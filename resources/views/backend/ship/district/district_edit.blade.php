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
                        <h3 class="box-title">Edit District</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('district.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $district->id }}">

                                <div class="form-group">
                                    <h5>Province Name : <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="province_id" class="form-control">
                                            <option selected="" disabled="">Select Province:</option>
                                            @foreach($provinces as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $district->province_id ? 'selected' : '' }}>{{ $item->province_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>District Name : <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="district_name" value="{{ $district->district_name }}" class="form-control">

                                        @error('district_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update District" />
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