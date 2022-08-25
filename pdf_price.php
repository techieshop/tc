<?php
require_once("pdf/report.php");
session_start();
//$colname=$_SESSION['data'];
//for ($i=0;$i<sizeof($colname[1]);$i++)
//{
//	echo $colname[1][$i];
//}
	pdf_report($_SESSION['head'],$_SESSION['colname'],$_SESSION['data']);
?>