@extends('users.user_layout')

@section('user_content')


            <!-- DataTales Example -->
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"> Receipts of <strong> {{$user->name}} </strong> </h6>
          </div>
            <div class="card-body">

              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                          <tr>

                              <th>Customer</th>
                              <th>Admin</th>
                              <th>Date</th>
                              <th>Total</th>
                              <th>Note</th>

                              <th class="text-right">Action</th>

                          </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th colspan="3" class="text-right">Total:</th>
                          <th>{{$user->receipts()->sum('amount')}}</th>
                          <th colspan="3"></th>
                        </tr>
                      </tfoot>
                      <tbody>
                      @foreach ($user->receipts as $receipt)
                        <tr>


                            <td>{{$user->name}}</td>
                            <td>{{optional($receipt->admin)->name}}</td>
                            <td>{{$receipt->date}}</td>
                            <td>{{$receipt->amount}} </td>
                            <td>{{$receipt->note}} </td>
                            <td class="text-right">

                              <form action="{{route('user.receipts.destroy',['id' => $user->id, 'receipt_id' => $receipt->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
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

        {{-- modal for add new receipts --}}



        <!-- Modal -->
        <div class="modal fade" id="newReceipt" tabindex="-1" role="dialog" aria-labelledby="newReceiptModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">

            {!! Form::open(['route' => ['user.receipts.store', $user->id], 'method' => 'post']) !!}


            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newReceiptModalLabel">New Receipts</h5>
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

@stop
