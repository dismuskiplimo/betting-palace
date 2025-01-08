@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-3">@include('pages.admin.includes.sidebar')</div>
            <div class="col-sm-9">
                <h4 class="text-warning mb-3">{{ $title }}
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <a href="{{ route('admin.bet-groups', ['category' => 'all']) }}" class="btn btn-sm btn-outline-warning{{ $category == 'all' ? ' active' : '' }}">All</a>
                        <a href="{{ route('admin.bet-groups', ['category' => 'active']) }}" class="btn btn-sm btn-outline-warning{{ $category == 'active' ? ' active' : '' }}">Active</a>
                        <a href="{{ route('admin.bet-groups', ['category' => 'finished']) }}" class="btn btn-sm btn-outline-warning{{ $category == 'finished' ? ' active' : '' }}">Finished</a>
                    </div>
                </h4>

                @if($bet_slips->count())

                    @php $i = 1;  @endphp

                    @foreach($bet_slips as $betslip)
                        <h5 class="text-warning">Group {{ $i }}</h5>
                        @php $i += 1;  @endphp
                
                        <table class="table table-dark table-striped" style="font-size:.7rem">
                            <thead>
                                <tr class="text-warning">
                                    <th>Time</th>
                                    <th>League</th>
                                    <th>GameId</th>
                                    <th>Home</th>
                                    <th>Away</th>
                                    <th>Prediction (Tip)</th>
                                    <th>Predicted Score</th>
                                    <th>Result</th>
                                    <th>Price</th>
                                    <th>Added By</th>
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
                                            @if($bet->status == -1)
                                                <span class="text-danger">LOST({{ $bet->homeScore . '-' . $bet->awayScore }})</span>
                                            @elseif($bet->status == 0)
                                                <span class="text-muted">PENDING</span>
                                            @else
                                            <span class="text-success">WON({{ $bet->homeScore . '-' . $bet->awayScore }})</span>
                                            @endif
                                        </td>
        
                                        <td>{!! $bet->free ? '<span class="text-muted">FREE</span>' : '<span class="text-warning">PREMIUM</span>' !!}</td>
                                        <td>{{ $bet->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        
                        </table>
                    @endforeach

                    {{ $bet_slips->links() }}

                @else
                    <p>Nothing here</p>
                @endif
            </div>
        </div>
    </div>
@endsection