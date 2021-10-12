<script>
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: '/GetBioContent',
            data: {
                "_token": "{{ csrf_token() }}",
                'type': "bios",
            },
            success: function(response) {
                console.log(response);
                if (response.status) {
                    $('#browsers1').html(response.html);
                }
            },
            error: function(response) {
                //  alert("error"); 
            }
        });
    });
</script>
@include('show_message')
<form action="{{ route('add-bio') }}" method="POST" enctype="multipart/form-data"
    class="validation-wizard wizard-circle">
    <!-- Step 1 -->
    {{ csrf_field() }}
    <button type="button" id="collapsesidebar-btn" class="collapse-btn">
        <span>
            <!-- <i class="mdi mdi-chevron-right fa-fw" data-icon="v"></i> --> Collapse sidebar
        </span>
    </button>
    <h6>Basic Info</h6>
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> Title*</label>
                    <input type="text" class="form-control text-case" value="" name="title" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> URL Segment:</label>
                    <div class="input_field">
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" name="titleUrlSegment" onfocusout="save_url();"
                                    value="{{ old('titleUrlSegment', $singlevideo['titleUrlSegment'] ?? '') }}"
                                    readonly>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn" onclick="editable_segment();"><i
                                        class="glyphicon glyphicon-edit single_edit_icon" id="edit_field"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Personal information*</label>
                    <input type="text" class="form-control" value="" name="short_description" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Know Name*</label>
                    <input type="text" class="form-control" value="" name="known_name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Surname*</label>
                    <input type="text" class="form-control" value="" name="surname" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">First name*</label>
                    <input type="text" class="form-control" value="" name="first_name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Nationality*</label>
                    <input type="text" class="form-control" value="" name="nationality" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="myfile">Date of Birth*</label>
                    <input type="date" class="form-control dtpicker" value="" name="date_of_birth" required>
                    <input type="time" class="form-control tmpicker" value="" name="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Date of Death*</label>
                    <input type="date" class="form-control dtpicker" value="" name="date_of_death" required>
                    <input type="time" class="form-control tmpicker" value="" name="">
                </div>
            </div>
            <div class="col-md-6" style="padding-top: 25px">
                <div class="form-group">
                    <label for="myfile">Place of Birth</label>
                    <input type="text" class="form-control" value="" name="place_of_birth">
                </div>
                <!-- <div class="form-group">
                    <label class="fullwidth" for="behName1">Location Search:</label>
                    <button type="button" class="location-search">Search</button>
                </div> -->
                <div class="form-group clear-b">
                    <label for="behName1">Location Search :</label>
                    <input type="text" id="bioslocationsearch" name="bioslocationsearch" placeholder="Choose Location">
                    <!-- <input type="text" class="form-control" value="" name="match_id" readonly=""> -->
                </div>
            </div>

            <div class="col-md-6" style="padding-top: 25px">
                <div class="form-group">
                    <label for="myfile">Add Image*:</label>
                    <input type="file" class="dropify" id="image_url" name="image_url" required>
                </div>
            </div>
            <div class="col-md-6 clear-b">
                <div class="form-group">
                    <label for="behName1">Longitude:</label>
                    <input type="text" id="latitudebios" name="latitudebios" readonly>
                    <!-- <input type="text" class="form-control" value="" name="latitude" readonly=""> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Latitude :</label>
                    <input type="text" id="longitudebios" name="longitudebios" readonly>
                    <!-- <input type="text" class="form-control" value="" name="latitude" readonly=""> -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="behName1">Platforms*:</label>
                    <select class="form-control valid" required="" name="platform" id="platform" required>
                        <option value="">Select</option>
                        <option value="domestic" selected="">
                            Domestic</option>
                        <option value="international">
                            International</option>
                        <option value="ipl">
                            Ipl</option>
                    </select>
                </div>
            </div>

            <!--geo location div start -->
            <div class="col-md-12">
                <div class="form-right-content">
                    <h3>Geo Blocking </h3>
                    <!-- <input type="checkbox" id="select_all" name="select_all" value="Select all"> -->
                    <!-- <label for="select_all">Select all</label><br> -->

                    <label for="shortDescription3">Custom Select country</label>
                    <!-- <label class="control-label"></label> -->
                    <select class="selectpicker" multiple data-actions-box="true">
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
            <!--geo location div end -->

            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" class="form-control" name="image_url" required>
                </div>
            </div> -->
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
                    <input class="form-control" id="platform" name="platform">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Slug*</label>
                    <input class="form-control" id="slug" name="slug" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Status</label>
                    <select name="current_status" class="form-control" id="current_status">
                        <option value="" disabled>Select Status</option>
                        @foreach ($status as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Language</label>
                    <select name="language" class="form-control" id="langauge">
                        <option value="" selected>Select Language</option>
                        @foreach ($data as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="wfirstName2"> Summary</label>
                    <input type="text" class="form-control" value="" name="summary">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="wemailAddress2"> Content*</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Selecttype"> Select type*:</label>
                    <select name="content_type" class="form-control" id="cars">
                        <option value="Photo">Photo</option>
                        <option value="Video">Video</option>
                    </select>
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

        <div class="col-md-6">
            <div class="form-group">
                <label for="wemailAddress2"> Career information</label>
            </div>
            <div class="form-group">
                <label for="wfirstName2"> Position</label>
                <input type="text" class="form-control" value="" name="">
            </div>
            <div class="form-group">
                <label for="wfirstName2"> Career Start Date</label>
                <input type="date" class="form-control dtpicker" value="" name="career_start_date">
                <input type="time" class="form-control tmpicker" value="" name="">
            </div>
            <div class="form-group" style="padding-top: 25px;">
                <label for="wfirstName2"> Career End Date</label>
                <input type="date" class="form-control dtpicker" value="" name="career_end_date">
                <input type="time" class="form-control tmpicker" value="" name="">
            </div>
            <div class="form-group" style="padding-top: 25px;">
                <label for="wfirstName2"> Town / City</label>
                <input type="text" class="form-control" value="" name="">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="wemailAddress2"> Additional dates</label>
            </div>
            <div class="form-group">
                <label for="wfirstName2" class="fullwidth"> Add Date</label>
                <input type="date" class="form-control dtpicker" value="" name="">
                <input type="time" class="form-control tmpicker" value="" name="">
            </div>
        </div>



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
                </div>
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
    <!--    
    <h6>Collapse &amp; slider</h6>
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
                          
                            <li >
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
                                <div class="selected-references-new__item-right">
                                   
                                    <button type="button"></button>
                                </div>
                            </li>
                            
                        </ol>
                    </div>
                </div>

            </div>
    </section>-->
    <!-- Step 4 -->
    <!--<h6>Tags</h6>
    <section>
        <div class="row">
            <div class="col-md-12">
                <?php //if(in_array($catalog_details['asset_type'], array('WATCH'))) {
                ?>
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
    <!--<input type="text" class="form-control" value="There are no tags within this tag group." readonly  name="">
                    </div>
                </div>
            </div>
    </section>-->
    <!--<h6>Related &amp; content</h6>
    <section>
        <div class="row">
            <div class="col-md-12">
                <?php //if(in_array($catalog_details['asset_type'], array('WATCH'))) {
                ?>
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
    </section>-->

    <div id="collapsingsidebar" class="collapssidebar">
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="content-ref">
                            <h2>Content references</h2>
                            <div class="reference-search">
                                <div class="reference-search__select-container">
                                    <select class="reference-search-s" name='type_reference' id="reference_bio">
                                        <option selected="selected" disabled="disabled">
                                            Select type</option>
                                        <option value="articles">Articles</option>
                                        <option value="images">Photos</option>
                                        <option value="playlists">Playlists</option>
                                        <option value="videos">Videos</option>
                                        <option value="audios">Audio</option>
                                        <option value="promos">Promos</option>
                                        <option value="documents">Documents</option>
                                        <option value="bios">Bios</option>
                                    </select>
                                    <select class="form-control selectpicker refclass_bio" name="ref[]"
                                        multiple="multiple" id="browsers" data-live-search="true" multiple
                                        data-actions-box="true" data-live-search="true" data-show-subtext="true">
                                    </select>
                                    <div class="selectedvalue" role="document"></div>
                                </div>
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
                            <div class="modal fade" id="Favourites" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="width: 60%; margin: 0 auto;">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h2>Click the add button to attach the content reference</h2>
                                        <select class="form-control selectpicker" id="browsers" data-live-search="true"
                                            multiple data-actions-box="true" data-live-search="true"
                                            data-show-subtext="true">
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tagsinput1">
                        <h2>Tags</h2>
                        <select class="form-control taginput-item" id="inputTag_bioshh" name="tags[]"
                            multiple="multiple">
                            <?php $get_tags = get_all_tags(); ?>
                            @foreach ($get_tags['data'] as $key => $t)
                                <option value="{{ $t['label'] }}">
                                    {{ $t['label'] }}</option>
                            @endforeach
                        </select>
                        <ul class="added-freq">
                            <li data-toggle="modal" data-target="#Favourites">
                                <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added
                            </li>
                            <li data-toggle="modal" data-target="#Favourites">
                                <i class="mdi mdi-restore fa-fw" data-icon="v"></i>
                                Recently Visited
                            </li>
                        </ul>
                    </div>


                    <div class="content-ref">
                        <h2>Related content</h2>
                        <div class="reference-search">
                            <div class="reference-search__select-container">
                                <select name="type_content" id="contentId_bio" class="reference-search-s">
                                    <option disabled="disabled" selected="selected">
                                        Select type</option>
                                    <option value="articles">Articles</option>
                                    <option value="images">Photos</option>
                                    <option value="playlists">Playlists</option>
                                    <option value="videos">Videos</option>
                                    <option value="audios">Audio</option>
                                    <option value="promos">Promos</option>
                                    <option value="documents">Documents</option>
                                    <option value="bios">Bios</option>
                                </select>


                                <select class="form-control selectpicker contentClass_bio" name="content[]"
                                    id="browsers" data-live-search="true" multiple data-actions-box="true"
                                    data-live-search="true" data-show-subtext="true">
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
                            <div class="modal fade" id="Favourites" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="width: 60%; margin: 0 auto;">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h2>Click the add button to attach the content reference</h2>
                                        <select class="form-control selectpicker" id="browsers" data-live-search="true"
                                            multiple data-actions-box="true" data-live-search="true"
                                            data-show-subtext="true">
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                            <option>
                                                <h2>India’s squad for WTC Final and Test series against England
                                                    announced</h2> <span class="lan">English | Last updated
                                                    31/08/2021</span> <span class='id'>ID: 154375</span>
                                            </option>
                                        </select>
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
<script src="{{ asset('js/bios/bioslist.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $("#bios button#collapsesidebar-btn").click(function() {
            $('#bios #collapsingsidebar').toggleClass("collapse-deactive");
            $('#bios section.body').toggleClass("collapse-deactive");
            $("#bios button#collapsesidebar-btn").text(function(i, v) {
                return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
            });
        });
        // start loader and dropdown
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.refclass_bio',
            function() {

                $("#collapsingsidebar .reference-search .inner").append(
                    '<button type="button" class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
                $("#collapsingsidebar .reference-search .inner").append(
                    '<div class="loader-background"><div class="loader"></div></div>'
                );
                //if ($('select.refclass_bio option').length != 0) {
                //    $('.loader-background').hide();
                //}
                for (let i = 1; i <= $('select.refclass_bio option').length; i++) {
                    if (i == $('select.refclass_bio option').length) {
                        console.log(i + "==" + $('select.refclass_bio option').length);
                        $('.loader-background').hide();
                    }
                }
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.contentClass_bio',
            function() {

                $("#collapsingsidebar .reference-search .inner").append(
                    '<button type="button" class="addtocontentrefrence" id="add-sels"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
                $("#collapsingsidebar .reference-search .inner").append(
                    '<div class="loader-background"><div class="loader"></div></div>'
                );
                //if ($('select.contentClass_bio option').length != 0) {
                //   $('.loader-background').hide();
                //}
                for (let i = 1; i <= $('select.contentClass_bio option').length; i++) {
                    if (i == $('select.contentClass_bio option').length) {
                        console.log(i + "==" + $('select.contentClass_bio option').length);
                        $('.loader-background').hide();
                    }
                }
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.refclass_bio',
            function() {
                $('.dropdown.bootstrap-select.form-control.refclass_bio').on('click', 'button#add-sel',
                    function() {

                        var optionsselected = $("select.refclass_bio").val();
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
            '.dropdown.bootstrap-select.form-control.contentClass_bio',
            function() {
                $('.dropdown.bootstrap-select.form-control.contentClass_bio').on('click', 'button#add-sels',
                    function() {
                        var optionsselected = $("select.contentClass_bio").val();
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
        // end selected and loider
    });

    function getval(sel) {

        var type = (sel.value);
        $.ajax({
            type: 'POST',
            url: '/GetBioContent',
            data: {
                "_token": "{{ csrf_token() }}",
                'type': type,
            },
            dataType: 'json',
            success: function(res) {
                console.log(res);
                $('.refclass').selectpicker('refresh');
                $.each(res.data, function(index, value) {
                    // var option = '<option value='+value.ID+'><h2>'+value.title +'</h2></option>';
                    var option = '<option value=' + value.ID + '><h2>' + value.title +
                        '</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span></option>'
                    $('select.refclass').append(option);
                });

            },
            error: function(response) {
                return false;
            },
            complete: function() {
                console.log('complete');
            }
        });

    }

    // Releted 
    function getval1(sel) {
        var type1 = (sel.value);
        if (type1 != undefined && type1 != null) {
            $.ajax({
                type: "POST",
                url: "/commonsearch",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'type': type1,
                },
                dataType: 'json',
                success: function(res) {
                    $('.contentClass1').selectpicker('refresh');
                    $.each(res.data, function(index, value) {

                        var option = '<option value=' + value.ID + '><h2>' + value.title +
                            '</h2> <span class="lan">' + value.language + '|' +
                            'Last updated 31/08/2021</span> <span class="id">ID:' + value.ID +
                            '</span></option>';
                        $('select.contentClass1').append(option);
                    });
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


    };
</script>
<script src="https://cdn.tiny.cloud/1/5orxol55pinopywbk09yrbw1ryxu73rl6q0r6h29utlwe1s9/tinymce/5/tinymce.min.js"
referrerpolicy="origin"></script>
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
            return '<audio controls>' + '\n<source src="' + data.source + '"' + (data.sourcemime ?
                ' type="' + data.sourcemime + '"' : '') + ' />\n' + (data.altsource ? '<source src="' +
                data.altsource + '"' + (data.altsourcemime ? ' type="' + data.altsourcemime + '"' :
                    '') + ' />\n' : '') + '</audio>';
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


<script>
    $(document).ready(function() {
        $('.dropify').dropify();
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.refclassaduio',
            function() {
                $("#collapsingsidebar .reference-search .inner").append(
                    '<button class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.contentClass1',
            function() {
                $("#collapsingsidebar .reference-search .inner").append(
                    '<button class="addtocontentrefrence" id="add-sels"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.refclassaduio',
            function() {
                $('.dropdown.bootstrap-select.form-control.refclassaduio').on('click', 'button#add-sel',
                    function() {

                        var optionsselected = $("select.refclassaduio").val();
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
            '.dropdown.bootstrap-select.form-control.contentClass1',
            function() {
                $('.dropdown.bootstrap-select.form-control.contentClass1').on('click', 'button#add-sels',
                    function() {
                        var optionsselected = $("select.contentClass1").val();
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
<script>
    $(document).ready(function() {
        $("#reference_bio").on('change', function() {
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
                        $('select.refclass_bio').empty();
                        $('select.refclass_bio').selectpicker('destroy');
                        $('select.refclass_bio').selectpicker();
                        $.each(res.data, function(index, value) {
                            var option = '<option value="<h2>' + value.title +
                                '</h2> <span>' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span>ID:' + value
                                .ID + '</span>"><h2>' + value.title +
                                '</h2> <span>' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span>ID:' + value
                                .ID + '</span></option>';
                            // var option = '<option value="'+value.title + "*" +value.ID+'</span>"><h2>'+value.title +'</h2> <span>'+value.language +'|'+ 'Last updated 31/08/2021</span> <span>ID:'+value.ID+'</span></option>';
                            $('select.refclass_bio').append(option);
                        });
                        $('select.refclass_bio').selectpicker('refresh');

                        if ($('select.refclass_bio option').length != 0) {
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
        $("#contentId_bio").on('change', function() {
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
                        $('select.contentClass_bio').empty();
                        $('select.contentClass_bio').selectpicker('destroy');
                        $('select.contentClass_bio').selectpicker();
                        $.each(res.data, function(index, value) {
                            var option = '<option value="<h2>' + value.title +
                                '</h2> <span>' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span >ID:' + value
                                .ID + '</span>"><h2>' + value.title +
                                '</h2> <span class="lan">' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span class="id">ID:' +
                                value.ID + '</span></option>';
                            $('select.contentClass_bio').append(option);
                        });
                        $('select.contentClass_bio').selectpicker('refresh');
                        if ($('select.contentClass_bio option').length != 0) {
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
        // ALERT
        $("#inputTag_bios").select2({
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
                        $('#inputTag_bios').append(option);
                    });
                    $(".taginput-item").select2({
                        tags: true,
                        tokenSeparators: [',', ' ']
                    })
                },
            }
        });

        // End Tags Search 
    });
</script>
