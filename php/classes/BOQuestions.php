<?php

include_once('tools/bootstrap.php');
include_once('models/QuestionsTable.php');

class BOQuestions{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('Questions');
    }

    
    function post($array)
    {
        if(!empty($array['comment']))
        {
        	$this->sentComment = $this->table->post($array);
        	return true;
        }
        else
        {
        	return false;
        }
        	
    }

    function getSentQuestion()
    {
    	return $this->sentComment;
    }

    function getQuestions()
    {
    	$ar = $this->table->getQuestions($id);
    	for($i = 0; $i<sizeof($ar); $i++)
    	{
    		if(isset($ar[$i]['Users']['Pics']['PIC']))
	        {
	            $pic = $ar[$i]['Users']['Pics']['PIC'];
	            $ar[$i]['Users']['Pics']['PIC'] = 'img/users/'.$pic;
	            $ar[$i]['Users']['Pics']['THUMB'] = 'img/users/thumb/'.$pic;
	        }
	        else
	        {
	            $ar[$i]['Users']['Pics']['PIC'] = 'img/users/default.jpg';
	            $ar[$i]['Users']['Pics']['THUMB'] = 'img/users/thumb/default.jpg';
	        }	
            if(isset($ar[$i]['Answers']))
            { 
                if(isset($ar[$i]['Answers']['Users']['Pics']['PIC']))
                {
                    $pic = $ar[$i]['Answers']['Users']['Pics']['PIC'];
                    $ar[$i]['Answers']['Users']['Pics']['PIC'] = 'img/users/'.$pic;
                    $ar[$i]['Answers']['Users']['Pics']['THUMB'] = 'img/users/thumb/'.$pic;
                }
                else
                {
                    $ar[$i]['Answers']['Users']['Pics']['PIC'] = 'img/users/default.jpg';
                    $ar[$i]['Answers']['Users']['Pics']['THUMB'] = 'img/users/thumb/default.jpg';
                }  
            }     
    	}
    	
    	return $ar;
    }

    function qtyNewQuestions()
    {
        $q = $this->table->qtyNewQuestions();
        return $q;
    }

    function getNewQuestions()
    {
        $q = $this->table->getNewQuestions();
        return $q;
    }

    function addAnswerId($a,$q)
    {
        try
        {
            $this->table->addAnswerId($a,$q);
            return true;
        }
        catch(Exception $e)
        {
            $this->err = $e->getMessage();
            return false;
        }
    }

    function getErr()
    {
        return $this->err;
    }

}//End class BOUsers



?>
