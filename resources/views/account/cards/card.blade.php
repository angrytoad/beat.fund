@extends('layouts.app')

@section('title', $card->name)

@section('content')
<div id="card" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('account.cards.card',$card) }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $card->name }}</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="card-delete" class="btn btn-warning pull-right" onclick="confirmDelete()">Delete Card</button>
                            @if(!$card->isDefaultCard())
                                <button id="card-make-default" class="btn btn-default pull-right" onclick="confirmDefault()">Make Default</button>
                            @endif
                            <h4>Editing your card</h4>
                            <p>If you'd like to update the details of your card you can do so here.</p>
                        </div>
                    </div>
                    <hr />
                    <form action="{{ route('account.cards.card.update',$card->id) }}" method="POST" id="card-form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Card Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Give your card a memorable name" value="{{ $card->name }}" />
                        </div>
                        <hr />
                        <button class="btn btn-primary pull-left">Update Card</button>
                    </form>
                    <form action="{{ route('account.cards.card.delete',$card->id) }}" method="POST" id="card-delete-form">
                        {{ csrf_field() }}
                    </form>
                    <form action="{{ route('account.cards.card.make_default',$card->id) }}" method="POST" id="card-default-form">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        function confirmDelete(){
            vex.dialog.confirm({
                message: 'Are you absolutely sure you want to delete this card?',
                callback: function (value) {
                    if(value){
                        var form = document.getElementById('card-delete-form');
                        form.submit();
                    }
                }
            })
        }

        function confirmDefault(){
            vex.dialog.confirm({
                message: 'Are you sure you want to make this card your new default?',
                callback: function (value) {
                    if(value){
                        var form = document.getElementById('card-default-form');
                        form.submit();
                    }
                }
            })
        }
    </script>
@endsection