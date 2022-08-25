<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

switch ($action) {
case "§ó·s":
for ($i = 1; $i <= $numr; $i++) {
  $cid = 'cid'.$i;
  $cid = $$cid;
  $custno = 'custno'.$i;
  $custno = $$custno;
  $ofcust = 'ofcust'.$i;
  $ofcust = $$ofcust;
  $cust = 'cust'.$i;
  $cust = $$cust;
  $lineno = 'lineno'.$i;
  $lineno = $$lineno;
  $addr = 'addr'.$i;
  $addr = $$addr;
  $tel = 'tel'.$i;
  $tel = $$tel;
  $fax = 'fax'.$i;
  $fax = $$fax;
  $sta = 'sta'.$i;
  $sta = $$sta;
  $chbox = 'chbox'.$i;
  $chbox = $$chbox;
  if ($chbox == "yes") {
    $custno = addslashes(trim($custno));
    $ofcust = addslashes(trim($ofcust));
    $cust = addslashes(trim($cust));
    $addr = addslashes(trim($addr));
    $tel = addslashes(trim($tel));
    $fax = addslashes(trim($fax));
    $query = "select customer_id from ntt_customer where customer_no='$custno' and customer_id != '$cid'";
    $result = mysql_query($query,$db);
    $numrow = mysql_num_rows($result);
    if ($numrow == 0) {
      if (!ereg(".",$lineno)) {
        $lineno = 80;
      }
      $query = "update ntt_customer set customer_no='$custno',customer_name='$cust',official_name='$ofcust',line_no='$lineno',address='$addr',tel='$tel',fax='$fax',status_id='$sta' where customer_id='$cid'";
      $result = mysql_query($query,$db);
    }
    else {
      $psalert = 1;
    }
  }
}
break;
} // switch ($action)

  printf("<html><head>");
  printf("<title>«È¤á</title>");
  printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
  printf("<script language=JavaScript src=js/kh_form.js></script>");
  printf("<script language=JavaScript src=js/windowManager.js></script>");
  switch ($psalert) {
  case 1:
  $msg = "alert('¦³¨Ç¶µ¥Øªº«È¤á½s¸¹¸ò¨ä¥L«È¤áªº½s¸¹¬Û¦P¡C');";
  break;
  } // switch ($psalert)
  printf("</head><body bgcolor=#eeeeee link=#000000 vlink=#000000 onload=$msg;>");

  printf("<form action=$PHP_SELF method=post>");
  printf("<table border=0 cellspacing=0 cellpadding=1 width=760>");
  printf("<tr bgcolor=#70a4e9>");
  printf("<td align=left height=25><font><b>«È¤á</b></font></td>");
  printf("</tr></table>");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=760><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
  printf("<table border=0 cellpadding=0 cellspacing=0 width=760><tr nowrap>");
  $query = "select customer_id from ntt_customer order by line_no,customer_id";
  $result = mysql_query($query,$db);
  $numrows = mysql_num_rows($result);
  if (!isset($b)) {
    $b = 1;
  }
  $b1 = $b - 1;
  $maxrow = 10;
  printf("<td align=left width=450><font size=-1><b>²{¦³«È¤á%s­Ó¡AÅã¥Ü²Ä%s­¶¡A%s¦Ü%s¶µ</b></font></td>",$numrows,ceil($b1/$maxrow)+1,min($b-0,$numrows),min($b+$maxrow-1,$numrows));
  printf("<td align=right width=20><INPUT type=submit name=action value=¥h></td>");
  printf("<td align=left width=90>²Ä<input maxLength=5 name=b size=3 value=\"%s\">¦æ</td>",$b);
  printf("</tr></table>");
  printf("<table border=1 cellpadding=1 cellspacing=1 width=760><tr bgcolor=#99ccff>");
  printf("<th align=center width=10 height=25>&nbsp;</th>");
  printf("<th align=center width=50 height=25><font size=-1><b>½s¸¹</b></font></th>");
  printf("<th align=center width=170><font size=-1><b>«È¤á¦WºÙ</b></font></th>");
  printf("<th align=center width=100><font size=-1><b>Â²ºÙ</b></font></th>");
  printf("<th align=center width=40><font size=-1><b>¸ôŽ¨</b></font></th>");
  printf("<th align=center width=220><font size=-1><b>¦a§}</b></font></th>");
  printf("<th align=center width=60><font size=-1><b>¹q¸Ü</b></font></th>");
  printf("<th align=center width=60><font size=-1><b>¶Ç¯u</b></font></th>");
  printf("<th align=center width=50><font size=-1><b>ª¬ªp</b></font></th>");
  printf("</tr><tbody>");
  $query = "select * from ntt_customer order by line_no,customer_id limit $b1,$maxrow";
  $result = mysql_query($query,$db);
  $i = 0;
  while ($myrow = mysql_fetch_array($result)) {
    $i++;
    $cid = $myrow["customer_id"];
    $custno = $myrow["customer_no"];
    $ofcust = $myrow["official_name"];
    $cust = $myrow["customer_name"];
    $lineno = $myrow["line_no"];
    $addr = $myrow["address"];
    $tel = $myrow["tel"];
    $fax = $myrow["fax"];
    $sta = $myrow["status_id"];
    printf("<tr>");
    printf("<td align=left><input type=checkbox name=chbox$i value=yes></td>");
    printf("<input type=hidden name=cid$i value=\"%s\">",$cid);
    printf("<td align=left><font size=-1><input maxLength=10 name=custno$i size=6 value=\"%s\"></font></td>",$custno);
    printf("<td align=left><font size=-1><input maxLength=50 name=ofcust$i size=19 value=\"%s\"></font></td>",$ofcust);
    printf("<td align=left><font size=-1><input maxLength=20 name=cust$i size=10 value=\"%s\"></font></td>",$cust);
    printf("<td align=left><font size=-1><input maxLength=5 name=lineno$i onchange=checkNum(this); size=3 value=\"%s\"></font></td>",$lineno);
    printf("<td align=left><font size=-1><input maxLength=80 name=addr$i size=27 value=\"%s\"></font></td>",$addr);
    printf("<td align=left><font size=-1><input maxLength=20 name=tel$i size=7 value=\"%s\"></font></td>",$tel);
    printf("<td align=left><font size=-1><input maxLength=20 name=fax$i size=7 value=\"%s\"></font></td>",$fax);
    printf("<td align=center><font size=-1><select name=sta$i size=1>");

    $query = "select * from ref_status where status_type='customer'";
    $result1 = mysql_query($query,$db);
    while ($myrow = mysql_fetch_array($result1)) {

    if (!$sta) {
      printf("<option value=%s>%s",$myrow["status_id"],$myrow["status_description"]);
    }
    else {
      if ($myrow["status_id"] == $sta) {
        printf("<option selected value=%s>%s",$myrow["status_id"],$myrow["status_description"]);
      }
      else {
        printf("<option value=%s>%s",$myrow["status_id"],$myrow["status_description"]);
      }
    }

    }

    printf("</select></font></td>");
    printf("</tr>");
  }
  printf("<input type=hidden name=numr value=\"%s\">",$i);
  printf("</tbody></TABLE>");
  $url1 = "cust_lis.php?b=";
  $numrow = $numrows;
  $npcolor = "#eeeeee";
  $npwidth = 10;
  include("include/next_p.php");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=760><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=760><TR nowrap><TD align=left width=32%%>&nbsp;");
  printf("</TD><TD align=left width=15%%>");
  printf("<INPUT type=button value=·s¥[ onclick=openSBWindow('add_cust.php','add_cust',440,400);>");
  printf("</TD><TD align=left width=15%%>");
  printf("<INPUT type=submit name=action value=§ó·s>");
  printf("</TD><TD align=left width=38%%>");
  printf("<INPUT type=button value=Ãö³¬ onclick=window.close();>");
  printf("</TD></TR></TABLE></FORM></BODY></HTML>");
  mysql_close($db);

?>
