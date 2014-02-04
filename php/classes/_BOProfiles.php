<?php

include_once('tools/bootstrap.php');
include_once('models/UsersTable.php');
include_once('models/PicsTable.php');
include_once('models/PetsTable.php');
include_once('models/CountriesTable.php');
include_once('models/RegionsTable.php');
include_once('models/CitiesTable.php');
include_once('models/NewsTable.php');
include_once('models/VideosTable.php');
include_once('models/AlbumsTable.php');



class BOProfiles{
  
    var $err;
    var $userId;
    var $name;
    var $lastname;
    var $nameComp;
    var $nickname;
    var $profilePic;
    var $thumb;
    var $about;
    var $location;
    var $news;
    var $videos;
    var $albumId;
    var $petList;
    var $countryId;
    var $regionId;
    var $cityId;


    function __construct($id)
    {
        $this->usersTable = Doctrine_Core::getTable('Users');
        $this->picsTable = Doctrine_Core::getTable('Pics');
        $this->petsTable = Doctrine_Core::getTable('Pets');
        $this->countriesTable = Doctrine_Core::getTable('Countries');
        $this->regionsTable = Doctrine_Core::getTable('Regions');
        $this->citiesTable = Doctrine_Core::getTable('Cities');
        $this->newsTable = Doctrine_Core::getTable('News');
        $this->videosTable = Doctrine_Core::getTable('Videos');
        $this->albumsTable = Doctrine_Core::getTable('Albums');
        $this->userId = $id;
        $this->getUserData($id);
    }


    function getUserData($id)
    {
        $data = $this->usersTable->find($id);
        //var_dump($data);
        $this->nameComp = $data->NAME . ' ' . $data->LASTNAME;
        $this->name = $data->NAME;
        $this->lastname = $data->LASTNAME;
        $this->nickname = $data->NICKNAME;        
        $this->about = $data->ABOUT;
        

        //no puedo traer todo de una como hizo vidaurri asiq voy trayendo de a poco
        if(!empty($data->PIC_ID))
        {
            $p = $this->picsTable->find($data->PIC_ID);
            $this->profilePic = $p->PIC;
            $this->thumb = $p->THUMB;
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
            $this->countryId = $data->COUNTRY_ID;
            $c = $this->countriesTable->find($data->COUNTRY_ID);
            $this->location = $c->Country;

            if(!empty($data->REGION_ID))
            {
                $this->regionId = $data->REGION_ID;
                $r = $this->regionsTable->find($data->REGION_ID);
                $this->location .= ', '.$r->Region;

                if(!empty($data->CITY_ID))
                {
                    $this->cityId = $data->CITY_ID;
                    $c = $this->citiesTable->find($data->CITY_ID);
                    $this->location .= ', '.$c->City;
                }

            }
        }
       

        //===NEWS 

        $news = $this->newsTable->getNewsByUser($id);
        if(!empty($news))
        {
            $this->news = $news;
        }
        else
        {
            $this->news = false;
        }

        
      

        
        //===PETLIST

        $pets = $this->petsTable->getPetListByUser($id); 
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
                    $petsArray[$i]['PIC'] = $p->PIC; 
                    $petsArray[$i]['THUMB'] = $p->THUMB; 
                }
                
                /*
                //== VIDEO
                $videos = $this->videosTable->getVideosByPet($petsArray[$i]['ID_PET']);
                
                if(!empty($videos))
                {
                    $petsArray[$i]['VIDEO'] = $videos[0]; //GUARDO LA POSICIón 0 ya que solo permitiremos guardar un solo video
                    $t = $this->picsTable->find($videos[0]['THUMB_ID']);
                    $petsArray[$i]['VIDEO']['THUMB'] = $t->PIC;
                }
                else
                {
                    $petsArray[$i]['VIDEO'] = false;
                }
                */

            }




            $this->petList = $petsArray;
            //var_dump($petsArray);
        }
        else
        {
            $this->petList = false;
        }
    }

    
    //===PET
    function getPet($id)
    {
        $p = $this->petsTable->find($id);
        $pet = $p->toArray();
        
        if($pet['PIC_ID'] == null)
        {
            $pet['PIC'] = 'img/pets/default.jpg';
            $pet['THUMB'] = 'img/pets/thumb/default.jpg';
        }
        else
        {
            $p = $this->picsTable->find($pet['PIC_ID']);
            $pet['PIC'] = $p->PIC; 
            $pet['THUMB'] = $p->THUMB; 
        }

        //$vid = $this->videosTable->find($pet['VIDEO_ID'])

        $videos = $this->videosTable->getVideosByPet($pet['ID_PET']);
                
        if(!empty($videos))
        {
            $pet['VIDEO'] = $videos[0]; //GUARDO LA POSICIón 0 ya que solo permitiremos guardar un solo video
            $t = $this->picsTable->find($videos[0]['THUMB_ID']);
            $pet['VIDEO']['THUMB'] = $t->PIC;
        }
        else
        {
            $pet['VIDEO'] = false;
        }



        //$this->pet = $pet;
        return $pet;
    }

    //==== Own profile
    function isOwn()
    {
        if(isset($_SESSION['id']) && $_GET['u'] == $_SESSION['id'])
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function getAlbum($id)
    {
        $a = $this->picsTable->getPicsByAlbum($id);
        return $a;
    }
    

    //==== GETS
    function getName()
    {
        return $this->name;   
    }

    function getLastname()
    {
        return $this->lastname;   
    }
    
    function getNameComp()
    {
        return $this->nameComp;
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

    function getNews()
    {
        return $this->news;
    }

    function getLocation()
    {
        return $this->location;
    }

    function getPetList()
    {
        return $this->petList;
    }

    function getAlbumId()
    {
        return $this->albumId;
    }

    function getCountryId()
    {
        return $this->countryId;
    }

    function getRegionId()
    {
        return $this->regionId;
    }

    function getCityId()
    {
        return $this->cityId;
    }

}


$p = new BOProfiles(5);

$p->getAlbum(1);


//echo $p->getName().' '. $p->getNickName().' '. $p->getProfilePic().' '. $p->getThumb().' '. $p->getAbout().' '. $p->getLocation();
?>
