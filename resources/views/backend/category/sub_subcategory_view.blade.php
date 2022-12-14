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
                        <h3 class="box-title">Sub SubCategory List<span class="badge badge-pill badge-danger"> {{ count($sub_sub) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Category </th>
                                        <th>SubCategory</th>
                                        <th>Sub SubCategory En</th>
                                        <!-- <th>Sub SubCategoy Nepali</th> -->
                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <!--url('upload/brand/'.$item->brand_image)-->
                                    @foreach($sub_sub as $item)
                                    <tr>
                                        <td>{{ ($item['category']['category_name_en']) ? $item['category']['category_name_en'] : ''  }}</td>
                                        <td>{{ $item['subcategory']['subcategory_name_en'] }}</td>
                                        <td>{{ $item->sub_subcategory_name_en }}</td>
                                        <!-- <td>{{ $item->sub_subcategory_name_nep }}</td> -->
                                        <td><a href="{{ route('subsubcategory.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('subsubcategory.delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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

            <!-- -----------------Add Sub SubCategory Col -->

            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Sub SubCategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('subsubcategory.store') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" class="form-control">
                                            <option selected="" disabled="">Select Category</option>
                                            @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" class="form-control">
                                            <option selected="" disabled="">Select SubCategory</option>



                                        </select>
                                        @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Sub SubCategory in English: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="sub_subcategory_name_en" class="form-control">

                                        @error('sub_subcategory_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Sub SubCategory in Nepali: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="sub_subcategory_name_nep" class="form-control">
                                        @error('sub_subcategory_name_nep')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New" />
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
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });


        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name_en + '</option>');
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