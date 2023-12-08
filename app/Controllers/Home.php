<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $db;
    private $url_api;

    function __construct()
    {
       // $this->db = \Config\Database::connect();
        $this->url_api = getenv('api.url');
    }

    public function index()
    {
        $getdata =  file_get_contents($this->url_api."sales-dashboard/");
        $dashboard = json_decode($getdata);
        $data['billable'] = $dashboard->billable;
        $data['sales']  = $dashboard->sales_data;
        $data['kanban_title'] = 'Sales & Marketing Dashboard';
        $data['columnA'] = 'A';
        $data['columnB'] = 'B';
        $data['columnC'] = 'C';
        return view('dashboard', $data);
        //return $dashboard;
    }

    public function inventory()
    {
        
    }
}
