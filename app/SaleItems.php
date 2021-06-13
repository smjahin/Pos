<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItems extends Model
{
 protected $fillable = [
     'product_id','sale_invoice_id','quantity','price','total',
 ];


  public function sales()
  {
    return $this->belongsTo(SaleInvoice::class);
  }

  public function product()
  {
    return $this->belongsTo(Product::class);
  }
}
