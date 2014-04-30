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

     function deleteNews($id){ 
        
       $q = doctrine_query::create()
        ->delete('News n')
        ->where('n.ID_NEWS =?', $id);
        $q->execute();

    }







    function getErrors(){

        return  $this->err;
    }


}//End class BOUsers



?>
