@extends('admin.layouts.master');
@section('title','Category List');
@section('myContent')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 offset-10">
                        <a href="{{ route('list#page') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
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
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Account Info</h3>
                            </div>

                            <div class="row mt-4">
                                <div class="col-7">
                                    @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender == 'male')
                                        <img src="{{ asset('image/defaultimg.jpeg') }}" class="img-thumbnail shadow-sm" style="width:600px;height:500pxx;object-fit:cover"/>
                                    @else
                                        <img src="{{ asset('image/female.jpeg') }}" class="img-thumbnail shadow-sm" style="width:600px;height:500px;object-fit:cover"/>
                                    @endif
                                    @else
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="John Doe" style="width:600px;height:500px;object-fit:cover" />
                                    @endif
                                </div>
                                <div class="col-5">
                                    <p class="text-muted mb-1">Hello I'm </p>
                                    <h1 class="text-danger text-uppercase fs-2 fw-bold">{{ Auth::user()->name }}</h1>
                                    <p class="text-muted mt-4">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                                        been the industry's standard dummy text ever since the 1500s.
                                    </p>
                                    <div>
                                        <h5 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;margin-left:10px;margin-top:30px"> <i class="fa-solid fa-envelope me-3"></i> {{ Auth::user()->email }}</h5>
                                        <h5 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;margin-left:10px;margin-top:20px"> <i class="fa-solid fa-phone me-3"></i> {{ Auth::user()->phone }}</h5>
                                        <h5 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;margin-left:10px;margin-top:20px"><i class="fa-solid fa-mars-and-venus me-3"></i> {{ Auth::user()->gender }}</h5>
                                        <h5 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;margin-left:10px;margin-top:20px"><i class="fa-solid fa-map-location-dot me-3"></i> {{ Auth::user()->address }}</h5>
                                        <h5 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;margin-left:10px;margin-top:20px"><i class="fa-solid fa-calendar-days me-3"></i> {{ Auth::user()->created_at->format('j-F-Y') }}</h5>
                                    </div>
                                    <div class="row ms-4 mt-5">
                                        <div class="col-4 offset-2 mt-3">
                                            <a href="{{ route('admin#accountedit') }}">
                                                <button type="submit" class="btn btn-dark text-white"> <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile </button>
                                            </a>
                                        </div>
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
