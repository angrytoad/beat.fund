@extends('layouts.app')

@section('title', 'Rearrange Items for '.$product->name)

@section('content')
<div id="rearrange-items" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.products.product.rearrange_items', $product) }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Rearrange Items in {{ $product->name }}</div>
                <div class="panel-body">
                    <p>
                        To rearrange items within your product, simply click and drag them into the new order.
                    </p>
                    <form method="POST" action={{ route('store.products.product.rearrange_items', $product->id) }}>
                        {{ csrf_field() }}
                        <ul id="rearrange-items-sortable" class="list-group">
                            @foreach($items as $item_key => $item)
                                <li class="list-group-item">
                                    <strong>{{ $item_key+1 }}</strong> &middot; {{ $item->name }}
                                    <input type="hidden" name="items[]" value="{{$item->id}}" />
                                </li>
                            @endforeach
                        </ul>
                        <button class="btn btn-primary">Save Order</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $( "#rearrange-items-sortable" ).sortable().disableSelection();
    </script>
@endsection