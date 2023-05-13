<?php

require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class PDF extends Controller
{
    public function generateBill($id)
    {

        $order_items = new Order_Items();
        $orders = new Orders();

        $data['order_details'] = $orders->getOrderByID($id);
        $data['order_items'] = $order_items->getOrderItems($id);
//
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('tempDir', '/tmp'); //folder name and location can be changed
        $dompdf = new Dompdf($options);
//
//// Load HTML content from a file
        ob_start();
//// Include and execute PHP file
        include '../public/assets/templates/bill.php';
//
//// Get output and clean buffer
        $htmlContent = ob_get_clean();
//
        $dompdf->loadHtml($htmlContent);
//
//// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('a4', 'portrait');
//
//// Render the HTML as PDF
        $dompdf->render();
//
//// Output the generated PDF to Browser
//        $dompdf->stream();
        $filename = 'Invoice_' . $id . "_.pdf";

// Send the PDF to the browser with the appropriate headers
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo $dompdf->output();
    }


}