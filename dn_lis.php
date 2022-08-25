<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

if ($action == "列印") {
  $url1 = "dnid1=".$dnid1."&dnid2=".$dnid2;
  printf("<html><head>");
  printf("<title>代出單列印</title>");
  printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
  printf("<script language=JavaScript src=js/windowManager.js></script>");
  printf("</head><body bgcolor=#eeeeee link=#000000 onload=openPrintWindow('dn_print.php?%s','dn_print',790,450);window.close();>",$url1);
  printf("</BODY></HTML>");
}

    printf("<html><head>");
    printf("<title>代出單查詢</title>");
    printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
    printf("<script language=JavaScript src=js/kh_form.js></script>");
    printf("<script language=JavaScript src=js/windowManager.js></script>");
    printf("</head><body bgcolor=#ffffff>");

    printf("<form action=$PHP_SELF method=post>");
    printf("<table border=0 cellspacing=0 cellpadding=1 width=500>");
    printf("<tr bgcolor=#70a4e9>");
    printf("<td align=left height=25><font size=+1><b>代出單查詢</b></font></td>");
    printf("</tr></table>");
    printf("<table border=0 cellpadding=0 cellspacing=0 width=500><tr nowrap><td>&nbsp;</td></tr></table>");

$array1 = split("-", $date_fr, 4);
$array2 = split("-", $date_to, 4);
if (checkdate($array1[1],$array1[2],$array1[0]) && checkdate($array2[1],$array2[2],$array2[0])) {
  $date_to = date("Y-m-d",mktime(0,0,0,$array2[1],$array2[2]+1,$array2[0]));

    printf("<table bgcolor=#e2ffff border=0 cellpadding=0 cellspacing=1 width=500><tr bgcolor=#99ccff>");
    printf("<th align=center width=25%% height=25><b>代出單號碼</b></th>");
    printf("<th align=center width=30%%><b>客戶名稱</b></th>");
    printf("<th align=center width=25%%><b>日期</b></th>");
    printf("<th align=center width=20%%><b>情況</b></th>");
    printf("</tr><tbody>");

$query = "select reserve_id,dn_date from his_reserve_head where (dn_date >= '$date_fr' and dn_date < '$date_to') order by reserve_id";
$result = mysql_query($query,$db);
$i = 0;
while ($myrow = mysql_fetch_array($result)) {
    printf("<tr>");
    $dnid = $myrow["reserve_id"];
    $dn_date = $myrow["dn_date"];
    printf("<td align=center><a href=javascript:openSBWindow('mod_dn.php?dnid=%s','mod_dn',440,480);>%s</a></td>",$dnid,$dnid);
    $query = "select customer_name from his_reserve_head,ntt_customer where reserve_id='$dnid' and ntt_customer.customer_id=his_reserve_head.customer_id";
    $result1 = mysql_query($query,$db);
    $myrow = mysql_fetch_array($result1);
    printf("<td align=center>%s</td>",$myrow["customer_name"]);
    printf("<td align=center>%s</td>",$dn_date);
    $query = "select reserve_id from his_reserve_line where reserve_id='$dnid' and status != '117'";
    $result1 = mysql_query($query,$db);
    $numrow = mysql_num_rows($result1);
    if ($numrow > 0) {
      printf("<td align=center>&nbsp;</td>");
    }
    else {
      printf("<td align=center>無效</td>");
    }
    printf("</tr>");
    $i++;
    if ($i == 1) {
      $dnid1 = $dnid;
    }
}

    $dnid2 = $dnid;
    printf("</tbody></TABLE>");
}
else {
    printf("<TABLE border=0 cellpadding=2 cellspacing=0 width=500><TR nowrap><TD>日期不正確。</TD></TR></TABLE>");
}
    printf("<TABLE border=0 cellpadding=2 cellspacing=0 width=70><TR nowrap>");
    printf("<td align=left width=30><input maxLength=8 name=dnid1 onchange=checkNum(this); size=5 value=\"%s\"></td>",$dnid1);
    printf("<td align=center width=10><b>-</b></td>");
    printf("<td align=left width=30><input maxLength=8 name=dnid2 onchange=checkNum(this); size=5 value=\"%s\"></td>",$dnid2);
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
