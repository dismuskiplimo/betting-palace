<div class="modal fade" id="update-prediction-modal-{{ $bet->id }}" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered text-dark" role ="document">
      <div class="modal-content">
        <form action="{{ route('analyst.bet.update', ['id' => $bet->id]) }}" method="POST">
          @csrf
          
          <div class="modal-header">
            <h5 class="modal-title">Update Prediction</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="">League<span class="text-danger">*</span></label>
                      <input type="text" name="league" value ="{{ $bet->league }}" id="" placeholder="league" class="form-control" required = "">
                  </div>
              </div>

              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="">Game ID<span class="text-danger">*</span></label>
                      <input type="number" min="1" value ="{{ $bet->gameId }}" name="gameId" class="form-control" required="" id="" placeholder="game id">
                  </div>
              </div>

              
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Pricing<span class="text-danger">*</span></label>
                    <select name="free" id="" class="form-control" required="">
                      <option value="0"{{ !$bet->free ? " selected" : "" }}>PAID BET</option>
                      <option value="1"{{ $bet->free ? " selected" : "" }}>FREE BET</option>
                    </select>
                </div>
              </div>

              <div class="col-sm-6">
                  <div class="form-group">
                    <label for="">Starts at (date hour:min)<span class="text-danger">*</span></label>
                    <div class="row">
                      <div class="col-6">
                        <input type="text" name="starts_at" value="{{ $bet->starts_at ? $bet->starts_at->format('Y-m-d') : "" }}" class="form-control datepicker" required="" id="" placeholder="date">
                      </div>

                      <div class="col-3">
                        <select name="hour" id="" class="form-control" required="">
                          @for($i = 0; $i < 24; $i++)
                            <option {{  $bet->starts_at->format('H') == $i ? "selected" : "" }} value="{{ $i < 10 ? '0' . $i : $i }}">{{ $i < 10 ? '0' . $i : $i }}</option>
                          @endfor
                        </select>
                      </div>

                      <div class="col-3">
                        <select name="minute" id="" class="form-control" required="">
                          @for($i = 0; $i<=60; $i++)
                            <option {{  $bet->starts_at->format('i') == $i ? "selected" : "" }} value="{{ $i < 10 ? '0' . $i : $i }}">{{ $i < 10 ? '0' . $i : $i }}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                    
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="">Home Team<span class="text-danger">*</span></label>
                      <input type="text" value = "{{ $bet->homeName }}" name="homeName" class="form-control" required="" id="" placeholder="home team">
                  </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Away Team<span class="text-danger">*</span></label>
                    <input type="text"  value = "{{ $bet->awayName }}" name="awayName" class="form-control" required="" id="" placeholder="away team">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                  <div class="form-group">
                      <label for="">Prediction<span class="text-danger">*</span></label>
                      <input type="text" name="prediction" value = "{{ $bet->prediction }}" id="" placeholder="prediction" class="form-control" required = "">
                  </div>
              </div>

              <div class="col-sm-4">
                  <div class="form-group">
                      <label for="">Predicted Home Score (optional)</label>
                      <input type="number" min="0" name="predictedHomeScore" value = "{{ $bet->predictedHomeScore }}" class="form-control"  id="" placeholder="score">
                  </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Predicted Away Score (optional)</label>
                    <input type="number" min="0" name="predictedAwayScore" value = "{{ $bet->predictedAwayScore }}" class="form-control"  id="" placeholder="score">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                  <div class="form-group">
                      <label for="">Status<span class="text-danger">*</span></label>
                      <select name="status" class="form-control" id="" required="">
                        <option value="-1" {{ $bet->status == '-1' ? 'selected' : '' }}>LOST</option>
                        <option value="0" {{ $bet->status == '0' ? 'selected' : '' }}>PENDING</option>
                        <option value="1" {{ $bet->status == '1' ? 'selected' : '' }}>WON</option>
                      </select>
                  </div>
              </div>

              <div class="col-sm-4">
                  <div class="form-group">
                      <label for="">Actual Home Score</label>
                      <input type="number" min="0" name="homeScore" value = "{{ $bet->homeScore }}" class="form-control"  id="" placeholder="score">
                  </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Actual Away Score</label>
                    <input type="number" min="0" name="awayScore" value = "{{ $bet->awayScore }}" class="form-control"  id="" placeholder="score">
                </div>
              </div>
            </div>

          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-success">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>