@extends('layouts.app')

@section('title', 'Tag items in '.$product->name)

@section('content')
<div id="tag-items" class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Products in {{ $product->name }}</div>
                <div class="panel-body">
                    <p>
                        Drag any products you want to modify into the right column
                    </p>
                    <ul id="product-items" class="list-group">
                        @foreach($product->items()->orderBy('order','ASC')->get() as $item)
                            <li class="list-group-item">
                                {{ $item->name }}
                                <input type="hidden" name="items[]" value="{{ $item->id }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Items to modify</div>
                <div class="panel-body">
                    <p>
                        Items in this box will be affected when tags are applied.
                    </p>
                    <form id="items-to-modify-form" method="POST" action={{ route('store.products.product.tag_items', $product->id) }}>
                        {{ csrf_field() }}
                        <div id="items-to-modify">
                        </div>
                        <div id="tags-to-send">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Add Tags</div>
                <div class="panel-body">
                    <p>
                        To add tags, simply enter the tags you want and press enter, you are free to tag your products as you wish,
                        but please do remember to keep it "safe for work".
                    </p>
                    <div class="form-group">
                        <input id="tag-input" class="form-control" type="text" data-role="tagsinput" placeholder="Enter a tag and press [Enter]"/>
                    </div>
                    <button class="btn btn-primary" onclick="submitForm()">Set Product Tags</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>

        function submitForm() {
            var form = document.querySelector('#items-to-modify-form');
            form.submit();
        }

        $product_list = $("#product-items");
        $items_to_modify = $("#items-to-modify");

        $( "li", $product_list ).draggable({
            cancel: "a.ui-icon", // clicking an icon won't initiate dragging
            revert: "invalid", // when not dropped, the item will revert back to its initial position
            containment: "document",
            helper: "clone",
            cursor: "move"
        });

        $items_to_modify.droppable({
            accept: "#product-items > li",
            classes: {
                "ui-droppable-active": "ui-state-highlight"
            },
            drop: function( event, ui ) {
                selectItem( ui.draggable );
            }
        });

        $product_list.droppable({
            accept: "#items-to-modify li",
            classes: {
                "ui-droppable-active": "custom-state-active"
            },
            drop: function( event, ui ) {
                returnItem( ui.draggable );
            }
        });

        function selectItem( $item ) {
            $item.fadeOut("fast",function () {
                var $list = $("ul", $items_to_modify).length ?
                        $("ul", $items_to_modify) :
                        $("<ul class='gallery ui-helper-reset'/>").appendTo($items_to_modify);

                $item.find("a.ui-icon-trash").remove();
                $item.appendTo($list).fadeIn("fast");
            });
        }

        function returnItem( $item ) {
            $item.fadeOut("fast", function() {
                $item.appendTo( $product_list ).fadeIn("fast");
            });
        }

        function updateTags() {
            var tags = $("#tag-input").tagsinput('items');
            $('#tags-to-send').empty();
            tags.forEach(function(tag){
                $('#tags-to-send').append('<input type="hidden" name="tags[]" value="'+tag+'" />');
            });
        }

        $('#tag-input').on('itemAdded', updateTags);
        $('#tag-input').on('itemRemoved', updateTags);


    </script>
@endsection