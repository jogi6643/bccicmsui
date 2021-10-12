@extends('base') 
@section('title', 'User List')
@section('epic_content')
<!-- Get HTML from Epic dashboard.blade.php -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="js/sorting.js" type="text/javascript"></script>
<script type="text/javascript">
    // $(document).ready(function() {
    //     $(".search").keyup(function () {
    //         var searchTerm = $(".search").val();
    //         var listItem = $('.results tbody').children('tr');
    //         var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
    //         $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
    //             return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    //             }
    //         });
    
    //         $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    //             $(this).attr('visible','false');
    //         });

    //         $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    //             $(this).attr('visible','true');
    //         });

    //         var jobCount = $('.results tbody tr[visible="true"]').length;
    //         $('.counter').text(jobCount + ' item');

    //         if(jobCount == '0') {
    //             $('.no-result').show();
    //         }
    //         else{
    //             $('.no-result').hide();
    //         }
    //     });
    // });
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
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row  userlist">
    <section>
        <div class="content_text">
            <p>New User List</p>
        </div>
        <div class="white-box col-md-12">
            <div class="responsive-table player-table">
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
                @if(basename(URL::current()) == 'usersearch')
                    <div class="row">
                        <div class="col-md-6 float-right margin-top text-right">
                            <a href="{{url('/bcciuserlist')}}" class="new-player right"><i class="mdi mdi-right"></i> Back</a>
                        </div>
                    </div>
                @endif
                <form method="post" action="{{url('usersearch')}}">
                    {{csrf_field()}}    
                    <div class="col-md-6 margin-bottom"> 
                        <div class="float">
                            <!-- <label>Search By Name</label> -->
                            <input type="text" class="search form-control" placeholder="Search" name="search_field" value="" id="search_field" autocomplete="off">
                        </div>  
                    </div>
                </form>
                <div class="col-md-6 float-right margin-top text-right">
                    <a href="{{url('/bcciaddnewuser')}}" class="new-player right"><i class="mdi mdi-plus"></i> Add New User</a>
                </div>

                <span class="counter pull-right"></span>

                <div class="col-md-12">
                    <div class="table-responsive">
                        <table  class="table table-striped table-hover table-bordered results" id="">
                            <thead>
                                <tr>
                                    <th class="col-md-1 col-xs-1">
                                        <form method="POST" action="{{ route('deleteBulkUser') }}" name="user_form" id="deleteBulkUser" data-parsley-validate>
                                            {{csrf_field()}}
                                            <input type="hidden" value="" name="user_id" id="user_id">
                                        </form>
                                        <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">
                                        <a class="view_delete" id="delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">     <i class="glyphicon glyphicon-trash" style="color: #e20101"></i>
                                        </a>
                                    </th>
                                    <th class="col-md-1 col-xs-1" >User ID  <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> --></th>
                                    <th class="col-md-3 col-xs-3">User Display Name  <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> --></th>
                                    <th class="col-md-1 col-xs-2">User Email  <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> --></th>
                                    <th class="col-md-2 col-xs-3">User DOB  <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> --></th>
                                    <th class="col-md-2 col-xs-3">User Phone <!--  <i class="glyphicon glyphicon glyphicon-sort" ></i> --></th>
                                    <th class="col-md-2 col-xs-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userlist['userlisting'] as $user)
                                    <tr id="row_{{$user['user_id']}}" class="user_row">
                                        <td scope="row">
                                            <input value="{{$user['user_id']}}" name="check_user" class="checkbox check_user form-element" type="checkbox">
                                        </td>
                                        <td>{{ $user['user_id'] }}</td>
                                        <td>{{ $user['user_title'] }} {{ $user['user_first_name'] }} {{ $user['user_last_name'] }}</td>
                                        <td>{{ $user['user_email_id'] }}</td>
                                        <td>{{ $user['user_dob'] }}</td>
                                        <td>{{ $user['user_phone_number'] }}</td>
                                        <td>
                                            <a class="view1" title="" data-toggle="tooltip" data-original-title="view" href="{{url('bcciviewuser')}}/{{$user['user_id']}}"><i class="glyphicon glyphicon-eye-open"></i></a>
                                            <a class="view1" title="" data-toggle="tooltip" href="{{url('bccieditnewuser')}}/{{$user['user_id']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <form method="POST" action="{{ route('deleteUser') }}" name="user_form" id="deleteSingleUser_{{$user['user_id']}}" data-parsley-validate>
                                                {{csrf_field()}}
                                                <input type="hidden" value="{{$user['user_id']}}" name="single_user_id" id="single_user_id">
                                            </form>
                                            <i class="glyphicon glyphicon-trash single_delete_icon" id="delete_single_photo_{{$user['user_id']}}" style="color: #e20101"></i>
                                            <!-- <a class="view_delete" id="single_delete_icon" href="" data-original-title="Delete" type="button" data-toggle="modal" data-target="#exampleModalLong">     
                                                
                                            </a> -->
                                            <!-- <a class="view1 delete_user" id="delete_{{$user['user_id']}}" type="button"><i class="glyphicon glyphicon-trash"></i></a> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <?php
                        //dd()
                           // dd((array($userlist['']['link'])));
                            // $ulr = ((basename(URL::current())) == 'usersearch') ? 'usersearch' : 'bcciuserlist';
                        ?>
                        <nav aria-label="...">
                            <ul class="pagination right">
                            <?php
                                $count = 1;
                                
                                $listCount   =  count(collect($userlist['link'])); 
                                ?>
                                @foreach($userlist['link'] as $link)
                                    @if($count == 1)
                                    <?php
                                    $lable = 1;?>
                                    @elseif($listCount === $count)
                                    <?php $lable = $activePage+1;?>
                                    @else
                                    <?php $lable = $link['label'];?>
                                    @endif
                               
                                    <li class="page-item {{($link['active'] == 1 ? 'active' : '')}}">
                                    <a class="page-link" href="{{url('/bcciuserlist')}}/{!! $lable !!}"> 
                                            {!! $link['label']  !!}
                                        </a>
                                    </li>
                                    @php $count++ @endphp
                                @endforeach
                               
                            </ul>
                        </nav>
                    </div>
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
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="button" class="btn btn-primary yes_button" id="yes_button">Yes</button>
                        <button type="button" class="btn btn-primary delete-btn" data-dismiss="modal">No</button>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>

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

            $("#delete_icon").click(function(){
                var f_ids = [];
                $.each($("input[name='check_user']:checked"), function(){
                    f_ids.push($(this).val());
                });
                var all_id = f_ids.join(",")
                $("#user_id").val(all_id);
            });

            $(".single_delete_icon").click(function(){
                var id = $(this).attr('id');
                id = id.replace('delete_single_photo_','');
                $('#single_user_id_form').val(id);
                $('#exampleModalLong').modal('show');
            });
            
            $("#yes_button").click(function(){
                var id = $("#single_user_id_form").val();
                if($('.checkbox:checked').length > 0){
                    $( "#deleteBulkUser" ).submit();
                }
                else{
                    $("#deleteSingleUser_"+id).submit();
                }
            });

            // $("#search_field").on('keyup', function(e){
            //     // alert(1);
            //     if (e.key === 'Enter' || e.keyCode === 13){
            //         var serarch_value = $(this).val();
            //         console.log(serarch_value);
            //         if(serarch_value != ''){
            //             $.ajax({
            //                 url: APP_URL+'/usersearch',
            //                 type: "POST",
            //                 data: {
            //                     "_token": "{{ csrf_token() }}",
            //                     'serarch_value' : serarch_value
            //                 },
            //                 dataType: "text",
            //                 success: function(data){
            //                     console.log(data);
            //                 }
            //             });
            //         }
            //     }
            // });
        });
    </script>
@stop


