<?php //echo "<pre>"; print_r($edit_data);exit;?>
@extends('base')
@section('epic_content')
<?php  $type = isset($_GET['type']) ? $_GET['type'] : ''; ?>
<?php error_reporting(E_ALL & ~E_NOTICE);?>
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
        <h4 class="page-title"></h4> </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li class="active"><a href="{{url('uploadcontent')}}">Upload Content</a></li>
            <!-- <li class="active"></li> -->
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<?php 
// pr($edit_data);die;

?>

<div class="modal-dialog modal-lg" style="width:100%">
        <div class="modal-content">
            <div class="modal-header upload" style="padding:5px 15px;">
                
                <h4 class="card-title head-title">Update Bios</h4>
            </div>
                <div class="modal-body upload-body">
                    <div class="row">
                    <div class="col-12">
                    <div class="white-box">
                    <div class="card-body wizard-content">
                    
                    <h6 class="card-subtitle">Complete All the steps to add new</h6>
                    <label class="control-label">Asset Type</label>
                        <div class="">
                            <select class="form-control" name="asset_type" id="asset_type" disabled >
                                <option value="">Select</option>
                                <option value="articles">Articles</option>
                                <option value="photos">Photos</option>
                                <option value="playlists">Playlists</option>
                                <option value="videos">Videos</option>
                                <option value="audio">Audio</option>
                                <option value="promos">Promos</option>
                                <option value="documents">Documents</option>
                                <option value="bios" selected>Bios</option>
                            </select>
                        </div>
                        <!--  -->
                        @include('show_message')
<form action="{{route('updateBios')}}" method="POST" enctype="multipart/form-data" class="validation-wizard wizard-circle">
    <!-- Step 1 -->
    {{csrf_field()}}
    <button type="button" id="collapsesidebar-btn" class="collapse-btn">
        <span><!-- <i class="mdi mdi-chevron-right fa-fw" data-icon="v"></i> --> Collapse sidebar</span>
    </button>
    <h6>Basic Info</h6>
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> Title *</label>
                    <input type="text" class="form-control text-case" value="{{old('title',$edit_data['title'] ?? '')}}"  name="title" required>
                </div>
            </div>
            <input type="hidden" class="form-control" value="{{$edit_data['ID']}}"  name="ID">
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                    <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> URL Segment:</label>
                    <div class="input_field">
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" name="titleUrlSegment" onfocusout="save_url();"
                                    value="{{ old('titleUrlSegment', $edit_data['slug'] ?? '') }}"
                                    readonly>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn" onclick=" ();"><i
                                        class="glyphicon glyphicon-edit single_edit_icon" id="edit_field"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 clear-b">
                <div class="form-group">
                    <label for="myfile">Personal information</label>
                    <input type="text" class="form-control" value="{{old('short_description',$edit_data['short_description'] ?? '')}}"  name="short_description">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Know Name</label>
                    <input type="text" class="form-control" value="{{old('known_name',$edit_data['known_name'] ?? '')}}"  name="known_name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Surname</label>
                    <input type="text" class="form-control" value="{{old('surname',$edit_data['surname'] ?? '')}}"  name="surname">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">First name</label>
                    <input type="text" class="form-control" value="{{old('first_name',$edit_data['first_name'] ?? '')}}"  name="first_name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Nationality</label>
                    <input type="text" class="form-control" value="{{old('nationality',$edit_data['nationality'] ?? '')}}"  name="nationality">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Date of Birth</label>
                    <input type="date" class="form-control dtpicker" value="{{old('date_of_birth',$edit_data['date_of_birth'] ?? '')}}"  name="date_of_birth">
                    <input type="time" class="form-control tmpicker" value="" name="">
                </div>
            </div>
            <div class="col-md-6 clear-b">
                <div class="form-group">
                    <label for="">Date of Death</label>
                    <input type="date" class="form-control dtpicker" value="{{old('date_of_death',$edit_data['date_of_death'] ?? '')}}"  name="date_of_death">
                    <input type="time" class="form-control tmpicker" value="" name="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Place of Birth</label>
                    <input type="text" class="form-control" value="{{old('place_of_birth',$edit_data['place_of_birth'] ?? '')}}"  name="place_of_birth">
                </div>
            </div>
   
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Image:</label>
                    <input type="file" id="myfile" class="dropify" name="image_url" value="{{old('image_url', $edit_data['image_url']) }}" data-default-file="{{ $edit_data['image_url'] ?? '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="fullwidth" for="behName1">Location Search:</label>
                    <input type="text" id="bioslocationsearch" name="bioslocationsearch" placeholder="Choose Location">
                    <!-- <button type="button" class="location-search">Search</button> -->
                </div>
                <!-- <div class="form-group clear-b">
                    <label for="behName1">Location label:</label>
                    <input type="text" class="form-control" value="" name="match_id" readonly="">
                </div> -->
                <div class="form-group">
                    <label for="behName1">Longitude:</label>
                    <input type="text" id="latitudebios" name="latitudebios" readonly>
                    <!-- <input type="text" class="form-control" value="" name="latitude" readonly=""> -->
                </div>
            </div>

            <div class="col-md-6 clear-b">
                <div class="form-group">
                    <label for="behName1">Latitude :</label>
                    <input type="text" id="longitudebios" name="longitudebios" readonly>
                    <!-- <input type="text" class="form-control" value="" name="latitude" readonly=""> -->
                </div>                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Platforms*:</label>
                    <select class="form-control" required="" name="platform" id="platform">
                        <option value="all">All</option>
                        <option value="domestic">
                            Domestic</option>
                        <option value="international">
                            International</option>
                        <option value="ipl">
                            Ipl</option>
                    </select>
                </div>
            </div> 
             <div class="col-md-12">
            <div class="form-right-content form-group geo-blocking">
                    <h3>Geo Blocking </h3>
                <!-- <input type="checkbox" id="select_all" name="select_all" value="Select all"> -->
                     <!-- <label for="select_all">Select all</label><br> -->

                            <label for="shortDescription3">Custom Select country</label>
                                  <!-- <label class="control-label"></label> -->
                                    <select class="selectpicker form-control" multiple data-actions-box="true">
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
                                        <option value="CD">Congo, Democratic Republic of the Congo</option>
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
                                        <option value="KP">Korea, Democratic People's Republic of</option>
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
                                        <option value="MK">Macedonia, the Former Yugoslav Republic of</option>
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
                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
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
    <h6>Bio</h6>
    <section>
        <div class="row">
        <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Platform</label>
                    <input class="form-control" value="{{old('platform',$edit_data['platform'] ?? '')}}" id="platform" name="platform">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Slug</label>
                    <input class="form-control" value="{{old('slug',$edit_data['slug'] ?? '')}}" id="slug" name="slug">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Status</label>
                    <select name="current_status" class="form-control" id="current_status">
                    <option value="">Select value</option>
                         @foreach ($status as $key  => $value)
                            <option value="{{ $key }}" {{ $edit_data['current_status'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                        @endforeach
                        </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Language</label>
                    <select name="language" id="langauge" class="form-control">
                    @foreach ($language as $key  => $value)
                        <option value="{{ $key }}" {{ $edit_data['language'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                    @endforeach
                    </select>
                    <!-- <input class="form-control" value="{{old('langauge',$edit_data['langauge'] ?? '')}}" id="langauge" name="langauge"> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> Summary</label>
                    <input type="text" class="form-control" value="{{old('summary',$edit_data['summary'] ?? '')}}" name="summary">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> Display Date</label>
                    <input type="date" class="form-control dtpicker" value="{{old('display_date',$edit_data['display_date'] ?? '')}}" name="display_date">
                    <input type="time" class="form-control tmpicker" value="" name="">
                </div>
            </div>
            <div class="col-md-6 clear-b">
                <div class="form-group">
                    <label for="wfirstName2"> Town / City</label>
                    <input type="text" class="form-control" value="{{old('city',$edit_data['city'] ?? '')}}" name="city">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="wemailAddress2"> Content</label>
                    <textarea class="form-control" value="{{old('description',$edit_data['description'] ?? '')}}" id="description" name="description" rows="3" required>{{$edit_data['description']}}</textarea>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2"> Bio For</label>
                    <ol>
                        ngRepeat: reference in references -->
                        <!-- <li>
                            <button type="button" ></button>
                            <div>
                                <div>Mohammad Shami </div>
                                <div>
                                    <a data-cms-href="#"  target="_blank" href="cricket/players/edit/94">
                                        <span>CRICKET_PLAYER: 94</span>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <button type="button" ></button>
                            </div>
                        </li> -->
                        <!-- end ngRepeat: reference in references -->
                    <!-- </ol>
                </div>
            </div> -->
        </div>
    </section>
    <!-- End Dynamic Tab -->
    <!-- Step 2 -->
    <h6>Meta Info</h6>
    <section>
        <!-- <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Meta Information</label>
                    <label for="wemailAddress2"> Display date</label>
                    <input type="date" class="form-control" value="" name="">
                    <input type="time" class="form-control" value="" name="">
                </div>
            </div>
        </div> -->

        <div class="col-md-12">
            <div class="form-group">
                <label for="wemailAddress2"> Career information</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="wfirstName2"> Position</label>
                <input type="text" class="form-control" value="{{old('position',$edit_data['position'] ?? '')}}" name="position">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="wfirstName2"> Career Start Date</label>
                <input type="date" class="form-control dtpicker" value="{{old('career_start_date',$edit_data['career_start_date'] ?? '')}}" name="career_start_date">
                <input type="time" class="form-control tmpicker" value="" name="">
            </div>
        </div>
        <div class="col-md-6 clear-b">
            <div class="form-group">
                <label for="wfirstName2"> Career End Date</label>
                <input type="date" class="form-control dtpicker" value="{{old('career_end_date',$edit_data['career_end_date'] ?? '')}}" name="career_end_date">
                <input type="time" class="form-control tmpicker" value="" name="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="wfirstName2"> Publish Date</label>
                <input type="date" class="form-control dtpicker" value="{{old('publish_date',$edit_data['publish_date'] ?? '')}}" name="publish_date">
                <input type="time" class="form-control tmpicker" value="" name="">
            </div>
        </div>
        <div class="col-md-6 clear-b" style="padding-top:25px">
            <div class="form-group">
                <label for="wfirstName2" class="fullwidth"> Expiry Date</label>
                <input type="date" class="form-control dtpicker" value="{{old('publish_date',$edit_data['publish_date'] ?? '')}}" name="publish_date">
                <input type="time" class="form-control tmpicker" value="" name="">
            </div>
        </div>
        <div class="col-md-6" style="padding-top:25px">
            <div class="form-group">
                <label for="wfirstName2"> Asset type</label>
                <input type="text" class="form-control" value="{{old('asset_type',$edit_data['asset_type'] ?? '')}}" name="asset_type">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="wfirstName2"> Content type</label>
                <input type="text" class="form-control" value="{{old('content_type',$edit_data['content_type'] ?? '')}}" name="content_type" required>
            </div>
        </div>

        <!-- <div class="col-md-6">
            <div class="form-group">
                <label for="wemailAddress2"> Additional dates</label>
            </div>
            <div class="form-group">
                <label for="wfirstName2"> addDate</label>
                <input type="date" class="form-control" value="" name="">
            </div>
        </div> -->



        <!-- <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Meta Information</label>
                    <label for="wemailAddress2"> Display date</label>
                    <input type="date" class="form-control" value="" name="">
                    <input type="time" class="form-control" value="" name="">
                </div>
            </div>
        </div> -->

    </section>
    <!-- <h6>Segmentation</h6>
    <section>
        <div class="row">
            <div class="col-md-6" style="margin-bottom: 10px;">
                <div class="form-group">
                    <input type="checkbox" id="restrict" name="restrict" value="">
                    <label for="vehicle1"> Restrict content to logged in users</label><br>
                </div>
                </d
                iv>
            </div>
    </section> -->
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
    <!-- <h6>Collapse &amp; slider</h6>
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="wjobTitle2">Collapse &amp; slider :</label>
                    <label class="form-group">
                        Lead media
                    </label>
                    <div class="form-group">
                        <label for="Selecttype"> Select type*:</label>
                        <select name="content_type" id="cars">
                        <option value='{{$edit_data["platform"]}}'selected>{{$edit_data['platform']}}</option>
                            <option value="Photo">Photo</option>
                            <option value="Video">Video</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="wfirstName2"> Select a reference type to start your search*:</label>
                        <input type="text" class="form-control" value="" placeholder="Select a reference type to start your search" name="" >
                    </div>
                    <div class="form-group">
                        <input type="file" id="file" name="file[]" value="Bike">
                    </div>
                    <div class="form-group">
                        <label for="wfirstName2"> <a href="#">Frequents add</a></label>
                    </div>
                    <div class="form-group">
                        <label for="wfirstName2"> <a href="#">Recently Visited</a></label>
                    </div>
                    <div class="form-group">
                        <label for="wfirstName2"> <a href="#">Favourites</a></label>
                    </div>
                </div>
            </div>
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
                    <div class="form-group">
                        <input type="text" class="form-control" value="" placeholder="Select a reference type to start your search" name="" >
                    </div>
                    <div class="form-group">
                        <label for="wfirstName2"> <a href="#">Frequents add</a></label>
                    </div>
                    <div class="form-group">
                        <label for="wfirstName2"> <a href="#">Recently Visited</a></label>
                    </div>
                    <div class="form-group">
                        <label for="wfirstName2"> <a href="#">Favourites</a></label>
                    </div>
                     <div class="form-group">
                        <ol>
                           ngRepeat: reference in references -->
                            <!-- <li >
                                <button type="button"></button>
                                <div>
                                    <div>Mohammad Shami </div>
                                    <div>
                                        <a data-cms-href="#" target="_blank" href="cricket/players/edit/94">
                                            <span >CRICKET_PLAYER: 94</span>
                                            <span data-icon="external"></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="selected-references-new__item-right"> --> 
                                    <!-- ngIf: referenceLookup[ reference.id ].thumbnail -->
                                    <!-- ngIf: reference.referenceId && reference.status && canChangeStatus( reference ) -->
                                    <!-- <button type="button"></button>
                                </div>
                            </li> -->
                            <!-- end ngRepeat: reference in references -->
                        <!-- </ol>
                    </div> 
                </div>

            </div>
    </section> -->
    <!-- Step 4 -->
    <!-- <h6>Tags</h6>
    <section>
        <div class="row">
            <div class="col-md-12">
                <?php //if(in_array($catalog_details['asset_type'], array('WATCH'))) { ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Search tag* :</label>
                        <input type="text" class="form-control" value="" name="" placeholder="Alt Text for Image">
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
                        <select name="" id="cars">
                            <option value="Photo Type">Photo Type</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                         <label for="wfirstName2"> Replace image*:</label> -->
                        <!-- <input type="text" class="form-control" value="There are no tags within this tag group." readonly  name="">
                    </div>
                </div>
            </div>
    </section> --> 
    <!-- <h6>Related &amp; content</h6>
    <section>
        <div class="row">
            <div class="col-md-12">
                <?php //if(in_array($catalog_details['asset_type'], array('WATCH'))) { ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Search tag* :</label>
                        <input type="text" class="form-control" value="" name="" placeholder="Alt Text for Image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="behName1">Select tag :-  :</label>
                        <select name="" id="cars">
                            <option value="Text">Text</option>
                            <option value="Photo">Photo</option>
                            <option value="Video">Video</option>
                            <option value="Document">Document</option>
                        </select>
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

                <input class="save_content_draft btn btn-primary" type="button" style="float:right;" value="Draft" name="draft_btn"></button>

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
<div class="modal fade" id="finish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
<script src="{{ asset('js/content_refernce/content_refernce.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDetZZwXV4c_mQULaCiJLJvT8Z_XYhfQbI&libraries=places"></script>
<script src="{{ asset('js/bios/bioslist.js') }}" type="text/javascript"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

<!-- <script type="text/javascript">
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
    </script> -->
<!-- summernote css/js -->
<!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });
</script> -->
<script>
$( document ).ready(function() {   
$('.dropify').dropify(); 
    $("#steps-uid-0 button#collapsesidebar-btn").click(function(){ 
        $('#steps-uid-0 #collapsingsidebar').toggleClass("collapse-deactive");
        $('#steps-uid-0 section.body').toggleClass("collapse-deactive");
        $("#steps-uid-0 button#collapsesidebar-btn").text(function(i, v){
            return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
        });
    });
});

function getval(sel)
{

    var type= (sel.value);
        $.ajax({
            type: 'POST',
            url: '/GetBioContent',
            data: {
                "_token": "{{ csrf_token() }}",
                'type':type,
            },
            dataType: 'json',
            success: function (res){
                console.log(res);
                $('.refclass').selectpicker('refresh');
                $.each(res.data, function (index, value) {
                    // var option = '<option value='+value.ID+'><h2>'+value.title +'</h2></option>';
                    var option ='<option value='+value.ID+'><h2>'+value.title +'</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span></option>'
                    $('select.refclass').append(option);
                });
                
               },
        error: function (response) {
            return false;
        },
        complete: function(){
                   console.log('complete');
               }
        });
   
}

// Releted 
function getval1(sel)
    {
    var type1= (sel.value);
        if(type1!=undefined && type1!=null)
        {
            $.ajax({
                 type: "POST",
                 url: "/commonsearch",
                 data: {
                "_token": "{{ csrf_token() }}",
                'type':type1,
            },
            dataType: 'json',
                 success: function (res){
                  $.each(res.data, function (index, value) {
                    $('.contentClass1').selectpicker('refresh');
                      var option = '<option value='+value.ID+'><h2>'+value.title +'</h2> <span class="lan">'+value.language +'|'+ 'Last updated 31/08/2021</span> <span class="id">ID:'+value.ID+'</span></option>';
                      $('select.contentClass1').append(option);
                  });
                  console.log(res);
                 },
                 error: function(){
                     return false;
                 },
                 complete: function(){
                     console.log('complete');
                 }
            })
        }
       
      
    };
</script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('#ckeditor').ckeditor();
    });
</script>
<script src="https://cdn.tiny.cloud/1/5orxol55pinopywbk09yrbw1ryxu73rl6q0r6h29utlwe1s9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
    selector: '#description',
    // file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
    // edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
    // view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
    // insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
    // format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight | forecolor backcolor | removeformat' },
    // tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
    // table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
    // help: { title: 'Help', items: 'help' },
    plugins: 'fullscreen code undo redo lists link anchor table media mediaembed paste',
    menubar: false,
    // menubar: 'view tools',
    // toolbar: 'fullscreen code undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent'
    toolbar: 'fullscreen code | undo redo | cut copy paste pastetext | styleselect | bold italic underline removeformat | numlist bullist outdent indent | link anchor | table | media',
        audio_template_callback: function(data) {
            return '<audio controls>' + '\n<source src="' + data.source + '"' + (data.sourcemime ? ' type="' + data.sourcemime + '"' : '') + ' />\n' + (data.altsource ? '<source src="' + data.altsource + '"' + (data.altsourcemime ? ' type="' + data.altsourcemime + '"' : '') + ' />\n' : '') + '</audio>';
        }
    // mediaembed_service_url: 'SERVICE_URL',
    // mediaembed_max_width: 450


    // plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
    // toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
    // toolbar_mode: 'floating',
    // tinycomments_mode: 'embedded',
    // tinycomments_author: 'Author name',
   });
</script>
@stop
