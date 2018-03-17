@extends('layouts.app')

@section('title', Auth::user()->first_name.'\'s profile')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')

            @if(Auth::user()->profile->getCompletionPercentage() < 100)
                <div class="panel panel-success">
                    <div class="panel-heading">Profile Progress</div>
                    <div class="panel-body">
                        <p>
                            Your profile is <strong>{{ Auth::user()->profile->getCompletionPercentage() }}%</strong> complete, finish creating
                            your profile so you can start creating a storefront.
                        </p>
                    </div>
                </div>
            @endif

            @if(Auth::user()->profile->getCompletionPercentage() === 100)
                <div class="panel panel-info">
                    <div class="panel-heading">Create a Store</div>
                    <div class="panel-body">
                        <p>
                            Thanks for having a complete profile! You may now go and <a href={{ route('storefront.create') }}>Create a storefront.</a>
                        </p>
                    </div>
                </div>
            @endif

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