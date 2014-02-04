<?php

include_once('tools/bootstrap.php');
include_once('models/VetTalkTable.php');

class BOVettalk{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('VetTalk');
    }

    function insertArticle($ref){

        try{ 
            $this->table->insertArticle($ref);
            return true;
        }
        catch(Exception $e){

              $this->err = $e->getMessage();
              return false;
        }
    }//End insertArticle

    function getAllArticles(){

       $array = $this->table->getAllArticles();
        return $array;
    }//End getAllArticles

    function getLastArticle(){

       $array = $this->table->getLastArticle();
        return $array;
    }//End getAllArticles

    function getArticlesById($id){ 

         $array = $this->table->getArticlesById($id);
         return $array;
    }// end getOrganizationsByUser


    function getErrors(){

        return  $this->err;
    }

}//End class BOVettalk



//$article = new BOVettalk;
//$query = array('title'=>'title 3', 'content'=>'content 3', 'user_id'=> 5, 'pic_id'=> 192);
//var_dump($article->insertArticle($query));
//var_dump($article->getLastArticles());
//var_dump($article->getOrganizationsByUser(5));


?>
