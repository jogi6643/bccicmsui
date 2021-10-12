<?php //echo "<pre>";print_r($video);exit; 
?>
@if($status == true )
@foreach($video['payload']['data'] as $video)


<li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
    <label class="content-grid__select">
        <div class="standardInput no-label form-checkbox">

            <input value="{{ isset($video['ID'])? $video['ID'] : $video['id'] }}" data-view="gridview" name="check_video" class="checkbox check_video form-element" type="checkbox">
        </div>
    </label>
    <figure title="News Article">
        <a class="image" data-cms-href="content.article.edit" data-params="item" href="{{ $video['imageUrl'] ?? '' }}">
            <img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="{{ $video['imageUrl'] ?? '' }}" alt="" src="{{ $video['imageUrl'] ?? '' }}">
            <span class="icon" data-icon="text"></span>
        </a>
    </figure>
    <div class="info">
        <span class="status published" title="Published"></span>

        <dl class="metadata">
            <dd class="title"> <a data-cms-href="content.article.edit" data-params="item" href="javascript:void(0)">{{$video['title'] ?? ''}}</a> </dd>
            <dt class="id" data-i18n="label.id">ID</dt>
            <dd class="id" data-ng-bind="item.id">{{ isset( $video['ID'])?  $video['ID'] :  $video['id'] }}</dd>
            <dt class="id" data-i18n="label.id">Title</dt>
            <dd class="id" data-ng-bind="item.id">{{ isset( $video['title'])?  $video['title'] :  $video['title'] }}</dd>
            <dt class="type" data-i18n="label.type">Publication date</dt>
            <dd class="type" data-i18n="content.type.TEXT"> 
            {{ !empty($video['publishFrom']) ? \Carbon\Carbon::parse($video['publishFrom'] ?? '')->format('d M Y H:m') : '---' }}
            </dd>
            <dt class="date" data-i18n="label.updated">Last updated</dt>
            <dd class="date">{{isset( $video['updated_at']) ? \Carbon\Carbon::parse( $video['updated_at'])->format('d M Y H:m') : '' }}</dd>
            <dt class="language" data-i18n="label.language">Language</dt>
            <dd class="language" data-language-label="item.language">
            {{ $video['language'] ? $video['language'] : '' }}
        </dl>
        <ul class="button_edit">
            <li>
                <a class="view1 open-data" title="" data-toggle="modal" data-id="{{  isset($video['ID'])? $video['ID'] : $video['id'] }}" data-original-title="view">
                    <i class="glyphicon glyphicon-eye-open"></i>
                </a>
                <!-- <a class="view1 open-data" title="" data-toggle="modal" data-target="#Viewpage" data-original-title="view">
                <i class="glyphicon glyphicon-eye-open"></i>
            </a> -->
                <!-- <a class="view open-popup" title="" data-toggle="modal" data-target="#Viewpage" data-original-title="Edit"><i class="glyphicon glyphicon-eye-open"></i></a> -->
            </li>
            <li>
                <a class="view" title="" data-toggle="tooltip" href="{{url('getVideoById')}}/{{ isset($video['ID'])? $video['ID'] : $video['id']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
            </li>

            <li>
            @if(($video['current_status']) == "unpublished" || ($video['current_status']) == "published")
            <a class="publish" title="" data-toggle="tooltip" data-original-title="publish">&nbsp;
                <span class="label">No</span>
                @if(($video['current_status']) == "unpublished")
                <input type="checkbox" hidden="hidden" onclick="changeUserStatus(event.target, {{ $video['ID']}});" id="gridview{{ $video['ID'] }}" class="publish_unpublish" {{($video['ID']) ? 'unchecked' : ''}}> 
                @else
                <input type="checkbox" hidden="hidden" onclick="changeUserStatus(event.target, {{ $video['ID']}});" id="gridview{{ $video['ID'] }}" class="publish_unpublish" {{($video['ID']) ? 'checked' : ''}}> 
                @endif
                <label class="publish_unpublish" for="gridview{{ $video['ID'] }}"> </label>
                <span class="label">Yes</span>
            </a>
            @endif
            </li>
            <li>

                <a class="view_delete single_delete_icon" data-view="gridview" id="{{ isset($video['ID'])? $video['ID'] : $video['id'] }}" href="javascript:void(0);" data-original-title="Delete" type="button" >
                    <i class="glyphicon glyphicon-trash" style="color: #e20101"></i>
                </a>

                <!-- <a class="view" title="" data-toggle="tooltip" href="{{ route('deleteVget') }}/{{ isset($video['ID'])? $video['ID'] : $video['id'] }}" data-original-title="Edit" onClick="return confirm('Delete This account?')"><i class="glyphicon glyphicon-trash"></i></a> -->
            </li>
        </ul>
    </div>
</li>
@endforeach
@else
<tr>Data Not Avaliable</tr>
@endif