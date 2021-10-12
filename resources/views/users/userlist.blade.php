@extends('base') 
@section('title', 'User List')
@section('epic_content')
<!-- Get HTML from Epic dashboard.blade.php -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="js/sorting.js" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $('.checked_all').on('change', function() {
                $('.checkbox').prop('checked', $(this).prop("checked"));
            });
            //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked
            $('.checkbox').change(function() { //".checkbox" change 
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('.checked_all').prop('checked', true);
                } else {
                    $('.checked_all').prop('checked', false);
                }
            });
        });
    </script>


<style type="text/css">
    a.view1 {
    padding: 4px;
    float: left;
}
.single_delete_icon {
    padding: 4px;
}
</style>

<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4> </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li class="active"> <a href="{{url('/bcciuserlist')}}">User Management</a></li>
            <li class="active">User List</li>
        
    </div>
    <!-- /.breadcrumb -->
</div>
    <!-- .row -->
    <div class="row">
        <section>
            <div class="content_text headbar">
                <p>User List</p>
            </div>
            </ol>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block alertMessage">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block alertMessage">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
            <div class="top-search">
                <div class="row content-search-header">
                    <section class="col-md-5 col-sm-12">
                        <div class="example">
                            <input type="text" placeholder="Enter search term..." name="search_term" id="search_term">
                            <button id="search_term_submit"><i class="fa fa-search"></i></button>
                        </div>

                    </section>
                    <section class="col-md-7 col-sm-12">
                    </section>
                </div>
            </div>
            <div class="card" data-content-list="data.articleList">
                <div class="results">

                    <!-- ngIf: list.items.length -->
                    <div class="border-bottom">
                   
                        <h2 class="show-data-pa showing_page_data"> results</h2>
                        <div class="add-new-button">
                            <a class="recent-content__add btn primary medium" href="{{ url('/bcciaddnewuser') }}"><i
                                    class="mdi mdi-plus"></i>Add New User</a>
                        </div>
                    </div>

                     <!-- end ngIf: list.items.length -->
                     <div class="content-control-wrapper row row--no-margin between-xs">
                        <div class="bulk-edit-control ">
                            <div class="u-flex">
                            </div>
                            <!-- ngIf: bulkEditCtrl.items.length -->
                        </div><!-- end ngIf: bulkEditCtrl && list.items.length -->
                        <div class="col-md-3 no-padd">
                            <div class="select-all-div">
                                <input id="check_all" name="product_all" type="checkbox"
                                    class="checked_all form-element">&nbsp;
                                <label for="check_all">Select All</label>
                            </div>
                            <div class="delete-div">
                                <a class="view_delete" id="delete_icon" href="" data-original-title="Delete"
                                    type="button" data-toggle="modal" data-target="#exampleModalLong">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Grid layout -->
                    <!-- ngIf: layout === 'grid' -->

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered results listing_table list_view" >
                            <thead>
                                <tr>
                                    <th>
                                        <form method="POST" action="#" name="user_form"
                                            id="deleteBulkuser" data-parsley-validate>
                                            {{ csrf_field() }}
                                            <input type="hidden" value="" name="user_id" id="user_id">
                                            <input type="hidden" value="tableview" name="userview">
                                        </form>
                                    </th>
                                    <th>User ID </th>
                                    <th>User Display Name </th>
                                    <th>User Email</th>
                                    <th>User DOB </th>
                                    <th>User Phone</th>
                                    <th class="action">Action</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">
                            </tbody>
                        </table>
                    </div>
                    
                    <ol class="content-grid row gride_ajax_data" style="display:none;margin-top: 0px !important;">
                    </ol>
                    <nav aria-label="..." class="paginations">
                        <ul class="pagination ajax_pagination">
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div  class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 60%; margin: 0 auto;">
                <!-- <form method="post" action="{{url('/deleteUser')}}"> -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <input type="hidden" name="user_id" id="single_user_id_form" class="single_user_id_form" value="">
                        <h3 class="modal-title" id="exampleModalLongTitle">Do you really want to delete</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary yes_button" id="yes_button">Yes</button>
                        <button type="button" class="btn btn-primary delete-btn" data-dismiss="modal">No</button>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('deleteusers') }}" name="user_form" class="deleteSingleUser"
        data-parsley-validate>
        {{ csrf_field() }}
        <input type="hidden" value="" name="single_user_id" id="single_user_id">
          <input type="hidden" value="tableview" name="userview">
    </form> 
   

    <script src="{{ asset('js/users/userlist.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("div#Viewpage button#collapsesidebar-btn").click(function() {
                $('div#Viewpage #collapsingsidebar').toggleClass("collapse-deactive");
                $('div#Viewpage section.body').toggleClass("collapse-deactive");
                $("div#Viewpage button#collapsesidebar-btn").text(function(i, v) {
                    return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
                });
            });
        });
         
        </script>

        
    @stop


