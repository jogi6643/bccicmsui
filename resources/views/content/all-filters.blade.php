<div  class="modal fade" id="Allfilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 60%; margin: 0 auto;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h2 >All filters</h2>
            <div class="row">
                <div class="col-md-7 seperator">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Filter by language</label>
                            <select name="language"  class="selectpicker" multiple data-actions-box="true" >
                                <option value="english" selected>English</option>
                                <option value="marathi">Marathi</option>
                                <option value="hindi">Hindi</option>
                                <option value="4">Tamil</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Filter by status</label>
                            <select name="language"  class="selectpicker" multiple data-actions-box="true" >
                                <option value="english" selected>Published</option>
                                <option value="marathi">In Draft</option>
                                <option value="hindi">In Review</option>
                                <option value="4">Unpublished</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Filter by import source</label>
                            <select name="language"  class="selectpicker" multiple data-actions-box="true" >
                                <option value="english" selected>Manual upload</option>
                                <option value="marathi">External provider</option>
                                <option value="hindi">Workflows</option>
                                <option value="4">Tamil</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-6">
                            <label>From date</label>
                            <input type="text" class="form-control datepicker" value="2021-11-30 " name="created_date">
                        </div>
                        <div class="col-md-6">
                            <label>To date</label>
                            <input type="text" class="form-control datepicker" value="2021-11-30 " name="created_date">
                        </div>
                    </div>
                </div>
            </div>
            <h2>Content references</h2>
            <div class="reference-search" >
                <div class="reference-search__select-container">
                    <select class="reference-search-s">
                        <option selected="selected" disabled="disabled">Select type</option>
                        <option>TEXT</option>
                        <option>Photo</option>
                        <option>Video</option>
                        <option>Document</option>
                    </select>

                    <select class="form-control selectpicker" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">
                        <option value='<h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>'><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span></option>
                        <option value='<h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>'><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                        <option value='<h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>'><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                        <option value='<h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class="id">ID: 154375</span>'><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                    </select>


                </div>
                <div class="selectedvalue" role="document"></div>
                <ul class="added-freq">
                    <li data-toggle="modal" data-target="#Favourites">
                        <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added

                    </li>
                    <li  data-toggle="modal" data-target="#Favourites">
                        <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                    </li>
                    <li  data-toggle="modal" data-target="#Favourites">
                        <i class="mdi mdi-heart-outline fa-fw" data-icon="v"></i> Favourites
                    </li>
                </ul>
                <div  class="modal fade" id="Favourites" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="width: 60%; margin: 0 auto;">
                            <button type="button" class="close btn innerpopup"  aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h2 >Click the add button to attach the content reference</h2>
                            <select class="form-control selectpicker" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">
                                <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                                <option ><h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID: 154375</span></option>
                                
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <h2>Tags</h2>
            <input type="text" id="inputTag" value="" data-role="tagsinput">
            <ul class="added-freq">
                <li  data-toggle="modal" data-target="#Favourites">
                    <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added
                </li>
                <li  data-toggle="modal" data-target="#Favourites">
                    <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                </li>
            </ul>

            <a class="recent-content__add btn primary medium" href="#">Submit</a>

        </div>
    </div>
</div> 

<script>
$( document ).ready(function() {
        $("button.btn.btn--toggle-filter").click(function(){
                $(".reference-search .inner.open ").append('<button class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>');
        });
        $("button.btn.btn--toggle-filter").click(function(){
            $("button#add-sel").click(function(){        
                var optionsselected = $("select#browsers").val();
                
                $('.selectedvalue').html("");
                $.each(optionsselected,function(i,x) {
                    
                    $('.selectedvalue').append('<div class="selectedcol ">'+x+'<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>')
                }); 
                //$('div#Allfilter .reference-search ul.dropdown-menu.inner li.selected').hide();  
            });
            $('.selectedvalue').on('click', '#close-selected', function() {
                $(this).parents('.selectedcol').fadeOut();
            });      

        });
        $('.selectedvalue').on('click', '#close-selected', function() {
            $(this).parents('.selectedcol').fadeOut();
        });   
        $("button.close.btn.innerpopup").click(function(){
            $('#Favourites').modal('hide');
        });
  

});

</script>