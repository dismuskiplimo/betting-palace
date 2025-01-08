@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-sm-12">
                <h4 class="text-warning">Today's Free Picks</h4>

                <hr>

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
                        @foreach ($free_bets as $bet)
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
                    </tbody>
                </table>
            </div>

            <div class="col-sm-12 mt-5">
                
                <h4 class="text-warning">Paid Predictions</h4>

                <hr>

                @if($user->subscription_active())
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
                            @foreach ($paid_bets as $bet)
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
                        </tbody>
                    </table>
                @else
                    <p>Subscribe to view premium bets</p>
                    <a class="btn btn-warning" data-toggle="modal" data-target="#make-subscription-modal" href="">Subscribe Now</a>
                @endif
            </div>

            <div class="col-sm-12 mt-5">
                
                <h4 class="text-warning">Premium hand-picked groupings</h4>

                <hr>

                @if($user->subscription_active())
                    @php $i = 1;  @endphp

                    @foreach($bet_slips as $betslip)


                        <h5 class="text-warning">Group {{ $i }}</h5>
                        @php $i += 1;  @endphp
                
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
                                @foreach ($betslip->bets()->get() as $bet)
                                    <tr>
                                        <td>{{ $bet->bet->starts_at->toDayDateTimeString() }}</td>
                                        <td>{{ $bet->bet->league }}</td>
                                        <td>{{ $bet->bet->gameId }}</td>
                                        <td>{{ $bet->bet->homeName }}</td>
                                        <td>{{ $bet->bet->awayName }}</td>
                                        <td>{{ $bet->bet->prediction }}</td>
                                        <td>{{ $bet->bet->predictedHomeScore != null && $bet->bet->predictedAwayScore != null ? $bet->bet->predictedHomeScore . ' - ' . $bet->bet->predictedAwayScore : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        
                        </table>

                    @endforeach
                @else
                    <p>Subscribe to view premium hand-picked groupings</p>
                    
                @endif
            </div>
        </div>
    </div>
    @include('pages.standard-user.modals.make-subscription')
    @include('pages.standard-user.modals.make-sms-subscription')
@endsection