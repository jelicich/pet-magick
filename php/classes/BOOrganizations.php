<?php

include_once('tools/bootstrap.php');
include_once('models/OrganizationsTable.php');

class BOOrganizations{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('Organizations');
    }// end __construct

    function insertOrganizations($ref){

        try{ 
            
            $this->table->insertOrganizations($ref);
            return true;
        }
        catch(Exception $e){

              $this->err = $e->getMessage();
              return false;
        }
    }// end insertOrganizations

    function getAllOrganizations(){

        $array = $this->table->getAllOrganizations();
        return $array;
    }// end getAllOrganizations

    function getOrganizationsByUser($id){ 

         $array = $this->table-> getOrganizationsByUser($id);
         return $array;
    }// end getOrganizationsByUser

    function getOrganizationsRamdom(){ 

         $array = $this->table-> getOrganizationsRamdom();
         return $array;
    }// end getOrganizationsByUser

    function getOrganizationsById($id){ 

     $array = $this->table-> getOrganizationsById($id);
     return $array;
    }// end getOrganizationsByUser


    function getErrors(){

        return  $this->err;
    }// end getErrors


}//End class BOUsers



//$myOrganizations = new BOOrganizations;
//$query = array('name'=>'name 1', 'description'=>'description 1', 'user_id'=> 5, 'pic_id'=> 192);
//var_dump($myOrganizations->insertOrganizations($query));
//var_dump($myOrganizations->getAllOrganizations());
//var_dump($myOrganizations->getOrganizationsByUser(5));

?>
