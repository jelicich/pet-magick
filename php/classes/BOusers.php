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
               $this->val_login($ref);
               $rta = $this->table->login($ref[0], $ref[1], $ref[2]);
               echo 'logueado! (Borrar este echo del codigo)';
               return true;
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

/*

// Registrarse
$query = array('luis', 'miguel', 'luismi', 'luismi@hotmail.com', 'clave', 'clave', 1, 1);
$yo->registration($query);

// Loguearse
$query = array('luismi', 'clave', 1);
$yo->login($query);

// Desloguearse
$query = array('luismi');
$yo->logout($query);

*/


?>
