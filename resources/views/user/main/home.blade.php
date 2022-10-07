@extends('user.layouts.master')

@section('content')

    <div class="deal">

        <div class="content">
            <h3>Discount of the day</h3>
            <h1>Up to <strong>50%</strong> off</h1>
            <p>Pizza is a dish of Italian origin consisting of a usually round, flat base of leavened wheat-based dough topped with tomatoes & cheese.</p>
            <a href="#" class="btn">shop now</a>
        </div>

        <div class="image">
            <img src="{{ asset('user/images/bg_1.png') }}" alt="">
        </div>

    </div>

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <label class="" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal" style="font-size: 15px">{{ count($categories) }}</span>
                        </div>
                        <hr>
                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#home') }}" class="text-dark"><label for="price-1">All</label></a>
                        </div>
                        @foreach ($categories as $category)
                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#filter',$category->id) }}" class="text-dark"><label for="price-1">{{ $category->name }}</label></a>
                        </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                             <div>
                                <a href="{{ route('pizza#cartpage') }}">
                                    <button type="button" class="btn btn-primary position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded bg-danger">
                                          {{ count($carts) }}
                                          <span class="visually-hidden">unread messages</span>
                                        </span>
                                      </button>
                                </a>
                                <a href="{{ route('user#history') }}" class="ms-2">
                                    <button type="button" class="btn btn-primary position-relative">
                                        <i class="fa-solid fa-history"></i> History
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded bg-danger">
                                          {{ count($history) }}
                                          <span class="visually-hidden">unread messages</span>
                                        </span>
                                      </button>
                                </a>
                             </div>
                            <div class="ml-2">
                                <div class="btn-group ml-2">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Choose Option ...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                      </div>

                      <span id="dataList" class="row">
                        @if (count($pizzas) != 0)
                        @foreach ($pizzas as $pizza)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('storage/'.$pizza->image) }}" style="width:350px;height:350px;object-fit:cover">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{ route('pizza#detailpage',$pizza->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{ $pizza->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $pizza->price }} kyats</h5><h6 class="text-muted ml-2"></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                            <p class="text-danger text-white fs-5 col-6 offset-3">There is no pizza <i class="fa-solid fa-pizza-slice"></i> </p>
                        @endif
                    </span>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    <!-- Start Customer Section  -->
    <section id="customer" class="py-3 customers">
        <div class="container-fluid">
            <!-- Start title -->
            <div class="row text-center">
                <div class="col">
                    <h3 class="titles text-light">What Customer Say?</h3>
                </div>
            </div>
            <!-- End title -->

            <div class="row">
                <div class="mx-auto col-md-6">
                    <div id="customercarousels" class="carousel slide" data-bs-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-bs-target="#customercarousels" data-bs-slide-to="0"></li>
                            <li data-bs-target="#customercarousels" data-bs-slide-to="1"></li>
                            <li data-bs-target="#customercarousels" data-bs-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">

                            @if (count($feedback) == 3)
                                <!-- Start User One  -->
                            <div class="carousel-item text-center active">
                                <img src="{{ asset('user/images/user1.jpg') }}" width="150px" class="rounded-circle my-5"
                                    alt="user1">
                                <blockquote class="text-light mb-3">
                                        <p>{{ $feedback[0]['message'] }}</p>
                                </blockquote>
                                <h5 class="fw-bold text-light text-uppercase mb-1">{{ $feedback[0]['name'] }}</h5>
                                <ul class="list-inline mb-5">
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                </ul>
                            </div>
                            <!-- End User One  -->

                            <!-- Start User Two  -->
                            <div class="carousel-item text-center">
                                <img src="{{ asset('user/images/user2.jpg') }}" width="150px" class="rounded-circle my-5"
                                    alt="user2">
                                <blockquote class="text-light mb-3">
                                    <p>{{ $feedback[1]['message'] }}</p>
                                </blockquote>
                                <h5 class="fw-bold text-light text-uppercase mb-1">{{ $feedback[1]['name'] }}</h5>
                                <ul class="list-inline mb-5">
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                </ul>
                            </div>
                            <!-- End User Two  -->

                            <!-- Start User Three  -->
                            <div class="carousel-item text-center">
                                <img src="{{ asset('user/images/user3.jpg') }}" width="150px" class="rounded-circle my-5"
                                    alt="user3">
                                <blockquote class="text-light mb-3">
                                    <p>{{ $feedback[2]['message'] }}</p>
                                </blockquote>
                                <h5 class="fw-bold text-light text-uppercase mb-1">{{ $feedback[2]['name'] }}</h5>
                                <ul class="list-inline mb-5">
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                </ul>
                            </div>
                            <!-- End User Three  -->
                            @else
                                <!-- Start User One  -->
                            <div class="carousel-item text-center active">
                                <img src="{{ asset('user/images/user1.jpg') }}" width="150px" class="rounded-circle my-5"
                                    alt="user1">
                                <blockquote class="text-light mb-3">
                                        <p>Good for user1</p>
                                </blockquote>
                                <h5 class="fw-bold text-light text-uppercase mb-1">User 1</h5>
                                <ul class="list-inline mb-5">
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                </ul>
                            </div>
                            <!-- End User One  -->

                            <!-- Start User Two  -->
                            <div class="carousel-item text-center">
                                <img src="{{ asset('user/images/user2.jpg') }}" width="150px" class="rounded-circle my-5"
                                    alt="user2">
                                <blockquote class="text-light mb-3">
                                    <p>Good for user2</p>
                                </blockquote>
                                <h5 class="fw-bold text-light text-uppercase mb-1">User 2</h5>
                                <ul class="list-inline mb-5">
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                </ul>
                            </div>
                            <!-- End User Two  -->

                            <!-- Start User Three  -->
                            <div class="carousel-item text-center">
                                <img src="{{ asset('user/images/user3.jpg') }}" width="150px" class="rounded-circle my-5"
                                    alt="user3">
                                <blockquote class="text-light mb-3">
                                    <p>Good for user3</p>
                                </blockquote>
                                <h5 class="fw-bold text-light text-uppercase mb-1">User 3</h5>
                                <ul class="list-inline mb-5">
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                </ul>
                            </div>
                            <!-- End User Three  -->
                            @endif


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Customer Section  -->

@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('#sortingOption').change(function(){
                $eventOption = $('#sortingOption').val();
                if($eventOption == 'asc'){
                    $.ajax({
                        type: "get",
                        url: "http://localhost:8000/user/ajax/pizza/list",
                        data: { "status" : 'asc' },
                        dataType: "json",
                        success: function (response) {
                           $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('storage/${response[$i].image}') }}" style="width:350px;height:350px;object-fit:cover">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price} kyats</h5><h6 class="text-muted ml-2"></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                                `;
                            }
                            $('#dataList').html($list);
                        }
                    });
                }else if($eventOption == 'desc'){
                    $.ajax({
                        type: "get",
                        url: "/user/ajax/pizza/list",
                        data: { 'status' : 'desc'},
                        dataType: "json",
                        success: function (response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('storage/${response[$i].image}') }}" style="width:350px;height:350px;object-fit:cover">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price} kyats</h5><h6 class="text-muted ml-2"></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                                `;
                            }
                            $('#dataList').html($list);
                        }
                    });
                }
            })
        })
    </script>
@endsection
