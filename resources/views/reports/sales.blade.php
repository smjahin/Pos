@extends('layout.main')

@section('main_content')

  <div class="row clearfix page-header">
    <div class="col-md-6">
      <h2> Products </h2>
    </div>
    <div class="col-md-6 text-right">
      <a class="btn btn-info" href="{{url('products/create')}}"> <i class="fa fa-plus"></i> New user</a>
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
                         <th>Products</th>
                         <th>unit price</th>
                         <th>Title</th>
                         <th>Description</th>
                         <th>Cost Price</th>
                         <th>Price</th>
                         <th class="text-right">Action</th>

                     </tr>
                 </thead>
                 <tfoot>
                     <tr>
                       <th>ID</th>
                       <th>Category</th>
                       <th>Title</th>
                       <th>Description</th>
                       <th>Cost Price</th>
                       <th>Price</th>
                       <th class="text-right">Action</th>
                     </tr>
                 </tfoot>
                 <tbody>
                 @foreach ($products as $products)
                   <tr>
                       <td>{{$products->id}}</td>
                       <td>{{$products->category->title}}</td>
                       <td>{{$products->title}}</td>
                       <td>{{$products->description}}</td>
                       <td>{{$products->cost_price}}</td>
                       <td>{{$products->price}}</td>

                     </tr>
                   @endforeach

                 </tbody>
             </table>
         </div>
     </div>
 </div>

@stop
