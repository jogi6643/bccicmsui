<?php

use App\Http\APIHandlers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

/**
 * Created by PhpStorm.
 * User: sanjay_in10
 * Date: 26-08-2021
 * Time: 03:20 PM
 */

function countryList()
{
    try {
        return Cache::remember('country_list', now()->addHours(2), function () {
            $method = 'GET';
            $url = config('bcciconfig.CURD_API_URL') . 'listCountry';
            $token = APIHandlers::get_token();
            $headers = [
                'Accept:application/json',
                'Authorization: Bearer ' . $token
            ];
            $response = APIHandlers::get_api_response($method, $url, $headers);
            $response_data = json_decode($response, true);
            return $response_data['payload'];
        });
    } catch (Exception $exception) {
        return [];
    }

}

function viewDate($date)
{
    if (!empty($date)) {
        $carbon = Carbon::createFromFormat('Y-m-d H:i:s', $date);
        return $carbon->format('d M Y H:i');
    } else {
        return $date;
    }
}

if (!function_exists('pr')) {
	function pr($toPrint)
	{
		echo "<pre>";
		print_r($toPrint);
		echo "</pre>";
	}
}
 ////////////// Language API ///////////
 function language()
 {
     $method1 = 'GET';
     $url1 = config('bcciconfig.CURD_API_URL').'languages';
     $token1 = APIHandlers::get_token();
     $headers1 = [
         'Accept:application/json',
         'Authorization: Bearer ' . $token1
     ];
    
     $response1 = APIHandlers::get_api_response($method1, $url1, $headers1);
     $response_data1 = json_decode($response1, true);
     $lang=$response_data1['payload'];
     return $lang;
 }

 function status(){
    $method = 'GET';
    $token = APIHandlers::get_token();
    $statusurl = config('bcciconfig.CURD_API_URL') . 'status';
    $statusheaders = [
        'Authorization: Bearer ' . $token,
        'Accept:application/json',
        'Content-Type: application/json'
    ];
    $status = APIHandlers::get_api_response($method, $statusurl, $statusheaders);
    $status_data = json_decode($status, true);
    $status = $status_data['payload'];
    return $status;
 }

  function get_all_tags()
 {
     $postdata = '';
      
     $method = 'POST';
     $url = config('bcciconfig.CURD_API_URL') .'tags/list';
     $token = APIHandlers::get_token();
     $headers = [
         'Authorization: Bearer ' . $token,
         'Accept:application/json',
         'Content-Type: application/json'
     ];
    
     $response = APIHandlers::get_api_response($method, $url, $headers, json_encode($postdata));
     $response_data = json_decode($response, true);
     if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
         return $response_data['payload'];
     } else {
         return $response_data['payload'];
     }

}
// to get platform list 
function platformList()
{
    $method = 'GET';
    $url = config('bcciconfig.CURD_API_URL') .'platform';
    $token = APIHandlers::get_token();
    $headers = [
        'Authorization: Bearer ' . $token,
        'Accept:application/json',
        'Content-Type: application/json'
    ];

    $response = APIHandlers::get_api_response($method, $url, $headers);
    $response_data = json_decode($response, true);
    if (!empty($response_data['status']['code']) && $response_data['status']['code'] == '200') {
        return $response_data['payload'];
    } else {
        return $response_data['payload'];
    }

}

if (!function_exists('uploadFileToS3')) {
    function uploadFileToS3 ($file, $folderPath, $tag = '') {
        // dd($file);
        $s3 = new Aws\S3\S3Client([
            'region'  => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ]
        ]);

        $name = time() . '_' . $file->getClientOriginalName();
        if ($tag == 'video') {
            $result = $s3->putObject([
                'Bucket' => 'mum-epicon-bcci',
                'Key'    => $folderPath . $name,
                'SourceFile' => $file->getRealPath()
            ]);
        } else {
           $result = $s3->putObject([
                'Bucket' => 'bcciplayerimages',
                'Key'    => $folderPath . $name,
                'SourceFile' => $file->getRealPath()
            ]); 
        }
        
        return $result;
    }
}
if (!function_exists('uploadFileToS31')) {
    function uploadFileToS31 ($file, $folderPath, $tag = '') {
        // dd($file);
        $s3 = new Aws\S3\S3Client([
            'region'  => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ]
        ]);

        $name1 = $file->getClientOriginalName();
        $name = time() . '_' . $name1[0];

        if ($tag == 'video') {
            $result = $s3->putObject([
                'Bucket' => 'mum-epicon-bcci',
                'Key'    => $folderPath . $name,
                'SourceFile' => $file->getRealPath()
            ]);
        } else {
           $result = $s3->putObject([
                'Bucket' => 'bcciplayerimages',
                'Key'    => $folderPath . $name,
                'SourceFile' => $file->getRealPath()
            ]); 
        }
        
        return $result;
    }
}
if (!function_exists('checkUrl')) {
    function checkUrl($url) {
       
        $file_headers = @get_headers($url);
        //print_r($file_headers);exit;
        if (!empty($file_headers) && $file_headers) {
            if (count($file_headers) > 0 && (strpos($file_headers[0], 'HTTP') !== false)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}