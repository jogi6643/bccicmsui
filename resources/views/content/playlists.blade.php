<form data-parsley-validate action="{{ route('addplaylist') }}" method="post" id="playlist_form" name="playlist_form"
    enctype="multipart/form-data" class="validation-wizard wizard-circle">
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
                    <input type="text" class="form-control text-case" value="{{ old('title') }}" id="title"
                        name="title" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2">Url Segment</label>
                    <!-- <input type="text" class="form-control" value="" id="url_segment" name="url_segment"> -->
                    <input type="text" name="titleUrlSegment" id="titleUrlSegment" onfocusout="save_url();"
                        value="{{ $photoData['url_segment'] ?? '' }}" readonly="readonly">
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="form-group">
                    <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                    <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                </div>                -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2">Headline*:</label>
                    <input type="text" class="form-control text-case" value="{{ old('headline') }}" id="headline"
                        name="headline" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2">Asset Type*:</label>
                    <select id="playlist_type" name="playlist_type" required="" class="form-control">
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
                        <option value="CRICKET_TOURNAMENTGROUP">CRICKET_TOURNAMENTGROUP</option>
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
                    <label for="wlastName2">Published Date*:</label>
                    <input type="date" class="form-control dtpicker" value="{{ old('publish_time') }}"
                        name="publish_time" required>
                    <input type="time" class="form-control tmpicker" value="{{ old('publish_time') }}"
                        name="publish_time">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2" class="fullwidth">Expiry Date*</label>
                    <input type="date" class="form-control dtpicker" value="" name="expiryDate" required>
                    <input type="time" class="form-control tmpicker" value="" name="expiryTime">

                </div>
            </div>

        </div>
        <div class="row" style="padding-top:25px">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2">Status*</label>
                    <select id="current_status" name="current_status" class="form-control" required>
                        <option value="" disabled>Select Status</option>
                        @foreach ($status as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <?php $get_tags = platformList(); ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Platform*:</label>
                    <select class="selectpicker"  multiple data-actions-box="true" required="" id="feild"name="platform[]" value="{{ old('platform') }}">
                        @foreach ($get_tags as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <!-- <input type="text" name="photo_platform" class="form-control" value="" required=""> -->
                    <p class="">
                    </p>
                </div>
            </div>
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
                    <label for="wfirstName2"> Subtitle*</label>
                    <input type="text" class="form-control text-case" value="{{ old('subtitle') }}" id="subtitle"
                        name="subtitle" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Summary*</label>
                    <textarea class="form-control" id="summary" name="summary" rows="3"
                        value="{{ old('summary') }}" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2">Slug*</label>
                    <textarea class="form-control" id="slug" name="slug" rows="3" value="{{ old('slug') }}"
                        required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2">Cover Image*</label>
                    <input type="file" class="form-control dropify" value="{{ old('coverphoto') }}" name="coverphoto" accept="image/png,image/jpg,image/jpeg,image/gif,image/*"  id="myfile2" onchange="return imagecheckValidation()" required>
                    <!--<textarea class="form-control" id="cover" name="cover" rows="3"></textarea>-->
                </div>
                <div id="imageError"></div>
            </div>
            <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Display date</label>
                        <input type="date" class="form-control" placeholder="23/08/2021" value="" id="date" name="date">
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
    <h6>Submit</h6>
    <section>
        <div class="row">
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1" class="fullwidth">Location Search:</label>
                    <button type="button" class="location-search">Search</button>
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Location Search *:</label>
                    <input type="text" name="playlistlocationsearch" value="{{ old('playlistlocationsearch') }}"
                        id="playlistlocationsearch" class="form-control" placeholder="Choose Location" required>
                    <!-- <input type="text" class="form-control" readonly value="" id="location" name="location"> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Latitude</label>
                    <input type="text" id="latitudeplaylist" name="latitudeplaylist" class="form-control" readonly>
                    <!-- <input type="text" class="form-control" value="" readonly id="latitude" name="latitude"> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Longitude</label>
                    <input type="text" name="longitudeplaylist" id="longitudeplaylist" class="form-control" readonly>
                    <!-- <input type="text" class="form-control" value="" readonly id="longitude" name="longitude"> -->
                </div>
            </div>
        </div>
        <!-- <div class="col-md-6">
            <div class="form-group">
                <select id="status" name="status">Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                </select>
            </div>
        </div> -->
        <!-- <div class="col-md-6">
            <div class="form-group">
                <label for="behName1">Display Date</label>
                <input type="date" class="form-control" value="" id="display_date" name="display_date">
            </div>
        </div> -->
        <!-- <div class="col-md-6">
            <div class="form-group">
                <label for="behName1">Created Date</label>
                <input type="text" class="form-control" value="" id="created_date" name="created_date">
            </div>
        </div> -->
        <div class="row">


            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Language*</label>
                    <select id="language" name="language" class="form-control" required>
                        @foreach ($data as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Tags*</label>
                    <input type="text" class="form-control" value="" id="keywords" name="keywords">
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
                                <div class="reference-search__select-container">
                                    <select id="playlistId" name="playlistId" class="reference-search-s">
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

                                    <select class="form-control selectpicker playlist_reference"
                                        name="playlist_reference[]" id="browsers" data-live-search="true" multiple
                                        data-actions-box="true" data-live-search="true" data-show-subtext="true">
                                    </select>
                                    <div class="selectedvalue" role="document"></div>

                                </div>
                                <ul class="added-freq">
                                    <li data-toggle="modal" data-target="#Favouritess">
                                        <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added

                                    </li>
                                    <li data-toggle="modal" data-target="#Favouritess">
                                        <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                                    </li>
                                    <li data-toggle="modal" data-target="#Favouritess">
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
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tagsinput1">
                            <h2>Tags</h2>

                            <select class="form-control taginput-item" id="inputTagplaylistxsde" name="tags[]"
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
                                    <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                                </li>
                            </ul>
                        </div>


                        <div class="content-ref">
                            <h2>Related content</h2>
                            <div class="reference-search">
                                <div class="reference-search__select-container">
                                    <select id="playlistcontentId" name="playlistcontentId" class="reference-search-s">
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

                                    <select class="form-control selectpicker playlistrelatedcontent"
                                        name="playlistrelatedcontent[]" id="browsers" data-live-search="true" multiple
                                        data-actions-box="true" data-live-search="true" data-show-subtext="true">
                                    </select>
                                    <div class="selectedrelcont" role="document"></div>

                                </div>
                                <ul class="added-freq">
                                    <li data-toggle="modal" data-target="#Favouritess">
                                        <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added

                                    </li>
                                    <li data-toggle="modal" data-target="#Favouritess">
                                        <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                                    </li>
                                    <li data-toggle="modal" data-target="#Favouritess">
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
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
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

</form>
<script src="{{ asset('js/playlists/playlists.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $("#playlists button#collapsesidebar-btn").click(function() {
            $('#playlists #collapsingsidebar').toggleClass("collapse-deactive");
            $('#playlists section.body').toggleClass("collapse-deactive");
            $("#playlists button#collapsesidebar-btn").text(function(i, v) {
                return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
            });
        });

        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.playlist_reference',
            function() {
                $("#collapsingsidebar .reference-search .inner").append(
                    '<button type="button" class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
                $("#collapsingsidebar .reference-search .inner").append(
                    '<div class="loader-background"><div class="loader"></div></div>'
                );
                for (let i = 1; i <= $('select.playlist_reference option').length; i++) {
                    if (i == $('select.playlist_reference option').length) {
                        console.log(i + "==" + $('select.playlist_reference option').length);
                        $('.loader-background').hide();
                    }
                }
                //if ($('select.playlist_reference option').length != 0) {
                //    $('.loader-background').hide();
                //}
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.playlistrelatedcontent',
            function() {
                $("#collapsingsidebar .reference-search .inner").append(
                    '<button type="button" class="addtocontentrefrence" id="add-sels"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
                $("#collapsingsidebar .reference-search .inner").append(
                    '<div class="loader-background"><div class="loader"></div></div>'
                );
                  for (let i = 1; i <= $('select.playlistrelatedcontent option').length; i++) {
                    if (i == $('select.playlistrelatedcontent option').length) {
                        console.log(i + "==" + $('select.playlistrelatedcontent option').length);
                        $('.loader-background').hide();
                    }
                }
               // if ($('select.photorelatedcontent option').length != 0) {
               //     $('.loader-background').hide();
               // }
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.playlist_reference',
            function() {
                $('.dropdown.bootstrap-select.form-control.playlist_reference').on('click',
                    'button#add-sel',
                    function() {

                        var optionsselected = $("select.playlist_reference").val();
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
            '.dropdown.bootstrap-select.form-control.playlistrelatedcontent',
            function() {
                $('.dropdown.bootstrap-select.form-control.playlistrelatedcontent').on('click',
                    'button#add-sels',
                    function() {
                        var optionsselected = $("select.playlistrelatedcontent").val();
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

<script type="text/javascript">
    $(document).ready(function() {
        function editable_segment() {
            $('input[name="titleUrlSegment"]').removeAttr("readonly");
        }

        function save_url() {
            $('input[name="titleUrlSegment"]').attr("readonly", "readonly");
        }
        $("#playlistId").on('change', function() {
            // alert("asdf");    
            var ref = $(this).val();
            // alert(ref);
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
                          $('select.playlist_reference').empty();
                    $('select.playlist_reference').selectpicker('destroy');
                    $('select.playlist_reference').selectpicker();
                        $.each(res.data, function(index, value) {

                            var option = '<option value="<h2>' + value.title +
                                '</h2> <span>' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span>ID:' + value
                                .ID + '</span>"><h2>' + value.title +
                                '</h2> <span class="lan">' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span class="id">ID:' +
                                value.ID + '</span></option>';
                            $('select.playlist_reference').append(option);
                        });
                           $('.playlist_reference').selectpicker('refresh');
                        if ($('select.playlist_reference option').length != 0) {
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
        $("#playlistcontentId").on('change', function() {
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
                    $('select.playlistrelatedcontent').empty();
                    $('select.playlistrelatedcontent').selectpicker('destroy');
                    $('select.playlistrelatedcontent').selectpicker();
                        $.each(res.data, function(index, value) {
                            var option = '<option value="<h2>' + value.title +
                                '</h2> <span>' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span>ID:' + value
                                .ID + '</span>"><h2>' + value.title +
                                '</h2> <span class="lan">' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span class="id">ID:' +
                                value.ID + '</span></option>';
                            $('select.playlistrelatedcontent').append(option);
                        });
                        $('.playlistrelatedcontent').selectpicker('refresh');
                        if ($('select.playlistrelatedcontent option').length != 0) {
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

        // Tags Api for
        $("#inputTagplaylist").select2({
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
                        $('#inputTagplaylist').append(option);
                    });
                    $(".taginput-item").select2({
                        tags: true,
                        tokenSeparators: [',', ' ']
                    })
                },
            }
        });
    });

    // function editable_segment() {
    //     $('input[name="titleUrlSegment"]').removeAttr("readonly");
    // }

    // function save_url() {
    //     $('input[name="titleUrlSegment"]').attr("readonly", "readonly");
    // }
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
                        $('#' + selectTagId).append('<option value="' + response[i]['ID'] + '">' + response[
                            i]['title'] + '</option>');
                    }
                } else {
                    optionData += '<select>No Data</select>';
                }
                $("#" + selectTagId).selectpicker("refresh");
            }
        });
    }

    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

    function hideShowEditURLDiv() {
        $('.input_field').show();
        $('.text_url_field').hide();
    }
function imagecheckValidation() {

var fileInput =
    document.getElementById('myfile2');

var filePath = fileInput.value;

// Allowing file type
var allowedExtensions =
    /(\.jpg|\.jpeg|\.png|\.gif)$/i;

if (!allowedExtensions.exec(filePath)) {
    $('#imageError').html('<strong style="color:red">Please Select .JPEG|.PNG|.GIF|.TIFF|.PSD|.PDF|.EPS|.AI|.INDD|.RAW type only.</strong>');
    fileInput.value = '';
    return false;
}

}
</script>
