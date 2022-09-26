@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container-full" style="background-color: #DFF6FF;">

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Admin User</h4>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('admin.user.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$adminuser->id}}">
                            <input type="hidden" name="old_image" value="{{$adminuser->profile_photo_path}}">

                            <div class="row">
                                <div class="col-12">


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Admin username: <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" value="{{$adminuser->name}}" name="name" class="form-control">
                                                </div>
                                            </div>
                                        </div> <!--  end col-md-6 -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Admin email: <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="email" value="{{$adminuser->email}}" name="email" class="form-control">
                                                </div>
                                            </div>

                                        </div> <!--  end col-md-6 -->
                                    </div><!--  end row -->


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Admin UserPhone: <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <!-- <input type="text" value="{{$adminuser->phone}}" name="phone" class="form-control"> -->
                                                    <input type="tel" id="phone" name="phone" value="{{$adminuser->phone}}" placeholder="9xxxxxxxxx" pattern="[9][0-9]{9}" style="width:100%;" class="form-control" onkeypress="return isNumberKey(event)">
                                                </div>
                                            </div>
                                        </div> <!--  end col-md-6 -->


                                    </div><!--  end row -->





                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Admin Profile Image: <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" id="image" name="profile_photo_path" class="form-control" accept="image/png, image/jpeg">
                                                </div>
                                            </div>

                                        </div> <!--  end col-md-6 -->

                                        <div class="col-md-6">
                                            <img id="showImage" src="{{ (!empty($editData->profile_photo_path)) ? url('upload/admin_images/'.$editData->profile_photo_path) : url('upload/no_image.png') }}" style="width: 100px; height:100px;">

                                        </div> <!--  end col-md-6 -->
                                    </div><!--  end row -->


                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_2" name="brand" value="1" {{$adminuser->brand==1 ? 'checked':''}}>
                                                        <label for="checkbox_2">Brand</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_3" name="category" value="1" {{$adminuser->category==1 ? 'checked':''}}>
                                                        <label for="checkbox_3">Category</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_4" name="product" value="1" {{$adminuser->product==1 ? 'checked':''}}>
                                                        <label for="checkbox_4">Product</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_5" name="slider" value="1" {{$adminuser->slider==1 ? 'checked':''}}>
                                                        <label for="checkbox_5">Slider</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_6" name="coupon" value="1" {{$adminuser->coupon==1 ? 'checked':''}}>
                                                        <label for="checkbox_6">Coupons</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>





                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_7" name="shipping" value="1" {{$adminuser->shipping==1 ? 'checked':''}}>
                                                        <label for="checkbox_7">Shipping</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_8" name="blog" value="1" {{$adminuser->blog==1 ? 'checked':''}}>
                                                        <label for="checkbox_8">Blog</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_9" name="setting" value="1" {{$adminuser->setting==1 ? 'checked':''}}>
                                                        <label for="checkbox_9">Setting</label>
                                                    </fieldset>


                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_10" name="returnorder" value="1" {{$adminuser->returnorder==1 ? 'checked':''}}>
                                                        <label for="checkbox_10">Return Order</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_11" name="review" value="1" {{$adminuser->review==1 ? 'checked':''}}>
                                                        <label for="checkbox_11"> Review</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_12" name="orders" value="1" {{$adminuser->orders==1 ? 'checked':''}}>
                                                        <label for="checkbox_12">Orders</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_13" name="stock" value="1" {{$adminuser->stock==1 ? 'checked':''}}>
                                                        <label for="checkbox_13">Stock</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_14" name="reports" value="1" {{$adminuser->reports==1 ? 'checked':''}}>
                                                        <label for="checkbox_14">Reports</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_15" name="alluser" value="1" {{$adminuser->aluser==1 ? 'checked':''}}>
                                                        <label for="checkbox_15">Alluser</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_16" name="adminuserrole" value="1" {{$adminuser->adminuserrole==1 ? 'checked':''}}>
                                                        <label for="checkbox_16">Adminuserrole</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>





                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update" />
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
    $(new Document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
<script>
    function isNumberKey(e) {
        if (e.keyCode === 9999999999) return true;
        var currentChar = parseInt(String.fromCharCode(e.keyCode), 10);
        if (!isNaN(currentChar)) {
            var nextValue = $("#phone").val() + currentChar; //It's a string concatenation, not an addition

            if (parseInt(nextValue, 10) <= 9999999999) return true;
        }

        return false;
    }
</script>
@endsection