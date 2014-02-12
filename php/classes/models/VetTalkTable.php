<?php

/**
 * VetTalkTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class VetTalkTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object VetTalkTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('VetTalk');
    } 


    public function insertArticle($ref){

    	    $now = date('Y-m-d');

            $VetTalk = new VetTalk();
            $VetTalk->TITLE = $ref['title'];
            $VetTalk->CONTENT = $ref['content'];
            $VetTalk->DATE = $now;
            $VetTalk->USER_ID = $ref['user_id'];
            $VetTalk->PIC_ID = $ref['pic_id'];

            $VetTalk->save();
    }// end insertArticle

    public function getAllArticles(){

        $q = Doctrine_Query::create()

              ->select('v.*, ph.PIC, ph.thumb') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
              ->from('VetTalk v')
              ->leftJoin('v.Pics ph')
              ->orderBy('v.date DESC'); 
          

        $r = $q->execute();    
          if($r)
            return $r->toArray();
        else
            return false;

    }//End getAllArticles

    public function getLastArticle(){

        $userCount = Doctrine::getTable('Organizations')->count();
        $user = Doctrine::getTable('Organizations')
        ->createQuery()
        ->select('v.*, ph.PIC, ph.thumb, u.NAME, u.LASTNAME') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
        ->from('VetTalk v')
        ->innerJoin('v.Users u')
        ->leftJoin('v.Pics ph')
        ->limit(1)
        ->orderBy('v.date DESC')
        //->offset(rand(0, $userCount - 1))
        ->fetchOne();

        if($user)
            return $user->toArray();
        else
            return false;


    }//End getLastArticles

     public  function getArticlesById($id){ 

         $q = Doctrine_Query::create()

            ->select('v.*, ph.PIC, ph.thumb, u.NAME, u.LASTNAME') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
            ->from('VetTalk v')
            ->innerJoin('v.Users u')
            ->leftJoin('v.Pics ph')
            ->where('v.ID_VET_TALK = ?', $id)
            ->groupBy('v.ID_VET_TALK');
        

            $p = $q->execute(); 
            if($p)
                return $p->toArray();
            else
                return false;


    }// end getOrganizationsByUser

    public function deleteVetTalk($id)
    {
        $q= Doctrine_Query::create()
            ->delete('VetTalk v')
            ->where('v.ID_VET_TALK =?', $id);
        $q->execute();
    }

}