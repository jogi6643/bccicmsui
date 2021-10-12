@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>
<style>
form.example button {
    float: left;
    width: 5%;
}
form.example input[type=text] {
width: 95%;}
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
            <li><a href="{{url('/')}}">Manage live blogs</a></li>
            <li class="active"></li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
  
  <section>
  
  <div class="content_text"><p>Manage live blogs</p></div>
  
<div class="top-search">
    <div class="row content-search-header">
            <section class="col-md-12 col-sm-12">
                <form class="example" action="/action_page.php">
                      <input type="text" placeholder="Enter search term..." name="search2">
                      <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </section>
            
    </div>
</div>


    <div class="card" data-content-list="data.articleList"><div class="results">

    <!-- ngIf: list.items.length -->
    <h2 class="show-data-page">Showing 1 - 24 of 143 results</h2>
    <!-- end ngIf: list.items.length -->

    <div class="content-control-wrapper row row--no-margin between-xs">
     <div class="col-md-6">
        <div class="form-group col-md-3">
                    <label class="col-sm-6 control-label">Active</label>
                    <div class="col-sm-3">
                    <input type="checkbox" name="bccid" id="tag-bccid" value="1" class="js-switch" data-color="#f96262" data-size="small" />                   
                    </div>
        </div>

        <div class="form-group col-md-3">
                    <label class="col-sm-6 control-label">Draft</label>
                    <div class="col-sm-3 ">
                    <input type="checkbox" name="bccid" id="tag-bccid" value="1" class="js-switch" data-color="#f96262" data-size="small" />                   
                    </div>
        </div>

        <div class="form-group col-md-3">
                    <label class="col-sm-6 control-label">Closed</label>
                    <div class="col-sm-3">
                    <input type="checkbox" name="bccid" id="tag-bccid" value="1" class="js-switch" data-color="#f96262" data-size="small" />                   
                    </div>
        </div>
     </div>   

        <!-- <div class="form-inline">
            <div class="standardInput form-radio">
                <input  class="form-element ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" type="radio" value="ACTIVE" name="input-984" id="input-984" checked="checked" style="">
                <label class="form-label " for="input-984">
                    <span class="form-label-text ">Active</span>
                </label>
            </div>
            <div class="standardInput form-radio">
                <input class="form-element ng-valid ng-not-empty ng-dirty ng-touched" type="radio" value="DRAFT" name="input-985" id="input-985" style="">
                <label class="form-label " for="input-985">
                    <span class="form-label-text ">Draft</span>
                </label>
            </div>
            <div class="standardInput form-radio">
                <input  class="form-element ng-pristine ng-untouched ng-valid ng-not-empty" type="radio" value="CLOSED" name="input-986" id="input-986">
                <label class="form-label " for="input-986">
                    <span class="form-label-text ">Closed</span>
                </label>
            </div>
        </div> -->
        
    </div>

    <!-- Grid layout -->
   

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