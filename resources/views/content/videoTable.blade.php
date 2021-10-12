<?php //echo "<pre>";print_r($video['payload']);exit
?>
@if($status == true )
@foreach($video['payload']['data'] as $val)
<tr>
    <td scope="row">
        <input value="{{ isset($val['ID'])? $val['ID'] : $val['id'] }}" data-view="listview" name="check_video" class="checkbox check_video form-element" type="checkbox">
        <!-- <input value="1" name="product" class="checkbox form-element" type="checkbox"> -->
    </td>
    <td>{{ isset($val['ID'])? $val['ID'] : $val['id'] }}</td>
    <td>
        <!-- <a class="titletab open-data" data-toggle="modal" data-target="#Viewpage">
            {{ $val['title'] ?? '' }}
        </a> -->
        <a class="view1 open-data titletab" title="" data-toggle="modal" data-id="{{  isset($val['ID'])? $val['ID'] : $val['id'] }}" data-original-title="view">
            {{ $val['title'] ?? '' }}
        </a>
    </td> 
    <td> {{ ucfirst(str_replace('_', ' ', $val['current_status'])) }}</td>
    <td>{{ !empty( $val['publishFrom']) ? \Carbon\Carbon::parse( $val['publishFrom'] ?? '')->format('d M Y H:m') : '' }}</td>
    <td>{{ !empty( $val['updated_at']) ?  \Carbon\Carbon::parse( $val['updated_at'] ?? '')->format('d M Y H:m') : '' }}</td>
    <td> {{ $val['language'] ?? ''}} </td>

    <td class="action">


        <!-- <a class="view1 open-data" title="" data-toggle="modal" data-target="#Viewpage" data-original-title="view">
            <i class="glyphicon glyphicon-eye-open"></i>
        </a> -->
        <a class="view1 open-data tdaction" title="" data-toggle="modal" data-id="{{  isset($val['ID'])? $val['ID'] : $val['id'] }}" data-original-title="view">
            <span class="ti-eye"></span>
        </a>
        <a class="view1 tdaction" title="" data-toggle="tooltip" href="{{url('getVideoById')}}/{{isset($val['ID'])? $val['ID'] : $val['id'] }}" data-original-title="Edit"><span class="ti-pencil-alt"></span>
        </a>

        <a class="view_delete single_delete_icon tdaction" data-view="listview" id="{{ isset($val['ID'])? $val['ID'] : $val['id'] }}" href="" data-original-title="Delete" type="button" data-toggle="modal">
            <span class="ti-trash"></span>
        </a>
    </td>
    <td> 
        @if(($val['current_status']) == "unpublished" || ($val['current_status']) == "published")
             <a class="publish" title="" data-toggle="tooltip" data-original-title="publish">&nbsp;
                <span class="label">No</span> 
                @if(($val['current_status']) == "unpublished")
                <input type="checkbox" hidden="hidden" onclick="changeUserStatus(event.target, {{ $val['ID']}});" id="tableview{{ $val['ID'] }}" class="publish_unpublish" {{($val['ID']) ? 'unchecked' : ''}}>
                @else
                <input type="checkbox" hidden="hidden" onclick="changeUserStatus(event.target, {{ $val['ID']}});" id="tableview{{ $val['ID'] }}" class="publish_unpublish" {{($val['ID']) ? 'checked' : ''}}> 
                @endif 
                <label class="publish_unpublish" for="tableview{{ $val['ID'] }}"> </label>
                <span class="label">Yes</span>
            </a>
        @endif
    </td>
</tr>
@endforeach
@else
<tr>Data Not Avaliable</tr>
@endif