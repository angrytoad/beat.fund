@extends('email.layout.base')

@section('title', 'Thanks for the suggestion, '.$request->get('name'))

@section('styling')
    <style>

    </style>
@endsection

@section('content')
    <div class="content">
        <h1 class="title">Thanks <span class="highlight">{{ $request->get('name') }}!</span></h1>
        <div>
            <p>
                Thanks for suggesting a new feature for Beat Fund, I do try and read every suggestion I get and weigh it
                up properly against what already exists on the service. If its feasible to add into the site I will certainly
                try to schedule it in when I get a chance.
            </p>
            <p>
                Thanks for helping to get involved in the community, its a huge show of support to want to see the platform
                grow and expand with new offerings! If your feature gets added to the <a href="{{ route('suggest_a_feature') }}">Wall of Fame</a> you
                should get an email from me letting you know!
            </p>
            <p>
                I've included what you put in the form here for your reference, in case you need to refer to it in the future!
            </p>
            <ul>
                <li>Full Name: <strong>{{ $request->get('name') }}</strong></li>
                <li>Email: <strong>{{ $request->get('email') }}</strong></li>
                <li>Featured Link : <strong>{{ $request->get('featured_link') }}</strong></li>
                <li>Suggestion : <strong>{{ $request->get('suggestion') }}</strong></li>
            </ul>
            <p>
                Kind Regards, <br /><br />
                Tom Freeborough <br />
                <small><strong>Founder</strong></small>
            </p>
        </div>
    </div>
@endsection
