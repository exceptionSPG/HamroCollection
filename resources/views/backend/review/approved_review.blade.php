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
                        <h3 class="box-title">Approved Review List<span class="badge badge-pill badge-danger"> {{ count($reviews) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Summary </th>
                                        <th>Comment</th>
                                        <th>Product Name</th>
                                        <th>User</th>

                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <!--coupon_name	coupon_discount	coupon_validity	status -->
                                    @foreach($reviews as $item)
                                    <tr>

                                        <td>{{ $item->summary }}</td>
                                        <td>{{ $item->comment }}</td>
                                        <td>{{ $item->product->product_name_en }}</td>

                                        <td>
                                            {{ $item->user->name }}
                                        </td>

                                        <td>
                                            @if($item->status == 0)

                                            <span class="badge badge-pill badge-primary">Pending</span>

                                            @elseif($item->status == 1)
                                            <span class="badge badge-pill badge-success">Approved</span>
                                            @elseif($item->status == 2)
                                            <span class="badge badge-pill badge-success">Rejected</span>

                                            @endif

                                        </td>


                                        <td>

                                            <!-- <a href="{{ route('approve.review',$item->id) }}" class="btn btn-success sm" title="Approve Request"><i class="fa fa-check"></i></a> -->


                                            <a href="{{ route('delete.review',$item->id) }}" id="delete" class="btn btn-danger sm" title="Delete Review"><i class="fa fa-trash"></i></a>







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