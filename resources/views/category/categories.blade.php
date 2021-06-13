@extends('layout.main')

@section('main_content')

  <div class="row clearfix page-header">
    <div class="col-md-6">
      <h2> Categories </h2>
    </div>
    <div class="col-md-6 text-right">
      <a class="btn btn-info" href="{{route('categories.create')}}"> <i class="fa fa-plus"></i> New Categories</a>
    </div>

  </div>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>ID</th>
                         <th>Title</th>

                         <th class="text-right">Action</th>

                     </tr>
                 </thead>
                 <tfoot>
                     <tr>
                       <th>ID</th>
                       <th>Title</th>

                       <th class="text-right">Action</th>
                     </tr>
                 </tfoot>
                 <tbody>
                 @foreach ($categories as $categories)
                   <tr>
                       <td>{{$categories->id}}</td>
                       <td>{{$categories->title}}</td>
                       <td class="text-right">

                         <form action="{{route('categories.destroy',['category' => $categories->id])}}" method="POST">
                           @csrf
                           @method('DELETE')

                              <a class="btn btn-primary btn-sm" href="{{route('categories.edit',['category' => $categories->id]) }}">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                           <button onclick=" return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Delete </button>
                         </form>
                       </td>
                     </tr>
                   @endforeach

                 </tbody>
             </table>
         </div>
     </div>
 </div>

@stop
