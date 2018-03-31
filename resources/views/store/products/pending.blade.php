@extends('layouts.app')

@section('title', 'Pending Products')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.products.pending') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Pending Products</div>
                <div class="panel-body">
                    <a href="{{ route('store.products.create') }}">
                        <button class="btn btn-primary">Create a product</button>
                    </a>
                    <hr />
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