
<?php

include_once('tools/bootstrap.php');
include_once('models/PicsTable.php');


class BOPics{

  var $table;
  var $err;

  function __construct(){

    $this->table = Doctrine_Core::getTable('Pics');
  }

//=============================================================================== FUNCTIONS

 function upload_img($ref){

        try
            {
               $rta = $this->table->upload_img($ref);
               echo 'arriba! (Borrar este echo del codigo)';
               return true;
            }

        catch(Exception $e)
            {
              $this->err = array('Error:'=> $e->getMessage());
              return false;
            }
    }// End function upload_img
 

}//End class BOPics
/*
$pics = new BOPics;
$query = array('pic'=>'imgs/culo.jpg', 
			   //'date'=>'2013/12/12', 
			   'caption'=>'fotito', 
			   //'thumbnail'=> 1 
			   //'album_id'=> null 
);

$pics->upload_img($query);
*/
?>
