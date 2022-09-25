@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full" style="background-color: #DFF6FF;">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Province List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Province Name</th>
                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <!--coupon_name	coupon_discount	coupon_validity	status -->
                                    @foreach($province as $item)
                                    <tr>

                                        <td>{{ $item->province_name }}</td>
                                        <td width=40%><a href="{{ route('province.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('province.delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>


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

            <!-- -----------------Add Coupon Col 	coupon_name coupon_discount	coupon_validity	status-------->

            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Province</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('province.store') }}" method="post">
                                @csrf


                                <div class="form-group">
                                    <h5>Province Name : <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="province_name" class="form-control">

                                        @error('province_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>




                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Province" />
                                </div>
                            </form>




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