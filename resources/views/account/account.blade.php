@extends('layouts.app')

@section('content')
    <div class="container" id="verification_required">
        <div class="row">
            <div class="col-md-8">
                @include('layouts.flash_message')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ Auth::user()->first_name }}'s account settings
                    </div>
                    <div class="panel-body">
                        <p>
                            Got nothing for you at the moment, check back in a few weeks maybe?
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Account Tools
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <a href="{{ route('account.update_email') }}" class="list-group-item list-group-item-action">Update Email</a>
                            <a href="{{ route('account.change_password') }}" class="list-group-item list-group-item-action">Change Password</a>
                            <a href="{{ route('account.add_mobile_number') }}" class="list-group-item list-group-item-action">Add a Mobile Number</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection