<?php

namespace App\Http\Controllers;
use App\Http\APIHandlers;
use Exception;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

use Illuminate\Support\Facades\Validator;

class bioController extends Controller
{
    public function bioList(Request $request,$id = 1){
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL').'bios/list?page_number='.$id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $language=language();
        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $data['biolist'] = $response_data['payload']['data'];
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

        return view('bios.biolistshow', [
            'biolist' => $data,
            'lang' => $language,
        ]);
    }

    function biosfilter(Request $request)
    {
        //echo "safdsdafsdaf";exit;
       
        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'bios/list';
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
        // dd($postData);
        // echo '2';exit;
        $json = json_encode($postData);
        // echo "<pre>";print_r($postData);exit;
        $response = APIHandlers::get_api_response($method, $url, $headers, $json);
        // echo "<pre>";print_r($response);exit;
        $response_data = json_decode($response, true);
        // echo "<pre>";print_r($response_data);exit;
        if (!empty($response_data) && $response_data['status']['code'] == '200') {
            return response()->json([
                'listhtml' => view('bios.biosTable', ['bios' => $response_data, 'status' => true])->render(),
                'gridehtml' => view('bios.biosGride', ['bios' => $response_data, 'status' => true])->render(),
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

    public function fetchbios(Request $request){
     
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . $request->id .'/viewBioById';
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
                return redirect('bios')->with('error', $response_data['status']['message']);
            }
        } else {
            info('Bios Edit : ' . $response_data['message']);
            return redirect('bios')->with('error', $response_data['message']);
        }
    }

    public function biogridList(Request $request,$id = 1){
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL').'listBio?page='.$id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);

        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $listbio = $response_data;
        } else {
            $listbio = [];
        }
     
        return view('admin.biosgrid', [
            'biolist' => $listbio
        ]);
    }
    public function viewBioById(Request $request)
    {
        
        $Bios_id = $request->input('id');
        $url = config('bcciconfig.CURD_API_URL') .$Bios_id.'/viewBioById';
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
                return redirect('viewBioById')->with('error', $response_data['status']['message']);
            }
        } else {
            info('Article Edit : ' . $response_data['message']);
            return redirect('viewBioById')->with('error', $response_data['message']);
        }
    }
    public function addNewBio(Request $request)
    {
        
         $postdata = $request->all() ?? null;
        
         if($request->file('image_file') != ""){
            $postdata['image_url'] = curl_file_create($request->file('image_url'), $request->file('image_url')->getMimeType(), $request->file('image_url')->getClientOriginalName());
        }      
        $validator = Validator::make($postdata, [
            // 'title' => 'required|min:3',
            // 'photo_description' => 'required',
            // // 'photo_keyword' => 'required',
            // 'photo_subtitle' => 'required',
            // // 'published_by' => 'required',
            // 'published_date' => 'required',
            // // 'match_format' => 'required',
            // // 'photo_status' => 'required',
            // 'photo_current_status' => 'required',
            // // 'photo_platform' => 'required',
            // // 'comments_on' => 'required',
            // 'copyright' => 'required',
            // 'language' => 'required',
            'image_url' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $url = config('bcciconfig.CURD_API_URL') . 'addBio';
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
            if(!empty($postdata['image_url'])){
                $imageurl = curl_file_create($request->file('image_url'), $request->file('image_url')->getMimeType(), $request->file('image_url')->getClientOriginalName());
             }else{
                $imageurl ="";
             }
            $postfields = ['title' => $postdata['title'] ?? null,
                "asset_type" => "bio",
                'slug' => $postdata['slug'] ?? null,
                'short_description' => $postdata['short_description'] ?? null,
                'description' => $postdata['description'] ?? null,
                'content_type' => $postdata['content_type'] ?? null,
                'known_name' => $postdata['known_name'] ?? null,
                'first_name' => $postdata['first_name'] ?? null,
                'surname' => $postdata['surname'] ?? null,
                'platform' => $postdata['platform'] ?? null,
                'image_url' =>$imageurl ?? null,
                'nationality' => $postdata['nationality'] ?? null,
                'date_of_birth' => $postdata['date_of_birth'] ?? null,
                'date_of_death' => $postdata['date_of_death'] ?? null,
                'language' => $postdata['language'] ?? null,
                'place_of_birth' => $postdata['place_of_birth'] ?? null,
                'summary' => $postdata['summary'] ?? null,
                'career_start_date' => $postdata['career_start_date'] ?? null,
                'career_end_date' => $postdata['career_end_date'] ?? null,
                'current_status' => $postdata['current_status'] ?? null,
                'status' => $postdata['status'] ?? null,
                'references' => $ref ?? null,
                'related' => $cont ?? null,
                'tags' => $tags,
                //'publish_date' => $request->publish_date . ' ' . $request->publish_time ?? null,
                //'expiryDate' => $request->expiryDate . ' ' . $request->expiryTime ?? null,

            ]; 
            $response = APIHandlers::get_api_response('POST', $url, $headers, $postfields);
            $response_data = json_decode($response, true);
            //dd($response_data);
            if (!empty($response_data['status']['code'])) {
                if ($response_data['status']['code'] == '200') {
                    return redirect('getbiosList')->with('success', $response_data['status']['message']);
                } else {
                    return redirect('uploadcontent')->with('error', $response_data['status']['message']);
                }
            } else {
                return redirect('uploadcontent')->with('error', $response_data['message']);
            }
        }
    }


    public function singledeletebios(Request $request){
        // echo "asfdsafdsfsadf";exit;
        $id = $request['single_id'];
        $route = 'bios';
        $method = 'DELETE';
        $url = config('bcciconfig.CURD_API_URL') . $id.'/deleteBio'; 
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

    public function deletebio($id)
    {
        $route = 'bios';
        $method = 'DELETE';
        $url = config('bcciconfig.CURD_API_URL') . $id.'/deleteBio';
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

    public function deleteBulkBios(Request $request){
        $id_array = $request['single_id'];
        if($id_array == ""){
            $method = 'DELETE';
            $url = config('bcciconfig.CURD_API_URL') . 'bulkDeleteBio';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ];
            $route = 'bios';
            $articleview = $request->input('videoview');
            $id_array = explode(',', $request->input('bulk_ids'));
            // echo "<pre>";print_r($id_array);exit;
            $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['bio_ids' => $id_array]));
        }else {
            $id = $request['single_id'];
            $route = 'bios';
            $method = 'DELETE';
            $url = config('bcciconfig.CURD_API_URL') . $id.'/deleteBio'; 
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
     
        // $method = 'DELETE';
        // $url = config('bcciconfig.CURD_API_URL') . 'bulkDeleteBio';
        // $token = APIHandlers::get_token();
        // $headers = [
        //     'Accept:application/json',
        //     'Authorization: Bearer ' . $token,
        //     'Content-Type: application/json'
        // ];
        // $route = 'bios';
        // $articleview = $request->input('videoview');
        // $id_array = explode(',', $request->input('bulk_ids'));
        // // echo "<pre>";print_r($id_array);exit;
        // $response = APIHandlers::get_api_response($method, $url, $headers, json_encode(['bio_ids' => $id_array]));
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
        // $token = APIHandlers::get_token();
        // $url = config('bcciconfig.CURD_API_URL').'bulkDeleteBio';
        // $headers = [
        //     'Authorization: Bearer ' . $token,
        //     'Content-Type: application/json'
        // ];
        
        // $videoview = $request->input('Biosview');
        // // $value_get = $request->input('Bios_id');
        // $id_array = array_map('intval', explode(',', $request->input('Bios_id')));
        // // pr($id_array);
        // // echo $videoview;
        // // die;
        // $response = APIHandlers::get_api_response('DELETE', $url, $headers,json_encode(['bio_ids' =>$id_array]));
        // $response_data = json_decode($response, true);
        // if($videoview == 'tableview'){
        //     if(!empty($response_data['status']['code'])){
        //         if($response_data['status']['code'] == '200'){
        //             return redirect('bios')->with('success', $response_data['status']['message']);
        //         }else{
        //             return redirect('bios')->with('error', $response_data['status']['message']);
        //         }
        //     }else{
        //         return redirect('bios')->with('error', $response_data['message']);
        //     }
        // }else if($videoview == 'gridview'){
        //     if(!empty($response_data['status']['code'])){
        //         if($response_data['status']['code'] == '200'){
        //             return redirect('biosdata')->with('success', $response_data['status']['message']);
        //         }else{
        //             return redirect('biosdata')->with('error', $response_data['status']['message']);
        //         }
        //     }else{
        //         return redirect('biosdata')->with('error', $response_data['message']);
        //     }
        // }else{
        //     return redirect('bios')->with('error', "Something went wrong");
        // }
        
    }

    public function searchByTitle(Request $request){
        
        $postdata = $request->all() ?? null;
        $validator = Validator::make($postdata, [
            'search' => 'required',

        ]);

        if ($validator->fails()) {
            // if(0){
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

        else { $url = config('bcciconfig.CURD_API_URL') .$postdata['search'].'/searchByTitleBio';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $videoview = $request->input('Biosview1');
        $response = APIHandlers::get_api_response('GET', $url, $headers);
        $response_data = json_decode($response, true);
       // pr($response_data);die;
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $listbio = $response_data;
        } else {
            $listbio = [];
        }
        if($videoview=='gridview'){
            return view('admin.biosgrid', [
                'biolist' => $listbio,
            ]);
        }
        return view('admin.bios', [
            'biolist' => $listbio,
        ]);
        }
    }

    public function filterBios(Request $request){
        
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL'). 'bios/list';
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
        $postdata['content_from'] = $request->input('content_from') ?? 'All time';
        $postdata['page_number'] = $request->input('go_to') ?? 1;

        if (!(empty($request->input('search_term')))) {
            $postdata['title'] = $request->input('search_term');
        }
        if (!(empty($request->input('language')))) {
            $postdata['language'] = $request->input('language');
            // $postdata['language'] ='English';
        }
        if (!(empty($request->input('current_status')))) {
            $postdata['current_status'] = $request->input('current_status');
        }
        // dd($postdata['language']);
        $response = APIHandlers::get_api_response($method, $url, $headers, json_encode($postdata));
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $biolist = $response_data['payload']['data'];
        } else {
            $biolist = [];
        }
        return response()->json([
            'html' => view('admin.biosTable', ['biolist' => $biolist, ])->render(),
            'status' => false,
        ]);
    }

   
    public function filterBiosgrid(Request $request)
    {
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL'). 'bios/list';
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
        // dd($postdata);
        $response = APIHandlers::get_api_response($method, $url, $headers, json_encode($postdata));
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $biolist = $response_data['payload']['data'];
            return response()->json([
                'html' => view('admin.biosTablegrid', ['biolist' => $biolist, ])->render(),
                'status' => true,
            ]);
        } else {
            $biolist = [];
            return response()->json([
                'html' => view('admin.biosTablegrid', ['biolist' => $biolist, ])->render(),
                'status' => false,
            ]);
        }
    }
    public function Biosdata(Request $request,$id = 1)
    {
    
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') .'listBio?page='.$id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        $language=language();
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $listbio = $response_data;
        } else {
            $listbio = [];
        }
        return view('admin.biosgrid', [
            'biolist' => $listbio,
            'language' => $language,
        ]);
    }

    public function editBiosById($Bios_id)
    {
        $url = config('bcciconfig.CURD_API_URL') .$Bios_id.'/viewBioById';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $language=language();
        $response = APIHandlers::get_api_response('GET', $url, $headers);
        $response_data = json_decode($response, true);
        $status   = status();
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $listbio = $response_data['payload'];
        } else {
            $listbio = [];
        }
        return view('content.edit_bios', [
            'edit_data' => $listbio,
            'language' => $language,
            'status'=>$status,
        ]);
    }

    public function updateBios(Request $request)
    {

        $postdata = $request->all() ?? null;
        $validator = Validator::make($postdata, [
            'title' => 'required',
            //'asset_type' => 'required',
            //'slug' => 'required',
            'short_description' => 'required|max:520',
            'description' => 'required',
            'content_type' => 'required'
         ]);

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
       if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $id = $postdata['ID'];
            $url = config('bcciconfig.CURD_API_URL') .$postdata['ID'].'/updateBio';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token
            ];
            if(!empty($postdata['image_url'])){
                $imageurl = curl_file_create($request->file('image_url'), $request->file('image_url')->getMimeType(), $request->file('image_url')->getClientOriginalName());
             }else{
                $imageurl ="";
             }

            $postfields = ['title' => $postdata['title'] ?? null,
             'short_description' => $postdata['short_description'] ?? null,
             'known_name' => $postdata['known_name'] ?? null,
             'surname' => $postdata['surname'] ?? null,
             'first_name' => $postdata['first_name'] ?? null,
             'nationality' => $postdata['nationality'] ?? null,
             'date_of_birth' => $postdata['date_of_birth'] ?? null,
             'date_of_death' => $postdata['date_of_death'] ?? null,
             'image_url' => $imageurl ?? null,
             'platform' => $postdata['platform'] ?? null,
             'slug' => $postdata['slug'] ?? null,
             'current_status' => $postdata['current_status'] ?? null,
             'language' => $postdata['language'] ?? null,
             //'published_by' => $postdata['published_by'] ?? null,
             'summary' => $postdata['summary'] ?? null,
             'display_date' => $postdata['display_date'] ?? null,
             'city' => $postdata['city'] ?? null,
             'description' => $postdata['description'] ?? null,
             'position' => $postdata['position'] ?? null,
             'career_start_date' => $postdata['career_start_date'] ?? null,
             'career_end_date' => $postdata['career_end_date'] ?? null,
             'publish_date' => $postdata['publish_date'] ?? null,
             'asset_type' => $postdata['asset_type'] ?? null,
             'references' => $ref ?? null,
             'related' => $cont ?? null,
             'tags' => $tags,
             'content_type' => $postdata['content_type'] ?? null,   
            ];
           

            // if($request->file('thumbnail_image') != ""){
            //     $postfields['imageUrl'] = curl_file_create($request->file('thumbnail_image'), $request->file('thumbnail_image')->getMimeType(), $request->file('thumbnail_image')->getClientOriginalName());
            // } 
       
            $response = APIHandlers::get_api_response('POST', $url, $headers, $postfields);
            $response_data = json_decode($response, true);
            if (!empty($response_data['status']['code'])) {
                if ($response_data['status']['code'] == '200') {
                    return redirect('bios')->with('success', $response_data['status']['message']);
                } else {
                    return redirect('edit-bios')->with('error', $response_data['status']['message']);
                }
            } else {
                return redirect('edit-bios')->with('error', $response_data['message']);
            }
        }
    }

    public function GetBioContent(Request $request)
    {
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

    public function BioreferanceRelated(Request $request)
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
}
