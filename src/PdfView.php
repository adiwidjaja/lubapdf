<?php

namespace Luba;

use Luba\Framework\View;
use Knp\Snappy\Pdf;

class PdfView extends View
{
    /**
     * Variables passed to snappy
     */
    protected $options = [];

    public function __construct($template, array $variables = [], $customPath = NULL, $compileVars = false)
    {
        parent::__construct($template, $variables, $customPath, $compileVars);
    }

    public function setOption($name, $value) {
        $this->options[$name] = $value;
    }

    public function setOptions($options) {
        $this->options = $options;
    }

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
        echo $snappy->getOutputFromHtml($html, $this->options);
    }

    public function saveToFile($filename)
    {
        $html = $this->render();
        $snappy->generateFromHtml($html, $filename, $this->options);
    }
}