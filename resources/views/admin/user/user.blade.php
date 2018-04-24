@extends ('layouts.app')

@section('title', 'Admin Panel')

@section ('content')
    <div class="container" id="admin-panel">
        @include('layouts.flash_message')
        {{ Breadcrumbs::render('admin.user', $user) }}
        <div class="row">
            <div class="col-md-3">
                @include('layouts.menus.admin_menu')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->first_name }} {{ $user->last_name }}</div>
                    <div class="panel-body">
                        <i class="text-muted">More data to come soon...</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection