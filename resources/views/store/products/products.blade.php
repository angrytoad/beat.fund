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