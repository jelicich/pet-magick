<?php

include_once('tools/bootstrap.php');
include_once('models/TributesTable.php');

class BOTributes{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('Tributes');
    }

    function createTribute($array)
    {
        if($this->val_createTribute($array))
        {
            $id = $this->table->createTribute($array);
            return $id;
        }
        else
        {
            return false;
        }
        
    }

    function val_createTribute($array)
    {
        if(empty($array['tr-title']) || empty($array['tr-msg']) )
        {
            
            if(empty($array['tr-title']))
                $this->err[]= 'The title field is mandatory';
            if(empty($array['tr-msg']))
                $this->err[]= 'The content field is mandatory';
            return false;
        }
        else
        {
            return true;
        }
    }


    function getErr(){

        return  $this->err;
    }

    function getTribute($id)
    {
        $obj = $this->table->getTribute($id);
       
        return $obj[0];
    }

}//End class BOUsers



?>
