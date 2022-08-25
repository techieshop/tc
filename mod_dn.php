<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

switch ($action) {
case "更新":
$rem = addslashes(trim($rem));
$query = "update his_reserve_head set dn_date='$dn_date',remark='$rem',customer_id='$cid' where reserve_id='$dnid'";
$result = mysql_query($query,$db);
for ($i = 1; $i <= $numr; $i++) {
  $olid = 'olid'.$i;
  $olid = $$olid;
  $qty = 'qty'.$i;
  $qty = $$qty;
  $wt = 'wt'.$i;
  $wt = $$wt;
  $chbox = 'chbox'.$i;
  $chbox = $$chbox;
  if ($chbox == "yes") {
    $query = "update his_reserve_line set qty='$qty',weight='$wt' where reserve_id='$dnid' and order_line_id='$olid'";
    $result = mysql_query($query,$db);
  }
}
break;
case "刪除":
for ($i = 1; $i <= $numr; $i++) {
  $olid = 'olid'.$i;
  $olid = $$olid;
  $chbox = 'chbox'.$i;
  $chbox = $$chbox;
  if ($chbox == "yes") {
    $query = "update his_reserve_line set status='117' where reserve_id='$dnid' and order_line_id='$olid'";
    $result = mysql_query($query,$db);
  }
}
break;
} // switch ($action)

  printf("<html><head>");
  printf("<title>代出單</title>");
  printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
  printf("<script language=JavaScript src=js/kh_form.js></script>");
  printf("<script language=JavaScript src=js/windowManager.js></script>");
  printf("</head><body bgcolor=#eeeeee link=#000000 vlink=#000000>");

  printf("<form action=$PHP_SELF method=post>");
  printf("<table border=0 cellspacing=0 cellpadding=1 width=400>");
  printf("<tr bgcolor=#70a4e9>");
  printf("<td align=left height=25><font size=+1><b>代出單</b></font></td>");
  printf("</tr></table>");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=400><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
  printf("<table border=0 cellpadding=0 cellspacing=0 width=400><tr nowrap>");
  printf("<td align=left width=20%%><b>客戶名稱</b></td>");
  $query = "select customer_id,dn_date,remark from his_reserve_head where reserve_id='$dnid'";
  $result = mysql_query($query,$db);
  $myrow = mysql_fetch_array($result);
  $cid = $myrow["customer_id"];
  $dn_date = $myrow["dn_date"];
  $rem = $myrow["remark"];
  printf("<td align=left width=55%%><select name=cid size=1>");
  $query = "select customer_id,customer_name from ntt_customer where status_id != '115' order by line_no,customer_id";
  $result = mysql_query($query,$db);
  while ($myrow = mysql_fetch_array($result)) {
    if ($myrow["customer_id"] == $cid) {
      printf("<option selected value=%s>%s",$myrow["customer_id"],$myrow["customer_name"]);
    }
    else {
      printf("<option value=%s>%s",$myrow["customer_id"],$myrow["customer_name"]);
    }
  }
  printf("</select></td>");
  printf("<td align=left width=10%%><b>日期</b></td>");
  printf("<td align=left width=15%%><input maxLength=10 name=dn_date onchange=checkDate(this); size=7 value=\"%s\"></td>",$dn_date);
  printf("</tr><tr nowrap>");
  printf("<td align=left><b>代出單號</b></td>");
  printf("<td align=left>%s</td>",$dnid);
  printf("<input type=hidden name=dnid value=\"%s\">",$dnid);
  printf("<td align=left>&nbsp;</td>");
  printf("<td align=left>");
  printf("<select name=rem size=1>");
  printf("<option selected value=%s>%s",$rem,$rem);
  printf("<option value=廚>廚");
  printf("<option value=點>點");
  printf("<option value=味>味");
  printf("<option value=泰>泰");
  printf("<option value=火>火");
  printf("<option value=粥>粥");
  printf("<option value=福>福");
  printf("<option value=聚>聚");
  printf("</select>");
  printf("</td>");
  printf("</tr></table>");
  printf("<table bgcolor=#e2ffff border=0 cellpadding=0 cellspacing=1 width=400>");
  printf("<tr bgcolor=#99ccff>");
  printf("<th align=center width=20 height=25>&nbsp;</th>");
  printf("<th align=center width=170><b>貨品</b></th>");
  printf("<th align=center width=50><b>件數</b></th>");
  printf("<th align=center width=80><b>重量</b></th>");
  printf("<th align=center width=80><b>單價</b></th>");
  printf("</tr><tbody>");
  $query = "select his_reserve_line.*,product_name from his_reserve_line,vol_product where reserve_id='$dnid' and his_reserve_line.status != '117' and vol_product.product_id=his_reserve_line.product_id";
  $result = mysql_query($query,$db);
  $i = 0;
  while ($myrow = mysql_fetch_array($result)) {
    $i++;
    $olid = $myrow["order_line_id"];
    $pname = $myrow["product_name"];
    $qty = $myrow["qty"]-0;
    $wt = $myrow["weight"]-0;
    $price = "";
    printf("<tr>");
    printf("<td align=left><input type=checkbox name=chbox$i value=yes></td>");
    printf("<input type=hidden name=olid$i value=\"%s\">",$olid);
    printf("<td align=left><b>%s</b></td>",$pname);
    if ($qty == 0) {
      $qty = "";
    }
    if ($wt == 0) {
      $wt = "";
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
  printf("<INPUT type=submit name=action value=更新>");
  printf("</TD><TD align=left width=20%%>");
  printf("<INPUT type=submit name=action value=刪除>");
  printf("</TD><TD align=left width=20%%>");
  printf("<INPUT type=button value=列印 onclick=openPrintWindow('dn_print.php?dnid=%s','dn_print',790,450);window.close();>",$dnid);
  printf("</TD><TD align=left width=25%%>");
  printf("<INPUT type=button value=關閉 onclick=window.close();>");
  printf("</TD></TR></TABLE></FORM></BODY></HTML>");
  mysql_close($db);

?>
