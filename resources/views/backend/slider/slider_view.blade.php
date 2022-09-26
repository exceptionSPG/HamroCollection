@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full" style="background-color: #DFF6FF;">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Slider List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Slider Image</th>
                                        <th>Slider Title</th>
                                        <th>Slider Description</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <!--url('upload/brand/'.$item->brand_image)-->
                                    @foreach($sliders as $item)
                                    <tr>
                                        <td><img src="{{ url($item->slider_image) }}" alt="Slider Image" style="height: 40px; width: 70px;"></td>
                                        <td>

                                            @if($item->title == NULL)
                                            <span class="badge badge-pill badge-danger">No Title Data</span>


                                            @else

                                            {{ $item->title }}

                                            @endif


                                        </td>
                                        <td>

                                            @if($item->description == NULL)
                                            <span class="badge badge-pill badge-danger">No Description Data</span>


                                            @else

                                            {{ $item->description }}

                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>


                                            @else
                                            <span class="badge badge-pill badge-danger">Inactive</span>

                                            @endif
                                        </td>


                                        <td width=30%><a href="{{ route('slider.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('slider.delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>


                                            @if($item->status == 1)
                                            <a href="{{ route('slider.inactive',$item->id) }}" class="btn btn-danger sm" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>

                                            @else
                                            <a href="{{ route('slider.active',$item->id) }}" class="btn btn-success sm" title="Acive Now "><i class="fa fa-arrow-up"></i></a>

                                            @endif
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
                        <h3 class="box-title">Add Slider </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                                @csrf


                                <div class="form-group">
                                    <h5>Slider Title: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="title" class="form-control">


                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Slider Description: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea type="text" name="description" class="form-control"></textarea>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Slider Image: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="slider_image" class="form-control" accept="image/png, image/jpeg">
                                        @error('slider_image')
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