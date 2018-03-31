@extends('layouts.app')

@section('title', 'Account')

@section('content')
    <div class="container" id="verification_required">
        @include('layouts.flash_message')
        {{ Breadcrumbs::render('account') }}
        <div class="row">
            <div class="col-md-3">
                @include('layouts.menus.internal_menu')
            </div>
            <div class="col-md-9">
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
        </div>
    </div>
@endsection