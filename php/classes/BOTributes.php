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

    function updateTribute($array)
    {
        if($this->val_updateTribute($array))
        {
            $this->table->updateTribute($array);
            return true;
        }
        else
        {
            return false;
        }
    }
    function val_updateTribute($array)
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

    function deleteTribute($id)
    {
        $this->table->deleteTribute($id);
    }

    function deleteTributeByPet($id)
    {
        $this->table->deleteTributeByPet($id);
    }


    function getErr(){

        return  $this->err;
    }

    function getTribute($id)
    {
        $obj = $this->table->getTribute($id);
        
        if(isset($obj[0]['Pets']['Pics']['PIC']))
        {
            $pic = $obj[0]['Pets']['Pics']['PIC'];
            $obj[0]['Pets']['Pics']['PIC'] = 'img/pets/'.$pic;
            $obj[0]['Pets']['Pics']['THUMB'] = 'img/pets/thumb/'.$pic;
        }
        else
        {
            $obj[0]['Pets']['Pics']['PIC'] = 'img/pets/default.jpg';
            $obj[0]['Pets']['Pics']['THUMB'] = 'img/pets/thumb/default.jpg';
        }
        return $obj[0];
    }

}//End class BOUsers



?>
