@extends('admin.layouts.master');
@section('title','Category List');
@section('myContent')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">

                  <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <a href="{{ route('admin#list') }}"><i class="fa-solid fa-arrow-left fs-4 text-dark"></i></a>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Change Role</h3>
                            </div>
                            <form action="{{ route('admin#change',$account->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-4">
                                    <div class="col-4 offset-1">
                                        @if ($account->image == null)
                                        @if ($account->gender == 'male')
                                            <img src="{{ asset('image/defaultimg.jpeg') }}" class="img-thumbnail shadow-sm"/>
                                        @else
                                            <img src="{{ asset('image/female.jpeg') }}" class="img-thumbnail shadow-sm"/>
                                        @endif
                                        @else
                                        <img src="{{ asset('storage/'.$account->image) }}" class="img-thumbnail shadow-sm"/>
                                        @endif
                                    </div>
                                    <div class="row col-6">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input name="name" type="text" class="form-control" value="{{ old('name',$account->name) }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if($account->role == "admin") selected @endif>Admin</option>
                                                <option value="user" @if($account->role == "user") selected @endif> User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input name="email" type="text" value="{{ old('email',$account->email) }}"  class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input name="phone" type="number" value="{{ old('phone',$account->phone) }}"  class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control" disabled>
                                                <option value="">Choose Gender</option>
                                                <option value="male" @if($account->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if($account->gender == 'female') selected @endif>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control"  cols="30" rows="10" disabled>{{ old('address',$account->address) }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-dark text-white form-control py-2"> <i class="fa-solid fa-pen-to-square me-2"></i> Change </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
