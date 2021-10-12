@extends('base')
@section('epic_content')
<style>
  .disabledli {
    pointer-events: none;
    opacity: 0.6;
  }
</style>
<link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="js/sorting.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.dropify').dropify();
    $("#inputTag").tagsinput('items');
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $("li.btn").click(function() {
      $("li.btn").removeClass("active");
      $(this).addClass("active");
    });
  });
</script>


<script type="text/javascript">
  $(document).ready(function() {
    $('.checked_all').on('change', function() {
      $('.checkbox').prop('checked', $(this).prop("checked"));
    });
    //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked
    $('.checkbox').change(function() { //".checkbox" change 
      if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('.checked_all').prop('checked', true);
      } else {
        $('.checked_all').prop('checked', false);
      }
    });
  });
</script>


<div class="row bg-title">
  <!-- .page title -->
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"></h4>
  </div>
  <!-- /.page title -->
  <!-- .breadcrumb -->
  @include('show_message')
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <ol class="breadcrumb">
      <li><a href="{{url('#')}}">Content Management</a></li>
      <li class="active">Videos</li>
    </ol>
  </div>
  <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
  <section>
    <div class="content_text headbar">
      <p>Manage Videos</p>
    </div>
    <div class="top-search">
      <div class="row content-search-header">
        <section class="col-md-5 col-sm-12">
          <div class="example">
            <input type="text" placeholder="Enter search term..." name="search_term" id="search_term">
            <button class="search_term_submit"><i class="fa fa-search"></i></button>
          </div>

        </section>

        <section class="col-md-7 col-sm-12">
          <div class="form-inline">
            <div class="col-md-7">
              <div class="custom-select fiftyper">
                <label>Filter by language</label>
                <select name="language[]" class="selectpicker applybtn FilterBylanguage firstLng" multiple data-actions-box="true">

                </select>
              </div>

              <div class="custom-select fiftyper" style="">
                <label>Filter by status</label>
                <select name="status[]" class="selectpicker applybtn FilterByStatus firstStatus" multiple data-actions-box="true">

                </select>
              </div>
            </div>
            <div class="col-md-3">
              <a class="btn btn--toggle-filter" href="{{url('getVideoList')}}" role="button">Clear</a>
              <button class="btn btn--toggle-filter apply">Apply</button>
            </div>
            <div class="col-md-2">
              <button class="btn btn--toggle-filter" data-toggle="modal" data-target="#Allfilter">All filters</button>
            </div>
          </div>
        </section>
      </div>
    </div>


    <div class="card" data-content-list="data.articleList">
      <div class="results">

        <!-- ngIf: list.items.length -->
        <div class="border-bottom">
          <h2 class="show-data-pa showing_page_data">Showing 0 results</h2>
          <div class="add-new-button">
            <a class="recent-content__add btn primary medium" href="{{url('uploadcontent/videos')}}"><i class="mdi mdi-plus"></i>Add New Videos</a>
          </div>
        </div>


        <!-- end ngIf: list.items.length -->
        <div class="content-control-wrapper row row--no-margin between-xs">
          <div class="bulk-edit-control ">
            <div class="u-flex">
            </div>
            <!-- ngIf: bulkEditCtrl.items.length -->
          </div><!-- end ngIf: bulkEditCtrl && list.items.length -->
          <div class="col-md-3 no-padd">
            <div class="select-all-div">
              <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element">&nbsp;
              <label for="check_all">Select All</label>
            </div>
            <div class="delete-div">
              <a class="view_delete" id="delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal">
                <i class="glyphicon glyphicon-trash"></i>
              </a>
              <!-- <a href="#" ><i class="glyphicon glyphicon-trash" data-toggle="tooltip" data-original-title="delete"></i></a> -->
            </div>
          </div>
          <!-- Filters -->
          <div class="filter-wrapper filter-wrapper--content u-flex--fill col-md-9">

            <div class="filter">
              <div class="standardInput form-input"><label class="form-label " for="input-0"><span class="form-label-text ">Max items</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-empty max_item_filter filter_target">
                  <!-- <option value="">All </option> -->
                  <option class="" value="24" selected>24</option>
                  <option label="36" value="36">36</option>
                  <option label="48" value="48">48</option>
                  <option label="60" value="60">60</option>
                </select><!-- ngRepeat: ( error, value ) in ngModel.$error -->
              </div>
            </div>

            <div class="filter">
              <div class="standardInput form-input">
                <label class="form-label " for="input-1"><span class="form-label-text ">Sort by</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-empty sortby_filter" id="input-1" name="input-1">
                  <!-- <option value="">All</option> -->
                  <option value="Last updated" data-i18n="label.updated">Last updated</option>
                  <option value="Status" data-i18n="label.status">Status</option>
                  <option value="Publication date" data-i18n="label.publishdate">Publication date</option>
                </select><!-- ngRepeat: ( error, value ) in ngModel.$error -->
              </div>
            </div>

            <div class="filter">
              <div class="standardInput form-input"><label class="form-label " for="input-1"><span class="form-label-text ">Show content from</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-empty show_content_from_filter" id="input-1" name="input-1">
                  <option label="All time" value="All time">All time</option>
                  <option label="The last year" value="The last year">The last year</option>
                  <option label="Last 2 years" value="Last 2 years">Last 2 years</option>
                  <option label="Last 3 years" value="Last 3 years">Last 3 years</option>
                </select><!-- ngRepeat: ( error, value ) in ngModel.$error -->
              </div>
            </div>

            <div class="filter">

              <ul>
                <h3 class="layout-left">Layout</h3>
                <li class="btn primary layout active listview" data-view="listview">
                  <a href="javascript:void(0);"><i class="mdi mdi-apps"></i></a>
                </li>
                <li class="btn primary2 layout gridview" data-view="gridview" data-icon="list">
                  <a href="javascript:void(0);"><i class="mdi mdi-table"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Grid layout -->
        <!-- ngIf: layout === 'grid' -->

        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered results listing_table list_view">
            <thead>
              <tr>
                <th>
                  <form method="POST" action="{{ route('deleteBulkVideo') }}" name="user_form" id="deleteBulkVideo" data-parsley-validate>
                    {{csrf_field()}}
                    <input type="hidden" value="" name="video_id" id="video_id">
                    <input type="hidden" value="" name="videoview">
                    <input type="hidden" value="" class="deleteType">
                  </form>
                </th>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th class="p-date">Publication date</th>
                <th class="p-date">Last updated</th>
                <th>Language</th>
                <th class="action">Action</th>
                <th class="publish">Publish and unpublish</th>
              </tr>
            </thead>
            <tbody class="tableBody">
            </tbody>
          </table>
        </div>
        <ol class="content-grid row gride_ajax_data" style="display:none;margin-top: 0px !important;">
        </ol>
        <nav class="paginations" aria-label="...">
          <ul class="pagination ajax_pagination">
          </ul>
        </nav>

        <div class="footer-tablelist">

          <form class="go-to-page" onsubmit="event.preventDefault()">
            <label class="go-to-page__label">Go to page</label>
            <div class="standardInput form-input">
              <input class="go-to-page__input form-element go goto" type="number" name="page" min="1">
            </div>
            <button type="button" id="go" class="go-to-page__link goto_submit">
              <span data-i18n="pagination.go">Go</span>
              <span>›</span>
            </button>
          </form>
        </div>




      </div>
    </div>
</div>
</section>
</div>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 60%; margin: 0 auto;">
      <!-- <form method="post" action="{{url('/deleteUser')}}"> -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <!-- <input type="hidden" name="user_id" id="user_id" class="user_id" value=""> -->
        <h3 class="modal-title" id="exampleModalLongTitle">Do you really want to delete</h3>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary yes_button" id="yes_button">Yes</button>
        <button type="button" class="btn btn-primary delete-btn" data-dismiss="modal">No</button>
      </div>
      <!-- </form> -->
    </div>
  </div>
</div>

<form method="POST" action="{{ route('deleteVideo') }}" name="user_form" class="deleteSingleUser" data-parsley-validate>
  {{csrf_field()}}
  <input type="hidden" value="" name="single_video_id" id="single_video_id">
  <input type="hidden" value="" name="videoview" class="videoview">
  <input type="hidden" value="" class="deleteType">
</form>

<div class="modal fade" id="Allfilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="AllFilterForm" enctype="multipart/form-data">
      <div class="modal-content" style="width: 60%; margin: 0 auto;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2>All filters</h2>
        <div class="row">
          <div class="col-md-7 seperator">
            <div class="row">
              <div class="col-md-4">
                <label>Filter by language</label>
                <select class="selectpicker applybtn FilterBylanguage secondLng" multiple data-actions-box="true">
                </select>
              </div>
              <div class="col-md-4">
                <label>Filter by status</label>
                <select class="selectpicker applybtn FilterByStatus secondStatus" multiple data-actions-box="true">
                </select>
              </div>
              <div class="col-md-4">
                <label>Filter by import source</label>
                <select name="filter_by_source[]" class="selectpicker filter_by_source" multiple data-actions-box="true">
                  <option value="Manual upload">Manual upload</option>
                  <option value="External provider">External provider</option>
                  <option value="Workflows">Workflows</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-6">
                <label>From date</label>
                <input type="text" class="form-control datepicker" autocomplete="off" name="from_date">
              </div>
              <div class="col-md-6">
                <label>To date</label>
                <input type="text" class="form-control datepicker" autocomplete="off" name="to_date">
              </div>
            </div>
          </div>
        </div>
        <h2>Content references</h2>
        <div class="reference-search">

          <div class="reference-search__select-container ">
            <select class="reference-search-s content_ref" name="ref_type" data-type="referance">
              <option selected="selected" disabled="disabled">
                Select type</option>
              <option value="articles">Articles</option>
              <option value="photos">Photos</option>
              <option value="playlists">Playlists</option>
              <option value="videos">Videos</option>
              <option value="audio">Audio</option>
              <option value="promos">Promos</option>
              <option value="documents">Documents</option>
              <option value="bios">Bios</option>
            </select>

            <select class="form-control selectpicker referencesResponse" name="ref[]" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">
            </select>
          </div>


          <div class="selectedvalue" role="document"></div>
          <ul class="added-freq">
            <li data-toggle="modal" data-target="#Favourites">
              <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added
            </li>
            <li data-toggle="modal" data-target="#Favourites">
              <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
            </li>
            <li data-toggle="modal" data-target="#Favourites">
              <i class="mdi mdi-heart-outline fa-fw" data-icon="v"></i> Favourites
            </li>
          </ul>
          <div class="modal fade" id="Favourites" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content" style="width: 60%; margin: 0 auto;">
                <button type="button" class="close btn innerpopup" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h2>Click the add button to attach the content reference</h2>
                <select class="form-control selectpicker" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">
                  <option>
                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                  </option>
                  <option>
                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                  </option>

                </select>
              </div>
            </div>
          </div>
        </div>

        <h2>Tags</h2>
        <input type="text" id="inputTag" name="tags" data-role="tagsinput">
        <ul class="added-freq">
          <li data-toggle="modal" data-target="#Favourites">
            <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added
          </li>
          <li data-toggle="modal" data-target="#Favourites">
            <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
          </li>
        </ul>


        <input type="submit" class="recent-content__add btn primary medium apply" name="Submit" value="submit">

      </div>
    </form>
  </div>
</div>


</div>
<div class="modal fade nbs" id="Viewpage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 100%; margin: 0 auto;">
      <div class="modal-header">
        <h2 class="Preview-title">Preview Video</h2>
        <a class="recent-content__add btn primary medium rightbtn" href="#">Edit Detail</a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body wizard-content">
        <form data-parsley-validate action="{{ route('addArticle') }}" name="article_form" id="article_form" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">

          <h6>Basic Info</h6>
          <section>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="pdlt" for="wfirstName2"> Headline</label>
                  <h2 id="title" class="head-title"></h2>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="pdlt" for="wfirstName2">
                    Publish Date:
                    <span class="date" id="publishTo"> 2021-09-22</span>
                    Expiry Date:
                    <span class="date" id="publishTo"> 2021-09-22</span>
                    Author:
                    <span class="date" id="author"> Ravindranath</span>
                    Location:
                    <span class="date" id="location"> Mumbai</span>
                  </label>
                  <!-- <input type="text" id="url_segment" name="url_segment" class="form-control" value="" name="short_description" readonly>-->
                </div>
              </div>
              <div class="col-md-6">
                <div class="vd">
                  <label class="pdlt fullwidth" for="wfirstName2" style="width: 100%;text-align: center"> Video</label>
                  <!-- <video id="video_url" poster="" width="350px" controls>
                    <source src="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4" type="video/mp4" />
                  </video> -->
                  <video id="my_video" class="video-js vjs-big-play-centered" controls preload="auto" width="350" height="268" data-setup="{'fluid':true}">
                  </video>
                </div>
              </div>
              <div class="col-md-6">
                <label class="pdlt fullwidth vdltc" for="wfirstName2" style="width: 100%;">Description</label>
                <div class="vd-dec">
                  <p>Agile and alert - Outstanding catch at mid-off from Steve Smith. Prabhsimran Singh had to make the long walk back to the pavilion.</p>
                </div>
              </div>
              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2"> Short Description*:</label>
                  <input type="text" class="form-control" value="" name="short_description" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">

                  <label for="wfirstName2">Article Language:</label>
                  <input type="text" class="form-control" value="" name="subtitle" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Article Owner:</label>
                  <input type="text" class="form-control" value="" name="article_owner" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Photo:</label>
                  <input type="file" class="form-control" value="" name="photo" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Video Duration:</label>
                  <input type="text" class="form-control" value="" name="video_duration" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Match Id:</label>
                  <input type="text" class="form-control" value="" name="match_id" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Content Type:</label>
                  <input type="text" class="form-control" value="" name="content_type" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Author:</label>
                  <input type="text" class="form-control" value="" name="author" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Keywords:</label>
                  <input type="text" class="form-control" value="" name="keywords" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Additional Info:</label>
                  <input type="text" class="form-control" value="" name="additionalInfo" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Match Formats:</label>
                  <input type="text" class="form-control" value="" name="match_formats" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Published By:</label>
                  <input type="text" class="form-control" value="" name="published_by" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Publish Date:</label>
                  <input type="text" class="form-control datepicker" value="" name="publish_date" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Language:</label>
                  <input type="text" class="form-control" value="" name="language" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Location:</label>
                  <input type="text" class="form-control" value="" name="location" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">References:</label>
                  <input type="text" class="form-control" value="" name="references" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Expiry Date:</label>
                  <input type="text" class="form-control datepicker" value="" name="expiryDate" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">total_viewcount:</label>
                  <input type="text" class="form-control" value="" name="total_viewcount" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Total Viewcount:</label>
                  <input type="text" class="form-control" value="" name="total_viewcount" readonly>
                </div>
              </div> -->
              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Slug:</label>
                  <input type="text" class="form-control" value="" name="slug" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wfirstName2">Platform:</label>
                  <input type="text" class="form-control" value="" name="platform" readonly>
                </div>
              </div>
              <div class="col-md-12 bodycontent">
                <div class="form-group">
                  <label for="wlastName2">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="9" readonly></textarea>
                </div>
                <div class="form-group">
                  <label for="wlastName2">Summary</label>
                  <textarea class="form-control" id="summary" name="summary" rows="9" readonly></textarea>
                </div>
              </div>
              <div class="col-md-12 bodycontent">
                <div class="form-group">
                  <label for="wlastName2">Body content</label>
                  <textarea name="content" row="20" id="content" readonly></textarea>
                </div>
              </div>

            </div>
            <h3>Meta Information</h3>
            <div class="row bodycontent">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="wfirstName2"> Author</label>
                  <input type="text" class="form-control" value="" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wemailAddress2"> Read time (seconds)</label>
                  <textarea class="form-control" rows="3" readonly></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="wlastName2"> Hotlink URL</label>
                  <textarea class="form-control" rows="3" readonly></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group date-time">
                  <label for="behName1">Display date</label>
                  <input type="text" class="form-control datepicker" placeholder="23/08/2021" value="" readonly>
                  <input type="text" class="form-control  timepicker" value="" placeholder="time 10:30" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="behName1">Metadata* :</label>
                  <input type="text" class="form-control" value="" readonly>
                </div>
              </div>
            </div>
            <h3>Segmentation</h3>
            <div class="row bodycontent">
              <div class="col-md-6" style="margin-bottom: 10px;">
                <div class="form-group checkbox-al">
                  <input type="checkbox" id="restrict" name="restrict" value="Bike" disabled>
                  <label for="restrict"> Restrict content to logged in users</label><br>
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
                          <ol class="selected-references-new">
                            <li class="selected-references-new__item">
                              <div class="selected-references-new__item-title-block">
                                <div class="selected-references-new__item-title">4th Test </div>
                                <span class="selected-references-new__item-action-link-label">CRICKET_MATCH: 22439</span>
                              </div>
                            </li>
                            <li class="selected-references-new__item">
                              <div class="selected-references-new__item-title-block">
                                <div class="selected-references-new__item-title">4th Test </div>
                                <span class="selected-references-new__item-action-link-label">CRICKET_MATCH: 22439</span>
                              </div>
                            </li>
                          </ol>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tagsinput">
                    <h2>Tags</h2>
                    <input type="text" id="inputTag" value="Test , Test , Test , Test Test , Test " data-role="tagsinput" disabled>

                  </div>
                  <div class="content-ref">
                    <h2>Related content</h2>
                    <div class="reference-search">
                      <div class="reference-search__select-container">
                        <ol class="selected-references-new">
                          <li class="selected-references-new__item">
                            <div class="selected-references-new__item-title-block">
                              <div class="selected-references-new__item-title">4th Test </div>
                              <span class="selected-references-new__item-action-link-label">CRICKET_MATCH: 22439</span>
                            </div>
                          </li>
                          <li class="selected-references-new__item">
                            <div class="selected-references-new__item-title-block">
                              <div class="selected-references-new__item-title">4th Test </div>
                              <span class="selected-references-new__item-action-link-label">CRICKET_MATCH: 22439</span>
                            </div>
                          </li>
                        </ol>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section> -->
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script src="{{ asset('js/video/video.js') }}" type="text/javascript"></script>
<script src="https://unpkg.com/video.js/dist/video.js"></script>

<script>
  $(document).ready(function() {
    $("div#Viewpage button#collapsesidebar-btn").click(function() {
      $('div#Viewpage #collapsingsidebar').toggleClass("collapse-deactive");
      $('div#Viewpage section.body').toggleClass("collapse-deactive");
      $("div#Viewpage button#collapsesidebar-btn").text(function(i, v) {
        return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
      });
    });

    var pageView = '<?php echo Request::Segment(2); ?>';
    $("." + pageView).click();

  });

  $(document).on("click", ".open-data", function() {
    $('.rightbtn').attr("href", '');
    var id = $(this).data('id');
    if (id != undefined && id != null) {
      $.ajax({
        type: 'GET',
        url: '/video/fetchVideo',
        data: {
          "id": id,
        },
        success: function(res) {
          if (res.data) {
            console.log(res.data);
            $('#title').html(res.data.title);
            if (typeof(res.data.ID) != "undefined" && res.data.ID !== null) {
              var videoId = res.data.ID;
            } else {
              var videoId = res.data.id;
            }
            var video_url = res.data.video_url;
            var thumb = res.data.video_url ? res.data.thumbnail_image : '/img/no-video.jpg';
            $('.rightbtn').attr("href", APP_URL + "/getVideoById/" + videoId)
            // $('#video_url').attr('src', video_url);
            // $('#video_url').attr('poster', thumb);
            //   videojs.Vhs.xhr.afterRequest = function (options) {
            //   options.headers = options.headers || {};
            //   options.headers.token = 'shivam',
            //   // options.serverURL='http://52.66.77.143/get-secure-key?token=shivam',
            //   // options.Headers.token ='shivam',
            //   console.log('options', options);
            //   return options;
            // };
            function setupTokenForDecrypt(options) {
              if (options.uri.includes('http://52.66.77.143/get-secure-key')) {
                options.headers = options.headers || {}
                // options.headers.Authorization = 'Bearer Token',
                options.headers['token'] = 'shivam',
                  options.headers['Access-Control-Allow-Origin'] = '*';
                options.headers['Access-Control-Allow-Methods'] = 'GET, PUT, POST, DELETE, HEAD, OPTIONS'
              }

              return options

            }
            videojs.Vhs.xhr.beforeRequest = setupTokenForDecrypt;

            var player = videojs('my_video');
            player.ready(function() {
              this.src({
                src: video_url,
                type: 'application/x-mpegURL'
              });
            });
          }

          $('#Viewpage').modal('show');

        },
        error: function(e) {
          alert(e);
        },
        complete: function() {

        }
      });
    }
  })

  function changeUserStatus(_this, id){
            var status = $(_this).prop('checked') == true ? true : false;
            let _token = $('meta[name="csrf-token"]').attr('content');
            var type = "videos";
            $.ajax({
                url: `/change-status`,
                type: 'post',
                data: {
                    _token: _token,
                    id: id,
                    status: status,
                    type:type,
                },
                success: function (response) {
                   swal('Success','Status Successfully Changed')
                   window.location.reload();
                }
            });
        }

</script>

@stop