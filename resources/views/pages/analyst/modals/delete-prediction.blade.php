<div class="modal fade" id="delete-prediction-modal-{{ $bet->id }}" role="dialog">
    <div class="modal-dialog modal-dialog-centered text-dark" role ="document">
      <div class="modal-content">
        <form action="{{ route('analyst.bet.delete', ['id' => $bet->id]) }}" method="POST">
          @csrf
          
          <div class="modal-header">
            <h5 class="modal-title">Delete Prediction</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
            <h4>Delete Prediction?</h4>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-success">Yes, delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>