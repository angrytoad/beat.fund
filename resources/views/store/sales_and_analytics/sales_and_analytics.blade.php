@extends('layouts.app')

@section('title', 'Sales and Analytics')

@section('content')
<div id="sales_and_analytics" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.sales_and_analytics') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Sales and Analytics</div>
                <div class="panel-body">
                    <div class="analytic-wrapper">
                        <div class="analytic-numbering">
                            <div>
                                <div class="big">{{ number_format($music_store->getTotalProductSaleCount()) }}</div>
                                <div>Total Products Sold</div>
                            </div>
                        </div>
                        <div class="analytic-text">
                            <h4 class="text-success">Music Store Analytics</h4>
                            <p>Analytics for your Beat Fund music store page, as well as estimated revenue.</p>
                            <a href="{{ route('store.sales_and_analytics.music_store') }}">
                                <button class="btn-primary btn">View Analytics</button>
                            </a>
                            <hr />
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

    </script>
@endsection