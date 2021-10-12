@extends('base')
@section('epic_content')

<?php error_reporting(E_ALL & ~E_NOTICE);?>
<!-- ckeditor -->
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
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
        <h4 class="page-title"></h4> </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li class="active"><a href="{{url('uploadcontent')}}">Upload Content</a></li>
            <!-- <li class="active"></li> -->
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>


<div class="modal-dialog modal-lg" style="width:85%">
    <div class="modal-content">
        <div class="modal-header" style="padding:5px 15px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="col-md-12 white-box ">  
                        <div class="card-body wizard-content">
                            <h4 class="card-title">Add New</h4>
                            <h6 class="card-subtitle">Complete All the steps to add new</h6>
                            <label class="control-label">Asset Type*</label>
                            <div class="">
                                <select class="form-control" name="asset_type" id="asset_type" onchange="assettype()" >
                                    <option value="">Select</option>
                                    <option value="articles">Articles</option>
                                    <option value="photos">Photos</option>
                                    <option value="playlists">Playlists</option>
                                    <option value="videos">Videos</option>
                                    <option value="audio">Audio</option>
                                    <option value="promos">Promos</option>
                                    <option value="documents">Documents</option>
                                    <option value="bios">Bios</option>                      
                                </select>
                            </div>
                            <div id="articles" style="display: none;">
                                <form action="#" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                                    <!-- Step 1 -->
                                    <h6>Basic Info</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wfirstName2"> Headline*:</label>
                                                    <input type="text" class="form-control" value=""  name="title"> 
                                                </div>
                                                <div class="form-group">
                                                    <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                                                    <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="myfile">Subtitle</label>
                                                    <input type="file" id="myfile" name="myfile">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wlastName2">Summary</label>
                                                    <textarea class="form-control "  name="description" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wlastName2">Body content(test editor)</label>
                                                    <textarea id="ckeditor"class="ckeditor form-control" name="description"></textarea>
                                                    <!-- <textarea class="form-control" name="summernote" id="summernote"></textarea> -->
                                                    <!-- <textarea name="description" rows="5" cols="40" class="form-control tinymce-editor"></textarea> -->
                                                    <!-- <textarea class="form-control "  name="description" rows="3"></textarea> -->
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
                                                    <label for="wfirstName2"> Author</label>
                                                    <input type="text" class="form-control" value="" name="title"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wemailAddress2"> Read time (seconds)</label>
                                                    <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wlastName2"> Hotlink URL</label>
                                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Display date</label>
                                                    <input type="text" class="form-control" placeholder="23/08/2021" value="" name="title"> 
                                                    <input type="text" class="form-control" value="" placeholder="time 10:30" name="title"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Location Search</label>
                                                    <input type="text" class="form-control" value="" name="title"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Location label</label>
                                                    <input type="text" class="form-control" value="" name="title"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Latitude</label>
                                                    <input type="text" class="form-control" value="" name="title"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Longitude</label>
                                                    <input type="text" class="form-control" value="" name="title"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Metadata* :</label>
                                                    <input type="text" class="form-control" value="" readonly name="title"> 
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- End Dynamic Tab -->
                                    <!-- Step 3-->
                                    <h6>Segmentation</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6" style="margin-bottom: 10px;">
                                                <div class="form-group">
                                                    <input type="checkbox" id="restrict" name="restrict" value="Bike">
                                                    <label for="vehicle1"> Restrict content to logged in users</label><br>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 3 -->
                                    <h6>Collapse &amp; sidebar</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <img class="image" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/23/8e1332bb-5905-41c7-baae-1779b9ed4f9f/celebration.jpg?width=400" alt="" src="https://resources.platform.bcci.tv/photo-resources/2021/08/23/8e1332bb-5905-41c7-baae-1779b9ed4f9f/celebration.jpg?width=400">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="wjobTitle2">celebration Photo ID: 154923</label>
                                                        <label for="wjobTitle2">Country Code IN</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h6>Content &amp; references</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="wjobTitle2">Content &amp; references :</label>
                                                    <label class="form-group"> 
                                                    Content references
                                                    </label>
                                                    <div class="form-group">
                                                        <label for="Selecttype"> Select type*:</label>
                                                        <select>
                                                            <option selected="selected" disabled="disabled" value="">Select type</option>        
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
                                                            <option value="EVENT">EVENT</option>
                                                            <option value="EVENT_GROUP">EVENT_GROUP</option>
                                                            <option value="FORM">FORM</option>
                                                            <option value="QUIZ">QUIZ</option>
                                                            <option value="OTHER">OTHER</option>
                                                            <option value="REFERENCE_GROUP">REFERENCE_GROUP</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="wfirstName2">suggested references:</label>
                                                        <label for="wfirstName2"> Show suggested references List</label> 
                                                        <label for="wfirstName2"> Showing more suggested references </label>
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
                                        <select>
                                            <option selected="selected" disabled="disabled" value="">Select type</option>                 
                                            <option value="TEXT" >TEXT</option>
                                            <option value="PHOTO" >PHOTO</option>
                                            <option value="VIDEO" >VIDEO</option>
                                            <option value="AUDIO" >AUDIO</option>
                                            <option value="DOCUMENT" >DOCUMENT</option>
                                            <option value="PLAYLIST" >PLAYLIST</option>
                                            <option value="PROMO" >PROMO</option>
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
                    </div>
                    <!-- style="display: none;" -->
                    <div id="playlists" style="display: none;">
                        <form action="#" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                        <!-- Step 1 -->
                        <h6>Basic Info</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wfirstName2"> Headline*:</label>
                                    <input type="text" class="form-control" value=""  name="title"> 
                                    </div>
                                    <div class="form-group">
                                    <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                                    <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                                    </div>
                                    <div class="form-group">
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
                                            <option value="AUDIO">AUDIO</option>                                          <option value="DOCUMENT">DOCUMENT</option>                                   <option value="PLAYLIST">PLAYLIST</option>                                    
                                            <option value="PROMO">PROMO</option>                                         <option value="LIVE_BLOG">LIVE_BLOG</option>                                  
                                            <option value="BIO">BIO</option>                                            
                                            <option value="CRICKET_TOURNAMENTGROUP">CRICKET_TOURNAMENTGROUP</option>      <option value="CRICKET_TOURNAMENT">CRICKET_TOURNAMENT</option>
                                            <option value="CRICKET_MATCH">CRICKET_MATCH</option>
                                            <option value="CRICKET_TEAM">CRICKET_TEAM</option>
                                            <option value="CRICKET_SQUAD">CRICKET_SQUAD</option>
                                            <option value="CRICKET_PLAYER">CRICKET_PLAYER</option>
                                            <option value="CRICKET_VENUE">CRICKET_VENUE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                    </div>
                                    <ol>
                                        <!-- ngRepeat: reference in references -->
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
                                                <!-- ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <div>
                                                    <img class="thumbnail" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100" src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100">
                                                </div>
                                                <!-- end ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <!-- ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
                                                <div>
                                                    <button>Published</button>
                                                    <button>
                                                    <!-- ngIf: sizeSmall -->
                                                    <span>PUBLISHED</span><!-- end ngIf: sizeSmall -->
                                                    <span class="status__dot"></span>
                                                    <span class="status__dropdown-icon selected--icon" data-icon="down"></span>
                                                    </button>
                                                    <ul>
                                                    <!-- ngRepeat: status in options --><!-- ngIf: checkPermission( status ) --><!-- end ngRepeat: status in options --><!-- ngIf: checkPermission( status ) --><!-- end ngRepeat: status in options -->
                                                    </ul>
                                                </div>
                                                <!-- end ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
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
                                                <!-- ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <div>
                                                    <img class="thumbnail" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100" src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100">
                                                </div>
                                                <!-- end ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <!-- ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
                                                <div>
                                                    <button>Published</button>
                                                    <button>
                                                    <!-- ngIf: sizeSmall -->
                                                    <span>PUBLISHED</span><!-- end ngIf: sizeSmall -->
                                                    <span class="status__dot"></span>
                                                    <span class="status__dropdown-icon selected--icon" data-icon="down"></span>
                                                    </button>
                                                    <ul>
                                                    <!-- ngRepeat: status in options --><!-- ngIf: checkPermission( status ) --><!-- end ngRepeat: status in options --><!-- ngIf: checkPermission( status ) --><!-- end ngRepeat: status in options -->
                                                    </ul>
                                                </div>
                                                <!-- end ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
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
                                                <!-- ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <div>
                                                    <img class="thumbnail" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100" src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100">
                                                </div>
                                                <!-- end ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <!-- ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
                                                <div>
                                                    <button>Published</button>
                                                    <button>
                                                    <!-- ngIf: sizeSmall -->
                                                    <span>PUBLISHED</span><!-- end ngIf: sizeSmall -->
                                                    <span class="status__dot"></span>
                                                    <span class="status__dropdown-icon selected--icon" data-icon="down"></span>
                                                    </button>
                                                    <ul>
                                                    <!-- ngRepeat: status in options --><!-- ngIf: checkPermission( status ) --><!-- end ngRepeat: status in options --><!-- ngIf: checkPermission( status ) --><!-- end ngRepeat: status in options -->
                                                    </ul>
                                                </div>
                                                <!-- end ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
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
                                                <!-- ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <div>
                                                    <img class="thumbnail" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100" src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100">
                                                </div>
                                                <!-- end ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <!-- ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
                                                <div>
                                                    <button>Published</button>
                                                    <button>
                                                    <!-- ngIf: sizeSmall -->
                                                    <span>PUBLISHED</span><!-- end ngIf: sizeSmall -->
                                                    <span class="status__dot"></span>
                                                    <span class="status__dropdown-icon selected--icon" data-icon="down"></span>
                                                    </button>
                                                    <ul>
                                                    <!-- ngRepeat: status in options --><!-- ngIf: checkPermission( status ) --><!-- end ngRepeat: status in options --><!-- ngIf: checkPermission( status ) --><!-- end ngRepeat: status in options -->
                                                    </ul>
                                                </div>
                                                <!-- end ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
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
                                                <!-- ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <div>
                                                    <img class="thumbnail" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100" src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100">
                                                </div>
                                                <!-- end ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <!-- ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
                                                <div>
                                                    <button>Published</button>
                                                    <button>
                                                    <!-- ngIf: sizeSmall -->
                                                    <span>PUBLISHED</span><!-- end ngIf: sizeSmall -->
                                                    <span class="status__dot"></span>
                                                    <span class="status__dropdown-icon selected--icon" data-icon="down"></span>
                                                    </button>
                                                    <ul>
                                                    <!-- ngRepeat: status in options --><!-- ngIf: checkPermission( status ) --><!-- end ngRepeat: status in options --><!-- ngIf: checkPermission( status ) --><!-- end ngRepeat: status in options -->
                                                    </ul>
                                                </div>
                                                <!-- end ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
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
                                                <!-- ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <div>
                                                    <img class="thumbnail" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100" src="https://resources.platform.bcci.tv/photo-resources/2021/08/25/7dde6954-ea7e-4e40-9b33-c8aa149abf76/1336253276.jpg?width=100">
                                                </div>
                                                <!-- end ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <!-- ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
                                                <div>
                                                    <button>Published</button>
                                                    <button>
                                                    <!-- ngIf: sizeSmall -->
                                                    <span>PUBLISHED</span><!-- end ngIf: sizeSmall -->
                                                    <span class="status__dot"></span>
                                                    <span class="status__dropdown-icon selected--icon" data-icon="down"></span>
                                                    </button>
                                                    <ul>
                                                    <!-- ngRepeat: status in options --><!-- ngIf: checkPermission( status ) --><!-- end ngRepeat: status in options --><!-- ngIf: checkPermission( status ) --><!-- end ngRepeat: status in options -->
                                                    </ul>
                                                </div>
                                                <!-- end ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
                                                <button data-icon="close"></button>
                                            </div>
                                        </li>
                                        <!-- end ngRepeat: reference in references -->
                                    </ol>
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
                                    <label for="wfirstName2"> Subtitle</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wemailAddress2"> Summary</label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Location Search</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Location label</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Latitude</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Longitude</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Metadata* :</label>
                                        <input type="text" class="form-control" value="" readonly name="title"> 
                                        </div>
                                    </div>
                            </div>
                        </section>
                        <!-- End Dynamic Tab -->
                        <!-- Step 2 -->
                        <h6>segmentation</h6>
                        <section>
                            <div class="row">
                            <div class="col-md-6" style="margin-bottom: 10px;">
                                <div class="form-group">
                                    <label for="behName1">Route restrictions</label>
                                    <input type="checkbox" id="restrict" name="restrict" value="Bike">
                                    <label for="vehicle1"> Restrict content to logged in users</label><br>
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
                        <h6>Content &amp; references</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="wjobTitle2">Content &amp; references :</label>
                                    <label class="form-group"> 
                                    Content references
                                    </label>
                                    <div class="form-group">
                                        <label for="Selecttype"> Select type*:</label>
                                        <select>All types</option>                                            
                                            <option value="TEXT">TEXT</option>                                            
                                            <option value="PHOTO">PHOTO</option>                                     
                                            <option value="VIDEO">VIDEO</option>              
                                            <option value="AUDIO">AUDIO</option>                                          <option value="DOCUMENT">DOCUMENT</option>                                   <option value="PLAYLIST">PLAYLIST</option>                                    
                                            <option value="PROMO">PROMO</option>                                         <option value="LIVE_BLOG">LIVE_BLOG</option>                                  
                                            <option value="BIO">BIO</option>                                            
                                            <option value="CRICKET_TOURNAMENTGROUP">CRICKET_TOURNAMENTGROUP</option>      <option value="CRICKET_TOURNAMENT">CRICKET_TOURNAMENT</option>
                                            <option value="CRICKET_MATCH">CRICKET_MATCH</option>
                                            <option value="CRICKET_TEAM">CRICKET_TEAM</option>
                                            <option value="CRICKET_SQUAD">CRICKET_SQUAD</option>
                                            <option value="CRICKET_PLAYER">CRICKET_PLAYER</option>
                                            <option value="CRICKET_VENUE">CRICKET_VENUE</option>
                                        </select>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="wfirstName2"> <a href="#">Frequents added</a></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="wfirstName2"> <a href="#">Recently Visited</a></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="wfirstName2"> <a href="#">Favourites</a></label>
                                    </div>
                                    <ol>
                                        <!-- ngRepeat: reference in references -->
                                        <li>
                                            <button type="button"></button>
                                            <div>
                                                <div>England v India 2021 </div>
                                                <div>
                                                    <a data-cms-href="#">
                                                    <span>CRICKET_TOURNAMENT: 22435</span>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="button"></button>
                                            </div>
                                        </li>
                                        <!-- end ngRepeat: reference in references -->
                                        <li>
                                            <button type="button"></button>
                                            <div>
                                                <div>3rd Test </div>
                                                <div>
                                                    <a data-cms-href="#" href="#">
                                                    <span>CRICKET_MATCH: 22438</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="selected-references-new__item-right">
                                                <!-- ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                <!-- ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
                                                <button type="button" data-icon="close"></button>
                                            </div>
                                        </li>
                                        <!-- end ngRepeat: reference in references -->
                                    </ol>
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
                                    <label for="wfirstName2"> <a href="#">Frequents added</a></label>
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
                                        <select style="">
                                        <option selected="selected" disabled="disabled" value="">Select type</option>
                                            <option value="TEXT" >TEXT</option>
                                            <option value="PHOTO" >PHOTO</option>
                                            <option value="VIDEO" >VIDEO</option>
                                            <option value="AUDIO" >AUDIO</option>
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
                        </section>
                        </form>
                    </div>
                    <div id="videos" style="display: none;">
                    <form action="#" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                        <!-- Step 1 -->
                        <h6>Basic Info</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wfirstName2"> Headline*:</label>
                                    <input type="text" class="form-control" value=""  name="title"> 
                                    </div>
                                    <div class="form-group">
                                    <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                                    <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                                    </div>
                                    <div class="form-group">
                                    <label for="myfile">Replace image:</label>
                                    <input type="file" id="myfile" name="myfile">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wlastName2"> Photo editor*:</label>
                                    <textarea class="form-control "  name="description" rows="3"></textarea>
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
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wemailAddress2"> Summary*:</label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wlastName2"> Display date*:</label>
                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Location* :</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Location label:</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Location Search :</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Latitude :</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Longitude:</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Metadata* :</label>
                                    <input type="text" class="form-control" value="" readonly name="title"> 
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
                                </d
                                iv>
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
                                        <select name="cars" id="cars">
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
                    
                    </div> 
                    <div id="audio" style="display: none;">
                    <form action="#" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                            <!-- Step 1 -->
                            <h6>Basic Info</h6>
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="wfirstName2"> Headline*:</label>
                                        <input type="text" class="form-control" value=""  name="title"> 
                                        </div>
                                        <div class="form-group">
                                        <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                                        <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                                        </div>
                                        <div class="form-group">
                                        <label for="myfile">Replace image:</label>
                                        <input type="file" id="myfile" name="myfile">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="wlastName2"> Photo editor*:</label>
                                        <textarea class="form-control "  name="description" rows="3"></textarea>
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
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="wemailAddress2"> Summary*:</label>
                                        <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="wlastName2"> Display date*:</label>
                                        <textarea class="form-control" name="description" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Location* :</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Location label:</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Location Search :</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Latitude :</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Longitude:</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Metadata* :</label>
                                        <input type="text" class="form-control" value="" readonly name="title"> 
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
                                    </d
                                    iv>
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
                                            <select name="cars" id="cars">
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
                    </div> 
                    <div id="promos" style="display: none;">
                    <form action="#" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                        <!-- Step 1 -->
                        <h6>Basic Info</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wfirstName2"> Headline*:</label>
                                    <input type="text" class="form-control" value=""  name="title"> 
                                    </div>
                                    <div class="form-group">
                                    <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                                    <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                                    </div>
                                    <div class="form-group">
                                    <label for="myfile">Replace image:</label>
                                    <input type="file" id="myfile" name="myfile">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wlastName2"> Photo editor*:</label>
                                    <textarea class="form-control "  name="description" rows="3"></textarea>
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
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wemailAddress2"> Summary*:</label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wlastName2"> Display date*:</label>
                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Location* :</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Location label:</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Location Search :</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Latitude :</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Longitude:</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Metadata* :</label>
                                    <input type="text" class="form-control" value="" readonly name="title"> 
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
                                </d
                                iv>
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
                                        <select name="cars" id="cars">
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

                    </div>  
                    <div id="documents" style="display: none;">
                        <form action="#" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                        <!-- Step 1 -->
                        <h6>Basic Info</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wfirstName2"> Headline*:</label>
                                    <input type="text" class="form-control" value=""  name="title"> 
                                    </div>
                                    <div class="form-group">
                                    <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                                    <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="myfile">Upload new file</label>
                                        <input type="file" id="myfile" name="myfile">
                                        <label for="myfile">Download File</label>
                                        <br/>
                                        <label for="myfile">File Link</label>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </section>
                        <!-- Dynamic Tab -->
                        <h6>Meta Information</h6>
                        <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="wemailAddress2"> Summary*:</label>
                                        <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="behName1">Display date</label>
                                    <input type="text" class="form-control" placeholder="23/08/2021" value="" name="title"> 
                                    <input type="text" class="form-control" value="" placeholder="time 10:30" name="title"> 
                                    </div>
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Location</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Location label:</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Location Search :</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Latitude :</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Longitude:</label>
                                        <input type="text" class="form-control" value="" name="title"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="behName1">Metadata* :</label>
                                        <input type="text" class="form-control" value="" readonly name="title"> 
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- End Dynamic Tab -->
                            <!-- Step 2 -->
                            <h6>Segmentation</h6>
                            <section>
                                <div class="row">
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <div class="form-group">
                                        <input type="checkbox" id="restrict" name="restrict" value="Bike">
                                        <label for="vehicle1"> Restrict content to logged in users</label><br>
                                    </div>
                                    </d
                                    iv>
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
                                            <select class="reference-search__type-select js-type-select ng-pristine ng-valid ng-not-empty ng-valid-parse ng-touched" data-ng-change="typeSelect( selectType )" data-ng-model="selectType" data-ignore-dirty="" style="">
                                                <option selected="selected">Select type</option>
                                                <option value="TEXT" >TEXT</option>                                     
                                                <option value="PHOTO" >PHOTO</option>                                    
                                                <option value="VIDEO" >VIDEO</option>                                
                                                <option value="AUDIO" >AUDIO</option>                                    
                                                <option value="DOCUMENT" >DOCUMENT</option>                              
                                                <option value="PLAYLIST" >PLAYLIST</option>                              
                                                <option value="PROMO" >PROMO</option>                             
                                                <option value="LIVE_BLOG" >LIVE_BLOG</option>                        
                                                <option value="BIO" >BIO</option>                                
                                                <option value="CRICKET_TOURNAMENTGROUP" >CRICKET_TOURNAMENTGROUP</option>
                                                <option value="CRICKET_TOURNAMENT" >CRICKET_TOURNAMENT</option>          
                                                <option value="CRICKET_MATCH" >CRICKET_MATCH</option>                    
                                                <option value="CRICKET_TEAM" >CRICKET_TEAM</option>                      
                                                <option value="CRICKET_SQUAD" >CRICKET_SQUAD</option>                   
                                                <option value="CRICKET_PLAYER" >CRICKET_PLAYER</option>                  
                                                <option value="CRICKET_VENUE" >CRICKET_VENUE</option>                   
                                                <option value="EVENT" >EVENT</option>                                  
                                                <option value="EVENT_GROUP" >EVENT_GROUP</option>                        
                                                <option value="FORM" >FORM</option>                                   
                                                <option value="QUIZ" >QUIZ</option>                                      
                                                <option value="OTHER" >OTHER</option>                                    
                                                <option value="REFERENCE_GROUP" >REFERENCE_GROUP</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="wfirstName2">Start typing to search by ID or name ...</label>
                                            <input type="text" class="form-control" value="" placeholder="Start typing to search by ID or name ..." name="slug" > 
                                        </div>
                                        <div class="form-group">
                                            <label for="wfirstName2"> <a href="#">Frequents added</a></label>
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
                                            <option value="PLAYLIST">PLAYLIST</option>
                                            <option value="PROMO">PROMO</option> 
                                        </select>
                                        <input type="text" class="form-control" value="" name="alt_cover_image" placeholder="Select a reference type to start your search">
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
                    </div>   
                    <div id="bios" style="display: none;">
                    <form action="#" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                        <!-- Step 1 -->
                        <h6>Basic Info</h6>
                        <section>
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wfirstName2"> Title</label>
                                    <input type="text" class="form-control" value=""  name="title"> 
                                    </div>
                                    <div class="form-group">
                                    <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                                    <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="myfile">Personal information</label>
                                        <input type="text" class="form-control" value=""  name="title"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="myfile">Surname</label>
                                        <input type="text" class="form-control" value=""  name="title"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="myfile">First name</label>
                                        <input type="text" class="form-control" value=""  name="title"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="myfile">Nationality</label>
                                        <input type="text" class="form-control" value=""  name="title"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="myfile">Date of Birth</label>
                                        <input type="text" class="form-control" value=""  name="title"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="myfile">Date of Death †</label>
                                        <input type="text" class="form-control" value=""  name="title"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="myfile">Place of Birth</label>
                                        <input type="text" class="form-control" value=""  name="title"> 
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </section>
                        <!-- Dynamic Tab -->
                        <h6>Bio</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="wfirstName2"> Summary</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wemailAddress2"> Content</label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="wlastName2"> Bio For</label>
                                    <ol>
                                        <!-- ngRepeat: reference in references -->
                                        <li>
                                            <button type="button" ></button>
                                            <div>
                                                <div>Mohammad Shami </div>
                                                <div>
                                                    <a data-cms-href="#"  target="_blank" href="cricket/players/edit/94">
                                                    <span>CRICKET_PLAYER: 94</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="button" ></button>
                                            </div>
                                        </li>
                                        <!-- end ngRepeat: reference in references -->
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End Dynamic Tab -->
                        <!-- Step 2 -->
                        <h6>Meta Info</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wemailAddress2"> Meta Information</label>
                                        <label for="wemailAddress2"> Display date</label>
                                        <input type="date" class="form-control" value="" name="title">
                                        <input type="time" class="form-control" value="" name="title"> 
                                    </div>
                                </div>  
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wemailAddress2"> Career information</label>
                                </div>
                                <div class="form-group">
                                    <label for="wfirstName2"> Position</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                </div>
                                <div class="form-group">
                                    <label for="wfirstName2"> Career Start Date</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                </div>
                                <div class="form-group">
                                    <label for="wfirstName2"> Career End Date</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                </div>
                                <div class="form-group">
                                    <label for="wfirstName2"> Town / City</label>
                                    <input type="text" class="form-control" value="" name="title"> 
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wemailAddress2"> Additional dates</label>
                                </div>
                                <div class="form-group">
                                    <label for="wfirstName2"> addDate</label>
                                    <input type="date" class="form-control" value="" name="title"> 
                                </div>
                            </div>
                            

                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wemailAddress2"> Meta Information</label>
                                        <label for="wemailAddress2"> Display date</label>
                                        <input type="date" class="form-control" value="" name="title">
                                        <input type="time" class="form-control" value="" name="title"> 
                                    </div>
                                </div>  
                            </div> 

                        </section>
                        <h6>Segmentation</h6>
                            <section>
                                <div class="row">
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <div class="form-group">
                                        <input type="checkbox" id="restrict" name="restrict" value="Bike">
                                        <label for="vehicle1"> Restrict content to logged in users</label><br>
                                    </div>
                                    </d
                                    iv>
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
                        <h6>Collapse &amp; slider</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="wjobTitle2">Collapse &amp; slider :</label>
                                    <label class="form-group"> 
                                    Lead media
                                    </label>
                                    <div class="form-group">
                                        <label for="Selecttype"> Select type*:</label>
                                        <select name="cars" id="cars">
                                            <option value="Photo">Photo</option>
                                            <option value="Video">Video</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="wfirstName2"> Select a reference type to start your search*:</label>
                                        <input type="text" class="form-control" value="" placeholder="Select a reference type to start your search" name="slug" > 
                                    </div>
                                    <div class="form-group">
                                    <input type="file" id="file" name="file[]" value="Bike">
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
                                <div class="form-group">
                                        <label for="wjobTitle2">Collapse &amp; slider :</label>
                                        <label class="form-group"> 
                                        Content references
                                        </label>
                                        <div class="form-group">
                                            <label for="Selecttype"> Select type*:</label>
                                            <select class="reference-search__type-select js-type-select ng-pristine ng-valid ng-not-empty ng-valid-parse ng-touched" data-ng-change="typeSelect( selectType )" data-ng-model="selectType" data-ignore-dirty="" style="">
                                                <option selected="selected">Select type</option>
                                                <option value="TEXT" >TEXT</option>                                     
                                                <option value="PHOTO" >PHOTO</option>                                    
                                                <option value="VIDEO" >VIDEO</option>                                
                                                <option value="AUDIO" >AUDIO</option>                                    
                                                <option value="DOCUMENT" >DOCUMENT</option>                              
                                                <option value="PLAYLIST" >PLAYLIST</option>                              
                                                <option value="PROMO" >PROMO</option>                             
                                                <option value="LIVE_BLOG" >LIVE_BLOG</option>                        
                                                <option value="BIO" >BIO</option>                                
                                                <option value="CRICKET_TOURNAMENTGROUP" >CRICKET_TOURNAMENTGROUP</option>
                                                <option value="CRICKET_TOURNAMENT" >CRICKET_TOURNAMENT</option>          
                                                <option value="CRICKET_MATCH" >CRICKET_MATCH</option>                    
                                                <option value="CRICKET_TEAM" >CRICKET_TEAM</option>                      
                                                <option value="CRICKET_SQUAD" >CRICKET_SQUAD</option>                   
                                                <option value="CRICKET_PLAYER" >CRICKET_PLAYER</option>                  
                                                <option value="CRICKET_VENUE" >CRICKET_VENUE</option>                   
                                                <option value="EVENT" >EVENT</option>                                  
                                                <option value="EVENT_GROUP" >EVENT_GROUP</option>                        
                                                <option value="FORM" >FORM</option>                                   
                                                <option value="QUIZ" >QUIZ</option>                                      
                                                <option value="OTHER" >OTHER</option>                                    
                                                <option value="REFERENCE_GROUP" >REFERENCE_GROUP</option>
                                            </select>
                                            <div class="form-group">
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
                                            <div class="form-group">
                                            <ol>
                                                <!-- ngRepeat: reference in references -->
                                                <li >
                                                    <button type="button"></button>
                                                    <div>
                                                        <div>Mohammad Shami </div>
                                                        <div>
                                                            <a data-cms-href="#" target="_blank" href="cricket/players/edit/94">
                                                                <span >CRICKET_PLAYER: 94</span>
                                                                <span data-icon="external"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="selected-references-new__item-right">
                                                        <!-- ngIf: referenceLookup[ reference.id ].thumbnail -->
                                                        <!-- ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
                                                        <button type="button"></button>
                                                    </div>
                                                </li>
                                                <!-- end ngRepeat: reference in references -->
                                                </ol>
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
                    </div>       
                    <div id="photos" style="display: none;">
                        @include('image.add_photo') 
                    </div>    
                    <input class="save_content_draft btn btn-primary" type="button" style="float:right;" value="Draft" name="draft_btn"></button>
                
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
<div class="modal fade" id="finish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
<script>
function assettype(){
    var asset_type = document.getElementById("asset_type").value;
    if(asset_type == 'photos'){
        document.getElementById("photos").style.display = "block";
        document.getElementById("articles").style.display = "none";
        document.getElementById("playlists").style.display = "none";
        document.getElementById("videos").style.display = "none";
        document.getElementById("audio").style.display = "none";
        document.getElementById("promos").style.display = "none";
        document.getElementById("documents").style.display = "none";
        document.getElementById("bios").style.display = "none";
    }else if(asset_type == 'articles'){
        document.getElementById("articles").style.display = "block";
        document.getElementById("photos").style.display = "none";
        document.getElementById("playlists").style.display = "none";
        document.getElementById("videos").style.display = "none";
        document.getElementById("audio").style.display = "none";
        document.getElementById("promos").style.display = "none";
        document.getElementById("documents").style.display = "none";
        document.getElementById("bios").style.display = "none";
    }else if(asset_type == 'playlists'){
        document.getElementById("playlists").style.display = "block";
        document.getElementById("articles").style.display = "none";
        document.getElementById("photos").style.display = "none";
        document.getElementById("videos").style.display = "none";
        document.getElementById("audio").style.display = "none";
        document.getElementById("promos").style.display = "none";
        document.getElementById("documents").style.display = "none";
        document.getElementById("bios").style.display = "none";
    }else if(asset_type == 'videos'){
        document.getElementById("videos").style.display = "block";
        document.getElementById("playlists").style.display = "none";
        document.getElementById("articles").style.display = "none";
        document.getElementById("photos").style.display = "none";
        document.getElementById("audio").style.display = "none";
        document.getElementById("promos").style.display = "none";
        document.getElementById("documents").style.display = "none";
        document.getElementById("bios").style.display = "none";
    }else if(asset_type == 'audio'){
        document.getElementById("audio").style.display = "block";
        document.getElementById("videos").style.display = "none";
        document.getElementById("playlists").style.display = "none";
        document.getElementById("articles").style.display = "none";
        document.getElementById("photos").style.display = "none";
        document.getElementById("promos").style.display = "none";
        document.getElementById("documents").style.display = "none";
        document.getElementById("bios").style.display = "none";
    }else if(asset_type == 'promos'){
        document.getElementById("promos").style.display = "block";
        document.getElementById("audio").style.display = "none";
        document.getElementById("videos").style.display = "none";
        document.getElementById("playlists").style.display = "none";
        document.getElementById("articles").style.display = "none";
        document.getElementById("photos").style.display = "none";
        document.getElementById("documents").style.display = "none";
        document.getElementById("bios").style.display = "none";
    }else if(asset_type == 'documents'){
        document.getElementById("documents").style.display = "block";
        document.getElementById("promos").style.display = "none";
        document.getElementById("audio").style.display = "none";
        document.getElementById("videos").style.display = "none";
        document.getElementById("playlists").style.display = "none";
        document.getElementById("articles").style.display = "none";
        document.getElementById("photos").style.display = "none";
        document.getElementById("bios").style.display = "none";
    }else if(asset_type == 'promos'){
        document.getElementById("promos").style.display = "block";
        document.getElementById("audio").style.display = "none";
        document.getElementById("videos").style.display = "none";
        document.getElementById("playlists").style.display = "none";
        document.getElementById("articles").style.display = "none";
        document.getElementById("photos").style.display = "none";
        document.getElementById("documents").style.display = "none";
        document.getElementById("bios").style.display = "none";
    }else if(asset_type == 'bios'){
        document.getElementById("bios").style.display = "block";
        document.getElementById("promos").style.display = "none";
        document.getElementById("audio").style.display = "none";
        document.getElementById("videos").style.display = "none";
        document.getElementById("playlists").style.display = "none";
        document.getElementById("articles").style.display = "none";
        document.getElementById("photos").style.display = "none";
        document.getElementById("documents").style.display = "none";
    }else{
        document.getElementById("articles").style.display = "none";
        document.getElementById("photos").style.display = "none";
        document.getElementById("playlists").style.display = "none";
        document.getElementById("videos").style.display = "none";
        document.getElementById("audio").style.display = "none";
        document.getElementById("promos").style.display = "none";
        document.getElementById("documents").style.display = "none";
        document.getElementById("bios").style.display = "none";
    }


    // alert(e);
}    
    
</script>



<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
  
<!-- <script type="text/javascript">
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
    </script> -->
<!-- summernote css/js -->
<!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });
</script> -->

<!-- ckeditor -->
<!-- <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('#ckeditor').ckeditor();
    });
</script> -->

@stop