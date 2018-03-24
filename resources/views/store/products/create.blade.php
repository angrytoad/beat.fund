@extends('layouts.app')

@section('title', 'Create a product')

@section('content')
<div id="create-product" class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Create a product</div>
                <div class="panel-body">
                    <form id="create-product-form" action="{{ route('store.products.create') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input class="form-control" type="text" name="name" placeholder="The name that will appear on your store." value="{{ old('name') }}" />
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Product Description</label>
                                    <div id="description"></div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-6">
                                <label>Fixed Pricing/Pay What you want</label>
                                <p>
                                    Our promise to put control into your hands means you have flexibility when it comes to pricing
                                    your product, set a fixed price or let users pay what they want for it. You can read more
                                    about pricing <a target="_blank" href="{{ route('help.store.products.pricing') }}">here.</a>
                                </p>
                                <div id="price" class="form-group">
                                    <label>Price</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="input-group-text" id="basic-addon1">&pound;</span>
                                        </div>
                                        <input type="number" name="price" class="form-control" placeholder="Enter a price E.G. £0.69" min="0" value="{{ old('price') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-info">
                                    <div class="panel-body text-left">
                                        <p>
                                            Currently selected: <strong><span id="pricing_type">Fixed Pricing</span></strong>
                                        </p>
                                        <input type="checkbox" data-on-text="Fixed Pricing" data-off-text="Pay what you want" data-off-color="primary" name="pricing_type" checked data-toggle="toggle" data-size="small">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Inputs -->
                        <input type="hidden" name="description" value="{{ old('description') }}" />
                        <input type="hidden" name="delta" value="{{ old('delta') }}" />
                        <input type="hidden" name="image" value="{{ old('image') }}" />
                    </form>
                    <hr />
                    <div class="row">
                        <div class="col-md-12">
                            <label>Product Image (Optional)</label>
                            <p>
                                If you know what image you'd like to use for your product you can upload it now, otherwise you can add it
                                at a later point.
                            </p>
                            <form action="{{ route('store.products.create.image') }}" class="dropzone" id="product-image">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary" onclick="submitForm()">Create Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">Make the description count</div>
                <div class="panel-body">
                    <p>
                        Did you know you can extensively format your description? Want to add titles and hyper links? go for it!
                    </p>
                    <p>
                        Your description is what lets fans understand what the products is, short descriptions with little information will
                        not help customers to make an informed purchase.
                    </p>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Fixed Pricing or PWYW?</div>
                <div class="panel-body">
                    <p>
                        Working out whether to use Fixed Pricing for your product or "Pay what you want" can be difficult. Here is a little more
                        info to help you make the choice that's right for you.
                    </p>
                    <hr />
                    <label>Fixed Pricing:</label><br />
                    <p>
                        Fixed pricing can be great if you want a consistency when fans purchase your music, knowing you get a fixed
                        amount of money from each purchase can be good, but you have to put some thought into what you feel is a fair price
                        for fans to pay. Fixed pricing in general will generate less sales but with a higher average payment per product.
                    </p>
                    <label>Pay what you want:</label><br />
                    <p>
                        Pay what you want add some uncertainty, because fans can pay anywhere from &pound;0.01 to &pound;&pound;&pound;
                        for your music. Often it can be beneficial as fans may pay you more than the average for your music to help support you, Pay what you want
                        in general will generate more sales with a lower average payment per product.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>

        function submitForm() {
            document.getElementById("create-product-form").submit();
        }

        function switchProductPricing(event, state) {
            if(state){
                $('#pricing_type').text('Fixed Pricing');
                $('#price input').removeAttr('readonly').val('');
            }else{
                $('#pricing_type').text('Pay what you want');
                $('#price input').attr('readonly','true').val('');
            }
        }

        $("[name='pricing_type']").bootstrapSwitch('onSwitchChange', switchProductPricing);

        Dropzone.options.productImage = {
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

        @if(old('delta'))
            quill.setContents({!! old('delta') !!});
        @endif

        quill.on('text-change', function(delta, oldDelta, source) {
            var description = document.querySelector('input[name=description]');
            description.value = $('.ql-editor').html();

            var delta_input = document.querySelector('input[name=delta]');
            delta_input.value = JSON.stringify(quill.getContents());
        });
    </script>
@endsection