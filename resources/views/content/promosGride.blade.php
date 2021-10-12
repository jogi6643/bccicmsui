<?php //echo "<pre>";print_r($original_data);exit
?>
@if($status == true )
@foreach($promos['payload']['data'] as $val)
<li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 " style="margin:15px 0px 15px 0px">
    <div class="border-side"> <label class="content-grid__select">
            <div class="standardInput no-label form-checkbox"><input value="{{$val['ID']}}" name='check_user' class='checkbox form-element' type='checkbox'> </div>
        </label>
        <figure title="News Article"> <a class="image" data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en"> <img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" alt="" src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260"> <span class="icon" data-icon="text"></span> </a> </figure>
        <div class="info"> <span class="status published" title="Published"></span>
            <dl class="metadata">
                <dd class="title"> <a data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">{{$val['title'] ?? ''}}</a> </dd>
                <dt class="id" data-i18n="label.id">ID</dt>
                <dd class="id" data-ng-bind="item.id">{{$val['ID']}}</dd>
                <dt class="type" data-i18n="label.type">Type</dt>
                <dd class="type" data-i18n="content.type.TEXT">Promos</dd>
                <dt class="date" data-i18n="label.updated">Last updated</dt>
                <dd class="date">{{ \Carbon\Carbon::parse($val['updated_at'])->format('d M Y H:m')   }}</dd>
                <dt class="language" data-i18n="label.language">Language</dt>
                <dd class="language" data-language-label="item.language">{{$val['language'] ?? ''}}</dd>
            </dl>
            <ul class="button_edit">
                <li> <a class="view" title="" data-toggle="tooltip" href="navigation" data-original-title="Edit"><i class="glyphicon glyphicon-eye-open"></i></a> </li>
                <li> <a class="view" title="" data-toggle="tooltip" href="{{url('/contentList/editPromos/')}}/{{$val['ID']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> </li>
                <li>
                    <a class="publish" title="" data-toggle="tooltip" data-original-title="publish">&nbsp;
                        <input type="checkbox" hidden="hidden" id="gridview<?php echo $val['ID']; ?>" class="publish_unpublish">
                        <label class="publish_unpublish" for="gridview<?php echo $val['ID']; ?>"> </label>
                    </a>
                </li>

                <li> <a class="view single_delete_icon" data-id="{{$val['ID']}}" title="" data-toggle="tooltip" href="#" data-original-title="Edit"><i class="glyphicon glyphicon-trash"></i></a> </li>
            </ul>
        </div>
    </div>
</li>
@endforeach
@else
<tr>Data Not Avaliable</tr>
@endif