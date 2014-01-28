<?php	
include_once('../php/classes/BOLocation.php');
$location = new BOLocation();

$cities = $location->citiesByRegion($_GET['idRegion']);


		$json = array();

         foreach($cities as $m) 
         {
            $json[] = $m;
         }

         $rta = json_encode($json);
         echo $rta;

/*
echo '<option disabled="disabled" selected="selected">City</option>';

foreach ($cities as $key => $value) 
{
	echo '<option value="'.$value['CityId'].'">'.$value['City'].'</option>';
}

//echo '<option value="0">Other</option>';
*/