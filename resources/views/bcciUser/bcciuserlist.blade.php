@extends('base') 
@section('title', 'User List')
@section('epic_content')
<!-- Get HTML from Epic dashboard.blade.php -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="js/sorting.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
          });
});
</script>

<?
    // dd($data['']);
?>

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

        $('.delete_user').click(function(){
            var id = $(this).attr('id');
            id = id.replace("delete_", "");
            $('.user_id').val(id);
            $('#exampleModalLong').modal('show');
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
            <!-- <li class="active"><a href="{{url('/bcciaddnewuser')}}">New User</a></li>
            <li class="active">New User List</li> -->
            <li class="active"><a href="{{url('/')}}">User Management</a></li>
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
        <div class="col-md-6 margin-bottom"> 
            <div class="float">
                <!-- <label>Search By Name</label> -->
                <input type="text" class="search form-control" placeholder="Search by Name">
            </div>  
        </div>
        
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
        <input name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">
        All&nbsp;
        <i class="glyphicon glyphicon-trash" style="color: #e20101"></i>
      </th>
      <th class="col-md-2 col-xs-2" >User ID  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th class="col-md-3 col-xs-3">User Display Name  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th class="col-md-1 col-xs-2">User Email  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th class="col-md-2 col-xs-3">User DOB  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th class="col-md-2 col-xs-3">User Phone  <i class="glyphicon glyphicon glyphicon-sort" ></i></th>
      <th class="col-md-2 col-xs-3">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($userlist['userlisting'] as $user)
    <tr id="row_{{$user['user_id']}}" class="user_row">
      <td scope="row">
        <input value="1" name="product" class="checkbox form-element" type="checkbox">
      </td>
      <td>{{ $user['user_id'] }}</td>
      <td>{{ $user['user_title'] }} {{ $user['user_first_name'] }} {{ $user['user_last_name'] }}</td>
      <td>{{ $user['user_email_id'] }}</td>
      <td>{{ $user['user_dob'] }}</td>
      <td>{{ $user['user_phone_number'] }}</td>
      <td>

        <a class="view1" title="" data-toggle="tooltip" data-original-title="view" href="{{url('bcciviewuser')}}/{{$user['user_id']}}"><i class="glyphicon glyphicon-eye-open"></i></a>

        <a class="view1" title="" data-toggle="tooltip" href="{{url('bccieditnewuser')}}/{{$user['user_id']}}" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>

        <a class="view1 delete_user" id="delete_{{$user['user_id']}}" type="button"><i class="glyphicon glyphicon-trash"></i></a>



      </td>
    </tr>
    @endforeach

  </tbody>
</table>
<nav aria-label="...">
    <ul class="pagination right">
         @foreach($userlist['link'] as $link)
            <a href="{{url('/bcciuserlist')}}/{{$link['label']}}"><li>{{$link['label']}}</li></a>
        @endforeach
    </ul>
</nav>
<div class="pagination">
    <ul>
       
    </ul>
</div>
</div>
</div>

</div>

    </section>
</div>

<!-- Modal -->
<div  class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 60%; margin: 0 auto;">
        <form method="post" action="{{url('/deleteUser')}}">
      <div class="modal-header">
        {{csrf_field()}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <input type="hidden" name="user_id" id="user_id" class="user_id" value="">
        <h3 class="modal-title" id="exampleModalLongTitle">Do you really want to delete</h3>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary yes_button">Yes</button>
        <button type="button" class="btn btn-primary delete-btn" data-dismiss="modal">No</button>
      </div>
      </form>
    </div>
  </div>
</div>

 @stop