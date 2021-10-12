@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>
<style>

</style>

<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        <ol class="breadcrumb">
            <li><a href="{{url('/')}}">Manage bios</a></li>
            <li class="active"></li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
  
  <section>
  
  <div class="content_text"><p>Manage bios</p></div>
  
<div class="top-search">
    <div class="row content-search-header">
            <section class="col-md-6 col-sm-12">
                <form class="example" action="/action_page.php">
                      <input type="text" placeholder="Enter search term..." name="search2">
                      <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </section>
            <section class="col-md-6 col-sm-12">
               <div class="form-inline">
                 <div class="col-md-5">
                    <div class="custom-select" style="">
                        <label>Filter by language</label>
                      <select>
                        <option value="0">Select All:</option>
                        <option value="1">English</option>
                        <option value="2">Marathi</option>
                        <option value="3">Hindi</option>
                        <option value="4">Tamil</option>
                      </select>
                    </div>
                 </div>

                 <div class="col-md-5">
                    <div class="custom-select" style="">
                        <label>Filter by status</label>
                      <select>
                        <option value="0">Select All:</option>
                        <option value="1">Published</option>
                        <option value="2">In Draft</option>
                        <option value="3">In Review</option>
                        <option value="4">Unpublished</option>
                      </select>
                    </div>
                 </div>

                 <div class="col-md-2">
                    <button class="btn btn--toggle-filter">All filters</button>
                 </div>
                    <!-- ngRepeat: filter in contentFilters -->

                </div>
            </section>
    </div>
</div>


    <div class="card" data-content-list="data.articleList"><div class="results">

    <!-- ngIf: list.items.length -->
    <h2 class="show-data-page">Showing 1 - 24 of 143 results</h2>
    <!-- end ngIf: list.items.length -->

    <div class="content-control-wrapper row row--no-margin between-xs">

        <!-- Bulk Edit -->
        <!-- ngIf: bulkEditCtrl && list.items.length -->
        <div class="bulk-edit-control col-md-4">
            <div class="u-flex">
                <div class="bulk-edit-control__multi-select drop-down">
                    <div class="btn btn--toggle-filter" >
                        <div class="standardInput no-label form-checkbox form-checkbox--multi-select"><input data-common-input="" class="form-element ng-pristine ng-untouched ng-valid ng-empty" type="checkbox"><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
                        <span class="drop-down__toggle" data-icon="down"></span>
                    </div>
                    <!-- ngIf: bulkEditCtrl.selectAllOptions -->
                </div>
                <div class="bulk-edit-control__options ng-hide">
                    <!-- hasRole: [ { type: 'CSTATUS', action: 'UPDATE' } ] -->
                    <button class="btn btn--toggle-filter">Submit translation</button>
                
                    <button class="btn btn--toggle-filter">Add references</button>
                
                </div>
            </div>
            <!-- ngIf: bulkEditCtrl.items.length -->
        </div><!-- end ngIf: bulkEditCtrl && list.items.length -->

        <!-- Filters -->
        <div class="filter-wrapper filter-wrapper--content u-flex--fill col-md-8">

            <div class="filter">
                <div class="standardInput form-input"><label class="form-label " for="input-0"><span class="form-label-text ">Max items</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-empty"><option value="" class="" selected="selected">24</option><option label="36" value="string:36">36</option><option label="48" value="string:48">48</option><option label="60" value="string:60">60</option></select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
            </div>

            <div class="filter">
                <div class="standardInput form-input"><label class="form-label " for="input-1"><span class="form-label-text ">Sort by</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-empty" id="input-1" name="input-1">
                    <option value="" data-i18n="label.updated">Last updated</option>
                    <option value="status" data-i18n="label.status">Status</option>
                    <option value="publishDate" data-i18n="label.publishdate">Publication date</option>
                </select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
            </div>

            <div class="filter filter--show-content-from">
                <div class="standardInput form-input"><label class="form-label " for="input-2"><span class="form-label-text ">Show content from</span></label><select class="form-element ng-pristine ng-untouched ng-valid ng-not-empty" id="input-2" name="input-2">
                <!-- ngIf: filterCtrl.params.toDate || filterCtrl.params.fromDate && !filterCtrl.showContentFromOptions[ filterCtrl.params.fromDate ] --><option label="All time" value="">All time</option><option label="The last year" value="string:1595701800000" selected="selected">The last year</option><option label="Last 2 years" value="">Last 2 years</option><option label="Last 3 years" value="">Last 3 years</option></select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
            </div>

            <div class="filter">
                
                <ul>
                    <h3 class="layout-left">Layout</h3>
                    <li class="btn primary"><i class="mdi mdi-apps"></i></li>
                    <li class="btn primary2" data-icon="list"><i class="mdi mdi-apps"></i></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Grid layout -->
    <!-- ngIf: layout === 'grid' -->
    <ol class="content-grid row">
        <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

            <label class="content-grid__select">
                <div class="standardInput no-label form-checkbox">
                    <input data-common-input="" class="form-element" type="checkbox" id="input-pl-4">
                </div>
            </label>

            <figure title="News Article">
                <a class="image" data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: !ContentSummaryAPIActive && item.thumbnail -->
                    <!-- ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <!-- <img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" alt="" src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" class="" style=""> --><!-- end ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <!-- new ContentSummaryAPIActive usage end -->
                    <span class="icon" data-icon="text"><i class="mdi mdi-file-document"></i></span>
                    <span class="icon" data-icon="text"></span>
                </a>
            </figure>

            <div class="info">
                <span class="status published" title="Published"></span>

                <dl class="metadata">
                    <!-- <dt class="title" data-i18n="label.title">Title</dt> -->
                    <dd class="title">
                        <a data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">Injury &amp; replacement updates - India’s Tour of England, 2021</a>
                        <!-- ngIf: item.internalName -->
                    </dd>
                    <dt class="id" data-i18n="label.id">ID</dt>
                    <dd class="id" data-ng-bind="item.id">154683</dd>
                    <dt class="type" data-i18n="label.type">Type</dt>
                    <dd class="type" data-i18n="content.type.TEXT">News Article</dd>
                    <dt class="date" data-i18n="label.updated">Last updated</dt>
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: ContentSummaryAPIActive --><dd class="date" data-ng-if="ContentSummaryAPIActive" data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'" style="">26/07/2021 12:45</dd><!-- end ngIf: ContentSummaryAPIActive -->
                    <!-- ngIf: !ContentSummaryAPIActive -->
                    <!-- new ContentSummaryAPIActive usage end -->
                    <dt class="language" data-i18n="label.language">Language</dt>
                    <dd class="language" data-language-label="item.language">English</dd>
                    <!-- ngRepeat: filter in filterCtrl.activeFilters -->
                </dl>

            </div>

        </li>

        <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

            <label class="content-grid__select">
                <div class="standardInput no-label form-checkbox">
                    <input data-common-input="" class="form-element" type="checkbox" id="input-pl-4">
                </div>
            </label>

            <figure title="News Article">
                <a class="image" data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: !ContentSummaryAPIActive && item.thumbnail -->
                    <!-- ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <!-- <img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" alt="" src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" class="" style=""> --><!-- end ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <!-- new ContentSummaryAPIActive usage end -->
                    <span class="icon" data-icon="text"><i class="mdi mdi-file-document"></i></span>
                    <span class="icon" data-icon="text"></span>
                </a>
            </figure>

            <div class="info">
                <span class="status published" title="Published"></span>

                <dl class="metadata">
                   <!--  <dt class="title" data-i18n="label.title">Title</dt> -->
                    <dd class="title">
                        <a data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">Injury &amp; replacement updates - India’s Tour of England, 2021</a>
                        <!-- ngIf: item.internalName -->
                    </dd>
                    <dt class="id" data-i18n="label.id">ID</dt>
                    <dd class="id" data-ng-bind="item.id">154683</dd>
                    <dt class="type" data-i18n="label.type">Type</dt>
                    <dd class="type" data-i18n="content.type.TEXT">News Article</dd>
                    <dt class="date" data-i18n="label.updated">Last updated</dt>
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: ContentSummaryAPIActive --><dd class="date" data-ng-if="ContentSummaryAPIActive" data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'" style="">26/07/2021 12:45</dd><!-- end ngIf: ContentSummaryAPIActive -->
                    <!-- ngIf: !ContentSummaryAPIActive -->
                    <!-- new ContentSummaryAPIActive usage end -->
                    <dt class="language" data-i18n="label.language">Language</dt>
                    <dd class="language" data-language-label="item.language">English</dd>
                    <!-- ngRepeat: filter in filterCtrl.activeFilters -->
                </dl>

            </div>

        </li>

        <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

            <label class="content-grid__select">
                <div class="standardInput no-label form-checkbox">
                    <input data-common-input="" class="form-element" type="checkbox" id="input-pl-4">
                </div>
            </label>

            <figure title="News Article">
                <a class="image" data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: !ContentSummaryAPIActive && item.thumbnail -->
                    <!-- ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <!-- <img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" alt="" src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" class="" style=""> --><!-- end ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <!-- new ContentSummaryAPIActive usage end -->
                    <span class="icon" data-icon="text"><i class="mdi mdi-file-document"></i></span>
                    <span class="icon" data-icon="text"></span>
                </a>
            </figure>

            <div class="info">
                <span class="status published" title="Published"></span>

                <dl class="metadata">
                    <!-- <dt class="title" data-i18n="label.title">Title</dt> -->
                    <dd class="title">
                        <a data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">Injury &amp; replacement updates - India’s Tour of England, 2021</a>
                        <!-- ngIf: item.internalName -->
                    </dd>
                    <dt class="id" data-i18n="label.id">ID</dt>
                    <dd class="id" data-ng-bind="item.id">154683</dd>
                    <dt class="type" data-i18n="label.type">Type</dt>
                    <dd class="type" data-i18n="content.type.TEXT">News Article</dd>
                    <dt class="date" data-i18n="label.updated">Last updated</dt>
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: ContentSummaryAPIActive --><dd class="date" data-ng-if="ContentSummaryAPIActive" data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'" style="">26/07/2021 12:45</dd><!-- end ngIf: ContentSummaryAPIActive -->
                    <!-- ngIf: !ContentSummaryAPIActive -->
                    <!-- new ContentSummaryAPIActive usage end -->
                    <dt class="language" data-i18n="label.language">Language</dt>
                    <dd class="language" data-language-label="item.language">English</dd>
                    <!-- ngRepeat: filter in filterCtrl.activeFilters -->
                </dl>

            </div>

        </li>

        <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

            <label class="content-grid__select">
                <div class="standardInput no-label form-checkbox">
                    <input data-common-input="" class="form-element" type="checkbox" id="input-pl-4">
                </div>
            </label>

            <figure title="News Article">
                <a class="image" data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: !ContentSummaryAPIActive && item.thumbnail -->
                    <!-- ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <!-- <img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" alt="" src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" class="" style=""> --><!-- end ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <!-- new ContentSummaryAPIActive usage end -->
                    <span class="icon" data-icon="text"><i class="mdi mdi-file-document"></i></span>
                    <span class="icon" data-icon="text"></span>
                </a>
            </figure>

            <div class="info">
                <span class="status published" title="Published"></span>

                <dl class="metadata">
                    <!-- <dt class="title" data-i18n="label.title">Title</dt> -->
                    <dd class="title">
                        <a data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">Injury &amp; replacement updates - India’s Tour of England, 2021</a>
                        <!-- ngIf: item.internalName -->
                    </dd>
                    <dt class="id" data-i18n="label.id">ID</dt>
                    <dd class="id" data-ng-bind="item.id">154683</dd>
                    <dt class="type" data-i18n="label.type">Type</dt>
                    <dd class="type" data-i18n="content.type.TEXT">News Article</dd>
                    <dt class="date" data-i18n="label.updated">Last updated</dt>
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: ContentSummaryAPIActive --><dd class="date" data-ng-if="ContentSummaryAPIActive" data-ng-bind="item.updatedAt | date: 'dd/MM/yyyy HH:mm'" style="">26/07/2021 12:45</dd><!-- end ngIf: ContentSummaryAPIActive -->
                    <!-- ngIf: !ContentSummaryAPIActive -->
                    <!-- new ContentSummaryAPIActive usage end -->
                    <dt class="language" data-i18n="label.language">Language</dt>
                    <dd class="language" data-language-label="item.language">English</dd>
                    <!-- ngRepeat: filter in filterCtrl.activeFilters -->
                </dl>

            </div>

        </li>

    </ol>

    <!-- end ngIf: layout === 'grid' -->

    <!-- ngIf: layout === 'list' -->

    <!-- ngIf: !list.items.length -->

    <div class="pagination-wrapper" data-ng-show="total > 1" data-filter-paging="list.totalPages">
  <!-- Empty div for flex alignment -->
  <div></div>
  <!-- <nav class="pagination">
      <ol>
        
          <li data-ng-class="{ disabled: pageData.page == 1 }" class="disabled">
              <span>‹</span>
              <span data-ng-click="changePage( pageData.page - 1 )" data-i18n="pagination.prev">Prev</span>
          </li>

          <li data-ng-repeat="page in pageData.outerWindow" data-ng-class="{ current: pageData.page === ( page + 1 ) }" class="current">
              <span data-ng-click="changePage( page + 1 )" data-ng-bind="page + 1">1</span>
          </li>
          <li data-ng-repeat="page in pageData.pages" data-ng-class="{ current: pageData.page === page }">
              <span data-ng-click="changePage( page )" data-ng-bind="page">2</span>
          </li>
          <li data-ng-repeat="page in pageData.pages" data-ng-class="{ current: pageData.page === page }">
              <span data-ng-click="changePage( page )" data-ng-bind="page">3</span>
          </li>
          <li data-ng-repeat="page in pageData.pages" data-ng-class="{ current: pageData.page === page }">
              <span data-ng-click="changePage( page )" data-ng-bind="page">4</span>
          </li>
          <li data-ng-if="pageData.last < ( total - pageData.outerWindow.length )" class="spacer disabled">…</li>
          <li data-ng-repeat="page in pageData.outerWindow | orderBy:'$index':true" data-ng-class="{ 'current': pageData.page === ( total - page ) }">
              <span data-ng-click="changePage( total - page )" data-ng-bind="total - page">6</span>
          </li>

          <li data-ng-class="{ disabled: pageData.page == total }">
              <span data-ng-click="changePage( pageData.page + 1 )" data-i18n="pagination.next">Next</span>
              <span>›</span>
          </li>
      </ol>

  </nav> -->
 <!--  <form class="go-to-page ng-pristine ng-valid ng-valid-min ng-valid-max" data-ng-submit="changePage( pageData.goToPage )" data-nowarn="true" novalidate="">
      <label class="go-to-page__label" data-i18n="pagination.goToPage">Go to page</label>
      <div class="standardInput no-label form-input go-to-page__input-wrap" go-to-page__input-wrap=""><input data-common-input="" class="go-to-page__input form-element ng-pristine ng-untouched ng-valid ng-valid-min ng-valid-max ng-not-empty" type="number" data-ng-model="pageData.goToPage" data-additional-css-class="go-to-page__input-wrap" min="1" max="6" id="input-pl-1">

      </div>
      <button type="submit" class="go-to-page__link">
          <span data-i18n="pagination.go">Go</span>
          <span>›</span>
      </button>
  </form> -->

</div>

</div>
</div>

</section>
   
</div>


@stop