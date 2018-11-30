<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 21/02/2018
 * Time: 15h33
 */

namespace Core\Controller;


class Contact
{

    private $valeurs;
    private $donnee;
    public $tag = 'p';


    public function __construct($valeurs = array())
    {
        $this->valeurs = $valeurs;
    }


    public function input($type, $name, $placeholder=null, $multiple=null, $id=null, $verification=null){
        return $this->retour ("<input class='form-control' required='required' id=".$id." $multiple type=".$type." name=" .$name." 
        placeholder=".$placeholder."> <small id=".$verification."> </small>");
    }


    public function select($name, $id=null){
        return $this->retour('<select id="'.$id.'" name="'.$name.'">
 <option value="Freelance">FREELANCE</option> 
 <option value="Entreprise">ENTREPRISE</option>
 </select>');
    }


    public function textarea($name, $message, $id=null, $verification=null){
        return $this->retour ("<textarea id=".$id." class='form-control' name=" .$name." 
        placeholder=".$message."></textarea> <small id=".$verification."> </small>" );
    }

    public function submit($text, $class=null){
        return $this->retour ("<button class='btn btn-primary ".$class."' title='Cliquez-Ici' required='required' type='submit'> $text </button>") ;
    }



    private function retour($html){
        return "<{$this->tag}>$html</{$this->tag}>" ;
    }

    //accesseurs
    private function getValue($index){
        return  isset($this->valeurs[$index]) ? $this->valeurs[$index] : null;
    }

}