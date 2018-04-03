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
                    <table class="table table-striped table-hover table-responsive" id="store_products_pending">
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
                        @foreach($pending_products as $pending_product)
                            <tr>
                                <td>{{ $pending_product->live ? 'Live' : 'Pending' }}</td>
                                <td>{{ $pending_product->name }}</td>
                                <td>{{ count($pending_product->items) }}</td>
                                <td>{{ $pending_product->updated_at }}</td>
                                <td>
                                    <a href="{{ route('store.products.product', $pending_product->id) }}"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('store.products.product.delete', $pending_product->id) }}"><i class="fas fa-trash-alt text-danger"></i></a>
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
            $('#store_products_pending').dataTable({
                "pageLength": 25
            });
        } );
    </script>
@endsection