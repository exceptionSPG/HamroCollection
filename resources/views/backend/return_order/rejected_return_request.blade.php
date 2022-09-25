@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full" style="background-color: #DFF6FF;">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rejected Return Order List<span class="badge badge-pill badge-danger"> {{ count($orders) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Invoice</th>
                                        <th>Amount</th>
                                        <th>Return Reason</th>
                                        <th>Status</th>
                                        <!-- <th>Action</th> -->

                                    </tr>

                                </thead>
                                <tbody>
                                    <!--coupon_name	coupon_discount	coupon_validity	status -->
                                    @foreach($orders as $item)
                                    <tr>

                                        <td>{{ $item->order_date }}</td>
                                        <td>{{ $item->invoice_number }}</td>
                                        <td>Rs.{{ $item->amount }}</td>

                                        <td>
                                            {{ $item->return_reason }}



                                        </td>

                                        <td>
                                            @if($item->return_order == 1)

                                            <span class="badge badge-pill badge-primary">Pending</span>

                                            @elseif($item->return_order == 2)
                                            <span class="badge badge-pill badge-success">Approved</span>
                                            @elseif($item->return_order == 3)
                                            <span class="badge badge-pill badge-success">Rejected</span>

                                            @endif

                                        </td>


                                        <!-- <td width=30%>

                                            <a href="{{ route('approve.return_request',$item->id) }}" class="btn btn-success sm" title="Approve Request"><i class="fa fa-check"></i></a>


                                            <a href="{{ route('reject.return_request',$item->id) }}" id="reject" class="btn btn-danger sm" title="Reject Request"><i class="fa fa-close"></i></a>







                                        </td> -->

                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- /.box -->
            </div>
            <!-- /.col 12 -->


        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

<!-- /.content-wrapper -->

@endsection