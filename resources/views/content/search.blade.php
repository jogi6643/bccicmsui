<div class="top-search">
    <div class="row content-search-header">
        <section class="col-md-5 col-sm-12">
            <div class="example">
                <input type="text" placeholder="Enter search term..." name="search_term" id="search_term">
                <button id="search_term_submit"><i class="fa fa-search"></i></button>
            </div>
        </section>
        <section class="col-md-7 col-sm-12">

            {{csrf_field()}}
            @php
                $languages = config('bcciconfig.LANGUAGES');
                $status = config('bcciconfig.CONTENT_STATUS');
            @endphp
            <div class="form-inline">
                <div class="col-md-7">
                    <div class="custom-select fiftyper">
                        <label>Filter by language</label>
                   
                        @if($content_type=='articles')
                        <select name="search_language" id="search_language" class="selectpicker applybtn" multiple data-actions-box="true" >
                            <option value="en">English</option>
                            <option value="hi">Hindi</option>
                        </select>
                        @else
                         <select name="search_language" id="search_language" class="selectpicker applybtn" multiple data-actions-box="true" >
                            @foreach($languages as $val)
                                <option value="{{$val}}">{{$val}}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>

                    <div class="custom-select fiftyper" style="">
                        <label>Filter by status</label>
                        @if($content_type=='articles')
                        <select name="search_language" id="search_language" class="selectpicker applybtn" multiple data-actions-box="true" >
                            <option value="Publish">Draft</option>
                            <option value="unpublish">Un Publish</option>
                            <option value="publish">Publish</option>
                        </select>
                        @else
                         <select name="current_status" id="current_status" class="selectpicker applybtn" multiple data-actions-box="true" >
                            @foreach($status as $val)
                                <option value="{{$val}}">{{$val}}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn--toggle-filter" id="apply_search">Apply</button>
                    <button class="btn btn--toggle-filter" id="clear_search">Clear</button>
                </div>
                <div class="col-md-2">
                    <button class="btn btn--toggle-filter" data-toggle="modal" data-target="#Allfilter">All filters</button>
                </div>

                <!-- ngRepeat: filter in contentFilters -->

            </div>


        </section>
    </div>
</div>
