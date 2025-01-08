@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-sm-8 offset-sm-2">
                <h4 class="text-warning mb-5">{{ $title }}</h4>

                <h5>Current Subscription</h5>

                @if($user->subscription_active())
                    <p>Subscription Type: {{ $user->subscription()->subscription_details }}</p>
                    <p>Active Until: {{ $user->subscription()->ends_at->toDayDateTimeString() }}</p>
                    <p>Amount Paid: KES {{ number_format($user->subscription()->mpesa_amount)  }}/=</p>
                @else
                    <p>Free Subscription (You are only able to view free tips)</p>
                    <p>
                        <a class="btn btn-sm btn-outline-warning" href="" data-toggle="modal" data-target="#make-subscription-modal">SUBSCRIBE NOW</a>
                    </p>
                @endif

                <hr style="border-color: aliceblue">

                <h5>SMS Notifications</h5>

                @if($user->subscription_active())
                    @if($user->sms_subscription_active())
                        <p>Description: {{ $user->sms_subscription()->subscription_details }}</p>
                        <p>Active Until: {{ $user->sms_subscription()->ends_at->toDayDateTimeString() }}</p>
                        <p>Amount Paid: KES {{ number_format($user->sms_subscription()->mpesa_amount) }}/=</p>
                    @else
                    <a class="btn btn-sm btn-outline-warning" href="" data-toggle="modal" data-target="#make-sms-subscription-modal">SUBSCRIBE TO SMS</a>
                    @endif
                    
                @else
                    <p>First subscribe to premium before you can enable SMS notifications</p>
                @endif

                

            </div>
        </div>
    </div>
    @include('pages.standard-user.modals.make-subscription')
    @include('pages.standard-user.modals.make-sms-subscription')
@endsection