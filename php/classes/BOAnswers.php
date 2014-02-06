<?php

include_once('tools/bootstrap.php');
include_once('models/AnswersTable.php');

class BOAnswers{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('Answers');
    }

    
    function post($array)
    {
        if(!empty($array['a']))
        {
        	$this->lastAnswerId = $this->table->post($array);
        	return true;
        }
        else
        {
        	return false;
        }
        	
    }

    function getLastAnswerId()
    {
        return $this->lastAnswerId;
    }

    function getSentQuestion()
    {
    	return $this->sentComment;
    }


}//End class BOUsers



?>
