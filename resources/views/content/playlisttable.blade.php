@if($images)
@foreach($images as $video)
<tr>
    <td scope="row">
         <input value="{{$video['ID']}}" name="check_photo" class="checkbox check_photo form-element" type="checkbox">
    </td>
    <td>{{$video['ID']}}</td>
    <td>{{$video['title'] ?? ''}}</td>
    <td>{{ $video['status'] }}</td>
    <td>{{ $video['publish_date'] }}</td>
    <td>{{ $video['created_date'] }}</td>
    <td>
    <form method="POST" action="{{ route('deleteplaylists') }}" name="user_form" id="deleteSinglevideo_{{$video['ID']}}" data-parsley-validate>
            {{csrf_field()}}
            <input type="hidden" value="{{$video['ID']}}" name="single_video_id" id="single_video_id">
            <input type="hidden" value="tableview" name="videoview" id="videoview">
        </form>

        <!-- <a class="view1" title="" data-toggle="modal" data-target="#Viewpage" 
                       data-original-title="view">
            <i class="glyphicon glyphicon-eye-open"></i>
        </a> -->
        <a class="view1 open-data" title="" data-toggle="modal" data-id="{{ $video['ID'] }}"
            data-original-title="view">
            <i class="glyphicon glyphicon-eye-open"></i>
        </a> 

        <a class="view1" title="" data-toggle="tooltip" href="{{url('editplaylists')}}/{{$video['ID']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>

        <a class="publish" title=""  data-toggle="tooltip" data-original-title="publish">&nbsp;
            <span class="label">No</span>
            <input type="checkbox" hidden="hidden" id="{{$video['ID']}}" class="publish_unpublish">
            <label class="publish_unpublish" for="{{$video  ['ID']}}"> </label>
            <span class="label">Yes</span>
        </a> 

        <i class="glyphicon glyphicon-trash single_delete_icon" id="delete_single_photo_{{ $video['ID'] }}" style="color: #e20101"></i>
    </td>
</tr>
@endforeach
@else
<tr>Data Not Avaliable</tr>
@endif


<div  class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 60%; margin: 0 auto;">
            <!-- <form method="post" action="{{url('/deleteUser')}}"> -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <input type="hidden" name="photo_id" id="photo_id" class="photo_id" value="">
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
                $.each($("input[name='check_photo']:checked"), function(){
                    f_ids.push($(this).val());
                });
                var all_id = f_ids.join(",")
                $("#photo_id").val(all_id);
            });

            $(".single_delete_icon").click(function(){
                var id = $(this).attr('id');
                id = id.replace('delete_single_photo_','');
                $('#photo_id').val(id);
                $('#exampleModalLong').modal('show');
            });
            
            $("#yes_button").click(function(){
                var id = $("#photo_id").val();
                if($('.checkbox:checked').length > 0){
                    $( "#deleteBulkPhoto" ).submit();
                }
                else{
                    $("#deleteSinglePhoto_"+id).submit();
                }
            });
        });
    </script>
