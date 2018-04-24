@extends ('layouts.app')

@section('title', 'Admin Panel')

@section ('content')
    <div class="container" id="admin-users">
        @include('layouts.flash_message')
        {{ Breadcrumbs::render('admin.users') }}
        <div class="row">
            <div class="col-md-3">
                @include('layouts.menus.admin_menu')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Users Panel</div>
                    <div class="panel-body">
                        <table id="admin-users-table" class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Profile</th>
                                <th>Store</th>
                                <th>No. of Purchases</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.user', $user->id) }}">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</a>
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($user->created_at)->toDayDateTimeString() }}
                                    </td>
                                    <td>
                                        @if(!$user->profile)
                                            <p><i title="This user has no profile." class="fas fa-ban"></i></p>
                                        @else
                                            <p><i class="fas fa-check"></i></p>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$user->store)
                                            <p><i title="This user has no store." class="fas fa-ban"></i></p>
                                        @else
                                            <p><i class="fas fa-check"></i>&nbsp;&nbsp;<a href="{{ route('admin.user.store', $user->id) }}">Store</a></p>
                                        @endif
                                    </td>
                                    <td>
                                        {{ count($user->orders) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#admin-users-table').dataTable({
            "pageLength": 25,
        });
    </script>
@endsection