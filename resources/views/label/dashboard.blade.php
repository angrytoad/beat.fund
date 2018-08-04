@extends('layouts.app_label')

@section('title', $label->name)

@section('content')
<div class="wide-container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('label.dashboard') }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $label->name }}</div>
                <div class="panel-body">

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