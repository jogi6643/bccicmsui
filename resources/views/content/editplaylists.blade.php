<?php
// echo "1234567";
// echo "<pre>";
// print_r($edit_data);
// exit;
?>

@extends('base')
@section('epic_content')
    <?php $type = isset($_GET['type']) ? $_GET['type'] : ''; ?>
    <?php error_reporting(E_ALL & ~E_NOTICE); ?>
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
    <div class="modal-dialog modal-lg" style="width:100%">
        <div class="modal-content">
            <div class="modal-header upload" style="padding:5px 15px;">

                <h4 class="card-title head-title">Update Playlist</h4>
            </div>
            <div class="modal-body upload-body">
                @include('show_message')
                <div class="row">
                    <div class="col-12">
                        <div class="white-box">
                            <div class="card-body wizard-content">

                                <h6 class="card-subtitle">Complete All the steps to update</h6>
                                <label class="control-label">Asset Type</label>
                                <div class="">
                                    <select class=" form-control"
                                        name="asset_type" id="asset_type" disabled>
                                        <option value="">Select</option>
                                        <option value="articles">Articles</option>
                                        <option value="photos">Photos</option>
                                        <option value="playlists" selected>Playlists</option>
                                        <option value="videos">Videos</option>
                                        <option value="audio">Audio</option>
                                        <option value="promos">Promos</option>
                                        <option value="documents">Documents</option>
                                        <option value="bios">Bios</option>
                                        </select>
                                    </div>
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
                                <div id="playlists">
                                    <form action="{{ route('updateVedio') }}" method="post" id="playlist_form"
                                        name="playlist_form" enctype="multipart/form-data"
                                        class="validation-wizard wizard-circle">
                                        {{ csrf_field() }}
                                        <!-- Step 1 -->
                                        <button type="button" id="collapsesidebar-btn" class="collapse-btn">
                                            <span> Collapse sidebar</span>
                                        </button>
                                        <h6>Basic Info</h6>
                                        <section>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wfirstName2"> Title*:</label>
                                                        <input type="text" class="form-control text-case"
                                                            value="{{ $edit_data['title'] }}" id="title" name="title" required>
                                                        <input type="hidden" class="form-control"
                                                            value="{{ $edit_data['ID'] }}" id="videolist_id"
                                                            name="videolist_id">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wlastName2">Url Segment</label>
                                                        <input type="text" name="titleUrlSegment" id="titleUrlSegment"
                                                            onfocusout="save_url();"
                                                            value="{{ $edit_data['url_segment'] }}" readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wlastName2">Headline*</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $edit_data['headline'] }}" id="headline"
                                                            name="headline" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wlastName2">Asset Type*</label>
                                                        <select id="playlist_type" name="playlist_type" required=""
                                                            class="form-control">
                                                            <option value="" disabled>Standard playlist</option>
                                                            <option value="TEXT">TEXT</option>
                                                            <option value="PHOTO">PHOTO</option>
                                                            <option value="VIDEO">VIDEO</option>
                                                            <option value="AUDIO">AUDIO</option>
                                                            <option value="DOCUMENT">DOCUMENT</option>
                                                            <option value="PLAYLIST">PLAYLIST</option>
                                                            <option value="PROMO">PROMO</option>
                                                            <option value="LIVE_BLOG">LIVE_BLOG</option>
                                                            <option value="BIO">BIO</option>
                                                            <option value="CRICKET_TOURNAMENTGROUP">CRICKET_TOURNAMENTGROUP
                                                            </option>
                                                            <option value="CRICKET_TOURNAMENT">CRICKET_TOURNAMENT</option>
                                                            <option value="CRICKET_MATCH">CRICKET_MATCH</option>
                                                            <option value="CRICKET_TEAM">CRICKET_TEAM</option>
                                                            <option value="CRICKET_SQUAD">CRICKET_SQUAD</option>
                                                            <option value="CRICKET_PLAYER">CRICKET_PLAYER</option>
                                                            <option value="CRICKET_VENUE">CRICKET_VENUE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="behName1">Publish Date*</label>
                                                        <input type="date" class="form-control dtpicker"
                                                            value="{{ $publishdate ?? '' }}"
                                                            name="publish_date" required>
                                                        <input type="time" class="form-control tmpicker" value="{{ $publishtime ?? '' }}"  name="publish_time" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label for="wlastName2" class="wdt">Expiry Date*</label>
                                                        <input type="date" class="form-control dtpicker"
                                                            value="{{ $expiredate ?? '' }}"
                                                            name="expiryDate" required>
                                                        <input type="time" class="form-control tmpicker" value="{{ $expiretime ?? '' }}" name="expiryTime">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row" style="padding-top:25px">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wlastName2">Status*</label>
                                                        <select id="current_status" name="current_status"
                                                            class="form-control" required>
                                                            <option value=""disabled>Select Status</option>
                                                            @foreach ($status as $key  => $value)
                                                                <option value="{{ $key }}" {{ $edit_data['current_status'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php $get_tags = platformList(); 
                                                 
                                                 ?>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label for="myfile">Platform*:</label>
                                                        <select class="selectpicker"  multiple data-actions-box="true" required="" id="feild"name="platform[]" value="{{ old('platform') }}">
                                                             @foreach($get_tags as $key => $value)
                                                            
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                            
                                                            @endforeach
                                                        </select>
                                                        <p class=""></p>
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
                                                    <!-- <div class="form-group">
                                                                        <label for="myfile">Playlist settings</label>
                                                                        <select>
                                                                            <option value="" disabled="disabled" class="">Select playlist type</option>
                                        <option label="Standard playlist" value="boolean:false">Standard playlist</option>
                                                                            <option label="Smart playlist" value="boolean:true">Smart playlist</option>
                                                                        </select>
                                                                        <select>All types</option>
                                                                            <option value="TEXT">TEXT</option>
                                                                            <option value="PHOTO">PHOTO</option>
                                                                            <option value="VIDEO">VIDEO</option>
                                                                            <option value="AUDIO">AUDIO</option>
                                                                            <option value="DOCUMENT">DOCUMENT</option>
                                                                            <option value="PLAYLIST">PLAYLIST</option>
                                                                            <option value="PROMO">PROMO</option>
                                                                            <option value="LIVE_BLOG">LIVE_BLOG</option>
                                                                            <option value="BIO">BIO</option>
                                                                            <option value="CRICKET_TOURNAMENTGROUP">CRICKET_TOURNAMENTGROUP</option>
                                                                            <option value="CRICKET_TOURNAMENT">CRICKET_TOURNAMENT</option>
                                                                            <option value="CRICKET_MATCH">CRICKET_MATCH</option>
                                                                            <option value="CRICKET_TEAM">CRICKET_TEAM</option>
                                                                            <option value="CRICKET_SQUAD">CRICKET_SQUAD</option>
                                                                            <option value="CRICKET_PLAYER">CRICKET_PLAYER</option>
                                                                            <option value="CRICKET_VENUE">CRICKET_VENUE</option>
                                                                        </select>
                                                                    </div>
                                                                </div>-->
                                                    <!-- <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="wlastName2"> Playlist items (7)</label>
                                                                        <div class="form-group">
                                                                            <label for="wfirstName2"> <a href="#">Frequents added </a></label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="wfirstName2"> <a href="#">Recently Visited</a></label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="wfirstName2"> <a href="#">Favourites</a></label>
                                                                        </div>
                                                                </div> -->
                                                    <!-- <ol>
                                                                        <li>
                                                                            <button></button>
                                                                            <div >
                                                                                <div>1336253276 </div>
                                                                                <div>
                                                                                    <a data-cms-href="#">
                                                                                        <span>PHOTO: 154938</span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <div>
                                                                                    <img class="thumbnail" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100" src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100">
                                                                                </div>
                                                                                <div>
                                                                                    <button>Published</button>
                                                                                    <button>
                                                                                        <span>PUBLISHED</span>
                                                                                        <span class="status__dot"></span>
                                                                                        <span class="status__dropdown-icon selected--icon" data-icon="down"></span>
                                                                                    </button>
                                                                                    <ul>

                                                                                    </ul>
                                                                                </div>
                                                                                <button data-icon="close"></button>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <button></button>
                                                                            <div >
                                                                                <div>1336253276 </div>
                                                                                <div>
                                                                                    <a data-cms-href="#">
                                                                                        <span>PHOTO: 154938</span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <div>
                                                                                    <img class="thumbnail" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100" src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100">
                                                                                </div>
                                                                                <div>
                                                                                    <button>Published</button>
                                                                                    <button>
                                                                                        <span>PUBLISHED</span>
                                                                                        <span class="status__dot"></span>
                                                                                        <span class="status__dropdown-icon selected--icon" data-icon="down"></span>
                                                                                    </button>
                                                                                    <ul>
                                                                                    </ul>
                                                                                </div>
                                                                                <button data-icon="close"></button>
                                                                            </div>
                                                                        </li>
                                                                        <li >
                                                                            <button></button>
                                                                            <div >
                                                                                <div>1336253276 </div>
                                                                                <div>
                                                                                    <a data-cms-href="#">
                                                                                        <span>PHOTO: 154938</span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <div>
                                                                                    <img class="thumbnail" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100" src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100">
                                                                                </div>
                                                                                <div>
                                                                                    <button>Published</button>
                                                                                    <button>
                                                                                        <span>PUBLISHED</span>
                                                                                        <span class="status__dot"></span>
                                                                                        <span class="status__dropdown-icon selected--icon" data-icon="down"></span>
                                                                                    </button>
                                                                                    <ul>
                                                                                    </ul>
                                                                                </div>
                                                                                <button data-icon="close"></button>
                                                                            </div>
                                                                        </li>
                                                                        <li >
                                                                            <button></button>
                                                                            <div >
                                                                                <div>1336253276 </div>
                                                                                <div>
                                                                                    <a data-cms-href="#">
                                                                                        <span>PHOTO: 154938</span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <div>
                                                                                    <img class="thumbnail" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100" src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100">
                                                                                </div>
                                                                                <div>
                                                                                    <button>Published</button>
                                                                                    <button>
                                                                                        <span>PUBLISHED</span>
                                                                                        <span class="status__dot"></span>
                                                                                        <span class="status__dropdown-icon selected--icon" data-icon="down"></span>
                                                                                    </button>
                                                                                    <ul>
                                                                                    </ul>
                                                                                </div>
                                                                                <button data-icon="close"></button>
                                                                            </div>
                                                                        </li>
                                                                        <li >
                                                                            <button></button>
                                                                            <div >
                                                                                <div>1336253276 </div>
                                                                                <div>
                                                                                    <a data-cms-href="#">
                                                                                        <span>PHOTO: 154938</span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <div>
                                                                                    <img class="thumbnail" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100" src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100">
                                                                                </div>
                                                                                <div>
                                                                                    <button>Published</button>
                                                                                    <button>

                                                                                        <span>PUBLISHED</span>
                                                                                        <span class="status__dot"></span>
                                                                                        <span class="status__dropdown-icon selected--icon" data-icon="down"></span>
                                                                                    </button>
                                                                                    <ul>

                                                                                    </ul>
                                                                                </div>

                                                                                <button data-icon="close"></button>
                                                                            </div>
                                                                        </li>
                                                                        <li >
                                                                            <button></button>
                                                                            <div >
                                                                                <div>1336253276 </div>
                                                                                <div>
                                                                                    <a data-cms-href="#">
                                                                                        <span>PHOTO: 154938</span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div>

                                                                                <div>
                                                                                    <img class="thumbnail" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100" src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100">
                                                                                </div>

                                                                                <div>
                                                                                    <button>Published</button>
                                                                                    <button>

                                                                                        <span>PUBLISHED</span>
                                                                                        <span class="status__dot"></span>
                                                                                        <span class="status__dropdown-icon selected--icon" data-icon="down"></span>
                                                                                    </button>
                                                                                    <ul>

                                                                                    </ul>
                                                                                </div>

                                                                                <button data-icon="close"></button>
                                                                            </div>
                                                                        </li>

                                                                    </ol> -->
                                                    <!-- </div> -->
                                        </section>
                                        <!-- Dynamic Tab -->
                                        <h6>Meta Information</h6>
                                        <section>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="wfirstName2"> Subtitle *</label>
                                                        <input type="text" class="form-control text-case"
                                                            value="{{ $edit_data['subtitle'] }}" id="subtitle"
                                                            name="subtitle" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wemailAddress2"> Summary*</label>
                                                        <textarea class="form-control" id="summary" name="summary"
                                                            rows="3" required>{{ $edit_data['summary'] }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wemailAddress2">Slug*</label>
                                                        <textarea class="form-control" id="slug" name="slug"
                                                            rows="3"required>{{ $edit_data['slug'] }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wemailAddress2">Cover Image</label>
                                                        <img src="{{ $edit_data['cover'] }}" class="img-responsive"  accept="image/*" >
                                                        <span>{{ $edit_data['cover'] }}</span>
                                                        <input type="file" name="image_file" class="form-control dropify"
                                                            value="{{ old('cover') }}"  accept="image/*" >
                                                        <!-- <textarea class="form-control" id="cover" name="cover" rows="3">{{ $edit_data['cover'] }}</textarea> -->
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="behName1">Display date</label>
                                                                            <input type="date" class="form-control" placeholder="23/08/2021" value="{{ $edit_data['display_date'] }}" id="date" name="date">
                                                                            <input type="time" class="form-control" value="" placeholder="time 10:30" id="time" name="time">
                                                                        </div>
                                                                    </div> -->
                                                <!-- <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="wlastName2"> Cover selection</label>
                                                                        <select>
                                                                            <option value="FIRST">FIRST</option>
                                                                            <option value="LAST">LAST</option>
                                                                            <option value="RANDOM">RANDOM</option>
                                                                            <option value="MANUAL">MANUAL</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="behName1">Display date</label>
                                                                            <input type="text" class="form-control" placeholder="23/08/2021" value="" name="title">
                                                                            <input type="text" class="form-control" value="" placeholder="time 10:30" name="title">
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                <!-- <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="behName1">Location Search</label>
                                                                        <input type="text" class="form-control" value="" name="title">
                                                                    </div>
                                                                </div> -->
                                            </div>
                                        </section>
                                        <!-- End Dynamic Tab -->
                                        <!-- Step 2 -->
                                        <h6>Update</h6>
                                        <section>
                                            <div class="row">
                                                <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="behName1" class="fullwidth">Location Search
                                                            :</label>
                                                        <button type="button" class="location-search">Search</button>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="behName1">Location Search *</label>
                                                        <input type="text" name="playlistlocationsearch"
                                                            id="playlistlocationsearch" class="form-control"
                                                            placeholder="Choose Location"
                                                            value="{{ $edit_data['location'] }}" required>
                                                        <!-- <input type="text" class="form-control" readonly value="{{ $edit_data['location'] }}" id="location" name="location"> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="behName1">Latitude</label>
                                                        <input type="text" id="latitudeplaylist" name="latitudeplaylist"
                                                            class="form-control" value="{{ $edit_data['latitude'] }}"
                                                            readonly>
                                                        <!-- <input type="text" class="form-control" readonly value="{{ $edit_data['latitude'] }}" id="latitude" name="latitude"> -->
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="behName1">Longitude</label>
                                                        <input type="text" name="longitudeplaylist" id="longitudeplaylist"
                                                            class="form-control" readonly
                                                            value="{{ $edit_data['longitude'] }}">
                                                        <!-- <input type="text" class="form-control" readonly value="{{ $edit_data['longitude'] }}" id="longitude" name="longitude"> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <select id="status" name="status">Status</option>
                                                                            <option value="true" selected>Active</option>
                                                                            <option value="false">Inactive</option>

                                                                    </select>
                                                                </div>
                                                            </div> -->
                                            <!-- <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="behName1">Display Date</label>
                                                                    <input type="text" class="form-control" value="{{ $edit_data['display_date'] }}" id="display_date" name="display_date">
                                                                </div>
                                                            </div> -->
                                            <!-- <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="behName1">Created Date</label>
                                                                    <input type="text" class="form-control" value="{{ $edit_data['created_date'] }}" id="created_date" name="created_date">
                                                                </div>
                                                            </div> -->
                                            <div class="row">

                                                <!-- <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="behName1">Updated Date</label>
                                                                    <input type="text" class="form-control" value="{{ $edit_data['updated_date'] }}" id="updated_date" name="updated_date">
                                                                </div>
                                                            </div> -->
                                                <!-- <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="behName1">Longitude</label>
                                                                    <input type="text" class="form-control" value="" name="title4">
                                                                </div>
                                                            </div> -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="behName1">Language*</label>
                                                        <select id="language" name="language" class="form-control" required>
                                                        @foreach ($lang as $key  => $value)
                                                                <option value="{{ $key }}" {{ $edit_data['language'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="behName1">Tags*</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $edit_data['tags'] }}" id="keywords" value="{{ $edit_data['keywords'] }}" name="keywords" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                            </div>
                                            <div class="row">

                                            </div>
                                        </section>

                                        <div id="collapsingsidebar" class="collapssidebar">
                                            @include('releted_references.edit-content-reference');
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript"
                src="https://maps.google.com/maps/api/js?key=AIzaSyDetZZwXV4c_mQULaCiJLJvT8Z_XYhfQbI&libraries=places"></script>
        <script src="{{ asset('js/playlists/playlists.js') }}" type="text/javascript"></script>
       <script src="{{ asset('js/content_refernce/content_refernce.js') }}" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                $("#playlists button#collapsesidebar-btn").click(function() {
                    $('#playlists #collapsingsidebar').toggleClass("collapse-deactive");
                    $('#playlists section.body').toggleClass("collapse-deactive");
                    $("#playlists button#collapsesidebar-btn").text(function(i, v) {
                        return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
                    });
                });

            });
        </script>
        <script type="text/javascript">
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
            });
            $(document).ready(function() {
                // $('.input_field').hide();
                $('.text_url_field').show();

                $('#remove_div').click(function() {
                    $('.input_field').hide();
                    $('.text_url_field').show();
                });

                $(".photo_title").keyup(function() {
                    var title = $('.photo_title').val();
                    var url_segment = title.replace(/\s+/g, '-').toLowerCase();
                    $('#url_segment').val(url_segment);
                });

                var optionData = '';

                $("#related_content").change(function() {
                    var selectedValue = $('#related_content :selected').val();
                    getDataByContentValue(selectedValue, 'related_content_div');
                });

                $("#content_reference").change(function() {
                    var selectedValue = $('#content_reference :selected').val();
                    getDataByContentValue(selectedValue, 'content_reference_div');
                });
            });



            var loadFile = function(event) {
                var image = document.getElementById('output');
                image.src = URL.createObjectURL(event.target.files[0]);
            };

            function hideShowEditURLDiv() {
                $('.input_field').show();
                $('.text_url_field').hide();
            }
        </script>
    @stop
