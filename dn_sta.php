<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

printf("<html><head>");
printf("<title>参璸</title>");
printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
printf("</head><body bgcolor=#ffffff topMargin=5 bottomMargin=0>");

printf("<table border=0 cellpadding=0 cellspacing=0 width=600><tr nowrap>");
printf("<td align=left width=50><b>厨 : </b></td>");
printf("<td align=left width=330>参璸</td>");
printf("<td align=right width=50><b>ら戳 : </b></td>");
$array2 = split("-", $date_to, 4);
$date_to1 = date("Y-m-d",mktime(0,0,0,$array2[1],$array2[2]-1,$array2[0]));
printf("<td align=right width=170>%s%s</td>",$date_fr,$date_to1);
printf("</tr><tr nowrap>");
printf("<td align=left><b>め : </b></td>");

$query = "select customer_name from ntt_customer where customer_id='$custno'";
$result = mysql_query($query,$db);
$myrow = mysql_fetch_array($result);
printf("<td align=left colspan=3>%s</td>",$myrow["customer_name"]);
printf("</tr></table>");
printf("<table border=0 cellpadding=0 cellspacing=0 width=600><tr nowrap><td>&nbsp;</td></tr></table>");

printf("<table border=0 cellpadding=0 cellspacing=0 width=600><tr>");
printf("<td colspan=7><hr size=1 noshade width=100%%></td>");
printf("</tr><tr>");
printf("<td align=center><b>&nbsp;</b></td>");
printf("<td align=center colspan=2><b>紁</b></td>");
printf("<td align=center colspan=2><b>翴</b></td>");
printf("<td align=center colspan=2><b></b></td>");
printf("</tr><tr>");
printf("<td align=center width=150><b>砯珇</b></td>");
printf("<td align=right width=50><b>ン计</b></td>");
printf("<td align=right width=100><b>秖</b></td>");
printf("<td align=right width=50><b>ン计</b></td>");
printf("<td align=right width=100><b>秖</b></td>");
printf("<td align=right width=50><b>ン计</b></td>");
printf("<td align=right width=100><b>秖</b></td>");
printf("</tr><tr>");
printf("<td colspan=7><hr size=1 noshade width=100%%></td>");
printf("</tr>");
$query = "select distinct his_reserve_line.product_id,product_name,product_unit_id,remark,sum(qty),sum(weight) from vol_product,his_reserve_head,his_reserve_line where (dn_date >= '$date_fr' and dn_date < '$date_to') and (customer_id='$custno' and his_reserve_line.status != '117' and his_reserve_head.reserve_id=his_reserve_line.reserve_id and vol_product.product_id=his_reserve_line.product_id) and remark in ('紁','翴','') group by product_id,remark order by sort_order";
$result = mysql_query($query,$db);
$first_flag=0;
while ($myrow = mysql_fetch_array($result)) {
 if ($first_flag == 0) {
  if ($myrow["remark"]=='紁') {
    $qty1 = $myrow["sum(qty)"]-0;
    $wt1 = $myrow["sum(weight)"]-0;
  }
  elseif ($myrow["remark"]=='翴') {
    $qty2 = $myrow["sum(qty)"]-0;
    $wt2 = $myrow["sum(weight)"]-0;
  }
  elseif ($myrow["remark"]=='') {
    $qty3 = $myrow["sum(qty)"]-0;
    $wt3 = $myrow["sum(weight)"]-0;
  }
  $no = $myrow["product_id"];
  $uni = $myrow["product_unit_id"];
  $pname = $myrow["product_name"];
  $first_flag=1;
  continue;
 }
 if ($no != $myrow["product_id"]) {
  printf("<tr>");
  printf("<td align=left>%s</td>",$pname);
  if ($qty1 != 0) {
    printf("<td align=right>%s</td>",$qty1);
  }
  else {
    printf("<td align=right>&nbsp;</td>");
  }
  if ($wt1 != 0) {
    printf("<td align=right>%s</td>",$wt1.$uni);
  }
  else {
    printf("<td align=right>&nbsp;</td>");
  }
  if ($qty2 != 0) {
    printf("<td align=right>%s</td>",$qty2);
  }
  else {
    printf("<td align=right>&nbsp;</td>");
  }
  if ($wt2 != 0) {
    printf("<td align=right>%s</td>",$wt2.$uni);
  }
  else {
    printf("<td align=right>&nbsp;</td>");
  }
  if ($qty3 != 0) {
    printf("<td align=right>%s</td>",$qty3);
  }
  else {
    printf("<td align=right>&nbsp;</td>");
  }
  if ($wt3 != 0) {
    printf("<td align=right>%s</td>",$wt3.$uni);
  }
  else {
    printf("<td align=right>&nbsp;</td>");
  }
  printf("</tr>");
  $qty1=0;
  $wt1=0;
  $qty2=0;
  $wt2=0;
  $qty3=0;
  $wt3=0;
  $no = $myrow["product_id"];
  $uni = $myrow["product_unit_id"];
  $pname = $myrow["product_name"];
 }
  if ($myrow["remark"]=='紁') {
    $qty1 = $myrow["sum(qty)"]-0;
    $wt1 = $myrow["sum(weight)"]-0;
  }
  elseif ($myrow["remark"]=='翴') {
    $qty2 = $myrow["sum(qty)"]-0;
    $wt2 = $myrow["sum(weight)"]-0;
  }
  elseif ($myrow["remark"]=='') {
    $qty3 = $myrow["sum(qty)"]-0;
    $wt3 = $myrow["sum(weight)"]-0;
  }
}
  printf("<tr>");
  printf("<td align=left>%s</td>",$pname);
  if ($qty1 != 0) {
    printf("<td align=right>%s</td>",$qty1);
  }
  else {
    printf("<td align=right>&nbsp;</td>");
  }
  if ($wt1 != 0) {
    printf("<td align=right>%s</td>",$wt1.$uni);
  }
  else {
    printf("<td align=right>&nbsp;</td>");
  }
  if ($qty2 != 0) {
    printf("<td align=right>%s</td>",$qty2);
  }
  else {
    printf("<td align=right>&nbsp;</td>");
  }
  if ($wt2 != 0) {
    printf("<td align=right>%s</td>",$wt2.$uni);
  }
  else {
    printf("<td align=right>&nbsp;</td>");
  }
  if ($qty3 != 0) {
    printf("<td align=right>%s</td>",$qty3);
  }
  else {
    printf("<td align=right>&nbsp;</td>");
  }
  if ($wt3 != 0) {
    printf("<td align=right>%s</td>",$wt3.$uni);
  }
  else {
    printf("<td align=right>&nbsp;</td>");
  }
  printf("</tr>");
printf("<tr>");
printf("<td colspan=7><hr size=1 noshade width=100%%></td>");
printf("</tr>");
printf("</TABLE></BODY></HTML>");
mysql_close($db);

?>
