<?php

namespace App\Http\Controllers;

use App\Http\APIHandlers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class BcciUserController extends Controller
{
    //

    public function __construct()
    {
        session(['token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMzE1NDA4YmM4NTdkYjY0MWMzZDQ0NGM3NjQxZTVmMGQ1NzZkMmNjZDFlNzE2YWVjYTUyNDQxNDM5MDUxZmViN2JhNmU0MTZmMjVkOWVmMDMiLCJpYXQiOjE2Mjk0NTQxNTQuODg1Mjg3LCJuYmYiOjE2Mjk0NTQxNTQuODg1MjksImV4cCI6MTY2MDk5MDE1NC44Nzk4MjksInN1YiI6IjYiLCJzY29wZXMiOltdfQ.Wd1Irk_9pk4Qq6HUmVQfsBpqTjHto5MB2mLEkJZiW7E7kabIkKSypaT98XAchQPUXtezSriuaeP0-BmoDG6fUd8orLbfl_zNcuRC4gi6hS-dhIw6277-Re47hRtNeVrFE4S_cVU0cKOkM_TgcPak6F6oQtmS5qME6scJlTv1LDra-HO_Y-3YNaR0hRkNPNHCg2PzOwZt3nBGir9uyGiXGgRlZosIxC35Ta9WxXmMCDQfdFKqzEJVrCvnEA4Wr83X7LSDWQ8gt8LQq5rKPx7aimYZGYEanIdyYIrHH2q7B0ruM_qfxt6gOWmxAkCwDsAz0omzAGUoJAkwdRUCp98N9Qk2ShEu_zOMs66Gv65pUJE-eSMtk1e_GqytbQwP8WLHBKO_PO_1Tb4bhDnfJ8UY_d_EOhYme9czlUOD_4GPOlSEAbnmrdqq76bfGqmKGgqwZg56EBfadVToSQJQiCQS7q2JaTsIwKuFmc5zX6L-3CpIQ782ejjW70dOm-5LiTw79W-Q_1dkIqExnBWnV8_ZaeNN3FhI3kFB5g-yHA7iUuMWB82ASVJVKhTs5JJqHK0mivd-yuTmPHiEQOX3xa5otu8ifq9aYf39gpTQe1vLDxCs1stEpcMZMLJzfmXWMQjiLXj9HH0oM2ER13r4F21WG7nQikAJQKSpi8aOc8ubaB8']);
    }

    public function userlist(Request $request, $id = 1)
    {

        $token = session('token');

        $url = config('bcciconfig.CURD_API_URL') . "users?page=" . $id;
        $method = "GET";
        $headers = [
            'Authorization: Bearer ' . $token,
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);

        $json_array = json_decode($response, true);

        if ($json_array['status']['code'] == '200') {
            $data['userlisting'] = (object)$json_array['payload']['data'];
            $data['link'] = (object)$json_array['payload']['links'];
           
            
        } else {
            $data = array();
        }

        return view('bcciUser.bcciuserlist', ["userlist" => $data,"activePage"=>$id]);
    }

   
}
