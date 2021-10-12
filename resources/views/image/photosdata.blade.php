@extends('base')
@section('title', 'Photo List')
@section('epic_content')
<style type="text/css">
    .delete_icons{
        display: inline-block;
    }
</style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/sorting.js" type="text/javascript"></script>

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
                <li class="active">Photos</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    
    <div class="row">
        <section>
            <div class="content_text"><p>Manage Photos</p></div>
            <div class="top-search">
                <div class="row content-search-header">
                    <section class="col-md-5 col-sm-12">
                        <div class="example">
                            {{csrf_field()}}
                            <input type="text" placeholder="Enter search term..." name="search" class="search_field" id="search_field">
                            <button type="button" id="search_btn" name="search_btn"><i class="fa fa-search"></i></button>
                        </div>
                    </section>
                    <section class="col-md-7 col-sm-12">
                        {{csrf_field()}}
                        <div class="form-inline">
                            <div class="col-md-7">
                                <div class="custom-select fiftyper">
                                    <label>Filter by language</label>
                                    <select id="search_language" name="search_language"  class="selectpicker applybtn" multiple data-actions-box="true" >
                                        <option value="english" selected>English</option>
                                        <option value="marathi">Marathi</option>
                                        <option value="hindi">Hindi</option>
                                        <option value="4">Tamil</option>
                                    </select>
                                </div>
                                <div class="custom-select fiftyper" style="">
                                    <label>Filter by status</label>
                                    <select id="current_status" name="current_status"  class="selectpicker applybtn" multiple data-actions-box="true" >
                                        <option value="published" selected>Published</option>
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
        </section>
    </div>
    
    <div class="row">
        <section>
            <div class="card" data-content-list="data.articleList"><div class="results">
                <div class="border-bottom">
                    <h2 class="show-data-pa">Showing  records</h2>
                    <div class="add-new-button">
                        <a class="recent-content__add btn primary medium" href="{{route('uploadcontent')}}"><i class="mdi mdi-plus"></i>Add new Photos</a>
                    </div>
                </div>   
                    <div class="content-control-wrapper row row--no-margin between-xs">
                        <div class="bulk-edit-control ">
                            <div class="u-flex"> 
                            </div>
                            <!-- ngIf: bulkEditCtrl.items.length -->
                        </div><!-- end ngIf: bulkEditCtrl && list.items.length -->
                        <form method="POST" action="{{ route('deleteBulkPhoto') }}" name="photo_bulk_form" id="deleteBulkPhoto" data-parsley-validate>
                            {{csrf_field()}}
                            <input type="hidden" value="" name="photo_id" id="photo_id">
                            <input type="hidden" value="gridview" name="videoview" id="videoview">
                        </form>
                        <!-- <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element" type="checkbox"> -->

                        <div class="col-md-4">
                            <div class="select-all-div">
                                <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">&nbsp; Select All
                            </div>
                            <div class="delete-div">
                                <a class="view_delete" id="delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">     
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
                                <li class="btn primary"><a href="{{url('photos')}}" ><i class="mdi mdi-apps"></i></a></li>
                                <li class="btn primary2 active" data-icon="list">
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
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block alertMessage">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block alertMessage">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <ol class="content-grid row">
    <!-- ngRepeat: item in list.items -->
    <?php //pr($videoslist);die; ?>
    <ol class="content-grid row">
    <!-- ngRepeat: item in list.items -->
    <?php //pr($photolist);die; ?>
    <div id="load_datatwo"><div>
    @if(count($photolist['userlisting']) > 0)
        @foreach($photolist['userlisting'] as $photo)
            <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                <label class="content-grid__select">
                    <div class="standardInput no-label form-checkbox">
                        <!-- <input value="{{ $photo['ID'] }}" name="product" class="checkbox form-element allselect checkbox" type="checkbox" id="input-pl-4"> -->
                        <input value="{{$photo['ID']}}" name="check_photo" class="checkbox check_photo form-element" type="checkbox">
                    </div>
                </label>
                <figure title="News Article">
                    <a class="image" data-cms-href="content.article.edit" data-params="item" href="{{ $photo['image_url'] ?? '' }}">
                    <img src="{{ $photo['image_url'] ?? '' }}" alt="{{ $photo['title'] }}" width="460" height="345">
                        <!-- new ContentSummaryAPIActive usage start -->
                        <!-- ngIf: !ContentSummaryAPIActive && item.thumbnail -->
                        <!-- ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                        <!-- <img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="{{ $photo['image_url'] ?? '' }}" alt="" src="{{ $photo['thumbnail_image'] ?? '' }}" class="" style=""> -->
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
                        <a data-cms-href="content.article.edit" data-params="item" href="{{ $photo['thumbnail_image'] ?? '' }}">{{ $photo['title'] }}</a>
                        <!-- ngIf: item.internalName -->
                        </dd>
                        <dt class="id" data-i18n="label.id">ID</dt>
                        <dd class="id" data-ng-bind="item.id">{{ $photo['ID'] }}</dd>
                        <!-- <dt class="type" data-i18n="label.type">Type</dt> -->
                        <!-- <dd class="type" data-i18n="content.type.TEXT">News Article</dd> -->
                        <dt class="date" data-i18n="label.updated">publish date</dt>
                        <dd class="date" data-ng-if="ContentSummaryAPIActive" data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'" style="">{{ $photo['publish_date'] ?? '' }}</dd>
                        <dt class="date" data-i18n="label.updated">created date</dt>
                        <dd class="date" data-ng-if="ContentSummaryAPIActive" data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'" style="">{{ $photo['created_date'] ?? '' }}</dd>
                        <!-- end ngIf: ContentSummaryAPIActive -->
                        <!-- ngIf: !ContentSummaryAPIActive -->
                        <!-- new ContentSummaryAPIActive usage end -->
                        <dt class="language" data-i18n="label.language">Language</dt>
                        <dd class="language" data-language-label="item.language">{{ $photo['language'] ?? '' }}</dd>
                        <dt class="language" data-i18n="label.language">Match Formats</dt>
                        <dd class="language" data-language-label="item.language">{{ $photo['match_formats'] ?? '' }}</dd>
                        <dt class="language" data-i18n="label.language">Current Status</dt>
                        <dd class="language" data-language-label="item.language">{{ $photo['currentstatus'] ?? '' }}</dd>
                        <dt class="language" data-i18n="label.language">Status</dt>
                        <dd class="language" data-language-label="item.language">{{($photo['status'] == 'true' || $photo['currentstatus'] == '1') ? 'Active' : 'Inactive'}}</dd>
                        <!-- ngRepeat: filter in filterCtrl.activeFilters -->
                    </dl>
                    <ul class="button_edit">
                        <li>
                        <a class="view" title="" data-toggle="tooltip" href="navigation" data-original-title="Edit"><i class="glyphicon glyphicon-eye-open"></i></a>
                        </li>
                        <li>
                        <a class="view" title="" data-toggle="tooltip" href="{{url('editPhoto')}}/{{$photo['ID']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                        </li>
                        <li>
                        <!-- <a class="view1" title="" data-toggle="tooltip" href="{{url('editPhoto')}}/{{$photo['ID']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> -->
                        <form method="POST" action="{{ route('deleteImage') }}" name="photo_bulk_form" id="deleteSinglePhoto_{{$photo['ID']}}" class="test delete_icons" data-parsley-validate>
                            {{csrf_field()}}
                            <input type="hidden" value="{{$photo['ID']}}" name="single_photo_id" id="single_photo_id">
                            <input type="hidden" value="gridview" name="videoview" id="videoview">
                        </form>
                        <i class="glyphicon glyphicon-trash single_delete_icon" id="delete_single_photo_{{$photo['ID']}}" style="color: #e20101" ></i>
                            <!-- <a class="view" title="" data-toggle="tooltip" href="{{ route('deleteVget') }}/{{ $photo['ID'] }}" data-original-title="Edit" onClick="return confirm('Delete This account?')"><i class="glyphicon glyphicon-trash"></i></a> -->
                        </li>
                    </ul>
                </div>
            </li>
            @endforeach
            @else
            <ul class="button_edit">
                        <li>
                            <span> No Data Available</span>
                        </li>
                    </ul>
                <!-- <tr>
                    <td colspan="7" class="" style="text-align: center;">No Data Available</td>
                </tr> -->
            @endif


            
    
    
</ol>
    
    
</ol>
                </div>
            </div>
        </div>
    </section>

    <nav aria-label="...">
        <ul class="pagination right">
            @foreach($photolist['link'] as $link)
                <li class="page-item {{($link['active'] == 1 ? 'active' : '')}}">
                    <a class="page-link" href="{{url('/photodata')}}/{!! $link['label'] !!}">
                        {!! $link['label'] !!}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>
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
        </div>
        </div>
        <h2>Tags</h2>
        <input type="text" id="inputTag" value="" data-role="tagsinput">
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
                    <input type="hidden" name="photo_id" id="photo_id" class="photo_id" value="">
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
                $.each($("input[name='check_photo']:checked"), function(){
                    f_ids.push($(this).val());
                });
                var all_id = f_ids.join(",")
                $("#photo_id").val(all_id);
            });

            $(".single_delete_icon").click(function(){
                var id = $(this).attr('id');
                id = id.replace('delete_single_photo_','');
                $('#photo_id').val(id);
                $('#exampleModalLong').modal('show');
            });
            
            $("#yes_button").click(function(){
                var id = $("#photo_id").val();
                
                if($('.checkbox:checked').length > 0){
                    $( "#deleteBulkPhoto" ).submit();
                }
                else{
                    $("#deleteSinglePhoto_"+id).submit();
                }
            });

            $("#search_btn").click(function(){
                // alert("asdfasdf");
                var searchValue = $("#search_field").val();
                // alert(searchValue);
                if(searchValue != ""){
                    $.ajax({
                        url: APP_URL+'/photogridSearch',
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'serarch_value' : searchValue
                        },
                        // dataType: "text",
                        success: function(data){
                            $('#load_datatwo').html(data.html);   
                            console.log(data);
                        }
                    });
                }
            });
        });
    </script>
@stop