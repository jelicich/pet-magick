<?php

include_once('tools/bootstrap.php');
include_once('models/MessagesTable.php');
include_once('models/UsersTable.php');
include_once('models/ConversationsTable.php');


class BOConversations{

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

    // FUNCIONES de conexión y consulta

    function conectar() 
    {
        $conexion = @mysqli_connect('localhost', 'root', '', 'pet_magick');

        if (!$conexion) 
        {
        //entra en este if si $conexion es false
            die("No hay conexion a la bd");
        }
        return $conexion;
    }

    function consultar($conexion, $consulta) 
    {
        $resultadoConsulta = mysqli_query($conexion,$consulta);
        //var_dump($resultadoConsulta);
        $err = mysqli_error($conexion);
        if ($err) 
        {
            die("Error en la consulta " . $err);
        }
        return $resultadoConsulta;
    }


    function consultarConResultados($conexion, $consulta) 
    {
        $resultado = $this->consultar($conexion, $consulta);

        $registros = array();
        while($registro = mysqli_fetch_assoc($resultado)) 
        {
            $registros[] = $registro;
        }
        return $registros;
    }





        function getHeaders($idUser){
            $c = $this->conectar();
            $q = "
                SELECT u.ID_USER, c.ID_CONVERSATION, u.NICKNAME 
                FROM conversations c, users u
                WHERE CASE
                WHEN c.USER_1_ID = '".$_SESSION['id']."'
                THEN c.USER_2_ID = u.ID_USER
                WHEN c.USER_2_ID = '".$_SESSION['id']."'
                THEN c.USER_1_ID = u.ID_USER
                END
                AND (
                    c.USER_1_ID = '".$_SESSION['id']."'
                    or c.USER_2_ID = '".$_SESSION['id']."'
                )
                ORDER BY c.ID_CONVERSATION DESC";
            $r = $this->consultarConResultados($c,$q);
            
            $this->inbox = json_encode($r);
            return true;

        /*
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
        */

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







