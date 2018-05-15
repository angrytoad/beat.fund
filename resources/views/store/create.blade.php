@extends('layouts.app')

@section('title', 'Create a store')

@section('content')
<div class="container" id="create_store">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.create') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Create a store</div>
                <div class="panel-body">
                    <p>
                        Creating a store on Beat Fund allows any Artist/Band to sell their music online an an easy and fair manner.
                        Creating a store is free and at Beat Fund we are completely transparent with our <a target="_blank" href={{ route('revenue_sharing_policy') }}>revenue sharing policy.</a>
                    </p>
                    <div class="row" id="store_requirements">
                        <div class="col-md-6">
                            <div class="jumbotron">
                                <p>
                                    @if(Auth::user()->mobile_number !== null)
                                        <i class="far fa-check-square"></i>
                                    @else
                                        <i class="far fa-window-close"></i>
                                    @endif
                                        Add a mobile number.
                                </p>
                                <small><a href={{ route('account.add_mobile_number') }}>Click here to add a mobile number.</a></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="jumbotron">
                                <p>
                                    @if(Auth::user()->profile->getCompletionPercentage() === 100)
                                        <i class="far fa-check-square"></i>
                                    @else
                                        <i class="far fa-window-close"></i>
                                    @endif
                                    Complete your profile.
                                </p>
                                <small><a href={{ route('profile') }}>Click here to complete your profile.</a></small>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action={{ route('store.create') }}>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="create_store_checkbox" id="create_store_checkbox">
                                <label class="form-check-label" for="create_store_checkbox">
                                    I have and read and accept Beat Funds <a target="_blank" href="https://termsfeed.com/terms-conditions/c26e18e24eb4e014fc316451d02c19ca">Terms & Conditions.</a>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            @if(Auth::user()->mobile_number !== null && Auth::user()->profile->getCompletionPercentage() === 100)
                                <button class="btn btn-primary">Create a store</button>
                            @else
                                <button class="btn disabled">Create a store</button>
                            @endif
                        </div>
                    </form>
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