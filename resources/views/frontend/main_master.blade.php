<!DOCTYPE html>
<html lang="en">

@php
$seo = App\Models\SEOSetting::find(1);
@endphp

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="{{$seo->meta_description}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="{{$seo->meta_author}}">
    <meta name="keywords" content="{{$seo->meta_keyword}}">
    <meta name="robots" content="all">


    <script>
    {{ $seo->google_analytics }}
    </script>

    <title>@yield('title') </title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!--toaster css-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <style>
        .checked {
            color: orange;
        }
    </style>

    <!-- App icon -->

    <link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">


</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    @include('frontend.body.header')
    <!-- ============================================== HEADER : END ============================================== -->
    @yield('content')
    <!-- /#top-banner-and-menu -->

    <!-- ============================================================= FOOTER ============================================================= -->
    @include('frontend.body.footer')
    <!-- ============================================================= FOOTER : END============================================================= -->

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}">
    </script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>

    <script src="https://js.stripe.com/v3/"></script>

    <!-- Sweetalert script-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
        @endif
    </script>




    <!-- Add to cart product Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong><span id="pname"></span> </strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-4">

                            <div class="card" style="width: 18rem;">
                                <img src=" " class="card-img-top" style="height: 200px;width: 200px;" alt="..." id="pimage">

                            </div>

                        </div>
                        <!-- End col-md-4 -->

                        <div class="col-md-4">

                            <ul class="list-group">
                                <li class="list-group-item">
                                    Price:
                                    <strong class="text-danger">
                                        Rs. <span id="pprice"></span>

                                    </strong><br>
                                    <del id="oldprice"> </del>
                                </li>
                                <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                                <li class="list-group-item">Brand:<strong id="pbrand"></strong></li>
                                <li class="list-group-item">Category:<strong id="category"></strong></li>
                                <li class="list-group-item">Stock:
                                    <span class="badge badge-success badge-pill" id="available" style="background-color: green; color: white"></span>
                                    <span class="badge badge-danger badge-pill" id="stockout" style="background-color: red; color: white"></span>
                                </li>
                            </ul>

                        </div>
                        <!-- End col-md-4 -->

                        <div class="col-md-4">

                            <div class="form-group" id="colorArea">
                                <label for="color">Choose Color:</label>
                                <select class="form-control" id="color" name="color">


                                </select>
                            </div>

                            <div class="form-group" id="sizeArea">
                                <label for="size">Choose Size:</label>
                                <select class="form-control" id="size" name="size">


                                </select>
                            </div>


                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="number" class="form-control" id="quantity" value="1" min="1">
                            </div>

                            <input type="hidden" id="product_id">
                            <button type="submit" id="btnAddToCart" class="btn btn-primary" onclick="addToCart()">Add to Cart</button>
                            <span id="stockMsg"></span>
                        </div>
                        <!-- End col-md-4 -->
                    </div>



                </div>
                <!-- End modal body -->

            </div>
        </div>
    </div>

    <!-- END to cart product Modal -->

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

            }
        });

        //start productView with modal
        function productView(id) {
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',

                success: function(data) {
                    $('#pname').text(data.product.product_name_en);
                    $('#pcode').text(data.product.product_code);
                    //$('#price').text(data.product.selling_price);
                    $('#stock').text(data.product.product_qty);
                    $('#pimage').attr('src', '/' + data.product.product_thumbnail);
                    $('#pbrand').text(data.product.brand.brand_name_en);
                    $('#category').text(data.product.category['category_name_en']);


                    //pass id to button add to card ko hidden input field quantity
                    $('#product_id').val(id);
                    $('#quantity').val(1);

                    //product price
                    if (data.product.discount_price == null) {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text(data.product.selling_price);
                    } else {
                        $('#pprice').text(data.product.discount_price);
                        $('#oldprice').text(data.product.selling_price);

                    } //end price

                    //color colorArea
                    $('select[name="color"]').empty();
                    $.each(data.color, function(key, value) {
                        $('select[name="color"]').append('<option value=" ' + value + '  ">' + value + '</option>');
                        if (data.color == "") {
                            $('#colorArea').hide();
                        } else {
                            $('#colorArea').show();
                        }
                    }) //end color

                    //size
                    $('select[name="size"]').empty();
                    $.each(data.size, function(key, value) {
                        $('select[name="size"]').append('<option value=" ' + value + '  ">' + value + '</option>');
                        if (data.size == "") {
                            $('#sizeArea').hide();
                        } else {
                            $('#sizeArea').show();
                        }
                    }) //end size

                    //stock  stockMsg
                    if (data.product.product_qty > 0) {
                        $('#available').text('');
                        $('#stockout').text('');
                        $('#available').text('available');
                        $('#btnAddToCart').show();
                        $('#stockMsg').text('');

                    } else {
                        $('#available').text('');
                        $('#stockout').text('');
                        $('#stockout').text('stockout');
                        $('#btnAddToCart').hide();
                        $('#stockMsg').text('You can buy once Product is available.Add to wishlist for now.');

                    }

                    //end stock

                }
            })
        } //end productView with modal

        /* ************add to cart with modal start****************/
        function addToCart() {
            var product_name = $('#pname').text();;
            var product_id = $('#product_id').val();
            var color = $('#color option:selected').text();
            var size = $('#size option:selected').text();
            var quantity = $('#quantity').val();

            //var name = 'next';
            var dataObject = {};
            dataObject['product_name'] = product_name;



            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    "color": color,
                    "size": size,
                    "quantity": quantity,
                    "product_name": product_name,
                },
                url: "/cart/data/store/" + product_id,
                success: function(data) {
                    couponCalculation();
                    miniCart();
                    Cart();

                    $('#closeModal').click();
                    //console.log(data);

                    //Start of Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        // title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        })

                    }



                    //End of Message







                },
            })


        } //end method addToCart
    </script>
    <!-- END  to cart product Modal Script -->

    <script type="text/javascript">
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(response) {
                    $('span[id="cartSubTotal"]').text(response.cartTotal)
                    $('span[id="cartQty"]').text(response.cartQty)
                    var miniCart = ""
                    //console.log(response);
                    $.each(response.carts, function(key, value) {
                        miniCart += `<div class="cart-item product-summary">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="image"> <a href="detail.html"><img src="/${value.options.image}" alt=""></a> </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                                            <div class="price">Rs. ${value.price}* ${value.qty}</div>
                                        </div>
                                        <div class="col-xs-1 action">
                                         <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button> 
                                         </div>
                                    </div>
                                </div>
                                <!-- /.cart-item -->
                                
                                <div class="clearfix"></div>
                                <hr>`

                    });
                    $('#miniCart').html(miniCart);
                }
            })
        }

        miniCart();

        //miniCartRemove START

        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product-remove/' + rowId,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    miniCart();
                    Cart();

                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            })
        }


        //miniCartRemove END
    </script>

    <!-- Start Add Wishlist page  -->
    <script type="text/javascript">
        function addToWishlist(product_id) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "/add-to-wishlist/" + product_id,


                success: function(data) {

                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message

                }
            })

        } //end method
    </script>

    <!-- END Wishlist -->

    <!-- Load Wishlist Data -->

    <script type="text/javascript">
        function Wishlist() {
            $.ajax({
                type: 'GET',
                url: '/user/get-wishlist-product',
                dataType: 'json',
                success: function(response) {

                    var rows = ""
                    //console.log(response);
                    $.each(response, function(key, value) {
                        rows += ` <tr>
                                    <td class="col-md-2"><img src="/${value.product.product_thumbnail}" alt="${value.product.product_name_en}"></td>
                                    <td class="col-md-7">
                                        <div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
                                        
                                        <div class="price">

                                        ${value.product.discount_price == null ? `Rs. ${value.product.selling_price}` : `Rs. ${value.product.discount_price} <span>Rs. ${value.product.selling_price} </span> ` }
                                           
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                    <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)"> Add To Cart </button>
                                    </td>
                                    <td class="col-md-1 close-btn">
                                        <button type="submit" class="" id="${value.id}" onclick="wishlistRemove(this.id)"> <i class="fa fa-times"></i> </button>
                                    </td>
                                </tr>`

                    });
                    $('#wishlist').html(rows);
                }
            })
        }

        Wishlist();



        //Wishilist Remove START

        function wishlistRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/user/wishlist/product-remove/' + id,
                dataType: 'json',
                success: function(data) {
                    Wishlist(); //call this to refresh without refreshing page.. boom
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            })
        }


        //Wishilist Remove END
    </script>

    <!-- END Wishlist Data -->



    <!--START Load mycart cartpage -->

    <script type="text/javascript">
        function Cart() {
            $.ajax({
                type: 'GET',
                url: '/get-mycart-product',
                dataType: 'json',
                success: function(response) {

                    var rows = ""
                    //console.log(response);
                    $.each(response.carts, function(key, value) {
                        rows += ` <tr>
                <td class="col-md-2"><img src="/${value.options.image}" alt="${value.name}" style="width:60px; height:60px;"></td>

               
                <td class="col-md-2">
            <div class="product-name"><a href="#">${value.name}</a></div>
             
            <div class="price"> 
                            ${value.price}
                        </div>
                    </td>

                <td class="col-md-2">
            <strong>${value.options.color} </strong> 
            </td>
         <td class="col-md-2">
          ${value.options.size == null
            ? `<span> ... </span>`
            :
          `<strong>${value.options.size} </strong>` 
          }           
            </td>


           <td class="col-md-2">
           ${value.qty > 1
            ? `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)" >-</button> `
            : `<button type="submit" class="btn btn-danger btn-sm" disabled >-</button> `
            }
        <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width:25px;" > 

        <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="CartIncrement(this.id)">+</button>  
            
        </td>
             <td class="col-md-2">
            <strong>Rs. ${value.subtotal} </strong> 
            </td>
                
                <td class="col-md-1 close-btn">
                    <button type="submit" class="" id="${value.rowId}" onclick="CartRemove(this.id)"> <i class="fa fa-times"></i> </button>
                </td>
            </tr>`

                    });
                    $('#cartpage').html(rows);
                }
            })
        }

        Cart();



        //Cart Remove START

        function CartRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/cart/product-remove/' + id,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    Cart(); //call this to refresh without refreshing page.. boom
                    miniCart(); //mini cart ko section ma pani aafai update garnako lagi call garne
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            })
        }

        //Cart item Remove END

        //Start: Cart Increment 

        function CartIncrement(id) {
            $.ajax({
                type: 'GET',
                url: '/cart-increment/' + id,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    Cart(); //call this to refresh without refreshing page.. boom
                    miniCart(); //mini cart ko section ma pani aafai update garnako lagi call garne
                }
            })
        }
        //END: Cart Increment

        //Start: Cart Decrement  

        function cartDecrement(id) {
            $.ajax({
                type: 'GET',
                url: '/cart-decrement/' + id,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    Cart(); //call this to refresh without refreshing page.. boom
                    miniCart(); //mini cart ko section ma pani aafai update garnako lagi call garne
                }
            })
        }

        //END: Cart Decrement
    </script>

    <!-- END mycart -->


    <!-- START: Coupon Apply -->

    <script type="text/javascript">
        function applyCoupon() {
            var coupon_name = $('#coupon_name').val();
            if (coupon_name != '') {
                $.ajax({
                    type: 'POST',
                    url: '/apply-coupon',
                    dataType: 'json',
                    data: {
                        coupon_name: coupon_name
                    },
                    success: function(data) {

                        if (data.success) {
                            console.log(data.success);
                            $('#couponTable').hide();
                        }

                        console.log(data);
                        // Start Message 
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',

                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                                icon: 'success',
                                type: 'success',
                                title: data.success
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                type: 'error',
                                title: data.error
                            });
                        }
                        // End Message
                    }
                });
            } else {
                alert("Promocode can not be blank .Enter a Valid Promocode !");

            }
            couponCalculation();
        }

        function couponCalculation() {
            $.ajax({
                type: 'GET',
                url: '/coupon-calculation',
                dataType: 'json',
                success: function(data) {
                    if (data.total) {

                        $('#couponCallField').html(
                            ` <tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Subtotal<span class="inner-left-md">Rs.${data.total}</span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Grand Total<span class="inner-left-md">Rs.${data.total}</span>
                                    </div>
                                </th>
                            </tr>`
                        );

                    } else {

                        $('#couponCallField').html(
                            ` <tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Subtotal<span class="inner-left-md">Rs.${data.subtotal}</span>
                                    </div>
                                    <div class="cart-sub-total">
                                        Coupon<span class="inner-left-md">${data.coupon_name}</span>
                                        <button type="submit" onclick="couponRemove()"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="cart-sub-total">
                                        Discount Amt.<span class="inner-left-md">Rs.${data.discount_amount}</span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Grand Total<span class="inner-left-md">Rs.${data.total_amount}</span>
                                    </div>
                                </th>
                            </tr>`
                        );

                    }

                },
            })
        }

        couponCalculation();
    </script>

    <!-- END: Coupon Apply -->



    <!-- START Coupon remove -->

    <script type="text/javascript">
        function couponRemove() {
            $.ajax({
                type: 'GET',
                url: '/coupon-remove',
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    $('#coupon_name').val(' ');

                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        $('#couponTable').show();

                        Toast.fire({
                            icon: 'success',
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            type: 'error',
                            title: data.error
                        });
                    }
                    // End Message


                }
            })
        }
    </script>
    <!-- END Coupon Removal -->





    <!-- -------Start JavaScript stripe --------->
    <script type="text/javascript">
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51LeubbKClkSrZJTRQHSCllNmHYn8SPhdRGpjAOKlx5pPvK60PQjFz8OastoXf6bvLLiOKQ8QCTiUM9b7fMbTYCoA00fcBkp6qr');
        // Create an instance of Elements.
        var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style
        });
        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });
        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    </script>


</body>

</html>