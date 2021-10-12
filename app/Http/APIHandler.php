<?php
namespace App\Http;

class APIHandler{
    public function get_response_post($url,$headers,$postdata,$method){
        
        if($method=="POST"){
            if($headers==""){
                $headers=array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Postman-Token: a749cbee-8c6c-430c-9585-44c2bf1c20c6',
                    'Cache-Control: no-cache'
                );
            }
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($postdata),
            CURLOPT_HTTPHEADER => $headers,
            ));
    
            $response = curl_exec($curl);
    
            curl_close($curl);
            return $response;
    
        }
        else{
            if($headers==""){
                $headers=array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Postman-Token: a749cbee-8c6c-430c-9585-44c2bf1c20c6',
                    'Cache-Control: no-cache'
                );
            }
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $headers,
            ));
    
            $response = curl_exec($curl);
    
            curl_close($curl);
            return $response;
    
        }
    }

    public function get_api_response($url = null, $headers = [], $postfields = [], $method = 'POST'){

        // add comment for test
        // dd($headers);

        $curl = curl_init();


        curl_setopt_array($curl, array(

            CURLOPT_URL => $url,

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_ENCODING => '',

            CURLOPT_MAXREDIRS => 10,

            CURLOPT_TIMEOUT => 0,

            CURLOPT_FOLLOWLOCATION => true,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

            CURLOPT_CUSTOMREQUEST => strtoupper($method),

            CURLOPT_POSTFIELDS => http_build_query($postfields),

            CURLOPT_HTTPHEADER => $headers,

        ));


        $response = curl_exec($curl);
        $error_response = curl_error($curl);

        curl_close($curl);


        echo "<pre>";
        print_r($response);
        dd($error_response);

        return $response;

    }
}