<?php

include_once('tools/bootstrap.php');
include_once('models/FavoritesTable.php');



class BOFavorites{
  
  var $err;

  function __construct()
  {
    $this->table = Doctrine_Core::getTable('Favorites');
  }


    function addFavorite($ref)
    {
      return $this->table->addFavorite($ref);
    }

    function getFavorite($ref)
    {
      return $this->table->getFavorite($ref);
    }

    function getFavoriteList($ref){

        return $this->table->getFavoriteList($ref);
    }

    function deleteFavorite($ref){

        return $this->table->deleteFavorite($ref);
    }

}//End class BOUsers


//$a = new BOFavorites;
//$query = array('id_user_me' => 5, 'id_user_favorite' =>8);
//var_dump($a->addFavorite($query));
//var_dump($a->getFavorite(5));