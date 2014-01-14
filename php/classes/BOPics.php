
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
              move_uploaded_file($query['file'], $path.$newName);
              $fullpath = $path.$newName;
              $thumbpath = $path."thumb/".$newName; //para thumb
              $caption = $query['caption'];
              

              $imgOriginal = $fullpath ;
              
              //CROPPPP !!!
              list($org_ancho, $org_alto) = getimagesize($imgOriginal);
              $img_original = imagecreatefromjpeg( $imgOriginal );

              if ($org_ancho > $org_alto) //si el ancho es mayor al alto, es del tipo apaisada.
              {
                $nue_ancho = $org_alto;
                $nue_alto = $org_alto;
                $ratio = $org_alto / $nue_alto;
                $tmp_ancho = round($nue_ancho * $ratio);
                $dif_ancho = round(($org_ancho / 2) - ($tmp_ancho / 2));

                $nueva = imagecreatetruecolor($nue_ancho, $nue_alto);
                imagecopyresampled($nueva, $img_original, 0, 0, $dif_ancho, 0, $nue_ancho, $nue_alto, $tmp_ancho, $org_alto);
              }
              else //si el ancho es menor o igual al alto, es del tipo retrato o cuadrada
              {
                $nue_ancho = $org_ancho;
                $nue_alto = $org_ancho;
                $ratio = $org_ancho / $nue_ancho;
                $tmp_alto = round($nue_alto * $ratio);
                $dif_alto = round(($org_alto / 2) - ($tmp_alto / 2));

                $nueva = imagecreatetruecolor($nue_ancho, $nue_alto);
                imagecopyresampled($nueva, $img_original, 0, 0, 0, $dif_alto, $nue_ancho, $nue_alto, $org_ancho, $tmp_alto);
              }

              //imageinterlace($nueva, 1); //hacemos que la imagen sea progresiva
              imagejpeg( $nueva, '../img/temp/'.$newName, '100' ) ;

              

              //RESIZE !!!!
              $imgOriginal = '../img/temp/'.$newName ;
              // separo alto y ancho de la imgOriginal en dos variables
              list( $anchoImgOriginal, $altoImgOriginal ) = getimagesize( $imgOriginal ) ;
              //creo una nueva foto a partir de la anterior

              $img_original = imagecreatefromjpeg( $imgOriginal );
              // maximo ancho y alto
              $max_ancho = 123;
              $max_alto = 123;

              // separo alto y ancho de la imgOriginal en dos variables
              
              //list( $anchoImgOriginal, $altoImgOriginal ) = getimagesize( $img_original ) ;
              /*
              $x_ratio = $max_ancho / $anchoImgOriginal ;
              $y_ratio = $max_alto / $altoImgOriginal ;

              if( $anchoImgOriginal <= $max_ancho){
                $anchoFinal = $anchoImgOriginal ;
                $altoFinal = $altoImgOriginal ;
                echo 'paso 1';
              }
              elseif( $anchoImgOriginal > $max_ancho ){
                $altoFinal = ceil( $x_ratio * $altoImgOriginal ) ;
                $anchoFinal = $max_ancho ; 
                echo 'paso 2';
              } elseif( $altoImgOriginal > $max_alto ){
                $anchoFinal = ceil( $y_ratio * $anchoImgOriginal ) ;
                $altoFinal = $max_alto ; 
                echo 'paso 3';
              }
              */

              $imgNueva = imagecreatetruecolor( $max_ancho, $max_alto ) ;
              
              imagecopyresampled( $imgNueva, $img_original, 0, 0, 0, 0, $max_ancho, $max_alto, $anchoImgOriginal, $altoImgOriginal );

              //imagedestroy( $img_original );

              $calidad = 100 ;
              imageinterlace($imgNueva, 1); //hacemos que la imagen sea progresiva
              imagejpeg( $imgNueva, $thumbpath, $calidad ) ;
              

              //BORRO LA TEMPORAL
              unlink($imgOriginal);

              
              $query = array(
                 //'pic'=>$fullpath, //Cambio esto, porque esta guardando en la base de datos la ruta "../img/blabla" lo cual está mal, ya que cuando entras a (por ej) user-profile.php intenta subir un nivel para encontrar la carpeta img, cuando la carpeta img está en el mismo nivel que user-profile (y todas las paginas).
                 'pic'=>$newName, 
                 'thumb'=>$thumbpath,
                 'caption'=>$caption
              );

              $id_last = $this->table->upload($query);
              return $id_last;
            }

        catch(Exception $e)
            {
              $this->err = $e->getMessage();
              return false;
            }
}// End function upload_img

function unlinkProfilePic($id, $path)
{
  $data = $this->table->find($id);
  //$this->table->deletePicture($id);
  unlink($path.$data->PIC);
  unlink($path.'thumb/'.$data->PIC);
  $this->table->deletePic($id);
}

function getErrors(){

    return  $this->err;
}

}//End class BOPics


?>
