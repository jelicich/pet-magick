<?php

include_once('tools/bootstrap.php');
include_once('models/CommentsTable.php');

class BOComments{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('Comments');
    }

    
    function post($array){
        $this->table->post($array);
    }



}//End class BOUsers



?>
