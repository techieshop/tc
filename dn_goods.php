<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

printf("<html>");
printf("<head>");
$title = "代出";
printf("<title>%s</title>",$title);
printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
printf("<script language=JavaScript src=js/kh_form.js></script>");
printf("<script language=JavaScript src=js/windowManager.js></script>");
printf("<script language=JavaScript>");
printf("var Year = %s;",date("Y"));
printf("</script>");
include("include/main_dn.php");
switch ($psalert) {
case 1:
$msg = "alert('未填資料。');";
break;
} // switch ($psalert)
printf("</head><body bgcolor=#ffffff vlink=#0000ff onload=$msg;>");

printf("<form action=$PHP_SELF method=post>");
printf("<input type=hidden name=custno value=\"%s\">",$custno);
$query = "select customer_name from ntt_customer where customer_id='$custno'";
$result = mysql_query($query,$db);
$myrow = mysql_fetch_array($result);
printf("<table border=0 cellspacing=0 cellpadding=1 width=750>");
printf("<tr bgcolor=#eeeeee>");
printf("<td align=left width=600><font size=+1><b>%s</b></font></td>",$myrow["customer_name"]);
printf("<td align=right width=85><b>日期</b></td>");
printf("<td align=right width=65><input maxLength=10 name=dn_date onchange=checkDate(this); size=7 value=\"%s\"></td>",date("Y-m-d"));
printf("</tr></table>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=750><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
printf("<table border=0 cellpadding=0 cellspacing=0 width=750><tr nowrap>");
printf("<td align=left width=80><b>代出客戶</b></td>");
printf("<td align=left width=670><select name=cid size=1>");
/*
if (!$cid)	{
	$query = "select customer_id,customer_name from ntt_customer where status_id != '115' order by line_no,customer_id";
} else {
*/
	$q1="select customer_group_id from ntt_customer_group where customer_id = $custno";
	$gid=mysql_fetch_array(mysql_query($q1,$db));
	if ($gid[customer_group_id]=='')	{
		$query = "select customer_id,customer_name from ntt_customer where status_id != '115' order by customer_id";
	} else {
		$query = "select n.customer_id,customer_name from ntt_customer n, ntt_customer_group g where g.customer_id=n.customer_id and g.customer_group_id='{$gid[customer_group_id]}' and status_id != '115' order by line_no,customer_id";
	}
/*
}
*/
$result = mysql_query($query,$db);
while ($myrow = mysql_fetch_array($result)) {
  if (!$cid) {
    printf("<option value=%s>%s",$myrow["customer_id"],$myrow["customer_name"]);
  }
  else {
    if ($myrow["customer_id"] == $cid) {
      printf("<option selected value=%s>%s",$myrow["customer_id"],$myrow["customer_name"]);
    }
    else {
      printf("<option value=%s>%s",$myrow["customer_id"],$myrow["customer_name"]);
    }
  }
}
printf("</select></td>");
printf("</tr></table>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=750><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");

printf("<table border=0 cellspacing=1 cellpadding=0 width=750>");
printf("<tr bgcolor=#eeeeee valign=top>");
printf("<td align=center width=20 height=25>&nbsp;</td>");
printf("<td align=center width=125><b>貨品</b></td>");
printf("<td align=center width=80><b>尚餘件數</b></td>");
printf("<td align=center width=80><b>尚餘重量</b></td>");
printf("<td align=center width=50><b>件數</b></td>");
printf("<td align=center width=80><b>重量</b></td>");
printf("<td align=center width=80><b>留單件數</b></td>");
printf("<td align=center width=80><b>留單重量</b></td>");
printf("<td align=center width=80><b>留單日期</b></td>");
printf("<td align=center width=75><b>發貨單號</b></td>");
printf("</tr>");
$query = "select vol_order_line.*,so_date from vol_order_line,vol_order_head where (customer_id='$custno' and vol_order_line.status='102' and vol_order_line.reserve_status !='100' and vol_order_line.order_id=vol_order_head.order_id) order by order_line_id";
$result = mysql_query($query,$db);
$n = 1;
while ($myrow = mysql_fetch_array($result)) {
  $olid = $myrow["order_line_id"];
  $oid = $myrow["order_id"];
  $no = $myrow["product_id"];
  $so_date = $myrow["so_date"];
  $oqty = $myrow["qty"]-0;
  $owt = $myrow["weight"]-0;
  $query = "select product_name,product_unit_id from vol_product where product_id='$no'";
  $result1 = mysql_query($query,$db);
  $myrow = mysql_fetch_array($result1);
  $uni = $myrow["product_unit_id"];
  $pname = $myrow["product_name"];
  $query = "select sum(qty),sum(weight) from his_reserve_line where (order_line_id='$olid' and status != '117')";
  $result1 = mysql_query($query,$db);
  $myrow = mysql_fetch_array($result1);
  $bqty = $oqty - $myrow["sum(qty)"];
  $bwt = $owt - $myrow["sum(weight)"];
  $wt = 'wt'.$n;
  $wt = $$wt;
  $qty = 'qty'.$n;
  $qty = $$qty;
  printf("<tr nowrap>");
  printf("<input type=hidden name=olid$n value=\"%s\">",$olid);
  printf("<input type=hidden name=no$n value=\"%s\">",$no);
  printf("<input type=hidden name=bwt$n value=\"%s\">",$bwt);
  printf("<td align=left><input type=checkbox name=chbox$n value=yes></td>");
  printf("<td>%s</td>",$pname);
  printf("<td align=center>%s</td>",$bqty);
  printf("<td align=center>%s</td>",$bwt.$uni);
  printf("<td align=center><input maxLength=7 name=qty$n onchange=checkNum(this); size=5 value=\"%s\"></td>",$qty);
  printf("<td align=center><input maxLength=10 name=wt$n onchange=checkNum(this); size=8 value=\"%s\"></td>",$wt);
  printf("<td align=center>%s</td>",$oqty);
  printf("<td align=center>%s</td>",$owt.$uni);
  printf("<td align=center>%s</td>",$so_date);
  printf("<td align=center><a href=javascript:openSBWindow('mod_so.php?oid=%s','mod_so',440,480);>%s</a></td>",$oid,$oid);
  printf("</tr>");
  $n++;
}
printf("</table>");
printf("<input type=hidden name=numr value=\"%s\">",$n-1);
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=750><TR nowrap>");
printf("<TD align=left width=500>&nbsp;</TD>");
printf("</TR></TABLE>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=750><TR nowrap>");
printf("<TD align=left width=50><INPUT type=submit name=action value=廚></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=點></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=味></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=泰></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=火></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=粥></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=福></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=燒></TD>");
printf("<TD align=left width=50><INPUT type=submit name=action value=吧></TD>");
printf("<TD align=left width=230>&nbsp;</TD>");
printf("<TD align=right width=150><INPUT type=submit name=action value=取消餘下件數></TD>");
printf("<TD align=right width=70><INPUT type=button value=關閉 onclick=window.close();></TD>");
printf("</TR></TABLE>");

printf("</form>");
printf("</body>");
printf("</html>");
mysql_close($db);

?>
