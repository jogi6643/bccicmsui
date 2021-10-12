<?php

namespace App\Http\Controllers;
use App\Http\APIHandlers;
use App\Helpers\CommonHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class NavigationMenuController extends Controller{
    //

    public function index(Request $request){
        return view('admin.nav-menu');
    }

    //  public function promo(Request $request){
    //     return view('admin.promos');
    // }
     public function article(Request $request){
        $language=language();
        $status=status();
        return view('admin.articles')->with(['data'=> $language,'status'=>$status]);
    }

     public function photo(Request $request){
        $language=language();
        $status=status();
        return view('admin.photos')->with(['data'=> $language,'status'=>$status]);
    }
     public function playlist(Request $request){
        $language=language();
        $status=status();
        return view('admin.playlists')->with(['data'=> $language,'status'=>$status]);
    }
    public function video(Request $request){
        $language=language();
        $status=status();
        return view('admin.videos')->with(['data'=> $language,'status'=>$status]);
    }

    public function audio(Request $request){
        $language=language();
        $status=status();
        return view('admin.audio')->with(['data'=> $language,'status'=>$status]);
    }
     public function document(Request $request){
        $language=language();
        $status=status();
        return view('admin.document')->with(['data'=> $language,'status'=>$status]);
    }
     public function bio(Request $request){
        $language=language();
        $status=status();
        return view('admin.bios')->with(['data'=> $language,'status'=>$status]);
    }
     public function liveblog(Request $request){
        return view('admin.liveblogs');
    }

      public function articlesdata(Request $request){
        return view('admin.articlesdata');
    }

     public function addnewarticle(Request $request){
        return view('admin.addnewarticle');
    }

    public function adminusers(Request $request){
        return view('admin.adminusers');
    }

    public function adminusersaction(Request $request){
        return view('admin.adminusersaction');
    }

    public function version1(Request $request){
        return view('admin.version1');
    }

    public function version2(Request $request){
        return view('admin.version2');
    }

    public function traysorting1(Request $request){
        return view('admin.traysorting1');
    }

    public function traysorting2(Request $request){
        return view('admin.traysorting2');
    }
    public function uploadcontent(Request $request){
      
        $language=language();
        $status=status();
        return view('content.uploadcontent')->with(['data'=> $language,'status'=>$status]);
    }

    public function assignrole(Request $request){
        return view('admin.assignrole');
    }

    public function othermenucontent(Request $request){
        return view('admin.othermenucontent');
    }

    public function bccidomestic(Request $request){
        return view('admin.bccidomestic');
    }

    public function addcontentnew(Request $request){
        return view('admin.addcontentnew');
    }

    public function othermenucontentinternal(Request $request){
        $userData = $request->session()->get('user_data') ?? null;
        if (!empty($userData)) {
            header('Location: http://dev-iplauctioncms.epicon.in');
        }else{
            return redirect('login');
        }
    }

    public function bcciinternational(Request $request){
        return view('admin.bcciinternational');
    }

    public function ipl(Request $request){
        return view('admin.ipl');
    }
    public function vodlivematch(Request $request){
        return view('admin.vodlivematch');
    }

    public function edittray(Request $request){
        return view('admin.edittray');
    }

    public function addmenu(Request $request){
        $respMessage = '';
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . APIHandlers::get_token()
        ];

        // Logo Listing API
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
        $response_mainmenu = APIHandlers::get_api_response('GET', config('bcciconfig.CURD_API_URL') . 'getparentmenu', $headers);
        $response_mainmenudata = json_decode($response_mainmenu, true);
        //print_r($response_mainmenudata);exit;
        if ($response_mainmenudata['status']['code'] == '200' && !empty($response_mainmenudata['status']['code']) && !empty($response_data['payload'])) {
            $data_menu['records'] = $response_mainmenudata['payload'];
            //$data_menu['link'] = $response_data['payload']['links'];
            //$data_menu['current_page'] = $response_data['payload']['current_page'];
        } else {
            $data_menu['records'] = [];
            //$data_menu['link'] = [];
            //$data['current_page'] = 1;
            $respMessage = $response_mainmenudata['status']['message'];
        }
       // print_r($data_menu);exit;
        return view('admin.addmenu',["data" => $data['records'],"data_menu" => $data_menu['records']]);
    }

    public function bcciuserlist(Request $request){
        $api=new APIHandler();
        $response=$api->get_response_post("http://52.66.77.143/api/users/","","","GET");
        $json_array=json_decode($response);
        if($json_array->success==true){
            $userlist=$json_array->data;
        }
        else{
            $userlist=array();
        }
        return view('admin.bcciuserlist',["userlist"=>$userlist]);
    }

    public function bcciaddnewuser(Request $request){
        return view('admin.bcciaddnewuser');
    }

    public function bcciviewuser(Request $request){
        return view('admin.bcciviewuser');
    }

    public function bccieditnewuser(Request $request){
        return view('admin.bccieditnewuser');
    }

    public function bccilogin(Request $request){
        return view('admin.bccilogin');
    }

    public function bcciforgotpassword(Request $request){
        return view('admin.bcciforgotpassword');
    }

    public function bcciresetpassword(Request $request){
        return view('admin.bcciresetpassword');
    }

    public function termscondition(Request $request){
        return view('content.terms-condition');
    }

    public function savemenu(Request $request){
        $postData = $request->all();
        if($postData['action'] == "add"){
		if ($postData) {
            $validation = Validator::make($postData, [
                'menu_type' => 'required',
                'menu_name' => 'required',
                'slug' => 'required',
                'platform' => 'required',
            ]);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->errors())->withInput();
            } else {

                $headers = [
					'Accept:application/json',
					'Authorization: Bearer ' . APIHandlers::get_token()
				];
                $postData = [
                    'menu_type' => $request->input('menu_type'),
                    'menu_name' => $request->input('menu_name'),
                    'slug' => $request->input('slug'),
                    'platform' => $request->input('platform'),
                    'parent_menu' => $request->input('parent_menu') ?? 0,
                    'meta_title' => $request->input('meta_title'),
                    'meta_desc' => $request->input('meta_desc'),
                    'meta_keywords' => $request->input('meta_keywords'),
                    'order' => $request->input('order'),
                    'show_in_menu' => $request->input('show_in_menu') ?? 'no',
				];
				
                $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'menu', $headers, $postData);
                $json_array = json_decode($response, true);
                
                if ($json_array['status']['code'] == '200' && !(empty($json_array['status']['code']))) {
                    return redirect('addmenu')->with('success', $json_array['status']['message']);
                } else {
                    return redirect('addmenu')->with('error', $json_array['status']['message']);
                }
            }
        }
        }
        if($postData['action'] == "update"){
            $menu_id = $request->input('menu_id');
          //  print_r($request->input('show_in_menu'));exit;
            $postData = $request->all();
            if ($postData) {
                $validation = Validator::make($postData, [
                    'menu_type' => 'required',
                    'menu_name' => 'required',
                    'slug' => 'required',
                    'platform' => 'required',
                ]);
    
                if ($validation->fails()) {
                    return redirect()->back()->withErrors($validation->errors())->withInput();
                } else {
                $headers = [
                    'Accept:application/json',
                    'Authorization: Bearer ' . APIHandlers::get_token()
                ];

              
                $postData = [
                    'menu_type' => $request->input('menu_type'),
                    'menu_name' => $request->input('menu_name'),
                    'slug' => $request->input('slug'),
                    'platform' => $request->input('platform'),
                    'parent_menu' => $request->input('parent_menu') ?? 0,
                    'meta_title' => $request->input('meta_title'),
                    'meta_desc' => $request->input('meta_desc'),
                    'meta_keywords' => $request->input('meta_keywords'),
                    'order' => $request->input('order'),
                    'show_in_menu' => $request->input('show_in_menu') ?? 'no',
                ];
              
                 $response = APIHandlers::get_api_response('PUT', config('bcciconfig.CURD_API_URL') . 'menu/'.(int)$menu_id, $headers, $postData,true);
                 $json_array = json_decode($response, true);
                
                 if ($json_array['status']['code'] == '200' && !(empty($json_array['status']['code']))) {
                     return redirect('addmenu')->with('success', $json_array['status']['message']);
                 } else {
                     return redirect('addmenu')->with('error', $json_array['status']['message']);
                 }
                }
            }
        }
    }
    public function deleteMenu(Request $request)
    {
        $menu_id = $request->input('id');
        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Accept: application/json',
            'Authorization: Bearer ' . APIHandlers::get_token()
        ];
       
        $response = APIHandlers::get_api_response('DELETE', config('bcciconfig.CURD_API_URL') . 'menu/'.$menu_id, $headers);
        $json_array = json_decode($response, true);

       return $json_array;
    }
}
