@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-3">@include('pages.admin.includes.sidebar')</div>
            <div class="col-sm-9">
                <h4 class="text-warning mb-3">{{ $title }}
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <a href="{{ route('admin.subscriptions', ['category' => 'all']) }}" class="btn btn-sm btn-outline-warning{{ $category == 'all' ? ' active' : '' }}">All</a>
                        <a href="{{ route('admin.subscriptions', ['category' => 'active']) }}" class="btn btn-sm btn-outline-warning{{ $category == 'active' ? ' active' : '' }}">Active</a>
                        <a href="{{ route('admin.subscriptions', ['category' => 'expired']) }}" class="btn btn-sm btn-outline-warning{{ $category == 'expired' ? ' active' : '' }}">Expired</a>
                    </div>
                </h4>

                <table class="table table-dark table-striped table-hover" style="font-size:.7rem">
                    <thead>
                        <tr class="text-warning">
                            <th>Start</th>
                            <th>End</th>
                            <th>User</th>
                            <th>Details</th>
                            <th>MPESA Number</th>
                            <th>Amount</th>
                            <th>Transaction Code</th>
                            <th>Paid</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($subscriptions as $subscription)
                            <tr>
                                <td>{{ $subscription->starts_at->toDayDateTimeString() }}</td>
                                <td>{{ $subscription->ends_at->toDayDateTimeString() }}</td>
                                <td>{{ $subscription->user->name }}</td>
                                <td>{{ $subscription->subscription_details }}</td>
                                <td>{{ $subscription->mpesa_number }}</td>
                                <td>KES {{ number_format($subscription->mpesa_amount) }}/=</td>
                                <td>{{ $subscription->mpesa_trx_code }}</td>
                                <td>{{ $subscription->completed_at->toDayDateTimeString() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $subscriptions->links() }}
            </div>
        </div>
    </div>
@endsection