@extends('layout.main')



@section('main_content')

  @yield('user_card')
  <div class="row clearfix page-header">
    <div class="col-md-4">
      <a class="btn btn-primary" href="{{route('users.index')}}"> <i class="fas fa-arrow-left"></i> Back </a>
    </div>

    <div class="col-md-8 text-right">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newSale">
        <i class="fa fa-plus"></i> New Sale
      </button>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newPurchase">
        <i class="fa fa-plus"></i> New Purchase
      </button>


      <!-- Button trigger modal -->
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newPayment">
			  <i class="fa fa-plus"></i> New Payment
			</button>


      <!-- Button trigger modal -->
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newReceipt">
			  <i class="fa fa-plus"></i> New Receipt
			</button>

    </div>
  </div>



    <div class="row clearfix mt-5">
      <div class="col-md-2">
        <div class="nav flex-column nav-pills" >

        <a class="nav-link @if ($tab_menu == 'user_info') active @endif" href="{{route('users.show',$user->id)}}">User Info</a>

        <a class="nav-link @if ($tab_menu == 'sales') active @endif" href="{{route('user.sales',$user->id)}}">Sales</a>

        <a class="nav-link @if ($tab_menu == 'purchases') active @endif" href="{{route('user.purchases',$user->id)}}">Purchase</a>

        <a class="nav-link @if ($tab_menu == 'payments') active @endif" href="{{route('user.payments',$user->id)}}">Payments</a>

        <a class="nav-link @if ($tab_menu == 'receipts') active @endif" href="{{route('user.receipts',$user->id)}}">Receipts</a>

      </div>

      </div>

    <div class="col-md-10">
            <!-- DataTales Example -->
            @yield('user_content')
      </div>

    </div>

    {{-- modal for add new Sale --}}



    <!-- Modal -->
    <div class="modal fade" id="newSale" tabindex="-1" role="dialog" aria-labelledby="newSaleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        {!! Form::open(['route' => ['user.sales.store', $user->id], 'method' => 'post']) !!}


        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newSaleModalLabel">New Sale</h5>
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
              <label for="challan_no" class="col-sm-3 col-form-label">Challan Number</label>
              <div class="col-sm-9">
                {!! Form::text('challan_no',NULL, ['class' => 'form-control', 'id'=>'challan_no', 'placeholder'=> 'Enter Challan Number'])!!}
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



    {{-- modal for add new Sale --}}



    <!-- Modal -->
    <div class="modal fade" id="newPurchase" tabindex="-1" role="dialog" aria-labelledby="newPurchaseModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        {!! Form::open(['route' => ['user.purchases.store', $user->id], 'method' => 'post']) !!}


        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newPurchaseModalLabel">New Purchase</h5>
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
              <label for="challan_no" class="col-sm-3 col-form-label">Challan Number</label>
              <div class="col-sm-9">
                {!! Form::text('challan_no',NULL, ['class' => 'form-control', 'id'=>'challan_no', 'placeholder'=> 'Enter Challan Number'])!!}
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







@stop
