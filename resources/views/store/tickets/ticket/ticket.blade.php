@extends('layouts.app')

@section('title', $ticket->name)

@section('content')
<div class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.tickets.ticket', $ticket) }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $ticket->name }}</div>
                <div class="panel-body">
                    <p>
                        More info coming soon boyo!
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