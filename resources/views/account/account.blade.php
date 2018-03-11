@extends('layouts.app')

@section('content')
    <div class="container" id="verification_required">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.flash_message')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Hows it going {{ Auth::user()->first_name }}?
                    </div>
                    <div class="panel-body">
                        <p>
                            Got nothing for you at the moment, check back in a few weeks maybe?
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection