<?php

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

switch ($action) {
case "更新":
for ($i = 1; $i <= $numr; $i++) {
  $no = 'no'.$i;
  $no = $$no;
  $pname = 'pname'.$i;
  $pname = $$pname;
  $sorder = 'sorder'.$i;
  $sorder = $$sorder;
  $uni = 'uni'.$i;
  $uni = $$uni;
  $sta = 'sta'.$i;
  $sta = $$sta;
  $chbox = 'chbox'.$i;
  $chbox = $$chbox;
  if ($chbox == "yes") {
    $pname = addslashes(trim($pname));
    $query = "update vol_product set product_name='$pname',sort_order='$sorder',product_unit_id='$uni',status='$sta' where product_id='$no'";
    $result = mysql_query($query,$db);
  }
}
break;
} // switch ($action)

  printf("<html><head>");
  printf("<title>貨品</title>");
  printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
  printf("<script language=JavaScript src=js/windowManager.js></script>");
  printf("</head><body bgcolor=#eeeeee link=#000000 vlink=#000000>");

  printf("<form action=$PHP_SELF method=post>");
  printf("<table border=0 cellspacing=0 cellpadding=1 width=500>");
  printf("<tr bgcolor=#70a4e9>");
  printf("<td align=left height=25><font><b>貨品</b></font></td>");
  printf("</tr></table>");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=500><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
  printf("<table border=0 cellpadding=0 cellspacing=0 width=500><tr nowrap>");
  $query = "select product_id from vol_product order by sort_order,product_id";
  $result = mysql_query($query,$db);
  $numrows = mysql_num_rows($result);
  if (!isset($b)) {
    $b = 1;
  }
  $b1 = $b - 1;
  $maxrow = 10;
  printf("<td align=left width=450><font size=-1><b>現有貨品%s種，顯示第%s頁，%s至%s項</b></font></td>",$numrows,ceil($b1/$maxrow)+1,min($b-0,$numrows),min($b+$maxrow-1,$numrows));
  printf("<td align=right width=20><INPUT type=submit name=action value=去></td>");
  printf("<td align=left width=90>第<input maxLength=5 name=b size=3 value=\"%s\">行</td>",$b);
  printf("</tr></table>");
  printf("<table border=1 cellpadding=1 cellspacing=1 width=500><tr bgcolor=#99ccff>");
  printf("<th align=center width=20 height=25>&nbsp;</th>");
  printf("<th align=center width=50 height=25><font size=-1><b>貨號</b></font></th>");
  printf("<th align=center width=230><font size=-1><b>貨品</b></font></th>");
  printf("<th align=center width=50><font size=-1><b>次序</b></font></th>");
  printf("<th align=center width=70><font size=-1><b>單位</b></font></th>");
  printf("<th align=center width=80><font size=-1><b>情況</b></font></th>");
  printf("</tr><tbody>");
  $query = "select * from vol_product order by sort_order,product_id limit $b1,$maxrow";
  $result = mysql_query($query,$db);
  $i = 0;
  while ($myrow = mysql_fetch_array($result)) {
    $i++;
    $no = $myrow["product_id"];
    $pname = $myrow["product_name"];
    $sorder = $myrow["sort_order"];
    $uni = $myrow["product_unit_id"];
    $sta = $myrow["status"];
    printf("<tr>");
    printf("<td align=left><input type=checkbox name=chbox$i value=yes></td>");
    printf("<td align=left><font>%s</font></td>",$no);
    printf("<input type=hidden name=no$i value=\"%s\">",$no);
    printf("<td align=center><font size=-1><input maxLength=50 name=pname$i size=30 value=\"%s\"></font></td>",$pname);
    printf("<td align=center><font size=-1><input maxLength=7 name=sorder$i size=5 value=\"%s\"></font></td>",$sorder);
    printf("<td align=center><font size=-1><select name=uni$i size=1>");

    $query = "select * from ref_product_unit";
    $result1 = mysql_query($query,$db);
    while ($myrow = mysql_fetch_array($result1)) {

    if (!$uni) {
      printf("<option value=%s>%s",$myrow["product_unit_id"],$myrow["product_unit_name"]);
    }
    else {
      if ($myrow["product_unit_id"] == $uni) {
        printf("<option selected value=%s>%s",$myrow["product_unit_id"],$myrow["product_unit_name"]);
      }
      else {
        printf("<option value=%s>%s",$myrow["product_unit_id"],$myrow["product_unit_name"]);
      }
    }

    }

    printf("</select></font></td>");
    printf("<td align=center><font size=-1><select name=sta$i size=1>");

    $query = "select * from ref_status where status_type='product'";
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
  $url1 = "gds_lis.php?b=";
  $numrow = $numrows;
  $npcolor = "#eeeeee";
  $npwidth = 20;
  include("include/next_p.php");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=500><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=500><TR nowrap><TD align=left width=32%%>&nbsp;");
  printf("</TD><TD align=left width=15%%>");
  printf("<INPUT type=button value=新加 onclick=openSBWindow('add_gds.php','add_gds',340,240);>");
  printf("</TD><TD align=left width=15%%>");
  printf("<INPUT type=submit name=action value=更新>");
  printf("</TD><TD align=left width=38%%>");
  printf("<INPUT type=button value=關閉 onclick=window.close();>");
  printf("</TD></TR></TABLE></FORM></BODY></HTML>");
  mysql_close($db);

?>
