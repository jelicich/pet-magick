<?php

include_once('tools/bootstrap.php');
include_once('models/NewsTable.php');

class BONews{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('News');
    }

    function insertNews($ref){

        try{ 
            
            $this->table->insertNews($ref);
            return true;
        }
        catch(Exception $e){

              $this->err = $e->getMessage();
              return false;
        }
    }

    function getNews($id){

        $news = $this->table->getNewsByUser($id);
        if(!empty($news))
        {
            $this->news = $news;
        }
        else
        {
            $this->news = false;
        }
        
        return $this->news;
    }

    function deleteNews(){ // completar esta funcion

    }

    function getErrors(){

        return  $this->err;
    }


}//End class BOUsers


/*
$news = new BONews;
$query = array('news'=> 'novedad 1', 'user_id'=> 5);
var_dump($news->insertNews($query));
//var_dump($news->getErrors());
*/

?>
