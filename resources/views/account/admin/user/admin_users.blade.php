@extends ('layouts.app')

@section('title', 'Admin Panel')

@section ('content')
    <div class="container" id="admin-panel">
        <h1>Users Panel</h1>
        <table class="table table-striped users-list">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Has Profile?</th>
                    <th>Has Store?</th>
                    <th>No. of Purchases</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <a href="{{ route('account.admin.user', ['id' => $user->id]) }}">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</a>
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
                                <p><i class="fas fa-check"></i><a href="{{ route('account.admin.user_store', ['id' => $user->store->id]) }}"> Store</a></p>
                            @endif
                        </td>
                        <td>
                            {{ count($user->orders) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection