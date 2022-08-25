<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

include("include/upd_tb.php");

printf("<html>");
printf("<head>");
$title = "客戶";
printf("<title>%s</title>",$title);
printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
printf("<style type=\"text/css\">a {text-decoration: none}</style>");
printf("<script language=JavaScript src=js/kh_form.js></script>");
printf("<script language=JavaScript src=js/windowManager.js></script>");
printf("<script language=JavaScript>");
printf("var Year = %s;",date("Y"));
printf("</script>");
printf("</head>");
printf("<body bgcolor=#ffffff link=#0000ff vlink=#0000ff>");

printf("<form>");
printf("<table border=0 cellspacing=0 cellpadding=1 width=750>");
printf("<tr bgcolor=#99ff99>");
printf("<td align=left width=150><font size=-1>&nbsp;</font></td>");
printf("<td width=500 align=right><font size=-1>");
printf(" <b><a href=javascript:openSBWindow('cust_lis.php','cust_lis',790,500);>客戶</a></b>");
printf(" | <b><a href=javascript:openSBWindow('gds_lis.php','gds_lis',540,480);>貨品</a></b>");
printf(" | <b><a href=javascript:openSBWindow('so_qry.php','so_qry',340,220);>發貨單</a></b>");
printf(" | <b><a href=javascript:openSBWindow('dn_qry.php','dn_qry',340,220);>代出單</a></b>");
printf(" | <b><a href=javascript:openSBWindow('so_mon_q.php','so_mon_q',340,220);>月結</a></b>");
printf(" | <b><a href=javascript:openSBWindow('so_sta_q.php','so_sta_q',340,220);>銷售統計</a></b>");
printf(" | <b><a href=javascript:openSBWindow('dn_sta_q.php','dn_sta_q',340,220);>代出統計</a></b>");
printf("</font></td>");
printf("<td align=left width=100><font size=-1>&nbsp;</font></td>");
printf("</tr>");
printf("</table>");
$pheader = "客戶";
printf("<table border=0 cellspacing=0 cellpadding=1 width=750>");
printf("<tr bgcolor=#99ffcc>");
printf("<td align=left width=600><font size=+1><b>%s</b></font></td>",$pheader);
printf("<td align=right width=85><b>日期</b></td>");
printf("<td align=right width=65><input maxLength=10 name=so_date onchange=checkDate(this); size=7 value=\"%s\"></td>",date("Y-m-d"));
printf("</tr>");
printf("</table>");

printf("<table border=0 cellspacing=0 cellpadding=0 width=750>");
printf("<tr valign=top>");

$query = "select customer_id from ntt_customer where status_id != '115'";
$result = mysql_query($query,$db);
$numrow = mysql_num_rows($result);
$maxrow = ceil($numrow / 5);
$b = 0;

printf("<td width=155>");

printf("<table border=0 cellpadding=2 cellspacing=0 width=100%%>");
$query = "select line_no,customer_id,customer_name from ntt_customer where status_id != '115' order by line_no,customer_id limit $b,$maxrow";
$result = mysql_query($query,$db);
while ($myrow = mysql_fetch_array($result)) {
  printf("<tr bgcolor=#ffffff nowrap>");
  printf("<td><b>%s <a href=javascript:openSBWindow('so_goods.php?custno=%s','so_goods',790,520);>%s</a></b></td>",$myrow["line_no"],$myrow["customer_id"],$myrow["customer_name"]);
  printf("</tr>");
}
printf("</table>");

printf("</td>");
printf("<td width=155>");

printf("<table border=0 cellpadding=2 cellspacing=0 width=100%%>");
$b = $maxrow;
$query = "select line_no,customer_id,customer_name from ntt_customer where status_id != '115' order by line_no,customer_id limit $b,$maxrow";
$result = mysql_query($query,$db);
while ($myrow = mysql_fetch_array($result)) {
  printf("<tr bgcolor=#ffffff nowrap>");
  printf("<td><b>%s <a href=javascript:openSBWindow('so_goods.php?custno=%s','so_goods',790,520);>%s</a></b></td>",$myrow["line_no"],$myrow["customer_id"],$myrow["customer_name"]);
  printf("</tr>");
}
printf("</table>");

printf("</td>");
printf("<td width=155>");

printf("<table border=0 cellpadding=2 cellspacing=0 width=100%%>");
$b = $maxrow * 2;
$query = "select line_no,customer_id,customer_name from ntt_customer where status_id != '115' order by line_no,customer_id limit $b,$maxrow";
$result = mysql_query($query,$db);
while ($myrow = mysql_fetch_array($result)) {
  printf("<tr bgcolor=#ffffff nowrap>");
  printf("<td><b>%s <a href=javascript:openSBWindow('so_goods.php?custno=%s','so_goods',790,520);>%s</a></b></td>",$myrow["line_no"],$myrow["customer_id"],$myrow["customer_name"]);
  printf("</tr>");
}
printf("</table>");

printf("</td>");
printf("<td width=155>");

printf("<table border=0 cellpadding=2 cellspacing=0 width=100%%>");
$b = $maxrow * 3;
$query = "select line_no,customer_id,customer_name from ntt_customer where status_id != '115' order by line_no,customer_id limit $b,$maxrow";
$result = mysql_query($query,$db);
while ($myrow = mysql_fetch_array($result)) {
  printf("<tr bgcolor=#ffffff nowrap>");
  printf("<td><b>%s <a href=javascript:openSBWindow('so_goods.php?custno=%s','so_goods',790,520);>%s</a></b></td>",$myrow["line_no"],$myrow["customer_id"],$myrow["customer_name"]);
  printf("</tr>");
}
printf("</table>");

printf("</td>");
printf("<td width=130>");

printf("<table border=0 cellpadding=2 cellspacing=0 width=100%%>");
$b = $maxrow * 4;
$query = "select line_no,customer_id,customer_name from ntt_customer where status_id != '115' order by line_no,customer_id limit $b,$maxrow";
$result = mysql_query($query,$db);
while ($myrow = mysql_fetch_array($result)) {
  printf("<tr bgcolor=#ffffff nowrap>");
  printf("<td><b>%s <a href=javascript:openSBWindow('so_goods.php?custno=%s','so_goods',790,520);>%s</a></b></td>",$myrow["line_no"],$myrow["customer_id"],$myrow["customer_name"]);
  printf("</tr>");
}
printf("</table>");

printf("</td>");

printf("</tr>");
printf("</table>");
printf("</form>");
printf("<hr noshade size=1 width=750 align=center>");
printf("<font size=-1>");
printf("<p align=center>&copy;2001 泰昌銷售印單系統V2.1");
printf("</font>");
printf("</body>");
printf("</html>");
mysql_close($db);

?>
