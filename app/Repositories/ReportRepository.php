<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Company;
use App\Models\Diagnosis;
use App\Models\Facility;
use App\Models\HealthProfessional;
use App\Models\Patient;
use App\Models\PlaceOfService;
use App\Models\Procedure;
use App\Models\TypeCatalog;
use App\Models\TypeForm;
use App\Repositories\Contracts\ReportInterface;
use Carbon\Carbon;
use Elibyy\TCPDF\TCPDF as PDF;
use Illuminate\Support\Facades\View;

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
    /** @var int Establece el eje de las Y en donde comienza a mostrarse el encabezado del reporte */
    private $headerY;
    /** @var int Establece el eje de las Y para el texto de subtítulo y fecha del reporte */
    private $headerTextY;
    /** @var object Crea y gestiona el objeto PDF */
    private $pdf;

    private $print;
    private $typeForm;
    private $insuranceCompany;
    private $patient;
    private $company;
    private $billingCompany;
    private $billingProvider;
    private $provider;
    private $providerCode;
    private $policyPrimary;
    private $policyOther;
    private $subscriber;
    private $subscriberOther;
    private $patientOrInsuredInfo;
    private $physicianOrSupplierInfo;
    private $dateOfCurrent;
    private $dateOfCurrentQualifier;
    private $otherDate;
    private $otherDateQualifier;

    private $currentOccupationField;
    private $currentField;
    private $otherField;
    private $hospitalizationField;
    private $additionalField;

    private $claimServices;
    private $diagnoses;
    private $facility;

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
            'fgcolor' => [0, 0, 0],
            'bgcolor' => false,
        ];
        $this->barCodeStyle = $params['barCodeStyle'] ?? [
            'border' => 0,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => [0, 0, 0],
            'bgcolor' => false, // array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1, // height of a single module in points
        ];
        $this->lineStyle = $params['lineStyle'] ?? [
            'width' => 0.5,
            'cap' => 'butt',
            'join' => 'miter',
            'dash' => 0,
            'color' => [0, 0, 0],
        ];
        $this->urlVerify = $params['urlVerify'] ?? null;
        $this->headerY = 20.8;
        $this->headerTextY = 26.5;
        $this->filename = $params['filename'] ?? uniqid().'pdf';
        $this->subject = '';
        $this->print = $params['print'] ?? false;

        $typeForm = TypeForm::find($params['typeFormat']);
        if (isset($typeForm)) {
            if ('CMS-1500 / 837P' == $typeForm->form) {
                $this->typeForm = 'CMS-1500_837P_1';
            } elseif ('UB-04 / 837I' == $typeForm->form) {
                $this->typeForm = 'UB-04_837I_1';
            }
        } else {
            $this->typeForm = null;
        }
        $bC = $this->billingCompany = $params['billing_company_id'] ?? null;
        if (isset($bC)) {
            $this->patient = Patient::with([
                'user' => function ($query) use ($bC) {
                    $query->with([
                        'profile',
                        'addresses' => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        'contacts' => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                    ]);
                },
            ])->find($params['patient_id']);
        } else {
            $this->patient = Patient::with([
                'user' => function ($query) {
                    $query->with(['profile', 'addresses', 'contacts']);
                },
            ])->find($params['patient_id']);
        }
        if (isset($this->patient)) {
            $this->policyPrimary = $this->patient->insurancePolicies
                                        ->whereIn('id', $params['insurance_policies'] ?? [])->first();
            $this->policyOther = $this->patient->insurancePolicies
                                        ->whereIn('id', $params['insurance_policies'] ?? [])->skip(1)->first();
            if ($this->policyPrimary) {
                $this->insuranceCompany = $this->policyPrimary->insurancePlan->insuranceCompany;
            }
            $this->subscriber =
                ($this->policyPrimary->own ?? true)
                    ? $this->patient->user
                    : $this->policyPrimary->subscriber;

            $this->subscriberOther =
                ($this->policyOther->own ?? true)
                    ? $this->patient->user
                    : $this->policyOther->subscriber;
        }

        $this->patientOrInsuredInfo = $params['patient_or_insured_information'] ?? null;
        $this->physicianOrSupplierInfo = $params['physician_or_supplier_information'] ?? null;

        if (isset($this->physicianOrSupplierInfo->claimDateInformations)) {
            $this->otherField = null;
            $this->currentField = null;
            $this->currentOccupationField = null;
            $this->hospitalizationField = null;
            $this->additionalField = null;

            foreach ($this->physicianOrSupplierInfo->claimDateInformations ?? [] as $service) {
                if (str_contains($service->field->description ?? '', '14.')) {
                    if (!isset($this->currentField)) {
                        $this->currentField = $service;
                    }
                } elseif (str_contains($service->field->description ?? '', '15.')) {
                    if (!isset($this->otherField)) {
                        $this->otherField = $service;
                    }
                } elseif (str_contains($service->field->description ?? '', '16.')) {
                    if (!isset($this->currentOccupationField)) {
                        $this->currentOccupationField = $service;
                    }
                } elseif (str_contains($service->field->description ?? '', '18.')) {
                    if (!isset($this->hospitalizationField)) {
                        $this->hospitalizationField = $service;
                    }
                } elseif (str_contains($service->field->description ?? '', '19.')) {
                    if (!isset($this->additionalField)) {
                        $this->additionalField = $service;
                    }
                }
            }
        }
        if (isset($params['service_provider_id'])) {
            $this->provider = HealthProfessional::find($params['service_provider_id']);
            $this->providerCode = 'DN';
        } elseif (isset($params['referred_id'])) {
            $this->provider = HealthProfessional::find($params['referred_id']);
            $this->providerCode = 'DK';
        }

        if (isset($params['billing_provider_id'])) {
            $this->billingProvider = HealthProfessional::find($params['billing_provider_id']);
        }

        $this->claimServices = $params['claim_form_services'];

        foreach ($params['diagnoses'] ?? [] as $diagnosis) {
            $diag = Diagnosis::find($diagnosis->pivot->diagnosis_id ?? $diagnosis['diagnosis_id']);
            $this->diagnoses[$diagnosis->pivot->item ?? $diagnosis['item']] = $diag->code;
        }
        $this->company = Company::find($params['company_id'] ?? null);
        $this->facility = Facility::find($params['facility_id'] ?? null);
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
        $params = (object) [
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
            'typeFormat' => $typeFormat,
            'print' => $this->print,
        ];
        $this->title = $title ?? '';
        $this->pdf->setHeaderCallback(function ($pdf) use ($params) {
            // get the current page break margin
            $bMargin = $pdf->getBreakMargin();
            // get current auto-page-break mode
            $auto_page_break = $pdf->getAutoPageBreak();
            // disable auto-page-break
            $pdf->SetAutoPageBreak(false, 0);
            // set bacground image
            if (false == $params->print) {
                if (isset($this->typeForm)) {
                    $img_file = storage_path('pictures').'/CMS-1500_837P_1_v3.png';
                } else {
                    $img_file = storage_path('pictures').'/CMS-1500_837P_1_v3.png';
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
            }
        });
    }

    public function setBody($body, $isHTML = true, $htmlParams = [], $storeAction = 'E', $end = true)
    {
        /** @var string Contenido del reporte */
        $htmlContent = $body;
        /* Configuración sobre el autor del reporte */
        $this->pdf->SetAuthor(__('BegentoOS - :app', ['app' => config('app.name')]));
        /* Configuración del título de reporte */
        // $this->pdf->SetTitle($this->title);
        /* Configuración sobre el asunto del reporte */
        $this->pdf->SetSubject($this->subject);
        /* Configuración de los márgenes del cuerpo del reporte */
        $this->pdf->SetMargins(0, 0, 0);
        $this->pdf->SetHeaderMargin(0);
        $this->pdf->SetFooterMargin(0);
        /* Establece si se configura o no las fuentes para sub configuraciones */
        $this->pdf->SetFontSubsetting(false);
        /* Configuración de la fuente por defecto del cuerpo del reporte */
        // $helveticaNeue = \TCPDF_FONTS::addTTFfont(storage_path() . '/fonts/HelveticaNeue/HELVETICANEUECYR-LIGHT.ttf', 'TrueTypeUnicode', '', 32);
        // $this->pdf->SetFont($helveticaNeue, '', 6);
        $this->pdf->SetFontSize('10px');
        /*
         * Configuración que permite realizar un salto de página automático al alcanzar el límite inferior del cuerpo
         * del reporte
         */
        // $this->pdf->SetAutoPageBreak(true, 15); //PDF_MARGIN_BOTTOM
        /* Agrega las respectivas páginas del reporte */
        $this->pdf->AddPage($this->orientation, $this->format);

        /** Título del reporte */

        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

        /** Info Billing Company */
        $address = ($this->insuranceCompany) ? $this->insuranceCompany->addresses->first() : null;

        $this->pdf->SetFont($this->fontFamily, '', 10);
        $this->pdf->MultiCell(70, 5.8, $this->insuranceCompany->name ?? '', 0, 'L', false, 1, 107, 16, true, 0, false, true, 0, 'T', true);
        $this->pdf->MultiCell(70, 5.8, $address->address ?? '', 0, 'L', false, 1, 107, 20, true, 0, false, true, 0, 'T', true);
        $this->pdf->MultiCell(70, 5.8, '', 0, 'L', false, 1, 107, 24, true, 0, false, true, 0, 'T', true);
        $this->pdf->MultiCell(70, 5.8,
            substr($address->city ?? '', 0, 24).' '.substr($address->state ?? '', 0, 3).substr($address->zip ?? '', 0, 12),
            0, 'L', false, 1, 107, 28, true, 0, false, true, 0, 'T', true);

        /* 1. Tipo de Cobertura del segur de salud */
        $this->pdf->SetFont($this->fontFamily, '', 10);
        $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 8.5, 40, true, 0, false, true, 0, 'T', true);

        /* 1a. Insured ID number */
        if (isset($this->subscriber)) {
            $this->pdf->SetFont($this->fontFamily, '', 9);
            /**$ssn = (isset($this->subscriber->ssn)
                ? $this->subscriber->ssn
                : (isset($this->subscriber->profile->ssn)
                    ? $this->subscriber->profile->ssn
                    : ''));*/
            $this->pdf->MultiCell(70, 5.8, $this->policyPrimary->policy_number ?? '', 0, 'L', false, 1, 135, 40, true, 0, false, true, 0, 'T', true);

            /* 4. Insured name */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $name = ($this->subscriber->last_name ?? $this->subscriber->profile->last_name).', '.($this->subscriber->first_name ?? $this->subscriber->profile->first_name).', '.substr(isset($this->subscriber->middle_name) ? $this->subscriber->middle_name : (isset($this->subscriber->profile->middle_name) ? $this->subscriber->profile->middle_name : ''), 0, 1);
            $this->pdf->MultiCell(70, 5.8, $name, 0, 'L', false, 1, 135, 48, true, 0, false, true, 0, 'T', true);
        }

        /* Information de paciente */
        if (isset($this->patient)) {
            /* Configuración de la fuente  y tamaño en 20 para el título del reporte */
            $this->pdf->SetFont($this->fontFamily, '', 10);

            /** 2. Patient full name */
            $name = ($this->patient->user->profile->last_name.', '.$this->patient->user->profile->first_name.', '.substr($this->patient->user->profile->middle_name, 0, 1));
            $this->pdf->MultiCell(70, 5.8, $name, 0, 'L', false, 1, 10, 48, true, 0, false, true, 0, 'T', true);

            /* 3. Patient Birth date and sex */

            $this->pdf->SetFont($this->fontFamily, '', 9);
            $birthdate = explode('-', $this->patient->user->profile->date_of_birth);
            $this->pdf->MultiCell(70, 10, $birthdate[2], 0, 'L', false, 1, 92, 48.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $birthdate[1], 0, 'L', false, 1, 84, 48.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $birthdate[0], 0, 'L', false, 1, 100, 48.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $sex = $this->patient->user->profile->sex;
            if (('M' == $sex) || ('m' == $sex)) {
                $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 111, 48.5, true, 0, false, true, 0, 'T', true);
            } else {
                $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 123.5, 48.5, true, 0, false, true, 0, 'T', true);
            }

            /** 5. Patient addres and contact */
            $address = $this->patient->user->addresses->first();
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $this->pdf->MultiCell(70, 5.8, substr($address->address ?? '', 0, 28), 0, 'L', false, 1, 10, 56.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, substr($address->city ?? '', 0, 24), 0, 'L', false, 1, 10, 64.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, substr($address->state ?? '', 0, 3), 0, 'L', false, 1, 72.5, 64.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $this->pdf->MultiCell(70, 5.8, substr($address->zip ?? '', 0, 12), 0, 'L', false, 1, 10, 74, true, 0, false, true, 0, 'T', true);

            $contact = $this->patient->user->contacts->first();
            $this->pdf->MultiCell(70, 5.8, substr($contact->phone ?? '', 0, 3), 0, 'L', false, 1, 44.5, 74, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, substr($contact->phone ?? '', 3, 10), 0, 'L', false, 1, 53, 74, true, 0, false, true, 0, 'T', true);

            /* 6. Patient relationship to insured */
            if ($this->subscriber) {
                $this->pdf->SetFont($this->fontFamily, '', 10);
                if ($this->policyPrimary->own ?? true) {
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 88.5, 57, true, 0, false, true, 0, 'T', true);
                } elseif ($this->subscriber->relationship && str_contains(strtolower($this->subscriber->relationship->description), 'spouse')) {
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 101, 57, true, 0, false, true, 0, 'T', true);
                } elseif ($this->subscriber->relationship && str_contains(strtolower($this->subscriber->relationship->description), 'child')) {
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 111, 57, true, 0, false, true, 0, 'T', true);
                } else {
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 123.5, 57, true, 0, false, true, 0, 'T', true);
                }
            }

            /** 7. Insured address and contact */
            $address = $this->subscriber?->addresses->first() ?? null;
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $this->pdf->MultiCell(70, 5.8, substr($address->address ?? '', 0, 28), 0, 'L', false, 1, 135, 56.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, substr($address->city ?? '', 0, 24), 0, 'L', false, 1, 135, 64.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, substr($address->state ?? '', 0, 3), 0, 'L', false, 1, 191.5, 64.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $this->pdf->MultiCell(70, 5.8, substr($address->zip ?? '', 0, 12), 0, 'L', false, 1, 135, 74, true, 0, false, true, 0, 'T', true);

            $contact = $this->subscriber?->contacts->first() ?? null;
            $this->pdf->MultiCell(70, 5.8, substr($contact->phone ?? '', 0, 3), 0, 'L', false, 1, 170, 74, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, substr($contact->phone ?? '', 3, 135), 0, 'L', false, 1, 178.5, 74, true, 0, false, true, 0, 'T', true);

            /* 8. Reservado */
            /* 9. Reservado para MEDIGAP */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            if ($this->policyOther && $this->policyPrimary && $this->policyOther->id != $this->policyPrimary->id) {
                if ($this->subscriberOther && $this->subscriberOther->id != $this->subscriber->id) {
                    $name = ($this->subscriberOther->last_name ?? $this->subscriberOther->profile->last_name).', '.($this->subscriberOther->first_name ?? $this->subscriberOther->profile->first_name).', '.substr(isset($this->subscriberOther->middle_name) ? $this->subscriberOther->middle_name : (isset($this->subscriberOther->profile->middle_name) ? $this->subscriberOther->profile->middle_name : ''), 0, 1);
                    $this->pdf->MultiCell(70, 5.8, $name, 0, 'L', false, 1, 10, 81.5, true, 0, false, true, 0, 'T', true);
                }
                /* 9a. Other insurance policy group */
                $this->pdf->MultiCell(70, 5.8, substr($this->policyOther->policy_number ?? '', 0, 29), 0, 'L', false, 1, 10, 90, true, 0, false, true, 0, 'T', true);

                /* 9d. Other insurance plan name */
                $this->pdf->MultiCell(70, 5.8, $this->policyOther->insurancePlan->name ?? '', 0, 'L', false, 1, 10, 115.5, true, 0, false, true, 0, 'T', true);
            }

            /* 10. Patient condition related */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            if ($this->patientOrInsuredInfo) {
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1,
                    $this->patientOrInsuredInfo['employment_related_condition'] ? 93.5 : 108.5, 90.8, true, 0, false, true, 0, 'T', true);
                if ($this->patientOrInsuredInfo['auto_accident_related_condition']) {
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 93.5, 99, true, 0, false, true, 0, 'T', true);
                } else {
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 108.5, 99, true, 0, false, true, 0, 'T', true);
                    $this->pdf->MultiCell(70, 5.8, substr($this->patientOrInsuredInfo['auto_accident_place_state'] ?? '', 0, 2), 0, 'L', false, 1, 120, 99, true, 0, false, true, 0, 'T', true);
                }
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1,
                    $this->patientOrInsuredInfo['other_accident_related_condition'] ? 93.5 : 108.5, 107.2, true, 0, false, true, 0, 'T', true);
            } else {
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 108.5, 90.8, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 108.5, 99, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 108.5, 107.2, true, 0, false, true, 0, 'T', true);
            }
            /* 10d. Medicaid number patient */

            /* 11. Policy number or group number insured */
            if ($this->policyPrimary && ('P' == $this->policyPrimary->typeResponsibility->code)) {
                $this->pdf->SetFont($this->fontFamily, '', 10);
                $this->pdf->MultiCell(70, 5.8, 'NONE', 0, 'L', false, 1, 133, 82, true, 0, false, true, 0, 'T', true);
            } else {
                $this->pdf->SetFont($this->fontFamily, '', 10);
                $this->pdf->MultiCell(70, 5.8, substr($this->policyPrimary->group_number ?? '', 0, 29), 0, 'L', false, 1, 133, 82, true, 0, false, true, 0, 'T', true);
            }

            /* 11a. Insured date of birth */
            if (!($this->policyPrimary->own ?? true)) {
                $this->pdf->SetFont($this->fontFamily, '', 9);
                $subscriberBirthdate = explode('-', $this->subscriber?->date_of_birth);
                $this->pdf->MultiCell(70, 10, $birthdate[2], 0, 'L', false, 1, 146, 91, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 10, $birthdate[1], 0, 'L', false, 1, 139.5, 91, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 10, $birthdate[0], 0, 'L', false, 1, 154, 91, true, 0, false, true, 0, 'T', true);

                $this->pdf->SetFont($this->fontFamily, '', 10);
                $sex = $this->subscriber->sex ?? 'M';
                if (('M' == $sex) || ('m' == $sex)) {
                    $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 176, 90.5, true, 0, false, true, 0, 'T', true);
                } else {
                    $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 193.8, 90.5, true, 0, false, true, 0, 'T', true);
                }
            }
            /* 11c. Insurance plan name */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $this->pdf->MultiCell(70, 5.8, $this->policyPrimary->insurancePlan->name ?? '', 0, 'L', false, 1, 135, 107.5, true, 0, false, true, 0, 'T', true);
            /* 11d. Other benefit insurance plan */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 148.5, 115.5, true, 0, false, true, 0, 'T', true);

            /* 12. Patient authorization */
            if ($this->patientOrInsuredInfo['patient_signature'] ?? false) {
                $this->pdf->MultiCell(70, 10, 'Signature on File', 0, 'L', false, 1, 27, 131.5, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 10, now()->format('m/d/Y'), 0, 'L', false, 1, 100, 131.5, true, 0, false, true, 0, 'T', true);
            }

            /* 13. Insured authorization */
            if ($this->patientOrInsuredInfo['insured_signature'] ?? false) {
                $this->pdf->MultiCell(70, 10, 'Signature on File', 0, 'L', false, 1, 148.5, 131.5, true, 0, false, true, 0, 'T', true);
            }

            /* 14. Date of current inlines */
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $dateOfCurrent = explode('-', $this->currentField->from_date_or_current ?? '');
            $this->pdf->MultiCell(70, 10, $dateOfCurrent[2] ?? '', 0, 'L', false, 1, 19.5, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $dateOfCurrent[1] ?? '', 0, 'L', false, 1, 11, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $dateOfCurrent[0] ?? '', 0, 'L', false, 1, 27, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $this->currentField->qualifier->code ?? '', 0, 'L', false, 1, 46, 141, true, 0, false, true, 0, 'T', true);

            /* 15. Other date inlines */
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $otherDate = explode('-', $this->otherField->from_date_or_current ?? '');
            $this->pdf->MultiCell(70, 10, $this->otherField->qualifier->code ?? '', 0, 'L', false, 1, 83, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $otherDate[2] ?? '', 0, 'L', false, 1, 106, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $otherDate[1] ?? '', 0, 'L', false, 1, 100, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $otherDate[0] ?? '', 0, 'L', false, 1, 114, 141, true, 0, false, true, 0, 'T', true);

            /* 16. Other date inlines */
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $fromDate = explode('-', $this->currentOccupationField->from_date_or_current ?? '');
            $toDate = explode('-', $this->currentOccupationField->to_date ?? '');

            $this->pdf->MultiCell(70, 10, $fromDate[2] ?? '', 0, 'L', false, 1, 148, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $fromDate[1] ?? '', 0, 'L', false, 1, 142, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $fromDate[0] ?? '', 0, 'L', false, 1, 156, 141, true, 0, false, true, 0, 'T', true);

            $this->pdf->MultiCell(70, 10, $toDate[2] ?? '', 0, 'L', false, 1, 183, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $toDate[1] ?? '', 0, 'L', false, 1, 177, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $toDate[0] ?? '', 0, 'L', false, 1, 191, 141, true, 0, false, true, 0, 'T', true);

            /* 17. Provider */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $providerName = $this->provider->user->profile->first_name ?? null;
            $providerName .= isset($this->provider->user->profile->middle_name)
                ? ' '.substr($this->provider->user->profile->middle_name, 0, 1).' '
                : ' ';
            $providerName .= $this->provider->user->profile->last_name ?? '';
            $providerName .= ' '.($this->provider->user->profile->suffix_name ?? '');

            $this->pdf->MultiCell(70, 10, $this->providerCode ?? '', 0, 'L', false, 1, 9, 149, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $providerName ?? '', 0, 'L', false, 1, 15.5, 149, true, 0, false, true, 0, 'T', true);

            /* 17a. Info provider */
            $this->pdf->SetFont($this->fontFamily, '', 9);
            /* Número de licencia estatal */
            // $this->pdf->MultiCell(70, 10, '0B', 0, 'L', false, 1, 81, 145, true, 0, false, true, 0, 'T', true);
            /* Número de UPIN */
            // $this->pdf->MultiCell(70, 10, '1G', 0, 'L', false, 1, 81, 145, true, 0, false, true, 0, 'T', true);
            /* Número comercial del proveedor */
            $this->pdf->MultiCell(70, 10, 'G2', 0, 'L', false, 1, 81, 145, true, 0, false, true, 0, 'T', true);
            /* Número de ubicación */
            // $this->pdf->MultiCell(70, 10, 'LU', 0, 'L', false, 1, 81, 145, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, 'Por asignar', 0, 'L', false, 1, 86.5, 145, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $this->provider->npi ?? '', 0, 'L', false, 1, 86.5, 149, true, 0, false, true, 0, 'T', true);

            /* 18. Hospitalization dates */
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $fromDate = explode('-', $this->hospitalizationField->from_date_or_current ?? '');
            $toDate = explode('-', $this->hospitalizationField->to_date ?? '');

            $this->pdf->MultiCell(70, 10, $fromDate[2] ?? '', 0, 'L', false, 1, 148, 149, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $fromDate[1] ?? '', 0, 'L', false, 1, 142, 149, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $fromDate[0] ?? '', 0, 'L', false, 1, 156, 149, true, 0, false, true, 0, 'T', true);

            $this->pdf->MultiCell(70, 10, $toDate[2] ?? '', 0, 'L', false, 1, 183, 149, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $toDate[1] ?? '', 0, 'L', false, 1, 177, 149, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $toDate[0] ?? '', 0, 'L', false, 1, 191, 149, true, 0, false, true, 0, 'T', true);

            /* 19. Additional claim info */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $this->pdf->MultiCell(70, 10, 'Por asignar', 0, 'L', false, 1, 9, 157, true, 0, false, true, 0, 'T', true);

            /* 20. Outaide LAB */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            if ($this->physicianOrSupplierInfo->outside_lab ?? false) {
                $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 136, 157.2, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(25, 10, $this->physicianOrSupplierInfo->charges ?? '', 0, 'R', false, 1, 160, 157.2, true, 0, false, true, 0, 'T', true);
            } else {
                $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 148.8, 157.2, true, 0, false, true, 0, 'T', true);
            }

            /* 21. Diagnosis LCD */
            $this->pdf->MultiCell(8, 10, '0', 0, 'L', false, 1, 111.5, 162, true, 0, false, true, 0, 'T', true);
            // $this->pdf->MultiCell(8, 10, '9', 0, 'L', false, 1, 111.5, 162, true, 0, false, true, 0, 'T', true);

            $this->pdf->MultiCell(20, 10, $this->diagnoses['A'] ?? '', 0, 'L', false, 1, 12.5, 166, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->diagnoses['B'] ?? '', 0, 'L', false, 1, 45, 166, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->diagnoses['C'] ?? '', 0, 'L', false, 1, 77.9, 166, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->diagnoses['D'] ?? '', 0, 'L', false, 1, 110.4, 166.3, true, 0, false, true, 0, 'T', true);

            $this->pdf->MultiCell(20, 10, $this->diagnoses['E'] ?? '', 0, 'L', false, 1, 12.5, 170, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->diagnoses['F'] ?? '', 0, 'L', false, 1, 45, 170.1, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->diagnoses['G'] ?? '', 0, 'L', false, 1, 77.9, 170, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->diagnoses['H'] ?? '', 0, 'L', false, 1, 110.4, 170.5, true, 0, false, true, 0, 'T', true);

            $this->pdf->MultiCell(20, 10, $this->diagnoses['I'] ?? '', 0, 'L', false, 1, 12.5, 174.2, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->diagnoses['J'] ?? '', 0, 'L', false, 1, 45, 174.2, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->diagnoses['K'] ?? '', 0, 'L', false, 1, 77.9, 174.2, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->diagnoses['L'] ?? '', 0, 'L', false, 1, 110.4, 174.2, true, 0, false, true, 0, 'T', true);

            /* 22. Resubmision Code */
            /* Sustitución del reclamo anteriror */
            $this->pdf->MultiCell(20, 10, '', 0, 'L', false, 1, 132, 166.3, true, 0, false, true, 0, 'T', true);
            /* Anulación del reclamo anteriror */
            // $this->pdf->MultiCell(20, 10, '8', 0, 'L', false, 1, 132, 166.3, true, 0, false, true, 0, 'T', true);

            /* Original REF */
            $this->pdf->MultiCell(20, 10, '', 0, 'L', false, 1, 160, 166.3, true, 0, false, true, 0, 'T', true);

            /* 23. Authorization number */
            $this->pdf->MultiCell(70, 10, $this->physicianOrSupplierInfo->prior_authorization_number ?? '', 0, 'L', false, 1, 132, 174.2, true, 0, false, true, 0, 'T', true);

            $this->pdf->SetFont($this->fontFamily, '', 10);
            $lineSpaceY = 8.6;
            $totalCharge = 0;
            $totalCopay = 0;
            foreach ($this->claimServices as $index => $claimService) {
                /** 24a. Dates of services */
                $fromDate = explode('-', $claimService->from_service ?? '');
                $toDate = explode('-', $claimService->to_service ?? '');

                $this->pdf->MultiCell(70, 10, $fromDate[2] ?? '', 0, 'L', false, 1, 15.5, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 10, $fromDate[1] ?? '', 0, 'L', false, 1, 9, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 10, substr($fromDate[0] ?? '', 2, 2), 0, 'L', false, 1, 23, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);

                $this->pdf->MultiCell(70, 10, $toDate[2] ?? '', 0, 'L', false, 1, 38, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 10, $toDate[1] ?? '', 0, 'L', false, 1, 31, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 10, substr($toDate[0] ?? '', 2, 2), 0, 'L', false, 1, 46, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);

                /** 24b. Places of services */
                $pos = PlaceOfService::find($claimService->place_of_service_id ?? null);
                $this->pdf->MultiCell(70, 10, $pos->code ?? '', 0, 'L', false, 1, 52.5, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
                /* 24c. Places of services */
                if ($claimService->emg ?? false) {
                    $this->pdf->MultiCell(70, 10, 'Y', 0, 'L', false, 1, 61, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
                }

                /** 24d. Procedures services or suppliers */
                $cpt = Procedure::find($claimService->place_of_service_id ?? null);
                $this->pdf->MultiCell(70, 10, $cpt->code ?? '', 0, 'L', false, 1, 70, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
                $lineSpaceX = 8;
                foreach ($claimService->modifiers ?? [] as $key => $mod) {
                    $this->pdf->MultiCell(70, 10, $mod['name'] ?? '', 0, 'L', false, 1, 87.5 + ($lineSpaceX * $key) - (0.3 * $key), 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
                }

                /** 24e. Diagnosis pointer */
                $diagPointers = '';
                foreach ($claimService->diagnostic_pointers ?? [] as $key => $pointer) {
                    $diagPointers .= $pointer;
                }
                $this->pdf->MultiCell(70, 10, $diagPointers ?? '', 0, 'L', false, 1, 118, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);

                /** 24f. Charges */
                $arrayPrice = explode('.', $claimService->price ?? '');
                $totalCharge += $claimService->price ?? 0;
                $totalCopay += $claimService->copay ?? 0;
                $this->pdf->MultiCell(15, 10, $arrayPrice[0] ?? '', 0, 'R', false, 1, 132, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(15, 10, $arrayPrice[1] ?? '', 0, 'L', false, 1, 147, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);

                /* 24g. Days or units */
                if (str_contains($claimService->days_or_units ?? '', '.')) {
                    $this->pdf->MultiCell(15, 10, $claimService->days_or_units ?? '', 0, 'L', false, 1, 153, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
                } else {
                    $this->pdf->MultiCell(15, 10, substr($claimService->days_or_units ?? '', 0, 2), 0, 'L', false, 1, 153, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
                }

                /** 24h. EPSDT/Plan familiar */
                $epsdt = TypeCatalog::find($claimService->epsdt_id ?? null);
                $this->pdf->SetFont($this->fontFamily, '', 9);
                $this->pdf->MultiCell(70, 10, $epsdt->code ?? '', 0, 'L', false, 1, 163, 187 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);

                $planFamily = TypeCatalog::find($claimService->family_planning_id ?? null);
                $this->pdf->SetFont($this->fontFamily, '', 10);
                $this->pdf->MultiCell(70, 10, $planFamily->code ?? '', 0, 'L', false, 1, 163, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);

                /* 24i. Qualifier */

                $this->pdf->SetFont($this->fontFamily, '', 9);
                $this->pdf->MultiCell(70, 10, '', 0, 'L', false, 1, 169, 187 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);

                /* 24j. NPI */
                $this->pdf->SetFont($this->fontFamily, '', 9);
                $this->pdf->MultiCell(70, 10, '', 0, 'L', false, 1, 176, 187 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);

                $this->pdf->SetFont($this->fontFamily, '', 10);
                $this->pdf->MultiCell(70, 10, $this->provider->npi ?? null, 0, 'L', false, 1, 176, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
            }

            /* 25. FederalTax */
            if (isset($this->company->ein)) {
                $this->pdf->MultiCell(35, 10, $this->company->ein ?? '', 0, 'L', false, 1, 10, 240.8, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(35, 10, 'X', 0, 'L', false, 1, 48.5, 240.8, true, 0, false, true, 0, 'T', true);
            }

            // $this->pdf->MultiCell(35, 10, 'SSN', 0, 'L', false, 1, 10, 240.8, true, 0, false, true, 0, 'T', true);
            // $this->pdf->MultiCell(35, 10, 'X', 0, 'L', false, 1, 53.5, 240.8, true, 0, false, true, 0, 'T', true);

            /* 26. NumAccount */
            $this->pdf->MultiCell(35, 10, $this->physicianOrSupplierInfo->patient_account_num ?? '', 0, 'L', false, 1, 65, 240.8, true, 0, false, true, 0, 'T', true);

            /* 27. Accept Assignment */
            if ($this->physicianOrSupplierInfo->accept_assignment ?? false) {
                $this->pdf->MultiCell(35, 10, 'X', 0, 'L', false, 1, 101.2, 240.8, true, 0, false, true, 0, 'T', true);
            } else {
                $this->pdf->MultiCell(35, 10, 'X', 0, 'L', false, 1, 113.5, 240.8, true, 0, false, true, 0, 'T', true);
            }

            /** 28. Total charge */
            $arrayPrice = explode('.', $totalCharge ?? '');
            $this->pdf->MultiCell(18, 10, $arrayPrice[0] ?? '', 0, 'R', false, 1, 134, 240.8, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(6, 10, ('' != $arrayPrice[0]) ? (str_pad($arrayPrice[1] ?? '', 2, '0', STR_PAD_RIGHT) ?? '00') : '', 0, 'L', false, 1, 152, 240.8, true, 0, false, true, 0, 'T', true);

            /** 29. Amount paid */
            $arrayPrice = explode('.', $totalCopay ?? '');
            $this->pdf->MultiCell(15, 10, $arrayPrice[0] ?? '', 0, 'R', false, 1, 162, 240.8, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(6, 10, ('' != $arrayPrice[0]) ? (str_pad($arrayPrice[1] ?? '', 2, '0', STR_PAD_RIGHT) ?? '00') : '', 0, 'L', false, 1, 177, 240.8, true, 0, false, true, 0, 'T', true);

            /* 31. Signature physician */

            $this->pdf->MultiCell(70, 10, 'Signature on File', 0, 'L', false, 1, 15, 258, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, now()->format('m/d/y'), 0, 'L', false, 1, 45, 258, true, 0, false, true, 0, 'T', true);

            /** 32. Facility */
            $address = ($this->facility) ? $this->facility->addresses->first() : null;

            $this->pdf->SetFont($this->fontFamily, '', 9);
            $this->pdf->MultiCell(70, 5.8, $this->facility->name ?? '', 0, 'L', false, 1, 65, 248, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, $address->address ?? '', 0, 'L', false, 1, 65, 252, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8,
                substr($address->city ?? '', 0, 24).' '.substr($address->state ?? '', 0, 3).substr($address->zip ?? '', 0, 12),
                0, 'L', false, 1, 65, 256, true, 0, false, true, 0, 'T', true);

            /* 32a. Facility NPI */
            $this->pdf->MultiCell(70, 5.8, $this->facility->npi ?? '', 0, 'L', false, 1, 65, 262, true, 0, false, true, 0, 'T', true);

            /** 32b. Facility Other */
            // $this->pdf->MultiCell(70, 5.8, ($this->facility->npi ?? ''), 0, 'L', false, 1, 93.5, 262, true, 0, false, true, 0, 'T', true);

            /** 33. Billing providerInfo */
            $address = ($this->billingProvider && $this->billingProvider->user->addresses) ? $this->billingProvider->user->addresses->first() : null;

            $this->pdf->SetFont($this->fontFamily, '', 9);
            $name = isset($this->billingProvider)
                ? ($this->billingProvider->user->profile->last_name.', '.$this->billingProvider->user->profile->first_name.', '.substr($this->billingProvider->user->profile->middle_name, 0, 1))
                : '';

            $this->pdf->MultiCell(70, 5.8, $name ?? '', 0, 'L', false, 1, 134, 248, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, $address->address ?? '', 0, 'L', false, 1, 134, 252, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8,
                substr($address->city ?? '', 0, 24).' '.substr($address->state ?? '', 0, 3).substr($address->zip ?? '', 0, 12),
                0, 'L', false, 1, 134, 256, true, 0, false, true, 0, 'T', true);

            /* 32a. billingProvider NPI */
            $this->pdf->MultiCell(70, 5.8, $this->billingProvider->npi ?? '', 0, 'L', false, 1, 134, 262, true, 0, false, true, 0, 'T', true);

            /* 32b. billingProvider Other */
            // $this->pdf->MultiCell(70, 5.8, ($this->billingProvider->npi ?? ''), 0, 'L', false, 1, 93.5, 262, true, 0, false, true, 0, 'T', true);
        }

        if ($isHTML) {
            $view = View::make($body, $htmlParams);
            $htmlContent = $view->render();
        }
        /* Escribre el contenido del reporte */
        $this->pdf->writeHTML($htmlContent, true, false, true, false, '');
        /* Establece el apuntador del reporte a la última página generada */
        $this->pdf->lastPage();
        /*
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
        if (true == $end) {
            return $this->pdf->Output($this->filename, $storeAction);
        }
    }

    public function setFooter($pages = true, $footerText = '')
    {
        $fontFamily = $this->fontFamily;
        $lineStyle = $this->lineStyle;
        if (empty($footerText)) {
            $footerText = '';
        }

        $this->pdf->setFooterCallback(function ($pdf) use ($pages, $fontFamily, $footerText, $lineStyle) {
            /* Posición a 14 mm del borde inferior de la página */
            $pdf->SetY(-14);
            /* Configuración de la fuenta a utilizar */
            $pdf->SetFont($fontFamily, 'I', 8);
            if ($pages) {
                /** @var string Número de página del reporte */
                $pageNumber = __('Pág. ').$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages();
                /* Texto a mostrar para el número de página */
                $pdf->MultiCell(20, 4, $pageNumber, 0, 'R', false, 0, 185, -8, true, 1, false, true, 1, 'T', true);
            }
            /* Texto a mostrar en el pie de página del reporte */
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
            /* Línea de separación entre el cuerpo del reporte y el pie de página */
            $pdf->Line(7, 265, 205, 265, $lineStyle);
        });
    }

    public function show($file = null, $outputMethod = 'F')
    {
        $filename = storage_path().'/reports/'.$file ?? 'report'.Carbon::now().'.pdf';
        $this->pdf->Output($filename, $outputMethod);

        return response()->download($filename);
    }
}
