
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


     function val_pics($ref){

    }// End function upload_img
 
//=============================================================================== FUNCTIONS

 function upload_img($ref){

        try
            {  
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


?>
