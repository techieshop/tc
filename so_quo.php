<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

printf("<html>");
printf("<head>");
$title = "報價單";
printf("<title>%s</title>",$title);
printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
printf("</head><body bgcolor=#ffffff topMargin=0 bottomMargin=0>");

printf("<table border=0 cellspacing=0 cellpadding=1 width=600>");
printf("<tr>");
printf("<td align=center><font size=+2><b>報價單</b></font></td>");
printf("</tr>");
printf("</table>");

printf("<table border=0 cellpadding=0 cellspacing=0 width=600>");
printf("<tr>");
printf("<td colspan=7><hr size=1 noshade width=100%%></td>");
printf("</tr><tr>");
printf("<td align=center width=135 height=25><b>貨品</b></td>");
printf("<td align=right width=75><b>單價</b></td>");
printf("<td align=center width=180><b>&nbsp;</b></td>");
printf("<td align=center width=135 height=25><b>貨品</b></td>");
printf("<td align=right width=75><b>單價</b></td>");
printf("</tr><tr>");
printf("<td colspan=7><hr size=1 noshade width=100%%></td>");
printf("</tr>");
$query = "select product_name,quo_price from vol_product where status != '110' order by sort_order";
$result = mysql_query($query,$db);
$n = 1;
while ($myrow = mysql_fetch_array($result)) {
  if ((ceil($n/2) - floor($n/2)) > 0) {
    printf("<tr nowrap>");
    printf("<td>%s</td>",$myrow["product_name"]);
    printf("<td align=right>%7.2f</td>",$myrow["quo_price"]);
  }
  else {
    printf("<td>&nbsp;</td>");
    printf("<td>%s</td>",$myrow["product_name"]);
    printf("<td align=right>%7.2f</td>",$myrow["quo_price"]);
    printf("</tr>");
  }
  $n++;
}
printf("<tr>");
printf("<td colspan=7><hr size=1 noshade width=100%%></td>");
printf("</tr>");
printf("</table>");

printf("</body>");
printf("</html>");
mysql_close($db);

?>
