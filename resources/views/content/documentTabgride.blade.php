<?php if($biolist){?>
<ol class="content-grid row">
    <?php foreach($biolist as $list){?>
        <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <label class="content-grid__select">
                <div class="standardInput no-label form-checkbox">
                    <input value="<?php echo $list['ID'] ?>" name="check_video" class="checkbox check_video form-element" type="checkbox">
                </div>
            </label>
            <figure title="News Article">
            <!-- <img style="display: block; max-height: 100%;/* margin: auto; */ position: absolute; top: 0;bottom: 194px; right: 0;left: 13px;max-width: 100%;" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=200&amp;height=180" alt="" src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=280&amp;height=145" class="" style=""> -->
            </figure>
            <div class="info">
                <span class="status published" title="Published"></span>
                <dl class="metadata">
                    <!--  <dt class="title" data-i18n="label.title">Title</dt> -->
                    <dd class="title">
                    <a data-cms-href="javascript: void(0)" data-params="item" href="<?php echo $list['image_url'] ?? '' ?>"><?php echo ucfirst($list['title']) ?></a>
                    <!-- ngIf: item.internalName -->
                    </dd>
                    <dt class="id" data-i18n="label.id">ID</dt>
                    <dd class="id" data-ng-bind="item.id"><?php echo $list['ID'] ?></dd>
                    <dt class="type" data-i18n="label.type">Type</dt>
                    <dd class="type" data-i18n="content.type.TEXT"><?php echo ucfirst($list['content_type']) ?></dd>
                    <dt class="date" data-i18n="label.updated">Last updated</dt>
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: ContentSummaryAPIActive -->
                    <dd class="date" data-ng-if="ContentSummaryAPIActive" data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'" style=""><?php $date_arr= explode("T", $list['updated_at']);
                        $date= $date_arr[0];
                        $time= $date_arr[1];
                        $date_arr1= explode(".",$time);
                        $time1=$date_arr1[0];
                        echo $date." ".$time1; ?></dd>
                    <!-- end ngIf: ContentSummaryAPIActive -->
                    <!-- ngIf: !ContentSummaryAPIActive -->
                    <!-- new ContentSummaryAPIActive usage end -->
                    <dt class="language" data-i18n="label.language">Language</dt>
                    <dd class="language" data-language-label="item.language"><?php echo ucfirst(isset($list['langauge'])?? "") ?></dd>
                    <!-- ngRepeat: filter in filterCtrl.activeFilters -->
                </dl>
                <ul class="button_edit">
                    <li>
                    <a class="view" title="" data-toggle="tooltip" href="#" data-original-title="Edit"><i class="glyphicon glyphicon-eye-open"></i></a>
                    </li>
                    <li>
                    <a class="view" title="" data-toggle="tooltip" href="<?php echo url('editBiosById').'/'.$list['ID']?>" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                    </li>
                    <li>
                        <form method="POST" action="<?php echo route('deleteBulkBios')?>" name="user_form" id="deleteSinglevideo_<?php echo $list['ID']?>" data-parsley-validate>
                        <?php echo csrf_field()?>
                            <input type="hidden" value="<?php echo $list['ID']?>" name="Bios_id" id="single_video_id">
                            <input type="hidden" value="gridview" name="Biosview" id="videoview">
                        </form>
                        <i class="glyphicon glyphicon-trash single_delete_icon1"  onclick="rev(this)" id="<?php echo $list['ID'] ?>" style="color: #e20101"></i>

                        <!-- <a class="view" title="" data-toggle="tooltip" href="{{ route('deleteVget') }}/{{ $list['ID'] }}" data-original-title="Edit" onClick="return confirm('Delete This account?')"><i class="glyphicon glyphicon-trash"></i></a> -->
                    </li>
                </ul>
            </div>
        </li>
    <?php } } else { ?>
<b>No data Found ! </b>
<?php }?>
</ol>
