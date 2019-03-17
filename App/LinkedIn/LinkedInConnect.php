<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 15/03/2019
 * Time: 19h36
 */

namespace App\LinkedIn;


class LinkedInConnect
{
    private $client_id;
    private $client_secret;
    private $redirect_uri;
    private $csrf_token;
    private $scopes;
    
    public function __construct($client_id, $client_secret, $redirect_uri, $csrf_token, $scopes)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->redirect_uri = $redirect_uri;
        $this->csrf_token = $csrf_token;
        $this->scopes = $scopes;
    }

    public function getCallBack(){

        if(isset($_REQUEST['code'])){
            $code = $_REQUEST['code'];
            $url = 'https://www.linkdein.com/oauth/v2/accessToken';

            $param = [
                'client_id'=>$this->client_id,
                'client_secret'=>$this->client_secret,
                'redirect_uri'=>$this->redirect_uri,
                'code'=>$code,
                'grant_type'=>'authorization_code',
            ];
            $accessToken = $this->curl($url, http_build_query($param));
            //var_dump($accessToken);
            $accessToken = json_decode($accessToken)->$accessToken;
            $url = 'https://api.linkedin.com/v1/people/~:(id, firstName, lastName, pictureUrls::(original), headline,publicProfileUrl, location, industry, positions, email-address)?format=json&oauth2_access_token='.$accessToken.'';
            $user = file_get_contents($url, false);
            return json_decode($user);
        }
    }

    public function curl($url, $parameters){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 1);
        $headers = [];
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        return $result;
    }

}