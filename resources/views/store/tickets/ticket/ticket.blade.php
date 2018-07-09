@extends('layouts.app')

@section('title', $ticket->name)

@section('content')
<div id="edit-ticket" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.tickets.ticket', $ticket) }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $ticket->name }}</div>
                <div class="panel-body">
                    @if($ticket->live)
                        @if($ticket->has_ticket_expired())
                            <div class="alert alert-danger">
                                This ticket has expired, this means it is no longer purchasable on the store.
                            </div>
                        @else
                            <div class="alert alert-success">
                                This ticket is live, this means it can be purchased through the store.
                            </div>
                            <form id="set-pending-form" method="POST" action="{{ route('store.tickets.ticket.set_pending', $ticket->id) }}">
                                {{ csrf_field() }}
                                <button class="btn btn-warning">Set Pending</button>
                            </form>
                        @endif
                    @else
                        <div class="alert alert-warning">
                            This ticket is pending, this means it cannot be purchased through the store, set it live to
                            start selling it!
                        </div>
                        <form id="set-live-form" method="POST" action="{{ route('store.tickets.ticket.set_live', $ticket->id) }}">
                            {{ csrf_field() }}
                            <button class="btn btn-success">Set Live</button>
                        </form>
                    @endif

                    @if($ticket->live)
                            <a href="{{ route('storefront.tickets.ticket', $ticket->slug) }}">
                                <button class="btn btn-info">View Ticket Page</button>
                            </a>
                    @else
                            <a href="{{ route('store.tickets.ticket.preview', $ticket->id) }}">
                                <button class="btn btn-info">View Preview</button>
                            </a>
                    @endif
                    <hr />
                    @if($ticket->live)
                        <p class="lead">
                            Ticket analytics and check in rates coming soon!
                        </p>
                    @else
                        <form id="edit-ticket-form" action="{{ route('store.tickets.ticket', $ticket->id) }}" method="POST">
                            {{ csrf_field() }}
                            <h4>Event/Gig Details</h4>
                            <div class="form-group">
                                <label>Name<span class="text-danger">&#42;</span></label>
                                <input value="{{ $ticket->name or old('name', '') }}" id="event-name-input" type="text" class="form-control" name="name" placeholder="Event name" required onkeyup="changeEventName(event)"/>
                            </div>
                            <div class="form-group">
                                <label>Event Description<span class="text-danger">&#42;</span></label>
                                <div id="description"></div>
                                <input type="hidden" name="description" value="{{ $ticket->description or old('description', '') }}"/>
                                <input type="hidden" name="description_delta" value="{{ $ticket->description_delta or old('description_delta', '') }}"/>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Time<span class="text-danger">&#42;</span></label>
                                        <input size="16" type="text" name="start" value="{{ $ticket->start or old('start', '') }}" placeholder="Enter a start time" readonly class="form-control form_datetime" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Time<span class="text-danger">&#42;</span></label>
                                        <input size="16" type="text" name="end" value="{{ $ticket->end or old('end', '') }}" placeholder="Enter a end time" readonly class="form-control form_datetime" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Location<span class="text-danger">&#42;</span></label>
                                        <p>
                                            To help buyers, please enter an identifiable name of where your Event is located, E.G The Five Swans, NE1 7PG
                                        </p>
                                        <input type="text" name="location" class="form-control" value="{{ $ticket->location or old('location', '') }}" placeholder="Location name" required />
                                        <hr />
                                        <label>Location on Map<span class="text-danger">&#42;</span> | <button type="button" id="map-button" class="btn btn-primary btn-xs">Select Location</button></label>
                                        <div id="map"></div>
                                        <div id="location-picked" class="alert alert-success">
                                            You're currently selected location is:
                                            <br />
                                            <strong>Latitude: </strong><span id="latitude-label">{{ $ticket->latitude or old('latitude', '') }}</span>
                                            <br />
                                            <strong>Longitude: </strong><span id="longitude-label">{{ $ticket->longitude or old('longitude', '') }}</span>
                                        </div>
                                        <input class="form-control" id="latitude" type="hidden" value="{{ $ticket->latitude or old('latitude', '') }}" name="latitude" />
                                        <input class="form-control" id="longitude" type="hidden" value="{{ $ticket->longitude or old('longitude', '') }}" name="longitude" />
                                    </div>
                                </div>
                            </div>

                            <hr />
                            <h4>Ticket Details</h4>
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
                                            @if($ticket->price !== null)
                                                @if(old('price'))
                                                    <input type="number" name="price" class="form-control" step="any" placeholder="Enter a price" min="0" value="{{ number_format(old('price'),2) }}" />
                                                @else
                                                    <input type="number" name="price" class="form-control" step="any" placeholder="Enter a price" min="0" value="{{ number_format($ticket->price/100,2) }}" />
                                                @endif
                                            @else
                                                <input type="number" name="price" readonly class="form-control" step="any" placeholder="Enter a price" min="0" value="{{ $ticket->price or old('price', '') }}" />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-info">
                                        <div class="panel-body text-left">
                                            <p>
                                                Currently selected: <strong><span id="pricing_type">Fixed Pricing</span></strong>
                                            </p>
                                            @if($ticket->price !== null)
                                                <input type="checkbox" data-on-text="Fixed" data-off-text="PWYW" data-off-color="primary" name="pricing_type" checked data-toggle="toggle" data-size="small">
                                            @else
                                                <input type="checkbox" data-on-text="Fixed" data-off-text="PWYW" data-off-color="primary" name="pricing_type" data-toggle="toggle" data-size="small">
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <input id="banner-image-input" type="hidden" name="image" value="{{ $ticket->banner_key or old('image', '') }}" />
                            <input id="background_color" type="hidden" name="background_color" value="{{ $ticket->background_color or old('background_color', '#F4F9FF') }}" />
                        </form>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Page Settings</h4>
                                <p>
                                    Edit settings about the page where your tickets can be purchased from.
                                </p>
                                <hr />
                                <div class="form-group">
                                    <label>Page Background Color (Optional)</label>
                                    <i class="fas fa-times text-danger" onclick="resetBackgroundColor()" title="Reset color"></i>
                                    <br />
                                    <input id="background_color_picker" type="color" value="{{ $ticket->background_color or old('background_color', '#F4F9FF') }}" name="background_color" onchange="changeBackgroundColor(event)"/>
                                </div>
                                <div class="form-group">
                                    <label>Banner Image (Optional)</label>
                                    <i class="fas fa-times text-danger" onclick="resetBannerImage()" title="Reset banner"></i>
                                    <p>
                                        If you know what image you'd like to use for your product you can upload it now, otherwise you can add it
                                        at a later point.
                                    </p>

                                    <form action="{{ route('store.tickets.create.image') }}" class="dropzone" id="ticket-image" style="background: url({{ $ticket->banner_url }}); background-size:cover; background-position: center">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Page Preview</h4>
                                <p>See a rough preview of what your page may look like with your chosen options.</p>
                                <hr />
                                <div id="page-preview">
                                    <div id="page-preview-inner">
                                        <div id="page-preview-banner" class="event-name-banner">
                                            Your Event Name
                                        </div>
                                        <div id="page-preview-event-name" class="event-name">
                                            Your Event Name
                                        </div>
                                        <div id="page-preview-information">
                                            <small>
                                                <div class="event-description">
                                                    <p>
                                                        Enter a description to preview it.
                                                    </p>
                                                </div>
                                            </small>
                                        </div>
                                        <div id="page-preview-location">
                                            <strong>Location</strong>
                                            <img width="100%" style="background:white; border:1px solid #ddd;" src="/images/misc/google_maps_1.jpg" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary" onclick="submitForm()">Save Changes</button>
                                <a href="{{ route('store.tickets.ticket.delete',$ticket->id) }}">
                                    <button class="btn btn-danger btn-xs pull-right">Delete Ticket</button>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>

        $(document).ready(function(){
            @if($ticket->banner_key === null)
                $('#page-preview-banner').html($('#event-name-input').val());
            @else
                $('#page-preview-banner').html('<img src="{{ $ticket->banner_url }}" />');
            @endif
            $('#page-preview').css('background',$('#background_color').val());
        });

        /**
         * Background Color Stuff
         **/
        function changeBackgroundColor(e){
            console.log(e.target.value);
            $('#background_color').val(e.target.value);
            $('#page-preview').css('background',e.target.value);
        }

        function resetBackgroundColor(){
            $('#background_color').val("#F4F9FF");
            $('#background_color_picker').val("#F4F9FF");
            $('#page-preview').css('background',"#F4F9FF");

        }

        /**
         * Submit Form
         **/
        function submitForm(){
            $('#edit-ticket-form').submit();
        }

        /**
         * Event Name Change
         **/
        function changeEventName(e){
            if($('#banner-image-input').val() === ""){
                $('.event-name-banner').html(e.target.value);
            }
            $('.event-name').html(e.target.value);
        }

        /**
         * DROPZONE
         **/
        Dropzone.autoDiscover = false;
        $('#ticket-image').dropzone({
            paramName: 'file',
            maxFilesize: 5, // MB
            maxFiles: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            init: function() {
                this.on("success", function(file, response) {
                    var image = document.querySelector('input[name=image]');
                    image.value = response.file_name;

                    $('#page-preview-banner').html('<img src="'+response.source_file+'" />');
                    $('#ticket-image').attr('style','');
                });

                this.on("error", function(file, response) {
                    alert(response);
                });
            }
        });

        function resetBannerImage(){
            let dz = Dropzone.forElement("#ticket-image");
            dz.removeAllFiles();
            $('#page-preview-banner').html($('#event-name-input').val());
            $('#ticket-image').attr('style','');

        }



        $(".form_datetime").datetimepicker();

        var locationPicker = new locationPicker('map',
            {
                setCurrentPosition: false, // You can omit this, defaults to true
                lat: parseFloat({{ $ticket->latitude or old('latitude', '') }}),
                lng: parseFloat({{ $ticket->longitude or old('longitude', '') }}),
            },
            {
                zoom: 15
            }
        );

        $('#map-button').click(function(){
            // Get current location and show it in HTML
            var location = locationPicker.getMarkerPosition();

            $('#latitude').val(location.lat);
            $('#latitude-label').text(location.lat);

            $('#longitude').val(location.lng);
            $('#longitude-label').text(location.lng);

            $('#location-picked').removeClass('hidden');

            console.log(location);
            $(this).notify("Location Saved",{
                position:"top",
                className:"success"
            });
        });

        function switchTicketPricing(event, state) {
            if(state){
                $('#pricing_type').text('Fixed Pricing');
                $('#price input').removeAttr('readonly').val('');
            }else{
                $('#pricing_type').text('Pay what you want');
                $('#price input').attr('readonly','true').val('');
            }
        }

        $("[name='pricing_type']").bootstrapSwitch('onSwitchChange', switchTicketPricing);

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

        $("#description_delta").val(JSON.stringify({!! $ticket->description_delta or old('description_delta', '') !!}));
        quill.setContents({!! $ticket->description_delta !!});

        quill.on('text-change', function(delta, oldDelta, source) {
            var description = document.querySelector('input[name=description]');
            description.value = $('.ql-editor').html();
            $('.event-description').html($('.ql-editor').html());

            var delta_input = document.querySelector('input[name=description_delta]');
            delta_input.value = JSON.stringify(quill.getContents());
        });
    </script>
@endsection