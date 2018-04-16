@extends ('layouts.app')

@section('title', 'Admin Panel')

@section ('content')
    <div class="container" id="admin-panel">
        <h1>Admin Panel</h1>
        <table class="table admin-panel-table">
            <tbody>
                <tr>
                    <td width="70%">
                        <h2>Users</h2>
                        <p>The user admin panel, where details of a users account, store and profile can be inspected and altered.</p>
                    </td>
                    <td class="align-middle" width="30%">
                        <a class="btn btn-primary" href="{{ route('account.admin.user_list') }}">List Users</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection