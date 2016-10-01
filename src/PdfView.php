<?php

namespace Luba;

use Luba\Framework\View;
use Knp\Snappy\Pdf;

class PdfView extends View
{
    public function output($filename="file.pdf", $download=false)
    {
        $html = $this->render();

        if(!defined('WKHTMLTOPDF')) {
            define('WKHTMLTOPDF', '/usr/bin/wkhtmltopdf');
        }

        $snappy = new Pdf(WKHTMLTOPDF);

        //In the browser
        header('Content-Type: application/pdf');
        if($download)
            header('Content-Disposition: attachment; filename="'.$filename.'"');
        else
            header('Content-Disposition: inline; filename="'.$filename.'"');
        echo $snappy->getOutputFromHtml($html);
    }

    public function saveToFile($filename)
    {
        $html = $this->render();
        $snappy->generateFromHtml($html, $filename);
    }
}