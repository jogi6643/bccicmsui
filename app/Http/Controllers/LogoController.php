<?php

namespace App\Http\Controllers;

use App\Http\APIHandlers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogoController extends Controller{
    
    public function index(Request $request, $page=1){
        $respMessage = '';
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . APIHandlers::get_token()
        ];

        // Logo Listing API
        $response = APIHandlers::get_api_response('GET', config('bcciconfig.CURD_API_URL') . 'logo?page=' . $page, $headers);
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

        // Country API
        $country = APIHandlers::get_api_response('GET', config('bcciconfig.CURD_API_URL') . 'listCountry', $headers);
        $countryData = json_decode($country, true);
        if ($countryData['status']['code'] == '200' && !empty($countryData['status']['code']) && !empty($countryData['payload'])) {
            $data['countryData'] = $countryData['payload'];
        } else {
            $data['countryData'] = [];
        }

        // Category API
        $category = APIHandlers::get_api_response('GET', config('bcciconfig.CURD_API_URL') . 'category', $headers);
        $categoryData = json_decode($category, true);
        if ($categoryData['status']['code'] == '200' && !empty($categoryData['status']['code']) && !empty($categoryData['payload'])) {
            $data['categoryData'] = $categoryData['payload'];
        } else {
            $data['categoryData'] = [];
        }

        // Platform API
        $category = APIHandlers::get_api_response('GET', config('bcciconfig.CURD_API_URL') . 'platform', $headers);
        $categoryData = json_decode($category, true);
        if ($categoryData['status']['code'] == '200' && !empty($categoryData['status']['code']) && !empty($categoryData['payload'])) {
            $data['platformData'] = $categoryData['payload'];
        } else {
            $data['platformData'] = [];
        }

        return view('admin.logo', ["data" => $data, 'page' => $page, 'respMessage' => $respMessage]);
    }

    public function save(Request $request) {
        
        $postData = $request->all();
		if ($postData) {
            $validation = Validator::make($postData, [
                'title' => 'required',
                'logo' => 'required',
                'publish_date' => 'required',
                'expiry_date' => 'required',
                'platform' => 'required',
                'category' => 'required',
                'location' => 'required',
                'country' => 'required',
            ]);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->errors())->withInput();
            } else {

                $headers = [
					'Accept:application/json',
					'Authorization: Bearer ' . APIHandlers::get_token()
				];
                $postData = [
                    'name' => $request->input('title'),
                    'photo' => curl_file_create($request->file('logo'), $request->file('logo')->getMimeType(), $request->file('logo')->getClientOriginalName()),
                    'start_date' => $request->input('publish_date').' '.$request->input('start_time'),
                    'end_date' => $request->input('expiry_date').' '.$request->input('end_time'),
                    'platform' => $request->input('platform'),
                    'category' => $request->input('category'),
                    'location' => $request->input('location'),
                    'latitude' => $request->input('latitude'),
                    'logitude' => $request->input('logitude'),
                    'country' => json_encode($request->input('country')),
				];
    
                $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'logo', $headers, $postData);
                $json_array = json_decode($response, true);
                
                if ($json_array['status']['code'] == '200' && !(empty($json_array['status']['code']))) {
                    return redirect('logo')->with('success', $json_array['status']['message']);
                } else {
                    return redirect('logo')->with('error', $json_array['status']['message']);
                }
            }
        }
    }

    public function delete(Request $request)
    {
        $logo_id = $request->input('logo_id');
        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Accept: application/json',
            'Authorization: Bearer ' . APIHandlers::get_token()
        ];
        $response = APIHandlers::get_api_response('DELETE', config('bcciconfig.CURD_API_URL') . 'logo/' . $logo_id, $headers);
        $json_array = json_decode($response, true);

        if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
            return redirect('logo')->with('success', $json_array['status']['message']);
        } else {
            return redirect('logo')->with('error', $json_array['status']['message']);
        }
    }

    public function view(Request $request)
    {
        $logo_id = $request->input('logo_id');
        $type = $request->input('type');
        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Accept: application/json',
            'Authorization: Bearer ' . APIHandlers::get_token()
        ];
        $response = APIHandlers::get_api_response('GET', config('bcciconfig.CURD_API_URL') . 'logo/' . $logo_id, $headers);
        $json_array = json_decode($response, true);
        if($type == 'view')
            if ($json_array['status']['code'] == '200' && !(empty($json_array['status']['code']) && !empty($response_data['payload']))) {
                $json_array['payload']['start_date'] = $json_array['payload']['start_date'] ? date('d M Y h:i A', strtotime($json_array['payload']['start_date'])) : '';  
                $json_array['payload']['end_date'] = $json_array['payload']['end_date'] ? date('d M Y h:i A', strtotime($json_array['payload']['end_date'])) : '';  
                $json_array['payload']['platform'] = $json_array['payload']['platform'] ? strtoupper($json_array['payload']['platform']) : '';  
                $json_array['payload']['category'] = $json_array['payload']['category'] ? ucwords(str_replace('_', ' ', $json_array['payload']['category'])) : '';  
                $json_array['payload']['location'] = $json_array['payload']['location'] ? ucwords($json_array['payload']['location']) : '';  
            }
        
        if($type == 'edit')
            if ($json_array['status']['code'] == '200' && !(empty($json_array['status']['code']) && !empty($response_data['payload']))) {
                $json_array['payload']['start_time'] = $json_array['payload']['start_date'] ? date('H:i', strtotime($json_array['payload']['start_date'])) : '';  
                $json_array['payload']['end_time'] = $json_array['payload']['end_date'] ? date('H:i', strtotime($json_array['payload']['end_date'])) : '';  
                $json_array['payload']['start_date'] = $json_array['payload']['start_date'] ? date('Y-m-d', strtotime($json_array['payload']['start_date'])) : '';  
                $json_array['payload']['end_date'] = $json_array['payload']['end_date'] ? date('Y-m-d', strtotime($json_array['payload']['end_date'])) : '';  
            }
        return json_encode($json_array);
    }

    public function update(Request $request) {
        
        $postData = $request->all();
		if ($postData) {
            
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . APIHandlers::get_token()
            ];
            $logo_id = $request->input('logo_id');
            $photo = $request->has('logo') ? curl_file_create($request->file('logo'), $request->file('logo')->getMimeType(), $request->file('logo')->getClientOriginalName()) : $request->input('image_url'); 
            $postData = [
                'name' => $request->input('title'),
                'photo' => $photo,
                'start_date' => $request->input('publish_date').' '.$request->input('start_time'),
                'end_date' => $request->input('expiry_date').' '.$request->input('end_time'),
                'platform' => $request->input('platform'),
                'category' => $request->input('category'),
                'location' => $request->input('location'),
                'latitude' => $request->input('latitude'),
                'logitude' => $request->input('logitude'),
                'country' => json_encode($request->input('country')),
            ];
            
            return $response = APIHandlers::get_api_response('POST', config('bcciconfig.CURD_API_URL') . 'logo/update/' . $logo_id, $headers, $postData);
        }
    }
}
