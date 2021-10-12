@include('show_message')

<form action="{{route('add-video')}}" name="video_form" id="video_form" method="POST" enctype="multipart/form-data" class="validation-wizard wizard-circle">
    <!-- Step 1 -->
    <!--created branch -->
    {{csrf_field()}}
    <h6>Basic Info</h6>
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> Headline*:</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                    <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                </div>
                <div class="form-group">
                    <label for="myfile">Add Video:</label>
                    <input type="file" id="myfile" name="videofile">
                </div>
                <div class="form-group">
                    <label for="myfile">Thumbnail Image:</label>
                    <input type="file" id="myfile" name="thumbnail_image" value="{{ old('thumbnail_image') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2"> Photo editor*:</label>
                    <textarea class="form-control "  name="description" rows="3" value="{{ old('description') }}"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Video URL :</label>
                    <input type="text" class="form-control" value="{{old('video_url')}}" name="video_url">
                </div>
             
            </div>
        </div>
        <!-- </div> -->
    </section>
    <!-- Dynamic Tab -->
    <h6>Meta Information</h6>
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="wfirstName2"> Subtitle*:</label>
                    <input type="text" class="form-control" value="{{old('subtitle')}}" name="subtitle">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Summary*:</label>
                    <textarea class="form-control" id="short_description" name="short_description" rows="3" value="{{old('short_description')}}"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2"> Description*:</label>
                    <textarea class="form-control" name="description" rows="3" value="{{old('description')}}"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Location* :</label>
                    <input type="text" class="form-control" value="{{old('video_duration')}}" name="video_duration">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Location label:</label>
                    <input type="text" class="form-control" value="{{old('match_id')}}" name="match_id">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Location Search :</label>
                    <input type="text" class="form-control" value="{{old('video_scope')}}" name="video_scope">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Latitude :</label>
                    <input type="text" class="form-control" value="{{old('latitude')}}" name="latitude">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Longitude:</label>
                    <input type="text" class="form-control" value="{{old('match_formats')}}" name="match_formats">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Metadata* :</label>
                    <input type="text" class="form-control" value="{{old('keywords')}}" readonly name="keywords">
                </div>
            </div>
        </div>
    </section>
    <!-- End Dynamic Tab -->
    <!-- Step 2 -->
    <h6>Route restrictions</h6>
    <section>
        <div class="row">
            <div class="col-md-6" style="margin-bottom: 10px;">
                <div class="form-group">
                    <input type="checkbox" id="restrict" name="restrict" value="Bike">
                    <label for="vehicle1"> Restrict content to logged in users</label><br>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Meta Languages :</label>
                    <input type="text" class="form-control" value="{{old('meta_languages')}}"  name="meta_languages">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Langauge :</label>
                    <input type="text" class="form-control" value="{{old('langauge')}}"  name="langauge">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Asset Type :</label>
                    <input type="text" class="form-control" value="{{old('asset_type')}}" name="asset_type">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Created Date :</label>
                    <input type="text" class="form-control datepicker" value="{{old('created_date')}}" name="created_date">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Publish Date :</label>
                    <input type="text" class="form-control datepicker" value="{{old('publish_date')}}" name="publish_date">
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Expiry Date :</label>
                    <input type="text" class="form-control datepicker" value="{{old('expiry_date')}}" name="expiry_date">
                </div>
                </div>
               
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Total Viewcount :</label>
                    <input type="text" class="form-control" value="{{old('total_viewcount')}}"  name="total_viewcount">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Title Slug:</label>
                    <input type="text" class="form-control" value="{{old('slug')}}"  name="slug">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Thumbnail:<$geolocation ?? null/label>
                    <input type="text" class="form-control" value="{{old('thumbnail')}}"  name="thumbnail">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Varients:</label>
                    <input type="text" class="form-control" value="{{old('varients')}}"  name="varients">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Views Count:</label>
                    <input type="text" class="form-control" value="{{old('views_count')}}"  name="views_count">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Comments:</label>
                    <input type="text" class="form-control" value="{{old('comments')}}"  name="comments">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Platform:</label>
                    <input type="text" class="form-control" value="{{old('platform')}}"  name="platform">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Content:</label>
                    <input type="text" class="form-control" value="{{old('content')}}"  name="content">
                </div>
                </div>

            </div>
    </section>
    <!-- Step 3 -->
    <!-- <h6>Regions</h6>
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="shortDescription3">Regions*:</label>
                        <select id="regions_to_select" class="select2 m-b-10 select2-multiple " style="width:100%"  name="regions[]"  data-style="form-control" multiple>

                            <option value="IN" selected>India</option>
                            <option value="ROW" selected>Rest of the World</option>
                        </select>
                    </div>
                </div>
            </div>
        </section> -->
    <h6>Collapse &amp; Crew</h6>
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="wjobTitle2">Collapse &amp; slider :</label>
                    <label class="form-group">
                        Content references
                    </label>
                    <div class="form-group">
                        <label for="Selecttype"> Select type*:</label>
                        <select name="content_type" id="cars">
                            <option value="Text">Text</option>
                            <option value="Photo">Photo</option>
                            <option value="Video">Video</option>
                            <option value="Document">Document</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="wfirstName2"> Select a reference type to start your search*:</label>
                        <input type="text" class="form-control" value="" placeholder="Select a reference type to start your search" name="slug" >
                    </div>
                    <div class="form-group">
                        <label for="wfirstName2"> <a href="#">Frequents add</a></label>
                    </div>
                    <div class="form-group">
                        <label for="wfirstName2"> <a href="#">Recently Visited</a></label>
                    </div>
                    <div class="form-group">
                        <label for="wfirstName2"> <a href="#">Favourites</a></label>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Step 4 -->
    <h6>Tags</h6>
    <section>
        <div class="row">
            <div class="col-md-12">
                <?php //if(in_array($catalog_details['asset_type'], array('WATCH'))) { ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Search tag* :</label>
                        <input type="text" class="form-control" value="" name="alt_cover_image" placeholder="Alt Text for Image">
                    </div>
                </div>
                <div class="form-group">
                    <label for="wfirstName2"> <a href="#">Frequents add</a></label>
                </div>
                <div class="form-group">
                    <label for="wfirstName2"> <a href="#">Recently Visited</a></label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Select tag :-  :</label>
                        <select name="cars" id="cars">
                            <option value="Photo Type">Photo Type</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- <label for="wfirstName2"> Replace image*:</label> -->
                        <input type="text" class="form-control" value="There are no tags within this tag group." readonly  name="slug">
                    </div>
                </div>
            </div>
    </section>
    <h6>Related &amp; content</h6>
    <section>
        <div class="row">
            <div class="col-md-12">
                <?php //if(in_array($catalog_details['asset_type'], array('WATCH'))) { ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Search tag* :</label>
                        <input type="text" class="form-control" value="" name="alt_cover_image" placeholder="Alt Text for Image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Select tag :-  :</label>
                        <select name="cars" id="cars">
                            <option value="Text">Text</option>
                            <option value="Photo">Photo</option>
                            <option value="Video">Video</option>
                            <option value="Document">Document</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="wfirstName2"> <a href="#">Frequents add </a></label>
                </div>
                <div class="form-group">
                    <label for="wfirstName2"> <a href="#">Recently Visited</a></label>
                </div>
                <div class="form-group">
                    <label for="wfirstName2"> <a href="#">Favourites</a></label>
                </div>
            </div>
    </section>
</form>
