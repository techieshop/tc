<?php
//Find price in the datebase rest with customer¡¢product and date
require_once("include_head/fun_price.php");
$so_date=$_GET['date'];
$product_id=$_GET['pro_id'];
$select_name=$_GET['sln'];
$rem=$_GET['rem'];
$custno=$_GET['custno'];
if($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  	$conn_db = 1;
}
$price_message=getPrice($product_id,$custno,$so_date,$rem);
if(!$price_message) $error='no data.';
else {$price=$price_message[0];$message=$price_message[1];}
if(!$price)$error='no data.';
//$odate=date("Y-m-d",strtotime("$odate -1 months"));
$idPrice="getPrice".ereg_replace("no","",$select_name);
$idDiv="error".ereg_replace("no","",$select_name);
switch ($message)
{
	case "general_last":$error='#ff6600';break;
	case "general_2long":$error='red';break;
}


echo $price."@@".$select_name."@@".$error;
?>
