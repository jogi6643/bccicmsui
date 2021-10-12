@extends('base')
@section('epic_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/sorting.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("li.btn").click(function () {
                $("li.btn").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="{{url('#')}}">Content Management</a></li>
                <li class="active">article</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <!-- .row -->
    <div class="row">

        <section>

            <div class="content_text"><p>Manage articles</p></div>
            @include('show_message')
            @include('content.search')
            {{--<div class="top-search">
                <div class="row content-search-header">
                    <form class="example" action="{{url('/searchArticle')}}" method="post">
                        <section class="col-md-6 col-sm-12">
                            {{csrf_field()}}
                            <input type="text" placeholder="Enter search term..." name="search_term">
                            <input type="hidden" name="view" value="articles-list">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </section>
                        <section class="col-md-6 col-sm-12">
                            <div class="form-inline">
                                @php
                                $languages = config('bcciconfig.LANGUAGES');
                                $status = config('bcciconfig.CONTENT_STATUS');
                                @endphp
                                <div class="col-md-5">
                                    <div class="custom-select" style="">
                                        <label>Filter by language</label>
                                        <select name="language">
                                            <option value="">-- Select Language --</option>
                                            @foreach($languages as $val)
                                            <option value="{{$val}}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="custom-select" style="">
                                        <label>Filter by status</label>
                                        <select name="status">
                                            <option value="">-- Select status --</option>
                                            @foreach($status as $val)
                                                <option value="{{$val}}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn--toggle-filter">All filters</button>
                                </div>
                                <!-- ngRepeat: filter in contentFilters -->
                            </div>
                        </section>
                    </form>
                </div>
            </div>--}}
@include('content.search')

            <div class="card" data-content-list="data.articleList">
                <div class="results">
                    <!-- ngIf: list.items.length -->
                    <div class="border-bottom">
                        <h2 class="show-data-pa">Showing 1 - 24 of 143 results</h2>
                        <div class="add-new-button">
                            <a class="recent-content__add btn primary medium" href="{{url('uploadcontent')}}"><i
                                    class="mdi mdi-plus"></i>Add new article</a>
                        </div>
                    </div>
                    <!-- end ngIf: list.items.length -->
                    <div class="content-control-wrapper row row--no-margin between-xs">
                        <div class="bulk-edit-control ">
                            <div class="u-flex">
                            </div>
                            <!-- ngIf: bulkEditCtrl.items.length -->
                        </div><!-- end ngIf: bulkEditCtrl && list.items.length -->
                        <!-- Filters -->
                        <div class="filter-wrapper filter-wrapper--content u-flex--fill col-md-8">

                            <div class="filter">
                                <div class="standardInput form-input"><label class="form-label " for="input-0"><span
                                            class="form-label-text ">Max items</span></label><select
                                        class="form-element ng-pristine ng-untouched ng-valid ng-empty">
                                        <option value="" class="" selected="selected">24</option>
                                        <option label="36" value="string:36">36</option>
                                        <option label="48" value="string:48">48</option>
                                        <option label="60" value="string:60">60</option>
                                    </select><!-- ngRepeat: ( error, value ) in ngModel.$error -->
                                </div>
                            </div>

                            <div class="filter">
                                <div class="standardInput form-input"><label class="form-label " for="input-1"><span
                                            class="form-label-text ">Sort by</span></label><select
                                        class="form-element ng-pristine ng-untouched ng-valid ng-empty" id="input-1"
                                        name="input-1">
                                        <option value="" data-i18n="label.updated">Last updated</option>
                                        <option value="status" data-i18n="label.status">Status</option>
                                        <option value="publishDate" data-i18n="label.publishdate">Publication date
                                        </option>
                                    </select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
                            </div>

                            <div class="filter filter--show-content-from">
                                <div class="standardInput form-input"><label class="form-label " for="input-2"><span
                                            class="form-label-text ">Show content from</span></label><select
                                        class="form-element ng-pristine ng-untouched ng-valid ng-not-empty" id="input-2"
                                        name="input-2">
                                        <!-- ngIf: filterCtrl.params.toDate || filterCtrl.params.fromDate && !filterCtrl.showContentFromOptions[ filterCtrl.params.fromDate ] -->
                                        <option label="All time" value="">All time</option>
                                        <option label="The last year" value="string:1595701800000" selected="selected">
                                            The last year
                                        </option>
                                        <option label="Last 2 years" value="">Last 2 years</option>
                                        <option label="Last 3 years" value="">Last 3 years</option>
                                    </select><!-- ngRepeat: ( error, value ) in ngModel.$error --></div>
                            </div>

                            <div class="filter">

                                <ul>
                                    <h3 class="layout-left">Layout</h3>
                                    <li class="btn primary active"><a href="{{url('articleslist')}}"><i
                                                class="mdi mdi-apps"></i></a></li>
                                    <li class="btn primary2" data-icon="list">
                                        <a href="{{url('articlesgrid')}}"><i class="mdi mdi-table"></i></a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Grid layout -->
                    <!-- ngIf: layout === 'grid' -->
                    <div class="table-responsive" id="article_table">
                        <table class="table table-striped table-hover table-bordered results">
                            <thead>
                            <tr>
                                <th class="col-md-1 col-xs-1">
                                    <form method="POST" action="{{ route('delete-article') }}" name="article_form" id="article_form" data-parsley-validate>
                                        {{csrf_field()}}
                                        <input type="hidden" value="" name="article_id" id="article_id">
                                        <input type="hidden" value="articleslist" name="from" id="from">
                                    </form>
                                    <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element">
                                    <a class="view_delete" id="delete_icon" href="" data-original-title="Delete"
                                       type="button" data-toggle="modal" data-target="#exampleModalLong"><i
                                            class="glyphicon glyphicon-trash" style="color: #e20101"></i></a>
                                </th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Status <i class="glyphicon glyphicon-sort"></i></th>
                                <th>Publication date <i class="glyphicon glyphicon-sort"></i></th>
                                <th>Last updated <i class="glyphicon glyphicon-sort"></i></th>
                                <th>Language </th>
                                <th>Action</th>
                            </tr>
                            <tr class="warning no-result">
                                <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $val)
                                <tr>
                                <td scope="row">
                                    <input  value="{{$val['ID']}}" name="check_article" class="checkbox check_article form-element" type="checkbox">
                                </td>
                                <td>{{$val['ID']}}</td>
                                <td>{{$val['title'] ?? ''}}</td>
                                <td>{{$val['currentstatus'] ?? ''}}</td>
                                <td>{{($val['publish_date'] ?? '')}}</td>
                                <td>{{($val['expiryDate'] ?? '')}}</td>
                                <td>{{$val['language'] ?? ''}}</td>
                                <td>

                                    <a class="view1" title="" data-toggle="tooltip" href="navigation"
                                       data-original-title="view"><i class="glyphicon glyphicon-eye-open"></i></a>

                                    <a class="view1" title="" data-toggle="tooltip" href="{{url('editarticle')}}/{{$val['ID']}}?from=articleslist"
                                       data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>

                                    <a class="view1" title="" data-toggle="tooltip" href="{{url('deletearticle')}}/{{$val['ID']}}?from=articleslist" data-original-title="delete"><i
                                            class="glyphicon glyphicon-trash"></i></a>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- nav pagination start -->
                    {{--<nav aria-label="...">
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
                    </nav>--}}
                </div>

            </div>
        </section>
    </div>
    <!-- Modal -->
    <div  class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 60%; margin: 0 auto;">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLongTitle">Do you really want to delete</h3>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button id="yes_delete" type="button" class="btn btn-primary">Yes</button>
                    <button type="button" class="close btn btn-primary delete-btn" data-dismiss="modal" aria-label="Close" aria-hidden="true">No</button>
                    <!-- <button type="button" class=""></button> -->
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $('#check_all').click(function () {
                if ($(this).prop("checked") == true) {
                    $('.check_article').prop('checked', true);
                } else if ($(this).prop("checked") == false) {
                    $('.check_article').prop('checked', false);
                }
            });

            $("#delete_icon").click(function () {
                var f_ids = [];
                $.each($("input[name='check_article']:checked"), function () {
                    f_ids.push($(this).val());
                });
                var all_id = f_ids.join(",")
                $("#article_id").val(all_id);
            });

            $("#yes_delete").click(function () {
                $("#article_form").submit();
            });


            $("#search_term").click(function() {
               var search_term = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '/searchArticle',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'search_term' : $("#search_term").val()
                    },
                    dataType: 'json',
                    success:function(data) {
                        console.log(data.html)
                        // alert(123);
                        $('#article_table').html(data.html);

                        /*$.each(data.data, function(key, value) {
                            $('#ajaxResults').html();
                        });*/
                    }
                });
            });



        });
    </script>

@stop
