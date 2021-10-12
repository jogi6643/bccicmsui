<?php

namespace App\Http\Controllers;

use App\Http\APIHandlers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AudioController extends Controller
{
    public function getAudioList(Request $request, $id = 1)
    {
        $language = language();
        $page = !empty($request->page) ? $request->page  : $id;
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . "audios?page=" . $id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
      
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['audiolist'] = $response_data['payload']['data'];
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
        return view('audio.audiolist', [
            'audiolist' => $data,
            'lang'=>$language
        ]);
        // $method = 'GET';
        // $url = config('bcciconfig.CURD_API_URL') . 'audios?page='.$id;
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
        //     $data['total'] = $response_data['payload']['total'];
        //     $data['from'] = $response_data['payload']['from'];
        //     $data['to'] = $response_data['payload']['to'];
        // } else {
        //     $data = [];
        // }
        // return view('content.audio-list', [ 'data' => $data, 'content_type' => 'audio']);
    }


    function audiofilter(Request $request)
    {
        // echo "123456";exit;
        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'audios/list';
        $headers = [
            // 'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'Accept: application/json' ,
        ];
      
        // $tags = !empty($request->tags) ? explode(",", $request->tags) : '';
        // $tags = !empty($request->tags) ?  $request->tags: '';
        $lang = !empty($request->lang) ? explode(",",  $request->lang) : '';
        $current_status = !empty($request->current_status) ? explode(",", $request->current_status) : '';
  
        $cc = [];
        $aa =[];
        if($request->ref!==null &&isset($request->ref))
        {
            foreach ($request->ref as $key => $value) {
                $cc = strip_tags($value);
                $split = explode("ID:", $cc);
                $cc = $split[1];
                $aa[] = $cc;
             }
        }
        $postData = [
            "page_number"  => $request->page ?? 1,
            "per_page_count" => (int)$request->max_items,
            // "import_source" => $request->filter_by_source,
            //  "from_date" => $request->from_date,
            // "to_date" => $request->to_date,
            // "content_reference" => $aa,
             "title" => $request->search_term,
            "max_items" => $request->max_item,
            // "sort_by" => $request->sortby,
            "order" => $request->max_item,
            "content_from" => $request->show_content_from,
            // "tags" => !empty($tags) ? $tags : '',
            "language" =>  !empty($lang) ? $lang : '',
            "current_status" =>  !empty($current_status) ? $current_status : '',

        ];
        $json = json_encode($postData);       
        $response = APIHandlers::get_api_response($method, $url, $headers, $json);
        // echo "<pre>";print_r($postData);exit;
        $response_data = json_decode($response, true);
        // echo "<pre>";print_r($response_data);exit;
        if (!empty($response_data) && $response_data['status']['code'] == '200') {
            return response()->json([
                'listhtml' => view('audio.audioTable', ['audio' => $response_data, 'status' => true])->render(),
                'gridehtml' => view('audio.audioGride', ['audio' => $response_data, 'status' => true])->render(),
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

    public function addNewAudio(Request $request){
        $route = 'getAudioList';
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'audios';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        
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
                $arr[$key]['type'] = $request->type_reference;
               
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
                $arr[$key]['type'] = $request->releted_audio_type;  
            }
            $cont=  json_encode($arr)??null;
        }
        else
        {
            $cont = null;
        }
        // End Content References
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
       
        $postfields = [
                'title' => $request->input("title"),
                'titleslug' => $request->input("titleUrlSegment"),
                'audio_url' => curl_file_create($request->file('audiofile'), $request->file('audiofile')->getMimeType(), $request->file('audiofile')->getClientOriginalName()),
                'thumbnail' => curl_file_create($request->file('thumbnail_image'), $request->file('thumbnail_image')->getMimeType(), $request->file('thumbnail_image')->getClientOriginalName()),
                'description' => $request->input("description"),
                'short_description' => $request->input("short_description"),
                'audio_duration' => $request->input("duration"),
                'platform' => $request->input("platform"),
                'keywords' => $request->input("keywords"),
                'language' => $request->input("language"),
                'asset_type' => $request->input("type"),
                //'publish_date' => $request->input("publish_date"),
                //'expiryDate' => $request->input("expiry_date"),
                'current_status' => $request->input("current_status"),
                'references' => $ref,
                'related' => $cont,
                'tags' =>   $tags,
                'publish_date' =>$request->publish_date . ' ' . $request->publish_time ?? null,
                'expiryDate' =>$request->expiryDate . ' ' . $request->expiryTime ?? null,

                // 'match_id' => $request->input("match_id"),
                // 'content_type' => $request->input("content_type"),
                // 'audio_scope' => $request->input("audio_scope"),
                // 'match_formats' => $request->input("match_formats"),
                // 'status' => $request->input("status"),
                // 'created_date' => $request->input("created_date"),
                // 'publish_by' => $request->input("publish_by"),
                // 'meta_languages' => $request->input("meta_languages"),
                // 'total_viewcount' => $request->input("total_viewcount"),
                // 'commentsOn' => $request->input("commentsOn"),
            ];

        try {
            $response = APIHandlers::get_api_response($method, $url, $headers, $postfields);
            $response_data = json_decode($response, true);

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
    }

    public function editAudio($id){
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'audios/' . $id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        $language = language();
        $status   = status();
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {

                $publishtimestamp = $response_data['payload']['publishTo'];
                $splitTimeStamp = explode(" ",$publishtimestamp);
                $publishdate = $splitTimeStamp[0]?? '';
                $publishtime = $splitTimeStamp[1] ?? '';

                $expiretimestamp = $response_data['payload']['publishFrom'];
                $splitTimeStamp = explode(" ",$expiretimestamp);
                $expiredate = $splitTimeStamp[0]?? '';
                $expiretime = $splitTimeStamp[1] ?? '';
                $get_tags = get_all_tags();
                return view('content.editaudio', ['action' => 'edit',
                 "edit_data" => $response_data['payload'] ,
                 'language' => $language,'status'=>$status,
                 'publishdate'=>$publishdate,
                 'publishtime'=>$publishtime, 'expiredate'=>$expiredate, 'expiretime'=>$expiretime,'get_tags'=>$get_tags]);
      
            }else {
                    return redirect('getAudioList')->with('error', $response_data['status']['message']);
            }
        } else {
            info('Article Edit : ' . $response_data['message']);
            return redirect('getAudioList')->with('error', $response_data['message']);
        }
    }




    public function updateAudio(Request $request){
        $postdata = $request->all() ?? null;
      
        $audiolist_id = $request->input("ID");
        $route = 'getAudioList';
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'audios/' . $audiolist_id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        if (!empty($request->file('audiofile'))) {
            $audiourl = curl_file_create($request->file('audiofile'), $request->file('audiofile')->getMimeType(), $request->file('audiofile')->getClientOriginalName());
        } else {
            $audiourl = $request->input('audio_url');
        }

        if (!empty($request->file('thumbnail'))) {
            $thumbnail = curl_file_create($request->file('thumbnail'), $request->file('thumbnail')->getMimeType(), $request->file('thumbnail')->getClientOriginalName());
        } else {
            $thumbnail = $request->input('thumbnail_url');
        }
        

       
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
             

        $postfields = [
            'title' => $request->input("title"),
            'titleslug' => $request->input("titleUrlSegment"),
            'audio_url' => $audiourl ?? null,
            'thumbnail' => $thumbnail ?? null,
            'description' => $request->input("description"),
            'short_description' => $request->input("short_description"),
            'audio_duration' => $request->input("duration"),
            'platform' => $request->input("platform"),
            'keywords' => $request->input("keywords"),
            'language' => $request->input("language"),
            'asset_type' => $request->input("type"),
           // 'publish_date' => $request->input("publish_date"),
           // 'expiryDate' => $request->input("expiry_date"),
            'current_status' => $request->input("current_status"),
            'references' => $ref,
            'related' => $cont,
            'tags' => $tags,
            'publish_date' =>$request->publish_date . ' ' . $request->publish_time ?? null,
            'expiryDate' =>$request->expiryDate . ' ' . $request->expiryTime ?? null,

            // 'match_id' => $request->input("match_id"),
            // 'content_type' => $request->input("content_type"),
            // 'audio_scope' => $request->input("audio_scope"),
            // 'match_formats' => $request->input("match_formats"),
            // 'status' => $request->input("status"),
            // 'created_date' => $request->input("created_date"),
            // 'publish_by' => $request->input("publish_by"),
            // 'meta_languages' => $request->input("meta_languages"),
            // 'total_viewcount' => $request->input("total_viewcount"),
            // 'commentsOn' => $request->input("commentsOn"),
        ];
        
        try {
            $response = APIHandlers::get_api_response($method, $url, $headers, $postfields);
            $response_data = json_decode($response, true);
            // echo "<pre>"; print_r($response_data);exit;
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
    
    

    public function deleteAudio(Request $request)
    {
        $id = $request['single_id'];
        $route = 'getAudioList';
        $method = 'DELETE';
        $url = config('bcciconfig.CURD_API_URL') . 'audios/' . $id; 
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
            info('Audio Delete : ' . $response_data['message']);
            return redirect($route)->with('error', $response_data['message']);
        }
        // // echo "sadfasfd";exit;
        // // $route = 'contentList/playlists';
        // $token = APIHandlers::get_token();
        // $id = $request->input('single_video_id');
        // $videoview = $request->input('videoview');
        // // $id = $uriSegments[2];
        // $url = config('bcciconfig.CURD_API_URL'). "audios".'/'.$id ;
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
        //             return redirect('/getAudioList')->with('success', $response_data['status']['message']);
        //         }else{
        //             return redirect('/getAudioList')->with('error', $response_data['status']['message']);
        //         }
        //     }else{
        //         return redirect('/getAudioList')->with('error', $response_data['message']);
        //     }
        // }else if($videoview == 'gridview'){
        //     if(!empty($response_data['status']['code'])){
        //         if($response_data['status']['code'] == '200'){
        //             return redirect('audiolistdata')->with('success', $response_data['status']['message']);
        //         }else{
        //             return redirect('audiolistdata')->with('error', $response_data['status']['message']);
        //         }
        //     }else{
        //         return redirect('audiolistdata')->with('error', $response_data['message']);
        //     }
        // }else{
        //     return redirect('audiolistdata')->with('error', "Something went wrong");
        // }


    }

    public function deleteBulkaudio(Request $request){
        
        $id_array = $request['single_id'];
        if($id_array == ""){
            $method = 'POST';
            $url = config('bcciconfig.CURD_API_URL') . 'audios/bulk_delete';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ];
            $route = 'getAudioList';
            $articleview = $request->input('videoview');
            $id_array = explode(',', $request->input('bulk_ids'));
            // echo "<pre>";print_r($id_array);exit;
            $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['audio_ids' => $id_array]));
        }else {
            $id = $request['single_id'];
            $route = 'getAudioList';
            $method = 'DELETE';
            $url = config('bcciconfig.CURD_API_URL') . 'audios/' . $id; 
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
        // $url = config('bcciconfig.CURD_API_URL') . 'audios/bulk_delete';
        // $token = APIHandlers::get_token();
        // $headers = [
        //     'Accept:application/json',
        //     'Authorization: Bearer ' . $token,
        //     'Content-Type: application/json'
        // ];
        // $route = 'getAudioList';
        // $articleview = $request->input('videoview');
        // $id_array = explode(',', $request->input('bulk_ids'));
        // // echo "<pre>";print_r($id_array);exit;
        // $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['audio_ids' => $id_array]));
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
        //     info('Audio Delete : ' . $response_data['message']);
        //     return redirect($route)->with('error', $response_data['message']);
        // }    
        
        
        // // echo "asdfasdf";exit;
        // $token = APIHandlers::get_token();

        // $url = config('bcciconfig.CURD_API_URL') . 'audios/bulk_delete';

        // $headers = [
        //     'Authorization: Bearer ' . $token,
        //     'Content-Type: application/json'
        // ];
        
        // $videoview = $request->input('videoview');
        // $value_get = $request->input('video_id');
        // $id_array = array_map('intval', explode(',', $request->input('video_id')));
        // // echo "<pre>";print_r($id_array);exit;
        // $response = APIHandlers::get_api_response('POST', $url, $headers,json_encode(['audio_ids' =>$id_array]));
        // // echo "<pre>";print_r($response);exit;
        // $response_data = json_decode($response, true);
        // if($videoview == 'tableview'){
        //     if(!empty($response_data['status']['code'])){
        //         if($response_data['status']['code'] == '200'){
        //             return redirect('getAudioList')->with('success', $response_data['status']['message']);
        //         }else{
        //             return redirect('getAudioList')->with('error', $response_data['status']['message']);
        //         }
        //     }else{
        //         return redirect('getAudioList')->with('error', $response_data['message']);
        //     }
        // }else if($videoview == 'gridview'){
        //     if(!empty($response_data['status']['code'])){
        //         if($response_data['status']['code'] == '200'){
        //             return redirect('audiolistdata')->with('success', $response_data['status']['message']);
        //         }else{
        //             return redirect('audiolistdata')->with('error', $response_data['status']['message']);
        //         }
        //     }else{
        //         return redirect('audiolistdata')->with('error', $response_data['message']);
        //     }
        // }else{
        //     return redirect('audiolistdata')->with('error', "Something went wrong");
        // }
    }

    public function audiolistdata(Request $request,$id = 1)
    {
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'audios?page='.$id;
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
        return view('content.audiodata', [
            'videoslist' => $data,
        ]);   
    }

    public function fetchaudio(Request $request)
    {
       
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'audios/' . $request->id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        
        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
     
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return  response()->json(array('data'=>$response_data['payload']));
               
            } else {
                return redirect('getAudioList')->with('error', $response_data['status']['message']);
            }
        } else {
            info('Article Edit : ' . $response_data['message']);
            return redirect('getAudioList')->with('error', $response_data['message']);
        }
    }

    public function audiocommonsearch(Request $request) { 
        $postdata = $request->type;
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') .'search';
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

    // use search List Api for Audio Search
    public function audiosearchlist(Request $request)
    {
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') .'audios/list';
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
     
        if (!(empty($request->input('search_term')))) {
            $postdata['title'] = $request->input('search_term');
        }
        if (!(empty($request->input('language')))) {
            $postdata['language'] = $request->input('language');
        }
        if (!(empty($request->input('current_status')))) {
            $postdata['current_status'] = $request->input('current_status');
        }

        $response = APIHandlers::get_api_response($method, $url, $headers, json_encode($postdata));
        $response_data = json_decode($response, true);
    
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['videoslist'] = $response_data['payload']['data'];
            $data['link'] = $response_data['payload']['links'];
            $data['total'] = $response_data['payload']['total'];
            $data['from'] = $response_data['payload']['from'];
            $data['to'] = $response_data['payload']['to'];
        } else {
            $data = [];
        }
        return response()->json([
            'html' => view('content.audio-table-data', [
                'data' => $data,
                'content_type' => 'audio',
            ])->render()
        ]);
    }
}
