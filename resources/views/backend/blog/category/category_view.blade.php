@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">BlogCategory List <span class="badge badge-pill badge-success"> {{ count($blogcategory) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Blog Category En</th>
                                        <th>Blog Category Nep</th>
                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <!--url('upload/brand/'.$item->brand_image)-->
                                    @foreach($blogcategory as $item)
                                    <tr>
                                        <td>{{ $item->blog_category_name_en }}</td>
                                        <td>{{ $item->blog_category_name_nep }}</td>

                                        <td><a href="{{ route('blogcategory.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('blogcategory.delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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

            <!-- -----------------Add Brand Col -->

            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Blog Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('blogcategory.store') }}" method="post">
                                @csrf


                                <div class="form-group">
                                    <h5>Blog Category Name English: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="blog_category_name_en" class="form-control">

                                        @error('blog_category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Blog Category Name Nepali: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="blog_category_name_nep" class="form-control">
                                        @error('blog_category_name_nep')
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

@endsection