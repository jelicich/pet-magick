<?php

include_once('tools/bootstrap.php');
include_once('models/PetsTable.php');
include_once('models/PicsTable.php');
include_once('models/VideosTable.php');



class BOPets{

    var $table;

    var $err;

    function __construct()
    {
        $this->table = Doctrine_Core::getTable('Pets');
        $this->picsTable = Doctrine_Core::getTable('Pics');
        $this->videosTable = Doctrine_Core::getTable('Videos');
    }

    //$id = user ID
    function getPetList($id)
    {
        $pets = $this->table->getPetListByUser($id); 
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
                    $petsArray[$i]['PIC'] = 'img/pets/'.$p->PIC; 
                    $petsArray[$i]['THUMB'] = 'img/pets/thumb/'.$p->PIC; 
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

        return $this->petList;
    }


    //$id = pet ID 
    function getPetData($id)
    {
        $p = $this->table->find($id);
        
        $this->name = $p->NAME;
        $this->breed = $p->BREED;
        $this->traits = $p->TRAITS;
        $this->story = $p->STORY;
        


        
        if($p->PIC_ID == null)
        {
            $this->pic = 'img/pets/default.jpg';
            $this->thumb = 'img/pets/thumb/default.jpg';
        }
        else
        {
            $pic = $this->picsTable->find($p->PIC_ID);
            $this->pic = 'img/pets/'.$pic->PIC; 
            $this->thumb = 'img/pets/thumb/'.$pic->PIC; 
        }

        //$vid = $this->videosTable->find($pet['VIDEO_ID'])

        if(!empty($p->ALBUM_ID))
        {
            $this->albumId = $p->ALBUM_ID;
        }
        else
        {
            $this->albumId = false;
        }

        $videos = $this->videosTable->getVideosByPet($p->ID_PET);
                
        if(!empty($videos))
        {
            $this->video = $videos[0]; //GUARDO LA POSICIón 0 ya que solo permitiremos guardar un solo video
        }
        else
        {
            $this->video = false;
        }



        //$this->pet = $pet;
        //return $pet;
    }

    function getName()
    {
        return $this->name;
    }

    function getPic()
    {
        return $this->pic;
    }

    function getThumb()
    {
        return $this->thumb;
    }

    function getBreed()
    {
        return $this->breed;
    }

    function getTraits()
    {
        return $this->traits;
    }

    function getStory()
    {
        return $this->story;
    }

    function getVideo()
    {
        return $this->video;
    }

    function getAlbumId()
    {
        return $this->albumId;
    }



    //$id = album ID
    function getAlbum($id)
    {
        $a = $this->picsTable->getPicsByAlbum($id);
        for($i=0; $i<sizeof($a); $i++)
        {
            $file=$a[$i]['PIC'];
            $a[$i]['PIC'] = 'img/pets/' . $file;
            $a[$i]['THUMB'] = 'img/pets/thumb/' . $file;
        }
        return $a;
    }


    function getPetsByCat($id)
    {
        $array = $this->table->getPetsByCat($id);
        return $array;
    }



}//End class BOUsers


?>
