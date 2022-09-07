@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>




<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add Blog Post </h4>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('blogpost.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-12">


                                    <div class="row">
                                        <!-- start of 2nd row -->
                                        <div class="col-md-6">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Blog Post Category Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control" required="">
                                                        <option selected="" disabled>Select Blog Post Category</option>
                                                        @foreach($blogcats as $item)
                                                        <option value="{{ $item->id }}">{{ $item->blog_category_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror


                                                </div>
                                            </div>



                                        </div><!-- end of col-md-4 -->
                                        <!-- post_title_en	post_title_nep	post_slug_en	post_slug_nep	post_image	post_details_en	post_details_nep -->

                                        <div class="col-md-6">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Blog Title En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="post_title_en" class="form-control" required="">
                                                    @error('post_title_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->


                                    </div><!-- end of 2nd row -->







                                    <!-- start of 6th row -->
                                    <div class="row">

                                        <div class="col-md-6">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Post Title Nep <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="post_title_nep" class="form-control" required="">
                                                    @error('post_title_nep')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->

                                        <div class="col-md-6">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Post Image: <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="post_image" class="form-control" onchange="mainThamUrl(this)" required="">
                                                    @error('post_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb">
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->



                                    </div><!-- end of 6th row -->





                                    <!-- start of long description wala th row -->
                                    <div class="row">

                                        <div class="col-md-6">
                                            <!-- start of col md 6 -->
                                            <div class="form-group">
                                                <h5>Blog Post Details En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="post_details_en" id="editor1" rows="10" cols="80" class="form-control" required="">Post Details English</textarea>

                                                    @error('post_details_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-6 -->


                                        <div class="col-md-6">
                                            <!-- start of col md 6 -->
                                            <div class="form-group">
                                                <h5>Post Details Nepali <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="post_details_nep" id="editor2" rows="10" cols="80" class="form-control" required="">Post Details  Nep</textarea>

                                                    @error('post_details_nep')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-6 -->
                                    </div><!-- end of 8th row -->

                                    <hr>



                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Add Post">
                                    </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>




<script type="text/javascript">
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>



@endsection