@extends('user.layouts.master')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid" style="margin:150px 0px">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartLists as $cartList)
                        <tr>
                            {{-- <input type="hidden" value="{{ $cartList->pizza_price }}"> --}}
                            <td><img src="{{ asset('storage/'.$cartList->product_image) }}" style="width: 50px;"></td>
                            <td class="align-middle">
                                {{ $cartList->pizza_name }}
                                <input type="hidden" class="orderId" value="{{  $cartList->id }}">
                                <input type="hidden" class="userId" value="{{  $cartList->user_id }}">
                                <input type="hidden" class="productId" value="{{  $cartList->product_id }}">
                            </td>
                            <td class="align-middle" id="price">{{ $cartList->pizza_price }} kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $cartList->qty }}" id="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{ $cartList->pizza_price*$cartList->qty }} kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove" id="removebtn"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Subtotal</h5>
                            <h5 id="subtotalprice">{{ $totalPrice }}</h5>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="font-weight-medium">Delivery</h5>
                            {{-- <h5 class="font-weight-medium">3000</h5> --}}
                            <select id="cityFee" required>
                                <option value="10000">Choose Place....</option>
                                <option value="3000">Insein</option>
                                <option value="2000">Hledan</option>
                                <option value="5000">Dagon</option>
                                <option value="6000">Sule</option>
                                <option value="5000">North Okkalapa</option>
                                <option value="4000">Yankin</option>
                            </select>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h4>Total</h4>
                            <h4 id="finalPrice">{{ $totalPrice + 10000 }}</h4>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">Clear Cart</button>
                    </div>
                    <small class="text-danger">*** If you didn't choose place , give 10000 </small>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('message')
<div class="alert alert-dismissible fade show" role="alert" style="margin-bottom:-10px">
    <strong><marquee direction="left">မြို့တွင်းပို့ခ ---> အင်းစိန်(၃၀၀၀ ကျပ်) လှည်းတန်း(၂၀၀၀ ကျပ်) ဒဂုံ(၅၀၀၀ ကျပ်) ဆူးလေ(၆၀၀၀ ကျပ်) မြောက်ဥက္ကလာပ(၅၀၀၀ ကျပ်) ရန်ကင်း(၄၀၀၀ ကျပ်) ဖြစ်ပါတယ်။ </marquee></strong>
</div>
@endsection

@section('scriptSource')
<script src="{{ asset('user/js/cart.js') }}"></script>
<script>
    $('#orderBtn').click(function(){
        $orderList = [];
        $random = Math.floor(Math.random() * 100000000001);
        $('#dataTable tbody tr').each(function(index,row){
            $orderList.push({
                'user_id' : $(row).find('.userId').val(),
                'product_id' : $(row).find('.productId').val(),
                'qty' : $(row).find('#qty').val(),
                'total' : $(row).find('#total').text().replace('kyats',''),
                'order_code' : 'POS'+ $random,
                'cityFee' : Number($("#cityFee option:selected").val())
            });
        });

        $.ajax({
            type: "get",
            url: "http://localhost:8000/user/ajax/order",
            data:  Object.assign({},$orderList ),
            dataType: "json",
            success: function (response) {
                if(response.status == 'success'){
                    window.location.href = "http://localhost:8000/user/home";
                }
            }
        });
        });

        $('#clearBtn').click(function(){
                $('#dataTable tbody tr').remove();
                $('#subtotalprice').html(0);
                Number($("#cityFee option:selected").val());
                $("#finalPrice").html(Number($('#subtotalprice').html())+Number($("#cityFee option:selected").val()));
                $.ajax({
                    type: "get",
                    url: "http://localhost:8000/user/ajax/cart/clear",
                    dataType: "json",
            });
        });

            // When each product cart remove
        $('.btn-remove').click(function(){
            $parentNode = $(this).parents("tr");
            $productId = $parentNode.find('.productId').val();
            $orderId = $parentNode.find('.orderId').val();
            $.ajax({
                    type: "get",
                    url: "http://localhost:8000/user/ajax/cart/current/clear",
                    data:  { 'product_id' : $productId , 'order_id' : $orderId},
                    dataType: "json",
            });
            $parentNode.remove();
            $cityFee = Number($("#cityFee option:selected").val());
            $totalSummary = 0;
            $("#dataTable tr").each(function(index,row){
                $totalSummary += Number($(row).find("#total").text().replace("kyats",""));
            });
            $("#subtotalprice").html(`${$totalSummary}`);
            $("#finalPrice").html(`${$totalSummary+$cityFee}`);
        });
</script>
@endsection

