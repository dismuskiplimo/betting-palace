@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-3">@include('pages.admin.includes.sidebar')</div>
            <div class="col-sm-9">
                <h4 class="text-warning mb-3">{{ $title }}
                    
                </h4>

                <table class="table table-dark table-striped table-hover" style="font-size:.7rem">
                    <thead>
                        <tr class="text-warning">
                            <th>Date</th>
                            <th>Receipt</th>
                            <th>MPESA No.</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>User</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->TransactionDate->toDayDateTimeString() }}</td>
                                <td>{{ $transaction->MpesaReceiptNumber }}</td>
                                <td>{{ $transaction->PhoneNumber }}</td>
                                <td>KES {{ number_format($transaction->Amount) }}/=</td>
                                <td>{{ $transaction->description }}</td>
                                <td>{{ $transaction->user->name }}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $transactions->links() }}
            </div>
        </div>
    </div>
@endsection