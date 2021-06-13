@extends('layout.main')

@section('main_content')

  <div class="row clearfix page-header">
    <div class="col-md-4">
      <a class="btn btn-primary" href="{{route('products.index')}}"> <i class="fas fa-arrow-left"></i> Back </a>
    </div>

  </div>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">{{$product->title}}</h6>
     </div>
     <div class="card-body">

       <div class="row clearfix justify-content-md-center">
         <div class="col-md-8">

           <table class="table table-borderless">
             <tr>
               <th  scope="col">Category :</th>
               <td> {{ $product->category->title }}</td>
             </tr>

             <tr>
               <th  scope="col">Title :</th>
               <td> {{ $product->title }}</td>
             </tr>

             <tr>
               <th scope="col">Description :</th>
               <td> {{ $product->description }}</td>
             </tr>

             <tr>
               <th scope="col">Cost Price :</th>
               <td> {{ $product->cost_price }}</td>
             </tr>
             <tr>

               <th scope="col">Price :</th>
               <td> {{ $product->price }}</td>
             </tr>
           </table>

         </div>

       </div>


     </div>
 </div>

@stop
