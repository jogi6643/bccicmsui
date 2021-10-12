<div class="modal-content" style="width: 100%; margin: 0 auto;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body wizard-content">
            <form data-parsley-validate action="{{ route('addArticle') }}" name="article_form" id="article_form" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                <button type="button" id="collapsesidebar-btn" class="collapse-btn">
                    <span><i class="mdi mdi-chevron-right fa-fw" data-icon="v"></i> Collapse sidebar</span>
                </button>
                <h6>Basic Info</h6>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wfirstName2"> Headline*:</label>
                                <input type="text" class="form-control" value="" name="title" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2"> Short Description*:</label>
                                <input type="text" class="form-control" value="" name="short_description" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <!-- <label for="wfirstName2">Subtitle:</label> -->
                                <label for="wfirstName2">Article Language:</label>
                                <input type="text" class="form-control" value="" name="subtitle" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Article Owner:</label>
                                <input type="text" class="form-control" value="" name="article_owner" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">                             
                            <div class="form-group">
                                <label for="wfirstName2">Photo:</label>
                                <input type="file" class="form-control" value="" name="photo" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Video Duration:</label>
                                <input type="text" class="form-control" value="" name="video_duration" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">      
                            <div class="form-group">
                                <label for="wfirstName2">Match Id:</label>
                                <input type="text" class="form-control" value="" name="match_id" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Content Type:</label>
                                <input type="text" class="form-control" value="" name="content_type" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Author:</label>
                                <input type="text" class="form-control" value="" name="author" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Keywords:</label>
                                <input type="text" class="form-control" value="" name="keywords" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Additional Info:</label>
                                <input type="text" class="form-control" value="" name="additionalInfo" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Match Formats:</label>
                                <input type="text" class="form-control" value="" name="match_formats" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">                 
                            <div class="form-group">
                                <label for="wfirstName2">Published By:</label>
                                <input type="text" class="form-control" value="" name="published_by" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Publish Date:</label>
                                <input type="text" class="form-control datepicker" value="" name="publish_date" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">                
                            <div class="form-group">
                                <label for="wfirstName2">Language:</label>
                                <input type="text" class="form-control" value="" name="language" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Location:</label>
                                <input type="text" class="form-control" value="" name="location" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">References:</label>
                                <input type="text" class="form-control" value="" name="references" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Expiry Date:</label>
                                <input type="text" class="form-control datepicker" value="" name="expiryDate" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">total_viewcount:</label>
                                <input type="text" class="form-control" value="" name="total_viewcount" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="wfirstName2">Total Viewcount:</label>
                                <input type="text" class="form-control" value="" name="total_viewcount" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">                 
                            <div class="form-group">
                                <label for="wfirstName2">Slug:</label>
                                <input type="text" class="form-control" value="" name="slug" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">     
                            <div class="form-group">
                                <label for="wfirstName2">Platform:</label>
                                <input type="text" class="form-control" value="" name="platform" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wlastName2">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="9" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label for="wlastName2">Summary</label>
                                <textarea class="form-control" id="summary" name="summary" rows="9" readonly></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="wlastName2">Body content</label>
                                <textarea name="content" row="20" id="content"  readonly></textarea>
                            </div>
                        </div>

                    </div>
                </section>
                <h6>Meta Information</h6>
                <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="wfirstName2"> Author</label>
                                <input type="text" class="form-control" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wemailAddress2"> Read time (seconds)</label>
                                <textarea class="form-control"  rows="3" readonly></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wlastName2"> Hotlink URL</label>
                                <textarea class="form-control"  rows="3" readonly ></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group date-time">
                                <label for="behName1">Display date</label>
                                <input type="text" class="form-control datepicker" placeholder="23/08/2021" value="" readonly >
                                <input type="text" class="form-control  timepicker" value="" placeholder="time 10:30" readonly >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Metadata* :</label>
                                <input type="text" class="form-control" value="" readonly >
                            </div>
                        </div>
                    </div>
                </section>
                <h6>Segmentation</h6>
                <section>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 10px;">
                            <div class="form-group checkbox-al">
                                <input type="checkbox" id="restrict" name="restrict" value="Bike" disabled>
                                <label for="restrict"> Restrict content to logged in users</label><br>
                            </div>
                        </div>
                    </div>
                </section>
                <div id="collapsingsidebar" class="collapssidebar">
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="content-ref">
                                        <h2>Content references</h2>
                                        <div class="reference-search" >
                                        <div class="reference-search__select-container">
                                            <ol class="selected-references-new" >
                                                <li class="selected-references-new__item" >
                                                    <div class="selected-references-new__item-title-block">
                                                        <div class="selected-references-new__item-title">4th Test </div>
                                                        <span class="selected-references-new__item-action-link-label">CRICKET_MATCH: 22439</span>
                                                    </div>
                                                </li>
                                                <li class="selected-references-new__item" >
                                                    <div class="selected-references-new__item-title-block">
                                                        <div class="selected-references-new__item-title">4th Test </div>
                                                        <span class="selected-references-new__item-action-link-label">CRICKET_MATCH: 22439</span>
                                                    </div>
                                                </li>                    
                                            </ol>   
                                        </div>  
                                        </div>                
                                    </div>
                                </div>
                                <div class="tagsinput">   
                                    <h2>Tags</h2>
                                    <input type="text" id="inputTag" value="Test , Test , Test , Test Test , Test " data-role="tagsinput" disabled>
                                    
                                </div>
                                <div class="content-ref">
                                        <h2>Related content</h2>
                                        <div class="reference-search" >
                                        <div class="reference-search__select-container">
                                            <ol class="selected-references-new" >
                                                <li class="selected-references-new__item" >
                                                    <div class="selected-references-new__item-title-block">
                                                        <div class="selected-references-new__item-title">4th Test </div>
                                                        <span class="selected-references-new__item-action-link-label">CRICKET_MATCH: 22439</span>
                                                    </div>
                                                </li>
                                                <li class="selected-references-new__item" >
                                                    <div class="selected-references-new__item-title-block">
                                                        <div class="selected-references-new__item-title">4th Test </div>
                                                        <span class="selected-references-new__item-action-link-label">CRICKET_MATCH: 22439</span>
                                                    </div>
                                                </li>                    
                                            </ol>   
                                        </div>  
                                        </div>                  
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </form>
            </div>
        </div>