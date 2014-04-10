<?php

include_once('tools/bootstrap.php');
include_once('models/UsersTable.php');
include_once('models/PicsTable.php');
include_once('models/CountriesTable.php');
include_once('models/RegionsTable.php');
include_once('models/CitiesTable.php');
//lo agrego para poder borrar la imagen de perfil cuando sube otra
include_once ('BOPics.php');

class BOUsers{

  var $table;
  var $err;
  var $complete;

  function __construct(){

    $this->table = Doctrine_Core::getTable('Users');
    $this->picsTable = Doctrine_Core::getTable('Pics');
    $this->countriesTable = Doctrine_Core::getTable('Countries');
    $this->regionsTable = Doctrine_Core::getTable('Regions');
    $this->citiesTable = Doctrine_Core::getTable('Cities');
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

                $rta_nickname = $this->table->val_nickname($ref['nickname']); // Ver si esto se puede optimizar (junto con las consultas en table: val_nickname, val_email)
                $rta_email = $this->table->val_email($ref['email']);

                
                if($ref['password'] != $ref['password2']){

                    throw new Exception("Passwords don't match");
                    break;

                    //LO COMENTO PORQUE EL NICKNAME NO ERA UNIQUE
              }else if($rta_nickname == false){ 

                     throw new Exception('Existing user');
                     break;

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

    function loginBlog($ref){

        $q = Doctrine_Query::create()
                ->update('Chyrp_users c')
                ->set('c.login', '?', $array['name'] )
                ->set('c.password', '?', $array['lastname']);
    }

    function checklogin(){

      if(!isset($_SESSION['id'])){
        
        return false;

      }
      else
      {
        return true;
      }

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
          ->where('u.ID_USER = ?', $ref);
          //->where('u.EMAIL = ?', $ref);
      $q->execute();

     // echo 'Borrado! (Borrar este echo del codigo)';

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






    //===== PROFILE

    function getUserData($id)
    {
        $data = $this->table->find($id);
        //var_dump($data);
        $this->nameComp = $data->NAME . ' ' . $data->LASTNAME;
        $this->name = $data->NAME;
        $this->lastname = $data->LASTNAME;
        $this->nickname = $data->NICKNAME;        
        $this->about = $data->ABOUT;
        $this->email = $data->EMAIL;
        

        //no puedo traer todo de una como hizo vidaurri asiq voy trayendo de a poco
        if(!empty($data->PIC_ID))
        {
            $p = $this->picsTable->find($data->PIC_ID);
            $this->picId = $data->PIC_ID;
            $this->profilePic = 'img/users/'.$p->PIC;
            $this->thumb = 'img/users/thumb/'.$p->PIC;
            $this->hasPic = true;
        }
        else
        {
            $this->hasPic = false;
            $this->profilePic = 'img/users/default.jpg';
            $this->thumb = 'img/users/thumb/default.jpg';
        }


        if(!empty($data->ALBUM_ID))
        {
            $this->albumId = $data->ALBUM_ID;
        }
        else
        {
            $this->albumId = false;
        }


        if(!empty($data->COUNTRY_ID))
        {
            $this->countryId = $data->COUNTRY_ID;
            $c = $this->countriesTable->find($data->COUNTRY_ID);
            $this->location = $c->Country;

            if(!empty($data->REGION_ID))
            {
                $this->regionId = $data->REGION_ID;
                $r = $this->regionsTable->find($data->REGION_ID);
                $this->location .= ', '.$r->Region;

                if(!empty($data->CITY_ID))
                {
                    $this->cityId = $data->CITY_ID;
                    $c = $this->citiesTable->find($data->CITY_ID);
                    $this->location .= ', '.$c->City;
                }

            }
        }
        else
        {
            $this->location = false;
        }
    
        
        
    }
    /*
    function getUserList($limit)
    {
        $array = $this->table->getUserList($limit);
        return $array;
    }
    */
      function getUserList()
    {
        $array = $this->table->getUserList();
        return $array;
    }
    
    //$id = album ID
    function getAlbum($id)
    {

        $a = $this->picsTable->getPicsByAlbum($id);
        for($i=0; $i<sizeof($a); $i++)
        {
            $file=$a[$i]['PIC'];
            $a[$i]['PIC'] = 'img/users/' . $file;
            $a[$i]['THUMB'] = 'img/users/thumb/' . $file;
        }
        return $a;
    }

    //GETS PROFILE
    function getName()
    {
        return $this->name;   
    }

    function getLastname()
    {
        return $this->lastname;   
    }
    
    function getNameComp()
    {
        return $this->nameComp;
    }

    function getNickName()
    {
        return $this->nickname;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getProfilePic()
    {
        return $this->profilePic;
    }

    function getThumb()
    {
        return $this->thumb;
    }

    function getAbout()
    {
        return $this->about;
    }

    function getLocation()
    {
        return $this->location;
    }

    function getAlbumId()
    {
        return $this->albumId;
    }

    function getCountryId()
    {
        return $this->countryId;
    }

    function getRegionId()
    {
        return $this->regionId;
    }

    function getCityId()
    {
        return $this->cityId;
    }

    function getPicId()
    {
      return $this->picId;
    }

    function hasPic()
    {
      return $this->hasPic;
    }

    function getVets(){

          $q = Doctrine_Query::create()
          ->select('u.ID_USER, u.NAME, u.LASTNAME, u.NICKNAME, u.EMAIL')
          ->from('Users u') 
          ->AndWhere('u.RANK = ?', 2);

        $user = $q->execute();
        return $user->toArray();
    }

    function becomeVet($ref) {

      $q = Doctrine_Query::create()
                ->update('Users u')
                ->set('u.RANK', '?', $ref['rank'] )
                ->where('u.EMAIL = ?', $ref['email']);
        $rta = $q->execute();
        return $rta; 
    }


 //==== Own profile
    function isOwn()
    {
      if(isset($_POST['u']))
        $id = $_POST['u'];
      else if(isset($_GET['u']))
        $id = $_GET['u'];
        
      if(isset($_SESSION['id']) && $id == $_SESSION['id'])
      {
          return true;
      }
      else
      {
          return false;
      }
    }



    // ==== UPDATE / SAVE 

    function updateInfo($array, $path)
    {
        //var_dump($array);
       if($this->val_updateInfo($array))
       {
          
          $pic = new BOPics;
          $dataPic = $this->table->find($_SESSION['id']);
          $oldPic = $dataPic->PIC_ID;
          $r = $this->table->updateInfo($array);
          
          //borro la imagen original de perfil
          if(!empty($array['pic']) && is_numeric($array['pic']))
          {
            if(!empty($oldPic))
              $pic->unlinkProfilePic($oldPic, $path);
          }
          elseif(isset($array['delete-pic']))
          {
             
             for($i = 0; $i < sizeof($array['delete-pic']); $i++)
             {
                $pic->unlinkProfilePic($array['delete-pic'][$i], $path);    
             }
          }

          return true;

        } //end if

        else
        {
          return false;
        }

        //echo $r;
            /*
        try
        {
            $this->val_updateInfo($array);
            $r = $this->table->updateInfo($array);
            echo $r;
            return true;
        }

        catch(Exception $e)
        {
            echo 'no guardo';
            $this->err = array('Error:'=> $e->getMessage());
            return false;
        }*/
    }

    function val_updateInfo($array)
    {
        if(empty($array['name']) || empty($array['lastname']) || empty($array['email']))
        {
          $er = '<ul class="update-err">';
          
          if(empty($array['name']))
            $er .= '<li>The name field is mandatory</li>';
          if(empty($array['lastname']))
            $er .= '<li>The lastname field is mandatory</li>';
          if(empty($array['email']))
            $er .= '<li>The e-mail field is mandatory</li>';
          
          $er .= '</ul>';
          $this->err = $er;
          return false;
        }
        else
        {
          return true;
        }
    }

    function getErr()
    {
      return $this->err;
    }


    function updateAlbum($array, $path)
    {
        //var_dump($array);
      
        
        $pic = new BOPics;
        
        if(isset($array['delete-pic']))
        {
            for($i = 0; $i < sizeof($array['delete-pic']); $i++)
            {
                $pic->unlinkProfilePic($array['delete-pic'][$i], $path);    
            }
            
        }

        /*
        $dataPic = $this->table->find($_POST['p']);
        $oldPic = $dataPic->PIC_ID;
        
        $r = $this->table->updateInfo($array);
        
        //borro la imagen original de perfil
        if(!empty($array['pic']) && is_numeric($array['pic']))
        {
          if(!empty($oldPic))
            $pic->unlinkProfilePic($oldPic, $path);
        }
        */


    }

    function getAlbumIdByUser($id)
    {
        return $this->table->getAlbumIdByUser($id);
    }


    function setAlbum($albumId, $userId)
    {
        $this->table->setAlbum($albumId, $userId);
    }

      function howmuch_profiles()
    {
        $r = $this->table->howmuch_profiles();
        return $r;
    }
    

    function getProfilePicWP($id)
    {
      $p = $this->table->getProfilePicWP($id);
      $pic = array();
      //var_dump($p);
      if(isset($p[0]['Pics']))
      {
          $pic['PIC'] = '../img/users/'.$p[0]['Pics']['PIC'];
          $pic['THUMB'] = '../img/users/thumb/'.$p[0]['Pics']['PIC'];
      }
      else
      {
          $pic['PIC'] = '../img/users/default.jpg';
          $pic['THUMB'] = '../img/users/thumb/default.jpg';
      }
      
      return $pic;
    }


    function updatePassword($data){

       $user = $this->table->find($data['user_id']);
       $password = sha1($data['password']);
       $newPassword = sha1($data['newPassword']);

       if($password == $user['PASSWORD']){

            $q = Doctrine_Query::create()
                  ->update('Users u')
                  ->set('u.PASSWORD', '?', $newPassword )
                  ->where('u.ID_USER = ?', $data['user_id']);
            $rta = $q->execute();
         
            echo "<div id='passAlert' class='alert alert-success'>New password set!</div>"; 

       } else{

            echo "<div id='passAlert' class='alert alert-danger'>Inavlid password</div>"; 
       }
    }

    function forgotPassword($data){

               $user = $this->table->findByMail($data);
               //var_dump($user);

               if(sizeof($user) > 0){

                    $newPasswordDb = sha1($user[0]['LASTNAME'].'_'.uniqid()); 
                    $newPasswordToUser = $user[0]['LASTNAME'].'_'.uniqid(); 
                   // echo $newPasswordToUser; exit;

                    $q = Doctrine_Query::create()
                          ->update('Users u')
                          ->set('u.PASSWORD', '?', $newPasswordDb )
                          ->where('u.ID_USER = ?', $user[0]['ID_USER']);
                    $rta = $q->execute();

                    $to = $data;
                    $subject = 'New Password';
                    $message = 'Hi! This is your new password '.$newPasswordToUser.' Remember that you can change it from your profile whenever you want';
                  //  $headers = 'From: noreply_pet_magick@petmagik.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                    $headers =  "From: noReply@petmagick.co.nz\r\n";
                    $headers .= "Date: ". date('Y-m-d H:i:s'); 
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";



                if(mail($to, $subject, $message, $headers)){

                       echo "<div id='passAlert' class='alert alert-success'>Check your email !</div>";            
                  
                }else{

                    echo "<div id='passAlert' class='alert alert-danger'>There was a problem. Please try again in a few minutes</div>";  
               }

               //Return para WP
               return(array('ID' => $user[0]['ID_USER'], 'user_pass' => $newPasswordToUser));

                }else{

                  echo "<div id='passAlert' class='alert alert-danger'>Invalid email</div>"; 
                }
    }

    function searchUsers($string,$from,$to)
    {
        if($string == '*')
        {
          $q = Doctrine_Query::create()
            ->select('u.ID_USER, u.NAME, u.LASTNAME, u.NICKNAME, ph.PIC, k.Country, r.Region, c.City')
            ->from('Users u')
            ->leftJoin('u.Pics ph')
            ->leftJoin('u.Countries k')
            ->leftJoin('u.Regions r')
            ->leftJoin('u.Cities c')
            ->orderBy('u.ID_USER DESC')
            ->offset($from)
            ->limit($to);
        }
        else
        {
          $q = Doctrine_Query::create()
            ->select('u.ID_USER, u.NAME, u.LASTNAME, u.NICKNAME, ph.PIC, k.Country, r.Region, c.City')
            ->from('Users u')
            ->leftJoin('u.Pics ph')
            ->leftJoin('u.Countries k')
            ->leftJoin('u.Regions r')
            ->leftJoin('u.Cities c')
            ->where('u.NAME LIKE ?', '%'.$string.'%')
            ->orWhere('u.LASTNAME LIKE ?', '%'.$string.'%')
            ->orWhere('u.NICKNAME LIKE ?', '%'.$string.'%')
            ->orderBy('u.ID_USER DESC')
            ->offset($from)
            ->limit($to);  
        }
        
        $rta = $q->execute();

        if($rta)
            return $rta->toArray();
        else
            return false;

    }

    function totalRecords($string)
    {
        if($string == '*')
        {
          $q = Doctrine_Query::create()
            ->select('COUNT(u.ID_USER) as QTY')
            ->from('Users u')
            ->orderBy('u.ID_USER DESC');  
        }
        else
        {
          $q = Doctrine_Query::create()
            ->select('COUNT(u.ID_USER) as QTY')
            ->from('Users u')
            ->where('u.NAME LIKE ?', '%'.$string.'%')
            ->orWhere('u.LASTNAME LIKE ?', '%'.$string.'%')
            ->orWhere('u.NICKNAME LIKE ?', '%'.$string.'%')
            ->orderBy('u.ID_USER DESC');  
        }
        
        $rta = $q->execute();

        if($rta)
        {
            $ar = $rta->toArray();
            return $ar[0]['QTY'];
        }          
        else
        {
            return false;
        }
            
    }

    function findName($id)
    {
      $q = Doctrine_Query::create()
          ->select('u.NAME, u.LASTNAME, u.NICKNAME')
          ->from('Users u')
          ->where('u.ID_USER = ?',$id);
        $rta = $q->execute();

        if($rta)
        {
            $ar = $rta->toArray();
            return $ar;
        }          
        else
        {
            return false;
        }
    }


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
