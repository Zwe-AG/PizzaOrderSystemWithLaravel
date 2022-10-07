@extends('admin.layouts.master');
@section('title','Category List');
@section('myContent')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                @if (session('updateSuccess'))
                <div class="col-6 offset-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('updateSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                <div class="col-lg-10 offset-1">

                  <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fa-solid fa-arrow-left text-dark" style="font-size:23px" onclick="history.back()"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Pizza Info</h3>
                            </div>

                            <div class="row mt-4">
                                <div class="col-7">
                                    <img src="{{ asset('storage/'.$pizza->image) }}" alt="John Doe" style="width:600px;height:500px;object-fit:cover" />
                                </div>
                                <div class="col-5">
                                    <p class="text-muted mb-1">Hello This is</p>
                                    <h1 class="text-danger text-uppercase fs-2 fw-bold">{{ $pizza->name }}</h1>
                                    <p class="text-muted mt-4">
                                        {{ $pizza->name }} is a dish of Italian origin consisting of a usually round, flat base of leavened wheat-based dough topped with tomatoes, cheese, and often various other ingredients, which is then baked at a high temperature, traditionally in a wood-fired oven.
                                    </p>
                                    <div>
                                        <h5 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;margin-left:10px;margin-top:20px" class="btn btn-dark text-white"> <i class="fa-solid fa-money-check-dollar me-1"></i> {{ $pizza->price }}</h5>
                                        <h5 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;margin-left:10px;margin-top:20px" class="btn btn-dark text-white"> <i class="fa-solid fa-clock me-1"></i> {{ $pizza->waiting_time }}</h5>
                                        <h5 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;margin-left:10px;margin-top:20px" class="btn btn-dark text-white"><i class="fa-solid fa-eye me-1"></i> {{ $pizza->view_count }}</h5>
                                        <h5 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;margin-left:10px;margin-top:20px" class="btn btn-dark text-white"><i class="fa-solid fa-hashtag me-1"></i> {{ $pizza->category_name }}</h5>
                                        <h5 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;margin-left:10px;margin-top:20px"><i class="fa-solid fa-calendar-days me-3"></i> {{ $pizza->created_at->format('j-F-Y') }}</h5>
                                        <h5 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;margin-left:10px;margin-top:20px;text-align:initial"><i class="fa-solid fa-file-lines me-3"></i> Detail</h5>
                                        <div class="ms-5">{{ Str::words($pizza->description, 10 , '...') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
