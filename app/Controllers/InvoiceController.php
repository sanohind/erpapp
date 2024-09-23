<?php

namespace App\Controllers;

use Dompdf\Dompdf;

use App\Controllers\BaseController;
use App\Controllers\EncryptController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class InvoiceController extends BaseController
{
    private $url_api;
    private $encrypt;

    function __construct()
    {
        $this->url_api = getenv('api.url');
        $this->encrypt = new EncryptController();
    }

    public function index($trans = false, $invoice = false)
    {
        $bpid = 'CLTMMIN';
        $getInv = file_get_contents($this->url_api . "invoice/?type=$trans&invoice=$invoice&bpid=$bpid");
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
        $inv = $header[0]->trans . $header[0]->inv_no;

        if ($header[0]->no_faktur == "") {
            $no_faktur = "-";
        } else {
            $no_faktur = $header[0]->no_faktur;
        }

        $qrtext = "VISION|" . $inv  . "|" . number_format($header[0]->inv_net_amount, 2, ".", "") . "|" . number_format($header[0]->inv_amount, 2, ".", "") . "|" . number_format($header[0]->inv_tax_value, 2, ".", "") . "|" . $no_faktur;

        //encrypting process
        //$encrypt = new EncryptController;
        $enc = $this->encrypt->EncryptData($qrtext);
        //$encrypter = \Config\Services::encrypter();
        //$enkrip = base64_encode($encrypter->encrypt($qrtext));
        //$data['qrtext'] = $enkrip;
        $data['qrtext'] = $enc;
        $data['qroritext'] = $qrtext;
        //$data['dekrip'] = $encrypter->decrypt(base64_decode($enkrip));

        //qrcode processing
        $qr = new QRController;
        //$qrData = $qr->createQr($enkrip, $header[0]->trans . $header[0]->inv_no);
        //$qrData = 
        $data['qruri'] = $qr->createQr($enc, $inv);

        //get basse64Encode image
        $ttd_agus = site_url('/assets/img/ttd_agus.png');
        $ttd_BuDian = site_url('/assets/img/ttd_dian2.png');
        $data['ttdAgus'] = $this->imageBase64Encode($ttd_agus);
        $data['ttdBuDian'] = $this->imageBase64Encode($ttd_BuDian);

        //return view('invoicing/invpdf_local', $data);

        $filename = $header[0]->trans . $header[0]->inv_no;

        $pdf = new Dompdf();
        $pdf->loadHtml(view('invoicing/invpdf_local', $data));
        $pdf->setPaper('A4', 'Potrait');
        $pdf->render();

        // add pagination
        $canvas = $pdf->getCanvas(); // get the canvas
        // add the page number and total number of pages
        $canvas->page_script(' $text = "Page : $PAGE_NUM";
                        $pdf->text(535, 35, $text, \'Helvetica\', 10, array(0,0,0));');

        $pdf->stream($filename, array("Attachment" => 0));
    }

    public function billable($status =  false)
    {
        if ($status ==  false) {
            $title = "Detail data billable line";
        } else {
            $title = "Detail data billable line with " . $status . " status";
        }
        $sts = urlencode($status);
        $getBillable = file_get_contents($this->url_api . "billable-data/?status=$sts");
        $billData = json_decode($getBillable);
        $data['billable'] = $billData;
        $data['title'] = $title;
        return view('invoicing/billable', $data);
    }

    public function export()
    {
        //var_dump($this->request->getPost());
        $reportType = $this->request->getPost(('reportType'));
        //echo $reportType;
        
        $spreadSheet = new Spreadsheet();
        $column = 2;

        if( $reportType == 'summary'){
            $getData = file_get_contents($this->url_api."aging-summary/");
            $summary = json_decode($getData);
            $data = $summary->aging_data;

            $spreadSheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Customer Name')
            ->setCellValue('B1', 'Current')
            ->setCellValue('C1', '30 Days')
            ->setCellValue('D1', '60 Days')
            ->setCellValue('E1', '90 Days')
            ->setCellValue('F1', '120 Days');

            foreach($data as $row){
                $spreadSheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $row->customer)
                ->setCellValue('B' . $column, $row->D0)
                ->setCellValue('C' . $column, $row->D30)
                ->setCellValue('D' . $column, $row->D60)
                ->setCellValue('E' . $column, $row->D90)
                ->setCellValue('F' . $column, $row->D120);

                $column++;
            }

        }else{
            $getData = file_get_contents($this->url_api."aging-detail/?customer=");
        }

        $writer = new Xlsx($spreadSheet);
        $filename = date('YmdHis')."_Aging ".ucfirst($reportType)." Report";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        setlocale(LC_ALL, 'en_US');
        ob_end_clean();
        return $writer->save('php://output');
    }
}