<?php

namespace App\Http\Controllers;

use App\Http\APIHandlers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrayController extends Controller {
	
	public function index(Request $request){

		$respMessage = '';
		$page = $request->input('page');
		$headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . APIHandlers::get_token()
        ];
		$postData = array(
			'current_page' => $page,
			'page_slug' => ''
		);
        $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'trays/list', $headers, $postData);
        $response_data = json_decode($response, true);

        if ($response_data['status']['code'] == '200' && !empty($response_data['status']['code']) && !empty($response_data['payload'])) {
            if(!empty($response_data['payload']['data'])){
                $new_arr = [];
                foreach($response_data['payload']['data'] as $val){
                    $new_arr[] = $val['list'];
                   // print_r($val['list']);exit;
                }
                //print_r($new_arr);exit;
                $data['records'] = $new_arr;
            $data['link'] = $response_data['payload']['links'];
            }
        } else {
            $data['records'] = [];
            $data['link'] = [];
            $respMessage = $response_data['status']['message'];
        }

        $response_menu = APIHandlers::get_api_response('GET', config('bcciconfig.CURD_API_URL') . 'menu', $headers);
        $menu_data = json_decode($response_menu, true);
      
        if ($menu_data['status']['code'] == '200' && !empty($menu_data['status']['code']) && !empty($menu_data['payload'])) {
            $menu['records'] = $menu_data['payload']['data'];
            $menu['link'] = $menu_data['payload']['links'];
            $menu['current_page'] = $menu_data['payload']['current_page'];
        } else {
            $menu['records'] = [];
            $menu['link'] = [];
            $menu['current_page'] = 1;
            $menuMessage = $menu_data['status']['message'];
        }
        //print_r($menu['records']);exit;
        return view('content.tray-management', ["data" => $data,"menu" =>$menu['records'],  'page' => $page, 'respMessage' => $respMessage]);
	}
	
	public function save(Request $request) {
        
        $postData = $request->all();
        //print_r($postData);exit;
		if ($postData) {
            $validation = Validator::make($postData, [
                'title' => 'required',
                'display_title' => 'required',
                //'display_title_hindi' => 'required',
                'page' => 'required',
                'curated_language' => 'required',
                'content' => 'required',
            ]);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->errors())->withInput();
            } else {

                $headers = [
					'Accept:application/json',
					'Authorization: Bearer ' . APIHandlers::get_token()
				];
                $con_res = [];
              
                if(!empty($request->input('content'))){
                    foreach($request->input('content') as $key => $val){
                        $response = APIHandlers::get_api_response('GET', config('bcciconfig.CURD_API_URL') .$val.'/viewVideoById', $headers);
                        $response_data = json_decode($response, true);
                        $con_res[$key] = $response_data['payload'];
                        $con_res[$key]['list_order'] = $key;
                        //print_r($response_data['payload']);exit;
                    }
                }
                $postData = [
                    'title' => $request->input('title'),
                    'slug' => $request->input('slug'),
                    'display_title' => $request->input('display_title'),
                    'display_title_hindi' => $request->input('display_title_hindi'),
                    'page' => $request->input('page'),
                    'curated_language' => $request->input('curated_language'),
                    'show_more_button' => $request->input('show_more_button') ?? 'false',
					'content_list' => !empty($con_res) ? array(json_encode($con_res)) : null
				];
                $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'trays', $headers, $postData,true);
                $json_array = json_decode($response, true);
                if ($json_array['status']['code'] == '200' && !(empty($json_array['status']['code']))) {
                    return redirect('tray-management')->with('success', $json_array['status']['message']);
                } else {
                    return redirect('tray-management')->with('error', $json_array['status']['message']);
                }
            }
        }
    }

    public function delete(Request $request)
    {
        $tray_id = $request->input('tray_id');
        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Accept: application/json',
            'Authorization: Bearer ' . APIHandlers::get_token()
        ];
        $postData = [
            'page_slug' => 'home',
            'list_id' => $tray_id
        ];
        $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'deleteList', $headers, $postData, true);
        $json_array = json_decode($response, true);

        if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
            return redirect('tray-management')->with('success', $json_array['status']['message']);
        } else {
            return redirect('tray-management')->with('error', $json_array['status']['message']);
        }
    }

    public function view(Request $request)
    {
        //print_r($request->all());exit;
        $tray_id = $request->input('tray_id');
        $page_slug = $request->input('page_slug');
        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Accept: application/json',
            'Authorization: Bearer ' . APIHandlers::get_token()
        ];
        $postData = [
            'page_slug' => $page_slug,
            'tray_id' => $tray_id
        ];
        return $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'viewTrayById', $headers, $postData, true);
    }

    public function update(Request $request) {
        
        $tray_id = $request->input('tray_id');
        $postData = $request->all();
        //print_r($postData);exit;
		if ($postData) {
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . APIHandlers::get_token()
            ];
            $con_res = [];
            if(!empty($request->input('select-content-list'))){
                foreach($request->input('select-content-list') as $key => $val){
                    $response = APIHandlers::get_api_response('GET', config('bcciconfig.CURD_API_URL') .$val.'/viewVideoById', $headers);
                    $response_data = json_decode($response, true);
                    $con_res[$key] = $response_data['payload'];
                    $con_res[$key]['list_order'] = $key+1;
                    //print_r($response_data['payload']);exit;
                }
            }
            $postData = [
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'display_title' => $request->input('display_title'),
                'display_title_hindi' => $request->input('display_title_hindi'),
                'page' => $request->input('page'),
                'curated_language' => $request->input('curated_language'),
                'show_more_button' => $request->input('show_more_button') ?? 'false',
                'content_list' => !empty($con_res) ? array(json_encode($con_res)) : null
            ];
            //print_r($postData);exit;
            return $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'trays/' . $tray_id, $headers, $postData,true);
        }
    }

    public function traySorting(Request $request){

		$respMessage = '';
		$headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . APIHandlers::get_token()
        ];
      
	// 	$postData = array(
	// 		'page_slug' => 'home'
	// 	);
    //     $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'trays/list', $headers, $postData);
    //     $response_data = json_decode($response, true);

    //     if ($response_data['status']['code'] == '200' && !empty($response_data['status']['code']) && !empty($response_data['payload'])) {
    //         $data['list'] = $response_data['payload']['data']['0']['list'];
    //     } else {
    //         $data['list'] = [];
    //     }
    //    // $list_arr = [];
    //     $final_arr =[];
    //             foreach($data['list'] as $key => $val){
    //                 if(isset($val['list_order'])){
    //                 $final_arr[$val['list_order']] = $val;
    //                 }
    //             }
    //             //array_multisort($data['list'], SORT_DESC, $final_arr);
               
    //             ksort($final_arr);
    //           // print_r($final_arr);exit;

              $response = APIHandlers::get_api_response('GET', config('bcciconfig.CURD_API_URL') . 'menu', $headers);
              $response_data = json_decode($response, true);
            
              if ($response_data['status']['code'] == '200' && !empty($response_data['status']['code']) && !empty($response_data['payload'])) {
                  $data['records'] = $response_data['payload']['data'];
                  $data['link'] = $response_data['payload']['links'];
                  $data['current_page'] = $response_data['payload']['current_page'];
              } else {
                  $data['records'] = [];
                  $data['link'] = [];
                  $data['current_page'] = 1;
                  $respMessage = $response_data['status']['message'];
              }
              //print_r($data['records']);exit;
        return view('admin.traysorting', ["data" => $data['records']]);
	}

    public function listSort(Request $request) {
        
        $tray_id = $request->input('tray_id');
        $postData = $request->all();
		if ($postData) {
            
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . APIHandlers::get_token()
            ];

            $postData = [
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'display_title' => $request->input('display_title'),
                'display_title_hindi' => $request->input('display_title_hindi'),
                'page' => $request->input('page'),
                'curated_language' => $request->input('curated_language'),
                'show_more_button' => $request->input('show_more_button') ?? 'false',
                'content_list' => ' [{ "ID": 1, "title": "Test", "slug": "test" }, { "ID": 2, "title": "Test", "slug": "test" }]'
            ];
            
            return $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'trays/' . $tray_id, $headers, $postData);
        }
    }

    public function tray_list_sort(Request $request) {
        
        $postData = $request->all();
		if ($postData) {
            
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . APIHandlers::get_token()
            ];

          $postData['content_list'] = array_filter($postData['content_list']);
            return $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'traySorting',$headers, $postData,true);
        }
    }

    public function listContentSort(Request $request) {
        
        $postData = $request->all();
      
		if ($postData) {
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . APIHandlers::get_token()
            ];
            if(!empty($postData['content_list'])){
                $new_arr = [];
                foreach($postData['content_list'] as $key => $val){
                    $key = $key + 1;
                    $new_arr[$val] = $key ;
                }
            }
            $postData['content_list'] = $new_arr;
            //print_r($postData);exit;
          //$postData['content_list'] = array_filter($postData['content_list']);
        
            return $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'trayContentSort',$headers, $postData,true);
        }
    }

    public function getListContent(Request $request) {
        
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . APIHandlers::get_token()
        ];

        $postData = array(
            'page_slug' => $request->input('page_slug'),
            'tray_id' => $request->input('list_id')
        );
        
        return $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'viewTrayById', $headers, $postData);
    }
    public function getcataloglist(Request $request) {
        
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . APIHandlers::get_token()
        ];

       		$postData = array(
			'page_slug' => trim($request->input('page_slug'))
		);
        $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'trays/list', $headers, $postData);
        $response_data = json_decode($response, true);
        if ($response_data['status']['code'] == '200' && !empty($response_data['status']['code']) && !empty($response_data['payload'])) {
            $data['list'] = $response_data['payload']['data']['0']['list'];
        } else {
            $data['list'] = [];
        }
       // $list_arr = [];
       
        $final_arr =[];
                foreach($data['list'] as $key => $val){
                    if(isset($val['list_order'])){
                    $final_arr[$val['list_order']] = $val;
                    }
                }
                //array_multisort($data['list'], SORT_DESC, $final_arr);
               
                ksort($final_arr);
                $data['list']  = $final_arr;
              // print_r($final_arr);exit;
        return $data;
      //  return $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'viewTrayById', $headers, $postData);
    }
public function searchByTitle(Request $request){
    $respMessage = '';
    $headers = [
        'Accept:application/json',
        'Authorization: Bearer ' . APIHandlers::get_token()
    ];

          $response = APIHandlers::get_api_response('GET', config('bcciconfig.CURD_API_URL') .$request['title'].'/searchByTitle', $headers);
          $response_data = json_decode($response, true);
      
          if ($response_data['status']['code'] == '200' && !empty($response_data['status']['code']) && !empty($response_data['payload'])) {
              $data['records'] = $response_data['payload']['data'];
          }
          foreach($data as $val){
            foreach ($val as $final_val){
                $res[] = array('id' => $final_val['ID'], 'text' => $final_val['title']);
            }
          }
        //   $res[] = array('id' => $value['ID'], 'text' => $value['title']);
           return json_encode(array('results' => $res));
}

    
}



