@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog List <span class="badge badge-pill badge-success"> {{ count($blogs) }}</span></h3>
                        <a href="{{route('add.post') }}" class="btn btn-success" style="float: right;">Add Post</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Blog Category</th>
                                        <th>Post Image </th>
                                        <th>Post Title En </th>
                                        <th>Post Title Nep </th>
                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <!--url('upload/brand/'.post_title_en	post_title_nep-->
                                    @foreach($blogs as $item)
                                    <tr>
                                        <td>{{ $item->category->blog_category_name_en }}</td>
                                        <td><img src="{{ url($item->post_image) }}" alt="Post Image" style="height: 40px; width: 70px;"></td>
                                        <td>{{ $item->post_title_en }}</td>
                                        <td>{{ $item->post_title_nep }}</td>

                                        <td><a href="{{ route('blogpost.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('blogpost.delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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


        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

<!-- /.content-wrapper -->

@endsection