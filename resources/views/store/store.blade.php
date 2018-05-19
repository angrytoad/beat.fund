@extends('layouts.app')

@section('title', $profile->artist_name.'\'s Store')

@section('content')
<div id="store" class="container">
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
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-success">Music</h4>
                            <p>Upload songs, albums and EP's sell your music online through your own Beat Fund store!</p>
                            <a href="{{ route('store.products') }}">
                                <button class="btn-primary btn">Music Store</button>
                            </a>
                            <hr />
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-success">Tickets</h4>
                            <p>Offer a digital solution for free and paid ticketing at your events.</p>
                            <button class="btn-primary btn disabled">Tickets Manager</button>
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-muted">Synchronization</h4>
                            <p class="text-muted">Allow businesses to purchase Synchronization rights to use your music in Ads, Films and more!</p>
                            <button class="btn-disabled btn">Coming soon...</button>
                            <hr />
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-muted">Aggregation</h4>
                            <p class="text-muted">Freely distribute your catalogue across popular platforms such as iTunes, Spotify and more!</p>
                            <button class="btn-disabled btn">Coming soon...</button>
                            <hr />
                        </div>
                    </div>
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