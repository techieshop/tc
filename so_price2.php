<?php
include_once("include_head/tc_inv_header.inc");
include("control/select.php");
if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}
if($_POST['next']) $b=$_POST['next_b'];
elseif($_POST['previous']) $b=$_POST['previous_b'];
if($_GET['sort']) $sort=$_GET['sort'];
elseif($_POST['sort_mode']) $sort=$_POST['sort_mode'];
else $sort='customer_name';
switch ($action) {
case "埃":
for ($i = 1; $i <= $numr; $i++) {
  $no = 'no'.$i;
  $no = $$no;
  $pname = 'pname'.$i;
  $pname = $$pname;
  $customer_name = 'customer_name'.$i;
  $customer_name = $$customer_name;
/******
new add
******/  
  $price = 'price'.$i;
  $price = $$price;
  $customer_id = 'customer_id'.$i;
  $customer_id = $$customer_id;
  $date_start = 'date_start'.$i;
  $date_start = $$date_start;
  $date_end = 'date_end'.$i;
  $date_end = $$date_end;
  $odate_start = 'odate_start'.$i;
  $odate_start = $$odate_start;
  $odate_end = 'odate_end'.$i;
  $odate_end = $$odate_end;
//End add
  $chbox = 'chbox'.$i;
  $chbox = $$chbox;
  if ($chbox == "yes") {
    $pname = addslashes(trim($pname));
    $query = "delete from cus_pro_price where product_id='$no' and customer_id='$customer_id' and date_start='$odate_start' and date_end='$odate_end' ";
	$result = mysql_query($query,$db);
  }
}break;
case "穝":
for ($i = 1; $i <= $numr; $i++) {
  $no = 'no'.$i;
  $no = $$no;
  $pname = 'pname'.$i;
  $pname = $$pname;
  $customer_name = 'customer_name'.$i;
  $customer_name = $$customer_name;
/******
new add
******/  
  $price = 'price'.$i;
  $price = $$price;
  $customer_id = 'customer_id'.$i;
  $customer_id = $$customer_id;
  $date_start = 'date_start'.$i;
  $date_start = $$date_start;
  $date_end = 'date_end'.$i;
  $date_end = $$date_end;
  $odate_start = 'odate_start'.$i;
  $odate_start = $$odate_start;
  $odate_end = 'odate_end'.$i;
  $odate_end = $$odate_end;
//End add
  $chbox = 'chbox'.$i;
  $chbox = $$chbox;
  if ($chbox == "yes") {
    $pname = addslashes(trim($pname));
    require_once("check_price.php");
    if(check($customer_id,$no,$date_start,$date_end,$odate_start,$odate_end,$customer_name,$pname))
    {
    	$query = "update cus_pro_price set price='$price',date_start='$date_start',date_end='$date_end' where product_id='$no' and customer_id='$customer_id' and date_start='$odate_start' and date_end='$odate_end' ";
	$result = mysql_query($query,$db);
    }
  }
}
break;
case "尿戳":
for ($i = 1; $i <= $numr; $i++) {
  $no = 'no'.$i;
  $no = $$no;
  $pname = 'pname'.$i;
  $pname = $$pname;
  $customer_name = 'customer_name'.$i;
  $customer_name = $$customer_name;
/******
new add
******/  
  $price = 'price'.$i;
  $price = $$price;
  $customer_id = 'customer_id'.$i;
  $customer_id = $$customer_id;
  $date_start = 'date_start'.$i;
  $date_start = $$date_start;
  $date_end = 'date_end'.$i;
  $date_end = $$date_end;
//End add
  $chbox = 'chbox'.$i;
  $chbox = $$chbox;
  if ($chbox == "yes") {
  	$now=date("Y-m-d");
  	$now_month=date("m");
  	$now_day=date("d");
  	$now_month_start=date('Y-m-d',strtotime("$now -($now_day-1) days"));
  	$now_month_end=date('Y-m-d',strtotime("$now +1 months-$now_day days"));
  	$this_day=date('d',strtotime("$date_end"));
  	$this_month_end=date('Y-m-d',strtotime("$date_end +1 months-$this_day days"));
  	$sql="select * from cus_pro_price where product_id='$no' and customer_id='$customer_id' and date_end >'$date_end' order by date_end limit 0,1";
  	$result=mysql_query($sql);
  	$add_date_start=date('Y-m-d',strtotime("$date_end +1 days"));
  	if(mysql_num_rows($result)==0)
  	{
  		if($add_date_start>$this_month_end) $add_date_end=date('Y-m-d',strtotime("$date_end +2 months-$this_day days"));
  		else $add_date_end=$this_month_end;
  	}
  	else {
  		$row=mysql_fetch_array($result);
  		if($row['date_start']>$this_month_end)
  		{
  			if($add_date_start>$this_month_end) $add_date_end=date('Y-m-d',strtotime("$row[date_start] -1 days"))<date('Y-m-d',strtotime("$date_end +2 months-$this_day days"))?date('Y-m-d',strtotime("$row[date_start] -1 days")):date('Y-m-d',strtotime("$date_end +2 months-$this_day days"));
  			else $add_date_end=$this_month_end;
  		}
  		else 
  		{
  			$add_date_end=date('Y-m-d',strtotime("$row[date_start] -1 days"));
  		}
  	}
    $pname = addslashes(trim($pname));
    require_once("check_price.php");
    if(strtotime($add_date_end)-strtotime($now)>3600*24*60) continue;
    if(check($customer_id,$no,$add_date_start,$add_date_end,-1,-1,$customer_name,$pname,false))
    {
    	$query = "insert into cus_pro_price (customer_id,product_id,price,date_start,date_end,date_add,autostatus)values('$customer_id','$no','$price','$add_date_start','$add_date_end',now(),1)";
	    $result = mysql_query($query,$db);
    }
  }
}
break;
case "ゴ":
include("price_print.php");


} // switch ($action)
if($_POST['keyCustomerName']=='') $cus_sql='';
else $cus_sql=" and c.customer_id=$keyCustomerName ";
if($_POST['keyword']=='') $pro_sql='';
else $pro_sql=" and c.product_id=$keyword ";
if(!isset($keyDate)) $keyDate=date("Y-m-d");
if($keyDate=='') $dat_sql='';
else $dat_sql=" and ('$keyDate' between date_start and date_end )";
if($_GET['customer']&&$_GET['product'])
{
	$where_sql=" and c.customer_id=".$_GET['customer']." and c.product_id=".$_GET['product'];
}
else
{
	$where_sql=$cus_sql.$pro_sql.$dat_sql;
}
$so_date=date("Y-m-d");
$limit_date=date("Y-m-d",strtotime("$so_date + 3 days"));
$before_date=date("Y-m-d",strtotime("$limit_date -15 days"));
if($_POST['overdue'])
{
	$where_sql.="and date_end between '$before_date' and '$limit_date'";
}
  printf("<html><head>");
  printf("<title>砯珇</title>");
  //printf("<meta content=\"text/html; charset=big5\" http-equiv=Content-Type>");
  ?>
  <meta content="text/html; charset=big5" http-equiv=Content-Type>
  <?php
  printf("<script language=JavaScript src=js/windowManager.js></script>");
  printf("<script language=JavaScript src=js/kh_form.js></script>");
  printf("</head><body bgcolor=#eeeeee link=#000000 vlink=#000000>");
  printf("<form action=$PHP_SELF method=post name='form1'>");
  printf("<table border=0 cellspacing=0 cellpadding=1 width=630>");
  printf("<tr bgcolor=#70a4e9>");
  printf("<td align=left height=25><font><b>砯珇</b></font></td>");
  printf("</tr></table>");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=500><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
  printf("<table border=0 cellpadding=0 cellspacing=0 width=500><tr nowrap>");
  $query = "select v.product_id,v.product_name,c.price,c.customer_id,n.customer_name,date_start,date_end from vol_product v left outer join cus_pro_price c on v.product_id=c.product_id left outer join ntt_customer n on n.customer_id=c.customer_id where v.status!='110' and  date_end >='$before_date' $where_sql";
  $result = mysql_query($query,$db);
  $numrows = mysql_num_rows($result);
  if (!isset($b)) {
    $b = 1;
  }
  $b1 = $b - 1;
  $maxrow = 100;
  printf("<td align=left width=560><font size=-1><b>砯珇基%s贺陪ボ材%s%s%s兜</b></font></td>",$numrows,ceil($b1/$maxrow)+1,min($b-0,$numrows),min($b+$maxrow-1,$numrows));
  printf("<td align=right width=20><INPUT type=submit name=action value=></td>");
  printf("<td align=left width=90>材<input maxLength=5 name=b size=3 value=\"%s\">︽</td>",$b);
  printf("</tr></table>");
  printf("逼:<select name='sort_mode' onchange=sort();>");
  printf("<option value=%s %s>%s</option>",'customer_id',$sort=='customer_id'?'selected':'','め絪腹');
  printf("<option value=%s %s>%s</option>",'customer_name',$sort=='customer_name'?'selected':'','め嘿');
  printf("<option value=%s %s>%s</option>",'product_id',$sort=='product_id'?'selected':'','砯珇絪腹');
  printf("<option value=%s %s>%s</option>",'product_name',$sort=='product_name'?'selected':'','砯珇嘿');
  printf("<option value=%s %s>%s</option>",'date_start',$sort_mode=='date_start'?'selected':'','秨﹍ら戳');
  printf("<option value=%s %s>%s</option>",'date_end',$sort=='date_end'?'selected':'','挡ら戳');
  printf("<option value=%s %s>%s</option>",'date_add',$sort=='date_add'?'selected':'','睰ら戳');
  printf("</select><br>");
  //printf("Customer<input type='text' name='keyCustomerName'/>");
  printf("め");
  $sql="select customer_id,customer_name from ntt_customer";
  if($_GET['customer'])$keyCustomerName=$_GET['customer'];
  if($_GET['product'])$keyword=$_GET['product'];
  $arrCustomer=selectArr($sql,'keyCustomerName',$keyCustomerName,array(true,array(0,'そ基')));
  printf(" 砯珇");
  $sql="select product_id,product_name from vol_product where status!='110'";
  $arrProduct=selectArr($sql,'keyword',$keyword,true);
  printf(" ら戳<input type='text' name='keyDate' size=9 value=$keyDate>");
  printf("<input type='submit' name='search' value='琩т'/>");
  printf("<input type='submit' name='overdue' value='筁戳'/>");
  printf("<table border=1 cellpadding=1 cellspacing=1><tr bgcolor=#99ccff>");
  printf("<th align=center width=20 height=25><input type=checkbox name=chbox value=yes onclick=checkA() ></th>");
  printf("<th align=center width=50 height=25><font size=-1><b>砯腹</b></font></th>");
  printf("<th align=center ><font size=-1><b>砯珇</b></font></th>");
  printf("<th align=center width=100><font size=-1><b>め</b></font></th>");
  printf("<th align=center width=50><font size=-1><b>虫基</b></font></th>");
  printf("<th align=center width=80><font size=-1><b>秨﹍ら戳</b></font></th>");
  printf("<th align=center width=80><font size=-1><b>挡ら戳</b></font></th>");
  printf("</tr><tbody>");
  $query = "select c.id,v.product_id,v.product_name,c.price,c.customer_id,n.customer_name,date_start,date_end from vol_product v left outer join cus_pro_price c on v.product_id=c.product_id left outer join ntt_customer n on n.customer_id=c.customer_id where v.status!='110' and date_end >='$before_date' $where_sql order by $sort, sort_order,v.product_id limit $b1,$maxrow";
  $result = mysql_query($query,$db);
  $i = 0;
  while ($myrow = mysql_fetch_array($result)) {
    $i++;
    $no = $myrow["product_id"];
    $pname = $myrow["product_name"];
    /*$sorder = $myrow["sort_order"];
    $uni = $myrow["product_unit_id"];
    $sta = $myrow["status"];*/
    $id=$myrow["id"];
    $price = $myrow["price"];
    $customer_id = $myrow["customer_id"];
    $customer_name = $myrow["customer_id"]!=0?$myrow["customer_name"]:"そ基";
    $date_start = $myrow["date_start"];
    $date_end = $myrow["date_end"];
    $color='';
    if($date_end<=$limit_date)
    {
    	$sql_check="select * from cus_pro_price where product_id=$no and customer_id=$customer_id and date_end >'$date_end' order by date_end limit 0,1";
    	$result_check=mysql_query($sql_check);
    	$check_num=mysql_num_rows($result_check);
    	$date_end_next='';
    	$date_start_next='';
    	if($check_num>0)
    	{
    		$row=mysql_fetch_array($result_check);
    		$date_end_next=$row['date_end'];
    		$date_start_next=$row['date_start'];
    	}

    	if($date_end_next&&$date_start_next)
    	{
    		//如果下一期的价格日子与今期的相链接,且下一期的date_end在limit_date之后,则无色.
    		if($date_start_next<=date('Y-m-d',strtotime("$date_end +1 days"))&&$date_end_next>$limit_date)
    		{
    			$color='';
    		}
    		elseif ($date_start_next<=date('Y-m-d',strtotime("$date_end +1 days"))&&$date_end_next<=$limit_date)
    		{
    			$color="bgcolor='red'";
    		}
    		else $color="bgcolor='red'";
    	}
    	elseif ($date_end<=$limit_date)
    	{
    		$color="bgcolor='red'";
    	}
    }
    printf("<tr %s>",$color);
    printf("<td align=left><input type=checkbox name=chbox$i value=yes></td>");
    printf("<input name=id$i value=%s type=hidden >",$id);
    printf("<td align=left><font>%s</font></td>",$no);
    printf("<input type=hidden name=no$i value=\"%s\">",$no);
    printf("<td align=center><font size=-1><input maxLength=50 name=pname$i size=20 value=\"%s\" readonly></font></td>",$pname);   
    printf("<td align=center width=100><font size=-1><input type='hidden' maxLength=7 name=customer_id$i size=5 value=\"%s\" ></font>",$customer_id);
    printf("<font size=-1><input maxLength=20 name=customer_name$i value=\"%s\" readonly size=15></font></td>",$customer_name);
    printf("<td align=center><font size=-1><input maxLength=11 name=price$i value=\"%s\" size=12></font></td>",$price);

    printf("<td align=center><font size=-1><input maxLength=10 name=date_start$i value=\"%s\" size=10 onchange='return checkDate(this)'></font></td>",$date_start);
    printf("<td><font size=-1><input maxLength=10 name=date_end$i value=\"%s\" size=10 onchange='return checkDate(this)'></font ></td>",$date_end);
    printf("<td width=0><font size=-1><input type=hidden name=odate_start$i value=\"%s\" size=10'></font></td>",$date_start);
    printf("<td width=0><font size=-1><input type=hidden name=odate_end$i value=\"%s\" size=10'></font ></td>",$date_end);
    printf("</tr>");
  }
  printf("<input type=hidden name=numr value=\"%s\">",$i);
  printf("</tbody></TABLE>");
  $url1 = "$PHP_SELF?b=";
  $numrow = $numrows;
  $npcolor = "#eeeeee";
  $npwidth = 20;
  include("include/next2_p.php");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=500><TR nowrap><TD>&nbsp;</TD></TR></TABLE>");
  printf("<TABLE border=0 cellpadding=0 cellspacing=0 width=500><TR nowrap><TD align=left width=32%%>&nbsp;");
  printf("</TD><TD align=left width=15%%>");
  printf("</TD><TD align=left width=38%%>");
  printf("</TD><TD align=left width=15%%>");
  printf("<INPUT type=button value=穝 onclick=openSBWindow('add_price.php','add_price',340,240);>");
  printf("<INPUT type=submit name=action value='穝'>"); 
  printf("<INPUT type=submit name=action value='埃' onclick='return confirmDel();'>"); 
  printf("<INPUT type=submit name=action value='尿戳' >");
  printf("<INPUT type=submit name=action value='ゴ' >");
  printf("<INPUT type=button value=闽超 onclick=window.close();>");
  printf("</TD></TR></TABLE></FORM></BODY></HTML>");
  mysql_close($db);

?>
<script language="javascript">
function confirmDel()
{
	var temp=confirm('絋粄埃?');
	return temp;
}

function sort()
{
	var sort_value=document.getElementById('sort_mode').value;
	window.location.href="<?php echo $PHP_SELF?>?sort="+sort_value;
}
function checkA()
{
	var check=document.getElementById('chbox').checked;
	for(j=1;j<=<?php echo $i;?>;j++)
	{
		var chbox='chbox'+j;
		document.getElementById(chbox).checked=check;
	}
}
</script>
