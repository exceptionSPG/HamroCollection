@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">


            <!-- -----------------Add Coupon Col 	coupon_name coupon_discount	coupon_validity	status-------->

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Coupon</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('coupon.update',$coupon->id) }}" method="post">
                                @csrf


                                <div class="form-group">
                                    <h5>Coupon Name : <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="coupon_name" value="{{ $coupon->coupon_name }}" class="form-control">

                                        @error('coupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Coupon Discount(%) : <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="coupon_discount" value="{{ $coupon->coupon_discount }}" class="form-control">
                                        @error('coupon_discount')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Category Validity: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="coupon_validity" value="{{ $coupon->coupon_validity }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control">
                                        @error('coupon_validity')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Coupon" />
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