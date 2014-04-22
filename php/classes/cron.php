<?php


 function conectar() 
    {

    	$conexion = @mysqli_connect('localhost', 'petmagic_userdb', 'petmagick1524', 'petmagic_db');
    	

        if (!$conexion) 
        {
        //entra en este if si $conexion es false
            die("No connection to database");
        }
        return $conexion;
    }

    function consultar($conexion, $consulta) 
    {
        $resultadoConsulta = mysqli_query($conexion,$consulta);
        //var_dump($resultadoConsulta);
        $err = mysqli_error($conexion);
        if ($err) 
        {
            die("Query error " . $err);
        }
        return $resultadoConsulta;
    }


    function consultarConResultados($conexion, $consulta) 
    {
        $resultado = $this->consultar($conexion, $consulta);

        $registros = array();
        while($registro = mysqli_fetch_assoc($resultado)) 
        {
            $registros[] = $registro;
        }
        return $registros;
    }

    function clean_subscriptions_unfoncirmed(){
            
        $c = $this->conectar();
        $q = "DELETE FROM users WHERE STATUS = 0 AND REGISTRATION_DATE < DATE_ADD(NOW(), INTERVAL -2 DAY)";

        consultar($c,$q);
    }// End read

