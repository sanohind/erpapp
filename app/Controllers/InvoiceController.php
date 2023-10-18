<?php

namespace App\Controllers;

use Dompdf\Dompdf;

use App\Controllers\BaseController;

class InvoiceController extends BaseController
{
    private $url_api;

    function __construct()
    {
        $this->url_api = getenv('api.url');
    }

    public function index($trans = false, $invoice = false)
    {
        $getInv = file_get_contents($this->url_api."invoice/?type=$trans&invoice=$invoice");
        $invData = json_decode($getInv);
        $data['invoice'] = $invData->data;
        return view('invoicing/inv-form', $data);
    }

    public function invoice_print_local($trans, $invoice)
    {
        $getData = file_get_contents($this->url_api . "invoice-print/?type=$trans&invoice=$invoice");
        $header = json_decode($getData)->dataHeader;

        //encode data
        $data['invHeader'] = $header;
        $data['invDetail'] = json_decode($getData)->dataDetail;
        

        $qrtext = "VISION|" . $header[0]->trans . $header[0]->inv_no . "|" . $header[0]->inv_amount1 . "|" . $header[0]->inv_amount . "|" . $header[0]->inv_tax_value . "|" . $header[0]->no_faktur;

        //encrypting process
        //$encrypt = new EncryptController;
        //$qrtext = $encrypt->EncryptedData($qrtext);
        $encrypter = \Config\Services::encrypter();
        $enkrip = base64_encode($encrypter->encrypt($qrtext));
        $data['qrtext'] = $enkrip;
        $data['dekrip'] = $encrypter->decrypt(base64_decode($enkrip));

        //qrcode processing
        $qr = new QRController;
        $qrData = $qr->createQr($enkrip, $header[0]->trans . $header[0]->inv_no);
        $data['qruri'] = $qrData;

        //get basse64Encode image
        $ttd_agus = base_url('/assets/img/ttd_agus.png');
        $ttd_BuDian = base_url('/assets/img/ttd_dian.png');
        $data['ttdAgus'] = $this->imageBase64Encode($ttd_agus);
        $data['ttdBuDian'] = $this->imageBase64Encode($ttd_BuDian);

        //return view('transaction/invpdf_local', $data);

        $filename = $header[0]->trans . $header[0]->inv_no;

        $pdf = new Dompdf();
        $pdf->loadHtml(view('invoicing/invpdf_local', $data));
        $pdf->setPaper('A4', 'Potrait');
        $pdf->render();
        $pdf->stream($filename, array("Attachment" => 0));
    }
}
