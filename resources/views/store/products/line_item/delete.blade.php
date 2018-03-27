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
                        Any future purchasers will not receive this item.
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