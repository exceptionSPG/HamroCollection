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
                        <h3 class="box-title">Product Stock List <span class="badge badge-pill badge-success"> {{ count($products) }}</span></h3>
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
                                    @foreach($products as $item)
                                    <tr>
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


                                        <td> <a href="{{ route('product.edit',$item->id) }}" class="btn btn-primary sm" title="Edit Data"><i class="fa fa-eye"></i></a>
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

@endsection