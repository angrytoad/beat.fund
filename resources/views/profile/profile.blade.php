@extends('layouts.app')

@section('title', Auth::user()->first_name.'\'s profile')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->first_name }}'s Profile</div>
                <div class="panel-body">
                    <p>
                        Edit the information shown on your storefront below.
                    </p>
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