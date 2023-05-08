<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PlaceOfService;
use App\Models\Procedure;
use App\Models\TypeCatalog;
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

    private $data;

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
        $this->data = $params['data'] ?? [];
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

        /* Título del reporte */

        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

        /* Info Billing Company */
        $this->pdf->SetFont($this->fontFamily, '', 10);
        $this->pdf->MultiCell(70, 5.8, $this->data['insurance_company']['name'], 0, 'L', false, 1, 107, 16, true, 0, false, true, 0, 'T', true);
        $this->pdf->MultiCell(70, 5.8, $this->data['insurance_company']['address']['address'] ?? '', 0, 'L', false, 1, 107, 20, true, 0, false, true, 0, 'T', true);
        $this->pdf->MultiCell(70, 5.8, '', 0, 'L', false, 1, 107, 24, true, 0, false, true, 0, 'T', true);
        $this->pdf->MultiCell(70, 5.8,
            substr($this->data['insurance_company']['address']['city'] ?? '', 0, 24).' '.
            substr($this->data['insurance_company']['address']['state'] ?? '', 0, 3).
            substr($this->data['insurance_company']['address']['zip'] ?? '', 0, 12),
            0, 'L', false, 1, 107, 28, true, 0, false, true, 0, 'T', true);

        /* 1. Tipo de Cobertura del segur de salud */
        $this->pdf->SetFont($this->fontFamily, '', 10);
        $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 8.5, 40, true, 0, false, true, 0, 'T', true);

        /* 1a. Insured ID number */
        if (isset($this->subscriber)) {
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $this->pdf->MultiCell(70, 5.8, $this->data['1a'] ?? '', 0, 'L', false, 1, 135, 40, true, 0, false, true, 0, 'T', true);

            /* 4. Insured name */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $this->pdf->MultiCell(70, 5.8, $this->data['4'], 0, 'L', false, 1, 135, 48, true, 0, false, true, 0, 'T', true);
        }

        /* Information de paciente */
        if (isset($this->patient)) {
            /* Configuración de la fuente  y tamaño en 20 para el título del reporte */
            $this->pdf->SetFont($this->fontFamily, '', 10);

            /* 2. Patient full name */
            $this->pdf->MultiCell(70, 5.8, $this->data['2'], 0, 'L', false, 1, 10, 48, true, 0, false, true, 0, 'T', true);

            /* 3. Patient Birth date and sex */

            $this->pdf->SetFont($this->fontFamily, '', 9);
            $birthdate = explode('-', $this->data['3']['date']);
            $this->pdf->MultiCell(70, 10, $birthdate[2], 0, 'L', false, 1, 92, 48.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $birthdate[1], 0, 'L', false, 1, 84, 48.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $birthdate[0], 0, 'L', false, 1, 100, 48.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->SetFont($this->fontFamily, '', 10);
            if (('M' == $this->data['3']['date']) || ('m' == $this->data['3']['date'])) {
                $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 111, 48.5, true, 0, false, true, 0, 'T', true);
            } else {
                $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 123.5, 48.5, true, 0, false, true, 0, 'T', true);
            }

            /* 5. Patient addres and contact */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $this->pdf->MultiCell(70, 5.8, substr($this->data['5']['address']['address'] ?? '', 0, 28), 0, 'L', false, 1, 10, 56.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, substr($this->data['5']['address']['city'] ?? '', 0, 24), 0, 'L', false, 1, 10, 64.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, substr($this->data['5']['address']['state'] ?? '', 0, 3), 0, 'L', false, 1, 72.5, 64.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $this->pdf->MultiCell(70, 5.8, substr($this->data['5']['address']['zip'] ?? '', 0, 12), 0, 'L', false, 1, 10, 74, true, 0, false, true, 0, 'T', true);

            $this->pdf->MultiCell(70, 5.8, substr($this->data['5']['contact']['phone'] ?? '', 0, 3), 0, 'L', false, 1, 44.5, 74, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, substr($this->data['5']['contact']['phone'] ?? '', 3, 10), 0, 'L', false, 1, 53, 74, true, 0, false, true, 0, 'T', true);

            /* 6. Patient relationship to insured */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            if ('self' === $this->data['6']) {
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 88.5, 57, true, 0, false, true, 0, 'T', true);
            } elseif ('spouse' === $this->data['6']) {
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 101, 57, true, 0, false, true, 0, 'T', true);
            } elseif ('child' === $this->data['6']) {
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 111, 57, true, 0, false, true, 0, 'T', true);
            } elseif ('other' === $this->data['6']) {
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 123.5, 57, true, 0, false, true, 0, 'T', true);
            }

            /* 7. Insured address and contact */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $this->pdf->MultiCell(70, 5.8, substr($this->data['7']['address']['address'] ?? '', 0, 28), 0, 'L', false, 1, 135, 56.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, substr($this->data['7']['address']['city'] ?? '', 0, 24), 0, 'L', false, 1, 135, 64.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, substr($this->data['7']['address']['state'] ?? '', 0, 3), 0, 'L', false, 1, 191.5, 64.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $this->pdf->MultiCell(70, 5.8, substr($this->data['7']['address']['zip'] ?? '', 0, 12), 0, 'L', false, 1, 135, 74, true, 0, false, true, 0, 'T', true);

            $this->pdf->MultiCell(70, 5.8, substr($this->data['7']['contact']['phone'] ?? '', 0, 3), 0, 'L', false, 1, 170, 74, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, substr($this->data['7']['contact']['phone'] ?? '', 3, 135), 0, 'L', false, 1, 178.5, 74, true, 0, false, true, 0, 'T', true);

            /* 8. Reservado */
            $this->pdf->SetFont($this->fontFamily, '', 10);

            /* 9. Reservado para MEDIGAP */
            $this->pdf->MultiCell(70, 5.8, $this->data['9'] ?? '', 0, 'L', false, 1, 10, 81.5, true, 0, false, true, 0, 'T', true);
            /* 9a. Other insurance policy group */
            $this->pdf->MultiCell(70, 5.8, substr($this->data['9a'] ?? '', 0, 29), 0, 'L', false, 1, 10, 90, true, 0, false, true, 0, 'T', true);

            /* 9d. Other insurance plan name */
            $this->pdf->MultiCell(70, 5.8, $this->data['9d'] ?? '', 0, 'L', false, 1, 10, 115.5, true, 0, false, true, 0, 'T', true);

            /* 10. Patient condition related */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            if ($this->patientOrInsuredInfo) {
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1,
                    $this->data['10a'] ? 93.5 : 108.5, 90.8, true, 0, false, true, 0, 'T', true);
                if ($this->data['10b']['value']) {
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 93.5, 99, true, 0, false, true, 0, 'T', true);
                } else {
                    $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 108.5, 99, true, 0, false, true, 0, 'T', true);
                    $this->pdf->MultiCell(70, 5.8, substr($this->data['10b']['state'] ?? '', 0, 2), 0, 'L', false, 1, 120, 99, true, 0, false, true, 0, 'T', true);
                }
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1,
                    $this->data['10c'] ? 93.5 : 108.5, 107.2, true, 0, false, true, 0, 'T', true);
            } else {
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 108.5, 90.8, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 108.5, 99, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(70, 5.8, 'X', 0, 'L', false, 1, 108.5, 107.2, true, 0, false, true, 0, 'T', true);
            }
            /* 10d. Medicaid number patient */

            /* 11. Policy number or group number insured */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $this->pdf->MultiCell(70, 5.8, $this->data['11'] ?? '', 0, 'L', false, 1, 133, 82, true, 0, false, true, 0, 'T', true);

            /* 11a. Insured date of birth */
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $subscriberBirthdate = explode('-', $this->data['11a']['date']);
            $this->pdf->MultiCell(70, 10, $birthdate[2], 0, 'L', false, 1, 146, 91, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $birthdate[1], 0, 'L', false, 1, 139.5, 91, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $birthdate[0], 0, 'L', false, 1, 154, 91, true, 0, false, true, 0, 'T', true);

            $this->pdf->SetFont($this->fontFamily, '', 10);
            if (('M' == $this->data['11a']['sex']) || ('m' == $this->data['11a']['sex'])) {
                $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 176, 90.5, true, 0, false, true, 0, 'T', true);
            } else {
                $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 193.8, 90.5, true, 0, false, true, 0, 'T', true);
            }
            /* 11c. Insurance plan name */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $this->pdf->MultiCell(70, 5.8, $this->data['11c'] ?? '', 0, 'L', false, 1, 135, 107.5, true, 0, false, true, 0, 'T', true);
            /* 11d. Other benefit insurance plan */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            if ($this->data['11d']) {
                $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 148.5, 115.5, true, 0, false, true, 0, 'T', true);
            }

            /* 12. Patient authorization */
            $this->pdf->MultiCell(70, 10, $this->data['12']['signed'], 0, 'L', false, 1, 27, 131.5, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $this->data['12']['date'], 0, 'L', false, 1, 100, 131.5, true, 0, false, true, 0, 'T', true);

            /* 13. Insured authorization */
            $this->pdf->MultiCell(70, 10, $this->data['13'], 0, 'L', false, 1, 148.5, 131.5, true, 0, false, true, 0, 'T', true);

            /* 14. Date of current inlines */
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $dateOfCurrent = explode('-', $this->data['14']['date'] ?? '');
            $this->pdf->MultiCell(70, 10, $dateOfCurrent[2] ?? '', 0, 'L', false, 1, 19.5, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $dateOfCurrent[1] ?? '', 0, 'L', false, 1, 11, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $dateOfCurrent[0] ?? '', 0, 'L', false, 1, 27, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $this->data['14']['qualifier'] ?? '', 0, 'L', false, 1, 46, 141, true, 0, false, true, 0, 'T', true);

            /* 15. Other date inlines */
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $otherDate = explode('-', $this->data['15']['date'] ?? '');
            $this->pdf->MultiCell(70, 10, $this->data['15']['qualifier'] ?? '', 0, 'L', false, 1, 83, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $otherDate[2] ?? '', 0, 'L', false, 1, 106, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $otherDate[1] ?? '', 0, 'L', false, 1, 100, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $otherDate[0] ?? '', 0, 'L', false, 1, 114, 141, true, 0, false, true, 0, 'T', true);

            /* 16. Other date inlines */
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $fromDate = explode('-', $this->data['16']['from'] ?? '');
            $toDate = explode('-', $this->data['16']['to'] ?? '');

            $this->pdf->MultiCell(70, 10, $fromDate[2] ?? '', 0, 'L', false, 1, 148, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $fromDate[1] ?? '', 0, 'L', false, 1, 142, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $fromDate[0] ?? '', 0, 'L', false, 1, 156, 141, true, 0, false, true, 0, 'T', true);

            $this->pdf->MultiCell(70, 10, $toDate[2] ?? '', 0, 'L', false, 1, 183, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $toDate[1] ?? '', 0, 'L', false, 1, 177, 141, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $toDate[0] ?? '', 0, 'L', false, 1, 191, 141, true, 0, false, true, 0, 'T', true);

            /* 17. Provider */
            $this->pdf->SetFont($this->fontFamily, '', 10);

            $this->pdf->MultiCell(70, 10, $this->data['17']['code'] ?? '', 0, 'L', false, 1, 9, 149, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $this->data['17']['name'] ?? '', 0, 'L', false, 1, 15.5, 149, true, 0, false, true, 0, 'T', true);

            /* 17a. Info provider */
            $this->pdf->SetFont($this->fontFamily, '', 9);
            /* Número comercial del proveedor */
            $this->pdf->MultiCell(70, 10, $this->data['17a']['code'], 0, 'L', false, 1, 81, 145, true, 0, false, true, 0, 'T', true);
            /* Número de ubicación */
            // $this->pdf->MultiCell(70, 10, 'LU', 0, 'L', false, 1, 81, 145, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $this->data['17a']['value'], 0, 'L', false, 1, 86.5, 145, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $this->data['17b']['value'] ?? '', 0, 'L', false, 1, 86.5, 149, true, 0, false, true, 0, 'T', true);

            /* 18. Hospitalization dates */
            $this->pdf->SetFont($this->fontFamily, '', 9);
            $fromDate = explode('-', $this->data['18']['from'] ?? '');
            $toDate = explode('-', $this->data['18']['to'] ?? '');

            $this->pdf->MultiCell(70, 10, $fromDate[2] ?? '', 0, 'L', false, 1, 148, 149, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $fromDate[1] ?? '', 0, 'L', false, 1, 142, 149, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $fromDate[0] ?? '', 0, 'L', false, 1, 156, 149, true, 0, false, true, 0, 'T', true);

            $this->pdf->MultiCell(70, 10, $toDate[2] ?? '', 0, 'L', false, 1, 183, 149, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $toDate[1] ?? '', 0, 'L', false, 1, 177, 149, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $toDate[0] ?? '', 0, 'L', false, 1, 191, 149, true, 0, false, true, 0, 'T', true);

            /* 19. Additional claim info */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            $this->pdf->MultiCell(70, 10, $this->data['19'] ?? '', 0, 'L', false, 1, 9, 157, true, 0, false, true, 0, 'T', true);

            /* 20. Outaide LAB */
            $this->pdf->SetFont($this->fontFamily, '', 10);
            if ($this->data['20']['outside_lab']) {
                $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 136, 157.2, true, 0, false, true, 0, 'T', true);
                $this->pdf->MultiCell(25, 10, $this->data['20']['outside_lab']['charges'] ?? '', 0, 'R', false, 1, 160, 157.2, true, 0, false, true, 0, 'T', true);
            } else {
                $this->pdf->MultiCell(70, 10, 'X', 0, 'L', false, 1, 148.8, 157.2, true, 0, false, true, 0, 'T', true);
            }

            /* 21. Diagnosis LCD */
            $this->pdf->MultiCell(8, 10, $this->data['21']['indicator'], 0, 'L', false, 1, 111.5, 162, true, 0, false, true, 0, 'T', true);

            $this->pdf->MultiCell(20, 10, $this->data['21']['diagnoses']['A'] ?? '', 0, 'L', false, 1, 12.5, 166, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->data['21']['diagnoses']['B'] ?? '', 0, 'L', false, 1, 45, 166, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->data['21']['diagnoses']['C'] ?? '', 0, 'L', false, 1, 77.9, 166, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->data['21']['diagnoses']['D'] ?? '', 0, 'L', false, 1, 110.4, 166.3, true, 0, false, true, 0, 'T', true);

            $this->pdf->MultiCell(20, 10, $this->data['21']['diagnoses']['E'] ?? '', 0, 'L', false, 1, 12.5, 170, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->data['21']['diagnoses']['F'] ?? '', 0, 'L', false, 1, 45, 170.1, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->data['21']['diagnoses']['G'] ?? '', 0, 'L', false, 1, 77.9, 170, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->data['21']['diagnoses']['H'] ?? '', 0, 'L', false, 1, 110.4, 170.5, true, 0, false, true, 0, 'T', true);

            $this->pdf->MultiCell(20, 10, $this->data['21']['diagnoses']['I'] ?? '', 0, 'L', false, 1, 12.5, 174.2, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->data['21']['diagnoses']['J'] ?? '', 0, 'L', false, 1, 45, 174.2, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->data['21']['diagnoses']['K'] ?? '', 0, 'L', false, 1, 77.9, 174.2, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(20, 10, $this->data['21']['diagnoses']['L'] ?? '', 0, 'L', false, 1, 110.4, 174.2, true, 0, false, true, 0, 'T', true);

            /* 22. Resubmision Code */
            /* Sustitución del reclamo anteriror */
            $this->pdf->MultiCell(20, 10, $this->data['22']['resubmision_code'], 0, 'L', false, 1, 132, 166.3, true, 0, false, true, 0, 'T', true);

            /* Original REF */
            $this->pdf->MultiCell(20, 10, $this->data['22']['original_code'], 0, 'L', false, 1, 160, 166.3, true, 0, false, true, 0, 'T', true);

            /* 23. Authorization number */
            $this->pdf->MultiCell(70, 10, $this->data['23'] ?? '', 0, 'L', false, 1, 132, 174.2, true, 0, false, true, 0, 'T', true);

            $this->pdf->SetFont($this->fontFamily, '', 10);
            $lineSpaceY = 8.6;
            $totalCharge = 0;
            $totalCopay = 0;
            foreach ($this->data['24'] as $index => $claimService) {
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
                $this->pdf->MultiCell(70, 10, $this->data['24j'] ?? '', 0, 'L', false, 1, 176, 191 + ($lineSpaceY * $index) - (0.3 * $index), true, 0, false, true, 0, 'T', true);
            }

            /* 25. FederalTax */
            $this->pdf->MultiCell(35, 10, $this->data['25']['value'] ?? '', 0, 'L', false, 1, 10, 240.8, true, 0, false, true, 0, 'T', true);
            if ('EIN' === $this->data['25']['code']) {
                $this->pdf->MultiCell(35, 10, 'X', 0, 'L', false, 1, 48.5, 240.8, true, 0, false, true, 0, 'T', true);
            }

            /* 26. NumAccount */
            $this->pdf->MultiCell(35, 10, $this->data['26'] ?? '', 0, 'L', false, 1, 65, 240.8, true, 0, false, true, 0, 'T', true);

            /* 27. Accept Assignment */
            if ($this->data['27']) {
                $this->pdf->MultiCell(35, 10, 'X', 0, 'L', false, 1, 101.2, 240.8, true, 0, false, true, 0, 'T', true);
            } else {
                $this->pdf->MultiCell(35, 10, 'X', 0, 'L', false, 1, 113.5, 240.8, true, 0, false, true, 0, 'T', true);
            }

            /** 28. Total charge */
            $arrayPrice = explode('.', $this->data['28'] ?? '');
            $this->pdf->MultiCell(18, 10, $arrayPrice[0] ?? '', 0, 'R', false, 1, 134, 240.8, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(6, 10, ('' != $arrayPrice[0]) ? (str_pad($arrayPrice[1] ?? '', 2, '0', STR_PAD_RIGHT) ?? '00') : '', 0, 'L', false, 1, 152, 240.8, true, 0, false, true, 0, 'T', true);

            /** 29. Amount paid */
            $arrayPrice = explode('.', $this->data['29'] ?? '');
            $this->pdf->MultiCell(15, 10, $arrayPrice[0] ?? '', 0, 'R', false, 1, 162, 240.8, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(6, 10, ('' != $arrayPrice[0]) ? (str_pad($arrayPrice[1] ?? '', 2, '0', STR_PAD_RIGHT) ?? '00') : '', 0, 'L', false, 1, 177, 240.8, true, 0, false, true, 0, 'T', true);

            /* 31. Signature physician */

            $this->pdf->MultiCell(70, 10, $this->data['31']['signed'], 0, 'L', false, 1, 15, 258, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 10, $this->data['31']['date'], 0, 'L', false, 1, 45, 258, true, 0, false, true, 0, 'T', true);

            /* 32. Facility */

            $this->pdf->SetFont($this->fontFamily, '', 9);
            $this->pdf->MultiCell(70, 5.8, $this->data['32']['name'] ?? '', 0, 'L', false, 1, 65, 248, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, $this->data['32']['address']['address'] ?? '', 0, 'L', false, 1, 65, 252, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8,
                substr($this->data['32']['address']['city'] ?? '', 0, 24).' '.
                substr($this->data['32']['address']['state'] ?? '', 0, 3).
                substr($this->data['32']['address']['zip'] ?? '', 0, 12),
                0, 'L', false, 1, 65, 256, true, 0, false, true, 0, 'T', true);

            /* 32a. Facility NPI */
            $this->pdf->MultiCell(70, 5.8, $this->data['32a'] ?? '', 0, 'L', false, 1, 65, 262, true, 0, false, true, 0, 'T', true);

            /* 32b. Facility Other */
            $this->pdf->MultiCell(70, 5.8, $this->data['32b'] ?? '', 0, 'L', false, 1, 93.5, 262, true, 0, false, true, 0, 'T', true);

            /* 33. Billing providerInfo */
            $this->pdf->SetFont($this->fontFamily, '', 9);

            $this->pdf->MultiCell(70, 5.8, $this->data['33']['name'] ?? '', 0, 'L', false, 1, 134, 248, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8, $this->data['33']['address']['address'] ?? '', 0, 'L', false, 1, 134, 252, true, 0, false, true, 0, 'T', true);
            $this->pdf->MultiCell(70, 5.8,
                substr($this->data['33']['address']['city'] ?? '', 0, 24).' '.
                substr($this->data['33']['address']['state'] ?? '', 0, 3).
                substr($this->data['33']['address']['zip'] ?? '', 0, 12),
                0, 'L', false, 1, 134, 256, true, 0, false, true, 0, 'T', true);

            /* 33a. billingProvider NPI */
            $this->pdf->MultiCell(70, 5.8, $this->data['33a'] ?? '', 0, 'L', false, 1, 134, 262, true, 0, false, true, 0, 'T', true);

            /* 33b. billingProvider Other */
            $this->pdf->MultiCell(70, 5.8, $this->data['33b'] ?? '', 0, 'L', false, 1, 93.5, 262, true, 0, false, true, 0, 'T', true);
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
