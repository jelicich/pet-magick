<?php	
include_once('../php/classes/BOLocation.php');
$location = new BOLocation();

$regions = $location->regionsByCountry($_GET['idCountry']);

echo '<option disabled="disabled" selected="selected">Region</option>';

foreach ($regions as $key => $value) 
{
	echo '<option value="'.$value['RegionID'].'">'.$value['Region'].'</option>';
}

