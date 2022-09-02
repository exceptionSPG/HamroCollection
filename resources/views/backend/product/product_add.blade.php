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
                <h4 class="box-title">Add Product</h4>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf

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
                                                        <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}</option>
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
                                                        <option value="{{ $cat->id }}">{{ $cat->category_name_en }}</option>
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
                                                    <input type="text" name="product_name_en" class="form-control" required="">
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
                                                    <input type="text" name="product_name_nep" class="form-control" required="">
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
                                                    <input type="text" name="product_code" class="form-control" required="">
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
                                                    <input type="text" name="product_qty" class="form-control" required="">
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
                                                    <input type="text" name="product_tags_en" value="Lorem" data-role="tagsinput" class="form-control" required="">
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
                                                    <input type="text" name="product_tags_nep" value="Lorem" data-role="tagsinput" class="form-control" required="">
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
                                                    <input type="text" name="product_size_en" value="Small,medium,large" data-role="tagsinput" class="form-control">
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
                                                    <input type="text" name="product_size_nep" value="Small,medium,large" data-role="tagsinput" class="form-control">
                                                    @error('product_size_nep')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->
                                    </div><!-- end of 4th row -->



                                    <div class="row">
                                        <!-- start of 5th row -->
                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Color En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_en" value="Red,Black" data-role="tagsinput" class="form-control" required="">
                                                    @error('product_color_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                        </div><!-- end of col-md-4 -->

                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Color Nep <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_nep" value="Red, Black" data-role="tagsinput" class="form-control" required="">
                                                    @error('product_color_nep')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->


                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="selling_price" class="form-control" required="">
                                                    @error('selling_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->
                                    </div><!-- end of 5th row -->



                                    <!-- start of 6th row -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount_price" class="form-control">
                                                    @error('discount_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                        </div><!-- end of col-md-4 -->

                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Main Thumbnail <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="product_thumbnail" class="form-control" onchange="mainThamUrl(this)" required="">
                                                    @error('product_thumbnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb">
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->


                                        <div class="col-md-4">
                                            <!-- start of col md 4 -->
                                            <div class="form-group">
                                                <h5>Multiple image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="multi_image[]" class="form-control" multiple="" id="multiImg" required="">
                                                    @error('multi_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="row" id="preview_img">

                                                    </div>
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-4 -->
                                    </div><!-- end of 6th row -->




                                    <!-- start of description wala th row -->
                                    <div class="row">

                                        <div class="col-md-6">
                                            <!-- start of col md 6 -->
                                            <div class="form-group">
                                                <h5>Product Short Description En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_des_en" id="textarea" class="form-control" required=""></textarea>

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
                                                    <textarea name="short_des_nep" id="textarea" class="form-control" required=""></textarea>
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
                                                    <textarea name="long_des_en" id="editor1" rows="10" cols="80" class="form-control" required="">Product Long Description En</textarea>

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
                                                    <textarea name="long_des_nep" id="editor2" rows="10" cols="80" class="form-control" required="">Product Long Description Nep</textarea>

                                                    @error('long_des_nep')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div><!-- end of col-md-6 -->
                                    </div><!-- end of 8th row -->

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_2" name="hot_deals" value="1">
                                                        <label for="checkbox_2">Hot Deals</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" name="featured" id="checkbox_3" value="1">
                                                        <label for="checkbox_3">Featured</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" name="special_offer" id="checkbox_4" value="1">
                                                        <label for="checkbox_4">Special Offer</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" name="special_deals" id="checkbox_5" value="1">
                                                        <label for="checkbox_5">Special Deals</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Add Product">
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


@endsection