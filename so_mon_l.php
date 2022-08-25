<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

    printf("<html><head>");
    printf("<title>月結</title>");
    printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
    printf("<script language=JavaScript src=js/windowManager.js></script>");
    printf("</head><body bgcolor=#ffffff>");

    printf("<table border=0 cellspacing=0 cellpadding=1 width=300>");
    printf("<tr bgcolor=#70a4e9>");
    printf("<td align=left height=25><font size=+1><b>月結</b></font></td>");
    printf("</tr></table>");
    printf("<table border=0 cellpadding=2 cellspacing=0 width=300><tr nowrap><td>&nbsp;</td></tr></table>");

$array1 = split("-", $date_fr, 4);
$array2 = split("-", $date_to, 4);
if (checkdate($array1[1],$array1[2],$array1[0]) && checkdate($array2[1],$array2[2],$array2[0])) {
  $date_to = date("Y-m-d",mktime(0,0,0,$array2[1],$array2[2]+1,$array2[0]));

    printf("<table bgcolor=#e2ffff border=0 cellpadding=0 cellspacing=1 width=300><tr bgcolor=#99ccff>");
    printf("<th align=center width=40%% height=25><b>客戶編號</b></th>");
    printf("<th align=center width=60%%><b>客戶名稱</b></th>");
    printf("</tr><tbody>");

$query = "select vol_order_head.customer_id,customer_no,customer_name from vol_order_head,ntt_customer where (so_date >= '$date_fr' and so_date < '$date_to') and (ntt_customer.customer_id=vol_order_head.customer_id) group by vol_order_head.customer_id order by line_no,vol_order_head.customer_id";
$result = mysql_query($query,$db);
while ($myrow = mysql_fetch_array($result)) {
    printf("<tr>");
    printf("<td align=center>%s</td>",$myrow["customer_no"]);
    printf("<td align=left><a href=javascript:openPrintWindow('so_mon.php?custno=%s&date_fr=$date_fr&date_to=$date_to','so_mon',790,450);>%s</a></td>",$myrow["customer_id"],$myrow["customer_name"]);
    printf("</tr>");
}

    printf("</tbody></TABLE>");
}
else {
    printf("<TABLE border=0 cellpadding=2 cellspacing=0 width=300><TR nowrap><TD>日期不正確。</TD></TR></TABLE>");
}
    printf("<TABLE border=0 cellpadding=2 cellspacing=0 width=300><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
    printf("<TABLE border=0 cellpadding=2 cellspacing=0 width=300><TR nowrap><TD align=left width=45%%>&nbsp;");
    printf("</TD><TD align=left width=55%%>");
    printf("<INPUT type=button value=關閉 onclick=window.close();>");
    printf("</TD></TR></TABLE></BODY></HTML>");
    mysql_close($db);

?>
