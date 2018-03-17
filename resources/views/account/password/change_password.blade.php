@extends('layouts.app')

@section('title', 'Change your password')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Change your password</div>
                <div class="panel-body">
                    <p>Coming soon...</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">Helpful Hints:</div>
                <div class="panel-body">
                    <p>Here are a few helpful tips to keep in mind when choosing a new password.</p>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Make it memorable:</strong> A 4 word phrase is much more secure than 8 random characters.</li>
                        <li class="list-group-item"><strong>Obscurity is not security:</strong> special characters are not a good substitute for a longer password.</li>
                        <li class="list-group-item list-group-item-warning">We recommend having a password of at least 16 characters in length.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection