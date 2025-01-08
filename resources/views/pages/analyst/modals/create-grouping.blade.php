<div class="modal fade" id="create-grouping-modal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered text-dark" role ="document">
      <div class="modal-content">
        <form action="{{ route('analyst.betslip.add') }}" method="POST">
          @csrf
          
          <div class="modal-header">
            <h5 class="modal-title">Create Grouping</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <p>Select games to group</p>
                @foreach($active_bets as $bet)
                  
                          
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="{{ $bet->id }}" name="bets[]" id="defaultCheck{{ $bet->id }}">
                      <label class="form-check-label" for="defaultCheck{{ $bet->id }}">
                        {{ $bet->homeName }} - {{ $bet->awayName }} - ({{ $bet->league }}) {{ $bet->gameId }} -  {{ $bet->starts_at->toDayDateTimeString() }} - (Tip: {{ $bet->prediction }}) {{ !is_null($bet->predictedHomeScore) && !is_null($bet->predictedAwayScore) ? ' (CS: ' . $bet->predictedHomeScore . ' - ' . $bet->predictedAwayScore . ')' : '' }}
                      </label>
                    </div>

                    <hr>
               
                @endforeach
              </div>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-success">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>