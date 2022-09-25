@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<!-- Content Wrapper. Contains page content -->

<div class="container-full" style="background-color: #DFF6FF;">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Local State List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Province Name</th>
                                        <th>District Name</th>
                                        <th>Municipality Name</th>
                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <!--coupon_name	coupon_discount	coupon_validity	status -->
                                    @foreach($munis as $item)
                                    <tr>

                                        <td>{{ $item->province->province_name }}</td>
                                        <td>{{ $item->district->district_name }}</td>
                                        <td>{{ $item->municipal_name }}</td>
                                        <td width=40%><a href="{{ route('municipal.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('municipal.delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>


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
                        <h3 class="box-title">Add Local State</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('municipal.store') }}" method="post">
                                @csrf


                                <div class="form-group">
                                    <h5>Province Name : <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="province_id" class="form-control">
                                            <option selected="" disabled="">Select Province:</option>
                                            @foreach($provinces as $item)
                                            <option value="{{ $item->id }}">{{ $item->province_name }}</option>
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
                                        <select name="district_id" class="form-control">
                                            <option selected="" disabled="">Select District:</option>
                                            @foreach($districts as $item)
                                            <option value="{{ $item->id }}">{{ $item->district_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('district_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Local State Name : <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="municipal_name" class="form-control">

                                        @error('municipal_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Local State" />
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


<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="province_id"]').on('change', function() {
            var province_id = $(this).val();
            if (province_id) {
                $.ajax({
                    url: "{{ url('/shipping/district/ajax') }}/" + province_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="district_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });



    });
</script>

@endsection