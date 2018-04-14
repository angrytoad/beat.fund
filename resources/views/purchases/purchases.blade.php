@extends('layouts.app')

@section('title', 'Purchases')

@section('content')
<div class="container">
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
                    <h4>
                        Your purchases will be available here soon...
                    </h4>
                    @foreach($orders as $order)
                        <div>
                            {{ $order->id }}
                        </div>
                    @endforeach
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