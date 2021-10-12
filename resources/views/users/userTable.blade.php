<?php //echo "<pre>";print_r($video['payload']);exit
?>
@if ($status == true)
    @foreach ($user['payload']['data'] as $val)
        <tr>
            <td scope="row">
                <input value="{{ isset($val['user_id']) ? $val['user_id'] : $val['user_id'] }}" name="check_video"
                    class="checkbox check_video form-element" type="checkbox">
                <!-- <input value="1" name="product" class="checkbox form-element" type="checkbox"> -->
            </td>
            <td>{{ isset($val['user_id']) ? $val['user_id'] : $val['user_id'] }}</td>
            <td class="title">
                <!-- <a class="titletab open-data" data-toggle="modal" data-target="#Viewpage"> -->
                <a class="titletab open-data" title="" data-toggle="modal" data-id="{{ $val['user_id'] }}" data-original-title="view">
                    {{ $val['user_title'] ?? '' }}  {{ $val['user_first_name'] }} {{ $val['user_last_name'] }}
                </a>
            </td>
            <td>{{ $val['user_email_id'] }}</td>
            <td>{{ $val['user_dob'] }}</td>
            <td>{{ $val['user_phone_number'] }}</td>

            <td class="action">


                <!-- <a class="view1 open-data tdaction" title="" data-toggle="modal" data-target="#Viewpage"
                    data-original-title="view">
                    <span class="ti-eye"></span>
                </a> -->
                <a class="view1" title="" data-toggle="tooltip" data-original-title="view" href="{{url('bcciviewuser')}}/{{$val['user_id']}}"><i class="glyphicon glyphicon-eye-open"></i></a>
                <a class="view1 tdaction" title="" data-toggle="tooltip"
                    href="{{url('bccieditnewuser')}}/{{$val['user_id']}}"
                    data-original-title="Edit"><span class="ti-pencil-alt"></span>
                </a>

                <a class="view_delete single_delete_icon tdaction" id="{{$val['user_id']}}"
                    href="" data-original-title="Delete" type="button" data-toggle="modal"
                    data-target="#exampleModalLong">

                    <span class="ti-trash"></span>
                </a>
            </td>
    
            
        </tr>
    @endforeach
@else
    <tr>Data Not Avaliable</tr>
@endif
