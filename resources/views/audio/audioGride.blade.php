<?php // echo "<pre>";print_r($audio['payload']['data']);exit; ?>
@if($status == true )
@foreach($audio['payload']['data'] as $photo)
<li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
    <label class="content-grid__select">
        <div class="standardInput no-label form-checkbox">

            <input value="{{ isset($photo['ID'])? $photo['ID'] : $photo['id'] }}" name="check_video" class="checkbox check_video form-element" type="checkbox">
        </div>
    </label>
    <figure title="News Article">
        <a class="image" data-cms-href="content.article.edit" data-params="item" href="{{ $photo['audio_url'] ?? '' }}">
            <img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="{{ $photo['audio_url'] ?? '' }}" alt="" src="{{ $photo['audio_url'] ?? '' }}" >
            <span class="icon" data-icon="text"></span>
        </a>
    </figure>
    <div class="info">
        <span class="status published" title="Published"></span>

        <dl class="metadata">
            <dd class="title"> <a data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">{{$val['title'] ?? ''}}</a> </dd>
            <dt class="id" data-i18n="label.id">ID</dt>
            <dd class="id" data-ng-bind="item.id">{{ isset( $photo['ID'])?  $photo['ID'] :  $photo['id'] }}</dd>
            <dt class="id" data-i18n="label.id">Title</dt>
            <dd class="id" data-ng-bind="item.id">{{ $photo['title'] ?? '' }}</dd>
            <dt class="id" data-i18n="label.id">Status</dt>
            <dd class="id" data-ng-bind="item.id"> 
            {{ucfirst(str_replace('_', ' ', $photo['current_status']))}}
            </dd>
            <dt class="type" data-i18n="label.type">Publication date</dt>
            <dd class="type" data-i18n="content.type.TEXT"> 
            {{ !empty($photo['publish_date']) ? \Carbon\Carbon::parse($photo['publish_date'] ?? '')->format('d M Y H:m') : '' }}
            </dd>
            <dt class="type" data-i18n="label.type">Type</dt>
            <dd class="type" data-i18n="content.type.TEXT">photo</dd>
            <dt class="date" data-i18n="label.updated">Last updated</dt>
            <dd class="date">{{isset( $photo['updated_at']) ? \Carbon\Carbon::parse( $photo['updated_at'])->format('d M Y H:m') : '' }}</dd>
            <dt class="language" data-i18n="label.language">Language</dt>
            <dd class="language" data-language-label="item.language">
            {{ isset($photo['language']) ? $photo['language'] : '' }}</dd>
        </dl>
        <ul class="button_edit">
            <li>
             <a class="view1 open-data tdaction" title="" data-toggle="modal" data-id="{{ $photo['ID'] }}" data-original-title="view">
                <i class="glyphicon glyphicon-eye-open"></i>
                {{-- <a class="view" title="" data-toggle="tooltip" href="navigation" data-original-title="Edit"><i class="glyphicon glyphicon-eye-open"></i></a> --}}
            </li>
            <li>
                <a class="view" title="" data-toggle="tooltip" href="{{url('editAudio')}}/{{ isset($photo['ID'])? $photo['ID'] : $photo['id']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
            </li>

            <li>
            @if(($photo['current_status']) == "unpublished" || ($photo['current_status']) == "published")
            <a class="publish" title="" data-toggle="tooltip" data-original-title="publish">&nbsp;
                <span class="label">No</span>
                @if($photo['current_status'] == "unpublished")
                <input type="checkbox" hidden="hidden" onclick="changeUserStatus(event.target, {{ $photo['ID']}});" id="tableview{{ $photo['ID'] }}" class="publish_unpublish" {{($photo['ID']) ? 'unchecked' : ''}}> 
                @else
                <input type="checkbox" hidden="hidden" onclick="changeUserStatus(event.target, {{ $photo['ID']}});" id="tableview{{ $photo['ID'] }}" class="publish_unpublish" {{($photo['ID']) ? 'checked' : ''}}> 
                @endif
                <label class="publish_unpublish" for="gridview{{ $photo['ID'] }}"> </label>
                <span class="label">Yes</span>
            </a>
            @endif
            </li>
            <li>
         
             <a class="view_delete single_delete_icon" id="{{ isset($photo['ID']) ? $photo['ID'] : $photo['id'] }}"
                    href="" data-original-title="Delete" type="button" data-toggle="modal"
                    data-target="#exampleModalLong">

                    <i class="glyphicon glyphicon-trash" style="color: #e20101"></i>
                </a>
            </li>
        </ul>
    </div>
</li>
@endforeach
@else
<tr>Data Not Avaliable</tr>
@endif