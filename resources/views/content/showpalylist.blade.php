<?php 
// echo "asdfasdf";
// echo "<pre>";
// print_r($showpalylist);
// exit; 
?>
@extends('base')
@section('epic_content')
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
            <li class="active">playlists</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
  
  <section>
  
  <div class="content_text headbar"><p>Manage play lists</p></div>
  
  <div class="top-search">
                <div class="row content-search-header">
                    <section class="col-md-5 col-sm-12">
                        <div class="example">
                            {{csrf_field()}}
                            <input type="text" placeholder="Enter search term..." name="search" class="search_field" id="search_field">
                            <button type="button" id="search_btn"><i class="fa fa-search"></i></button>
                        </div>
                    </section>
                    <section class="col-md-7 col-sm-12">
                        {{csrf_field()}}
                        <div class="form-inline">
                            <div class="col-md-7">
                                <div class="custom-select fiftyper">
                                    <label>Filter by language</label>
                                    <select id="search_language" name="search_language"  class="selectpicker applybtn" multiple data-actions-box="true" >
                                        <option value="english">English</option>
                                        <option value="marathi">Marathi</option>
                                        <option value="hindi">Hindi</option>
                                        <option value="4">Tamil</option>
                                    </select>
                                </div>
                                <div class="custom-select fiftyper">
                                    <label>Filter by status</label>
                                    <select id="current_status" name="current_status"  class="selectpicker applybtn" multiple data-actions-box="true" >
                                        <option value="published">Published</option>
                                        <option value="In Draft">In Draft</option>
                                        <option value="In Review">In Review</option>
                                        <option value="Unpublished">Unpublished</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <button class="btn btn--toggle-filter" id="clear_search" name="clear_search">Clear</button>
                                <button class="btn btn--toggle-filter" id="apply_search" name="apply_search" >Apply</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn--toggle-filter" data-toggle="modal" data-target="#Allfilter">All filters</button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
</div>
      

    <div class="card mlr" data-content-list="data.articleList"><div class="results">

    <!-- ngIf: list.items.length -->
<div class="border-bottom">
    <h2 class="show-data-pa">Showing 1 - 24 of 143 results</h2>
    <div class="add-new-button">
        <a class="recent-content__add btn primary medium" href="{{url('uploadcontent')}}"><i class="mdi mdi-plus"></i>Add New Playlist</a>
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

        <!-- Filters -->
        <div class="col-md-3 no-padd">
            <div class="select-all-div">
                <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element">&nbsp; 
                <label for="check_all">Select All</label>
            </div>
            <div class="delete-div">
                <a class="view_delete" id="delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#confirm_delete_modal">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
                <!-- <a href="#" ><i class="glyphicon glyphicon-trash" data-toggle="tooltip" data-original-title="delete"></i></a> -->
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-wrapper filter-wrapper--content u-flex--fill col-md-9">
                <div class="filter">
                    <div class="standardInput form-input">
                        <label class="form-label " for="input-0">
                            <span class="form-label-text ">Max items</span>
                        </label>
                        <select id="max_items" name="max_items" class="form-element ng-pristine ng-untouched ng-valid ng-empty">
                            <option value="24" selected="selected">24</option>
                            <option value="36">36</option>
                            <option value="48">48</option>
                            <option value="60">60</option>
                        </select>
                    </div>
                </div>
                <div class="filter">
                    <div class="standardInput form-input">
                        <label class="form-label " for="input-1">
                            <span class="form-label-text ">Sort by</span>
                        </label>
                        <select class="form-element ng-pristine ng-untouched ng-valid ng-empty" id="sort_by" name="sort_by">
                            <option value="" data-i18n="label.updated">Last updated</option>
                            <option value="status" data-i18n="label.status">Status</option>
                            <option value="publishDate" data-i18n="label.publishdate">Publication date</option>
                        </select>
                    </div>
                </div>
                <div class="filter filter--show-content-from">
                    <div class="standardInput form-input">
                        <label class="form-label " for="input-2">
                            <span class="form-label-text ">Show content from</span>
                        </label>
                        <select class="form-element ng-pristine ng-untouched ng-valid ng-not-empty" id="content_from" name="content_from">
                            <option label="All time" value="">All time</option>
                            <option value="last_years" selected="selected">The last year</option>
                            <option value="last_2_years">Last 2 years</option>
                            <option value="last_3_years">Last 3 years</option>
                        </select>
                    </div>
                </div>
                <div class="filter">
                <ul>
                    <h3 class="layout-left">Layout</h3>
                    <li class="btn primary active"><a href="{{url('photos')}}" ><i class="mdi mdi-apps"></i></a></li>
                    <li class="btn primary2" data-icon="list">
                        <a href="{{url('photodata')}}" ><i class="mdi mdi-table"></i></a>                                
                    </li>
                </ul>
                    <!-- <ul>
                        <h3 class="layout-left">Layout</h3>
                        <li class="btn primary active">
                            <a href="#list_view" data-toggle="tab"><i class="mdi mdi-apps"></i></a>
                            <a href="{{url('getVideoList')}}" data-toggle="tab"><i class="mdi mdi-apps"></i></a>

                        </li>
                        <li class="btn primary2" data-icon="list">
                            <a href="#table_view" data-toggle="tab"><i class="mdi mdi-table"></i></a>
                            <a href="{{url('videosdata')}}" data-toggle="tab"><i class="mdi mdi-table"></i></a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>

    <!-- Grid layout -->
    <!-- ngIf: layout === 'grid' -->
       
<div class="table-responsive">
<table  class="table table-striped table-hover table-bordered results list_view" >
  <thead>
    <tr>
      <th>
          <!--
          <form method="POST" action="{{ route('deleteBulklists') }}" name="user_form" id="deleteBulkVideo" data-parsley-validate>
              {{csrf_field()}}
              <input type="hidden" value="" name="video_id" id="video_id">
              <input type="hidden" value="tableview" name="videoview" id="videoview">
          </form>
          <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">
          <a class="view_delete" id="delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong"><i class="glyphicon glyphicon-trash" style="color: #e20101"></i>
          </a>-->
        <!-- <input name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">
        All&nbsp;
        <i class="glyphicon glyphicon-trash" style="color: #e20101"></i> -->
      </th>
      <th>ID</th>
      <th >Title</th>
      <th >Status</th>
      <th class="p-date">Publication date</th>
      <th class="p-date">Last updated</th>
      <!-- <th >Language</th> -->
      <th class="action">Action</th>
      <th class="publish">Publish and unpublish</th>
    </tr>
    <tr class="warning no-result">
      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
    </tr>
  </thead>
  <tbody id="load_datatwo">
    <?php //pr($videoslist);die;?>
  @foreach($videoslist['videoslist'] as $video)
    <tr>
      
      <td scope="row">
        <input value="{{ $video['ID'] }}" name="check_video" class="checkbox check_video form-element" type="checkbox">
        <!-- <input value="1" name="product" class="checkbox form-element" type="checkbox"> -->
      </td>
      <td>{{ $video['ID'] }}</td>
      <td> <a class="titletab open-data" data-toggle="modal" data-id="{{ $video['ID'] }}">{{ $video['title'] }}</a></td>
      <td>{{ $video['status'] }}</td>
      <td>{{ $video['publish_date'] }}</td>
      <td>{{ $video['created_date'] }}</td>
      <td class="action">

       
        <!-- <form method="POST" action="{{ route('deleteplaylists') }}" name="user_form" id="deleteSingleUser" data-parsley-validate>
            {{csrf_field()}}
          <input type="hidden" value="{{$video['ID']}}" name="single_video_id" id="single_video_id">
          <input type="hidden" value="tableview" name="videoview" id="videoview">
        </form>  -->
               
        <!-- <a class="view_delete" id="single_delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">     
            <i class="glyphicon glyphicon-trash" style="color: #e20101"></i>
        </a> -->
        <form method="POST" action="{{ route('deleteplaylists') }}" name="user_form" id="deleteSinglevideo_{{$video['ID']}}" data-parsley-validate>
            {{csrf_field()}}
            <input type="hidden" value="{{$video['ID']}}" name="single_video_id" id="single_video_id">
            <input type="hidden" value="tableview" name="videoview" id="videoview">
        </form>

        <!-- <a class="view1" title="" data-toggle="modal" data-target="#Viewpage" 
                       data-original-title="view">
            <i class="glyphicon glyphicon-eye-open"></i>
        </a> -->
        <a class="view1 open-data tdaction" title="" data-toggle="modal" data-id="{{ $video['ID'] }}"
            data-original-title="view">
            <span class="ti-eye"></span>
        </a> 

        <a class="view1 tdaction" title="" data-toggle="tooltip" href="{{url('editplaylists')}}/{{$video['ID']}}" data-original-title="Edit"><span class="ti-pencil-alt"></span></a>
        <a class="view1 tdaction" title="">
           <span class="ti-trash"></span>
        </a>

 

        <!--<i class="glyphicon glyphicon-trash single_delete_icon tdaction" id="delete_single_photo_{{ $video['ID'] }}" style="color: #e20101"></i>-->

        <!-- <a class="publish" title=""  data-toggle="tooltip" data-original-title="{{ $video['ID'] }}">
            <input type="checkbox" hidden="hidden" id="{{ $video['ID'] }}" class="publish_unpublish">
            <label class="publish_unpublish" for="publish"> </label>
        </a>   -->


        <!-- <form method="POST" action="{{ route('deleteVideo') }}" name="user_form" id="deleteSingleVideo" data-parsley-validate>
                                                {{csrf_field()}}
          <input type="hidden" value="" name="single_video_id" id="single_video_id">
        </form>

        <a class="view1" title="" data-toggle="tooltip" data-original-title="delete" data-toggle="modal" data-target="#exampleModalLong"><i class="glyphicon glyphicon-trash"></i></a> -->

      </td>
      <td>       
        <a class="publish" title=""  data-toggle="tooltip" data-original-title="publish">&nbsp;
            <span class="label">No</span>
            <input type="checkbox" hidden="hidden" id="{{$video['ID']}}" class="publish_unpublish">
            <label class="publish_unpublish" for="{{$video  ['ID']}}"> </label>
            <span class="label">Yes</span>
        </a>
      </td>  
    </tr>
    @endforeach
    <!--    <tr>
      <td scope="row">
        <input value="1" name="product" class="checkbox form-element" type="checkbox">
      </td>
      <td>122</td>
      <td>Second Sri Lanka-India T20I postponed</td>
      <td>Published</td>
      <td>27 Jul 2021 16:15</td>
      <td>  27 Jul 2021 16:26</td>
      <td>  English</td>
      <td>

        <a class="view1" title="" data-toggle="tooltip" href="navigation" data-original-title="view"><i class="glyphicon glyphicon-eye-open"></i></a>

        <a class="view1" title="" data-toggle="tooltip" href="uploadcontent" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
        
        <a class="view1" title="" data-toggle="tooltip" data-original-title="delete"><i class="glyphicon glyphicon-trash"></i></a>

      </td>
    </tr>
        <tr>
      <td scope="row">
        <input value="1" name="product" class="checkbox form-element" type="checkbox">
      </td>
      <td>123</td>
      <td>Second Sri Lanka-India T20I postponed</td>
      <td>Published</td>
      <td>27 Jul 2021 16:15</td>
      <td>  27 Jul 2021 16:26</td>
      <td>  English</td>
      <td>

        <a class="view1" title="" data-toggle="tooltip" href="navigation" data-original-title="view"><i class="glyphicon glyphicon-eye-open"></i></a>

        <a class="view1" title="" data-toggle="tooltip" href="uploadcontent" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
        
        <a class="view1" title="" data-toggle="tooltip" data-original-title="delete"><i class="glyphicon glyphicon-trash"></i></a>

      </td>
    </tr>
        <tr>
      <td scope="row">
        <input value="1" name="product" class="checkbox form-element" type="checkbox">
      </td>
      <td>124</td>
      <td>Second Sri Lanka-India T20I postponed</td>
      <td>Published</td>
      <td>27 Jul 2021 16:15</td>
      <td>  27 Jul 2021 16:26</td>
      <td>  English</td>
      <td>

        <a class="view1" title="" data-toggle="tooltip" href="navigation" data-original-title="view"><i class="glyphicon glyphicon-eye-open"></i></a>

        <a class="view1" title="" data-toggle="tooltip" href="uploadcontent" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
        
        <a class="view1" title="" data-toggle="tooltip" data-original-title="delete"><i class="glyphicon glyphicon-trash"></i></a>

      </td>
    </tr>-->

  </tbody>
</table>
</div>


     <!-- nav pagination start -->
 

     <nav aria-label="..." class="paginations">
          <ul class="pagination right">
              @foreach($videoslist['link'] as $link)
                  <li class="page-item {{($link['active'] == 1 ? 'active' : '')}}">
                      <a class="page-link" href="{{url('/playlists')}}/{!! $link['label'] !!}">
                          {!! $link['label'] !!}
                      </a>
                  </li>
              @endforeach
            
          </ul>
      </nav>
        <div class="footer-tablelist">
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
        </div>
      
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
<div  class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                // return false;
                $("#video_id").val(all_id);
            });

            $(".single_delete_icon").click(function(){
                var id = $(this).attr('id');
                id = id.replace('delete_single_photo_','');
                $('#single_video_id_form').val(id);
                $('#exampleModalLong').modal('show');
            });
            
            $("#yes_button").click(function(){
                // alert('1');
                // return false;
                var id = $("#single_video_id_form").val();
                if($('.checkbox:checked').length > 0){
                    $("#deleteBulkVideo").submit();
                }
                else{
                    $("#deleteSinglevideo_"+id).submit();
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



<div  class="modal fade" id="Allfilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 60%; margin: 0 auto;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h2 >All filters</h2>
            <div class="row">
                <div class="col-md-7 seperator">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Filter by language</label>
                            <select name="language"  class="selectpicker" multiple data-actions-box="true" >
                                <option value="english" selected>English</option>
                                <option value="marathi">Marathi</option>
                                <option value="hindi">Hindi</option>
                                <option value="4">Tamil</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Filter by status</label>
                            <select name="language"  class="selectpicker" multiple data-actions-box="true" >
                                <option value="english" selected>Published</option>
                                <option value="marathi">In Draft</option>
                                <option value="hindi">In Review</option>
                                <option value="4">Unpublished</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Filter by import source</label>
                            <select name="language"  class="selectpicker" multiple data-actions-box="true" >
                                <option value="english" selected>Manual upload</option>
                                <option value="marathi">External provider</option>
                                <option value="hindi">Workflows</option>
                                <option value="4">Tamil</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-6">
                            <label>From date</label>
                            <input type="text" class="form-control datepicker" value="2021-11-30 " name="created_date">
                        </div>
                        <div class="col-md-6">
                            <label>To date</label>
                            <input type="text" class="form-control datepicker" value="2021-11-30 " name="created_date">
                        </div>
                    </div>
                </div>
            </div>
            <h2>Content references</h2>
            <div class="reference-search" >
                <div class="reference-search__select-container">
                    <select class="reference-search-s">
                        <option selected="selected" disabled="disabled">Select type</option>
                        <option>TEXT</option>
                        <option>Photo</option>
                        <option>Video</option>
                        <option>Document</option>
                    </select>

                    <select class="form-control selectpicker" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">
                        <option value='<h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>'><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span></option>
                        <option value='<h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>'><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                        <option value='<h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>'><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                        <option value='<h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>'><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    </select>


                </div>
                <div class="selectedvalue" role="document"></div>
                <ul class="added-freq">
                    <li data-toggle="modal" data-target="#Favourites">
                        <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added

                    </li>
                    <li  data-toggle="modal" data-target="#Favourites">
                        <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                    </li>
                    <li  data-toggle="modal" data-target="#Favourites">
                        <i class="mdi mdi-heart-outline fa-fw" data-icon="v"></i> Favourites
                    </li>
                </ul>
                <div  class="modal fade" id="Favourites" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="width: 60%; margin: 0 auto;">
                            <button type="button" class="close btn innerpopup"  aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h2 >Click the add button to attach the content reference</h2>
                            <select class="form-control selectpicker" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">
                                <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                                <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                                
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <h2>Tags</h2>
            <input type="text" id="inputTag" value="" data-role="tagsinput">
            <ul class="added-freq">
                <li  data-toggle="modal" data-target="#Favourites">
                    <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added
                </li>
                <li  data-toggle="modal" data-target="#Favourites">
                    <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                </li>
            </ul>

            <a class="recent-content__add btn primary medium" href="#">Submit</a>

        </div>
    </div>
</div>

<div  class="modal fade" id="Viewpage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 100%; margin: 0 auto;">
            <div class="modal-header">

                <h2 class="Preview-title">Preview Playlist</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body wizard-content">
              
            <form data-parsley-validate action="{{ route('addArticle') }}" name="article_form" id="article_form" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                <!--<button type="button" id="collapsesidebar-btn" class="collapse-btn">
                    <span><i class="mdi mdi-chevron-right fa-fw" data-icon="v"></i> Collapse sidebar</span>
                </button>-->
                <h6>Basic Info</h6>
                <section>
                    <!--<h3>Basic Info</h3>-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <!--<input type="text" id="headline_show" name="headline_show" class="form-control" value="" disabled>-->
                                <a class="recent-content__add btn primary medium rightbtn" href="#">Edit Detail</a>
                                <h2 id="headline_show" class="head-title"></h2>
                                

                                <!--<label for="wfirstName2"> Title</label>-->
                                
                            </div>
                        </div>
                        <div class="col-md-12">    
                            <div class="form-group">
                                <label class="pdlt" for="wfirstName2">
                                    Publish Date: 
                                    <span class="date" id="publishTo"> 2021-09-22</span>
                                    Un Publish Date: 
                                    <span class="date" id="publishTo"> 2021-09-22</span>
                                    Author:
                                    <span class="date" id="author"> Ravindranath</span>
                                    Location: 
                                    <span class="date"  id="location"> Mumbai</span>
                                </label>
                               <!-- <input type="text" id="url_segment" name="url_segment" class="form-control" value="" name="short_description" readonly>-->
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2"> Url Segment: &nbsp;&nbsp;<span class="poptext"  id="url_segment"></span></label>
                                
                               <!-- <input type="text" id="url_segment" name="url_segment" class="form-control" value="" name="short_description" readonly>-->
                            </div>
                        </div>

                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Asset Type: &nbsp;&nbsp;<span class="poptext" id="assettype"></span></label>
                                <!--<input type="text" id="assettype" name="assettype" class="form-control" value="" readonly>-->
                            </div>
                        </div>
                        <!--<div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Subtitle:</label> 
                                <label for="wfirstName2">Headline</label>
                                <input type="text" id="title" name="title" class="form-control" value="" name="title" readonly>
                            </div>
                        </div>-->
                        {{--<div class="col-md-6">                             
                            <div class="form-group">
                                <label for="wfirstName2">Expiry Date: &nbsp;&nbsp;<span class="poptext" id="expirydate"></span></label>
                                <!--<input type="text" id="expirydate" name="expirydate" class="form-control" value="" readonly>-->
                            </div>
                        </div>
                        <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Status: &nbsp;&nbsp;<span class="poptext" id="status"></span></label>
                                <!--<input type="text" id="status" name="status" class="form-control" value="" readonly>-->
                            </div>
                        </div>--}}
                        <!-- <div class="col-md-6">      
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wlastName2">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="9" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label for="wlastName2">Summary</label>
                                <textarea class="form-control" id="summary" name="summary" rows="9" readonly></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="wlastName2">Body content</label>
                                <textarea name="content" row="20" id="content"  readonly></textarea>
                            </div>
                        </div> -->

                    </div>
                    <!--<h3>Meta Information</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="wfirstName2"> Subtitle</label>
                                <input type="text" id="subtitle" name="subtitle" class="form-control" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wemailAddress2"> Summary</label>
                                <textarea class="form-control"  id="summary" name="summary" rows="3" readonly></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wlastName2"> Slug</label>
                                <textarea class="form-control" id="slug" name="slug" rows="3" readonly ></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group date-time">
                                <label for="behName1">Cover Image</label>
                                <input type="text" id="coverimage" name="coverimage" class="form-control" readonly >
                                <!-- <input type="text" class="form-control  timepicker" value="" placeholder="time 10:30" readonly > -
                            </div>
                        </div>-->
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Metadata* :</label>
                                <input type="text" class="form-control" value="" readonly >
                            </div>
                        </div> 
                    </div>-->
                    <!--<h3>Segmentation</h3>
                    <div class="row">
                          <div class="col-md-6">
                            <div class="form-group date-time">
                                <label for="behName1">location</label>
                                <input type="text" id="location" name="location" class="form-control" readonly >
                                <!-- <input type="text" class="form-control  timepicker" value="" placeholder="time 10:30" readonly >
                            </div>
                          </div> 
                          <div class="col-md-6"> 
                            <div class="form-group date-time">
                                <label for="behName1">Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-control" readonly >
                                <!-- <input type="text" class="form-control  timepicker" value="" placeholder="time 10:30" readonly > 
                            </div>
                          </div> 
                          <div class="col-md-6">  
                            <div class="form-group date-time">
                                <label for="behName1">Longitude</label>
                                <input type="text" id="longitude" name="longitude" class="form-control" readonly >
                                <!-- <input type="text" class="form-control  timepicker" value="" placeholder="time 10:30" readonly > 
                            </div>
                          </div> 
                          <div class="col-md-6">    
                            <div class="form-group date-time">
                                <label for="behName1">Publish Date</label>
                                <input type="text" id="publishdate" name="publishdate" class="form-control" readonly >
                                <!-- <input type="text" class="form-control  timepicker" value="" placeholder="time 10:30" readonly >
                            </div>
                          </div> 
                          <div class="col-md-6">                            
                            <div class="form-group date-time">
                                <label for="behName1">Language</label>
                                <input type="text" id="language" name="language" class="form-control" readonly >
                                <!-- <input type="text" class="form-control  timepicker" value="" placeholder="time 10:30" readonly > 
                            </div>
                          </div> 
                          <div class="col-md-6">                            
                            <div class="form-group date-time">
                                <label for="behName1">Tags</label>
                                <input type="text" id="tags" name="tags" class="form-control" readonly >
                                <!-- <input type="text" class="form-control  timepicker" value="" placeholder="time 10:30" readonly > 
                            </div>
                        </div>
                        <!-- <div class="col-md-6" style="margin-bottom: 10px;">
                            <div class="form-group checkbox-al">
                                <input type="checkbox" id="restrict" name="restrict" value="Bike" disabled>
                                <label for="restrict"> Restrict content to logged in users</label><br>
                            </div>
                        </div> 
                    </div>-->
                </section>
                <!--
                <div id="collapsingsidebar" class="collapssidebar">
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="content-ref">
                                        <h2>Content references</h2>
                                        <div class="reference-search" >
                                        <div class="reference-search__select-container">
                                            <div id="references" class="selectedvalue"><div>
                                            <!-- <ol class="selected-references-new" >
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
                                        <div id="related_content" class="selectedvalue" ><div>
                                            <!-- <ol class="selected-references-new" >
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
                </div>-->
            </form>
            </div>
        </div>
    </div>
</div>
<script>
$( document ).ready(function() {
        $("button.btn.btn--toggle-filter").click(function(){
                $(".reference-search .inner.open ").append('<button class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>');
        });
        $("button.btn.btn--toggle-filter").click(function(){
            $("button#add-sel").click(function(){        
              var optionsselected = $("select#browsers").val();
              $('.selectedvalue').html("");
              $.each(optionsselected,function(i,x) {
                $('.selectedvalue').append('<div class="selectedcol">'+x+'<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>')
              });
            }); 
        });
        $('.selectedvalue').on('click', '#close-selected', function() {
            $(this).parents('.selectedcol').fadeOut();
            
        });   
        $("button.close.btn.innerpopup").click(function(){
            $('#Favourites').modal('hide');
        });
});
</script>
<script type="text/javascript">

    $('.open-data').click(function() {
        // alert("asdfsadf");return false;
        // alert("asdfasdf");
        var id = $(this).data('id');
        // alert(id);
        // return false;
        if (id != undefined && id != null) {
            $.ajax({
                type: 'GET',
                url: '/playlist/fetchplay',
                data: {
                    "id": id,
                },
                success: function(res) {
                    // console.log("res",res);
                    // return false;                
                    if (res.data) {
                        console.log(res.data);
                        // return false;
                        $('#title').val(res.data.title);
                        $('#url_segment').html(res.data.url_segment);
                        // $('#photo_show').val(res.data.image_url);
                        // $("#headline_show").attr( res.data.headline);
                        $('#assettype').html(res.data.playlist_type);
                        $('#expirydate').html(res.data.expiryDate);
                        $('#headline_show').html(res.data.headline);
                        $('#subtitle').val(res.data.subtitle);
                         console.log("references",res.data.references);
                        // if(res.data.references != null){
                            var obj = jQuery.parseJSON(res.data.references);
                            //  console.log("references1",obj);
                             $.each(obj, function (index, value) {
                                var option = '<div class="selectedcol "> <h2>'+value.title+'</h2><span>'+value.id+'</span> <span>'+value.type+'</span></div>';
                                $('#references').append(option);
                            });    
                        // }
                        
                        // if(res.data.related != ""){
                            var relatedobj = jQuery.parseJSON(res.data.related);
                             console.log("references1",relatedobj);
                             $.each(relatedobj, function (index, value) {
                                var option = '<div class="selectedcol "> <h2>'+value.title+'</h2><span>'+value.id+'</span> <span>'+value.type+'</span></div>';
                                $('#related_content').append(option);
                            });
                        // }
                            
                        if (res.data.language == 'en' || res.data.language ==
                            'English' || res.data.language == 'english') {
                            $('#leng').val('English');
                        } else if (res.data.language == 'hi' || res.data.language ==
                            'Hindi' || res.data.language == 'hindi') {
                            $('#leng').val('Hindi');
                        } else {

                            $('#leng').val('N/A');
                        }
                        $('#summary').val(res.data.summary); 
                         $('#slug').val(res.data.slug); 
                         $('#coverimage').val(res.data.cover); 
                         $('#publishdate').val(res.data.publish_date); 
                         $('#language').val(res.data.language); 
                         $('#tags').val(res.data.tags); 
                        //  $('#expiry_date').val(res.data.expiryDate); 
                        //  $("#urlsegnment").val(res.data.title.replace(/\s+/g, '-').toLowerCase());
                        //  $("#platform").val(res.data.platform);
                        if (res.data.current_status == 'draft' || res.data.current_status == 'Draft')
                        {
                            $("#status").html('In Draft');
                        }
                        else if(res.data.current_status=='unpublish'|| res.data.current_status=='unpublished')
                        {
                            $("#status").val('Un published');
                        }
                        else if(res.data.current_status=='publish'||res.data.current_status=='published')
                        {
                            $("#status").val('Published');
                        }
                        else
                        {
                            $("#status").val('In Draft');
                            
                        }
                        $('#content').val(res.data.body)
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
    })
    $("#clear_search").click(function () {
        location.reload();
    });
    $("#apply_search,#search_field").click(function () {
            load_data();
            // alert($("#search_status").val());
            // alert($("#search_language").val());
    });
    $("#max_items,#sort_by,#content_from").change(function () {
        load_data();
    });
    $("#go").click(function () {
        load_data();
    });
    function load_data(){
        $.ajax({
            type: 'POST',
            url: APP_URL+'/playlistSearchlist',
            data: {
                "_token": "{{ csrf_token() }}",
                'search_field': $("#search_field").val(),
                'language': $("#search_language").val(),
                'current_status': $("#current_status").val(),
                'max_items': $("#max_items").val(),
                'sort_by': $("#sort_by").val(),
                'content_from': $("#content_from").val(),
                'go_to': $("#go_to").val(),
                'order': 'desc',
            },
            dataType: 'json',
            success: function (data) {
                $('#load_datatwo').html(data.html);
            }
        });
    }
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