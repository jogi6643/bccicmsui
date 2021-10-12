@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
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

    /* $('#selectall').click(function() {
     if($(".allselect").prop('checked', true)){
        alert(1);
        $(".allselect").prop('unchecked', true);

    } 

      $(".allselect").prop('checked', true);
});

        });*/

    
})
</script>

<script type="text/javascript">

   function getval(sel)
    {
      if(sel.value==="selectall"){
          $("#deleteall").hide();
          $("#selectall").show();
      }else{
        $("#selectall").hide();
          $("#deleteall").show();
      }
    }

    

</script>

<!-- <script type="text/javascript">
    $(document).ready(function(){
    $('.check:button').toggle(function(){
        $('input:checkbox').attr('checked','checked');
        $(this).val('uncheck all')
    },function(){
        $('input:checkbox').removeAttr('checked');
        $(this).val('check all');        
    })
})


</script> -->
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
            <li><a href="{{url('/')}}">Manage articles</a></li>
            <li class="active"></li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">

<!-- <input type="button" class="check" value="check all"/>

   <input type="checkbox" class="cb-element" /> Checkbox  1
   <input type="checkbox" class="cb-element" /> Checkbox  2
   <input type="checkbox" class="cb-element" /> Checkbox  3 -->
  
  <section>
  
  <div class="content_text"><p>Manage articles</p></div>
  
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

        <div class="col-md-4">
            <div class="select-all-div">
                <input name="product_all" class="checked_all" type="checkbox">&nbsp; Select All
            </div>
            <div class="delete-div">
                <a href="#" ><i class="glyphicon glyphicon-trash" data-toggle="tooltip" data-original-title="delete"></i></a>
            </div>
        </div>
     
    <!--  <div class="col-md-4"> 
      <ul>
        <li><button id="selectall">Select All</button></li>
        <li><button id="deleteall">Delete All</button></li>
      </ul> 
    </div>  -->

      <!--select button and delete button div start-->

        <!-- <div class="bulk-edit-control col-md-4">
            <div class="u-flex">
               <div class="select_button"> 
                <select id="selcontent"  onchange="getval(this);">
                    <option value="">Action</option>
                    <option value="selectall">Select All</option>
                    <option value="deleteall">Delete All</option>
                </select>

                <button id="selectall" style="display: none;">Select All</button>
                <button id="deleteall" style="display: none;">Delete All</button>
               </div>
            </div>
            
        </div> -->

<!--select button and delete button div start-->

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
                    <li class="btn primary "><a href="{{url('article')}}" ><i class="mdi mdi-apps"></i></a></li>
                    <li class="btn primary2 active" data-icon="list">
                        <a href="{{url('articlesdata')}}" ><i class="mdi mdi-table"></i></a>
                     
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <!-- Grid layout -->
    <!-- ngIf: layout === 'grid' -->
    <ol class="content-grid row">

        <!-- ngRepeat: item in list.items -->
        <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
           <div class="border-side">
            <label class="content-grid__select">
                <div class="standardInput no-label form-checkbox">
                    <input value="1" name="product" class="checkbox form-element allselect" type="checkbox" id="input-pl-4">

                </div>
            </label>

            <figure title="News Article">
                <a class="image" data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: !ContentSummaryAPIActive && item.thumbnail -->
                    <!-- ngIf: ContentSummaryAPIActive && item.thumbnailUrl --><img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" alt="" src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" class="" style=""><!-- end ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <!-- new ContentSummaryAPIActive usage end -->
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
                    <!-- ngIf: ContentSummaryAPIActive --><dd class="date" >26/07/2021 11:45</dd><!-- end ngIf: ContentSummaryAPIActive -->
                    <!-- ngIf: !ContentSummaryAPIActive -->
                    <!-- new ContentSummaryAPIActive usage end -->
                    <dt class="language" data-i18n="label.language">Language</dt>
                    <dd class="language" data-language-label="item.language">English</dd>
                    <!-- ngRepeat: filter in filterCtrl.activeFilters -->
                </dl>

                <ul class="button_edit">
                         <li>
                            <a class="view" title="" data-toggle="tooltip" href="navigation" data-original-title="Edit"><i class="glyphicon glyphicon-eye-open"></i></a>
                          </li>  
                        <li>
                          <a class="view" title="" data-toggle="tooltip" href="uploadcontent" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                        </li>

                        <li>
                        <a class="view" title="" data-toggle="tooltip" href="#" data-original-title="Edit"><i class="glyphicon glyphicon-trash"></i></a>
                        </li>
                     </ul>

            </div>
         </div>
        </li>

        <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

            <label class="content-grid__select">
                <div class="standardInput no-label form-checkbox">
                    <input value="2" name="product" class="checkbox form-element allselect checkbox" type="checkbox" id="input-pl-4">
                </div>
            </label>

            <figure title="News Article">
                <a class="image" data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: !ContentSummaryAPIActive && item.thumbnail -->
                    <!-- ngIf: ContentSummaryAPIActive && item.thumbnailUrl --><img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" alt="" src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" class="" style=""><!-- end ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <!-- new ContentSummaryAPIActive usage end -->
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

                <ul class="button_edit">
                         <li>
                            <a class="view" title="" data-toggle="tooltip" href="navigation" data-original-title="Edit"><i class="glyphicon glyphicon-eye-open"></i></a>
                          </li>  
                        <li>
                          <a class="view" title="" data-toggle="tooltip" href="uploadcontent" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                        </li>

                        <li>
                        <a class="view" title="" data-toggle="tooltip" href="#" data-original-title="Edit"><i class="glyphicon glyphicon-trash"></i></a>
                        </li>
                     </ul>

            </div>

        </li>

        <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

            <label class="content-grid__select">
                <div class="standardInput no-label form-checkbox">
                    <input value="3" name="product" class="checkbox form-element allselect checkbox" type="checkbox" id="input-pl-4">
                </div>
            </label>

            <figure title="News Article">
                <a class="image" data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">
                    <!-- new ContentSummaryAPIActive usage start -->
                    <!-- ngIf: !ContentSummaryAPIActive && item.thumbnail -->
                    <!-- ngIf: ContentSummaryAPIActive && item.thumbnailUrl --><img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" alt="" src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" class="" style=""><!-- end ngIf: ContentSummaryAPIActive && item.thumbnailUrl -->
                    <!-- new ContentSummaryAPIActive usage end -->
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

                <ul class="button_edit">
                         <li>
                            <a class="view" title="" data-toggle="tooltip" href="navigation" data-original-title="Edit"><i class="glyphicon glyphicon-eye-open"></i></a>
                          </li>  
                        <li>
                          <a class="view" title="" data-toggle="tooltip" href="uploadcontent" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                        </li>

                        <li>
                        <a class="view" title="" data-toggle="tooltip" href="#" data-original-title="Edit"><i class="glyphicon glyphicon-trash"></i></a>
                        </li>
                </ul>

            </div>

        </li>

        <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

            <label class="content-grid__select">
                <div class="standardInput no-label form-checkbox">
                    <input value="4" name="product" class="checkbox form-element allselect" type="checkbox" id="input-pl-4">
                </div>
            </label>

            <figure title="News Article">
                <a class="image" data-cms-href="content.article.edit" data-params="item" href="content/articles/edit/154683/en">
                    <img data-ng-if="ContentSummaryAPIActive &amp;&amp; item.thumbnailUrl" data-ng-src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" alt="" src="https://resources.platform.bcci.tv/photo-resources/2021/07/26/9e19648d-e723-41df-956f-a75a3b0b78a6/DSC06768-1-.jpg?width=400&amp;height=260" class="" style="">
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

                <ul class="button_edit">
                         <li>
                            <a class="view" title="" data-toggle="tooltip" data-original-title="Edit"><i class="glyphicon glyphicon-eye-open"></i></a>
                          </li>  
                        <li>
                          <a class="view" title="" data-toggle="tooltip" href="uploadcontent" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                        </li>

                        <li>
                        <a class="view" title="" data-toggle="tooltip" data-original-title="Edit"><i class="glyphicon glyphicon-trash"></i></a>
                        </li>
                </ul>

            </div>

        </li>

    </ol><!-- end ngIf: layout === 'grid' -->

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


</div>

</div>
</div>

</section>
   
</div>


@stop