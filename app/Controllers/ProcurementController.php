<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProcurementController extends BaseController
{
    public function index()
    {
        //
    }

    public function kanban_requisition()
    {
        
        $data['kanban_title'] = 'Purchase Requisition Kanban';
        $data['columnA'] = 'Purchase Requisition Process';
        $data['columnB'] = 'Purchase Requisition Converted';
        $data['columnC'] = 'Purchase Requisition Receipt';
        return view('kanban', $data);
    }
}
