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
                                <h2 class="title-1">User List</h2>
                            </div>
                        </div>
                    </div>
                    @if (session('deleteMessage'))
                    <div class="col-6 offset-6">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('deleteMessage') }}</strong>
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
                        <form action="{{ route('userlist#page') }}" method="get">
                            <div class="d-flex">
                                <input type="text" name="dataSearch" id="" class="form-control" placeholder="Search...." value="{{ request('dataSearch') }}">
                                 <button type="submit" class="btn btn-dark text-uppercase" style="font-size: 13px"><i class="fa-solid fa-magnifying-glass me-1"></i>Search</button>
                            </div>
                        </form>
                    </div>
                    </div>

                    <div class="row">
                        <h4 class="text-danger"> <i class="fa-solid fa-database"></i> Total - {{ $userLists->total() }} </h4>
                    </div>

                    @if (count($userLists) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Gender</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userLists as $userList)
                                <tr class="spacer">
                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if($userList->image != null)
                                                <img src="{{ asset('storage/'.$userList->image) }}" class="img-thumbnail shadow-sm" style="height:100px;width:100px;object-fit:cover"/>
                                            @else
                                            @if ($userList->gender == 'male')
                                            <img src="{{ asset('image/defaultimg.jpeg') }}" class="img-thumbnail shadow-sm" style="height:100px;width:100px;object-fit:cover"/>
                                            @else
                                            <img src="{{ asset('image/female.jpeg') }}" class="img-thumbnail shadow-sm" style="height:100px;width:100px;object-fit:cover"/>
                                            @endif
                                            @endif
                                        </td>
                                        <input type="hidden" class="userID" value="{{ $userList->id }}">
                                        <td class="text-center">{{ $userList->name }}</td>
                                        <td class="text-center">{{ $userList->email}}</td>
                                        <td class="text-center">{{ $userList->phone}}</td>
                                        <td class="text-center">{{ $userList->address}}</td>
                                        <td class="text-center">{{ $userList->gender}}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <select class="form-control roleChange me-3">
                                                    <option value="admin" @if($userList->role == 'admin') selected @endif>Admin</option>
                                                    <option value="user" @if($userList->role == 'user') selected @endif>User</option>
                                                </select>
                                                <a href="{{ route('userlist#userDeleteFromAdmin',$userList->id)  }}">
                                                    <button title="Delete">
                                                        <i class="fa-solid fa-trash-can fs-5"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $userLists->appends(request()->query())->links() }}
                        </div>
                    </div>
                    @else
                    <h1 class="text-secondary text-center mt-5">There is no account here!</h1>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('.roleChange').change(function(){
                $currentRole = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userID').val();

                $data = {
                    'role' : $currentRole,
                    'userId' : $userId,
                };
                $.ajax({
                    type: "get",
                    url: "/ajax/role/userchange",
                    data: $data,
                    dataType: "json",
                });
                location.reload();
            });
        });
    </script>
@endsection
