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
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>
                    </div>
                    @if (session('createMessage'))
                    <div class="col-6 offset-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('createMessage') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif
                    @if (session('deleteMessage'))
                    <div class="col-6 offset-6">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('deleteMessage') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif

                    @if (session('updateMessage'))
                    <div class="col-6 offset-6">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>{{ session('updateMessage') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-4">
                            <h5 class="text-primary">Search Key :  <span class="text-danger">{{ request('dataSearch') }}</span></h5>
                        </div>
                        {{-- Data Searching  --}}
                    <div class="col-4 offset-4">
                        <form action="{{ route('order#list') }}" method="get">
                            <div class="d-flex">
                                <input type="text" name="dataSearch" class="form-control" placeholder="Search...." value="{{ request('dataSearch') }}" style="padding: 8px">
                                 <button type="submit" class="btn btn-dark text-uppercase" style="font-size: 13px;margin-left: 10px"><i class="fa-solid fa-magnifying-glass me-1"></i>Search</button>
                            </div>
                        </form>
                    </div>
                    </div>

                    <div class="row">
                        <h4 class="text-danger"> <i class="fa-solid fa-database"></i> Total - {{ count($orders) }}</h4>
                    </div>


                    <form action="{{ route('ajax#orderstatus') }}" method="get">
                        @csrf
                        <label>Order Status</label>
                        <div class="d-flex">
                                <select name="orderStatus" id="orderStatus" class="form-control col-2">
                                    <option value="">All</option>
                                    <option value="0" @if(request('orderStatus') == '0' ) selected @endif>Pending</option>
                                    <option value="1" @if(request('orderStatus') == '1' ) selected @endif>Accept</option>
                                    <option value="2" @if(request('orderStatus') == '2' ) selected @endif>Reject</option>
                                </select>
                            <button type="submit" class="btn btn-sm bg-dark text-white px-4">Search</button>
                        </div>
                    </form>

                    @if (count($orders) != 0)
                       <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class="text-center">User ID</th>
                                    <th class="text-center">User Name</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Order Code</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orders as $order)
                                <tr class="spacer">
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="orderID" value="{{ $order->id }}">
                                        <td class="text-center">{{ $order->user_id }}</td>
                                        <td class="text-center">{{ $order->user_name}}</td>
                                        <td class="text-center">{{ $order->created_at->format('F-j-Y') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('order#listinfo',$order->order_code) }}" class="text-primary text-decoration-none">{{ $order->order_code }}</a>
                                        </td>
                                        <td class="text-center">{{ $order->total_price }} kyats</td>
                                        <td class="text-center">
                                            <select class="form-control statusChange">
                                                <option value="0" @if($order->status == 0 ) selected @endif>Pending</option>
                                                <option value="1" @if($order->status == 1 ) selected @endif>Accept</option>
                                                <option value="2" @if($order->status == 2 ) selected @endif>Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                        </div>
                    </div>
                    @else
                       <div>
                           <h1 class="text-danger mt-5 text-center">There is no data</h1>
                       </div>
                   @endif
                <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSource')
        <script>
            $(document).ready(function(){

                // Order Status Search
                // $('#orderStatus').change(function(){
                //     $status = $('#orderStatus').val();
                //     // console.log($status);
                // $.ajax({
                //     type: "get",
                //     url: "http://localhost:8000/ajax/order/status",
                //     data: {
                //         'status' : $status,
                //     },
                //     dataType: "json",
                //     success: function (response) {
                //         $list = '';
                //         for ($i = 0; $i < response.length; $i++) {
                //             $month = ['January','February','March','April','May','June','July','Augest','September','October','November','December'];
                //             $dbDate = new Date(response[$i].created_at);
                //             $finalDate = $month[$dbDate.getMonth()] + "-" + $dbDate.getDate() + "-" + $dbDate.getFullYear() ;
                //             if (response[$i].status == 0) {
                //                 $statusMessage = `
                //                 <select class="form-control statusChange">
                //                         <option value="0" selected>Pending</option>
                //                         <option value="1">Accept</option>
                //                         <option value="2">Reject</option>
                //                 </select>
                //                 `;
                //             }else if (response[$i].status == 1) {
                //                 $statusMessage = `
                //                 <select class="form-control statusChange">
                //                         <option value="0">Pending</option>
                //                         <option value="1" selected>Accept</option>
                //                         <option value="2">Reject</option>
                //                 </select>
                //                 `;
                //             }else if (response[$i].status == 2) {
                //                 $statusMessage = `
                //                 <select class="form-control statusChange">
                //                         <option value="0">Pending</option>
                //                         <option value="1">Accept</option>
                //                         <option value="2" selected>Reject</option>
                //                 </select>
                //                 `;
                //             }
                //             $list += `
                //             <tr class="spacer">
                //                     <tr class="tr-shadow">
                //                         <td class="text-center">${response[$i].user_id}</td>
                //                         <td class="text-center">${response[$i].user_name}</td>
                //                         <td class="text-center">${$finalDate}</td>
                //                         <td class="text-center">${response[$i].order_code}</td>
                //                         <td class="text-center">${response[$i].total_price}</td>
                //                         <td class="text-center">${$statusMessage}</td>
                //                         <td>
                //                             <div class="table-data-feature">
                //                                 <a href="#">
                //                                     <button class="mt-2 mr-3" data-toggle="tooltip" data-placement="top" title="Edit">
                //                                         <i class="fa-regular fa-eye fs-5"></i>
                //                                     </button>
                //                                 </a>
                //                                 <a href="#">
                //                                     <button class="mt-2 mr-3" data-toggle="tooltip" data-placement="top" title="Delete">
                //                                         <i class="fa-solid fa-trash-can fs-5"></i>
                //                                     </button>
                //                                 </a>
                //                             </div>
                //                         </td>
                //                     </tr>
                //                 </tr>
                //             `;
                //         }
                //         $('#dataList').html($list);
                //     }
                // });
                // });

                // Change Status orderID
                $('.statusChange').change(function(){
                    $currentStatus = $(this).val();
                    $parentNode = $(this).parents('tr');
                    $orderId = $parentNode.find('.orderID').val();

                    $data = {
                        'status' : $currentStatus,
                        'orderId' : $orderId,
                    };

                    console.log($data);

                    $.ajax({
                        type: "get",
                        url: "/ajax/change/status",
                        data: $data,
                        dataType: "json",
                    });
                    window.location.href = "http://localhost:8000/order/list";
                });

            });
        </script>
@endsection
