<?php

declare(strict_types=1);

declare(strict_types=1);

namespace App\Services\Claim;

use App\Models\TypeForm;
use App\Repositories\Contracts\ReportInterface;
use Carbon\Carbon;
use Elibyy\TCPDF\TCPDF as PDF;
use Illuminate\Support\Facades\View;

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

    /** @var string|null Tipo de formato del reporte */
    private mixed $typeForm;

    /** @var \App\Http\Resources\Claim\PreviewResource|null Contenido del reporte pdf */
    private mixed $data;

    /**
     * Constructor for the PHP class.
     *
     * @param PDF $pdf the PDF object to be used
     */
    public function __construct(private PDF $pdf)
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
        $this->reportDate = $params['reportDate'] ?? Carbon::now()->format('d-m-Y');
        $this->orientation = $params['orientation'] ?? config('tcpdf.page_orientation');
        $this->format = $params['format'] ?? config('tcpdf.page_format');
        $this->fontFamily = $params['fontFamily'] ?? config('tcpdf.font_family');
        $this->qrCodeStyle = $params['qrCodeStyle'] ?? config('tcpdf.qr_code_style');
        $this->lineStyle = $params['lineStyle'] ?? config('tcpdf.line_style');
        $this->urlVerify = $params['urlVerify'] ?? null;
        $this->filename = $params['filename'] ?? uniqid().'.pdf';
        $this->print = $params['print'] ?? false;
        $this->data = $params['data'] ?? [];

        $typeForm = TypeForm::find($params['typeFormat']);

        if (isset($typeForm)) {
            if ('CMS-1500 / 837P' === $typeForm->form) {
                $this->typeForm = 'CMS-1500_837P_1';
            } elseif ('UB-04 / 837I' === $typeForm->form) {
                $this->typeForm = 'UB-04_837I_1';
            }
        }

        $this->pdf->SetAuthor(__('BegentoOS - :app', ['app' => config('app.name')]));
        $this->pdf->SetSubject($params['subject'] ?? '');
        $this->pdf->SetMargins(0, 0, 0);
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
    public function setHeader(bool $hasQR = true, bool $hasBarCode = false): void
    {
        $pdf = $this->pdf;
        $print = $this->print;
        $urlVerify = $this->urlVerify;
        $qrCodeStyle = $this->qrCodeStyle;
        $hasQR = ('UB-04_837I_1' === $this->typeForm) ? false : $hasQR;

        $pdf->setHeaderCallback(function ($pdf) use ($print, $hasQR, $urlVerify, $qrCodeStyle): void {
            $pdf->SetAutoPageBreak(false, 0);

            if (!$print) {
                if (isset($this->typeForm)) {
                    if ('CMS-1500_837P_1' === $this->typeForm) {
                        $imgFile = storage_path('pictures').'/CMS-1500_837P_1_v3.png';
                    } elseif ('UB-04_837I_1' === $this->typeForm) {
                        $imgFile = storage_path('pictures').'/UB-04_837I_1.jpg';
                    }
                }

                $pdf->Image($imgFile, 0, 0, 216, 280, '', '', '', false, 300, '', false, false, 0);

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
    ): object|string|null {
        $this->pdf->AddPage($this->orientation, $this->format);

        $previewFields = ('CMS-1500_837P_1' === $this->typeForm)
            ? config('claim.preview_837p')
            : (('UB-04_837I_1' === $this->typeForm)
                ? config('claim.preview_837i')
                : []);

        foreach ($previewFields as $fieldName => $value) {
            if (isset($value['properties'])) {
                $this->setData($value['properties'], $fieldName);
            } elseif (isset($value['options']) && 1 === count($value)) {
                $this->setData($value['options'][$this->data[$fieldName]]['properties'], $fieldName, null, 'X');
            } else {
                foreach ($value as $key => $val) {
                    if ('options' === $key) {
                        $this->setData($val[$this->data[$fieldName]['value']]['properties'], $fieldName, null, 'X');
                    } elseif (isset($val['options'])) {
                        if (isset($val['options'][$this->data[$fieldName][$key]])) {
                            $this->setData($val['options'][$this->data[$fieldName][$key]]['properties'], $fieldName, null, 'X');
                        }
                    } else {
                        $this->setData($val['properties'], $fieldName, $key);
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
        }
    }

    /**
     * Sets the footer for the PDF document.
     *
     * @param bool $pages whether to include page numbers or not
     * @param string $footerText the text to be included in the footer
     */
    public function setFooter($pages = true): void
    {
        $this->pdf->setFooterCallback(function ($pdf) use ($pages): void {
            $pdf->SetY(-14);
            $pdf->SetFont($this->fontFamily, 'I', 8);

            if ($pages) {
                $pageNumber = __('Pág. ').$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages();
                $pdf->MultiCell(20, 4, $pageNumber, 0, 'R', false, 0, 185, -8, true, 1, false, true, 1, 'T', true);
            }

            $pdf->MultiCell(
                $pdf->getPageWidth() - PDF_MARGIN_RIGHT,
                8,
                '',
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

            $pdf->Line(7, 265, 205, 265, $this->lineStyle);
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
                ? $this->data[$fieldName][$index]
                : $this->data[$fieldName];
        }

        $this->pdf->SetFont($cellProperties['fontFamily'], '', $cellProperties['fontSize']);
        $this->pdf->MultiCell(
            $cellProperties['w'],
            $cellProperties['h'],
            $value,
            0,
            'L',
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
