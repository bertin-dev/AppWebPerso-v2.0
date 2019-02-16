<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 08/02/2019
 * Time: 06h47
 */

namespace App\Table;


 class Commentaires
{

    public function getUrl(){
        return 'index.php?id_page=7&comments=' .$this->id_commentaires;
    }

    public function getExtrait()
    {
      return $this->commentaires;
    }
}