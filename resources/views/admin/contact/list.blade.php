@extends('admin.layouts.master')
@section('title','Category List')
@section('myContent')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    @if (session('deleteMessage'))
                    <div class="col-6 offset-6">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('deleteMessage') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif
                    <div class="row">
                        <h4 class="text-primary"> <i class="fa-solid fa-comment-sms fs-2"></i> Total - {{ $contacts->total() }}</h4>
                    </div>
                    @if (count($contacts) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                <tr class="spacer">
                                    <tr class="tr-shadow">
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ Str::words($contact->message, 2, '...') }}</td>
                                        <td>{{ $contact->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('contact#detail',$contact->id) }}">
                                                    <button class="mt-2 mr-3" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-regular fa-eye fs-5"></i>
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
                            {{ $contacts->links() }}
                        </div>
                    </div>
                    @else
                    <h1 class="text-secondary text-center mt-5">There is no contact here!</h1>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection




