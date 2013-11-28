<?php

include_once('tools/bootstrap.php');
include_once('models/UsersTable.php');


class BOUsers{

  var $table;

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

    /*
    function val_login($ref){

        $t = sizeof($ref);

        if($t < 3 || $ref[0] == '' || $ref[1] == ''){

             throw new Exception('Completar todo');
             break;
            
        }else{

             $rta = $this->table->val_login($ref);
            
             if($rta["ID_USER"] == null){ 
                
                 throw new Exception('usuario o pass incorrecto');
                 break;
             } 
            else if($rta["TOKEN"] != 0){

                 throw new Exception('usuario ya esta logueado');
                 break;
            }
        }// End else
      }// End function val_login
      
      */
      
          //=======VERSION ESTEBAN

      //no termino de entender tu validacion de login. porque se autoejecuta el validador... entra en un bucle q no entiendo como sale.
      //mi funcion de validacion de login es la siguiente y ademas busca al usuario por si no está registrado o no coincide la contraseña
      //la adapto a tu metodología de errores
      function validateLogin($usr, $pass, $tok)
      {
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

        /*
        $e = $this->getErrores();
        if(empty($e))
          return true;
        else
          return false;
        */

        //Devuelvo true pq paso la validación aunque segun entiendo con el try y catch no hace falta q la funcion devuelva ningun valor
        return true;
        
      }




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
              //$this->val_login($ref);
              //=====ESTEBAN
              //desarmo el array para q lo reciba bien funcion
              $usr = $ref[0];
              $pass = sha1($ref[1]);
              $tok = $ref[2];
              //===END ESTEBAN
              $this->validateLogin($usr, $pass, $tok);
              $rta = $this->table->login($usr, $tok); //para hacer el update solo necesito el usr y el $tok
              echo 'logueado! (Borrar este echo del codigo)';
              return true;
              //cuando ejecuto el login desde el objeto instanciado hago if($obj->login()), si entra guardo la info del usuario en sesion pidiendola asi:
              //obj->table->findByMail($mail)   <-- todavía no puse este metodo
            }
       
        catch(Exception $e)
            {
               echo 'Message: ' .$e->getMessage();
            }
    }// End login

    //======================== LOGOUT

    function logout($ref){

       $rta = $this->table->logout($ref);
       echo 'Deslogueado! (Borrar este echo del codigo)';
       return true;

    }// End loout

   
}//End class BOUsers


$yo = new BOUsers;



// Registrarse
/*
$query = array('luis', 'miguel', 'luismi', 'luismi@hotmail.com', 'clave', 'clave', 1, 1211);
$yo->registration($query);

// Loguearse
$query = array('luismi', 'clave', 1);
$yo->login($query);


*/

// Loguearse
$query = array('luismi@hotmail.com', 'clave', 1); //uso el mail como usuario 
$yo->login($query);

/*

// Desloguearse
$query = array('luismi');
$yo->logout($query);

*/


?>
