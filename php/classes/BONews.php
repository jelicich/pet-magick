<?php

include_once('tools/bootstrap.php');
include_once('models/NewsTable.php');



class BONews{

    var $table;

    var $err;

    function __construct()
    {
        $this->table = Doctrine_Core::getTable('News');
    }


    function getNews($id)
    {
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

}//End class BOUsers


?>
