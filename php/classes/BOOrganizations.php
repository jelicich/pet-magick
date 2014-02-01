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
       
         $q = Doctrine_Query::create()

              ->select('o.ID_ORGANIZATION, o.NAME, o.DESCRIPTION, o.USER_ID, ph.PIC, ph.thumb') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
              ->from('Organizations o')
              ->leftJoin('o.Pics ph'); 
          
          $r = $q->execute();    
          
          return $r->toArray();
    }// end getAllOrganizations

    function getOrganizationsByUser($id){ 

         $q = Doctrine_Query::create()

            ->select('o.ID_ORGANIZATION, o.NAME, o.DESCRIPTION, o.USER_ID, ph.PIC, ph.thumb') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
            ->from('Organizations o')
            ->leftJoin('o.Pics ph') // van con leftJoin, sino, si el usuario no tiene nada cargado, no trae nada
            ->where('o.USER_ID = ?', $id);
        
            $p = $q->execute();    
       
           if(sizeof($p) > 0){
               
                return $p->toArray();

           }else{

                return false;
           }
    }// end getOrganizationsByUser

    function getOrganizationsRamdom(){ // revisar esta funcion pq no me queda claro q carajo me trae, aunque anda
          
        $userCount = Doctrine::getTable('Organizations')->count();
        $user = Doctrine::getTable('Organizations')
        ->createQuery()
        ->select('o.ID_ORGANIZATION, o.NAME, o.DESCRIPTION, o.USER_ID, ph.PIC, ph.thumb') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
        ->from('Organizations o')
        ->leftJoin('o.Pics ph') 
        ->limit(1)
        ->offset(rand(0, $userCount - 1))
        ->fetchOne();

       return $user->toArray();
    }// end getOrganizationsRamdom

    function getOrganizationsById($id){ 

         $q = Doctrine_Query::create()

            ->select('o.ID_ORGANIZATION, o.NAME, o.DESCRIPTION, o.USER_ID, ph.PIC, ph.thumb') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
            ->from('Organizations o')
            //->innerJoin('o.Users u')
            ->leftJoin('o.Pics ph') // van con leftJoin, sino, si el usuario no tiene nada cargado, no trae nada
            ->where('o.ID_ORGANIZATION = ?', $id)
            ->groupBy('o.ID_ORGANIZATION');
        
            $p = $q->execute();    
       
           if(sizeof($p) > 0){
               
                return $p->toArray();

           }else{

                return false;
           }
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
