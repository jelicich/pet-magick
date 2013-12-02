<?php

include_once('tools/bootstrap.php');
include_once('models/UsersTable.php');


class BOUsers{

  var $table;
  

  /*
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
  var $err;

  function __construct()
  {
    $this->table = Doctrine_Core::getTable('Users');
  }

//=========================================================== VALIDATIONS

  //======================= REG VAL

   function val_reg($ref){

        $t = sizeof($ref);

        if($t < 8 || $ref[0] == '' || $ref[1] == '' 
                  || $ref[2] == '' || $ref[3] == ''  
                  || $ref[4] == '' || $ref[5] == '' 
                  || $ref[6] =='' || $ref[7] =='')
        {
            throw new Exception('error 1: Completar todo');
            break;

        }else{

                $rta_nickname = $this->table->val_nickname($ref[2]); // Ver si esto se puede optimizar (junto con las consultas en table: val_nickname, val_email)
                $rta_email = $this->table->val_email($ref[3]);

                
                if($ref[4] != $ref[5]){

                    throw new Exception('password no coincide');
                    break;

                }else if($rta_nickname == false){

                     throw new Exception('usuario existente');
                     break;

                }else if(preg_match("/^[a-zA-Z]\w+(\.\w+)*\@\w+(\.[0-9a-zA-Z]+)*\.[a-zA-Z]{2,4}$/", $ref[3]) === 0){

                    throw new Exception('no es email');
                    break;

                }else if($rta_email == false){

                     throw new Exception('mail existente');
                     break;
                }
        }// End else
    } // End function val_reg



    //======================= LOGIN VAL

      function val_login($usr, $pass, $tok){

        //me fijo si estan vacios usr y pass
        if(empty($usr) || empty($pass))
        {
          throw new Exception('Debe ingresar el mail y contraseña');
        }
        else
        {
          //si no están vacios busco que el mail coincida con la contraseña (ejecuta un query q es "Select * where usr = $usr & pass = $pass")
          //metodo en UsersTable
          $rta = $this->table->findByMailPass($usr,$pass);
          //si la respuesta viene vacia le tiro el error
          if(empty($rta))
          {
            throw new Exception('Usuario inexistente o contraseña incorrecta');
          }
          else
          {
            //sino está vacia, es decir q el usuario existe y puso bien la contraseña, me fijo q no esté logueado.
            if($rta[0]['TOKEN'] != 0)
            {
              if($rta[0]['TOKEN'] != $tok)
                //si el token no es 0 y es diferente del parametro q pasa significa q esta logueado
                throw new Exception('Ya hay una sesion abierta de este usuario');
            }
          }
        }
      }// End val_login

    

    //======================== REGISTRATION

    function registration($ref){

        try
            {
               $this->val_reg($ref);
               $rta = $this->table->reg($ref[0], $ref[1], $ref[2], $ref[3], $ref[4], $ref[6], $ref[7]);
               echo 'Registrado! (Borrar este echo del codigo)';
               return true;
            }

        catch(Exception $e)
            {
               echo 'Message: ' .$e->getMessage();
            }
    }// End function registration


    
    //============================= LOGIN

    function login($ref){

         try
            {
              //desarmo el array para q lo reciba bien funcion
              $usr = $ref[0];
              $pass = sha1($ref[1]);
              $tok = $ref[2];
              $this->val_login($usr, $pass, $tok);
              $rta = $this->table->login($usr, $tok); //para hacer el update solo necesito el usr y el $tok
              //echo 'logueado! (Borrar este echo del codigo)';
              return true;
              //cuando ejecuto el login desde el objeto instanciado hago if($obj->login()), si entra guardo la info del usuario en sesion pidiendola asi:
              //obj->table->findByMail($mail)   <-- todavía no puse este metodo
            }
       
        catch(Exception $e)
            {
               //echo 'Message: ' .$e->getMessage();
              $this->err = array('Error:'=> $e->getMessage());
              return false;
            }
    }// End login

   

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

}//End class BOUsers

/*
$yo = new BOUsers;


// Loguearse
$query = array('diego@hotmail.com', 'clave', 1); //uso el mail como usuario 
$yo->login($query);
*/
/*

// Registrarse
$query = array('luis', 'miguel', 'luismi', 'luismi@hotmail.com', 'clave', 'clave', 1, 1211);
$yo->registration($query);

// Loguearse
$query = array('luismi@hotmail.com', 'clave', 1); //uso el mail como usuario 
$yo->login($query);

// Desloguearse
$query = array('luismi@hotmail.com');
$yo->logout($query);

// Delete
$query = array('luismi@hotmail.com');
$yo->delete($query);

*/


?>
