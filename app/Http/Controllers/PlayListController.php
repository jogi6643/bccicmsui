<?php

namespace App\Http\Controllers;

use App\Http\APIHandlers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlayListController extends Controller{
    //

    public function __construct(){
    }

    /**
     * view playlist listing page.
     *
     * @param array $request and $id
     * @return \Illuminate\View\View
     */
    public function getplaylists(Request $request, $id = 1){
        $language = language();
        $page = !empty($request->page) ? $request->page  : $id;
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . "playlists?page=" . $id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
      
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
        return view('playlist.playlistlist', [
            'playlist' => $data,
            'lang'=>$language
        ]);
        // $method = 'GET';
        // $url = config('bcciconfig.CURD_API_URL') . 'playlists?page='.$id;
        // $token = APIHandlers::get_token();
        // $headers = [
        //     'Accept:application/json',
        //     'Authorization: Bearer ' . $token
        // ];

        // $response = APIHandlers::get_api_response($method, $url, $headers);
        // $response_data = json_decode($response, true);
        // if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
        //     $data['videoslist'] = $response_data['payload']['data'];
        //     $data['link'] = $response_data['payload']['links'];
        // } else {
        //     $data = [];
        // }
        // return view('content.showpalylist', [
        //     'videoslist' => $data,
        // ]);

        // $method = 'GET';
        // $url = config('bcciconfig.CURD_API_URL') . 'playlists?page='.$id;
        // $token = APIHandlers::get_token();
        // $headers = [
        //     'Accept:application/json',
        //     'Authorization: Bearer ' . $token
        // ];

        // $response = APIHandlers::get_api_response($method, $url, $headers);
        // $response_data = json_decode($response, true);
        // if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
        //     $data['videoslist'] = $response_data['payload']['data'];
        //     $data['link'] = $response_data['payload']['links'];
        // } else {
        //     $data = [];
        // }
        // // return view('content.videolist', [
        // //     'videoslist' => $data,
        // // ]);
        // return view('content.showpalylist', ["playlist" => $data]);

        // // return view('playlist.playlist', ["playlist" => $data]);
    }

    public function addplaylist(Request $request){
        $validation = Validator::make(
            $request->all(), [
            'photo' => 'image|mimes:jpeg,bmp,png,jpg',
        ],
        );
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        $route = 'playlist';
        $route = 'playlists';
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'playlists';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

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

        // New Logic for Content and  reference
        if(isset($request->playlist_reference))
        {
            
            $ref = $request->playlist_reference;
           
            $arr =[];
           foreach ($ref as $key => $value) {
            
                $ids = explode("</h2>",$value);
                $tit = strip_tags($ids[0]);
                $articleid = explode("ID:",$ids[1]);
                $articleid = strip_tags($articleid[1]); 
                $arr[$key]['id'] = $articleid;  
                $arr[$key]['title'] = $tit;  
                $arr[$key]['type'] = $request->playlistId;
               
           }
            $ref =  json_encode($arr)??null;
        }
        else
        {
            $ref = null;
        }
        // End Relete reference
        
        // Start Content Refrence 
        if(isset($request->playlistrelatedcontent))
        {
            $arr =[];
            $cont = $request->playlistrelatedcontent;
            foreach ($cont as $key => $value) {
                $ids = explode("</h2>",$value);
                $tit = strip_tags($ids[0]);
                $articleid = explode("ID:",$ids[1]);
                $articleid = strip_tags($articleid[1]); 
                $arr[$key]['id'] = $articleid;  
                $arr[$key]['title'] = $tit;  
                $arr[$key]['type'] = $request->playlistId;  
            }
            $cont=  json_encode($arr)??null;
        }
        else
        {
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
        $postfields = ['title' => $request->input("title"),
                'url_segment' => $request->input("titleUrlSegment"),
                'subtitle' => $request->input("subtitle"),
                'summary' => $request->input("summary"),
                'slug' => $request->input("slug"),
                'cover' => ($request->file('coverphoto')) ? curl_file_create($request->file('coverphoto'), $request->file('coverphoto')->getMimeType(), $request->file('coverphoto')->getClientOriginalName()) : null,
                'display_date' => $request->input("date"),
                'location' => $request->input("playlistlocationsearch"),
                'latitude' => $request->input("latitudeplaylist"),
                'longitude' => $request->input("longitudeplaylist"),
                'status' => $request->input("status"),
                'created_date' => $request->input("created_date"),
                'platform' => $platform,
                'updated_date' => $request->input("updated_date"),
                'language' => $request->input("language"),
                'headline' => $request->input("headline"),
                'tags' =>  $tags,
                'references' => $ref,
                'related' => $cont,
                'expiryDate' => $request->input("expiryDate"),
                'playlist_type' => $request->input("playlist_type"),
                'content_type' => $request->input("content_type"),
                'current_status' => $request->input("current_status"),
                'publish_date' =>$request->publish_date . ' ' . $request->publish_time ?? null,
                'expiryDate' =>$request->expiryDate . ' ' . $request->expiryTime ?? null,
                'geo_blocking' => $country ?? null,
                'keywords' =>   $request->input("keywords"),
            ];
            //dd($postfields);
            try {
                $response = APIHandlers::get_api_response($method, $url, $headers, $postfields);
                $response_data = json_decode($response, true);
                // echo "<pre>";print_r($response);exit;
                if (!empty($response_data['status']['code'])) {
                    if ($response_data['status']['code'] == '200') {
                        return redirect($route)->with('success', $response_data['status']['message']);
                    } else {
                        return redirect($route)->with('error', $response_data['status']['message']);
                    }
                } else {
                    info('Article Add : ' . $response_data['message']);
                    return redirect($route)->with('error', $response_data['message']);
                }
            } catch (Exception $exception) {
                return redirect($route)->with('error', "API Error : " . $exception->getMessage());
            }
            // echo "<pre>";
            // print_r($postfields);exit;
    }

    function playlistfilter(Request $request)
    {
        // echo "safdsdafsdaf";exit;
       
        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'playlists/list';
        $headers = [
            // 'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'Accept: application/json' ,
        ];
        // $tags = !empty($request->tags) ? explode(",", $request->tags) : '';
        $lang = !empty($request->lang) ? explode(",",  $request->lang) : '';
        $current_status = !empty($request->current_status) ? explode(",", $request->current_status) : '';
        // dd($request->page);
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
        // echo "<pre>";print_r($postData);
        $response = APIHandlers::get_api_response($method, $url, $headers, $json);
        // echo "<pre>";print_r($response);exit;
        $response_data = json_decode($response, true);
        // echo "<pre>";print_r($response_data);exit;
        if (!empty($response_data) && $response_data['status']['code'] == '200') {
            return response()->json([
                'listhtml' => view('playlist.playlistTable', ['playlist' => $response_data, 'status' => true])->render(),
                'gridehtml' => view('playlist.playlistGride', ['playlist' => $response_data, 'status' => true])->render(),
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
    public function editplaylists($id){
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'playlists/' . $id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $language = language();
        $status = status();
        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        //dd($response_data);
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {

                $publishtimestamp = $response_data['payload']['publishFrom'];
                $splitTimeStamp = explode(" ",$publishtimestamp);
                $publishdate = $splitTimeStamp[0]?? '';
                $publishtime = $splitTimeStamp[1] ?? '';
        
                $expiretimestamp = $response_data['payload']['publishTo'];
                $splitTimeStamp = explode(" ",$expiretimestamp);
                $expiredate = $splitTimeStamp[0]?? '';
                $expiretime = $splitTimeStamp[1] ?? '';
                return view('content.editplaylists', ['action' => 'edit', "edit_data" => $response_data['payload'],'lang'=>$language,
                'status'=>$status,'publishdate'=>$publishdate,
                'publishtime'=>$publishtime, 'expiredate'=>$expiredate, 'expiretime'=>$expiretime]);
            } else {
                return redirect('playlists')->with('error', $response_data['status']['message']);
            }
        } else {
            info('Article Edit : ' . $response_data['message']);
            return redirect('playlists')->with('error', $response_data['message']);
        }
    }


    public function updateVedio(Request $request){
        $validation = Validator::make(
            $request->all(), [
            'photo' => 'image|mimes:jpeg,bmp,png,jpg',
        ],
        );
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        $postdata = $request->all() ?? null;
        $videolist_id = $request->input("videolist_id");
        $route = 'playlists';
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'playlists/' . $videolist_id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

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
        //platform
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

         //country
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
   
        $postfields = ['title' => $request->input("title"),
                'url_segment' => $request->input("titleUrlSegment"),
                'subtitle' => $request->input("subtitle"),
                'summary' => $request->input("summary"),
                'slug' => $request->input("slug"),
                'cover' => ($request->file('coverphoto')) ? curl_file_create($request->file('coverphoto'), $request->file('coverphoto')->getMimeType(), $request->file('coverphoto')->getClientOriginalName()) : null,
                'display_date' => $request->input("date"),
                'location' => $request->input("playlistlocationsearch"),
                'latitude' => $request->input("latitudeplaylist"),
                'longitude' => $request->input("longitudeplaylist"),
                'status' => $request->input("status"),
                'created_date' => $request->input("created_date"),
                'platform' => $platform,
                'updated_date' => $request->input("updated_date"),
                'language' => $request->input("language"),
                'headline' => $request->input("headline"),
                'tags' => $tags,
                'references' => $ref,
                'related' => $cont,
                'expiryDate' => $request->input("expiryDate"),
                'playlist_type' => $request->input("playlist_type"),
                'content_type' => $request->input("content_type"),
                'current_status' => $request->input("current_status"),
                'publish_date' =>$request->publish_date . ' ' . $request->publish_time ?? null,
                'expiryDate' =>$request->expiryDate . ' ' . $request->expiryTime ?? null,
                'geo_blocking' => $country ?? null,
                'keywords' =>   $request->input("keywords"),
            ];

            // echo "<pre>";
            // print_r($postfields);exit;
            try {
                $response = APIHandlers::get_api_response($method, $url, $headers, $postfields);
                $response_data = json_decode($response, true);
                // echo "<pre>";
                // print_r($response_data);exit;
                if (!empty($response_data['status']['code'])) {
                    if ($response_data['status']['code'] == '200') {
                        return redirect($route)->with('success', $response_data['status']['message']);
                    } else {
                        return redirect($route)->with('error', $response_data['status']['message']);
                    }
                } else {
                    info('Article Update : ' . $response_data['message']);
                    return redirect($route)->with('error', $response_data['message']);
                }
                } catch (Exception $exception) {
                    return redirect($route)->with('error', "API Error : " . $exception->getMessage());
                }
    } 
    
    public function deleteplaylists(Request $request)
    {
        $id = $request['single_id'];
        $route = 'photos';
        $method = 'DELETE';
        $url = config('bcciconfig.CURD_API_URL') . 'playlists/' . $id; 
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
            info('playlist Delete : ' . $response_data['message']);
            return redirect($route)->with('error', $response_data['message']);
        }
        // // echo "sadfasfd";exit;
        // // $route = 'contentList/playlists';
        // $token = APIHandlers::get_token();
        // $id = $request->input('single_video_id');
        // $videoview = $request->input('videoview');
        // // $id = $uriSegments[2];
        // $url = config('bcciconfig.CURD_API_URL'). "playlists".'/'.$id ;
        // // echo $url;exit;
        // $method = "DELETE";

        // $headers = [
        //     'Cache-Control: no-cache',
        //     'Content-Type: application/x-www-form-urlencoded',
        //     'Authorization: Bearer ' . $token,
        // ];

        // $response = APIHandlers::get_api_response($method, $url, $headers);
    
        // $response_data = json_decode($response, true);
        // // echo "<pre>";
        // // print_r($response_data);exit;
        // if($videoview == 'tableview'){
        //     if(!empty($response_data['status']['code'])){
        //         if($response_data['status']['code'] == '200'){
        //             return redirect('/playlists')->with('success', $response_data['status']['message']);
        //         }else{
        //             return redirect('/playlists')->with('error', $response_data['status']['message']);
        //         }
        //     }else{
        //         return redirect('/playlists')->with('error', $response_data['message']);
        //     }
        // }else if($videoview == 'gridview'){
        //     if(!empty($response_data['status']['code'])){
        //         if($response_data['status']['code'] == '200'){
        //             return redirect('playlistdata')->with('success', $response_data['status']['message']);
        //         }else{
        //             return redirect('playlistdata')->with('error', $response_data['status']['message']);
        //         }
        //     }else{
        //         return redirect('playlistdata')->with('error', $response_data['message']);
        //     }
        // }else{
        //     return redirect('playlistdata')->with('error', "Something went wrong");
        // }


    }

    public function deleteBulklists(Request $request){
        $id_array = $request['single_id'];
        if($id_array == ""){
            $method = 'POST';
            $url = config('bcciconfig.CURD_API_URL') . 'playlists/bulk_delete';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ];
            $route = 'photos';
            $id_array = explode(',', $request->input('bulk_ids'));
            $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['playlist_ids' => $id_array]));
        }else {
            $id = $request['single_id'];
            $route = 'photos';
            $method = 'DELETE';
            $url = config('bcciconfig.CURD_API_URL') . 'playlists/' . $id; 
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
    }

    public function playlistdata(Request $request,$id = 1)
    {
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'playlists?page='.$id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['videoslist'] = $response_data['payload']['data'];
            $data['link'] = $response_data['payload']['links'];
        } else {
            $data = [];
        }
        return view('content.playlistdata', [
            'videoslist' => $data,
        ]);
        // $method = 'GET';
        // $url = config('bcciconfig.CURD_API_URL') . 'playlists?page='.$id;
        // $token = APIHandlers::get_token();
        // $headers = [
        //     'Accept:application/json',
        //     'Authorization: Bearer ' . $token
        // ];

        // $response = APIHandlers::get_api_response($method, $url, $headers);
        // $response_data = json_decode($response, true);
        // if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
        //     $data['videoslist'] = $response_data['payload']['data'];
        //     $data['link'] = $response_data['payload']['links'];
        // } else {
        //     $data = [];
        // }
        // // return view('content.videolist', [
        // //     'videoslist' => $data,
        // // ]);
        // return view('content.playlistdata', ["playlist" => $data]);

        // return view('playlist.playlist', ["playlist" => $data]);
    }


    public function searchByTitle(Request $request){
        // echo "1234";exit;
        $postdata = $request->input("search");
        // $postdata = $request->all() ?? null;
        // pr($postdata);die;
        $url = config('bcciconfig.CURD_API_URL') .'playlists/list';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $postfields = ['title' => $postdata['title'] ?? null,
         ];

        $response = APIHandlers::get_api_response('POST', $url, $headers, $postfields);
        $response_data = json_decode($response, true);
        //pr($response_data);die;
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['videoslist'] = $response_data['payload']['data'];
            $data['link'] = $response_data['payload']['links'];
        } else {
            $data = [];
        }
        return view('content.showpalylist', [
            'videoslist' => $data,
        ]);

    }

    
    public function fetchplay(Request $request){
        // echo "asdfasdf";exit;
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'playlists/' . $request->id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
     //dd($response_data);
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return  response()->json(array('data'=>$response_data['payload']));
               
            } else {
                return redirect('playlists')->with('error', $response_data['status']['message']);
            }
        } else {
            info('playlists Edit : ' . $response_data['message']);
            return redirect('playlists')->with('error', $response_data['message']);
        }
    }

    public function playlistSearchlist(Request $request){
        // echo "asdfasdf";exit;
        // $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL'). 'playlists/list';
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

        echo "<pre>";print_r($postdata);exit;

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
            'html' => view('content.playlisttable', ['images' => $image, ])->render(),
            'status' => false,
        ]);
        // echo "asdfasdf";exit;
        // $token = APIHandlers::get_token();
        // $method = 'POST';
        // $headers = [
        //     'Content-Type:application/x-www-form-urlencoded',
        //     'Authorization: Bearer ' . $token
        // ];
        // $post_fields = array(
        //     'search_title' => $request->input('serarch_value')
        // );
        // $url = config('bcciconfig.CURD_API_URL') . '/images';
        // $response = APIHandlers::get_api_response($method, $url, $headers, $post_fields, true);
        // $response_data = json_decode($response, true);

        // if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
        //     $image = $response_data['payload'];
        //     return response()->json([
        //         'html' => view('image.phototable', ['images' => $image, ])->render(),
        //         'status' => true,
        //     ]);
        // } else {
        //     $promos = [];
        //     return response()->json([
        //         'html' => view('image.phototable', ['images' => $image, ])->render(),
        //         'status' => false,
        //     ]);
        // }
    }
}
