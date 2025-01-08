<div class="modal fade" id="make-sms-subscription-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered text-dark" role ="document">
      <div class="modal-content">
        <form action="{{ route('payment.request.mpesa', ['type' => 'sms']) }}" method="POST">
          @csrf
          
          <div class="modal-header">
            <h5 class="modal-title">Subscribe for SMS Notifications</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Phone Number to make MPESA payment (Safaricom only). Please use the format 2547XXXXXXXX e.g 254725678921. Any other format will fail. An STK push will be sent to your phone to which you will input your MPESA PIN to authorize payment.<span class="text-danger">*</span></label>
                        <input type="number" name="phone" id="" placeholder="254XXXXXXXXX" class="form-control" required = "" value="{{ auth()->user()->phone }}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        @php
                          $max = auth()->user()->subscription_expires_at ? auth()->user()->subscription_expires_at->diffInDays(\Carbon\Carbon::now()) : 0;   
                        @endphp

                        <label for="">How many days? (Max: {{ $max }}). SMS charged KES {{ env('SMS_PRICE') }}/= per day</label>
                        <input type="number" min="1"  max="{{ $max }}" name="no_of_days" class="form-control" required="" id="" placeholder="number of days" value="{{ $max }}">
                    </div>
                </div>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-success">Subscribe</button>
          </div>
        </form>
      </div>
    </div>
  </div>