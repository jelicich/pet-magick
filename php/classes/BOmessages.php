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
            //si tiene algun campo vacio
            //me parece q esto no evalua si el campo esta vacio, sino si existen todas las posiciones. puede estar la posición y estar vacia y esto no lo evalua
            /*
            if($t < 4)
            {   
                throw new Exception("Please ");
                break;
            }
            */

            if(empty($ref['to']))
            {
                throw new Exception('Please enter the recipient');
            }
            else
            {
                $rta = $this->tableUsr->findByMail($ref[1]);
                if(!empty($rta))
                {   
                    throw new Exception('Invalid recipient');
                }
               /* else
                {
                    //$this->dest = $rta[0]['ID'];
                    var_dump($rta);
                }*/
            }   
        }// End else
    }// End val_submit

    //======================= READ VAL

    function val_getMessages($idUser)
    {
        /*
        if(sizeof($ref) < 2 || empty($ref['id']) || empty($ref['datelog']))
        {
            throw new Exception("Hubo un error con su sesion. No se pueden leer los mensajes");
            break;
        }
        else
        {
            return true;
        }
        */

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
                //echo 'Leido! (Borrar este echo del codigo)';

                return true;
            }
         catch(Exception $e)
            {
               $this->err = $e->getMessage();
               return false;
            }

    }// End read

    
/**
    Esta funcion no la necesitamos me parece. Si la necesitamos habria q cambiarle el nombre pq confunde
*/
/*
    //======================= MESSAGES
    function getMessages(){

        return $this->msg;

    }// End getMessages

}// End class BOmesagges
*/

    //======================== READ MESSAGES
    /**
    Creo esta función para obtener el inbox, Vidaurri decía q era más seguro hacerlo así.
    */

    function getInbox()
    {
        return $this->inbox;
    }



}













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







