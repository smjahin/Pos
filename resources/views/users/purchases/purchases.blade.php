@extends('users.user_layout')

@section('user_content')


            <!-- DataTales Example -->
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"> Purchases of <strong> {{$user->name}} </strong> </h6>
          </div>
            <div class="card-body">

              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                            <th>Challan No</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Quantity</th>
                            <th>Total</th>

                              <th class="text-right">Action</th>

                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                            <th>Challan No</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Quantity</th>
                            <th>Total</th>

                            <th class="text-right">Action</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        <?php
                          $grandTotal = 0;
                          $totalItem = 0;
                        ?>
                      @foreach ($user->purchases as $purchase)
                        <tr>

                            <td>{{$purchase->challan_no}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$purchase->date}}</td>

                            <td>
                              <?php
                                $itemQty = $purchase->items()->sum('quantity');
                                $totalItem += $itemQty;
                                echo $itemQty;
                              ?>
                            </td>
                            <td>

                              <?php
                                $total = $purchase->items()->sum('total');
                                $grandTotal += $total;
                                echo $total;
                              ?>

                              </td>
                            <td class="text-right">

                              <form action="{{route('user.purchases.destroy',['id' => $user->id, 'invoice_id' => $purchase->id ])}}" method="POST">

                                  <a class="btn btn-primary btn-sm" href="{{route('user.purchases.invoice_details',['id' => $user->id, 'invoice_id'=> $purchase->id]) }}">
                                    <i class="fa fa-eye"></i> Show
                                  </a>
                                  @if ($itemQty == 0)
                                      @csrf
                                      @method('DELETE')
                                    <button onclick=" return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm">
                                      <i class="fa fa-trash"></i> Delete </button>
                                @endif
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
