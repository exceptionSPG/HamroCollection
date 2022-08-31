@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">


            <!-- -----------------Edit Sub Category Col -->

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit SubCategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('subcategory.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $subcat->id }}">

                                <div class="form-group">
                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" class="form-control">
                                            <!-- <option selected="" disabled>Select Category</option> -->
                                            @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $subcat->category_id == $cat->id ? 'selected': '' }}>{{ $cat->category_name_en }}</option>
                                            @endforeach
                                        </select>


                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>SubCategory in English: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subcategory_name_en" value="{{ $subcat->subcategory_name_en }}" class="form-control">


                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>SubCategory in Nepali: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subcategory_name_nep" value="{{ $subcat->subcategory_name_nep }}" class="form-control">

                                    </div>
                                </div>



                                <div class="text-xs-right">
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

@endsection