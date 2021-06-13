<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class ProductsStockController extends Controller
{
    public function index()
    {
      $this->data['products'] = Product::all();

      return view('products.stocks',$this->data);
    }
}
