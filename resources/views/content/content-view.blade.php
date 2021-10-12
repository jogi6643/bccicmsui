<?php //echo "asdfsadf";exit;?>
@extends('base')
@section('title', 'Article List')
@section('epic_content')
    <style type="text/css">
        .delete_icons {
            display: inline-block;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/sorting.js" type="text/javascript"></script>
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
                <li class="active">{{ucwords($content_type)}}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <div class="row">

        <section>
            <div class="content_text headbar"><p>Manage {{$content_type}}</p></div>
  
            @include('content.search')
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <div class="card" data-content-list="data.articleList">
                <div class="results">
                    <div class="border-bottom">
                        <h2 class="show-data-pa">Showing List of Articles</h2>
                        <div class="add-new-button">
                            <a class="recent-content__add btn primary medium" href="{{route('uploadcontent')}}"><i
                                    class="mdi mdi-plus"></i>Add new {{$content_type}}</a>
                        </div>
                    </div>
                    @include('content.filter')
                    @php
                        $bulk_delete_url = url('bulkDeleteContent/'.$content_type);
                    @endphp
                  
                    @if($content_type=='articles')
                 
                    <form method="POST" action="{{url('bulkDeleteArticle') }}" name="content_form" id="content_form"
                          data-parsley-validate>
                        {{csrf_field()}}
                        <input type="hidden" value="" name="content_id" id="content_id">
                    </form>
                  
                    @else
                    <form method="POST" action="{{ $bulk_delete_url }}" name="content_form" id="content_form"
                          data-parsley-validate>
                        {{csrf_field()}}
                        <input type="hidden" value="" name="content_id" id="content_id">
                    </form>
                    @endif
                    <div class="tab-content" id="load_data">
                        @include('content.contents-list-table')
                    </div>
                    @include('content.pagination')
                </div>
            </div>
        </section>
    </div>

    @include('content.confirm-delete')
    @include('content.all-filters')
    @include('content.content-script')
@stop
