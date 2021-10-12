<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\APIHandlers;

class CommonStatusController extends Controller
{
    function statusUpdate(Request $request)
    {

        $postdata = '';
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') .'statusChange';
        $token = APIHandlers::get_token();
        $headers = [
            'Authorization: Bearer ' . $token,
            'Accept:application/json',
            'Content-Type: application/json'
        ];
        $postfields =[
            "type" => $request->type,
            'content_id' => $request->id,
            'is_publish' => $request->status,
        ];
       
        $response = APIHandlers::get_api_response($method, $url, $headers, json_encode($postfields));
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            return $response_data['status']['message'];
        } else {
            return $response_data['status']['message'];
        }
   
   }
}
