<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\APIHandlers;

class DashboardController extends Controller{
    //

    public function index(Request $request){
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'dashboard';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
    //   dd( $response_data);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $articles = $response_data['payload']['articles'];
            $videos = $response_data['payload']['videos'];
            $images = $response_data['payload']['images'];
            $playlists = $response_data['payload']['playlists'];
            $promos = $response_data['payload']['promos'];
            $bios = $response_data['payload']['bios'];
        } else {
            $articles = [];
            $videos = [];
            $images =[];
            $playlists = [];
            $promos =[];
            $bios = [];
        }
        
        return view('admin.dashboard', [
            'articles' => $articles,
            'videos' => $videos,
            'images' => $images,
            'playlists' => $playlists,
            'promos' => $promos,
            'bios' => $bios,
        ]);
    }

    public function content(){

        return view('admin.content');
    }
}
