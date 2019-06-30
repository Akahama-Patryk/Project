<?php
require('../../../App/phpToPDF.php');
include_once('../../../App/Autoloader.php');
Autoloader::sessionStarter();

foreach ($_SESSION['factuurdata'] as $item) {

    if (is_array($item) || is_object($item)) {
        $filename = 'invoice#_' . $item['invoice_id'] . '.pdf';
    }
}
//It is possible to include a file that outputs html and store it in a variable
//using output buffering.
ob_start();
include('invoice_view.php');
$my_html = ob_get_clean();

////Set Your Options -- we are saving the PDF as 'my_filename.pdf' to a 'my_pdfs' folder
$pdf_options = array(
    "source_type" => 'html',
    "source" => $my_html,
    "action" => 'download',
    "save_directory" => 'PDF',
    "file_name" => $filename,
    "omit_images" => 'no',
    "page_size" => 'A3');

//Code to generate PDF file from options above
phptopdf($pdf_options);