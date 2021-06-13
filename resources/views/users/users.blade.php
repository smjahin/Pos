@extends('layout.main')

@section('main_content')

  <div class="row clearfix page-header">
    <div class="col-md-6">
      <h2> Users </h2>
    </div>
    <div class="col-md-6 text-right">
      <a class="btn btn-info" href="{{url('users/create')}}"> <i class="fa fa-plus"></i> New user</a>
    </div>

  </div>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">All User</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>ID</th>
                         <th>Admin</th>
                         <th>Group</th>
                         <th>Name</th>
                         <th>Email</th>
                         <th>Phone</th>
                         <th>Address</th>
                         <th class="text-right">Action</th>

                     </tr>
                 </thead>
                 <tfoot>
                     <tr>
                       <th>ID</th>
                       <th>Admin</th>
                       <th>Group</th>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Phone</th>
                       <th>Address</th>
                       <th class="text-right">Action</th>
                     </tr>
                 </tfoot>
                 <tbody>
                 @foreach ($users as $users)
                   <tr>
                       <td>{{$users->id}}</td>
                       <td>{{$users->admin_id}}</td>
                       <td>{{$users->group->title}}</td>
                       <td>{{$users->name}}</td>
                       <td>{{$users->email}}</td>
                       <td>{{$users->phone}}</td>
                       <td>{{$users->address}}</td>
                       <td class="text-right">

                         <form action="{{route('users.destroy',['user' => $users->id])}}" method="POST">

                             <a class="btn btn-primary btn-sm" href="{{route('users.show',['user' => $users->id]) }}">
                               <i class="fa fa-eye"></i> Show
                             </a>
                              <a class="btn btn-primary btn-sm" href="{{route('users.edit',['user' => $users->id]) }}">
                                <i class="fa fa-edit"></i> Edit
                              </a>

                              @csrf
                              @method('DELETE')
                           <button onclick=" return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm">
                             <i class="fa fa-trash"></i> Delete </button>
                             
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
