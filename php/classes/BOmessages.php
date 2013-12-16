<?php

include_once('tools/bootstrap.php');
include_once('models/MessagesTable.php');
include_once('models/UsersTable.php');
include_once('models/ConversationsTable.php');


class BOMessages{

    var $tableUsr;
    var $tableMsg;
    var $inbox;
    var $chat;
    var $msgSent;
    var $err;

    function __construct()
    {

        $this->tableUsr = Doctrine_Core::getTable('Users');
        $this->tableMsg = Doctrine_Core::getTable('Messages');
        $this->tableConv = Doctrine_Core::getTable('Conversations');

    }// End constructor

    function getErrors()
    {
        return $this->err;
    }

//=========================================================== VALIDATIONS

  //======================= SUBMIT VAL

    function val_submit($ref)
    {
        $t = sizeof($ref);

        if(!$ref['from'] || empty($ref['from']) )
        {
            throw new Exception('There was an error with your session. Message can\'t be sent');
        }
        //si no es array lo que recibo
        if(!is_array($ref))
        {   
            throw new Exception('Data format error');
        }
        else
        {
             if(empty($ref['to']))
            {
                throw new Exception('Please enter the recipient');
            }
            else
            {   /** 
                Esta funcion requiere el mail del destinatario para validar. 
                Queda pendiente hasta q sepamos q dato vamos a manejar// findByMail($ref['to']) 
                */
                //$rta = $this->tableUsr->findByMail($ref['to']);
                if(!empty($rta))
                {   
                    throw new Exception('Invalid recipient');
                }

            }   
        }// End else
    }// End val_submit

    //======================= READ VAL

    function val_getMessages($idUser)
    {
         /** 
        Adapto la funcion de arriba ya que no necesitamos que reciba un array. Solo el ID
         */

        if(empty($idUser)) 
        {
            throw new Exception("There was a problem. Messages can't be loaded.");
            //break;
        }
        else
        {
            return true;
        }
        
    }// End val_read



    //======================== SUBMIT

    function submit($ref){

         try
            {  
                $this->val_submit($ref);
                $this->msgSent = $this->tableMsg->submit($ref['from'], $ref['to'], $ref['message']);

                return true;
            }
         catch(Exception $e)
            {
               $this->err = $e->getMessage();
               return false;
            }

    }// End submit



    //======================== READ MESSAGES
    function getAllMessages($idUser){
/**
Si el mensaje tiene Ñ o acentos devuelve null. hay q escapar esos caracteres y los saltos de linea tmb.
para los saltos de linea existe nl2br y para los acentos nosé q habrá q hacer
*/
        try
            {  
                $this->val_getMessages($idUser);
                $this->chat = $this->tableMsg->getAllMessages($idUser);

                return true;
            }
         catch(Exception $e)
            {
               $this->err = $e->getMessage();
               return false;
            }

    }// End read


    function getNewMessages($from){
/**
Si el mensaje tiene Ñ o acentos devuelve null. hay q escapar esos caracteres y los saltos de linea tmb.
para los saltos de linea existe nl2br y para los acentos nosé q habrá q hacer
*/
        try
            {  
                $this->val_getMessages($from);
                $this->chat = $this->tableMsg->getNewMessages($from);
                if($this->chat == null)
                    return null;
                
                return true;
            }
         catch(Exception $e)
            {
               $this->err = $e->getMessage();
               return false;
            }

    }// End read

        function getHeaders($idUser){
/**
Si el mensaje tiene Ñ o acentos devuelve null. hay q escapar esos caracteres y los saltos de linea tmb.
para los saltos de linea existe nl2br y para los acentos nosé q habrá q hacer
*/
        try
            {  
                //$this->val_getMessages($idUser);
                $this->inbox = $this->tableConv->getHeaders($idUser);

                return true;
            }
         catch(Exception $e)
            {
               $this->err = $e->getMessage();
               return false;
            }

    }// End read



     function getNewHeaders($idUser){
/**
Si el mensaje tiene Ñ o acentos devuelve null. hay q escapar esos caracteres y los saltos de linea tmb.
para los saltos de linea existe nl2br y para los acentos nosé q habrá q hacer
*/
        try
            {  
                //$this->val_getMessages($idUser);
                $this->inbox = $this->tableMsg->getNewHeaders($idUser);
                if($this->inbox == null)
                    return null;

                return true;
            }
         catch(Exception $e)
            {
               $this->err = $e->getMessage();
               return false;
            }

    }// End read

 //======================== READ MESSAGES




 //======================== GETS

    function getInbox()
    {
        return $this->inbox;
    }// End getInbox

   
    function getChat()
    {
        return $this->chat;
    }// End getChat





    function getMsgSent()
    {
        return $this->msgSent;
    }
    

}// End class












/*

$inbox = new BOmessages;
$yesterday = date('Y-m-d H:i:s', time()-86400);


// Submit
$query = array(17,18, 'pijita', 'hola puto');
$inbox->submit($query);
/*

// Submit
$query = array(6,7, 'pijita', 'hola puto', 0);
$inbox->submit($query);

//Read
$query = array(7, $yesterday);
$inbox->read($query);

var_dump( $inbox->getMessages());


*/



?>







