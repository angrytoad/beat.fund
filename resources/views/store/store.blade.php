@extends('layouts.app')

@section('title', $profile->artist_name.'\'s Store')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $profile->artist_name }}'s Store</div>
                <div class="panel-body">
                    You've got a store, nothing here at the moment though
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