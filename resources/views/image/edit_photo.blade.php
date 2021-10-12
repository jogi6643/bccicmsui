<?php header('Access-Control-Allow-Origin: *'); ?>
@extends('base')
@section('title', 'Edit Photo')
@section('epic_content')

<style type="text/css">
    .modal-title {
        margin: 0;
        line-height: 1.42857143;
        text-align: center;
        color: #1a457d;
        font-weight: 400;
    }
</style>
<?php //dd($edit_data) ?>
<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li class="active"><a href="{{ url('uploadcontent') }}">Upload Content</a></li>
            <!-- <li class="active"></li> -->
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<div class="modal-dialog modal-lg" style="width:100%">
    <div class="modal-content">
        <div class="modal-header upload" style="padding:5px 15px;">
            <h4 class="card-title head-title">Update Photo</h4>
        </div>
        <div class="modal-body upload-body">
            <div class="row">
                <div class="col-12">
                    <div class="white-box">
                        <div class="card-body wizard-content">
                            <h6 class="card-subtitle">Complete All the steps to add new</h6>
                            <label class="control-label">Asset Type*</label>
                            <div class="">
                                <select class=" form-control" name="asset_type" id="asset_type" disabled="">
                                    <option value="">Select</option>
                                    <option value="articles">Articles</option>
                                    <option value="photos" selected="">Photos</option>
                                    <option value="playlists">Playlists</option>
                                    <option value="videos">Videos</option>
                                    <option value="audio">Audio</option>
                                    <option value="promos">Promos</option>
                                    <option value="documents">Documents</option>
                                    <option value="bios">Bios</option>
                                </select>
                            </div>
                            <div id="photos">
                                <form name="edit_photo_form" id="edit_photo_form" parsley-validate parsley-bind method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="photo_id" class="photo_id" value="{{ $edit_data['ID'] }}">
                                    <!-- Step 1 -->
                                    <button type="button" id="collapsesidebar-btn" class="collapse-btn">
                                        <span> Collapse sidebar</span>
                                    </button>
                                    <h6>Basic Info</h6>
                                    <section>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wfirstName2"> Headline*:</label>
                                                    <input type="text" required="" class="form-control text-case" value="{{ $edit_data['title'] }}" id="title" name="title" value="">
                                                    <input type="hidden" class="form-control" value="{{ $edit_data['ID'] }}" id="photo_id" name="photo_id" required="">
                                                    <p class="error">{{ $errors->first('photo_title') }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wfirstName2">URL Segment</label>
                                                    <input type="text" name="titleUrlSegment" id="titleUrlSegment" onfocusout="save_url();" value="{{ isset($edit_data['url_segment']) ? $edit_data['url_segment'] : '' }}" readonly="readonly">
                                                    <p class="error">{{ $errors->first('photo_title') }}</p>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="wlastName2">Language*:</label>
                                                    <select class="form-control" name="language" required="">
                                                        <option value="">Select Language</option>
                                                        @foreach ($language as $key => $value)
                                                        <option value="{{ $key }}" {{ $edit_data['language'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="error">{{ $errors->first('language') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- cropper image div  -->
                                                <div class="form-group">
                                                    <label for="myfile">Upload photo:</label>
                                                    <input type="hidden" name="image_name" id="image_name">
                                                    <input type="hidden" name="imgBaseUrl" id="imgBaseUrl">
                                                    <div class="img-container">
                                                        <img id="image" src="{{ isset($edit_data['image_url']) ? $edit_data['image_url'] : $edit_data['imageUrl'] }} ">
                                                    </div>
                                                    <input type="text" name="imageUrl" class="editimg" style="visibility: hidden;position: absolute;top: 0px;opacity: 0;" value="{{ isset($edit_data['image_url']) ? $edit_data['image_url'] : $edit_data['imageUrl'] }}" required>
                                                    <div class="errorsuccmsg"> </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 pt-0">
                                                <div class="form-group">
                                                    <label for="myfile">Preview:</label>
                                                    <div class="docs-preview clearfix">
                                                        <div class="img-preview preview-lg"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- cropper image div  -->
                                        </div>
                                        @include('cropper.cropper')

                                    </section>
                                    <!-- Dynamic Tab -->
                                    <h6>Meta Information</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="myfile">Copyright*:</label>
                                                    <input type="text" name="copyright" class="form-control" value="{{ $edit_data['copyright'] }}" required="">
                                                    <p class="error">{{ $errors->first('copyright') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wfirstName2"> Subtitle*:</label>
                                                    <input type="text" name="photo_subtitle" class="form-control text-case" value="{{ $edit_data['subtitle'] }}" required="">
                                                    <p class="error">{{ $errors->first('photo_subtitle') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="wlastName2"> Description*:</label>
                                                    <textarea class="form-control" name="photo_description" rows="3" required="">{{ $edit_data['description'] }}</textarea>
                                                    <p class="error">
                                                        {{ $errors->first('photo_description') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group clearfix">
                                                    <label for="wlastName2">Published Date*:</label>
                                                    <input type="date" class="form-control dtpicker" value="{{ $publishdate ?? '' }}" name="publish_date" required>
                                                    <input type="time" class="form-control tmpicker" value="{{ $publishtime ?? '' }}" name="publish_time">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group clearfix">
                                                    <label for="wlastName2">Expiry Date*:</label>
                                                    <input type="date" class="form-control dtpicker" value="{{ $expiredate ?? '' }}" name="expiryDate" required>
                                                    <input type="time" class="form-control tmpicker" value="{{ $expiretime ?? '' }}" name="expiryTime">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-md-12 location ">
                                                <div class="form-group">
                                                    <label for="behName1">Location Search*:</label>
                                                    <input type="text" name="photolocationsearch" id="photolocationsearch" class="form-control" value="{{ $edit_data['location'] }}" placeholder="Choose Location" required> 

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Latitude :</label>
                                                    <input type="text" id="latitudephoto" name="latitudephoto" class="form-control" value="{{ isset($edit_data['latitude'])?$edit_data['latitude'] : '' }}"  readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Longitude:</label>
                                                    <input type="text" name="longitudephoto" id="longitudephoto" class="form-control" value="{{ isset($edit_data['longitude'])?$edit_data['longitude'] : ''  }}"  readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                        <?php $get_tags = platformList();
                                                $selected = json_decode($edit_data['platform']);
                                                $select = !empty($selected)?$selected : [];
                                                ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label for="myfile">Platform*:</label>
                                                        <select class="selectpicker"  multiple data-actions-box="true" required="" id="feild"name="platform[]" value="{{ old('platform') }}">
                                                            @foreach ($get_tags as $key => $value)
                                                                <option value="{{ $key }}" {{ (in_array($key, $select)) ? 'selected' : '' }}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="myfile">Status*:</label>
                                                    <select class="form-control" name="photo_current_status" required="">
                                                        <option value="" disabled>Select Status</option>
                                                        @foreach ($status as $key => $value)
                                                        <option value="{{ $key }}" {{ $edit_data['currentstatus'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="error">
                                                        {{ $errors->first('photo_current_status') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </section>
                                    <!-- Step 2 -->
                                    <h6>Update</h6>
                                    <section>
                                    <?php $get_country = countryList();?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-right-content form-group geo-blocking">
                                                <h3>Geo Blocking </h3>
                                                    <label for="shortDescription3">Custom Select country</label>
                                                    <select class="selectpicker form-control" name="country[]" multiple data-actions-box="true">
                                                    <option value="" disabled>Select Country</option>   
                                                        @foreach($get_country as $value)
                                                        @if(isset($edit_data['geo_blocking']))
                                                            <option value="{{ $value['country_id'] }}" {{ (in_array($value['country_id'], $edit_data['geo_blocking'])) ? 'selected' : '' }}>{{ $value['country_name']}}</option>
                                                        @else                                                                 
                                                        <option value="{{ $value['country_id'] }}" >{{ $value['country_name']}}</option>
                                                        @endif
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                       

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="myfile">Copyright*:</label>
                                                    <input type="text" name="copyright" class="form-control" value="{{ $edit_data['copyright'] }}" required="">
                                                    <p class="error">{{ $errors->first('copyright') }}</p>
                                                </div>
                                            </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="wlastName2"> Keywords*:</label>
                                                <input type="text" name="photo_keyword" class="form-control" value="{{ isset($edit_data['keywords'])?$edit_data['keywords']:'' }}" required="">
                                                <p class="error">{{-- $errors->first('photo_keyword') --}}</p>
                                            </div>
                                        </div>
                                        </div>

                                        <!-- <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="wlastName2">metadata:</label>
                                                    <input type="text" name="photo_meta_data" readonly class="form-control tagsinput" value="{{ isset($edit_data['metadata']) }}">

                                                    <p class="error">
                                                        {{-- isset($errors->first('photo_meta_data')) --}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="col-md-6" style="margin-bottom: 10px;">
                                            <div class="form-group checkbox-al">
                                                <input type="checkbox" id="restrict" name="restrict" value="Bike">
                                                <label for="vehicle1"> Restrict content to logged in users</label><br>
                                            </div>
                                        </div>
                                       
                                    </section>
                                    <div id="collapsingsidebar" class="collapssidebar">
                                        @include('releted_references.edit-content-reference');
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/content_refernce/content_refernce.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/common/cropper.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    function editable_segment() {
        $('input[name="titleUrlSegment"]').removeAttr("readonly");
    }

    function save_url() {
        $('input[name="titleUrlSegment"]').attr("readonly", "readonly");
    }
    $(document).ready(function() {
        $("#headline_title").keyup(function() {
            $("input").css("background-color", "pink");
        });
    });
    $(document).ready(function() {
        // $('.input_field').hide();
        $('.text_url_field').show();

        $('#remove_div').click(function() {
            $('.input_field').hide();
            $('.text_url_field').show();
        });

        $(".photo_title").keyup(function() {
            var title = $('.photo_title').val();
            var url_segment = title.replace(/\s+/g, '-').toLowerCase();
            $('#url_segment').val(url_segment);
        });

        var optionData = '';

        $("#related_content").change(function() {
            var selectedValue = $('#related_content :selected').val();
            getDataByContentValue(selectedValue, 'related_content_div');
        });

        $("#content_reference").change(function() {
            var selectedValue = $('#content_reference :selected').val();
            getDataByContentValue(selectedValue, 'content_reference_div');
        });
    });

    function getDataByContentValue(value, selectTagId) {
        $.ajax({
            url: APP_URL + '/commonSearchForReferenceAndContent',
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'serarch_value': value,
            },
            dataType: "json",
            success: function(data) {
                var response = $.parseJSON(data);
                if (response.length > 0) {
                    for (var i = 0; i < response.length; i++) {
                        $('#' + selectTagId).append('<option value="' + response[i]['ID'] + '">' + response[
                            i]['title'] + '</option>');
                    }
                } else {
                    optionData += '<select>No Data</select>';
                }
                $("#" + selectTagId).selectpicker("refresh");
            }
        });
    }

    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

    function hideShowEditURLDiv() {
        $('.input_field').show();
        $('.text_url_field').hide();
    }
</script>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDetZZwXV4c_mQULaCiJLJvT8Z_XYhfQbI&libraries=places"></script>
<script src="{{ asset('js/photos/photoslist.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // $('.input_field').hide();
        $('.text_url_field').show();

        $('#remove_div').click(function() {
            // $('.input_field').hide();
            $('.text_url_field').show();
        });

        $("#ok_button").click(function() {
            // var url_segment = $('#url_segment').val();
            // var id = $(".photo_id").val();
            // url_segment = url_segment.replace(/\s+/g,'-').toLowerCase();
            var data = $("#edit_photo_form").serializeArray();
            // console.log(data);
            $.ajax({
                url: APP_URL + '/updateUrlSegment',
                type: "POST",
                data: data,
                success: function(response) {
                    // console.log(response);
                    if (response.status.code == 200) {
                        window.location.reload();
                    }
                }
            });
        });

        var optionData = '';

        $("#related_content").change(function() {
            var selectedValue = $('#related_content :selected').val();
            getDataByContentValue(selectedValue, 'related_content_div');
        });

        $("#content_reference").change(function() {
            var selectedValue = $('#content_reference :selected').val();
            getDataByContentValue(selectedValue, 'content_reference_div');
        });
    });

    function getDataByContentValue(value, selectTagId) {
        $.ajax({
            url: APP_URL + '/commonSearchForReferenceAndContent',
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'serarch_value': value,
            },
            dataType: "text",
            success: function(data) {
                var response = $.parseJSON(data);
                if (response.length > 0) {
                    for (var i = 0; i < response.length; i++) {
                        $('#' + selectTagId).append('<option value="' + response[i]['ID'] + '">' + response[
                            i]['title'] + '</option>');
                    }
                } else {
                    optionData += '<select>No Data</select>';
                }
                $("#" + selectTagId).selectpicker("refresh");
            }
        });
    }

    function testing() {
        $('.input_field').show();
        $('.text_url_field').hide();
    }
</script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify();
        $("#photos button#collapsesidebar-btn").click(function() {
            $('#photos #collapsingsidebar').toggleClass("collapse-deactive");
            $('#photos section.body').toggleClass("collapse-deactive");
            $("#photos button#collapsesidebar-btn").text(function(i, v) {
                return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
            });
        });


    });
</script>


@stop