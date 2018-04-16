@extends('layouts.app')

@section('title', 'Store')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('storefront') }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Store</div>
                <div class="panel-body">
                    @foreach($products as $product)
                        <div>
                            <a href="{{ route('artist.store.product',[$product->store_slug, $product->id]) }}">
                                <strong>{{ $product->name }}</strong>
                            </a> by {{ $product->artist_name }}
                        </div>
                    @endforeach
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