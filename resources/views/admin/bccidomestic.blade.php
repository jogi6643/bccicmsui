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
        // back button provious page //
    $(".hBack").on("click", function(e){
    e.preventDefault();
    window.history.back();
});
        });
</script>

<!-- <script>
 $(document).ready(function() {  
 var divHover = null,
    windowClick = false;

$(function(){
  $(window).mousedown(function(){
    windowClick = true;
  });
  
  $(window).mouseup(function(){
    windowClick = false;
  });
  
  $('.draggable').hover(function(){
    if(divHover === null){
      divHover = $(this);
    }
  }, function(){
    if(windowClick === false){
      divHover = null;
      $(this).css('z-index', '0');
    }
  });
  
  $(window).mousemove(function(e){
    if(windowClick === true && divHover != null){
      divHover.css({ top: e.clientY - divHover.height() / 2 + 'px', left: e.clientX - divHover.width() / 2 + 'px', position: 'absolute', zIndex: '1' });
    }
  });
});
})

  </script> -->



<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        <ol class="breadcrumb">
            <li><a href="{{url('/')}}">BCCI Menu Item</a></li>
            <li class="active"></li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>

<!-- .row -->
<div class="container-fluid">
          <div class="row">    
              <div class="card margin-top">
                   
                   <!-- 3 columns -->
                      <div class="col-md-12 col-sm-12 col-xs-12"><h3>BCCI Domestic ( Menu Item )</h3></div>
                       
                        <div class="container">
                          <div class="row"> 
                           <div class="col-md-6 col-sm-6 col-xs-5">
                               <button class="btn btn-primary hBack" type="button"><i class="mdi mdi-chevron-left"></i>Back</button>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-7 text-right">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"><i class="mdi mdi-delete"></i> Delete box</button>
<!-- <a href="#" class="delete-button">Delete</a> -->
                            </div>
                         </div>   
                            <div class="col-xs-12 col-sm-3 " >
                             <a href="SocialShare">   
                              <div class="box draggable">
                                <h3>Social Media  </h3>
                              </div>
                             </a> 
                            </div>
                            
                            <div class="col-xs-12 col-sm-4 col-md-3">
                             <a href="othermenucontentinternal">   
                              <div class="box draggable">
                                <h3>Push Notification</h3>
                              </div>
                             </a> 
                            </div>
                            
                            <div class="col-xs-12 col-sm-4 col-md-3">
                             <a href="othermenucontentinternal">    
                              <div class="box draggable">
                                <h3>ODMS</h3>
                              </div>
                             </a> 
                            </div>

                           <div class="col-xs-12 col-sm-4 col-md-3">
                             <a href="othermenucontentinternal">    
                              <div class="box">
                                <h3>Others</h3>
                              </div>
                             </a> 
                            </div> 

                          <div class="col-xs-12 col-sm-4 col-md-3 draggable">
                             <a href="othermenucontentinternal">    
                              <div class="box">
                                <h3>Ball Tracking System</h3>
                              </div>
                             </a> 
                            </div>

                         <div class="col-xs-12 col-sm-4 col-md-3 draggable">
                             <a href="othermenucontentinternal">    
                              <div class="box">
                                <h3>Emailer Services</h3>
                              </div>
                             </a> 
                            </div>

                        <div class="col-xs-12 col-sm-4 col-md-3 draggable">
                             <a href="othermenucontentinternal">    
                              <div class="box">
                                <h3>Fan Engagement System</h3>
                              </div>
                             </a> 
                            </div> 

                         <div class="col-xs-12 col-sm-4 col-md-3 draggable">
                             <a href="othermenucontentinternal">    
                              <div class="box">
                                <h3>Analytics</h3>
                              </div>
                             </a> 
                            </div>             
                            
                          </div>
                        </div>


                 <!-- 3 columns -->

              </div>

          </div>
</div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Enter Password to Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Enter Your Password</label>
        <input id="password-field" type="password" class="form-control" name="password" value="secret">
        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        <!-- <input type="text" placeholder="Enter Your Password" class="enterpass"> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>

@stop