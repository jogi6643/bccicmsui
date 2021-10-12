
@if($biolist)
@foreach($biolist as $list)
<tr>
<td>
        <input value="{{ $list['ID'] }}" name="check_Bios" class="checkbox check_video form-element" type="checkbox">
      </td>
      <td>{{ $list['ID'] ?? '' }}</td>
      <td>{{ ucfirst($list['title']) ?? '' }}</td>
      <td>{{ ucfirst($list['status']=='1') ? 'Published' :'UnPublished' }}</td>
      <td>
         <?php $date_arr= explode("T", $list['created_at']);
          $date= $date_arr[0]; 
          echo $date; ?>
      </td>
      <td>
      <?php $date_arr= explode("T", $list['updated_at']);
          $date= $date_arr[0]; 
          echo $date; ?></td>
      <td>{{ ucfirst(isset($list['langauge'])) ?? ""}} </td>
       <td>
       <a class="view1" title="" data-toggle="modal" data-target="#Viewpage" 
                       data-original-title="view">
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
        <!-- <a class="view1" title="" data-toggle="tooltip" href="#" data-original-title="view"><i class="glyphicon glyphicon-eye-open"></i></a> -->

        <a class="view1" title="" data-toggle="tooltip" href="{{url('editBiosById')}}/{{$list['ID']}}?from=biolist" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
        
        <a class="view1" title="" href="{{url('deletebio')}}/{{$list['ID']}}?from=biolist" data-toggle="tooltip" data-original-title="#"><i class="glyphicon glyphicon-trash"></i></a>
      </td>
      <td>
      <a class="publish" title=""  data-toggle="tooltip" data-original-title="publish">
                                    <span class="label">No</span>
                                    <input type="checkbox" hidden="hidden" id="{{ $list['ID'] }}" class="publish_unpublish">
                                    <label class="publish_unpublish" for="{{ $list['ID'] }}"> </label>
                                    <span class="label">Yes</span>
                                </a>
      </td>
</tr>
@endforeach
@else
<b>Data Not Avaliable</b>
@endif