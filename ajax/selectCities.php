<?php	
include('../php/classes/BOlocation.php');
$location = new BOLocation();

$cities = $location->citiesByRegion($_GET['idRegion']);

echo '<option disabled="disabled" selected="selected">City</option>';

foreach ($cities as $key => $value) 
{
	echo '<option value="'.$value['CityId'].'">'.$value['City'].'</option>';
}

//echo '<option value="0">Other</option>';