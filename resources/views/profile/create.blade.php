@extends('layouts.app')

@section('title', 'Create your profile')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('profile.create') }}
    <div class="row">
        <div class="col-md-4">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Create Profile</div>
                <div class="panel-body">
                    <div class="alert alert-warning">
                        Please only use this feature if you wish to sell <strong>your own music</strong> on Beat Fund.
                    </div>
                    <p>
                        If you are an artist/band, then you are in the right place, creating a profile is the only way
                        you can let other users and new fans know more about you.
                    </p>
                    <h3>Why do I need a profile?</h3>
                    <p>
                        If you want to sell music on Beat Fund, we require you to have a profile as a step towards
                        verifying you as a legitimate person. By adding links to other websites, you can also help drive
                        your new customers to other social outlets that you are active on.
                    </p>
                    <p>
                        Furthermore, by providing this information you helping prospective fans understand more about who you
                        are and what you're creating.
                    </p>
                    <h3>I'm not an Artist/Band... do I need a profile?</h3>
                    <p>
                        The simple answer is no... for the time being. Profiles are only used on an artists/bands storefront.
                        If you simply purchase music through Beat Fund we do not currently support Public profiles between
                        regular users.
                    </p>
                    <p>
                        There is nothing stopping you from creating a profile however, but please bear in mind that nobody
                        will see it unless you have a storefront enabled; which means you'll also need products to sell; so
                        nobody will actually see your profile for the moment, but hey, nothings stopping you.
                    </p>
                    <h3>Will all users be able to have profiles in the Future?</h3>
                    <p>
                        Perhaps! We're always looking at ways to improve the user experience and that may mean adding features
                        to make Beat Fund a more social experience. Keep your ears close to the ground...
                    </p>
                    <hr />
                    <form method="POST" action={{ route('profile.create') }}>
                        {{ csrf_field() }}
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="create_profile_checkbox" id="create_profile_checkbox">
                            <label class="form-check-label" for="create_profile_checkbox">
                                I understand that I am an Artist/Band and I wish to sell my own music.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Create a Profile</button>
                    </form>
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