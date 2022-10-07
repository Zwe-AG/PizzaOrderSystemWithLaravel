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
                                <a href="{{ route('product#list') }}"><i class="fa-solid fa-arrow-left fs-3 text-dark"></i></a>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Update Pizza</h3>
                            </div>

                            <form action="{{ route('product#update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-4">
                                    <div class="col-4 offset-1">
                                        <input type="hidden" name="pizzaID" value="{{ old('pizzaID',$pizza->id) }}">
                                        <img src="{{ asset('storage/'.$pizza->image) }}" alt="John Doe" class="img-thumbnail shadow-sm"/>
                                        <div class="mt-2">
                                            <input type="file" name="pizzaImage" id="" class="form-control @error('pizzaImage') is-invalid @enderror">
                                        </div>
                                        @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                    </div>
                                    <div class="row col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text" value="{{ old('pizzaName',$pizza->name) }}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name">
                                            @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror"  cols="30" rows="10" placeholder="Enter Pizza Description">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input name="pizzaPrice" type="number" value="{{ old('pizzaPrice',$pizza->price) }}"  class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price">
                                            @error('pizzaPrice')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input name="pizzaWaitingTime" type="number" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}"  class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time">
                                            @error('pizzaWaitingTime')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose Category</option>
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}" @if($pizza->category_id == $item->id) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">View Count</label>
                                            <input name="viewCount" type="number" value="{{ old('phone',$pizza->view_count) }}"  class="form-control" aria-required="true" aria-invalid="false" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Create Date</label>
                                            <input name="createDate" type="text" value="{{ old('createDate',$pizza->created_at->format('j/F/Y  h:i:s')) }}" class="form-control" aria-required="true" aria-invalid="false" disabled>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-dark text-white form-control py-2"> <i class="fa-solid fa-pen-to-square me-2"></i> Update Profile </button>
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
