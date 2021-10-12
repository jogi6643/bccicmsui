@extends('base') @section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.dropify').dropify();
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("li.btn").click(function() {
        $("li.btn").removeClass("active");
        $(this).addClass("active");
    });
});
</script>
<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4> </div>
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
    <div class="row">
        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading"> </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="30">ID</th>
                                <th width="300">Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>5</td>
                                <td>
                                    <h5>Home Banners</h5>
                                    <div style="text-align:right;">
                                        <button type="button" title="Edit" data-id="5" class="edit-list btn btn-info btn-outline btn-circle"><i class="ti-pencil-alt"></i></button>
                                        <button type="button" title="Copy" data-id="5" class="copy-list btn btn-info btn-outline btn-circle"><i class="ti-files"></i></button>
                                        <button type="button" title="Active" data-status="1" data-id="5" class="active-list btn btn-danger btn-outline btn-circle"><i class="ti-rss"></i></button>
                                        <button type="button" class="delete-list btn btn-info btn-outline btn-circle" data-id="5" title="Delete"><i class="ti-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>
                                    <h5>HOME - BINGE WATCH</h5>
                                    <div style="text-align:right;">
                                        <button type="button" title="Edit" data-id="7" class="edit-list btn btn-info btn-outline btn-circle"><i class="ti-pencil-alt"></i></button>
                                        <button type="button" title="Copy" data-id="7" class="copy-list btn btn-info btn-outline btn-circle"><i class="ti-files"></i></button>
                                        <button type="button" title="Active" data-status="1" data-id="7" class="active-list btn btn-danger btn-outline btn-circle"><i class="ti-rss"></i></button>
                                        <button type="button" class="delete-list btn btn-info btn-outline btn-circle" data-id="7" title="Delete"><i class="ti-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>
                                    <h5>TV SHOWS - Best of Mythology</h5>
                                    <div style="text-align:right;">
                                        <button type="button" title="Edit" data-id="8" class="edit-list btn btn-info btn-outline btn-circle"><i class="ti-pencil-alt"></i></button>
                                        <button type="button" title="Copy" data-id="8" class="copy-list btn btn-info btn-outline btn-circle"><i class="ti-files"></i></button>
                                        <button type="button" title="Active" data-status="1" data-id="8" class="active-list btn btn-danger btn-outline btn-circle"><i class="ti-rss"></i></button>
                                        <button type="button" class="delete-list btn btn-info btn-outline btn-circle" data-id="8" title="Delete"><i class="ti-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>
                                    <h5>TV Shows - TRAVEL STORIES</h5>
                                    <div style="text-align:right;">
                                        <button type="button" title="Edit" data-id="9" class="edit-list btn btn-info btn-outline btn-circle"><i class="ti-pencil-alt"></i></button>
                                        <button type="button" title="Copy" data-id="9" class="copy-list btn btn-info btn-outline btn-circle"><i class="ti-files"></i></button>
                                        <button type="button" title="Active" data-status="1" data-id="9" class="active-list btn btn-danger btn-outline btn-circle"><i class="ti-rss"></i></button>
                                        <button type="button" class="delete-list btn btn-info btn-outline btn-circle" data-id="9" title="Delete"><i class="ti-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                           
                
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8 list-form panel">
            <div class="white-box row">
                <h3 class="box-title m-b-0">Edit tray content</h3>
                <p class="text-muted m-b-30 font-13"> Select Content or Banners to create list </p>
                <form class="form-horizontal" method="post" action="https://livecms.epicon.in/lists" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="zin9TjEyQsSm9Xkuq9LV5iSXAB4jaMsxTfgWGpa4">
                    <input name="list_version" type="hidden" value="1">
                    <input type="hidden" name="action" value="add">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Title</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="" name="title" placeholder="title" required=""> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Display Title</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="" name="display_title" placeholder="title" required=""> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Display Title - HINDI</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="" name="display_title_HI" placeholder="HINDI title"> </div>
                        </div>
                        <!-- <div class="form-group">
                        <label class="col-md-12">Display Title - MARATHI</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" value="" name="display_title_MR" placeholder="MARATHI title">
                        </div>
                    </div> -->
                        <!-- <div class="form-group">
                        <label class="col-md-12">Display Title - TAMIL</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" value="" name="display_title_TA" placeholder="TAMIL title">
                        </div>
                    </div> -->
                        <div class="form-group">
                            <label class="col-md-12">Slug</label>
                            <div class="col-md-12">
                                <input type="text" name="slug" readonly="" class="form-control" placeholder="slug"> </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-12">Display Type</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="display_type" id="display_type" data-id="">
                                    <option value="STANDARD">Standard</option>
                                    <option value="SPECIAL">Special</option>
                                    <option value="BANNER">Banners</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-12">List Curated Language</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="curated_language" id="curated_language" data-id="">
                                    <option value="">Select Language</option>
                                    <option value="ENGLISH">ENGLISH</option>
                                    <option value="HINDI">HINDI</option>
                                    <option value="MARATHI">MARATHI</option>
                                    <option value="TAMIL">TAMIL</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- <div class="form-group">
                        
                            <label class="col-md-12">Search Content</label> 
                        <div class="col-md-12">
                            <input type="text" class="form-control search-content" placeholder="Search" name="search"> <span class="help-block"><small>Start Typing the title of content / banner.</small></span> </div>
                    </div> -->
                        <!-- <div class="form-group">
                            <label class="col-md-12">Show More Button</label>
                            <div class="col-md-12">
                                <input type="checkbox" name="show_more" value="1" class="js-switch" data-color="#2cabe3" data-size="small" data-switchery="true" style="display: none;"> </div>
                        </div> -->
                        <div class="form-group show_all" style="display:none">
                            <label class="col-md-12">Show All</label>
                            <div class="col-md-12">
                                <input type="checkbox" name="is_episodic" value="1" class="js-switch" data-color="#2cabe3" data-size="small" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;"><small style="left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span> </div>
                        </div>
                        <div class="form-group show_all" style="display:none">
                            <label class="col-sm-12">Show</label>
                            <select name="is_episodic_content_id" class="select2 select2-hidden-accessible" id="show_select" style="width:100%" data-select2-id="show_select" tabindex="-1" aria-hidden="true"> </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-show_select-container"><span class="select2-selection__rendered" id="select2-show_select-container" role="textbox" aria-readonly="true"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span>
                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                        <div class="form-group show_all" style="display:none">
                            <label class="col-sm-12">Episode Order</label>
                            <select name="episodic_content_order" class="select2 select2-hidden-accessible" id="episodic_content_order" style="width:100%" data-select2-id="episodic_content_order" tabindex="-1" aria-hidden="true">
                                <option value="" data-select2-id="4">please select</option>
                                <option value="asc">Ascending order</option>
                                <option value="desc">Descending order</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="3" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-episodic_content_order-container"><span class="select2-selection__rendered" id="select2-episodic_content_order-container" role="textbox" aria-readonly="true" title="please select">please select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span>
                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Add Content</label>
                            <div class="col-md-12">
                                <select name="select-content-list[]" class="select-content-list select2-hidden-accessible" multiple="" style="width:100%" data-select2-id="10" tabindex="-1" aria-hidden="true"></select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="11" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-12">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info btn-lg tray-btn">Submit</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- nav pagination start -->
    <!--  <nav aria-label="...">
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
            </nav> -->
    <!-- nav pagination end -->| </div>
</div>
</div>
</section>
</div> @stop