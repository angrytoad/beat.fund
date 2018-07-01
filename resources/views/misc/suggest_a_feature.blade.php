@extends('layouts.app')

@section('title', 'Suggest a Feature')

@section('content')
<div id="suggest-a-feature" class="container">
    <div class="row">
        <div class="col-xs-12">
            <div id="suggest-a-feature-banner">
                <div id="suggest-a-feature-banner-overlay">
                    <div>
                        <h1>Got a killer idea you'd like to see on Beat Fund?</h1>
                        <p class="lead">Let me know and I'll see what I can do...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Make it so!</div>
                <div class="panel-body">
                    <p>
                        I personally read all suggestions submitted through this form and If its feasible to add to the website
                        I will try to schedule it in.
                    </p>
                    <p>
                        If you're feature is selected to go onto the website You'll receive an email and you'll be features on
                        this page, immortalised in Beat Fund history!
                    </p>
                    <hr />
                    <form id="suggest-a-feature-form" method="POST" action="{{ route('suggest_a_feature') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter your name" name="name" value="{{ old('name') }}" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Enter your email address" name="email" value="{{ old('email') }}" />
                        </div>
                        <div class="form-group">
                            <label>Featured Link (Optional)</label>
                            <input type="text" class="form-control" placeholder="Why not add a link to your facebook page?" name="featured_link" value="{{ old('featured_link') }}" />
                            <small>
                                The url that will be used to link your name on the wall of fame. <br />
                                E.g. "Feature Suggested by <a href="https://beat.fund">Tom Freeborough.</a>"
                            </small>
                        </div>
                        <div class="form-group">
                            <label>Your Suggestion</label>
                            <textarea rows="5" name="suggestion" class="form-control" placeholder="Tell me about your suggestion...">{{ old('suggestion') }}</textarea>
                        </div>
                        <div class="form-group">

                            <label class="control-label">Recaptcha</label>

                            <div>
                                <div class="g-recaptcha" data-sitekey="6LcECUwUAAAAAJIRvPInYeHGtMWXouSJsbOeCJ1k"></div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="feature_acknowledgement">
                                <label class="form-check-label" for="create_store_checkbox">
                                    I acknowledge that my name may be shown on the wall of fame if my suggestion is added.
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary">Submit Suggestion</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">The Wall of Fame!</div>
                <div class="panel-body">
                    @if(count($suggestions) > 0)
                        <ul id="suggestions-list" class="list-group">
                            @foreach($suggestions as $suggestion)
                                <li class="list-group-item">
                                    <p class="lead">{{ $suggestion->suggestion }}</p>
                                    @if($suggestion->featured_link !== null)
                                        <small>Suggested by <strong><a target="_blank" href="{{ $suggestion->featured_link }}">{{ $suggestion->name }}</a></strong> - added {{ \Carbon\Carbon::parse($suggestion->created_at)->diffForHumans() }}</small>
                                    @else
                                        <small>Suggested by <strong>{{ $suggestion->name }}</strong> - added {{ \Carbon\Carbon::parse($suggestion->created_at)->diffForHumans() }}</small>
                                    @endif

                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="lead"><i>Oops, looks like nobody has suggested a feature yet, do you want to be the first?</i></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection