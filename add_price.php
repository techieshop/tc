<?php
include_once("include_head/tc_inv_header.inc");
if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

echo"<script language=JavaScript src=js/kh_form.js></script>";
$column1='width=35%';
$column2='width=65%';
if ($action == "確定") {
  if(mktime($date_start)>mktime($date_end)) 
  {
  	echo "<script>alert('Sorry,please check you date!')</script>";
  }
  else 
  {
  	if($product=='all')insert_all($customer,'',$date_start,$date_end);
  	else insert_price($product,$customer,$price,$date_start,$date_end);

  }
}
?>
<meta content="text/html; charset=big5" http-equiv=Content-Type>
<?php

printf("<html><head>");
printf("<title>Add price</title>");
printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
printf("<script language=JavaScript src=js/windowManager.js></script>");
printf("</head><body bgcolor=#eeeeee link=#000000>");

printf("<form action=$PHP_SELF method=post>");
printf("<table border=0 cellspacing=0 cellpadding=1 width=300>");
printf("<tr bgcolor=#70a4e9>");
printf("<td align=left height=25><font><b>Add price</b></font></td>");
printf("</tr></table>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=300><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
printf("<table border=0 cellpadding=0 cellspacing=0 width=300><tr>");
printf("<td align=left $column1%><b>product</b></td>");
printf("<td align=left $column2%><font size=-1><select name=product size=1>");
$query = "select product_id,product_name from vol_product where status!='110'";
$result1 = mysql_query($query);
printf("<option %s value='all'>全部</option>",$product=='all'?'selected':'');
while ($myrow = mysql_fetch_array($result1)) {
  printf("<option %s value=%s >%s",$myrow["product_id"]==$product?'selected':'',$myrow["product_id"],$myrow["product_name"]);
}
printf("</select></font></td>");
printf("</tr><tr>");
printf("<td align=left ><b>customer</b></td>");
printf("<td align=left ><font size=-1><select name=customer size=1>");
$query = "select customer_id,customer_name from ntt_customer";
$result1 = mysql_query($query);
printf("<option %s value=0 >一般客戶</option>",$customer==0?'selected':'');
while ($myrow = mysql_fetch_array($result1)) {
  printf("<option %s value=%s>%s",$myrow["customer_id"]==$customer?'selected':'',$myrow["customer_id"],$myrow["customer_name"]);
}
printf("</select></font></td>");
printf("</tr><tr>");
printf("<td>&nbsp;</td>");
printf("</tr><tr>");
printf("<td align=left ><b>Price</b></td>");
printf("<td align=left ><font size=-1><input name='price' value='$price' /></font></td>");
printf("</tr><tr>");
printf("<td align=left ><b>Start date</b></td>");
printf("<td align=left ><font size=-1><input name='date_start' value='$date_start' onchange='return checkDate(this)' /></font></td>");
printf("</tr><tr>");
printf("<td align=left ><b>End date</b></td>");
printf("<td align=left ><font size=-1><input name='date_end' value='$date_end' onchange='return checkDate(this)'; /></font></td>");
printf("</tr></TABLE>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=300><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=300><TR nowrap><TD align=left width=30%%>&nbsp;");
printf("</TD><TD align=left width=30%%>");
printf("<INPUT type=submit name=action value=確定 >");
printf("</TD><TD align=left width=40%%>");
printf("<INPUT type=button value=關閉 onclick=openSBWindow('so_price2.php','so_price2',540,480);window.close();>");
printf("</TD></TR></TABLE></FORM></BODY></HTML>");
mysql_close($db);
function insert_price($product,$customer,$price,$date_start,$date_end,$bScript=true)
{
  	$query_check="select * from cus_pro_price where product_id='$product' and customer_id='$customer' and (('$date_start' between date_start and date_end) or ('$date_end' between date_start and date_end) or (date_start >'$date_start' and date_end<'$date_end'))";
  	$result = mysql_query($query_check);
  	$num=mysql_num_rows($result);
	
  	if($num>0)
  	{
  		if($bScript)
  		{?>
  		<script>alert("Sorry,cannot insert data!\n<?php echo $num?>data conflict!\n<?php
		 
  		for($i=0;$i<$num;$i++) 
  		{
  			$row=mysql_fetch_array($result);
  			echo $row['date_start'].' to '.$row['date_end'].'\n';
  		};?>");
  		</script>
  		<?php
  		}
  		return false;
  	}
  	else
  	{
		if($price=='')
		{
			$date=date("Y-m-d");
			$sql="select price from cus_pro_price where customer_id=0 and product_id='$product' and '$date' between date_start and date_end";
			$rs=mysql_query($sql);
			if(mysql_num_rows($rs)>0)
			{
				$row=mysql_fetch_array($rs);
				$price=$row['price'];
			}
		}		
  		$query = "insert into cus_pro_price (product_id,customer_id,price,date_start,date_end,date_add) values('$product','$customer','$price','$date_start','$date_end',now())";
  		$result = mysql_query($query);
  		if($bScript) echo "<script>alert('OK!');</script>";
  		return true;
  	}
}
function insert_all($customer,$price,$date_start,$date_end)
{
	$sql="select product_id,product_name from vol_product where status!='110'";
	$rs=mysql_query($sql);
	while ($row=mysql_fetch_array($rs)) {
		$insert_false=insert_price($row['product_id'],$customer,$price,$date_start,$date_end,false);
		if(!$insert_false)
		{
			$insert_false_product[]=$row['product_name'];
		}
	}
	$size=sizeof($insert_false_product);
	if($size>0)
	{
	$false_prodcut=implode(",",$insert_false_product);
	$alert_str="共有".$size."條記錄有衝突,無法加入,請檢查數據.不能加入價格的貨品有";
	$alert_str.=$false_prodcut;
	}
	else
	{
		$alert_str="成功添加";
	}
	?>
	<script>
	var strAlert=<?php echo "\"".$alert_str."\"";?>;
	alert(strAlert);
	</script>
	<?php
	
	
}
?>
