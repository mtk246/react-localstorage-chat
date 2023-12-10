<?php

declare(strict_types=1);

declare(strict_types=1);

namespace App\Services\Claim;

use App\Models\TypeForm;
use App\Repositories\Contracts\ReportInterface;
use Carbon\Carbon;
use Elibyy\TCPDF\TCPDF as PDF;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

final class ClaimPreviewService implements ReportInterface
{
    private string $orientation;

    /** Establece el formato de la página (A4, Letter, ...) */
    private string $format;

    /** Establece el tipo de fuente a usar en el reporte */
    private string $fontFamily;

    /** Estilos a implementar en códigos QR a generar */
    private array $qrCodeStyle;

    /** Estilos para líneas de separación entre encabezado cuerpo y pie de página */
    private array $lineStyle;

    /** URL de verificación del reporte */
    private string $urlVerify;

    /** Fecha en la que se genera el reporte */
    private string $reportDate;

    /** Nombre del archivo a generar con el reporte */
    private string $filename;

    /** Establece si el reporte pdf a generar va ser visualización o impresión */
    private bool $print;

    /** @var \App\Http\Resources\Claim\PreviewResource|null Contenido del reporte pdf */
    private mixed $data;

    /**
     * Constructor for the PHP class.
     *
     * @param PDF $pdf the PDF object to be used
     */
    public function __construct(private PDF $pdf, private string $backgroundFile = '', private string $typeForm = '')
    {
    }

    /**
     * Sets the configuration values for the TCPDF object.
     *
     * @param mixed[] $params An array of configuration parameters
     *                        - reportDate: string The date to be used in the report (default: today's date)
     *                        - orientation: string The orientation of the page (default: value from config file)
     *                        - format: string The format of the page (default: value from config file)
     *                        - fontFamily: string The font family to be used (default: value from config file)
     *                        - qrCodeStyle: string The style of QR code (default: value from config file)
     *                        - lineStyle: string The line style to be used (default: value from config file)
     *                        - urlVerify: string|null The URL to verify the PDF (default: null)
     *                        - filename: string The name of the PDF file (default: unique id + .pdf)
     *                        - print: bool Whether or not to show the print dialog (default: false)
     *                        - data: array The data to be used in the PDF (default: empty array)
     *                        - typeForm: int The ID of the typeform (default: null)
     */
    public function setConfig(array $params = []): void
    {
        $this->reportDate = $params['reportDate'] ?? Carbon::now()->format('d/m/Y H:i:s A');
        $this->orientation = $params['orientation'] ?? config('tcpdf.page_orientation');
        $this->format = $params['format'] ?? config('tcpdf.page_format');
        $this->fontFamily = $params['fontFamily'] ?? config('tcpdf.font_family');
        $this->qrCodeStyle = $params['qrCodeStyle'] ?? config('tcpdf.qr_code_style');
        $this->lineStyle = $params['lineStyle'] ?? config('tcpdf.line_style');
        $this->urlVerify = $params['urlVerify'] ?? null;
        $this->filename = $params['filename'] ?? uniqid().'.pdf';
        $this->print = $params['print'] ?? false;
        $this->data = $params['data'] ?? [];

        $this->typeForm = TypeForm::find($params['typeFormat'] ?? null)?->form ?? '';

        if ('CMS-1500 / 837P' === $this->typeForm) {
            $this->backgroundFile = 'CMS-1500_837P_1_v3.png';
        } elseif ('UB-04 / 837I' === $this->typeForm) {
            $this->backgroundFile = 'UB-04_837I_1.jpg';
        }

        $this->pdf->SetAuthor(__('BegentoOS - :app', ['app' => config('app.name')]));
        $this->pdf->SetSubject($params['subject'] ?? '');
        $this->pdf->SetMargins(7, 20, 7);
        $this->pdf->SetHeaderMargin(0);
        $this->pdf->SetFooterMargin(0);
        $this->pdf->SetFontSubsetting(false);
        $this->pdf->SetFontSize('10px');
    }

    /**
     * Sets the header callback for the PDF.
     *
     * @param bool $hasQR If the QR code is present
     * @param bool $hasBarCode If the Barcode is present
     */
    public function setHeader(string $title = '', string $subTitle = '', bool $hasQR = true, bool $hasBarCode = false): void
    {
        $pdf = $this->pdf;
        $print = $this->print;
        $urlVerify = $this->urlVerify;
        $qrCodeStyle = $this->qrCodeStyle;
        $hasQR = ('CMS-1500 / 837P' === $this->typeForm) ?: false;

        $pdf->setHeaderCallback(function ($pdf) use ($print, $hasQR, $urlVerify, $qrCodeStyle, $title, $subTitle): void {
            $pdf->SetAutoPageBreak(false, 0);
            if (!$print) {
                $imgFile = ('' !== $this->backgroundFile) ? storage_path('pictures').'/'.$this->backgroundFile : null;

                if (isset($imgFile)) {
                    $pdf->Image($imgFile, 0, 0, 216, 280, '', '', '', false, 300, '', false, false, 0);
                }

                if ($hasQR && null !== $urlVerify) {
                    $pdf->write2DBarcode(
                        $urlVerify,
                        'QRCODE,H',
                        8.5,
                        6,
                        13,
                        13,
                        $qrCodeStyle,
                        'T',
                    );
                }
            }
            if (!empty($title)) {
                /* Configuración de la fuente para el título del reporte */
                $pdf->SetFont($this->fontFamily, 'B', 12);
                /* Título del reporte */
                $pdf->MultiCell(
                    $pdf->getPageWidth(),
                    7,
                    Str::upper($title).' - '.$this->reportDate,
                    0,
                    'L',
                    false,
                    1,
                    10,
                    8,
                    true,
                    0,
                    false,
                    true,
                    0,
                    'T',
                    true
                );
            }
            if (!empty($subTitle)) {
                /* Configuración de la fuente para la breve descripción del reporte */
                $pdf->SetFont($this->fontFamily, 'I', 8);
                /* Descripción breve del reporte */
                $pdf->MultiCell(
                    $pdf->getPageWidth(),
                    4,
                    upperCaseWords($subTitle),
                    0,
                    'L',
                    false,
                    1,
                    10,
                    15,
                    true,
                    1,
                    false,
                    true,
                    0,
                    'T',
                    true
                );
            }
        });
    }

    /**
     * Sets the body of the PDF document to be generated.
     *
     * @param mixed $body the body content of the PDF document
     * @param bool $isHTML indicates whether the body content is HTML or not
     * @param mixed[] $htmlParams an array of parameters to be passed to the HTML view
     * @param string $storeAction the action to be taken for the generated PDF
     * @param bool $end indicates whether the PDF generation should end
     *
     * @return mixed the generated PDF, depending on the storeAction parameter
     *
     * @throws Some_Exception_Class if an error occurs while writing to the PDF
     */
    public function setBody(
        mixed $body,
        bool $isHTML = true,
        array $htmlParams = [],
        string $storeAction = 'E',
        bool $end = true,
        bool $isTransmissionResponse = false
    ): object|string|null {
        $this->pdf->AddPage($this->orientation, $this->format);
        if ($isTransmissionResponse) {
            $this->pdf->SetAutoPageBreak(true, 20);
        }

        $previewFields = ('CMS-1500 / 837P' === $this->typeForm)
            ? config('claim.preview_837p')
            : (('UB-04 / 837I' === $this->typeForm)
                ? config('claim.preview_837i')
                : []);

        foreach ($previewFields as $fieldName => $value) {
            if (isset($value['properties'])) {
                $this->setData($value['properties'], $fieldName);
            } elseif (isset($value['options']) && 1 === count($value)) {
                if (isset($this->data[$fieldName]) && isset($value['options'][$this->data[$fieldName]]['properties'])) {
                    $this->setData($value['options'][$this->data[$fieldName]]['properties'], $fieldName, null, 'X');
                }
            } else {
                foreach ($value as $key => $val) {
                    if ('options' === $key) {
                        if (isset($this->data[$fieldName]) && isset($val[$this->data[$fieldName]['value']]['properties'])) {
                            $this->setData($val[$this->data[$fieldName]['value']]['properties'], $fieldName, null, 'X');
                        }
                    } elseif (isset($val['properties'])) {
                        $this->setData($val['properties'], $fieldName, $key);
                    } elseif (isset($this->data[$fieldName]) && isset($val['options'][$this->data[$fieldName][$key]]['properties'])) {
                        $this->setData($val['options'][$this->data[$fieldName][$key]]['properties'], $fieldName, null, 'X');
                    }
                }
            }
        }

        $htmlContent = $body;

        if ($isHTML) {
            $view = View::make($body, $htmlParams);
            $htmlContent = $view->render();
        }

        $this->pdf->writeHTML($htmlContent, true, false, true, false, '');
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
        if (true === $end) {
            return $this->pdf->Output($this->filename, $storeAction);
        } else {
            return $this->pdf;
        }
    }

    /**
     * Sets the footer for the PDF document.
     *
     * @param bool $pages whether to include page numbers or not
     */
    public function setFooter($user = '', $pages = true, $currentDate = true): void
    {
        $this->pdf->setFooterCallback(function ($pdf) use ($pages, $currentDate, $user): void {
            $pdf->SetY(-14);
            $pdf->SetFont($this->fontFamily, 'I', 8);

            if ($currentDate) {
                $pdf->MultiCell(
                    $pdf->getPageWidth() / 3,
                    8,
                    $this->reportDate,
                    0,
                    'L',
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
                    true,
                );
            }

            $pdf->MultiCell(
                $pdf->getPageWidth() - 14,
                8,
                empty($user) ? '' : 'By '.$user,
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
                true,
            );

            if ($pages) {
                $pageNumber = __('Pág. ').$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages();
                $pdf->MultiCell(
                    $pdf->getPageWidth() - 7,
                    8,
                    $pageNumber,
                    0,
                    'R',
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
                    true,
                );
            }

            $pdf->Line(7, 265, $pdf->getPageWidth() - 7, 265, $this->lineStyle);
        });
    }

    /**
     * Sets data to the cell properties.
     *
     * @param mixed[] $cellProperties an associative array containing cell properties
     * @param mixed $fieldName the name of the field
     * @param int|null $index the index of the field if it is an array
     *
     * @throws Some_Exception_Class description of exception
     */
    public function setData(array $cellProperties, mixed $fieldName, mixed $index = null, string $value = ''): void
    {
        if ('' === $value) {
            $value = (!is_null($index))
                ? ($this->data[$fieldName][$index] ?? '')
                : ($this->data[$fieldName] ?? '');
        }

        $this->pdf->SetFont($cellProperties['fontFamily'], '', $cellProperties['fontSize']);
        $this->pdf->MultiCell(
            $cellProperties['w'],
            $cellProperties['h'],
            $value,
            0,
            $cellProperties['align'],
            false,
            1,
            $cellProperties['x'],
            $cellProperties['y'],
            true,
            0,
            false,
            true,
            0,
            'T',
            true,
        );
    }
}
