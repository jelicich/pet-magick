<?php

include_once('tools/bootstrap.php');
include_once('models/AnimalCategoriesTable.php');



class BOAnimalCategories{
  
  var $err;

  function __construct()
  {
    $this->table = Doctrine_Core::getTable('AnimalCategories');
  }

//======================= nombres de todos los paises
    function getCategories()
    {

        $rta = $this->table->getCategories();
        return $rta;
       
    }


      

}//End class BOUsers


?>
