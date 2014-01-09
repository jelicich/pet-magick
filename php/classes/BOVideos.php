<?php

include_once('tools/bootstrap.php');
include_once('models/VideosTable.php');


class BOVideos{

  var $table;
  var $err;
  var $mime = array('video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav');

  function __construct(){

    $this->table = Doctrine_Core::getTable('Videos');
  }

//=============================================================================== VALIDATIONS

  function val($query){

        if($query['fileSize'] > 900000) 
        {// ver q medidas necesito aca para cada formato, tal vez separarlos
          throw new Exception('<span>muy grande desde php videos</span>');
          return;
        }
        if(!in_array($query['fileType'], $this->mime)){

          throw new Exception('<span>formato invalido desde php videos</span>');
          return;
        }
  }// End function upload_img
 
//=============================================================================== FUNCTIONS

  function upload($query){

      try
          {  
            $this->val($query);

            extension_loaded('ffmpeg') or die('Error in loading ffmpeg');
            $ext = pathinfo($query['fileName'], PATHINFO_EXTENSION);
            $rand = rand(1000,9999);
            $path = "../video";
            $newName = $rand . "_" . time() .'.' . $ext; 
            $thumbName =  $rand . "_" . time() .'.jpg';
            move_uploaded_file($query['file'], $path.'/'.$newName);
            $path = realpath($path.'/'.$newName); 
            $thumbPath = '../video/'.$thumbName; //tuve q modificar la ruta pq si no no lo guardaba en la BD , no se pq...
            
            function getThumbImage($route, $thumbRoute){ // ver pq se ejecuta antes de instanciarla esta puta function

              $movie = new ffmpeg_movie($route,false);
              $videoDuration = $movie->getDuration();
              $frameCount = $movie->getFrameCount();
              $frameRate = $movie->getFrameRate();
              $videoTitle = $movie->getTitle();
              $author = $movie->getAuthor() ;
              $copyright = $movie->getCopyright();
              $frameHeight = $movie->getFrameHeight();
              $frameWidth = $movie->getFrameWidth();

              $capPos = ceil($frameCount/4);

              if($frameWidth>120)
              {
                $cropWidth = ceil(($frameWidth-120)/2);
              }
              else
              {
                $cropWidth =0;
              }
              if($frameHeight>90)
              {
                $cropHeight = ceil(($frameHeight-90)/2);
              }
              else
              {
                $cropHeight = 0;
              }
              if($cropWidth%2!=0)
              {
                $cropWidth = $cropWidth-1;
              }
              if($cropHeight%2!=0)
              {
                $cropHeight = $cropHeight-1;
              }

                $frameObject = $movie->getFrame($capPos);


              if($frameObject)
              {
                $imageName = $thumbRoute;
                $tmbPath = $imageName;
                $frameObject->resize(120,90,0,0,0,0);
                imagejpeg($frameObject->toGDImage(),$tmbPath);
              }
              else
              {
                $imageName="";
              }
              return $imageName;
            }
            
            getThumbImage($path, $thumbPath);

            $title = 'provisorio!!!!!!';
            $caption = 'provisorio!!!!!!';
            $path = '../video/'.$newName;
            
            $query = array(
                 'video'=>$path, 
                 'title'=>$title, 
                 'caption'=>$caption, 
                 'thumbnail'=>$thumbPath, //tuve q modificar la ruta pq si no no lo guardaba en la BD , no se pq...
                 'album_id'=> null 
            );

            $this->table->upload($query);
            return true;
          }

      catch(Exception $e)
          {
            $this->err = $e->getMessage();
            return false;
          }
  }// End upload_video

  function getErrors(){

      return  $this->err;
  }// End getErrors

}//end class

