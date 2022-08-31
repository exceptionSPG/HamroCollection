@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">


            <!-- -----------------Edit Brand Col -->

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('category.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $cat->id }}">

                                <div class="form-group">
                                    <h5>Category Name English: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_name_en" class="form-control" value="{{ $cat->category_name_en }}">


                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Category Name Nepali: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_name_nep" value="{{ $cat->category_name_nep }}" class=" form-control">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Category Icon: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_icon" class="form-control" value="{{ $cat->category_icon }}">

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