<?php

namespace App\Http\Controllers;

use App\Http\APIHandlers;
use Exception;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function searchContent(Request $request, $content_type)
    {
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . $content_type . '/list';
        $token = APIHandlers::get_token();
        $headers = [
            'Authorization: Bearer ' . $token,
            'Accept:application/json',
            'Content-Type: application/json'
        ];

        $postdata = [];
        $postdata['max_items'] = (int)$request->input('max_items') ?? 24;
        $postdata['sort_by'] = $request->input('sort_by') ?? 'Last updated';
        $postdata['order'] = $request->input('order') ?? 'desc';
        $postdata['content_from'] = $request->input('content_from') ?? 'All time';
        $postdata['page_number'] = $request->input('go_to') ?? 1;

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
        } else {
            $articles = [];
        }
        return response()->json([
            'html' => view('content.contents-list-table', [
                'contents' => $articles,
                'content_type' => $content_type,
            ])->render()
        ]);
    }

    public function contentList(Request $request, $content_type)
    {
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . $content_type;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);

        if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
            $articles = $response_data['payload']['data'];
        } else {
            $articles = [];
        }

        return view('content.content-view', [
            'contents' => $articles,
            'content_type' => $content_type
        ]);
    }

    public function deleteContent($content_type, $id)
    {
        $route = 'contentList/' . $content_type;
        $method = 'DELETE';
        $url = config('bcciconfig.CURD_API_URL') . $content_type . '/' . $id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        try {

            $response = APIHandlers::get_api_response($method, $url, $headers);
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

    public function bulkDeleteContent(Request $request, $content_type)
    {
        $route = 'contentList/' . $content_type;
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

    public function commonSearchForReferenceAndContent(Request $request){

        $method = "POST";
        $url = config('bcciconfig.CURD_API_URL') . "search";
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $postfields = [
            'type' => $request->input('serarch_value')
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers, $postfields);
        $response_data = json_decode($response, true);


        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return $response_data['payload'];
            } else {
                return $response_data['payload'];
            }
        } else {
            return $response_data['payload'];
        }
    }
}