@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>
<style>
form.form-horizontal h3.heading {
    font-size: 20px;
    margin-bottom: 29px;
    font-weight: 400;
    background: #0186cb;
    color: #fff;
    padding: 12px;
    border-radius: 3px;
    position: relative;
    top: -10px;
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
            <li><a href="{{url('/')}}">Dashbord</a></li>
            <li class="active"></li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-md-12">
        <div class="content_text headbar">
            <p>Add T & C Document</p>
        </div>
    </div>    
    <div class="col-md-4">
        <div class="white-box"style="padding:40px;">
            <!-- <h3 class="box-title m-b-0">Internal EPIC ON Display Ads</h3> -->
            <form class="form-horizontal addnewlogo" method="post" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h3 class="heading">Add New Document</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Document Title</label>
                            <div class="col-sm-8">
                                <input  type="text" class="form-control" name="title" id="title" value="" />
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Upload Document</label>
                            <div class="col-sm-8">
                                <input type="file" class="dropify file" id="tag-menu-icon" name="menu_icon"  data-allowed-file-extensions='["pdf"]'>
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Thumbnail</label>
                            <div class="col-sm-8">
                                <input type="file" class="dropify" id="tag-menu-icon" name="menu_icon" >
                            </div>
                        </div>    
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Type of Document</label>
                            <div class="col-sm-8">
                                <select name="platform" id="cars" class="form-control">
                                    <option value="#">Select Document Type</option>
                                    <option >ANTI CORRUPTION POLICY</option>
                                    <option >ANTI DOPING POLICY</option>
                                    <option>TUE APPLICATION FORM</option>
                                    <option>ANTI DISCRIMINATION POLICY</option>
                                    <option>CLOTHING AND EQUIPMENT REGULATIONS</option>
                                    <option>CODE OF CONDUCT FOR PLAYERS AND TEAM OFFICIALS  </option>
                                    <option>NEWS ACCESS REGULATIONS </option>
                                    <option>IMAGE USE TERMS </option>
                                    <option>CONTACT US</option>
                                    <option>SPONSORSHIPS</option>
                                    <option>IPL CODE OF CONDUCT FOR MATCH OFFICIALS</option>
                                    <option>BRAND AND PROTECTION GUIDELINES</option>
                                    <option>
                                      GOVERNING COUNCIL
                                    </option>
                                    <option>MATCH PLAYING CONDITIONS</option>
                                    <option>PMOA MINIMUM STANDARD</option>
                                    <option>SUSPECT ACTION POLICY</option>
                                </select>
                            </div>
                        </div>    
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Description</label>
                            <div class="col-sm-8">
                              <textarea class="form-control" name="photo_description" rows="3" required=""></textarea>
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Publish Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control dtpicker" value="" name="publish_date">
                                <input type="time" class="form-control tmpicker" value="" name="">
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Expiry Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control dtpicker" value="" name="publish_date">
                                <input type="time" class="form-control tmpicker" value="" name="">
                            </div>
                        </div>    
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Select Platform</label>
                            <div class="col-sm-8">
                                <select name="platform" id="cars" class="form-control">
                                    <option value="domestic">Select Platform</option>
                                    <option value="domestic">All</option>
                                    <option value="domestic">Domestic</option>
                                    <option value="international">International</option>
                                    <option value="international">IPL</option>
                                </select>
                            </div>
                        </div>    
                    </div>

                    <div class="col-md-12">
                        <div class="form-group " style="margin-top: 25px">
                            <label for="behName1" class="col-sm-4 control-label">Location Search :</label>
                            <div class="col-sm-8">
                                <button type="button" class="location-search"><span class="ti-search"></span> Search</button> 
                            </div>
                        </div>  
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group" >
                            <label for="wfirstName2" class="col-sm-4 control-label">Location:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="" name="  location">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="behName1" class="col-sm-4 control-label">Latitude :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly="" value="" name="latitude"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="behName1" class="col-sm-4 control-label">Longitude:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly="" value="" name="longitude"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-right-content form-groups geo-blocking">
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
                <!--
                <div class="form-group">
                <label class="col-sm-4 control-label">Select Platform:</label>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">Upload to all</label>
                    <div class="col-sm-6 ">
                    <input type="checkbox" name="bccid" id="tag-bccid" value="1" class="js-switch" data-color="#f96262" data-size="small" />                   
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">BCCI Domestic</label>
                    <div class="col-sm-6 ">
                    <input type="checkbox" name="bccid" id="tag-bccid" value="1" class="js-switch" data-color="#f96262" data-size="small" />                   
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">BCCI International</label>
                    <div class="col-sm-6">
                    <input type="checkbox" name="bccii" id="tag-bccii" value="1" class="js-switch" data-color="#f96262" data-size="small" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">IPL</label>
                    <div class="col-sm-6 ">
                    <input type="checkbox" name="ipl" id="tag-ipl" value="1" class="js-switch" data-color="#f96262" data-size="small" />
                    </div>
                </div>-->
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <input type="hidden" name="type" id="tag-type" value="">
                        <button type="submit" name="submit" id="submit" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                        <button type="submit" name="submit" id="submit" class="btn btn-info waves-effect waves-light m-t-10">Cancel</button>
                    </div>
                </div>
            </form>
            <form class="form-horizontal editnewlogo" method="post" action="" enctype="multipart/form-data" style="display: none">
                {{ csrf_field() }}
                <h3 class="heading">Update T & C Document</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Document Title</label>
                            <div class="col-sm-8">
                                <input  type="text" class="form-control" name="title" id="title" value="TEAM SPONSOR" />
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Upload Document</label>
                            <div class="col-sm-8">
                                <input type="file" class="dropify file" id="tag-menu-icon" name="menu_icon"  data-allowed-file-extensions='["pdf"]'>
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Thumbnail</label>
                            <div class="col-sm-8">
                                <input type="file" class="dropify" id="tag-menu-icon" name="menu_icon" data-default-file="{{URL::asset('img/terms-and-conditions.jpg')}}" >
                            </div>
                        </div>    
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Type of Document</label>
                            <div class="col-sm-8">
                                <select name="platform" id="cars" class="form-control">
                                    <option value="#">Select Document Type</option>
                                    <option >ANTI CORRUPTION POLICY</option>
                                    <option selected>ANTI DOPING POLICY</option>
                                    <option>TUE APPLICATION FORM</option>
                                    <option>ANTI DISCRIMINATION POLICY</option>
                                    <option>CLOTHING AND EQUIPMENT REGULATIONS</option>
                                    <option>CODE OF CONDUCT FOR PLAYERS AND TEAM OFFICIALS  </option>
                                    <option>NEWS ACCESS REGULATIONS </option>
                                    <option>IMAGE USE TERMS </option>
                                    <option>CONTACT US</option>
                                    <option>SPONSORSHIPS</option>
                                    <option>IPL CODE OF CONDUCT FOR MATCH OFFICIALS</option>
                                    <option>BRAND AND PROTECTION GUIDELINES</option>
                                    <option>
                                      GOVERNING COUNCIL
                                    </option>
                                    <option>MATCH PLAYING CONDITIONS</option>
                                    <option>PMOA MINIMUM STANDARD</option>
                                    <option>SUSPECT ACTION POLICY</option>
                                </select>
                            </div>
                        </div>    
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Description</label>
                            <div class="col-sm-8">
                              <textarea class="form-control" name="photo_description" rows="3" required="" value="">Baroda edged out Haryana in a thriller while Rajasthan beat Bihar in the third and fourth quarterfinals respectively at the Motera Stadium in Ahmedabad on Wednesday and joined Punjab and Tamil Nadu in the semifinals of the Syed Mushtaq Ali Trophy </textarea>
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Publish Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control dtpicker" value="04-09-2021" name="publish_date">
                                <input type="time" class="form-control tmpicker" value="15:01" name="">
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Expiry Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control dtpicker" value="04-09-2021" name="publish_date">
                                <input type="time" class="form-control tmpicker" value="15:01" name="">
                            </div>
                        </div>    
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Select Platform</label>
                            <div class="col-sm-8">
                                <select name="platform" id="cars" class="form-control">
                                    <option value="domestic">Select Platform</option>
                                    <option value="domestic">All</option>
                                    <option value="domestic" selected>Domestic</option>
                                    <option value="international">International</option>
                                    <option value="international">IPL</option>
                                </select>
                            </div>
                        </div>    
                    </div>

                    <div class="col-md-12">
                        <div class="form-group " style="margin-top: 25px">
                            <label for="behName1" class="col-sm-4 control-label">Location Search :</label>
                            <div class="col-sm-8">
                                <button type="button" class="location-search"><span class="ti-search"></span> Search</button> 
                            </div>
                        </div>  
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group" >
                            <label for="wfirstName2" class="col-sm-4 control-label">Location:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="" name="  location">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="behName1" class="col-sm-4 control-label">Latitude :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly="" value="" name="latitude"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="behName1" class="col-sm-4 control-label">Longitude:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly="" value="" name="longitude"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-right-content form-groups geo-blocking">
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
                <!--
                <div class="form-group">
                <label class="col-sm-4 control-label">Select Platform:</label>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">Upload to all</label>
                    <div class="col-sm-6 ">
                    <input type="checkbox" name="bccid" id="tag-bccid" value="1" class="js-switch" data-color="#f96262" data-size="small" />                   
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">BCCI Domestic</label>
                    <div class="col-sm-6 ">
                    <input type="checkbox" name="bccid" id="tag-bccid" value="1" class="js-switch" data-color="#f96262" data-size="small" />                   
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">BCCI International</label>
                    <div class="col-sm-6">
                    <input type="checkbox" name="bccii" id="tag-bccii" value="1" class="js-switch" data-color="#f96262" data-size="small" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">IPL</label>
                    <div class="col-sm-6 ">
                    <input type="checkbox" name="ipl" id="tag-ipl" value="1" class="js-switch" data-color="#f96262" data-size="small" />
                    </div>
                </div>-->
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <input type="hidden" name="type" id="tag-type" value="">
                        <button type="submit" name="submit" id="submit" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                        <button type="submit" name="submit" id="submit" class="btn btn-info waves-effect waves-light m-t-10">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="white-box"style="padding:40px;width: 100%">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered results listing_table list_view logo-management">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Document Type</th>
                            <th>Platform</th>
                            <th>Publish Date</th>
                            <th>Expiry Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input value="555685" name="check_video" class="checkbox check_video form-element" type="checkbox"></td>
                            <td>1</td>
                            <td>TEAM SPONSOR</td>
                            <td>ANTI DOPING POLICY</td>
                            <td>DOMESTIC</td>
                            <td>23 Sep 2021 07:09</td>
                            <td>23 Sep 2021 07:09</td>
                            <td class="action">
                                <a class="view1 open-data tdaction"  data-target="#Viewpage" title="" data-toggle="modal" data-id="555685" data-original-title="view">
                                   <span class="ti-eye"></span>
                                </a>
                                <a class="view1 tdaction edit" title="" data-toggle="tooltip" href="#" data-original-title="Edit">
                                    <span class="ti-pencil-alt"></span>
                                </a>
                                <a class="view_delete single_delete_icon tdaction" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">
                                    <span class="ti-trash"></span>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td><input value="555685" name="check_video" class="checkbox check_video form-element" type="checkbox"></td>
                            <td>1</td>
                            <td>TEAM SPONSOR</td>
                            <td>ANTI DOPING POLICY</td>
                            <td>DOMESTIC</td>
                            <td>23 Sep 2021 07:09</td>
                            <td>23 Sep 2021 07:09</td>
                            <td class="action">
                                <a class="view1 open-data tdaction" data-target="#Viewpage" title="" data-toggle="modal" data-id="555685" data-original-title="view">
                                   <span class="ti-eye"></span>
                                </a>
                                <a class="view1 tdaction edit" title="" data-toggle="tooltip" href="#" data-original-title="Edit">
                                    <span class="ti-pencil-alt"></span>
                                </a>
                                <a class="view_delete single_delete_icon tdaction" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">
                                    <span class="ti-trash"></span>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td><input value="555685" name="check_video" class="checkbox check_video form-element" type="checkbox"></td>
                            <td>2</td>
                            <td>TEAM SPONSOR</td>
                            <td>ANTI DOPING POLICY</td>
                            <td>DOMESTIC</td>
                            <td>23 Sep 2021 07:09</td>
                            <td>23 Sep 2021 07:09</td>
                            <td class="action">
                                <a class="view1 open-data tdaction" data-target="#Viewpage" title="" data-toggle="modal" data-id="555685" data-original-title="view">
                                   <span class="ti-eye"></span>
                                </a>
                                <a class="view1 tdaction edit" title="" data-toggle="tooltip" href="#" data-original-title="Edit">
                                    <span class="ti-pencil-alt"></span>
                                </a>
                                <a class="view_delete single_delete_icon tdaction" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">
                                    <span class="ti-trash"></span>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td><input value="555685" name="check_video" class="checkbox check_video form-element" type="checkbox"></td>
                            <td>3</td>
                            <td>TEAM SPONSOR</td>
                            <td>ANTI DOPING POLICY</td>
                            <td>DOMESTIC</td>
                            <td>23 Sep 2021 07:09</td>
                            <td>23 Sep 2021 07:09</td>
                            <td class="action">
                                <a class="view1 open-data tdaction" data-target="#Viewpage" title="" data-toggle="modal" data-id="555685" data-original-title="view">
                                   <span class="ti-eye"></span>
                                </a>
                                <a class="view1 tdaction edit" title="" data-toggle="tooltip" href="#" data-original-title="Edit">
                                    <span class="ti-pencil-alt"></span>
                                </a>
                                <a class="view_delete single_delete_icon tdaction" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">
                                    <span class="ti-trash"></span>
                                </a>

                            </td>
                        </tr>
                                                <tr>
                            <td><input value="555685" name="check_video" class="checkbox check_video form-element" type="checkbox"></td>
                            <td>4</td>
                            <td>TEAM SPONSOR</td>
                            <td>ANTI DOPING POLICY</td>
                            <td>DOMESTIC</td>
                            <td>23 Sep 2021 07:09</td>
                            <td>23 Sep 2021 07:09</td>
                            <td class="action">
                                <a class="view1 open-data tdaction" data-target="#Viewpage" title="" data-toggle="modal" data-id="555685" data-original-title="view">
                                   <span class="ti-eye"></span>
                                </a>
                                <a class="view1 tdaction edit" title="" data-toggle="tooltip" href="#" data-original-title="Edit">
                                    <span class="ti-pencil-alt"></span>
                                </a>
                                <a class="view_delete single_delete_icon tdaction" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">
                                    <span class="ti-trash"></span>
                                </a>

                            </td>
                        </tr>
                                                <tr>
                            <td><input value="555685" name="check_video" class="checkbox check_video form-element" type="checkbox"></td>
                            <td>5</td>
                            <td>TEAM SPONSOR</td>
                            <td>ANTI DOPING POLICY</td>
                            <td>DOMESTIC</td>
                            <td>23 Sep 2021 07:09</td>
                            <td>23 Sep 2021 07:09</td>
                            <td class="action">
                                <a class="view1 open-data tdaction" data-target="#Viewpage" title="" data-toggle="modal" data-id="555685" data-original-title="view">
                                   <span class="ti-eye"></span>
                                </a>
                                <a class="view1 tdaction edit" title="" data-toggle="tooltip" href="#" data-original-title="Edit">
                                    <span class="ti-pencil-alt"></span>
                                </a>
                                <a class="view_delete single_delete_icon tdaction" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">
                                    <span class="ti-trash"></span>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td><input value="555685" name="check_video" class="checkbox check_video form-element" type="checkbox"></td>
                            <td>6</td>
                            <td>TEAM SPONSOR</td>
                            <td>ANTI DOPING POLICY</td>
                            <td>DOMESTIC</td>
                            <td>23 Sep 2021 07:09</td>
                            <td>23 Sep 2021 07:09</td>
                            <td class="action">
                                <a class="view1 open-data tdaction" title="" data-toggle="modal" data-target="#Viewpage" data-original-title="view">
                                   <span class="ti-eye"></span>
                                </a>
                                <a class="view1 tdaction edit" title="" data-toggle="tooltip" href="#" data-original-title="Edit">
                                    <span class="ti-pencil-alt"></span>
                                </a>
                                <a class="view_delete single_delete_icon tdaction" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">
                                    <span class="ti-trash"></span>
                                </a>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>    
</div>
  
   
   
</div>
    <div class="modal fade" id="Viewpage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 100%; margin: 0 auto;">
                <div class="modal-header">
                    <h2 class="Preview-title">Preview T & C</h2>
                    <a class="recent-content__add btn primary medium rightbtn" href="#">Edit Detail</a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body wizard-content">
                    <form data-parsley-validate action="{{ route('addArticle') }}" name="article_form" id="article_form"
                        method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                        <h6>Basic Info</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="pdlt" for="wfirstName2">Document Title<span class="date" id="publishTo"></span>
                                        </label>
                                        <h2 id="title" class="head-title">TEAM SPONSOR</h2>
                                    </div>
                                </div>  
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label class="pdlt" for="wfirstName2">
                                            Type of Document:
                                            <span class="date" id="publishTo">ANTI DOPING POLICY</span>  
                                            Publish Date: 
                                            <span class="date" id="publishTo"> 23 Sep 2021 07:09</span>
                                            Expiry Date: 
                                            <span class="date" id="publishTo"> 23 Sep 2021 07:09</span><br/>
                                            Platform: 
                                            <span class="date" id="publishTo"> DOMESTIC</span>
                                            
                                        </label>
                                        <!--<div class="date" id="publishTo"></div> --> 
                                    </div>
                                </div>


                                <div class="col-md-6">    
                                    <div class="form-group">
                                        <label for="wlastName2" class="pdlt description" style="">  </label>
                                        <img src="{{URL::asset('img/terms-and-conditions.jpg')}}" id="image_url" name="image_url" alt="Trulli" class="art-img">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group description">
                                        <label for="wlastName2" class="pdlt description">Document Description </label>
                                        <div id="content" class="content description"><p> Baroda edged out Haryana in a thriller while Rajasthan beat Bihar in the third and fourth quarterfinals respectively at the Motera Stadium in Ahmedabad on Wednesday and joined Punjab and Tamil Nadu in the semifinals of the Syed Mushtaq Ali Trophy 2020-21.</p></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(document).ready(function() {
    $("a.view1.tdaction.edit").click(function(){
      $("form.form-horizontal.addnewlogo").hide();
      $("form.form-horizontal.editnewlogo").show();
    });    
  var buttonAdd = $("#add-button");
  var buttonRemove = $("#remove-button");
  var className = ".dynamic-field";
  var count = 0;
  var field = "";
  var maxFields = 5;

  function totalFields() {
    return $(className).length;
  }

  function addNewField() {
    count = totalFields() + 1;
    field = $("#dynamic-field-1").clone();
    field.attr("id", "dynamic-field-" + count);
    field.children("label").text("Field " + count);
    field.find("input").val("");
    $(className + ":last").after($(field));
  }

  function removeLastField() {
    if (totalFields() > 1) {
      $(className + ":last").remove();
    }
  }

  function enableButtonRemove() {
    if (totalFields() === 2) {
      buttonRemove.removeAttr("disabled");
      buttonRemove.addClass("shadow-sm");
    }
  }

  function disableButtonRemove() {
    if (totalFields() === 1) {
      buttonRemove.attr("disabled", "disabled");
      buttonRemove.removeClass("shadow-sm");
    }
  }

  function disableButtonAdd() {
    if (totalFields() === maxFields) {
      buttonAdd.attr("disabled", "disabled");
      buttonAdd.removeClass("shadow-sm");
    }
  }

  function enableButtonAdd() {
    if (totalFields() === (maxFields - 1)) {
      buttonAdd.removeAttr("disabled");
      buttonAdd.addClass("shadow-sm");
    }
  }

  buttonAdd.click(function() {
    addNewField();
    enableButtonRemove();
    disableButtonAdd();
  });

  buttonRemove.click(function() {
    removeLastField();
    disableButtonRemove();
    enableButtonAdd();
  });
});    
</script>

@stop