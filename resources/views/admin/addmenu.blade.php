@extends('base') @section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.dropify').dropify();
    $("a.view1.tdaction.edit").click(function(){ 
      $("form.form-horizontal.addmenu").hide();
      //$("form.form-horizontal.editmenu").show();
    }); 

    $('[name="menu_name"]').on('keyup',function(){
      var val = $(this).val();
      var slug = slugify(val);
      $('[name="slug"]').val(slug);
  });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("select.form-control.select-menu").change(function(){
        $('.form-group.select-submenu').hide();
        $('[name="parent_menu"]').val("");
        $(this).find("option.submenu-option:selected").each(function(){
            $('.form-group.select-submenu').show();
        });
    }).change();
});

function getCatalogTypeView(event) {
    //console.log(event);
    var menu_name = document.getElementById("menu_name_" + event).innerText;
    var menu_type = document.getElementById("menu_type_" + event).innerText;
    var slug = document.getElementById("slug_" + event).value;
    var meta_title = document.getElementById("meta_title_" + event).value;
    var meta_desc = document.getElementById("meta_desc_" + event).value;
    var meta_keywords = document.getElementById("meta_keywords_" + event).value;
    var order = document.getElementById("order_" + event).innerText;
    var show_in_menu = document.getElementById("show_in_menu_" + event).innerText;
    var platform = document.getElementById("Platform_" + event).innerText;
    console.log(meta_desc);
    $(".head-title").html(menu_name);
            document.getElementById("slug_view").textContent = slug;
            if(meta_title!= ""){
                document.getElementById("meta_title_view").textContent = meta_title;
            }
            if(meta_desc!= ""){
            document.getElementById("meta_desc_view").textContent = meta_desc;
            }
            if(meta_keywords!= ""){
            document.getElementById("meta_keywords_view").textContent = meta_keywords;
            }
            document.getElementById("show_in_menu_view").textContent = show_in_menu;
            document.getElementById("platform_view").textContent = platform;
            document.getElementById("menu_type_view").textContent = menu_type;
          
    //console.log(menu_type.toLowerCase());
}
function getCatalogType(event) {
    //console.log(event);
    var menu_name = document.getElementById("menu_name_" + event).innerText;
    var menu_type = document.getElementById("menu_type_" + event).innerText;
    var slug = document.getElementById("slug_" + event).value;
    var parent_menu = document.getElementById("parent_menu_" + event).innerText;
    var meta_title = document.getElementById("meta_title_" + event).value;
    var meta_desc = document.getElementById("meta_desc_" + event).value;
    var meta_keywords = document.getElementById("meta_keywords_" + event).value;
    var order = document.getElementById("order_" + event).innerText;
    var show_in_menu = document.getElementById("show_in_menu_" + event).innerText;
    var platform = document.getElementById("Platform_" + event).innerText;
            document.getElementById("menu_name").value = menu_name;
            document.getElementById("slug").value = slug;
            document.getElementById("meta_keywords").value = meta_keywords;
            document.getElementById("meta_title").value = meta_title;
            document.getElementById("meta_desc").value = meta_desc;
            document.getElementById("meta_keywords").value = meta_keywords;
            document.getElementById("order").value = order;
           
            //document.getElementById("show_in_menu").value = show_in_menu;
            $("#parent_menu option[value='']").prop('selected', true);
            $('.form-group.select-submenu').hide();
            $("#action").val("update");
            $("#menu_id").val(event);
            $(".heading").html("");
            $(".heading").html("Edit Menu Items");
            $("#platform option[value='"+platform.toLowerCase()+"']").prop('selected', true);
            $("#menu_type option[value='"+menu_type.toLowerCase()+"']").prop('selected', true);
            if(menu_type.toLowerCase() == "submenu"){
                $('.form-group.select-submenu').show();
                $("#parent_menu option[value='"+parent_menu.toLowerCase()+"']").prop('selected', true);
            }
            if (show_in_menu.toLowerCase() == 'yes') {
            $('#show_in_menu').click();
             }
    //console.log(menu_type.toLowerCase());
}

function DeleteMenu(event){
    swal({
          title:"Are you sure?",
          text:"You want to delete this menu",
          icon:"error",
          buttons:true,
        })
        .then((willPush) => {
          if (willPush) {
            var id = event;
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
              method: "POST",
              url: "{{url('deletemenu')}}",
              data: {id:id},
              beforeSend: function() {
                  swal({   
                    title: "HOLD ON !",   
                    text: "Menu has been deleted.",   
                    icon:"warning", 
                    button: false 
                });
              },
              success:function(response){
                  console.log(response);
                  if(response.status.code == 200){
                    swal({   
                    title: "Good Job!",   
                    text: response.status.message,   
                    timer: 2000,
                    icon: "success",   
                    button: false 
                }).then((result) => {
  // Reload the Page
  location.reload();
});
                  }
              },
              error:function(xhr, status, error){
                handleAjaxError(xhr);
              }
            })
          }else{
            
          }
        });     
}  

</script> 
<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4> </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{url('#')}}">Bucket</a></li>
            <li class="active">Menu</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
    <div class="content_text headbar">
                <p>Manage Menu Items</p>
    </div>
    <div class="col-md-4">
        <div class="white-box" style="width: 100%;">
        @include('show_message')
            <!-- <h3 class="box-title m-b-0">Internal EPIC ON Display Ads</h3> -->
            <form class="form-horizontal" method="post" action="{{ route('savemenu') }}" enctype="multipart/form-data">
            <input type="hidden" name="action" id="action" value="add">
            <input type="hidden" name="menu_id" id="menu_id" value="">
            @csrf
                <h3 class="heading">Add Menu Items</h3>
                <div class="form-group">
                    <label for="redirection-url" class="col-sm-4 control-label">Select Menu</label>
                    <div class="col-sm-8">
                        <select name="menu_type" id="menu_type" class="form-control select-menu">
                            <option value="">Select Menu Type</option>
                            <option value="mainmenu">Main Menu</option>
                            <option value="submenu" class="submenu-option">Sub Menu</option>
                            <option value="secondarymenu">Secondary Menu</option>
                        </select>
                        @if ($errors->has('menu_type'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('menu_type') }}</strong>
                                </div>
                        @endif
                    </div> 
                </div> 
                <div class="form-group select-submenu">      
                    <label for="redirection-url" class="col-sm-4 control-label">Select Main Menu</label> 
                    <div class="col-sm-8">   
                        <select name="parent_menu" id="parent_menu" class="form-control ">
                            <option value="">Select Main Menu</option>
                            @foreach($data_menu as $key => $val)
                            <option value="{{$key}}">{{$val}}</option>
                            @endforeach
                        </select>  
                    </div>                  
                </div>    
                <div class="form-group">
                    <label for="redirection-url" class="col-sm-4 control-label">Name*</label>
                    <div class="col-sm-8">
                        <input name="menu_name" id="menu_name" value="" type="text"> </div>
                        @if ($errors->has('menu_name'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('menu_name') }}</strong>
                                </div>
                                @endif
                </div>
                <div class="form-group">
                    <label for="redirection-url" class="col-sm-4 control-label">Slug</label>
                    <div class="col-sm-8">
                        <input name="slug" id="slug" value="" type="text" readonly> </div>
                        @if ($errors->has('slug'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </div>
                                @endif
                </div>
              
                <div class="form-group">
                    <label for="redirection-url" class="col-sm-4 control-label">Meta Title</label>
                    <div class="col-sm-8">
                        <input name="meta_title" id="meta_title" value="" type="text"> </div>
                </div>
                <div class="form-group">
                    <label for="redirection-url" class="col-sm-4 control-label">Meta Description</label>
                    <div class="col-sm-8">
                        <textarea name="meta_desc" id="meta_desc" value="" type="text"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta-tags" class="col-sm-4 control-label">Meta Tags</label>
                    <div class="col-sm-8">
                        <input name="meta_keywords" id="meta_keywords" value="" type="text"> <span class="help-block">Press Enter After Each Meta Tag</span> </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Order</label>
                    <div class="col-sm-8">
                        <input name="order" id="order" value="" type="text"> </div>
                </div>
            
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-6 control-label">Show in Menu</label>
                    <div class="col-sm-6">
                        <a class="publish" title="" data-toggle="tooltip" data-original-title="Show in Menu">
                            <span class="label">No</span>
                            <input type="checkbox" hidden="hidden" id="show_in_menu" class="publish_unpublish" name="show_in_menu" value ="yes">
                            <label class="publish_unpublish" for="show_in_menu">
                            </label>
                            <span class="label">Yes</span>
                        </a>
                        
                    </div>
                </div>
                <div class="form-group">      
                    <label for="redirection-url" class="col-sm-4 control-label">Select Platform</label> 
                    <div class="col-sm-8">  
                        <select name="platform" id="platform" class="form-control select-menu">
                            <option value="">Select Platform</option>
                            <option value="domestic">BCCI Domestic</option>
                            <option value="international">BCCI International</option>
                            <option value="ipl">IPL</option>
                        </select>
                        @if ($errors->has('platform'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('platform') }}</strong>
                                </div>
                                @endif
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-9">
                        <input type="hidden" name="type" id="tag-type" value="">
                        <button type="submit" name="submit" id="submit" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                         <!-- <button  data-toggle="modal" data-target="#exampleModalLong2" name="submit" id="submit" class="btn btn-info waves-effect waves-light m-t-10">Cancel</button> -->
                       <!-- <button data-toggle="modal" data-target="#exampleModalLong2" class="submit cancel">Cancel </button>-->
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="white-box" style="width: 100%">
            <!--<h3 class="box-title">catalog</h3>-->
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered results listing_table list_view">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Menu Name</th>
                            <th>Parent Menu</th>
                            <th>Menu Type</th>
                            <th>Order</th>
                            <th>Platform</th>
                            <th>Show In Menu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $val)
                        @if($val['parent_menu'] == "0")
                        @php
                        $mainmenu = "-";
                        @endphp
                        @else
                        @php
                        $mainmenu  = $val['parent_menu'] ;
                        @endphp
                        @endif
                        <tr>
                            @if($val['status'] == true)
                            <td id="ID_{{$val['ID']}}">{{$val['ID']}}</td>
                            <td id="menu_name_{{$val['ID']}}">{{strtoupper($val['menu_name'])}}</td>
                            <td id="parent_menu_{{$val['ID']}}">{{strtoupper($mainmenu)}}</td>
                            <td id="menu_type_{{$val['ID']}}">{{strtoupper($val['menu_type'])}}</td>
                            <td id="order_{{$val['ID']}}">{{$val['order']}}</td>
                            <td id="Platform_{{$val['ID']}}">{{strtoupper($val['platform'])}}</td>
                            <td id="show_in_menu_{{$val['ID']}}">{{strtoupper($val['show_in_menu'])}}</td>
                            <input type="hidden" name="slug_{{$val['ID']}}" id="slug_{{$val['ID']}}" value="{{$val['slug']}}">
                            <input type="hidden" name="meta_title_{{$val['ID']}}" id="meta_title_{{$val['ID']}}" value="{{$val['meta_title']}}">
                            <input type="hidden" name="meta_desc_{{$val['ID']}}" id="meta_desc_{{$val['ID']}}" value="{{$val['meta_desc']}}">
                            <input type="hidden" name="meta_keywords_{{$val['ID']}}" id="meta_keywords_{{$val['ID']}}" value="{{$val['meta_keywords']}}">
                            <td class="action">
                                <a class="view1 open-data tdaction" data-target="#Viewpage" title="" data-toggle="modal" id="{{$val['ID']}}" data-original-title="view" onClick="getCatalogTypeView(this.id)">
                                   <span class="ti-eye"></span>
                                </a>
                                <a class="view1 tdaction edit" title="" data-toggle="tooltip" href="javascript:void(0)" data-original-title="Edit" id="{{$val['ID']}}" onClick="getCatalogType(this.id)">
                                    <span class="ti-pencil-alt"></span>
                                </a>

                                <a class="view_delete single_delete_icon tdaction" href="javascript:void(0)" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong" id="{{$val['ID']}}" onclick = "DeleteMenu(this.id)">
                                    <span class="ti-trash"></span>
                                </a>

                            </td>
                        </tr>
                        @endif
                        @endforeach
                       
                    </tbody>
                </table>
                <div class="modal fade in" id="Viewpage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 100%; margin: 0 auto;">
                <div class="modal-header">
                    <h2 class="Preview-title">Preview Menu Item</h2>
                    <!-- <a class="recent-content__add btn primary medium rightbtn" href="#">Edit Detail</a> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card-body wizard-content">
                    <form data-parsley-validate=""  name="article_form"  enctype="multipart/form-data" class="validation-wizard wizard-circle wizard clearfix" role="application" novalidate=""><div class="steps clearfix"><ul role="tablist"><li role="tab" class="first last current" aria-disabled="false" aria-selected="true"><a id="article_form-t-0" href="#article_form-h-0" aria-controls="article_form-p-0"><span class="current-info audible">current step: </span><span class="step">1</span> Basic Info</a></li></ul></div><div class="content clearfix">
                        <h6 id="article_form-h-0" tabindex="-1" class="title current">Basic Info</h6>
                        <section id="article_form-p-0" role="tabpanel" aria-labelledby="article_form-h-0" class="body current" aria-hidden="false">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="pdlt" for="wfirstName2">Menu Name<span class="date" id="publishTo"></span>
                                        </label>
                                        <h2 id="title" class="head-title"></h2>
                                    </div>
                                </div>  
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="pdlt" for="wfirstName2">
                                            Menu Type:
                                            <span class="date" id="menu_type_view"></span><br>
                                            Menu Slug:
                                            <span class="date" id="slug_view"></span>  <br>
            
                                            Platform: 
                                            <span class="date" id="platform_view"></span>
                                            
                                        </label>
                                        <!--<div class="date" id="publishTo"></div> --> 
                                    </div>
                                </div>


                                <div class="col-md-6">    
                                    <div class="form-group">
                                        <label class="pdlt" for="wfirstName2">
                                            Meta Title:
                                            <span class="date" id="meta_title_view"></span><br>
                                            Meta Description:
                                            <span class="date" id="meta_desc_view">
                                          
                                            </span>  <br>
                                            Meta Tag: 
                                            <span class="date" id="meta_keywords_view"> </span><br>
                                            
                                            Show in Menu: 
                                            <span class="date" id="show_in_menu_view"></span>
                                            
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </section>
                    </div><div class="actions clearfix"><ul role="menu" aria-label="Pagination"><li class="disabled" aria-disabled="true"><a href="#previous" role="menuitem">Previous</a></li><li aria-hidden="true" class="disabled" aria-disabled="true" style="display: none;"><a href="#next" role="menuitem">Next</a></li><li aria-hidden="false"><a href="#finish" role="menuitem">Submit</a></li></ul></div></form>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</div> 

@stop
