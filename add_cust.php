<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

if ($action == "確定") {
  $custno = addslashes(trim($custno));
  $ofcust = addslashes(trim($ofcust));
  $cust = addslashes(trim($cust));
  $addr = addslashes(trim($addr));
  $tel = addslashes(trim($tel));
  $fax = addslashes(trim($fax));
  $query = "select customer_id from ntt_customer where customer_no='$custno'";
  $result = mysql_query($query,$db);
  $numrow = mysql_num_rows($result);
  if ($numrow == 0) {
    if (!ereg(".",$lineno)) {
      $lineno = 80;
    }
    $query = "insert into ntt_customer (customer_id,customer_no,line_no,official_name,customer_name,address,tel,fax,status_id) values(null,'$custno','$lineno','$ofcust','$cust','$addr','$tel','$fax',114)";
    $result = mysql_query($query,$db);
    $custno = "";
    $lineno = "";
    $ofcust = "";
    $cust = "";
    $addr = "";
    $tel = "";
    $fax = "";
  }
  else {
    $psalert = 1;
  }
}

printf("<html><head>");
printf("<title>新加客戶</title>");
printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
printf("<script language=JavaScript src=js/kh_form.js></script>");
printf("<script language=JavaScript src=js/windowManager.js></script>");
switch ($psalert) {
case 1:
$msg = "alert('客戶編號已存在，沒有增加記錄。');";
break;
} // switch ($psalert)
printf("</head><body bgcolor=#eeeeee link=#000000 onload=$msg;>");

printf("<form action=$PHP_SELF method=post>");
printf("<table border=0 cellspacing=0 cellpadding=1 width=400>");
printf("<tr bgcolor=#70a4e9>");
printf("<td align=left height=25><font><b>新加客戶</b></font></td>");
printf("</tr></table>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=400><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
printf("<table border=0 cellpadding=0 cellspacing=0 width=400><tr>");
printf("<td width=14%%>&nbsp;</td>");
printf("<td align=left width=11%%><b>編號</b></td>");
printf("<td align=left width=25%%><font size=-1><input maxLength=10 name=custno size=7 value=\"%s\"></font></td>",$custno);
printf("<td align=right width=13%%><b>路��&nbsp;&nbsp;</b></td>");
printf("<td align=left width=37%%><font size=-1><input maxLength=5 name=lineno onchange=checkNum(this); size=3 value=\"%s\"></font></td>",$lineno);
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("<td align=left><b>客名</b></td>");
printf("<td align=left colspan=3><font size=-1><input maxLength=50 name=ofcust size=25 value=\"%s\"></font></td>",$ofcust);
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("<td align=left><b>簡稱</b></td>");
printf("<td align=left colspan=3><font size=-1><input maxLength=20 name=cust size=12 value=\"%s\"></font></td>",$cust);
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("<td align=left valign=top><b>地址</b></td>");
printf("<td align=left colspan=3><font size=-1><textarea name=addr rows=4 cols=30 wrap=physical>%s</textarea></font></td>",$addr);
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("<td align=left><b>電話</b></td>");
printf("<td align=left colspan=3><font size=-1><input maxLength=20 name=tel size=10 value=\"%s\"></font></td>",$tel);
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("<td align=left><b>傳真</b></td>");
printf("<td align=left colspan=3><font size=-1><input maxLength=20 name=fax size=10 value=\"%s\"></font></td>",$fax);
printf("</tr></TABLE>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=400><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=400><TR nowrap><TD align=left width=35%%>&nbsp;");
printf("</TD><TD align=left width=20%%>");
printf("<INPUT type=submit name=action value=確定>");
printf("</TD><TD align=left width=45%%>");
printf("<INPUT type=button value=關閉 onclick=openSBWindow('cust_lis.php','cust_lis',790,500);window.close();>");
printf("</TD></TR></TABLE></FORM></BODY></HTML>");
mysql_close($db);

?>
