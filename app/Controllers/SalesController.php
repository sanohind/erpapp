<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SalesController extends BaseController
{
    private $url_api;

    function __construct()
    {
        $this->url_api = getenv('api.url');
    }

    public function index()
    {
        $getData = file_get_contents($this->url_api."aging-summary/");
        $summary = json_decode($getData);
        $data['aging_summary'] = $summary->aging_sum;
        $data['aging_detail'] = $summary->aging_data;
        $data['title'] = "Sales Aging Monitor";
        return view('sales/aging-ar', $data);
    }

    public function sales_report()
    {
        return view('sales/invoice');
    }
}
