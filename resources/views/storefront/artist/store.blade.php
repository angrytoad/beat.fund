@extends('layouts.app')

@section('title', $artist->artist_name.'\'s Store')

@section('content')
<div id="artist-store" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('artist.store',$artist) }}
    <div class="row">
        <div class="col-xs-12">
            <div class="banner" style="background: url({{ $store->banner_url }})">
                <div class="banner-text">{{ $artist->artist_name }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>{{ $artist->artist_name }}</h1><hr />
                    <div id="artist-store-bio">
                        {!! $artist->artist_bio !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection