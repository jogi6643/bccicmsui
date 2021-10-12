<?php

namespace App\Http\Controllers;
use App\Http\APIHandlers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class SocialShareController extends Controller
{
    public function index(){
        return view('SocialShare.addpost');
    }
    public function SharePost(Request $request){

        // $validator = Validator::make($request->all(), [
        //     'media_url' => 'mimes:jpg,png|max:1024',
        // ]);
        $postdata = $request->all() ?? null;        
        $method = 'POST';
        $url = 'https://app.ayrshare.com/api/post';
        $headers = [
            'Authorization: Bearer KNY77DG-ZGKM5AD-J2Q9XPC-6J4GYKT',
            'Content-Type: application/json'
        ];
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator->errors())->withInput();
        // } 
        if (!empty($request->get('media_url')) || $request->hasFile('media_url')) 
        {
            if (in_array("instagram", $postdata['platform']))
                {
                    $files = $request->file('media_url');
                    $folderpath = 'bcci/Socialmedia_image/';
                    $result = uploadFileToS31($files[0],$folderpath, '');
                    $media_url = $result['ObjectURL'] ?? '';
                }
                else
                {
                    $files = $request->file('media_url');
                    $folderpath = 'bcci/Socialmedia_image/';
                    foreach($files as $imgfile) {
                    $result = uploadFileToS3($imgfile,$folderpath, '');
                    $media_url[] = $result['ObjectURL'] ?? '';
                    }
                }
        } 
        else {
            $media_url = '';
        }
        // dd($media_url);
        $postData = [
                'post' => $postdata['title'] ?? null,
                'platforms' => $postdata['platform'] ?? null,
                'media_urls' => $media_url,
        ];
        $json = json_encode($postData);
        $response = APIHandlers::get_api_response1($method, $url, $headers, $json);
        $response_data = json_decode($response, true);
        // dd($response_data);
        if (!empty($response_data['status'])) {
            if ($response_data['status']== 'success') {
                $msg ="Social Post Shared successfully";
                return redirect('SocialShare')->with('success',$msg);
            } elseif($response_data['errors'][0]['code']== '137'){
                $msg ="Duplicate or similar content posted within the same three day period.";
                return redirect('SocialShare')->with('error', $response_data['errors'][0]['message']);
            }
            else {
                $msg ="Social Post Sharing failed!";
                return redirect('SocialShare')->with('error', $msg);
            }
        } else {
            $msg ="Social Post Sharing failed!";
            return redirect('SocialShare')->with('error', $msg);
        }
    }
}
