<?php

include_once('tools/bootstrap.php');
include_once('models/PopupsTable.php');

class BOPopups{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('Popups');
    }

    
    function upload($ref){

        //var_dump($ref); exit;
        try{ 
            $this->table->upload($ref);
            return true;
        }
        catch(Exception $e){

              $this->err = $e->getMessage();
              return false;
        }
        	
    }

    function getPopUps($ref){

        

         try{ 
           
            return  $this->table->getPopUps($ref);
        }
        catch(Exception $e){

              $this->err = $e->getMessage();
              return false;
        }
    }

    function getErrors(){

        return  $this->err;
    }




}//End class BOUsers

  

?>
