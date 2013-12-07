<?php

include_once('tools/bootstrap.php');
include_once('models/MessagesTable.php');
include_once('models/UsersTable.php');


class BOMessages{

    var $tableUsr;
    var $tableMsg;
    var $inbox;
    var $err;

    function __construct()
    {

        $this->tableUsr = Doctrine_Core::getTable('Users');
        $this->tableMsg = Doctrine_Core::getTable('Messages');

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
            throw new Exception("There was an error with your session. Messages can't be loaded.");
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
                $rta = $this->tableMsg->submit($ref['from'], $ref['to'], $ref['subject'], $ref['message']);
                return true;
            }
         catch(Exception $e)
            {
               $this->err = $e->getMessage();
               return false;
            }

    }// End submit



    //======================== READ MESSAGES
    function getMessages($idUser){
/**
Si el mensaje tiene Ñ o acentos devuelve null. hay q escapar esos caracteres y los saltos de linea tmb.
para los saltos de linea existe nl2br y para los acentos nosé q habrá q hacer
*/
        try
            {  
                $this->val_getMessages($idUser);
                $this->inbox = $this->tableMsg->getMessages($idUser);

                return true;
            }
         catch(Exception $e)
            {
               $this->err = $e->getMessage();
               return false;
            }

    }// End read

 //======================== READ MESSAGES

    /**
    Creo esta función para obtener el inbox, Vidaurri decía q era más seguro hacerlo así.
    */

    function getInbox()
    {
        return $this->inbox;
    }// End getInbox

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







