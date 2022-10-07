@extends('admin.layouts.master');
@section('title','Contact List');
@section('myContent')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card" style="width: 600px;">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fa-solid fa-arrow-left text-dark" style="font-size:23px;margin-right:180px" onclick="history.back()"></i>
                                <span class="fs-5">Feedback Our Service</span>
                            </div>
                        </div>
                        <div style="height: 200px;object-fit:cover;background-color: #0093E9;background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 50%, #ffffff 100%);">
                             <img src="https://cdn-icons-png.flaticon.com/128/2343/2343697.png" style="width:14%;transform:translate(300%,80%)">
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">Message</h5>
                          <p class="card-text">{{ Str::words($details->message, 20 , '...') }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">Name - {{ $details->name }}</li>
                          <li class="list-group-item">Email - {{ $details->email }}</li>
                          <li class="list-group-item">Date - {{ $details->created_at->format('j/F/Y') }}</li>
                        </ul>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
