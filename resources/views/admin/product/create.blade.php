@extends('admin.layouts.master');
@section('title','Category List');
@section('myContent')

    <<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">Pizza List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Your Pizza</h3>
                            </div>
                            <form action="{{ route('product#create') }}" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input name="pizzaName" type="text" value="{{ old('pizzaName') }}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name....">
                                    @error('pizzaName')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Category</label>
                                    <select class="form-control  @error('pizzaCategory') is-invalid @enderror" name="pizzaCategory">
                                        <option value="">Choose your category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pizzaCategory')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Description</label>
                                    <textarea class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Pizza Description...." name="pizzaDescription">{{ old('pizzaDescription') }}</textarea>
                                    @error('pizzaDescription')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                    <input name="pizzaImage" type="file"  class="form-control @error('pizzaImage') is-invalid @enderror" aria-required="true" aria-invalid="false"">
                                    @error('pizzaImage')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                    <input name="pizzaWaitingTime" value="{{ old('pizzaWaitingTime') }}" type="number"  class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false"">
                                    @error('pizzaWaitingTime')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="pizzaPrice" type="number" value="{{ old('categoryName') }}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price....">
                                    @error('pizzaPrice')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
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
