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
                    @if(!$store->live)
                        <div class="alert alert-warning">Your store is NOT LIVE. (You have no public store page at present)</div>
                        <div id="store-live-requirements">
                            <div>
                                @if($profile->artist_bio !== null)
                                    <p>You have a bio</p>
                                @else
                                    <p>You do not have a bio</p>
                                @endif
                            </div>
                            <div>
                                @if(count($store->liveProducts()) > 0)
                                    <p>You have {{ count($store->liveProducts()) }} live product(s)</p>
                                @else
                                    <p>You do not have any live products set up. <a href="{{ route('store.products') }}">View products.</a></p>
                                @endif
                            </div>
                            <div>
                                @if($store->banner_key !== null)
                                    <p>You have a storefront banner. <a href="{{ route('store.banner.add') }}">Change it.</a></p>
                                @else
                                    <p>You do not have a storefront banner. <a href="{{ route('store.banner.add') }}">Add one here.</a></p>
                                @endif
                            </div>
                            <div>
                                @if($store->avatar_key !== null)
                                    <p>You have a storefront avatar <a href="{{ route('store.avatar.add') }}">Change it.</a></p>
                                @else
                                    <p>You do not have a storefront avatar. <a href="{{ route('store.avatar.add') }}">Add one here.</a></p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="alert alert-success">This product is currently LIVE. (You have a public store page)</div>

                    @endif
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