<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SaleItems;

class SaleReportController extends Controller
{
    public function index()
    {
      return $this->data['sales'] = SaleItems::all();
      return view('reports.sales', $this->data);
    }
}
