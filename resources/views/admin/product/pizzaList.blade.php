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
                                <h2 class="title-1">Pizza List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createpage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
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
                        <form action="{{ route('product#list') }}" method="get">
                            <div class="d-flex">
                                <input type="text" name="dataSearch" id="" class="form-control" placeholder="Search...." value="{{ request('dataSearch') }}">
                                 <button type="submit" class="btn btn-dark text-uppercase" style="font-size: 13px"><i class="fa-solid fa-magnifying-glass me-1"></i>Search</button>
                            </div>
                        </form>
                    </div>
                    </div>
                    <div class="row">
                        <h4 class="text-danger"> <i class="fa-solid fa-database"></i> Total - {{ $pizzas->total() }}</h4>
                    </div>
                   @if (count($pizzas) != 0)
                       <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Product Price</th>
                                    <th class="text-center">Category ID</th>
                                    <th class="text-center">View Count</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pizzas as $pizza)
                                <tr class="spacer">
                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            <img src="{{ asset('storage/'.$pizza->image) }}" class="img-thumbnail shadow-sm" style="height:100px"/>
                                        </td>
                                        <td class="text-center">{{ $pizza->name }}</td>
                                        <td class="text-center">{{ $pizza->price}}</td>
                                        <td class="text-center">{{ $pizza->category_name}}</td>
                                        <td class="text-center"><i class="fa-solid fa-eye me-2"></i> {{ $pizza->view_count}}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('product#edit',$pizza->id) }}">
                                                    <button class="mt-2 mr-3" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-regular fa-eye fs-5"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#delete',$pizza->id) }}">
                                                    <button class="mt-2 mr-3" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa-solid fa-trash-can fs-5"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#updatepage',$pizza->id) }}">
                                                    <button class="mt-2 mr-3">
                                                        <i class="fa-solid fa-pen-to-square fs-5"></i>
                                                    </button>
                                                </a>
                                                <button class="mt-2 mr-3" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="fa-solid fa-ellipsis fs-5"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pizzas->links() }}
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
