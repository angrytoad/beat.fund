@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('home') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
            <div class="panel panel-info">
                <div class="panel-heading">My Profile</div>
                <div class="panel-body">
                    @if(Auth::user()->hasProfile())
                        <p>
                            Your Profile is {{ Auth::user()->profile->getCompletionPercentage() }}% complete.
                        </p>
                        <a href="{{ route('profile') }}"><button class="btn btn-primary btn-sm">View Profile</button></a>
                    @else
                        <p>
                            Looks like you haven't created a profile yet, if you are an artist or band you'll need a profile
                            to start selling your music.
                        </p>
                        <p>
                            You can create your profile <a href={{ route('profile.create') }}>here.</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Hello {{ Auth::user()->first_name }}, what would you like to do?
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="jumbotron text-center" style="background:url('/images/misc/cassettes.jpg') center center / cover;">
                                <a href="{{ route('purchases') }}">
                                    <button class="btn btn-success">View my purchases</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="jumbotron text-center" style="background:url('/images/misc/random_product.jpg') center center / cover;">
                                <a href="{{ route('storefront.random') }}">
                                    <button class="btn btn-default">Show me something cool...</button>
                                </a>
                            </div>
                        </div>
                        @if(Auth::user()->store)
                            <div class="col-md-6">
                                <div class="jumbotron text-center" style="background:url('/images/misc/store.jpg') center center / cover;">
                                    <a href="{{ route('store') }}">
                                        <button class="btn btn-primary">Edit my Store</button>
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if(Auth::user()->profile)
                            <div class="col-md-6">
                                <div class="jumbotron text-center" style="background:url('/images/misc/profile.jpg') center center / cover;">
                                    <a href="{{ route('profile') }}">
                                        <button class="btn btn-primary">Edit my Profile</button>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
