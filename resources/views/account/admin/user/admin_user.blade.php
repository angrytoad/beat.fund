@extends ('layouts.app')

@section('title', 'Admin Panel')

@section ('content')
    <div class="container" id="admin-panel">
        <h1>{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }} - id: {{ $user->id }}</h1>
        <div class=" panel admin-panel col col-lg-12">
            <div class="col col-lg-8">
                <h2>Userdata:</h2>
                <div class="col col-lg-4">
                    <p><span class="bold">Email:</span>&nbsp;{{ $user->email }}</p>
                    @if ($user->mobile_number)
                        <p><span class="bold">Mobile Number:</span> {{ $user->mobile_number }}</p>
                    @else
                        <p><span class="bold">Mobile Number:</span> <i class="fas fa-ban"></i></p>
                    @endif
                </div>
                <div class="col col-lg-4">
                    @if ($user->email_verified)
                        <p><span class="bold">Email Verified:</span>&nbsp;<i class="fas fa-check"></i></p>
                    @else
                        <p><span class="bold">Email Verified:</span>&nbsp;<i class="fas fa-ban"></i></p>
                    @endif
                    @if ($user->admin)
                        <p><span class="bold">Admin:</span>&nbsp;<i class="fas fa-check"></i></p>
                    @else
                        <p><span class="bold">Admin:</span>&nbsp;<i class="fas fa-ban"></i></p>
                    @endif
                </div>
            </div>
            <div class="col col-lg-4">
                <h2>Actions</h2>
                <ul class="actions-list">
                    <li><a href="{{ route('account.admin.purge', ['id' => $user->id]) }}">PURGE</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection