@if(count($imagesgird['data']) > 0)
        @foreach($imagesgird['data'] as $photo)
            <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                <label class="content-grid__select">
                    <div class="standardInput no-label form-checkbox">
                        <!-- <input value="{{ $photo['ID'] }}" name="product" class="checkbox form-element allselect checkbox" type="checkbox" id="input-pl-4"> -->
                        <input value="{{$photo['ID']}}" name="check_photo" class="checkbox check_photo form-element" type="checkbox">
                    </div>
                </label>
                <figure title="News Article">
                    <a class="image" data-cms-href="content.article.edit" data-params="item" href="{{ $photo['image_url'] ?? '' }}">
                    <img src="{{ $photo['image_url'] ?? '' }}" alt="{{ $photo['title'] }}" width="460" height="345">
                        <!-- new ContentSummaryAPIActive usage start -->
                        <!-- ngIf: !ContentSummaryAPIActive && item.thumbnail -->
                        <!-- ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                        <!-- <img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="{{ $photo['image_url'] ?? '' }}" alt="" src="{{ $photo['thumbnail_image'] ?? '' }}" class="" style=""> -->
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
                        <a data-cms-href="content.article.edit" data-params="item" href="{{ $photo['thumbnail_image'] ?? '' }}">{{ $photo['title'] }}</a>
                        <!-- ngIf: item.internalName -->
                        </dd>
                        <dt class="id" data-i18n="label.id">ID</dt>
                        <dd class="id" data-ng-bind="item.id">{{ $photo['ID'] }}</dd>
                        <!-- <dt class="type" data-i18n="label.type">Type</dt> -->
                        <!-- <dd class="type" data-i18n="content.type.TEXT">News Article</dd> -->
                        <dt class="date" data-i18n="label.updated">publish date</dt>
                        <dd class="date" data-ng-if="ContentSummaryAPIActive" data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'" style="">{{ $photo['publish_date'] ?? '' }}</dd>
                        <dt class="date" data-i18n="label.updated">created date</dt>
                        <dd class="date" data-ng-if="ContentSummaryAPIActive" data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'" style="">{{ $photo['created_date'] ?? '' }}</dd>
                        <!-- end ngIf: ContentSummaryAPIActive -->
                        <!-- ngIf: !ContentSummaryAPIActive -->
                        <!-- new ContentSummaryAPIActive usage end -->
                        <dt class="language" data-i18n="label.language">Language</dt>
                        <dd class="language" data-language-label="item.language">{{ $photo['language'] ?? '' }}</dd>
                        <dt class="language" data-i18n="label.language">Match Formats</dt>
                        <dd class="language" data-language-label="item.language">{{ $photo['match_formats'] ?? '' }}</dd>
                        <dt class="language" data-i18n="label.language">Current Status</dt>
                        <dd class="language" data-language-label="item.language">{{ $photo['currentstatus'] ?? '' }}</dd>
                        <dt class="language" data-i18n="label.language">Status</dt>
                        <dd class="language" data-language-label="item.language">{{($photo['status'] == 'true' || $photo['currentstatus'] == '1') ? 'Active' : 'Inactive'}}</dd>
                        <!-- ngRepeat: filter in filterCtrl.activeFilters -->
                    </dl>
                    <ul class="button_edit">
                        <li>
                        <a class="view" title="" data-toggle="tooltip" href="navigation" data-original-title="Edit"><i class="glyphicon glyphicon-eye-open"></i></a>
                        </li>
                        <li>
                        <a class="view" title="" data-toggle="tooltip" href="{{url('editPhoto')}}/{{$photo['ID']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                        </li>
                        <li>
                        <!-- <a class="view1" title="" data-toggle="tooltip" href="{{url('editPhoto')}}/{{$photo['ID']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> -->
                        <form method="POST" action="{{ route('deleteImage') }}" name="photo_bulk_form" id="deleteSinglePhoto_{{$photo['ID']}}" class="test delete_icons" data-parsley-validate>
                            {{csrf_field()}}
                            <input type="hidden" value="{{$photo['ID']}}" name="single_photo_id" id="single_photo_id">
                            <input type="hidden" value="gridview" name="videoview" id="videoview">
                        </form>
                        <i class="glyphicon glyphicon-trash single_delete_icon" id="delete_single_photo_{{$photo['ID']}}" style="color: #e20101" ></i>
                            <!-- <a class="view" title="" data-toggle="tooltip" href="{{ route('deleteVget') }}/{{ $photo['ID'] }}" data-original-title="Edit" onClick="return confirm('Delete This account?')"><i class="glyphicon glyphicon-trash"></i></a> -->
                        </li>
                    </ul>
                </div>
            </li>
            @endforeach
            @else
            <ul class="button_edit">
                        <li>
                            <span> No Data Available</span>
                        </li>
                    </ul>
                <!-- <tr>
                    <td colspan="7" class="" style="text-align: center;">No Data Available</td>
                </tr> -->
            @endif


