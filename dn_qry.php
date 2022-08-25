<?php

if ($action == "確定") {
  $url1 = "date_fr=".$date_fr."&date_to=".$date_to;
  printf("<html><head>");
  printf("<title>代出單查詢</title>");
  printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
  printf("<script language=JavaScript src=js/windowManager.js></script>");
  printf("</head><body bgcolor=#eeeeee link=#000000 onload=openSBWindow('dn_lis.php?%s','dn_lis',540,350);window.close();>",$url1);
  printf("</BODY></HTML>");
}

printf("<html><head>");
printf("<title>代出單查詢</title>");
printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
printf("<script language=JavaScript src=js/kh_form.js></script>");
printf("<script language=JavaScript src=js/windowManager.js></script>");
printf("<script language=JavaScript>");
printf("var Year = %s;",date("Y"));
printf("</script>");
printf("</head><body bgcolor=#ffffff link=#000000>");

printf("<form action=$PHP_SELF method=post>");
printf("<table border=0 cellspacing=0 cellpadding=1 width=300>");
printf("<tr bgcolor=#70a4e9>");
printf("<td align=left height=25><font size=+1><b>代出單查詢</b></font></td>");
printf("</tr></table>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=300><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
printf("<table bgcolor=#e2ffff border=0 cellpadding=0 cellspacing=1 width=300><tr>");
printf("<th>&nbsp;</th>");
printf("<th colspan=4 align=left height=25><b>請輸入想要查詢代出單的日期</b></th>");
printf("</tr><tbody>");
printf("<tr><td>&nbsp;</td></tr>");
printf("<tr>");
printf("<td width=10%%>&nbsp;</td>");
printf("<td align=left width=10%%><b>由</b></td>");
printf("<td align=left width=25%%><input maxLength=10 name=date_fr onchange=checkDate(this); size=7 value=\"%s\"></td>",date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y"))));
printf("<td align=left width=10%%><b>至</b></td>");
printf("<td align=left width=45%%><input maxLength=10 name=date_to onchange=checkDate(this); size=7 value=\"%s\"></td>",date("Y-m-d"));
printf("<tr><td>&nbsp;</td></tr>");
printf("</tr></tbody></TABLE>");
printf("<TABLE border=0 cellpadding=2 cellspacing=0 width=300><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=300><TR nowrap><TD align=left width=25%%>&nbsp;");
printf("</TD><TD align=left width=20%%>");
printf("<INPUT type=submit name=action value=確定>");
printf("</TD><TD align=left width=20%%>");
printf("<INPUT type=reset value=取消>");
printf("</TD><TD align=left width=35%%>");
printf("<INPUT type=button value=關閉 onclick=window.close();>");
printf("</TD></TR></TABLE></FORM></BODY></HTML>");

?>
