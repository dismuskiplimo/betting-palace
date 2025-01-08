<div class="modal fade" id="add-prediction-modal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered text-dark" role ="document">
      <div class="modal-content">
        <form action="{{ route('analyst.dashboard') }}" method="POST">
          @csrf
          
          <div class="modal-header">
            <h5 class="modal-title">Add Prediction</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="">League<span class="text-danger">*</span></label>
                      <input type="text" name="league" id="" placeholder="league" class="form-control" required = "">
                  </div>
              </div>

              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="">Game ID<span class="text-danger">*</span></label>
                      <input type="number" min="1" name="gameId" class="form-control" required="" id="" placeholder="game id">
                  </div>
              </div>

              
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Pricing<span class="text-danger">*</span></label>
                    <select name="free" id="" class="form-control" required="">
                      <option value="0">PAID BET</option>
                      <option value="1">FREE BET</option>
                    </select>
                </div>
              </div>

              <div class="col-sm-6">
                  <div class="form-group">
                    <label for="">Starts at (date hour:min)<span class="text-danger">*</span></label>
                    <div class="row">
                      <div class="col-6">
                        <input type="text" name="starts_at" class="form-control datepicker" required="" id="" placeholder="date">
                      </div>

                      <div class="col-3">
                        <select name="hour" id="" class="form-control" required="">
                          @for($i = 0; $i < 24; $i++)
                            <option value="{{ $i < 10 ? '0' . $i : $i }}">{{ $i < 10 ? '0' . $i : $i }}</option>
                          @endfor
                        </select>
                      </div>

                      <div class="col-3">
                        <select name="minute" id="" class="form-control" required="">
                          @for($i = 0; $i<=60; $i++)
                            <option value="{{ $i < 10 ? '0' . $i : $i }}">{{ $i < 10 ? '0' . $i : $i }}</option>
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
                      <input type="text" name="homeName" class="form-control" required="" id="" placeholder="home team">
                  </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Away Team<span class="text-danger">*</span></label>
                    <input type="text"  name="awayName" class="form-control" required="" id="" placeholder="away team">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                  <div class="form-group">
                      <label for="">Prediction<span class="text-danger">*</span></label>
                      <input type="text" name="prediction" id="" placeholder="prediction" class="form-control" required = "">
                  </div>
              </div>

              <div class="col-sm-4">
                  <div class="form-group">
                      <label for="">Predicted Home Score (optional)</label>
                      <input type="number" min="0" name="predictedHomeScore" class="form-control"  id="" placeholder="score">
                  </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Predicted Away Score (optional)</label>
                    <input type="number" min="0" name="predictedAwayScore" class="form-control"  id="" placeholder="score">
                </div>
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