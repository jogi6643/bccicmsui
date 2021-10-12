<?php //echo "<pre>";print_r($promos['payload']['data'] );exit
?>
@if($status == true )
@foreach($promos['payload']['data'] as $val)
<tr>
    <td scope="row">
        <input value="{{$val['ID']}}" name='check_user' class='checkbox form-element' type='checkbox'>
    </td>
    <td>{{$val['ID']}}</td>
    <!-- <td>{{$val['title'] ?? ''}}</td> -->
    <td>
        <a class="titletab open-data" title="" data-toggle="modal" data-id="{{ $val['ID'] }}">

            {{ $val['title'] ?? '' }}
        </a>
    </td>
    <td>{{ $val['current_status'] }}</td>
    <td>{{ \Carbon\Carbon::parse( isset($val['publish_date']) ? $val['publish_date'] : '')->format('d M Y H:m')    }}</td>
    <td>{{ \Carbon\Carbon::parse( isset($val['updated_at']) ? $val['updated_at'] : '' )->format('d M Y H:m')   }}</td>
    <td>{{$val['language'] ?? ''}}</td>
    <td class="action">
        <a class="view1 open-data tdaction" title="" data-toggle="modal" data-target="#Viewpage" data-original-title="view" data-id="{{ $val['ID'] }}">
            <!--<i class="glyphicon glyphicon-eye-open"></i>-->
            <span class="ti-eye"></span>
        </a>

        <a class="view1 tdaction" title="" data-toggle="tooltip" href="{{url('/contentList/editPromos/')}}/{{$val['ID']}}" data-original-title="Edit">
            <!-- <i class="glyphicon glyphicon-pencil"></i> -->
            <span class="ti-pencil-alt"></span>
        </a>

        <a class="view1 single_delete_icon tdaction" data-id="{{$val['ID']}}" title="" data-toggle="tooltip" href="javascript:void(0)" data-original-title="delete">
            <span class="ti-trash"></span>
            <!-- <i class="glyphicon glyphicon-trash"></i> --></a>

    </td>
    <td>
        <a class="publish" title="" data-toggle="tooltip" data-original-title="publish">
            <span class="label">No</span>
            <input type="checkbox" hidden="hidden" id="tableview{{ $val['ID'] }}" class="publish_unpublish">
            <label class="publish_unpublish" for="tableview{{ $val['ID'] }}"> </label>
            <span class="label">Yes</span>
        </a>
    </td>
</tr>
@endforeach
@else
<tr>Data Not Avaliable</tr>
@endif