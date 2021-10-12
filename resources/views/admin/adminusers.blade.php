@extends('base') @section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
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


<div class="row">
    <div class="col-sm-12" style="margin-top:2%;">
        <div class="white-box col-md-12">
            <div style="overflow:hidden;margin-bottom:10px;">
                <h3 class="box-title" style="float:left;">Bcci Users</h3>
                <a href="adminusersaction">
                    <button class="btn btn-info" id="add-new-admin" style="float:right;">Add New</button>
                </a>
            </div>
 
         <!--search box -->
            <section class="col-md-6 col-sm-12 search-box">
                <form class="example" action="/action_page.php">
                      <input type="text" placeholder="Enter search term..." name="search2">
                      <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </section>
            <!--search box end-->
          <div class="col-md-12">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                    
                            <th scope="col">
                            <input name="product_all" type="checkbox" class="checked_all form-element" type="checkbox">&nbsp;<i class="glyphicon glyphicon-trash" style="color: #e20101"></i>&nbsp;All

                            </th>
                            <th>User ID <i class="glyphicon glyphicon glyphicon-sort"></i></th>
                            <th>User Display Name</th>
                            <th>User Login</th>
                            <th>User Email</th>
                            <th>User Role</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <input value="1" name="product" class="checkbox form-element" type="checkbox">
                            </th>
                            <td>1</td>
                            <td><a href="https://livecms.epicon.in/admin-user-action?user=1">Sourabh Pisolkar</a></td>
                            <td>sourabh.pisolkar@latestly.com</td>
                            <td>sourabh.pisolkar@latestly.com</td>
                            <td>1</td>
                            <td>
                             <a class="view1" title="" data-toggle="tooltip" href="adminusersaction" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>   
                             <a class="view1" title="" data-toggle="tooltip" data-original-title="delete"><i class="glyphicon glyphicon-trash"></i></a>
                             <!-- <a href="#"><span class="delete-admin-user" data-id="9"><i class="ti-trash"></i></span></a> -->
                         </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <input value="1" name="product" class="checkbox form-element" type="checkbox">
                            </th>
                            <td>2</td>
                            <td><a href="https://livecms.epicon.in/admin-user-action?user=2">Prafull Patil</a></td>
                            <td>ppatil@epicchannel.com</td>
                            <td>ppatil@epicchannel.com</td>
                            <td>1</td>
                            <td>
                             <a class="view1" title="" data-toggle="tooltip" href="adminusersaction" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>   
                             <a class="view1" title="" data-toggle="tooltip" data-original-title="delete"><i class="glyphicon glyphicon-trash"></i></a>
                             <!-- <a href="#"><span class="delete-admin-user" data-id="9"><i class="ti-trash"></i></span></a> -->
                         </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <input value="1" name="product" class="checkbox form-element" type="checkbox">
                            </th>
                            <td>9</td>
                            <td><a href="https://livecms.epicon.in/admin-user-action?user=9">Vivek</a></td>
                            <td>vivek.chaudhary@latestly.com</td>
                            <td>vivek.chaudhary@latestly.com</td>
                            <td>1</td>
                            <td>
                             <a class="view1" title="" data-toggle="tooltip" href="adminusersaction" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>   
                             <a class="view1" title="" data-toggle="tooltip" data-original-title="delete"><i class="glyphicon glyphicon-trash"></i></a>
                             <!-- <a href="#"><span class="delete-admin-user" data-id="9"><i class="ti-trash"></i></span></a> -->
                         </td>
                        </tr>
                        

                    </tbody>
                </table>

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
    </div>
</div> 

@stop