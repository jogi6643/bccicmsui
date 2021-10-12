<?php

namespace App\Http\Controllers;

use App\Http\APIHandlers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function addNewVideo(Request $request)
    {
        $postdata = $request->all() ?? null;        
        if(isset($request->ref))
        {
            
            $ref = $request->ref;
           
            $arr =[];
           foreach ($ref as $key => $value) {
            
                $ids = explode("</h2>",$value);
                $tit = strip_tags($ids[0]);
                $articleid = explode("ID:",$ids[1]);
                $articleid = strip_tags($articleid[1]); 
                $arr[$key]['id'] = $articleid;  
                $arr[$key]['title'] = $tit;  
                $arr[$key]['type'] = $postdata['type_reference'];
               
           }
            $ref =  json_encode($arr)??null;
        }
        else
        {
            $ref = null;
        }
        // End Relete reference
        
        // Start Content Refrence 
        if(isset($request->content))
        {
            $arr =[];
            $cont = $request->content;
            foreach ($cont as $key => $value) {
                $ids = explode("</h2>",$value);
                $tit = strip_tags($ids[0]);
                $articleid = explode("ID:",$ids[1]);
                $articleid = strip_tags($articleid[1]); 
                $arr[$key]['id'] = $articleid;  
                $arr[$key]['title'] = $tit;  
                $arr[$key]['type'] = $postdata['type_content'];  
            }
            $cont=  json_encode($arr)??null;
        }
        else
        {
            $cont = null;
        }
        // End Content References
        $tags = $request->tags_promos??null;
        if( $tags!=null)
        {

            $t =[];
            foreach ($tags as $key => $v) {
                $t[$key]['id'] = $key;  
                $t[$key]['label'] = $v;   
            }
            $tags = json_encode($t);
        }
        else
        {
            $tags = null;
        }
         
        // Platform 
        $platform = $request->platform ?? null;
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
        // end
        $validator = Validator::make($postdata, [
            'title' => 'required',
            'short_description' => 'required|max:520',
            'description' => 'required',
        ]);
      
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $url = config('bcciconfig.CURD_API_URL') . 'addVideo';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token
            ];

            if (!empty($postdata['videofile'])) {
                $videourl = curl_file_create($request->file('videofile'), $request->file('videofile')->getMimeType(), $request->file('videofile')->getClientOriginalName());
            } else {
                $videourl = $postdata['video_url'];
            }
           
            $postfields = [
                'title' => $postdata['title'] ?? null,
                'short_description' => $postdata['short_description'] ?? null,
                'description' => $postdata['description'] ?? null,
                'duration' => $postdata['duration'] ?? null,
                'content_type' => $postdata['content_type'] ?? null,
                'video_url' => $videourl ?? null,
                'keywords' => $postdata['keywords'] ? trim($postdata['keywords'], '"') : null,
                'language' => $postdata['language'] ?? null,
                'location' => $postdata['videolocationsearch'] ?? null,
                'latitude' => $postdata['latitudevideo'] ?? null,
                'longitude' => $postdata['longitudevideo'] ?? null,
                'asset_type' => $postdata['type'] ?? null,
                'publishTo' => $postdata['expiry_date'] ?? null,
                'titleUrlSegment' => $postdata['titleUrlSegment'] ?? null,
                'platform' => $platform ?? null,
                'current_status' => $postdata['current_status'] ?? null,
                'imageUrl' => curl_file_create($request->file('thumbnail_image'), $request->file('thumbnail_image')->getMimeType(), $request->file('thumbnail_image')->getClientOriginalName()),
                'references' => $ref ?? null,
                'related' =>  $cont ?? null,
                'tags' => $tags ?? null,
                'geo_blocking' => $country ?? null,
                'publish_date' =>$request->publish_date . ' ' . $request->publish_time ?? null,
                'expiryDate' =>$request->expiryDate . ' ' . $request->expiryTime ?? null,
            ];
            $response = APIHandlers::get_api_response('POST', $url, $headers, $postfields);
            $response_data = json_decode($response, true);
            if (!empty($response_data['status']['code'])) {
                if ($response_data['status']['code'] == '200') {
                    return redirect('getVideoList')->with('success', $response_data['status']['message']);
                } else {
                    return redirect('uploadcontent')->with('error', $response_data['status']['message']);
                }
            } else {
                return redirect('uploadcontent')->with('error', $response_data['message']);
            }
        }
    }

    public function getVideoList(Request $request, $id = 1)
    {
        $page = !empty($request->page) ? $request->page  : $id;
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'listVideo?page=' . $page;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $language = language();
        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['videoslist'] = $response_data['payload']['data'];
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
        //dd($data);
        return view('content.videolist', [
            'videoslist' => $data,
            'lang' => $language
        ]);
    }


    public function videosdata(Request $request, $id = 1)
    {
        $page = !empty($request->page) ? $request->page  : $id;
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'listVideo?page=' . $page;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['videoslist'] = $response_data['payload']['data'];
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
        // dd(  $response_data );
        return view('content.videosdata', [
            'videoslist' => $data,
        ]);
    }

    public function getVideoById($video_id)
    {

        $url = config('bcciconfig.CURD_API_URL') . $video_id . '/viewVideoById';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $postfields = [];
        $status   = status();
        $language = language();
        $response = APIHandlers::get_api_response('GET', $url, $headers);
        $response_data = json_decode($response, true);
        $publishtimestamp = $response_data['payload']['publishFrom'];
        $splitTimeStamp = explode(" ",$publishtimestamp);
        $publishdate = $splitTimeStamp[0]?? '';
        $publishtime = $splitTimeStamp[1] ?? '';

        $expiretimestamp = $response_data['payload']['publishTo'];
        $splitTimeStamp = explode(" ",$expiretimestamp);
        $expiredate = $splitTimeStamp[0]?? '';
        $expiretime = $splitTimeStamp[1] ?? '';
        //dd($response_data['payload']);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') 
        {
            $video = $response_data['payload'];
        } else {
            $video = [];
        }
        return view('content.edit-video', [
            'edit_data' => $video,'status'=>$status,'language' => $language, 'status'=>$status,
            'publishdate'=>$publishdate,
            'publishtime'=>$publishtime, 'expiredate'=>$expiredate,'expiretime'=>$expiretime
        ]);
    }
    public function fetchVideo(Request $request)
    {
        $url = config('bcciconfig.CURD_API_URL') . $request->id . '/viewVideoById';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $postfields = [];

        $response = APIHandlers::get_api_response('GET', $url, $headers);
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return  response()->json(array('data' => $response_data['payload']));
            } else {
                return redirect('getVideoList')->with('error', $response_data['status']['message']);
            }
        } else {
            info('Article Edit : ' . $response_data['message']);
            return redirect('getVideoList')->with('error', $response_data['message']);
        }
    }
    public function updateVideo(Request $request)
    {
        $postdata = $request->all() ?? null;
        
         // Edit value of
         $tags = $request->tags??null;
         if( $tags!=null)
         {
 
             $t =[];
             foreach ($tags as $key => $v) {
                 $t[$key]['id'] = $key;  
                 $t[$key]['label'] = $v;   
             }
             $tags = json_encode($t);
         }
         else
         {
             $tags = null;
         }
           // Relete refernce
           if(isset($request->ref) && isset($postdata['type_reference']))
           {
               
               $ref = $request->ref;
              
               $arr =[];
              foreach ($ref as $key => $value) {
               
                   $ids = explode("</h2>",$value);
                   $tit = strip_tags($ids[0]);
                   $articleid = explode("ID:",$ids[1]);
                   $articleid = strip_tags($articleid[1]); 
                   $arr[$key]['id'] = $articleid;  
                   $arr[$key]['title'] = $tit;  
                   $arr[$key]['type'] = $postdata['type_reference'];
                  
              }
               
               if(isset($request->refeedit))
               {
 
                 $ref = json_encode(array_merge(json_decode($request->refeedit, true),$arr));
              
                   // New code for remove click from 
                 $removeids = explode(",",$request->removerefeedit1);
                 $arr =[];
                 foreach (json_decode($ref) as $key => $value) {
                     if(!in_array($value->id,$removeids))
                     {
                         $arr[$key]['id'] = $value->id;  
                         $arr[$key]['title'] = $value->title;  
                         $arr[$key]['type'] = $value->type;
                     }
                   
                 }
                 $ref =  json_encode(array_values($arr))??null;
                 // End New code for remove click from
                   
                   // Both are submit
                 
               }
               else
               {
                   // New submit data
                 $ref =  json_encode($arr)??null;
                 
               }
              
           }
           else
           {
             if(isset($request->refeedit))
             {
                 // only edit data submit
                 $ref = $request->refeedit;
                 
                 // New code for remove click from 
             
                 $removeids = explode(",",$request->removerefeedit1);
            
                 $arr =[];
                 foreach (json_decode($ref) as $key => $value) {
                     if(!in_array($value->id,$removeids))
                     {
                         $arr[$key]['id'] = $value->id;  
                         $arr[$key]['title'] = $value->title;  
                         $arr[$key]['type'] = $value->type;
                     }
                   
                 }
                 $ref =  json_encode(array_values($arr))??null;
             
                 // End New code for remove click from
             }
             else
             {
                 // nothing send
                 $ref = null;
             }
             
           }
       
           // End Relete reference
           // Start Content Refrence 
           if(isset($request->content) && isset($postdata['type_content']))
           {
               $arr =[];
               $cont = $request->content;
               foreach ($cont as $key => $value) {
                   $ids = explode("</h2>",$value);
                   $tit = strip_tags($ids[0]);
                   $articleid = explode("ID:",$ids[1]);
                   $articleid = strip_tags($articleid[1]); 
                   $arr[$key]['id'] = $articleid;  
                   $arr[$key]['title'] = $tit;  
                   $arr[$key]['type'] = $postdata['type_content'];  
               }
               if(isset($request->contedit))
               {
                 
                   $cont = json_encode(array_merge(json_decode($request->contedit, true),$arr));
                        // New code for remove click from 
                 $removeids = explode(",",$request->removeconteedit);
                 $arr =[];
                 foreach (json_decode($cont) as $key => $value) {
                     if(!in_array($value->id,$removeids))
                     {
                         $arr[$key]['id'] = $value->id;  
                         $arr[$key]['title'] = $value->title;  
                         $arr[$key]['type'] = $value->type;
                     }
                   
                 }
                 $ref =  json_encode(array_values($arr))??null;
                 // End New code for remove click from
                   // Both are submit
                 
               }
               else
               {
                   // New submit data
                   $cont=  json_encode($arr)??null;
 
 
                 
               }
              
           }
           else
           {
            
               if(isset($request->contedit))
               {
                   // only edit data submit
                   $cont = $request->contedit;
                   // New code for remove click from 
             
                 $removeids = explode(",",$request->removeconteedit);
            
                 $arr =[];
                 foreach (json_decode( $cont) as $key => $value) {
                     if(!in_array($value->id,$removeids))
                     {
                         $arr[$key]['id'] = $value->id;  
                         $arr[$key]['title'] = $value->title;  
                         $arr[$key]['type'] = $value->type;
                     }
                   
                 }
                 $cont =  json_encode(array_values($arr))??null;
             
                 // End New code for remove click from
               }
               else
               {
                   // nothing send
                   $cont = null;
               }
           }
                // Platform 
        $platform = $request->platform ?? null;
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
        $validator = Validator::make($postdata, [
            'title' => 'required',
            'short_description' => 'required|max:520',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $id = $postdata['ID'];
            $url = config('bcciconfig.CURD_API_URL') . $postdata['ID'] . '/updateVideo';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token
            ];
            if (!empty($postdata['videofile'])) {
                $videourl = curl_file_create($request->file('videofile'), $request->file('videofile')->getMimeType(), $request->file('videofile')->getClientOriginalName());
            } else {
                $videourl = $postdata['video_url'];
            }
            //print_r(trim($postdata['keywords'],'"'));exit; // double quotes);exit;
            $postfields = [
                'title' => $postdata['title'] ?? null,
                'short_description' => $postdata['short_description'] ?? null,
                'description' => $postdata['description'] ?? null,
                'duration' => $postdata['duration'] ?? null,
                'video_scope' => $postdata['video_scope'] ?? null,
                'video_url' => $videourl ?? null,
                'keywords' => trim($postdata['keywords'], '"') ?? null,
                'language' => $postdata['language'] ?? null,
                'location' => $postdata['videolocationsearch'] ?? null,
                'latitude' => $postdata['latitudevideo'] ?? null,
                'longitude' => $postdata['longitudevideo'] ?? null,
                'asset_type' => $postdata['asset_type'] ?? null,
                'publishTo' => date('Y-m-d H:i:s', strtotime($postdata['expiryDate'])) ?? null,
                'titleUrlSegment' => $postdata['titleUrlSegment'] ?? null,
                'current_status' => $postdata['current_status'] ?? null,
                'references' => $ref ?? null,
                'related' =>  $cont ?? null,
                'tags' => $tags ?? null,
                'platform' => $platform ?? null,
                'geo_blocking' => $country ?? null,
                'publish_date' =>$request->publish_date . ' ' . $request->publish_time ?? null,
                'expiryDate' =>$request->expiryDate . ' ' . $request->expiryTime ?? null,
            ];

            if ($request->file('thumbnail_image') != "") {
                $postfields['imageUrl'] = curl_file_create($request->file('thumbnail_image'), $request->file('thumbnail_image')->getMimeType(), $request->file('thumbnail_image')->getClientOriginalName());
            }

            $response = APIHandlers::get_api_response('POST', $url, $headers, $postfields);
            $response_data = json_decode($response, true);
            // dd($response_data);

            if (!empty($response_data['status']['code'])) {
                if ($response_data['status']['code'] == '200') {
                    return redirect('getVideoList')->with('success', $response_data['status']['message']);
                } else {
                    return redirect('edit-video')->with('error', $response_data['status']['message']);
                }
            } else {
                return redirect('edit-video')->with('error', $response_data['message']);
            }
        }
    }

    public function deleteVideo(Request $request)
    {

        $token = APIHandlers::get_token();
        $id = $request->input('single_video_id');
        $videoview = $request->input('videoview');
        $url = config('bcciconfig.CURD_API_URL') . $id . "/deleteVideo";
        $method = "DELETE";

        $headers = [
            'Cache-Control: no-cache',
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token,
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);

        $response_data = json_decode($response, true);


        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return redirect('getVideoList/' . $videoview)->with('success', $response_data['status']['message']);
            } else {
                return redirect('getVideoList/' . $videoview)->with('error', $response_data['status']['message']);
            }
        } else {
            return redirect('getVideoList/' . $videoview)->with('error', $response_data['message']);
        }
    }

    public function deleteVget()
    {
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $token = APIHandlers::get_token();
        $id = $uriSegments[2];
        $url = config('bcciconfig.CURD_API_URL') . $id . "/deleteVideo";
        $method = "DELETE";
        $headers = [
            'Cache-Control: no-cache',
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token,
        ];
        $response = APIHandlers::get_api_response($method, $url, $headers);
        $json_array = json_decode($response, true);
        if ($json_array['status']['code'] == '200' && !(empty($json_array['status']['code']))) {
            return redirect('videosdata')->with('success', $json_array['status']['message']);
        } else {
            return redirect('videosdata')->with('error', $json_array['status']['message']);
        }
    }

    public function searchByTitle(Request $request)
    {

        $search_term = $request->search ?? null;

        $page = !empty($request->page) ? $request->page : 1;
        $view = !empty($request->view) ? $request->view : '';
        if ($search_term == null) {
            return redirect($view);
        }
        $url = config('bcciconfig.CURD_API_URL') . $search_term . '/searchByTitle?page=' . $page;
        $postdata['type'] = 'videos';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $response = APIHandlers::get_api_response('GET', $url, $headers);
        $response_data = json_decode($response, true);

        // dd($response_data);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['videoslist'] = $response_data['payload']['data'];
            $data['link'] = array_slice($response_data['payload']['links'], 1, -1);
            $data['current_page'] = $response_data['payload']['current_page'];
            $data['last_page'] = $response_data['payload']['last_page'];
            $data['from'] = $response_data['payload']['from'];
            $data['to'] = $response_data['payload']['to'];
            $data['total'] = $response_data['payload']['total'];
            $data['type'] = 'search';
        } else {
            $data = [];
        }

        if ($view == 'videosdata') {
            return view('content.videosdata', [
                'videoslist' => $data,
            ]);
        } else {
            return view('content.videolist', [
                'videoslist' => $data,
            ]);
        }
    }

    public function searchByLanguageAndStatus(Request $request)
    {
        $postdata = $request->all() ?? null;
        $url = "";
        if (!empty($postdata['language'])) {

            $url = config('bcciconfig.CURD_API_URL') . $postdata['language'] . '/filterByLanguage';
        } else if (!empty($postdata['status'])) {

            $url = config('bcciconfig.CURD_API_URL') . $postdata['status'] . '/filterByStatus';
        }




        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response('GET', $url, $headers);
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $videolist = $response_data['payload'];
        } else {
            $videolist = [];
        }

        return view('content.videolist', [
            'videoslist' => $videolist,
        ]);
    }
    public function searchByStatus(Request $request)
    {
        $postdata = $request->all() ?? null;
        $url = config('bcciconfig.CURD_API_URL') . $postdata . 'listVideo';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response('GET', $url, $headers);
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $videolist = $response_data['payload'];
        } else {
            $videolist = [];
        }
        return view('content.videolist', [
            'videoslist' => $videolist,
        ]);
    }

    public function deleteBulkVideo(Request $request)
    {
        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'bulkDeleteVideo';
        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token
        ];
        // $id_array = explode(',', $request->input('video_id'));
        // $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['video_ids' => $id_array]));
        // $response_data = json_decode($response, true);
        $videoview = $request->input('videoview');
        $id_array = explode(',', $request->input('video_id'));
        // $returnValue = json_encode($request->input('video_id'));
        $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['video_ids' => $id_array]));
        // $response = APIHandlers::get_api_response($method, $url, $headers, ['video_ids' => $id_array], true);
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return redirect('getVideoList' . $videoview)->with('success', $response_data['status']['message']);
            } else {
                return redirect('getVideoList' . $videoview)->with('error', $response_data['status']['message']);
            }
        } else {
            return redirect('getVideoList' . $videoview)->with('error', $response_data['message']);
        }
    }


    function filter(Request $request)
    {
        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'videos/list';
        $headers = [
            // 'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        $tags = !empty($request->tags) ? explode(",", $request->tags) : '';
        $lang = !empty($request->lang) ? explode(",",  $request->lang) : '';
        $current_status = !empty($request->current_status) ? explode(",", $request->current_status) : '';

        $postData = [
            "page_number"  => $request->page ?? 1,
            "per_page_count" => $request->max_items,
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
        $json = json_encode($postData);
        $response = APIHandlers::get_api_response($method, $url, $headers, $json);
        $response_data = json_decode($response, true);
        // dd($response_data);
        if (!empty($response_data) && $response_data['status']['code'] == '200') {
            return response()->json([
                'listhtml' => view('content.videoTable', ['video' => $response_data, 'status' => true])->render(),
                'gridehtml' => view('content.videoGride', ['video' => $response_data, 'status' => true])->render(),
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


    public function referanceRelated(Request $request)
    {
        $dropdown = $request->dropdown;
        $postdata['type'] = $request->type;
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
            return $response_data;
        }
    }

    public function commonStatusLang(Request $request)
    {
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'languages';
        $token = APIHandlers::get_token();
        $headers = [
            'Authorization: Bearer ' . $token,
            'Accept:application/json',
            'Content-Type: application/json'
        ];
        $languages = APIHandlers::get_api_response($method, $url, $headers);
        $languages_data = json_decode($languages, true);

        $statusurl = config('bcciconfig.CURD_API_URL') . 'status';
        $statusheaders = [
            'Authorization: Bearer ' . $token,
            'Accept:application/json',
            'Content-Type: application/json'
        ];
        $status = APIHandlers::get_api_response($method, $statusurl, $statusheaders);
        $status_data = json_decode($status, true);

        if (!empty($status_data) && !empty($languages_data) && $status_data['status']['code'] == '200' && $languages_data['status']['code'] == '200') {
            return response()->json([
                'lang_data'        =>  $languages_data,
                'status_data'      =>  $status_data,
                'status'           =>  true,
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
}
