@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">


            <!-- -----------------Add Brand Col -->

            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Blog Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('blogcategory.update') }}" method="post">
                                @csrf

                                <input type="hidden" name="id" value="{{$bcat->id}}">
                                <div class="form-group">
                                    <h5>Blog Category Name English: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" required="" name="blog_category_name_en" value="{{$bcat->blog_category_name_en}}" class="form-control">


                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Blog Category Name Nepali: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="blog_category_name_nep" value="{{$bcat->blog_category_name_en}}" required="" class="form-control">

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