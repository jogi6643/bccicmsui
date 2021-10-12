@extends('base')
@section('title', 'Audio List')
@section('epic_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/sorting.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropify').dropify();

            $("li.btn").click(function() {
                $("li.btn").removeClass("active");
                $(this).addClass("active");
            });

            $('.checked_all').on('change', function() {
                $('.checkbox').prop('checked', $(this).prop("checked"));
            });

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
                <li><a href="{{ url('#') }}">Content Management</a></li>
                <li class="active">Audio</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <!-- .row -->
    <div class="row">
        <section>
            <div class="content_text headbar">
                <p>Manage Audio</p>
            </div>
            @include('show_message')
            @include('content.search')
            <div class="card" data-content-list="data.articleList">
                <div class="results">
                    <div class="border-bottom">
                        <h2 class="show-data-pa">Showing {{ $data['from'] }} - {{ $data['to'] }} of
                            {{ $data['total'] }} records</h2>
                        <div class="add-new-button">
                            <a class="recent-content__add btn primary medium" href="{{ url('uploadcontent') }}"><i
                                    class="mdi mdi-plus"></i>Add new Audio</a>
                        </div>
                    </div>
                    <div class="content-control-wrapper row row--no-margin between-xs">
                        <div class="bulk-edit-control ">
                            <div class="u-flex">
                            </div>
                        </div>

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
                            @php
                                $sort_by = config('bcciconfig.CONTENT_SORTBY') ?? ['Last updated', 'Status', 'Publication date'];
                                $max_items = config('bcciconfig.CONTENT_MAX_ITEM') ?? [24, 36, 48, 60];
                                $content_from = config('bcciconfig.CONTENT_FROM') ?? ['All time', 'The last year', 'Last 2 years', 'Last 3 years'];
                            @endphp
                            <div class="filter">
                                <div class="standardInput form-input">
                                    <label class="form-label " for="input-0">
                                        <span class="form-label-text ">Max items</span>
                                    </label>
                                    <select name="max_items" id="max_items"
                                        class="form-element ng-pristine ng-untouched ng-valid ng-empty">
                                        @foreach ($max_items as $val)
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="filter">
                                <div class="standardInput form-input">
                                    <label class="form-label " for="input-1">
                                        <span class="form-label-text ">Sort by</span>
                                    </label>
                                    <select class="form-element ng-pristine ng-untouched ng-valid ng-empty" id="sort_by"
                                        name="sort_by">
                                        @foreach ($sort_by as $val)
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="filter filter--show-content-from">
                                <div class="standardInput form-input">
                                    <label class="form-label " for="input-2">
                                        <span class="form-label-text ">Show content from</span>
                                    </label>
                                    <select class="form-element ng-pristine ng-untouched ng-valid ng-not-empty"
                                        id="content_from" name="content_from">
                                        @foreach ($content_from as $val)
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="filter">
                                <ul>
                                    <h3 class="layout-left">Layout</h3>
                                    <li class="btn primary active"><a href="{{ url('getAudioList') }}"><i
                                                class="mdi mdi-apps"></i></a></li>
                                    <li class="btn primary2" data-icon="list">
                                        <a href="{{ url('audiolistdata') }}"><i class="mdi mdi-table"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                     <div class="tab-content" id="load_data">
                        @include('content.audio-table-data')
                    </div>

                    {{-- <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered results">
                            <thead>
                                <tr>
                                    <th>
                                        <form method="POST" action="{{ route('deleteBulkaudio') }}" name="user_form"
                                            id="deleteBulkVideo" data-parsley-validate>
                                            {{ csrf_field() }}
                                            <input type="hidden" value="" name="video_id" id="video_id">
                                            <input type="hidden" value="tableview" name="videoview" id="videoview">
                                        </form>
                                        <input id="check_all" name="product_all" type="checkbox"
                                            class="checked_all form-element" type="checkbox">
                                        <a class="view_delete" id="delete_icon" href="" data-original-title="Delete"
                                            type="button" data-toggle="modal" data-target="#exampleModalLong"><i
                                                class="glyphicon glyphicon-trash" style="color: #e20101"></i></a>
                                    </th>
                                    <th>ID
                                        <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> -->
                                    </th>
                                    <th>Title
                                        <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> -->
                                    </th>
                                    <th>Status
                                        <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> -->
                                    </th>
                                    <th>Publication Date
                                        <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> -->
                                    </th>
                                    <th>Last Updated
                                        <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> -->
                                    </th>
                                    <th>Language
                                        <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> -->
                                    </th>
                                    <th class="action">Action</th>
                                    <th class="action">Publish and unpublish</th>
                                </tr>
                                <tr class="warning no-result">
                                    <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['videoslist'] as $video)
                                    <tr>
                                        <td scope="row">
                                            <input value="{{ $video['ID'] }}" name="check_video"
                                                class="checkbox check_video form-element" type="checkbox">
                                            <!-- <input value="{{ isset($video['ID']) }}" name="check_audios" class="checkbox check_audios form-element" type="checkbox"> -->
                                        </td>
                                        <td>{{ $video['ID'] }}</td>
                                        <!-- <td>{{ $video['title'] ?? '' }}</td> -->
                                        <td class="title">
                                            <a class="titletab open-data" title="" data-toggle="modal"
                                                data-id="{{ $video['ID'] }}">

                                                {{ $video['title'] ?? '' }}
                                            </a>
                                        </td>
                                        <td>{{ $video['current_status'] ?? '' }}</td>
                                        <td>{{ date('Y-m-d H:i:s', strtotime($video['publish_date'])) ?? '' }}</td>
                                        <td>{{ date('Y-m-d H:i:s', strtotime($video['updated_at'])) ?? '' }}</td>
                                        <td>{{ $video['language'] ?? '' }}</td>
                                        <td>
                                            <a class="view1 open-data" title="" data-toggle="modal"
                                                data-id="{{ $video['ID'] }}" data-original-title="view">
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </a>

                                            <a class="view1" title="" data-toggle="tooltip"
                                                href="{{ url('editAudio') }}/{{ $video['ID'] }}"
                                                data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>



                                            <i class="glyphicon glyphicon-trash single_delete_icon"
                                                id="delete_single_photo_{{ $video['ID'] }}" style="color: #e20101"></i>

                                            <!-- <a class="publish" title=""  data-toggle="tooltip" data-original-title="publish">&nbsp;
                                                <i class="mdi mdi-checkbox-multiple-marked" data-icon="v"></i>
                                            </a> -->
                                            <!-- <a class="publish" title=""  data-toggle="tooltip" data-original-title="publish">&nbsp;
                                                <input type="checkbox" {{ $video['current_status'] == 'published' ? 'checked' : '' }} hidden="hidden" id="{{ $video['ID'] }}" class="publish_unpublish">
                                                <label class="publish_unpublish" for="{{ $video['ID'] }}"> </label>
                                            </a>  -->
                                            <form method="POST" action="{{ route('deleteAudio') }}" name="user_form"
                                                id="deleteSinglevideo_{{ $video['ID'] }}" data-parsley-validate>
                                                {{ csrf_field() }}
                                                <input type="hidden" value="{{ $video['ID'] }}" name="single_video_id"
                                                    id="single_video_id">
                                                <input type="hidden" value="tableview" name="videoview" id="videoview">
                                            </form>
                                        </td>
                                        <td>
                                            <a class="publish" title="" data-toggle="tooltip"
                                                data-original-title="publish">
                                                <span class="label">No</span>
                                                <input type="checkbox" hidden="hidden" id="publish"
                                                    class="publish_unpublish">
                                                <label class="publish_unpublish" for="publish"> </label>
                                                <span class="label">Yes</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}

                    {{-- <nav aria-label="...">
                        <ul class="pagination right">
                            @foreach ($data['link'] as $link)
                                <li class="page-item {{ $link['active'] == 1 ? 'active' : '' }}">
                                    <a class="page-link" href="{{ url('/getAudioList') }}/{!! $link['label'] !!}">
                                        {!! $link['label'] !!}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </nav> --}}
                     <div class="tab-content" id="load_data">
                        @include('content.audio-pagination')
                    </div>
                </div>
            </div>
        </section>
    </div>


    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 60%; margin: 0 auto;">
                <!-- <form method="post" action="{{ url('/deleteUser') }}"> -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <input type="hidden" name="single_video_id_form" id="single_video_id_form" class="user_id"
                        value="">
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

    <div class="modal fade" id="Viewpage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 100%; margin: 0 auto;">
                <div class="modal-header">
                    <h2 class="Preview-title">Audio View</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body wizard-content">
                    
                    <form data-parsley-validate action="{{ route('addArticle') }}" name="article_form" id="article_form"
                        method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                       <!--  <button type="button" id="collapsesidebar-btn" class="collapse-btn">
                            <span><i class="mdi mdi-chevron-right fa-fw" data-icon="v"></i> Collapse sidebar</span>
                        </button> -->
                        <h6>Basic Info</h6>
                        <section>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <!-- <label for="wfirstName2"> Headline*:</label>
                                        <input type="text" id="title" class="form-control" value="" name="title"
                                            readonly> -->
                                        <a class="recent-content__add btn primary medium rightbtn" href="#">Edit Detail</a> 
                                        <h2 id="title" class="head-title"></h2>
                                          
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
                                        <label for="wlastName2">Summary</label>
                                        <!-- <textarea class="form-control" id="summary" name="summary" rows="9" readonly></textarea> -->
                                    </div>
                                </div>

                                <div class="col-md-6">    
                                    <div class="form-group">
                                        <label for="wlastName2">Audio Content</label>
                                        <!-- <textarea class="form-control" id="summary" name="summary" rows="9" readonly></textarea> -->
                                    </div>
                                </div>

                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="pdlt" for="wfirstName2">
                                            Publish Date: 
                                            <span class="date" id="publishTo"></span>
                                            Author:
                                            <span class="date" id="author"></span>
                                            Location: 
                                            <span class="date"  id="location"></span>
                                        </label>
                                        <div class="date" id="publishTo"></div>  
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wlastName2" class="pdlt">Article Content</label>
                                        <div id="content" class="content"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">    
                                    <div class="form-group">
                                        <img src="" id="image_url" name="image_url" alt="Trulli" class="art-img">
                                    </div>
                                </div> -->


                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wfirstName2"> Headline*:</label>
                                        <input type="text" id="title" class="form-control" value="" name="title"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wfirstName2"> Short Description*:</label>
                                        <input type="text" id="short_description" class="form-control" value=""
                                            name="short_description" readonly>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">    
                            <div class="form-group">
                                
                                <label for="wfirstName2">Article Language:</label>
                                <input type="text" class="form-control" value="" name="subtitle" disabled>
                            </div>
                        </div> --}}
                                {{-- <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Article Owner:</label>
                                <input type="text" class="form-control" value="" name="article_owner" readonly>
                            </div>
                        </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wfirstName2">Photo:</label>
                                        <input type="file" class="form-control" value="" name="photo" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wfirstName2">Audio Duration:</label>
                                        <input type="text" id="audio_duration" class="form-control" value=""
                                            name="video_duration" readonly>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">      
                            <div class="form-group">
                                <label for="wfirstName2">Match Id:</label>
                                <input type="text" class="form-control" value="" name="match_id" readonly>
                            </div>
                        </div> --}}
                                {{-- <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Content Type:</label>
                                <input type="text" class="form-control" value="" name="content_type" readonly>
                            </div>
                        </div> --}}
                                {{-- <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Author:</label>
                                <input type="text" class="form-control" value="" name="author" readonly>
                            </div>
                        </div> --}}
                                {{-- <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Keywords:</label>
                                <input type="text" class="form-control" value="" name="keywords" readonly>
                            </div>
                        </div> --}}
                                {{-- <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Additional Info:</label>
                                <input type="text" class="form-control" value="" name="additionalInfo" readonly>
                            </div>
                        </div> --}}
                                {{-- <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Match Formats:</label>
                                <input type="text" class="form-control" value="" name="match_formats" readonly>
                            </div>
                        </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wfirstName2">Published By:</label>
                                        <input type="text" id="publish_by" class="form-control" value=""
                                            name="published_by" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wfirstName2">Publish Date:</label>
                                        <input type="text" id="publish_date" class="form-control datepicker" value=""
                                            name="publish_date" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wfirstName2">Language:</label>
                                        <input type="text" id="leng" class="form-control" value="" name="language"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wfirstName2">Location:</label>
                                        <input type="text" id="location" class="form-control" value="" name="location"
                                            readonly>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">References:</label>
                                <input type="text" class="form-control" value="" name="references" readonly>
                            </div>
                        </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wfirstName2">Expiry Date:</label>
                                        <input type="text" id="expiry_date" class="form-control datepicker" value=""
                                            name="expiryDate" readonly>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">total_viewcount:</label>
                                <input type="text" class="form-control" value="" name="total_viewcount" readonly>
                            </div>
                        </div> --}}
                                {{-- <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Total Viewcount:</label>
                                <input type="text" class="form-control" value="" name="total_viewcount" readonly>
                            </div>
                        </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wfirstName2">Slug:</label>
                                        <input type="text" id="urlsegnment" class="form-control" value="" name="slug"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wfirstName2">Platform:</label>
                                        <input type="text" id="platform" class="form-control" value="" name="platform"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wfirstName2">Current Status:</label>
                                        <input type="text" id="status" class="form-control" value="" name="platform"
                                            readonly>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="wlastName2">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="9" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label for="wlastName2">Summary</label>
                                <textarea class="form-control" id="summary" name="summary" rows="9" readonly></textarea>
                            </div>
                        </div> --}}
                                <div class="col-md-12 bodycontent">
                                    <div class="form-group">
                                        <label for="wlastName2">Body content</label>
                                        <textarea name="content" row="20" id="content" readonly></textarea>
                                    </div>
                                </div> -->

                            </div>
                        </section>
                        <h6>Meta Information</h6>
                        <section>
                            <div class="row">
                                {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="wfirstName2"> Author</label>
                                <input type="text" class="form-control" value="" readonly>
                            </div>
                        </div> --}}
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
                                        <input type="text" class="form-control datepicker" placeholder="23/08/2021"
                                            value="" readonly>
                                        <input type="text" class="form-control  timepicker" value=""
                                            placeholder="time 10:30" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="behName1">Metadata* :</label>
                                        <input type="text" class="form-control" value="" readonly>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <h6>Segmentation</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <div class="form-group checkbox-al">
                                        <input type="checkbox" id="restrict" name="restrict" value="Bike" disabled>
                                        <label for="restrict"> Restrict content to logged in users</label><br>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- <div id="collapsingsidebar" class="collapssidebar">
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
                                                                    <div class="selected-references-new__item-title">4th
                                                                        Test </div>
                                                                    <span
                                                                        class="selected-references-new__item-action-link-label">CRICKET_MATCH:
                                                                        22439</span>
                                                                </div>
                                                            </li>
                                                            <li class="selected-references-new__item">
                                                                <div class="selected-references-new__item-title-block">
                                                                    <div class="selected-references-new__item-title">4th
                                                                        Test </div>
                                                                    <span
                                                                        class="selected-references-new__item-action-link-label">CRICKET_MATCH:
                                                                        22439</span>
                                                                </div>
                                                            </li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tagsinput">
                                            <h2>Tags</h2>
                                            <input type="text" id="inputTag" value="Test , Test , Test , Test Test , Test "
                                                data-role="tagsinput" disabled>

                                        </div>
                                        <div class="content-ref">
                                            <h2>Related content</h2>
                                            <div class="reference-search">
                                                <div class="reference-search__select-container">
                                                    <ol class="selected-references-new">
                                                        <li class="selected-references-new__item">
                                                            <div class="selected-references-new__item-title-block">
                                                                <div class="selected-references-new__item-title">4th Test
                                                                </div>
                                                                <span
                                                                    class="selected-references-new__item-action-link-label">CRICKET_MATCH:
                                                                    22439</span>
                                                            </div>
                                                        </li>
                                                        <li class="selected-references-new__item">
                                                            <div class="selected-references-new__item-title-block">
                                                                <div class="selected-references-new__item-title">4th Test
                                                                </div>
                                                                <span
                                                                    class="selected-references-new__item-action-link-label">CRICKET_MATCH:
                                                                    22439</span>
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
    <script src="{{ asset('js/audio/audio.js') }}" type="text/javascript"></script>
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


            $('.open-data').click(function() {
                var id = $(this).data('id');

                if (id != undefined && id != null) {
                    $.ajax({
                        type: 'GET',
                        url: '/audio/fetchaudio',
                        data: {
                            "id": id,
                        },
                        success: function(res) {


                            if (res.data) {
                                console.log(res.data);
                                $('#title').html(res.data.title);
                                if (res.data.language == 'en' || res.data.language ==
                                    'English' || res.data.language == 'english') {
                                    $('#leng').val('English');
                                } else if (res.data.language == 'hi' || res.data.language ==
                                    'Hindi' || res.data.language == 'hindi') {
                                    $('#leng').val('Hindi');
                                } else {

                                    $('#leng').val('N/A');
                                }
                                $('#author').html(res.data.author);
                                $('#short_description').val(res.data.short_description);
                                $('#audio_duration').val(res.data.audio_duration);
                                $('#publish_by').val(res.data.published_by);
                                $('#publish_date').val(res.data.publish_date);
                                $('#location').val(res.data.location);
                                $('#refer').val(res.data.references);
                                $('#expiry_date').val(res.data.expiryDate);
                                $("#urlsegnment").val(res.data.title.replace(/\s+/g, '-')
                                    .toLowerCase());
                                $("#platform").val(res.data.platform);
                                if (res.data.current_status == 'draft' || res.data
                                    .current_status == 'Draft') {
                                    $("#status").val('In Draft');
                                } else if (res.data.current_status == 'unpublish' || res.data
                                    .current_status == 'unpublished') {
                                    $("#status").val('Un published');
                                } else if (res.data.current_status == 'publish' || res.data
                                    .current_status == 'published') {
                                    $("#status").val('Published');
                                } else {
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
