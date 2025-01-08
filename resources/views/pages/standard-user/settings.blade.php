@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-sm-8 offset-sm-2">
                <h4 class="text-warning mb-3">{{ $title }}</h4>

                <hr>

                <h5>Personal Information</h5>
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="name" value="{{ auth()->user()->name }}" required="" id="">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="email" value="{{ auth()->user()->email }}" required="" id="">
                    </div>

                    <div class="form-group">
                        <label for="">Phone (format: 254XXXXXXXXX)</label>
                        <input type="number" class="form-control" name="phone" placeholder="254XXXXXXXXX" value="{{ auth()->user()->phone }}" required="" id="">
                    </div>

                    <div class="rogm-group">
                        <button type="submit" class="btn btn-warning">UPDATE</button>
                    </div>
                </form>

                <h5 class="mt-5">Update Password</h5>
                <form action="{{ route('auth.password.update') }}" method="POST" class="">
                    @csrf
                    <div class="form-group">
                        <label for="">Old Password</label>
                        <input type="password" class="form-control" name="old_password" placeholder="old password" required="" id="">
                    </div>

                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="password" class="form-control" name="new_password" placeholder="new password" required="" id="">
                    </div>

                    <div class="form-group">
                        <label for="">Confirm New Password</label>
                        <input type="password" class="form-control" name="new_password_confirmation" placeholder="confirm new password" required="" id="">
                    </div>

                    <div class="rogm-group">
                        <button type="submit" class="btn btn-warning">UPDATE</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @include('pages.standard-user.modals.make-subscription')
    @include('pages.standard-user.modals.make-sms-subscription')
@endsection