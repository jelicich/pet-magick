<?php	
include('../php/classes/BOlocation.php');
$location = new BOLocation();

$cities = $location->citiesByRegion($_GET['idRegion']);
var_dump($_GET);
echo '<select id="city">';
foreach ($cities as $key => $value) 
{
	echo '<option value="'.$value['CityId'].'">'.$value['City'].'</option>';
}
echo '</select>';
