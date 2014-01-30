<?php

include_once('tools/bootstrap.php');
include_once('models/ProjectsTable.php');

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

    function getAllProjects(){

        $array = $this->table->getAllProjects();
        return $array;
    }// end getAllProjects

    function getProjectsByUser($id){ 

         $array = $this->table-> getProjectsByUser($id);
         return $array;
    }// end getProjectsByUser

    function getAlbumIdByProject($id){

        return $this->table->getAlbumIdByProject($id);
    }// end setAlbum

    function setAlbum($albumId, $projectId){

        $this->table->setAlbum($albumId, $projectId);
    }// end setAlbum

    function getErrors(){

        return  $this->err;
    }// end getErrors


}//End class BOUsers



//$myProject = new BOProjects;
//$query = array('title'=>'titulo 3', 'description'=>'description 3', 'user_id'=> 7, 'album_id'=> 1);
//var_dump($myProject->insertProjects($query));
//var_dump($myProject->getAllProjects());
//var_dump($myProject->getProjectsByUser(5));

?>
