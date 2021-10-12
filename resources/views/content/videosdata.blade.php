@extends('base')
@section('epic_content')
<style>
    .disabledli {
        pointer-events: none;
        opacity: 0.6;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
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

        /* $('#selectall').click(function() {
     if($(".allselect").prop('checked', true)){
        alert(1);
        $(".allselect").prop('unchecked', true);

    } 

      $(".allselect").prop('checked', true);
});

        });*/


    })
</script>

<script type="text/javascript">
    function getval(sel) {
        if (sel.value === "selectall") {
            $("#deleteall").hide();
            $("#selectall").show();
        } else {
            $("#selectall").hide();
            $("#deleteall").show();
        }
    }
</script>

<!-- <script type="text/javascript">
    $(document).ready(function(){
    $('.check:button').toggle(function(){
        $('input:checkbox').attr('checked','checked');
        $(this).val('uncheck all')
    },function(){
        $('input:checkbox').removeAttr('checked');
        $(this).val('check all');        
    })
})


</script> -->
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
            <li><a href="{{url('/')}}">Manage Videos</a></li>
            <li class="active"></li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">

    <!-- <input type="button" class="check" value="check all"/>

   <input type="checkbox" class="cb-element" /> Checkbox  1
   <input type="checkbox" class="cb-element" /> Checkbox  2
   <input type="checkbox" class="cb-element" /> Checkbox  3 -->

    <section>

        <div class="content_text">
            <p>Manage Videos</p>
        </div>


        <div class="top-search">
            <div class="row content-search-header">
                <section class="col-md-5 col-sm-12">
                    <form class="example" action="{{url('searchByTitle')}}" method="get">
                        @csrf
                        <div class="example">
                            <input type="text" placeholder="Enter search term..." name="search" value="{{($videoslist['type'] == 'search')?$_GET['search']:''}}" id="search_term">
                            <input type="hidden" value="1" name="page" id="1">
                            <input type="hidden" value="videosdata" name="view">
                            <button type="submit" id="search_term_submit"><i class="fa fa-search"></i></button>
                            <!--<input type="text" placeholder="Enter search term..." name="search_term" id="search_term">
                                <button id="search_term_submit"><i class="fa fa-search"></i></button> -->
                        </div>
                    </form>
                </section>

                <section class="col-md-7 col-sm-12">
                    <div class="form-inline">
                        <div class="col-md-7">
                            <div class="custom-select fiftyper">
                                <label>Filter by language</label>
                                <select name="language[]" class="selectpicker applybtn FilterBylanguage firstLng" multiple data-actions-box="true">
                                    <option value="en">English</option>
                                    <option value="mr">Marathi</option>
                                    <option value="hi">Hindi</option>
                                    <option value="ta">Tamil</option>
                                </select>
                            </div>

                            <div class="custom-select fiftyper">
                                <label>Filter by status</label>
                                <select name="status[]" class="selectpicker applybtn FilterByStatus firstStatus" multiple data-actions-box="true">
                                    <option value="published">Published</option>
                                    <option value="in_draft">In Draft</option>
                                    <option value="in_review">In Review</option>
                                    <option value="unpublished">Unpublished</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- <button class="btn btn--toggle-filter">Clear</button> -->
                            <a class="btn btn--toggle-filter" href="{{url('videosdata')}}" role="button">Clear</a>
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
                    <h2 class="show-data-pa">Showing {{ $videoslist['from'] }} - {{ $videoslist['to'] }} of {{ $videoslist['total'] }} results</h2>
                    <div class="add-new-button">
                        <a class="recent-content__add btn primary medium" href="{{url('uploadcontent')}}"><i class="mdi mdi-plus"></i>Add New Videos</a>
                    </div>
                </div>
                <!-- end ngIf: list.items.length -->

                <div class="content-control-wrapper row row--no-margin between-xs">

                    <div class="col-md-4">
                        <!-- <div class="select-all-div">
                <input name="product_all" class="checked_all" type="checkbox">&nbsp; Select All
                </div> -->
                        <div class="delete-div">
                            <!-- <a href="#" ><i class="glyphicon glyphicon-trash" data-toggle="tooltip" data-original-title="delete"></i></a> -->
                            <form method="POST" action="{{ route('deleteBulkVideo') }}" name="user_form" id="deleteBulkVideo" data-parsley-validate>
                                {{csrf_field()}}
                                <input type="hidden" value="" name="video_id" id="video_id">
                                <input type="hidden" value="gridview" name="videoview" id="videoview">
                            </form>
                            <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element" type="checkbox"> &nbsp; Select All
                            <a class="view_delete" id="delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong"> <i class="glyphicon glyphicon-trash" style="color: #e20101"></i>
                            </a>

                        </div>
                    </div>

                    <!--  <div class="col-md-4"> 
      <ul>
        <li><button id="selectall">Select All</button></li>
        <li><button id="deleteall">Delete All</button></li>
      </ul> 
    </div>  -->

                    <!--select button and delete button div start-->

                    <!-- <div class="bulk-edit-control col-md-4">
            <div class="u-flex">
               <div class="select_button"> 
                <select id="selcontent"  onchange="getval(this);">
                    <option value="">Action</option>
                    <option value="selectall">Select All</option>
                    <option value="deleteall">Delete All</option>
                </select>

                <button id="selectall" style="display: none;">Select All</button>
                <button id="deleteall" style="display: none;">Delete All</button>
               </div>
            </div>
            
        </div> -->

                    <!--select button and delete button div start-->

                    <!-- Filters -->
                    <div class="filter-wrapper filter-wrapper--content u-flex--fill col-md-8">

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
                                    <option label="All time" value="">All time</option>
                                    <option label="The last year" value="The last year">The last year</option>
                                    <option label="Last 2 years" value="Last 2 years">Last 2 years</option>
                                    <option label="Last 3 years" value="Last 3 years">Last 3 years</option>
                                </select><!-- ngRepeat: ( error, value ) in ngModel.$error -->
                            </div>
                        </div>

                        <div class="filter">

                            <ul>
                                <h3 class="layout-left">Layout</h3>
                                <li class="btn primary "><a href="{{url('getVideoList')}}"><i class="mdi mdi-apps"></i></a></li>
                                <li class="btn primary2 active" data-icon="list">
                                    <a href="{{url('videosdata')}}"><i class="mdi mdi-table"></i></a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Grid layout -->
                <!-- ngIf: layout === 'grid' -->
                <ol class="content-grid row gride_ajax_data">
                    <!-- ngRepeat: item in list.items -->
                    <?php //pr($videoslist);die; 
                    ?>
                    @foreach($videoslist['videoslist'] as $video)
                    <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                        <label class="content-grid__select">
                            <div class="standardInput no-label form-checkbox">

                                <input value="{{ isset($video['ID'])? $video['ID'] : $video['id'] }}" name="check_video" class="checkbox check_video form-element" type="checkbox">
                            </div>
                        </label>
                        <figure title="News Article">
                            <a class="image" data-cms-href="content.article.edit" data-params="item" href="{{ $video['imageUrl'] ?? '' }}">
                                <!-- new ContentSummaryAPIActive usage start -->
                                <!-- ngIf: !ContentSummaryAPIActive && item.thumbnail -->
                                <!-- ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                                <img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="{{ $video['imageUrl'] ?? '' }}" alt="" src="{{ $video['imageUrl'] ?? '' }}">
                                <!-- end ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                                <!-- new ContentSummaryAPIActive usage end -->
                                <span class="icon" data-icon="text"></span>
                            </a>
                        </figure>
                        <div class="info">
                            <span class="status published" title="Published"></span>
                            <dl class="metadata">
                                <!--  <dt class="title" data-i18n="label.title">Title</dt> -->
                                <dd class="title">
                                    <a data-cms-href="content.article.edit" data-params="item" href="javascript:void(0)">{{ $video['title'] }}</a>
                                    <!-- ngIf: item.internalName -->
                                </dd>
                                <dt class="id" data-i18n="label.id">ID</dt>
                                <dd class="id" data-ng-bind="item.id">{{ isset($video['ID'])? $video['ID'] : $video['id'] }}</dd>
                                <dt class="type" data-i18n="label.type">Type</dt>
                                <dd class="type" data-i18n="content.type.TEXT">News Article</dd>
                                <dt class="date" data-i18n="label.updated">Last updated</dt>
                                <!-- new ContentSummaryAPIActive usage start -->
                                <!-- ngIf: ContentSummaryAPIActive -->
                                <dd class="date" data-ng-if="ContentSummaryAPIActive" data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'">26/07/2021 12:45</dd>
                                <!-- end ngIf: ContentSummaryAPIActive -->
                                <!-- ngIf: !ContentSummaryAPIActive -->
                                <!-- new ContentSummaryAPIActive usage end -->
                                <dt class="language" data-i18n="label.language">Language</dt>
                                <dd class="language" data-language-label="item.language">English</dd>
                                <!-- ngRepeat: filter in filterCtrl.activeFilters -->
                            </dl>
                            <ul class="button_edit">
                                <li>
                                    <a class="view" title="" data-toggle="tooltip" href="navigation" data-original-title="Edit"><i class="glyphicon glyphicon-eye-open"></i></a>
                                </li>
                                <li>
                                    <a class="view" title="" data-toggle="tooltip" href="{{url('getVideoById')}}/{{ isset($video['ID'])? $video['ID'] : $video['id']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                </li>

                                <li>
                                    <a class="publish" title="" data-toggle="tooltip" data-original-title="publish">&nbsp;
                                        <input type="checkbox" hidden="hidden" id="tableview{{ $video['ID'] }}" class="publish_unpublish">
                                        <label class="publish_unpublish" for="tableview{{ $video['ID'] }}"> </label>
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('deleteVideo') }}" name="user_form" id="deleteSinglevideo_{{ isset($video['ID'])? $video['ID'] : $video['id'] }}" data-parsley-validate>
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{ isset($video['ID'])? $video['ID'] : $video['id'] }}" name="single_video_id" id="single_video_id">
                                        <input type="hidden" value="gridview" name="videoview" id="videoview">
                                    </form>
                                    <a href="javascript:void(0);" class="view">
                                        <i class="glyphicon glyphicon-trash single_delete_icon view" id="delete_single_photo_{{ isset($video['ID'])? $video['ID'] : $video['id']  }}" style="color: #e20101"></i>
                                    </a>

                                    <!-- <a class="view" title="" data-toggle="tooltip" href="{{ route('deleteVget') }}/{{ isset($video['ID'])? $video['ID'] : $video['id'] }}" data-original-title="Edit" onClick="return confirm('Delete This account?')"><i class="glyphicon glyphicon-trash"></i></a> -->
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endforeach
                </ol>
                <!-- end ngIf: layout === 'grid' -->

                <!-- nav pagination start -->


                <!-- <nav aria-label="...">
          <ul class="pagination">
            <li class="page-item disabled">
              <span class="page-link">Previous</span>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active">
              <span class="page-link">
                2
                <span class="sr-only">(current)</span>
              </span>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav> -->

                <!-- nav pagination start -->

                @if($videoslist['type'] == 'search')
                <nav aria-label="..." class="paginations">
                    <ul class="pagination right">
                        <li class="page-item {{($videoslist['current_page']-1 ==0 ) ? 'disabledli':''}}">
                            <a class="page-link" href="{{url('/searchByTitle')}}?search={{$_GET['search']}}&page={{ $videoslist['current_page']-1 }}&view=videosdata">Previous</a>
                        </li>
                        @foreach($videoslist['link'] as $key => $link)
                        <li class="page-item {{($link['active'] == 1 ? 'active' : '')}} ">
                            <a class="page-link" href="{{url('/searchByTitle')}}?search={{$_GET['search']}}&page={!! $link['label'] !!}&view=videosdata">
                                {!! $link['label'] !!}
                            </a>
                        </li>
                        @endforeach
                        <li class="page-item {{($videoslist['last_page'] == $videoslist['current_page'] ) ? 'disabledli':''}} ">
                            <a class="page-link" href="{{url('/searchByTitle')}}?search={{$_GET['search']}}&page={{ $videoslist['current_page']+1 }}&view=videosdata">Next</a>
                        </li>
                    </ul>
                </nav>

                <div class="footer-tablelist">
                    <form class="go-to-page" action="{{url('searchByTitle')}}" method="get">
                        <label class="go-to-page__label">Go to page</label>
                        <div class="standardInput form-input">
                            <input type="hidden" placeholder="Enter search term..." name="search" value="{{($videoslist['type'] == 'search')?$_GET['search']:''}}" id="search_term">
                            <input type="hidden" value="videosdata" name="view">
                            <input class="go-to-page__input form-element" type="number" name="page" value="{{$videoslist['current_page']}}" min="1" max="{{ $videoslist['total'] }}">
                        </div>
                        <button type="submit" class="go-to-page__link">
                            <span data-i18n="pagination.go">Go</span>
                            <span>›</span>
                        </button>
                    </form>
                </div>
                @else
                <nav aria-label="..." class="paginations">
                    <ul class="pagination right">
                        <li class="page-item {{($videoslist['current_page']-1 ==0 ) ? 'disabledli':''}}">
                            <a class="page-link" href="{{url('/videosdata')}}/{{ $videoslist['current_page']-1 }}">Previous</a>
                        </li>
                        @foreach($videoslist['link'] as $key => $link)
                        <li class="page-item {{($link['active'] == 1 ? 'active' : '')}} ">
                            <a class="page-link" href="{{url('/videosdata')}}/{!! $link['label'] !!}">
                                {!! $link['label'] !!}
                            </a>
                        </li>
                        @endforeach
                        <li class="page-item {{($videoslist['last_page'] == $videoslist['current_page'] ) ? 'disabledli':''}} ">
                            <a class="page-link" href="{{url('/videosdata')}}/{{ $videoslist['current_page']+1 }}">Next</a>
                        </li>
                    </ul>
                </nav>

                <div class="footer-tablelist">
                    <form class="go-to-page" action="{{url('videosdata')}}" method="get">
                        <label class="go-to-page__label">Go to page</label>
                        <!-- <input type="hidden" value="videosdata" name="view"> -->
                        <div class="standardInput form-input">
                            <input class="go-to-page__input form-element" type="number" value="{{$videoslist['current_page']}}" name="page" min="1" max="{{ $videoslist['total'] }}">
                        </div>
                        <button type="submit" class="go-to-page__link">
                            <span data-i18n="pagination.go">Go</span>
                            <span>›</span>
                        </button>
                    </form>
                </div>
                @endif

                <!-- nav pagination end -->


            </div>

        </div>
</div>

</section>

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
                <input type="hidden" name="single_video_id_form" id="single_video_id_form" class="user_id" value="">
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
                                    <option value="en">English</option>
                                    <option value="mr">Marathi</option>
                                    <option value="hi">Hindi</option>
                                    <option value="ta">Tamil</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Filter by status</label>
                                <select class="selectpicker applybtn FilterByStatus secondStatus" multiple data-actions-box="true">
                                    <option value="published">Published</option>
                                    <option value="in_draft">In Draft</option>
                                    <option value="in_review">In Review</option>
                                    <option value="unpublished">Unpublished</option>
                                    <option value="rejected">Rejected</option>
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
                                <input type="text" class="form-control datepicker" name="from_date">
                            </div>
                            <div class="col-md-6">
                                <label>To date</label>
                                <input type="text" class="form-control datepicker" name="to_date">
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

                        <select class="form-control selectpicker referencesResponse" name="ref[]" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">
                        </select>
                    </div>

                    <!-- <div class="reference-search__select-container">
          <select class="reference-search-s">
            <option selected="selected" disabled="disabled">Select type</option>
            <option>TEXT</option>
            <option>Photo</option>
            <option>Video</option>
            <option>Document</option>
          </select>

          <select class="form-control selectpicker" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">
            <option value='<h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>'>
              <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>
            </option>
            <option value='<h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>'>
              <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span>
            </option>
            <option value='<h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>'>
              <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span>
            </option>
            <option value='<h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>'>
              <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span>
            </option>
          </select>
        </div> -->
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
                <input type="text" id="inputTag" name="tags[]" data-role="tagsinput">
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

        $("#delete_icon").click(function() {
            var f_ids = [];
            $.each($("input[name='check_video']:checked"), function() {
                f_ids.push($(this).val());
            });
            var all_id = f_ids.join(",")
            console.log("all_id", all_id);
            // return false;
            $("#video_id").val(all_id);
        });

        $(".single_delete_icon").click(function() {
            var id = $(this).attr('id');
            id = id.replace('delete_single_photo_', '');
            $('#single_video_id_form').val(id);
            $('#exampleModalLong').modal('show');
        });

        $("#yes_button").click(function() {
            // alert('1');
            // return false;
            var id = $("#single_video_id_form").val();
            if ($('.checkbox:checked').length > 0) {
                $("#deleteBulkVideo").submit();
            } else {
                $("#deleteSinglevideo_" + id).submit();
            }
        });

        // $("#search_field").on('keyup', function(e){
        //     // alert(1);
        //     if (e.key === 'Enter' || e.keyCode === 13){
        //         var serarch_value = $(this).val();
        //         console.log(serarch_value);
        //         if(serarch_value != ''){
        //             $.ajax({
        //                 url: APP_URL+'/usersearch',
        //                 type: "POST",
        //                 data: {
        //                     "_token": "{{ csrf_token() }}",
        //                     'serarch_value' : serarch_value
        //                 },
        //                 dataType: "text",
        //                 success: function(data){
        //                     console.log(data);
        //                 }
        //             });
        //         }
        //     }
        // });
    });
</script>
<script src="{{ asset('js/video/video.js') }}" type="text/javascript"></script>

@stop