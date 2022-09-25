<!--- province_edit.blade.php -->



@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full" style="background-color: #DFF6FF;">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">


            <!-- -----------------Add Coupon Col 	coupon_name coupon_discount	coupon_validity	status-------->

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Province</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('province.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $province->id }}">

                                <div class="form-group">
                                    <h5>Province Name : <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="province_name" value="{{ $province->province_name }}" class="form-control">

                                        @error('province_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Province" />
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