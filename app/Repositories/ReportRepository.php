<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Parameter;
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
    }

    public function setHeader(
        $title = '',
        $subTitle = '',
        $hasQR = true,
        $hasBarCode = false,
        $titleAlign = 'L',
        $subTitleAlign = 'C'
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
            'headerTextY' => $this->headerTextY
        ];
        $this->title = $title ?? '';
        $this->pdf->setHeaderCallback(function ($pdf) use ($params) {
            $pdf->Image(
                storage_path('pictures') . '/ci_1.png',
                5.4,
                8.4,
                218,
                283,
                'PNG',
                '',
                'T',
                false,
                300,
                '',
                false,
                false,
                0
            );

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
            /** Configuración de la fuente para el título del reporte */
            $helveticaNeue = \TCPDF_FONTS::addTTFfont(storage_path() . '/fonts/HelveticaNeue/HELVETICANEUECYR-LIGHT.ttf', 'TrueTypeUnicode', '', 32);
            /** Configuración de la fuente para el título del reporte */
            $pdf->SetFont($params->fontFamily, 'B', 11);
            /** Título del reporte */
            $this->pdf->MultiCell(
                '',
                '',
                'HEALTH INSURANCE CLAIM FORM',
                0,
                $params->titleAlign,
                false,
                1,
                8.5,
                $params->headerY,
                true,
                0,
                false,
                true,
                0,
                'T',
                true
            );

            /** Configuración de la fuente para el sub-título del reporte */
            $pdf->SetFont($params->fontFamily, '', 6);
            $this->pdf->MultiCell(
                '',
                '',
                'APPROVED BY NATIONAL UNIFORM CLAIM COMMITTEE (NUCC) 02/12',
                0,
                $params->titleAlign,
                false,
                1,
                8.5,
                $params->headerTextY,
                true,
                0,
                false,
                true,
                0,
                'T',
                true
            );
            /** Líneas de subrayado left pica del reporte */
            $this->pdf->Line(
                8.7,
                31.4,
                $this->pdf->getPageWidth() - 200,
                31.4,
                [
                    'width' => 0.2,
                    'cap' => 'butt',
                    'join' => 'miter',
                    'dash' => 0,
                    'color' => [0, 0, 0]
                ]
            );
            $this->pdf->Line(
                8.7,
                31.4,
                8.7,
                34.8,
                [
                    'width' => 0.2,
                    'cap' => 'butt',
                    'join' => 'miter',
                    'dash' => 0,
                    'color' => [0, 0, 0]
                ]
            );
            $this->pdf->Line(
                8.7,
                34.7,
                $this->pdf->getPageWidth() - 200,
                34.7,
                [
                    'width' => 0.2,
                    'cap' => 'butt',
                    'join' => 'miter',
                    'dash' => 0,
                    'color' => [0, 0, 0]
                ]
            );
            $this->pdf->Line(
                $this->pdf->getPageWidth() - 200,
                31.4,
                $this->pdf->getPageWidth() - 200,
                34.8,
                [
                    'width' => 0.2,
                    'cap' => 'butt',
                    'join' => 'miter',
                    'dash' => 0,
                    'color' => [0, 0, 0]
                ]
            );
            $this->pdf->Line(
                $this->pdf->getPageWidth() - 202.5,
                31.4,
                $this->pdf->getPageWidth() - 202.5,
                34.8,
                [
                    'width' => 0.2,
                    'cap' => 'butt',
                    'join' => 'miter',
                    'dash' => 0,
                    'color' => [0, 0, 0]
                ]
            );
            $this->pdf->Line(
                $this->pdf->getPageWidth() - 205,
                31.4,
                $this->pdf->getPageWidth() - 205,
                34.8,
                [
                    'width' => 0.2,
                    'cap' => 'butt',
                    'join' => 'miter',
                    'dash' => 0,
                    'color' => [0, 0, 0]
                ]
            );
            $this->pdf->MultiCell(
                '',
                '',
                'PICA',
                0,
                $params->titleAlign,
                false,
                1,
                16,
                $params->headerTextY + 4,
                true,
                0,
                false,
                true,
                0,
                'T',
                true
            );

            /** Líneas de subrayado right pica del reporte */
            $this->pdf->Line(
                $this->pdf->getPageWidth() - 21.8,
                31.4,
                $this->pdf->getPageWidth() - 14.5,
                31.4,
                [
                    'width' => 0.2,
                    'cap' => 'butt',
                    'join' => 'miter',
                    'dash' => 0,
                    'color' => [0, 0, 0]
                ]
            );
            $this->pdf->Line(
                $this->pdf->getPageWidth() - 19.3,
                31.4,
                $this->pdf->getPageWidth() - 19.3,
                34.8,
                [
                    'width' => 0.2,
                    'cap' => 'butt',
                    'join' => 'miter',
                    'dash' => 0,
                    'color' => [0, 0, 0]
                ]
            );
            $this->pdf->Line(
                $this->pdf->getPageWidth() - 21.8,
                34.7,
                $this->pdf->getPageWidth() - 14.5,
                34.7,
                [
                    'width' => 0.2,
                    'cap' => 'butt',
                    'join' => 'miter',
                    'dash' => 0,
                    'color' => [0, 0, 0]
                ]
            );
            $this->pdf->Line(
                $this->pdf->getPageWidth() - 16.8,
                31.4,
                $this->pdf->getPageWidth() - 16.8,
                34.8,
                [
                    'width' => 0.2,
                    'cap' => 'butt',
                    'join' => 'miter',
                    'dash' => 0,
                    'color' => [0, 0, 0]
                ]
            );
            $this->pdf->Line(
                $this->pdf->getPageWidth() - 14.5,
                31.4,
                $this->pdf->getPageWidth() - 14.5,
                34.8,
                [
                    'width' => 0.2,
                    'cap' => 'butt',
                    'join' => 'miter',
                    'dash' => 0,
                    'color' => [0, 0, 0]
                ]
            );
            $this->pdf->Line(
                $this->pdf->getPageWidth() - 21.8,
                31.4,
                $this->pdf->getPageWidth() - 21.8,
                34.8,
                [
                    'width' => 0.2,
                    'cap' => 'butt',
                    'join' => 'miter',
                    'dash' => 0,
                    'color' => [0, 0, 0]
                ]
            );
            $this->pdf->MultiCell(
                '',
                '',
                'PICA',
                0,
                $params->titleAlign,
                false,
                1,
                $this->pdf->getPageWidth() - 27.5,
                $params->headerTextY + 4,
                true,
                0,
                false,
                true,
                0,
                'T',
                true
            );

            /** Línea de subrayado del titulo del reporte */
            $this->pdf->Line(
                8.5,
                34.8,
                $this->pdf->getPageWidth() - 14.5,
                34.8,
                $this->lineStyle
            );

            /** Sub 1 */
            $this->pdf->MultiCell(
                '',
                '',
                '1.',
                0,
                $params->titleAlign,
                false,
                1,
                9.5,
                $params->headerTextY + 9,
                true,
                0,
                false,
                true,
                0,
                'T',
                true
            );
            $this->pdf->MultiCell(
                '',
                '',
                'MEDICARE',
                0,
                $params->titleAlign,
                false,
                1,
                13.5,
                $params->headerTextY + 9,
                true,
                0,
                false,
                true,
                0,
                'T',
                true
            );

            $this->pdf->MultiCell(
                '',
                '',
                'MEDICAID',
                0,
                $params->titleAlign,
                false,
                1,
                31,
                $params->headerTextY + 9,
                true,
                0,
                false,
                true,
                0,
                'T',
                true
            );

            $this->pdf->MultiCell(
                '',
                '',
                'TRICARE',
                0,
                $params->titleAlign,
                false,
                1,
                49,
                $params->headerTextY + 9,
                true,
                0,
                false,
                true,
                0,
                'T',
                true
            );

            $this->pdf->MultiCell(
                '',
                '',
                'CHAMPVA',
                0,
                $params->titleAlign,
                false,
                1,
                71.5,
                $params->headerTextY + 9,
                true,
                0,
                false,
                true,
                0,
                'T',
                true
            );

            $this->pdf->MultiCell(
                '',
                '',
                'GROUP',
                0,
                $params->titleAlign,
                false,
                1,
                89.3,
                $params->headerTextY + 9,
                true,
                0,
                false,
                true,
                0,
                'T',
                true
            );

            $this->pdf->MultiCell(
                '',
                '',
                'FECA',
                0,
                $params->titleAlign,
                false,
                1,
                109.5,
                $params->headerTextY + 9,
                true,
                0,
                false,
                true,
                0,
                'T',
                true
            );

            /** Configuración de la fuente para la breve descripción del reporte */
            //$pdf->SetFont($params->fontFamily, 'B', 12);
            /** Descripción breve del reporte */
            /**$pdf->MultiCell(
                145,
                4,
                $params->subTitle,
                0,
                $params->subTitleAlign,
                false,
                1,
                40,
                $params->headerY + 8,
                true,
                1,
                false,
                true,
                0,
                'T',
                true
            );*/
            /** Fecha de emisión del reporte */
            /*$pdf->MultiCell(
                $pdf->getPageWidth() - 140,
                4,
                $params->reportDate,
                0,
                'R',
                false,
                1,
                113,
                $params->headerY + 8,
                true,
                1,
                false,
                true,
                0,
                'T',
                true
            );*/
            /** Línea de separación entre el encabezado del reporte y el cuerpo */
            //$pdf->Line(7, $params->headerY + 15, $pdf->getPageWidth() - $params->headerY, $params->headerY + 15, $params->lineStyle);
        });
    }

    public function setBody($body, $isHTML = true, $htmlParams = [], $storeAction = 'I')
    {
        /** @var string Contenido del reporte */
        $htmlContent = $body;
        /** Configuración sobre el autor del reporte */
        $this->pdf->SetAuthor(__('BegentoOS - :app', ['app' => config('app.name')]));
        /** Configuración del título de reporte */
        $this->pdf->SetTitle($this->title);
        /** Configuración sobre el asunto del reporte */
        $this->pdf->SetSubject($this->subject);
        /** Configuración de los márgenes del cuerpo del reporte */
        $this->pdf->SetMargins(0, 0, 0);
        $this->pdf->SetHeaderMargin(0);
        $this->pdf->SetFooterMargin(0);
        /** Establece si se configura o no las fuentes para sub configuraciones */
        $this->pdf->SetFontSubsetting(false);
        /** Configuración de la fuente por defecto del cuerpo del reporte */
        //$this->pdf->SetFontSize('10px');
        /**
         * Configuración que permite realizar un salto de página automático al alcanzar el límite inferior del cuerpo
         * del reporte
         */
        //$this->pdf->SetAutoPageBreak(true, 15); //PDF_MARGIN_BOTTOM
        /** Agrega las respectivas páginas del reporte */
        $this->pdf->AddPage($this->orientation, $this->format);

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
        $this->pdf->Output($this->filename, $storeAction);
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
