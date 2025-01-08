<div class="modal fade" id="send-sms-modal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered text-dark" role ="document">
      <div class="modal-content">
        <form action="{{ route('analyst.sms.send') }}" method="POST">
          @csrf
          
          <div class="modal-header">
            <h5 class="modal-title">Send SMS</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <h4>Send SMS to subscribed Members?</h4>
                
              </div>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-success">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>