@extends('email.layout.base')

@section('title', 'You\'re suggestion made the Wall of Fame!')

@section('styling')
    <style>

    </style>
@endsection

@section('content')
    <div class="content">
        <h1 class="title">Hey <span class="highlight">{{ $request->get('name') }}</span>, you're now part of Beat Fund history!</h1>
        <div>
            <p>
                I'm just shooting you a quick email to let you know your suggestion has been added to the suggestions wall of fame on Beat Fund.
                You're now part of Beat Fund history!
            </p>
            <p>
                Thanks so much for support, its people like you who make all the hours building a service like this worthwhile.
            </p>
            <p>
                If you want to take a cheeky peek, here is a link to the page where you should now find your suggestion.
            </p>
            <p>
                <a href="{{ route('suggest_a_feature') }}">Suggest a Feature</a>
            </p>
            <p>
                Kind Regards, <br /><br />
                Tom Freeborough
            </p>
        </div>
    </div>
@endsection
