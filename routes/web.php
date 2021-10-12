<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\LoginController::class, 'login']);

// route for login
Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name("login");
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout']);
Route::post('/login_check', [App\Http\Controllers\LoginController::class, 'loginCheck']);

// route for forgot password
Route::get('/forgotpassword', [App\Http\Controllers\LoginController::class, 'forgotpassword']);
Route::post('/setForgotPassword', [App\Http\Controllers\LoginController::class, 'setForgotPassword']);

// route for reset password
Route::get('/resetpassword', [App\Http\Controllers\LoginController::class, 'resetpassword'])->name('resetpassword');
Route::post('/resetpasswordpost', [App\Http\Controllers\LoginController::class, 'resetpasswordpost'])->name('resetpasswordpost');

Route::group(['middleware' => 'usersession'], function () {

	Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
	Route::get('/content', [App\Http\Controllers\DashboardController::class, 'content']);

	Route::get('/genres', [App\Http\Controllers\GenresController::class, 'index']);
	Route::get('/navigation', [App\Http\Controllers\NavigationMenuController::class, 'index']);
	Route::get('/termscondition', [App\Http\Controllers\NavigationMenuController::class, 'termscondition']);
	Route::get('/promo', [App\Http\Controllers\NavigationMenuController::class, 'promo']);
	Route::get('/article', [App\Http\Controllers\NavigationMenuController::class, 'article']);

	Route::get('/videos', [App\Http\Controllers\NavigationMenuController::class, 'video']);
	Route::get('/audio', [App\Http\Controllers\NavigationMenuController::class, 'audio']);
	Route::get('/document', [App\Http\Controllers\NavigationMenuController::class, 'document']);
	Route::get('/liveblogs', [App\Http\Controllers\NavigationMenuController::class, 'liveblog']);
	Route::get('/articlesdata', [App\Http\Controllers\NavigationMenuController::class, 'articlesdata']);
	Route::get('/addnewarticle', [App\Http\Controllers\NavigationMenuController::class, 'addnewarticle']);
	Route::get('/adminusers', [App\Http\Controllers\NavigationMenuController::class, 'adminusers']);
	Route::get('/adminusersaction', [App\Http\Controllers\NavigationMenuController::class, 'adminusersaction']);
	Route::get('/version1', [App\Http\Controllers\NavigationMenuController::class, 'version1']);
	Route::get('/version2', [App\Http\Controllers\NavigationMenuController::class, 'version2']);
	Route::get('/uploadcontent/{type?}', [App\Http\Controllers\NavigationMenuController::class, 'uploadcontent'])->name('uploadcontent');
	// Route::get('/uploadcontent/{type?}{id?}',[App\Http\Controllers\NavigationMenuController::class, 'uploadcontent']);
	Route::get('/assignrole', [App\Http\Controllers\NavigationMenuController::class, 'assignrole']);
	Route::get('/othermenucontent', [App\Http\Controllers\NavigationMenuController::class, 'othermenucontent']);
	Route::get('/bccidomestic', [App\Http\Controllers\NavigationMenuController::class, 'bccidomestic']);
	Route::get('/addcontentnew', [App\Http\Controllers\NavigationMenuController::class, 'addcontentnew']);
	Route::get('/othermenucontentinternal', [App\Http\Controllers\NavigationMenuController::class, 'othermenucontentinternal']);
	Route::get('/bcciinternational', [App\Http\Controllers\NavigationMenuController::class, 'bcciinternational']);
	Route::get('/vodlivematch', [App\Http\Controllers\NavigationMenuController::class, 'vodlivematch']);
	Route::get('/ipl', [App\Http\Controllers\NavigationMenuController::class, 'ipl']);
	Route::get('/edittray', [App\Http\Controllers\NavigationMenuController::class, 'edittray']);
	Route::get('/addmenu', [App\Http\Controllers\NavigationMenuController::class, 'addmenu']);

	Route::get('/bcciviewuser', [App\Http\Controllers\NavigationMenuController::class, 'bcciviewuser']);
	Route::get('/bccieditnewuser', [App\Http\Controllers\NavigationMenuController::class, 'bccieditnewuser']);

	Route::get('/gallary', [App\Http\Controllers\GallaryController::class, 'index']);

	Route::get('/venue', [App\Http\Controllers\VenueController::class, 'index']);
	Route::get('/livematch', [App\Http\Controllers\LiveMatchController::class, 'create']);
	Route::get('/vodmatch', [App\Http\Controllers\VodMatchController::class, 'create']);

	// route for user crud operation
	Route::get('/bcciuserlist/{id?}', [App\Http\Controllers\UserController::class, 'userlist']);
	Route::get('/bcciaddnewuser', [App\Http\Controllers\UserController::class, 'addNewUser']);
	Route::post('/savebccinewuser', [App\Http\Controllers\UserController::class, 'saveNewUser']);
	Route::get('/bcciviewuser/{id}', [App\Http\Controllers\UserController::class, 'viewUser']);
	Route::get('/bccieditnewuser/{id}', [App\Http\Controllers\UserController::class, 'editUser']);
	Route::post('/updatebccinewuser', [App\Http\Controllers\UserController::class, 'updateUser']);
	Route::post('/deleteUser', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('deleteusers');
	Route::post('/deleteBulkUser', [App\Http\Controllers\UserController::class, 'deleteBulkUser'])->name('deleteBulkUser');
	// Route::post('/usersearch/{id?}', [App\Http\Controllers\UserController::class, 'usersearch'])->name('usersearch');
	Route::match(array('GET', 'POST'), '/usersearch/{id?}', [App\Http\Controllers\UserController::class, 'usersearch'])->name('usersearch');
	Route::post('/userfilter', [App\Http\Controllers\UserController::class, 'userfilter']);

	// route for images
	// Route::get('/getimagelist',[App\Http\Controllers\ImageController::class, 'getImageList']);
	Route::get('/photo/fetchphoto',[App\Http\Controllers\ImageController::class, 'fetchphoto'])->name('fetchphoto');
	Route::post('/photofilter', [App\Http\Controllers\ImageController::class, 'photofilter'])->name('photofilter');
	Route::get('/photos/{id?}', [App\Http\Controllers\ImageController::class, 'getImageList'])->name('photos');
	Route::get('/photodata/{id?}', [App\Http\Controllers\ImageController::class, 'photodata'])->name('photodata');
	Route::post('/saveNewPhoto', [App\Http\Controllers\ImageController::class, 'saveNewPhoto'])->name('saveNewPhoto');
	Route::post('/deleteImage', [App\Http\Controllers\ImageController::class, 'deleteImage'])->name('deleteImage');
	Route::post('/deleteBulkPhoto', [App\Http\Controllers\ImageController::class, 'deleteBulkPhoto'])->name('deleteBulkPhoto');
	Route::get('/editPhoto/{id}', [App\Http\Controllers\ImageController::class, 'editImage'])->name('editImage');
	Route::post('/updateNewPhoto', [App\Http\Controllers\ImageController::class, 'updateNewPhoto'])->name('updateNewPhoto');
	Route::post('/searchImageByTitle', [App\Http\Controllers\ImageController::class, 'searchImageByTitle'])->name('searchImageByTitle');
	Route::post('/searchByFilter', [App\Http\Controllers\ImageController::class, 'searchByFilter'])->name('searchByFilter');
	Route::post('/photoSearch', [App\Http\Controllers\ImageController::class, 'photoSearch'])->name('photoSearch');
	Route::post('/photogridSearch', [App\Http\Controllers\ImageController::class, 'photogridSearch'])->name('photogridSearch');
	Route::post('/photoSearchlist', [App\Http\Controllers\ImageController::class, 'photoSearchlist'])->name('photoSearchlist');
	Route::post('/updateUrlSegment', [App\Http\Controllers\ImageController::class, 'updateUrlSegment'])->name('updateUrlSegment');
	Route::post('/phreferencesearch', [App\Http\Controllers\ImageController::class, 'phreferencesearch']);
	Route::post('/imagestagList', [App\Http\Controllers\ImageController::class, 'imagestagList']);
	// Route::get('/searchImageByLanguage',[App\Http\Controllers\ImageController::class, 'searchImageByLanguage'])->name('searchImageByLanguage');
	// Route::get('/searchImageByStatus',[App\Http\Controllers\ImageController::class, 'searchImageByStatus'])->name('searchImageByStatus');

	Route::get('/privilegeslist', [App\Http\Controllers\PrivilegesController::class, 'getPrivilegesList']);
	Route::post('/updateprivileges', [App\Http\Controllers\PrivilegesController::class, 'updatePrivileges'])->name('update-previleges');
	Route::post('/searchprivilege', [App\Http\Controllers\PrivilegesController::class, 'searchPrivilege']);
	// Route for Bio GetBioContent
	Route::get('/bios/fetchbios/',[App\Http\Controllers\bioController::class, 'fetchbios'])->name('fetchbios');
	Route::post('/singledeletebios', [App\Http\Controllers\bioController::class, 'singledeletebios'])->name('singledeletebios');
	Route::get('/bios/{id?}', [App\Http\Controllers\bioController::class, 'bioList'])->name('bioList');
	Route::get('/searchByTitleBio', [App\Http\Controllers\bioController::class, 'bioList']);
	Route::post('/GetBioContent', [App\Http\Controllers\bioController::class, 'GetBioContent']);
	Route::post('/biosfilter', [App\Http\Controllers\bioController::class, 'biosfilter'])->name('biosfilter');
	Route::get('/getbiosList/{id?}', [App\Http\Controllers\bioController::class, 'bioList']);
	Route::get('/getbiosgridList/{id?}', [App\Http\Controllers\bioController::class, 'biogridList']);
	Route::post('/addNewBio', [App\Http\Controllers\bioController::class, 'addNewBio'])->name('add-bio');
	Route::get('/deletebio/{id}', [App\Http\Controllers\bioController::class, 'deletebio']);
	Route::post('/deleteBulkBios', [App\Http\Controllers\bioController::class, 'deleteBulkBios'])->name('deleteBulkBios');
	Route::post('/searchByTitleBio',[App\Http\Controllers\bioController::class, 'searchByTitle']);
	Route::get('/biosdata',[App\Http\Controllers\bioController::class, 'Biosdata']);
	Route::get('/editBiosById/{id?}',[App\Http\Controllers\bioController::class, 'editBiosById'])->name('editBiosById');
	Route::post('/updateBios',[App\Http\Controllers\bioController::class, 'updateBios'])->name('updateBios');
	Route::post('/filterBios',[App\Http\Controllers\bioController::class, 'filterBios'])->name('filterBios');
	Route::post('/filterBiosgrid',[App\Http\Controllers\bioController::class, 'filterBiosgrid'])->name('filterBiosgrid');
	Route::get('/viewBioById',[App\Http\Controllers\bioController::class, 'viewBioById'])->name('viewBioById');
	Route::post('/BioreferanceRelated', [App\Http\Controllers\bioController::class, 'BioreferanceRelated']);

	// Route for video
	Route::post('/addNewVideo', [App\Http\Controllers\VideoController::class, 'addNewVideo'])->name('add-video');
	Route::get('/getVideoList/{id?}', [App\Http\Controllers\VideoController::class, 'getVideoList'])->name('getVideoList');
	Route::get('/videosdata/{id?}', [App\Http\Controllers\VideoController::class, 'videosdata']);
	Route::get('/getVideoById/{id?}', [App\Http\Controllers\VideoController::class, 'getVideoById'])->name('getVideoById');
	Route::post('/updateVideo', [App\Http\Controllers\VideoController::class, 'updateVideo']);
	Route::post('/deleteVideo', [App\Http\Controllers\VideoController::class, 'deleteVideo'])->name('deleteVideo');
	Route::get('/deleteVget/{id?}', [App\Http\Controllers\VideoController::class, 'deleteVget'])->name('deleteVget');
	Route::post('/deleteBulkVideo', [App\Http\Controllers\VideoController::class, 'deleteBulkVideo'])->name('deleteBulkVideo');
	Route::post('/languageStatusSearch', [App\Http\Controllers\VideoController::class, 'searchByLanguageAndStatus']);
	Route::post('/referanceRelated', [App\Http\Controllers\VideoController::class, 'referanceRelated']);
	Route::get('/commonStatusLang', [App\Http\Controllers\VideoController::class, 'commonStatusLang']);
	Route::get('/video/fetchVideo',[App\Http\Controllers\VideoController::class, 'fetchVideo']);
	// end video routes

	Route::get('/articles/fetchArticle',[App\Http\Controllers\ArticlesController::class, 'fetchArticle']);
	Route::get('/articles/{id?}', [App\Http\Controllers\ArticlesController::class, 'getArticlesList']);
	// Route::get('/articleslist',[App\Http\Controllers\ArticlesController::class, 'getArticlesList']);
	Route::get('/articlesgrid', [App\Http\Controllers\ArticlesController::class, 'getArticlesGrid']);
	Route::get('/editarticles/{id}', [App\Http\Controllers\ArticlesController::class, 'editArticles'])->name('editarticles');
	// Route::get('/deletearticles',[App\Http\Controllers\ArticlesController::class, 'deleteArticle'])->name('deletearticles');
	Route::post('/deletearticles', [App\Http\Controllers\ArticlesController::class, 'deleteArticle'])->name('deletearticles');
	// Route::post('/bulkdeletearticle',[App\Http\Controllers\ArticlesController::class, 'bulkDeleteArticle'])->name('delete-articles');
	Route::post('/addArticle', [App\Http\Controllers\ArticlesController::class, 'addArticle'])->name('addArticle');
	Route::post('/updateArticle', [App\Http\Controllers\ArticlesController::class, 'updateArticle'])->name('updateArticle');
	Route::post('/searchArticle', [App\Http\Controllers\ArticlesController::class, 'searchArticle'])->name('searchImageByTitle');
	Route::post('/searchartcletype', [App\Http\Controllers\ArticlesController::class, 'searchartcletype']);
	Route::post('/bulkDeleteArticle', [App\Http\Controllers\ArticlesController::class, 'bulkDeleteContent']);
	Route::get('/searchByTitle', [App\Http\Controllers\VideoController::class, 'searchByTitle']);

	Route::post('/languageStatusSearch', [App\Http\Controllers\VideoController::class, 'searchByLanguageAndStatus']);
	Route::post('/search', [App\Http\Controllers\VideoController::class, 'filter']);
	// end video routes

	//start Promos 
	Route::any('/contentList/promo', 'App\Http\Controllers\PromosController@index')->name('promo');
	// Route::get('/playlist/fetchplay',[App\Http\Controllers\PlayListController::class, 'fetchplay']);
	Route::get('/promo/fetchpromo', 'App\Http\Controllers\PromosController@fetchpromo');
	Route::get('/contentList/list', 'App\Http\Controllers\PromosController@list');
	Route::post('/contentList/addPromos', 'App\Http\Controllers\PromosController@store');
	Route::post('/contentList/searchFilter', 'App\Http\Controllers\PromosController@searchFilter');
	Route::post('/contentList/bulkdeletePromos', 'App\Http\Controllers\PromosController@Bulkdelete');
	Route::get('/contentList/deletePromos/{id}', 'App\Http\Controllers\PromosController@delete');
	Route::any('/contentList/editPromos/{id}', 'App\Http\Controllers\PromosController@edit')->name('editPromos');
	Route::post('/contentList/updatePromos', 'App\Http\Controllers\PromosController@update');
	Route::post('/contentList/filter', 'App\Http\Controllers\PromosController@filter');
	//end promos

	Route::get('/articleslist', [App\Http\Controllers\ArticlesController::class, 'getArticlesList'])->name('articleslist');
	Route::get('/articlesgrid', [App\Http\Controllers\ArticlesController::class, 'getArticlesGrid']);
	Route::get('/editarticles/{id}', [App\Http\Controllers\ArticlesController::class, 'editArticles'])->name('editarticles');
	// Route::get('/deletearticles/{id}', [App\Http\Controllers\ArticlesController::class, 'deleteArticle']);
	// Route::post('/bulkdeletearticle', [App\Http\Controllers\ArticlesController::class, 'bulkDeleteArticle'])->name('delete-articles');
	Route::post('/addArticle', [App\Http\Controllers\ArticlesController::class, 'addArticle'])->name('addArticle');
	Route::post('/updateArticle', [App\Http\Controllers\ArticlesController::class, 'updateArticle'])->name('updateArticle');
	Route::post('/searchArticle', [App\Http\Controllers\ArticlesController::class, 'searchArticle'])->name('searchImageByTitle');
	Route::post('/commonsearch', [App\Http\Controllers\ArticlesController::class, 'commonsearch']);
	Route::post('/articletagList', [App\Http\Controllers\ArticlesController::class, 'articletagList']);
	Route::post('/atriclefilter', [App\Http\Controllers\ArticlesController::class, 'atriclefilter']);
	Route::post('/bulkdeletearticles', [App\Http\Controllers\ArticlesController::class, 'bulkDeleteArticles']);
	Route::post('/articledelete', [App\Http\Controllers\ArticlesController::class, 'articledelete']);
	
	// route for playlist
	Route::get('/playlist/fetchplay',[App\Http\Controllers\PlayListController::class, 'fetchplay']);
	Route::get('/playlists/{id?}', [App\Http\Controllers\PlayListController::class, 'getplaylists'])->name('playlists');
	Route::post('/playlistfilter', [App\Http\Controllers\PlayListController::class, 'playlistfilter'])->name('playlistfilter');
	Route::post('/playlistSearchlist', [App\Http\Controllers\PlayListController::class, 'playlistSearchlist'])->name('playlistSearchlist');
	Route::post('/addplaylist', [App\Http\Controllers\PlayListController::class, 'addplaylist'])->name('addplaylist');;
	Route::get('/editplaylists/{id}', [App\Http\Controllers\PlayListController::class, 'editplaylists'])->name('editplaylists');
	Route::get('/playlistdata/{id?}', [App\Http\Controllers\PlayListController::class, 'playlistdata']);
	Route::post('/updateVedio', [App\Http\Controllers\PlayListController::class, 'updateVedio'])->name('updateVedio');
	Route::post('/deleteplaylists', [App\Http\Controllers\PlayListController::class, 'deleteplaylists'])->name('deleteplaylists');
	Route::post('/deleteBulklists', [App\Http\Controllers\PlayListController::class, 'deleteBulklists'])->name('deleteBulklists');
	Route::post('/searchByTitleplay', [App\Http\Controllers\PlayListController::class, 'searchByTitle']);
	Route::get('/contentList/{content_type}', [App\Http\Controllers\ContentController::class, 'contentList']);
	Route::post('/searchContent/{content_type}', [App\Http\Controllers\ContentController::class, 'searchContent']);

	Route::post('/commonSearchForReferenceAndContent', [App\Http\Controllers\ContentController::class, 'commonSearchForReferenceAndContent']);

	Route::get('/deleteContent/{content_type}/{id}', [App\Http\Controllers\ContentController::class, 'deleteContent']);
	Route::post('/bulkDeleteContent/{content_type}', [App\Http\Controllers\ContentController::class, 'bulkDeleteContent']);

	// add documnet 
	Route::post('/addNewdoc', [App\Http\Controllers\DocumentsController::class, 'addNewdoc'])->name('add-document');
	Route::get('/documnet/fetchdocumnet',[App\Http\Controllers\DocumentsController::class, 'fetchdocumnet'])->name('fetchdocumnet');
	Route::get('/getdocument/{id?}', [App\Http\Controllers\DocumentsController::class, 'getDocument']);
	Route::post('/documentfilter', [App\Http\Controllers\DocumentsController::class, 'documentfilter'])->name('documentfilter');
	Route::get('/getdocumentById/{id?}', [App\Http\Controllers\DocumentsController::class, 'getdocumentById']);
	Route::get('/viewdocById/{id?}', [App\Http\Controllers\DocumentsController::class, 'viewdocById']);
	Route::post('/updatedoc', [App\Http\Controllers\DocumentsController::class, 'updatedoc']);
	Route::post('/singledeletedoc', [App\Http\Controllers\DocumentsController::class, 'singledeletedoc'])->name('singledeletedoc');
	// Route::post('/deletedoc', [App\Http\Controllers\DocumentsController::class, 'deleteDoc'])->name('deletedoc');
	Route::post('/bulkDeletedocument', [App\Http\Controllers\DocumentsController::class, 'bulkDeletedocument'])->name('bulkDeletedocument');
	// Route::post('/bulkdeletedoc', [App\Http\Controllers\DocumentsController::class, 'bulkDeleteDoc'])->name('bulkdeletedoc');
	Route::post('/searchByTitleDoc', [App\Http\Controllers\DocumentsController::class, 'searchByTitle']);
	Route::get('/documentlistdata/{id?}', [App\Http\Controllers\DocumentsController::class, 'documentlistdata']);
	Route::post('/filterDocs',[App\Http\Controllers\DocumentsController::class, 'filterDocs'])->name('filterDocs');
	Route::post('/filterDocsgride',[App\Http\Controllers\DocumentsController::class, 'filterDocsgride'])->name('filterDocsgride');

	//Route for audios
	Route::post('/audiosearchlist', [App\Http\Controllers\AudioController::class, 'audiosearchlist']);
	Route::post('/audiofilter', [App\Http\Controllers\AudioController::class, 'audiofilter'])->name('audiofilter');;
	Route::get('/audio/fetchaudio',[App\Http\Controllers\AudioController::class, 'fetchaudio']);
	Route::get('/getAudioList/{id?}', [App\Http\Controllers\AudioController::class, 'getAudioList']);
	Route::post('/addNewAudio', [App\Http\Controllers\AudioController::class, 'addNewAudio'])->name('addNewAudio');
	Route::get('/editAudio/{id}', [App\Http\Controllers\AudioController::class, 'editAudio']);
	Route::post('/updateAudio', [App\Http\Controllers\AudioController::class, 'updateAudio'])->name('updateAudio');
	Route::post('/deleteAudio', [App\Http\Controllers\AudioController::class, 'deleteAudio'])->name('deleteAudio');
	Route::post('/deleteBulkaudio', [App\Http\Controllers\AudioController::class, 'deleteBulkaudio'])->name('deleteBulkaudio');
	Route::get('/audiolistdata', [App\Http\Controllers\AudioController::class, 'audiolistdata']);
	Route::post('/audiocommonsearch', [App\Http\Controllers\AudioController::class, 'audiocommonsearch']);

	//Tray Management
	Route::get('/tray-management', [App\Http\Controllers\TrayController::class, 'index']);
	Route::post('/saveTray',[App\Http\Controllers\TrayController::class, 'save'])->name('saveTray');
	Route::post('/deleteTray',[App\Http\Controllers\TrayController::class, 'delete'])->name('deleteTray');
	Route::get('/viewTray',[App\Http\Controllers\TrayController::class, 'view'])->name('viewTray');
	Route::post('/updateTray',[App\Http\Controllers\TrayController::class, 'update'])->name('updateTray');
	Route::post('/searchByTitle',[App\Http\Controllers\TrayController::class, 'searchByTitle'])->name('searchByTitle');

	//Tray Sorting
	Route::get('/tray-sorting', [App\Http\Controllers\TrayController::class, 'traySorting'])->name('tray-sorting');
	Route::post('/list-sort', [App\Http\Controllers\TrayController::class, 'listSort'])->name('list-sort');
	Route::post('/tray-list-sort', [App\Http\Controllers\TrayController::class, 'tray_list_sort'])->name('tray-list-sort');
	Route::post('/list-content-sort', [App\Http\Controllers\TrayController::class, 'listContentSort'])->name('list-content-sort');
	Route::get('/getListContent', [App\Http\Controllers\TrayController::class, 'getListContent']);
	Route::get('/getcataloglist', [App\Http\Controllers\TrayController::class, 'getcataloglist']);

	//Logo Management
	Route::get('/logo/{page?}', [App\Http\Controllers\LogoController::class, 'index']);
	Route::post('/saveLogo',[App\Http\Controllers\LogoController::class, 'save'])->name('saveLogo');
	Route::post('/deleteLogo',[App\Http\Controllers\LogoController::class, 'delete'])->name('deleteLogo');
	Route::get('/viewLogo',[App\Http\Controllers\LogoController::class, 'view'])->name('viewLogo');
	Route::post('/updateLogo',[App\Http\Controllers\LogoController::class, 'update'])->name('updateLogo');

	//Menu Management
	//Route::get('/tray-management', [App\Http\Controllers\NavigationMenuController::class, 'index']);
	Route::post('/savemenu',[App\Http\Controllers\NavigationMenuController::class, 'savemenu'])->name('savemenu');
	Route::post('/deletemenu',[App\Http\Controllers\NavigationMenuController::class, 'deleteMenu'])->name('deletemenu');
	//Route::get('/viewTray',[App\Http\Controllers\NavigationMenuController::class, 'view'])->name('viewTray');
	//Route::post('/updateTray',[App\Http\Controllers\NavigationMenuController::class, 'update'])->name('updateTray');
    

	//Common Status 
	Route::post('/change-status',[App\Http\Controllers\CommonStatusController::class, 'statusUpdate'])->name('statusUpdate');

	///////////// Social  AyrShare /////////////////
Route::get('/SocialShare',[App\Http\Controllers\SocialShareController::class, 'index']);
Route::post('/SharePost',[App\Http\Controllers\SocialShareController::class, 'SharePost']);
});
