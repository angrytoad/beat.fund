@extends('layouts.app')

@section('title', 'Purchases')

@section('content')
<div id="purchases" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('purchases') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Purchases</div>
                <div class="panel-body">
                    @if(count($orders) === 0)
                        <div class="alert alert-warning">
                            <p>
                                Oh snap! Doesn't look like you have made any purchases yet, why not
                                visit <a href="{{ route('storefront') }}">the store</a> and find something you like.
                            </p>
                            <p>
                                Of course, you could just click <a href="{{ route('storefront.random') }}">this link</a> and find something new...
                            </p>
                        </div>
                    @endif
                    <table class="table table-responsive table-striped" id="purchases-table">
                        <thead>
                            <tr>
                                <th>Products</th>
                                <th>Date</th>
                                <th># of Products</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('purchases.order', $order->id) }}">
                                        {{ $order->items()->first()->trashed_product->name }}
                                        @if(count($order->items) > 1)
                                            and {{ count($order->items)-1 }} others
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($order->created_at)->toDayDateTimeString() }}
                                </td>
                                <td>{{ count($order->items) }}</td>
                                <td>
                                    &pound;{{ number_format($order->total()/100,2) }}
                                </td>
                                <td>
                                    <a href="{{ route('purchases.order', $order->id) }}"><i class="fas fa-eye"></i></a>
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
        $('#purchases-table').dataTable({
            "pageLength": 25,
            "ordering": false
        });
    </script>
@endsection