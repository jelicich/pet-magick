<?php

include_once('tools/bootstrap.php');
include_once('models/UsersTable.php');
include_once('models/PicsTable.php');
include_once('models/PetsTable.php');
include_once('models/CountriesTable.php');
include_once('models/RegionsTable.php');
include_once('models/CitiesTable.php');



class BOProfiles{
  
    var $err;
    var $userId;
    var $name;
    var $nickname;
    var $profilePic;
    var $thumb;
    var $about;
    var $location;
    var $albumId;
    var $pets;

    function __construct($id)
    {
        $this->usersTable = Doctrine_Core::getTable('Users');
        $this->picsTable = Doctrine_Core::getTable('Pics');
        $this->petsTable = Doctrine_Core::getTable('Pets');
        $this->countriesTable = Doctrine_Core::getTable('Countries');
        $this->regionsTable = Doctrine_Core::getTable('Regions');
        $this->citiesTable = Doctrine_Core::getTable('Cities');
        $this->userId = $id;
        $this->getUserData($id);
    }


    function getUserData($id)
    {
        $data = $this->usersTable->find($id);
        //var_dump($data);
        $this->name = $data->NAME . ' ' . $data->LASTNAME;
        if(!empty($data->NICKNAME))
            $this->nickname = $data->NICKNAME;
        else
            $this->nickname = $data->NAME;
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
            $this->profilePic = 'img/users/'.$p->PIC;
            $this->thumb = 'img/users/thumb/'.$p->PIC;
        }
        else
        {
            $this->profilePic = 'img/users/default.jpg';
            $this->thumb = 'img/users/thumb/default.jpg';
        }

        if(!empty($data->ALBUM_ID))
        {
            $this->albumId = $data->ALBUM_ID;
        }
        else
        {
            $this->albumId = false;
        }

        if(!empty($data->COUNTRY_ID))
        {
            $c = $this->countriesTable->find($data->COUNTRY_ID);
            $this->location = $c->Country;

            if(!empty($data->REGION_ID))
            {
                $r = $this->regionsTable->find($data->REGION_ID);
                $this->location .= ', '.$r->Region;

                if(!empty($data->CITY_ID))
                {
                    $c = $this->citiesTable->find($data->CITY_ID);
                    $this->location .= ', '.$c->City;
                }

            }
        }
        else
        {
           $this->location = "Nowhere"; //!!!!!!!PROVISORIO ??? Q PONER??? 
        }

        
        //===PETS

        $pets = $this->petsTable->getPetsByUser($id);
        $petsArray = $pets->toArray();
        if(!empty($petsArray))
        {
            for($i = 0; $i < sizeof($petsArray); $i ++)
            {
                if($petsArray[$i]['PIC_ID'] == null)
                {
                    $petsArray[$i]['PIC'] = 'img/pets/default.jpg';
                    $petsArray[$i]['THUMB'] = 'img/pets/thumb/default.jpg';
                }
                else
                {
                    $p = $this->picsTable->find($petsArray[$i]['PIC_ID']);
                    $petsArray[$i]['PIC'] = 'img/pets/' . $p->PIC; 
                    $petsArray[$i]['THUMB'] = 'img/pets/thumb/' . $p->PIC; 
                }
            }

            $this->pets = $petsArray;
            //var_dump($petsArray);
        }
        else
        {
            $this->pets = false;
        }
    }

    
    

    //==== GETS
    function getName()
    {
        return $this->name;
    }

    function getNickName()
    {
        return $this->nickname;
    }

    function getProfilePic()
    {
        return $this->profilePic;
    }

    function getThumb()
    {
        return $this->thumb;
    }

    function getAbout()
    {
        return $this->about;
    }

    function getLocation()
    {
        return $this->location;
    }

    function getPets()
    {
        return $this->pets;
    }

}


//$p = new BOProfiles(5);

//echo $p->getName().' '. $p->getNickName().' '. $p->getProfilePic().' '. $p->getThumb().' '. $p->getAbout().' '. $p->getLocation();
?>
