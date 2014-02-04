<?php
include_once('tools/bootstrap.php');
include_once('models/UsuariosTable.php');

class BOUsuario{
	var $tabla;
	var $usr;
	var $errores = array();
	var $msg;



	function __construct()
	{
		$this->tabla = Doctrine_Core::getTable('Usuarios');
		$this->usr = new Usuarios();
	}

	function registrar($array)
	{
		if($this->validarReg($array))
		{
			//$usr = new Usuarios();
		    $this->usr->NOMBRE = ($array['nombre']);
			$this->usr->APELLIDO = ($array['apellido']);
			$this->usr->MAIL = ($array['mail']);
			$this->usr->PASSWORD = sha1(($array['password']));
			$this->usr->LOGGED = 0;
			$this->usr->save();	
			
			$this->msg = "Se registro correctamente";
			$msg=$this->getMsg();
			return true;
		}
		else
		{
			//return $this->getErrores();
			return false;
		}
	}

	function login($usr, $pass, $tok)
	{
		if($this->validarLogin($usr, sha1($pass), $tok))
		{
			$q = Doctrine_Query::create()
		            ->update('Usuarios u')
		            ->set('u.LOGGED', '?', $tok )
		            ->where('u.MAIL = ?', $usr);
		    $rta = $q->execute();
		    $this->msg = "Se logueo correctamente";
		    return true;
		}
		else
		{
			//return $this->getErrores();
			return false;
		}
	}

	function logout($usr)
	{
		$rta = $this->tabla->buscarPorMail($usr);
		
		$q = Doctrine_Query::create()
	            ->update('Usuarios u')
	            ->set('u.LOGGED', '?', 0 )
	            ->where('u.ID = ?', $usr);
	    $rta=$q->execute();
	    //session_destroy();
	    $this->msg = "Se deslogueo correctamente";
	    return true;
	    //como hacer para que la sesion no expire?
	}

	function validarReg($array)
	{
		//si no es array lo que recibo
		if(!is_array($array))
		{
			$this->errores['001']= "Formato de datos incorrecto";
		}
		else
		{
			//si tiene algun campo vacio
			foreach ($array as $key => $value) 
			{
				if(empty($value))
				{
					$this->errores['002'][]="El ".$key." esta vacio, es obligatorio";
				}
			}
			//Si el usuario ya existe
			$rta = $this->tabla->buscarPorMail($array['mail']);
			if(!empty($rta))
			{
				$this->errores['003']="El usuario ya existe";
			}
			//si no coinciden las contraseñas
			if($array['password'] != $array['password2'])
			{
				$this->errores['004']="La contraseña no coincide";
			}
		}

		$e = $this->getErrores();
		if(empty($e))
			return true;
		else
			return false;
	}

	function validarLogin($usr, $pass, $tok)
	{
		if(empty($usr) || empty($pass))
		{
			$this->errores['005']="Debe ingresar el mail y contraseña";
		}
		else
		{
			$rta = $this->tabla->buscarPorMailPass($usr,$pass);
			
			if(empty($rta))
			{
				$this->errores['006'] = "Usuario inexistente o contraseña incorrecta";
			}
			else
			{
				if($rta[0]['LOGGED'] != 0)
				{
					if($rta[0]['LOGGED'] != $tok)
						$this->errores['007'] = "Ya hay una sesion abierta de este usuario";
				}
			}
		}

		$e = $this->getErrores();
		if(empty($e))
			return true;
		else
			return false;
	}

		function getErrores()
	{
		return $this->errores;
	}

	function getMsg()
	{
		return $this->msg;
	}


}


?>