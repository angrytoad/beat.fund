@extends('layouts.app')

@section('title', 'Add an avatarr')

@section('content')
    <div id="add-avatar" class="container">
        @include('layouts.flash_message')
        {{ Breadcrumbs::render('store.add_avatar') }}
        <div class="row">
            <div class="col-md-3">
                @include('layouts.menus.internal_menu')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Add an avatar</div>
                    <div class="panel-body">
                        <form action="{{ route('store.avatar.add.image') }}" class="dropzone" id="storefront-avatar">
                            {{ csrf_field() }}
                        </form>
                        <hr />
                        <h3>Preview</h3>
                        <div id="avatar">
                            <p class="text-muted">Your avatar will appear once uploaded.</p>
                            @if(Auth::user()->store->avatar_url)
                                <img src="{{ Auth::user()->store->avatar_url }}" />
                            @else
                                <img src="" />
                            @endif
                        </div>
                        <form action="{{ route('store.avatar.add') }}" method="POST">
                            {{ csrf_field() }}
                            <input name="image" type="hidden" />
                            <button class="btn btn-primary">Upload avatar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        Dropzone.options.storefrontAvatar = {
            paramName: 'file',
            maxFilesize: 3, // MB
            maxFiles: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            init: function() {
                this.on("success", function(file, response) {
                    var image = document.querySelector('input[name=image]');
                    image.value = response.file_name;
                    $('#avatar img').attr('src',response.source_file);
                });

                this.on("error", function(file, response) {
                    alert(response);
                });
            }
        };
    </script>
@endsection