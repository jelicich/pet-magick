<?php

/**
 * BlogsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class BlogsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object BlogsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Blogs');
    }

    public function insertBlogs($ref){

    		$now = date('Y-m-d');

    		$Blogs = new Blogs();
            $Blogs->TITLE = $ref['title'];
            $Blogs->CONTENT = $ref['content'];
            $Blogs->DATE = $now;
            $Blogs->USER_ID = $ref['user_id'];
            $Blogs->PIC_ID = $ref['pic_id'];

            $Blogs->save();
    }// end insertBlogs

    public function getLastBlog(){

        $userCount = Doctrine::getTable('Blogs')->count();
        $user = Doctrine::getTable('Blogs')
        ->createQuery()
        ->select('b.*, ph.PIC, ph.thumb, u.NAME, u.LASTNAME') // ver si necesito la pic de perfil del user o una del album para la principal del modulo de projects
        ->from('Blogs b')
        ->innerJoin('b.Users u')
        ->leftJoin('b.Pics ph')
        ->limit(1)
        ->orderBy('b.date DESC')
        //->offset(rand(0, $userCount - 1))
        ->fetchOne();

       return $user->toArray();

    }//End getLastArticles


    public function deleteBlog($id){
        $q= Doctrine_Query::create()
            ->delete('Blogs o')
            ->where('o.ID_BLOG =?', $id);
        $q->execute();
    }
}