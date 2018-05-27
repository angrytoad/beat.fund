@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div id="store_products" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.products') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Products</div>
                <div class="panel-body">
                    @if(!$store->live)
                        <div class="alert alert-warning">Your store is NOT LIVE. (You have no public store page at present)</div>
                    @else
                        <div class="alert alert-success">This store is currently LIVE. (You have a public store page)</div>
                    @endif
                    <div class="row">
                        <div class="col-xs-12">
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
                                            <p>You have {{ count($store->liveProducts()) }} live product(s). <a href="{{ route('store.products') }}">View products.</a></p>
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
                                    @if($user->stripe_account)
                                        <div>
                                            <i class="fas fa-check text-primary"></i>
                                            <p>You have a Stripe Account. <a href="{{ route('account.stripe') }}">Update it.</a></p>
                                        </div>
                                    @else
                                        <div>
                                            <i class="fas fa-times text-danger"></i>
                                            <p>You are not set up to take payments via Stripe. <a href="{{ route('account.stripe') }}">Set up Stripe Account.</a></p>
                                        </div>
                                    @endif
                                </div>
                                @if(!$store->live)
                                    @if(
                                      $store->banner_key !== null &&
                                      $store->avatar_key !== null &&
                                      $user->stripe_account &&
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
                                            <button class="btn btn-primary">View Public Store</button>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-xs-12">
                            <div id="store_products_clickthrough">
                                <a href="{{ route('store.products.live') }}">
                                    <div title="Live Products">
                            <span>
                                <i class="fas fa-music"></i> <strong>{{ $live_products_count }}</strong><br />
                                <small>live products</small>
                            </span>
                                    </div>
                                </a>
                                <a href="{{ route('store.products.pending') }}">
                                    <div title="Pending Products">
                                <span>
                                    <i class="fas fa-cubes"></i> <strong>{{ $pending_products_count }}</strong><br />
                                    <small>pending products</small>
                                </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="{{ route('store.products.create') }}"><button class="btn btn-primary">Create a product</button></a>
                        </div>
                    </div>
                    <hr />
                    <h4>Recently Added</h4>
                    <table class="table table-striped table-hover table-responsive" id="store_products_recent">
                        <thead class="thead-dark">
                            <tr>
                                <th>Status</th>
                                <th>Name</th>
                                <th>Items</th>
                                <th>Last Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_products as $recent_product)
                                <tr>
                                    <td>{{ $recent_product->live ? 'Live' : 'Pending' }}</td>
                                    <td>{{ $recent_product->name }}</td>
                                    <td>{{ count($recent_product->items) }}</td>
                                    <td>{{ $recent_product->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('store.products.product', $recent_product->id) }}"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('store.products.product.delete', $recent_product->id) }}"><i class="fas fa-trash-alt text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready( function () {
            $('#store_products_recent').dataTable();
        } );
    </script>
@endsection