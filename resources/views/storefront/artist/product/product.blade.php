@extends('layouts.app')

@section('title', $product->name)
@section('meta_description', $product->plaintextDescription())

@section('og:title', $product->name)
@section('og:description', str_limit($product->plaintextDescription(),150,'...'))
@section('og:type', 'music.song')
@section('og:audio:type','audio/vnd.facebook.bridge')
@section('og:audio',$product->items()->orderBy('order','ASC')->get()[0]->sampleUrl())
@section('og:music:musician', route('artist.store',$product->store->slug))
@section('twitter:card','player')
@section('twitter:player:height','200')
@section('twitter:player:width','400')

@if($product->image_key)
    @section('og:image', $product->downsizedImage())
@endif


@section('content')
<div id="artist-product" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('artist.store.product',$product->store->user->profile,$product) }}
    <div class="row">
        <div class="col-xs-12">
            <div class="banner" style="background: url({{ $product->store->downsizedBanner() }})">
                <div class="banner-text">{{ $product->name }}</div>
            </div>
        </div>
    </div>
    @include('misc.is_product_in_cart_alert')
    <div id="artist-product-columns" class="row">
        <div id="artist-product-left-column" class="col-md-9">
            <div id="artist-product-description" class="panel panel-default">
                <div class="panel-heading">Description</div>
                <div class="panel-body">
                   {!! $product->description !!}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Items</div>
                <div class="panel-body">
                    <ul id="artist-product-items" class="list-group">
                        @foreach($product->items()->orderBy('order','ASC')->get() as $line_item)
                            <li id="line-item-{{ $line_item->id }}" class="artist-product-item list-group-item" data-sampleurl="{{ $line_item->sampleURL() }}">
                                <div class="order">
                                    #{{ $line_item->order+1 }}
                                </div>
                                <div class="name">
                                    {{ $line_item->name }}
                                </div>
                                <div class="wave">

                                </div>
                                <div class="sample">
                                    <button onclick="playItem('line-item-{{ $line_item->id }}')" class="btn btn-primary disabled">Play</button>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
            <div id="artist-product-description_tiny" class="panel panel-default hidden-lg hidden-md hidden-sm">
                <div class="panel-heading">Description</div>
                <div class="panel-body">
                    {!! $product->description !!}
                </div>
            </div>
        </div>
        <div id="artist-product-right-column" class="col-md-3">
            <h2 class="hidden-lg hidden-md hidden-sm text-center">{{ $product->name }}</h2>
            @if($product->image_key)
                <div id="product-image" class="panel">
                    <img src="{{ $product->downsizedImage() }}" />
                </div>
            @endif
            @include('misc.is_product_in_cart')
            @if(null !== $product)
                @if(!array_key_exists($product->id,(session()->exists('cart') ? session()->get('cart') : [])))
                    <div class="panel panel-default">
                        <div id="artist-product-price" class="panel-body">
                            <form id="add-to-cart" method="POST" action="{{ route('artist.store.product.add_to_cart',[$product->store->slug,$product->id]) }}">
                                {{ csrf_field() }}
                                @if($product->price !== null)
                                    @if($product->price === 0)
                                        Price: <strong>&pound;FREE</strong>
                                    @else
                                        Price: <strong>&pound;{{ number_format($product->price/100,2) }}</strong>
                                    @endif

                                    <input type="hidden" id="amount" readonly name="amount" value="{{ number_format($product->price/100,2) }}" />
                                @else
                                    Price: <strong>&pound;<span id="amount_price_display">{{ number_format((count($product->items)*60)/100,2) }}</span></strong> <br />
                                    <input type="hidden" id="amount" readonly name="amount" value="{{ number_format((count($product->items)*60)/100,2) }}" />
                                    <div id="amount_display"></div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" onclick="toggleCustomAmount(event)" />
                                        <label class="form-check-label" for="inlineCheckbox1"><i>Enter a custom amount</i></label>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                @endif
            @endif
            @if(count($other_products) > 0)
                <div id="artist-product-other-products" class="panel panel-default">
                    <p id="artist-product-other-products-more-from">More from <a href="{{ route('artist.store',$product->store->slug) }}">{{ $artist->artist_name }}</a></p>
                    @foreach($other_products as $other_product)
                        <a href="{{ route('artist.store.product',[$other_product->store->slug, $other_product->id]) }}">
                            <div class="row other-product">
                                <div class="col-xs-12">
                                    @if($other_product->image_key)
                                        <div class="other-product-image" style="background:url({{ $other_product->image_url }})">
                                            <div class="other-product-price">
                                                @if($other_product->price)
                                                    {{ number_format($other_product->price/100,2) }}
                                                @else
                                                    PWYW
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="other-product-name">
                                        {{ $other_product->name }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>

        var loaded_waves = [];

        $('.artist-product-item').each(function(index, item){
            var id = $(item).attr('id');

            var wavesurfer = WaveSurfer.create({
                container: '#'+id+' .wave',
                waveColor: '#007BFF',
                progressColor: '#0067D6',
                scrollParent: true
            });

            wavesurfer.on('finish', function () {
                var $button = $('#'+id+' .sample button');
                $button.text('Play');
                $button.attr('onclick','playItem("'+id+'")');
                $button.addClass('btn-primary');
                wavesurfer.stop();
            });

            wavesurfer.on('ready', function () {
                $('#'+id+' .sample button').removeClass('disabled');
            });

            wavesurfer.load($(item).data('sampleurl'));

            loaded_waves.push({
                id: $(item).attr('id'),
                wavesurfer: wavesurfer
            });
        });


        function playItem(id){
            loaded_waves.forEach(function(wave, index){

                if(id === wave.id){
                    wave.wavesurfer.playPause();
                    var $button = $('#'+wave.id+' .sample button');
                    $button.text('Pause');
                    $button.attr('onclick','pauseItem("'+wave.id+'")');
                    $button.removeClass('btn-primary');
                }else{
                    wave.wavesurfer.pause();
                    var $button = $('#'+wave.id+' .sample button');
                    $button.text('Play');
                    $button.attr('onclick','playItem("'+wave.id+'")');
                    $button.addClass('btn-primary');
                }
            });
        }

        function pauseItem(id){
            loaded_waves.forEach(function(wave, index){
                if(id === wave.id){
                    wave.wavesurfer.playPause();
                    var $button = $('#'+id+' .sample button');
                    $button.text('Play');
                    $button.attr('onclick','playItem("'+id+'")');
                    $button.addClass('btn-primary');
                }
            });
        }




        $( "#amount_display" ).slider({
            value: "{{ number_format((count($product->items)*60)/100,2) }}",
            range: "min",
            animate: true,
            orientation: "horizontal",
            min: 0.50,
            max: 15,
            step:0.10,
            slide: function( event, ui ) {
                $( "#amount" ).val(ui.value);
                $( "#amount_price_display" ).text(ui.value.toFixed(2));
            }
        });

        function updateProductPrice(e){
            if(e.target.value !== ""){
                $( "#amount_price_display" ).text(parseFloat(e.target.value).toFixed(2));
                $( "#amount" ).val(parseFloat(e.target.value).toFixed(2));
            }
        }


        function toggleCustomAmount(e){
            if(e.target.checked){
                $('#amount_display').html(
                        '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                                '<div class="input-group-text">&pound;</div>' +
                            '</div>' +
                            '<input class="form-control" type="number" name="amount" step="0.01" min="0.10" onkeyup="updateProductPrice(event)"/>' +
                        '</div>'
                );
                $( "#amount_display" ).slider("destroy");
            }else{
                $('#amount_display').html('');
                $( "#amount_display" ).slider({
                    value:$( "#amount" ).val(),
                    range: "min",
                    animate: true,
                    orientation: "horizontal",
                    min: 0.50,
                    max: 15,
                    step:0.10,
                    slide: function( event, ui ) {
                        $( "#amount" ).val(ui.value);
                        $( "#amount_price_display" ).text(ui.value.toFixed(2));
                    }
                });
            }
        }
    </script>
@endsection