<?php

include("include/function.php");

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

  printf("<html><head>");
  printf("<title>月結單</title>");
  printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
  printf("</head><body bgcolor=#ffffff leftMargin=5 topMargin=0 bottomMargin=0 link=#000000 vlink=#000000>");

  printf("<table border=0 cellpadding=0 cellspacing=0 width=600><tr nowrap>");
  printf("<td height=10>&nbsp;</td>");
  printf("</tr></table>");
  printf("<table border=0 cellpadding=0 cellspacing=0 width=600><tr nowrap>");
  printf("<td align=center><font size=+2><b>泰 &nbsp;&nbsp;&nbsp;昌 &nbsp;&nbsp;&nbsp;肉 &nbsp;&nbsp;&nbsp;食 &nbsp;&nbsp;&nbsp;公 &nbsp;&nbsp;&nbsp;司</b></font></td>");
  printf("</tr><tr nowrap>");
  printf("<td align=center><font size=+2><b>TAI &nbsp;&nbsp;CHEONG &nbsp;&nbsp;MEAT &nbsp;&nbsp;CO.</b></font></td>");
  printf("</tr><tr nowrap>");
  printf("<td align=center><font>九龍深水�鶗梫巡�17,19號地下</font></td>");
  printf("</tr><tr nowrap>");
  printf("<td align=center><font>電話 : 2397-6100 &nbsp;&nbsp;傳真 : 2381-8817</font></td>");
  printf("</tr></table>");
  printf("<table border=0 cellpadding=0 cellspacing=0 width=600><tr nowrap>");
  printf("<td height=5>&nbsp;</td>");
  printf("</tr><tr nowrap>");
  printf("<td align=center width=600 height=20><font size=+1><b>月 &nbsp;&nbsp;結 &nbsp;&nbsp;單</b></font></td>");
  printf("</tr><tr nowrap>");
  printf("<td align=center height=5><hr size=1 noshade width=85></td>");
  printf("</tr></table>");
  printf("<table border=0 cellpadding=0 cellspacing=0 width=600><tr nowrap>");
  printf("<td align=left>&nbsp;</td>");
  $query = "select official_name,customer_no,address,tel from ntt_customer where customer_id='$custno'";
  $result = mysql_query($query,$db);
  $myrow = mysql_fetch_array($result);
  printf("<td align=left>%s &nbsp;(%s)</td>",$myrow["official_name"],$myrow["customer_no"]);
  printf("<td align=left>&nbsp;</td>");
  printf("<td align=left>&nbsp;</td>");
  printf("</tr><tr nowrap>");
  printf("<td align=left width=20>&nbsp;</td>");
  printf("<td align=left valign=top width=220 height=33><font size=-1>%s</font></td>",$myrow["address"]);
  printf("<td align=left width=260>&nbsp;</td>");
  printf("<td align=left width=100>&nbsp;</td>");
  printf("</tr><tr nowrap>");
  printf("<td align=left>&nbsp;</td>");
  printf("<td align=left>電話 : %s</td>",$myrow["tel"]);
  printf("<td align=right>日期 : </td>");
  $array1 = split("-", $date_to, 4);
  printf("<td align=right>%s</td>",date("Y-m-d",mktime(0,0,0,$array1[1],$array1[2]-1,$array1[0])));
  printf("</tr></table>");
  printf("<table border=0 cellpadding=0 cellspacing=0 width=600><tr nowrap>");
  printf("<td height=10>&nbsp;</td>");
  printf("</tr></table>");
  printf("<table border=0 cellpadding=0 cellspacing=0 width=600><tr nowrap>");
  printf("<td colspan=7 height=10><hr size=1 noshade width=100%%></td>");
  printf("</tr><tr nowrap>");
  printf("<td align=center height=15>日 &nbsp;&nbsp;期</td>");
  printf("<td align=center>&nbsp;</td>");
  printf("<td align=center>發貨單號碼</td>");
  printf("<td align=center>&nbsp;</td>");
  printf("<td align=right>金 &nbsp;&nbsp;額</td>");
  printf("</tr><tr nowrap>");
  printf("<td colspan=7 height=10><hr size=1 noshade width=100%%></td>");
  printf("</tr>");
  $total = 0;
  $query = "select so_date,t1.order_id,sum(round(weight*unit_price*10+0.000000001)/10) as amount from vol_order_head t1,vol_order_line t2 where (so_date >= '$date_fr' and so_date < '$date_to') and (customer_id='$custno' and status != '117' and t2.order_id=t1.order_id) group by order_id order by so_date,order_id";
  $result = mysql_query($query,$db);
  while ($myrow = mysql_fetch_array($result)) {
    $amount = $myrow["amount"];
    printf("<tr>");
    printf("<td align=center width=120>%s</td>",$myrow["so_date"]);
    printf("<td align=center width=100>&nbsp;</td>");
    printf("<td align=center width=160>%s</td>",$myrow["order_id"]);
    printf("<td align=center width=120>&nbsp;</td>");
    printf("<td align=right width=100>%s</td>",ins_comma($amount));
    printf("</tr>");
    $total += $amount;
  }
  printf("<tr>");
  printf("<td colspan=7 height=10><hr size=1 noshade width=100%%></td>");
  printf("</tr>");
  printf("<tr>");
  printf("<TD>&nbsp;</TD>");
  printf("<TD>&nbsp;</TD>");
  printf("<TD>&nbsp;</TD>");
  printf("<td align=right height=22>合 &nbsp;&nbsp;計 HK$</td>");
  printf("<td align=right>%s</td>",ins_comma($total));
  printf("</tr>");
  printf("<tr>");
  printf("<TD>&nbsp;</TD>");
  printf("<TD>&nbsp;</TD>");
  printf("<TD>&nbsp;</TD>");
  printf("<TD>&nbsp;</TD>");
  printf("<td valign=top align=right><hr size=2 noshade width=100%%></td>");
  printf("</tr>");
  printf("</TABLE>");
  printf("</BODY></HTML>");
  mysql_close($db);

?>
