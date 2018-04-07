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
                    @else
                        <div class="alert alert-success">This store is currently LIVE. (You have a public store page)</div>
                    @endif
                        <div id="store-live-requirements">
                            <div>
                                @if($profile->getCompletionPercentage() === 100)
                                    <div>
                                        <i class="fas fa-check text-primary"></i>
                                        <p>Have a complete profile <a href="{{ route('profile') }}">Update.</a></p>
                                    </div>
                                @else
                                    <div>
                                        <i class="fas fa-times text-danger"></i>
                                        <p>You do not have a complete profile ({{ $profile->getCompletionPercentage() }}%). <a href="{{ route('profile') }}">Add one.</a></p>
                                    </div>
                                @endif
                            </div>
                            <div>
                                @if(count($store->liveProducts()) > 0)
                                    <div>
                                        <i class="fas fa-check text-primary"></i>
                                        <p>You have {{ count($store->liveProducts()) }} live product(s)</p>
                                    </div>
                                @else
                                    <div>
                                        <i class="fas fa-times text-danger"></i>
                                        <p>You do not have any live products set up. <a href="{{ route('store.products') }}">View products.</a></p>
                                    </div>
                                @endif
                            </div>
                            <div>
                                @if($store->banner_key !== null)
                                    <div>
                                        <i class="fas fa-check text-primary"></i>
                                        <p>You have a storefront banner. <a href="{{ route('store.banner.add') }}">Change it.</a></p>
                                    </div>
                                @else
                                    <div>
                                        <i class="fas fa-times text-danger"></i>
                                        <p>You do not have a storefront banner. <a href="{{ route('store.banner.add') }}">Add one here.</a></p>
                                    </div>
                                @endif
                            </div>
                            <div>
                                @if($store->avatar_key !== null)
                                    <div>
                                        <i class="fas fa-check text-primary"></i>
                                        <p>You have a storefront avatar. <a href="{{ route('store.avatar.add') }}">Change it.</a></p>
                                    </div>
                                @else
                                    <div>
                                        <i class="fas fa-times text-danger"></i>
                                        <p>You do not have a storefront avatar. <a href="{{ route('store.avatar.add') }}">Add one here.</a></p>
                                    </div>
                                @endif
                            </div>
                            <div>
                                @if(Auth::user()->stripe_account)
                                    <div>
                                        <i class="fas fa-check text-primary"></i>
                                        <p>You have a Stripe Account. <a href="{{ route('account.stripe') }}">Update it.</a></p>
                                    </div>
                                @else
                                    <div>
                                        <i class="fas fa-times text-danger"></i>
                                        <p>You are not set up to take payments. <a href="{{ route('account.stripe') }}">Add one here.</a></p>
                                    </div>
                                @endif
                            </div>
                            @if(!$store->live)
                                @if(
                                  $store->banner_key !== null &&
                                  $store->avatar_key !== null &&
                                  Auth::user()->stripe_account &&
                                  $profile->getCompletionPercentage() === 100 &&
                                  count($store->liveProducts()) > 0
                                )
                                    <div>
                                        <form method="POST" action="{{ route('store.set_live') }}">
                                            {{ csrf_field() }}
                                            <button class="btn btn-success">Set Store Live</button>
                                        </form>
                                    </div>
                                @else
                                    <div>
                                        <button class="btn btn-disabled">Set Store Live</button>
                                    </div>
                                @endif
                            @else
                                <div>
                                    <a href="{{ route('artist.store',$store->slug) }}">
                                        <button class="btn btn-primary">View Store</button>
                                    </a>
                                </div>
                            @endif

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