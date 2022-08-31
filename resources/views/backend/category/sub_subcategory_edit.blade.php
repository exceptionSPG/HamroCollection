@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">

            <!-- -----------------Add Sub SubCategory Col -->

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Sub SubCategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('subsubcategory.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $subsubcategory->id }}">

                                <div class="form-group">
                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" class="form-control">
                                            <option selected="" disabled="">Select Category</option>
                                            @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $subsubcategory->category_id == $cat->id ? 'selected': '' }}>{{ $cat->category_name_en }}</option>
                                            @endforeach
                                        </select>


                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" class="form-control">
                                            <option selected="" disabled="">Select SubCategory</option>
                                            @foreach($subcategories as $subcat)
                                            <option value="{{ $subcat->id }}" {{ $subsubcategory->subcategory_id == $subcat->id ? 'selected': '' }}>{{ $subcat->subcategory_name_en }}</option>
                                            @endforeach


                                        </select>


                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Sub SubCategory in English: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="sub_subcategory_name_en" value="{{ $subsubcategory->sub_subcategory_name_en }}" class="form-control">


                                    </div>
                                </div>

                                <div class=" form-group">
                                    <h5>Sub SubCategory in Nepali: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="sub_subcategory_name_nep" class="form-control" value="{{ $subsubcategory->sub_subcategory_name_nep }}">

                                    </div>
                                </div>



                                <div class=" text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update" />
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
                        var d = $('select[name="subcategory_id" ]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id" ]').append('<option value="' + value.id + '">' + value.subcategory_name_en + '</option>');
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