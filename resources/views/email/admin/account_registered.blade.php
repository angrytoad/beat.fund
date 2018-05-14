@extends('email.layout.base')

@section('title', 'A user has signed up to Beat Fund')

@section('styling')
    <style>

    </style>
@endsection

@section('content')
    <div class="content">
        <h1 class="title"><small>A new user has signed up to Beat Fund.</small></h1>
        <div>
            <p>
                Please view the information below about the user who signed up.
            </p>
            <ul>
                <li>First Name: <strong>{{ $user->first_name }}</strong></li>
                <li>Last Name: <strong>{{ $user->last_name }}</strong></li>
                <li>Email: <strong>{{ $user->email }}</strong></li>
            </ul>
            <p>
                <a href="{{ url('/admin') }}">
                    <button>Admin</button>
                </a>
            </p>
            <p>
                Kind Regards, <br />
                Beat Fund
            </p>
        </div>
    </div>
@endsection
