@extends('base') @section('epic_content')
@section('title', 'Dashboard')
<!-- Get HTML from Epic dashboard.blade.php -->
<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4> </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li class="active"><a href="{{url('/')}}">Dashbaord</a></li>
            <li class="active"></li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row dashbaord-box">
    <section>
        <div class="content_text headbar">
            <p>Dashboard</p>
        </div>
        {{-- <section class="row card quick-links"> <span class="quick-links__label">Quick links</span>
            <ul class="quick-links__list">
                <li class="quick-links__link"><a class="action-link" href="#">Routing</a></li>
                <li class="quick-links__link"><a class="action-link" href="#">Pages</a></li>
                <li class="quick-links__link"><a class="action-link" href="#">Menus</a></li>
            </ul>
        </section> --}}
        <div class="col-lg-4 u-margin-bottom ">
            <div class="recent-content card">
                <div class="recent-content__header"> <span class="recent-content__title"><i class="mdi mdi-note-plus"></i>Articles</span>
                    <div class="add-new-button"> <a class="recent-content__add btn primary medium" href="{{ url('uploadcontent/articles') }}"><i class="mdi mdi-plus"></i>Add New Article</a> </div>
                </div>
                <div class="recent-content__content-wrap">
                    <div class="recent-content__list table fade-lazy">
                        @foreach($articles as $article)
                            <div class="recent-content__list-row table-row hover">
                                <div class="table-cell id">{{ $article['ID'] }}</div>
                                {{-- <a class="recent-content__item-title title" href="{{ route('editarticles', $article['ID'])}}">{{ $article['title'] }} </a> --}}
                                <span class="recent-content__item-title title">{{ $article['title'] }} </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="View-article-button"> <a class="view-all-button" href="{{ route('articleslist') }}">View all Articles</a> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 u-margin-bottom">
            <div class="recent-content card">
                <div class="recent-content__header"> <span class="recent-content__title"><i class="mdi mdi-google-photos"></i>Photos</span>
                    <div class="add-new-button"> <a class="recent-content__add btn primary medium" href="{{ url('uploadcontent/photos') }}"><i class="mdi mdi-plus"></i>Add New Photos</a> </div>
                </div>
                <div class="recent-content__content-wrap">
                    <div class="recent-content__list table fade-lazy">
                        @foreach($images as $image)
                            <div class="recent-content__list-row table-row hover">
                                <div class="table-cell id">{{ $image['ID'] }}</div>
                                {{-- <a class="recent-content__item-title title" href="{{ route('editImage', $image['ID'])}}">{{ $image['title'] }} </a> --}}
                                <span class="recent-content__item-title title" href="#">{{ $image['title'] }} </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="View-article-button"> <a class="view-all-button" href="{{ route('photos') }}">View all Photos</a> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 u-margin-bottom">
            <div class="recent-content card">
                <div class="recent-content__header"> <span class="recent-content__title"><i class="mdi mdi-playlist-plus"></i>Playlists</span>
                    <div class="add-new-button"> <a class="recent-content__add btn primary medium" href="{{ url('uploadcontent/playlists') }}"><i class="mdi mdi-plus"></i>Add New Playlists</a> </div>
                </div>
                <div class="recent-content__content-wrap">
                    <div class="recent-content__list table fade-lazy">
                        @foreach($playlists as $playlist)
                            <div class="recent-content__list-row table-row hover">
                                <div class="table-cell id">{{ $playlist['ID'] }}</div>
                                {{-- <a class="recent-content__item-title title" href="{{ route('editplaylists', $playlist['ID'])}}">{{ $playlist['title'] }} </a> --}}
                                <span class="recent-content__item-title title">{{ $playlist['title'] }} </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="View-article-button"> <a class="view-all-button" href="{{ route('playlists') }}">View all Playlists</a> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 u-margin-bottom" style="clear: both">
            <div class="recent-content card">
                <div class="recent-content__header"> <span class="recent-content__title"><i class="mdi mdi-video"></i>Videos</span>
                    <div class="add-new-button"> <a class="recent-content__add btn primary medium" href="{{ url('uploadcontent/videos') }}"><i class="mdi mdi-plus"></i>Add New Videos</a> </div>
                </div>
                <div class="recent-content__content-wrap">
                    <div class="recent-content__list table fade-lazy">
                        @foreach($videos as $video)
                            <div class="recent-content__list-row table-row hover">
                                <div class="table-cell id">{{ $video['ID'] }}</div>
                                {{-- <a class="recent-content__item-title title" href="{{ route('getVideoById', $video['ID'])}}">{{ $video['title'] }} </a> --}}
                                <span class="recent-content__item-title title">{{ $video['title'] }} </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="View-article-button"> <a class="view-all-button" href="{{ route('getVideoList') }}">View all Videos</a> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 u-margin-bottom">
            <div class="recent-content card">
                <div class="recent-content__header"> <span class="recent-content__title"><i class="mdi mdi-tag"></i>Promos</span>
                    <div class="add-new-button"> <a class="recent-content__add btn primary medium" href="{{ url('uploadcontent/promos') }}"><i class="mdi mdi-plus"></i>Add New Promos</a> </div>
                </div>
                <div class="recent-content__content-wrap">
                    <div class="recent-content__list table fade-lazy">
                        @foreach($promos as $promo)
                            <div class="recent-content__list-row table-row hover">
                                <div class="table-cell id">{{ $promo['ID'] }}</div>
                                {{-- <a class="recent-content__item-title title" href="{{ route('editPromos', $promo['ID'])}}">{{ $promo['title'] }} </a> --}}
                                <span class="recent-content__item-title title">{{ $promo['title'] }} </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="View-article-button"> <a class="view-all-button" href="{{ route('promo') }}">View all Promos</a> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 u-margin-bottom">
            <div class="recent-content card">
                <div class="recent-content__header"> <span class="recent-content__title"><i class="mdi mdi-blogger"></i>Bios</span>
                    <div class="add-new-button"> <a class="recent-content__add btn primary medium" href="{{ url('uploadcontent/bios') }}"><i class="mdi mdi-plus"></i>Add New Bios</a> </div>
                </div>
                <div class="recent-content__content-wrap">
                    <div class="recent-content__list table fade-lazy">
                        @foreach($bios as $bio)
                            <div class="recent-content__list-row table-row hover">
                                <div class="table-cell id">{{ $bio['ID'] }}</div>
                                {{-- <a class="recent-content__item-title title" href="{{ route('editBiosById', $bio['ID'])}}">{{ $bio['title'] }} </a> --}}
                                <span class="recent-content__item-title title">{{ $bio['title'] }} </span>
                            </div>
                        @endforeach
                    </div>
                    <!-- Commenting to fix dashboard error - Commented by Aaditya -->
                    <div class="View-article-button"> <a class="view-all-button" href=" {{ url('/bios')}}">View all Bios</a> </div>
                </div>
            </div>
        </div>
    </section>
</div> @stop
