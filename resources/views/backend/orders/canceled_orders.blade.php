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
                        <h3 class="box-title">Canceled Order List<span class="badge badge-pill badge-danger"> {{ count($orders) }}</span></h3>
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
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Action</th>

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
                                            {{ $item->payment_method }}



                                        </td>

                                        <td>
                                            <span class="badge badge-pill badge-success">{{ $item->status }}</span>

                                        </td>


                                        <td width=30%><a href="{{ route('pending.order.details',$item->id) }}" class="btn btn-info sm" title="View Order"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('coupon.delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>



                                            <a href="{{ route('coupon.inactive',$item->id) }}" class="btn btn-danger sm" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>


                                            <a href="{{ route('coupon.active',$item->id) }}" class="btn btn-success sm" title="Acive Now "><i class="fa fa-arrow-up"></i></a>


                                        </td>

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