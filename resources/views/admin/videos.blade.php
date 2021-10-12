@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="js/sorting.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify();
        $("#inputTag").tagsinput('items');
          $("button.btn.btn--toggle-filter").click(function(){
            $("div#Allfilter .inner.open").append("<button class='btn-modal-box' >Add selected references</button>");
          });
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
            <li class="active">Videos</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
  
  <section>
  
  <div class="content_text"><p>Manage Videos</p></div>
  
<div class="top-search">
    <div class="row content-search-header">
            <section class="col-md-5 col-sm-12">
                <form class="example" action="{{url('searchByTitle')}}" method="POST">
                    {{csrf_field()}}
                    <div class="example">
                      <input type="text" placeholder="Enter search term..." name="search">
                      <button type="submit"><i class="fa fa-search"></i></button>
                    </div>  
                </form>
            </section>
            <section class="col-md-7 col-sm-12">
              
              {{csrf_field()}}
               <div class="form-inline">
                 <div class="col-md-7">
                    <div class="custom-select fiftyper">
                      <label>Filter by language</label>
                      <select name="language"  class="selectpicker applybtn" multiple data-actions-box="true" >
                        
                        <option value="english" selected>English</option>
                        <option value="marathi">Marathi</option>
                        <option value="hindi">Hindi</option>
                        <option value="tamil">Tamil</option>
                      </select>
                    </div>
                 
                    <div class="custom-select fiftyper" style="">
                        <label>Filter by status</label>
                      <select name="status"  class="selectpicker applybtn" multiple data-actions-box="true" >
                        
                        <option value="published" selected>Published</option>
                        <option value="In Draft">In Draft</option>
                        <option value="In Review">In Review</option>
                        <option value="Unpublished">Unpublished</option>
                      </select>
                    </div>
                 </div>
                  <div class="col-md-3">
                    <button class="btn btn--toggle-filter" >Clear</button>
                    <button class="btn btn--toggle-filter" >Apply</button>
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
        <a class="recent-content__add btn primary medium" href="{{url('uploadcontent')}}"><i class="mdi mdi-plus"></i>Add New Videos</a>
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
        <div class="filter-wrapper filter-wrapper--content u-flex--fill col-md-12 no-padd">

            <div class="filter">
                <div class="standardInput form-input"><label class="form-label " for="input-0"><span class="form-label-text ">Max items</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-empty"><option value="" class="" selected="selected">24</option><option label="36" value="string:36">36</option><option label="48" value="string:48">48</option><option label="60" value="string:60">60</option></select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
            </div>

            <div class="filter">
                <div class="standardInput form-input"><label class="form-label " for="input-1"><span class="form-label-text ">Sort by</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-empty" id="input-1" name="input-1">
                    <option value="" data-i18n="label.updated">Last updated</option>
                    <option value="status" data-i18n="label.status">Status</option>
                    <option value="publishDate" data-i18n="label.publishdate">Publication date</option>
                </select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
            </div>

            <div class="filter filter--show-content-from">
                <div class="standardInput form-input"><label class="form-label " for="input-2"><span class="form-label-text ">Show content from</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-not-empty" id="input-2" name="input-2">
                <!-- ngIf: filterCtrl.params.toDate || filterCtrl.params.fromDate && !filterCtrl.showContentFromOptions[ filterCtrl.params.fromDate ] --><option label="All time" value="">All time</option><option label="The last year" value="string:1595701800000" selected="selected">The last year</option><option label="Last 2 years" value="">Last 2 years</option><option label="Last 3 years" value="">Last 3 years</option></select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
            </div>

            <div class="filter right">
                
                <ul>
                    <h3 class="layout-left">Layout</h3>
                    <li class="btn primary active"><a href="{{url('getVideoList')}}" ><i class="mdi mdi-apps"></i></a></li>
                    <li class="btn primary2" data-icon="list">
                        <a href="{{url('videosdata')}}" ><i class="mdi mdi-table"></i></a>
                     
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
      <form method="POST" action="{{ route('deleteBulkVideo') }}" name="user_form" id="deleteBulkVideo" data-parsley-validate>
              {{csrf_field()}}
              <input type="hidden" value="" name="video_id" id="video_id">
              <input type="hidden" value="tableview" name="videoview" id="videoview">
          </form>
          <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">
          <a class="view_delete" id="delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong"><i class="glyphicon glyphicon-trash" style="color: #e20101"></i>
          </a>
        <!-- <input name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">
        All&nbsp;
        <i class="glyphicon glyphicon-trash" style="color: #e20101"></i> -->
      </th>
      <th>ID  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th >Title  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th >Status  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th >Publication date  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th >Last updated  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th >Language  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th >Action</th>
    </tr>
    <tr class="warning no-result">
      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
    </tr>
  </thead>
  <tbody>
    <?php //pr($videoslist);die;?>
  @foreach($videoslist['videoslist'] as $video)
    <tr>
      
      <td scope="row">
        <input value="{{ $video['ID'] }}" name="check_video" class="checkbox check_video form-element" type="checkbox">
        <!-- <input value="1" name="product" class="checkbox form-element" type="checkbox"> -->
      </td>
      <td>{{ $video['ID'] }}</td>
      <td>{{ $video['title'] }}</td>
      <td>{{ $video['status'] }}</td>
      <td>{{ $video['publish_date'] }}</td>
      <td>{{ $video['created_date'] }}</td>
      <td>{{ $video['langauge'] }}</td>
      <td>

       
        <form method="POST" action="{{ route('deleteVideo') }}" name="user_form" id="deleteSingleUser" data-parsley-validate>
            {{csrf_field()}}
          <input type="hidden" value="{{$video['ID']}}" name="single_video_id" id="single_video_id">
          <input type="hidden" value="tableview" name="videoview" id="videoview">
        </form> 
        <a class="view1" title="" data-toggle="tooltip" href="{{url('getVideoById')}}/{{$video['ID']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
               
        <a class="view_delete" id="single_delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">     
            <i class="glyphicon glyphicon-trash" style="color: #e20101"></i>
        </a>
        <!-- <form method="POST" action="{{ route('deleteVideo') }}" name="user_form" id="deleteSingleVideo" data-parsley-validate>
                                                {{csrf_field()}}
          <input type="hidden" value="" name="single_video_id" id="single_video_id">
        </form>

        <a class="view1" title="" data-toggle="tooltip" data-original-title="delete" data-toggle="modal" data-target="#exampleModalLong"><i class="glyphicon glyphicon-trash"></i></a> -->

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
 

     <nav aria-label="...">
                            <ul class="pagination right">
                                @foreach($videoslist['link'] as $link)
                                    <li class="page-item {{($link['active'] == 1 ? 'active' : '')}}">
                                        <a class="page-link" href="{{url('/getVideoList')}}/{!! $link['label'] !!}">
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
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                </select>
                
                
            </div>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 >Click the add button to attach the content reference</h2>
                    <select class="form-control selectpicker" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">  
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
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

    </div>
  </div>
</div>  
@stop