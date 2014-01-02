<?php

/**
 * PicsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PicsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PicsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Pics');
    }

     public function upload_img($ref){

     			$now = date('Y-m-d');

     		    $Pics = new Pics();
	            $Pics->PIC = $ref['pic'];
	            $Pics->DATE = $now;
	            $Pics->CAPTION = $ref['caption'];
	            $Pics->THUMB = $ref['thumb']; // Lo puse not null para hacer pruebas en mi BD
	            $Pics->ALBUM_ID = $ref['album_id'];

                $Pics->save();
	 }// end upload_img

     public function getPicsByAlbum($id)
     {

        $q = Doctrine_Query::create()
            ->from('Pics p') 
            ->AndWhere('p.ALBUM_ID = ?',$id);
        $rta = $q->execute(); 
        
        return $rta->toArray();
     }
}