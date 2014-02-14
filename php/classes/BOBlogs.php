<?php

include_once('tools/bootstrap.php');
include_once('models/BlogsTable.php');

class BOBlogs{

    var $table;
    var $err;

    function __construct()
    {

        $this->table = Doctrine_Core::getTable('Blogs');
    }// end __construct

    function insertBlogs($ref)
    {

        try{ 
            
            $this->table->insertBlogs($ref);
            return true;
        }
        catch(Exception $e){

              $this->err = $e->getMessage();
              return false;
        }
    }// end insertOrganizations

    function getLastBlog()
    {


       $array = $this->table->getLastBlog();
        return $array;
    }//End getAllArticles
    

    function getAllBlogs()
    {
       
         $q = Doctrine_Query::create()

              ->select('b.*, ph.PIC') 
              ->from('Blogs b')
              ->leftJoin('b.Pics ph')
              ->orderBy('DATE'); // ver si este order funciona
          
          $r = $q->execute();    
          
          return $r->toArray();
    }// end getAllOrganizations

    function getBlogsById($id)
    { 

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

    function getErrors()
    {

        return  $this->err;
    }// end getErrors

    function deleteBlog($id)
    {
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



    function getArchive($id)
    {
      
      
        

      $q = Doctrine_Query::create()

          ->select("b.ID_BLOG, DATE_FORMAT(b.DATE, '%M') as MONTH, YEAR(b.DATE), DATE_FORMAT(b.DATE, '%Y-%m') as DATE") 
          ->from('Blogs b')
          ->orderBy('DATE ASC')
          ->groupBy("MONTH(b.DATE)");
      
      $r = $q->execute();    
      if($r)
        return $r->toArray();
      else
        return false;
    }
    


}//End class BOUsers



//$myBlog= new BOBlogs;
//$query = array('title'=>'name 1', 'content'=>'description 1', 'user_id'=> 5, 'pic_id'=> 7);
//var_dump($myBlog->insertBlogs($query));
//var_dump($myOrganizations->getAllOrganizations());
//var_dump($myOrganizations->getOrganizationsByUser(5));

?>
