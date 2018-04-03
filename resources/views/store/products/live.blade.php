@extends('layouts.app')

@section('title', 'Live Products')

@section('content')
    <div class="container">
        @include('layouts.flash_message')
        {{ Breadcrumbs::render('store.products.live') }}
        <div class="row">
            <div class="col-md-3">
                @include('layouts.menus.internal_menu')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Live Products</div>
                    <div class="panel-body">
                        <a href="{{ route('store.products.create') }}">
                            <button class="btn btn-primary">Create a product</button>
                        </a>
                        <hr />
                        <table class="table table-striped table-hover table-responsive" id="store_products_live">
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
                            @foreach($live_products as $live_product)
                                <tr>
                                    <td>{{ $live_product->live ? 'Live' : 'live' }}</td>
                                    <td>{{ $live_product->name }}</td>
                                    <td>{{ count($live_product->items) }}</td>
                                    <td>{{ $live_product->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('store.products.product', $live_product->id) }}"><i class="fas fa-eye"></i></a>
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
            $('#store_products_live').dataTable({
                "pageLength": 25
            });
        } );
    </script>
@endsection