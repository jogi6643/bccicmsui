@extends('base')
@section('epic_content')
    <?php $type = isset($_GET['type']) ? $_GET['type'] : ''; ?>
    {{-- <?php //error_reporting(E_ALL & ~E_NOTICE);
?> --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- My add file -->
    <!-- Tiny MCE editor -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- include libraries(jQuery, bootstrap) -->
    <!-- summernote -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
                                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                                        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
                                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
    <!-- End summernote-->
    <!-- <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
                                         <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
                                          <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script> -->

    <style type="text/css">
        .modal-title {
            margin: 0;
            line-height: 1.42857143;
            text-align: center;
            color: #1a457d;
            font-weight: 400;
        }

    </style>

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active"><a href="{{ url('uploadcontent') }}">Upload Content</a></li>
                <!-- <li class="active"></li> -->
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>


    <div class="modal-dialog modal-lg" style="width:100%">
        <div class="modal-content">
            <div class="modal-header upload" style="padding:5px 15px;">

                <h4 class="card-title head-title">Update Article</h4>
            </div>
            <div class="modal-body upload-body">
                @include('show_message')
                <div class="row">
                    <div class="col-12">
                        <div class="white-box">
                            <div class="card-body wizard-content">

                                <h6 class="card-subtitle uploadcont">Complete All the steps to update</h6>
                                <label class="control-label uplcont">Asset Type</label>
                                <div class="">
                                    <select class=" form-control"
                                        name="asset_type" id="asset_type" disabled>
                                        <option value="">Select</option>
                                        <option value="articles" selected>Articles</option>
                                        <option value="photos">Photos</option>
                                        <option value="playlists">Playlists</option>
                                        <option value="videos">Videos</option>
                                        <option value="audio">Audio</option>
                                        <option value="promos">Promos</option>
                                        <option value="documents">Documents</option>
                                        <option value="bios">Bios</option>
                                        </select>
                                    </div>
                                {{-- $edit_data['content_type'] ?? '' --}}
                                {{-- <div class="">
                            <select class="form-control" name="asset_type" id="asset_type" onchange="assettype()" >
                                <option value="">Select</option>
                                <option value="articles">Articles</option>
                                <option value="photos">Photos</option>
                                <option value="playlists">Playlists</option>
                                <option value="videos" <?php if ($type == 'videos') {
    echo 'selected';
} ?>>Videos</option>
                                <option value="audio">Audio</option>
                                <option value="promos">Promos</option>
                                <option value="documents">Documents</option>
                                <option value="bios">Bios</option>
                            </select>
                        </div> --}}
                                <!--  -->
                                <div id="articles">
                                    <form data-parsley-validate action="{{ route('updateArticle') }}" name="article_form"
                                        id="article_form" method="post" enctype="multipart/form-data"
                                        class="validation-wizard wizard-circle">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="article_id" name="article_id"
                                            value="{{ $edit_data['ID'] }}">
                                        <input type="hidden" name="from" value="{{ $_GET['from'] ?? 'articleslist' }}">
                                        <button type="button" id="collapsesidebar-btn" class="collapse-btn">
                                            <span> Collapse
                                                sidebar</span>
                                        </button>
                                        <h6>Basic Info</h6>
                                        <section>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2"> Headline*:</label>
                                                        <input type="text" id="headline" required class="form-control"
                                                            value="{{ $edit_data['title'] }}" name="title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">

                                                        <label for="wfirstName2"> Short Description*:</label>
                                                        <input type="text"  class="form-control"
                                                            value="{{ $edit_data['description'] ?? '' }}"
                                                            name="description" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!--
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Subtitle:</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $edit_data['subtitle'] ?? '' }}" name="subtitle">
                                                    </div>-->
                                                    <!-- <div class="col-md-6"> -->
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Language*:</label>
                                                        <select class="form-control"  name="language">
                                                            @foreach ($language as $key  => $value)
                                                                <option value="{{ $key }}" {{ $edit_data['language'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                        <!-- <input type="text" class="form-control"
                                                                                                value="{{ $edit_data['language'] ?? '' }}" name="language"> -->

                                                    </div>
                                                    <!-- </div> -->
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Content Type:</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $edit_data['content_type'] ?? '' }}"
                                                            name="content_type" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Author*:</label>
                                                        <input type="text"  class="form-control"
                                                            value="{{ $edit_data['author'] ?? '' }}" name="author" required>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Article Owner:</label>
                                                        <input type="text" class="form-control" value="{{ $edit_data['article_owner'] ?? '' }}" name="article_owner">
                                                    </div>
                                                </div> -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Photo:</label>
                                                        <input type="file" class="form-control dropify" value=""
                                                            name="photo"
                                                            data-default-file="{{ $edit_data['image_url'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                                <!-- <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="wfirstName2">Video Duration:</label>
                                                                                    <input type="text" class="form-control" value="{{ $edit_data['video_duration'] ?? '' }}" name="video_duration">
                                                                                </div>
                                                                            </div> -->
                                                <!-- <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="wfirstName2">Match Id:</label>
                                                                                    <input type="text" class="form-control" value="{{ $edit_data['match_Id'] ?? '' }}" name="match_id">
                                                                                </div>
                                                                            </div>
                                                                                    <div class="col-md-6">

                                                                                    </div>
                                                                                    <div class="col-md-6">

                                                                                    </div>-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Url Segment*:</label>
                                                        <input type="text" id="urlsegment"required class="form-control"
                                                            value="{{ $edit_data['titleUrlSegment'] ?? '' }}"
                                                            name="urlsegment">
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Additional Info*:</label>
                                                        <input type="text" class="form-control" required
                                                            value="{{ !is_array($edit_data['additionalInfo']) ? $edit_data['additionalInfo'] : '' }}"
                                                            name="additionalInfo">
                                                    </div>
                                                </div>


                                                {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="wfirstName2">LeadMedia:</label>

                                                            <input type="text" class="form-control" value="{{$edit_data['leadMedia']['imageUrl']??''}}" name="leadMedia">
                                                        </div>
                                                    </div> --}}



                                                <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Match Formats:</label>
                                                        <input type="text" class="form-control" value="{{ $edit_data['match_formats'] ?? '' }}" name="match_formats">
                                                    </div>
                                                </div> -->

                                                <!-- <div class="col-md-6">
                                                        <div class="form-group " style="margin-top: 25px">
                                                            <label for="behName1" class="fullwidth">Location Search
                                                                :</label>
                                                            <button type="button" class="location-search">Search</button>
                                                        </div>
                                                    </div> -->



                                                {{-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">References:</label>
                                                        <input type="text" class="form-control" value="{{(!is_array($edit_data['references'])) ? $edit_data['references'] : ''}}" name="references">
                                                    </div>
                                                </div> --}}

                                                {{-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Current Status:</label>
                                                        <input type="text" class="form-control" value="{{$edit_data['current_status']??''}}" name="current_status">
                                                    </div>
                                                </div> --}}


                                                <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Total Viewcount:</label>
                                                        <input type="text" class="form-control" value="{{ $edit_data['total_viewcount'] ?? '' }}" name="total_viewcount">
                                                    </div>
                                                </div> -->
                                                <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Slug:</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $edit_data['slug'] ?? '' }}" name="slug">
                                                    </div> -->
                                                <!-- <div class="form-group">
                                                            <label for="wfirstName2">Summary:</label>
                                                            <input type="text" class="form-control" value="{{ $edit_data['summary'] }}" name="summary">
                                                        </div> -->
                                                <!-- </div> -->

                                                {{-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Platform:</label>
                                                        <input type="text" class="form-control" value="{{$edit_data['platform']??''}}" name="platform">
                                                    </div> --}}

                                                {{-- <div class="form-group">
                                                <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                                                <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="myfile">Subtitle</label>
                                                    <input type="file" id="myfile" name="myfile">
                                                </div> --}}
                                                {{-- </div> --}}


                                                <!-- <div class="
                                                            col-md-6">
                                                        <div class="form-group">
                                                            <label for="wlastName2">Summary</label>
                                                            <textarea class="form-control " required name="summary"
                                                                rows="3">{{ $edit_data['summary'] ?? '' }}</textarea>
                                                        </div>
                                                    </div> -->

                                                    <!-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="wlastName2">Description</label>
                                                            <textarea class="form-control " required name="description" rows="3" >{{ $edit_data['description'] ?? '' }}</textarea>
                                                        </div>
                                                    </div> -->



                                            </div>
                                        </section>
                                        <h6>Meta Information</h6>
                                        <section>
                                            <div class="row">
                                                <!-- <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="wfirstName2"> Author</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                </div> -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wemailAddress2"> Read time (seconds)</label>
                                                        <textarea class="form-control" name rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wlastName2"> Hotlink URL*</label>
                                                        <textarea class="form-control" name="hotlinkUrl"
                                                            rows="3" required>{{ $edit_data['hotlinkUrl'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group date-time">
                                                        <label for="behName1">Display date</label>
                                                        <input type="date" class="form-control dtpicker"
                                                            placeholder="23/08/2021" value="">
                                                        <input type="time" class="form-control  tmpicker" value=""
                                                            placeholder="time 10:30">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Published By:</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $edit_data['published_by'] ?? '' }}"
                                                            name="published_by">
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Publish Date*:</label>
                                                        <input type="date" class="form-control dtpicker"
                                                            value="{{ $publishdate ?? '' }}"
                                                            name="publish_date" required>
                                                        <input type="time" class="form-control tmpicker" value="{{ $publishtime ?? '' }}"  name="publish_time" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Expiry Date*:</label>
                                                        <input type="date" class="form-control dtpicker"
                                                            value="{{ $expiredate ?? '' }}"
                                                            name="expiryDate" required>
                                                        <input type="time" class="form-control tmpicker" value="{{ $expiretime ?? '' }}" name="expiryTime">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" style="margin-top: 25px">
                                                        <label for="wfirstName2">Location Search*:</label>
                                                        <input type="text" name="location_search" id="location_search"
                                                            value="{{ $edit_data['location'] ?? '' }}"
                                                            class="form-control" placeholder="Choose Location" required>
                                                        <!-- <input type="text" class="form-control"
                                                                value="{{ $edit_data['location'] ?? '' }}" name="location"> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6" >
                                                    <div class="form-group">
                                                        <label for="behName1">Latitude :</label>
                                                        <input type="text" id="latitude" name="latitude"
                                                            class="form-control" value="{{ $edit_data['latitude'] ?? '' }}" readonly>
                                                        <!-- <input type="text" class="form-control" readonly value=""
                                                                name="latitude"> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="behName1">Longitude:</label>
                                                        <input type="text" name="longitude" id="longitude"
                                                            class="form-control" value="{{ $edit_data['longitude'] ?? '' }}" readonly>
                                                        <!-- <input type="text" class="form-control" readonly value=""
                                                                name="longitude"> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $get_tags = platformList();
                                                $selected = json_decode($edit_data['platform']);
                                                ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="myfile">Platform*:</label>
                                                        <select class="selectpicker"  multiple data-actions-box="true" required="" id="feild"name="platform[]" value="{{ old('platform') }}">
                                                            @foreach ($get_tags as $key => $value)
                                                                <option value="{{ $key }}" {{ (in_array($key, $selected)) ? 'selected' : '' }}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Status:*</label>
                                                        <select name="current_status" id="cars" class="form-control" required>
                                                        <option value="" disabled>Select Status</option>
                                                            @foreach ($status as $key  => $value)
                                                                <option value="{{ $key }}" {{ $edit_data['current_status'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="behName1">Keywords*:</label>
                                                    <input type="text" name="keywords" required class="form-control" value="{{$edit_data['keywords']}}">
                                                </div>
                                            </div> 
                                        </div>  
                                            <!--
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2">Keywords:</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $edit_data['keywords'] ?? '' }}" name="keywords">
                                                    </div>
                                                </div>
                                            </div> -->

                                                <!-- <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label class="fullwidth" for="behName1">Location
                                                                                                Search</label>
                                                                                            <button type="button" class="location-search">Search</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="behName1">Location label</label>
                                                                                            <input type="text" class="form-control" value="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="behName1">Latitude</label>
                                                                                            <input type="text" class="form-control" value="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="behName1">Longitude</label>
                                                                                            <input type="text" class="form-control" value="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="behName1">Metadata* :</label>
                                                                                            <input type="text" class="form-control" value="" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </section>
                                                                            {{-- <h6>Segmentation</h6> --}}
                                                                            {{-- <section>
                                <div class="row">
                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                        <div class="form-group checkbox-al">
                                            <input type="checkbox" id="restrict" name="restrict" value="Bike">
                                            <label for="vehicle1"> Restrict content to logged in users</label><br>
                                        </div>
                                    </div>
                                </div>
                            </section> --}}
                                                                            {{-- <h6>Collapse &amp; sidebar</h6> --}}
                                                                            {{-- <section>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img class="image"
                                                 src="{{(isset($edit_data['image_url']) && !is_array($edit_data['image_url'])) ? $edit_data['image_url'] : ''}}" width="400">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="wjobTitle2">celebration Photo ID: 154923</label>
                                                <label for="wjobTitle2">Country Code IN</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}-->
                                        </section>
                                        {{-- <h6>Content &amp; references</h6> --}}
                                        <h6>Segmentation</h6>
                                        <section>
                                            <div class="row">
                                                <div class="col-md-12" style="margin-bottom: 10px;">
                                                    <div class="form-group checkbox-al">
                                                        <input type="checkbox" id="restrict" name="restrict" value="Bike">
                                                        <label for="vehicle1"> Restrict content to logged in
                                                            users</label><br>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $get_country = countryList();?>
                                            <div class="row">
                                                 <div class="col-md-12">
                                                        <div class="form-right-content form-group geo-blocking">
                                                            <h3>Geo Blocking </h3>
                                                            <label for="shortDescription3">Custom Select country</label>
                                                            <select class="selectpicker form-control" name="country[]" multiple data-actions-box="true">
                                                            <option value="" disabled>Select Country</option>   
                                                                @foreach($get_country as $value)
                                                                @if($edit_data['geo_blocking'] !='')
                                                                    <option value="{{ $value['country_id'] }}" {{ (in_array($value['country_id'], $edit_data['geo_blocking'])) ? 'selected' : '' }}>{{ $value['country_name']}}</option>
                                                                @else                                                                 
                                                                <option value="{{ $value['country_id'] }}" >{{ $value['country_name']}}</option>
                                                                @endif
                                                                @endforeach
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>

                                        </section>

                                        <div id="collapsingsidebar" class="collapssidebar">
                                          {{-- // code remove --}}
                                          @include('releted_references.edit-content-reference');
                                        </div>

                                        <!--

                                                                    <h6>Tags</h6>
                                                                    <section>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <?php //if(in_array($catalog_details['asset_type'], array('WATCH'))) {
                                                                                ?>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="behName1">Search tag* :</label>
                                                                                        <input type="text" class="form-control" value="" name="alt_cover_image"
                                                                                               placeholder="Alt Text for Image">
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
                                                                                        <label for="behName1">Select tag :- :</label>
                                                                                        <select name="cars" id="cars">
                                                                                            <option value="Photo Type">Photo Type</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </section>
                                                                    <h6>Related &amp; content</h6>
                                                                    <section>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <?php //if(in_array($catalog_details['asset_type'], array('WATCH'))) {
                                                                                ?>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="behName1">Search tag* :</label>
                                                                                        <input type="text" class="form-control" value="" name="alt_cover_image"
                                                                                               placeholder="Alt Text for Image">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="behName1">Select tag :- :</label>
                                                                                        <select>
                                                                                            <option selected="selected" disabled="disabled" value="">Select type</option>
                                                                                            <option value="TEXT">TEXT</option>
                                                                                            <option value="PHOTO">PHOTO</option>
                                                                                            <option value="VIDEO">VIDEO</option>
                                                                                            <option value="AUDIO">AUDIO</option>
                                                                                            <option value="DOCUMENT">DOCUMENT</option>
                                                                                            <option value="PLAYLIST">PLAYLIST</option>
                                                                                            <option value="PROMO">PROMO</option>
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
                                                                        </div>
                                                                    </section>-->
                                        <div class="row">
                                            <div class="col-md-12 bodycontent">
                                                <div class="form-group">
                                                    <label for="wlastName2">BContent*</label>
                                                    <textarea class="ckeditor form-control" required id="content"
                                                        name="body">{{ $edit_data['body'] ?? '' }}</textarea>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div id="playlists" style="display: none;">
                        @include('content.playlists')
                    </div>
                    <div id="videos" style="display: none;">
                        @include('content.videos')
                    </div>
                    <div id="audio" style="display: none;">
                        @include('content.audio')
                    </div>
                    <div id="promos" style="display: none;">
                        @include('content.promos')
                    </div>
                    <div id="documents" style="display: none;">
                        @include('content.documents')
                    </div>
                    <div id="bios" style="display: none;">
                        @include('content.bios')
                    </div>
                    <div id="photos" style="display: none;">
                        @include('content.photos')
                    </div> --}}
                                <input class="save_content_draft btn btn-primary" type="button" style="float:right;"
                                    value="Draft" name="draft_btn"></button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->


    <!-- Modal -->
    <div class="modal fade" id="finish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <h3 class="modal-title" id="exampleModalLongTitle">Data has been save successfully</h5>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Submit</button> -->
                    </div>
            </div>
        </div>
    </div>



    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
                                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
                                        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>
    <!-- summernote css/js -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
                                        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
                                        <script type="text/javascript">
                                            $('#summernote').summernote({
                                                height: 400
                                            });
                                        </script> -->


    <!-- <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#ckeditor').ckeditor();
                                            });
                                        </script> -->
    <script src="{{ asset('js/articles/articles.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/content_refernce/content_refernce.js') }}" type="text/javascript"></script>
    <script src="https://cdn.tiny.cloud/1/5orxol55pinopywbk09yrbw1ryxu73rl6q0r6h29utlwe1s9/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key=AIzaSyDetZZwXV4c_mQULaCiJLJvT8Z_XYhfQbI&libraries=places"></script>
    <script>
        $(document).ready(function() {
            $("#latitudeArea").addClass("d-none");
            $("#longtitudeArea").addClass("d-none");
        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var input = document.getElementById('location_search');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());

                $("#latitudeArea").removeClass("d-none");
                $("#longtitudeArea").removeClass("d-none");
            });
        }
    </script>
    <script>
        tinymce.init({
            selector: '#content',
            // file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
            // edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
            // view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
            // insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
            // format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight | forecolor backcolor | removeformat' },
            // tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
            // table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
            // help: { title: 'Help', items: 'help' },
            plugins: 'fullscreen code undo redo lists link anchor table media mediaembed paste',
            menubar: false,
            // menubar: 'view tools',
            // toolbar: 'fullscreen code undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent'
            toolbar: 'fullscreen code | undo redo | cut copy paste pastetext | styleselect | bold italic underline removeformat | numlist bullist outdent indent | link anchor | table | media',
            audio_template_callback: function(data) {
                return '<audio controls>' + '\n<source src="' + data.source + '"' + (data.sourcemime ?
                    ' type="' + data.sourcemime + '"' : '') + ' />\n' + (data.altsource ? '<source src="' +
                    data.altsource + '"' + (data.altsourcemime ? ' type="' + data.altsourcemime + '"' :
                        '') + ' />\n' : '') + '</audio>';
            }
            // mediaembed_service_url: 'SERVICE_URL',
            // mediaembed_max_width: 450


            // plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            // toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
            // toolbar_mode: 'floating',
            // tinycomments_mode: 'embedded',
            // tinycomments_author: 'Author name',
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#headline").keyup(function() {
            var Text = $('#headline').val()
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $("#urlsegment").val(Text);   
        })

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>

@stop
