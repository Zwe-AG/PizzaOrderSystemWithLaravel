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
                                <h2 class="title-1">Category List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createpage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add category
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
                        <form action="{{ route('list#page') }}" method="get">
                            <div class="d-flex">
                                <input type="text" name="dataSearch" id="" class="form-control" placeholder="Search...." value="{{ request('dataSearch') }}">
                                 <button type="submit" class="btn btn-dark text-uppercase" style="font-size: 13px"><i class="fa-solid fa-magnifying-glass me-1"></i>Search</button>
                            </div>
                        </form>
                    </div>
                    </div>
                    <div class="row">
                        <h4 class="text-danger"> <i class="fa-solid fa-database"></i> Total - {{ $categories->total() }}</h4>
                    </div>
                    @if (count($categories) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Category Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr class="spacer">
                                    <tr class="tr-shadow">
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('category#edit',$category->id) }}">
                                                    <button class="item mr-3" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('category#delete',$category->id) }}">
                                                    <button class="item mr-3" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="zmdi zmdi-more"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $categories->links() }}
                        </div>
                    </div>
                    @else
                    <h1 class="text-secondary text-center mt-5">There is no category here!</h1>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection




