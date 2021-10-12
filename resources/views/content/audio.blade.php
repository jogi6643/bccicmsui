<form action="{{ route('addNewAudio') }}" method="post" enctype="multipart/form-data"
    class="validation-wizard wizard-circle">
    {{ csrf_field() }}
    <button type="button" id="collapsesidebar-btn" class="collapse-btn">
        <span>
            <!-- <i class="mdi mdi-chevron-right fa-fw" data-icon="v"></i> --> Collapse Sidebar
        </span>
    </button>

    <h6>Basic Info</h6>
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> Headline*:</label>
                    <input type="text" required class="form-control videotitle text-case" name="title"
                        value="{{ old('title') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2"> URL Segment:</label>
                    <br />
                    <div class="input_field">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="titleUrlSegment" onfocusout="save_url();"
                                    value="{{ old('titleUrlSegment', $singlevideo['titleUrlSegment'] ?? '') }}"
                                    readonly>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn" onclick="editable_segment();"><i
                                        class="glyphicon glyphicon-edit single_edit_icon" id="edit_field"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 clear-b menu-icon-box">
                <div class="form-group">
                    <label for="myfile">Add Audio*:</label>
                    <input type="file" class="dropify" data-default-file="" id="myfile1" name="audiofile"
                        onchange="return audioValidation()" required>
                </div>
            </div>
            <div class="col-md-6 menu-icon-box">
                <div class="form-group">
                    <label for="myfile">Thumbnail Image*:</label>
                    <input type="file" class="dropify" data-default-file="" id="myfile2" name="thumbnail_image"
                        onchange="return imageValidation()" value="{{ old('thumbnail_image') }}" required>
                </div>
            </div>

            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2">Publish Date:</label>
                    <input type="date" class="form-control dtpicker" value="" name="publish_date" required>
                    <input type="time" class="form-control tmpicker" value="" name="publish_time" >
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2">Expiry Date:</label>
                    <input type="date" class="form-control dtpicker" value="" name="expiryDate" required> 
                    <input type="time" class="form-control tmpicker" value="" name="expiryTime">
                </div>
            </div> -->
            <div class="col-md-6" style="margin-top: 25px">
                <div class="form-group">
                    <label class="fullwidth" for="behName1">Location Search:</label>
                    <input type="text" id="audiolocationsearch" name="audiolocationsearch"
                        placeholder="Choose Location">
                    <!-- <button type="button" class="location-search">Search</button> -->
                </div>
            </div>
            <!-- <div class="col-md-6" style="margin-top: 25px">
                <div class="form-group">
                    <label for="wfirstName2">Location:</label>
                    <input type="text" id="latitudebios" name="latitudebios" readonly>
                    <input type="text" class="form-control" value="" name="location">
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Latitude:</label>
                    <input type="text" id="latitudeaudio" name="latitudeaudio" readonly>
                    <!-- <input type="text" class="form-control" value="" name="latitude" readonly=""> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Longitude:</label>
                    <input type="text" id="longitudeaudio" name="longitudeaudio" readonly>
                    <!-- <input type="text" class="form-control" value="" name="latitude" readonly=""> -->
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
        </div>
    </section>

    <h6>Meta Information</h6>
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Short Description*:</label>
                    <textarea class="form-control" required id="short_description" name="short_description" rows="3"
                        value="{{ old('short_description') }}"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2"> Description*:</label>
                    <textarea class="form-control" required name="description" rows="3"
                        value="{{ old('description') }}"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Audio Duration* :</label>
                    <input type="text" required placeholder="HH:mm:ss" class="form-control"
                        value="{{ old('duration') }}" name="duration">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Location label:</label>
                    <input type="text" readonly class="form-control" value="{{ old('media_Id') }}" name="media_Id">
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label class="fullwidth" for="behName1">Location Search :</label>
                    <button type="button" class="location-search">Search</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Latitude :</label>
                    <input type="text" readonly class="form-control" value="{{ old('latitude') }}" name="latitude">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Longitude:</label>
                    <input type="text" readonly class="form-control" value="" name="longitude">
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Platforms*:</label>
                    <select class="form-control" required name="platform" id="platform">
                        <option value="">Select</option>
                        <option value="domestic">Domestic</option>
                        <option value="international">International</option>
                        <option value="ipl">IPL</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="behName1">Keywords :</label>
                    <input type="text" class="form-control tagsinput" value="{{ old('keywords') }}" name="keywords">
                    <span class="help-block">Press Enter After Each Tag</span>
                </div>
            </div>
        </div>
    </section>

    <h6>Route restrictions</h6>
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Language :</label>
                    <select required="required" class="form-control" name="language" id="language">
                        <option value="" disabled>Select Language</option>
                        @foreach ($data as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Asset Type :</label>
                    <input type="text" class="form-control" value="audio" name="type" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Publish Date*:</label>
                    <input type="date" class="form-control dtpicker" value="" name="publish_date" required>
                    <input type="time" class="form-control tmpicker" value="" name="publish_time">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Expiry Date*:</label>
                    <input type="date" class="form-control dtpicker" value="" name="expiryDate" required>
                    <input type="time" class="form-control tmpicker" value="" name="expiryTime">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Status:</label>
                    <select class="form-control" name="current_status" id="current_status">
                        <option value="" disabled>Select Status</option>
                        @foreach ($status as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </section>

    <div id="collapsingsidebar" class="collapssidebar">
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="content-ref">
                            <h2>Content references</h2>
                            <div class="reference-search">
                                <div class="reference-search__select-container">
                                    <select class="reference-search-s" name='type_reference' id="referenceaudio">
                                        <option selected="selected" disabled="disabled">Select type</option>
                                        <option value="articles">Articles</option>
                                        <option value="images">Photos</option>
                                        <option value="playlists">Playlists</option>
                                        <option value="videos">Videos</option>
                                        <option value="audios">Audio</option>
                                        <option value="promos">Promos</option>
                                        <option value="documents">Documents</option>
                                        <option value="bios">Bios</option>
                                    </select>

                                    <select class="form-control selectpicker refclassaduio" name="ref[]" id="browsers"
                                        data-live-search="true" multiple data-actions-box="true" data-live-search="true"
                                        data-show-subtext="true">

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
                                <div class="modal fade" id="Favourites" tabindex="-1" role="dialog"
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
                            </div>
                        </div>

                        <div class="tagsinput1">
                            <h2>Tags</h2>
                            <select class="form-control taginput-item tagClass" id="inputTag1xfsd" name="tags[]"
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
                                    <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                                </li>
                            </ul>
                        </div>

                        <div class="content-ref">
                            <h2>Related content</h2>
                            <div class="reference-search">
                                <div class="reference-search__select-container">
                                    <select class="reference-search-s" id="contentIdaudio" name="releted_audio_type">
                                        <option selected="selected" disabled="disabled">Select type</option>
                                        <option value="articles">Articles</option>
                                        <option value="images">Photos</option>
                                        <option value="playlists">Playlists</option>
                                        <option value="videos">Videos</option>
                                        <option value="audios">Audio</option>
                                        <option value="promos">Promos</option>
                                        <option value="documents">Documents</option>
                                        <option value="bios">Bios</option>
                                    </select>

                                    <select class="form-control selectpicker contentClassaudio" name="content[]"
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</form>
{{-- <script src="{{ asset('js/audio/audio.js') }}" type="text/javascript"></script> --}}
<script>
    $(document).ready(function() {
        $("#latitudeArea").addClass("d-none");
        $("#longtitudeArea").addClass("d-none");
    });
    google.maps.event.addDomListener(window, 'load', initialize);

    function initialize() {
        var input = document.getElementById('audiolocationsearch');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            $('#latitudeaudio').val(place.geometry['location'].lat());
            $('#longitudeaudio').val(place.geometry['location'].lng());

            $("#latitudeArea").removeClass("d-none");
            $("#longtitudeArea").removeClass("d-none");
        });
    }
    $(document).ready(function() {
        $('.dropify').dropify();

        $("#audio button#collapsesidebar-btn").click(function() {
            $('#audio #collapsingsidebar').toggleClass("collapse-deactive");
            $('#audio section.body').toggleClass("collapse-deactive");
            $("#audio button#collapsesidebar-btn").text(function(i, v) {
                return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
            });
        });
        // Start loader and selected 
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.refclassaduio',
            function() {
                $("#collapsingsidebar .reference-search .inner").append(
                    '<button type="button" class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
                $("#collapsingsidebar .reference-search .inner").append(
                    '<div class="loader-background"><div class="loader"></div></div>'
                );
                //if ($('select.refclassaduio option').length != 0) {
                //   $('.loader-background').hide();
                //}
                for (let i = 1; i <= $('select.refclassaduio option').length; i++) {
                    if (i == $('select.refclassaduio option').length) {
                        console.log(i + "==" + $('select.refclassaduio option').length);
                        $('.loader-background').hide();
                    }
                }
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.contentClassaudio',
            function() {
                $("#collapsingsidebar .reference-search .inner").append(
                    '<button type="button" class="addtocontentrefrence" id="add-sels"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
                );
                $("#collapsingsidebar .reference-search .inner").append(
                    '<div class="loader-background"><div class="loader"></div></div>'
                );
                //if ($('select.contentClassaudio option').length != 0) {
                //   $('.loader-background').hide();
                //}
                for (let i = 1; i <= $('select.contentClassaudio option').length; i++) {
                    if (i == $('select.contentClassaudio option').length) {
                        console.log(i + "==" + $('select.contentClassaudio option').length);
                        $('.loader-background').hide();
                    }
                }
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.refclassaduio',
            function() {
                $('.dropdown.bootstrap-select.form-control.refclassaduio').on('click', 'button#add-sel',
                    function() {

                        var optionsselected = $("select.refclassaduio").val();
                        console.log(optionsselected);
                        //$('.selectedvalue').html("");
                        $.each(optionsselected, function(i, x) {

                            $('.selectedvalue').append('<div class="selectedcol ">' + x +
                                '<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>'
                            )

                        });

                    });
            });
        $('.reference-search__select-container').on('click',
            '.dropdown.bootstrap-select.form-control.contentClassaudio',
            function() {
                $('.dropdown.bootstrap-select.form-control.contentClassaudio').on('click',
                    'button#add-sels',
                    function() {
                        var optionsselected = $("select.contentClassaudio").val();
                        // $('.selectedrelcont').html("");
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
        // End selected option and loader 

        $("#referenceaudio").on('change', function() {
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

                        $('select.refclassaduio').empty();
                        $('select.refclassaduio').selectpicker('destroy');
                        $('select.refclassaduio').selectpicker();
                        $.each(res.data, function(index, value) {
                            var option = '<option value="<h2>' + value.title +
                                '</h2> <span>' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span >ID:' + value
                                .ID + '</span>"><h2>' + value.title +
                                '</h2> <span class="lan">' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span class="id">ID:' +
                                value.ID + '</span></option>';
                            $('select.refclassaduio').append(option);
                        });
                        $('select.refclassaduio').selectpicker('refresh');
                        if ($('select.refclassaduio option').length != 0) {
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

        $("#contentIdaudio").on('change', function() {
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

                        $('select.contentClassaudio').empty();
                        $('select.contentClassaudio').selectpicker('destroy');
                        $('select.contentClassaudio').selectpicker();
                        $.each(res.data, function(index, value) {
                            var option = '<option value="<h2>' + value.title +
                                '</h2> <span>' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span >ID:' + value
                                .ID + '</span>"><h2>' + value.title +
                                '</h2> <span class="lan">' + value.language + '|' +
                                'Last updated 31/08/2021</span> <span class="id">ID:' +
                                value.ID + '</span></option>';
                            $('select.contentClassaudio').append(option);

                        });
                        if ($('select.contentClassaudio option').length != 0) {
                            $('.loader-background').hide();
                        }
                        $('select.contentClassaudio').selectpicker('refresh');
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

        // Tags 

        // ALERT
        $("#inputTag1").select2({
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
                        $('#inputTag1').append(option);
                    });
                    $(".taginput-item").select2({
                        tags: true,
                        tokenSeparators: [',', ' ']
                    })
                },
            }
        });
        get_all_tags


    });
</script>
<script>
    function audioValidation() {
        var fileInput =
            document.getElementById('myfile1');

        var filePath = fileInput.value;
        {{-- M4A,FLAC,MP3,MP4,WAV,WMA,AAC --}}
        // Allowing file type
        var allowedExtensions =
            /(\.M4A|\.FLAC|\.MP3|\.MP4|\.WAV|\.WMA|\.AAC)$/i;

        if (!allowedExtensions.exec(filePath)) {
            alert('Invalid file type, file type should be M4A,FLAC,MP3,MP4,WAV,WMA and AAC');
            fileInput.value = '';
            return false;
        }

    }

    function imageValidation() {

        var fileInput =
            document.getElementById('myfile2');

        var filePath = fileInput.value;

        // Allowing file type
        var allowedExtensions =
            /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        if (!allowedExtensions.exec(filePath)) {
            alert('Invalid file type,image type shloud be jpg,jpeg,png and gif');
            fileInput.value = '';
            return false;
        }

    }
</script>
