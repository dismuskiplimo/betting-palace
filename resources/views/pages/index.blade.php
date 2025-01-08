@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-sm-12">
                <h4 class="text-center text-warning mb-4">TODAY'S FREE TIPS</h4>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr class="text-warning">
                            <th>Time</th>
                            <th>League</th>
                            <th>GameId</th>
                            <th>Home</th>
                            <th>Away</th>
                            <th>Prediction (Tip)</th>
                            <th>Predicted Score</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(count($bets))
                            @foreach ($bets as $bet)
                                <tr>
                                    <td>{{ $bet->starts_at->toDayDateTimeString() }}</td>
                                    <td>{{ $bet->league }}</td>
                                    <td>{{ $bet->gameId }}</td>
                                    <td>{{ $bet->homeName }}</td>
                                    <td>{{ $bet->awayName }}</td>
                                    <td>{{ $bet->prediction }}</td>
                                    <td>{{ $bet->predictedHomeScore != null && $bet->predictedAwayScore != null ? $bet->predictedHomeScore . ' - ' . $bet->predictedAwayScore : '-' }}</td>
                                </tr>
                            @endforeach
                        @else
                                <tr>
                                    <td colspan="7" class="text-center"><span class="text-light">Free tips will be updated shortly</span></td>
                                </tr>
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-sm-12 mb-5">
                <h3 class="text-center text-warning">SUSBSCRIBE NOW TO GET PREMIUM VIP TIPS </h3>
            </div>
            
            @php $stars = 1; @endphp
            @foreach($subscription_types as $subscription_type)
                <div class="col-sm-4">
                    <div class="card bg-dark border-warning">
                        <div class="card-body text-center text-light">
                            <p style="font-size: 2.5rem">
                                @for($i = 0; $i < $stars; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor

                                @php $stars += 1; @endphp
                            </p>
                            <h1 class="text-warning">{{ $subscription_type->subscription_type }}</h1>
                            <hr>
                            <h2>{{ $subscription_type->no_of_days }} DAYS</h2>
                            <hr>
                            <h4>KES {{ number_format($subscription_type->price) }}/=</h4>
                            <p class="mt-5">
                                <a href="" class="btn btn-warning btn-lg">SUBSCRIBE</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row my-5">
            <div class="col-12">
                <h4 class="text-center text-warning mb-4">BLOG</h4>

                <div class="row">
                    {{-- {!! getFeed("https://betstarskenya.com/blog/feed/") !!} --}}
                </div>
            </div>
        </div>
    </div>

    @if(auth()->check() && auth()->user()->is_standard_user())
        @include('pages.standard-user.modals.make-subscription')
        @include('pages.standard-user.modals.make-sms-subscription')
    @endif
@endsection