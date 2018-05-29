@extends('layouts.app')

@section('title', 'Music Store Analytics')

@section('content')
<div id="music-store" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.sales_and_analytics.music_store') }}
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Music Store</div>
                <div class="panel-body">
                    <div id="music-store-top-stats">
                        <div>
                            <div>
                                <div class="big">{{ $music_store->getTotalProductSaleCount() }}</div>
                                <div class="">Total Products Sold</div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <div class="big">{{ $music_store->getTotalOrderCount() }}</div>
                                <div class="">Total Orders</div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <div class="big">{{ $music_store->getTotalCustomerCount() }}</div>
                                <div class="">Total Customers</div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <div class="big">&pound;{{ number_format(\App\Helpers\Helper::getArtistCut($music_store->getTotalRevenue())/100,2) }}</div>
                                <div class="">Estimated Total Revenue</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>Products Sold in the Past 30 Days ({{ \Carbon\Carbon::now()->subDays(30)->format('d/m') }} - {{ \Carbon\Carbon::now()->subDays(1)->format('d/m') }})</h4>
                            <div id="music-sales-chart"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-responsive table-striped" id="music-store-products-sold-table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Purchased</th>
                                    <th>Customer Paid</th>
                                    <th>You Receive</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($music_store->getProductSales() as $order_item)
                                    <tr>
                                        <td>{{ $order_item->product->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order_item->created_at)->toDayDateTimeString() }}</td>
                                        <td>&pound;{{ number_format($order_item->price_paid/100,2) }}</td>
                                        <td class="text-success"><strong>&pound;{{ number_format(\App\Helpers\Helper::getArtistCut($order_item->price_paid)/100,2) }}</strong></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $('#music-store-products-sold-table').dataTable({
            "pageLength": 25,
            "order": []
        });

        new Chartist.Line('#music-sales-chart', {
                labels: Array.from({!! $music_store->getChartDates(\Carbon\Carbon::now()->subDays(30)) !!}) ,
                series: [
                    {{ $music_store->getProductSalesCountChartData(\Carbon\Carbon::now()->subDays(30), \Carbon\Carbon::now()) }}
                ]
            },
            {
                fullWidth: true,
                chartPadding: {
                    right: 40
                },
            }
        );
    </script>
@endsection