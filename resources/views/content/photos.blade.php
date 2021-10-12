
<form data-parsley-validate  name="photo_form" id="photo_form" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
    {{ csrf_field() }}
    <!-- Step 1 -->
    <button type="button" id="collapsesidebar-btn" class="collapse-btn">
        <span>Collapse sidebar</span>
    </button>
    <h6>Basic Info</h6>
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> Headline*:</label>
                    <input type="text" required class="form-control text-case" id="title" name="title" value="">
                    <!-- <input type="text" class="form-control photo_title" value="{{ old('photo_title') }}" id="photo_title" name="photo_title" required="">  -->
                    <p class="error">{{ $errors->first('photo_title') }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2">URL Segment</label>
                    <br />
                    <div class="input_field">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <input type="text" name="url_segment" class="form-control url_segment" id="url_segment" value="" readonly="" > -->

                                <input type="text" id="titleUrlSegment" name="titleUrlSegment" onfocusout="save_url();" value="" readonly="readonly">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2">Language*:</label>
                    <select class="form-control" name="language" required>
                        <option value="" disabled>Select Language</option>
                        @foreach ($data as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                        <!-- <option value="english" @if (old('language') == 'english') selected="selected" @endif>English</option>
                        <option value="hindi" @if (old('language') == 'hindi') selected="selected" @endif>Hindi</option> -->
                    </select>
                    <p class="error">{{ $errors->first('language') }}</p>
                </div>
            </div>


            <div class="col-md-6">

                <div class="form-group">
                    <label for="wlastName2"> Description*:</label>
                    <textarea class="form-control" name="photo_description" rows="9" required="">{{ old('photo_description') }}</textarea>
                    <p class="error">{{ $errors->first('photo_description') }}</p>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- cropper image div  -->
                <div class="form-group">
                    <label for="myfile">Upload photo:</label>
                    <input type="hidden" name="image_name"  id="image_name" >                  
                    <div class="img-container">
                        <img id="image" src="{{ asset('img/no-image.png') }} ">
                    </div>
                    <input type="text" name="imageUrl"  style="visibility: hidden;position: absolute;top: 0px;opacity: 0;" required id="imgBaseUrl">                 
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
        @include('cropper.cropper');
    </section>
    <!-- Dynamic Tab -->
    <h6>Meta Information</h6>
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Copyright*:</label>
                    <input type="text" name="copyright" class="form-control" value="{{ old('copyright') }}" required="">
                    <p class="error">{{ $errors->first('copyright') }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> Subtitle*:</label>
                    <input type="text" name="photo_subtitle" class="form-control" value="{{ old('photo_subtitle') }}" required="">
                    <p class="error">{{ $errors->first('photo_subtitle') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group clearfix">
                    <label for="wlastName2">Published Date*:</label>
                    <input type="date" class="form-control dtpicker published_date" value="" name="publish_date" required>
                    <input type="time" class="form-control tmpicker publish_time" value="" name="publish_time">
                    <p class="error">{{ $errors->first('published_date') }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group clearfix">
                    <label for="wlastName2">Expiry Date*:</label>
                    <input type="date" class="form-control dtpicker expirydate" value="" name="expiryDate" required>
                    <input type="time" class="form-control tmpicker expiry_time" value="" name="expiryTime">
                    <div class="Expiryerror"></div>

                </div>
            </div>

        </div>
        <div class="row">
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1" class="fullwidth">Location Search :</label>
                    <button type="button" class="location-search">Search</button>
                </div>
            </div> -->
            <div class="col-md-12">
                <div class="form-group">
                    <label for="behName1">Location Search* :</label>
                    <input type="text" name="photolocationsearch" id="photolocationsearch" class="form-control" placeholder="Choose Location" required>
                    <!-- <input type="text" class="form-control" value=""  name="location_label"> -->
                </div>
            </div>

        </div>
        <div class="row">
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Published By*:</label>
                    <input type="text" name="published_by" class="form-control" value="{{ old('published_by') }}" required="">
                    <p class="error">{{ $errors->first('published_by') }}</p>
                </div>
            </div> -->
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Additional Info*:</label>
                    <textarea class="form-control" name="photo_additional_info" rows="2" disabled="">{{ old('photo_additional_info') }}</textarea>
                    <p class="error">{{ $errors->first('photo_additional_info') }}</p>
                </div>
            </div> -->
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Location* :</label>
                    <input type="text" class="form-control" value="" name="location"> 
                </div>
            </div> -->

        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Latitude :</label>
                    <input type="text" id="latitudephoto" name="latitudephoto" class="form-control" readonly>
                    <!-- <input type="text" class="form-control" value="" readonly name="latitude"> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Longitude:</label>
                    <input type="text" name="longitudephoto" id="longitudephoto" class="form-control" readonly>
                    <!-- <input type="text" class="form-control" value="" readonly name="longitude"> -->
                </div>
            </div>
        </div>
        <?php $get_tags = platformList(); ?>
                              
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Platform*:</label>
                    <select class="form-control" required="" name="platform[]" id="platform">
                    @foreach ($get_tags as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach    
                </select>
                    <!-- <input type="text" name="photo_platform" class="form-control" value="" required=""> -->
                    <p class="">
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Status*:</label>
                    <select class="form-control" name="photo_current_status" required="">
                        <option value="" disabled>Select Status</option>
                        @foreach ($status as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <p class="error">{{ $errors->first('photo_current_status') }}</p>
                </div>
            </div>
        </div>

    </section>
    <!-- End Dynamic Tab -->
    <!-- Step 2 -->
    <h6>Route restrictions</h6>
    <section>
        <?php $get_country = countryList(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-right-content form-group geo-blocking">
                <h3>Geo Blocking</h3>
                        <label for="shortDescription3">Custom Select country</label>
                        <select class="selectpicker form-control" name="country[]" multiple data-actions-box="true">
                        <option value="" disabled>Select Country</option>   
                            @foreach($get_country as $value)
                                <option value="{{ $value['country_id'] }}">{{ $value['country_name']}}</option>
                            @endforeach
                        </select>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2">Comments On*:</label>
                    <select class="form-control" name="comments_on" required="">
                        <option value="">Select Comments On Status</option>
                        <option value="true" @if (old('comments_on') == 'true') selected="selected" @endif>Active</option>
                        <option value="false" @if (old('comments_on') == 'false') selected="selected" @endif>Inactive</option>
                    </select>
                    <p class="error">{{ $errors->first('comments_on') }}</p>
                </div>
            </div> -->

        </div>
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="wlastName2">Keywords:</label>
                    <input type="text" name="photo_meta_data" class="form-control tagsinput"
                        value="{{ old('photo_meta_data') }}">
                    <p class="error">{{ $errors->first('photo_meta_data') }}</p>
                </div>
            </div>
        </div> -->
        <!-- <div class="row">
            <div class="col-md-6" style="margin-bottom: 10px;">
                <div class="form-group checkbox-al">
                    <input type="checkbox" id="restrict" name="restrict" value="">
                    <label for="vehicle1"> Restrict content to logged in users</label><br>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2"> Keywords*:</label>
                    <input type="text" name="photo_keyword" class="form-control" value="{{ old('photo_keyword') }}">
                    <p class="error">{{ $errors->first('photo_keyword') }}</p>
                </div>
            </div>
        </div> -->
        <!-- <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Match Format*:</label>
                    <input type="text" name="match_format" class="form-control" value="{{ old('match_format') }}" >
                    <p class="error">{{ $errors->first('match_format') }}</p>
                </div>
            </div>
        </div> -->
        <div class="row">
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Status*:</label>
                    <select class="form-control" name="photo_status">
                        <option value="">Select value</option>
                        <option value="true" @if (old('photo_status') == 'true') selected="selected" @endif>Active</option>
                        <option value="false" @if (old('photo_status') == 'false') selected="selected" @endif>Inactive</option>
                    </select>
                    <p class="error">{{ $errors->first('photo_status') }}</p>
                </div>
            </div> -->

        </div>
    </section>


    <div id="collapsingsidebar" class="collapssidebar">
        <section>
            <!-- <button onclick="myFunction()">Click me</button> -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="content-ref">
                            <h2>Content references</h2>
                            <div class="reference-search">
                                <div class="reference-search__select-container">
                                    <select id="imagesreference" name="imagesreference" class="reference-search-s">
                                        <option selected="selected" disabled="disabled">Select type</option>
                                        <option value="articles">Articles</option>
                                        <option value="photos">Photos</option>
                                        <option value="playlists">Playlists</option>
                                        <option value="videos">Videos</option>
                                        <option value="audio">Audio</option>
                                        <option value="promos">Promos</option>
                                        <option value="documents">Documents</option>
                                        <option value="bios">Bios</option>
                                    </select>

                                    <select class="form-control selectpicker photos_reference" name="photoreference[]" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">

                                    </select>
                                    <div class="selectedvalue" role="document"></div>

                                </div>
                                <ul class="added-freq">
                                    <li data-toggle="modal" data-target="#Favouritess">
                                        <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added

                                    </li>
                                    <li data-toggle="modal" data-target="#Favouritess">
                                        <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                                    </li>
                                    <li data-toggle="modal" data-target="#Favouritess">
                                        <i class="mdi mdi-heart-outline fa-fw" data-icon="v"></i> Favourites
                                    </li>
                                </ul>
                                <div class="modal fade" id="Favourites" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="width: 60%; margin: 0 auto;">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h2>Click the add button to attach the content reference</h2>
                                            <select class="form-control selectpicker" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tagsinput1">
                            <h2>Tags</h2>
                            <?php $get_tags = get_all_tags(); ?>
                            <select class="form-control taginput-item" id="inputTagimagexyx" name="tags[]" multiple="multiple">
                                @foreach ($get_tags['data'] as $key => $t)
                                <option value="{{ $t['label'] }}">
                                    {{ $t['label'] }}
                                </option>
                                @endforeach
                            </select>
                            <ul class="added-freq">
                                <li data-toggle="modal" data-target="#Favourites">
                                    <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added
                                </li>
                                <li data-toggle="modal" data-target="#Favourites">
                                    <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                                </li>
                            </ul>
                        </div>


                        <div class="content-ref">
                            <h2>Related content</h2>
                            <div class="reference-search">
                                <div class="reference-search__select-container">
                                    <select id="photocontentId" name="photocontentId" class="reference-search-s">
                                        <option selected="selected" disabled="disabled">Select type</option>
                                        <option value="articles">Articles</option>
                                        <option value="photos">Photos</option>
                                        <option value="playlists">Playlists</option>
                                        <option value="videos">Videos</option>
                                        <option value="audio">Audio</option>
                                        <option value="promos">Promos</option>
                                        <option value="documents">Documents</option>
                                        <option value="bios">Bios</option>
                                    </select>

                                    <select class="form-control selectpicker photorelatedcontent" name="photocontentref[]" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">

                                    </select>
                                    <div class="selectedrelcont" role="document"></div>

                                </div>
                                <ul class="added-freq">
                                    <li data-toggle="modal" data-target="#Favouritess">
                                        <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added

                                    </li>
                                    <li data-toggle="modal" data-target="#Favouritess">
                                        <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                                    </li>
                                    <li data-toggle="modal" data-target="#Favouritess">
                                        <i class="mdi mdi-heart-outline fa-fw" data-icon="v"></i> Favourites
                                    </li>
                                </ul>
                                <div class="modal fade" id="Favourites" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="width: 60%; margin: 0 auto;">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h2>Click the add button to attach the content reference</h2>
                                            <select class="form-control selectpicker" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                                <option>
                                                    <h2>India’s squad for WTC Final and Test series against England
                                                        announced</h2> <span class="lan">English | Last
                                                        updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>
    </div>
</form>
<!-- <script src="{{ URL::asset('js/cropper.js') }}"></script>
<script src="{{ URL::asset('js/cropper_main.js') }}"></script> -->
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDetZZwXV4c_mQULaCiJLJvT8Z_XYhfQbI&libraries=places"></script>
<script src="{{ asset('js/photos/photoslist.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/common/cropper.js') }}" type="text/javascript"></script>

{{-- Collapse Bar selected drop down with loader --}}
<script>
    $(document).ready(function() {
        $("#photos button#collapsesidebar-btn").click(function() {
            $('#photos #collapsingsidebar').toggleClass("collapse-deactive");
            $('#photos section.body').toggleClass("collapse-deactive");
            $("#photos button#collapsesidebar-btn").text(function(i, v) {
                return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
            });
        });

        //  Selected dropdown with loader2

        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.photos_reference',
            function() {
                $("#collapsingsidebar .reference-search .inner").append(
                    '<button  type="button" class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
                $("#collapsingsidebar .reference-search .inner").append(
                    '<div class="loader-background"><div class="loader"></div></div>'
                );
               // if ($('select.photos_reference option').length != 0) {
               //     $('.loader-background').hide();
               // }
                   for (let i = 1; i <= $('select.photos_reference option').length; i++) {
                    if (i == $('select.photos_reference option').length) {
                        console.log(i + "==" + $('select.photos_reference option').length);
                        $('.loader-background').hide();
                    }
                }
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.photorelatedcontent',
            function() {
                $("#collapsingsidebar .reference-search .inner").append(
                    '<button type="button" class="addtocontentrefrence" id="add-sels"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
                $("#collapsingsidebar .reference-search .inner").append(
                    '<div class="loader-background"><div class="loader"></div></div>'
                );
                //if ($('select.photorelatedcontent option').length != 0) {
                //    $('.loader-background').hide();
                //}
                  for (let i = 1; i <= $('select.photorelatedcontent option').length; i++) {
                    if (i == $('select.photorelatedcontent option').length) {
                        console.log(i + "==" + $('select.photorelatedcontent option').length);
                        $('.loader-background').hide();
                    }
                }
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.photos_reference',
            function() {
                $('.dropdown.bootstrap-select.show-tick.form-control.photos_reference').on('click',
                    'button#add-sel',
                    function() {

                        var optionsselected = $("select.photos_reference").val();
                        console.log(optionsselected);
                        $('.selectedvalue').html("");
                        $.each(optionsselected, function(i, x) {

                            $('.selectedvalue').append('<div class="selectedcol ">' + x +
                                '<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>'
                            )

                        });

                    });
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.photorelatedcontent',
            function() {
                $('.dropdown-menu.open').on('click', 'button#add-sels', function() {
                    var optionsselected = $("select.photorelatedcontent").val();
                    $('.selectedrelcont').html("");
                    $.each(optionsselected, function(i, x) {

                        $('.selectedrelcont').append('<div class="selectedcol ">' + x +
                            '<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>'
                        )

                    });

                });
            });
        $('.selectedvalue').on('click', '#close-selected', function() {
            $(this).parents('.selectedcol').fadeOut();
        });
        $("button.close.btn.innerpopup").click(function() {
            $('#Favourites').modal('hide');
        });

    });
</script>
{{-- End Collapse Bar selected drop down with loader --}}

<script type="text/javascript">
    $(document).ready(function() {
        $("#imagesreference").on('change', function() {
            var ref = $(this).val();

            if (ref != undefined && ref != null) {
                $.ajax({
                    type: "POST",
                     url: "/commonsearch",
                    data: {
                        type: ref
                    },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        $('select.photos_reference').empty();
                        $('select.photos_reference').selectpicker('destroy');
                        $('select.photos_reference').selectpicker();
                        $.each(res.data, function(index, value) {
                          
                            var option = '<option value="<h2>' + value.title +
                                '</h2> <span>' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span >ID:' + value
                                .ID + '</span>" data-show=""><h2>' + value.title +
                                '</h2> <span class="lan">' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span class="id">ID:' +
                                value.ID + '</span></option>';
                            $('select.photos_reference').append(option);

                        });
                          $('.photos_reference').selectpicker('refresh');
                        if ($('select.photos_reference option').length != 0) {
                            $('.loader-background').hide();
                        }
                        
                    },
                    error: function() {
                        return false;
                    },
                    complete: function() {
                        console.log('complete');
                    }
                })
            }

        });

        // Releted 
        $("#photocontentId").on('change', function() {
            var ref = $(this).val();
            if (ref != undefined && ref != null) {
                $.ajax({
                    type: "POST",
                    url: "/commonsearch",
                    data: {
                        type: ref
                    },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                           $('select.photorelatedcontent').empty();
                        $('select.photorelatedcontent').selectpicker('destroy');
                        $('select.photorelatedcontent').selectpicker();
                        $.each(res.data, function(index, value) {
                            var option = '<option value="<h2>' + value.title +
                                '</h2> <span>' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span>ID:' + value
                                .ID + '</span>" ><h2>' + value.title +
                                '</h2> <span class="lan">' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span class="id">ID:' +
                                value.ID + '</span></option>';
                            $('select.photorelatedcontent').append(option);
                        });
                        $('.photorelatedcontent').selectpicker('refresh');
                        if ($('select.photorelatedcontent option').length != 0) {
                            $('.loader-background').hide();
                        }
                        console.log(res);
                    },
                    error: function() {
                        return false;
                    },
                    complete: function() {
                        console.log('complete');
                    }
                })
            }

        });

        // Tags in Search

        $("#inputTagimage").select2({
            minimumInputLength: 2,
            tags: [],
            ajax: {
                url: "/articletagList",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                success: function(res) {
                    console.log(res.data);
                    $.each(res.data, function(index, value) {
                        console.log(value.label);
                        var option = '<option>' + value.label + '</option>';
                        $('#inputTagimage').append(option);
                    });
                    $(".taginput-item").select2({
                        tags: true,
                        tokenSeparators: [',', ' ']
                    })
                },
            }
        });

    });

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

    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

    function hideShowEditURLDiv() {
        $('.input_field').show();
        $('.text_url_field').hide();
    }
</script>