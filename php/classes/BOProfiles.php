<?php

include_once('tools/bootstrap.php');
include_once('models/UsersTable.php');
include_once('models/PicsTable.php');
include_once('models/PetsTable.php');



class BOProfiles{
  
    var $err;
    var $userId;
    var $name;
    var $nickname;
    var $profilePic;
    var $thumb;
    var $about;

    function __construct($id)
    {
        $this->usersTable = Doctrine_Core::getTable('Users');
        $this->picsTable = Doctrine_Core::getTable('Pics');
        $this->petsTable = Doctrine_Core::getTable('Pets');
        $this->userId = $id;
        $this->getUserData($id);
    }


    function getUserData($id)
    {
        $data = $this->usersTable->find($id);
        //var_dump($data);
        $this->name = $data->NAME . ' ' . $data->LASTNAME;
        if(!empty($data->NICKNAME) || $data->NICKNAME != '')
            $this->nickname = $data->NICKNAME;
        
        if(!empty($data->ABOUT))
        {
            $this->about = $data->ABOUT;
        }
        else
        {
            $this->about = 'The user has not entered a description yet.';
        }

        //no puedo traer todo de una como hizo vidaurri asiq voy trayendo de a poco
        if(!empty($data->PIC_ID))
        {
            $p = $this->picsTable->find($data->PIC_ID);
            $this->profilePic = $p->PIC;

            $t = $this->picsTable->find($p->THUMBNAIL);
            $this->thumb = $t->PIC;
        }

        $pets = $this->petsTable->getPetsByUser($id);
        $petsArray = $pets->toArray();
        if(!empty($petsArray))
        {
            //ver cómo trae las mascotas si son varias y cómo manejarlas desde acá para luego entregarlas para imprimir.
        }
        else
        {
            echo 'no pets';
        }
    }
      

}


$p = new BOProfiles(5);


?>
