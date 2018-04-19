@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div id="product" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.products.product', $product) }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $product->name }}</div>
                <div class="panel-body">
                    @if(!$product->live)
                        <div class="alert alert-warning">This product is currently PENDING. (It is not showing on your store page)</div>
                        <div id="product-details">
                            <div id="product-image">
                                @if($product->image_key)
                                    <img src="{{ $product->image_url }}" />
                                @else
                                    <img src="/images/no_image.png" />
                                @endif

                                <form action="{{ route('store.products.create.image') }}" class="dropzone" id="product-image-dropzone">
                                    {{ csrf_field() }}
                                </form>
                                <div id="product-status-button">
                                    @if(!$product->live)
                                        <form method="POST" action="{{ route('store.products.product.set_live',$product->id) }}">
                                            {{ csrf_field() }}
                                            <button class="btn btn-success">Set Product Live</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <form id="update-product-form" action="{{ route('store.products.product', $product->id) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="row" id="product-information">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input class="form-control" type="text" name="name" placeholder="The name that will appear on your store." value="{{ $product->name or old('name', '') }}" />
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Product Description</label>
                                            <div id="description"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="price" class="form-group">
                                            <label>Price</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text" id="basic-addon1">&pound;</span>
                                                </div>
                                                @if($product->price !== null)
                                                    @if(old('price'))
                                                        <input type="number" name="price" class="form-control" step="any" placeholder="Enter a price" min="0" value="{{ number_format(old('price'),2) }}" />
                                                    @else
                                                        <input type="number" name="price" class="form-control" step="any" placeholder="Enter a price" min="0" value="{{ number_format($product->price/100,2) }}" />
                                                    @endif
                                                @else
                                                    <input type="number" name="price" readonly class="form-control" step="any" placeholder="Enter a price" min="0" value="{{ $product->price or old('price', '') }}" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Pricing Type</label>
                                        <div class="form-group">
                                            @if($product->price !== null)
                                                <input type="checkbox" data-on-text="Fixed" data-off-text="PWYW" data-off-color="primary" name="pricing_type" checked data-toggle="toggle" data-size="small" >
                                            @else
                                                <input type="checkbox" data-on-text="Fixed" data-off-text="PWYW" data-off-color="primary" name="pricing_type" data-toggle="toggle" data-size="small">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden Inputs -->
                                <input type="hidden" name="description" value="{{ $product->description or old('description', '') }}" />
                                <input type="hidden" id="product_delta" name="delta" value="" />
                                <input type="hidden" name="image" value="{{ old('image') }}" />

                                <div class="row">
                                    <div class="col-xs-12">
                                        <button class="btn btn-primary" onclick="submitForm()">Update Product</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-success">This product is currently LIVE.</div>
                        <div id="product-details">
                            <div id="product-image">
                                <img src="{{ $product->image_url }}" />
                            </div>
                            <div id="product-information">
                                <form method="POST" action="{{ route('store.products.product.set_pending',$product->id) }}" class="pull-right">
                                    {{ csrf_field() }}
                                    <button class="btn btn-warning">Set Product Pending</button>
                                </form>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <strong>Product Name:</strong> {{ $product->name }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        @if($product->price === null)
                                            <strong>Price:</strong> <i>Pay what you want</i>
                                        @else
                                            <strong>Price:</strong> &pound;{{ number_format($product->price/100,2) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <strong>Product Description:</strong>
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Genres</div>
                <div class="panel-body">
                    @if(!$product->live)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Genres</label>
                                    <p>
                                        You can select as many genres as you wish to add to this product, you can search for them by typing in the search below.
                                    </p>
                                    <input class="form-control" type="text" onkeyup="searchGenres(event)" placeholder="Search for a genre..." />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('store.products.product.update_genres', $product->id) }}">
                                    {{ csrf_field() }}
                                    <div id="selected_genres" class="list-group">
                                        @foreach($product->genres as $genre)
                                            <div class="list-group-item list-group-item-success" data-id="{{ $genre->id }}">
                                                <i class="fas fa-times text-danger" onclick="removeGenre('{{ $genre->id }}')"></i> {{ $genre->pretty_name }}
                                                <input type="hidden" name="genres[]" value="{{ $genre->id }}"/>
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="genres[]" value=""/>
                                    </div>
                                    <button class="btn btn-primary">Update Genres</button>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <ul id="genre_select_list">

                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="list-group">
                            @foreach($product->genres as $genre)
                                <div class="list-group-item">{{ $genre->pretty_name }}</div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Line Items</div>
                <div class="panel-body">
                    <a href="{{ route('store.products.product.add_items',$product->id) }}"><button class="btn-primary btn">Add item(s)</button></a>
                    <a href="{{ route('store.products.product.rearrange_items',$product->id) }}"><button class="btn-primary btn">Rearrange item(s)</button></a>
                    <a href="{{ route('store.products.product.tag_items',$product->id) }}"><button class="btn-primary btn">Tag item(s)</button></a>
                    <hr />
                    <table class="table-responsive table table-striped" id="product-line-items">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>File</th>
                                <th>Tags</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->items()->orderBy('order','ASC')->get() as $item)
                                <tr>
                                    <td>{{ $item->order+1 }}</td>
                                    <td><a href="{{ route('store.products.product.item', [$product->id, $item->id]) }}">{{ $item->name }}</a></td>
                                    <td>
                                        <audio controls preload="none">
                                            <source src="{{ $item->signedSampleURL() }}">
                                        </audio>
                                    </td>
                                    <td>
                                        @foreach(array_slice($item->tags->toArray(),0,5) as $tag)
                                            <div class="tag">
                                                {{ $tag['name'] }}
                                            </div>
                                        @endforeach
                                        @if(count($item->tags) > 5)
                                                <div class="tag">
                                                    <strong>+{{ count($item->tags)-5 }}</strong>
                                                </div>
                                        @endif
                                        @if(count($item->tags) === 0)
                                            <i>N/A</i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('store.products.product.item', [$product->id, $item->id]) }}"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('store.products.product.item.delete',[$product->id, $item->id]) }}"><i class="fas fa-trash-alt text-danger"></i></a>
                                    </td>
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

        var genres = [
            @foreach(\App\Helpers\Helper::getGenres() as $genre)
            {!! json_encode($genre) !!},
            @endforeach
        ];

        var options = {
            keys: ['pretty_name','genre'],
        };

        var fuse = new Fuse(genres, options);

        function removeGenre(id){
            $('#selected_genres').children().each(function(index, genre){
                if($(genre).data('id') === id){
                    $(genre).remove();
                }
            });
        }

        function addGenre(id, name){
            var found = false;
            $('#selected_genres').children().each(function(index, genre){
                if($(genre).data('id') === id){
                    found = true
                }
            });

            if(!found){
                $('#selected_genres').append(
                        '<div class="list-group-item list-group-item-success" data-id="'+id+'">' +
                        '<i onclick="removeGenre(\''+id+'\')" class="fas fa-times text-danger"></i>' +
                        '<input type="hidden" name="genres[]" value="'+id+'"/> '+name+'' +
                        '</div>'
                );
            }
        }

        function searchGenres(e){
            var search = e.target.value;
            var search_results = fuse.search(search);
            var to_render = search_results.slice(0,10);
            console.log(to_render);
            $('#genre_select_list').empty();
            to_render.forEach(function(result){
                $('#genre_select_list').append('<li onclick="addGenre(\''+result.id+'\',\''+result.pretty_name+'\')">'+result.pretty_name+'</li>')
            });
        }




        $('#product-line-items').dataTable();

        function submitForm() {
            document.getElementById("update-product-form").submit();
        }

        function switchProductPricing(event, state) {
            if(state){
                $('#price input').removeAttr('readonly').val('');
            }else{
                $('#price input').attr('readonly','true').val('');
            }
        }

        $("[name='pricing_type']").bootstrapSwitch('onSwitchChange', switchProductPricing);

        Dropzone.options.productImageDropzone = {
            paramName: 'file',
            maxFilesize: 5, // MB
            maxFiles: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            init: function() {
                this.on("success", function(file, response) {
                    var image = document.querySelector('input[name=image]');
                    image.value = response;
                });

                this.on("error", function(file, response) {
                    alert(response);
                });
            }
        };


        var quill = new Quill('#description', {
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'header': [1, 2, false] }],
                    ['link', 'blockquote', 'code-block', 'image'],
                    [{ list: 'ordered' }, { list: 'bullet' }]
                ]
            },
            placeholder: 'Your description will be shown on the store.',
            theme: 'snow',
        });

        $("#product_delta").val(JSON.stringify({!! $product->description_delta or old('delta', '') !!}));
        quill.setContents({!! $product->description_delta !!});

        quill.on('text-change', function(delta, oldDelta, source) {
            var description = document.querySelector('input[name=description]');
            description.value = $('.ql-editor').html();

            var delta_input = document.querySelector('input[name=delta]');
            delta_input.value = JSON.stringify(quill.getContents());
        });

    </script>
@endsection