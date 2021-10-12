<?php

namespace App\Http\Controllers;

use App\Http\APIHandlers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{

    public function getArticlesList(Request $request, $id = 1)
    {
        
        $language = language();
        $status    = status();
        $page = !empty($request->page) ? $request->page  : $id;
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'articles?page=' . $page;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
      
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['articlelist'] = $response_data['payload']['data'];
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
        return view('articles.artclelist', [
            'articlelist' => $data,
            'lang'=>$language,
            'status'=>$status,
        ]);
    }


    function atriclefilter(Request $request)
    {
        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'articles/list';
        $headers = [
            // 'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'Accept: application/json' ,
        ];
      
        // $tags = !empty($request->tags) ? explode(",", $request->tags) : '';
        $tags = !empty($request->tags) ?  $request->tags: '';
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
            "per_page_count" => $request->max_items,
            "import_source" => $request->filter_by_source,
            "from_date" => $request->from_date,
            "to_date" => $request->to_date,
            "content_reference" => $aa,
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

        if (!empty($response_data) && $response_data['status']['code'] == '200') {
            return response()->json([
                'listhtml' => view('articles.articleTable', ['article' => $response_data, 'status' => true])->render(),
                'gridehtml' => view('articles.articleGride', ['article' => $response_data, 'status' => true])->render(),
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
    // public function getArticlesList(Request $request, $id = 1){
      
    //     $method = 'GET';
    //     $url = config('bcciconfig.CURD_API_URL') . 'articles?page='.$id;
    //     $token = APIHandlers::get_token();
    //     $headers = [
    //         'Accept:application/json',
    //         'Authorization: Bearer ' . $token
    //     ];

    //     $response = APIHandlers::get_api_response($method, $url, $headers);
    //     $response_data = json_decode($response, true);
      
    //     if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
    //         $articles = $response_data['payload']['data'];
    //         $pagination = $response_data['payload']['links'];
    //     } else {
    //         $articles = [];
    //     }
     
    //     return view('content.content-view', [
    //         'contents' => $articles,
    //         'pagination'=>$pagination,
    //         'content_type' => 'articles'
    //     ]);
     
    // }

    public function addArticle(Request $request)
    {
       
        $postdata = $request->all() ?? null;
        // Relete refernce
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
         // end
        $validator = Validator::make($postdata, [
            // 'title' => 'required',
            // 'short_description' => 'required',
            // 'description' => 'required',
            // 'body' => 'required',
            // 'description' => 'required',
            'title' => 'required',
            // 'summary' => 'required',
            'body' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $route = 'articles';
            // $route = 'contentList/articles';

            $method = 'POST';
            $url = config('bcciconfig.CURD_API_URL') . 'articles';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token
            ];
            $postfields = [
                'title' => $postdata['title'] ?? null,
                'short_description' => $postdata['short_description'] ?? null,
                'description' => "test description",
                'body' => $postdata['body'] ?? null,
                // 'content' => $postdata['content'] ?? null,
                'subtitle' => $postdata['subtitle'] ?? null,
                // 'article_owner' => $postdata['article_owner'] ?? null,
                // 'video_duration' => $postdata['video_duration'] ?? null,
                // 'match_id' => $postdata['match_id'] ?? null,
                // 'related'
                'content_type' => $postdata['content_type'] ?? null,
                'author' => $postdata['author'] ?? null,
                'image_url' => $postdata['image_url'] ?? null,
                'keywords' => $postdata['keywords'] ?? null,
                'leadMedia' => $postdata['leadMedia'] ?? null,
                'additionalInfo' => $postdata['additionalInfo'] ?? null,
                'match_formats' => $postdata['match_formats'] ?? null,
                'published_by' => $postdata['published_by'] ?? null,
                'language' => $postdata['langauge'] ?? null,
                'location' => $postdata['location_search'] ?? null,
                'latitude' => $postdata['latitude'] ?? null,
                'longitude' => $postdata['longitude'] ?? null,
                'references' => $ref,
                'related'=>$cont,
                'tags'=>$tags ?? null,
                'commentsOn' => $postdata['commentsOn'] ?? null,
                'titleUrlSegment' => $request->urlsegment ?? null,
                'slug' => $postdata['slug'] ?? null,
                'summary' => "Test",
                'platform' => $platform,
                'status' => true,
                'hotlinkUrl' => $postdata['hoturl'] ?? null,
                'current_status' => $postdata['current_status'] ?? null,
                'publish_date' =>$request->publish_date . ' ' . $request->publish_time ?? null,
                'expiryDate' =>$request->expiryDate . ' ' . $request->expiryTime ?? null,
                'geo_blocking' => $country ?? null,
            ];
           

            if ($request->file('photo') != "") {
                $postfields['photo'] = curl_file_create($request->file('photo'), $request->file('photo')->getMimeType(), $request->file('photo')->getClientOriginalName());
            }
            // echo "<pre>";print_r($postfields);exit;
            try {
                $response = APIHandlers::get_api_response($method, $url, $headers, $postfields);
                $response_data = json_decode($response, true);
           
                if (!empty($response_data['status']['code'])) {
                    if ($response_data['status']['code'] == '200') {
                        // echo "asdfasdf"; exit;
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
    }

    public function searchArticleByTitle(Request $request)
    {
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'articles/search';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $view = $request->input('view') ?? 'articles-list';
        $postdata = ["search_term"=>$request->input('search_term') ?? null];
        $response = APIHandlers::get_api_response($method, $url, $headers,$postdata);
        $response_data = json_decode($response, true);

        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $articles = $response_data['payload'];
        } else {
            $articles = [];
        }

        return view('content.'.$view, [
            'articles' => $articles,
        ]);
    }

    public function searchArticle(Request $request)
    {
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'articles/list';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $postdata = [];
        if(!(empty($request->input('search_term')))){
            $postdata['title'] = $request->input('search_term');
        }
        if(!(empty($request->input('language')))){
            $postdata['language'] = $request->input('language');
        }
        if(!(empty($request->input('status')))){
            $postdata['status'] = $request->input('status');
        }

        $response = APIHandlers::get_api_response($method, $url, $headers,$postdata);
        $response_data = json_decode($response, true);

        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $articles = $response_data['payload'];
        } else {
            $articles = [];
        }
        return response()->json([
            'html' => view('content.articles-list-table', [
                'articles' => $articles,
            ])->render()
        ]);
        // return view('content.'.$view, [
        //     'articles' => $articles,
        // ]);
    }

    

    public function getArticlesGrid(Request $request)
    {
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'articles';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);

        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $articles = $response_data['payload'];
        } else {
            $articles = [];
        }

        return view('content.articles-grid', [
            'articles' => $articles,
        ]);
    }

    public function editArticles($id)
    {
       
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'articles/' . $id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $language = language();
        $status   = status();
        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        $publishtimestamp = $response_data['payload']['publishFrom'];
        $splitTimeStamp = explode(" ",$publishtimestamp);
        $publishdate = $splitTimeStamp[0]?? '';
        $publishtime = $splitTimeStamp[1] ?? '';

        $expiretimestamp = $response_data['payload']['publishTo'];
        $splitTimeStamp = explode(" ",$expiretimestamp);
        $expiredate = $splitTimeStamp[0]?? '';
        $expiretime = $splitTimeStamp[1] ?? '';
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return view('content.edit-article', ['language' => $language, 
                'action' => 'edit',
                "edit_data" => $response_data['payload'] ,
                'status'=>$status,
                'publishdate'=>$publishdate,
                'publishtime'=>$publishtime, 'expiredate'=>$expiredate, 'expiretime'=>$expiretime]);
            } else {
                return redirect('articleslist')->with('error', $response_data['status']['message']);
            }
        } else {
            info('Article Edit : ' . $response_data['message']);
            return redirect('articleslist')->with('error', $response_data['message']);
        }
    }
    
    public function fetchArticle(Request $request)
    {
       
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'articles/' . $request->id;
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
                return redirect('articles')->with('error', $response_data['status']['message']);
            }
        } else {
            info('Article Edit : ' . $response_data['message']);
            return redirect('articles')->with('error', $response_data['message']);
        }
    }

    public function updateArticle(Request $request)
    {
        $postdata = $request->all() ?? null;
     //   dd($postdata);
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
        
            // 'description' => 'required',
            'title' => 'required',
            // 'summary' => 'required',
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $article_id = $postdata['article_id'];
            $route = 'articles';
            $method = 'POST';
            $url = config('bcciconfig.CURD_API_URL') . 'articles/' . $article_id;
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token
            ];
          
        //////////////////// New code /////////////////////
            $postfields = [
                'title' => $postdata['title'] ?? null,
                'description' => $postdata['description'] ?? null,
                'subtitle' => $postdata['subtitle'] ?? null,
                'content_type' => $postdata['content_type'] ?? null,
                'author' => $postdata['author'] ?? null,
                'keywords' => $postdata['keywords']??null,
                'additionalInfo' => $postdata['additionalInfo'],
                'published_by' => $postdata['published_by'] ?? null,
                'language' => $postdata['language'] ?? null,
                'location' => $postdata['location_search'] ?? null,
                'latitude' => $postdata['latitude'] ?? null,
                'longitude' => $postdata['longitude'] ?? null,
                'current_status' => $postdata['current_status'] ?? null,
                'slug' => $postdata['slug'] ?? null,
                'titleUrlSegment' => $postdata['urlsegment']?? null,
                'platform' => $platform,
                'body' => $postdata['body'] ?? null,
                'hotlinkUrl' => $postdata['hotlinkUrl'] ?? null,
                'leadMedia' => $postdata['leadMedia'] ?? null,
                'references' => $ref,
                'related'=>$cont,
                'tags'=>$tags ?? null,
                'commentsOn' => $postdata['commentsOn'] ?? null,
                'total_viewcount' => "10",
                'summary' => "Test",
                'status' => true,
                'image_url' => $postdata['image_url'] ?? null,
                'publish_date' =>$request->publish_date . ' ' . $request->publish_time ?? null,
                'expiryDate' =>$request->expiryDate . ' ' . $request->expiryTime ?? null,
                'geo_blocking' => $country ?? null,
                // 'article_owner' => $postdata['article_owner'] ?? null,
                // 'duration' => "40",
                //'video_duration' => $postdata['video_duration'] ?? null,
                // 'match_id' => $postdata['match_id'] ?? null,
                // 'match_formats' => $postdata['match_formats'] ?? null,
                // 'summary' => "Test",
                // 'summary' => $postdata['summary'] ?? null,
                //'photo' => curl_file_create($request->file('photo'), $request->file('photo')->getMimeType(), $request->file('photo')->getClientOriginalName()),
            ];

        ///////////////////////// end ///////////////////

     
       // dd($postfields);
            if($request->file('photo') != ""){
                $postfields['photo'] = curl_file_create($request->file('photo'), $request->file('photo')->getMimeType(), $request->file('photo')->getClientOriginalName());
            }

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
                info('Article Update : ' . $response_data['message']);
                return redirect($route)->with('error', $response_data['message']);
            }
            } catch (Exception $exception) {
                return redirect($route)->with('error', "API Error : " . $exception->getMessage());
            }
        }
    }

    public function deleteArticle(Request $request)
    {
       
        $id = $request['single_article_id'];
        $route = 'articles';
        $method = 'DELETE';
        $url = config('bcciconfig.CURD_API_URL') . 'articles/' . $id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return redirect($route)->with('success', $response_data['status']['message']);


            } else {
                return redirect($route)->with('error', $response_data['status']['message']);
            }
        } else {
            info('Article Delete : ' . $response_data['message']);
            return redirect($route)->with('error', $response_data['message']);
        }
    }
    //copy 
    public function articledelete(Request $request)
    {
 
        $id = $request['article_id'];
        $route = 'articles';
        $method = 'DELETE';
        $url = config('bcciconfig.CURD_API_URL') . 'articles/' . $id;
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
            info('Article Delete : ' . $response_data['message']);
            return redirect($route)->with('error', $response_data['message']);
        }
    }

    // public function bulkDeleteArticle(Request $request)
    // {
        
    //     $method = 'POST';
    //     $url = config('bcciconfig.CURD_API_URL') . 'articles/bulk_delete';
    //     $token = APIHandlers::get_token();
    //     $headers = [
    //         'Accept:application/json',
    //         'Authorization: Bearer ' . $token,
    //         'Content-Type: application/json'
    //     ];
    //     $route = 'articles';
    //     $articleview = $request->input('videoview');
    //     $id_array = explode(',', $request->input('article_id'));
    //     $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['article_ids' => $id_array]));
    //     $response_data = json_decode($response, true);
    //     if (!empty($response_data['status']['code'])) {
    //         if ($response_data['status']['code'] == '200') {
    //             return redirect($route)->with('success', $response_data['status']['message']);
    //         } else {
    //             return redirect($route)->with('error', $response_data['status']['message']);
    //         }
    //     } else {
    //         info('Article Delete : ' . $response_data['message']);
    //         return redirect($route)->with('error', $response_data['message']);
    //     }
    // }
    public function bulkDeleteArticles(Request $request)
    {
        $id_array = $request['article_id'];
        if($id_array == ""){
            $method = 'POST';
            $url = config('bcciconfig.CURD_API_URL') . 'articles/bulk_delete';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ];
            $route = 'articles';
            $articleview = $request->input('videoview');
            $id_array = explode(',', $request->input('article_ids'));
            $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['article_ids' => $id_array]));
        }else {
            $id = $request['single_id'];
            $route = 'photos';
            $method = 'DELETE';
            $url = config('bcciconfig.CURD_API_URL') . 'articles/' . $id_array; 
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
        // echo "<hr/>";
        // echo '<pre>'; $id_array = explode(',', $request->input('article_ids'));
        // print_r($id_array);
        // exit;
        // $method = 'POST';
        // $url = config('bcciconfig.CURD_API_URL') . 'articles/bulk_delete';
        // $token = APIHandlers::get_token();
        // $headers = [
        //     'Accept:application/json',
        //     'Authorization: Bearer ' . $token,
        //     'Content-Type: application/json'
        // ];
        // $route = 'articles';
        // $articleview = $request->input('videoview');
        // $id_array = explode(',', $request->input('article_ids'));
        // $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['article_ids' => $id_array]));
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
        //     info('Article Delete : ' . $response_data['message']);
        //     return redirect($route)->with('error', $response_data['message']);
        // }
    }

    public function fetchArticlesList(Request $request)
    {
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'articles';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);

        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $articles = $response_data['payload'];
        } else {
            $articles = [];
        }

        return view('content.articles-list', [
            'articles' => $articles,
        ]);
    }


    public function searchartcletype(Request $request)
    {
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') .'articles';
        $token = APIHandlers::get_token();
        $headers = [
            'Authorization: Bearer ' . $token,
            'Accept:application/json',
            'Content-Type: application/json'
        ];

        $postdata = [];
        $postdata['max_items'] = $request->input('max_items') ?? '25';
        $postdata['sort_by'] = $request->input('sort_by') ?? 'Last updated';
        $postdata['order'] = $request->input('order') ?? 'desc';

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
            $articles = $response_data['payload']['data'];
            $pagination = $response_data['payload']['links'];
        } else {
            $articles = [];
     
        }
       
      
        return response()->json([
            'html' => view('content.articlesList', [
                'contents' => $articles,
                'pagination'=>$pagination,
                
             
            ])->render()
        ]);
    }


    public function bulkDeleteContent(Request $request)
    {
    
      
        $content_type = 'articles';
        $route = 'articles/';
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . $content_type . '/bulk_delete';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ];

        $id_array = explode(',', $request->input('content_id'));

        try {
            $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['article_ids' => $id_array]));
            $response_data = json_decode($response, true);

            if (!empty($response_data['status']['code'])) {
                if ($response_data['status']['code'] == '200') {
                    return redirect($route)->with('success', $response_data['status']['message']);
                } else {
                    return redirect($route)->with('error', $response_data['status']['message']);
                }
            } else {
                info($content_type . 'Delete : ' . $response_data['message']);
                return redirect($route)->with('error', $response_data['message']);
            }
        } catch (Exception $exception) {
            return redirect($route)->with('error', "API Error : " . $exception->getMessage());
        }
    }

    // common search methods

    public function commonsearch(Request $request)
    {
        // $postdata = $request->type;
        $postdata=[];
        $postdata['type'] = $request->type;
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


   
     
    public function articletagList(Request $request)
    {
        
        $postdata = $request->tag;
         
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') .'tags/list';
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
