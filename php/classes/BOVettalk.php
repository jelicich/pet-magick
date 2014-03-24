<?php

include_once('tools/bootstrap.php');
include_once('models/VetTalkTable.php');
include_once ('BOPics.php');


class BOVettalk{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('VetTalk');
    }

    function insertArticle($ref){

        try{ 
            $this->table->insertArticle($ref);
            return true;
        }
        catch(Exception $e){

              $this->err = $e->getMessage();
              return false;
        }
    }//End insertArticle

    function getAllArticles(){

       $array = $this->table->getAllArticles();
        return $array;
    }//End getAllArticles

    function getLastArticle(){

       $array = $this->table->getLastArticle();
        return $array;
    }//End getAllArticles

    function getArticlesById($id){ 

         $array = $this->table->getArticlesById($id);
         return $array;
    }// end getOrganizationsByUser


    function getErrors(){

        return  $this->err;
    }


    function getVetTalkListByUser($id)
    {
      $q = Doctrine_Query::create()
        ->select('o.ID_VET_TALK, LEFT(o.TITLE,65) AS TITLE, LEFT(o.CONTENT, 125) AS CONTENT, o.DATE, o.USER_ID, ph.PIC')
        ->from('VetTalk o')
        ->leftJoin('o.Pics ph')
        ->where('o.USER_ID = ?', $id);
      $ob = $q->execute();
      $ar = $ob->toArray();
      if(sizeof($ar) > 0)
      {
               
          for($i=0; $i < sizeof($ar); $i++)
          {
            if(isset($ar[$i]['Pics']['PIC']))
            {
                $pic = $ar[$i]['Pics']['PIC'];
                $ar[$i]['Pics']['PIC'] = 'img/vetTalk/'.$pic;
                $ar[$i]['Pics']['THUMB'] = 'img/vetTalk/thumb/'.$pic;
            }
            else
            {
                $ar[$i]['Pics']['PIC'] = 'img/vetTalk/default.jpg';
                $ar[$i]['Pics']['THUMB'] = 'img/vetTalk/thumb/default.jpg';
            }   
          }
          return $ar;
       }
       else
       {

            return false;
       }
    }

    function deleteVetTalk($id)
    {
      try
      {
        $data = $this->table->find($id);
        $pics = new BOPics;
        if($pics->unlinkProfilePic($data->PIC_ID, '../img/vetTalk/'))

        $this->table->deleteVetTalk($id);
        return true;
      } 
      catch (Exception $e)
      {
        $this->err = $e->getMessage();
        return false;
      }

    }

}//End class BOVettalk



//$article = new BOVettalk;
//$query = array('title'=>'title 3', 'content'=>'content 3', 'user_id'=> 5, 'pic_id'=> 192);
//var_dump($article->insertArticle($query));
//var_dump($article->getLastArticles());
//var_dump($article->getOrganizationsByUser(5));


?>
