<?php
if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}
session_start();
if($_SESSION['UserName']) {$price_change=true;} 
else $price_change=false;
//if(authGetUserLevel(getUserName())==2) $price_change=true;
printf("<html>");
printf("<head>");
$title = "貨品";
printf("<title>%s</title>",$title);
printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
printf("<script language=JavaScript src=js/kh_form.js></script>");
printf("<script language=JavaScript src=js/windowManager.js></script>");
printf("<script language=JavaScript>");
printf("var Year = %s;",date("Y"));
printf("function winReset(form)");
printf("{");
printf("parent.location.href='so_goods.php?custno='+form.custno.value+'&rem='+form.rem.value;");
printf("}");
printf("</script>");
include("include/main_gds.php");
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
printf("<tr bgcolor=#99ffcc>");
printf("<td align=left width=350><font size=+1><b>%s</b></font></td>",$myrow["customer_name"]);
if (!$rem) {
  $rem = "廚";
}
printf("<td align=left width=250>");
printf("<select name=rem onchange=winReset(this.form); size=1>");
printf("<option selected value=%s>%s",$rem,$rem);
if ($rem != "廚") 
printf("<option value=廚>廚");
if ($rem != "點") 
printf("<option value=點>點");
if ($rem != "味") 
printf("<option value=味>味");
if ($rem != "泰") 
printf("<option value=泰>泰");
if ($rem != "火") 
printf("<option value=火>火");
if ($rem != "粥") 
printf("<option value=粥>粥");
if ($rem != "福") 
printf("<option value=福>福");
if ($rem != "代") 
printf("<option value=代>代");
printf("</select>");
printf("</td>");
printf("<td align=right width=85><b>日期</b></td>");
printf("<td align=right width=65><input maxLength=10 name='so_date' onchange=checkDate(this); size=7 value=\"%s\"></td>",date("Y-m-d"));
printf("</tr>");
printf("</table>");

printf("<table border=0 cellspacing=0 cellpadding=0 width=750>");
printf("<tr valign=top>");

$date_fr = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-14,date("Y")));
$date_to = date("Y-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y")));
$query = "select distinct run_order_line.product_id from vol_product,run_order_head,run_order_line where (so_date >= '$date_fr' and so_date <= '$date_to') and (customer_id='$custno' and remark='$rem' and run_order_line.status != '117' and run_order_head.order_id=run_order_line.order_id and vol_product.product_id=run_order_line.product_id) group by product_id order by sort_order";
$result = mysql_query($query,$db);
$numrow = mysql_num_rows($result);
$maxrow = ceil($numrow / 2);
$b = 0;

printf("<td width=415>");

printf("<table border=0 cellpadding=0 cellspacing=0 width=100%%>");
printf("<tr>");
printf("<td align=center width=135 height=25><b>貨品</b></td>");
printf("<td align=center width=50><b>件數</b></td>");
printf("<td align=center width=80><b>重量</b></td>");
printf("<td align=center width=75><b>舊價</b></td>");
printf("<td align=center width=75><b>新價</b></td>");
printf("</tr>");
$query = "select distinct run_order_line.product_id from vol_product,run_order_head,run_order_line where (so_date >= '$date_fr' and so_date <= '$date_to') and (customer_id='$custno' and remark='$rem' and run_order_line.status != '117' and run_order_head.order_id=run_order_line.order_id and vol_product.product_id=run_order_line.product_id) group by product_id order by sort_order limit $b,$maxrow";
$result = mysql_query($query,$db);
$n = 1;
$pid_str = "0";
while ($myrow = mysql_fetch_array($result)) {
  $no = $myrow["product_id"];
  $pid_str = $pid_str.",".$no;
  printf("<input type=hidden name=no$n value=\"%s\">",$no);
  $query = "select product_name,unit_price from vol_product,run_order_head,run_order_line where customer_id='$custno' and remark='$rem' and run_order_line.status != '117' and run_order_line.product_id='$no' and run_order_head.order_id=run_order_line.order_id and vol_product.product_id=run_order_line.product_id order by order_line_id desc limit 0,1";
  $result1 = mysql_query($query,$db);
  $myrow = mysql_fetch_array($result1);
  $wt = 'wt'.$n;
  $wt = $$wt;
  $qty = 'qty'.$n;
  $qty = $$qty;
  printf("<tr nowrap>");
  printf("<td><b>%s</b></td>",$myrow["product_name"]);
  printf("<td align=center><input maxLength=7 name=qty$n onchange=checkNum(this); size=5 value=\"%s\"></td>",$qty);
  printf("<td align=center><input maxLength=10 name=wt$n onchange=checkNum(this); size=8 value=\"%s\"></td>",$wt);
  printf("<td align=center><input maxLength=10 name=price$n onchange=checkNum(this); size=8 value=\"%s\" readonly></td>",$myrow["unit_price"]-0);
  printf("<td align=center><input maxLength=10 name=getPrice$n onchange=checkNum(this); size=8 ></td>");
  printf("</tr>");
  $n++;
}
printf("</table>");

printf("</td>");
printf("<td width=70>");

printf("<table border=0 cellpadding=0 cellspacing=0 width=100%%>");
printf("<tr>");
printf("<td align=center width=70><b>&nbsp;</b></td>");
printf("</tr>");
printf("</table>");

printf("</td>");
printf("<td width=415>");

printf("<table border=0 cellpadding=0 cellspacing=0 width=100%%>");
printf("<tr>");
printf("<td align=center width=135 height=25><b>貨品</b></td>");
printf("<td align=center width=50><b>件數</b></td>");
printf("<td align=center width=80><b>重量</b></td>");
printf("<td align=center width=75><b>舊價</b></td>");
printf("<td align=center width=75><b>新價</b></td>");
printf("</tr>");
$b = $maxrow;
$query = "select distinct run_order_line.product_id from vol_product,run_order_head,run_order_line where (so_date >= '$date_fr' and so_date <= '$date_to') and (customer_id='$custno' and remark='$rem' and run_order_line.status != '117' and run_order_head.order_id=run_order_line.order_id and vol_product.product_id=run_order_line.product_id) group by product_id order by sort_order limit $b,$maxrow";
$result = mysql_query($query,$db);
while ($myrow = mysql_fetch_array($result)) {
  $no = $myrow["product_id"];
  $pid_str = $pid_str.",".$no;
  printf("<input type=hidden name=no$n value=\"%s\">",$no);
  $query = "select product_name,unit_price from vol_product,run_order_head,run_order_line where customer_id='$custno' and remark='$rem' and run_order_line.status != '117' and run_order_line.product_id='$no' and run_order_head.order_id=run_order_line.order_id and vol_product.product_id=run_order_line.product_id order by order_line_id desc limit 0,1";
  $result1 = mysql_query($query,$db);
  $myrow = mysql_fetch_array($result1);
  $wt = 'wt'.$n;
  $wt = $$wt;
  $qty = 'qty'.$n;
  $qty = $$qty;
  printf("<tr nowrap>");
  printf("<td><b>%s</b></td>",$myrow["product_name"]);
  printf("<td align=center><input maxLength=7 name=qty$n onchange=checkNum(this); size=5 value=\"%s\"></td>",$qty);
  printf("<td align=center><input maxLength=10 name=wt$n onchange=checkNum(this); size=8 value=\"%s\"></td>",$wt);
  printf("<td align=center><input maxLength=10 name=price$n onchange=checkNum(this); size=8 value=\"%s\" readonly></td>",$myrow["unit_price"]-0);
  printf("<td align=center><input maxLength=10 name=getPrice$n onchange=checkNum(this); size=8 ></td>");
    
  printf("</tr>");
  $n++;
}
printf("</table>");

printf("</td>");

printf("</tr>");
printf("</table>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=750><TR nowrap>");
printf("<TD align=left width=500>&nbsp;</TD>");
printf("</TR></TABLE>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=750><TR nowrap>");
printf("<TD align=right width=50><INPUT type=submit name=action value=\"%s\"></TD>",$rem);
printf("<TD align=left width=460>&nbsp;</TD>");
printf("<TD align=right width=70><INPUT type=button value=代出 onclick=openSBWindow('dn_goods.php?custno=%s','dn_goods',790,500);></TD>",$custno);
printf("<TD align=right width=100><INPUT type=button value=全部貨品 onclick=openSBWindow('all_gds.php?custno=%s','all_gds',790,500);window.close();></TD>",$custno);
printf("<TD align=right width=70><INPUT type=button value=關閉 onclick=window.close();></TD>");
printf("</TR></TABLE>");

printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=750><TR nowrap>");
printf("<TD align=left width=500>&nbsp;</TD>");
printf("</TR></TABLE>");

printf("<table border=0 cellspacing=0 cellpadding=0 width=750>");
printf("<tr valign=top>");

printf("<td width=415>");

printf("<table border=0 cellpadding=0 cellspacing=0 width=100%%>");
$start_n=$n;
for ($i=$n;$i<($n+3);$i++) {

  $no = 'no'.$i;
  $no = $$no;
  $wt = 'wt'.$i;
  $wt = $$wt;
  $qty = 'qty'.$i;
  $qty = $$qty;
  $price = 'price'.$i;
  $price = $$price;
  printf("<tr nowrap>");
  printf("<td><select name=no$i style='width:100px' size=1 onchange=getValue('no$i');>");
  $query = "select product_id,product_name from vol_product where status != '110' and product_id not in (".$pid_str.") order by sort_order";
  $result = mysql_query($query,$db);
  while ($myrow = mysql_fetch_array($result)) {
    if (!$no) {
      printf("<option value=%s>%s",$myrow["product_id"],$myrow["product_name"]);
    }
    else {
      if ($myrow["product_id"] == $no) {
        printf("<option selected value=%s>%s",$myrow["product_id"],$myrow["product_name"]);
      }
      else {
        printf("<option value=%s>%s",$myrow["product_id"],$myrow["product_name"]);
      }
    }
  }
  printf("</select></td>");
  printf("<td align=center width=50><input maxLength=7 name=qty$i onchange=checkNum(this); size=5 value=\"%s\"></td>",$qty);
  printf("<td align=center width=80><input maxLength=10 name=wt$i onchange=checkNum(this); size=8 value=\"%s\"></td>",$wt);

  	printf("<td align=center width=75><input maxLength=10 name=price$i onchange=checkNum(this); size=8 value=\"%s\" ></td>",$price);
    if($price_change)
  {
    printf("<td align=center><input maxLength=10 name=getPrice$i onchange=checkNum(this); size=8 ></td>");
  }
  else
  {
  	 printf("<td align=center><input maxLength=10 name=getPrice$i onchange=checkNum(this); size=8 readonly></td>");
  }

    printf("<td align=center><input type=button name=goto$i onclick=goto_soprice(this);></td>");
  printf("</tr>");
}
printf("</table>");

printf("</td>");
printf("<td width=70>");

printf("<table border=0 cellpadding=0 cellspacing=0 width=100%%>");
printf("<tr>");
printf("<td align=center width=70><b>&nbsp;</b></td>");
printf("</tr>");
printf("</table>");

printf("</td>");
printf("<td width=415>");
printf("<table border=0 cellpadding=0 cellspacing=0 width=100%%>");
for ($i=($n+3);$i<($n+6);$i++) {
  $no = 'no'.$i;
  $wt = 'wt'.$i;
  $wt = $$wt;
  $qty = 'qty'.$i;
  $qty = $$qty;
  $price = 'price'.$i;
  $price = $$price;
  printf("<tr nowrap>");
  printf("<td><select name=no$i size=1 style='width:100px' onchange=getValue('no$i');>");
  $query = "select product_id,product_name from vol_product where status != '110' and product_id not in (".$pid_str.") order by sort_order";
  $result = mysql_query($query,$db);
  while ($myrow = mysql_fetch_array($result)) {
    if (!$no) {
      printf("<option value=%s>%s",$myrow["product_id"],$myrow["product_name"]);
    }
    else {
      if ($myrow["product_id"] == $no) {
        printf("<option selected value=%s>%s",$myrow["product_id"],$myrow["product_name"]);
      }
      else {
        printf("<option value=%s>%s",$myrow["product_id"],$myrow["product_name"]);
      }
    }
  }
  printf("</select></td>");
  printf("<td align=center width=50><input maxLength=7 name=qty$i onchange=checkNum(this); size=5 value=\"%s\"></td>",$qty);
  printf("<td align=center width=80><input maxLength=10 name=wt$i onchange=checkNum(this); size=8 value=\"%s\"></td>",$wt);

  	printf("<td align=center width=75><input maxLength=10 name=price$i onchange=checkNum(this); size=8 value=\"%s\" ></td>",$price);
    if($price_change)
  {
    printf("<td align=center><input maxLength=10 name=getPrice$i onchange=checkNum(this); size=8 ></td>");
  }
  else
  {
  	 printf("<td align=center><input maxLength=10 name=getPrice$i onchange=checkNum(this); size=8 readonly></td>");
  }
  printf("<td align=center><input type=button name=goto$i onclick=goto_soprice(this);></td>");
  printf("</tr>");
}
printf("</table>");

printf("</td>");

printf("</tr>");
printf("</table>");
printf("<input type=hidden name=numr value=\"%s\">",$i-1);

printf("</form>");
for($i=$start_n;$i<$start_n+6;$i++)
{
	printf("<div id=error$i></div>");
}
printf("</body>");
printf("</html>");
printf("<div id=showtime></div>");
mysql_close($db);

?>
<script language="javascript">
var nowtime;

var hr=false;
var start_n=<?php echo $start_n?>;
for(var i=1;i<start_n;i++)
{
	getValue("no"+i);
	elementPrice=document.getElementById("price"+i);
	elementGetPrice=document.getElementById("getPrice"+i);
	element=elementPrice.value>elementGetPrice.value?elementPrice:elementGetPrice;
	element.style.color='red';
}
for(var i=start_n;i<start_n+6;i++)
{
	getValue("no"+i);
}
function getValue(select_name)
{
/*
	nowtime=new Date();
	var element;
	element_so_date=document.getElementById("so_date");
	element_select=document.getElementById(select_name);
	var url="getprice.php?custno=<?php echo $custno;?>&pro_id="+element_select.value+"&date="+element_so_date.value+"&sln="+select_name+"&rem=<?php echo $custno;?>";
	hr=false;
	if(window.XMLHttpRequest)
	{
		hr=new XMLHttpRequest();
		if(hr.overrideMimeType)
		{
			hr.overrideMimeType('text/xml');
		}
	}
	else if(window.ActiveXObject)
	{
		try
		{
			hr=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			try
			{
				hr=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){}
		}
	}
	hr.onreadystatechange=show;
	hr.open("GET",url,false);
	hr.send(null);
	*/
}
function show()
{
	response=hr.responseText.split("@@");
	response[1]=response[1].replace("no","");
	element=document.getElementById("getPrice"+response[1]);
	element.value=response[0];
	element.style.color='#000000';
	if(response[2]=='no_data.') {element.value='';}
	else if(response[2]!='') {element.style.color=response[2];element.bgColor=response[2];}
	ele=document.getElementById('showtime');
	var today = new Date();
	ele.innerText+=today.getTime()-nowtime.getTime()+'<br>';

}
function goto_soprice(obj)
{
	var name=obj.name;
	var seq=name.replace("goto","");
	elementProduct=document.getElementById("no"+seq);
	var customer=<?php echo$custno;?>;
	var url="so_price2.php?customer="+customer+"&product="+elementProduct.value;
	openSBWindow(url);
}
</script>