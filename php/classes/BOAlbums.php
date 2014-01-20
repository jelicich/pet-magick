<?php

include_once('tools/bootstrap.php');
include_once('models/AlbumsTable.php');

class BOAlbums{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('Albums');
    }

    function createAlbum()
    {
        return $this->table->createAlbum();
    }


}//End class BOUsers



?>
