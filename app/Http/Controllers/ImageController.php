<?php

namespace App\Http\Controllers;

use App\Http\APIHandlers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
// use Session;
// use View;

class ImageController extends Controller
{
    //

    public function __construct()
    {
    }

    /**
     * view image listing page.
     *
     * @param array $request and $id
     * @return \Illuminate\View\View
     */
    public function getImageList(Request $request, $id = 1)
    {

        $language = language();
        $status   = status();
        $page = !empty($request->page) ? $request->page  : $id;
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . "images?page=" . $id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        //dd($response_data);

        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['photolist'] = $response_data['payload']['data'];
            $data['link'] = array_slice($response_data['payload']['links'], 1, -1);
            $data['current_page'] = $response_data['payload']['current_page'];
            $data['last_page'] = $response_data['payload']['last_page'];
            $data['from'] = $response_data['payload']['from'];
            $data['to'] = $response_data['payload']['to'];
            $data['total'] = $response_data['payload']['total'];
            $data['type'] = 'list';
        } else {
            $data = [];
        }

        // echo "<pre>";print_r($data);exit;
        return view('photos.photolist', [
            'photolist' => $data,
            'lang' => $language,
            'status' => $status
        ]);
    }

    function photofilter(Request $request)
    {
        // echo "safdsdafsdaf";exit;

        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'images/list';
        $headers = [
            // 'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'Accept: application/json',
        ];
        // $tags = !empty($request->tags) ? explode(",", $request->tags) : '';
        // $lang = !empty($request->lang) ? explode(",",  $request->lang) : '';
        // $current_status = !empty($request->current_status) ? explode(",", $request->current_status) : '';
        //dd($request->all());
        $postData = [
            "page_number"  => $request->page ?? 1,
            "per_page_count" => (int)$request->max_items,
            "import_source" => $request->filter_by_source,
            "from_date" => $request->from_date,
            "to_date" => $request->to_date,
            "content_reference" => $request->ref,
            "title" => $request->search_term,
            "max_items" => $request->max_item,
            "sort_by" => $request->sortby,
            // "order" => $request->max_item,
            "content_from" => $request->show_content_from,
            "tags" => !empty($tags) ? $tags : '',
            "language" =>  !empty($lang) ? $lang : '',
            "current_status" =>  !empty($current_status) ? $current_status : '',

        ];
        // echo '2';exit;
        $json = json_encode($postData);
        // echo "<pre>";print_r($postData);exit;
        $response = APIHandlers::get_api_response($method, $url, $headers, $json);
        // echo "<pre>";print_r($response);exit;
        $response_data = json_decode($response, true);
        // echo "<pre>";print_r($response_data);exit;
        if (!empty($response_data) && $response_data['status']['code'] == '200') {
            return response()->json([
                'listhtml' => view('photos.photoTable', ['photos' => $response_data, 'status' => true])->render(),
                'gridehtml' => view('photos.photoGride', ['photos' => $response_data, 'status' => true])->render(),
                'data'     => $response_data,
                'status'           => true,
                'status_code'      =>  200,
                'message'          => 'data get successfully',
            ], 200);
        } else {
            return response()->json([
                'status'           => false,
                'status_code'      =>  400,
                'message'          => 'data not avaliable',
            ], 200);
        }
    }


    public function photodata(Request $request, $id = 1)
    {

        $token = APIHandlers::get_token();

        $url = config('bcciconfig.CURD_API_URL') . "images?page=" . $id;
        $method = "GET";

        $headers = [
            'Cache-Control: no-cache',
            'Authorization: Bearer ' . $token,
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);

        $json_array = json_decode($response, true);

        if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
            $data['userlisting'] = $json_array['payload']['data'];
            $data['link'] = $json_array['payload']['links'];
        } else {
            $data['userlisting'] = array();
            $data['link'] = array();
        }

        return view('image.photosdata', ["photolist" => $data]);
    }

    /**
     * save new image.
     *
     * @param array $request
     * @return \Illuminate\View\View
     */
    public function saveNewPhoto(Request $request)
    {
        $postdata = $request->all() ?? null;
        $validator = Validator::make($postdata, [
            'title' => 'required|min:3',
            'photo_description' => 'required',
            // 'photo_keyword' => 'required',
            'photo_subtitle' => 'required',
            // 'published_by' => 'required',
            //'published_date' => 'required',
            // 'match_format' => 'required',
            // 'photo_status' => 'required',
            'photo_current_status' => 'required',
            // 'photo_platform' => 'required',
            // 'comments_on' => 'required',
            'copyright' => 'required',
            'language' => 'required',
            // 'image_file' => 'required',
        ]);
        $tags = $request->tags ?? null;
        if ($tags != null) {

            $t = [];
            foreach ($tags as $key => $v) {
                $t[$key]['id'] = $key;
                $t[$key]['label'] = $v;
            }
            $tags = json_encode($t);
        } else {
            $tags = null;
        }
        // New Logic for Content and  reference
        if (isset($request->photoreference)) {

            $ref = $request->photoreference;

            $arr = [];
            foreach ($ref as $key => $value) {

                $ids = explode("</h2>", $value);
                $tit = strip_tags($ids[0]);
                $articleid = explode("ID:", $ids[1]);
                $articleid = strip_tags($articleid[1]);
                $arr[$key]['id'] = $articleid;
                $arr[$key]['title'] = $tit;
                $arr[$key]['type'] = $postdata['imagesreference'];
            }
            $ref =  json_encode($arr) ?? null;
        } else {
            $ref = null;
        }
        // End Relete reference
        http://local.bcci-cms.in/photos
        // Start Content Refrence 
        if (isset($request->photocontentref)) {
            $arr = [];
            $cont = $request->photocontentref;
            foreach ($cont as $key => $value) {
                $ids = explode("</h2>", $value);
                $tit = strip_tags($ids[0]);
                $articleid = explode("ID:", $ids[1]);
                $articleid = strip_tags($articleid[1]);
                $arr[$key]['id'] = $articleid;
                $arr[$key]['title'] = $tit;
                $arr[$key]['type'] = $postdata['photocontentId'];
            }
            $cont =  json_encode($arr) ?? null;
        } else {
            $cont = null;
        }
        $platform = $request->platform??null;
        if( $platform!=null)
        {
            $t =[];
            foreach ($platform as  $v) {
                $t[]= $v;   
            }
            $platform = json_encode($t);
        }
        else
        {
            $platform = null;
        }
         // Platform 
         $country = $request->country ?? null;
         if( $country!=null)
         {
             $t =[];
             foreach ($country as  $v) {
                 $t[]= $v;   
             }
             $country = json_encode($t);
         }
         else
         {
             $country = null;
         }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            // $route = 'contentList/images';
            $route = 'photos';

            $method = 'POST';
            $url = config('bcciconfig.CURD_API_URL') . 'images';
            $token = APIHandlers::get_token();
            $headers = [
                'Cache-Control: no-cache',
                'Content-Type: multipart/form-data',
                'Authorization: Bearer ' . $token,
            ];

            $postfields = [
                'title' => $postdata['title'] ?? null,
                'description' => $postdata['photo_description'] ?? null,
                'keywords' => $postdata['photo_keyword'] ?? null,
                'additionalInfo' => $postdata['photo_additional_info'] ?? '',
                'subtitle' => $postdata['photo_subtitle'] ?? null,
                'match_formats' => $postdata['match_format'] ?? null,
                'created_date' => date('Y-m-d'),
                'published_by' => $postdata['published_by'] ?? null,
                //'publish_date' => $postdata['published_date'] ?? null,
                // 'related' => implode(',',$postdata['related_content_option']) ?? null,
                // 'references' => implode(',',$postdata['content_reference_option']) ?? null,
                'related' => $cont,
                'references' => $ref,
                'tags' => $tags,
                'coordinates' => $postdata['co_ordinates'] ?? '',
                'metadata' => $postdata['photo_meta_data'] ?? null,
                'status' => 'true', //$postdata['photo_current_status'] ?? null,
                'currentstatus' => $postdata['photo_current_status'] ?? null,
                'platform' => $platform,
                'location' => $postdata['photolocationsearch'] ?? null,
                'latitude' => $postdata['latitudephoto'] ?? null,
                'longitude' => $postdata['longitudephoto'] ?? null,
                'commentsOn' => $postdata['comments_on'] ?? null,
                'copyright' => $postdata['copyright'] ?? null,
                'language' => $postdata['language'] ?? null,
                'url_segment' => "/" . $postdata['titleUrlSegment'] ?? null,
                'image_url' => curl_file_create($request->file('img'), $request->file('img')->getMimeType(), $request->file('img')->getClientOriginalName()),
                'publish_date' => $postdata['publish_date'] . ' ' . $postdata['publish_time'] ?? null,
                'expiryDate' => $postdata['expiryDate'] . ' ' . $postdata['expiryTime'] ?? null,
                'geo_blocking' => $country ?? null,
            ];
           

            $response = APIHandlers::get_api_response($method, $url, $headers, $postfields);
            $response_data = json_decode($response, true);
            //  dd($response_data);
            if (!empty($response_data) && $response_data['status']['code'] == '200') {
                Session::flash('success', 'photos saved successfully!');
                return response()->json([
                    'data'             => $response_data,
                    'status'           => true,
                    'status_code'      =>  200,
                    'message'          => 'data get successfully',
                    'redirectUrl'      => $route,
                ], 200);
            } else {
                return response()->json([
                    'status'           => false,
                    'status_code'      =>  400,
                    'message'          => 'data not avaliable',
                ], 200);
            }
        }
    }

    /**
     * serach by image title
     *
     * @param  @search_value
     * @return \Illuminate\View\View
     */
    public function searchImageByTitle(Request $request)
    {

        $searchValue = $request->input('search_item');

        if ($searchValue != "") {

            $token = APIHandlers::get_token();
            $method = 'POST';
            $url = config('bcciconfig.CURD_API_URL') . 'images/searchItem';

            $headers = [
                'Content-Type:application/x-www-form-urlencoded',
                'Authorization: Bearer ' . $token
            ];

            $post_fields = array(
                'search_item' => $searchValue
            );

            $response = APIHandlers::get_api_response($method, $url, $headers, $post_fields, true);
            $json_array = json_decode($response, true);

            if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
                $data['userlisting'] = $json_array['payload']['data'];
                $data['link'] = $json_array['payload']['links'];
            } else {
                $data['userlisting'] = array();
                $data['link'] = array();
            }
        } else {
            $data['userlisting'] = array();
            $data['link'] = array();
        }

        return view('image.photos', ["photolist" => $data]);
    }

    /**
     * serach by image langauge
     *
     * @param  @search_value
     * @return \Illuminate\View\View
     */
    public function searchByFilter(Request $request)
    {

        $token = APIHandlers::get_token();
        $method = 'POST';
        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token
        ];

        if (!empty($request->input('language'))) {
            $post_fields = array(
                'language' => $request->input('language')
            );

            $url = config('bcciconfig.CURD_API_URL') . 'images/search_language';
        } elseif (!empty($request->input('status')) || $request->input('status') != "") {
            $post_fields = array(
                'status' => $request->input('status')
            );

            $url = config('bcciconfig.CURD_API_URL') . 'images/search_status';
        }

        $response = APIHandlers::get_api_response($method, $url, $headers, $post_fields, true);
        $json_array = json_decode($response, true);

        if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
            // $data['userlisting'] = (object)$json_array['payload']['data'];
            // $data['link'] = (object)$json_array['payload']['links'];
            $data['userlisting'] = $json_array['payload'];
        } else {
            $data['userlisting'] = array();
        }

        return view('image.photos', ["photolist" => $data]);
    }

    public function photoSearch(Request $request)
    {
        $token = APIHandlers::get_token();
        $method = 'POST';
        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token
        ];
        $post_fields = array(
            'search_title' => $request->input('serarch_value')
        );
        $url = config('bcciconfig.CURD_API_URL') . 'images/search';
        $response = APIHandlers::get_api_response($method, $url, $headers, $post_fields, true);
        $response_data = json_decode($response, true);

        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $image = $response_data['payload'];
            return response()->json([
                'html' => view('image.phototable', ['images' => $image,])->render(),
                'status' => true,
            ]);
        } else {
            $image = [];
            return response()->json([
                'html' => view('image.phototable', ['images' => $image,])->render(),
                'status' => false,
            ]);
        }
    }


    /**
     * serach by image status
     *
     * @param  @search_value
     * @return \Illuminate\View\View
     */
    public function searchImageByStatus(Request $request)
    {

        $searchValue = $request->input('search_field');

        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'images/search_status';

        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token
        ];

        $post_fields = array(
            'status' => $searchValue
        );

        $response = APIHandlers::get_api_response($method, $url, $headers, $post_fields, true);
        $json_array = json_decode($response, true);

        // dd($json_array);

        if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
            $data['userlisting'] = (object)$json_array['payload']['data'];
            $data['link'] = (object)$json_array['payload']['links'];
        } else {
            $data = array();
        }

        return view('admin.bcciuserlist', ["userlist" => $data]);
    }

    /**
     * delete image by paritcular id 
     *
     * @param  @id
     * @return \Illuminate\View\View
     */
    public function deleteImage(Request $request)
    {
        $id = $request['single_id'];
        $route = 'photos';
        $method = 'DELETE';
        $url = config('bcciconfig.CURD_API_URL') . 'images/' . $id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return response()->json([
                    'delete_status'           => true,
                    'status_code'      =>  200,
                    'success_message'          => 'data deleted successfully',
                ], 200);
                // return redirect($route)->with('success', $response_data['status']['message']);


            } else {
                return $response_data['status']['message'];
                return redirect($route)->with('error', $response_data['status']['message']);
            }
        } else {
            info('Photo Delete : ' . $response_data['message']);
            return redirect($route)->with('error', $response_data['message']);
        }
    }

    /**
     * delete bulk users.
     *
     * @param  @id
     * @return \Illuminate\View\View
     */
    public function deleteBulkPhoto(Request $request)
    {
        $id_array = $request['single_id'];
        if ($id_array == "") {
            $method = 'POST';
            $url = config('bcciconfig.CURD_API_URL') . 'images/bulk_delete';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ];
            $route = 'photos';
            $articleview = $request->input('videoview');
            $id_array = explode(',', $request->input('bulk_ids'));
            // echo "<pre>";print_r($id_array);exit;
            $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['images_ids' => $id_array]));
        } else {
            $id = $request['single_id'];
            $route = 'photos';
            $method = 'DELETE';
            $url = config('bcciconfig.CURD_API_URL') . 'images/' . $id;
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token
            ];

            $response = APIHandlers::get_api_response($method, $url, $headers);
        }
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return response()->json([
                    'delete_status'           => true,
                    'status_code'      =>  200,
                    'success_message'          => 'data deleted successfully',
                ], 200);
                // return redirect($route)->with('success', $response_data['status']['message']);


            } else {
                return $response_data['status']['message'];
                return redirect($route)->with('error', $response_data['status']['message']);
            }
        } else {
            info('playlist Delete : ' . $response_data['message']);
            return redirect($route)->with('error', $response_data['message']);
        }
        // $method = 'POST';
        // $url = config('bcciconfig.CURD_API_URL') . 'images/bulk_delete';
        // $token = APIHandlers::get_token();
        // $headers = [
        //     'Accept:application/json',
        //     'Authorization: Bearer ' . $token,
        //     'Content-Type: application/json'
        // ];
        // $route = 'photos';
        // $articleview = $request->input('videoview');
        // $id_array = explode(',', $request->input('bulk_ids'));
        // // echo "<pre>";print_r($id_array);exit;
        // $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['images_ids' => $id_array]));
        // // echo "<pre>"; print_r($response);exit;
        // $response_data = json_decode($response, true);
        // if (!empty($response_data['status']['code'])) {
        //     if ($response_data['status']['code'] == '200') {
        //         return response()->json([
        //             'delete_status'           => true,
        //             'status_code'      =>  200,
        //             'success_message'          => 'data deleted successfully',
        //         ], 200);
        //         // return redirect($route)->with('success', $response_data['status']['message']);
        //     } else {
        //         return redirect($route)->with('error', $response_data['status']['message']);
        //     }
        // } else {
        //     info('Photo Delete : ' . $response_data['message']);
        //     return redirect($route)->with('error', $response_data['message']);
        // }    
    }

    /**
     * edit single photo by id
     *
     * @param  @id
     * @return \Illuminate\View\View
     */
    public function editImage($id)
    {

        $language = language();
        $status   = status();
        $token = APIHandlers::get_token();
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'images/' . $id;

        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token
        ];

        $language = language();
        $status    = status();
        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                $photoData = $response_data['payload'];
            } else {
                $photoData = [];
            }
        } else {
            $photoData = [];
        }
        $publishtimestamp = $response_data['payload']['publishFrom'];
        $splitTimeStamp = explode(" ", $publishtimestamp);
        $publishdate = $splitTimeStamp[0] ?? '';
        $publishtime = $splitTimeStamp[1] ?? '';
        $expiretimestamp = $response_data['payload']['publishTo'];
        $splitTimeStamp = explode(" ", $expiretimestamp);
        $expiredate = $splitTimeStamp[0] ?? '';
        $expiretime = $splitTimeStamp[1] ?? '';
       //dd($response_data);
        return view('image.edit_photo', [
            "edit_data" => $photoData, 'language' => $language, 'status' => $status, 'publishdate' => $publishdate,
            'publishtime' => $publishtime, 'expiredate' => $expiredate, 'expiretime' => $expiretime
        ]);
    }

    /**
     * update single photo by id
     *
     * @param  @id
     * @return \Illuminate\View\View
     */
    public function updateNewPhoto(Request $request)
    {

        $photo_id = $request->input("photo_id");
        $postdata = $request->all() ?? null;

        $validator = Validator::make($postdata, [
            'title' => 'required|min:3',
            // 'photo_description' => 'required',
            // 'photo_keyword' => 'required',
            // 'photo_subtitle' => 'required',
            // // 'published_by' => 'required',
            // 'published_date' => 'required',
            // 'match_format' => 'required',
            // 'photo_status' => 'required',
            // 'photo_current_status' => 'required',
            // 'photo_platform' => 'required',
            // 'comments_on' => 'required',
            // 'copyright' => 'required',
            'language' => 'required',
            // // 'image_file' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            // $route = 'contentList/images';
            $route = 'photos';
            $method = 'POST';
            $url = config('bcciconfig.CURD_API_URL') . 'images/' . $photo_id;
            $token = APIHandlers::get_token();
            $headers = [
                'Cache-Control: no-cache',
                'Content-Type: multipart/form-data',
                'Authorization: Bearer ' . $token,
            ];

            // New Logic for Content and  reference
            // Edit value of
            $tags = $request->tags ?? null;
            if ($tags != null) {

                $t = [];
                foreach ($tags as $key => $v) {
                    $t[$key]['id'] = $key;
                    $t[$key]['label'] = $v;
                }
                $tags = json_encode($t);
            } else {
                $tags = null;
            }
            // Relete refernce
            if (isset($request->ref) && isset($postdata['type_reference'])) {

                $ref = $request->ref;

                $arr = [];
                foreach ($ref as $key => $value) {

                    $ids = explode("</h2>", $value);
                    $tit = strip_tags($ids[0]);
                    $articleid = explode("ID:", $ids[1]);
                    $articleid = strip_tags($articleid[1]);
                    $arr[$key]['id'] = $articleid;
                    $arr[$key]['title'] = $tit;
                    $arr[$key]['type'] = $postdata['type_reference'];
                }

                if (isset($request->refeedit)) {

                    $ref = json_encode(array_merge(json_decode($request->refeedit, true), $arr));

                    // New code for remove click from 
                    $removeids = explode(",", $request->removerefeedit1);
                    $arr = [];
                    foreach (json_decode($ref) as $key => $value) {
                        if (!in_array($value->id, $removeids)) {
                            $arr[$key]['id'] = $value->id;
                            $arr[$key]['title'] = $value->title;
                            $arr[$key]['type'] = $value->type;
                        }
                    }
                    $ref =  json_encode(array_values($arr)) ?? null;
                    // End New code for remove click from

                    // Both are submit

                } else {
                    // New submit data
                    $ref =  json_encode($arr) ?? null;
                }
            } else {
                if (isset($request->refeedit)) {
                    // only edit data submit
                    $ref = $request->refeedit;

                    // New code for remove click from 

                    $removeids = explode(",", $request->removerefeedit1);

                    $arr = [];
                    foreach (json_decode($ref) as $key => $value) {
                        if (!in_array($value->id, $removeids)) {
                            $arr[$key]['id'] = $value->id;
                            $arr[$key]['title'] = $value->title;
                            $arr[$key]['type'] = $value->type;
                        }
                    }
                    $ref =  json_encode(array_values($arr)) ?? null;

                    // End New code for remove click from
                } else {
                    // nothing send
                    $ref = null;
                }
            }

            // End Relete reference
            // Start Content Refrence 
            if (isset($request->content) && isset($postdata['type_content'])) {
                $arr = [];
                $cont = $request->content;
                foreach ($cont as $key => $value) {
                    $ids = explode("</h2>", $value);
                    $tit = strip_tags($ids[0]);
                    $articleid = explode("ID:", $ids[1]);
                    $articleid = strip_tags($articleid[1]);
                    $arr[$key]['id'] = $articleid;
                    $arr[$key]['title'] = $tit;
                    $arr[$key]['type'] = $postdata['type_content'];
                }
                if (isset($request->contedit)) {

                    $cont = json_encode(array_merge(json_decode($request->contedit, true), $arr));
                    // New code for remove click from 
                    $removeids = explode(",", $request->removeconteedit);
                    $arr = [];
                    foreach (json_decode($cont) as $key => $value) {
                        if (!in_array($value->id, $removeids)) {
                            $arr[$key]['id'] = $value->id;
                            $arr[$key]['title'] = $value->title;
                            $arr[$key]['type'] = $value->type;
                        }
                    }
                    $ref =  json_encode(array_values($arr)) ?? null;
                    // End New code for remove click from
                    // Both are submit

                } else {
                    // New submit data
                    $cont =  json_encode($arr) ?? null;
                }
            } else {

                if (isset($request->contedit)) {
                    // only edit data submit
                    $cont = $request->contedit;
                    // New code for remove click from 

                    $removeids = explode(",", $request->removeconteedit);

                    $arr = [];
                    foreach (json_decode($cont) as $key => $value) {
                        if (!in_array($value->id, $removeids)) {
                            $arr[$key]['id'] = $value->id;
                            $arr[$key]['title'] = $value->title;
                            $arr[$key]['type'] = $value->type;
                        }
                    }
                    $cont =  json_encode(array_values($arr)) ?? null;

                    // End New code for remove click from
                } else {
                    // nothing send
                    $cont = null;
                }
            }
           // platform 
            $platform = $request->platform??null;
            if( $platform!=null)
            {
                $t =[];
                foreach ($platform as  $v) {
                    $t[]= $v;   
                }
                $platform = json_encode($t);
            }
            else
            {
                $platform = null;
            }
            // country 
            $country = $request->country ?? null;
            if( $country!=null)
            {
                $t =[];
                foreach ($country as  $v) {
                    $t[]= $v;   
                }
                $country = json_encode($t);
            }
            else
            {
                $country = null;
            }
            // end

            $postfields = [
                'title' => $postdata['title'] ?? null,
                'description' => $postdata['photo_description'] ?? null,
                'keywords' => $postdata['photo_keyword'] ?? null,
                'additionalInfo' => $postdata['photo_additional_info'] ?? '',
                'subtitle' => $postdata['photo_subtitle'] ?? null,
                'match_formats' => $postdata['match_format'] ?? null,
                'published_by' => $postdata['published_by'] ?? null,
                //'publish_date' => $postdata['published_date'] ?? null,
                'related' => $cont ?? null,
                'references' => $ref ?? null,
                'tags' => $tags,
                'coordinates' => $postdata['co_ordinates'] ?? '',
                'metadata' => $postdata['photo_meta_data'] ?? null,
                'status' => $postdata['photo_status'] ?? null,
                'currentstatus' => $postdata['photo_current_status'] ?? null,
                'platform' => $platform,
                'location' => $postdata['photolocationsearch'] ?? null,
                'commentsOn' => $postdata['comments_on'] ?? null,
                'copyright' => $postdata['copyright'] ?? null,
                'language' => $postdata['language'] ?? null,
                'url_segment' => $postdata['titleUrlSegment'] ?? null,
                'image_id' => $postdata['photo_id'] ?? null,
                'publish_date' => $request->publish_date . ' ' . $request->publish_time ?? null,
                'expiryDate' => $request->expiryDate . ' ' . $request->expiryTime ?? null,
                'geo_blocking' => $country ?? null,
               'latitude' => $postdata['latitudephoto'] ?? null,
                'longitude' => $postdata['longitudephoto'] ?? null,
            ];

            if ($request->file('img') != "") {
                $postfields['image_url'] = curl_file_create($request->file('img'), $request->file('img')->getMimeType(), $request->file('img')->getClientOriginalName());
            }

            $response = APIHandlers::get_api_response($method, $url, $headers, $postfields);
            $response_data = json_decode($response, true);


            if (!empty($response_data) && $response_data['status']['code'] == '200') {
                Session::flash('success', 'photos has been updated successfully!');
                return response()->json([
                    'data'             => $response_data,
                    'status'           => true,
                    'status_code'      =>  200,
                    'message'          => 'data get successfully',
                    'redirectUrl'      => $route,
                ], 200);
            } else {
                return response()->json([
                    'status'           => false,
                    'status_code'      =>  400,
                    'message'          => 'data not avaliable',
                ], 200);
            }
        }
    }

    public function updateUrlSegment(Request $request)
    {

        $postdata = $request->all();

        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'images/update';
        $token = APIHandlers::get_token();
        $headers = [
            'Cache-Control: no-cache',
            'Content-Type: multipart/form-data',
            'Authorization: Bearer ' . $token,
        ];

        $postfields = [
            'title' => $postdata['photo_title'] ?? null,
            'description' => $postdata['photo_description'] ?? null,
            'keywords' => $postdata['photo_keyword'] ?? null,
            'additionalInfo' => $postdata['photo_additional_info'] ?? '',
            'subtitle' => $postdata['photo_subtitle'] ?? null,
            'match_formats' => $postdata['match_format'] ?? null,
            'published_by' => $postdata['published_by'] ?? null,
            'publish_date' => $postdata['published_date'] ?? null,
            'related' => $postdata['related'] ?? '',
            'references' => $postdata['reference'] ?? '',
            'coordinates' => $postdata['co_ordinates'] ?? '',
            'metadata' => $postdata['photo_meta_data'] ?? '',
            'status' => $postdata['photo_status'] ?? null,
            'currentstatus' => $postdata['photo_current_status'] ?? null,
            'platform' => $postdata['photo_platform'] ?? null,
            'commentsOn' => $postdata['comments_on'] ?? null,
            'copyright' => $postdata['copyright'] ?? null,
            'language' => $postdata['language'] ?? null,
            'url_segment' => str_replace(' ', '-', $postdata['url_segment']) ?? null,
            'image_id' => $postdata['photo_id'] ?? null
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers, $postfields);
        $response_data = json_decode($response, true);

        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return $response_data;
            } else {
                return $response_data;
            }
        } else {
            return $response_data;
        }
    }

    // common search methods

    public function phreferencesearch(Request $request)
    {

        $postdata = $request->type;
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'search';
        $token = APIHandlers::get_token();
        $headers = [
            'Authorization: Bearer ' . $token,
            'Accept:application/json',
            'Content-Type: application/json'
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers, json_encode($postdata));

        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            return $response_data['payload'];
        } else {
            return $response_data['payload'];
        }
    }


    public function fetchphoto(Request $request)
    {
        // echo "asdfasdf";exit;
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'images/' . $request->id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);

        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return  response()->json(array('data' => $response_data['payload']));
            } else {
                return redirect('photos')->with('error', $response_data['status']['message']);
            }
        } else {
            info('Photo Edit : ' . $response_data['message']);
            return redirect('photos')->with('error', $response_data['message']);
        }
    }

    public function photoSearchlist(Request $request)
    {
        // echo "asdfasdf";exit;
        // $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'images/list';
        $token = APIHandlers::get_token();
        $headers = [
            'Authorization: Bearer ' . $token,
            'Accept:application/json',
            'Content-Type: application/json'
        ];

        $postdata = [];
        $postdata['max_items'] = (int)$request->input('max_items') ?? 24;
        $postdata['sort_by'] = $request->input('sort_by') ?? 'Last updated';
        $postdata['order'] = $request->input('order') ?? 'desc';
        $postdata['content_from'] = $request->input('content_from') ?? 'All time';
        $postdata['page_number'] = $request->input('go_to') ?? 1;

        if (!(empty($request->input('search_field')))) {
            $postdata['title'] = $request->input('search_field');
        }
        if (!(empty($request->input('language')))) {
            // dd($request->input('language'));
            $postdata['language'] = $request->input('language');
        }
        if (!(empty($request->input('current_status')))) {
            $postdata['current_status'] = $request->input('current_status');
        }

        // echo "<pre>";print_r($postdata);exit;

        $response = APIHandlers::get_api_response($method, $url, $headers, json_encode($postdata));
        $response_data = json_decode($response, true);
        //dd($response_data);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $image = $response_data['payload']['data'];
        } else {
            $image = [];
        }
        // dd($image);
        // return view('image.photos', ["photolist" => $data]);
        return response()->json([
            'html' => view('image.phototable', ['images' => $image,])->render(),
            'status' => false,
        ]);
    }
    public function photogridSearch(Request $request)
    {
        // echo "asdfsaf";exit;
        $token = APIHandlers::get_token();
        $method = 'POST';
        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token
        ];
        $post_fields = array(
            'search_title' => $request->input('serarch_value')
        );

        $url = config('bcciconfig.CURD_API_URL') . 'images/search';
        $response = APIHandlers::get_api_response($method, $url, $headers, $post_fields, true);
        $response_data = json_decode($response, true);
        // echo "<pre>";print_r($response_data);exit;
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $image = $response_data['payload'];
            return response()->json([
                'html' => view('image.photogrid', ['imagesgird' => $image,])->render(),
                'status' => true,
            ]);
        } else {
            $image = [];
            return response()->json([
                'html' => view('image.photogrid', ['imagesgird' => $image,])->render(),
                'status' => false,
            ]);
        }
    }

    public function imagestagList(Request $request)
    {

        $postdata = $request->tag;

        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'tags/list';
        $token = APIHandlers::get_token();
        $headers = [
            'Authorization: Bearer ' . $token,
            'Accept:application/json',
            'Content-Type: application/json'
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers, json_encode($postdata));
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            return $response_data['payload'];
        } else {
            return $response_data['payload'];
        }
    }
}
