@extends('email.layout.base')

@section('title', 'A new feature has been suggested for Beat Fund')

@section('styling')
    <style>

    </style>
@endsection

@section('content')
    <div class="content">
        <h1 class="title"><small>A new feature has been suggested</small></h1>
        <div>
            <p>
                Please view the information below about the featured suggestion...
            </p>
            <ul>
                <li>Full Name: <strong>{{ $request->get('name') }}</strong></li>
                <li>Email: <strong>{{ $request->get('email') }}</strong></li>
                <li>Featured Link : <strong>{{ $request->get('featured_link') }}</strong></li>
                <li>Suggestion : <strong>{{ $request->get('suggestion') }}</strong></li>
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
