# Package adiwidjaja/lubapdf

Luba addon for pdf views.

## Usage

    $view = new \Luba\PdfView("exportpdf", [
        "content" => "Test"
    ]);
    $view->setOptions(['orientation'=>'Landscape']);
    $view->output("filename_when_saved.pdf");

or

    $view->output("path/somewhere/something.pdf");