@extends('base')
@section('epic_content')
    <style>
        .disabledli {
            pointer-events: none;
            opacity: 0.6;
        }

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/sorting.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropify').dropify();
           // $("#inputTag").tagsinput('items');
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
        <div class="alert alert-success" style="display: none" id="delete_msg">Bios have been deleted successfully.</div>
        <div class="alert alert-danger" style="display: none" id="un_delete_msg"> Unable to delete Bios</div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('#') }}">Content Management</a></li>
                <li class="active">Bios</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <!-- .row -->
    <div class="row">
        <section>
            <div class="content_text headbar">
                <p>Manage Bios</p>
            </div>
            <div class="top-search">
                <div class="row content-search-header">
                    <section class="col-md-5 col-sm-12">
                        <div class="example">
                            <input type="text" placeholder="Enter search term..." name="search_term" id="search_term">
                            <button id="search_term_submit"><i class="fa fa-search"></i></button>
                        </div>

                    </section>

                    <section class="col-md-7 col-sm-12">
                        <div class="form-inline">
                            <div class="col-md-7">
                                <div class="custom-select fiftyper">
                                    <label>Filter by language</label>
                                    <select name="language[]" class="selectpicker applybtn FilterBylanguage firstLng"
                                        multiple data-actions-box="true">
                                        @foreach ($lang as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="custom-select fiftyper">
                                    <label>Filter by status</label>
                                    <select name="status[]" class="selectpicker applybtn FilterByStatus firstStatus"
                                        multiple data-actions-box="true">
                                        <option value="published">Published</option>
                                        <option value="in_draft">In Draft</option>
                                        <option value="in_review">In Review</option>
                                        <option value="unpublished">Unpublished</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn--toggle-filter" href="{{ url('bios') }}" role="button">Clear</a>
                                <button class="btn btn--toggle-filter apply">Apply</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn--toggle-filter" data-toggle="modal" data-target="#Allfilter">All
                                    filters</button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>


            <div class="card" data-content-list="data.photolist">
                <div class="results">

                    <!-- ngIf: list.items.length -->
                    <div class="border-bottom">
                        <h2 class="show-data-pa showing_page_data">Showing {{ $biolist['from'] }} -
                            {{ $biolist['to'] }} of {{ $biolist['total'] }} results</h2>
                        <div class="add-new-button">
                            <a class="recent-content__add btn primary medium" href="{{ url('uploadcontent/bios') }}"><i
                                    class="mdi mdi-plus"></i>Add New Bios</a>
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
                                <input id="check_all" name="product_all" type="checkbox"
                                    class="checked_all form-element">&nbsp;
                                <label for="check_all">Select All</label>
                            </div>
                            <div class="delete-div">
                                <a class="view_delete" id="delete_icon" href="" data-original-title="Delete"
                                    type="button" data-toggle="modal" data-target="#exampleModalLong">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                                <!-- <a href="#" ><i class="glyphicon glyphicon-trash" data-toggle="tooltip" data-original-title="delete"></i></a> -->
                            </div>
                        </div>
                        <!-- Filters -->
                        <div class="filter-wrapper filter-wrapper--content u-flex--fill col-md-9">

                            <div class="filter">
                                <div class="standardInput form-input"><label class="form-label " for="input-0"><span
                                            class="form-label-text ">Max items</span></label><select
                                        class="form-element ng-pristine ng-untouched ng-valid ng-empty max_item_filter filter_target">
                                        <!-- <option value="">All </option> -->
                                        <option class="" value=" 24" selected>24</option>
                                        <option label="36" value="36">36</option>
                                        <option label="48" value="48">48</option>
                                        <option label="60" value="60">60</option>
                                    </select><!-- ngRepeat: ( error, value ) in ngModel.$error -->
                                </div>
                            </div>

                            <div class="filter">
                                <div class="standardInput form-input">
                                    <label class="form-label " for="input-1"><span class="form-label-text ">Sort
                                            by</span></label>
                                    <select class="form-element ng-pristine ng-untouched ng-valid ng-empty sortby_filter"
                                        id="sortby_filter" name="sortby_filter">
                                        <!-- <option value="">All</option> -->
                                        <option value="Last updated" data-i18n="label.updated">Last updated</option>
                                        <option value="Status" data-i18n="label.status">Status</option>
                                        <option value="Publication date" data-i18n="label.publishdate">Publication date
                                        </option>
                                    </select><!-- ngRepeat: ( error, value ) in ngModel.$error -->
                                </div>
                            </div>

                            <div class="filter">
                                <div class="standardInput form-input"><label class="form-label " for="input-1"><span
                                            class="form-label-text ">Show content from</span></label><select
                                        class="form-element ng-pristine ng-untouched ng-valid ng-empty show_content_from_filter"
                                        id="input-1" name="input-1">
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
                                    <li class="btn primary active listview">
                                        <a href="javascript:void(0);"><i class="mdi mdi-apps"></i></a>
                                    </li>
                                    <li class="btn primary2 gridview" data-icon="list">
                                        <a href="javascript:void(0);"><i class="mdi mdi-table"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Grid layout -->
                    <!-- ngIf: layout === 'grid' -->

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered results listing_table list_view" >
                            <thead>
                                <tr>
                                    <th>
                                        {{-- <form method="POST" action="{{ route('delete-articles') }}" name="user_form" --}}
                                        <form method="POST" action="#" name="user_form"
                                            id="deleteBulkarticle" data-parsley-validate>
                                            {{ csrf_field() }}
                                            <input type="hidden" value="" name="single_id" id="single_id">
                                            <input type="hidden" value="tableview" name="tableview">
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
                    <nav aria-label="..." class="paginations">
                        <ul class="pagination ajax_pagination">
                        </ul>
                    </nav>
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
                    <!-- <div class="footer-tablelist" >
                        <form class="go-to-page" >
                              <label class="go-to-page__label">Go to page</label>
                              <div class="standardInput form-input" >
                                <input class="go-to-page__input form-element go" id="go_to" type="number" name="go_to" min="1" max="64">
                              </div>
                              <button type="button" id="go"  class="go-to-page__link">
                                  <span data-i18n="pagination.go">Go</span>
                                  <span>›</span>
                              </button>
                        </form>
                    </div>                             -->
                </div>
            </div>
    </div>
    </section>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 60%; margin: 0 auto;">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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

    <form method="POST" action="{{ route('deletearticles') }}" name="user_form" class="deleteSingleUser"
        data-parsley-validate>
        {{ csrf_field() }}
        <input type="hidden" value="" name="single_deleted_id" id="single_deleted_id">
          <input type="hidden" value="tableview" name="articleview">
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
                <input type="date" class="form-control datepicker" name="from_date">
              </div>
              <div class="col-md-6">
                <label>To date</label>
                <input type="date" class="form-control datepicker" name="to_date">
              </div>
            </div>
          </div>
        </div>
        <h2>Content references</h2>
        <div class="reference-search">

          <div class="reference-search__select-container ">
            <select class="reference-search-s content_ref" name="ref_type" data-type="referance">
              <option value="">Select type</option>
              <option value="text">TEXT</option>
              <option value="images">Photo</option>
              <option value="videos">Video</option>
              <option value="documents">Document</option>
            </select>

            <select class="form-control selectpicker referencesResponse" name="ref[]" id="browsers1" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">
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
    <div  class="modal fade" id="Viewpage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 100%; margin: 0 auto;">
            <div class="modal-header">
                    <h2 class="Preview-title">Bios View</h2>
                    <a class="recent-content__add btn primary medium rightbtn" id="edit_bios" href="">Edit Detail</a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="card-body wizard-content">
              
            <form data-parsley-validate action="#" name="article_form" id="article_form" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                <!-- <button type="button" id="collapsesidebar-btn" class="collapse-btn">
                    <span><i class="mdi mdi-chevron-right fa-fw" data-icon="v"></i> Collapse sidebar</span>
                </button> -->
              <section class="body">  
                <h3 class="border-bottom">Basic Info</h3>
                <div>
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
                                            <span class="date" id="expiryDate"> </span>
                                            <!-- Author:
                                            <span class="date" id="author">Ravindra</span> -->
                                            <!-- Location: 
                                            <span class="date"  id="location">Mumbai</span> -->
                                        </label>
                                        <!--<div class="date" id="publishTo"></div> --> 
                                    </div>
                                </div>

                                <div class="col-md-6">    
                                    <div class="form-group">
                                        <label for="wlastName2" class="pdlt description">Photo </label>
                                        <img src="{{URL::asset('assets/images/bcci2.jpeg')}}" id="image_url" name="image_url" alt="Trulli" class="art-img">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group description">
                                        <label for="wlastName2" class="pdlt description">Content </label>
                                        <div id="content" class="content description"></div>
                                    </div>
                                </div>

                        <!-- <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wlastName2">Video Content</label>
                                <textarea class="form-control" id="summary" name="summary" rows="9" readonly></textarea> 
                            </div>
                        </div>-->





                     <!--    <div class="col-md-6">
                            <div class="form-group">
                                <label for="wfirstName2"> Headline*:</label>
                                <input type="text" class="form-control" value="" id="title" name="title" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2"> Short Description*:</label>
                                <input type="text" class="form-control" value="" id="short_description" name="short_description" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Know Name:</label>
                                <input type="text" class="form-control" value=""  id="known_name" name="known_name" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Surname:</label>
                                <input type="text" class="form-control" value="" id="surname" name="surname" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">                             
                            <div class="form-group">
                                <label for="wfirstName2">First name:</label>
                                <input type="text" class="form-control" value="" id="first_name" name="first_name" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Nationality:</label>
                                <input type="text" class="form-control" value="" id="nationality" name="nationality" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">      
                            <div class="form-group">
                                <label for="wfirstName2">Date of Birth:</label>
                                <input type="date" class="form-control" value="" id="date_of_birth" name="date_of_birth" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Date of Death:</label>
                                <input type="date" class="form-control" value="" id="date_of_death" name="date_of_death" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Place of Birth:</label>
                                <input type="text" class="form-control" value="" id="place_of_birth" name="place_of_birth" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Image:</label>
                                <input type="text" class="form-control" value="" id="image_url" name="image_url" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Position:</label>
                                <input type="text" class="form-control" value="" name="position" id="position" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Career Start Date:</label>
                                <input type="text" class="form-control" value="" id="career_start_date" name="career_start_date" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">                 
                            <div class="form-group">
                                <label for="wfirstName2">Career End Date:</label>
                                <input type="text" class="form-control" value="" name="career_end_date"  id="career_end_date" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Publish Date:</label>
                                <input type="text" class="form-control datepicker" value="" id="publish_date" name="publish_date" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">                
                            <div class="form-group">
                                <label for="wfirstName2">Asset type:</label>
                                <input type="text" class="form-control" value="" id="asset_type" name="asset_type" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Content type:</label>
                                <input type="text" class="form-control" value="" id="content_type" name="content_type" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">References:</label>
                                <input type="text" class="form-control" value="" name="references" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 ">    
                            <div class="form-group">
                                <label for="wfirstName2">Status:</label>
                                <input type="text" class="form-control datepicker" value="" id="status" name="status" readonly>
                            </div>
                        </div> -->
                        
                        <!-- <div class="col-md-6">    
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
                        </div>
                        <div class="col-md-6">                 
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
                        </div>-->
                         <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="wlastName2">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="9" readonly></textarea>
                            </div>
                            
                        </div> 
                        <div class="col-md-6">
                          <div class="form-group">
                                <label for="wlastName2">Summary</label>
                                <textarea class="form-control" id="summary" name="summary" rows="9" readonly></textarea>
                            </div>
                        </div>
                       <div class="col-md-12 bodycontent">
                            <div class="form-group">
                                <label for="wlastName2">Status:</label>
                                <textarea name="content" row="20" id="current_status"  readonly></textarea>
                            </div>
                        </div> -->

                    </div>
                </div>
               <!--  <h3 class="border-bottom">Meta Information</h3>
                <div>
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
                                <textarea class="form-control"  rows="3" readonly></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wlastName2"> Hotlink URL</label>
                                <textarea class="form-control"  rows="3" readonly ></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group date-time">
                                <label for="behName1">Display date</label>
                                <input type="text" class="form-control datepicker" placeholder="23/08/2021" value="" readonly >
                                <input type="text" class="form-control  timepicker" value="" placeholder="time 10:30" readonly >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Metadata* :</label>
                                <input type="text" class="form-control" value="" readonly >
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="border-bottom">Segmentation</h6>
                <div>
                    <div class="row ">
                        <div class="col-md-6" style="margin-bottom: 10px;">
                            <div class="form-group checkbox-al">
                                <input type="checkbox" id="restrict" name="restrict" value="Bike" disabled>
                                <label for="restrict"> Restrict content to logged in users</label><br>
                            </div>
                        </div>
                    </div>
                </div> -->
                </section>
                <!-- <div id="collapsingsidebar" class="collapssidebar min-he">
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="content-ref">
                                        <h2>Content references</h2>
                                        <div class="reference-search" >
                                        <div class="reference-search__select-container">
                                            <ol class="selected-references-new" >
                                                <li class="selected-references-new__item" >
                                                    <div class="selected-references-new__item-title-block">
                                                        <div class="selected-references-new__item-title">4th Test </div>
                                                        <span class="selected-references-new__item-action-link-label">CRICKET_MATCH: 22439</span>
                                                    </div>
                                                </li>
                                                <li class="selected-references-new__item" >
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
                                        <div class="reference-search" >
                                        <div class="reference-search__select-container">
                                            <ol class="selected-references-new" >
                                                <li class="selected-references-new__item" >
                                                    <div class="selected-references-new__item-title-block">
                                                        <div class="selected-references-new__item-title">4th Test </div>
                                                        <span class="selected-references-new__item-action-link-label">CRICKET_MATCH: 22439</span>
                                                    </div>
                                                </li>
                                                <li class="selected-references-new__item" >
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
                    </section>
                </div> -->
            </form>
            </div>
        </div>
    </div>
</div>

    <!-- <script src="{{ asset('js/video/video.js') }}" type="text/javascript"></script>  -->
    <!-- <script src="{{ asset('js/articles/articlelist.js') }}" type="text/javascript"></script> -->
    <script src="{{ asset('js/bios/bioslist.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $("div#Viewpage button#collapsesidebar-btn").click(function() {
                $('div#Viewpage #collapsingsidebar').toggleClass("collapse-deactive");
                $('div#Viewpage section.body').toggleClass("collapse-deactive");
                $("div#Viewpage button#collapsesidebar-btn").text(function(i, v) {
                    return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
                });
            });
        });

        $(document).on("click", ".open-data", function () {
            
            var id = $(this).data('id');
            if (id != undefined && id != null) {
                $.ajax({
                    type: 'GET',
                    url: '/bios/fetchbios/',
                    data: {
                        "id": id,
                    },
                    success: function (res) {
                        console.log(res.data);

                        if (res.data) {
                            console.log(res.data);
                            var publish_date;
                            var expiry_date;
                            $('#title').html(res.data.title);
                            var image_url = res.data.image_url ? res.data.image_url : '/img/no-image.png';
                            var publishTo = res.data.publishTo ? res.data.publishTo : res.data.publishFrom;
                            if(publishTo ==null){
                                publishTo = "N/A";
                            }
                            expdate=res.data.expiryDate;
                            if(expdate ==""){
                                expdate = "N/A";
                            }

                            var edit_url= "{{ url('editBiosById') }}/"+ res.data.ID;
                            console.log("Edit Url : ",edit_url);
                            console.log("expdate :",expdate);
                            console.log("publishTo :",publishTo);
                            $('#image_url').attr('src', image_url);
                            $('#edit_bios').attr('href', edit_url);
                            $('#content').html(res.data.short_description);
                            $('#expiryDate').html(expdate); 
                            $('#publishTo').html(publishTo);

                            $('#Viewpage').modal('show');
                        }
                    },
                    error: function (e) {
                        alert(e);
                    },
                    complete: function () {

                    }
                });
            }
        });

    </script>

@stop
