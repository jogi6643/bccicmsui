<div class="table-responsive tab-pane fade in active" id="list_view">
    <table class="table table-striped table-hover table-bordered results">
        <thead>
            <tr>
                <th>

                    {{-- <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element">
                <a class="view_delete" id="delete_icon" href="" data-original-title="Delete"
                   type="button" data-toggle="modal" data-target="#exampleModalLong"><i
                        class="glyphicon glyphicon-trash" style="color: #e20101"></i></a> --}}
                </th>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Publication date</th>
                <th>Last updated</th>
                <th>Language </th>
                <th class="action">Action</th>
                <th class="publish">Publish / Unpublish Status</th>
            </tr>
            <tr class="warning no-result">
                <td colspan="4"><i class="fa fa-warning"></i> No result</td>
            </tr>
        </thead>
        <tbody>
            @if (!empty($contents))
                @foreach ($contents as $val)
                    <tr>
                        <td scope="row">
                            <input value="{{ $val['ID'] }}" name="check_content"
                                class="checkbox check_content form-element" type="checkbox">
                        </td>
                        <td>{{ $val['ID'] }}</td>
                        <td class="title">
                            <a class="titletab open-data" title="" data-toggle="modal" data-id="{{ $val['ID'] }}">

                            {{ $val['title'] ?? '' }}
                            </a>       
                        </td>
                        <td>
                            @if ($val['current_status'] == 'draft' || $val['current_status'] == 'Draft')
                                In Draft
                            @elseif($val['current_status']=='unpublish'|| $val['current_status']=='unpublished')
                                Un published
                            @elseif($val['current_status']=='publish'||$val['current_status']=='published')
                                Published
                            @else
                                In Draft
                            @endif
                        </td>
                        <td>{{ $val['publish_date'] ?? '' }}</td>
                        <td>{{ $val['expiryDate'] ?? '' }}</td>
                        <td>
                            @if ($val['language'] == 'en' || $val['language'] == 'English' || $val['language'] == 'english')
                                English
                            @elseif($val['language']=='hi'||$val['language']=='Hindi'||$val['language']=='hindi')
                                Hindi
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="action">
                            @php
                                $edit_url = url('edit' . $content_type);
                                $delete_url = url('deleteContent/' . $content_type . '/' . $val['ID']);
                            @endphp

                            @if ($content_type == 'articles')
                                <form method="POST" action="{{ route('deletearticles') }}" name="user_form"
                                    id="deleteSinglearticle_{{ $val['ID'] }}" data-parsley-validate>
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $val['ID'] }}" name="single_article_id"
                                        id="single_article_id">
                                    <input type="hidden" value="tableview" name="videoview" id="videoview">
                                </form>
                                <a class="view1 open-data tdaction" title="" data-toggle="modal" data-id="{{ $val['ID'] }}"
                                    data-original-title="view">
                                    <span class="ti-eye"></span>
                                </a>
                                <a class="view1 tdaction" title="" data-toggle="tooltip"
                                    href="{{ $edit_url }}/{{ $val['ID'] }}" data-original-title="Edit">
                                    <span class="ti-pencil-alt"></span>
                                </a>  

                                <a class="view1 tdaction" title="" id="delete_single_photo_{{ $val['ID'] }}"
                                    data-toggle="tooltip" data-original-title="delete"><span class="ti-trash"></span></a>
                            @else
                                <a class="view1" title="" data-toggle="tooltip"
                                    href="{{ $edit_url }}/{{ $val['ID'] }}" data-original-title="Edit"><i
                                        class="glyphicon glyphicon-pencil"></i></a>

                                <a class="view1" title="" data-toggle="tooltip" href="{{ $delete_url }}"
                                    data-original-title="delete"><i class="glyphicon glyphicon-trash"></i></a>
                            @endif
                        </td>
                        <td>
                            <a class="publish" title=""  data-toggle="tooltip" data-original-title="publish">
                                <span class="label">No</span>
                                <input type="checkbox" hidden="hidden" id="publish" class="publish_unpublish">
                                <label class="publish_unpublish" for="publish"> </label>
                                <span class="label">Yes</span>
                            </a>
                        </td>
                    </tr>


                @endforeach
            @endif
        </tbody>
    </table>
</div>
<div class="tab-pane fade" id="grid_view">
    <ol class="content-grid row">
        @foreach ($contents as $val)

            <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                <div class="border-side">
                    <label class="content-grid__select">
                        <div class="standardInput no-label form-checkbox">
                            <input value="{{ $val['ID'] }}" name="check_content"
                                class="checkbox form-element allselect" type="checkbox" id="input-pl-4">

                        </div>
                    </label>

                    <figure title="News Article">
                        <a class="image" data-cms-href="content.article.edit" data-params="item"
                            href="{{ $edit_url }}/{{ $val['ID'] }}">
                            {{-- {{ dd($val['image_url']); }} --}}
                           <img
                                data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl"
                                data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260"
                                alt="" src="{{ $val['image_url'] ?? '' }}?width=400&amp;height=260"
                                class="" style="">
                            <span class=" icon" data-icon="text"></span>
                        </a>
                    </figure>

                    <div class="info">
                        <span class="status published" title="Published"></span>

                        <dl class="metadata">
                            <!-- <dt class="title" data-i18n="label.title">Title</dt> -->
                            <dd class="title">
                                <a data-cms-href="content.article.edit" data-params="item"
                                    href="{{ $edit_url }}/{{ $val['ID'] }}">{{ $val['short_description'] ?? '' }}</a>
                                <!-- ngIf: item.internalName -->
                            </dd>

                            <dt class="id" data-i18n="label.id">ID</dt>
                            <dd class="id" data-ng-bind="item.id">{{ $val['ID'] }}</dd>
                            <dt class="type" data-i18n="label.type">Current Status</dt>
                            <dd class="type" data-i18n="content.type.TEXT">

                                @if ($val['current_status'] == 'draft' || $val['current_status'] == 'Draft')
                                    In Draft
                                @elseif($val['current_status']=='unpublish'|| $val['current_status']=='unpublished')
                                    Un published
                                @elseif($val['current_status']=='publish'||$val['current_status']=='published')
                                    Published
                                @else
                                    In Draft
                                @endif
                            </dd>
                            <dt class="date" data-i18n="label.updated">Last updated </dt>
                            <dd class="date" data-i18n="label.updated">{{ $val['expiryDate'] ?? 'N/A' }}
                            </dd>
                            <dt class="date" data-i18n="label.updated">language</dt>
                            <dd class="date" data-i18n="label.updated">
                                @if ($val['language'] == 'en' || $val['language'] == 'English' || $val['language'] == 'english')
                                    English
                                @elseif($val['language']=='hi'||$val['language']=='Hindi'||$val['language']=='hindi')
                                    Hindi
                                @else
                                    N/A
                                @endif
                            </dd>
                            <!-- new ContentSummaryAPIActive usage start -->
                            <!-- ngIf: ContentSummaryAPIActive -->
                            <dd class="date" data-ng-if="ContentSummaryAPIActive"
                                data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'" style="">
                                {{ $val['publish_date'] ?? '' }}</dd><!-- end ngIf: ContentSummaryAPIActive -->
                            <!-- ngIf: !ContentSummaryAPIActive -->
                            <!-- new ContentSummaryAPIActive usage end -->
                        </dl>

                        <ul class="button_edit">
                            @if ($content_type == 'articles')
                                <form method="POST" action="{{ route('deletearticles') }}" name="user_form"
                                    id="deleteSinglearticle_{{ $val['ID'] }}" data-parsley-validate>
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $val['ID'] }}" name="single_article_id"
                                        id="single_article_id">
                                    <input type="hidden" value="tableview" name="videoview" id="videoview">
                                </form>

                                <a class="view1 open-data" title="" data-toggle="modal" data-id="{{ $val['ID'] }}"
                                    data-target="#Viewpage_{{ $val['ID'] }}" data-original-title="view">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </a>
                                <a class="view1" title="" data-toggle="tooltip"
                                    href="{{ $edit_url }}/{{ $val['ID'] }}" data-original-title="Edit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>


                                <a class="publish" title="" data-toggle="tooltip"
                                    data-original-title="publish">&nbsp;
                                    <i class="mdi mdi-checkbox-multiple-marked" data-icon="v"></i>
                                </a>



                                <a class="view1" title="" id="delete_single_photo_{{ $val['ID'] }}"
                                    data-toggle="tooltip" data-original-title="delete"><i
                                        class="glyphicon glyphicon-trash single_delete_icon"
                                        data-id="{{ $val['ID'] }}"></i></a>
                            @else
                                <a class="view1" title="" data-toggle="tooltip"
                                    href="{{ $edit_url }}/{{ $val['ID'] }}" data-original-title="Edit"><i
                                        class="glyphicon glyphicon-pencil"></i></a>

                                <a class="view1" title="" data-toggle="tooltip" href="{{ $delete_url }}"
                                    data-original-title="delete"><i class="glyphicon glyphicon-trash"></i></a>
                            @endif
                          
                        </ul>

                    </div>
                </div>
            </li>


        @endforeach

    </ol>
</div>

<div class="modal fade" id="article_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 60%; margin: 0 auto;">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <input type="hidden" name="single_article_id_form" id="single_article_id_form" class="user_id"
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
                <h2 class="Preview-title">Preview Article</h2>
                <!--<a class="recent-content__add btn primary medium leftbtn" href="#">Edit Detail</a>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body wizard-content">

                <form data-parsley-validate action="{{ route('addArticle') }}" name="article_form" id="article_form"
                    method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                    <!--<button type="button" id="collapsesidebar-btn" class="collapse-btn">
                        <span> Collapse sidebar</span>
                    </button>-->
                    <h6>Basic Info</h6>
                    
                    <section>
                        <!--<h3>Basic Info</h3>-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!--<label for="wfirstName2"> Headline*:</label>-->
                                    <!--<input type="text"  class="form-control" value="" name="title" readonly>-->
                                    
                                    <a class="recent-content__add btn primary medium rightbtn" href="#">Edit Detail</a>
                                    <h2 id="title" class="head-title"></h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="pdlt" for="wfirstName2">Publish Date: &nbsp;<span class="date" id="publishTo"></span>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Author: &nbsp;<span class="date" id="author"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Location: &nbsp;<span class="date"  id="location"></span>

                                    </label>
                                    <!--<input type="text" id="publishTo"  value="" name="publishTo"
                                        readonly>-->
                                    <div class="date" id="publishTo"></div>    
                                </div>
                            </div>

                            {{--  
                            
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wfirstName2">Author:</label>
                                    <input type="text" id="author" class="form-control" value="" name="author" readonly>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wfirstName2"> Short Description*:</label>
                                    <input type="text" id="short_desc" class="form-control" value=""
                                        name="short_description" readonly>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                   <label for="wfirstName2">Subtitle:</label> -->
                                     <!-- <label for="wfirstName2">Article Language:</label>
                                    <input type="text" id="leng" class="form-control" value="" name="subtitle"
                                        disabled>
                                </div>

                            </div> -->
                            {{-- <div class="col-md-6">    
                            <div class="form-group">
                                <!--<label for="wfirstName2">Article Owner:</label>-->
                                <input type="text" class="form-control" value="" name="article_owner" readonly>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wlastName2" class="pdlt">Article Content</label>
                                    <div id="content" class="content"></div>
                                </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                            <!--<label for="wfirstName2">Photo:</label>-->
                            <div> <img src="" id="image_url" name="image_url" alt="Trulli" width="500" height="333"></div>
                              </div>
                        </div>
                            {{-- <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Video Duration:</label>
                                <input type="text" class="form-control" value="" name="video_duration" readonly>
                            </div>
                        </div> --}}
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
                                <label for="wfirstName2">Keywords:</label>
                                <input type="text" class="form-control" value="" name="keywords" readonly>
                            </div>
                        </div> --}}
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wfirstName2">Additional Info:</label>
                                    <input type="text" id="addininfo" class="form-control" value="" name="additionalInfo" readonly>
                                </div>
                            </div> -->
                            {{-- <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Match Formats:</label>
                                <input type="text" class="form-control" value="" name="match_formats" readonly>
                            </div>

                        </div> --}}
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wfirstName2">Published By:</label>
                                    <input type="text" id="publish_by" class="form-control" value="" name="published_by" readonly>
                                </div>

                            </div> -->
                            
                            {{-- <div class="col-md-6">                
                            <div class="form-group">
                                <label for="wfirstName2">Language:</label>
                                <input type="text" class="form-control" value="" name="language" readonly>
                            </div>

                        </div> --}}
                            <!-- <div class="col-md-6">

                                <div class="form-group">
                                    <label for="wfirstName2">Location:</label>
                                    <input type="text" id="location" class="form-control" value="" name="location" readonly>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wfirstName2">References:</label>
                                    <input type="text" id="refer" class="form-control" value="" name="references" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wfirstName2">Expiry Date:</label>
                                    <input type="text" id="expiry_date" class="form-control datepicker" value="" name="expiryDate"
                                        readonly>
                                </div>
                            </div> -->
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
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wfirstName2">Url Segment:</label>
                                    <input type="text" id="urlsegnment" class="form-control" value="" name="slug" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wfirstName2">Platform:</label>
                                    <input type="text" id="platform" class="form-control" value="" name="platform" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wfirstName2">Status:</label>
                                    <input type="text" id="status" class="form-control" value="" name="status" readonly>
                                </div>

                            </div> -->
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

                            {{--  <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wfirstName2">Photo:</label>
                                    <input type="file" class="form-control" value="" name="photo" readonly>
                                </div>
                            </div>--}}

                        </div>


                        <!-- <h3>Meta Information</h3> -->

                        <!-- <div class="row bodycontent">
                            {{-- <div class="col-md-12">
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

                        <h3>Segmentation</h3>

                        <div class="row bodycontent">
                            <div class="col-md-6" style="margin-bottom: 10px;">
                                <div class="form-group checkbox-al">
                                    <input type="checkbox" id="restrict" name="restrict" value="Bike" disabled>
                                    <label for="restrict"> Restrict content to logged in users</label><br>
                                </div>
                            </div>

                        </div> -->
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
<script>
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
            $("#video_id").val(all_id);
        });

        $(".single_delete_icon").click(function() {
            var id = $(this).data('id');
            $('#single_article_id_form').val(id);
            $('#article_model').modal('show');
        });

        $("#yes_button").click(function() {
            var id = $("#single_article_id_form").val();
            if ($('.checkbox:checked').length > 0) {
                $("#deleteBulkVideo").submit();
            } else {
                $("#deleteSinglearticle_" + id).submit();
            }
        });

        $('.open-data').click(function() {
            var id = $(this).data('id');
       
            if (id != undefined && id != null) {
                $.ajax({
                    type: 'GET',
                    url: '/articles/fetchArticle',
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
                             $('#addininfo').val(res.data.additionalInfo); 
                             $('#publish_by').val(res.data.published_by); 
                             $('#publishTo').html(res.data.publishTo); 
                             $('#location').html(res.data.location); 
                             $('#refer').val(res.data.references); 
                             $('#expiry_date').val(res.data.expiryDate); 
                             $("#urlsegnment").val(res.data.title.replace(/\s+/g, '-').toLowerCase());
                             $("#platform").val(res.data.platform);
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
                            var image_url = res.data.image_url ? res.data.image_url:'/img/no-image.png';
                            $('#content').html(res.data.body);
                            $('#image_url').attr('src',image_url);
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

       
       
  
    });
</script>
<script>
$( document ).ready(function() {    
    $("div#Viewpage button#collapsesidebar-btn").click(function(){ 
        $('div#Viewpage #collapsingsidebar').toggleClass("collapse-deactive");
        $('div#Viewpage section.body').toggleClass("collapse-deactive");
        $("div#Viewpage button#collapsesidebar-btn span").text(function(i, v){
            return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
        });
    });
});
</script>