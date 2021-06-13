@extends('layout.main')

@section('main_content')

  <div class="row clearfix page-header">
    <div class="col-md-6">
      <h2> Product Stock </h2>
    </div>


  </div>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">All Product</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>ID</th>
                         <th>Category</th>
                         <th>Title</th>
                         <th>purchases</th>
                         <th>Sales</th>
                         <th>Stock</th>


                     </tr>
                 </thead>
                 <tfoot>
                     <tr>
                       <th>ID</th>
                       <th>Category</th>
                       <th>Title</th>
                       <th>purchases</th>
                       <th>Sales</th>
                       <th>Stock</th>

                     </tr>
                 </tfoot>
                 <tbody>
                 @foreach ($products as $products)
                   <tr>
                       <td>{{$products->id}}</td>
                       <td>{{$products->category->title}}</td>
                       <td>{{$products->title}}</td>
                       <td>{{$purchase = $products->purchaseItems()->sum('quantity')}}</td>
                       <td>{{ $sale = $products->saleItems()->sum('quantity')}}</td>
                       <td>{{ $purchase - $sale }}</td>
                     </tr>
                   @endforeach

                 </tbody>
             </table>
         </div>
     </div>
 </div>

@stop
