@extends('layouts.app')

@section('title', 'Add items to '.$product->name)

@section('content')
<div id="add-items" class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Add items to {{ $product->name }}</div>
                <div class="panel-body">
                    <a href="{{ route('store.products.product', $product->id) }}"><button class="btn btn-default">Back</button></a>
                    <hr />
                    <h4>Adding Items</h4>
                    <p>
                        You can add many items as you like to {{ $product->name }}. When choosing items, you will need to add
                        a name, this is the actual name that will appear in the store.
                    </p>
                    <p>
                        If you are uploading audio files, please make sure they have a bit rate of over <strong>128Kb/s</strong> otherwise
                        they will not be added to the product.
                    </p>
                    <hr />
                    <form action="{{ route('store.products.product.upload_file', $product->id) }}" class="dropzone" id="product-items">
                        {{ csrf_field() }}
                    </form>
                    <hr />
                    <h4>Uploaded Files</h4>
                    <form id="product-items-uploaded" method="POST" action="{{ route('store.products.product.add_items', $product->id) }}">
                        <table class="table table-striped table-responsive" id="add-items-table">
                            <thead>
                                <tr>
                                    <th>Store Name</th>
                                    <th>File Name</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        {{ csrf_field() }}
                        <button class="btn btn-primary">Add Item(s)</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>

        Dropzone.options.productItems = {
            paramName: 'file',
            maxFilesize: 50, // MB
            maxFiles: 50,
            acceptedFiles: ".ogg,.wav,.aac,.mp4,.mp3,.m4a",
            init: function() {
                this.on("success", function(file, response) {

                    let random_client_name = response.client_name+Math.random().toString(36).substring(7);

                    $('#add-items-table tbody').append(
                            '<tr>' +
                            '<td><input type="text" class="form-control" required placeholder="Store name" name="items['+random_client_name+'][item_name]" /></td>' +
                            '<td>'+response.client_name+'</td>' +
                            '<td><audio controls><source src="'+response.public_url+'"></audio></td>' +
                            '</tr>'
                    )

                    $('#product-items-uploaded').append(
                            '<input type="hidden" name="items['+random_client_name+'][s3_name]" value="'+response.s3_name+'" />' +
                            '<input type="hidden" name="items['+random_client_name+'][client_name]" value="'+response.client_name+'" />' +
                            '<input type="hidden" name="items['+random_client_name+'][public_url]" value="'+response.public_url+'" />'
                    )
                });

                this.on("error", function(file, response) {
                    alert(response);
                });
            }
        };
    </script>
@endsection