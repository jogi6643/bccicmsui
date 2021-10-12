<form data-parsley-validate action="{{ route('addArticle') }}" name="article_form" id="article_form" method="post"
    enctype="multipart/form-data" class="validation-wizard wizard-circle">

    {{ csrf_field() }}
    <button type="button" id="collapsesidebar-btn" class="collapse-btn">
        <span> Collapse sidebar</span>
    </button>
    <h6>Basic Info</h6>
        <section>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="wfirstName2"> Headline*:</label>
                        <input type="text" id="headline" required class="form-control" value="" name="title">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="wfirstName2">Url Segment*:</label>
                        <input type="text" id="urlsegment" required class="form-control" value=""
                                                            name="urlsegment">
                    </div>
                </div>
           
        </div>  
        <div class="row">    
            <div class="col-md-6">
                <div class="form-group">
                        <label for="wemailAddress2"> Language*</label>
                        <select name="langauge" class="form-control" id="langauge" required>
                            <option value="" disabled>Select Language</option>
                        @foreach ($data as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select> 
                </div>
                <div class="form-group">
                    <label for="wfirstName2">Content Type:</label>
                    <input type="text" readonly class="form-control" value="Article" name="content_type">
                </div>
                <div class="form-group">
                    <label for="wfirstName2">Author*:</label>
                    <input type="text" class="form-control" value="" name="author" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2">Photo*:</label>
                    <input type="file" class="form-control dropify" value="" accept="image/*"  data-parsley-fileextension='jpg,png,jpeg,gif,svg'  name="photo" required> 
                </div>
            </div>
        </div>
        <div class="row"> 
            <!-- <div class="col-md-6">     
                <div class="form-group">
                    <label for="wfirstName2">Video Duration:</label>
                    <input type="text" class="form-control" value="" name="video_duration">
                </div>
            </div> -->
            <!-- <div class="col-md-6">      
                <div class="form-group">
                    <label for="wfirstName2">Match Id:</label>
                    <input type="text" class="form-control" value="" name="match_id">
                </div>
            </div> -->

            <!-- <div class="col-md-6">    
                <div class="form-group">
                    <label for="wfirstName2">Keywords:</label>
                    <input type="text" class="form-control" value="" name="keywords">
                </div>
            </div> -->
            <!-- <div class="col-md-6">      
                <div class="form-group">
                    <label for="wfirstName2">LeadMedia:</label>
                    <input type="text" class="form-control" value="" name="leadMedia">
                </div>
            </div> -->
            <div class="col-md-6 clear-b">
                <div class="form-group">
                    <label for="wfirstName2"> Short Description*:</label>
                    <input type="text" required class="form-control" value="" name="short_description">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2">Additional Info*:</label>
                    <input type="text" class="form-control" value="" name="additionalInfo" required>
                </div>
            </div>
        </div>
        <div class="row">    
            <!-- <div class="col-md-6">     
                <div class="form-group">
                    <label for="wfirstName2">Match Formats:</label>
                    <input type="text" class="form-control" value="" name="match_formats">
                </div>
            </div> -->


        </div>
        <div class="row">    
            <!-- <div class="col-md-6">                
                <div class="form-group">
                    <label for="wfirstName2">Language:</label>
                    <input type="text" class="form-control" value="" name="language">
                </div>
            </div> -->
            {{-- <div class="col-md-6">    
                <div class="form-group">
                    <label for="wfirstName2">References:</label>
                    <input type="text" class="form-control" value="" name="references">
                </div>
            </div> --}}

            <!-- <div class="col-md-6">
                <div class="form-group " style="margin-top: 25px">
                    <label for="behName1" class="fullwidth">Location:</label>
                    <button type="button" class="location-search">Search</button> 
                </div>  
            </div>             -->

                      
            <!-- <div class="col-md-6">    
                <div class="form-group">
                    <label for="wfirstName2">total_viewcount:</label>
                    <input type="text" class="form-control" value="" name="total_viewcount">
                </div>
            </div> -->
            <!-- <div class="col-md-6">    
                <div class="form-group">
                    <label for="wfirstName2">Total Viewcount:</label>
                    <input type="text" class="form-control" value="" name="total_viewcount">
                </div>
            </div> -->

            <!-- <div class="col-md-6">     
                <div class="form-group">
                    <label for="wfirstName2">Summary:</label>
                    <input type="text" class="form-control" value="" name="summary">
                </div>
            </div> -->

            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2">Description</label>
                    <textarea class="form-control " required id="description" name="description" rows="9"></textarea>
                </div>
                <div class="form-group">
                    <label for="wlastName2">Summary</label>
                    <textarea class="form-control " required name="summary" rows="9"></textarea>
                </div>

            </div> -->  

   
    </section>

    <h6>Meta Information</h6>
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wemailAddress2"> Read time (seconds) *</label>
                    <textarea class="form-control" rows="3" name="readtime" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wlastName2"> Hotlink URL*</label>
                    <textarea class="form-control" rows="3"  name="hoturl" required></textarea>
                </div>
            </div>
        </div> 
        <div class="row"> 
        <!-- 
            <div class="col-md-6">
                <div class="form-group date-time">
                    <label for="behName1">Display date</label>
                    <input type="date" class="form-control dtpicker" placeholder="23/08/2021" value="">
                    <input type="time" class="form-control tmpicker" value="" placeholder="time 10:30">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2">Published By:</label>
                    <input type="text" class="form-control" value="" name="published_by">
                </div>
            </div>-->
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label class="fullwidth" for="behName1 ">Location Search</label>
                    <button type="button" class="location-search">Search</button>
                </div>
            </div> -->
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Location label</label>
                    <input type="text" class="form-control" value="" >
                </div>
            </div> -->
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Latitude</label>
                    <input type="text" class="form-control" value="" >
                </div>
            </div> -->
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Longitude</label>
                    <input type="text" class="form-control" value="" >
                </div>
            </div> -->
  
        </div>
        <div class="row mb-25">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2">Publish Date*:</label>
                    <input type="date" class="form-control dtpicker" value="" name="publish_date" required>
                    <input type="time" class="form-control tmpicker" value="" name="publish_time" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2">Expiry Date*:</label>
                    <input type="date" class="form-control dtpicker" value="" name="expiryDate" required> 
                    <input type="time" class="form-control tmpicker" value="" name="expiryTime">
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" >
                    <label for="wfirstName2">Location Search* :</label>
                    <input type="text" name="location_search" id="location_search" class="form-control" placeholder="Choose Location" required>
                    <!-- <input type="text" class="form-control" value="" name="location"> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Latitude :</label>
                    <input type="text" id="latitude" name="latitude" class="form-control" readonly>
                    <!-- <input type="text" class="form-control" readonly="" value="" name="latitude">  -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="behName1">Longitude:</label>
                    <input type="text" name="longitude" id="longitude" class="form-control" readonly>
                    <!-- <input type="text" class="form-control" readonly="" value="" name="longitude">  -->
                </div>
            </div>              
        </div>
        <?php $get_tags = platformList(); ?>  
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2">Platform*:</label>
                    <!-- <input type="text" class="form-control" value="" name="platform"> -->
                    <select class="selectpicker"  multiple data-actions-box="true" required="" id="feild"name="platform[]" value="{{ old('platform') }}">
                        @foreach ($get_tags as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>


                {{-- <div class="form-group">
                    <label for="wfirstName2"> <a href="#">URL Segment</a></label>
                    <label for="wfirstName2"> <a href="#">Edit URL </a></label>
                </div>
                <div class="form-group">
                    <label for="myfile">Subtitle</label>
                    <input type="file" id="myfile" name="myfile">
                </div> --}}
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wfirstName2">Status*:</label>
                    <!-- <input type="text" class="form-control" value="" name="platform"> -->
                    <select name="current_status" id="cars" class="form-control" required>
                    <option value="" disabled>Select Status</option>
                        @foreach($status as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div> 
    </section>
    <h6>Segmentation</h6>
    <section>
        <div class="row">
            <div class="col-md-6" style="margin-bottom: 10px;">
                <div class="form-group checkbox-al">
                    <input type="checkbox" id="restrict" name="restrict" value="Bike">
                    <label for="restrict"> Restrict content to logged in users</label><br>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="behName1">Keywords*:</label>
                    <input type="text" name="keywords" class="form-control" value="" required>
                </div>
            </div> 
        </div>  
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

    </section>
    <div id="collapsingsidebar" class="collapssidebar">
        {{-- // code Remove --}}
         <?php $get_tags = get_all_tags();?>
        @include('releted_references.add-content-reference')
    </div>
    <div class="row">
        <div class="col-md-12 bodycontent">
            <div class="form-group">
                <label for="wemailAddress2"> Content * </label>
                <textarea class="form-control" id="description" value="" name="body" rows="3"></textarea>
            </div>
        </div> 
    </div>        


</form>


<script>

</script>

<script src="{{ asset('js/articles/articles.js') }}" type="text/javascript"></script>
{{-- <script src="{{ asset('js/content_refernce/content_refernce.js') }}" type="text/javascript"></script> --}}


<script src="https://cdn.tiny.cloud/1/5orxol55pinopywbk09yrbw1ryxu73rl6q0r6h29utlwe1s9/tinymce/5/tinymce.min.js"
referrerpolicy="origin"></script>
{{-- <script src="https://cdn.tiny.cloud/1/5orxol55pinopywbk09yrbw1ryxu73rl6q0r6h29utlwe1s9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDetZZwXV4c_mQULaCiJLJvT8Z_XYhfQbI&libraries=places"></script>
    <script>
        $(document).ready(function() {
            $("#latitudeArea").addClass("d-none");
            $("#longtitudeArea").addClass("d-none");
        });
    </script>
    <script>
        $(document).ready(function() {
        $("#headline").keyup(function() {
            var Text = $('#headline').val()
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $("#urlsegment").val(Text);   
        })

        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var input = document.getElementById('location_search');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());

                $("#latitudeArea").removeClass("d-none");
                $("#longtitudeArea").removeClass("d-none");
            });
        }
    </script>
<script>
    tinymce.init({
        selector: '#description1',
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
 $(document).ready(function () {  
 
    // End title convert in to segnatamente
    $('.reference-search__select-container').on('click', '.dropdown.bootstrap-select.form-control.refclass',
    function() {
        $("#collapsingsidebar .reference-search .inner").append(
            '<button type="button" class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
        );
        $("#collapsingsidebar .reference-search .inner").append(
            '<div class="loader-background"><div class="loader"></div></div>'
        );
            for (let i = 1; i <= $('select.refclass option').length; i++) {
            if(i==$('select.refclass option').length)
            {   console.log(i+"=="+$('select.refclass option').length);
                $('.loader-background').hide(); 
            }
          }
       // if ($('select.refclass option').length != 0) {
        //    $('.loader-background').hide();
        ///}
    });
$('.reference-search__select-container').on('click',
    '.dropdown.bootstrap-select.form-control.contentClass2',
    function() {
        $("#collapsingsidebar .reference-search .inner").append(
            '<button type="button" class="addtocontentrefrence" id="add-sels"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
        );
        $("#collapsingsidebar .reference-search .inner").append(
            '<div class="loader-background"><div class="loader"></div></div>'
        );
        ///if ($('select.contentClass1 option').length != 0) {
          //  $('.loader-background').hide();
        //}
          for (let i = 1; i <= $('select.contentClass2 option').length; i++) {
            if(i==$('select.contentClass2 option').length)
            {   console.log(i+"=="+$('select.contentClass2 option').length);
                $('.loader-background').hide(); 
            }
          }
    });
$('.reference-search__select-container').on('click', '.dropdown.bootstrap-select.form-control.refclass',
    function() {
        $('.dropdown.bootstrap-select.form-control.refclass').on('click', 'button#add-sel',
            function() {

                var optionsselected = $("select.refclass").val();
                $.each(optionsselected, function(i, x) {
                    var myStr = x.replace(/(<([^>]+)>)/ig, '');
                    var strArray = myStr.split("ID:");
                    dataid = strArray[1];
                    $('.selectedvalue').append(
                        '<div class="selectedcol" onclick="remove_cont_ref('+dataid + ')"  id="' + dataid + '">' + x +
                        '<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>'
                    )

                });

            });
    });
$('.reference-search__select-container').on('click',
    '.dropdown.bootstrap-select.form-control.contentClass2',
    function() {
        $('.dropdown.bootstrap-select.form-control.contentClass2').on('click', 'button#add-sels',
            function() {
                var optionsselected = $("select.contentClass2").val();
                //$('.selectedrelcont').html("");
                $.each(optionsselected, function(i, x) {
                    var myStr = x.replace(/(<([^>]+)>)/ig, '');
                    var strArray = myStr.split("ID:");
                    dataid = strArray[1];
                    $('.selectedrelcont').append('<div class="selectedcol " onclick="remove_cont('+dataid + ')"  id="' + dataid + '">' + x +
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

// End loader

    $("#reference").on('change', function () {
      var ref = $(this).val();
      if(ref!=undefined && ref!=null)
      {
          $.ajax({
               type: "POST",
               url: "/commonsearch",
               data:{type:ref},
               dataType: 'json',
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
               success: function (res){
                    $('select.refclass').empty();
                    $('select.refclass').selectpicker('destroy');
                    $('select.refclass').selectpicker();
                $.each(res.data, function (index, value) {
                    var option = '<option data-id="'+value.ID+'" value="<h2>'+value.title +'</h2> <span>'+value.language +'|'+ 'Last updated 31/08/2021</span> <span>ID:'+value.ID+'</span>"><h2>'+value.title +'</h2> <span>'+value.language +'|'+ 'Last updated 31/08/2021</span> <span>ID:'+value.ID+'</span></option>';
                    // var option = '<option value="'+value.title + "*" +value.ID+'</span>"><h2>'+value.title +'</h2> <span>'+value.language +'|'+ 'Last updated 31/08/2021</span> <span>ID:'+value.ID+'</span></option>';
                    $('select.refclass').append(option);
                });
                $('select.refclass').selectpicker('refresh');
               
                  if ($('select.refclass option').length != 0) {
                      $('.loader-background').hide();
                  }
               },
               error: function(){
                   return false;
               },
               complete: function(){
                   console.log('complete');
               }
          })
      }
     
    });



// Releted 
    $("#contentId").on('change', function () {
        var ref = $(this).val();
        
        if(ref!=undefined && ref!=null)
        {
            $.ajax({
                 type: "POST",
                 url: "/commonsearch",
                 data:{type:ref},
                 dataType: 'json',
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                 success: function (res){
                    $('select.contentClass2').empty();
                    $('select.contentClass2').selectpicker('destroy');
                    $('select.contentClass2').selectpicker();
                  $.each(res.data, function (index, value) {
                      var option = '<option data-id="'+value.ID+'" value="<h2>'+value.title +'</h2> <span>'+value.language +'|'+ 'Last updated 31/08/2021</span> <span >ID:'+value.ID+'</span>"><h2>'+value.title +'</h2> <span class="lan">'+value.language +'|'+ 'Last updated 31/08/2021</span> <span class="id">ID:'+value.ID+'</span></option>';
                      $('select.contentClass2').append(option);
                  });
                  $('select.contentClass2').selectpicker('refresh');
                  if ($('select.contentClass2 option').length != 0) {
                      $('.loader-background').hide();
                  }
                 },
                 error: function(){
                     return false;
                 },
                 complete: function(){
                     console.log('complete');
                 }
            })
        }
       
      });
// ALERT

$("#inputTag").select2({
    minimumInputLength: 2,
    tags: [],
    ajax: {
        url: "/articletagList",
        dataType: 'json',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        type: "POST",
        success: function (res){
           console.log(res.data);
           $.each(res.data, function (index, value) {
            console.log(value.label);
            var option = '<option>'+value.label+'</option>';
            $('#inputTag').append(option);
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


