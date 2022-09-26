@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>




<div class="container-full" style="background-color: #DFF6FF;">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Product</h4>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('product.update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">

                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <!-- start of 1st row -->
                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Brand Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="brand_id" class="form-control" required="">
                                                        <option selected="" disabled>Select Category</option>
                                                        @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected': '' }}>{{ $brand->brand_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror


                                                </div>
                                            </div>



                                        </div><!-- end of col-md-4 -->

                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Category Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control" required="">
                                                        <option selected="" disabled>Select Category</option>
                                                        @foreach($categories as $cat)
                                                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected': '' }}>{{ $cat->category_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror



                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->

                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subcategory_id" class="form-control" required="">
                                                        <option selected="" disabled>Select Sub Category</option>
                                                        <!-- javascript bata load hune banaune -->
                                                        @foreach($subcategory as $subcat)
                                                        <option value="{{ $subcat->id }}" {{ $product->subcategory_id == $subcat->id ? 'selected': '' }}>{{ $subcat->subcategory_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('subcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror


                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->
                                    </div><!-- end of 1st row -->


                                    <div class="row">
                                        <!-- start of 2nd row -->
                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Sub Subcategory Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subsubcategory_id" class="form-control" required="">
                                                        <option selected="" disabled>Select Sub SubCategory</option>
                                                        <!-- javascript bata load garne -->
                                                        @foreach($subsubcategory as $subsubcat)
                                                        <option value="{{ $subsubcat->id }}" {{ $product->subsubcategory_id == $subsubcat->id ? 'selected': '' }}>{{ $subsubcat->sub_subcategory_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('subsubcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror


                                                </div>
                                            </div>



                                        </div><!-- end of col-md-4 -->

                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Name En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_en" class="form-control" required="" value="{{ $product->product_name_en }}">
                                                    @error('product_name_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->

                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Name Nep <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_nep" class="form-control" required="" value="{{ $product->product_name_nep }}">
                                                    @error('product_name_nep')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->
                                    </div><!-- end of 2nd row -->


                                    <div class="row">
                                        <!-- start of 3rd row -->
                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Code <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_code" class="form-control" required="" value="{{ $product->product_code }}">
                                                    @error('product_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                        </div><!-- end of col-md-4 -->

                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Quantity <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <!-- <input type="text" name="product_qty" class="form-control" required="" value="{{ $product->product_qty }}"> -->
                                                    <input type="number" style="width:100%;" class="form-control" id="quantity" step="1" value="{{ $product->product_qty }}" min="1" max="1000" name="quantity" onkeypress="return isNumberKey(event)">
                                                    @error('product_qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->
                                        <!-- aba tags input ko lagi arko file kholera code lyau hai.. break -->

                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Tags En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_en" value="{{ $product->product_tags_en }}" data-role="tagsinput" class="form-control" required="">
                                                    @error('product_tags_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->
                                    </div><!-- end of 3rd row -->



                                    <div class="row">
                                        <!-- start of 4th row -->
                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Tags Nep <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_nep" value="{{ $product->product_tags_nep }}" data-role="tagsinput" class="form-control" required="">
                                                    @error('product_tags_nep')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                        </div><!-- end of col-md-4 -->

                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Size En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_en" value="{{ $product->product_size_en }}" data-role="tagsinput" class="form-control">
                                                    @error('product_size_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->

                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Size Nep <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_nep" value="{{ $product->product_size_nep }}" data-role="tagsinput" class="form-control">
                                                    @error('product_size_nep')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->
                                    </div><!-- end of 4th row -->



                                    <div class="row">
                                        <!-- start of 5th row -->
                                        <div class="col-md-6">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Color En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_en" value="{{ $product->product_color_en }}" data-role="tagsinput" class="form-control" required="">
                                                    @error('product_color_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                        </div><!-- end of col-md-4 -->

                                        <div class="col-md-6">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Color Nep <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_nep" value="{{ $product->product_color_nep }}" data-role="tagsinput" class="form-control" required="">
                                                    @error('product_color_nep')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->



                                    </div><!-- end of 5th row -->



                                    <!-- start of 6th row -->
                                    <div class="row">


                                        <div class="col-md-6">
                                            <!-- start of col md 6 -->
                                            <div class="form-group">
                                                <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <!-- <input type="text" name="selling_price" class="form-control" required="" value="{{ $product->selling_price }}"> -->
                                                    <input type="number" style="width:100%;" class="form-control" id="selling_price" step="1" min="1" max="100000" value="{{ $product->selling_price }}" name="selling_price" onkeypress="return isNumberKey1(event)">
                                                    @error('selling_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-6 -->
                                        <div class="col-md-6">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <!-- <input type="text" name="discount_price" class="form-control" value="{{ $product->discount_price }}"> -->
                                                    <input type="number" style="width:100%;" class="form-control" id="discount_price" step="1" max="100000" value="{{ $product->discount_price }}" name="discount_price" onkeypress="return isNumberKey2(event)">

                                                    @error('discount_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                        </div><!-- end of col-md-6 -->



                                    </div><!-- end of 6th row -->




                                    <!-- start of description wala th row -->
                                    <div class="row">

                                        <div class="col-md-6">
                                            <!-- start of col md 6 -->
                                            <div class="form-group">
                                                <h5>Product Short Description En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_des_en" id="textarea" class="form-control" required="">{!! $product->short_des_en !!}</textarea>

                                                    @error('short_des_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-6 -->


                                        <div class="col-md-6">
                                            <!-- start of col md 6 -->
                                            <div class="form-group">
                                                <h5>Product Short Description Nep <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_des_nep" id="textarea" class="form-control" required="">{!! $product->short_des_nep !!}</textarea>
                                                    @error('short_des_nep')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-6 -->
                                    </div><!-- end of 7th row -->


                                    <!-- start of long description wala th row -->
                                    <div class="row">

                                        <div class="col-md-6">
                                            <!-- start of col md 6 -->
                                            <div class="form-group">
                                                <h5>Product Long Description En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="long_des_en" id="editor1" rows="10" cols="80" class="form-control" required="">{!! $product->long_des_en !!}</textarea>

                                                    @error('long_des_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-6 -->


                                        <div class="col-md-6">
                                            <!-- start of col md 6 -->
                                            <div class="form-group">
                                                <h5>Product Long Description Nep <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="long_des_nep" id="editor2" rows="10" cols="80" class="form-control" required="">{!! $product->long_des_nep !!}</textarea>

                                                    @error('long_des_nep')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-6 -->
                                    </div><!-- end of 8th row -->

                                    <hr>

                                    <!-- Checkboxes  -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ $product->hot_deals == 1 ? 'checked':''}}>
                                                        <label for="checkbox_2">Hot Deals</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" name="featured" id="checkbox_3" value="1" {{ $product->featured == 1 ? 'checked':''}}>
                                                        <label for="checkbox_3">Featured</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" name="special_offer" id="checkbox_4" value="1" {{ $product->special_offer == 1 ? 'checked':''}}>
                                                        <label for="checkbox_4">Special Offer</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" name="special_deals" id="checkbox_5" value="1" {{ $product->special_deals == 1 ? 'checked':''}}>
                                                        <label for="checkbox_5">Special Deals</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Update Product">
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

    <!-- Multiple Image Update Area Start here -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                    </div>

                    <form action="{{ route('update.product.image') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row row-sm">
                            @foreach($multi_images as $img)
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ asset($img->photo_name) }}" style="width: 280px;height: 130px; ">
                                    <div class="card-body">
                                        <a href="{{ route('product.multiimg.delete',$img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Image"><i class="fa fa-trash"></i></a>

                                        <div class="form-group">
                                            <label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                            <input type="file" class="form-control" name="multi_image[{{ $img->id }}]" accept="image/png, image/jpeg" id="multiImg" required="">
                                            <div class="row" id="preview_img">

                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <!-- end col-md-3 -->
                            @endforeach

                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info" value="Update Image">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Multiple Image Update Area Start here -->

    <!-- Thumbnail Image Update Area Start here -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Thumbnail Image <strong>Update</strong></h4>
                    </div>

                    <form action="{{ route('update.product.thumbnail') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="old_img" value="{{ $product->product_thumbnail }}">
                        <div class="row row-sm">

                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ asset($product->product_thumbnail) }}" style="width: 280px;height: 130px;">
                                    <div class="card-body">


                                        <div class="form-group">
                                            <label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                            <input type="file" name="product_thumbnail" class="form-control" onchange="mainThamUrl(this)" required="">
                                            <img src="" id="mainThmb">
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!-- end col-md-3 -->

                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info" value="Update Thumbnail">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Thumbnail Image Update Area Start here -->














</div>












<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subsubcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });



        $('select[name="subcategory_id"]').on('change', function() {
            var subcategory_id = $(this).val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{ url('/category/sub_subcategory/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subsubcategory_id"]').append('<option value="' + value.id + '">' + value.sub_subcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

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

<script type="text/javascript">
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80)
                                    .height(80); //create image element 
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>
<script>
    function isNumberKey(e) {
        if (e.keyCode === 5) return true;
        var currentChar = parseInt(String.fromCharCode(e.keyCode), 10);
        if (!isNaN(currentChar)) {
            var nextValue = $("#quantity").val() + currentChar; //It's a string concatenation, not an addition

            if (parseInt(nextValue, 10) <= 1000) return true;
        }

        return false;
    }
</script>
<script>
    function isNumberKey1(e) {
        if (e.keyCode === 99999) return true;
        var currentChar = parseInt(String.fromCharCode(e.keyCode), 10);
        if (!isNaN(currentChar)) {
            var nextValue = $("#selling_price").val() + currentChar; //It's a string concatenation, not an addition

            if (parseInt(nextValue, 10) <= 999999) return true;
        }

        return false;
    }
</script>
<script>
    function isNumberKey2(e) {
        if (e.keyCode === 99999) return true;
        var currentChar = parseInt(String.fromCharCode(e.keyCode), 10);
        if (!isNaN(currentChar)) {
            var nextValue = $("#discount_price").val() + currentChar; //It's a string concatenation, not an addition

            if (parseInt(nextValue, 10) <= 999999) return true;
        }

        return false;
    }
</script>
@endsection