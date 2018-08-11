@extends('layouts.app_label')

@section('title', 'User Manager')

@section('content')
<div class="wide-container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('label.organisation.user_manager') }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Manager</div>
                <div class="panel-body">
                    More to come here... Soon!
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