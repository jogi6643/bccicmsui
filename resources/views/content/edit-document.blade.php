@extends('base')
@section('epic_content')
    <?php $type = isset($_GET['type']) ? $_GET['type'] : ''; ?>
    <?php error_reporting(E_ALL & ~E_NOTICE); ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- My add file -->
    <!-- Tiny MCE editor -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- include libraries(jQuery, bootstrap) -->
    <!-- summernote -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
                            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
    <!-- End summernote-->
    <!-- <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
                             <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
                              <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script> -->

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
                <li class="active"><a href="#">Upload Content</a></li>
                <!-- <li class="active"></li> -->
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <div class="modal-dialog modal-lg" style="width:100%">
        <div class="modal-content">
            <div class="modal-header upload" style="padding:5px 15px;">

                <h4 class="card-title head-title">Update Document</h4>
            </div>
            <div class="modal-body upload-body">
                <div class="row">
                    <div class="col-12">
                        <div class="white-box">
                            <div class="card-body wizard-content">

                                <h6 class="card-subtitle">Complete All the steps to Update</h6>
                                <label class="control-label">Asset Type</label>
                                <div class="">
                            <select class=" form-control" name="asset_type"
                                    id="asset_type" disabled>
                                    <option value="">Select</option>
                                    <option value="articles">Articles</option>
                                    <option value="photos">Photos</option>
                                    <option value="playlists">Playlists</option>
                                    <option value="videos">Videos</option>
                                    <option value="audio">Audio</option>
                                    <option value="promos">Promos</option>
                                    <option value="documents" selected>Documents</option>
                                    <option value="bios">Bios</option>
                                    </select>
                                </div>
                                <!--  -->
                                @include('show_message')

                                <form action="{{ url('updatedoc') }}" name="doc_form" id="doc_form" method="post"
                                    enctype="multipart/form-data" class="validation-wizard wizard-circle">
                                    <!-- Step 1 -->
                                    {{ csrf_field() }}
                                    <button type="button" id="collapsesidebar-btn" class="collapse-btn">
                                        <span>
                                            <!-- <i class="mdi mdi-chevron-right fa-fw" data-icon="v"></i> --> Collapse
                                            sidebar
                                        </span>
                                    </button>
                                    <h6>Basic Info</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wfirstName2"> Headline*:</label>
                                                    <input type="text" class="form-control text-case"
                                                        value="{{ old('title', $edit_data['title'] ?? '') }}"
                                                        name="title">
                                                    <input type="hidden" name="ID"
                                                        value="{{ old('ID', $edit_data['ID']) }}">
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

                                                                <input type="text" name="titleUrlSegment"
                                                                    onfocusout="save_url();"
                                                                    value="{{ old('url_segment', $edit_data['url_segment'] ?? '') }}"
                                                                    readonly="readonly">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                                                <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                                            </div> -->
                                            <div class="col-md-6 clear-b">
                                                <div class="form-group">
                                                    <label for="">Language </label>
                                                    <select class="form-control"  name="language">
                                                            @foreach ($language as $key  => $value)
                                                                <option value="{{ $key }}" {{ $edit_data['language'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    <!-- <input type="text" id="language" name="language" value="{{ old('language', $edit_data['language'] ?? '') }}"> -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Status </label>
                                                    <select name="current_status" id="cars" class="form-control">
                                                    <option value="">Select Status</option>
                                                    @foreach ($status as $key  => $value)
                                                        <option value="{{ $key }}" {{ $edit_data['status'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                                    @endforeach
                                                    </select>
                                                </div> 
                                            </div>
                                            <div class="col-md-6 clear-b">
                                                <div class="form-group">
                                                    <label for="myfile">Upload new file</label>
                                                    <input type="file" id="myfile" class="dropify" name="doc_url"
                                                        value="{{ old('doc_url', $edit_data['doc_url'] ?? '') }}" data-default-file="{{ $edit_data['doc_url'] ?? '' }}">
                                                    <!-- <label for="myfile">Download File</label> -->
                                                    <br />
                                                    <label for="myfile">Download File Link</label>
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="myfile">Platform*:</label>
                                                    <select class="form-control valid" required="" name="platform"
                                                        id="platform">
                                                        <!-- <option value="">Select</option> -->
                                                        <option value="domestic">Domestic</option>
                                                        <option value="international">International</option>
                                                        <option value="ipl">Ipl</option>
                                                    </select>
                                                    <!-- <input type="text" name="photo_platform" class="form-control" value="" required=""> -->
                                                    <p class=""></p>
                </div>
            </div>
            <div class="
                                                        col-md-12">
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
                                            </div>
                                            <!-- </div> -->
                                    </section>
                                    <!-- Dynamic Tab -->
                                    <h6>Meta Information</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wemailAddress2"> Short Description*:</label>
                                                    <textarea class="form-control" id="short_description"
                                                        name="short_description"
                                                        rows="3" required>{{ old('short_description', $edit_data['short_description'] ?? '') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wemailAddress2"> Summary*:</label>
                                                    <textarea class="form-control" id="summary" name="summary" required
                                                        rows="3">{{ old('summary', $edit_data['summary'] ?? '') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wemailAddress2"> Description*:</label>
                                                    <textarea class="form-control" id="description" name="description"
                                                        rows="3">{{ old('description', $edit_data['description'] ?? '') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label for="wfirstName2">Publish Date:</label>
                                                        <input type="date" class="form-control dtpicker"
                                                            value="{{ $publishdate ?? '' }}"
                                                            name="publish_date">
                                                        <input type="time" class="form-control tmpicker" value="{{ $publishtime ?? '' }}"  name="publish_time">
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label for="wfirstName2">Expiry Date:</label>
                                                        <input type="date" class="form-control dtpicker"
                                                            value="{{ $expiredate ?? '' }}"
                                                            name="expiryDate">
                                                        <input type="time" class="form-control tmpicker" value="{{ $expiretime ?? '' }}" name="expiryTime">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Match Formats</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('match_formats', $edit_data['match_formats'] ?? '') }}"
                                                        name="match_formats">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Published By</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('published_by', $edit_data['published_by'] ?? '') }}"
                                                        name="published_by">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Meta languages</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('meta_languages', $edit_data['meta_languages'] ?? '') }}"
                                                        name="meta_languages">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Assest type</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('assest_type', $edit_data['assest_type'] ?? '') }}"
                                                        name="assest_type">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- <label for="behName1">Expiry Date</label>
                                                    <input type="date" class="form-control "
                                                        value="{{ old('expiry_date', $edit_data['expiry_date'] ?? '') }}"
                                                        name="expiry_date"> -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1"> Content Type</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('content_type', $edit_data['content_type'] ?? '') }}"
                                                        name="content_type">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- End Dynamic Tab -->
                                    <!-- Step 2 -->
                                    <h6>Update</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6" style="margin-bottom: 10px;">
                                                <div class="form-group">
                                                    <label for="behName1">Current status:</label>
                                                    <select name="current_status" id="cars" class="form-control">
                                                        <option value="">Select value</option>
                                                            @foreach ($status as $key  => $value)
                                                                <option value="{{ $key }}" {{ $edit_data['currentstatus'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                                            @endforeach
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- <label for="behName1">Last Updated</label>
                                                    <input type="date" class="form-control"
                                                        value="{{ old('last_updated', $edit_data['last_updated'] ?? '') }}"
                                                        name="last_updated"> -->
                                                </div>
                                            </div>
                                            <div class="col-md-6 clear-b">
                                                <div class="form-group">
                                                    <label for="behName1">keywords</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('keywords', $edit_data['keywords'] ?? '') }}"
                                                        name="keywords">
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1" class="fullwidth">Location Search :</label>
                                                    <button type="button" class="location-search">Search</button>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Location</label>
                                                    <input type="text" class="form-control" readonly
                                                        value="{{ old('location', $edit_data['location'] ?? '') }}"
                                                        name="location">
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Location label:</label>
                                                    <input type="text" class="form-control" readonly
                                                        value="{{ old('location_label', $edit_data['location_label'] ?? '') }}"
                                                        name="location_label">
                                                </div>
                                            </div> -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Location Search :</label>
                                                    <input type="text" name="documentslocationsearch" id="documentslocationsearch" class="form-control" placeholder="Choose Location" value="{{ $edit_data['location'] }}">
                                                    <!-- <input type="text" id="latitudeplaylist" name="latitudeplaylist" class="form-control" value="{{ $edit_data['latitude'] }}" readonly> -->
                                                    <!-- <input type="text" class="form-control" value="{{ old('location_search', $edit_data['location_search'] ?? '') }}" name="location_search"> -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Latitude :</label>
                                                    <input type="text" id="latitudedocuments" name="latitudedocuments" class="form-control" value="{{ $edit_data['latitude'] }}" readonly>
                                                    <!-- <input type="text" class="form-control" readonly
                                                        value="{{ old('latitude', $edit_data['latitude'] ?? '') }}"
                                                        name="latitude"> -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Longitude:</label>
                                                    <input type="text" id="longitudedocuments" name="longitudedocuments" class="form-control" value="{{ $edit_data['latitude'] }}" readonly>
                                                    <!-- <input type="text" class="form-control" readonly
                                                        value="{{ old('longitude', $edit_data['longitude'] ?? '') }}"
                                                        name="longitude"> -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Keywords:</label>
                                                    <input type="text" class="form-control tagsinput"
                                                        value="{{ old('metadata', $edit_data['metadata'] ?? '') }}"
                                                        name="metadata">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 3 -->
                                    <!-- <h6>Regions</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="shortDescription3">Regions*:</label>
                                                    <select id="regions_to_select" class="select2 m-b-10 select2-multiple " style="width:100%"  name="regions[]"  data-style="form-control" multiple>

                                                        <option value="IN" selected>India</option>
                                                        <option value="ROW" selected>Rest of the World</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </section> -->
                                    <!-- <h6>Collapse &amp; Crew</h6>
                                <section>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="wjobTitle2">Collapse &amp; slider :</label>
                                                <label class="form-group">
                                                    Content references
                                                </label>
                                                <div class="form-group">
                                                    <label for="Selecttype"> Select type*:</label>
                                                    <select class="reference-search__type-select js-type-select ng-pristine ng-valid ng-not-empty ng-valid-parse ng-touched" data-ng-change="typeSelect( selectType )" data-ng-model="selectType" data-ignore-dirty="" style="">
                                                        <option selected="selected">Select type</option>
                                                        <option value="TEXT" >TEXT</option>
                                                        <option value="PHOTO" >PHOTO</option>
                                                        <option value="VIDEO" >VIDEO</option>
                                                        <option value="AUDIO" >AUDIO</option>
                                                        <option value="DOCUMENT" >DOCUMENT</option>
                                                        <option value="PLAYLIST" >PLAYLIST</option>
                                                        <option value="PROMO" >PROMO</option>
                                                        <option value="LIVE_BLOG" >LIVE_BLOG</option>
                                                        <option value="BIO" >BIO</option>
                                                        <option value="CRICKET_TOURNAMENTGROUP" >CRICKET_TOURNAMENTGROUP</option>
                                                        <option value="CRICKET_TOURNAMENT" >CRICKET_TOURNAMENT</option>
                                                        <option value="CRICKET_MATCH" >CRICKET_MATCH</option>
                                                        <option value="CRICKET_TEAM" >CRICKET_TEAM</option>
                                                        <option value="CRICKET_SQUAD" >CRICKET_SQUAD</option>
                                                        <option value="CRICKET_PLAYER" >CRICKET_PLAYER</option>
                                                        <option value="CRICKET_VENUE" >CRICKET_VENUE</option>
                                                        <option value="EVENT" >EVENT</option>
                                                        <option value="EVENT_GROUP" >EVENT_GROUP</option>
                                                        <option value="FORM" >FORM</option>
                                                        <option value="QUIZ" >QUIZ</option>
                                                        <option value="OTHER" >OTHER</option>
                                                        <option value="REFERENCE_GROUP" >REFERENCE_GROUP</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="wfirstName2">Start typing to search by ID or name ...</label>
                                                    <input type="text" class="form-control" value="" placeholder="Start typing to search by ID or name ..." name="slug" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="wfirstName2"> <a href="#">Frequents added</a></label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="wfirstName2"> <a href="#">Recently Visited</a></label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="wfirstName2"> <a href="#">Favourites</a></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section> -->
                                    <!-- Step 4 -->
                                    <!-- <h6>Tags</h6>
                                <section>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Search tag* :</label>
                                                    <input type="text" class="form-control" value="" name="alt_cover_image" placeholder="Alt Text for Image">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="wfirstName2"> <a href="#">Frequents add</a></label>
                                            </div>
                                            <div class="form-group">
                                                <label for="wfirstName2"> <a href="#">Recently Visited</a></label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Select tag :-  :</label>
                                                    <select name="cars" id="cars">
                                                        <option value="Photo Type">Photo Type</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                </section> -->
                                    <!-- <h6>Related &amp; content</h6>
                                <section>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Search tag* :</label>
                                                    <input type="text" class="form-control" value="" name="alt_cover_image" placeholder="Alt Text for Image">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Select tag :-  :</label>
                                                    <select name="cars" id="cars">
                                                        <option value="Text">Text</option>
                                                        <option value="Photo">Photo</option>
                                                        <option value="Video">Video</option>
                                                        <option value="Document">Document</option>
                                                        <option value="PLAYLIST">PLAYLIST</option>
                                                        <option value="PROMO">PROMO</option>
                                                    </select>
                                                    <input type="text" class="form-control" value="" name="alt_cover_image" placeholder="Select a reference type to start your search">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="wfirstName2"> <a href="#">Frequents add </a></label>
                                            </div>
                                            <div class="form-group">
                                                <label for="wfirstName2"> <a href="#">Recently Visited</a></label>
                                            </div>
                                            <div class="form-group">
                                                <label for="wfirstName2"> <a href="#">Favourites</a></label>
                                            </div>
                                        </div>
                                </section> -->
                                    <div id="collapsingsidebar" class="collapssidebar">
                                       @include('releted_references.edit-content-reference');
                                    </div>
                                </form>


                                <input class="save_content_draft btn btn-primary" type="button" style="float:right;"
                                    value="Draft" name="draft_btn"></button>

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
    <div class="modal fade" id="finish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <h3 class="modal-title" id="exampleModalLongTitle">Data has been save successfully</h5>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Submit</button> -->
                    </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDetZZwXV4c_mQULaCiJLJvT8Z_XYhfQbI&libraries=places"></script>
    <script src="{{ asset('js/document/documentlist.js') }}" type="text/javascript"></script>
   <script src="{{ asset('js/content_refernce/content_refernce.js') }}" type="text/javascript"></script> 
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropify').dropify();
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

    </script>


    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#documents button#collapsesidebar-btn").click(function() {
                $('#documents #collapsingsidebar').toggleClass("collapse-deactive");
                $('#documents section.body').toggleClass("collapse-deactive");
                $("#documents button#collapsesidebar-btn").text(function(i, v) {
                    return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
                });
            });
        });
    </script>

@stop
