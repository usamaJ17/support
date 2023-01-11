<?php

namespace App\Http\Controllers;
use App\DataTables\ServiceDatatable;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
   public function index()
   {
    if(session()->get('role')=='user'){
        $datatable=new ServiceDatatable;
        return $datatable->render('service.index');
    }
   }
}
