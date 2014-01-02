
<?php

include_once('tools/bootstrap.php');
include_once('models/PicsTable.php');


class BOPics{

  var $table;
  var $err;

  function __construct(){

    $this->table = Doctrine_Core::getTable('Pics');
  }
//=============================================================================== VALIDATIONS
//$tam = getimagesize($_FILES['imagen']['tmp_name']);
//$mime = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');



     function val_pics($ref){

        /*  if(!isset($ref['pic']) || $ref['pic'] == '')
          {
            throw new Exception('Please select an image');
            break;

          }//else if(!in_array( $_FILES['imagen']['type'], $mime ){

           // echo 'bien';
         // }*/


    }// End function upload_img
 
//=============================================================================== FUNCTIONS

 function upload_img($ref){

        try
            {  //$this->val_pics($ref);
               $rta = $this->table->upload_img($ref);
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

 

}//End class BOPics
/*
$pics = new BOPics;
$query = array(//'pic'=>'hoal', 
			   //'date'=>'2013/12/12', 
			   'caption'=>'fotito', 
			   'thumb'=>'img/pets/thumb/98.jpg',
			   //'album_id'=> null 
);

echo $pics->upload_img($query);
echo $pics->getErrors();

*/
?>
