@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $('select').selectpicker();
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



<style type="text/css">
    button.btn.dropdown-toggle.bs-placeholder.btn-default {
    padding: 8px 11px;
}
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
            <li><a href="{{url('#')}}">User Management</a></li>
            <li class="active">Assign Role</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>

                <div class="row">
                    <div class="col-md-12" style="margin-top:2%;">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <p class="box-title">Assign Role</p>
                            </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                        <div class="form-body">
                                            <hr>
                                    <form method="post" action="https://livecms.epicon.in/admin-user-action">
                                            <input type="hidden" name="_token" value="2WA1CO2xxeZh8a7rTty5FHr2LCHNHkTHCdFlCLAa">
                                            <div class="row">
                                                <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Role Name</label>
                                                        <input class="form-control" name="user_login" typr="text"> <span class="help-block"> This Should be Unique.</span></div>
                                                </div> -->

                                               <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Role Name</label>
                                                        <select name="user_role" class="form-control">
                                                            <option value="1">Admin</option>
                                                            <option value="2">Editor</option>
                                                            <option value="3">Author</option>
                                                            <option value="4">Contributor</option>
                                                        </select> <span class="help-block"> <i>User Level</i> </span> </div>
                                                </div> 


                                        <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">User rights</label>
                                                        <select class="selectpicker" multiple data-actions-box="true">
                                                          <option>Read</option>
                                                          <option>Write</option>
                                                        </select>
                                        </div>
                                    </div> -->    
                                                

                                
                                </div>
                                            
                                            <!-- <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Display Name</label>
                                                        <input class="form-control" type="text" name="display_name" required=""> <span class="help-block"> Name for Public Display </span> </div>
                                                </div>
                                            </div> -->
                        <div class="">

                            <div class="col-md-4 select-all">
                                <div class="select-all-div">
                                    <input name="product_all" class="checked_all" type="checkbox">&nbsp; Select All Privillages
                                </div>
                             </div>

                           <!--table start select read and write access checkbox checkbox-->
<table class="table table-hover table-bordered results access-role">
  <thead>
    <tr>
      <th>SR No</th>
      <th class="col-md-5 col-xs-5">Menu</th>
      <th class="col-md-4 col-xs-4">Read</th>
      <th class="col-md-3 col-xs-3">Write</th>
    </tr>
    <!-- <tr class="warning no-result">
      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
    </tr> -->
  </thead>
  <tbody>
    <tr>
      <td scope="row">1</td>
      <td style="font-weight: bold;">Upload Content</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

    <tr>
      <td scope="row">2</td>
      <td style="font-weight: bold;">Bucket</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td scope="row"></td>
      <td>Menu</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>


    <tr>
      <td scope="row">3</td>
      <td style="font-weight: bold;">Content Management</td>
      <td>-</td>
      <td>-</td>
    </tr>
    

    <tr>
      <td scope="row"></td>
      <td>Articles</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

    <tr>
      <td scope="row"></td>
      <td>Photo</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

    <tr>
      <td scope="row"></td>
      <td>Playlist</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

    <tr>
      <td scope="row"></td>
      <td>Videos</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

    <tr>
      <td scope="row"></td>
      <td>Audios</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>
    <tr>
      <td scope="row"></td>
      <td>Promos</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

    <tr>
      <td scope="row">4</td>
      <td style="font-weight: bold;">User Management</td>
      <td>-</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>
    <tr>
      <td scope="row"></td>
      <td>User List</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>
    <tr>
      <td scope="row"></td>
      <td>Assign Role</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

    <tr>
      <td scope="row">5</td>
      <td style="font-weight: bold;">Content Curation</td>
      <td>-</td>
      <td>-</td>
    </tr>
    <tr>
      <td scope="row"></td>
      <td>Live Streaming</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

    <tr>
      <td scope="row"></td>
      <td>VOD Content</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

    <tr>
      <td scope="row">6</td>
      <td style="font-weight: bold;">Tray Management</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

    <tr>
      <td scope="row">7</td>
      <td style="font-weight: bold;">Tray Sorting</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

    <tr>
      <td scope="row">8</td>
      <td style="font-weight: bold;">Other Menu</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

    <tr>
      <td scope="row">9</td>
      <td style="font-weight: bold;">Blogging </td>
      <td></td>
      <td></td>
    </tr>

    <tr>
      <td scope="row"></td>
      <td >Live Blogging </td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>
    <tr>
      <td scope="row"></td>
      <td >Blogging Icon</td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
      <td><input value="1" name="product" class="checkbox form-element" type="checkbox"></td>
    </tr>

</tbody>
</table>



                         </div> 


</form>
                        <div class="text-left">
                          <button class="submit" href="exampleModalLong"  data-toggle="modal" data-target="#exampleModalLong">Submit</button>
                         <button data-toggle="modal" data-target="#exampleModalLong2" class="submit cancel">Cancel </button> 
                          
                        </div> 
                    
                                                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                </div>

                <div  class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content" style="width: 60%; margin: 0 auto;">
                          <div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title text-center" id="exampleModalLongTitle">Data has been saved successfully</h3>
                          </div>
                          <div class="modal-footer text-center">
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                            <button data-dismiss="modal" aria-label="Close" type="button" class="btn btn-primary">Ok</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- cancel button popup start-->

                    <!-- Modal -->
<div  class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 60%; margin: 0 auto;">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="exampleModalLongTitle">Do you want to Cancel ?</h3>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-primary no" data-dismiss="modal" aria-label="Close" aria-hidden="true">No</button>
        <!-- <button type="button" class=""></button> -->
      </div>
    </div>
  </div>
</div>
@stop