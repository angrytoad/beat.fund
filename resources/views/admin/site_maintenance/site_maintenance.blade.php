@extends('layouts.app')

@section('title', 'Site Maintenance')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('admin.site_maintenance') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.admin_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Site Maintenance</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <h4>Feature Suggestions</h4>
                        <p>Add suggested features from users to the <a href="{{ route('suggest_a_feature') }}">Suggest a Feature</a> page.</p>
                        <a class="btn btn-primary" href="{{ route('admin.site_maintenance.feature_suggestions') }}">Feature Suggestions</a>
                        <hr />
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