<?php

namespace App\Http\Controllers;

use App\Http\APIHandlers;
use Illuminate\Http\Request;

class PrivilegesController extends Controller
{
    public function __construct()
    {
        session(['token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMzE1NDA4YmM4NTdkYjY0MWMzZDQ0NGM3NjQxZTVmMGQ1NzZkMmNjZDFlNzE2YWVjYTUyNDQxNDM5MDUxZmViN2JhNmU0MTZmMjVkOWVmMDMiLCJpYXQiOjE2Mjk0NTQxNTQuODg1Mjg3LCJuYmYiOjE2Mjk0NTQxNTQuODg1MjksImV4cCI6MTY2MDk5MDE1NC44Nzk4MjksInN1YiI6IjYiLCJzY29wZXMiOltdfQ.Wd1Irk_9pk4Qq6HUmVQfsBpqTjHto5MB2mLEkJZiW7E7kabIkKSypaT98XAchQPUXtezSriuaeP0-BmoDG6fUd8orLbfl_zNcuRC4gi6hS-dhIw6277-Re47hRtNeVrFE4S_cVU0cKOkM_TgcPak6F6oQtmS5qME6scJlTv1LDra-HO_Y-3YNaR0hRkNPNHCg2PzOwZt3nBGir9uyGiXGgRlZosIxC35Ta9WxXmMCDQfdFKqzEJVrCvnEA4Wr83X7LSDWQ8gt8LQq5rKPx7aimYZGYEanIdyYIrHH2q7B0ruM_qfxt6gOWmxAkCwDsAz0omzAGUoJAkwdRUCp98N9Qk2ShEu_zOMs66Gv65pUJE-eSMtk1e_GqytbQwP8WLHBKO_PO_1Tb4bhDnfJ8UY_d_EOhYme9czlUOD_4GPOlSEAbnmrdqq76bfGqmKGgqwZg56EBfadVToSQJQiCQS7q2JaTsIwKuFmc5zX6L-3CpIQ782ejjW70dOm-5LiTw79W-Q_1dkIqExnBWnV8_ZaeNN3FhI3kFB5g-yHA7iUuMWB82ASVJVKhTs5JJqHK0mivd-yuTmPHiEQOX3xa5otu8ifq9aYf39gpTQe1vLDxCs1stEpcMZMLJzfmXWMQjiLXj9HH0oM2ER13r4F21WG7nQikAJQKSpi8aOc8ubaB8']);
    }

    public function getPrivilegesList(Request $request)
    {
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'privilegesUser';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);

        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $privileges = $response_data['payload'];
        } else {
            $privileges = [];
        }

        $menu = [
            'upload_content' => [],
            'bucket' => ['menu'],
            'content_management' => ['articles', 'photo', 'playlist', 'videos', 'audios', 'promos'],
            'user_management' => ['user_list', 'assign_role'],
            'content_curation' => ['live_streaming', 'vod_content'],
            'tray_management' => [],
            'tray_sorting' => [],
            'other_menu' => [],
            'blogging' => ['live_blogging', 'blogging_icon'],
        ];

        return view('privileges.privileges', [
            'privileges' => $privileges,
            'menu' => $menu,
        ]);
    }

    public function searchPrivilege(Request $request)
    {
        $role_id = $request->input('role_id');

        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'privilegesUser';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);

        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $privileges = collect($response_data['payload'])
                ->where('role_id', $role_id)
                ->first();
        } else {
            $privileges = [];
        }

        return $privileges;
    }

    public function updatePrivileges(Request $request)
    {
        $token = APIHandlers::get_token();

        $postdata = $request->all() ?? null;

        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'privilegesUser';
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $postfields = [
            'role_name' => $postdata['role_name'] ?? null,
            'role_status' => 1,
            'read' => $postdata['read_list'] ?? null,
            'write' => $postdata['write_list'] ?? null,
            'country_nationality' => 'India',
            'user_privileg_status' => $postdata['user_role'],
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers, $postfields);
        $response_data = json_decode($response, true);

        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return redirect('privilegeslist')->with('success', $response_data['status']['message']);
            } else {
                return redirect('privilegeslist')->with('error', $response_data['status']['message']);
            }
        } else {
            return redirect('privilegeslist')->with('error', $response_data['message']);
        }
    }

}
