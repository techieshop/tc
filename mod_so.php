<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

switch ($action) {
case "��s":
$rem = addslashes(trim($rem));
$query = "update vol_order_head set so_date='$so_date',remark='$rem' where order_id='$oid'";
$result = mysql_query($query,$db);
$query = "update his_invoice_head set iv_date='$so_date',remark='$rem' where invoice_id='$oid'";
$result = mysql_query($query,$db);
if ($rem == "�N") {
  $query = "update vol_order_line set status='102' where order_id='$oid' and status != '117'";
  $result = mysql_query($query,$db);
  $query = "update his_invoice_line set status='102' where invoice_id='$oid' and status != '117'";
}
else {
  $query = "update vol_order_line set status='0' where order_id='$oid' and status != '117'";
  $result = mysql_query($query,$db);
  $query = "update his_invoice_line set status='100' where invoice_id='$oid' and status != '117'";
}
$result = mysql_query($query,$db);
for ($i = 1; $i <= $numr; $i++) {
  $olid = 'olid'.$i;
  $olid = $$olid;
  $qty = 'qty'.$i;
  $qty = $$qty;
  $wt = 'wt'.$i;
  $wt = $$wt;
  $price = 'price'.$i;
  $price = $$price;
  $chbox = 'chbox'.$i;
  $chbox = $$chbox;
  if ($chbox == "yes") {
    $query = "update vol_order_line set qty='$qty',weight='$wt',unit_price='$price' where order_line_id='$olid'";
    $result = mysql_query($query,$db);
    $query = "update his_invoice_line set qty='$qty',weight='$wt',unit_price='$price' where order_line_id='$olid' and invoice_id='$oid' and status != '117'";
    $result = mysql_query($query,$db);
  }
}
break;
case "�R��":
for ($i = 1; $i <= $numr; $i++) {
  $olid = 'olid'.$i;
  $olid = $$olid;
  $chbox = 'chbox'.$i;
  $chbox = $$chbox;
  if ($chbox == "yes") {
    $query = "update vol_order_line set status='117' where order_line_id='$olid'";
    $result = mysql_query($query,$db);
    $query = "update his_invoice_line set status='117' where order_line_id='$olid' and invoice_id='$oid'";
    $result = mysql_query($query,$db);
  }
}
break;
} // switch ($action)

  printf("<html><head>");
  printf("<title>�o�f��</title>");
  printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
  printf("<script language=JavaScript src=js/kh_form.js></script>");
  printf("<script language=JavaScript src=js/windowManager.js></script>");
  printf("</head><body bgcolor=#eeeeee link=#000000 vlink=#000000>");

  printf("<form action=$PHP_SELF method=post>");
  printf("<table border=0 cellspacing=0 cellpadding=1 width=400>");
  printf("<tr bgcolor=#70a4e9>");
  printf("<td align=left height=25><font size=+1><b>�o�f��</b></font></td>");
  printf("</tr></table>");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=400><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
  printf("<table border=0 cellpadding=0 cellspacing=0 width=400><tr nowrap>");
  printf("<td align=left width=20%%><b>�Ȥ�W��</b></td>");
  $query = "select customer_name,so_date,remark from vol_order_head,ntt_customer where order_id='$oid' and ntt_customer.customer_id=vol_order_head.customer_id";
  $result = mysql_query($query,$db);
  $myrow = mysql_fetch_array($result);
  printf("<td align=left width=55%%>%s</td>",$myrow["customer_name"]);
  printf("<td align=left width=10%%><b>���</b></td>");
  printf("<td align=left width=15%%><input maxLength=10 name=so_date onchange=checkDate(this); size=7 value=\"%s\"></td>",$myrow["so_date"]);
  printf("</tr><tr nowrap>");
  printf("<td align=left><b>�o�f�渹</b></td>");
  printf("<td align=left>%s</td>",$oid);
  printf("<input type=hidden name=oid value=\"%s\">",$oid);
  printf("<td align=left>&nbsp;</td>");
  printf("<td align=left>");
  printf("<select name=rem size=1>");
  printf("<option selected value=%s>%s",$myrow["remark"],$myrow["remark"]);
  printf("<option value=�p>�p");
  printf("<option value=�I>�I");
  printf("<option value=��>��");
  printf("<option value=��>��");
  printf("<option value=��>��");
  printf("<option value=��>��");
  printf("<option value=��>��");
  printf("<option value=�N>�N");
  printf("<option value=�E>�E");
  printf("</select>");
  printf("</td>");
  printf("</tr></table>");
  printf("<table bgcolor=#e2ffff border=0 cellpadding=0 cellspacing=1 width=400>");
  printf("<tr bgcolor=#99ccff>");
  printf("<th align=center width=20 height=25>&nbsp;</th>");
  printf("<th align=center width=170><b>�f�~</b></th>");
  printf("<th align=center width=50><b>���</b></th>");
  printf("<th align=center width=80><b>���q</b></th>");
  printf("<th align=center width=80><b>���</b></th>");
  printf("</tr><tbody>");
  $query = "select vol_order_line.*,product_name from vol_order_line,vol_product where order_id='$oid' and vol_order_line.status != '117' and vol_product.product_id=vol_order_line.product_id";

  $result = mysql_query($query,$db);
  $i = 0;
  while ($myrow = mysql_fetch_array($result)) {
    $i++;
    $olid = $myrow["order_line_id"];
    $pname = $myrow["product_name"];
    $qty = $myrow["qty"]-0;
    $wt = $myrow["weight"]-0;
    $price = $myrow["unit_price"]-0;
    printf("<tr>");
    printf("<td align=left><input type=checkbox name=chbox$i value=yes></td>");
    printf("<input type=hidden name=olid$i value=\"%s\">",$olid);
    printf("<td align=left><b>%s</b></td>",$pname);
    if ($qty == 0) {
      $qty = "";
    }
    printf("<td align=center><input maxLength=7 name=qty$i onchange=checkNum(this); size=5 value=\"%s\"></td>",$qty);
    printf("<td align=center><input maxLength=10 name=wt$i onchange=checkNum(this); size=8 value=\"%s\"></td>",$wt);
    printf("<td align=center><input maxLength=10 name=price$i onchange=checkNum(this); size=8 value=\"%s\"></td>",$price);
    printf("</tr>");
  }
  printf("<input type=hidden name=numr value=\"%s\">",$i);
  printf("</tbody></TABLE>");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=400><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=400><TR nowrap><TD align=left width=15%%>&nbsp;");
  printf("</TD><TD align=left width=20%%>");
  printf("<INPUT type=submit name=action value=��s>");
  printf("</TD><TD align=left width=20%%>");
  printf("<INPUT type=submit name=action value=�R��>");
  printf("</TD><TD align=left width=20%%>");
  printf("<INPUT type=button value=�C�L onclick=openPrintWindow('so_print.php?oid=%s','so_print',790,450);window.close();>",$oid);
  printf("</TD><TD align=left width=25%%>");
  printf("<INPUT type=button value=���� onclick=window.close();>");
  printf("</TD></TR></TABLE></FORM></BODY></HTML>");
  mysql_close($db);

?>
