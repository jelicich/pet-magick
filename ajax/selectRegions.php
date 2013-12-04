<?php	
include('../php/classes/BOlocation.php');
$location = new BOLocation();

$regions = $location->regionsByCountry($_GET['idCountry']);


foreach ($regions as $key => $value) 
{
	echo '<option value="'.$value['RegionID'].'">'.$value['Region'].'</option>';
}

