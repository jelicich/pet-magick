<?php

include_once('tools/bootstrap.php');
include_once('models/ProjectsTable.php');
include_once ('BOPics.php');

class BOProjects{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('Projects');
    }// end __construct

    function insertProjects($ref){

        try{ 

            $this->table->insertProjects($ref);
            return true;
        }
        catch(Exception $e){

              $this->err = $e->getMessage();
              return false;
        }
    }// end insertProjects

    function getAllProjects($limit){
        
        $q = Doctrine_Query::create()

            ->select('*') 
            ->from('Projects p')
            ->limit($limit);
        
        $r = $q->execute();

        if($r != false)
        return $r->toArray();

    }// end getAllProjects

    function getProjectsById($id){ 

     $q = Doctrine_Query::create()

        ->select('*') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
        ->from('Projects p')
        //->innerJoin('o.Users u')
        //->leftJoin('o.Pics ph') // van con leftJoin, sino, si el usuario no tiene nada cargado, no trae nada
        ->where('p.ID_PROJECT = ?', $id)
        ->groupBy('p.ID_PROJECT');
    
        $p = $q->execute();    
   
       if(sizeof($p) > 0){
           
            return $p->toArray();

       }else{

            return false;
       }
    }// end getOrganizationsByUser

    function getProjectsByUser($id){ // Ver si puedo hacer estas dos consultas en una sola. Linea 32 y 33 BOusers.php

         $q = Doctrine_Query::create()

            ->select('p.ID_PROJECT, p.TITLE, p.DESCRIPTION, u.ID_USER, ph.PIC') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
            ->from('Projects p')
            ->innerJoin('p.Users u')
            ->leftJoin('u.Pics ph') // van con leftJoin, sino, si el usuario no tiene nada cargado, no trae nada
            ->where('p.USER_ID = ?', $id)
            ->groupBy('u.ID_USER');
        
            $p = $q->execute();    
       
           if(sizeof($p) > 0){
               
                return $p->toArray();

           }else{

                return false;
           }
    }// end getProjectsByUser

    function getAlbumIdByProject($id){

        return $this->table->getAlbumIdByProject($id);
    }// end setAlbum

    function getProjectsRamdom(){ // revisar esta funcion pq no me queda claro q carajo me trae, aunque anda
          
        $userCount = Doctrine::getTable('Projects')->count();
        $user = Doctrine::getTable('Projects')
        ->createQuery()
        ->select('p.ID_PROJECT, LEFT(p.TITLE,40) AS TITLE, LEFT(p.DESCRIPTION, 125) AS DESCRIPTION, p.USER_ID, p.ALBUM_ID') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
        ->from('Projects p')
        //->leftJoin('o.Pics ph') 
       // ->limit(1)
        ->offset(rand(0, $userCount - 1))
        ->fetchOne();
        
        if($user != false)
        return $user->toArray();
    }// end getOrganizationsRamdom

    function getErrors(){

        return  $this->err;
    }// end getErrors


    function getProjectListByUser($id)
    {
      $q = Doctrine_Query::create()
        ->select('p.ID_PROJECT, LEFT(p.TITLE,65) AS TITLE, LEFT(p.DESCRIPTION,125) AS DESCRIPTION, p.USER_ID, p.ALBUM_ID, a.ID_ALBUM, f.PIC')
        ->from('Projects p')
        ->leftJoin('p.Albums a')
        ->leftJoin('a.Pics f')
        ->where('p.USER_ID = ?', $id);
      $ob = $q->execute();
      $ar = $ob->toArray();
      //var_dump($ar);
      
      if(sizeof($ar) > 0)
      {
               
          for($i=0; $i < sizeof($ar); $i++)
          {
              if(sizeof($ar[$i]['Albums']['Pics']) > 0)
              {
                for($j = 0; $j < sizeof($ar[$i]['Albums']['Pics']); $j++)
                {
                    
                  $pic = $ar[$i]['Albums']['Pics'][$j]['PIC'];
                  $ar[$i]['Albums']['Pics'][$j]['PIC'] = 'img/projects/'.$pic;
                  $ar[$i]['Albums']['Pics'][$j]['THUMB'] = 'img/projects/thumb/'.$pic;  
                    
                }
              }
              else
              {
                  
                  $ar[$i]['Albums']['Pics'][0]['PIC'] = 'img/projects/default.jpg';
                  $ar[$i]['Albums']['Pics'][0]['THUMB'] = 'img/projects/thumb/default.jpg';
              }   
          }
          
          return $ar;
       }
       else
       {

            return false;
       }
    }



    function deleteProject($id)
    {
      try
      {
        $data = $this->table->find($id);
        $pics = new BOPics;
        if($pics->deleteAllPics($data->ALBUM_ID, '../img/projects/'))
        $this->table->deleteProject($id);
        return true;
      } 
      catch (Exception $e)
      {
        $this->err = $e->getMessage();
        return false;
      }
    }

    function howmuch_projects()
    {
        $r = $this->table->howmuch_projects();
        return $r;
    }

    function searchProjects($string, $from)
    {
        $q = Doctrine_Query::create()
            ->select('p.ID_PROJECT, LEFT(p.TITLE,15) AS TITLE, LEFT(p.DESCRIPTION, 35) AS DESCRIPTION, p.USER_ID, p.ALBUM_ID, a.ID_ALBUM, f.PIC')
            ->from('Projects p')
            ->leftJoin('p.Albums a')
            ->leftJoin('a.Pics f')
            ->where('p.TITLE LIKE ?', '%'.$string.'%')
            ->orWhere('p.DESCRIPTION LIKE ?', '%'.$string.'%')
            ->orderBy('p.ID_PROJECT DESC')
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
            ->select('COUNT(p.ID_PROJECT) as QTY')
            ->from('Projects p')
            ->where('p.TITLE LIKE ?', '%'.$string.'%')
            ->orWhere('p.DESCRIPTION LIKE ?', '%'.$string.'%')
            ->orderBy('p.ID_PROJECT DESC');
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



//$myProject = new BOProjects;
//$query = array('title'=>'titulo 3', 'description'=>'description 3', 'user_id'=> 7, 'album_id'=> 1);
//var_dump($myProject->insertProjects($query));
//var_dump($myProject->getAllProjects());
//var_dump($myProject->getProjectsByUser(5));

?>
