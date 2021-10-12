@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
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

<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        <ol class="breadcrumb">
           <!--  <li><a href="{{url('#')}}">Traysorting</a></li> -->
            <li class="active">Traysorting</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>

<!-- .row -->

<div class="row">
    <div class="col-md-4">
        <div class="white-box col-md-12 ">
            <h3 class="box-title">Catalogs <br>
            <small>Click on catalog to get lists</small>
            </h3>
            <div class="myadmin-dd dd" id="catalogs">
                <ol class="dd-list catalog-listing">
                @foreach($data as $key => $list)
                        @if($list['status']== true)
                        <li class='dd-item lists-li' data-id='{{ $list["slug"] }}'>
                        <input type="hidden" name="list_id[]" value="{{$list['slug']}}">
                            <div class='dd-handle'> {{ $list["menu_name"] }}</div>
                        </li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="white-box col-md-12">
            <form action="{{ route('list-sort') }}" method="post">
            <h3 class="box-title">Lists</h3>
            <div class="myadmin-dd dd" id="lists">
               
            </div>
            <button class="btn btn-sm btn-outline pull-right btn-default reorder-btn" type="button">Reorder</button>
            <button disabled="" class="btn btn-sm btn-outline pull-right btn-default lo-submit-btn list-submit" type="button">Submit</button>
            <div class="clear-fix" style="clear:both;"></div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="white-box col-md-12">
            <form action="{{ route('list-content-sort') }}" method="post">
            <h3 class="box-title">List Contents</h3>
            <div class="myadmin-dd dd" id="list-contents">
                
            </div>
            <button class="btn btn-sm btn-outline pull-right btn-default reorder-btn" type="button">Reorder</button>
            <button disabled="" class="btn btn-sm btn-outline pull-right btn-default lo-submit-btn content-submit" type="button">Submit</button>
            <div class="clear-fix" style="clear:both;"></div>
            </form>
        </div>
    </div>
</div>

</div>
</div>

</section>
   
</div>

<script type="text/javascript">
$(document).ready(function(){  

    $('div#catalogs').on('click', 'ol.dd-list.catalog-listing li', function() { 
        $(this).addClass('active').siblings().removeClass('active'); 
        $('div#lists ol').remove();  
        var dataId = $(this).attr("data-id");
        //console.log(dataId);
        if(dataId){
            $('.preloader').show();
            $.ajax({
                url: APP_URL + '/getcataloglist',
                type: "GET",
                data: {
                    'page_slug':dataId
                },
                success: function(data) {
                    $('.preloader').hide();
                   // var response = $.parseJSON(data);
                    //console.log(data.list);
                    //if(response.status.code == 200){
                       
                        var htmls = "<ol class='dd-list listings'>";
                        $.each(data.list, function () {   
                            htmls+= "<li class='dd-item content-li' data-id='" +this.ID +"'>";
                            htmls+='<input type="hidden" name="list_id[]" value="'+this.ID+'">';
                            htmls+= "<div class='dd-handle'>"+this.title+"</div></li>";
                        });
                        htmls+= "</ol>";
                        //console.log(htmls);
                        $("#lists").html(htmls);
                    
                }
            });
        }
        
        
    });

    $('div#lists').on('click', 'ol.listings li', function() {
        $(this).addClass('active').siblings().removeClass('active');
        $('div#list-contents ol').remove();  
        var listId = $(this).attr("data-id");
        var catalogs = catalogs = $("div#catalogs li.active").attr("data-id");
        console.log(listId);
        if(listId){
            $('.preloader').show();
            $.ajax({
                url: APP_URL + '/getListContent',
                type: "GET",
                data: {
                    'list_id':listId,
                    'page_slug':catalogs
                },
                success: function(data) {
                    $('.preloader').hide();
                    var response = $.parseJSON(data);
                    if(response.status.code == 200){
                        var final_arr = [];
                        $.each(response.payload.content_list, function () {   
                            //console.log(this.list_order);
                            if (this.list_order != undefined) {
                                //final_arr[] = this;
                                //var order = this.list_order;
                               // console.log(response.payload.content_list);
                                final_arr[this.list_order] = this;
                            }
                        });
                        var filteredArr = final_arr.filter(elm => elm);
                        //final_arr.sort((a, b) => a - b);
                        filteredArr.sort(function(a, b) {
                            return a - b;
                            });

                        //console.log(filteredArr);
                        var htmls = "<ol class='dd-list listings'>";
                        $.each(filteredArr, function () {   
                            htmls+= "<li class='dd-item content-li' data-id='" +this.ID +"'>";
                            htmls+='<input type="hidden" name="content_id[]" value="'+this.ID+'">';
                            htmls+= "<div class='dd-handle'>"+this.title+"</div></li>";
                        });
                        htmls+= "</ol>";
                        //console.log(htmls);
                        $("#list-contents").html(htmls);
                    }else{
                        
                    }
                }
            });
        }
        
        if(listId === '1'){
             $("div#list-contents").append("<ol class='dd-list'><li class='dd-item content-li' data-id='40209'><div class='dd-handle'> Main Hoon Hero No 1 </div></li><li class='dd-item content-li' data-id='39870'><div class='dd-handle'> GUJARAT BHAVAN </div></li><li class='dd-item content-li' data-id='40020'><div class='dd-handle'> Ziddi </div></li><li class='dd-item content-li' data-id='32409'><div class='dd-handle'> BAD PAPA </div></li><li class='dd-item content-li' data-id='27421'><div class='dd-handle'> THEEVRAM </div></li><li class='dd-item content-li' data-id='22'><div class='dd-handle'> Lost Recipes </div></li><li class='dd-item content-li' data-id='27519'><div class='dd-handle'> SARABHAM </div></li></ol>");   
        }
    });

    $(".reorder-btn").click(function(){
        $(this).parent().find('.myadmin-dd').nestable();
        $(this).parent().find('.lo-submit-btn').removeAttr('disabled');
        $(this).parent().find('.content-submit').removeAttr('disabled');
        $(this).parent().find('.telco-submit-btn').removeAttr('disabled');
        $(this).attr('disabled','disabled');
    });

    $(".list-submit").click(function(){
    var lst_ord_ids = $(this).parent().find("input[name='list_id[]']").map(function(){return $(this).val();}).get();
    var catalogs = $("div#catalogs li.active").attr("data-id");
    var content_list =[];  
    $.each(lst_ord_ids, function(key,val) {
            key = parseInt(key +1);
            content_list[val] = key;
        });
        $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
        method: "POST",
        url: APP_URL + '/tray-list-sort',
        data: {page:catalogs,content_list:content_list},
        beforeSend: function() {
            $('.preloader').show();
          },
        success:function(response){
            var res = JSON.parse(response);
            if(res.status.code == 200){
            $('.preloader').hide(); 
            swal({   
            title: "Success!",   
            text: "Changes have been updated.",   
            timer: 3000,   
            button: false 
        })
        .then(() => {
          $(".lo-submit-btn").attr('disabled','disabled');
          $('.reorder-btn').removeAttr('disabled');
        });
            }else{

            }
          // $("#lists").html(response);
          //console.log(response);
        },
        error:function(xhr, status, error){
          handleAjaxError(xhr);
        }
      })
  });
  $(".content-submit").on("click",function(){
    var lst_ord_ids = $(this).parent().find("input[name='content_id[]']").map(function(){return $(this).val();}).get();
    var list_id = $("div#lists li.active").attr("data-id");
    var catalogs = $("div#catalogs li.active").attr("data-id");
   // var content_list_data =[];  
    //lst_ord_ids = lst_ord_ids.filter((v) => v != '');
    //console.log(lst_ord_ids);
    // $.each(lst_ord_ids, function(key,val) {
    //     console.log(val);
    //         key = parseInt(key + 1);
    //         content_list_data[val] = key;
    //     });
    //      //content_list_data = content_list_data.filter((v) => v != '');
         //console.log(content_list_data.length);
        // console.log(content_list_data);
    $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
        method: "POST",
       // dataType: 'json',
        url: APP_URL + '/list-content-sort',
        data: {page:catalogs,content_list:lst_ord_ids,tray_id:list_id},
        beforeSend: function() {
            $('.preloader').show();
          },
        success:function(response){
            var res = JSON.parse(response);
            if(res.status.code == 200){
            $('.preloader').hide(); 
            swal({   
            title: "Success!",   
            text: "Changes have been updated.",   
            timer: 3000,   
            button: false 
        })
        .then(() => {
          $(".lo-submit-btn").attr('disabled','disabled');
          $('.reorder-btn').removeAttr('disabled');
        });
            }else{

            }
          // $("#lists").html(response);
          //console.log(response);
        },
        error:function(xhr, status, error){
          handleAjaxError(xhr);
        }
      })
  });

});
 
</script>>
@stop