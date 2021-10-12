@include('admin.admin-header')
                
                <div class="row" STYLE="margin-top:2%;">
                    <div class="white-box">
                        <div class="panel panel-danger block4">
                            <div class="panel-heading"> Something Went Wrong!!
                                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
                            </div>
                            <div class="panel-wrapper collapse" aria-expanded="true" style="">
                                <div class="panel-body">
                                    <p>{{$exception}}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        
@include('admin.admin-footer')