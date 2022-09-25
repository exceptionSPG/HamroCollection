@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full" style="background-color: #DFF6FF;">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total Users <span class="badge badge-pill badge-success"> {{ count($users) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <!--url('upload/brand/'.$item->brand_image)-->
                                    @foreach($users as $item)
                                    <tr>
                                        <td><img src="{{ (!empty($item->profile_photo_path)) ? url('upload/user_images/'.$item->profile_photo_path) : url('upload/no_image.png') }}" alt="User Image" style="height: 40px; width: 70px;"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>

                                        <td>
                                            @if($item->UserOnline())

                                            <span class="badge badge-pill badge-success"> Active now

                                            </span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{ Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}</span>

                                            @endif

                                        </td>

                                        <td><a href="{{ route('brand.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('brand.delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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