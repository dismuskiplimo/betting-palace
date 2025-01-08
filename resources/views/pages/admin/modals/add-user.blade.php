<div class="modal fade" id="add-user-modal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered text-dark" role ="document">
      <div class="modal-content">
        <form action="{{ route('admin.add-user') }}" method="POST">
          @csrf
          
          <div class="modal-header">
            <h5 class="modal-title">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="name" class="form-control" required="" placeholder="name" value="{{ old('name') }}">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="email" name="email" class="form-control" required="" placeholder="email" value="{{ old('email') }}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Phone (format: 254XXXXXXXXX)</label>
                  <input type="number" name="phone" min = "0" class="form-control" required="" placeholder="phone number" value="{{ old('phone') }}">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">User Type</label>
                  <select name="user_type" class="form-control" required="">
                    <option value="STANDARD"{{ old('user_type' == "STANDARD" ? ' selected' : '') }}>Standard User</option>
                    <option value="ANALYST{{ old('user_type' == "ANALYST" ? ' selected' : '') }}">Analyst</option>
                    <option value="ADMIN{{ old('user_type' == "ADMIN" ? ' selected' : '') }}">Admin</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" name="password" class="form-control" required="" placeholder="password"  value="{{ old('password') }}">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control" required="" placeholder="confirm-password" value="{{ old('old_password') }}">
                </div>
              </div>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-success">Add User</button>
          </div>
        </form>
      </div>
    </div>
  </div>