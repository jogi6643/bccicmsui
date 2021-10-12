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
            <div class="content_text headbar"><p>Manage Photos</p></div>
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
                                <div class="custom-select fiftyper" style="">
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
                            <input type="hidden" value="tableview" name="videoview" id="videoview">
                        </form>
                        <!-- <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element" type="checkbox"> -->

                        <div class="col-md-3 no-padd">
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
                    <div class="tab-content">
                        <div class="table-responsive tab-pane fade in active" id="list_view">
                            <table  class="table table-striped table-hover table-bordered results list_view" >
                                <thead>
                                    <tr>
                                        <th class="col-md-1 col-xs-1">
                                            
                                            
                                        </th>
                                        <!-- <th >
                                            <input name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">
                                            All&nbsp;
                                            <i class="glyphicon glyphicon-trash" style="color: #e20101"></i>
                                        </th> -->
                                        <th>ID</th>
                                        <th >Title</th>
                                        <th >Status</th>
                                        <!-- <th >Publication date  <i class="glyphicon glyphicon glyphicon-sort" ></i></th> -->
                                        <!-- <th >Last updated  <i class="glyphicon glyphicon glyphicon-sort" ></i></th> -->
                                        <th>Language</th>
                                        <th class="action">Action</th>
                                        <th class="action">Publish and unpublish</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="load_datatwo">
                                    @if(count($photolist['userlisting']) > 0)
                                        @foreach($photolist['userlisting'] as $photo)
                                            <tr>
                                                <td scope="row">
                                                    <input value="{{$photo['ID']}}" name="check_photo" class="checkbox check_photo form-element" type="checkbox">
                                                </td>
                                                <td>{{$photo['ID']}}</td>
                                                <td> 
                                                <a class="titletab open-data"  data-toggle="modal" data-id="{{ $photo['ID'] }}"
                                                > {{$photo['title'] ?? ''}}
                                                </a>    
                                                </td>
                                                <!-- <td>{{-- $photo['currentstatus'] ?? '' --}}</td> -->
                                                <?php $currentstatus = strtolower($photo['currentstatus']); ?>
                                                <td>
                                                @if ($currentstatus == 'draft' || $currentstatus == 'Draft')
                                                    In Draft
                                                @elseif($currentstatus =='unpublish'|| $currentstatus =='unpublished')
                                                    Un published
                                                @elseif($currentstatus =='publish'|| $currentstatus=='published')
                                                    Published
                                                @else
                                                    In Draft
                                                @endif
                                                </td>
                                                {{-- ($photo['status'] == 'true' || $photo['status'] == '1') ? 'Active' : 'Inactive' --}}
                                                    <!-- {{ $photo['currentstatus'] ?? '' }} -->
                                                </td>
                                                <!-- <td>{{-- $photo['publish_date'] ?? '' --}}</td> -->
                                                <!-- <td>{{-- $photo['publish_date'] --}}</td> -->
                                                <td>{{$photo['language'] ?? ''}}</td>
                                                <td class="action">
                                                    <!-- <a class="view1" title="" data-toggle="tooltip" href="{{url('photos')}}/{{$photo['ID']}}" data-original-title="view"><i class="glyphicon glyphicon-eye-open"></i></a> -->
                                                    <!-- <a class="view1" title="" data-toggle="modal" data-target="#Viewpage" data-original-title="view">
                                                        <i class="glyphicon glyphicon-eye-open"></i>
                                                    </a> -->
                                                    <a class="view1 open-data tdaction" title="" data-toggle="modal" data-id="{{ $photo['ID'] }}"
                                                        data-original-title="view">
                                                       <span class="ti-eye"></span>
                                                    </a>

                                                    <a class="view1 tdaction" title="" data-toggle="tooltip" href="{{url('editPhoto')}}/{{$photo['ID']}}" data-original-title="Edit">
                                                        <span class="ti-pencil-alt"></span>
                                                    </a>
                                                    <form method="POST" action="{{ route('deleteImage') }}" name="photo_bulk_form" id="deleteSinglePhoto_{{$photo['ID']}}" class="test delete_icons" data-parsley-validate>
                                                        {{csrf_field()}}
                                                        <input type="hidden" value="{{$photo['ID']}}" name="single_photo_id" id="single_photo_id">
                                                        <input type="hidden" value="tableview" name="videoview" id="videoview">
                                                    </form>
                                                    <a href="" class="tdaction">
                                                    <!--<i class="glyphicon glyphicon-trash single_delete_icon" id="delete_single_photo_{{$photo['ID']}}" style="color: #e20101" ></i>-->
                                                    <span class="ti-trash"></span>
                                                    </a>                                            
                                                </td>
                                                <td>
                                                    <a class="publish" title=""  data-toggle="tooltip" data-original-title="publish">&nbsp;
                                                        <span class="label">No</span>
                                                        <input type="checkbox" hidden="hidden" id="{{$photo['ID']}}" class="publish_unpublish">
                                                        <label class="publish_unpublish" for="{{$photo['ID']}}"> </label>
                                                        <span class="label">Yes</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="" style="text-align: center;">No Data Available</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <!-- <tbody id="load_data1"></tbody> -->
                            </table>
                            <nav aria-label="..." class="paginations">
                                <ul class="pagination right">
                                    @foreach($photolist['link'] as $link)
                                        <li class="page-item {{($link['active'] == 1 ? 'active' : '')}}">
                                            <a class="page-link" href="{{url('/photos')}}/{!! $link['label'] !!}">
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
                            </div>
                        <div class="tab-pane fade" id="table_view">
                            <ol class="content-grid row">
                                @if(count($photolist['userlisting']) > 0)
                                    @foreach($photolist['userlisting'] as $photo)
                                        <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="border-side">
                                                <label class="content-grid__select">
                                                    <div class="standardInput no-label form-checkbox">
                                                        <input value="{{$photo['ID']}}" name="check_photo" class="checkbox form-element check_photo" type="checkbox" id="input-pl-4 check_photo">
                                                    </div>
                                                </label>
                                                <figure title="News Article">
                                                    <a class="image" data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">
                                                        <img src="{{-- $photo['image_url'] --}}" class="img-responsive">
                                                        <span class="icon" data-icon="text"></span>
                                                    </a>
                                                </figure>
                                                <div class="info">
                                                    <span class="status published" title="Published"></span>
                                                    <dl class="metadata">
                                                        <dd class="title">
                                                            <a data-cms-href="content.article.edit" data-params="item" href="">{{$photo['title']}}</a>
                                                        </dd>
                                                        <dt class="id" data-i18n="label.id">ID</dt>
                                                        <dd class="id" data-ng-bind="item.id">{{$photo['ID']}}</dd>
                                                        <dt class="type" data-i18n="label.type">Status</dt>
                                                        <dd class="type" data-i18n="content.type.TEXT">{{($photo['currentstatus'] == 1) ? 'Published' : 'Unpublished'}}</dd>
                                                        <dt class="date" data-i18n="label.updated">Publish Date</dt>
                                                        <dd class="date" data-ng-if="ContentSummaryAPIActive" data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'" style="">{{-- $photo['publish_date']--}}</dd><!-- end ngIf: ContentSummaryAPIActive -->
                                                        <!-- ngIf: !ContentSummaryAPIActive -->
                                                        <!-- new ContentSummaryAPIActive usage end -->
                                                        <dt class="language" data-i18n="label.language">Language</dt>
                                                        <dd class="language" data-language-label="item.language">{{$photo['language']}}</dd>
                                                        <!-- ngRepeat: filter in filterCtrl.activeFilters -->
                                                    </dl>
                                                    <ul class="button_edit">
                                                        <li>
                                                            <a class="edit view" title="" data-toggle="tooltip" href="{{url('editPhoto')}}/{{$photo['ID']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                                        </li>
                                                        <li>
                                                            <form method="POST" action="{{ route('deleteImage') }}" name="photo_bulk_form" id="deleteSinglePhoto_{{$photo['ID']}}" class="test" data-parsley-validate>
                                                                {{csrf_field()}}
                                                                <input type="hidden" value="{{$photo['ID']}}" name="single_photo_id" id="single_photo_id">
                                                            </form>
                                                            <a class="delete view"><i class="glyphicon glyphicon-trash single_delete_icon" id="delete_single_photo_{{$photo['ID']}}" style="cursor: pointer;"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <p style="text-align: center;">
                                            No Data Available
                                        </p>
                                    </div>
                                @endif  
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                                <option value="english">English</option>
                                <option value="marathi">Marathi</option>
                                <option value="hindi">Hindi</option>
                                <option value="4">Tamil</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Filter by status</label>
                            <select name="language"  class="selectpicker" multiple data-actions-box="true" >
                                <option value="published">Published</option>
                                <option value="indraft">In Draft</option>
                                <option value="inreview">In Review</option>
                                <option value="unpublished">Unpublished</option>
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
                <h2 class="Preview-title">Preview Photo</h2>
                <a class="recent-content__add btn primary medium rightbtn" href="#">Edit Detail</a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body wizard-content">
            <form data-parsley-validate action="{{ route('addArticle') }}" name="article_form" id="article_form" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                <!--<button type="button" id="collapsesidebar-btn" class="collapse-btn">
                    <span> Collapse sidebar</span>
                </button>-->
                <h6>Basic Info</h6>
                <section>
                    <!--<h3>Basic Info</h3>-->
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
                                            <span class="date"  id="location"> Mumbai</span>
                                        </label>
                               <!-- <input type="text" class="form-control" value="" id="url_segment" name="url_segment" readonly>-->
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group text-center">
                                <label for="wfirstName2" class="pdlt"> Photo</label>
                                <img src="pic_trulli.jpg" id="photo_show" class="photo-show" name="photo_show" alt="Trulli" >
                                <!-- <input type="text" class="form-control" value="" id="url_segment" name="url_segment" readonly> -->
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group text-center description">
                                <label for="wfirstName2" class="pdlt description"> Description</label>
                                <p class="description"> asfsadfsdf</p>
                                <!-- <input type="text" class="form-control" value="" id="url_segment" name="url_segment" readonly> -->
                            </div>
                        </div>
                        <!-- <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Subtitle:</label>
                                <label for="wfirstName2">Article Language:</label>
                                <input type="text" class="form-control" value="" name="subtitle" disabled>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Article Owner:</label>
                                <input type="text" class="form-control" value="" name="article_owner" readonly>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-6">                             
                            <div class="form-group">
                                <label for="wfirstName2">Photo:</label>
                                <input type="file" class="form-control" value="" name="photo" readonly>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Video Duration:</label>
                                <input type="text" class="form-control" value="" name="video_duration" readonly>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-6">      
                            <div class="form-group">
                                <label for="wfirstName2">Match Id:</label>
                                <input type="text" class="form-control" value="" name="match_id" readonly>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-6">    
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
                   {{--<h3>Meta Information</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="wfirstName2"> Subtitle</label>
                                <input type="text" id="subtitle" name="subtitle" class="form-control" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wemailAddress2">Description</label>
                                <input type="text" id="description" name="description" class="form-control" value="" readonly >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group date-time">
                                <label for="behName1">Display date</label>
                                <input type="text" id="displaydate" name="displaydate" class="form-control datepicker" placeholder="23/08/2021" value="" readonly >
                                <input type="text" id="displaytime" name="displaytime" class="form-control  timepicker" value="" placeholder="time 10:30" readonly >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wemailAddress2"> Location label:</label>
                                <input type="text" id="location_label" name="location_label" class="form-control" value="" readonly >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wemailAddress2"> Latitude:</label>
                                <input type="text" id="latitude" name="latitude" class="form-control" value="" readonly >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wemailAddress2"> Longitude:</label>
                                <input type="text" id="longitude" name="longitude" class="form-control" value="" readonly >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Metadata</label>
                                <input type="text" id="metadata" name="metadata" class="form-control" value="" readonly >
                            </div>
                        </div>
                    </div>
                    <h3>Segmentation</h3>
                    <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Platform</label>
                                <input type="text" id="platform" name="platform" class="form-control" value="" readonly >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Copyright</label>
                                <input type="text" id="copyright" name="copyright" class="form-control" value="" readonly >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Language</label>
                                <input type="text" id="language" name="language" class="form-control" value="" readonly >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Status</label>
                                <input type="text" id="status" name="status" class="form-control" value="" readonly >
                            </div>
                        </div>
                        <!-- <div class="col-md-6" style="margin-bottom: 10px;">
                            <div class="form-group checkbox-al">
                                <input type="checkbox" id="restrict" name="restrict" value="Bike" disabled>
                                <label for="restrict"> Restrict content to logged in users</label><br>
                            </div>
                        </div> -->
                    </div>--}}
                </section>
                {{--<div id="collapsingsidebar" class="collapssidebar">
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="content-ref">
                                        <h2>Content references</h2>
                                        <div class="reference-search" >
                                        <div class="reference-search__select-container">
                                            <!-- <input type="text" id="references" name="references" class="form-control" value="" readonly > -->
                                            <div id="references" class="selectedvalue"><div>

                                            <!-- <div id="references"><div> -->                                                
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
                                            </ol>    -->
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
                                            <div id="related_content" class="selectedvalue"><div>
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
                                            </ol>    -->
                                        </div>  
                                        </div>                  
                                </div>
                            </div>
                        </div>
                    </section>
                </div>--}}
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
                var searchValue = $(".search_field").val();
                if(searchValue != ""){
                    $.ajax({
                        url: APP_URL+'/photoSearch',
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'serarch_value' : searchValue
                        },
                        // dataType: "text",
                        success: function(data){
                            console.log(data);
                            // $('#load_dataone').hide();
                            $('#load_datatwo').html(data.html);                            
                        }
                    });
                }
            });
        });

        $('.open-data').click(function() {
            // alert("asdfasdf");
            var id = $(this).data('id');
            // alert(id);
            // return false;
            if (id != undefined && id != null) {
                $.ajax({
                    type: 'GET',
                    url: '/photo/fetchphoto',
                    data: {
                        "id": id,
                    },
                    success: function(res) {
                        // console.log("res",res);
                        // return false;                
                        if (res.data) {
                            console.log(res.data);
                            $('#title').html(res.data.title);
                            $('#url_segment').val(res.data.url_segment);
                            // $('#photo_show').val(res.data.image_url);
                            $("#photo_show").attr("src", res.data.image_url);
                            $('#subtitle').val(res.data.subtitle);
                            $('#description').val(res.data.description);
                            $('#metadata').val(res.data.metadata);
                            $('#language').val(res.data.language);
                            
                            if (res.data.language == 'en' || res.data.language ==
                                'English' || res.data.language == 'english') {
                                $('#leng').val('English');
                            } else if (res.data.language == 'hi' || res.data.language ==
                                'Hindi' || res.data.language == 'hindi') {
                                $('#leng').val('Hindi');
                            } else {

                                $('#leng').val('N/A');
                            }
                             $('#copyright').val(res.data.copyright);
                            //  console.log("references",res.data.references);
                             var obj = jQuery.parseJSON(res.data.references);
                            //  console.log("references1",obj);
                             $.each(obj, function (index, value) {
                                var option = '<div class="selectedcol ">'+value.id+' <span>'+value.title+'</span><span>'+value.type+'</span></div>';
                                $('#references').append(option);
                            });

                            var relatedobj = jQuery.parseJSON(res.data.related);
                             console.log("references1",relatedobj);
                             $.each(relatedobj, function (index, value) {
                                var option = '<div class="selectedcol ">'+value.id+' <span>'+value.title+' </span><span>'+value.type+'</span></div>';
                                $('#related_content').append(option);
                            });
                            //  $('#references').val(res.data.references); 
                            //  return false;
                            // $('#references').html(text);
                            // $('#references').html(obj);
                            //  $('#publish_by').val(res.data.published_by); 
                            //  $('#publish_date').val(res.data.publish_date); 
                            //  $('#location').val(res.data.location); 
                            //  $('#refer').val(res.data.references); 
                            //  $('#expiry_date').val(res.data.expiryDate); 
                            //  $("#urlsegnment").val(res.data.title.replace(/\s+/g, '-').toLowerCase());
                            //  $("#platform").val(res.data.platform);
                            if (res.data.current_status == 'draft' || res.data.current_status == 'Draft')
                            {
                                $("#status").val('In Draft');
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
        // aplay search
        $("#clear_search").click(function () {
            // $("#search_term").val('');
            // $("#current_status").val('');
            // $("#search_language").val('');
            location.reload();
            // $(".filter-option-inner-inner").html('Nothing selected');
            //load_data();
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
                url: APP_URL+'/photoSearchlist',
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