@extends('layouts.app')

@section('title', 'Create a store')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Create a store</div>
                <div class="panel-body">
                    Creating a store on Beat Fund allows any Artist/Band to sell their music online an an easy and fair manner.
                    Creating a store is free and at Beat Fund we are completely transparent our <a href={{ route('revenue_sharing_policy') }}>revenue sharing policy.</a>
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