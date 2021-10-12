@extends('base') @section('epic_content')
<!-- Get HTML from Epic dashboard.blade.php -->
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li class="active"><a href="{{url('/')}}">Content home</a></li>
            <li class="active"></li>
        </ol>
    </div>
</div>
<!-- .row -->
<div class="row">
    <section>
        <div class="content_text">
            <p>Content home</p>
        </div>

        <div class="col-lg-12 u-margin-bottom">
            <div class="recent-content card">
                <div class="recent-content__header"> <a class="recent-content__title" href="#">Search content</a>
                   
                </div>
                <section class="search-section">
                    <input type="text" placeholder="Enter search term..." name="search_term">
                    <input type="hidden" name="view" value="articles-list">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </section>

            </div>
            <div class="row">
            	<div class="col-md-3">
            		<a class="content-block"  href="{{url('/articles')}}">
            			<i class="mdi mdi-image-filter fa-fw" data-icon="v"></i>
            			<p>Article</p>
            		</a>	
            	</div>
            	<div class="col-md-3">
            		<a class="content-block"  href="{{url('/photos')}}">
            			<i class="mdi mdi-camera fa-fw" data-icon="v"></i>
            			<p>Photos</p>
            		</a>
            	</div>	
            	<div class="col-md-3">
            		<a class="content-block"  href="{{url('/playlists')}}">
            			<i class="mdi mdi-playlist-plus fa-fw" data-icon="v"></i>
            			<p>Playlists</p>
            		</a>
            	</div>
            	<div class="col-md-3">
            		<a class="content-block"  href="{{url('/getVideoList')}}">
            			<i class="mdi mdi-play-circle-outline fa-fw" data-icon="v"></i>
            			<p>Videos</p>
            		</a>
            	</div>
            	<div class="col-md-3">
            		<a class="content-block"  href="{{url('/getAudioList')}}">
            			<i class="mdi mdi-volume-high fa-fw" data-icon="v"></i>
            			<p>Audio</p>
            		</a>
            	</div>
            	<div class="col-md-3">
            		<a class="content-block"  href="{{url('/contentList/promo')}}">
            			<i class="mdi mdi-image-filter-frames fa-fw" data-icon="v"></i>
            			<p>Promos</p>
            		</a>
            	</div>
            	<div class="col-md-3">
            		<a class="content-block"  href="{{url('/getdocument')}}">
            			<i class="mdi mdi-file-document-box fa-fw" data-icon="v"></i>
            			<p>Documents</p>	
            		</a>
            	</div>
            	<div class="col-md-3">
            		<a class="content-block"  href="{{url('/bios')}}">
            			<i class="mdi mdi-book-open fa-fw" data-icon="v"></i>
            			<p>Bios</p>
            		</a>
            	</div>


            </div>	
        </div>
        
       

    </section>
</div> @stop