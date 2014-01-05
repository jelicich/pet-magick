<?php

include_once('tools/bootstrap.php');
include_once('models/VideosTable.php');


class BOVideos{

  var $table;
  var $err;

  function __construct(){

    $this->table = Doctrine_Core::getTable('Videos');
  }

	function upload_video($ref){

        try
            {  
               $this->table->upload_video($ref);
               echo 'hola';
               return true;
            }

        catch(Exception $e)
            {
              $this->err = $e->getMessage();
              return false;
            }
    }// End function upload_img


    function getErrors()
    {
        return  $this->err;
    }
}

$videos = new BOVideos;
$query = array('video'=>'hoal', 
			   //'date'=>'2013/12/12', 
			   'caption'=>'fotito', 
			   //'thumb'=>'img/pets/thumb/98.jpg',
			   //'album_id'=> null 
);

echo $videos->upload_video($query);