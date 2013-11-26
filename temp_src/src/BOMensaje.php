<?php
include_once('tools/bootstrap.php');
include_once('models/MensajesTable.php');
include_once('models/UsuariosTable.php');

class BOMensaje{

	var $err = array();
	var $tablaUsr;
	var $msg;
	var $dest;
	var $leido;



	function __construct()
	{
		$this->tablaUsr = Doctrine_Core::getTable('Usuarios');
		$this->msg = new Mensajes();
	}

	function enviar($array)
	{
		if($this->validarEnviar($array))
		{
		    $this->msg->ID_FROM = $array['id_from'];
			$this->msg->ID_TO = $this->dest;
			$this->msg->FECHA = date('Y-m-d H:i:s');
			$this->msg->MENSAJE = $array['mensaje'];
			
			$this->msg->save();	
			return true;
		}
		else
		{
			return false;
		}
	}

	function leer($array)
	{
		if($this->validarLeer($array))
		{
			$q = Doctrine_Query::create()
		            ->select('m.MENSAJE,m.FECHA,u.MAIL,m.ID')
		            ->from('Mensajes m')
		            ->innerJoin('m.Usuarios u')
		            ->AndWhere('m.ID_TO = ?', $array['id'] )
		            ->AndWhere('m.FECHA > ?', $array['fecha'])
		            ->AndWhere('m.LEIDO = ?', '0');
		    $rta=$q->execute();



	        $json = array();

	        foreach($rta as $m) 
	        { 
	        	$json[] = $m->toArray();
	        }
	        
	        //los marco como leidos        
	        for($i=0;$i<sizeof($json);$i++) 
	        {
	        	//$mids[] = $json[$i]['ID'];
	        	$q = Doctrine_Query::create()
		            ->update('Mensajes m')
		            ->set('m.LEIDO', '?', '1' )
		            ->where('m.ID = ?', $json[$i]['ID']);
		    	$rta2=$q->execute();
	        }

	        $rta = json_encode($json);

	        //los marco como leido

	        /*
	        $q = Doctrine_Query::create()
		            ->update('Mensajes m')
		            ->set('m.LEIDO', '?', '1' )
		            ->where('m.MAIL = ?', $usr);
		    $rta=$q->execute();
			*/
			$this->leido = $rta;
	        return true;
		}
		else
			return false;
	}

	function validarEnviar($array)
	{
		//si no es array lo que recibo
		if(!is_array($array))
		{
			$this->err['001']= "Formato de datos incorrecto";
		}
		else
		{
			//si tiene algun campo vacio
			foreach ($array as $key => $value) 
			{
				if(empty($value))
				{
					$this->err['002'][] = "El campo ".$key." esta vacio, es obligatorio. ";
				}
			}
			//Si el usuario no existe
			if(!empty($array['dest']))
			{
				$rta = $this->tablaUsr->buscarPorMail($array['dest']);
				if(empty($rta))
				{
					$this->err['003']="El usuario destinatario no existe";
				}
				else
				{
					$this->dest = $rta[0]['ID'];
				}
			}
		}

		$e = $this->getErrores();
		if(empty($e))
			return true;
		else
			return false;
	}

	function validarLeer($array)
	{
		if(sizeof($array)<2 || empty($array['id']) || empty($array['fecha']))
		{
			$this->err['004']="Hubo un error con su sesion. No se pueden leer los mensajes";
			return false;
		}
		else
		{
			return true;
		}
	}

	function getErrores()
	{
		return $this->err;
	}

	function getLeido()
	{
		return $this->leido;
	}
}

/*
$n = new BOMensaje;
$a  = array('id' => '33', 'fecha'=>'2013-06-12 20:20:20');
var_dump($n->leer($a));
*/
?>