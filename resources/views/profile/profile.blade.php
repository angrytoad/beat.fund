@extends('layouts.app')

@section('title', Auth::user()->first_name.'\'s profile')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('profile') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')

            @if(Auth::user()->profile->getCompletionPercentage() < 100)
                <div class="panel panel-success">
                    <div class="panel-heading">Profile Progress</div>
                    <div class="panel-body">
                        <span class="text-muted">Profile completion</span>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ Auth::user()->profile->getCompletionPercentage() }}%" aria-valuenow="{{ Auth::user()->profile->getCompletionPercentage() }}" aria-valuemin="0" aria-valuemax="100">{{ Auth::user()->profile->getCompletionPercentage() }}%</div>
                        </div>
                        <p>
                            Your profile is <strong>{{ Auth::user()->profile->getCompletionPercentage() }}%</strong> complete, finish creating
                            your profile so you can start creating a store.
                        </p>
                    </div>
                </div>
            @endif

            @if(Auth::user()->profile->getCompletionPercentage() === 100)
                <div class="panel panel-success">
                    <div class="panel-heading">Create a Store</div>
                    <div class="panel-body">
                        <span class="text-muted">Profile completion</span>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ Auth::user()->profile->getCompletionPercentage() }}%" aria-valuenow="{{ Auth::user()->profile->getCompletionPercentage() }}" aria-valuemin="0" aria-valuemax="100">{{ Auth::user()->profile->getCompletionPercentage() }}%</div>
                        </div>

                        <p>
                            Thanks for having a complete profile! You may now go and <a href={{ route('store.create') }}>Create a Store.</a>
                        </p>
                    </div>
                </div>
            @endif

        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->first_name }}'s Profile</div>
                <div class="panel-body">
                    <p>
                        Edit the information shown on your store below.
                    </p>
                    <hr />
                    <form id="profile_editing_form" action="{{ route('profile') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="artist_name">Artist/Band name</label>
                            <input type="text" class="form-control" name="artist_name" id="artist_name"
                                   aria-describedby="artist_name_help" placeholder="E.g. The Stone Roses"
                                   value="{{ $profile->artist_name or old('artist_name', '') }}" />
                            <small id="artist_name_help" class="form-text text-muted">This name will be used to identify your store on the website.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="artist_bio">Artist/Band Bio</label>
                                <textarea class="form-control" name="artist_bio" id="artist_bio" rows="6"
                                          placeholder="Let the world know a bit about you." >{{ $profile->artist_bio or old('artist_bio', '') }}</textarea>
                                <small id="artist_bio_help" class="form-text text-muted">Tell customers a little bit about yourself.</small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="favourite_genre">Favorite Genres</label>
                                    <input type="text" class="form-control" name="favourite_genre" id="favourite_genre"
                                           aria-describedby="favourite_genre_help" value="{{ $profile->favourite_genre or old('favourite_genre', '') }}"
                                           placeholder="E.g. Alternative Rock, Indie Rock, Madchester" />
                                    <small id="favourite_genre_help" class="form-text text-muted">Let users know what genres of music you support</small>
                                </div>
                                <div class="form-group">
                                    <label for="artist_website">Artist/Band Website</label>
                                    <input type="text" class="form-control" name="artist_website" id="artist_website"
                                           aria-describedby="artist_website_help" value="{{ $profile->artist_website or old('artist_website', '') }}"
                                           placeholder="E.g. http://www.thestoneroses.org/" />
                                    <small id="artist_website_help" class="form-text text-muted">If you have a merch store, why not add it here?</small>
                                </div>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group">
                            <label for="favourite_genre">Social Links</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control" id="social_channel" name="social_channel">
                                        <option value="twitter">Twitter</option>
                                        <option value="facebook">Facebook</option>
                                        <option value="instagram">Instagram</option>
                                        <option value="youtube">Youtube</option>
                                        <option value="soundcloud">Soundcloud</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary" onClick="addSocialLinkToForm();">Add Social Page</button>
                                </div>
                            </div>
                            <small id="favourite_genre_help" class="form-text text-muted">Show your customers where they can see more of you.</small>
                        </div>
                        <div id="social_page_container">
                            @if(count(old('social_link')) > 0)
                                @foreach(old('social_link') as $key => $social_link)
                                    <div class="row" link_number={{ $key }}>
                                        <div class="col-md-1 social_icon">
                                            @if($social_link['type'] === 'other')
                                                <i class="fas fa-bullhorn"></i>
                                            @else
                                                <i class="fab fa-{{ $social_link['type'] }}"></i>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <input type="hidden" id="social_type" name="social_link[{{$key}}][type]"  value="{{ $social_link['type'] }}"/>
                                            @if(array_key_exists('id',$social_link))
                                                <input type="hidden" id="social_type" name="social_link[{{$key}}][id]"  value="{{ $social_link['id'] }}"/>
                                            @endif
                                            <input type="text" class="form-control" name="social_link[{{$key}}][link]" id="social_link" placeholder="Enter full website address" value="{{ $social_link['link'] }}">
                                        </div>
                                        <div class="col-md-1 remove_icon" onclick="removeSocialLinkFromForm('{{ $key }}')">
                                            <i class="fas fa-times text-danger"></i>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @foreach($profile->profile_links as $profile_link)
                                @php ($found = false)
                                @if(old('social_link'))
                                    @foreach(old('social_link') as $key => $social_link)
                                        @if(array_key_exists('id',$social_link) && $social_link['id'] === $profile_link->id)
                                                @php ($found = true)
                                        @endif
                                    @endforeach
                                @endif
                                @if(!$found)
                                    <div class="row" link_number={{ $profile_link->id }}>
                                        <div class="col-md-1 social_icon">
                                            @if($profile_link->type === 'other')
                                                <i class="fas fa-bullhorn"></i>
                                            @else
                                                <i class="fab fa-{{ $profile_link->type }}"></i>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <input type="hidden" id="social_type" name="social_link[{{$profile_link->id}}][type]"  value="{{ $profile_link->type }}"/>
                                            <input type="hidden" id="social_type" name="social_link[{{$profile_link->id}}][id]"  value="{{ $profile_link->id }}"/>
                                            <input type="text" class="form-control" name="social_link[{{$profile_link->id}}][link]" id="social_link" placeholder="Enter full website address" value="{{ $profile_link->link }}">
                                        </div>
                                        <div class="col-md-1 remove_icon" onclick="removeSocialLinkFromForm('{{ $profile_link->id }}')">
                                            <i class="fas fa-times text-danger"></i>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <hr />
                        <div class="form-group">
                            <label for="business_email">Business Email</label>
                            <input type="text" class="form-control" name="business_email" id="business_email"
                                   aria-describedby="business_email_help" value="{{ $profile->business_email or old('business_email', '') }}"
                                   placeholder="E.g. ian@thestoneroses.org" />
                            <small id="business_email_help" class="form-text text-muted">We do not reveal your business email to the public.</small>
                        </div>
                        <hr />
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>

                    <!-- DONT REMOVE THIS -->
                    <div id="social_page_form_group" class="hidden">
                        <div class="row">
                            <div class="col-md-1 social_icon">
                                <i class="fab fa-soundcloud"></i>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" id="social_type" />
                                <input type="text" class="form-control" id="social_link" placeholder="Enter full website address">
                            </div>
                            <div class="col-md-1 remove_icon">
                                <i class="fas fa-times text-danger"></i>
                            </div>
                        </div>
                    </div>
                    <!-- DONT REMOVE THOS -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        function addSocialLinkToForm()
        {
            var selected_social_channel = $('#social_channel').val();

            if(selected_social_channel === "other"){
                $('#social_page_form_group .social_icon').html('<i class="fas fa-bullhorn"></i>');
            }else{
                $('#social_page_form_group .social_icon').html('<i class="fab fa-'+selected_social_channel+'"></i>');
            }

            var number_of_existing_rows = $('#social_page_container').children().length;

            $('#social_page_form_group .col-md-6 #social_type').attr('name','social_link['+number_of_existing_rows+'][type]').val(selected_social_channel);
            $('#social_page_form_group .col-md-6 #social_link').attr('name','social_link['+number_of_existing_rows+'][link]');

            $('#social_page_form_group .remove_icon').attr('onclick', 'removeSocialLinkFromForm(\''+number_of_existing_rows+'\')');
            $('#social_page_form_group .row').attr('link_number',number_of_existing_rows);


            $('#social_page_container').append($('#social_page_form_group').html());
        }

        function removeSocialLinkFromForm(row)
        {
            $.each($('#social_page_container').children(), function(k, v){
                console.log(v);
                console.log(row);
                if($(v).attr('link_number') === row){
                    $(v).remove();
                }
            });
        }
    </script>
@endsection