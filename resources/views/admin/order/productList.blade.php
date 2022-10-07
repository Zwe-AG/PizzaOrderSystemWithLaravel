@extends('admin.layouts.master');
@section('title','Category List');
@section('myContent')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('order#list') }}" class="text-dark text-decoration-none fs-5">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                    <div class="row col-4">
                        <div class="card mt-4">
                            <div class="card-title mt-4">
                                <h4 class="text-center" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif"><i class="fa-regular fa-clipboard me-2"></i>Order Info</h4>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"><i class="fa-solid fa-user me-1"></i> Customer Name</div>
                                    <div class="col">{{ $orderlists[0]->user_name }} </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col"><i class="fa-brands fa-codepen me-1"></i> Order Code</div>
                                    <div class="col">{{ $orderlists[0]->order_code }}</div>
                                </div>
                                <div class="row my-2">
                                    <div class="col"><i class="fa-solid fa-calendar-days me-1"></i> Order Date</div>
                                    <div class="col">{{ $orderlists[0]->created_at->format('j-F-Y') }}</div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col"><i class="fa-regular fa-money-bill-1 me-1"></i> Total Price</div>
                                    <div class="col">{{ $order->total_price }} kyats</div>
                                </div>
                                <small class="text-warning ms-5"> <i class="fa-solid fa-exclamation-triangle"></i> Include Delivery Charges</small>
                            </div>
                        </div>
                    </div>
                       <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center">Order ID</th>
                                    <th class="text-center">Product Image</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderlists as $orderlist)
                                <tr class="spacer">
                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td class="text-center">{{ $orderlist->id }}</td>
                                        <td class="col-2">
                                            <img src="{{ asset('storage/'.$orderlist->product_image) }}" class="img-thumbnail shadow-sm" style="height:100px"/>
                                        </td>
                                        <td class="text-center">{{ $orderlist->product_name }}</td>
                                        <td class="text-center">{{ $orderlist->created_at->format('j-F-Y') }}</td>
                                        <td class="text-center">{{  $orderlist->qty }}</td>
                                        <td class="text-center">{{  $orderlist->total }}</td>
                                    </tr>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                        </div>
                    </div>
                <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

