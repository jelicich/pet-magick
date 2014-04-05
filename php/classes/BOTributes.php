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

    function getAllTributes()
    {
        $r = $this->table->getAllTributes();
        return $r;
    }

   function howmuch_tributes()
    {
        $r = $this->table->howmuch_tributes();
        return $r;
    }
    
    function getTributesByCat($id)
    {
     
          $r = $this->table->getTributesByCat($id);
        return $r;
    }

    function searchTributes($string,$from,$to)
    {
        if($string == '*')
        {
          $q = Doctrine_Query::create()
            ->select("t.ID_TRIBUTE, t.TITLE, t.CONTENT, DATE_FORMAT(t.SINCE,'%Y') as SINCE, DATE_FORMAT(t.THRU, '%Y') as THRU, t.PET_ID, ph.PIC, p.NAME, p.ID_PET")
            ->from('Tributes t')
            ->leftJoin('t.Pets p')
            ->leftJoin('p.Pics ph')
            ->orderBy('t.ID_TRIBUTE DESC')
            ->offset($from)
            ->limit($to);
        }
        else
        {
          $q = Doctrine_Query::create()
            ->select('t.ID_TRIBUTE, t.TITLE, t.CONTENT, t.SINCE, t.THRU, t.PET_ID, ph.PIC, p.NAME, p.ID_PET')
            ->from('Tributes t')
            ->leftJoin('t.Pets p')
            ->leftJoin('p.Pics ph')
            ->where('p.NAME LIKE ?', '%'.$string.'%')
            ->orWhere('t.TITLE LIKE ?', '%'.$string.'%')
            ->orderBy('t.ID_TRIBUTE DESC')
            ->offset($from)
            ->limit($to);  
        }
        
        $rta = $q->execute();

        if($rta)
            return $rta->toArray();
        else
            return false;
    }

    function totalRecords($string)
    {
        if($string == '*')
        {
          $q = Doctrine_Query::create()
            ->select('COUNT(t.ID_TRIBUTE) as QTY')
            ->from('Tributes t')
            ->orderBy('t.ID_TRIBUTE DESC');  
        }
        else
        {
          $q = Doctrine_Query::create()
            ->select('COUNT(t.ID_TRIBUTE) as QTY')
            ->from('Tributes t')
            ->where('t.TITLE LIKE ?', '%'.$string.'%')
            ->orWhere('t.CONTENT LIKE ?', '%'.$string.'%')
            ->orderBy('t.ID_USER DESC');  
        }
        
        $rta = $q->execute();

        if($rta)
        {
            $ar = $rta->toArray();
            return $ar[0]['QTY'];
        }          
        else
        {
            return false;
        }
            
    }

}//End class BOUsers



?>
