@extends('base')
@section('epic_content')
<div class="modal-dialog modal-lg" style="width:85%">
        <div class="modal-content">
            <div class="modal-header" style="padding:5px 15px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-12">
                <div class="white-box">  
                <div class="card-body wizard-content">
                <h4 class="card-title">Add New Video</h4>
                <h6 class="card-subtitle">Complete All the steps to add new video</h6>
                <input class="save_content_draft btn btn-primary" type="button" style="float:right;" value="Draft" name="draft_btn"></button>
                <form action="{{url('catalogs/')}}" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                <!-- Step 1 -->
                {{csrf_field()}}
                <input type="hidden" name="draft_check" value=""/>
                <input type="hidden" name="catalog_id" value="" />
                <input type="hidden" name="content_type" value="" />
                <input type="hidden" name="asset_type" value="" />
                <input type="hidden" name="action" value="add" />
                <input type="hidden" name="ID" value="0" />
                
                <input type="hidden" name="trasncoding_status_video" value="" />
                <input type="hidden" name="upload_status_video" value="" />
                <input type="hidden" name="trasncoding_status_promo" value="" />
                <input type="hidden" name="upload_status_promo" value="" />
                <input type="hidden" name="parent" value="" />
                <h6>Intro &amp; Meta</h6>
                <section>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="wfirstName2"> Title*:</label>
                <input type="text" class="form-control" value="" required name="title"> 
                </div>
                <div class="form-group">
                <label for="wemailAddress2"> Short Description*:</label>
                <textarea class="form-control draft_required_exclude" required id="short_description" name="short_description" rows="3"></textarea>
                </div>
                <div class="form-group">
                <label for="wemailAddress2"> Meta Title :</label>
                <input type="text" class="form-control" value="" name="meta_title">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="wfirstName2"> Slug*:</label>
                <input type="text" class="form-control" value="" readonly required name="slug"> 
                </div>
                <div class="form-group">
                <label for="wlastName2"> Description*:</label>
                <textarea class="form-control draft_required_exclude" required name="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                <label for="wlastName2"> Meta Description :</label>
                <textarea class="form-control" name="meta_description" rows="3"></textarea>
                </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="wlastName2"> Genres*:
                </label>

                <select class="select2 m-b-10 select2-multiple draft_required_exclude" required multiple name="genres[]" data-style="form-control" style="width:100%">
                
                </select>

                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="wphoneNumber2">Content Language*:</label>
                <select class="select2 m-b-10 select2-multiple draft_required_exclude" required name="language" data-style="form-control" style="width:100%">
                <option value="HI">Hindi</option>
                <option value="EN">English</option>
                <option value="BN">Bengali</option>
                <option value="GU">Gujarati</option>
                <option value="ML">Malayalam</option>
                <option value="MR">Marathi</option>
                <option value="PA">Punjabi</option>
                <option value="TE">Telugu</option>
                <option value="TA">Tamil</option>
                <option value="UR">Urdu</option>
                <option value="BHO">Bhojpuri</option>
                <option value="AR">Arabic</option>
                </select>
                </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wlocation2"> Duration (HH:mm:ss):
                            </label>
                                <input type="text" placeholder="HH:mm:ss" name="duration" class="form-control" value="" />
                        </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="wdate2">Order:</label>
                        <input type="number" name="content_order" value="" class="form-control"> 
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="wdate2">Keywords:</label>
                <input type="text" name="keywords" value="" class="form-control tagsinput">
                <span class="help-block">Press Enter After Each Tag</span> 
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="wdate2">Meta Keywords:</label>
                        <input type="text" name="meta_keywords" value="" class="form-control tagsinput">
                        <span class="help-block">Press Enter After Each Meta Tag</span> 
                        </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="wdate2">Select Property</label><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="css">BCCI Domestic &nbsp;&nbsp;&nbsp;</label> : 
                            </div>
                            <div class="col-md-6">
                                <input type="radio" id="html" name="domestic" value="yes"> Yes <input type="radio" id="css" name="domestic" value="no"> No
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="css">BCCI International</label> : 
                            </div>
                            <div class="col-md-6">
                                <input type="radio" id="html" name="international" value="yes"> Yes <input type="radio" id="css" name="international" value="no"> No
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="css">IPL</label> : 
                            </div>
                            <div class="col-md-6">
                                <input type="radio" id="html" name="ipl" value="yes"> Yes <input type="radio" id="css" name="ipl" value="no"> No
                            </div>
                        </div>
                        </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="wdate2">Publish Date:</label>
                                <div class="input-group date" id="publish_date">
                                    <input type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="wdate2">Publish Date:</label>
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <input id="timepicker" type="text" class="form-control input-small">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-offset-3 col-sm-9">
                        <input type="hidden" name="type" id="tag-type" value="">
                        <button type="submit" name="submit" id="submit" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                    </div>
                </div>
                </div>
                </section>
                
                </form>
                </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#publish_date').datepicker({
            forceParse: false
        });
        $('#timepicker').timepicker();
    });
</script>
@stop