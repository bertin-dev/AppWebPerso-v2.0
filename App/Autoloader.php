<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 05/08/2018
 * Time: 08h35
 */


/*Chargement automaqtique de nos class*/
namespace App;

class Autoloader{

    //enregistre notre autoloader
     static function register(){

        spl_autoload_register(array(__CLASS__, 'autoload'));
    }


    //inclu le fichier correspondant a notre classe
    static function autoload($class){

        /*  //var_dump(__CLASS__.' 1 '.__FILE__.' 2 '.__DIR__.' methode: '.__METHOD__.' ligne: '.__LINE__.' namespace '.__NAMESPACE__);
          if(strpos($class, __NAMESPACE__. '\\') === 0){
              $class = str_replace(_NAMESPACE__ .'\\', '', $class);
              $class = str_replace('\\', '/', $class);
              require __DIR__ .'/' . $class . '.php';
          }*/




    }
}
