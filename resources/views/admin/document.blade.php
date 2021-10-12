@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="js/sorting.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify();
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("li.btn").click(function(){
        $("li.btn").removeClass("active");
        $(this).addClass("active");
});
        });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.checked_all').on('change', function() {     
                $('.checkbox').prop('checked', $(this).prop("checked"));              
        });
        //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked
        $('.checkbox').change(function(){ //".checkbox" change 
            if($('.checkbox:checked').length == $('.checkbox').length){
                   $('.checked_all').prop('checked',true);
            }else{
                   $('.checked_all').prop('checked',false);
            }
        });
        });
    </script>


<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        <ol class="breadcrumb">
            <li><a href="{{url('#')}}">Content Management</a></li>
            <li class="active">Document</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
  
  <section>
  
  <div class="content_text"><p>Manage document</p></div>
  
<div class="top-search">
    <div class="row content-search-header">
            <section class="col-md-6 col-sm-12">
                <form class="example" action="/action_page.php">
                  <div class="example">
                      <input type="text" placeholder="Enter search term..." name="search2">
                      <button type="submit"><i class="fa fa-search"></i></button>
                   </div>   
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
<div class="border-bottom">
    <h2 class="show-data-pa">Showing 1 - 24 of 143 results</h2>
    <div class="add-new-button">
        <a class="recent-content__add btn primary medium" href="addnewarticle"><i class="mdi mdi-plus"></i>Add New Document</a>
    </div>
 </div>   

    
    <!-- end ngIf: list.items.length -->


    <div class="content-control-wrapper row row--no-margin between-xs">

        <div class="bulk-edit-control ">
            <div class="u-flex"> 
            <!-- <div class="delete-div">
                <a href="#" >
                  <i data-toggle="tooltip" data-original-title="delete" class="glyphicon glyphicon-trash"></i>
                </a>
            </div> -->   
            
                <!-- <div class="bulk-edit-control__multi-select drop-down">
                    <div class="btn btn--toggle-filter" >
                        <div class="standardInput no-label form-checkbox form-checkbox--multi-select">
                          <input data-common-input="" class="form-element ng-pristine ng-untouched ng-valid ng-empty" type="checkbox">
                        </div>
                        <span class="drop-down__toggle" data-icon="down"></span>
                    </div>
                </div> -->
                <!-- <div class="bulk-edit-control__options ng-hide">
                    <button class="btn btn--toggle-filter">Submit translation</button>
                    <button class="btn btn--toggle-filter">Add references</button>
                
                </div> -->
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
                    <li class="btn primary active"><a href="{{url('article')}}" ><i class="mdi mdi-apps"></i></a></li>
                    <li class="btn primary2" data-icon="list">
                        <a href="{{url('articlesdata')}}" ><i class="mdi mdi-table"></i></a>
                     
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Grid layout -->
    <!-- ngIf: layout === 'grid' -->
          
<div class="table-responsive">
<table  class="table table-striped table-hover table-bordered results" >
  <thead>
    <tr>
      <th >
        <input name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">
        All&nbsp;
        <i class="glyphicon glyphicon-trash" style="color: #e20101"></i>
      </th>
      <th>ID  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th >Title  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th >Status  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th >Publication date  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th >Last updated  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th >Language  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th >Action</th>
    </tr>
    <tr class="warning no-result">
      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row">
        <input value="1" name="product" class="checkbox form-element" type="checkbox">
      </td>
      <td>121</td>
      <td>Second Sri Lanka-India T20I postponed</td>
      <td>Published</td>
      <td>27 Jul 2021 16:15</td>
      <td>  27 Jul 2021 16:26</td>
      <td>  English</td>
      <td>

        <a class="view1" title="" data-toggle="tooltip" href="navigation" data-original-title="view"><i class="glyphicon glyphicon-eye-open"></i></a>

        <a class="view1" title="" data-toggle="tooltip" href="uploadcontent" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
        
        <a class="view1" title="" data-toggle="tooltip" data-original-title="delete"><i class="glyphicon glyphicon-trash"></i></a>

      </td>
    </tr>
        <tr>
      <td scope="row">
        <input value="1" name="product" class="checkbox form-element" type="checkbox">
      </td>
      <td>122</td>
      <td>Second Sri Lanka-India T20I postponed</td>
      <td>Published</td>
      <td>27 Jul 2021 16:15</td>
      <td>  27 Jul 2021 16:26</td>
      <td>  English</td>
      <td>

        <a class="view1" title="" data-toggle="tooltip" href="navigation" data-original-title="view"><i class="glyphicon glyphicon-eye-open"></i></a>

        <a class="view1" title="" data-toggle="tooltip" href="uploadcontent" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
        
        <a class="view1" title="" data-toggle="tooltip" data-original-title="delete"><i class="glyphicon glyphicon-trash"></i></a>

      </td>
    </tr>
        <tr>
      <td scope="row">
        <input value="1" name="product" class="checkbox form-element" type="checkbox">
      </td>
      <td>123</td>
      <td>Second Sri Lanka-India T20I postponed</td>
      <td>Published</td>
      <td>27 Jul 2021 16:15</td>
      <td>  27 Jul 2021 16:26</td>
      <td>  English</td>
      <td>

        <a class="view1" title="" data-toggle="tooltip" href="navigation" data-original-title="view"><i class="glyphicon glyphicon-eye-open"></i></a>

        <a class="view1" title="" data-toggle="tooltip" href="uploadcontent" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
        
        <a class="view1" title="" data-toggle="tooltip" data-original-title="delete"><i class="glyphicon glyphicon-trash"></i></a>

      </td>
    </tr>
        <tr>
      <td scope="row">
        <input value="1" name="product" class="checkbox form-element" type="checkbox">
      </td>
      <td>124</td>
      <td>Second Sri Lanka-India T20I postponed</td>
      <td>Published</td>
      <td>27 Jul 2021 16:15</td>
      <td>  27 Jul 2021 16:26</td>
      <td>  English</td>
      <td>

        <a class="view1" title="" data-toggle="tooltip" href="navigation" data-original-title="view"><i class="glyphicon glyphicon-eye-open"></i></a>

        <a class="view1" title="" data-toggle="tooltip" href="uploadcontent" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
        
        <a class="view1" title="" data-toggle="tooltip" data-original-title="delete"><i class="glyphicon glyphicon-trash"></i></a>

      </td>
    </tr>

  </tbody>
</table>
</div>


     <!-- nav pagination start -->
 

        <nav aria-label="...">
          <ul class="pagination">
            <li class="page-item disabled">
              <span class="page-link">Previous</span>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active">
              <span class="page-link">
                2
                <span class="sr-only">(current)</span>
              </span>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>

      
     <!-- nav pagination end -->


    <!-- ngIf: layout === 'list' -->

    <!-- ngIf: !list.items.length -->
  <!-- Empty div for flex alignment -->

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