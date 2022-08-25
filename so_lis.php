<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

if ($action == "列印") {
  $url1 = "oid1=".$oid1."&oid2=".$oid2;
  printf("<html><head>");
  printf("<title>發貨單列印</title>");
  printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
  printf("<script language=JavaScript src=js/windowManager.js></script>");
  printf("</head><body bgcolor=#eeeeee link=#000000 onload=openPrintWindow('so_print.php?%s','so_print',790,450);window.close();>",$url1);
  printf("</BODY></HTML>");
}

    printf("<html><head>");
    printf("<title>發貨單查詢</title>");
    printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
    printf("<script language=JavaScript src=js/kh_form.js></script>");
    printf("<script language=JavaScript src=js/windowManager.js></script>");
    printf("</head><body bgcolor=#ffffff>");

    printf("<form action=$PHP_SELF method=post>");
    printf("<table border=0 cellspacing=0 cellpadding=1 width=500>");
    printf("<tr bgcolor=#70a4e9>");
    printf("<td align=left height=25><font size=+1><b>發貨單查詢</b></font></td>");
    printf("</tr></table>");
    printf("<table border=0 cellpadding=0 cellspacing=0 width=500><tr nowrap><td>&nbsp;</td></tr></table>");

$array1 = split("-", $date_fr, 4);
$array2 = split("-", $date_to, 4);
if (checkdate($array1[1],$array1[2],$array1[0]) && checkdate($array2[1],$array2[2],$array2[0])) {
  $date_to = date("Y-m-d",mktime(0,0,0,$array2[1],$array2[2]+1,$array2[0]));

    printf("<table bgcolor=#e2ffff border=0 cellpadding=0 cellspacing=1 width=500><tr bgcolor=#99ccff>");
    printf("<th align=center width=25%% height=25><b>發貨單號碼</b></th>");
    printf("<th align=center width=30%%><b>客戶名稱</b></th>");
    printf("<th align=center width=25%%><b>日期</b></th>");
    printf("<th align=center width=20%%><b>情況</b></th>");
    printf("</tr><tbody>");

$query = "select order_id,so_date,customer_name from vol_order_head t1, ntt_customer t2 where (so_date >= '$date_fr' and so_date < '$date_to') and t1.customer_id=t2.customer_id";
if (ereg(".",trim($start_oid)))
  $query.=" and order_id>='$start_oid'";
if (ereg(".",trim($end_oid)))
  $query.=" and order_id<='$end_oid'";
$query.=" order by order_id";
$result = mysql_query($query,$db);
$i = 0;
while ($myrow = mysql_fetch_array($result)) {
    printf("<tr>");
    $oid = $myrow["order_id"];
    printf("<td align=center><a href=javascript:openSBWindow('mod_so.php?oid=%s','mod_so',440,480);>%s</a></td>",$oid,$oid);
    printf("<td align=center>%s</td>",$myrow["customer_name"]);
    printf("<td align=center>%s</td>",$myrow["so_date"]);
/*
    $query = "select order_id from vol_order_line where order_id='$oid' and status != '117'";
    $result1 = mysql_query($query,$db);
    $numrow = mysql_num_rows($result1);
    if ($numrow > 0) {
      printf("<td align=center>&nbsp;</td>");
    }
    else {
      printf("<td align=center>無效</td>");
    }
*/
    printf("</tr>");
    $i++;
    if ($i == 1) {
      $oid1 = $oid;
    }
}

    $oid2 = $oid;
    printf("</tbody></TABLE>");
}
else {
    printf("<TABLE border=0 cellpadding=2 cellspacing=0 width=500><TR nowrap><TD>日期不正確。</TD></TR></TABLE>");
}
    printf("<TABLE border=0 cellpadding=2 cellspacing=0 width=70><TR nowrap>");
    printf("<td align=left width=30><input maxLength=8 name=oid1 onchange=checkNum(this); size=5 value=\"%s\"></td>",$oid1);
    printf("<td align=center width=10><b>-</b></td>");
    printf("<td align=left width=30><input maxLength=8 name=oid2 onchange=checkNum(this); size=5 value=\"%s\"></td>",$oid2);
    printf("</TR></TABLE>");
    printf("<TABLE border=0 cellpadding=2 cellspacing=0 width=500><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
    printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=500><TR nowrap><TD align=left width=35%%>&nbsp;");
    printf("</TD><TD align=left width=20%%>");
    printf("<INPUT type=submit name=action value=列印>");
    printf("</TD><TD align=left width=45%%>");
    printf("<INPUT type=button value=關閉 onclick=window.close();>");
    printf("</TD></TR></TABLE></FORM></BODY></HTML>");
    mysql_close($db);

?>
