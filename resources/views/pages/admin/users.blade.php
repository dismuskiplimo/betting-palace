@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-3">@include('pages.admin.includes.sidebar')</div>
            <div class="col-sm-9">
                <div class="btn-group mb-3 btn-group-justify" role="group" aria-label="">
                    <a href="{{ route('admin.users', ['category' => 'all']) }}" class="btn btn-sm btn-outline-warning{{ $category == 'all' ? ' active' : '' }}">All Users</a>
                    <a href="{{ route('admin.users', ['category' => 'active']) }}" class="btn btn-sm btn-outline-warning{{ $category == 'active' ? ' active' : '' }}">Subscribed to tips</a>
                    <a href="{{ route('admin.users', ['category' => 'inactive']) }}" class="btn btn-sm btn-outline-warning{{ $category == 'inactive' ? ' active' : '' }}">Not Subscribed to tips</a>
                    <a href="{{ route('admin.users', ['category' => 'active-sms']) }}" class="btn btn-sm btn-outline-warning{{ $category == 'active-sms' ? ' active' : '' }}">Subscribed to SMS</a>
                    <a href="{{ route('admin.users', ['category' => 'inactive-sms']) }}" class="btn btn-sm btn-outline-warning"{{ $category == 'inactive-sms' ? ' active' : '' }}>Not Subscribed to SMS</a>
                    <a href="{{ route('admin.users', ['category' => 'analyst']) }}" class="btn btn-sm btn-outline-warning{{ $category == 'analyst' ? ' active' : '' }}">Analysts</a>
                    <a href="{{ route('admin.users', ['category' => 'admin']) }}" class="btn btn-sm btn-outline-warning{{ $category == 'admin' ? ' active' : '' }}">Admins</a>
                </div>
                
                <h4 class="text-warning mb-3">{{ $title }}
                    <a href="" data-toggle="modal" data-target="#add-user-modal" class="btn btn-warning btn-sm float-right">Add User</a>
                </h4>

                <table class="table table-dark table-striped" style="font-size:.7rem">
                    <thead>
                        <tr class="text-warning">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>User Type</th>
                            <th>Bet Subscription</th>
                            <th>Bet Subscription Expires</th>
                            <th>SMS Subscription</th>
                            <th>SMS Subscription Expires</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->user_type }}</td>
                                <td>{{ !is_null($user->subscription_expires_at) && $user->subscription_expires_at->gt($now) ? "PREMIUM" : "FREE" }}</td>
                                <td>{{ !is_null($user->subscription_expires_at) && $user->subscription_expires_at->gt($now) ? $user->subscription_expires_at->toDayDateTimeString() : "" }}</td>
                                <td>{{ !is_null($user->sms_subscription_expires_at) && $user->sms_subscription_expires_at->gt($now) ? "SUBSCRIBED" : "" }}</td>
                                <td>{{ !is_null($user->sms_subscription_expires_at) && $user->sms_subscription_expires_at->gt($now) ? $user->sms_subscription_expires_at->toDayDateTimeString() : "" }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </div>

    @include('pages.admin.modals.add-user')
@endsection