<?php

include_once('tools/bootstrap.php');
include_once('models/AnimalCategoriesTable.php');



class BOAnimalCateogries{
  
  var $err;

  function __construct()
  {
    $this->country_table = Doctrine_Core::getTable('AnimalCategories');
  }

//======================= nombres de todos los paises
    function getCategories()
    {

        $rta = $this->table->getCategories();
        return $rta;
       
    }


      

}//End class BOUsers


?>
