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
                        <h3 class="box-title">Product Stock Below Threshold List <span class="badge badge-pill badge-success"> {{ count($product_below) }}</span></h3>

                        <a href="{{ route('all.stock') }}" class="btn btn-primary" style="float: right;">View All Stock</a><span></span>
                        <a href="{{ route('send.stock.mail') }}" class="btn btn-info mr-4" style="float: right;">Send Mail</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name En</th>
                                        <th>Product Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Update</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <!--url('upload/brand/'.$item->brand_image)-->
                                    @foreach($product_below as $item)
                                    <tr class="bg-danger">
                                        <td><img src="{{ asset($item->product_thumbnail) }}" alt="" style="width: 60px; height: 50px;"></td>
                                        <td>{{ $item->product_name_en }}</td>
                                        <td>Rs. {{ $item->selling_price }}</td>
                                        <td>{{ $item->product_qty }} pic</td>
                                        <td>
                                            @if($item->discount_price == NULL)
                                            <!-- battery down vayo yrr -->
                                            <!-- varkhar 6:09PM ma line aayera aako feri gayo.. -->
                                            <span class="badge badge-pill badge-danger">No Discount</span>


                                            @else
                                            @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = ($amount/$item->selling_price)*100;
                                            @endphp
                                            <span class="badge badge-pill badge-danger">{{ round($discount) }} %</span>

                                            @endif




                                        </td>


                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>


                                            @else
                                            <span class="badge badge-pill badge-danger">Inactive</span>

                                            @endif
                                        </td>


                                        <td>
                                            <a href="#addBookDialog" class="open-AddBookDialog btn btn-primary sm" type="button" data-toggle="modal" id="{{ $item->id }}" onclick="productId(this.id)" title="Edit Data"><i class="fa fa-pencil"></i></a>



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


            <!-- /.col 12 -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->





</div>

<!-- /.content-wrapper -->

<!-- START: Order Tracking Modal -->
<div class="modal fade" id="addBookDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Quantity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update.quantity') }}" method="POST">
                    @csrf
                    <input type="hidden" name="itemId" id="itemId" value="" />
                    <div class="modal-body">
                        <label for="">Product Quantity</label>
                        <input type="number" name="quantity" class="form-control" required="">

                    </div>
                    <button type="submit" style="margin-left: 17px;" class="btn btn-danger">Update</button>


                </form>



            </div>

        </div>
    </div>
</div>
<!-- END: Order Tracking Modal -->




<script type="text/javascript">
    //start productView with modal
    function productId(id) {
        $(".modal-body #itemId").val(id);


    } //end productView with modal
</script>



@endsection