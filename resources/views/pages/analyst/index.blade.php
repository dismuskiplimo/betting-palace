@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-sm-12">
            <h4 class="text-warning">Today's Free Picks
                <a href="" data-toggle="modal" data-target="#add-prediction-modal" class="btn btn-warning btn-sm float-right">ADD PREDICTION</a>
                <a href="" data-toggle="modal" data-target="#create-grouping-modal" class="btn btn-warning btn-sm float-right mr-2">CREATE GROUPING</a>
                <a href="" data-toggle="modal" data-target="#send-sms-modal" class="btn btn-warning btn-sm float-right mr-2">SEND SMS</a>
            </h4>

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
                        <th></th>
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
                            <th>
                                <a href="" title="update prediction" class = "text-info" data-toggle="modal" data-target="#update-prediction-modal-{{ $bet->id }}"><i class="fas fa-edit"></i></a>
                                <a href="" title = "delete prediction" class = "text-danger" data-toggle="modal" data-target="#delete-prediction-modal-{{ $bet->id }}"><i class="fas fa-trash"></i></a>


                                @include('pages.analyst.modals.update-prediction')
                                @include('pages.analyst.modals.delete-prediction')
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-sm-12 mt-5">
            
            <h4 class="text-warning">Paid Predictions</h4>

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
                        <th></th>
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
                            <td>
                                <a href="" title="update prediction" class = "text-info" data-toggle="modal" data-target="#update-prediction-modal-{{ $bet->id }}"><i class="fas fa-edit"></i></a>
                                <a href="" title = "delete prediction" class = "text-danger" data-toggle="modal" data-target="#delete-prediction-modal-{{ $bet->id }}"><i class="fas fa-trash"></i></a>


                                @include('pages.analyst.modals.update-prediction')
                                @include('pages.analyst.modals.delete-prediction')
                            </td>
                        </tr>


                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-sm-12 mt-5">
            
            <h4 class="text-warning">Premium hand-picked groupings</h4>

            <hr>

            @php $i = 1;  @endphp

            @foreach($bet_slips as $betslip)
                <h5 class="text-warning">Group {{ $i }}
                    <a href="" title = "delete bet group" class = "text-danger float-right" data-toggle="modal" data-target="#delete-betslip-modal-{{ $betslip->id }}"><i class="fas fa-trash"></i></a>

                    @include('pages.analyst.modals.delete-betslip')
                </h5>
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
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($betslip->bets()->get() as $bet)
                            @php $bet = $bet->bet;  @endphp
                            <tr>
                                <td>{{ $bet->starts_at->toDayDateTimeString() }}</td>
                                <td>{{ $bet->league }}</td>
                                <td>{{ $bet->gameId }}</td>
                                <td>{{ $bet->homeName }}</td>
                                <td>{{ $bet->awayName }}</td>
                                <td>{{ $bet->prediction }}</td>
                                <td>{{ $bet->predictedHomeScore != null && $bet->predictedAwayScore != null ? $bet->predictedHomeScore . ' - ' . $bet->predictedAwayScore : '-' }}</td>
                                <td>
                                    <a href="" title="update prediction" class = "text-info" data-toggle="modal" data-target="#update-prediction-modal-{{ $bet->id }}"><i class="fas fa-edit"></i></a>
                                    <a href="" title = "delete prediction" class = "text-danger" data-toggle="modal" data-target="#delete-prediction-modal-{{ $bet->id }}"><i class="fas fa-trash"></i></a>


                                    @include('pages.analyst.modals.update-prediction')
                                    @include('pages.analyst.modals.delete-prediction')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                
                </table>
            @endforeach
        </div>
    </div>
</div>

@include('pages.analyst.modals.add-prediction')
@include('pages.analyst.modals.create-grouping')
@include('pages.analyst.modals.send-sms')
@endsection