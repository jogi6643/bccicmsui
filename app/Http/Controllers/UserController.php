<?php

namespace App\Http\Controllers;

use App\Http\APIHandlers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function __construct()
    {
    }

    /**
     * view user listing page.
     *
     * @param array $request and $id
     * @return \Illuminate\View\View
     */
    public function userlist(Request $request, $id = 1)
    {
        $token = APIHandlers::get_token();

        $url = config('bcciconfig.CURD_API_URL') . "users?page=" . $id;
        $method = "GET";

        $headers = [
            'Cache-Control: no-cache',
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token,
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);

        $json_array = json_decode($response, true);

        // dd($json_array);

        if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
            $data['userlisting'] = (object)$json_array['payload']['data'];
            $data['link'] = (object)$json_array['payload']['links'];
        } else {
            $data = array();
        }

        return view('users.userlist', ["userlist" => $data,'activePage'=>$id]);
    }

    /**
     * add new user page.
     *
     * @param
     * @return \Illuminate\View\View
     */
    public function addNewUser()
    {
        $data['country'] = countryList();

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
            $data['privileges'] = $response_data['payload'];
        } else {
            $data['privileges'] = [];
        }
        // dd($privileges);

        return view('admin.bcciaddnewuser')->with($data);
    }

    /**
     * save new user.
     *
     * @param array $request
     * @return \Illuminate\View\View
     */
    public function saveNewUser(Request $request)
    {

        $postData = $request->all();
        $file = $request->file('photo');
        $token = APIHandlers::get_token();

        if ($postData) {

            $validation = Validator::make(
                $request->all(), [
                'user_login' => 'required|min:3',
                'display_name' => 'required|min:3',
                'user_email' => 'required|email',
                'user_contact' => 'required|max:10',
                'user_pass' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'user_confirm_pass' => 'required|same:user_pass',
                'country' => 'required',
                'location' => 'required',
                'user_role' => 'required',
                'user_status' => 'required',
                // 'photo' => 'exclude_if:hrequired',
                'photo' => 'image|mimes:jpeg,bmp,png,jpg|max:300',
            ],
                [
                    'user_pass.same' => 'Confirm password should match the Password',
                    'user_pass.regex' => 'The password should be consist of alpha numeric and 1 special character',
                    'user_confirm_pass.regex' => 'The password should be consist of alpha numeric and 1 special character'
                ]
            );

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->errors())->withInput();
            } else {

                $url = config('bcciconfig.CURD_API_URL') . "users/";
                $method = "POST";

                $headers = [
                    'Cache-Control: no-cache',
                    'Content-Type: multipart/form-data',
                    'Authorization: Bearer ' . $token,
                ];

                $post_fields = [
                    'user_title' => $postData['user_title'],
                    'user_first_name' => $postData['user_login'],
                    'user_last_name' => $postData['display_name'],
                    'user_email_id' => $postData['user_email'],
                    'user_phone_number' => $postData['user_contact'],
                    'user_password' => $postData['user_pass'],
                    'user_address' => $postData['location'],
                    'user_role_id' => $postData['user_role'],
                    'user_status' => $postData['user_status'],
                    'c_password' => $postData['user_confirm_pass'],
                    'user_country_id' => $postData['country'],
                    'user_photo_url' => ($request->file('photo')) ? curl_file_create($request->file('photo'), $request->file('photo')->getMimeType(), $request->file('photo')->getClientOriginalName()) : null
                ];

                $response = APIHandlers::get_api_response($method, $url, $headers, $post_fields);

                $json_array = json_decode($response, true);
                if ($json_array['status']['code'] == '200') {
                    return redirect('bcciuserlist')->with('success', "Data Added Successfully.");
                }else if ($json_array['status']['code'] == '201') {
                        // echo "<pre>";print_r($json_array['payload'][0]);exit;
                    return redirect('bcciaddnewuser')->with('error', $json_array['payload'][0])->withInput();
                } else {
                    return redirect('bcciaddnewuser')->with('error', $json_array['status']['message'][0])->withInput();
                }
            }
        }
    }

    /**
     * view particular user for edit.
     *
     * @param  @id
     * @return \Illuminate\View\View
     */
    public function editUser(Request $request, $id)
    {

        $token = APIHandlers::get_token();

        $url = config('bcciconfig.CURD_API_URL') . "users/" . $id;
        $method = "GET";

        $headers = [
            'Cache-Control: no-cache',
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token,
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);

        $json_array = json_decode($response, true);

        if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
            $userlist = (object)$json_array['payload'];
            $country = countryList();
        } else {
            $userlist = array();
        }

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

        return view('admin.bccieditnewuser', ["userlist" => $userlist, 'country' => $country,"privileges" => $privileges]);
    }

    public function updateUser(Request $request)
    {
        $postData = $request->all();
        $file = $request->file('photo');
        $token = APIHandlers::get_token();

        if ($postData) {

            $validation = Validator::make($request->all(), [
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'user_email' => 'required|email',
                'user_contact' => 'required||numeric|digits:10',
                'user_pass' => 'required|required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'user_confirm_pass' => 'required|same:user_pass|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'country' => 'required',
                'location' => 'required',
                'user_role' => 'required',
                'user_status' => 'required',
                // 'photo' => 'exclude_if:min,50|image|mimes:jpeg,bmp,png',
                'photo' => 'image|mimes:jpeg,bmp,png,jpg|max:300',
            ],
                [
                    'user_pass.same' => 'Confirm password should match the Password',
                    'user_pass.regex' => 'The password should be consist of alpha numeric and 1 special character',
                    'user_confirm_pass.regex' => 'The password should be consist of alpha numeric and 1 special character',
                    'user_contact.digits' => 'Phone Number must be valid'
                ]
            );

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->errors())->withInput();
            } else {

                $url = config('bcciconfig.CURD_API_URL') . "users/";
                $method = "POST";

                $headers = [
                    'Cache-Control: no-cache',
                    'Content-Type: multipart/form-data',
                    'Authorization: Bearer ' . $token,
                ];

                //$full_user_name = explode(" ", $postData['user_login']);

                $post_fields = [
                    'user_title' => $postData['user_title'],
                    'user_first_name' => $postData['first_name'],
                    'user_last_name' => $postData['last_name'],
                    'user_email_id' => $postData['user_email'],
                    'user_phone_number' => $postData['user_contact'],
                    'user_password' => $postData['user_pass'],
                    'user_address' => $postData['location'],
                    'user_role_id' => $postData['user_role'],
                    'user_status' => $postData['user_status'],
                    'c_password' => $postData['user_confirm_pass'],
                    'user_update_status' => $postData['user_update_status'],
                    'user_country_id' => $postData['country'],
                    'user_photo_url' => ($request->file('photo')) ? curl_file_create($request->file('photo'), $request->file('photo')->getMimeType(), $request->file('photo')->getClientOriginalName()) : $postData['user_old_photo']
                ];

                $response = APIHandlers::get_api_response($method, $url, $headers, $post_fields);

                $json_array = json_decode($response, true);
                if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
                    return redirect('bcciuserlist')->with('success', $json_array['status']['message']);
                } else {
                    return redirect('bcciuserlist')->with('error', $json_array['status']['message']);
                }
            }
        }
    }

    /**
     * view particular user.
     *
     * @param  @id
     * @return \Illuminate\View\View
     */
    public function viewUser(Request $request, $id)
    {

        $token = APIHandlers::get_token();

        $url = config('bcciconfig.CURD_API_URL') . "users/" . $id;
        $method = "GET";

        $headers = [
            'Cache-Control: no-cache',
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token,
        ];

        $response = APIHandlers::get_api_response($method, $url, $headers);

        $json_array = json_decode($response, true);

        if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
            $userlist = (object)$json_array['payload'];
            $country = countryList();
        } else {
            $userlist = array();
        }

        return view('admin.bcciviewuser', ["userlist" => $userlist, 'country' => $country]);
    }


    /**
     * delete bulk users.
     *
     * @param  @id
     * @return \Illuminate\View\View
     */
    public function deleteBulkUser(Request $request)
    {

        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'users/bulk_delete';

        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token
        ];

        $id_array = explode(',', $request->input('user_ids'));
        $response = APIHandlers::get_api_response($method, $url, $headers, ['user_ids[]' => $id_array], true);
        $response_data = json_decode($response, true);
        if (!empty($response_data['status']['code'])) {
            if ($response_data['status']['code'] == '200') {
                return response()->json([
                    'delete_status'    => true,
                    'status_code'      =>  200,
                    'success_message'  => 'data deleted successfully',
                ], 200);
            } else {
                return redirect('bcciuserlist')->with('error', $response_data['status']['message']);
            }
        } else {
            return redirect('bcciuserlist')->with('error', $response_data['message']);
        }
    }

    /**
     * serach by parameter
     *
     * @param  @id
     * @return \Illuminate\View\View
     */
    public function usersearch(Request $request, $id = 1)
    {

        $token = APIHandlers::get_token();
        $method = 'POST';
        $url = config('bcciconfig.CURD_API_URL') . 'usersearch';

        $headers = [
            'Content-Type:application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token
        ];
        if($request->input('search_field') != null){
        $post_fields = array(
            'data' => $request->input('search_field')
        );

        $response = APIHandlers::get_api_response($method, $url, $headers, $post_fields, true);
        $json_array = json_decode($response, true);

        if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
            $data['userlisting'] = (object)$json_array['payload']['data'];
            $data['link'] = (object)$json_array['payload']['links'];
        } else {
            $data = array();
        }


        }else{
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
                $data['activePage'] = (object)$id;
            } else {
                $data = array();
            }

        }
        return view('admin.bcciuserlist', ["userlist" => $data ,"activePage"=>$id]);
    }

    function userfilter(Request $request)
    {
        $page = !empty($request->page) ? $request->page  : 1;
        $token = APIHandlers::get_token();
        $url = config('bcciconfig.CURD_API_URL') . 'users?page=' . $page;
        $method = "GET";
        $headers = [
            'Authorization: Bearer ' . $token,
        ];
        $response = APIHandlers::get_api_response($method, $url, $headers);
        $response_data = json_decode($response, true);
        if (!empty($response_data) && $response_data['status']['code'] == '200') {
            return response()->json([

                'listhtml' => view('users.userTable', ['user' => $response_data, 'status' => true])->render(),
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

    /**
     * delete particular user.
     *
     * @param  @id
     * @return \Illuminate\View\View
     */

    public function deleteUser(Request $request)
    {

        $id = $request['user_id'];
        $method = 'DELETE';
        $url = config('bcciconfig.CURD_API_URL') . "users/" . $id;
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
                    'delete_status'    => true,
                    'status_code'      =>  200,
                    'success_message'  => 'data deleted successfully',
                ], 200);


            } else {
                return redirect()->with('error', $response_data['status']['message']);
            }
        } else {
            info('User Delete : ' . $response_data['message']);
            return redirect()->with('error', $response_data['message']);
        }
    }

}
