<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\APIHandlers;

class LoginController extends Controller
{

    /**
     * view login page.
     *
     * @param array $request
     * @return \Illuminate\View\View
     */
    public function login(Request $request)
    {
        $userData = $request->session()->get('user_data');
        if (!empty($userData)) {
            return redirect('/dashboard');
        } else {
            return view('admin.bccilogin');
        }
    }

    /**
     * check login.
     *
     * @param array $request
     * @return \Illuminate\View\View
     */
    public function loginCheck(Request $request)
    {

        $postdata = $request->all();

        $validator = Validator::make($postdata, [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        } else {

            $url = config('bcciconfig.CURD_API_URL') . "login";
            $method = "POST";

            $headers = [
                'Cache-Control: no-cache',
                'Content-Type: application/x-www-form-urlencoded'
            ];
            $post_fields = [
                'email' => $postdata['email'],
                'password' => $postdata['password']
            ];

            $response = APIHandlers::get_api_response($method, $url, $headers, $post_fields, true);

            $json_array = json_decode($response, true);

            if ($json_array['status']['code'] == '200' && !(empty($json_array['status']['code']))) {
                session(['user_data' => $json_array['payload']]);
                return redirect('/dashboard');
            }elseif ($json_array['status']['code'] == '201' && !(empty($json_array['status']['code']))) {
                return redirect()->back()->with('error', $json_array['status']['message']);
            }else {
                return redirect()->back()->with('error', $json_array['status']['message']);
            }
        }
    }

    /**
     * view forgot password blade.
     *
     * @param
     * @return \Illuminate\View\View
     */
    public function forgotpassword()
    {
        return view('admin.bcciforgotpassword');
    }

    /**
     * view reset password blade.
     *
     * @param
     * @return \Illuminate\View\View
     */
    public function resetpassword(Request $request)
    {
        $value = $request->session()->get('user_data');
        if($value != ""){
            return redirect('/dashboard');       
        }else{
            $email = $request->input('email');
            return view('admin.bcciresetpassword', ['user_email' => $email]);
        }
        // echo "<pre>";print_r($value);
        // echo "asfsadfsafd";exit;
        
    }

    public function resetpasswordpost(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required||regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'confirm-password' => 'required|same:password||regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'otp' => 'required|numeric',
        ],
            [
                'password.regex' => 'The password should be consist of alpha numeric and 1 special character',
                'confirm-password.regex' => 'The password should be consist of alpha numeric and 1 special character'
            ]
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        } else {
            $url = config('bcciconfig.CURD_API_URL') . "resetpass";
            $method = "POST";

            $headers = [
                'Cache-Control: no-cache',
                'Content-Type: application/x-www-form-urlencoded'
            ];

            $post_fields = [
                'email' => $request->input("email"),
                'password' => $request->input("password"),
                'otp' => $request->input("otp"),
            ];

            $response = APIHandlers::get_api_response($method, $url, $headers, $post_fields, true);
            
            $json_array = json_decode($response, true);
            
            if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
                return redirect(route('login'));
            }elseif ($json_array['status']['code'] == '201' && !(empty($json_array['status']['code']))) {
                if(@$json_array['payload'][0] != ''){
                    $error_meassage = $json_array['payload'][0];
                    return redirect()->back()->with('error', $error_meassage)->withInput();
                }elseif($json_array['status']['message'] != ''){
                    $error_meassage = $json_array['status']['message'];
                    return redirect()->back()->with('error', $error_meassage)->withInput();
                    // exit;
                }
                        
            }else{
                return redirect()->back()->with('error', $json_array['status']['message'])->withInput();
            }
        }
    }

    /**
     * sent mail for forgot password.
     *
     * @param array $request
     * @return \Illuminate\View\View
     */
    public function setForgotPassword(Request $request)
    {

        $postData = $request->all();

        if ($request) {
            $validator = Validator::make($postData, [
                'email' => 'required|string|email'
            ]);

            if ($validator->fails()) {
                $errors = json_decode($validator->errors());
                return redirect()->back()->with('error', $errors->email[0]);
            } else {

                $url = config('bcciconfig.CURD_API_URL') . "forgotpass";
                $method = "POST";

                $headers = [
                    'Cache-Control: no-cache',
                    'Content-Type: application/x-www-form-urlencoded'
                ];

                $post_fields = [
                    'email' => $postData['email']
                ];
                // echo "<pre>";print_r($post_fields['email']);exit;
                $response = APIHandlers::get_api_response($method, $url, $headers, $post_fields, true);
                
                $json_array = json_decode($response, true);
                if ($json_array['status']['code'] == '200' && !empty($json_array['status']['code'])) {
                    return redirect('login')->with('success', $json_array['status']['message']);
                }elseif ($json_array['status']['code'] == '201' && !(empty($json_array['status']['code']))) {
                    $error_meassage = $json_array['status']['message'];
                    $email = $post_fields['email'];
                    Session::put('email', $email);
                    return redirect('forgotpassword')->with('error', $error_meassage);
                }else{
                    return redirect('forgotpassword')->with('error', $json_array['status']['message']);
                }
            }
        }
    }

    /**
     * logout.
     *
     * @param
     * @return \Illuminate\View\View
     */
    public function logout(){
        Session::flush();
        // return redirect('/login');
        return redirect('/dashboard');
    }
}
