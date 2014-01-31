<?php

include_once('tools/bootstrap.php');
include_once('models/PetsTable.php');
include_once('models/PicsTable.php');
include_once('models/VideosTable.php');
include_once('models/TributesTable.php');
include_once ('BOPics.php');
include_once ('BOAlbums.php');
include_once ('BOTributes.php');


class BOPets{

    var $table;

    var $err;

    function __construct()
    {
        $this->table = Doctrine_Core::getTable('Pets');
        $this->picsTable = Doctrine_Core::getTable('Pics');
        $this->videosTable = Doctrine_Core::getTable('Videos');
        $this->tributesTable = Doctrine_Core::getTable('Tributes');
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
        $this->owner = $p->USER_ID;
        $this->id = $id;
        $this->category = $p->ANIMAL_CATEGORY_ID;

        if($p->PIC_ID == null)
        {
            $this->pic = 'img/pets/default.jpg';
            $this->thumb = 'img/pets/thumb/default.jpg';
            $this->hasPic = false;
        }
        else
        {
            $pic = $this->picsTable->find($p->PIC_ID);
            $this->picId = $p->PIC_ID;
            $this->pic = 'img/pets/'.$pic->PIC; 
            $this->thumb = 'img/pets/thumb/'.$pic->PIC; 
            $this->hasPic = true;
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

    function getOwner()
    {
        return $this->owner;
    }

    function getId()
    {
        return $this->id;
    }

    function getCategory()
    {
        return $this->category;
    }

    function getPicId()
    {
      return $this->picId;
    }

    function hasPic()
    {
      return $this->hasPic;
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


    function isOwn()
    {
      if(isset($_SESSION['id']) && $this->owner == $_SESSION['id'])
      {
          return true;
      }
      else
      {
          return false;
      }
    }


    function updateInfo($array, $path)
    {
        if($this->val_updateInfo($array))
        {
            $pic = new BOPics;
            $dataPic = $this->table->find($_POST['p']);
            $oldPic = $dataPic->PIC_ID;
            $r = $this->table->updateInfo($array);
            
            //borro la imagen original de perfil
            if(!empty($array['pic']) && is_numeric($array['pic']))
            {
              if(!empty($oldPic))
                $pic->unlinkProfilePic($oldPic, $path);
            }
            elseif(isset($array['delete-pic']))
            {
               
               for($i = 0; $i < sizeof($array['delete-pic']); $i++)
               {
                  $pic->unlinkProfilePic($array['delete-pic'][$i], $path);    
               }
            }
            return true;
        }// end if
        else
        {
            return false;
        }

    }

    function val_updateInfo($array)
    {
        if( empty($array['name']) || empty($array['animal-category']) )
        {
          $er = '<ul class="update-err">';
          
          if(empty($array['name']))
            $er .= '<li>The name field is mandatory</li>';
          if(empty($array['animal-category']))
            $er .= '<li>The animal category field is mandatory</li>';
          
          $er .= '</ul>';
          $this->err = $er;
          return false;
        }
        else
        {
          return true;
        }
    }

    function updateAlbum($array, $path)
    {
       
        
        $pic = new BOPics;
        
        if(isset($array['delete-pic']))
        {
            for($i = 0; $i < sizeof($array['delete-pic']); $i++)
            {
                $pic->unlinkProfilePic($array['delete-pic'][$i], $path);    
            }
            
        }

        /*
        $dataPic = $this->table->find($_POST['p']);
        $oldPic = $dataPic->PIC_ID;
        
        $r = $this->table->updateInfo($array);
        
        //borro la imagen original de perfil
        if(!empty($array['pic']) && is_numeric($array['pic']))
        {
          if(!empty($oldPic))
            $pic->unlinkProfilePic($oldPic, $path);
        }
        */


    }


    function getErr()
    {
        return $this->err;
    }

    function getAlbumIdByPet($id)
    {
        return $this->table->getAlbumIdByPet($id);
    }


    function setAlbum($albumId, $petId)
    {
        $this->table->setAlbum($albumId, $petId);
    }

    function getOwnerId($id)
    {
        $p = $this->table->find($id);
        return $p->USER_ID;
    }

    function setPicNull($id)
    {
        $this->table->setPicNull($id);
    }

    function setAlbumNull($id)
    {
        $this->table->setAlbumNull($id);   
    }

    function deleteAllData($id)
    {
        //borro todas las fotos del album
        $petData = $this->table->find($id);
        $pics = new BOPics;
        $pics->deleteAllPics($petData->ALBUM_ID, '../img/pets/');

        if($this->hasTribute($id))
        {
            $tr = new BOTributes;
            $tr->deleteTributeByPet($id);
        }

        //seteo la foto de perfil en null para que me deje borrrarla de la base
        $this->setPicNull($id); 

        //borro la foto de perfil
        if($petData->PIC_ID)
            $pics->unlinkProfilePic($petData->PIC_ID, '../img/pets/');

        //borro el album
        $this->setAlbumNull($id);
        $album = new BOAlbums;
        $album->deleteAlbum($petData->ALBUM_ID);

        //borro la mascota
        $this->table->deletePet($id);
    }

    function addPet($array)
    {

        if($this->val_addPet($array))
        {
            $this->val_addPet($array);
        

            $r = $this->table->addPet($array);
            return $r;    
        }
        else

            return false;
    
    }

    function val_addPet($array)
    {
        if( empty($array['name']) || empty($array['animal-category']) )
        {
          
          if(empty($array['name']))
            $this->err[] = 'The name field is mandatory';
          if(empty($array['animal-category']))
            $this->err[] = 'The animal category field is mandatory';
          
          return false;
        }
        else
        {
          return true;
        }
    }

    function hasTribute($id)
    {
        $r=$this->tributesTable->getTributeByPet($id);
        if(empty($r[0]['ID_TRIBUTE']))
        {
            return false;
        }
        else
        {
            $this->tribute = $r[0]['ID_TRIBUTE'];
            return true;
        }

    }

    function getTributeId()
    {
        return $this->tribute;
    }
}//End class BOUsers


?>
