@extends('layouts.app')

@section('title', 'Order '.$order->id)

@section('content')
<div class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('purchases.order', $order) }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Order created - {{ \Carbon\Carbon::parse($order->created_at)->toDayDateTimeString() }}</div>
                <div class="panel-body">
                    <p>
                        Below is a summary of all your products in this order, you can download each of your products below.
                    </p>
                    <hr />
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th># of Songs</th>
                                <th>Price Paid</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <a target="_blank" href="{{ route('artist.store.product',[$item->trashed_product->store->slug, $item->trashed_product->id]) }}">
                                        {{ $item->trashed_product->name }}
                                    </a> by
                                    <a target="_blank" href="{{ route('artist.store',$item->trashed_product->store->slug) }}">
                                        {{ $item->trashed_product->store->user->profile->artist_name }}
                                    </a>
                                </td>
                                <td>{{ count($item->trashed_product->getItemsBeforeDate($item->created_at)) }}</td>
                                <td>&pound;{{ number_format($item->price_paid/100,2) }}</td>
                                <td>
                                    <a target="_blank" href="{{ route('purchases.order.order_item.download',[$order->id, $item->id]) }}">
                                        <button class="btn btn-info btn-xs"><i class="fas fa-file-archive"></i> Download Zip</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <hr />
                    <button title="This isn't available yet, check back later!" class="btn btn-info disabled"><i class="fas fa-file-archive"></i> Download Zip</button>
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