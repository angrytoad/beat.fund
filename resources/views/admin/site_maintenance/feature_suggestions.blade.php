@extends('layouts.app')

@section('title', 'Feature Suggestions')

@section('content')
<div id="feature-suggestions" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('admin.site_maintenance.feature_suggestions') }}
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create new feature suggestion</div>
                <div class="panel-body">
                    <form id="feature-suggestions-form" method="POST" action="{{ route('admin.site_maintenance.feature_suggestions') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Name of Suggestor" name="name" value="{{ old('name') }}" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Email of Suggestor" name="email" value="{{ old('email') }}" />
                        </div>
                        <div class="form-group">
                            <label>Featured Link (Optional)</label>
                            <input type="text" class="form-control" placeholder="This will be in the original email" name="featured_link" value="{{ old('featured_link') }}" />
                        </div>
                        <div class="form-group">
                            <label>Suggestion</label>
                            <input name="suggestion" class="form-control" placeholder="Enter a short version of the suggestion" value="{{ old('suggestion') }}" />
                        </div>
                        <button class="btn btn-primary">Submit Suggestion</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-8 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Feature Suggestions</div>
                <div class="panel-body">
                    <table id="feature-suggestions-table" class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Suggestion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suggestions as $suggestion)
                                <tr>
                                    <td>{{ $suggestion->name }}</td>
                                    <td>{{ $suggestion->email }}</td>
                                    <td>{{ $suggestion->suggestion }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $('#feature-suggestions-table').dataTable({
            "pageLength": 25,
            "order": []
        });
    </script>
@endsection