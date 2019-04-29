<?php
namespace App\Http\Controllers\Util;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AbstractController extends Controller
{
    public function getParameters($parameters, $type = null)
    {
        $data = $type ? json_decode($parameters,true) :  json_decode($parameters);
        return $data;
    }

    public function missingField($data , $keys)
    {
        foreach ($keys as $key) {
            if(!isset($data[$key]) || empty($data[$key]))
                return false;
        }
        return true;
    }

    public function callAPI($method, $url, $data){
        $api_key = 'c2c2a3d0-8729-4627-b2ed-803443b58ad1';
        $curl = curl_init();

        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        $headers = array(
            'Content-Type :application/json',
            'Authorization: key='.$api_key
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $result = curl_exec($curl);
        if(!$result){return $result;}
        curl_close($curl);
        return $result;
    }
}