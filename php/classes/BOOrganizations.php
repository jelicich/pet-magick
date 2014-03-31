<?php

include_once('tools/bootstrap.php');
include_once('models/OrganizationsTable.php');
include_once ('BOPics.php');

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

              ->select('o.ID_ORGANIZATION, LEFT(o.NAME,65) AS NAME, LEFT(o.DESCRIPTION,125) AS DESCRIPTION, o.USER_ID, ph.PIC') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
              ->from('Organizations o')
              ->leftJoin('o.Pics ph'); 
          
          $r = $q->execute();    

         // if($r != false)
          return $r->toArray();
    }// end getAllOrganizations

    function getOrganizationsByUser($id){ 

         $q = Doctrine_Query::create()

            ->select('o.ID_ORGANIZATION, o.NAME, o.DESCRIPTION, o.USER_ID, ph.PIC') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
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
        ->select('o.ID_ORGANIZATION, o.NAME, o.DESCRIPTION, o.USER_ID, ph.PIC') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
        ->from('Organizations o')
        ->leftJoin('o.Pics ph') 
        ->limit(1)
        ->offset(rand(0, $userCount - 1))
        ->fetchOne();
        
         if($user != false)
         return $user->toArray();
    }// end getOrganizationsRamdom

    function getOrganizationsById($id){ 

         $q = Doctrine_Query::create()

            ->select('o.ID_ORGANIZATION, o.NAME, o.DESCRIPTION, o.USER_ID, ph.PIC') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
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

    function getOrgListByUser($id)
    {
      $q = Doctrine_Query::create()
        ->select('o.ID_ORGANIZATION, LEFT(o.NAME,65) AS NAME, LEFT(o.DESCRIPTION,125) AS DESCRIPTION, o.USER_ID, ph.PIC')
        ->from('Organizations o')
        ->leftJoin('o.Pics ph')
        ->where('o.USER_ID = ?', $id);
      $ob = $q->execute();
      $ar = $ob->toArray();
      if(sizeof($ar) > 0)
      {
               
          for($i=0; $i < sizeof($ar); $i++)
          {
            if(isset($ar[$i]['Pics']['PIC']))
            {
                $pic = $ar[$i]['Pics']['PIC'];
                $ar[$i]['Pics']['PIC'] = 'img/organizations/'.$pic;
                $ar[$i]['Pics']['THUMB'] = 'img/organizations/thumb/'.$pic;
            }
            else
            {
                $ar[$i]['Pics']['PIC'] = 'img/organizations/default.jpg';
                $ar[$i]['Pics']['THUMB'] = 'img/organizations/thumb/default.jpg';
            }   
          }
          return $ar;
       }
       else
       {

            return false;
       }
    }

    function getErrors(){

        return  $this->err;
    }// end getErrors

    function deleteOrganization($id)
    {
      try
      {
        $data = $this->table->find($id);
       // var_dump($data->PIC_ID); exit;
        $pics = new BOPics;
        if($data->PIC_ID != NULL){

              $pics->unlinkProfilePic($data->PIC_ID, '../img/organizations/');
        }
        
        $this->table->deleteOrganization($id);
        return true;
      } 
      catch (Exception $e)
      {
        $this->err = $e->getMessage();
        return false;
      }

    }

    function searchOrganizations($string, $from)
    {
        $q = Doctrine_Query::create()
            ->select('o.ID_ORGANIZATION, LEFT(o.NAME,15) AS NAME, LEFT(o.DESCRIPTION, 35) AS DESCRIPTION, ph.PIC, u.ID_USER')
            ->from('Organizations o')
            ->leftJoin('o.Pics ph')
            ->leftJoin('o.Users u')
            ->where('o.NAME LIKE ?', '%'.$string.'%')
            ->orWhere('o.DESCRIPTION LIKE ?', '%'.$string.'%')
            ->orderBy('o.ID_ORGANIZATION DESC')
            ->offset($from)
            ->limit(28);
        $rta = $q->execute();

        if($rta)
            return $rta->toArray();
        else
            return false;

    }

    function totalRecords($string)
    {
        $q = Doctrine_Query::create()
            ->select('COUNT(o.ID_ORGANIZATION) as QTY')
            ->from('Organizations o')
            ->where('o.NAME LIKE ?', '%'.$string.'%')
            ->orWhere('o.DESCRIPTION LIKE ?', '%'.$string.'%')
            ->orderBy('o.ID_ORGANIZATION DESC');
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



//$myOrganizations = new BOOrganizations;
//$query = array('name'=>'name 1', 'description'=>'description 1', 'user_id'=> 5, 'pic_id'=> 192);
//var_dump($myOrganizations->insertOrganizations($query));
//var_dump($myOrganizations->getAllOrganizations());
//var_dump($myOrganizations->getOrganizationsByUser(5));

?>
