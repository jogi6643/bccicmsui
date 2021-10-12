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
        $("li.btn").click(function(){
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
        $('.checkbox').change(function(){ //".checkbox" change 
            if($('.checkbox:checked').length == $('.checkbox').length){
                   $('.checked_all').prop('checked',true);
            }else{
                   $('.checked_all').prop('checked',false);
            }
        });
        });
    </script>

 <style type="text/css">
      .actions.clearfix {
    display: none !important;
}
    </style>

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
            <li class="active">Document</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
  
  <section>
  
  <div class="content_text headbar"><p>Manage document </p></div>
  
<div class="top-search">
    <div class="row content-search-header">
    <section class="col-md-5 col-sm-12">
                <!-- <form class="example" action="#" method="POST"> -->
                    {{csrf_field()}}
                    <div class="example">
                      <input type="text" id="search_term" value="" placeholder="Enter search term..." name="search">
                      <button id="search_term_submit" type="submit"><i class="fa fa-search"></i></button>
                    </div>  
                <!-- </form> -->
            </section>
            <section class="col-md-7 col-sm-12">

{{csrf_field()}}
@php
    $languages = config('bcciconfig.LANGUAGES');
    $status = config('bcciconfig.CONTENT_STATUS');
@endphp
<div class="form-inline">
    <div class="col-md-7">
        <div class="custom-select fiftyper">
            <label>Filter by language</label>
            <select name="search_language" id="search_language" class="selectpicker applybtn" multiple data-actions-box="true" >
                    @foreach($language  as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                    @endforeach
            </select>
        </div>

        <div class="custom-select fiftyper" style="">
            <label>Filter by status</label>
            <select name="current_status" id="current_status" class="selectpicker applybtn" multiple data-actions-box="true" >
                @foreach($status as $val)
                    <option value="{{$val}}">{{$val}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <button class="btn btn--toggle-filter" id="apply_search">Apply</button>
        <button class="btn btn--toggle-filter" id="clear_search">Clear</button>
    </div>
    <div class="col-md-2">
        <button class="btn btn--toggle-filter" data-toggle="modal" data-target="#Allfilter">All filters</button>
    </div>

    <!-- ngRepeat: filter in contentFilters -->

</div>


</section>
    </div>
</div>


    <div class="card" data-content-list="data.articleList"><div class="results">

    <!-- ngIf: list.items.length -->
<div class="border-bottom">
    <h2 class="show-data-pa">Showing 1 - 24 of 143 results</h2>
    <div class="add-new-button">
        <a class="recent-content__add btn primary medium" href="{{url('uploadcontent')}}"><i class="mdi mdi-plus"></i>Add New Document</a>
    </div>
 </div>   

    
    <!-- end ngIf: list.items.length -->


    <div class="content-control-wrapper row row--no-margin between-xs">

        <div class="bulk-edit-control ">
            <div class="u-flex"> 
            <!-- <div class="delete-div">
                <a href="#" >
                  <i data-toggle="tooltip" data-original-title="delete" class="glyphicon glyphicon-trash"></i>
                </a>
            </div> -->   
            
                <!-- <div class="bulk-edit-control__multi-select drop-down">
                    <div class="btn btn--toggle-filter" >
                        <div class="standardInput no-label form-checkbox form-checkbox--multi-select">
                          <input data-common-input="" class="form-element ng-pristine ng-untouched ng-valid ng-empty" type="checkbox">
                        </div>
                        <span class="drop-down__toggle" data-icon="down"></span>
                    </div>
                </div> -->
                <!-- <div class="bulk-edit-control__options ng-hide">
                    <button class="btn btn--toggle-filter">Submit translation</button>
                    <button class="btn btn--toggle-filter">Add references</button>
                
                </div> -->
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
        <div class="filter-wrapper filter-wrapper--content u-flex--fill col-md-8">

            <div class="filter">
                <div class="standardInput form-input"><label class="form-label " for="input-0"><span class="form-label-text ">Max items</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-empty" id="max_items"><option value="24" class="" selected="selected">24</option><option label="36" value="36">36</option><option label="48" value="48">48</option><option label="60" value="60">60</option></select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
            </div>

            <div class="filter">
                <div class="standardInput form-input"><label class="form-label " for="input-1"><span class="form-label-text ">Sort by</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-empty" id="sort_by" name="sort_by">
                    <option value="Last updated" data-i18n="label.updated">Last updated</option>
                    <option value="Status" data-i18n="label.status">Status</option>
                    <option value="Publication date" data-i18n="label.publishdate">Publication date</option>
                </select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
            </div>

            <div class="filter filter--show-content-from">
                <div class="standardInput form-input"><label class="form-label " for="input-2"><span class="form-label-text ">Show content from</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-not-empty" id="content_from" name="input-2">
                <!-- ngIf: filterCtrl.params.toDate || filterCtrl.params.fromDate && !filterCtrl.showContentFromOptions[ filterCtrl.params.fromDate ] --><option label="All time" value="All time">All time</option><option label="The last year" value="The last year" selected="selected">The last year</option><option label="Last 2 years" value="Last 2 years">Last 2 years</option><option label="Last 3 years" value="Last 3 years">Last 3 years</option></select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
            </div>

            <div class="filter">
                
                <ul>
                    <h3 class="layout-left">Layout</h3>
                    <li class="btn primary active"><a href="{{url('getdocument')}}" ><i class="mdi mdi-apps"></i></a></li>
                    <li class="btn primary2" data-icon="list">
                        <a href="{{url('documentlistdata')}}" ><i class="mdi mdi-table"></i></a>
                     
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Grid layout -->
    <!-- ngIf: layout === 'grid' -->
          
<div class="table-responsive">
<table  class="table table-striped table-hover table-bordered results" >
  <thead>
    <tr>
        <th>
            <!-- <form method="POST" action="{{ route('bulkdeletedoc') }}" name="user_form" id="deleteBulkVideo" data-parsley-validate>
                    {{csrf_field()}}
                    <input type="hidden" value="" name="video_id" id="video_id">
                    <input type="hidden" value="tableview" name="videoview" id="videoview">
                </form>
                <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">
                <a class="view_delete" id="delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong"><i class="glyphicon glyphicon-trash" style="color: #e20101"></i>
                </a> -->
        <!-- <input name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">
        All&nbsp;
        <i class="glyphicon glyphicon-trash" style="color: #e20101"></i> -->
      </th>
      <th>ID  </th>
      <th >Title  </th>
      <th >Status  <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> --></th>
      <th >Publication date  <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> --></th>
      <th >Last updated  <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> --></th>
      <th >Language  </i></th>
      <th class="action">Action</th>
      <th class="action">Publish and unpublish</th>
    </tr>
    <tr class="warning no-result">
      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
    </tr>
  </thead>
  <tbody class="xyz">
  <?php //pr($doclist['doclist']);die;?>
  @foreach($doclist['doclist'] as $list)
    <tr>
      <td scope="row">
      <input value="{{ $list['ID'] }}" name="check_video" class="checkbox check_video form-element" type="checkbox">  
        <!-- <input value="1" name="product" class="checkbox form-element" type="checkbox"> -->
      </td>
      <td>{{ $list['ID'] ?? '' }}</td>
      <!-- <td>{{ $list['title'] ?? '' }}</td> -->
      <td>
        <a class="titletab open-data" title="" data-toggle="modal" data-id="{{ $list['ID'] }}">

        {{ $list['title'] ?? '' }}
    </a>
    </td>   
      <td>{{ $list['status'] =='true'?'Published': 'Unpublished' }}</td>
      <td> <?php $date_arr= explode(" ", $list['published_date']);
          $date= $date_arr[0]; 
          echo $date; ?>
      </td>
      <td>{{ $list['last_updated'] ?? '' }}</td>
      <td>{{ $list['language'] ?? '' }}</td>
      <td class="action">

      <a class="view1 open-data tdaction" title="" data-toggle="modal" data-id="{{ $list['ID'] }}"
                                    data-original-title="view">
                                    <!-- <i class="glyphicon glyphicon-eye-open"></i> -->
                                    <span class="ti-eye"></span>
        </a>

        <a class="view1 tdaction" title="" data-toggle="tooltip" href="{{url('getdocumentById')}}/{{$list['ID']}}" data-original-title="Edit"><!-- <i class="glyphicon glyphicon-pencil"></i> -->
          <span class="ti-pencil-alt"></span>
        </a>
        
        <a class="view_delete tdaction" id="single_delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">     
            <!-- <i class="glyphicon glyphicon-trash" style="color: #e20101"></i> -->
            <span class="ti-trash"></span>
        </a>
        
        <!-- <a class="publish" title=""  data-toggle="tooltip" data-original-title="publish">
                                    <input type="checkbox" hidden="hidden" id="publish{{$list['ID']}}" class="publish_unpublish">
                                    <label class="publish_unpublish" for="publish{{$list['ID']}}"> </label>
                                </a> -->
        <form method="POST" action="{{ route('deletedoc') }}" name="user_form" id="deleteSingleUser" data-parsley-validate>
            {{csrf_field()}}
          <input type="hidden" value="{{$list['ID']}}" name="single_video_id" id="single_video_id">
          <input type="hidden" value="tableview" name="videoview" id="videoview">
        </form> 
      </td>
      <td>
        <a class="publish" title=""  data-toggle="tooltip" data-original-title="publish">
            <span class="label">No</span>
            <input type="checkbox" hidden="hidden" id="publish{{$list['ID']}}" class="publish_unpublish">
            <label class="publish_unpublish" for="publish{{$list['ID']}}"> </label>
            <span class="label">Yes</span>
        </a>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tbody class="nsp"></tbody>
</table>
</div>


     <!-- nav pagination start -->
 

     <nav aria-label="...">
        <ul class="pagination right">
            @foreach($doclist['link'] as $link)
                <li class="page-item {{($link['active'] == 1 ? 'active' : '')}}">
                    <a class="page-link" href="{{url('/getdocument')}}/{!! $link['label'] !!}">
                        {!! $link['label'] !!}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

      
     <!-- nav pagination end -->


    <!-- ngIf: layout === 'list' -->

    <!-- ngIf: !list.items.length -->
  <!-- Empty div for flex alignment -->

  <!-- <nav class="pagination">
      <ol>
        
          <li data-ng-class="{ disabled: pageData.page == 1 }" class="disabled">
              <span>‹</span>
              <span data-ng-click="changePage( pageData.page - 1 )" data-i18n="pagination.prev">Prev</span>
          </li>

          <li data-ng-repeat="page in pageData.outerWindow" data-ng-class="{ current: pageData.page === ( page + 1 ) }" class="current">
              <span data-ng-click="changePage( page + 1 )" data-ng-bind="page + 1">1</span>
          </li>
          <li data-ng-repeat="page in pageData.pages" data-ng-class="{ current: pageData.page === page }">
              <span data-ng-click="changePage( page )" data-ng-bind="page">2</span>
          </li>
          <li data-ng-repeat="page in pageData.pages" data-ng-class="{ current: pageData.page === page }">
              <span data-ng-click="changePage( page )" data-ng-bind="page">3</span>
          </li>
          <li data-ng-repeat="page in pageData.pages" data-ng-class="{ current: pageData.page === page }">
              <span data-ng-click="changePage( page )" data-ng-bind="page">4</span>
          </li>
          <li data-ng-if="pageData.last < ( total - pageData.outerWindow.length )" class="spacer disabled">…</li>
          <li data-ng-repeat="page in pageData.outerWindow | orderBy:'$index':true" data-ng-class="{ 'current': pageData.page === ( total - page ) }">
              <span data-ng-click="changePage( total - page )" data-ng-bind="total - page">6</span>
          </li>

          <li data-ng-class="{ disabled: pageData.page == total }">
              <span data-ng-click="changePage( pageData.page + 1 )" data-i18n="pagination.next">Next</span>
              <span>›</span>
          </li>
      </ol>

  </nav> -->
 <!--  <form class="go-to-page ng-pristine ng-valid ng-valid-min ng-valid-max" data-ng-submit="changePage( pageData.goToPage )" data-nowarn="true" novalidate="">
      <label class="go-to-page__label" data-i18n="pagination.goToPage">Go to page</label>
      <div class="standardInput no-label form-input go-to-page__input-wrap" go-to-page__input-wrap=""><input data-common-input="" class="go-to-page__input form-element ng-pristine ng-untouched ng-valid ng-valid-min ng-valid-max ng-not-empty" type="number" data-ng-model="pageData.goToPage" data-additional-css-class="go-to-page__input-wrap" min="1" max="6" id="input-pl-1">

      </div>
      <button type="submit" class="go-to-page__link">
          <span data-i18n="pagination.go">Go</span>
          <span>›</span>
      </button>
  </form> -->

</div>

</div>
</div>

</section>
   
</div>
<div  class="modal fade" id="Viewpage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 100%; margin: 0 auto;">
            <div class="modal-header">
                    <h2 class="Preview-title">Document View</h2>
                    <a class="recent-content__add btn primary medium rightbtn" href="#">Edit Detail</a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
            <div class="card-body wizard-content">
            <form data-parsley-validate action="{{ route('addArticle') }}" name="article_form" id="article_form" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                <!-- <button type="button" id="collapsesidebar-btn" class="collapse-btn">
                    <span><i class="mdi mdi-chevron-right fa-fw" data-icon="v"></i> Collapse sidebar</span>
                </button> -->
                <section class="body">
                <!-- <h3 class="border-bottom">Basic Info</h3> -->
            <div>
                    <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="pdlt" for="wfirstName2"> Headline</label>
                                        <h2 id="title" class="head-title"> New document</h2>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="pdlt" for="wfirstName2">
                                            Publish Date: 
                                            <span class="date" id="published_date"> 2021-09-22</span>
                                            Expiry Date: 
                                            <span class="date" id="expiryDate"> 2021-09-22</span>
                                            Author:
                                            <span class="date" id="published_by">Ravindra</span>
                                            Location: 
                                            <span class="date"  id="location">Mumbai</span>
                                        </label>
                                        <!--<div class="date" id="publishTo"></div> --> 
                                    </div>
                                </div>

                                <div class="col-md-6">    
                                    <div class="form-group">
                                        <label for="wlastName2" class="pdlt description">Document Photo </label>
                                        <img src="" id="doc_url" name="doc_url" alt="Trulli" class="art-img">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group description">
                                        <label for="wlastName2" class="pdlt description">Content Document </label>
                                        <div id="content" class="content description">Syed Mushtaq Ali Trophy 2020-21, SF2 - Punjab vs Baroda: Toss</div>
                                    </div>
                                </div>



                        <!-- <div class="col-md-6">
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
                                <label for="wfirstName2">Article Language:</label>
                                <input type="text" class="form-control" value="" id="language" name="language" disabled>
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
                                <label for="wfirstName2">Document:</label>
                                <input type="file" class="form-control" value="" id="doc_url" name="doc_url" readonly>
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
                                <input type="text" class="form-control" value="" id="content_type" name="content_type" readonly>
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
                                <input type="text" class="form-control" value="" id="keywords" name="keywords" readonly>
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
                                <input type="text" class="form-control" value="" id="match_formats" name="match_formats" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">                 
                            <div class="form-group">
                                <label for="wfirstName2">Published By:</label>
                                <input type="text" class="form-control" value="" id="published_by" name="published_by" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Publish Date:</label>
                                <input type="text" class="form-control datepicker" value="" name="publish_date" id="published_date" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">                
                            <div class="form-group">
                                <label for="wfirstName2">Language:</label>
                                <input type="text" class="form-control" value="" id="language" name="language" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Location:</label>
                                <input type="text" class="form-control" value="" id="location" name="location" readonly>
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
                                <input type="text" class="form-control datepicker" id="expiry_date" value="" name="expiry_date" readonly>
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
                        </div>
                        <div class="col-md-6">                 
                            <div class="form-group">
                                <label for="wfirstName2">Slug:</label>
                                <input type="text" class="form-control" value="" id="url_segment" name="url_segment" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Platform:</label>
                                <input type="text" class="form-control" value="" name="platform" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        </div>   -->

                  </div>

                        <!-- <div class="col-md-12 bodycontent">
                            <div class="form-group">
                                <label for="wlastName2">Body content</label>
                                <textarea name="content" row="20" id="content"  readonly></textarea>
                            </div>
                        </div> -->

              </div>
                </div>
                <!-- <h3 class="border-bottom">Meta Information</h3> -->
               <!--  <div>
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
                                <input type="text" class="form-control" id="metadata" value="" readonly >
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <h3 class="border-bottom">Segmentation</h3> -->
               <!--  <div>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 10px;">
                            <div class="form-group checkbox-al">
                                <input type="checkbox" id="restrict" name="restrict" value="Bike" disabled>
                                <label for="restrict"> Restrict content to logged in users</label><br>
                            </div>
                        </div>
                    </div>
                </div> -->
              </section>
               <!--  <div id="collapsingsidebar" class="collapssidebar min-he">
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
<div  class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.checked_all').on('change', function() {     
                $('.checkbox').prop('checked', $(this).prop("checked"));              
            });
           
            //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked
            $('.checkbox').change(function(){ //".checkbox" change 
                if($('.checkbox:checked').length == $('.checkbox').length){
                   $('.checked_all').prop('checked',true);
                }else{
                   $('.checked_all').prop('checked',false);
                }
            });

            $("#delete_icon").click(function(){
                var f_ids = [];
                $.each($("input[name='check_video']:checked"), function(){
                    f_ids.push($(this).val());
                });
                var all_id = f_ids.join(",")
                console.log("all_id",all_id);
                $("#video_id").val(all_id);
            });
            
            $("#yes_button").click(function(){
                if($('.checkbox:checked').length > 0){
                    $( "#deleteBulkVideo" ).submit();
                }
                else{
                    $("#deleteSingleUser").submit();
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
        $("#clear_search").click(function () {
                location.reload();
        });

        $("#apply_search,#search_term_submit").click(function () {
            // alert($("#search_term").val());
            // alert($("#search_language").val());
            // alert($("#current_status").val());
            // alert($("#max_items").val());
            // alert($("#sort_by").val());
            // alert('desc');
            // alert($("#content_from").val());
            load_data();
        });
        $("#max_items,#sort_by,#content_from").change(function () {
            load_data();
        });
        });

        function load_data(){
        // alert("Hii");
        $.ajax({
            type: 'POST',
            url: '/filterDocs',
            data: {
                    "_token": "{{ csrf_token() }}",
                    'search_term': $("#search_term").val(),
                    'language': $("#search_language").val(),
                    'current_status': $("#current_status").val(),
                    'max_items': $("#max_items").val(),
                    'sort_by': $("#sort_by").val(),
                    'content_from': $("#content_from").val(),
                    'go_to': $("#go_to").val(),
                    'order': 'desc',
            },
            dataType: 'json',
            success: function (response) {
              console.log(response);
            if (response.status=='true') {
                // $('.xyz').hide();
                $('.xyz').html(response.html);
            }
            else{
                $('.xyz').hide();
                $('.nsp').html(response.html);
            }
        },
        error: function (response) {
            //  alert("error"); 
        }
        });
    }
        $('.open-data').click(function() {
            var id = $(this).data('id');
            if (id != undefined && id != null) {
                $.ajax({
                    type: 'GET',
                    url: '/viewdocById',
                    data: {
                        "id": id,
                    },
                    success: function(res) {
                        // alert("Return");
                        console.log(res);
                        if (res.data) {
                            console.log(res.data);
                            $('#title').html(res.data.title);
                            var expiryDate = res.data.expiryDate ? res.data.expiryDate : res.data.expiry_date;
                            var doc_url = res.data.doc_url ? res.data.doc_url : '/img/no-image.png';
                            var pdate = res.data.published_date;
                            var split = pdate.split(" ");
                            var expdate = expiryDate.split(" ");
                            $('#doc_url').attr('src', doc_url);
                            $('#content').html(res.data.description);
                            $('#published_date').html(split[0]);
                            $('#expiryDate').html(expdate[0]); 
                            $('#location').html(res.data.location); 
                            $('#published_by').html(res.data.published_by); 

                            
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
</script>
    <script>
$( document ).ready(function() {    
    $("div#Viewpage button#collapsesidebar-btn").click(function(){ 
        $('div#Viewpage #collapsingsidebar').toggleClass("collapse-deactive");
        $('div#Viewpage section.body').toggleClass("collapse-deactive");
        $("div#Viewpage button#collapsesidebar-btn").text(function(i, v){
            return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
        });
    });
});
</script>
@stop