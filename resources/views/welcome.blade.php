@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div id="welcome-container">
        <div id="welcome-container-child">
            @include('layouts.flash_message')
            <h1 id="title">Beat Fund</h1>
            <h3 id="subtitle">Supporting independent artists</h3>
            <p id="subtitle">Launching in {{  \Carbon\Carbon::now()->year }}</p>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection