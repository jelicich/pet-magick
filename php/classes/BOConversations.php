<?php

include_once('tools/bootstrap.php');
include_once('models/MessagesTable.php');
include_once('models/UsersTable.php');
include_once('models/ConversationsTable.php');


class BOConversations{

    var $tableUsr;
    var $tableMsg;
    var $inbox;


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
            die("No connection to database");
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
            die("Query error " . $err);
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
            SELECT u.ID_USER, c.ID_CONVERSATION, u.NAME, u.LASTNAME, u.NICKNAME 
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
        $r = $this->consultar($c,$q);

            
        $out = array();

        while($row=mysqli_fetch_assoc($r))
        {

            $conv_id=$row['ID_CONVERSATION'];
            /*
            $user_id=$row['ID_USER'];
            $name=$row['NAME'];
            $lastname=$row['LASTNAME'];
            $nick=$row['NICKNAME'];
            */

            $cquery = $this->consultar($c,"
                SELECT m.ID_MESSAGE, m.DATE, m.MESSAGE, m.USER_ID, m.STATUS FROM messages m WHERE m.CONVERSATION_ID = '$conv_id' ORDER BY m.DATE DESC LIMIT 1");
            $crow=mysqli_fetch_assoc($cquery);
            $message_id=$crow['ID_MESSAGE'];
            $message=$crow['MESSAGE'];
            $time=$crow['DATE'];
            
            $row['ID_MESSAGE'] = $crow['ID_MESSAGE'];
            $row['MESSAGE'] = $crow['MESSAGE'];
            $row['DATE'] = $crow['DATE'];
            $row['SENDER'] = $crow['USER_ID'];
            $row['STATUS'] = $crow['STATUS'];
            $out[] = $row;
            /*
            $out = $crow['ID_MESSAGE'];
            $out = $crow['MESSAGE'];
            $out = $crow['DATE'];
            */   

        }
        if(sizeof($out) == 0)
            return null;
        
        $this->inbox = json_encode($out);
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
            
        $c = $this->conectar();
        $q = "
            SELECT u.ID_USER, c.ID_CONVERSATION, u.NAME, u.LASTNAME, u.NICKNAME 
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
            AND
            c.DATE > '".$_SESSION['last-header']."'
            ORDER BY c.ID_CONVERSATION DESC";
        $r = $this->consultar($c,$q);

        
        $out = array();

        while($row=mysqli_fetch_assoc($r))
        {

            $conv_id=$row['ID_CONVERSATION'];
            /*
            $user_id=$row['ID_USER'];
            $name=$row['NAME'];
            $lastname=$row['LASTNAME'];
            $nick=$row['NICKNAME'];
            */

            $cquery = $this->consultar($c,"
                SELECT m.ID_MESSAGE, m.DATE, m.MESSAGE, m.USER_ID, m.STATUS FROM messages m WHERE m.CONVERSATION_ID = '$conv_id' ORDER BY m.DATE DESC LIMIT 1");
            $crow=mysqli_fetch_assoc($cquery);
            $message_id=$crow['ID_MESSAGE'];
            $message=$crow['MESSAGE'];
            $time=$crow['DATE'];
            
            $row['ID_MESSAGE'] = $crow['ID_MESSAGE'];
            $row['MESSAGE'] = $crow['MESSAGE'];
            $row['DATE'] = $crow['DATE'];
            $row['SENDER'] = $crow['USER_ID'];
            $row['STATUS'] = $crow['STATUS'];
            $out[] = $row;
            /*
            $out = $crow['ID_MESSAGE'];
            $out = $crow['MESSAGE'];
            $out = $crow['DATE'];
            */

        }
        
        

        if(empty($out))
            return null;

        $this->inbox = json_encode($out);
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






 //======================== GETS

    function getInbox()
    {
        return $this->inbox;
    }// End getInbox

   
    

}// End class







?>







