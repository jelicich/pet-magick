BOUSERRS.PHP


//=============================================================================== AUTOCOMPLETE FUNCTIONS
   /* function autoComplete($ref){

      try
          {
            $this->complete = $this->table->autoComplete($ref);
            return true;
          }
          catch(Exception $e)
          {
            $this->err = array('Error:'=> $e->getMessage());
            return false;
          }
    }// End delete


    function getComplete()
    {
       return $this->complete;
    }// End getInbox
*/






USERSTABLE.PHP

 //==================== AUTOCOMPLETE BY USER

    public function autoComplete($ref){

    	$q = Doctrine_Query::create()
    		->select('*')
			->from('Users u') 
			->AndWhere('u.NICKNAME LIKE ?', $ref.'%');

		
		$rta = $q->execute();
		
        $json = array();

         foreach($rta as $m) 
         {
            $json[] = $m->toArray();
         }

         $rta = json_encode($json);
         return $rta;
    }