<?php

include_once('tools/bootstrap.php');
include_once('models/CommentsTable.php');

class BOComments{

    var $table;
    var $err;

    function __construct(){

        $this->table = Doctrine_Core::getTable('Comments');
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

    function getSentComment()
    {
    	return $this->sentComment;
    }

    function getComments($id)
    {
    	$ar = $this->table->getComments($id);
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
    	}
    	
    	return $ar;
    }


}//End class BOUsers



?>
