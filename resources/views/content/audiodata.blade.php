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

    /* $('#selectall').click(function() {
     if($(".allselect").prop('checked', true)){
        alert(1);
        $(".allselect").prop('unchecked', true);

    } 

      $(".allselect").prop('checked', true);
});

        });*/

    
})
</script>

<script type="text/javascript">

   function getval(sel)
    {
      if(sel.value==="selectall"){
          $("#deleteall").hide();
          $("#selectall").show();
      }else{
        $("#selectall").hide();
          $("#deleteall").show();
      }
    }

    

</script>

<!-- <script type="text/javascript">
    $(document).ready(function(){
    $('.check:button').toggle(function(){
        $('input:checkbox').attr('checked','checked');
        $(this).val('uncheck all')
    },function(){
        $('input:checkbox').removeAttr('checked');
        $(this).val('check all');        
    })
})


</script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.checked_all').on('change', function() {     
                $('.checkbox').prop('checked', $(this).prop("checked"));              
        });
        //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked
        $('.checkbox').change(function(){ //".checkbox" change 
            if($('.checkbox:checked').length == $('.checkbox').length){
                   $('.checked_all').prop('checked',true);
            }else{
                   $('.checked_all').prop('checked',false);
            }
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
            <li><a href="{{url('/')}}">Manage Videos</a></li>
            <li class="active"></li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">

<!-- <input type="button" class="check" value="check all"/>

   <input type="checkbox" class="cb-element" /> Checkbox  1
   <input type="checkbox" class="cb-element" /> Checkbox  2
   <input type="checkbox" class="cb-element" /> Checkbox  3 -->
  
  <section>
  
  <div class="content_text"><p>Manage Audio</p></div>
  
<div class="top-search">
    <div class="row content-search-header">
            <section class="col-md-6 col-sm-12">
            @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block alertMessage">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block alertMessage">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <form class="example" action="/action_page.php">
                    <div class="example">
                      <input type="text" placeholder="Enter search term..." name="search2">
                      <button type="submit"><i class="fa fa-search"></i></button>
                    </div>  
                </form>
            </section>
            <section class="col-md-6 col-sm-12">
               <div class="form-inline">
                 <div class="col-md-5">
                    <div class="custom-select" style="">
                        <label>Filter by language</label>
                      <select>
                        <option value="0">Select All:</option>
                        <option value="1">English</option>
                        <option value="2">Marathi</option>
                        <option value="3">Hindi</option>
                        <option value="4">Tamil</option>
                      </select>
                    </div>
                 </div>

                 <div class="col-md-5">
                    <div class="custom-select" style="">
                        <label>Filter by status</label>
                      <select>
                        <option value="0">Select All:</option>
                        <option value="1">Published</option>
                        <option value="2">In Draft</option>
                        <option value="3">In Review</option>
                        <option value="4">Unpublished</option>
                      </select>
                    </div>
                 </div>

                 <div class="col-md-2">
                    <button class="btn btn--toggle-filter">All filters</button>
                 </div>
                    <!-- ngRepeat: filter in contentFilters -->

                </div>
            </section>
    </div>
</div>


    <div class="card" data-content-list="data.articleList"><div class="results">

    <!-- ngIf: list.items.length -->
    <h2 class="show-data-page">Showing 1 - 24 of 143 results</h2>
    <!-- end ngIf: list.items.length -->

    <div class="content-control-wrapper row row--no-margin between-xs">

        <div class="col-md-4">
            <!-- <div class="select-all-div">
                <input name="product_all" class="checked_all" type="checkbox">&nbsp; Select All
            </div> -->
            <div class="select-all-div">
                <!-- <a href="#" ><i class="glyphicon glyphicon-trash" data-toggle="tooltip" data-original-title="delete"></i></a> -->
                <form method="POST" action="{{ route('deleteBulkaudio') }}" name="user_form" id="deleteBulkVideo" data-parsley-validate>
                    {{csrf_field()}}
                    <input type="hidden" value="" name="video_id" id="video_id">
                    <input type="hidden" value="gridview" name="videoview" id="videoview">
                    </form>
                    <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element" type="checkbox"> &nbsp; Select All
                
            </div>
            <div class="delete-div">
                <a class="view_delete" id="delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">     <i class="glyphicon glyphicon-trash" ></i>
                </a>
            </div>    
        </div>
     
    <!--  <div class="col-md-4"> 
      <ul>
        <li><button id="selectall">Select All</button></li>
        <li><button id="deleteall">Delete All</button></li>
      </ul> 
    </div>  -->

      <!--select button and delete button div start-->

        <!-- <div class="bulk-edit-control col-md-4">
            <div class="u-flex">
               <div class="select_button"> 
                <select id="selcontent"  onchange="getval(this);">
                    <option value="">Action</option>
                    <option value="selectall">Select All</option>
                    <option value="deleteall">Delete All</option>
                </select>

                <button id="selectall" style="display: none;">Select All</button>
                <button id="deleteall" style="display: none;">Delete All</button>
               </div>
            </div>
            
        </div> -->

<!--select button and delete button div start-->

        <!-- Filters -->
        <div class="filter-wrapper filter-wrapper--content u-flex--fill col-md-8">

            <div class="filter">
                <div class="standardInput form-input"><label class="form-label " for="input-0"><span class="form-label-text ">Max items</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-empty"><option value="" class="" selected="selected">24</option><option label="36" value="string:36">36</option><option label="48" value="string:48">48</option><option label="60" value="string:60">60</option></select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
            </div>

            <div class="filter">
                <div class="standardInput form-input"><label class="form-label " for="input-1"><span class="form-label-text ">Sort by</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-empty" id="input-1" name="input-1">
                    <option value="" data-i18n="label.updated">Last updated</option>
                    <option value="status" data-i18n="label.status">Status</option>
                    <option value="publishDate" data-i18n="label.publishdate">Publication date</option>
                </select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
            </div>

            <div class="filter filter--show-content-from">
                <div class="standardInput form-input"><label class="form-label " for="input-2"><span class="form-label-text ">Show content from</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-not-empty" id="input-2" name="input-2">
                <!-- ngIf: filterCtrl.params.toDate || filterCtrl.params.fromDate && !filterCtrl.showContentFromOptions[ filterCtrl.params.fromDate ] --><option label="All time" value="">All time</option><option label="The last year" value="string:1595701800000" selected="selected">The last year</option><option label="Last 2 years" value="">Last 2 years</option><option label="Last 3 years" value="">Last 3 years</option></select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
            </div>

            <div class="filter">
                
                <ul>
                    <h3 class="layout-left">Layout</h3>
                    <li class="btn primary "><a href="{{url('getAudioList')}}" ><i class="mdi mdi-apps"></i></a></li>
                    <li class="btn primary2 active" data-icon="list">
                        <a href="{{url('audiolistdata')}}" ><i class="mdi mdi-table"></i></a>
                     
                    </li>

                </ul>
            </div>
        </div>
    </div>

        <!-- Grid layout -->
        <!-- ngIf: layout === 'grid' -->
<ol class="content-grid row">
    <!-- ngRepeat: item in list.items -->
    <?php //pr($videoslist);die; ?>
    @foreach($videoslist['videoslist'] as $video)
        <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <label class="content-grid__select">
                <div class="standardInput no-label form-checkbox">
                    <!-- <input value="{{ $video['ID'] }}" name="product" class="checkbox form-element allselect checkbox" type="checkbox" id="input-pl-4"> -->
                    <input value="{{ $video['ID'] }}" name="check_video" class="checkbox check_video form-element" type="checkbox">
                </div>
            </label>
            <figure title="News Article">
                <a class="image" data-cms-href="content.article.edit" data-params="item" href="{{ $video['thumbnail_image'] ?? '' }}">
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: !ContentSummaryAPIActive && item.thumbnail -->
                    <!-- ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="{{ $video['thumbnail_image'] ?? '' }}" alt="" src="{{ $video['thumbnail_image'] ?? '' }}" class="" style="">
                    <!-- end ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <!-- new ContentSummaryAPIActive usage end -->
                    <span class="icon" data-icon="text"></span>
                </a>
            </figure>
            <div class="info">
                <span class="status published" title="Published"></span>
                <dl class="metadata">
                    <!--  <dt class="title" data-i18n="label.title">Title</dt> -->
                    <dd class="title">
                    <a data-cms-href="content.article.edit" data-params="item" href="{{ $video['thumbnail_image'] ?? '' }}">{{ $video['title'] }}</a>
                    <!-- ngIf: item.internalName -->
                    </dd>
                    <dt class="id" data-i18n="label.id">ID</dt>
                    <dd class="id" data-ng-bind="item.id">{{ $video['ID'] }}</dd>
                    <dt class="type" data-i18n="label.type">Type</dt>
                    <dd class="type" data-i18n="content.type.TEXT">News Article</dd>
                    <dt class="date" data-i18n="label.updated">Last updated</dt>
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: ContentSummaryAPIActive -->
                    <dd class="date" data-ng-if="ContentSummaryAPIActive" data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'" style="">26/07/2021 12:45</dd>
                    <!-- end ngIf: ContentSummaryAPIActive -->
                    <!-- ngIf: !ContentSummaryAPIActive -->
                    <!-- new ContentSummaryAPIActive usage end -->
                    <dt class="language" data-i18n="label.language">Language</dt>
                    <dd class="language" data-language-label="item.language">English</dd>
                    <!-- ngRepeat: filter in filterCtrl.activeFilters -->
                </dl>
                <ul class="button_edit">
                    <!-- <li>
                    <a class="view" title="" data-toggle="tooltip" href="navigation" data-original-title="Edit"><i class="glyphicon glyphicon-eye-open"></i></a>
                    </li> -->
                    <li>
                    <a class="view" title="" data-toggle="tooltip" href="{{url('editAudio')}}/{{$video['ID']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('deleteAudio') }}" name="user_form" id="deleteSinglevideo_{{$video['ID']}}" data-parsley-validate>
                            {{csrf_field()}}
                            <input type="hidden" value="{{$video['ID']}}" name="single_video_id" id="single_video_id">
                            <input type="hidden" value="gridview" name="videoview" id="videoview">
                        </form>
                        <i class="glyphicon glyphicon-trash single_delete_icon" id="delete_single_photo_{{ $video['ID'] }}" style="color: #e20101"></i>
                        <!-- <a class="view" title="" data-toggle="tooltip" href="{{ route('deleteVget') }}/{{ $video['ID'] }}" data-original-title="Edit" onClick="return confirm('Delete This account?')"><i class="glyphicon glyphicon-trash"></i></a> -->
                    </li>
                </ul>
            </div>
        </li>
    @endforeach
    
    
</ol>
    <!-- end ngIf: layout === 'grid' -->    

     <!-- nav pagination start -->
 

        <!-- <nav aria-label="...">
          <ul class="pagination">
            <li class="page-item disabled">
              <span class="page-link">Previous</span>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active">
              <span class="page-link">
                2
                <span class="sr-only">(current)</span>
              </span>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav> -->

        <nav aria-label="...">
            <ul class="pagination right">
                @foreach($videoslist['link'] as $link)
                    <li class="page-item {{($link['active'] == 1 ? 'active' : '')}}">
                        <a class="page-link" href="{{url('/getAudioList')}}/{!! $link['label'] !!}">
                            {!! $link['label'] !!}
                        </a>
                    </li>
                @endforeach                        
            </ul>
        </nav>
      
     <!-- nav pagination end -->


</div>

</div>
</div>

</section>
   
</div>
<!-- Modal -->
<div  class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 60%; margin: 0 auto;">
                <!-- <form method="post" action="{{url('/deleteUser')}}"> -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <input type="hidden" name="single_video_id_form" id="single_video_id_form" class="user_id" value="">                        
                        <h3 class="modal-title" id="exampleModalLongTitle">Do you really want to delete</h3>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="button" class="btn btn-primary yes_button" id="yes_button">Yes</button>
                        <button type="button" class="btn btn-primary delete-btn" data-dismiss="modal">No</button>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.checked_all').on('change', function() {     
                $('.checkbox').prop('checked', $(this).prop("checked"));              
            });
           
            //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked
            $('.checkbox').change(function(){ //".checkbox" change 
                if($('.checkbox:checked').length == $('.checkbox').length){
                   $('.checked_all').prop('checked',true);
                }else{
                   $('.checked_all').prop('checked',false);
                }
            });

            $("#delete_icon").click(function(){
                var f_ids = [];
                $.each($("input[name='check_video']:checked"), function(){
                    f_ids.push($(this).val());
                });
                var all_id = f_ids.join(",")
                console.log("all_id",all_id);
                // return false;
                $("#video_id").val(all_id);
            });

            $(".single_delete_icon").click(function(){
                var id = $(this).attr('id');
                id = id.replace('delete_single_photo_','');
                $('#single_video_id_form').val(id);
                $('#exampleModalLong').modal('show');
            });
            
            $("#yes_button").click(function(){
                // alert('1');
                // return false;
                var id = $("#single_video_id_form").val();
                if($('.checkbox:checked').length > 0){
                    $("#deleteBulkVideo").submit();
                }
                else{
                    $("#deleteSinglevideo_"+id).submit();
                }
            });

            // $("#search_field").on('keyup', function(e){
            //     // alert(1);
            //     if (e.key === 'Enter' || e.keyCode === 13){
            //         var serarch_value = $(this).val();
            //         console.log(serarch_value);
            //         if(serarch_value != ''){
            //             $.ajax({
            //                 url: APP_URL+'/usersearch',
            //                 type: "POST",
            //                 data: {
            //                     "_token": "{{ csrf_token() }}",
            //                     'serarch_value' : serarch_value
            //                 },
            //                 dataType: "text",
            //                 success: function(data){
            //                     console.log(data);
            //                 }
            //             });
            //         }
            //     }
            // });
        });
    </script>

@stop