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
                        <button class="btn btn-danger pull-right" onclick="confirmPurge()">Purge User</button>
                        <form method="POST" action="{{ route('admin.user.purge',$user->id) }}" id="purgeForm">
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
        function confirmPurge(){
            vex.dialog.confirm({
                message: 'Are you sure you want to Purge this user? You deffo cannot undo this and you MUST know what you are doing.',
                callback: function (value) {
                    if(value){
                        let form = document.getElementById('purgeForm');
                        form.submit();
                    }
                }
            })
        }
    </script>
@endsection