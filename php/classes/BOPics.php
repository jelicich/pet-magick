
<?php

include_once('tools/bootstrap.php');
include_once('models/PicsTable.php');


class BOPics{

  var $table;
  var $err;
  var $mime = array('image/JPG','image/JPEG','image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');

  function __construct(){

    $this->table = Doctrine_Core::getTable('Pics');
  }
//=============================================================================== VALIDATIONS


function val($query){

   /*   if( !isset($query['file']) )
      {
        throw new Exception('<span>esta vacio desde php images</span>');
        return;
      }*/

      if($query['fileSize'] > 900000000000) 
      {// ver q medidas necesito aca para cada formato, tal vez separarlos
        throw new Exception('<span>muy grande desde php images</span>');
        return;
      }
      if(!in_array($query['fileType'], $this->mime)){
        // ver si esto lo junto  o lo evaluo separado
        throw new Exception('<span>formato invalido desde php images</span>');
        return;
      }
}// End function upload_img
 
//=============================================================================== FUNCTIONS

function upload($query,$path){

        try
            {    
              $this->val($query);

              $ext = pathinfo($query['fileName'], PATHINFO_EXTENSION);
              $rand = rand(1000,9999);
              //$path = "../img";
              
              $newName = $rand . "_" . time() .'.' . $ext;  
              move_uploaded_file($query['file'], $path.'/'.$newName);
              $fullpath = $path.$newName;
              $thumbpath = $path."thumb/".$newName; //para thumb
              $caption = $query['caption'];
              

              $imgOriginal = $fullpath ;

              //creo una nueva foto a partir de la anterior
              $img_original = imagecreatefromjpeg( $imgOriginal );
              // maximo ancho y alto
              $max_ancho = 220;
              $max_alto = 2000;

              // separo alto y ancho de la imgOriginal en dos variables
              list( $anchoImgOriginal, $altoImgOriginal ) = getimagesize( $imgOriginal ) ;

              $x_ratio = $max_ancho / $anchoImgOriginal ;
              $y_ratio = $max_alto / $altoImgOriginal ;

              if( $anchoImgOriginal <= $max_ancho){
                $anchoFinal = $anchoImgOriginal ;
                $altoFinal = $altoImgOriginal ;
              }
              elseif( $anchoImgOriginal > $max_ancho ){
                $altoFinal = ceil( $x_ratio * $altoImgOriginal ) ;
                $anchoFinal = $max_ancho ; 
              } elseif( $altoImgOriginal > $max_alto ){
                $anchoFinal = ceil( $y_ratio * $anchoImgOriginal ) ;
                $altoFinal = $max_alto ; 
              }

              $imgNueva = imagecreatetruecolor( $anchoFinal, $altoFinal ) ;
              //ACA HABRIA Q VER COMO CROPEAR debe ser una gilada
              imagecopyresampled( $imgNueva, $img_original, 0, 0, 0, 0, $anchoFinal, $altoFinal, $anchoImgOriginal, $altoImgOriginal );

              //imagedestroy( $img_original );

              $calidad = 100 ;

              imagejpeg( $imgNueva, $thumbpath, $calidad ) ;
              
              $query = array(
                 'pic'=>$fullpath, 
                 'thumb'=>$thumbpath,
                 'caption'=>$caption
              );

              $this->table->upload($query);
               return true;
            }

        catch(Exception $e)
            {
              $this->err = $e->getMessage();
              return false;
            }
}// End function upload_img

function getErrors(){

    return  $this->err;
}

}//End class BOPics


?>
