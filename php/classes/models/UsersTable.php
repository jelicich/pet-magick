<?php

/**
 * UsersTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class UsersTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object UsersTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Users');
    }

//====================================================================== REG

       public function reg($ref){

       			$pass_sha1 = sha1($ref['password']);
	            $Users = new Users();
	            $Users->NAME = $ref['name'];
	            $Users->LASTNAME = $ref['lastname'];
	            $Users->NICKNAME = $ref['nickname'];
	            $Users->EMAIL = $ref['email'];
	            $Users->PASSWORD = $pass_sha1;
	            $Users->RANK = 0; //todos los q se registran son 0, los q no son 0 los tiene q registrar el admin desde el backend
	            if(is_numeric($ref['country']))
	            	$Users->COUNTRY_ID = $ref['country'];
	            else
	            	$Users->COUNTRY_ID = null;
	            if(is_numeric($ref['region']))
	            	$Users->REGION_ID = $ref['region'];
	            else
	            	$Users->REGION_ID = null;
	            if(is_numeric($ref['city']))
	            	$Users->CITY_ID = $ref['city'];
	            else
	            	$Users->CITY_ID = null;
	            $Users->TOKEN = $ref['token'];
	            $Users->save();
	           
	            return $Users->toArray();
	   }

	    //================== REG VALIDATION
       
       public function val_nickname($us){ // Ver si puedo hacer estas dos consultas en una sola. Linea 32 y 33 BOusers.php

		        $q = Doctrine_Query::create()
					->from('Users u') 
					->AndWhere('u.NICKNAME = ?', $us);

				$user = $q->execute();
	           
	           if(sizeof($user) == 0){
	           		return true;
	           }else{
	           		return false;
	           }
	   }// End function val_nickname



       public function val_email($email){ // Ver si puedo hacer estas dos consultas en una sola. Linea 32 y 33 BOusers.php

       		$q = Doctrine_Query::create()
				->from('Users u') 
				->AndWhere('u.EMAIL = ?', $email);

			$user = $q->execute();
           
           if(sizeof($user) == 0){
           		return true;
           }else{
           		return false;
           }
  		}// End function val_email


	    


//====================================================================== LOGIN

  		//================== LOGIN 
		public function login($usr, $tok)
		{
			$q = Doctrine_Query::create()
		            ->update('Users u')
		            ->set('u.TOKEN', '?', $tok )
		            ->where('u.EMAIL = ?', $usr);
		    $rta = $q->execute();
		    return; // logueado
		
		}// End function login
      
	   //================== LOGIN VALIDATION
		public function val_login($ref){

	   		$pass_sha1 = sha1($ref[1]);

			$q = Doctrine_Query::create()
				->from('Users u') 
				->AndWhere('u.NICKNAME = ?', $ref[0])
				->AndWhere('u.PASSWORD = ?', $pass_sha1);

			$user = $q->execute();

			return $user[0]->toArray();

		}// End function val_login

	
	//==================== FIND USER MAIL = PASS
	//para ver si tiene la contraseña bien y si el usuario existe	
	public function findByMailPass($usr, $pass)
	{
		$q = Doctrine_Query::create()
			->from('Users u') 
			->AndWhere('u.EMAIL = ?',$usr)
			->AndWhere('u.PASSWORD = ?',$pass);
		
		$rta = $q->execute()->toArray();
		return $rta;
	}

	 public function findByMail($mail)
    {
    	$q = Doctrine_Query::create()
			->from('Users u') 
			->AndWhere('u.EMAIL = ?',$mail);
		$rta = $q->execute()->toArray();
		
		return $rta;
    }




		

}//end class