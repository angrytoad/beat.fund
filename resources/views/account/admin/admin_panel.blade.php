@extends ('layouts.app')

@section('title', 'Admin Panel')

@section ('content')
    <div class="container" id="admin-panel">
        <h1>Admin Panel</h1>
        <div class="col col-lg-12">
            <div class="col col-lg-8">
                <h2>User control panel</h2>
                <p>The user control panel, list all current active users and be able to inspect their stores/products and reset them if required.</p>
            </div>
            <div class="col col-lg-4">
                <div style="text-align: center" class="btn btn-primary">Users Panel</div>
            </div>
        </div>
    </div>
@endsection