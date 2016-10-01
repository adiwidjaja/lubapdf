<?php

namespace Luba;

use Luba\Framework\View;

class PdfView
{
    public function render()
    {
        $html = parent::render();

        //Todo: Snappy!
        $result = $html;
        return $result;
    }
}