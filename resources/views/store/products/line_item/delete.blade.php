@extends('layouts.app')

@section('title', 'Delete '.$line_item->name)

@section('content')
<div class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Delete {{ $line_item->name }}</div>
                <div class="panel-body">
                    <p>
                        By deleting "{{ $line_item->name }}", you are confirming that any future purchase
                        of <a href="{{ route('store.products.product', $line_item->product->id) }}"><strong>{{ $line_item->product->name }}</strong></a> will not contain this item.
                    </p>
                    <form method="POST" action={{ route('store.products.product.item.delete', [$line_item->product->id, $line_item->id]) }}>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="delete_item_checkbox" id="delete_item_checkbox">
                                <label class="form-check-label" for="delete_item_checkbox">
                                    I understand this item will no longer be available.
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger">Delete <strong>{{ $line_item->name }}</strong></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-warning">
                <div class="panel-heading">Important Notice!</div>
                <div class="panel-body">
                    <p>
                        If anybody has previously purchased <strong>{{ $line_item->product->name }}</strong>, they will still
                        be able to access this item, we do this because we know how frustrating it can be to customers to have
                        digital products they purchased, removed.
                    </p>
                    <p>
                        <strong>Any future purchasers will not receive this item.</strong>
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