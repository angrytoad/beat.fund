@extends ('layouts.app')

@section('title', 'Admin Panel')

@section ('content')
    <div class="container" id="admin-panel">
        @include('layouts.flash_message')
        {{ Breadcrumbs::render('admin') }}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin Panel</div>
                    <div class="panel-body">
                        <div class="col-md-6 col-lg-4">
                            <h4>Users</h4>
                            <p>The user admin panel, where details of a users account, store and profile can be inspected and altered.</p>
                            <a class="btn btn-primary" href="{{ route('admin.users') }}">All Users</a>
                            <hr />
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <h4>Store</h4>
                            <p>View information about the Beat Fund store, as well as track orders that have come through recently on the site.</p>
                            <a class="btn btn-primary" href="{{ route('admin.users') }}">View Store Analytics</a>
                            <hr />
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <h4>Rights Management</h4>
                            <p>Logging copyright requests and scrubbing files from S3 so we are compliant with take down requests and all that.</p>
                            <a class="btn btn-primary" href="{{ route('admin.users') }}">Rights Management</a>
                            <hr />
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <h4>Site Health</h4>
                            <p>Database stats, general information about user signups and other useful bits of information are kept here.</p>
                            <a class="btn btn-primary" href="{{ route('admin.users') }}">Site Health</a>
                            <hr />
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <h4>Stripe Gateway</h4>
                            <p>Payment information, gross volume and other statistics that help determine how the store is performing.</p>
                            <a class="btn btn-primary" href="{{ route('admin.users') }}">Stripe Statistics</a>
                            <a class="btn btn-info" target="_blank" href="https://dashboard.stripe.com/dashboard">Stripe Dashboard</a>
                            <hr />
                        </div>
                        <div class="col-md-6 col-lg-4 disabled">
                            <h4>Tickets Management</h4>
                            <p>Information on events, ticket purchases and what is going through the ticketing system, as well as attendance.</p>
                            <a class="btn btn-primary disabled" href="{{ route('admin.users') }}">Tickets Management</a>
                            <hr />
                        </div>
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