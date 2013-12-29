<?php

include_once('tools/bootstrap.php');
include_once('models/UsersTable.php');


class BOUsers{

  var $table;
  var $err;
  var $complete;

  function __construct(){

    $this->table = Doctrine_Core::getTable('Users');
  }

//=============================================================================== VALIDATION FUNCTIONS

  //======================= REG VAL

   function val_reg($ref){

        $t = sizeof($ref);
        //var_dump($ref);
        if($t < 7 || $ref['name'] == '' || $ref['lastname'] == '' 
                  || $ref['nickname'] == '' || $ref['email'] == ''  
                  || $ref['password'] == '' || $ref['password2'] == '' ) // Le saque los datos que no son obligatorios (pais ciudad, etc) Pido un array de 7 q son los 6 campos obligatorios mas el token el ranking va default 0 en la BD
        {
            throw new Exception('Please fill in the mandatory fields');
            break;

        }else{

                //$rta_nickname = $this->table->val_nickname($ref[2]); // Ver si esto se puede optimizar (junto con las consultas en table: val_nickname, val_email)
                $rta_email = $this->table->val_email($ref['email']);

                
                if($ref['password'] != $ref['password2']){

                    throw new Exception("Passwords don't match");
                    break;

                    //LO COMENTO PORQUE EL NICKNAME NO ERA UNIQUE
                /*}else if($rta_nickname == false){ 

                     throw new Exception('usuario existente');
                     break;*/

                }else if(preg_match("/^[a-zA-Z]\w+(\.\w+)*\@\w+(\.[0-9a-zA-Z]+)*\.[a-zA-Z]{2,4}$/", $ref['email']) === 0){

                    throw new Exception('Please, enter a valid email address');
                    break;

                }else if($rta_email == false){

                     throw new Exception('This email address already exists in our system');
                     break;
                }
        }// End else
    } // End function val_reg



  //======================= LOGIN VAL

  function val_login($usr, $pass, $tok){

    if(empty($usr) || empty($pass))
    {
      throw new Exception('Please fill in both fields');
    }
    else
    {
      $rta = $this->table->findByMailPass($usr,$pass);
      if(empty($rta))
      {
        throw new Exception('Invalid username/password');
      }
      else
      {
        //no sé si esto es al pedo
        if($_SESSION['token'] != $tok)
          throw new Exception('There\'s an open session');
      }
    }
  }// End val_login

    

//=============================================================================== REGISTRATION FUNCTIONS

    function registration($ref){

        try
            {
               $this->val_reg($ref);
               $rta = $this->table->reg($ref);
               //echo 'Registrado! (Borrar este echo del codigo)';
               return true;
            }

        catch(Exception $e)
            {
              $this->err = array('Error:'=> $e->getMessage());
              return false;
            }
    }// End function registration

  
//=============================================================================== LOGIN FUNCTIONS

    function login($ref){

         try
            {
              $usr = $ref[0];
              $pass = sha1($ref[1]);
              $tok = $ref[2];
              $this->val_login($usr, $pass, $tok);
              return true;
            }
       
        catch(Exception $e)
            {
               //echo 'Message: ' .$e->getMessage();
              $this->err = array('Error:'=> $e->getMessage());
              return false;
            }
    }// End login

   

    function checklogin(){

      if(!isset($_SESSION['email'])){// Ver si mail es el valor correcto
        
        header('Location: index.php');

      }//end if

    }//end checklogin()

   

    //======================== LOGOUT

    function logout($ref){

       $q = Doctrine_Query::create()
            ->update('Users u')
            ->set('u.TOKEN', '?', 0)
            ->where('u.ID_USER = ?', $ref);
       $q->execute();

       //echo 'Deslogueado! (Borrar este echo del codigo)';

    }// End logout

     //======================== DELETE USER
    
    function delete($ref){

      $q = doctrine_query:: create()
          ->delete('Users u')
          ->where('u.EMAIL = ?', $ref);
      $q->execute();

      echo 'Borrado! (Borrar este echo del codigo)';

    }// End delete


    function autoCompleteEverything(){

      try
          {
            $this->complete = $this->table->autoCompleteEverything();
            return true;
          }
          catch(Exception $e)
          {
            $this->err = array('Error:'=> $e->getMessage());
            return false;
          }
    }// End delete


    function getCompleteEverything()
    {
       return $this->complete;
    }// End getInbox


}//End class BOUsers














/*


$inbox = new BOusers;
$query = 'mis';
var_dump($inbox->autoComplete($query));

*/
 /*
$inbox = new BOusers;
$query = array('chule_catupe@hotmail.com');
var_dump($inbox->id_user($query));
 
  creo esta variable $err, para poder modificar el metodo login, ya que devuelve un valor y eso se toma como verdadero. es decir, cuando quiero loguearme hago 
  if($usr->login())
  {
    entro
  }
  else
  {
    error;
  }
  al recibir el error como respuesta, en lugar de un false, entra en el if.
  En la variable err voy a guardar e->getMessage
  */



?>