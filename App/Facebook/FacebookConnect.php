<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 11/03/2019
 * Time: 00h15
 */

namespace App\Facebook;


use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use \Facebook\FacebookRequest;

class FacebookConnect
{
    private $appId;
    private $appSecret;

    /**
     * FacebookConnect constructor.
     * @param $appId Facebook application ID
     * @param $appSecret Facebook Application secret
     */
    function __construct($appId, $appSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    /**
     * @param $redirect_url
     * @return string
     */
    function connect($redirect_url){
        FacebookSession::setDefaultApplication($this->appId, $this->appSecret);
        $helper = new FacebookRedirectLoginHelper($redirect_url);
        if(isset($_SESSION) && isset($_SESSION['fb_token'])){
            $session = new FacebookSession($_SESSION['fb_token']);
        }else{
            $session = $helper->getSessionFromRedirect();
        }
        if($session){
            try{
                $_SESSION['fb_token'] = $session->getToken();
                $request = new FacebookRequest($session, 'GET', '/me');
                $profil = $request->execute()->getGraphObject('Facebook\GraphUser');
                if($profil->getEmail()===null){
                    throw new \Exception('Vous n\'avez pas accepter de donner votre mail');
                }
                return $profil;
            }catch (\Exception $e){
                unset($_SESSION['fb_token']);
                return $helper->getReRequestUrl(['email']);
            }
        }else{
            return $helper->getLoginUrl(['email']);
        }





    }

}