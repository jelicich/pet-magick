<?php

include_once('tools/bootstrap.php');
include_once('models/BlogsTable.php');

class BOBlogs{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('Blogs');
    }// end __construct

    function insertBlogs($ref){

        try{ 
            
            $this->table->insertBlogs($ref);
            return true;
        }
        catch(Exception $e){

              $this->err = $e->getMessage();
              return false;
        }
    }// end insertOrganizations

    function getLastBlog(){


       $array = $this->table->getLastBlog();
        return $array;
    }//End getAllArticles
    

    function getAllBlogs(){
       
         $q = Doctrine_Query::create()

              ->select('b.*, ph.PIC') 
              ->from('Blogs b')
              ->leftJoin('b.Pics ph')
              ->orderBy('DATE'); // ver si este order funciona
          
          $r = $q->execute();    
          
          return $r->toArray();
    }// end getAllOrganizations

    function getBlogsById($id){ 

         $q = Doctrine_Query::create()

            ->select('b.*, ph.PIC') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
            ->from('Blogs b')
            //->innerJoin('o.Users u')
            ->leftJoin('b.Pics ph')
            ->where('b.ID_BLOG = ?', $id)
            ->groupBy('b.ID_BLOG');
        
            $p = $q->execute();    
       
           if(sizeof($p) > 0){
               
                return $p->toArray();

           }else{

                return false;
           }
    }// end getOrganizationsByUser

    function getErrors(){

        return  $this->err;
    }// end getErrors

    function deleteBlog($id){
      try
      {
        $this->table->deleteBlog($id);
        return true;
      } 
      catch (Exception $e)
      {
        $this->err = $e->getMessage();
        return false;
      }
    }



 /*     function getOrganizationsByUser($id){ 

         $q = Doctrine_Query::create()

            ->select('o.ID_ORGANIZATION, o.NAME, o.DESCRIPTION, o.USER_ID, ph.PIC') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
            ->from('Organizations o')
            ->leftJoin('o.Pics ph') // van con leftJoin, sino, si el usuario no tiene nada cargado, no trae nada
            ->where('o.USER_ID = ?', $id);
        
            $p = $q->execute();    
       
           if(sizeof($p) > 0){
               
                return $p->toArray();

           }else{

                return false;
           }
    }// end getOrganizationsByUser

  function getOrganizationsRamdom(){ // revisar esta funcion pq no me queda claro q carajo me trae, aunque anda
          
        $userCount = Doctrine::getTable('Organizations')->count();
        $user = Doctrine::getTable('Organizations')
        ->createQuery()
        ->select('o.ID_ORGANIZATION, o.NAME, o.DESCRIPTION, o.USER_ID, ph.PIC') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
        ->from('Organizations o')
        ->leftJoin('o.Pics ph') 
        ->limit(1)
        ->offset(rand(0, $userCount - 1))
        ->fetchOne();

       return $user->toArray();
    }// end getOrganizationsRamdom

    function getOrgListByUser($id)
    {
      $q = Doctrine_Query::create()
        ->select('o.ID_ORGANIZATION, o.NAME, o.DESCRIPTION, o.USER_ID, ph.PIC')
        ->from('Organizations o')
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
                $ar[$i]['Pics']['PIC'] = 'img/organizations/'.$pic;
                $ar[$i]['Pics']['THUMB'] = 'img/organizations/thumb/'.$pic;
            }
            else
            {
                $ar[$i]['Pics']['PIC'] = 'img/organizations/default.jpg';
                $ar[$i]['Pics']['THUMB'] = 'img/organizations/thumb/default.jpg';
            }   
          }
          return $ar;
       }
       else
       {

            return false;
       }
    }
*/
    


}//End class BOUsers



//$myBlog= new BOBlogs;
//$query = array('title'=>'name 1', 'content'=>'description 1', 'user_id'=> 5, 'pic_id'=> 7);
//var_dump($myBlog->insertBlogs($query));
//var_dump($myOrganizations->getAllOrganizations());
//var_dump($myOrganizations->getOrganizationsByUser(5));

?>
