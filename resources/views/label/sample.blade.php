@extends('layouts.app_label')

@section('title', 'Create a user')

@section('content')
    <div id="create-user" class="wide-container">
        @include('layouts.flash_message')
        {{ Breadcrumbs::render('label.organisation.user_manager.create_user') }}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a user</div>
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