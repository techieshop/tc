<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

if ($action == "確定") {
  $query = "select sort_order from vol_product where sort_order >= '$sorder' order by sort_order limit 0,2";
  $result = mysql_query($query,$db);
  $sum_order = 0;
  while ($myrow = mysql_fetch_array($result)) {
    $sum_order += $myrow["sort_order"];
  }
  if ($sorder != $sum_order) {
    $sorder = $sum_order / 2;
  }
  else {
    $sorder += 100;
  }
  $pname = addslashes(trim($pname));
  $query = "insert into vol_product (product_id,product_name,sort_order,product_unit_id,status) values(null,'$pname','$sorder','$uni',109)";
  $result = mysql_query($query,$db);
}

printf("<html><head>");
printf("<title>新加貨品</title>");
printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
printf("<script language=JavaScript src=js/windowManager.js></script>");
printf("</head><body bgcolor=#eeeeee link=#000000>");

printf("<form action=$PHP_SELF method=post>");
printf("<table border=0 cellspacing=0 cellpadding=1 width=300>");
printf("<tr bgcolor=#70a4e9>");
printf("<td align=left height=25><font><b>新加貨品</b></font></td>");
printf("</tr></table>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=300><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
printf("<table border=0 cellpadding=0 cellspacing=0 width=300><tr>");
printf("<td width=10%%>&nbsp;</td>");
printf("<td align=left width=15%%><b>貨名</b></td>");
printf("<td align=left width=75%%><font size=-1><input maxLength=50 name=pname size=25 value=></font></td>");
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("</tr><tr>");
printf("<td width=10%%>&nbsp;</td>");
printf("<td align=left width=15%%><b>單位</b></td>");
printf("<td align=left width=75%%><font size=-1><select name=uni size=1>");
$query = "select * from ref_product_unit";
$result1 = mysql_query($query,$db);
while ($myrow = mysql_fetch_array($result1)) {
  printf("<option value=%s>%s",$myrow["product_unit_id"],$myrow["product_unit_name"]);
}
printf("</select></font></td>");
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("</tr><tr>");
printf("<td width=10%%>&nbsp;</td>");
printf("<td width=15%%>&nbsp;</td>");
printf("<td align=left width=75%%><font size=-1><b>排在下列貨品之後</b></font></td>");
printf("</tr><tr>");
printf("<td width=10%%>&nbsp;</td>");
printf("<td align=left width=15%%><b>次序</b></td>");
printf("<td align=left width=75%%><font size=-1><select name=sorder size=1>");
$query = "select sort_order,product_name from vol_product order by sort_order desc";
$result1 = mysql_query($query,$db);
while ($myrow = mysql_fetch_array($result1)) {
  printf("<option value=%s>%s",$myrow["sort_order"],$myrow["product_name"]);
}
printf("</select></font></td>");
printf("</tr></TABLE>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=300><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=300><TR nowrap><TD align=left width=30%%>&nbsp;");
printf("</TD><TD align=left width=30%%>");
printf("<INPUT type=submit name=action value=確定>");
printf("</TD><TD align=left width=40%%>");
printf("<INPUT type=button value=關閉 onclick=openSBWindow('gds_lis.php','gds_lis',540,480);window.close();>");
printf("</TD></TR></TABLE></FORM></BODY></HTML>");
mysql_close($db);

?>
