<?php

include_once('tools/bootstrap.php');
include_once('models/UsersTable.php');


class BOUsers{

    //======================== VALIDACIONES

   function val_reg($ref){

        $t = sizeof($ref);

        if($t < 7 || $ref[0] == '' || $ref[1] == '' // error 1: campos obligatorios
                  || $ref[2] == '' || $ref[3] == ''  
                  || $ref[4] == '' || $ref[5] == '' || $ref[6] =='')
        {
            throw new Exception('error 1: Completar todo');
            break;

        }else{

            $table = Doctrine_Core::getTable('Users');
            $rta_nickname = $table->val_nickname($ref[2]);
            $rta_email = $table->val_email($ref[3]);

            if($rta_nickname == false){// error 2: usuario existente

                 throw new Exception('error 2: usuario existente');
                 break;

            }else if(preg_match("/^[a-zA-Z]\w+(\.\w+)*\@\w+(\.[0-9a-zA-Z]+)*\.[a-zA-Z]{2,4}$/", $ref[3]) === 0){// error 3: formato mail incorrecto

                throw new Exception('error 3: no es email');
                break;

            }else if($rta_email == false){// error 4: email existente

                 throw new Exception('error 4: mail existente');
                 break;
            }
        }
    } // End function val_reg


    //======================== REGISTRATION

    function registration($ref){

        try
            {
               $this->val_reg($ref);

               $table = Doctrine_Core::getTable('Users');
               $rta = $table->reg_bd($ref[0], $ref[1], $ref[2], $ref[3], $ref[4], $ref[5], $ref[6]);
               return true;
            }

        catch(Exception $e)
            {
               echo 'Message: ' .$e->getMessage();
            }
    }
   
}//end class




$yo = new BOUsers;
$query = array('julian', 'pena', 'pepe', 'saudade@hotmail.com',  2, 1, 1);
$yo->registration($query);


?>
