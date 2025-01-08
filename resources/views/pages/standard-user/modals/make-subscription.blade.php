<div class="modal fade" id="make-subscription-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered text-dark" role ="document">
      <div class="modal-content">
        <form action="{{ route('payment.request.mpesa', ['type' => 'predictions']) }}" method="POST" class="book_room_form">
          @csrf
          
          <div class="modal-header">
            <h5 class="modal-title">Subscribe to Paid Predictions</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">                 
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Phone Number to make MPESA payment (Safaricom only). Please use the format 2547XXXXXXXX e.g 254725678921. Any other format will fail. An STK push will be sent to your phone to which you will input your MPESA PIN to authorize payment.<span class="text-danger">*</span></label>
                        <input type="number" name="phone" value="{{ auth()->user()->phone }}" id="" placeholder="254XXXXXXXXX" class="form-control" required = "">
                    </div>
                </div>
            </div>
        
            <div class="row">                        
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Subscription Type<span class="text-danger">*</span></label>
                        <select name="subscription_type_id" class="form-control available-rooms" id="" required = "">
                            @foreach(\App\SubscriptionType::get() as $subscriptionType) 
                                <option value="{{ $subscriptionType->id }}">{{ $subscriptionType->subscription_type }} (KES {{ number_format($subscriptionType->price) }}/=)</option>
                            @endforeach
                        </select>
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