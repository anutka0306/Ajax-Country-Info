<?php
$user = "root";
$password = "root";
$db_name = "world";
$host = "localhost";

$db = mysqli_connect($host, $user, $password, $db_name) or die("Didn't connect with Data Base");
mysqli_set_charset($db, "utf8") or die("Not possible to set charset of connection");



function getCountries(){
  global $db;
  $query = "SELECT Code, Name FROM country";
$res =  mysqli_query($db, $query);
  return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function getCities(){
 global $db;
 $code = mysqli_real_escape_string($db, $_POST['code']);
 $query = "SELECT ID, Name FROM city WHERE CountryCode = '$code'";
 $res = mysqli_query($db, $query);
 $data = '<option disabled selected>Choose you city</option>';
 while($row = mysqli_fetch_assoc($res)){
  $data .= "<option value='{$row['ID']}'>{$row['Name']}</option>";
 }
 return $data;
}

function getPopulation(){
  global $db;
  $cityId = mysqli_real_escape_string($db, $_POST['cityId']);
  $query = "SELECT Population, Name FROM city WHERE ID = '$cityId'";
  $res = mysqli_query($db, $query);
  while($row = mysqli_fetch_assoc($res)){
  $data .= "Population of {$row['Name']} city are: {$row['Population']} residents";
}
return $data;
}

function getCountryInfo(){
global $db;
$code2 = mysqli_real_escape_string($db, $_POST['code2']);



$query = "SELECT * FROM country WHERE Code = '$code2'";
$res = mysqli_query($db, $query);
$data = '';
while($row = mysqli_fetch_assoc($res)){
  $id_capital = $row['Capital'];
  $query_capital = "SELECT Name FROM city WHERE ID = '$id_capital'";
  $res_capital = mysqli_query($db, $query_capital);
  $data_capital = '';
  while($row_capital = mysqli_fetch_assoc($res_capital)){
    $data_capital .= $row_capital['Name'];
  }
  $data .= "<p>Continent: {$row['Continent']}</p>";
  $data .= "<p>Capital: {$data_capital}</p>";
  $data .= "<p>Region: {$row['Region']}</p>";
  $data .= "<p>Surface Area: {$row['SurfaceArea']}</p>";
  $data .= "<p>Country Population: {$row['Population']} residents</p>";
  $data .= "<p>Independence Year: {$row['IndepYear']}</p>";
  $data .= "<p>Gowernment Form: {$row['GovernmentForm']}</p>";
  $data .= "<p>Life Expectancy: {$row['LifeExpectancy']} year(s)</p>";
}
return $data;

}


if(!empty($_POST['cityId'])){
echo getPopulation();
exit;
}

if(!empty($_POST['code'])){
 echo getCities();
 exit;
}
if(!empty($_POST['code2'])){
 echo getCountryInfo();
 exit;
}

$countries = getCountries();

 ?>
