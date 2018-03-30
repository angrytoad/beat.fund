@extends('layouts.app')

@section('title', $item->name)

@section('content')
<div id="line-item" class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $item->name }}</div>
                <div class="panel-body">
                    <div id="waveform"></div>
                    <div id="time">

                    </div>
                    <hr />
                    <div id="play-pause">
                        <button class="btn btn-primary" onclick="playItem()">
                            <i class="fas fa-play"></i>
                            Play
                        </button>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-6">
                            <div id="line-item-tags" class="panel panel-default">
                                <div class="panel-heading">Tags</div>
                                <div class="panel-body">
                                    @foreach($item->tags as $tag)
                                        <div class="tag" data-tagid="{{$tag->id}}" onclick="toggleSelectedTag(event)">{{ $tag->name }}</div>
                                    @endforeach
                                    @if(count($item->tags) === 0)
                                        <p>You don't have any tags yet, why not <a href="{{route('store.products.product.tag_items',$item->product->id)}}">add some?</a></p>
                                    @else
                                        <hr />
                                        <a href="{{route('store.products.product.tag_items',$item->product->id)}}"><button class="btn btn-primary">Add tags</button></a>

                                        <form id="delete-selected-tags-form" method="POST" action="{{ route('store.products.product.item.tags.delete',[$item->product->id,$item->id]) }}">
                                            {{ csrf_field() }}
                                            <button type="button" id="delete-selected-tags" class="btn btn-danger" onclick="confirmTagDelete()">Delete selected tags</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">Actions</div>
                                <div class="panel-body">
                                    <ul id="line-item-actions-list">
                                        <a href="{{ route('store.products.product.item.delete', [$item->product->id, $item->id]) }}">
                                            <li><button class="btn btn-danger">Delete <strong>{{ $item->name }}</strong></button></li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $('#play-pause').hide();

        var wavesurfer = WaveSurfer.create({
            container: '#waveform',
            waveColor: '#007BFF',
            progressColor: '#0067D6'
        });

        wavesurfer.load('{!! $item->signedURL() !!}');

        wavesurfer.on('ready', function () {
            $('#play-pause').fadeIn();
        });

        function playItem(){
            wavesurfer.play();
            $('#play-pause').html(
                    '<button class="btn btn-default" onclick="pauseItem()">' +
                        '<i class="fas fa-pause"></i> ' +
                        'Pause' +
                    '</button>'
                )
        }

        function pauseItem(){
            wavesurfer.pause();
            $('#play-pause').html(
                    '<button class="btn btn-primary" onclick="playItem()">' +
                        '<i class="fas fa-play"></i> ' +
                        'Play' +
                    '</button>'
                )
        }

        var selected_tags = [];
        function toggleSelectedTag(e){
            var $tag = $(e.target);
            var tag_id = $tag.data('tagid');

            var found = -1;
            selected_tags.forEach(function(tag,index){
               if(tag === tag_id){
                   found = index;
               }
            });

            if(found > -1){
                $tag.removeClass('selected');
                selected_tags.splice(found,1);
            }else{
                $tag.addClass('selected');
                selected_tags.push(tag_id);
            }

            if(selected_tags.length > 0){
                $('#delete-selected-tags').text('Delete selected tags ('+selected_tags.length+')');
            }else{
                $('#delete-selected-tags').text('Delete selected tags');
            }

        }

        function confirmTagDelete() {
            if(selected_tags.length > 0){
                vex.dialog.confirm({
                    message: 'Are you sure you want to remove the '+selected_tags.length+' selected tags from {{ $item->name }}?',
                    callback: function (value) {
                        if(value){
                            $form = $('#delete-selected-tags-form');
                            selected_tags.forEach(function(tag){
                                $form.append('<input type="hidden" name="tags[]"  value="'+tag+'" />');
                            });
                            document.querySelector('#delete-selected-tags-form').submit();
                        }
                    }
                })
            }else{
                vex.dialog.alert('You need to select some tags first.')
            }
        }
    </script>
@endsection