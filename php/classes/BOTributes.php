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
        if(empty($array['title']) || empty($array['content']) || empty($array['name']))
        {
            var_dump($array);
            die;
            if(empty($array['title']))
                $this->err[]= '&ti=1';
            if(empty($array['content']))
                $this->err[]= '&co=1';
            if(empty($array['name']))
                $this->err[]= '&na=1';
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
        $p = $obj[0]['PIC'];
        if($p == NULL)
        {
            $obj[0]['PIC'] = 'img/tributes/default.jpg';
            $obj[0]['THUMB'] = 'img/tributes/thumb/default.jpg';
        }
        else
        {
            $obj[0]['PIC'] = 'img/tributes/'.$p;
            $obj[0]['THUMB'] = 'img/tributes/thumb/'.$p;
        }
        return $obj;
    }

}//End class BOUsers



?>
