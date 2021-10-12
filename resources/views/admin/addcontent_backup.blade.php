<div class="modal-dialog modal-lg" style="width:85%">
        <div class="modal-content">
            <div class="modal-header" style="padding:5px 15px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-12">
                <div class="white-box">  
                <div class="card-body wizard-content">
                <h4 class="card-title">Add New {{ucfirst(strtolower($content_type))}}</h4>
                <h6 class="card-subtitle">Complete All the steps to add new {{strtolower($content_type)}}</h6>
                <input class="save_content_draft btn btn-primary" type="button" style="float:right;" value="Draft" name="draft_btn"></button>
                <form action="{{url('catalogs/')}}" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                <!-- Step 1 -->
                {{csrf_field()}}
                <input type="hidden" name="draft_check" value=""/>
                <input type="hidden" name="catalog_id" value="{{$catalog_details['ID']}}" />
                <input type="hidden" name="content_type" value="{{$content_type}}" />
                <input type="hidden" name="asset_type" value="{{$catalog_details['asset_type']}}" />
                <input type="hidden" name="action" value="add" />
                <input type="hidden" name="ID" value="0" />
                <?php 
                    $status = "-1";
                    if($catalog_details['slug'] == "latestly" || $catalog_details['slug'] == "live-tv"){
                        $status = "1";
                    }
                ?>
                <input type="hidden" name="trasncoding_status_video" value="{{$status}}" />
                <input type="hidden" name="upload_status_video" value="{{$status}}" />
                <input type="hidden" name="trasncoding_status_promo" value="{{$status}}" />
                <input type="hidden" name="upload_status_promo" value="{{$status}}" />
                <input type="hidden" name="parent" value="{{$parent}}" />
                <h6>Intro &amp; Meta</h6>
                <section>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="wfirstName2"> Title*:</label>
                <input type="text" class="form-control" value="" required name="title"> 
                </div>
                <div class="form-group">
                <label for="wemailAddress2"> Short Description*:</label>
                <textarea class="form-control draft_required_exclude" required id="short_description" name="short_description" rows="3"></textarea>
                </div>
                <div class="form-group">
                <label for="wemailAddress2"> Meta Title :</label>
                <input type="text" class="form-control" value="" name="meta_title">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="wfirstName2"> Slug*:</label>
                <input type="text" class="form-control" value="" readonly required name="slug"> 
                </div>
                <div class="form-group">
                <label for="wlastName2"> Description*:</label>
                <textarea class="form-control draft_required_exclude" required name="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                <label for="wlastName2"> Meta Description :</label>
                <textarea class="form-control" name="meta_description" rows="3"></textarea>
                </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="wlastName2"> Genres*:
                </label>

                <select class="select2 m-b-10 select2-multiple draft_required_exclude" required multiple name="genres[]" data-style="form-control" style="width:100%">
                <?php foreach($all_genres as $ag) {?>
                    <option value="{{$ag['ID']}}">
                        {{$ag['name']}}
                    </option>
                <?php } ?>
                </select>

                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="wphoneNumber2">Content Language*:</label>
                <select class="select2 m-b-10 select2-multiple draft_required_exclude" required name="language" data-style="form-control" style="width:100%">
                <option value="HI">Hindi</option>
                <option value="EN">English</option>
                <option value="BN">Bengali</option>
                <option value="GU">Gujarati</option>
                <option value="ML">Malayalam</option>
                <option value="MR">Marathi</option>
                <option value="PA">Punjabi</option>
                <option value="TE">Telugu</option>
                <option value="TA">Tamil</option>
                <option value="UR">Urdu</option>
                <option value="BHO">Bhojpuri</option>
                <option value="AR">Arabic</option>
                </select>
                </div>
                </div>
                </div>
                <div class="row">
                <?php if($content_type != 'EBOOK') { ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wlocation2"> Duration (HH:mm:ss):
                            </label>
                                <input type="text" placeholder="HH:mm:ss" name="duration" class="form-control" value="" />
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="wdate2">Order:</label>
                        <input type="number" name="content_order" value="" class="form-control"> 
                    </div>
                </div>
                @if($catalog_details['asset_type'] == 'LISTEN' && $content_type == 'EPISODE')
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="wdate2">Episode Order:</label>
                        <input type="number" name="episode_order" value="" class="form-control"> 
                    </div>
                </div>
                @endif
                <div class="col-md-12">
                <div class="form-group">
                <label for="wdate2">Keywords:</label>
                <input type="text" name="keywords" value="" class="form-control tagsinput">
                <span class="help-block">Press Enter After Each Tag</span> 
                </div>
                </div>
                <div class="col-md-12">
                <div class="form-group">
                <label for="wdate2">Meta Keywords:</label>
                <input type="text" name="meta_keywords" value="" class="form-control tagsinput">
                <span class="help-block">Press Enter After Each Meta Tag</span> 
                </div>
                </div>
                <div class="col-md-6">
                            <div class="form-group">
                            <label for="wemailAddress2">Content Owner:</label>
                            <input type="text"  class="form-control" id="content_owner" name="content_owner" />
                            </div>
                        </div>
                      <?php if(in_array($catalog_details['asset_type'], array('WATCH','LISTEN'))) { ?>       
                        <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="wlocation2">Coming Soon
                            </label>
                                <input type="checkbox" name="coming_soon" class="form-control" value="1" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wlocation2"> Publish Future Date
                            </label>
                            <input type="input" value="" class="form-control mydatepicker" name="publish_future_date">
                        </div>
                    </div> -->
                <?php } ?>
                <div class="col-md-6">
                <div class="form-group">
                <label for="wfirstName2"> Age Rating:</label>
                <input type="text" class="form-control" value=""  name="age_rating"> 
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="wfirstName2"> Age OTT:</label>
                <input type="text" class="form-control" value=""  name="age_ott"> 
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="shortDescription3">Kids Content:</label>
                <select class="select2 m-b-10 select2-multiple" style="width:100%"  name="kids_content"  data-style="form-control">
                <option value="0" selected="selected">NO</option>
                <option value="1">YES</option>
                </select>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="shortDescription3">Ishara Content:</label>
                <select class="select2 m-b-10 select2-multiple" style="width:100%"  name="ishara_content"  data-style="form-control">
                <option value="0" selected="selected">NO</option>
                <option value="1">YES</option>
                </select>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="shortDescription3">Airtel Content:</label>
                <select class="select2 m-b-10 select2-multiple" style="width:100%"  name="airtel_content"  data-style="form-control">
                <option value="1" selected="selected">YES</option>
                <option value="0" >NO</option>
                </select>
                </div>
                </div>
                @if ($catalog_details['asset_type'] == 'LISTEN')
                <div class="col-md-6">
                <div class="form-group">
                <label for="shortDescription3">Jio Content:</label>
                <select class="select2 m-b-10 select2-multiple" style="width:100%" id = "content_jio" name="jio_content"  data-style="form-control">
                <option value="1" >YES</option>
                <option value="0" >NO</option>
                </select>
                </div>
                </div>
                @endif
                </div>
                </section>
                <!-- Dynamic Tab -->
                <?php if(in_array($catalog_details['asset_type'], array('WATCH'))) { ?>
                    @foreach($languages as $c => $lang)
                    @if($c != "EN")
                    <h6>{{$lang}}</h6>
                    <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="wfirstName2"> Title*:</label>
                            <input type="text" class="form-control" value="" name="title_{{$c}}"> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="wemailAddress2"> Short Description*:</label>
                            <textarea class="form-control" id="short_description" name="short_description_{{$c}}" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="wlastName2"> Description*:</label>
                            <textarea class="form-control" name="description_{{$c}}" rows="3"></textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="behName1">Standard Cover Image V2* :</label>
                        <input type="file" class="dropify" data-default-file="" name="cover_image_v2_{{$c}}" data-max-file-size="2M"/>
                        <span class="help-block"><small>Upload 1255x610 size of image. We will take care of Thumbnails.</small></span>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="behName1">Banner Image V2:</label>
                        <input type="file" class="dropify" data-default-file="" data-max-file-size="2M"  name="banner_image_v2_{{$c}}" />
                        <span class="help-block"><small>Upload 580x380 size of image. We will take care of Thumbnails.</small></span>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Vertical Cover Image :</label>
                                <input type="file" class="dropify" data-default-file="" name="vertical_cover_image_{{$c}}" data-max-file-size="2M" />
                                <span class="help-block"><small>Upload 580x380 size of image. We will take care of Thumbnails.</small></span>
                            </div>
                        </div>  
                        <div class="col-md-6">
                                <div class="form-group">
                                <label for="behName1">Vertical Banner Image:</label>
                                <input type="file" class="dropify" data-default-file="" data-max-file-size="2M"  name="vertical_banner_image_{{$c}}" />
                                <span class="help-block"><small>Upload 1255x610 size of image. We will take care of Thumbnails.</small></span>
                            </div>
                        </div>                         
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="behName1">Special Cover Image* :</label>
                        <input type="file" class="dropify" data-default-file="" data-max-file-size="2M" name="cover_image_special_{{$c}}" />
                        <span class="help-block"><small>Upload 576x640 size of image. We will take care of Thumbnails.</small></span>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="behName1">Banner Image TV Apps* :</label>
                        <input type="file" class="dropify" data-default-file="" data-max-file-size="2M" name="tv_app_image_{{$c}}" />
                        <span class="help-block"><small>Upload 1280x548 size of image. We will take care of Thumbnails.</small></span>
                        </div>
                        </div>
                        @if ($catalog_details['slug'] == 'live-tv')
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="behName1">Live TV Banner Image :</label>
                        <input type="file" class="dropify" data-default-file="" data-max-file-size="2M" name="live_tv_banner_{{$c}}" />
                        <span class="help-block"><small>Upload 1280x548 size of image. We will take care of Thumbnails.</small></span>
                        </div>
                        </div>
                        @endif
                    </div>
                    </section>
                    @endif
                    @endforeach
                <?php } ?>
                <!-- End Dynamic Tab -->
                <!-- Step 2 -->
                <h6>Availability</h6>
                <section>
                <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="shortDescription3">Release Date:</label>
                    <input type="text" class="form-control mydatepicker" value="{{isset($content_view['release_date'])?$content_view['release_date']:''}}" name="release_date">
                  </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">Content Ownership*:</label>
                    <select class="select2 m-b-10 select2-multiple" id="content_ownership" style="width:100%" name="content_ownership" data-style="form-control">
                       <option value="1">Owned</option>
                       <option value="2">Acquired</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="jobTitle2">Publish Start Date / Time*:</label>
                <input type="datetime-local" value="{{isset($content_view['publish_start_date'])?date('Y-m-d\TH:i',strtotime($content_view['publish_start_date'])):''}}" class="form-control draft_required_exclude" name="publish_start_date" required>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label id="publish_end_date_label" for="webUrl3">Publish End Date:</label>
                <input type="datetime-local" class="form-control" id="publish_end_date" value="{{isset($content_view['publish_end_date'])?date('Y-m-d\TH:i',strtotime($content_view['publish_end_date'])):''}}" name="publish_end_date"> </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="shortDescription3">Platforms*:</label>
                        <select class="select2 m-b-10 select2-multiple draft_required_exclude" style="width:100%" required name="platforms[]" multiple data-style="form-control">
                            <option value="web" selected>Web</option>
                            <option value="app_android" selected>Android</option>
                            <option value="app_ios" selected>IOS</option>
                            <option value="tv_apple" selected>Apple TV</option>
                            <option value="tv_android" selected>Android TV</option>
                            <option value="tv_roku" selected>Roku</option>
                            <option value="tv_fire" selected>Fire TV</option>
                            <option value="tv_mi" selected>MI TV</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="shortDescription3">Age Restiction :</label>
                <select class="select2 m-b-10 select2-multiple" style="width:100%"  name="age_restriction"  data-style="form-control">
                <option value="5" selected="selected">5+</option>
                <option value="10">10+</option>
                <option value="13">13+</option>
                <option value="18">18+</option>
                <!-- <option value="U">U</option>
                <option value="U/A 7+">U/A 7+</option>
                <option value="U/A 13+">U/A 13+</option>
                <option value="U/A 16+">U/A 16+</option>
                <option value="A">A</option> -->
                </select>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="shortDescription3">Age Limit :</label>
                <select class="select2 m-b-10 select2-multiple" style="width:100%" id= "age_limit" name="age_limit"  data-style="form-control">
                <option value="U" selected="selected">U</option>
                <option value="U/A 7+">U/A 7+</option>
                <option value="U/A 13+">U/A 13+</option>
                <option value="U/A 16+">U/A 16+</option>
                <option value="A">A</option>
                </select>
                </div>
                </div>
                <div class="col-md-6">  
                <div class="form-group">
                <label for="wemailAddress2"> Age Limit Description:</label>
                <textarea class="form-control"  id="ageres_description" name="ageres_description" rows="3"></textarea>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="shortDescription3">App Languages*:</label>
                <select multiple class="select2 m-b-10 select2-multiple" style="width:100%" required name="app_languages[]" id="app_languages"  data-style="form-control">
                    <option value="EN" selected>English</option>
                </select>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="shortDescription3">Subscription*:</label>
                <select class="select2 m-b-10 select2-multiple" style="width:100%" required name="free_premium"  data-style="form-control">
                <option value="1">Required</option>
                <option value="0">Not Required</option>
                </select>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="shortDescription3">Login*:</label>
                <select class="select2 m-b-10 select2-multiple" style="width:100%" required name="login_required"  data-style="form-control">
                <option value="1">Required</option>
                <option value="0">Not Required</option>
                </select>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="shortDescription3">Status*:</label>
                <select class="select2 m-b-10 select2-multiple" style="width:100%" required name="status" data-style="form-control">
                <option value="1">Published</option>
                <option value="0">Unpublished</option>
                </select>
                </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">UAE Content*:</label>
                    <select class="select2 m-b-10" id="uaecontent" style="width:100%" name="uaecontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">TPAY Content*:</label>
                    <select class="select2 m-b-10" id="tpaycontent" style="width:100%" name="tpaycontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">Saudi Content*:</label>
                    <select class="select2 m-b-10" id="saudicontent" style="width:100%" name="saudicontent" data-style="form-control">
                        <option value="NO">NO</option>   
                        <option value="YES">YES</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">Swwift Content*:</label>
                    <select class="select2 m-b-10" id="swifftcontent" style="width:100%" name="swifftcontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">Kuwait Content*:</label>
                    <select class="select2 m-b-10" id="kuwaitcontent" style="width:100%" name="kuwaitcontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">NFDC Content*:</label>
                    <select class="select2 m-b-10" id="Nfdc_content" style="width:100%" name="Nfdc_content" data-style="form-control">
                       <option value="1">YES</option>
                       <option value="0">NO</option>
                    </select>
                   </div>
                </div>
                    <!-- <label for="shortDescription3">Fortumo Content*:</label>
                    <select class="select2 m-b-10" id="fortumocontent" style="width:100%" name="fortumocontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div> -->
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">Monsooq Content*:</label>
                    <select class="select2 m-b-10" id="monsooqcontent" style="width:100%" name="monsooqcontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>

                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">DCB Content*:</label>
                    <select class="select2 m-b-10" id="dcbcontent" style="width:100%" name="dcbcontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>

                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">MTN Content*:</label>
                    <select class="select2 m-b-10" id="mtncontent" style="width:100%" name="mtncontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">OMAN Content*:</label>
                    <select class="select2 m-b-10" id="omancontent" style="width:100%" name="omancontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">TpayWallet Content*:</label>
                    <select class="select2 m-b-10" id="tpaywalletcontent" style="width:100%" name="tpaywalletcontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">Grameen Content*:</label>
                    <select class="select2 m-b-10" id="grameencontent" style="width:100%" name="grameencontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">Platenista Tpay Content*:</label>
                    <select class="select2 m-b-10" id="platenistatpaycontent" style="width:100%" name="platenistatpaycontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>
                <!-- <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">Platenista Uae Content*:</label>
                    <select class="select2 m-b-10" id="platenistauaecontent" style="width:100%" name="platenistauaecontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">Platenista Kuwait Content*:</label>
                    <select class="select2 m-b-10" id="platenistakuwaitcontent" style="width:100%" name="platenistakuwaitcontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div> -->
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">Platenista Saudi Content*:</label>
                    <select class="select2 m-b-10" id="platenistasaudicontent" style="width:100%" name="platenistasaudicontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="form-group">
                    <label for="shortDescription3">ApiGate Content*:</label>
                    <select class="select2 m-b-10" id="apigatecontent" style="width:100%" name="apigatecontent" data-style="form-control">
                       <option value="YES">YES</option>
                       <option value="NO">NO</option>
                    </select>
                   </div>
                </div>
                <!-- <div class="col-md-6">
                <div class="form-group">
                <label for="shortDescription3">Regions*:</label>
                <select class="select2 m-b-10 select2-multiple draft_required_exclude" style="width:100%" required name="regions[]"  data-style="form-control" multiple>
                <option value="IN" selected>India</option>
                <option value="ROW" selected>Rest of the World</option>
                </select>
                </div>
                </div> -->
                <div class="col-md-6">
                <div class="form-group">
                <label for="shortDescription3">Blocked Regions*:</label>
                <select class="select2 m-b-10 select2-multiple" style="width:100%" name="blocked_region[]"  data-style="form-control" multiple>
                @foreach ($countries as $country)
                <option value="{{$country}}">{{$country}}</option>
                @endforeach
                </select>
                </div>
                </div>
                @if($content_type == 'SHOW')
                <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="shortDescription3" >Show All</label>
                        <input type="checkbox" name="show_all_show" id="show_all_show" value="1" class="js-switch" data-color="#f96262" data-size="small" />
                </div>
                </div> -->
                @endif
                </div>
                </section>
                <!-- Step 3 -->
                <h6>Regions</h6>
                <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="shortDescription3">Regions*:</label>
                                <select id="regions_to_select" class="select2 m-b-10 select2-multiple draft_required_exclude" style="width:100%" required name="regions[]"  data-style="form-control" multiple>
                                    @foreach ($country_result as $region)
                                    <?php                                     
                                        $newClass = 'othrOpt';
                                        if($region == 'India'){
                                            $newClass = 'inOpt';
                                        } 
                                        if($region == 'Rest of the World'){
                                            $newClass = 'rowOpt';
                                        } 
                                    ?>
                                    <option value="{{$region}}" class="{{$newClass}}">{{$region}}</option>
                                    @endforeach
                                    <!-- <option value="IN" selected>India</option>
                                    <option value="ROW" selected>Rest of the World</option> -->
                                </select>
                            </div>
                        </div>
                    </div>
                </section>
                <h6>Cast &amp; Crew</h6>
                <section>
                <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                <label for="wjobTitle2">Cast &amp; Crew :</label>
                    <div class="cast-outer">
                        <div class="cast-box input-group m-t-10"> 
                        <input type="text" name="cast_role[]" value="" class="form-control" placeholder="Role" style="width:50%"><input type="text" name="cast_name[]" class="form-control" placeholder="Name" value="" style="width:50%"><span class="input-group-btn">
                        <button type="button" disabled class="btn waves-effect waves-light rem-cast" onclick="javascript:this.parentNode.parentNode.remove();"><i class="mdi mdi-minus-box"></i></button>
                        </span> </div>
                    </div>
                <a href="javascript:;" onclick="add_cast_row_cast(this)">Add Row</a>
                </div>
                </div>
                </div>
                </section>
                <!-- Step 4 -->
                <h6>Video & Images</h6>
                <section>
                <div class="row">
                <div class="col-md-12">               
                <?php if(in_array($catalog_details['asset_type'], array('WATCH'))) { ?>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Standard Cover Image* :</label>
                        <input type="text" class="form-control" value="" name="alt_cover_image" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify draft_required_exclude" data-default-file="" name="cover_image" data-max-file-size="2M" required />
                        <span class="help-block"><small>Upload 1280x720 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Banner Image :</label>
                        <input type="text" class="form-control" value="" name="alt_banner_image" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify" data-default-file="" data-max-file-size="2M"  name="banner_image" />
                        <span class="help-block"><small>Upload <?php echo ($catalog_details['asset_type'] == 'WATCH' ? '1280x548' : '1255x610');?> size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Standard Cover Image V2* :</label>
                        <input type="text" class="form-control" value="{{isset($content_view['alt_cover_image_v2'])?$content_view['alt_cover_image_v2']:''}}" name="alt_cover_image_v2" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify" data-max-file-size="2M" data-default-file="{{isset($content_view['cover_image_v2']['large'])?$content_view['cover_image_v2']['large']:''}}"  name="cover_image_v2" />
                        <span class="help-block"><small>Upload 580x380 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Banner Image V2* :</label>
                        <input type="text" class="form-control" value="{{isset($content_view['alt_banner_image_v2'])?$content_view['alt_banner_image_v2']:''}}" name="alt_banner_image_v2" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify" data-max-file-size="2M" data-default-file="{{isset($content_view['banner_image_v2']['large'])?$content_view['banner_image_v2']['large']:''}}"  name="banner_image_v2" />
                        <span class="help-block"><small>Upload 1255x610 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div>  
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Airtel Title Art:</label>
                        <input type="text" class="form-control" value="{{isset($content_view['alt_airtel_title_art'])?$content_view['alt_airtel_title_art']:''}}" name="alt_airtel_title_art" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify" data-max-file-size="2M" data-default-file="{{isset($content_view['airtel_title_art']['large'])?$content_view['airtel_title_art']['large']:''}}"  name="airtel_title_art" />
                        <span class="help-block"><small>Upload 1800x600 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Airtel Panoramic Banner:</label>
                        <input type="text" class="form-control" value="{{isset($content_view['alt_airtel_panoramic_banner'])?$content_view['alt_airtel_panoramic_banner']:''}}" name="alt_airtel_panoramic_banner" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify" data-max-file-size="2M" data-default-file="{{isset($content_view['airtel_panoramic_banner']['large'])?$content_view['airtel_panoramic_banner']['large']:''}}"  name="airtel_panoramic_banner" />
                        <span class="help-block"><small>Upload 1780x548 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Airtel Landscape Tile:</label>
                        <input type="text" class="form-control" value="{{isset($content_view['alt_airtel_landscape_tile'])?$content_view['alt_airtel_landscape_tile']:''}}" name="alt_airtel_landscape_tile" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify" data-max-file-size="2M" data-default-file="{{isset($content_view['airtel_landscape_tile']['large'])?$content_view['airtel_landscape_tile']['large']:''}}"   name="airtel_landscape_tile" />
                        <span class="help-block"><small>Upload 1024x576 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Airtel Landscape Banner:</label>
                        <input type="text" class="form-control" value="{{isset($content_view['alt_airtel_landscape_banner'])?$content_view['alt_airtel_landscape_banner']:''}}"  name="alt_airtel_landscape_banner" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify" data-max-file-size="2M" data-default-file="{{isset($content_view['airtel_landscape_banner']['large'])?$content_view['airtel_landscape_banner']['large']:''}}"   name="airtel_landscape_banner" />
                        <span class="help-block"><small>Upload 1344x756 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Airtel Episode Tile:</label>
                        <input type="text" class="form-control" value="{{isset($content_view['alt_airtel_episode_tile'])?$content_view['alt_airtel_episode_tile']:''}}"  name="alt_airtel_episode_tile" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify" data-max-file-size="2M" data-default-file="{{isset($content_view['airtel_episode_tile']['large'])?$content_view['airtel_episode_tile']['large']:''}}"  name="airtel_episode_tile" />
                        <span class="help-block"><small>Upload 1344x756 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Airtel Interstitial Ad:</label>
                        <input type="text" class="form-control" value="{{isset($content_view['alt_airtel_interstitial_ad'])?$content_view['alt_airtel_interstitial_ad']:''}}"  name="alt_airtel_interstitial_ad" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify" data-max-file-size="2M" data-default-file="{{isset($content_view['airtel_interstitial_ad']['large'])?$content_view['airtel_interstitial_ad']['large']:''}}"  name="airtel_interstitial_ad" />
                        <span class="help-block"><small>Upload 500x750 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Airtel Landscape Small:</label>
                        <input type="text" class="form-control" value="{{isset($content_view['alt_airtel_landscape_small'])?$content_view['alt_airtel_landscape_small']:''}}"  name="alt_airtel_landscape_small" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify" data-max-file-size="2M" data-default-file="{{isset($content_view['airtel_landscape_small']['large'])?$content_view['airtel_landscape_small']['large']:''}}"  name="airtel_landscape_small" />
                        <span class="help-block"><small>Upload 1024x768 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
                <?php } else { ?>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Standard Cover Image V2* :</label>
                        <input type="text" class="form-control" value="{{isset($content_view['alt_cover_image_v2'])?$content_view['alt_cover_image_v2']:''}}" name="alt_cover_image_v2" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify" data-max-file-size="2M" data-default-file="{{isset($content_view['cover_image_v2']['large'])?$content_view['cover_image_v2']['large']:''}}"  name="cover_image_v2" />
                        <span class="help-block"><small>Upload 580x380 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Banner Image V2* :</label>
                        <input type="text" class="form-control" value="{{isset($content_view['alt_banner_image_v2'])?$content_view['alt_banner_image_v2']:''}}" name="alt_banner_image_v2" placeholder="Alt Text for Image"><br>
                        <input type="file" class="dropify" data-max-file-size="2M" data-default-file="{{isset($content_view['banner_image_v2']['large'])?$content_view['banner_image_v2']['large']:''}}"  name="banner_image_v2" />
                        <span class="help-block"><small>Upload 1255x610 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div>  
                
                <?php } ?>
                <div class="col-md-6">
                     <div class="form-group">
                           <label for="behName1">Vertical Cover Image :</label>
                           <input type="file" class="dropify" data-default-file="{{isset($content_view['vertical_cover_image']['large'])?$content_view['vertical_cover_image']['large']:''}}" name="vertical_cover_image" data-max-file-size="2M" />
                           <span class="help-block"><small>Upload 580x380 size of image. We will take care of Thumbnails.</small></span>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                            <label for="behName1">Vertical Banner Image:</label>
                            <input type="file" class="dropify" data-default-file="{{isset($content_view['vertical_banner_image']['large'])?$content_view['vertical_banner_image']['large']:''}}" data-max-file-size="2M"  name="vertical_banner_image" />
                            <span class="help-block"><small>Upload 1255x610 size of image. We will take care of Thumbnails.</small></span>
                    </div>
                </div>   
                <div class="col-md-6">
                <div class="form-group">
                <label for="behName1">Special Cover Image* :</label>
                <input type="text" class="form-control" value="" name="alt_special_image" placeholder="Alt Text for Image"><br>
                <input type="file" class="dropify" data-default-file="" data-max-file-size="2M" name="cover_image_special" />
                <span class="help-block"><small>Upload 576x640 size of image. We will take care of Thumbnails.</small></span>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="behName1">Banner Image TV Apps* :</label>
                <input type="text" class="form-control" value="" name="alt_app_image" placeholder="Alt Text for Image"><br>
                <input type="file" class="dropify" data-default-file="" data-max-file-size="2M" name="tv_app_image" />
                <span class="help-block"><small>Upload 1280x548 size of image. We will take care of Thumbnails.</small></span>
                </div>
                </div>
                @if($catalog_details['slug'] == 'live-tv')
                <div class="col-md-12">
                <div class="col-md-6">
                <div class="form-group">
                <label for="behName1">Live TV Banner Image :</label>
                <input type="file" class="dropify" data-default-file="" data-max-file-size="2M" name="live_tv_banner" />
                <span class="help-block"><small>Upload 1280x548 size of image. We will take care of Thumbnails.</small></span>
                </div>
                </div>
                </div>
                @endif
                </div>
                <?php if(in_array($catalog_details['asset_type'], array('WATCH'))) { ?>
                <div class="col-md-6">
                    <div style="text-align:center;float:left;overflow:hidden;">
                        <div class="form-group">
                            <label for="decisions1">Opening Credits</label><br>
                            <input name="opening_credits[]" type="text" class="form-control">
                            <i class="mdi mdi-chevron-double-down"></i><br>
                            <input name="opening_credits[]" type="text" class="form-control">
                        </div>
                    </div>
                    <div style="text-align:center;float:right;overflow:hidden;">
                        <div class="form-group">
                            <label for="decisions1">End Credits</label><br>
                            <input name="end_credits[]" type="text" class="form-control">
                            <i class="mdi mdi-chevron-double-down"></i><br>
                            <input name="end_credits[]" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="col-md-6">
                <?php if(in_array($catalog_details['asset_type'], array('WATCH'))) { ?>
                    <div class="form-group">
                        <label for="decisions1">Promo File:</label>
                        <input name="promo_url" type="text" class="form-control">
                    </div>
               
                    <div class="form-group">
                        <label>Video File:</label>
                        <input name="video_url" type="text" class="form-control" {{$content_type == 'SHOW' || $content_type == 'SEASON'?'disabled':''}}>                       
                        <span class="help-block"><small>Only Promos can be uploaded for TV Show & Seasons</small></span>                        
                    </div>

                    <?php } else { ?>
                        <div class="form-group">
                            <label><?php echo $catalog_details['name'];?> File URL:</label>
                            <input name="video_url" type="text" class="form-control" {{$content_type == 'SHOW' || $content_type == 'SEASON'?'disabled':''}}>                       
                            <span class="help-block"><small></small></span>                        
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-6">
                <?php if(in_array($catalog_details['asset_type'], array('WATCH'))) { ?>
                    <div class="form-group">
                            <label for="wjobTitle2">SRT File :</label>
                            <div class="cast-box srt-html input-group m-t-10"> 
                                <input type="text" name="srt_lang[]" value="" class="form-control" placeholder="Language" style="width:50%"><input type="file" name="srt_link[]" class="form-control" placeholder="Link" value="" style="width:50%;float:left:"><span class="input-group-btn">
                                <button type="button" disabled class="btn waves-effect waves-light rem-cast" onclick="javascript:this.parentNode.parentNode.remove();"><i class="mdi mdi-minus-box"></i></button>
                                </span> 
                            </div>
                            <a href="javascript:;" onclick="add_cast_row(this)">Add Row</a>
                    </div>
                <?php } ?>
                </div>
                </div>
                </section>
                </form>
                </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
