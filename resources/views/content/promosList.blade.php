@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="js/sorting.js" type="text/javascript"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('.dropify').dropify();
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
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

    <ol class="breadcrumb">
      <li><a href="{{url('#')}}">Content Management</a></li>
      <li class="active">Promo</li>
    </ol>
  </div>
  <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
  <div class="error_message">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block ">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
    </div>
    @endif
  </div>
  <section>

    <div class="content_text headbar">
      <p>Manage Promo</p>
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
              <a class="btn btn--toggle-filter" href="{{url('contentList/promo')}}" role="button">Clear</a>
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
            <a class="recent-content__add btn primary medium" href="{{ url('uploadcontent/promos')}}"><i class="mdi mdi-plus"></i>Add New Promo</a>
          </div>
        </div>

        <!-- end ngIf: list.items.length -->


        <div class="content-control-wrapper row row--no-margin between-xs">
          <div class="col-md-3 no-padd">
            <div class="select-all-div">
              <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element">&nbsp;
              <label for="check_all">Select All</label>
            </div>
            <div class="delete-div">
              <a class="view_delete delete_icon" id="delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#allModalLong">
                <i class="glyphicon glyphicon-trash"></i>
              </a>
              <!-- <a href="#" ><i class="glyphicon glyphicon-trash" data-toggle="tooltip" data-original-title="delete"></i></a> -->
            </div>
          </div>
          <!-- Filters -->
          <div class="filter-wrapper filter-wrapper--content u-flex--fill col-md-8">

            <div class="float-left">

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
          <table class="table table-striped table-hover table-bordered  promos_listing_table list_view">
            <thead>
              <tr>
                <th>
                  <!-- <input name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">
                  &nbsp;
                  <i class="delete_icon glyphicon glyphicon-trash" style="color: #e20101"></i> -->
                </th>
                <th>ID <i class=""></i></th>
                <th>Title <i class=""></i></th>
                <th>Status <i class=""></i></th>
                <th>Publication date <i class=""></i></th>
                <th>Last updated <i class=""></i></th>
                <th>Language <i class=""></i></th>
                <th>Action</th>
                <th>Publish and unpublish</th>
              </tr>
            </thead>
            <tbody class="tableBody">
            </tbody>
          </table>
        </div>



        <!-- <div class="gride_checked_all" style="display:none;margin-left: 6px !important;">
          <input name="product_all" type="checkbox" class="checked_all" type="checkbox">
          <i class="delete_icon glyphicon glyphicon-trash" style="color: #e20101"></i>
        </div> -->
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



        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 60%; margin: 0 auto;">
              <!-- <form method="post" action="{{url('/deleteUser')}}"> -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <input type="hidden" name="user_id" id="single_user_id_form" class="single_user_id_form" value="">
                <h3 class="modal-title" id="exampleModalLongTitle">Do you really want to delete</h3>
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary yes_button_single" id="yes_button_single"><a class=" btn-primary yes_button_single">Yes</a></button>
                <button type="button" class="btn btn-primary delete-btn" data-dismiss="modal">No</button>
              </div>
              <!-- </form> -->
            </div>
          </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="allModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 60%; margin: 0 auto;">
              <form method="POST" action="{{ url('contentList/bulkdeletePromos') }}" name="user_form" id="deleteBulkUser" data-parsley-validate>
                @csrf
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <input type="hidden" value="" name="promos_id" id="promos_id">
                  <h3 class="modal-title" id="exampleModalLongTitle">Do you really want to delete?</h3>
                </div>
                <div class="modal-footer">
                  <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                  <button type="submit" class="btn btn-primary yes_button" id="yes_button"><a class=" btn-primary yes_button">Yes</a></button>
                  <button type="button" class="btn btn-primary delete-btn" data-dismiss="modal">No</button>
                </div>
              </form>
            </div>
          </div>
        </div>


        <div class="modal fade" id="Viewpage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 100%; margin: 0 auto;">
              <div class="modal-header">
                <h2 class="Preview-title">Preview Promo</h2>
                <a class="recent-content__add btn primary medium rightbtn" href="#">Edit Detail</a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="card-body wizard-content">

                <form data-parsley-validate action="{{ route('addArticle') }}" name="article_form" id="article_form" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                  <section class="body">
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
                              <span class="date" id="publish_date"> 2021-09-22</span>
                              Expiry Date:
                              <span class="date" id="expiry_date"> 2021-09-22</span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label class="pdlt fullwidth vdltc" for="wfirstName2" style="width: 100%;">Description</label>
                          <div class="vd-dec">
                            <p id="description"></p>
                          </div>
                        </div>
                      </div>
                  </section>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
</div>

</section>

</div>

<div class="modal fade" id="Allfilter" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                <input type="text" class="form-control mydatepicker" autocomplete="off" name="from_date">
              </div>
              <div class="col-md-6">
                <label>To date</label>
                <input type="text" class="form-control mydatepicker" autocomplete="off" name="to_date">
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

        <!-- <h2>Tags</h2>
        <input type="text" id="inputTag" name="tags" data-role="tagsinput"> -->

        <div class="col-sm-12">
         
            <select class="js-example-basic-multiple js-states form-control"   class="js-example-responsive" style="width: 50%" id="id_label_multiple" multiple="multiple">
            <option value="aaa">aaa</option>
            <option value="bb">bb</option>
            <option value="ccc">ccc</option>
            <option value="aaa">aaa</option>
            <option value="aaa">aaa</option>
            <option value="aaa">aaa</option>
            <option value="aaa">aaa</option>
            </select>
      
        </div>


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
<script src="{{ asset('js/promos/promos.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/common/common_apis.js') }}" type="text/javascript"></script>
<script>
  $(document).ready(function() {

    $(".js-example-basic-multiple").select2({
      width: 'resolve',
      dropdownParent: $("#Allfilter")
    });


    $("div#Viewpage button#collapsesidebar-btn").click(function() {
      $('div#Viewpage #collapsingsidebar').toggleClass("collapse-deactive");
      $('div#Viewpage section.body').toggleClass("collapse-deactive");
      $("div#Viewpage button#collapsesidebar-btn").text(function(i, v) {
        return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
      });
    });

    $(document).on("click", ".open-data", function() {

      var id = $(this).data('id');
      if (id != undefined && id != null) {
        $.ajax({
          type: 'GET',
          url: '/promo/fetchpromo',
          data: {
            "id": id,
          },
          success: function(res) {
            console.log(res.data);
            if (res.data) {
              console.log(res.data);
              $('#title').html(res.data.title);
              $('#publish_date').html(res.data.publish_date);
              $('#expiry_date').html(res.data.expiry_date);
              $('#location').html(res.data.location);
              $('#description').html(res.data.description);

              var image_url = res.data.image_url ? res.data.image_url : '/img/no-image.png';
              $('#image_url').attr('src', image_url);
              $('#Viewpage').modal('show');
            }
          },
          error: function(e) {
            alert(e);
          },
          complete: function() {

          }
        });
      }
    });
  });
</script>
@stop