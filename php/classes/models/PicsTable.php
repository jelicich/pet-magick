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

     public function upload($ref){

     			$now = date('Y-m-d');

     		    $Pics = new Pics();
	            $Pics->PIC = $ref['pic'];
                $Pics->THUMB = $ref['thumb'];
	            $Pics->DATE = $now;
	            $Pics->CAPTION = $ref['caption'];
                $Pics->THUMBNAIL = null;
                if(isset($ref['album-id']))
                    $Pics->ALBUM_ID = $ref['album-id'];

                $Pics->save();
                $id_last = $Pics->ID_PIC;
                return $id_last;
	 }// end upload_img

     public function getPicsByAlbum($id)
     {

        $q = Doctrine_Query::create()
            ->from('Pics p') 
            ->AndWhere('p.ALBUM_ID = ?',$id);
        $rta = $q->execute(); 
        
        return $rta->toArray();
     }

     function deletePic($id)
    {
        $q = Doctrine_Query::create()
            ->delete('Pics p')
            ->where('p.ID_PIC = ?', $id );
        $q->execute();
    }

    function deleteAllPics($id)
    {
        $q = Doctrine_Query::create()
            ->delete('Pics p')
            ->where('p.ALBUM_ID = ?', $id );
        $q->execute();
    }
}