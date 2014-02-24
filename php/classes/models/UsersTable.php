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
	            $Users->RANK = $ref['rank']; //todos los q se registran son 0, los q no son 0 los tiene q registrar el admin desde el backend
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
		/*
		public function login($usr, $tok)
		{
			$q = Doctrine_Query::create()
		            ->update('Users u')
		            ->set('u.TOKEN', '?', $tok )
		            ->where('u.EMAIL = ?', $usr);
		    $rta = $q->execute();
		    return; // logueado
		
		}// End function login
		*/
      
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
    
    public function findByMailLog($mail)
    {
    	$q = Doctrine_Query::create()
    		->select('u.ID_USER, u.NAME, u.LASTNAME, u.NICKNAME, u.EMAIL, p.THUMB')
			->from('Users u') 
			->innerJoin('u.Pics p')
			->AndWhere('u.EMAIL = ?',$mail);
		$rta = $q->execute()->toArray();
		
		return $rta;
    }

    

     //==================== AUTOCOMPLETE EVERYTHING

    public function autoCompleteEverything(){

    	$q = Doctrine_Query::create()
    		->select('*')
			->from('Users u');

		$rta = $q->execute();
		
        $json = array();

         foreach($rta as $m) 
         {
            $json[] = $m->toArray();
         }

         $rta = json_encode($json);
         return $rta;
    }


    //=================== PROFILE METHODS
    public function updateInfo($array)
    {

        


    	$q = Doctrine_Query::create()
		            ->update('Users u')
		            ->set('u.NAME', '?', $array['name'] )
		            ->set('u.LASTNAME', '?', $array['lastname'] )
		            //->set('u.NICKNAME', '?', $array['nickname'] )
		            ->set('u.EMAIL', '?', $array['email'] )
		            ->set('u.ABOUT', '?', $array['about'] );
		            

    	if(!empty($array['country']) && is_numeric($array['country']))
          	$q->set('u.COUNTRY_ID', '?', $array['country'] );
        else
        	$q->set('u.COUNTRY_ID', 'null' );
        
        if(!empty($array['region']) && is_numeric($array['region']))
        	$q->set('u.REGION_ID', '?', $array['region'] );
        else
        	$q->set('u.REGION_ID', 'null' );
        
        if(!empty($array['city']) && is_numeric($array['city']))
        	$q->set('u.CITY_ID', '?', $array['city'] );
        else
        	$q->set('u.CITY_ID',  'null' );

        if(isset($array['delete-pic']))
        	$q->set('u.PIC_ID', 'null');
		
		if(!empty($array['pic']) && is_numeric($array['pic']))
        	$q->set('u.PIC_ID', '?', $array['pic'] );
       



		            //->set('u.COUNTRY_ID', '?', $array['country'] )
		            //->set('u.REGION_ID', '?', $array['region'] )
		            //->set('u.CITY_ID', '?', $array['city'] )
		            
		    		$q->where('u.ID_USER = ?', $_SESSION['id']);
		    $rta = $q->execute();
		    return $rta; 
    }

   /*  public function getUserList($limit){
        $q = Doctrine_Query::create()
            //->select('p.USER_ID, u.ID_USER, u.NAME, u.LASTNAME, u.NICKNAME, ph.PIC, k.Country, r.Region, c.City')
            ->select('u.NAME, u.LASTNAME, u.NICKNAME, ph.PIC, k.Country, r.Region, c.City')
            ->from('Users u')
            //->innerJoin('p.Users u')
            ->leftJoin('u.Pics ph') // van con leftJoin, sino, si el usuario no tiene nada cargado, no trae nada
            ->leftJoin('u.Countries k')
            ->leftJoin('u.Regions r')
            ->leftJoin('u.Cities c')
            //->where('p.ANIMAL_CATEGORY_ID = ?', $id)
            ->groupBy('u.ID_USER')
            ->limit($limit);
        
        $r = $q->execute();    
        
        return $r->toArray();
    }*/

    public function getUserList(){

        $userCount = Doctrine::getTable('Users')->count();
        $user = Doctrine::getTable('Users')
       ->createQuery()
       ->select('u.NAME, u.LASTNAME, u.NICKNAME, ph.PIC, k.Country, r.Region, c.City')
	    ->from('Users u')
	    ->leftJoin('u.Pics ph')
	    ->leftJoin('u.Countries k')
	    ->leftJoin('u.Regions r')
	    ->leftJoin('u.Cities c')
	    ->groupBy('u.ID_USER')
       ->offset(rand(0, $userCount - 1))
       ->fetchOne();


       if($user)
         return $user->toArray();
       else
            return false;
     }
    
    public function getAlbumIdByUser($id)
    {   
        $q = Doctrine_Query::create()
            ->select('u.ALBUM_ID')
            ->from('Users u')
            ->where('u.ID_USER = ?',$id);

        $r = $q->execute();
        $r = $r->toArray();
        return $r[0]['ALBUM_ID'];

    }

    public function setAlbum($albumId, $userId)
    {
        $q = Doctrine_Query::create()
            ->update('Users u')
            ->set('u.ALBUM_ID', '?', $albumId )
            ->where('u.ID_USER = ?', $userId);

        $rta = $q->execute();
    }   

   public function howmuch_profiles(){

   		   $q = Doctrine_Query::create()
            
            ->select('u.NAME')
            ->from('Users u');
        
        $r = $q->execute();    
        
        return $r->toArray();

   }

}//end class