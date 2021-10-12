<div class="content-control-wrapper row row--no-margin between-xs">
    <div class="bulk-edit-control ">
        <div class="u-flex">
        </div>
        <!-- ngIf: bulkEditCtrl.items.length -->
    </div><!-- end ngIf: bulkEditCtrl && list.items.length -->
    <div class="col-md-3 no-padd">
        <div class="select-all-div">
            <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">&nbsp;<label for="input#check_all"> Select All</label>
        </div>
        <div class="delete-div">
            <a class="view_delete" id="delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#confirm_delete_modal">
                <i class="glyphicon glyphicon-trash"></i>
            </a>
            <!-- <a href="#" ><i class="glyphicon glyphicon-trash" data-toggle="tooltip" data-original-title="delete"></i></a> -->
        </div>
    </div>
    <div class="filter-wrapper filter-wrapper--content u-flex--fill col-md-9">
        @php
            $sort_by = config('bcciconfig.CONTENT_SORTBY') ?? ['Last updated', 'Status', 'Publication date'];
            $max_items = config('bcciconfig.CONTENT_MAX_ITEM') ?? [24,36,48,60];
            $content_from = config('bcciconfig.CONTENT_FROM') ?? ['All time', 'The last year', 'Last 2 years', 'Last 3 years'];
        @endphp
        <div class="filter">
            <div class="standardInput form-input">
                <label class="form-label " for="input-0">
                    <span class="form-label-text ">Max items</span>
                </label>
                <select name="max_items" id="max_items" class="form-element ng-pristine ng-untouched ng-valid ng-empty">
                    @foreach($max_items as $val)
                        <option value="{{$val}}">{{$val}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="filter">
            <div class="standardInput form-input">
                <label class="form-label " for="input-1">
                    <span class="form-label-text ">Sort by</span>
                </label>
                <select class="form-element ng-pristine ng-untouched ng-valid ng-empty" id="sort_by" name="sort_by">
                    @foreach($sort_by as $val)
                        <option value="{{$val}}">{{$val}}</option>
                    @endforeach
                </select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
        </div>

        <div class="filter filter--show-content-from">
            <div class="standardInput form-input">
                <label class="form-label " for="input-2">
                    <span class="form-label-text ">Show content from</span>
                </label>
                <select class="form-element ng-pristine ng-untouched ng-valid ng-not-empty" id="content_from" name="content_from">
                    @foreach($content_from as $val)
                        <option value="{{$val}}">{{$val}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="filter">
            <ul>
                <h3 class="layout-left">Layout</h3>
                <li class="btn primary active">
                    <a href="#list_view" data-toggle="tab"><i class="mdi mdi-apps"></i></a>
                </li>
                <li class="btn primary2" data-icon="list">
                    <a href="#grid_view" data-toggle="tab"><i class="mdi mdi-table"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
