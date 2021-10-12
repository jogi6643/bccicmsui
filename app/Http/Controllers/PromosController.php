<?php

namespace App\Http\Controllers;

use App\Http\APIHandlers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Isset_;
use PhpParser\Node\Stmt\Catch_;

class PromosController extends Controller
{
    public function index(Request $request)
    {
        return view('content.promosList');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'photo_editor' => 'required',
                'metadata' => 'required',                
            ],
        );

        $postdata = $request->all() ?? null;

        if (isset($request->ref)) {
            $ref = $request->ref;
            $arr = [];
            foreach ($ref as $key => $value) {
                $ids = explode("</h2>", $value);
                $tit = strip_tags($ids[0]);
                $articleid = explode("ID:", $ids[1]);
                $articleid = strip_tags($articleid[1]);
                $arr[$key]['id'] = $articleid;
                $arr[$key]['title'] = $tit;
                $arr[$key]['type'] = $postdata['type_reference'];
            }
            $ref =  json_encode($arr) ?? null;
        } else {
            $ref = null;
        }
        // End Relete reference

        // Start Content Refrence 
        if (isset($request->content)) {
            $arr = [];
            $cont = $request->content;
            foreach ($cont as $key => $value) {
                $ids = explode("</h2>", $value);
                $tit = strip_tags($ids[0]);
                $articleid = explode("ID:", $ids[1]);
                $articleid = strip_tags($articleid[1]);
                $arr[$key]['id'] = $articleid;
                $arr[$key]['title'] = $tit;
                $arr[$key]['type'] = $postdata['type_content'];
            }
            $cont =  json_encode($arr) ?? null;
        } else {
            $cont = null;
        }
        // End Content References
        $tags = $request->tags_promos ?? null;
        if ($tags != null) {
            $t = [];
            foreach ($tags as $key => $v) {
                $t[$key]['id'] = $key;
                $t[$key]['label'] = $v;
            }
            $tags = json_encode($t);
        } else {
            $tags = null;
        }

        $postfields = [
            'title' => $postdata['title'] ?? null,
            'url_segment' => $postdata['titleslug'] ?? null,
            'language' => $postdata['language'] ?? null,
            'description' => $postdata['description'] ?? null,
            'promo_url' => $postdata['promo_url'] ?? null,

            'display_date' => $request->publish_date . ' ' . $request->publish_time ?? null,

            'titleslug' => $postdata['titleslug'] ?? null,
            'location' => $postdata['promoslocationsearch'] ?? null,
            'latitude' => $postdata['latitudepromos'] ?? null,
            'longitude' => $postdata['longitudepromos'] ?? null,
            'current_status' => $postdata['current_status'] ?? null,
            'metadata' => $postdata['metadata'] ?? null,
            'photo_editor' => $postdata['photo_editor'] ?? null,
            'references' => $ref ?? null,
            'related' =>  $cont ?? null,
            'tags' => $tags ?? null,
            'publish_date' => $request->publish_date . ' ' . $request->publish_time ?? null,
            'expiryDate' => $request->expiryDate . ' ' . $request->expiryTime ?? null,
        ];


        $route = 'contentList/promo';
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'promos';
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        try {
            $response = APIHandlers::get_api_response($method, $url, $headers, $postfields);
            $response_data = json_decode($response, true);
            // dd($response_data);
            if ($response_data['status']['code'] == '200') {
                return redirect($route)->with('success', $response_data['status']['message']);
            } else {
                return redirect($route)->with('error', $response_data['status']['message']);
            }
        } catch (Exception $exception) {
            return redirect($route)->with('error', "Error : " . $exception->getMessage());
        }
    }

    public function fetchpromo(Request $request)
    {
        $method = 'GET';
        $route = 'contentList/promo';
        $url = config('bcciconfig.CURD_API_URL') . 'promos/' . $request->id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);

        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return  response()->json(array('data' => $response_data['payload']));
            } else {
                return redirect($route)->with('error', $response_data['status']['message']);
            }
        } else {
            info('Promo Edit : ' . $response_data['message']);
            return redirect($route)->with('error', $response_data['message']);
        }
    }
    public function delete($id)
    {
        $route = 'contentList/promo';
        $method = 'DELETE';
        $url = config('bcciconfig.CURD_API_URL') . 'promos/' . $id;
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
            info('Promos Delete : ' . $response_data['message']);
            return redirect($route)->with('error', $response_data['message']);
        }
    }

    public function edit($id)
    {
        $route = 'contentList/promo';
        $method = 'GET';
        $url = config('bcciconfig.CURD_API_URL') . 'promos/' . $id;
        $token = APIHandlers::get_token();
        $headers = [
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ];
        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        //dd($response_data);
        $language = language();
        $status   = status();
        if (!empty($response_data['status']['code'])) {

            $edit_data =  $response_data['payload'];
            $publishtimestamp = isset($response_data['payload']['publish_date']);
            $splitTimeStamp = explode(" ", $publishtimestamp);
            $publishdate = $splitTimeStamp[0] ?? '';
            $publishtime = $splitTimeStamp[1] ?? '';

            $expiretimestamp = isset($response_data['payload']['expiry_date']);
            $splitTimeStamp = explode(" ", $expiretimestamp);
            $expiredate = $splitTimeStamp[0] ?? '';
            $expiretime = $splitTimeStamp[1] ?? '';
            //    dd($expiredate);
            $action  = 'edit';
            if ($response_data['status']['code'] == '200') {
                return view('content.edit-promos', compact('edit_data', 'publishdate', 'publishtime', 'expiredate', 'expiretime', 'language', 'status'));
            } else {
                return redirect($route)->with('error', $response_data['status']['message']);
            }
        } else {
            info('Promos Edit : ' . $response_data['message']);
            return redirect($route)->with('error', $response_data['message']);
        }
    }

    public function update(Request $request)
    {
        $postdata = $request->all() ?? null;
        $tags = $request->tags ?? null;
        if ($tags != null) {

            $t = [];
            foreach ($tags as $key => $v) {
                $t[$key]['id'] = $key;
                $t[$key]['label'] = $v;
            }
            $tags = json_encode($t);
        } else {
            $tags = null;
        }
        // Relete refernce
        if (isset($request->ref) && isset($postdata['type_reference'])) {

            $ref = $request->ref;

            $arr = [];
            foreach ($ref as $key => $value) {

                $ids = explode("</h2>", $value);
                $tit = strip_tags($ids[0]);
                $articleid = explode("ID:", $ids[1]);
                $articleid = strip_tags($articleid[1]);
                $arr[$key]['id'] = $articleid;
                $arr[$key]['title'] = $tit;
                $arr[$key]['type'] = $postdata['type_reference'];
            }

            if (isset($request->refeedit)) {

                $ref = json_encode(array_merge(json_decode($request->refeedit, true), $arr));

                // New code for remove click from 
                $removeids = explode(",", $request->removerefeedit1);
                $arr = [];
                foreach (json_decode($ref) as $key => $value) {
                    if (!in_array($value->id, $removeids)) {
                        $arr[$key]['id'] = $value->id;
                        $arr[$key]['title'] = $value->title;
                        $arr[$key]['type'] = $value->type;
                    }
                }
                $ref =  json_encode(array_values($arr)) ?? null;
                // End New code for remove click from
            } else {

                $ref =  json_encode($arr) ?? null;
            }
        } else {
            if (isset($request->refeedit)) {
                // only edit data submit
                $ref = $request->refeedit;

                // New code for remove click from 

                $removeids = explode(",", $request->removerefeedit1);

                $arr = [];
                foreach (json_decode($ref) as $key => $value) {
                    if (!in_array($value->id, $removeids)) {
                        $arr[$key]['id'] = $value->id;
                        $arr[$key]['title'] = $value->title;
                        $arr[$key]['type'] = $value->type;
                    }
                }
                $ref =  json_encode(array_values($arr)) ?? null;

                // End New code for remove click from
            } else {
                // nothing send
                $ref = null;
            }
        }

        // End Relete reference
        // Start Content Refrence 
        if (isset($request->content) && isset($postdata['type_content'])) {
            $arr = [];
            $cont = $request->content;
            foreach ($cont as $key => $value) {
                $ids = explode("</h2>", $value);
                $tit = strip_tags($ids[0]);
                $articleid = explode("ID:", $ids[1]);
                $articleid = strip_tags($articleid[1]);
                $arr[$key]['id'] = $articleid;
                $arr[$key]['title'] = $tit;
                $arr[$key]['type'] = $postdata['type_content'];
            }
            if (isset($request->contedit)) {

                $cont = json_encode(array_merge(json_decode($request->contedit, true), $arr));
                // New code for remove click from 
                $removeids = explode(",", $request->removeconteedit);
                $arr = [];
                foreach (json_decode($cont) as $key => $value) {
                    if (!in_array($value->id, $removeids)) {
                        $arr[$key]['id'] = $value->id;
                        $arr[$key]['title'] = $value->title;
                        $arr[$key]['type'] = $value->type;
                    }
                }
                $ref =  json_encode(array_values($arr)) ?? null;
                // End New code for remove click from
                // Both are submit

            } else {
                // New submit data
                $cont =  json_encode($arr) ?? null;
            }
        } else {

            if (isset($request->contedit)) {
                // only edit data submit
                $cont = $request->contedit;
                // New code for remove click from 

                $removeids = explode(",", $request->removeconteedit);

                $arr = [];
                foreach (json_decode($cont) as $key => $value) {
                    if (!in_array($value->id, $removeids)) {
                        $arr[$key]['id'] = $value->id;
                        $arr[$key]['title'] = $value->title;
                        $arr[$key]['type'] = $value->type;
                    }
                }

                if (isset($request->refeedit)) {

                    $ref = json_encode(array_merge(json_decode($request->refeedit, true), $arr));

                    // New code for remove click from 
                    $removeids = explode(",", $request->removerefeedit1);
                    $arr = [];
                    foreach (json_decode($ref) as $key => $value) {
                        if (!in_array($value->id, $removeids)) {
                            $arr[$key]['id'] = $value->id;
                            $arr[$key]['title'] = $value->title;
                            $arr[$key]['type'] = $value->type;
                        }
                    }
                    $ref =  json_encode(array_values($arr)) ?? null;
                    // End New code for remove click from

                    // Both are submit

                } else {
                    // New submit data
                    $ref =  json_encode($arr) ?? null;
                }
            } else {
                if (isset($request->refeedit)) {
                    // only edit data submit
                    $ref = $request->refeedit;

                    // New code for remove click from 

                    $removeids = explode(",", $request->removerefeedit1);

                    $arr = [];
                    foreach (json_decode($ref) as $key => $value) {
                        if (!in_array($value->id, $removeids)) {
                            $arr[$key]['id'] = $value->id;
                            $arr[$key]['title'] = $value->title;
                            $arr[$key]['type'] = $value->type;
                        }
                    }
                    $ref =  json_encode(array_values($arr)) ?? null;

                    // End New code for remove click from
                } else {
                    // nothing send
                    $ref = null;
                }
            }

            // End Relete reference
            // Start Content Refrence 
            if (isset($request->content) && isset($postdata['type_content'])) {
                $arr = [];
                $cont = $request->content;
                foreach ($cont as $key => $value) {
                    $ids = explode("</h2>", $value);
                    $tit = strip_tags($ids[0]);
                    $articleid = explode("ID:", $ids[1]);
                    $articleid = strip_tags($articleid[1]);
                    $arr[$key]['id'] = $articleid;
                    $arr[$key]['title'] = $tit;
                    $arr[$key]['type'] = $postdata['type_content'];
                }
                if (isset($request->contedit)) {

                    $cont = json_encode(array_merge(json_decode($request->contedit, true), $arr));
                    // New code for remove click from 
                    $removeids = explode(",", $request->removeconteedit);
                    $arr = [];
                    foreach (json_decode($cont) as $key => $value) {
                        if (!in_array($value->id, $removeids)) {
                            $arr[$key]['id'] = $value->id;
                            $arr[$key]['title'] = $value->title;
                            $arr[$key]['type'] = $value->type;
                        }
                    }
                    $ref =  json_encode(array_values($arr)) ?? null;
                    // End New code for remove click from
                    // Both are submit

                } else {
                    // New submit data
                    $cont =  json_encode($arr) ?? null;
                }
            } else {

                if (isset($request->contedit)) {
                    // only edit data submit
                    $cont = $request->contedit;
                    // New code for remove click from 

                    $removeids = explode(",", $request->removeconteedit);

                    $arr = [];
                    foreach (json_decode($cont) as $key => $value) {
                        if (!in_array($value->id, $removeids)) {
                            $arr[$key]['id'] = $value->id;
                            $arr[$key]['title'] = $value->title;
                            $arr[$key]['type'] = $value->type;
                        }
                    }
                    $cont =  json_encode(array_values($arr)) ?? null;

                    // End New code for remove click from
                } else {
                    // nothing send
                    $cont = null;
                }
            }

            $postfields = [
                'promo_id' => $postdata['promo_id'],
                'title' => $postdata['title'] ?? null,
                'url_segment' => $postdata['titleslug'] ?? null,
                'language' => $postdata['language'] ?? null,
                'description' => $postdata['description'] ?? null,
                'promo_url' => $postdata['promo_url'] ?? null,
                'display_date' => $request->publish_date . ' ' . $request->publish_time ?? null,
                'publish_by' => $request->expiryDate . ' ' . $request->expiryTime ?? null,
                'meta_languages' => $postdata['expiry_date'] ?? null,
                'titleslug' => $postdata['titleslug'] ?? null,
                'location' => $postdata['promoslocationsearch'] ?? null,
                'latitude' => $postdata['latitudepromos'] ?? null,
                'longitude' => $postdata['longitudepromos'] ?? null,
                'current_status' => $postdata['current_status'] ?? null,
                'metadata' => $postdata['metadata'] ?? null,
                'photo_editor' => $postdata['photo_editor'] ?? null,
                'references' => $ref ?? null,
                'related' =>  $cont ?? null,
                'tags' => $tags ?? null,
                'publish_date' => $request->publish_date . ' ' . $request->publish_time ?? null,
                'expiryDate' => $request->expiryDate . ' ' . $request->expiryTime ?? null,
            ];

            $route = 'contentList/promo';
            $method = 'POST';
            $url = config('bcciconfig.CURD_API_URL') . 'promos/update';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token
            ];
            $response = APIHandlers::get_api_response($method, $url, $headers, $postfields);
            $response_data = json_decode($response, true);
            if (!empty($response_data['status']['code'])) {

                if ($response_data['status']['code'] == '200') {
                    return redirect($route)->with('success', $response_data['status']['message']);
                } else {
                    return redirect($route)->with('error', $response_data['status']['message']);
                }
            } else {
                info('Promos Edit : ' . $response_data['message']);
                return redirect($route)->with('error', $response_data['message']);
            }
        }
    }
    public function Bulkdelete(Request $request)
    {
        $token = APIHandlers::get_token();
        $route = 'contentList/promo';
        $url = config('bcciconfig.CURD_API_URL') . 'promos/bulk_delete';
        $headers = [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ];

        $id_array = array_map('intval', explode(',', $request->input('promos_id')));

        $response = APIHandlers::get_api_response('POST', $url, $headers, json_encode(['promo_ids' => $id_array]));
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return redirect($route)->with('success', $response_data['status']['message']);
            } else {
                return redirect($route)->with('error', $response_data['status']['message']);
            }
        } else {
            return redirect($route)->with('error', $response_data['message']);
        }
    }

    public function filter(Request $request)
    {
        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'promos/list';
        $headers = [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        $tags = !empty($request->tags) ? explode(",", $request->tags) : '';
        $lang = !empty($request->lang) ? explode(",",  $request->lang) : '';
        $current_status = !empty($request->current_status) ? explode(",", $request->current_status) : '';

        $postData = [
            "page_number"  => $request->page ?? 1,
            "per_page_count" => $request->max_items,
            "filter_by_source" => $request->filter_by_source,
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
      
        $json = json_encode($postData);
        $response = APIHandlers::get_api_response($method, $url, $headers, $json);
        $response_data = json_decode($response, true);
       
        if (!empty($response_data) && $response_data['status']['code'] == '200') {
            return response()->json([
                'listhtml' => view('content.promosTable', ['promos' => $response_data, 'status' => true])->render(),
                'gridehtml' => view('content.promosGride', ['promos' => $response_data, 'status' => true])->render(),
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
}
