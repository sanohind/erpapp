<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SalesController extends BaseController
{
    public function index()
    {
        //
    }

    public function sales_report()
    {
        return view('sales/invoice');
    }
}
