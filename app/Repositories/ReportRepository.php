<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Parameter;
use App\Models\TypeForm;
use App\Models\Patient;
use Elibyy\TCPDF\TCPDF as PDF;
use Illuminate\Support\Facades\View;
use App\Repositories\Contracts\ReportInterface;


class ReportRepository implements ReportInterface
{
    /** @var string Establece la orientación de la página, los posibles valores son P o L */
    private $orientation;
    /** @var string Establece la unidad de medida a implementar en el reporte */
    private $units;
    /** @var string Establece el formato de la página (A4, Letter, ...) */
    private $format;
    /** @var string Establece el tipo de fuente a usar en el reporte */
    private $fontFamily;
    /** @var array Estilos a implementar en códigos QR a generar */
    private $qrCodeStyle;
    /** @var array Estilos a implementar en códigos de barras a generar */
    private $barCodeStyle;
    /** @var string Estilos para líneas de separación entre encabezado cuerpo y pie de página */
    private $lineStyle;
    /** @var string URL de verificación del reporte */
    private $urlVerify;
    /** @var string Fecha en la que se genera el reporte */
    private $reportDate;
    /** @var string Nombre del archivo a generar con el reporte */
    private $filename;
    /** @var string Título del reporte */
    private $title;
    /** @var string Asunto del reporte */
    private $subject;
    /** @var integer Establece el eje de las Y en donde comienza a mostrarse el encabezado del reporte */
    private $headerY;
    /** @var integer Establece el eje de las Y para el texto de subtítulo y fecha del reporte */
    private $headerTextY;
    /** @var object Crea y gestiona el objeto PDF */
    private $pdf;

    private $typeForm;
    private $patient;
    private $billingCompany;
    private $policyPrimary;
    private $subscriber;

    public function __construct()
    {
        $this->pdf = new PDF(config('app.name'));
    }

    public function setConfig($params = [])
    {
        $this->reportDate = $params['reportDate'] ?? \Carbon\Carbon::now()->format('d-m-Y');
        $this->orientation = $params['orientation'] ?? 'P';
        $this->units = $params['units'] ?? 'mm';
        $this->format = $params['format'] ?? 'LETTER';
        $this->fontFamily = $params['fontFamily'] ?? 'helvetica';
        $this->qrCodeStyle = $params['qrCodeStyle'] ?? [
            'border' => false,
            'padding' => 0,
            'fgcolor' => [0,0,0],
            'bgcolor' => false
        ];
        $this->barCodeStyle = $params['barCodeStyle'] ?? [
            'border' => 0,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => [0,0,0],
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        ];
        $this->lineStyle = $params['lineStyle'] ?? [
            'width' => 0.5,
            'cap' => 'butt',
            'join' => 'miter',
            'dash' => 0,
            'color' => [0, 0, 0]
        ];
        $this->urlVerify = $params['urlVerify'] ?? null;
        $this->headerY = 20.8;
        $this->headerTextY = 26.5;
        $this->filename = $params['filename'] ?? uniqid() . 'pdf';
        $this->subject = '';
        $typeForm = TypeForm::find($params['typeFormat']);
        if (isset($typeForm)) {
            if ($typeForm->form == 'CMS-1500 / 837P') {
                $this->typeForm = 'CMS-1500_837P_1';
            } elseif ($typeForm->form == 'UB-04 / 837I') {
                $this->typeForm = 'UB-04_837I_1';
            }
        } else {
            $this->typeForm = null;
        }
        $bC = $this->billingCompany = $params['billing_company_id'] ?? null;
        if (isset($bC)) {
            $this->patient = Patient::with([
                "user" => function ($query) use ($bC) {
                    $query->with([
                        "profile",
                        "addresses" => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        "contacts" => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        "billingCompanies"
                    ]);
                },
                "maritalStatus",
                "marital",
                "companies",
                "insurancePolicies",
                "insurancePlans" => function ($query) {
                    $query->with([
                        "insuranceCompany"
                    ]);
                },
                "billingCompanies",
                "guarantor",
                "emergencyContacts",
                "employments",
                "publicNote",
                "privateNotes"
            ])->find($params['patient_id']);
        } else {
            $this->patient = Patient::with([
                "user" => function ($query) use ($bC) {
                    $query->with([
                        "profile", "addresses", "contacts", "billingCompanies"
                    ]);
                },
                "maritalStatus",
                "marital",
                "companies",
                "insurancePolicies",
                "insurancePlans" => function ($query) {
                    $query->with([
                        "insuranceCompany"
                    ]);
                },
                "billingCompanies",
                "guarantor",
                "emergencyContacts",
                "employments",
                "publicNote",
                "privateNotes"
            ])->find($params['patient_id']);
        }
        if (isset($this->patient)) {
            $this->policyPrimary = $this->patient->insurancePolicies
                                        ->whereIn('id', $params['insurance_policies'])->first();
            $this->subscriber =
                ($this->policyPrimary->own ?? true)
                    ? $this->patient->user
                    : $this->policyPrimary->subscriber;
        }
    }

    public function setHeader(
        $title = '',
        $subTitle = '',
        $hasQR = true,
        $hasBarCode = false,
        $titleAlign = 'L',
        $subTitleAlign = 'C',
        $typeFormat = null
    ) {
        $params = (object)[
            'fontFamily' => $this->fontFamily,
            'barCodeStyle' => $this->barCodeStyle,
            'qrCodeStyle' => $this->qrCodeStyle,
            'lineStyle' => $this->lineStyle,
            'hasQR' => $hasQR,
            'hasBarCode' => $hasBarCode,
            'urlVerify' => $this->urlVerify,
            'title' => $title,
            'titleAlign' => $titleAlign,
            'subTitle' => $subTitle,
            'subTitleAlign' => $subTitleAlign,
            'reportDate' => $this->reportDate,
            'headerY' => $this->headerY,
            'headerTextY' => $this->headerTextY,
            'typeFormat' => $typeFormat
        ];
        $this->title = $title ?? '';
        $this->pdf->setHeaderCallback(function ($pdf) use ($params) {

            //get the current page break margin
            $bMargin = $pdf->getBreakMargin();
            // get current auto-page-break mode
            $auto_page_break = $pdf->getAutoPageBreak();
            // disable auto-page-break
            $pdf->SetAutoPageBreak(false, 0);
            // set bacground image
            if (isset($this->typeForm)) {
                $img_file = storage_path('pictures') . '/' . $this->typeForm . '.png';
            } else {
                $img_file = storage_path('pictures') . '/CMS-1500_837P_1.png';
            }
            $pdf->Image($img_file, 0, 0, 216, 280, '', '', '', false, 300, '', false, false, 0);

            if ($params->hasQR && !is_null($params->urlVerify)) {
                $pdf->write2DBarcode(
                    $params->urlVerify,
                    'QRCODE,H',
                    8.5,
                    6,
                    13,
                    13,
                    $params->qrCodeStyle,
                    'T'
                );
            }
        });
    }

    public function setBody($body, $isHTML = true, $htmlParams = [], $storeAction = 'E')
    {
        /** @var string Contenido del reporte */
        $htmlContent = $body;
        /** Configuración sobre el autor del reporte */
        $this->pdf->SetAuthor(__('BegentoOS - :app', ['app' => config('app.name')]));
        /** Configuración del título de reporte */
        //$this->pdf->SetTitle($this->title);
        /** Configuración sobre el asunto del reporte */
        $this->pdf->SetSubject($this->subject);
        /** Configuración de los márgenes del cuerpo del reporte */
        $this->pdf->SetMargins(0, 0, 0);
        $this->pdf->SetHeaderMargin(0);
        $this->pdf->SetFooterMargin(0);
        /** Establece si se configura o no las fuentes para sub configuraciones */
        $this->pdf->SetFontSubsetting(false);
        /** Configuración de la fuente por defecto del cuerpo del reporte */
        //$helveticaNeue = \TCPDF_FONTS::addTTFfont(storage_path() . '/fonts/HelveticaNeue/HELVETICANEUECYR-LIGHT.ttf', 'TrueTypeUnicode', '', 32);
        //$this->pdf->SetFont($helveticaNeue, '', 6);
        $this->pdf->SetFontSize('10px');
        /**
         * Configuración que permite realizar un salto de página automático al alcanzar el límite inferior del cuerpo
         * del reporte
         */
        //$this->pdf->SetAutoPageBreak(true, 15); //PDF_MARGIN_BOTTOM
        /** Agrega las respectivas páginas del reporte */
        $this->pdf->AddPage($this->orientation, $this->format);

        /** Título del reporte */

        /** 1. Tipo de Cobertura del segur de salud */
        $this->pdf->SetFont($this->fontFamily, '', 10);
        $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 8.5, 40, true, 0, false, true, 0, 'T', true);

        /** 1a. Insured ID number */
        if (isset($this->subscriber)) {
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $ssn = $this->subscriber->ssn ?? $this->subscriber->profile->ssn;
            $this->pdf->MultiCell(70, 5.8, $ssn, 0, 'L', false, 1, 135, 40, true, 0, false, true, 0, 'T', true);

            /** 4. Insured name */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $name = $this->subscriber->last_name ?? $this->subscriber->profile->last_name . ', ' . $this->subscriber->first_name ?? $this->subscriber->profile->first_name . ', ' . substr(($this->subscriber->middle_name ?? $this->subscriber->profile->middle_name) ?? 'M', 0, 1);
            $this->pdf->MultiCell(70, 5.8, $name, 0, 'L', false, 1, 135, 48, true, 0, false, true, 0, 'T', true);
        }


        /** Information de paciente */
        if (isset($this->patient)) {
            /** Configuración de la fuente  y tamaño en 20 para el título del reporte */
                $this->pdf->SetFont($this->fontFamily, '', 10);

                /** 2. Patient full name */
                $name = ($this->policyPrimary->own ?? true) ? '' :($this->patient->user->profile->last_name . ', ' . $this->patient->user->profile->first_name . ', ' . substr($this->patient->user->profile->middle_name, 0, 1));
                $this->pdf->MultiCell(70, 5.8, $name, 0, 'L', false, 1, 10, 48, true, 0, false, true, 0, 'T', true);
                
                /** 3. Patient Birth date and sex */

                $this->pdf->SetFont($this->fontFamily, '', 9);
                $birthdate = explode('-', $this->patient->user->profile->date_of_birth);
                $this->pdf->MultiCell(70, 10, $birthdate[2], 0, 'L', false, 1, 92, 48.5, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 10, $birthdate[1], 0, 'L', false, 1, 84, 48.5, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 10, $birthdate[0], 0, 'L', false, 1, 100, 48.5, true, 0, false, true, 0, 'T', true);
                $this->pdf->SetFont($this->fontFamily, '', 10);
                $sex = $this->patient->user->profile->sex;
                if (($sex == 'M') || ($sex == 'm')) {
                    $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 111, 48.5, true, 0, false, true, 0, 'T', true);
                } else {
                    $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 123.5, 48.5, true, 0, false, true, 0, 'T', true);
                }

                /** 5. Patient addres and contact */
                $address = $this->patient->user->addresses->first();
                $this->pdf->SetFont($this->fontFamily, '', 10);
                $this->pdf->MultiCell(70, 5.8, ($this->policyPrimary->own ?? true) ? '' : substr($address->address ?? '', 0, 28), 0, 'L', false, 1, 10, 56.5, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 5.8, ($this->policyPrimary->own ?? true) ? '' : substr($address->city ?? '', 0, 24), 0, 'L', false, 1, 10, 64.5, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 5.8, ($this->policyPrimary->own ?? true) ? '' : substr($address->state ?? '', 0, 3), 0, 'L', false, 1, 72.5, 64.5, true, 0, false, true, 0, 'T', true);
                $this->pdf->SetFont($this->fontFamily, '', 9);
                $this->pdf->MultiCell(70, 5.8, ($this->policyPrimary->own ?? true) ? '' : substr($address->zip ?? '', 0, 12), 0, 'L', false, 1, 10, 74, true, 0, false, true, 0, 'T', true);

                $contact = $this->patient->user->contacts->first();
                $this->pdf->MultiCell(70, 5.8, ($this->policyPrimary->own ?? true) ? '' : substr($contact->phone ?? '', 0, 3), 0, 'L', false, 1, 44.5, 74, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 5.8, ($this->policyPrimary->own ?? true) ? '' : substr($contact->phone ?? '', 3, 10), 0, 'L', false, 1, 53, 74, true, 0, false, true, 0, 'T', true);

                /** 6. Patient relationship to insured */
                $this->pdf->SetFont($this->fontFamily, '', 10);
                if ($this->policyPrimary->own ?? true) {
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 88.5, 57, true, 0, false, true, 0, 'T', true);
                } else {
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 123.5, 57, true, 0, false, true, 0, 'T', true);
                }

                /** 7. Insured address and contact */
                $address = $this->subscriber->addresses->first();
                $this->pdf->SetFont($this->fontFamily, '', 10);
                $this->pdf->MultiCell(70, 5.8, substr($address->address ?? '', 0, 28), 0, 'L', false, 1, 135, 56.5, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 5.8, substr($address->city ?? '', 0, 24), 0, 'L', false, 1, 135, 64.5, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 5.8, substr($address->state ?? '', 0, 3), 0, 'L', false, 1, 191.5, 64.5, true, 0, false, true, 0, 'T', true);
                $this->pdf->SetFont($this->fontFamily, '', 9);
                $this->pdf->MultiCell(70, 5.8, substr($address->zip ?? '', 0, 12), 0, 'L', false, 1, 135, 74, true, 0, false, true, 0, 'T', true);

                $contact = $this->subscriber->contacts->first();
                $this->pdf->MultiCell(70, 5.8, substr($contact->phone ?? '', 0, 3), 0, 'L', false, 1, 170, 74, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 5.8, substr($contact->phone ?? '', 3, 135), 0, 'L', false, 1, 178.5, 74, true, 0, false, true, 0, 'T', true);

                /** 8. Reservado */
                /** 9. Reservado para MEDIGAP */

                /** 10. Patient condition related */
                $this->pdf->SetFont($this->fontFamily, '', 10);
                if (!true) {
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 93.5, 90.8, true, 0, false, true, 0, 'T', true);
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 93.5, 99, true, 0, false, true, 0, 'T', true);
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 93.5, 107.2, true, 0, false, true, 0, 'T', true);
                } else {
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 108.5, 90.8, true, 0, false, true, 0, 'T', true);
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 108.5, 99, true, 0, false, true, 0, 'T', true);
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 108.5, 107.2, true, 0, false, true, 0, 'T', true);
                }
                /** 10d. Medicaid number patient */

                /** 11. Policy number or group number insured */
                $this->pdf->SetFont($this->fontFamily, '', 10);
                $this->pdf->MultiCell(70, 5.8, substr($this->policyPrimary->policy_number ?? '', 0, 29), 0, 'L', false, 1, 133, 82, true, 0, false, true, 0, 'T', true);

                /** 11a. Insured date of birth */
                if (!($this->policyPrimary->own ?? true)) {
                    $this->pdf->SetFont($this->fontFamily, '', 9);
                    $subscriberBirthdate = explode('-', $this->subscriber->date_of_birth);
                    $this->pdf->MultiCell(70, 10, $birthdate[2], 0, 'L', false, 1, 139.5, 91, true, 0, false, true, 0, 'T', true);
                    $this->pdf->MultiCell(70, 10, $birthdate[1], 0, 'L', false, 1, 146, 91, true, 0, false, true, 0, 'T', true);
                    $this->pdf->MultiCell(70, 10, $birthdate[0], 0, 'L', false, 1, 154, 91, true, 0, false, true, 0, 'T', true);

                    $this->pdf->SetFont($this->fontFamily, '', 10);
                    $sex = $this->subscriber->sex ?? 'M';
                    if (($sex == 'M') || ($sex == 'm')) {
                        $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 176, 90.5, true, 0, false, true, 0, 'T', true);
                    } else {
                        $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 193.8, 90.5, true, 0, false, true, 0, 'T', true);
                    }
                }

        }


        if ($isHTML) {
            $view = View::make($body, $htmlParams);
            $htmlContent = $view->render();
        }
        /** Escribre el contenido del reporte */
        $this->pdf->writeHTML($htmlContent, true, false, true, false, '');
        /** Establece el apuntador del reporte a la última página generada */
        $this->pdf->lastPage();
        /**
         * Genera el reporte. Las opciones disponibles son:
         *
         * I: Genera el archivo directamente para ser visualizado en el navegador
         * D: Genera el archivo y forza la descarga del mismo
         * F: Guarda el archivo generado en la ruta del servidor establecida por defecto
         * S: Devuelve el documento generado como una cadena de texto
         * FI: Es equivalente a las opciones F + I
         * FD: Es equivalente a las opciones F + D
         * E: Devuelve el documento del tipo mime base64 para ser adjuntado en correos electrónicos
         */
        return $this->pdf->Output($this->filename, $storeAction);
    }

    public function setFooter($pages = true, $footerText = '')
    {
        $fontFamily = $this->fontFamily;
        $lineStyle = $this->lineStyle;
        if (empty($footerText)) {
            $footerText = '';
        }

        $this->pdf->setFooterCallback(function ($pdf) use ($pages, $fontFamily, $footerText, $lineStyle) {
            /** Posición a 14 mm del borde inferior de la página*/
            $pdf->SetY(-14);
            /** Configuración de la fuenta a utilizar */
            $pdf->SetFont($fontFamily, 'I', 8);
            if ($pages) {
                /** @var string Número de página del reporte */
                $pageNumber = __('Pág. ').$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages();
                /** Texto a mostrar para el número de página */
                $pdf->MultiCell(20, 4, $pageNumber, 0, 'R', false, 0, 185, -8, true, 1, false, true, 1, 'T', true);
            }
            /** Texto a mostrar en el pie de página del reporte */
            $pdf->MultiCell(
                $pdf->getPageWidth() - PDF_MARGIN_RIGHT,
                8,
                $footerText,
                0,
                'C',
                false,
                0,
                7,
                -12,
                true,
                1,
                true,
                true,
                0,
                'T',
                true
            );
            /** Línea de separación entre el cuerpo del reporte y el pie de página */
            $pdf->Line(7, 265, 205, 265, $lineStyle);
        });
    }

    public function show($file = null, $outputMethod = 'F')
    {
        $filename = storage_path() . '/reports/' . $file ?? 'report' . Carbon::now() . '.pdf';
        $this->pdf->Output($filename, $outputMethod);
        return response()->download($filename);
    }
}
