<?php

/**
 * QuestionsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class QuestionsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object QuestionsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Questions');
    }

    public function post($array)
    {
    	$c = new Questions;
        $c->QUESTION = $array['comment'];
        $c->DATE = date('Y-m-d H:i:s');
        $c->USER_ID = $_SESSION['id'];
        $c->save();

        $lm = $c->ID_QUESTION;

        $q = Doctrine_Query::create()
            ->select('q.*, u.NAME, u.LASTNAME, p.PIC')
            ->from('Questions q')
            ->leftJoin('q.Users u')
            ->leftJoin('u.Pics p')
            ->where('q.ID_QUESTION =?', $lm);
        $ob = $q->execute();


    
        $ar = $ob->toArray();
        
        if(isset($ar[0]['Users']['Pics']['PIC']))
        {
            $pic = $ar[0]['Users']['Pics']['PIC'];
            $ar[0]['Users']['Pics']['PIC'] = 'img/users/'.$pic;
            $ar[0]['Users']['Pics']['THUMB'] = 'img/users/thumb/'.$pic;
        }
        else
        {
            $ar[0]['Users']['Pics']['PIC'] = 'img/users/default.jpg';
            $ar[0]['Users']['Pics']['THUMB'] = 'img/users/thumb/default.jpg';
        }   

        $ob = json_encode($ar);



        return $ob;

    }

    public function getQuestions()
    {
        $q = Doctrine_Query::create()
            ->select('q.*, u.NAME, u.LASTNAME, p.PIC, a.*, h.Name, h.LASTNAME, f.PIC')
            ->from('Questions q')
            ->leftJoin('q.Users u')
            ->leftJoin('q.Answers a')
            ->leftJoin('u.Pics p')
            ->leftJoin('a.Users h')
            ->leftJoin('h.Pics f');
        $ob = $q->execute();

        return $ob->toArray();
    }

    public function qtyNewQuestions()
    {
        $q = Doctrine_Query::create()
            ->select('COUNT(q.ID_QUESTION)')
            ->from('Questions q')
            ->where('q.ANSWER_ID is NULL');
        $n = $q->execute();

        return $n->toArray();
    }
}