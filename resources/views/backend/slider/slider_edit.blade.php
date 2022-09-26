@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full" style="background-color: #DFF6FF;">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">


            <!-- -----------------Edit Slider Col -->

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Slider</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form action="{{ route('slider.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $slider->id }}">
                                <input type="hidden" name="old_image" value="{{ $slider->slider_image }}">

                                <div class="form-group">
                                    <h5>Slider Title: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="title" class="form-control" value="{{ $slider->title }}">


                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Slider Description: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea type="text" name="description" class=" form-control">{{ $slider->description }}</textarea>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Slider Image: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="slider_image" class="form-control" accept="image/png, image/jpeg">

                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Slider" />
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