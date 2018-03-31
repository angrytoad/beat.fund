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
                        Your Profile is {{ Auth::user()->profile->getCompletionPercentage() }}% complete.
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
                <div class="panel-heading">Home</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! I guess that's sort of an achievement...
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
