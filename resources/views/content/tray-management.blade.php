@extends('base')
@section('title', 'Tray Management')
@section('epic_content')
<style>
    .d-none{ display: none; }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $("li.btn").click(function() {
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
            <li><a href="{{url('#')}}">Page Curation</a></li>
            <li class="active">Tray Management</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
    <div class="">
        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading"> </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="30">ID</th>
                                <th width="300" style="text-align: left;">Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data['records']) > 0)
                                @foreach($data['records'] as $merge_rec)
                                @foreach($merge_rec as $record)
                                    @if($record['status']== true)
                                    <tr>
                                        <td>{{ $record['ID'] }}</td>
                                        <td>
                                            <h5 style="margin-top: 2px;">{{ $record['title'] }}</h5>
                                            <div style="text-align:right;">
                                            <input type="hidden" id="page_slug_{{$record['ID']}}" name="page_slug" value ="{{$record['page']}}">
                                                <button type="button" title="Edit" data-id="{{ $record['ID'] }}" class="edit-list btn btn-info btn-outline btn-circle"><i class="ti-pencil-alt"></i></button>
                                                <button type="button" class="delete-list btn btn-info btn-outline btn-circle" data-id="{{ $record['ID'] }}" title="Delete" data-toggle="modal" data-target=".delete-modal"><i class="ti-trash"></i></button>
                                                <!-- <button type="button" title="Copy" data-id="5" class="copy-list btn btn-info btn-outline btn-circle" data-toggle="modal" data-target=".copy-modal"><i class="ti-files"></i></button> -->
                                                <!-- <button type="button" title="Active" data-status="1" data-id="5" class="active-list btn btn-danger btn-outline btn-circle" data-toggle="modal" data-target=".active-modal"><i class="ti-rss"></i></button> -->
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                @endforeach
                            @else	
                                <tr>
                                    <td colspan="2" class="text-center">{{ $respMessage }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <nav aria-label="..." class="paginations">
                            <ul class="pagination right">
                                <li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="0" href="javascript:void(0);">Previous</a></li>
                                <li class="page-item active"><a class="page-link pagination_link" data-view="search" data-page="0" href="javascript:void(0);">1</a></li>
                                <li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="0" href="javascript:void(0);">Next</a></li>

                            </ul>
                        </nav>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12 col-sm-12 col-lg-8 list-form panel add-form">
            <div class="white-box row" style="margin-top: 0;">
                @include('show_message')
                <h3 class="box-title m-b-0">ADD NEW LIST</h3>
                <p class="text-muted m-b-30 font-13">Select Content or Banners to create list</p>
                <form class="form-horizontal" method="post" action="{{ route('saveTray') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
                        <div class="form-group">
                            <label class="col-md-12">Title</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control title" value="{{ old('title') }}" name="title" placeholder="title" id="title">
                                @if ($errors->has('title'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Display Title</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="{{ old('display_title') }}" name="display_title" placeholder="title" >
                                @if ($errors->has('display_title'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('display_title') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Display Title - HINDI</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="{{ old('display_title_hindi') }}" name="display_title_hindi" placeholder="HINDI title">
                                @if ($errors->has('display_title_hindi'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('display_title_hindi') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">Select Catalogs</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="page" id="page" data-id="">
                                    <option value="">Select Catalogs</option>
                                    @foreach($menu as $val)
                                    @if($val['status'] == true)
                                    <option value="{{$val['slug']}}">{{$val['menu_name']}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('page'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('page') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">List Curated Language</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="curated_language" id="curated_language" data-id="">
                                    <option value="">Select Language</option>
                                    <option {{ old('curated_language') == 'en' ? 'selected' : '' }} value="en">ENGLISH</option>
                                    <option {{ old('curated_language') == 'hi' ? 'selected' : '' }} value="hi">HINDI</option>
                                </select>
                                @if ($errors->has('curated_language'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('curated_language') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
                        <div class="form-group">
                            <label class="col-md-12">Slug</label>
                            <div class="col-md-12">
                                <input type="text" name="slug" readonly="" class="form-control title-slug" placeholder="slug" value="{{ old('slug') }}">
                                @if ($errors->has('slug'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group show_all">
                            <label class="col-md-12">Show More Button</label>
                            <div class="col-md-12" style="margin-bottom: 16px;">
                                <input type="checkbox" name="show_more_button" value="true" class="js-switch" data-color="#2cabe3" data-size="small" data-switchery="true" style="display: none;">
                                <span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s; display: none;"><small style="left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
                                @if ($errors->has('show_more_button'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('show_more_button') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Add Content</label>
                            <div class="col-md-12">
                                <select name="content[]" class="select-content-list" multiple style="width:100%"></select>
                                @if ($errors->has('content'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-info btn-lg tray-btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8 col-xs-12 col-sm-12 col-lg-8 list-form panel edit-form" style="display: none;">
            <div class="white-box row" style="margin-top: 0;">
                <div class="alert alert-success update-suc-msg d-none"></div>
                <div class="alert alert-danger update-err-msg d-none"></div>
                <div class="row-">
                    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                        <h3 class="box-title m-b-0">EDIT LIST : <span id="tray-title"></span> </h3>
                        <p class="text-muted m-b-30 font-13">Select Content or Banners to create list</p>
                    </div>
                    <!-- <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <button class="btn btn-danger btn-block duplicate-list">Duplicate</button>
                    </div> -->
                </div>
                <form id="form-update" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="edit_tray_id" name="tray_id">

                    <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
                        <div class="form-group">
                            <label class="col-md-12">Title</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control title" value="" name="title" placeholder="title" id="edit_title">
                                <div class="error d-none">
                                    <strong>The title field is required.</strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Display Title</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="" name="display_title" placeholder="title" id="edit_display_title" >
                                <div class="error d-none">
                                    <strong>The display title field is required.</strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Display Title - HINDI</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="" name="display_title_hindi" placeholder="HINDI title" id="edit_display_title_hindi">
                                <div class="error d-none">
                                    <strong>The display title hindi field is required.</strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">Select Catalogs</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="page" id="edit_page">
                                    <option value="">Select Catalogs</option>
                                    @foreach($menu as $val)
                                    @if($val['status'] == true)
                                    <option value="{{$val['slug']}}">{{$val['menu_name']}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <div class="error d-none">
                                    <strong>The page field is required.</strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">List Curated Language</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="curated_language" id="edit_curated_language">
                                    <option value="">Select Language</option>
                                    <option value="en">ENGLISH</option>
                                    <option value="hi">HINDI</option>
                                </select>
                                <div class="error d-none">
                                    <strong>The curated language field is required.</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
                        <div class="form-group">
                            <label class="col-md-12">Slug</label>
                            <div class="col-md-12">
                                <input type="text" name="slug" readonly="" class="form-control title-slug" placeholder="slug" id="edit_slug">
                                <div class="error d-none">
                                    <strong>The slug field is required.</strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group show_all">
                            <label class="col-md-12">Show More Button</label>
                            <div class="col-md-12" style="margin-bottom: 16px;">
                                <input type="checkbox" name="show_more_button" value="true" class="js-switch" data-color="#2cabe3" data-size="small" data-switchery="true" style="display: none;" id="edit_show_more_button">
                                <span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s; display: none;"><small style="left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
                                <div class="error d-none">
                                    <strong>The show more field is required.</strong>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Add Content</label>
                            <div class="col-md-12">
                            <select name="select-content-list[]" class="select-content-list" id = "edit-content-list" multiple style="width:100%">
                                 
                                </select>
                                <div class="error d-none">
                                    <strong>The content field is required.</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-info btn-lg tray-btn" id="btnUpdate">Update</button>
                            <button type="button" class="btn btn-info btn-lg tray-btn btnCancel">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="delete-modal fade swal-overlay swal-overlay--show-modal" tabindex="-1" role="dialog" style="display:none;">
    <div class="swal-modal" role="dialog" aria-modal="true">
        <form method="post" id="form-delete" action="{{ route('deleteTray') }}">
            @csrf
            <input type="text" id="tray_id" name="tray_id" value="">
            <div class="swal-icon swal-icon--error">
                <div class="swal-icon--error__x-mark">
                    <span class="swal-icon--error__line swal-icon--error__line--left"></span>
                    <span class="swal-icon--error__line swal-icon--error__line--right"></span>
                </div>
            </div>
            <div class="swal-title" style="">Are you sure?</div>
            <div class="swal-text" style="">Are you sure you want to delete?</div>
            <div class="swal-footer">
                <div class="swal-button-container">
                    <button type="button" class="swal-button swal-button--cancel" data-dismiss="modal">Cancel</button>
                    <div class="swal-button__loader">
                    
                    </div>
                </div>
                <div class="swal-button-container">
                    <button type="button" class="swal-button swal-button--confirm btn-ok" data-dismiss="modal">OK</button>
                    <div class="swal-button__loader">
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    setTimeout(function() {
        $('.alert-success').fadeOut('slow');
        $('.alert-danger').fadeOut('slow');
    }, 5000);

    $(document).ready(function() {
        $('.title').on('keyup', function(){
            $('.title-slug').val($(this).val().replace(/\s+/g,'-').toLowerCase());
            $('#tray-title').text($(this).val());
        });

        $('.delete-list').click(function(){
            var list_id  = $(this).attr('data-id');
            $('#tray_id').val(list_id);
        })

        $('.edit-list').click(function(){
            $('.add-form').hide();
            $('.edit-form').show();
            var tray_id = $(this).attr('data-id');
            var page_slug = $("#page_slug_"+tray_id).val();
            if(tray_id != ''){
                $('.preloader').show();
                $.ajax({
                    url: APP_URL + '/viewTray',
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'page_slug': page_slug,
                        'tray_id' : tray_id
                    },
                    dataType: "text",
                    success: function(data) {
                        $('.preloader').hide();
                        var response = $.parseJSON(data);
                        if(response.status.code == 200 && response.payload){
                            data = response.payload;
                           // console.log(data.content_list);
                            $('#tray-title').text(data.title);
                            $('#edit_tray_id').val(tray_id);
                            $('#edit_title').val(data.title);
                            $('#edit_display_title').val(data.display_title);
                            $('#edit_display_title_hindi').val(data.display_title_hindi);
                            $('#edit_page').val(data.page);
                            $('#edit_curated_language').val(data.curated_language);
                            $('#edit_slug').val(data.slug);
                            //$('.select-content-list').multiSelect('refresh');
                            //$(".select2").select2();
                            if(data.show_more_button == "true"){
                                $("#edit_show_more_button").trigger("click");
                            }
                            $('#edit-content-list').val(null).trigger('change');
                            $.each(data.content_list, function(key,val) {
                                $("#edit-content-list").select2("trigger", "select", {data : { id:val.ID, text: val.title}});
                            });
                            $(".select-content-list").select2({  
    minimumInputLength: 3,
ajax: {
  method: "POST",
  url: "{{url('searchByTitle')}}",
  delay: 250,
  dataType: 'json',
  data: function (params) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    return {title:params.term};
  },
  minimumInputLength: 3,
}
});
                            //$("#edit_show_more_button").prop('checked', true);
                        }else{
                            alert(response.status.message);
                            $('.add-form').toggle();
                            $('.edit-form').toggle();
                        }
                    }
                });
            }
        })

        $('#btnUpdate').click(function(){
            
            var title = $('#edit_title').val();
            var display_title = $('#edit_display_title').val();
            var display_title_hindi = $('#edit_display_title_hindi').val();
            var page = $('#edit_page').val();
            var curated_language = $('#edit_curated_language').val();
            var slug = $('#edit_slug').val();
            var show_more_button = $("#edit_show_more_button").val();
            var flag = 1;

            $('#form-update').find('.error').css('display', 'none');

            if(title == ''){
                $('#edit_title').parent().find('.error').css('display', 'block');
                flag = 0;
            }else{
                $('#edit_title').parent().find('.error').css('display', 'none');
            }

            if(display_title == ''){
                $('#edit_display_title').parent().find('.error').css('display', 'block');
                flag = 0;
            }else{
                $('#edit_display_title').parent().find('.error').css('display', 'none');
            }

            if(display_title_hindi == ''){
                $('#edit_display_title_hindi').parent().find('.error').css('display', 'block');
                flag = 0;
            }else{
                $('#edit_display_title_hindi').parent().find('.error').css('display', 'none');
            }

            if(page == ''){
                $('#edit_page').parent().find('.error').css('display', 'block');
                flag = 0;
            }else{
                $('#edit_page').parent().find('.error').css('display', 'none');
            }

            if(curated_language == ''){
                $('#edit_curated_language').parent().find('.error').css('display', 'block');
                flag = 0;
            }else{
                $('#edit_curated_language').parent().find('.error').css('display', 'none');
            }

            if(flag == 1){
                $('.preloader').show();
                $.ajax({
                    url: APP_URL + '/updateTray',
                    type: "POST",
                    data: $('#form-update').serialize(),
                    success: function(data) {
                        $('.preloader').hide();
                        var response = $.parseJSON(data);
                        console.log(response);
                        if(response.status.code == 200){
                            $('.update-suc-msg').text(response.status.message);
                            $('.update-suc-msg').show();
                            //$("#form-update")[0].reset(); 
                        }else{
                            $('.update-err-msg').text(response.status.message);
                            $('.update-err-msg').show();
                        }
                    }
                });
            }
        })

        $('.btnCancel').click(function(){
            $('.add-form').toggle();
            $('.edit-form').toggle();
        })

        $('.btn-ok').click(function(){
           $('#form-delete').submit();
        })
    })
</script>
@stop
