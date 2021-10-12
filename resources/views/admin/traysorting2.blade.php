@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify();
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("li.btn").click(function(){
        $("li.btn").removeClass("active");
        $(this).addClass("active");
});
        });
</script>
 -->

<!-- .row -->
<!-- <div class="container-fluid">
            <style type="text/css">
    .myadmin-dd .dd-list .dd-item.active .dd-handle{
        background: #aaa;color:#efefef;
    }
</style> -->
<div class="row" style="margin-top:2%;">
        <div class="col-md-4">
            <label>Tray View Type</label>
            <select id="listSelectType" class="form-control" style="margin-bottom:2%;"> 
                <option value="ALL">ALL</option>
                <option value="PREMIUM">PREMIUM</option>
                <option value="FREE">FREE</option>
            </select>
        </div>
    <div class="col-md-4">
        <label>Tray Language</label>
        <select id="listSelectLanguage" class="form-control" style="margin-bottom:2%;"> 
                <option value="ALL">ALL</option>
                <option value="ENGLISH">ENGLISH</option>
                <option value="HINDI">HINDI</option>
            </select>
        </div>
        <div class="col-md-4" style="float:right;">
            <!-- <button id="pushListChanges" class="btn btn-success" style="float:right;">Push Changes</button> -->
        </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="white-box custome-catalogs">
            <h3 class="box-title">Catalogs <br>
            <small>Click on catalog to get lists</small>
            </h3>
            <div class="myadmin-dd dd" id="catalogs">
                <ol class="dd-list">
                    <li class="dd-item catalog-li active" data-id="56">
                        <div class="dd-handle"> LISTEN </div>
                    </li>
                    <li class="dd-item catalog-li" data-id="57">
                        <div class="dd-handle"> PLAY </div>
                    </li>
                    <li class="dd-item catalog-li" data-id="58">
                        <div class="dd-handle"> READ </div>
                    </li>
                    <li class="dd-item catalog-li" data-id="59">
                        <div class="dd-handle"> LEARN </div>
                    </li>
                                        <li class="dd-item catalog-li" data-id="60">
                        <div class="dd-handle"> Home v2 </div>
                    </li>
                                        <li class="dd-item catalog-li" data-id="61">
                        <div class="dd-handle"> WATCH </div>
                    </li>
                                        <li class="dd-item catalog-li" data-id="180">
                        <div class="dd-handle"> Kid-home-v2 </div>
                    </li>
                                        <li class="dd-item catalog-li" data-id="181">
                        <div class="dd-handle"> Kid-watch </div>
                    </li>
                                        <li class="dd-item catalog-li" data-id="182">
                        <div class="dd-handle"> Kid-listen </div>
                    </li>
                                        <li class="dd-item catalog-li" data-id="183">
                        <div class="dd-handle"> Kid-read </div>
                    </li>
                                        <li class="dd-item catalog-li" data-id="184">
                        <div class="dd-handle"> Kid-play </div>
                    </li>
                                        <li class="dd-item catalog-li" data-id="189">
                        <div class="dd-handle"> Trending </div>
                    </li>
                                        <li class="dd-item catalog-li" data-id="190">
                        <div class="dd-handle"> New Release </div>
                    </li>
                                        <li class="dd-item catalog-li" data-id="254">
                        <div class="dd-handle"> Docubay </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="white-box custome-catalogs">
            <h3 class="box-title">Lists</h3>
            <div class="myadmin-dd dd" id="lists">
            <ol class="dd-list">
                <li class="dd-item lists-li" data-id="136">
                    <input type="hidden" name="list_id[]" value="136">
                    <div class="dd-handle"> PODCAST - CAROUSEL BANNER - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="1213">
                    <input type="hidden" name="list_id[]" value="1213">
                    <div class="dd-handle"> PODCAST- NEW RELEASES - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="757">
                    <input type="hidden" name="list_id[]" value="757">
                    <div class="dd-handle"> PODCAST - TRENDING PODCAST - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="1732">
                    <input type="hidden" name="list_id[]" value="1732">
                    <div class="dd-handle"> PODCAST- Tales Of Love - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="879">
                    <input type="hidden" name="list_id[]" value="879">
                    <div class="dd-handle"> PODCAST - KAHANIYAN -ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="1311">
                    <input type="hidden" name="list_id[]" value="1311">
                    <div class="dd-handle"> PODCAST - SOCIETY AND CULTURE- ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="1967">
                    <input type="hidden" name="list_id[]" value="1967">
                    <div class="dd-handle"> Podcast - Yuddha - The Indian Military History Podcast- ALL DUPLICATE </div>
                </li>
                    <li class="dd-item lists-li" data-id="1706">
                    <input type="hidden" name="list_id[]" value="1706">
                    <div class="dd-handle"> PODCAST - Editor's Picks - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="1679">
                    <input type="hidden" name="list_id[]" value="1679">
                    <div class="dd-handle"> PODCAST- MYTHOLOGY AND DEVOTIONAL - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="677">
                    <input type="hidden" name="list_id[]" value="677">
                    <div class="dd-handle"> PODCAST - Talking Tales - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="1216">
                    <input type="hidden" name="list_id[]" value="1216">
                    <div class="dd-handle"> PODCAST - POETRY AND ARTS - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="440">
                    <input type="hidden" name="list_id[]" value="440">
                    <div class="dd-handle"> PODCAST - Health And Lifestyle - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="1283">
                    <input type="hidden" name="list_id[]" value="1283">
                    <div class="dd-handle"> PODCAST - All About Business And Money - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="755">
                    <input type="hidden" name="list_id[]" value="755">
                    <div class="dd-handle"> PODCAST - HORROR AND CRIME - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="1299">
                    <input type="hidden" name="list_id[]" value="1299">
                    <div class="dd-handle"> PODCAST - BOLLYWOOD AND MORE..- ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="1865">
                    <input type="hidden" name="list_id[]" value="1865">
                    <div class="dd-handle"> PODCAST - EDUCATION - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="801">
                    <input type="hidden" name="list_id[]" value="801">
                    <div class="dd-handle"> PODCAST - SPORTS ENTHUSIASTS - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="1900">
                    <input type="hidden" name="list_id[]" value="1900">
                    <div class="dd-handle"> PODCAST - Teen Special - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="769">
                    <input type="hidden" name="list_id[]" value="769">
                    <div class="dd-handle"> PODCAST - Laugh Out Loud - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="1933">
                    <input type="hidden" name="list_id[]" value="1933">
                    <div class="dd-handle"> Podcast - Women's Corner - All </div>
                </li>
                    <li class="dd-item lists-li" data-id="1525">
                    <input type="hidden" name="list_id[]" value="1525">
                    <div class="dd-handle"> PODCAST - Kid's Corner - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="414">
                    <input type="hidden" name="list_id[]" value="414">
                    <div class="dd-handle"> PODCAST - Motivational- ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="1310">
                    <input type="hidden" name="list_id[]" value="1310">
                    <div class="dd-handle"> PODCAST - Connect Yourself - ALL </div>
                </li>
                    <li class="dd-item lists-li" data-id="140">
                    <input type="hidden" name="list_id[]" value="140">
                    <div class="dd-handle"> PODCAST - YOU MAY ALSO LIKE - ALL </div>
                </li>
             
            </ol>
        </div>
        <button class="btn btn-sm btn-outline pull-right btn-default reorder-btn" type="button">Reorder</button>
        <button disabled="" class="btn btn-sm btn-outline pull-right btn-default lo-submit-btn" type="button">Submit</button>
        </div>
    </div>
    <div class="col-md-4">
        <div class="white-box custome-catalogs">
            <h3 class="box-title">List Contents</h3>
            <div class="myadmin-dd dd" id="list-contents">
            <ol class="dd-list">
                <li class="dd-item content-li" data-id="37124">
                <div class="dd-handle"> The Millennial Athlete </div>
                </li>
                    <li class="dd-item content-li" data-id="38556">
                    <input type="hidden" name="content_id[]" value="38556">
                    <div class="dd-handle"> Zindagi Diaries </div>
                </li>
                    <li class="dd-item content-li" data-id="32187">
                    <input type="hidden" name="content_id[]" value="32187">
                    <div class="dd-handle"> Kahani Jaani Anjaani - Stories in Hindi </div>
                </li>
                    <li class="dd-item content-li" data-id="40041">
                    <input type="hidden" name="content_id[]" value="40041">
                    <div class="dd-handle"> वो कहानियां ।। Vo Kahaaniyan </div>
                </li>
                    <li class="dd-item content-li" data-id="37656">
                    <input type="hidden" name="content_id[]" value="37656">
                    <div class="dd-handle"> Howzzat! </div>
                </li>
                    <li class="dd-item content-li" data-id="15159">
                    <input type="hidden" name="content_id[]" value="15159">
                    <div class="dd-handle"> The Shayari Teller </div>
                </li>
                    <li class="dd-item content-li" data-id="15198">
                    <input type="hidden" name="content_id[]" value="15198">
                    <div class="dd-handle"> Kachi Mitti - A Body of Barefoot Stories </div>
                </li>
                    <li class="dd-item content-li" data-id="28462">
                    <input type="hidden" name="content_id[]" value="28462">
                    <div class="dd-handle"> The Reality Talk Show </div>
                </li>
                    <li class="dd-item content-li" data-id="27648">
                    <input type="hidden" name="content_id[]" value="27648">
                    <div class="dd-handle"> Dil Abhi Bhara Nahi </div>
                </li>
                    <li class="dd-item content-li" data-id="7988">
                    <input type="hidden" name="content_id[]" value="7988">
                    <div class="dd-handle"> Sex Vex </div>
                </li>
                    <li class="dd-item content-li" data-id="7063">
                    <input type="hidden" name="content_id[]" value="7063">
                    <div class="dd-handle"> Kini Aur Nani </div>
                </li>
                    <li class="dd-item content-li" data-id="17865">
                    <input type="hidden" name="content_id[]" value="17865">
                    <div class="dd-handle"> Aaj Kuch Naya Karte Hain </div>
                </li>
                    <li class="dd-item content-li" data-id="33371">
                    <input type="hidden" name="content_id[]" value="33371">
                    <div class="dd-handle"> Beyond Cliché </div>
                </li>
             
            </ol>
        </div>
            <button class="btn btn-sm btn-outline pull-right btn-default reorder-btn" type="button">Reorder</button>
            <button disabled="" class="btn btn-sm btn-outline pull-right btn-default lo-submit-btn" type="button">Submit</button>
        </div>
    </div>
</div>


@stop