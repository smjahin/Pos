@extends('users.user_layout')

@section('user_content')

  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Sales Invoice Details</h6>
      </div>
        <div class="card-body">

          <div class="row clearfix justify-content-md-center">
            <div class="col-md-9">
              <div class="no_padding no_margin">Customer:{{ $user->name }}</div>
              <div class="no_padding no_margin">Email:{{ $user->email }}</div>
              <div class="no_padding no_margin">Phone:{{ $user->phone }}</div>
            </div>

            <div class="col-md-3 ">
              <div class="no_padding">Date:{{ $invoice->date }}</div>
              <div class="no_padding">Challan No:{{ $invoice->challan_no }}</div>
            </div>

          </div>


          <div class="invoice_items">
            <table class="table">
              <thead>
                <th>SL</th>
                <th>Product</th>
                <th>Price</th>
                <th>QTY</th>
                <th>Total</th>
                <th></th>
              </thead>

              <tbody>
                @foreach ($invoice->items as $key => $item)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$item->product->title}}</td>
                  <td>{{$item->price}}</td>
                  <td>{{$item->quantity}}</td>
                  <td>{{$item->total}}</td>
                  <td class="text-right">
                    <form action="{{route('user.sales.invoices.delete_item',['id' => $user->id, 'invoice_id' =>$invoice->id, 'item_id' =>$item->id])}}"
                      method="POST">
                    @csrf
                    @method('DELETE')

                    <button onclick=" return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Delete </button>
                  </form>
                </td>
                </tr>
              @endforeach
              </tbody>

            <tr>
              <th></th>
              <tfoot>
                <th>
                   <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#newProduct">
                    <i class="fa fa-plus"></i> Add Product
                  </button>
                </th>

                <th colspan="2" class="text-right">Total:</th>
                <th>{{$totalPayable = $invoice->items()->sum('total')}}</th>
                <th></th>
            </tr>

              <tr>


                <th>
                   <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newReceiptForInvoice">
                    <i class="fa fa-plus"></i> Add Paymrnt
                  </button>
                </th>
                <th colspan="2" class="text-right">Paid:</th>
                <th>{{$totalPaid = $invoice->receipts()->sum('amount')}}</th>
                <th></th>
                </tr>


                <tr>



                  <th colspan="3" class="text-right">Due:</th>
                  <th>{{$due =$totalPayable - $totalPaid }}</th>
                  <th></th>
                  </tr>

              </tfoot>


            </table>
          </div>



        </div>
    </div>


    {{-- modal for add new Product --}}



    <!-- Modal -->
    <div class="modal fade" id="newProduct" tabindex="-1" role="dialog" aria-labelledby="newProductModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        {!! Form::open(['route' => ['user.sales.invoices.add_item', ['id'=>$user->id,'invoice_id'=>$invoice->id] ], 'method' => 'post']) !!}


        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newProductModalLabel">New Sale</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="form-group row">
              <label for="product" class="col-sm-3 col-form-label text-right">Product<span class="text-danger">*</span></label>
              <div class="col-sm-9">
                {!! Form::select('product_id', $products, NULL, ['class' => 'form-control', 'id'=>'product', 'placeholder'=> 'Select Product', 'required'])!!}
              </div>
            </div>

            <div class="form-group row">
              <label for="price" class="col-sm-3 col-form-label text-right">Unite Price<span class="text-danger">*</span></label>
              <div class="col-sm-9">
                {!! Form::text('price',NULL, ['class' => 'form-control', 'id'=>'price', 'placeholder'=> 'Enter price', 'required'])!!}
              </div>
            </div>

            <div class="form-group row">
              <label for="quantity" class="col-sm-3 col-form-label text-right">Quantity<span class="text-danger">*</span></label>
              <div class="col-sm-9">
                {!! Form::text('quantity',NULL, ['class' => 'form-control', 'id'=>'quantity', 'placeholder'=> 'Enter quantity', 'required'])!!}
              </div>
            </div>

            <div class="form-group row">
              <label for="total" class="col-sm-3 col-form-label text-right">Total<span class="text-danger">*</span></label>
              <div class="col-sm-9">
                {!! Form::text('total',NULL, ['class' => 'form-control', 'id'=>'total', 'placeholder'=> 'Enter Total', 'required'])!!}
              </div>
            </div>





          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>

          {!! Form::close() !!}



      </div>
    </div>



    {{-- modal for add new receipts for invoice --}}



    <!-- Modal -->
    <div class="modal fade" id="newReceiptForInvoice" tabindex="-1" role="dialog" aria-labelledby="newReceiptForInvoiceModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        {!! Form::open(['route' => ['user.receipts.store', ['id'=>$user->id, 'invoice_id'=>$invoice->id] ], 'method' => 'post']) !!}


        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newReceiptForInvoiceModalLabel">New Receipts for Invoice</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="form-group row">
              <label for="name" class="col-sm-3 col-form-label"> Date <span class="text-danger">*</span></label>
              <div class="col-sm-9">
                {!! Form::date('date',NULL, ['class' => 'form-control', 'id'=>'date', 'placeholder'=> 'Enter Date' ,'required'])!!}
              </div>
            </div>

            <div class="form-group row">
              <label for="amount" class="col-sm-3 col-form-label">Amount <span class="text-danger">*</span></label>
              <div class="col-sm-9">
                {!! Form::text('amount',NULL, ['class' => 'form-control', 'id'=>'amount', 'placeholder'=> 'Enter Amount' ,'required'])!!}
              </div>
            </div>

            <div class="form-group row">
              <label for="note" class="col-sm-3 col-form-label">Note </label>
              <div class="col-sm-9">
                {!! Form::text('note',NULL, ['class' => 'form-control', 'id'=>'note', 'placeholder'=> 'Enter Note'])!!}
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>

          {!! Form::close() !!}



      </div>
    </div>


@endsection
