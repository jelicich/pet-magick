<?php

include_once('tools/bootstrap.php');
include_once('models/CountriesTable.php');



class BOLocation{

  var $country_table;
  var $region_table;
  var $city_table;
  
  var $err;

  function __construct()
  {
    $this->country_table = Doctrine_Core::getTable('Countries');
  }

//======================= nombres de todos los paises
    function countryList(){

        $rta = $this->country_table->getCountries();
        return $rta;
       
    }// End country

    function regionsByCountry($id){

        $rta = $this->country_table->getRegionsByCountry($id);
        return $rta;
       
    }// End country

    function citiesByRegion($id){

        $rta = $this->country_table->getCitiesByRegion($id);
        return $rta;
       
    }// End country

      

}//End class BOUsers


?>
