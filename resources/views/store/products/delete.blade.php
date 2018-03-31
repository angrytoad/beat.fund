@extends('layouts.app')

@section('title', 'Delete '.$product->name)

@section('content')
    <div class="container">
        @include('layouts.flash_message')
        {{ Breadcrumbs::render('store.products.product.delete', $product) }}
        <div class="row">
            <div class="col-md-3">
                @include('layouts.menus.internal_menu')
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Delete {{ $product->name }}</div>
                    <div class="panel-body">
                        <p>
                            By deleting "{{ $product->name }}", you are confirming that this item will not long be available
                            from your store. <strong>You cannot undo this action.</strong> Any existing users that have purchased
                            this product will still be able to download it as is their consumer right.
                        </p>
                        <form method="POST" action={{ route('store.products.product.delete', [$product->id]) }}>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="delete_product_checkbox" id="delete_product_checkbox">
                                    <label class="form-check-label" for="delete_product_checkbox">
                                        I understand this product will not longer be available on my store.
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger">Delete <strong>{{ $product->name }}</strong></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-warning">
                    <div class="panel-heading">Important</div>
                    <div class="panel-body">
                        <p>
                            If anybody has previously purchased <strong>{{ $product->name }}</strong>, they will still
                            be able to access this item, we do this because we know how frustrating it can be to customers to have
                            digital products they purchased, removed.
                        </p>
                        <p>
                            <strong>This product will be not longer be available to purchase after it has been deleted.</strong>
                        </p>
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