<?php

if ($action == "�T�w") {
  $url1 = "date_fr=".$date_fr."&date_to=".$date_to."&start_oid=".$start_oid."&end_oid=".$end_oid;
  printf("<html><head>");
  printf("<title>�o�f��d��</title>");
  printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
  printf("<script language=JavaScript src=js/windowManager.js></script>");
  printf("</head><body bgcolor=#eeeeee link=#000000 onload=openSBWindow('so_lis.php?%s','so_lis',540,350);window.close();>",$url1);
  printf("</BODY></HTML>");
}

printf("<html><head>");
printf("<title>�o�f��d��</title>");
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
printf("<td align=left height=25><font size=+1><b>�o�f��d��</b></font></td>");
printf("</tr></table>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=300><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
printf("<table bgcolor=#e2ffff border=0 cellpadding=0 cellspacing=4 width=300><tr>");
printf("<th colspan=5 align=left><b>�п�J�Q�n�d�ߵo�f�檺����M���X</b><br>&nbsp;</th>");
printf("</tr><tbody>");
printf("<tr>");
printf("<td width=22%%><b>����G</b></td>");
printf("<td align=left width=23%%><input maxLength=10 name=date_fr onchange=\"return checkDate(this);\" size=7 value=\"%s\"></td>",date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y"))));
printf("<td align=left width=8%%>��</td>");
printf("<td align=left width=47%%><input maxLength=10 name=date_to onchange=\"return checkDate(this);\" size=7 value=\"%s\"></td>",date("Y-m-d"));
printf("</tr>");
printf("<tr>");
printf("<td><b>���X�G</b></td>");
printf("<td align=left><input maxLength=10 name=start_oid size=7 value=\"%s\"></td>",$start_oid);
printf("<td align=left>��</td>");
printf("<td align=left><input maxLength=10 name=end_oid size=7 value=\"%s\"></td>",$end_oid);
printf("</tr>");
printf("</tbody></TABLE>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=300><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=300><TR nowrap><TD align=left width=25%%>&nbsp;");
printf("</TD><TD align=left width=20%%>");
printf("<INPUT type=submit name=action value=�T�w>");
printf("</TD><TD align=left width=20%%>");
printf("<INPUT type=reset value=����>");
printf("</TD><TD align=left width=35%%>");
printf("<INPUT type=button value=���� onclick=window.close();>");
printf("</TD></TR></TABLE></FORM></BODY></HTML>");

?>
