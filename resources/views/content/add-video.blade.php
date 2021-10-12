@include('show_message')

<form data-parsley-validate action="{{ route('add-video') }}" name="video_form" id="video_form" method="POST"
    enctype="multipart/form-data" class="validation-wizard wizard-circle frmactive">
    <!-- Step 1 -->
    <!--created branch -->
    {{ csrf_field() }}
    <h6>Basic Info</h6>
    <button type="button" id="collapsesidebar-btn" class="collapse-btn">
        <span> Collapse sidebar</span>
    </button>
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> Headline*:</label>
                    <input type="text" required class="form-control videotitle text-case" name="title"
                        value="{{ old('title') }}" required>
                </div>
            </div>

            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Publish Start Date :</label>
                    <input type="text" class="form-control publish dtpicker" autocomplete="off" value="{{ old('publish_date') }}" name="publish_date" id="publish_date">
                    <input type="time" class="form-control tmpicker" value="" name="">

                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Expiry Date :</label>
                    <input type="text" class="form-control expiry dtpicker" value="{{ old('expiry_date') }}" autocomplete="off" id="expiry_date" name="expiry_date">
                    <input type="time" class="form-control tmpicker" value="" name="">
                </div>
            </div> -->

            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> URL Segment:</label>
                    <br />
                    <div class="input_field">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="titleUrlSegment" onfocusout="save_url();"
                                    value="{{ old('titleUrlSegment', $singlevideo['titleUrlSegment'] ?? '') }}"
                                    readonly>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn" onclick="editable_segment();"><i
                                        class="glyphicon glyphicon-edit single_edit_icon" id="edit_field"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 clear-b">
                <div class="form-group">
                    <label for="myfile">Add Video*:</label>
                    <input type="file" class="dropify" accept="video/mp4,video/x-m4v,video/*" required
                        id="videofile" name="videofile" onchange="return fileValidation()">
                </div>
                <div id="imagePreview"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Thumbnail Image*:</label>
                    <input type="file" class="dropify" required accept="image/*" name="thumbnail_image"
                        value="{{ old('thumbnail_image') }}" id="thumbnail_image" onchange="return fileValidation1()">
                </div>
                <div id="imagePreview1"></div>
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2"> Photo editor :</label>
                    <textarea class="form-control "  name="description" rows="2" value="{{ old('description') }}"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Video URL :</label>
                    <input type="text" class="form-control" value="{{ old('video_url') }}" name="video_url">
                </div>

            </div> -->
        </div>
        <?php $get_country = countryList(); ?>
       
        <div class="row">
            <div class="col-md-12">
                <div class="form-right-content form-group geo-blocking">
                    <h3>Geo Blocking</h3>
                    <label for="shortDescription3">Custom Select country</label>
                    <select class="selectpicker form-control" name="country[]" multiple data-actions-box="true">
                    <option value="" disabled>Select Country</option>   
                        @foreach($get_country as $value)
                            <option value="{{ $value['country_id'] }}">{{ $value['country_name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- </div> -->
    </section>
    <!-- Dynamic Tab -->
    <h6>Meta Information</h6>
    <section>
        <div class="row">
            <!-- <div class="col-md-12">
                <div class="form-group">
                    <label for="wfirstName2"> Subtitle:</label>
                    <input type="text" class="form-control" value="{{ old('subtitle') }}" name="subtitle">
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Short Description*:</label>
                    <textarea class="form-control" required id="short_description" name="short_description" rows="3"
                        value="{{ old('short_description') }}"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2"> Description*:</label>
                    <textarea class="form-control" required name="description" rows="3"
                        value="{{ old('description') }}"></textarea>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Location :</label>
                    <input type="text" class="form-control" value="" name="location">
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Video Duration* :</label>
                    <input type="time" required placeholder="HH:mm:ss" class="form-control"
                        value="{{ old('duration') }}" name="duration">
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Location label:</label>
                    <input type="text" readonly class="form-control" value="{{ old('media_Id') }}" name="media_Id">
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="fullwidth" for="behName1">Location Search*:</label>
                    <input type="text" name="videolocationsearch" id="videolocationsearch" class="form-control"
                        placeholder="Choose Location" required>
                    <!-- <button type="button" class="location-search">Search</button> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Latitude :</label>
                    <input type="text" id="latitudevideo" name="latitudevideo" class="form-control" readonly>
                    <!-- <input type="text" readonly class="form-control" value="{{ old('latitude') }}" name="latitude"> -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Longitude:</label>
                    <input type="text" name="longitudevideo" id="longitudevideo" class="form-control" readonly>
                    <!-- <input type="text" readonly class="form-control" value="" name="longitude"> -->
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Video Scope:</label>
                    <input type="text" style="border-inline-color: red;" class="form-control" value="{{ old('video_scope') }}" name="video_scope">
                </div>
            </div> -->
            <?php $get_platform = platformList(); ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Platforms*:</label>
                    <select class="selectpicker"  multiple data-actions-box="true" name="platform[]" id="platform" required>
                        @foreach($get_platform as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Metadata Keywords :</label>
                    <input type="text" class="form-control tagsinput" value="" name="metadata[]">
                    <span class="help-block">Press Enter After Each Tag</span>
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="behName1">Keywords*:</label>
                    <input type="text" class="form-control tagsinput" value="{{ old('keywords') }}" name="keywords" required>
                    <span class="help-block">Press Enter After Each Tag</span>
                </div>
            </div>
        </div>

    </section>
    <!-- End Dynamic Tab -->
    <!-- Step 2 -->
    <h6>Route restrictions</h6>
    <section>
        <div class="row">
            <!-- <div class="col-md-6" style="margin-bottom: 10px;">
                <div class="form-group checkbox-al">
                    <input type="checkbox" id="restrict" name="restrict" value="Bike">
                    <label for="vehicle1"> Restrict content to logged in users</label><br>
                </div>
                </div> -->
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Meta Languages :</label>
                    <input type="text" class="form-control" value="{{ old('meta_languages') }}"  name="meta_languages">
                </div>
                </div> -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Language*:</label>
                    <select class="form-control FilterBylanguage" required name="language" id="language">
                        <option value="" disabled>Select Language</option>
                        @foreach ($data as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Asset Type :</label>
                    <input type="text" class="form-control" value="video" name="type" readonly>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Created Date :</label>
                    <input type="text" class="form-control datepicker" value="{{ old('created_date') }}" name="created_date">
                </div>
                </div> -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Publish Date*:</label>
                    <input type="date" class="form-control dtpicker publish_date" value="" name="publish_date"
                        required>
                    <input type="time" class="form-control tmpicker publish_time" value="" name="publish_time">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group ">
                    <label for="behName1">Expiry Date*:</label>
                    <input type="date" class="form-control dtpicker expiry_date" value="" name="expiryDate" required>
                    <input type="time" class="form-control tmpicker expiry_time" value="" name="expiryTime">
                    <div class="Expiryerror"></div>
                </div>
            </div>

            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Total Viewcount :</label>
                    <input type="text" class="form-control" value="{{ old('total_viewcount') }}"  name="total_viewcount">
                </div>
                </div> -->
            <!--<div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Title Slug*:</label>
                    <input type="text" class="form-control" value="{{ old('slug') }}"  name="slug">
                </div>
                </div>-->
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Thumbnail:</label>
                    <input type="text" class="form-control" value="{{ old('thumbnail') }}"  name="thumbnail">
                </div>
                </div> -->
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Varients:</label>
                    <input type="text" style="border-inline-color: red;" class="form-control" value="{{ old('varients') }}"  name="varients">
                </div>
                </div> -->
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Views Count:</label>
                    <input type="text" class="form-control" value="{{ old('views_count') }}"  name="views_count">
                </div>
                </div> -->
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Comments:</label>
                    <input type="text" class="form-control" value="{{ old('comments') }}"  name="comments">
                </div>
                </div> -->
            <div class="col-md-6" style="margin-top: 25px;">
                <div class="form-group">
                    <label for="behName1">Status*:</label>
                    <select class="form-control" name="current_status" id="current_status" required> 
                        <option value="" disabled>Select Status</option>
                        @foreach ($status as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
    </section>


    <div id="collapsingsidebar" class="collapssidebar">
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="content-ref">
                            <h2>Content references</h2>
                            <div class="reference-search">
                                <div class="reference-search__select-container ">
                                    {{-- <select class="reference-search-s content_ref" name="ref_type" data-type="referance">
                                        <option value="">Select type</option>
                                        <option value="text">TEXT</option>
                                        <option value="images">Photo</option>
                                        <option value="videos">Video</option>
                                        <option value="documents">Document</option>
                                    </select>

                                    <select class="form-control selectpicker referencesResponse" name="ref[]" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">
                                    </select>
                                    <div class="selectedvalue"></div> --}}
                                    <select class="reference-search-s" name='type_reference' id="reference_video">
                                        <option selected="selected" disabled="disabled">
                                            Select type</option>
                                        <option value="articles">Articles</option>
                                        <option value="images">Photos</option>
                                        <option value="playlists">Playlists</option>
                                        <option value="videos">Videos</option>
                                        <option value="audios">Audio</option>
                                        <option value="promos">Promos</option>
                                        <option value="documents">Documents</option>
                                        <option value="bios">Bios</option>
                                    </select>
                                    <select class="form-control selectpicker refclass_videos" name="ref[]"
                                        multiple="multiple" id="browsers" data-live-search="true" multiple
                                        data-actions-box="true" data-live-search="true" data-show-subtext="true">
                                    </select>
                                    <div class="selectedvalue" role="document"></div>

                                </div>

                                <ul class="added-freq">
                                    <li data-toggle="modal" data-target="#Favourites_model">
                                        <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added

                                    </li>
                                    <li data-toggle="modal" data-target="#Favourites_model">
                                        <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                                    </li>
                                    <li data-toggle="modal" data-target="#Favourites_model">
                                        <i class="mdi mdi-heart-outline fa-fw" data-icon="v"></i> Favourites
                                    </li>
                                </ul>

                            </div>
                        </div>

                        <div class="tagsinput1">
                            <h2>Tags*</h2>
                            <select class="form-control taginput-item" id="inputTag_videosxyz" name="tags_promos[]"
                                multiple="multiple">
                                <?php $get_tags = get_all_tags(); ?>
                                @foreach ($get_tags['data'] as $key => $t)
                                    <option value="{{ $t['label'] }}">
                                        {{ $t['label'] }}</option>
                                @endforeach
                            </select>
                            <ul class="added-freq">
                                <li data-toggle="modal" data-target="#Favourites">
                                    <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added
                                </li>
                                <li data-toggle="modal" data-target="#Favourites">
                                    <i class="mdi mdi-restore fa-fw" data-icon="v"></i>
                                    Recently Visited
                                </li>
                            </ul>
                        </div>


                        <div class="content-ref">
                            <h2>Related content</h2>
                            <div class="reference-search">
                                <div class="reference-search__select-container">
                                    {{-- <select class="reference-search-s content_ref" name="rel_type" data-type="related">
                                        <option value="">Select type</option>
                                        <option value="text">TEXT</option>
                                        <option value="images">Photo</option>
                                        <option value="videos">Video</option>
                                        <option value="documents">Document</option>
                                    </select>

                                    <select class="form-control selectpicker relatedResponse" name="rel[]"
                                        id="browsers" data-live-search="true" multiple data-actions-box="true"
                                        data-live-search="true" data-show-subtext="true">
                                    </select>
                                    <div class="selectedrelcont"></div> --}}
                                    <select name="type_content" id="contentId_videos" class="reference-search-s">
                                        <option disabled="disabled" selected="selected">
                                            Select type</option>
                                        <option value="articles">Articles</option>
                                        <option value="images">Photos</option>
                                        <option value="playlists">Playlists</option>
                                        <option value="videos">Videos</option>
                                        <option value="audios">Audio</option>
                                        <option value="promos">Promos</option>
                                        <option value="documents">Documents</option>
                                        <option value="bios">Bios</option>
                                    </select>
                                    <select class="form-control selectpicker contentClass_videos" name="content[]"
                                        id="browsers" data-live-search="true" multiple data-actions-box="true"
                                        data-live-search="true" data-show-subtext="true">
                                    </select>
                                    <div class="selectedrelcont" role="document"></div>
                                </div>

                                <ul class="added-freq">
                                    <li data-toggle="modal" data-target="#Favourites_model">
                                        <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added

                                    </li>
                                    <li data-toggle="modal" data-target="#Favourites_model">
                                        <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                                    </li>
                                    <li data-toggle="modal" data-target="#Favourites_model">
                                        <i class="mdi mdi-heart-outline fa-fw" data-icon="v"></i> Favourites
                                    </li>
                                </ul>
                                <div class="modal fade" id="Favourites" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="width: 60%; margin: 0 auto;">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h2>Click the add button to attach the content reference</h2>
                                            <select class="form-control selectpicker" id="browsers"
                                                data-live-search="true" multiple data-actions-box="true"
                                                data-live-search="true" data-show-subtext="true">
                                                <!-- <option>
                                                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Step 4 -->
    <!--<h6>Tags</h6>
    <section>
        <div class="row">
            <div class="col-md-12">
                <?php //if(in_array($catalog_details['asset_type'], array('WATCH'))) {
                ?>
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
    <!--
                        <input type="text" class="form-control" value="There are no tags within this tag group." readonly  name="slug">
                    </div>
                </div>
            </div>
    </section>-->
    <!--
    <h6>Related &amp; content</h6>
    <section>
        <div class="row">
            <div class="col-md-12">
                <?php //if(in_array($catalog_details['asset_type'], array('WATCH'))) {
                ?>
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
    </section>-->
    <div class="modal fade" id="Favourites_model" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 60%; margin: 0 auto;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2>Click the add button to attach the content reference</h2>
                <select class="form-control selectpicker" id="browsers" data-live-search="true" multiple
                    data-actions-box="true" data-live-search="true" data-show-subtext="true">
                    <option>
                        <h2>India’s squad for WTC Final and Test series against England announced</h2> <span
                            class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                            154375</span>
                    </option>
                    <option>
                        <h2>India’s squad for WTC Final and Test series against England announced</h2> <span
                            class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                            154375</span>
                    </option>
                    <option>
                        <h2>India’s squad for WTC Final and Test series against England announced</h2> <span
                            class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                            154375</span>
                    </option>
                    <option>
                        <h2>India’s squad for WTC Final and Test series against England announced</h2> <span
                            class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                            154375</span>
                    </option>
                    <option>
                        <h2>India’s squad for WTC Final and Test series against England announced</h2> <span
                            class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                            154375</span>
                    </option>
                    <option>
                        <h2>India’s squad for WTC Final and Test series against England announced</h2> <span
                            class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                            154375</span>
                    </option>
                    <option>
                        <h2>India’s squad for WTC Final and Test series against England announced</h2> <span
                            class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                            154375</span>
                    </option>
                    <option>
                        <h2>India’s squad for WTC Final and Test series against England announced</h2> <span
                            class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                            154375</span>
                    </option>
                    <option>
                        <h2>India’s squad for WTC Final and Test series against England announced</h2> <span
                            class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                            154375</span>
                    </option>
                    <option>
                        <h2>India’s squad for WTC Final and Test series against England announced</h2> <span
                            class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                            154375</span>
                    </option>
                </select>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset('js/video/video.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $("#videos button#collapsesidebar-btn").click(function() {
            $('#videos #collapsingsidebar').toggleClass("collapse-deactive");
            $('#videos section.body').toggleClass("collapse-deactive");
            $("#videos button#collapsesidebar-btn").text(function(i, v) {
                return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
            });
        });
        // start loader and dropdown
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.refclass_videos',
            function() {

                $("#collapsingsidebar .reference-search .inner").append(
                    '<button type="button" class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
                $("#collapsingsidebar .reference-search .inner").append(
                    '<div class="loader-background"><div class="loader"></div></div>'
                );
                //if ($('select.refclass_videos option').length != 0) {
                //    $('.loader-background').hide();
                //}
                for (let i = 1; i <= $('select.refclass_videos option').length; i++) {
                    if (i == $('select.refclass_videos option').length) {
                        console.log(i + "==" + $('select.refclass_videos option').length);
                        $('.loader-background').hide();
                    }
                }
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.contentClass_videos',
            function() {

                $("#collapsingsidebar .reference-search .inner").append(
                    '<button type="button" class="addtocontentrefrence" id="add-sels"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
                $("#collapsingsidebar .reference-search .inner").append(
                    '<div class="loader-background"><div class="loader"></div></div>'
                );
                for (let i = 1; i <= $('select.contentClass_videos option').length; i++) {
                    if (i == $('select.contentClass_videos option').length) {
                        console.log(i + "==" + $('select.contentClass_videos option').length);
                        $('.loader-background').hide();
                    }
                }
                //if ($('select.contentClass_videos option').length != 0) {
                //    $('.loader-background').hide();
                //}
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.refclass_videos',
            function() {
                $('.dropdown.bootstrap-select.form-control.refclass_videos').on('click', 'button#add-sel',
                    function() {

                        var optionsselected = $("select.refclass_videos").val();
                        console.log(optionsselected);
                        //$('.selectedvalue').html("");
                        $.each(optionsselected, function(i, x) {

                            $('.selectedvalue').append('<div class="selectedcol ">' + x +
                                '<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>'
                            )

                        });

                    });
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.contentClass_videos',
            function() {
                $('.dropdown.bootstrap-select.form-control.contentClass_videos').on('click',
                    'button#add-sels',
                    function() {
                        var optionsselected = $("select.contentClass_videos").val();
                        //$('.selectedrelcont').html("");
                        $.each(optionsselected, function(i, x) {

                            $('.selectedrelcont').append('<div class="selectedcol ">' + x +
                                '<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>'
                            )

                        });

                    });
            });
        $('.selectedvalue').on('click', '#close-selected', function() {
            $(this).parents('.selectedcol').fadeOut();
        });
        $("button.close.btn.innerpopup").click(function() {
            $('#Favourites').modal('hide');
        });
        // end selected and loider


    });
</script>
<script>
    function editable_segment() {
        $('input[name="titleUrlSegment"]').removeAttr("readonly");
    }

    function save_url() {
        $('input[name="titleUrlSegment"]').attr("readonly", "readonly");
    }
    $(document).ready(function() {
        $("#headline_title").keyup(function() {
            $("input").css("background-color", "pink");
        });


        $("#content_reference").change(function() {
            var selectedValue = $('#content_reference :selected').val();
            getDataByContentValue(selectedValue, 'content_reference_div');
        });


        $("#related_content").change(function() {
            var selectedValue = $('#related_content :selected').val();
            getDataByContentValue(selectedValue, 'related_content_div');
        });

        function getDataByContentValue(value, selectTagId) {
            $.ajax({
                url: APP_URL + '/commonSearchForReferenceAndContent',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'serarch_value': value,
                },
                dataType: "text",
                success: function(data) {
                    var response = $.parseJSON(data);
                    if (response.length > 0) {
                        for (var i = 0; i < response.length; i++) {
                            $('#' + selectTagId).append('<option value="' + response[i]['ID'] +
                                '">' + response[i]['title'] + '</option>');
                        }
                    } else {
                        optionData += '<select>No Data</select>';
                    }
                    $("#" + selectTagId).selectpicker("refresh");
                }
            });
        }

    });
</script>
<script>
    $(document).ready(function() {
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.referencesResponse',
            function() {
                $("#collapsingsidebar .reference-search .inner").append(
                    '<button type="button" class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.relatedResponse',
            function() {
                $("#collapsingsidebar .reference-search .inner").append(
                    '<button type="button" class="addtocontentrefrence" id="add-sels"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.referencesResponse',
            function() {
                $('.dropdown.bootstrap-select.form-control.referencesResponse').on('click',
                    'button#add-sel',
                    function() {

                        var optionsselected = $("select.referencesResponse").val();
                        // var optionsselected =  $(".referencesResponse option:selected").text();

                        console.log(optionsselected);
                        $('.selectedvalue').html("");
                        $.each(optionsselected, function(i, x) {

                            $('.selectedvalue').append('<div class="selectedcol ">' + x +
                                '<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>'
                            )

                        });

                    });
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.relatedResponse',
            function() {
                $('.dropdown.bootstrap-select.form-control.relatedResponse').on('click', 'button#add-sels',
                    function() {
                        var optionsselected = $("select.relatedResponse").val();
                        $('.selectedrelcont').html("");
                        $.each(optionsselected, function(i, x) {

                            $('.selectedrelcont').append('<div class="selectedcol ">' + x +
                                '<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>'
                            )

                        });

                    });
            });
        $('.selectedvalue').on('click', '#close-selected', function() {
            $(this).parents('.selectedcol').fadeOut();
        });
        $("button.close.btn.innerpopup").click(function() {
            $('#Favourites').modal('hide');
        });

    });
</script>

<script>
    $(document).ready(function() {
        $("#reference_video").on('change', function() {
            var ref = $(this).val();
            if (ref != undefined && ref != null) {
                $.ajax({
                    type: "POST",
                    url: "/commonsearch",
                    data: {
                        type: ref
                    },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {

                        $('select.refclass_videos').empty();
                        $('select.refclass_videos').selectpicker('destroy');
                        $('select.refclass_videos').selectpicker();
                        $.each(res.data, function(index, value) {
                            var option = '<option value="<h2>' + value.title +
                                '</h2> <span>' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span>ID:' + value
                                .ID + '</span>"><h2>' + value.title +
                                '</h2> <span>' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span>ID:' + value
                                .ID + '</span></option>';
                            // var option = '<option value="'+value.title + "*" +value.ID+'</span>"><h2>'+value.title +'</h2> <span>'+value.language +'|'+ 'Last updated 31/08/2021</span> <span>ID:'+value.ID+'</span></option>';
                            $('select.refclass_videos').append(option);
                        });
                        $('select.refclass_videos').selectpicker('refresh');

                        if ($('select.refclass_videos option').length != 0) {
                            $('.loader-background').hide();
                        }
                    },
                    error: function() {
                        return false;
                    },
                    complete: function() {
                        console.log('complete');
                    }
                })
            }

        });



        // Releted
        $("#contentId_videos").on('change', function() {
            var ref = $(this).val();
            if (ref != undefined && ref != null) {
                $.ajax({
                    type: "POST",
                    url: "/commonsearch",
                    data: {
                        type: ref
                    },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        $('select.contentClass_videos').empty();
                        $('select.contentClass_videos').selectpicker('destroy');
                        $('select.contentClass_videos').selectpicker();
                        $.each(res.data, function(index, value) {
                            var option = '<option value="<h2>' + value.title +
                                '</h2> <span>' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span >ID:' + value
                                .ID + '</span>"><h2>' + value.title +
                                '</h2> <span class="lan">' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span class="id">ID:' +
                                value.ID + '</span></option>';
                            $('select.contentClass_videos').append(option);
                        });

                        if ($('select.contentClass_videos option').length != 0) {
                            $('.loader-background').hide();
                        }
                        $('select.contentClass_videos').selectpicker('refresh');
                    },
                    error: function() {
                        return false;
                    },
                    complete: function() {
                        console.log('complete');
                    }
                })
            }

        });
        // ALERT
        $("#inputTag_videos").select2({
            minimumInputLength: 2,
            tags: [],
            ajax: {
                url: "/articletagList",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                success: function(res) {
                    console.log(res.data);
                    $.each(res.data, function(index, value) {
                        console.log(value.label);
                        var option = '<option>' + value.label + '</option>';
                        $('#inputTag_videos').append(option);
                    });
                    $(".taginput-item").select2({
                        tags: true,
                        tokenSeparators: [',', ' ']
                    })
                },
            }
        });

        // End Tags Search
    });
</script>
