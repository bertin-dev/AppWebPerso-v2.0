<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 15/03/2019
 * Time: 15h50
 */

namespace App\Twitter;


use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter_Connect_Post
{
    private $consumer_key;
    private $consumer_secret;

    public function __construct($consumer_key, $consumer_secret)
    {

        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
    }

    public function getAuthentification($callback){
        $oauth = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
        $response = $oauth->oauth('oauth/request_token', ['oauth_callback'=>$callback]);
        $_SESSION['oauth_token'] = $response['oauth_token'];
        $_SESSION['oauth_token_secret'] = $response['oauth_token_secret'];
        $url = $oauth->url('oauth/authenticate', ['oauth_token'=>$response['oauth_token']]); //oauth/authorize
        return $url;
    }

    public function getAccessToken($token, $verifier)
    {

        if ($token != $_SESSION['oauth_token']) {
            throw new Exception('Impossible de se connecter avec ce Token');
        } else {

            $oauth = new TwitterOAuth(
                $this->consumer_key,
                $this->consumer_secret,
                $_SESSION['oauth_token'],
                $_SESSION['oauth_token_secret']
            );
            $response = $oauth->oauth('oauth/access_token', ['oauth_verifier' => $verifier]);

//etape suplémentaire pour poster un tweet
            /* $oauth = new TwitterOAuth(
                 $this->consumer_key,
                 $this->consumer_secret,
                 $response['oauth_token'],
                 $response['oauth_token_secret']);*/
            //verification via ma BD ou les sessions
            /* $_SESSION['authentified'] = true;
             $_SESSION['oauth_token'] = $response['oauth_token'];
             $_SESSION['oauth_token_secret'] = $response['oauth_token_secret'];*/
            //$oauth->post('statuses/update', ['status'=>'salut les gents']);
            return $response;
        }
    }

    public function verifyCredentials($token, $secret){
        $oauth = new TwitterOAuth(
            $this->consumer_key,
            $this->consumer_secret,
            $token,
            $secret
        );
        return $oauth->get('account/verify_credentials', ['include_email'=>true]);
    }
}