<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

if ($action == "������") {
for ($i = 1; $i <= $numr; $i++) {
  $no = 'no'.$i;
  $no = $$no;
  $price = 'price'.$i;
  $price = $$price;
  if (ereg(".",$price)) {
    $query = "update vol_product set quo_price='$price' where product_id='$no'";
    $result = mysql_query($query,$db);
  }
} // for ($i = 1; $i <= $numr; $i++) {
$msg = "openPrintWindow('so_quo.php','so_quo',790,450);window.close();";
} // if ($action == "������")

printf("<html>");
printf("<head>");
$title = "�f�~";
printf("<title>%s</title>",$title);
printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
printf("<script language=JavaScript src=js/kh_form.js></script>");
printf("<script language=JavaScript src=js/windowManager.js></script>");
printf("<script language=JavaScript>");
printf("var Year = %s;",date("Y"));
printf("</script>");
include("include/main_gds.php");
switch ($psalert) {
case 1:
$msg = "alert('�����ơC');";
break;
} // switch ($psalert)
printf("</head><body bgcolor=#ffffff vlink=#0000ff onload=$msg;>");

printf("<form action=$PHP_SELF method=post>");
printf("<input type=hidden name=custno value=\"%s\">",$custno);
$query = "select customer_name from ntt_customer where customer_id='$custno'";
$result = mysql_query($query,$db);
$myrow = mysql_fetch_array($result);
printf("<table border=0 cellspacing=0 cellpadding=1 width=750>");
printf("<tr bgcolor=#99ffcc>");
printf("<td align=left width=600><font size=+1><b>%s</b></font></td>",$myrow["customer_name"]);
printf("<td align=right width=85><b>���</b></td>");
printf("<td align=right width=65><input maxLength=10 name=so_date onchange=checkDate(this); size=7 value=\"%s\"></td>",date("Y-m-d"));
printf("</tr>");
printf("</table>");

printf("<table border=0 cellpadding=0 cellspacing=0 width=750>");
printf("<tr>");
printf("<td align=center width=135 height=25><b>�f�~</b></td>");
printf("<td align=center width=50><b>���</b></td>");
printf("<td align=center width=80><b>���q</b></td>");
printf("<td align=center width=75><b>���</b></td>");
printf("<td align=center width=70><b>&nbsp;</b></td>");
printf("<td align=center width=135 height=25><b>�f�~</b></td>");
printf("<td align=center width=50><b>���</b></td>");
printf("<td align=center width=80><b>���q</b></td>");
printf("<td align=center width=75><b>���</b></td>");
printf("</tr>");
$query = "select product_id,product_name from vol_product where status != '110' order by sort_order";
$result = mysql_query($query,$db);
$n = 1;
while ($myrow = mysql_fetch_array($result)) {
  $no = $myrow["product_id"];
  printf("<input type=hidden name=no$n value=\"%s\">",$no);
  $wt = 'wt'.$n;
  $wt = $$wt;
  $qty = 'qty'.$n;
  $qty = $$qty;
  $price = 'price'.$n;
  $price = $$price;
  if ((ceil($n/2) - floor($n/2)) > 0) {
    printf("<tr nowrap>");
    printf("<td><b>%s</b></td>",$myrow["product_name"]);
    printf("<td align=center><input maxLength=7 name=qty$n onchange=checkNum(this); size=5 value=\"%s\"></td>",$qty);
    printf("<td align=center><input maxLength=10 name=wt$n onchange=checkNum(this); size=8 value=\"%s\"></td>",$wt);
    printf("<td align=center><input maxLength=10 name=price$n onchange=checkNum(this); size=8 value=\"%s\"></td>",$price);
  }
  else {
    printf("<td><b>&nbsp;</b></td>");
    printf("<td><b>%s</b></td>",$myrow["product_name"]);
    printf("<td align=center><input maxLength=7 name=qty$n onchange=checkNum(this); size=5 value=\"%s\"></td>",$qty);
    printf("<td align=center><input maxLength=10 name=wt$n onchange=checkNum(this); size=8 value=\"%s\"></td>",$wt);
    printf("<td align=center><input maxLength=10 name=price$n onchange=checkNum(this); size=8 value=\"%s\"></td>",$price);
    printf("</tr>");
  }
  $n++;
}
printf("</table>");

printf("<input type=hidden name=numr value=\"%s\">",$n-1);
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=750><TR nowrap>");
printf("<TD align=left width=500>&nbsp;</TD>");
printf("</TR></TABLE>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=750><TR nowrap>");
printf("<TD align=left width=50><INPUT type=submit name=action value=�p></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=�I></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=��></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=��></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=��></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=��></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=��></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=�N></TD>");
printf("<TD align=left width=250>&nbsp;</TD>");
printf("<TD align=right width=80><INPUT type=submit name=action value=������></TD>");
printf("<TD align=right width=70><INPUT type=button value=���� onclick=window.close();></TD>");
printf("</TR></TABLE>");

printf("</form>");
printf("</body>");
printf("</html>");
mysql_close($db);

?>
