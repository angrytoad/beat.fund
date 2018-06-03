@extends('layouts.app')

@section('title', 'Delete '.$ticket->name)

@section('content')
<div id="delete-ticket" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.tickets.ticket.delete', $ticket) }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Delete {{ $ticket->name }}</div>
                <div class="panel-body">
                    <h2 class="title">Are you sure?</h2>
                    <p>
                        By deleting this <strong>{{ $ticket->name }}</strong>, you are no longer making it available, either on your store or to yourself, this operation cannot be undone.
                        If this ticket has already been purchased, these will still continue to work for the event up until
                        its standard expiry date.
                    </p>
                    <form id="delete-ticket" method="POST" action="{{ route('store.tickets.ticket.delete', $ticket->id) }}">
                        {{ csrf_field() }}
                        <button class="btn btn-danger">Delete ticket</button>
                    </form>
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