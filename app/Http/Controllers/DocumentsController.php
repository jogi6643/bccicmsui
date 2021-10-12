<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\APIHandlers;
use Illuminate\Support\Facades\Validator;

class DocumentsController extends Controller
{
    public function addNewdoc(Request $request)
    {
      
    
         $postdata = $request->all() ?? null;
            //dd($postdata);
        //  $published_date = $request->published_date ?? null." ".$request->published_time ?? null;
    
        //  $display_date = $request->display_date ?? null." ".$request->display_time ?? null;

        //  $expiry_date = $request->expiry_date ?? null." ".$request->expiry_time ?? null;
        //  $geolocation=json_encode($postdata['geolocation'])??null;
         $validator = Validator::make($postdata, [
            'title' => 'required',
            //'asset_type' => 'required',
            //'slug' => 'required',
            //'short_description' => 'required|max:520',
            'summary' => 'required',
            'doc_url' => 'required',
            //'content_type' => 'required'
         ]);
        //  if(isset($request->contentref))
        //  {
        //      // $ref =  implode(",",$request->ref)??null;
        //      $ref = $request->contentref;
        //      $arr =[];
        //     foreach ($ref as $key => $value) {
        //         $arr[$key]['id'] = $value;  
        //         $arr[$key]['title'] = $postdata['title'];  
        //         $arr[$key]['type'] = $postdata['type_reference'];  
        //     }
        //      $ref =  json_encode($arr)??null;
            
        //  }
        //  else
        //  {
        //      $ref = null;
        //  }
        //  if(isset($request->relcontent))
        //  {
        //      $ref1 = $request->relcontent;
        //      // $cont =  implode(",",$request->content)??null;
        //      $arr1 =[];
        //      foreach ($ref1 as $key => $value) {
        //          $arr1[$key]['id'] = $value;  
        //          $arr1[$key]['title'] = $postdata['title'];  
        //          $arr1[$key]['type'] = $postdata['refcontype'];  
        //      }
        //       $ref1 =  json_encode($arr1)??null;
        //      // $cont =  json_encode($request->content)??null;
        //  }
        //  else
        //  {
        //      $ref1 = null;
        //  }
        //  $tags=json_encode($postdata['tags'])??null; 

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
                $arr[$key]['type'] = $postdata['type_reference'];  
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

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $url = config('bcciconfig.CURD_API_URL') . 'documents';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token
            ];

            $postfields = ['title' => $postdata['title'] ?? null,
            'url_segment' => $postdata['titleUrlSegment'] ?? null,
            'slug' => $postdata['titleUrlSegment'] ?? null,
            'language' => $postdata['language'] ?? null,
            'status' => 'true',
            'short_description' => $postdata['short_description'] ?? null,
            'summary' => $postdata['summary'] ?? null,
            'currentstatus' => $postdata['currentstatus'] ?? null,
            'description' => $postdata['description'] ?? null,
            'display_date' => $request->publish_date . ' ' . $request->publish_time ?? null,
           // 'published_date' => $published_date ?? null,
            'publish_date' =>$request->publish_date . ' ' . $request->publish_time ?? null,
            'expiryDate' =>$request->expiryDate . ' ' . $request->expiryTime ?? null,
            'published_by' => $postdata['published_by'] ?? null,
            'meta_languages' => $postdata['meta_languages'] ?? null,
            'created_date' => $postdata['created_date'] ?? null,
            'assest_type' => "documents" ?? null,
            //'expiry_date' => $expiry_date ?? null,
            'match_formats' => $postdata['match_formats'] ?? null,
            'content_type' => $postdata['content_type'] ?? null,
            'last_updated' => $postdata['last_updated'] ?? null,
            'updated_date' => $postdata['updated_date'] ?? null,
            'read_time' => $postdata['read_time'] ?? null,
            'metadata' => $postdata['metadata'] ?? null,
            //'doc_url' => $postdata['views_count'] ?? null,
            'location' => $postdata['documentslocationsearch'] ?? null,
            // 'location_label' => $postdata['location_label'] ?? null,
            // 'location_search' => $postdata['location_search'] ?? null,
            'latitude' => $postdata['latitudedocuments'] ?? null,
            'longitude' => $postdata['longitudedocuments'] ?? null,
            'references' => $ref ?? null,
            'related' => $cont ?? null,
            'tags'=> $tags ?? null,
            'doc_url'=> curl_file_create($request->file('doc_url'), $request->file('doc_url')->getMimeType(), $request->file('doc_url')->getClientOriginalName())

        ];
            $response = APIHandlers::get_api_response('POST', $url, $headers, $postfields);
            $response_data = json_decode($response, true);
           // dd($response_data);
            if (!empty($response_data['status']['code'])) {
                if ($response_data['status']['code'] == '200') {
                    return redirect('getdocument')->with('success', $response_data['status']['message']);
                } else {
                    return redirect('uploadcontent')->with('error', $response_data['status']['message']);
                }
            } else {
                return redirect('uploadcontent')->with('error', $response_data['message']);
            }
        }
    }
    public function getDocument(Request $request,$id = 1)
    {
        $language = language();
        // $page = !empty($request->page) ? $request->page  : $id;
        // $method = 'GET';
        // $url = config('bcciconfig.CURD_API_URL') . "images?page=" . $id;
        // $token = APIHandlers::get_token();
        // $headers = [
        //     'Accept:application/json',
        //     'Authorization: Bearer ' . $token
        // ];

        // $response = APIHandlers::get_api_response($method, $url, $headers);
        // $response_data = json_decode($response, true);

        ///////////////// New Code by MAhendra Start ///////////////////

        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'documents/list';
        $headers = [
            // 'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'Accept: application/json' ,
        ];
        // $tags = !empty($request->tags) ? explode(",", $request->tags) : '';
        $lang = !empty($request->lang) ? explode(",",  $request->lang) : '';
        $current_status = !empty($request->current_status) ? explode(",", $request->current_status) : '';
        $postData = [
            "page_number"  => $request->page ?? 1,
            "per_page_count" => (int)$request->max_items,
            // "import_source" => $request->filter_by_source,
            // "from_date" => $request->from_date,
            // "to_date" => $request->to_date,
            // "content_reference" => $request->ref,
            "title" => $request->search_term,
            "max_items" => $request->max_item,
            //  "sort_by" => $request->sortby, // some problem
            // "order" => $request->max_item,
            "content_from" => $request->show_content_from, // some problem
            // "tags" => !empty($tags) ? $tags : '',
            "language" =>  !empty($lang) ? $lang : '',
            "current_status" =>  !empty($current_status) ? $current_status : '',

        ];
        $json = json_encode($postData);
        $response = APIHandlers::get_api_response($method, $url, $headers, $json);
        $response_data = json_decode($response, true);
       // dd($response_data);
        ///////////////// New Code by MAhendra  End ///////////////////

        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['documentlist'] = $response_data['payload']['data'];
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
        return view('document.documentlist', [
            'documentlist' => $data,
            'lang'=>$language
        ]);
        // // pr("HI");exit();
        // $method = 'POST';
        // $url = config('bcciconfig.CURD_API_URL') . 'documents/list?page_number'.$id;
        // $token = APIHandlers::get_token();
        // $headers = [
        //     'Accept:application/json',
        //     'Authorization: Bearer ' . $token
        // ];

        // $response = APIHandlers::get_api_response($method, $url, $headers);
        // $response_data = json_decode($response, true);
        // $language=language();
        // if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
        //     $data['doclist'] = $response_data['payload']['data'];
        //     $data['link'] = $response_data['payload']['links'];
        // } else {
        //     $data = [];
        // }
        // return view('content.list-document', [
        //     'doclist' => $data,
        //     'language' => $language,
        // ]);
    }

    function documentfilter(Request $request)
    {
        // echo "safdsdafsdaf";exit;
       
        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'documents/list';
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
            // "import_source" => $request->filter_by_source,
            // "from_date" => $request->from_date,
            // "to_date" => $request->to_date,
            // "content_reference" => $request->ref,
            "title" => $request->search_term,
            "max_items" => $request->max_item,
            //  "sort_by" => $request->sortby, // some problem
            // "order" => $request->max_item,
            "content_from" => $request->show_content_from, // some problem
            // "tags" => !empty($tags) ? $tags : '',
            "language" =>  !empty($lang) ? $lang : '',
            "current_status" =>  !empty($currentstatus) ? $currentstatus : '',

        ];
        // echo '2';exit;
        $json = json_encode($postData);
        // echo "<pre>";print_r($postData);exit;
        $response = APIHandlers::get_api_response($method, $url, $headers, $json);
        // echo "<pre>";print_r($response);exit;
        $response_data = json_decode($response, true);
        //echo "<pre>";print_r($response_data);exit;
        if (!empty($response_data) && $response_data['status']['code'] == '200') {
            return response()->json([
                'listhtml' => view('document.documentTable', ['document' => $response_data, 'status' => true])->render(),
                'gridehtml' => view('document.documentGride', ['document' => $response_data, 'status' => true])->render(),
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


    public function fetchdocumnet(Request $request){
        // echo $request->id;exit;
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'documents/' . $request->id;
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
                return redirect('getdocument')->with('error', $response_data['status']['message']);
            }
        } else {
            info('Photo Edit : ' . $response_data['message']);
            return redirect('getdocument')->with('error', $response_data['message']);
        }
    }

    public function getdocumentById($doc_id)
    {

        $url = config('bcciconfig.CURD_API_URL') .'documents/'.$doc_id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $postfields = [];
    
        $response = APIHandlers::get_api_response('GET', $url, $headers);
        $response_data = json_decode($response, true);
        $language=language();
        $status   = status();
        $publishtimestamp = $response_data['payload']['display_date'];
        $splitTimeStamp = explode(" ",$publishtimestamp);
        $publishdate = $splitTimeStamp[0]?? '';
        $publishtime = $splitTimeStamp[1] ?? '';

        $expiretimestamp = $response_data['payload']['publishTo'];
        $splitTimeStamp = explode(" ",$expiretimestamp);
        $expiredate = $splitTimeStamp[0]?? '';
        $expiretime = $splitTimeStamp[1] ?? '';
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $doc = $response_data['payload'];
        } else {
            $doc = [];
        }
        return view('content.edit-document', [
            'edit_data' => $doc,
            'language' => $language,
            'status'=>$status,
                'publishdate'=>$publishdate,
                'publishtime'=>$publishtime, 'expiredate'=>$expiredate, 'expiretime'=>$expiretime

        ]);
    }

    public function viewdocById(Request $request)
    {
        $doc_id = $request->input('id');
        $url = config('bcciconfig.CURD_API_URL') .'documents/'.$doc_id;
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
                return  response()->json(array('data'=>$response_data['payload']));
               
            } else {
                return redirect('viewdocById')->with('error', $response_data['status']['message']);
            }
        } else {
            info('Article Edit : ' . $response_data['message']);
            return redirect('viewdocById')->with('error', $response_data['message']);
        }
    }

    public function updatedoc(Request $request)
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

         $validator = Validator::make($postdata, [
            'title' => 'required',
            //'asset_type' => 'required',
            //'slug' => 'required',
            //'short_description' => 'required|max:520',
            'summary' => 'required',
            //'content_type' => 'required'
         ]);

       if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $id = $postdata['ID'];
            // api/documents/49/update
            $url = config('bcciconfig.CURD_API_URL') .'documents/'.$id.'/update/';
           
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token
            ];

             $postfields = ['title' => $postdata['title'] ?? null,
             'url_segment' => $postdata['url_segment'] ?? null,
             'language' => $postdata['language'] ?? null,
             'status' => 'true',
             'short_description' => $postdata['short_description'] ?? null,
             'summary' => $postdata['summary'] ?? null,
             'description' => $postdata['description'] ?? null,
             'display_date' => $request->publish_date . ' ' . $request->publish_time ?? null,
             'published_date' => $request->publish_date . ' ' . $request->publish_time ?? null,
             'expiryDate' => $request->expiryDate . ' ' . $request->expiryTime ?? null,
             'published_by' => $postdata['published_by'] ?? null,
             'meta_languages' => $postdata['meta_languages'] ?? null,
             'created_date' => $postdata['created_date'] ?? null,
             'assest_type' => $postdata['assest_type'] ?? null,
             'content_type' => $postdata['content_type'] ?? null,
             'last_updated' => $postdata['last_updated'] ?? null,
             'updated_date' => $postdata['updated_date'] ?? null,
             'read_time' => $postdata['read_time'] ?? null,
             'metadata' => $postdata['metadata'] ?? null,
             //'doc_url' => $postdata['views_count'] ?? null,
             'location' => $postdata['documentslocationsearch'] ?? null,
            // 'location_label' => $postdata['location_label'] ?? null,
            // 'location_search' => $postdata['location_search'] ?? null,
            'latitude' => $postdata['latitudedocuments'] ?? null,
            'longitude' => $postdata['longitudedocuments'] ?? null,
             'doc_id' => $postdata['ID'] ?? null,
             'references' => $ref ?? null,
            'related' => $cont ?? null,
            'tags'=> $tags ?? null,
             //'doc_url'=> curl_file_create($request->file('doc_url'), $request->file('doc_url')->getMimeType(), $request->file('doc_url')->getClientOriginalName())

         ];
           
            if($request->file('doc_url') != ""){
                $postfields['doc_url'] = curl_file_create($request->file('doc_url'), $request->file('doc_url')->getMimeType(), $request->file('doc_url')->getClientOriginalName());
            } 
       //dd($postfields);
        //   die;
            $response = APIHandlers::get_api_response('POST', $url, $headers, $postfields);
            $response_data = json_decode($response, true);
            // dd($response_data);
            if (!empty($response_data['status']['code'])) {
                if ($response_data['status']['code'] == '200') {
                    return redirect('getdocument')->with('success', $response_data['status']['message']);
                } else {
                    return redirect('getdocument')->with('error', $response_data['status']['message']);
                }
            } else {
                return redirect('getdocument')->with('error', $response_data['message']);
            }
        }
    }

    public function singledeletedoc(Request $request)
    {
        // echo "123";exit;
        $id = $request['single_id'];
        // echo $id;exit;
        $route = 'getdocument';
        $method = 'DELETE';
        $url = config('bcciconfig.CURD_API_URL') . 'documents/' . $id; 
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

        // $token = APIHandlers::get_token();
        // $id = $request->input('single_video_id');
        // $videoview = $request->input('videoview');
        // $url = config('bcciconfig.CURD_API_URL') ."documents/".$id;
        // $method = "DELETE";

        // $headers = [
        //     'Cache-Control: no-cache',
        //     'Content-Type: application/x-www-form-urlencoded',
        //     'Authorization: Bearer ' . $token,
        // ];

        // $response = APIHandlers::get_api_response($method, $url, $headers);
    
        // $response_data = json_decode($response, true);
        // //pr($response_data );die;
        // if($videoview == 'tableview'){
        //     if(!empty($response_data['status']['code'])){
        //         if($response_data['status']['code'] == '200'){
        //             return redirect('getdocument')->with('success', $response_data['status']['message']);
        //         }else{
        //             return redirect('getdocument')->with('error', $response_data['status']['message']);
        //         }
        //     }else{
        //         return redirect('getdocument')->with('error', $response_data['message']);
        //     }
        // }else if($videoview == 'gridview'){
        //     if(!empty($response_data['status']['code'])){
        //         if($response_data['status']['code'] == '200'){
        //             return redirect('documentlistdata')->with('success', $response_data['status']['message']);
        //         }else{
        //             return redirect('documentlistdata')->with('error', $response_data['status']['message']);
        //         }
        //     }else{
        //         return redirect('documentlistdata')->with('error', $response_data['message']);
        //     }
        // }else{
        //     return redirect('documentlistdata')->with('error', "Something went wrong");
        // }

    }
    
    public function bulkDeletedocument(Request $request){
        
        $id_array = $request['single_id'];
        if($id_array == ""){
            $method = 'POST';
            $url = config('bcciconfig.CURD_API_URL') . 'documents/bulk_delete';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ];
            $route = 'getdocument';
            $articleview = $request->input('videoview');
            $id_array = explode(',', $request->input('bulk_ids'));
            $doc_ids =[];
            foreach ($id_array  as $key => $value) {
            $doc_ids[] = (int)$value;
            }
            // echo "<pre>";print_r(json_encode($doc_ids));exit;
            $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['doc_ids' => $doc_ids]));
        }else {
            $id = $request['single_id'];
            // echo $id;exit;
            $route = 'getdocument';
            $method = 'DELETE';
            $url = config('bcciconfig.CURD_API_URL') . 'documents/' . $id; 
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
        // echo "safsadffsad";exit;
        // $method = 'POST';
        // $url = config('bcciconfig.CURD_API_URL') . 'documents/bulk_delete';
        // $token = APIHandlers::get_token();
        // $headers = [
        //     'Accept:application/json',
        //     'Authorization: Bearer ' . $token,
        //     'Content-Type: application/json'
        // ];
        // $route = 'getdocument';
        // $articleview = $request->input('videoview');
        // $id_array = explode(',', $request->input('bulk_ids'));
        // $doc_ids =[];
        // foreach ($id_array  as $key => $value) {
        //  $doc_ids[] = (int)$value;
        // }
        // // echo "<pre>";print_r(json_encode($doc_ids));exit;
        // $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['doc_ids' => $doc_ids]));
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
    public function bulkDeleteDoc(Request $request){
            
        $token = APIHandlers::get_token();
        $url = config('bcciconfig.CURD_API_URL') . 'documents/bulk_delete';

        $headers = [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ];
        
        $videoview = $request->input('videoview');
        $value_get = $request->input('video_id');
        $id_array = array_map('intval', explode(',', $request->input('video_id')));
        
        $response = APIHandlers::get_api_response('POST', $url, $headers,json_encode(['doc_ids' =>$id_array]));
        $response_data = json_decode($response, true);
        if($videoview == 'tableview'){
            if(!empty($response_data['status']['code'])){
                if($response_data['status']['code'] == '200'){
                    return redirect('getdocument')->with('success', $response_data['status']['message']);
                }else{
                    return redirect('getdocument')->with('error', $response_data['status']['message']);
                }
            }else{
                return redirect('getdocument')->with('error', $response_data['message']);
            }
        }else if($videoview == 'gridview'){
            if(!empty($response_data['status']['code'])){
                if($response_data['status']['code'] == '200'){
                    return redirect('documentlistdata')->with('success', $response_data['status']['message']);
                }else{
                    return redirect('documentlistdata')->with('error', $response_data['status']['message']);
                }
            }else{
                return redirect('documentlistdata')->with('error', $response_data['message']);
            }
        }else{
            return redirect('documentlistdata')->with('error', "Something went wrong");
        }
        
    }

    public function searchByTitle(Request $request){
        $postdata = $request->all() ?? null;
        //pr($postdata);die;
        $url = config('bcciconfig.CURD_API_URL') .'documents/search';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $postfields = ['search_title' => $postdata['search'] ?? null,
         ];

        $response = APIHandlers::get_api_response('POST', $url, $headers, $postfields);
        $response_data = json_decode($response, true);
        //pr($response_data);die;
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['doclist'] = $response_data['payload']['data'];
            $data['link'] = $response_data['payload']['links'];
        } else {
            $data['doclist'] = [];
            $data['link'] = [];
        }
        return view('content.list-document', [
            'doclist' => $data,
        ]);

    }

    public function documentlistdata(Request $request,$id = 1)
    {
        // pr("HI docs");exit();
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'documents?page='.$id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        $language=language();
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['videoslist'] = $response_data['payload']['data'];
            $data['link'] = $response_data['payload']['links'];
        } else {
            $data = [];
        }
        return view('content.documentdata', [
            'videoslist' => $data,
            'language' => $language,

        ]);
        // $method = 'GET';
        // $url = config('bcciconfig.CURD_API_URL') . 'documents';
        // $token = APIHandlers::get_token();
        // $headers = [
        //     'Accept:application/json',
        //     'Authorization: Bearer ' . $token
        // ];

        // $response = APIHandlers::get_api_response($method, $url, $headers);
        // $response_data = json_decode($response, true);
        // if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
        //     $data['doclist'] = $response_data['payload']['data'];
        //     $data['link'] = $response_data['payload']['links'];
        // } else {
        //     $data = [];
        // }
        // return view('content.documentdata', [
        //     'doclist' => $data,
        // ]);
    }

    public function filterDocs(Request $request){
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL'). 'documents/list';
        $token = APIHandlers::get_token();
        $headers = [
            'Authorization: Bearer ' . $token,
            'Accept:application/json',
            'Content-Type: application/json'
        ];

        $postdata = [];
        $postdata['max_items'] =$request->input('max_items') ?? 24;
        $postdata['sort_by'] = $request->input('sort_by') ?? 'Last updated';
        $postdata['order'] = $request->input('order') ?? 'desc';
        // $postdata['content_from'] = $request->input('content_from') ?? 'All time';
        $postdata['page_number'] = $request->input('go_to') ?? 1;

        if (!(empty($request->input('search_term')))) {
            $postdata['title'] = $request->input('search_term');
        }
        if (!(empty($request->input('language')))) {
            // $postdata['language'] = $request->input('language');
            // $postdata['language'] ='English';
        }
        if (!(empty($request->input('current_status')))) {
            $postdata['current_status'] = $request->input('current_status');
        }
        // dd(json_encode($postdata));
        $response = APIHandlers::get_api_response($method, $url, $headers, json_encode($postdata));
        $response_data = json_decode($response, true);
        // dd($response_data);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $biolist = $response_data['payload']['data'];
            return response()->json([
                'html' => view('content.docmentfilterlist', ['biolist' => $biolist, ])->render(),
                'status' => true,
            ]);
        } else {
            $biolist = [];
            return response()->json([
                'html' => view('content.docmentfilterlist', ['biolist' => $biolist, ])->render(),
                'status' => false,
            ]);
        }
        // if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
        //     $biolist = $response_data['payload']['data'];
        // } else {
        //     $biolist = [];
        // }
        // return response()->json([
        //     'html' => view('content.docmentfilterlist', ['biolist' => $biolist, ])->render(),
        //     'status' => false,
        // ]);
    }
    public function filterDocsgride(Request $request){
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL'). 'documents/list';
        $token = APIHandlers::get_token();
        $headers = [
            'Authorization: Bearer ' . $token,
            'Accept:application/json',
            'Content-Type: application/json'
        ];

        $postdata = [];
        $postdata['max_items'] =$request->input('max_items') ?? 24;
        $postdata['sort_by'] = $request->input('sort_by') ?? 'Last updated';
        $postdata['order'] = $request->input('order') ?? 'desc';
        // $postdata['content_from'] = $request->input('content_from') ?? 'All time';
        $postdata['page_number'] = $request->input('go_to') ?? 1;

        if (!(empty($request->input('search_term')))) {
            $postdata['title'] = $request->input('search_term');
        }
        if (!(empty($request->input('language')))) {
            // $postdata['language'] = $request->input('language');
            // $postdata['language'] ='English';
        }
        if (!(empty($request->input('current_status')))) {
            $postdata['current_status'] = $request->input('current_status');
        }
        // dd(json_encode($postdata));
        $response = APIHandlers::get_api_response($method, $url, $headers, json_encode($postdata));
        $response_data = json_decode($response, true);
        // dd($response_data);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $biolist = $response_data['payload']['data'];
            //  dd($response_data);
            return response()->json([
                'html' => view('content.documentTabgride', ['biolist' => $biolist, ])->render(),
                'status' => true,
            ]);
        } else {
            $biolist = [];
            return response()->json([
                'html' => view('content.documentTabgride', ['biolist' => $biolist, ])->render(),
                'status' => false,
            ]);
        }
        // if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
        //     $biolist = $response_data['payload']['data'];
        // } else {
        //     $biolist = [];
        // }
        // return response()->json([
        //     'html' => view('content.documentTabgride', ['biolist' => $biolist, ])->render(),
        //     'status' => false,
        // ]);
    }
}
