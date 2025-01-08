@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-sm-12">
                <h4 class="text-warning">{{ $title }}</h4>

                <hr>

                <table class="table table-dark table-striped">
                    <thead>
                        <tr class="text-warning">
                            <th>Time</th>
                            <th>League</th>
                            <th>GameId</th>
                            <th>Home</th>
                            <th>Away</th>
                            <th>Predicted Score</th>
                            <th>Actual Score</th>
                            <th>Prediction (Tip)</th>
                            <th>Bet Status</th>
                            <th></th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($bets as $bet)
                            <tr {!! $bet->status == 1 ? ' class="bg-success"' : ' class="bg-danger"' !!}>
                                <td>{{ $bet->starts_at->toDayDateTimeString() }}</td>
                                <td>{{ $bet->league }}</td>
                                <td>{{ $bet->gameId }}</td>
                                <td>{{ $bet->homeName }}</td>
                                <td>{{ $bet->awayName }}</td>
                                <td>{{ $bet->predictedHomeScore ? : '' . ' - ' . $bet->predictedAwayScore? : ''}}</td>
                                <td>{{ $bet->homeScore .' - '. $bet->awayScore}}</td>
                                <td>{{ $bet->prediction }}</td>
                                <td>{!! $bet->status == 1 ? 'WON' : 'LOST' !!}</td>
                                <td>{!! $bet->free ? '<span class="text-muted">FREE</span>' : '<span class="text-warning"><i class = "fas fa-star"></i> PREMIUM</span>' !!}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $bets->links() }}
            </div>
        </div>
    </div>
    @include('pages.standard-user.modals.make-subscription')
    @include('pages.standard-user.modals.make-sms-subscription')
@endsection