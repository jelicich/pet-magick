<?php

include_once('tools/bootstrap.php');
include_once('models/MessagesTable.php');
include_once('models/UsersTable.php');


class BOmessages{

    var $tablaUsr;
    var $msg;

    function __construct(){

        $this->tableUsr = Doctrine_Core::getTable('Users');
        $this->msg = Doctrine_Core::getTable('Messages');

    }// End constructor

//=========================================================== VALIDATIONS

  //======================= SUBMIT VAL

    function val_submit($ref)
    {
        $t = sizeof($ref);

        //si no es array lo que recibo
        if(!is_array($ref))
        {   
             throw new Exception('Formato de datos incorrecto');
        }
        else
        {
            //si tiene algun campo vacio
            if($t < 4)
            {   
                throw new Exception("Debe completar todos los campos");
                break;
            }
            
            //Si el usuario no existe
            if(!empty($ref[1]))
            {
                $rta = $this->tableUsr->findByMail($ref[1]);
                if(!empty($rta))
                {   
                    throw new Exception("El usuario destinatario no existe");
                    break;
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

    function val_read($ref)
    {
        if(sizeof($ref) < 2 || empty($ref[0]) || empty($ref[1]))
        {
            throw new Exception("Hubo un error con su sesion. No se pueden leer los mensajes");
            break;
        }
        else
        {
            return true;
        }
    }// End val_read



    //======================== SUBMIT

    function submit($ref){

         try
            {  $this->val_submit($ref);
               $rta = $this->msg->submit($ref[0], $ref[1], $ref[2], $ref[3]);
               return true;
            }
         catch(Exception $e)
            {
               echo 'Message: ' .$e->getMessage();
            }

    }// End submit



    //======================== READ MESSAGES
    function read($ref){

        try
            {  
                $this->val_read($ref);
                $rta = $this->msg->read($ref[0], $ref[1]);
                echo 'Leido! (Borrar este echo del codigo)';
                return true;
            }
         catch(Exception $e)
            {
               echo 'Message: ' .$e->getMessage();
            }

    }// End read

    

    //======================= MESSAGES
    function getMessages(){

        return $this->msg;

    }// End getMessages

}// End class BOmesagges



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







