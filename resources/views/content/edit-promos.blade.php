@extends('base')
@section('epic_content')

    <?php $type = isset($_GET['type']) ? $_GET['type'] : ''; ?>
    <?php error_reporting(E_ALL & ~E_NOTICE); ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style type="text/css">
        .modal-title {
            margin: 0;
            line-height: 1.42857143;
            text-align: center;
            color: #1a457d;
            font-weight: 400;
        }

    </style>
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
    <?php
    //pr($edit_data);die;
    ?>

    <div class="modal-dialog modal-lg" style="width:100%">
        <div class="modal-content">
            <div class="modal-header upload" style="padding:5px 15px;">
                <h4 class="card-title head-title">Update Promo</h4>
            </div>
            <div class="modal-body upload-body">
                <div class="row">
                    <div class="col-12">
                        <div class="white-box">
                            <div class="card-body wizard-content">

                                <h6 class="card-subtitle">Complete All the steps to update</h6>
                                <label class="control-label">Asset Type</label>
                                <div class="">
                                <select class=" form-control"
                                    name="asset_type" id="asset_type" disabled>
                                    <option value="">Select</option>
                                    <option value="articles">Articles</option>
                                    <option value="photos">Photos</option>
                                    <option value="playlists">Playlists</option>
                                    <option value="videos">Videos</option>
                                    <option value="audio">Audio</option>
                                    <option value="promos" selected>Promos</option>
                                    <option value="documents">Documents</option>
                                    <option value="bios">Bios</option>
                                    </select>
                                </div>
                                <!--  -->
                                @include('show_message')

                                <form action="{{ url('contentList/updatePromos') }}" name="video_form" id="video_form"
                                    method="POST" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                                    <!-- Step 1 -->
                                    @csrf
                                    <button type="button" id="collapsesidebar-btn" class="collapse-btn">
                                        <span>
                                            <!-- <i class="mdi mdi-chevron-right fa-fw" data-icon="v"></i> --> Collapse
                                            sidebar
                                        </span>
                                    </button>
                                    <h6>Basic Info</h6>
                                    <section>
                                        <input type="hidden" name="ID"
                                            value="{{ isset($edit_data['ID']) ? $edit_data['ID'] : $edit_data['promo_id'] }}">
                                        <input type="hidden" name="promo_id"
                                            value="{{ isset($edit_data['ID']) ? $edit_data['ID'] : $edit_data['promo_id'] }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wfirstName2"> Name*</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('name', $edit_data['name'] ?? '') }}" name="name" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wfirstName2"> Headline*</label>
                                                    <input type="text"  id="headline_promos" required class="form-control"
                                                        value="{{ old('title', $edit_data['title'] ?? '') }}"
                                                        name="title">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="wfirstName2">URL Segment</label>
                                                    <input type="text" id="urlsegment_promos" class="form-control"
                                                        value="{{ old('titleslug', $edit_data['titleslug'] ?? '') }}"
                                                        name="titleslug">
                                                </div>
                                            </div>

                                            <div class="col-md-6" style="padding-top: 25px">
                                                <div class="form-group">
                                                    <label for="wemailAddress2"> Summary</label>
                                                    <textarea class="form-control" name="description"
                                                        rows="9">{{ old('description', $edit_data['description'] ?? '') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding-top: 25px">
                                                <div class="form-group">
                                                    <label for="myfile">Add Promo*:</label>
                                                    <input type="file" class="dropify" id="" name="" required>
                                                </div>
                                            </div>
                                    <!--

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wlastName2">Link URL</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('promo_url', $edit_data['promo_url'] ?? '') }}"
                                                        name="promo_url">
                                                </div>
                                            </div>-->

                

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wlastName2"> Hot Link URL</label>
                                                    <input type="text" class="form-control" value="" name="">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wlastName2">Link text</label>
                                                    <input type="text" class="form-control  " value="" name="">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                    <label class="
                                                    control-label">Status*</label>
                                                    <select class="
                                                        form-control" required name="current_status">
                                                        <option value="">Select value</option>
                                                            @foreach ($status as $key  => $value)
                                                                <option value="{{ $key }}" {{ $edit_data['current_status'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                                            @endforeach
                                                   </select>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="">
                                                <label class="
                                                    control-label">Language*</label>
                                                    <div class="">
                                                    <select class="
                                                        form-control" required name="language">
                                                        @foreach ($language as $key  => $value)
                                                                <option value="{{ $key }}" {{ $edit_data['language'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-25">
                                                <div class="form-group">
                                                    <label for="myfile">Platform*:</label>
                                                    <select class="form-control" required="" name="platform"
                                                        id="platform">
                                                        <option value="all">All</option> 
                                                        <option value="domestic">BCCI - Domestic</option>
                                                        <option value="international">BCCI - International</option>
                                                        <option value="ipl">IPL</option>
                                                    </select>
                                                    <!-- <input type="text" name="photo_platform" class="form-control" value="" required=""> -->
                                                    <p class=""></p>
                                                </div>
                                            </div>    
                                        

                                    </section>
                                    <!-- Dynamic Tab -->
                                    <h6>Meta Information</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="wfirstName2"> Tracking ID</label>
                                                    <input type="text" class="form-control" value="" name="">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label for="wfirstName2">Publish Date:</label>
                                                        <input type="date" class="form-control dtpicker"
                                                            value="{{ $publishdate ?? '' }}"
                                                            name="publish_date">
                                                        <input type="time" class="form-control tmpicker" value="{{ $publishtime ?? '' }}"  name="publish_time" >

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wlastName2" class="fullwidth"> Expiry date*</label>
                                                    <input type="date" class="form-control dtpicker"
                                                            value="{{ $expiredate ?? '' }}"
                                                            name="expiryDate" required>
                                                    <input type="time" class="form-control tmpicker" value="{{ $expiretime ?? '' }}" name="expiryTime">
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="wlastName2"> Display Time</label>
                                                                    
                                                                </div>
                                                            </div>-->

                                            <!--                
                                            <div class="col-md-6" style="margin-top: 25px;">

                                                <div class="form-group">
                                                    <label for="behName1" class="fullwidth">Location Search :</label>
                                                    <button type="button" class="location-search">Search</button>
                                                </div>

                                            </div> -->

                                            <div class="col-md-6" style="margin-top: 25px;">
                                                <div class="form-group">
                                                    <label for="behName1">Location Search : </label>
                                                    <input type="text" name="promoslocationsearch" id="promoslocationsearch" class="form-control" placeholder="Choose Location" value="{{ $edit_data['location'] }}">
                                                    <!-- <input type="text" class="form-control"
                                                        value="{{ old('location_search', $edit_data['location_search'] ?? '') }}"
                                                        name="location_search"> -->
                                                </div>
                                            </div>

                                            <!--
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="behName1">Location label:</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('location_label', $edit_data['location_label'] ?? '') }}"
                                                        name="location_label">
                                                </div>

                                            </div>-->



                                            <div class="col-md-6 clear-b" >
                                                <div class="form-group">
                                                    <label for="behName1">Latitude</label>
                                                    <input type="text" id="latitudepromos" name="latitudepromos" class="form-control" value="{{ $edit_data['latitude'] }}" readonly>
                                                    <!-- <input type="text" class="form-control"
                                                        value="{{ old('latitude', $edit_data['latitude'] ?? '') }}"
                                                        name="latitude"> -->
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label for="behName1">Longitude</label>
                                                    <input type="text" name="longitudepromos" id="longitudepromos" class="form-control" readonly value="{{ $edit_data['longitude'] }}">
                                                    <!-- <input type="text" class="form-control"
                                                        value="{{ old('longitude', $edit_data['longitude'] ?? '') }}"
                                                        name="longitude"> -->
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="behName1">keywords</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('metadata', $edit_data['metadata'] ?? '') }}"
                                                        name="metadata" value="" data-role="tagsinput">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h6>Route restrictions</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6" style="margin-bottom: 10px;">
                                                <div class="form-group checkbox-al">
                                                    <input type="checkbox" id="restrict" name="restrict" value="Bike">
                                                    <label for="vehicle1"> Restrict content to logged in users</label><br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-right-content form-group geo-blocking">
                                                            <h3>Geo Blocking </h3>
                                                            <!-- <input type="checkbox" id="select_all" name="select_all" value="Select all"> -->
                                                            <!-- <label for="select_all">Select all</label><br> -->

                                                            <label for="shortDescription3">Custom Select country</label>
                                                            <!-- <label class="control-label"></label> -->
                                                            <select class="selectpicker form-control" multiple
                                                                data-actions-box="true">
                                                                <!-- <option>select country</option> -->
                                                                <option value="AF">Afghanistan</option>
                                                                <option value="AX">Aland Islands</option>
                                                                <option value="AL">Albania</option>
                                                                <option value="DZ">Algeria</option>
                                                                <option value="AS">American Samoa</option>
                                                                <option value="AD">Andorra</option>
                                                                <option value="AO">Angola</option>
                                                                <option value="AI">Anguilla</option>
                                                                <option value="AQ">Antarctica</option>
                                                                <option value="AG">Antigua and Barbuda</option>
                                                                <option value="AR">Argentina</option>
                                                                <option value="AM">Armenia</option>
                                                                <option value="AW">Aruba</option>
                                                                <option value="AU">Australia</option>
                                                                <option value="AT">Austria</option>
                                                                <option value="AZ">Azerbaijan</option>
                                                                <option value="BS">Bahamas</option>
                                                                <option value="BH">Bahrain</option>
                                                                <option value="BD">Bangladesh</option>
                                                                <option value="BB">Barbados</option>
                                                                <option value="BY">Belarus</option>
                                                                <option value="BE">Belgium</option>
                                                                <option value="BZ">Belize</option>
                                                                <option value="BJ">Benin</option>
                                                                <option value="BM">Bermuda</option>
                                                                <option value="BT">Bhutan</option>
                                                                <option value="BO">Bolivia</option>
                                                                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                                <option value="BA">Bosnia and Herzegovina</option>
                                                                <option value="BW">Botswana</option>
                                                                <option value="BV">Bouvet Island</option>
                                                                <option value="BR">Brazil</option>
                                                                <option value="IO">British Indian Ocean Territory</option>
                                                                <option value="BN">Brunei Darussalam</option>
                                                                <option value="BG">Bulgaria</option>
                                                                <option value="BF">Burkina Faso</option>
                                                                <option value="BI">Burundi</option>
                                                                <option value="KH">Cambodia</option>
                                                                <option value="CM">Cameroon</option>
                                                                <option value="CA">Canada</option>
                                                                <option value="CV">Cape Verde</option>
                                                                <option value="KY">Cayman Islands</option>
                                                                <option value="CF">Central African Republic</option>
                                                                <option value="TD">Chad</option>
                                                                <option value="CL">Chile</option>
                                                                <option value="CN">China</option>
                                                                <option value="CX">Christmas Island</option>
                                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                                <option value="CO">Colombia</option>
                                                                <option value="KM">Comoros</option>
                                                                <option value="CG">Congo</option>
                                                                <option value="CD">Congo, Democratic Republic of the Congo
                                                                </option>
                                                                <option value="CK">Cook Islands</option>
                                                                <option value="CR">Costa Rica</option>
                                                                <option value="CI">Cote D'Ivoire</option>
                                                                <option value="HR">Croatia</option>
                                                                <option value="CU">Cuba</option>
                                                                <option value="CW">Curacao</option>
                                                                <option value="CY">Cyprus</option>
                                                                <option value="CZ">Czech Republic</option>
                                                                <option value="DK">Denmark</option>
                                                                <option value="DJ">Djibouti</option>
                                                                <option value="DM">Dominica</option>
                                                                <option value="DO">Dominican Republic</option>
                                                                <option value="EC">Ecuador</option>
                                                                <option value="EG">Egypt</option>
                                                                <option value="SV">El Salvador</option>
                                                                <option value="GQ">Equatorial Guinea</option>
                                                                <option value="ER">Eritrea</option>
                                                                <option value="EE">Estonia</option>
                                                                <option value="ET">Ethiopia</option>
                                                                <option value="FK">Falkland Islands (Malvinas)</option>
                                                                <option value="FO">Faroe Islands</option>
                                                                <option value="FJ">Fiji</option>
                                                                <option value="FI">Finland</option>
                                                                <option value="FR">France</option>
                                                                <option value="GF">French Guiana</option>
                                                                <option value="PF">French Polynesia</option>
                                                                <option value="TF">French Southern Territories</option>
                                                                <option value="GA">Gabon</option>
                                                                <option value="GM">Gambia</option>
                                                                <option value="GE">Georgia</option>
                                                                <option value="DE">Germany</option>
                                                                <option value="GH">Ghana</option>
                                                                <option value="GI">Gibraltar</option>
                                                                <option value="GR">Greece</option>
                                                                <option value="GL">Greenland</option>
                                                                <option value="GD">Grenada</option>
                                                                <option value="GP">Guadeloupe</option>
                                                                <option value="GU">Guam</option>
                                                                <option value="GT">Guatemala</option>
                                                                <option value="GG">Guernsey</option>
                                                                <option value="GN">Guinea</option>
                                                                <option value="GW">Guinea-Bissau</option>
                                                                <option value="GY">Guyana</option>
                                                                <option value="HT">Haiti</option>
                                                                <option value="HM">Heard Island and Mcdonald Islands</option>
                                                                <option value="VA">Holy See (Vatican City State)</option>
                                                                <option value="HN">Honduras</option>
                                                                <option value="HK">Hong Kong</option>
                                                                <option value="HU">Hungary</option>
                                                                <option value="IS">Iceland</option>
                                                                <option value="IN">India</option>
                                                                <option value="ID">Indonesia</option>
                                                                <option value="IR">Iran, Islamic Republic of</option>
                                                                <option value="IQ">Iraq</option>
                                                                <option value="IE">Ireland</option>
                                                                <option value="IM">Isle of Man</option>
                                                                <option value="IL">Israel</option>
                                                                <option value="IT">Italy</option>
                                                                <option value="JM">Jamaica</option>
                                                                <option value="JP">Japan</option>
                                                                <option value="JE">Jersey</option>
                                                                <option value="JO">Jordan</option>
                                                                <option value="KZ">Kazakhstan</option>
                                                                <option value="KE">Kenya</option>
                                                                <option value="KI">Kiribati</option>
                                                                <option value="KP">Korea, Democratic People's Republic of
                                                                </option>
                                                                <option value="KR">Korea, Republic of</option>
                                                                <option value="XK">Kosovo</option>
                                                                <option value="KW">Kuwait</option>
                                                                <option value="KG">Kyrgyzstan</option>
                                                                <option value="LA">Lao People's Democratic Republic</option>
                                                                <option value="LV">Latvia</option>
                                                                <option value="LB">Lebanon</option>
                                                                <option value="LS">Lesotho</option>
                                                                <option value="LR">Liberia</option>
                                                                <option value="LY">Libyan Arab Jamahiriya</option>
                                                                <option value="LI">Liechtenstein</option>
                                                                <option value="LT">Lithuania</option>
                                                                <option value="LU">Luxembourg</option>
                                                                <option value="MO">Macao</option>
                                                                <option value="MK">Macedonia, the Former Yugoslav Republic of
                                                                </option>
                                                                <option value="MG">Madagascar</option>
                                                                <option value="MW">Malawi</option>
                                                                <option value="MY">Malaysia</option>
                                                                <option value="MV">Maldives</option>
                                                                <option value="ML">Mali</option>
                                                                <option value="MT">Malta</option>
                                                                <option value="MH">Marshall Islands</option>
                                                                <option value="MQ">Martinique</option>
                                                                <option value="MR">Mauritania</option>
                                                                <option value="MU">Mauritius</option>
                                                                <option value="YT">Mayotte</option>
                                                                <option value="MX">Mexico</option>
                                                                <option value="FM">Micronesia, Federated States of</option>
                                                                <option value="MD">Moldova, Republic of</option>
                                                                <option value="MC">Monaco</option>
                                                                <option value="MN">Mongolia</option>
                                                                <option value="ME">Montenegro</option>
                                                                <option value="MS">Montserrat</option>
                                                                <option value="MA">Morocco</option>
                                                                <option value="MZ">Mozambique</option>
                                                                <option value="MM">Myanmar</option>
                                                                <option value="NA">Namibia</option>
                                                                <option value="NR">Nauru</option>
                                                                <option value="NP">Nepal</option>
                                                                <option value="NL">Netherlands</option>
                                                                <option value="AN">Netherlands Antilles</option>
                                                                <option value="NC">New Caledonia</option>
                                                                <option value="NZ">New Zealand</option>
                                                                <option value="NI">Nicaragua</option>
                                                                <option value="NE">Niger</option>
                                                                <option value="NG">Nigeria</option>
                                                                <option value="NU">Niue</option>
                                                                <option value="NF">Norfolk Island</option>
                                                                <option value="MP">Northern Mariana Islands</option>
                                                                <option value="NO">Norway</option>
                                                                <option value="OM">Oman</option>
                                                                <option value="PK">Pakistan</option>
                                                                <option value="PW">Palau</option>
                                                                <option value="PS">Palestinian Territory, Occupied</option>
                                                                <option value="PA">Panama</option>
                                                                <option value="PG">Papua New Guinea</option>
                                                                <option value="PY">Paraguay</option>
                                                                <option value="PE">Peru</option>
                                                                <option value="PH">Philippines</option>
                                                                <option value="PN">Pitcairn</option>
                                                                <option value="PL">Poland</option>
                                                                <option value="PT">Portugal</option>
                                                                <option value="PR">Puerto Rico</option>
                                                                <option value="QA">Qatar</option>
                                                                <option value="RE">Reunion</option>
                                                                <option value="RO">Romania</option>
                                                                <option value="RU">Russian Federation</option>
                                                                <option value="RW">Rwanda</option>
                                                                <option value="BL">Saint Barthelemy</option>
                                                                <option value="SH">Saint Helena</option>
                                                                <option value="KN">Saint Kitts and Nevis</option>
                                                                <option value="LC">Saint Lucia</option>
                                                                <option value="MF">Saint Martin</option>
                                                                <option value="PM">Saint Pierre and Miquelon</option>
                                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                                <option value="WS">Samoa</option>
                                                                <option value="SM">San Marino</option>
                                                                <option value="ST">Sao Tome and Principe</option>
                                                                <option value="SA">Saudi Arabia</option>
                                                                <option value="SN">Senegal</option>
                                                                <option value="RS">Serbia</option>
                                                                <option value="CS">Serbia and Montenegro</option>
                                                                <option value="SC">Seychelles</option>
                                                                <option value="SL">Sierra Leone</option>
                                                                <option value="SG">Singapore</option>
                                                                <option value="SX">Sint Maarten</option>
                                                                <option value="SK">Slovakia</option>
                                                                <option value="SI">Slovenia</option>
                                                                <option value="SB">Solomon Islands</option>
                                                                <option value="SO">Somalia</option>
                                                                <option value="ZA">South Africa</option>
                                                                <option value="GS">South Georgia and the South Sandwich Islands
                                                                </option>
                                                                <option value="SS">South Sudan</option>
                                                                <option value="ES">Spain</option>
                                                                <option value="LK">Sri Lanka</option>
                                                                <option value="SD">Sudan</option>
                                                                <option value="SR">Suriname</option>
                                                                <option value="SJ">Svalbard and Jan Mayen</option>
                                                                <option value="SZ">Swaziland</option>
                                                                <option value="SE">Sweden</option>
                                                                <option value="CH">Switzerland</option>
                                                                <option value="SY">Syrian Arab Republic</option>
                                                                <option value="TW">Taiwan, Province of China</option>
                                                                <option value="TJ">Tajikistan</option>
                                                                <option value="TZ">Tanzania, United Republic of</option>
                                                                <option value="TH">Thailand</option>
                                                                <option value="TL">Timor-Leste</option>
                                                                <option value="TG">Togo</option>
                                                                <option value="TK">Tokelau</option>
                                                                <option value="TO">Tonga</option>
                                                                <option value="TT">Trinidad and Tobago</option>
                                                                <option value="TN">Tunisia</option>
                                                                <option value="TR">Turkey</option>
                                                                <option value="TM">Turkmenistan</option>
                                                                <option value="TC">Turks and Caicos Islands</option>
                                                                <option value="TV">Tuvalu</option>
                                                                <option value="UG">Uganda</option>
                                                                <option value="UA">Ukraine</option>
                                                                <option value="AE">United Arab Emirates</option>
                                                                <option value="GB">United Kingdom</option>
                                                                <option value="US">United States</option>
                                                                <option value="UM">United States Minor Outlying Islands</option>
                                                                <option value="UY">Uruguay</option>
                                                                <option value="UZ">Uzbekistan</option>
                                                                <option value="VU">Vanuatu</option>
                                                                <option value="VE">Venezuela</option>
                                                                <option value="VN">Viet Nam</option>
                                                                <option value="VG">Virgin Islands, British</option>
                                                                <option value="VI">Virgin Islands, U.s.</option>
                                                                <option value="WF">Wallis and Futuna</option>
                                                                <option value="EH">Western Sahara</option>
                                                                <option value="YE">Yemen</option>
                                                                <option value="ZM">Zambia</option>
                                                                <option value="ZW">Zimbabwe</option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <!-- <label for="wlastName2"> Photo editor*:</label> -->
                                                            <input type="hidden" value="test_data" class="form-control"
                                                                value="{{ old('photo_editor', $edit_data['photo_editor'] ?? '') }}"
                                                                name="photo_editor">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <!-- <label for="wlastName2"> Display date*:</label> -->
                                                            <input type="hidden" value="display"
                                                                class="form-control  datepicker"
                                                                value="{{ old('display_date', $edit_data['display_date'] ?? '') }}"
                                                                name="display_date">
                                                        </div>
                                                    </div>

                                        </div>
                                            
                                    </section>

                                    <div id="collapsingsidebar" class="collapssidebar">
                                       @include('releted_references.edit-content-reference');
                                    </div>

                                    <div class="modal fade" id="Favourites_model" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="width: 60%; margin: 0 auto;">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h2>Click the add button to attach the content reference</h2>
                                                <select class="form-control selectpicker" id="browsers"
                                                    data-live-search="true" multiple data-actions-box="true"
                                                    data-live-search="true" data-show-subtext="true">
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
    <!-- Modal -->
    <!-- <script src="http://local.bcci_cms.com/js/promos/promos.js" type="text/javascript"></script> -->
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDetZZwXV4c_mQULaCiJLJvT8Z_XYhfQbI&libraries=places"></script> 
    <script src="{{ asset('js/promos/promos.js') }}" type="text/javascript"></script>                                                                          
            <script src="{{ asset('js/content_refernce/content_refernce.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#video_form button#collapsesidebar-btn").click(function() {
                $('#video_form #collapsingsidebar').toggleClass("collapse-deactive");
                $('#video_form section.body').toggleClass("collapse-deactive");
                $("#video_form button#collapsesidebar-btn").text(function(i, v) {
                    return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
                });
            });

             $("#headline_promos").keypress(function() {
            var url = this.value;
            var urlsegment = url.replace(/\s+/g, '-').toLowerCase();
            $("#urlsegment_promos").val(urlsegment);
        })
           
        });
    </script>

    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        function editable_segment() {
            $('input[name="titleUrlSegment"]').removeAttr("readonly");
        }

        function save_url() {
            $('input[name="titleUrlSegment"]').attr("readonly", "readonly");
        }
    </script>
   



@stop
