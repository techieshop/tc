<?php
if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}
function buildpdfcol($sqlresult)	{
    $ColName = array();
	$rs=mysql_data_seek($sqlresult,0);
    if ($rs)   {
    for ($i=0; $i<mysql_num_fields($sqlresult); $i++)  {
		$f=mysql_field_name($sqlresult,$i);
		$fieldname=get_vocab("$f");
      	array_push($ColName, $fieldname);
    } // end for
	} // end if $rs
	return $ColName;
}

function buildpdfdata($sqlresult, $col)	{
    $ColData = array();
    $rs=mysql_data_seek($sqlresult,0);
    if ($rs)   {
		while ($ro = mysql_fetch_array($sqlresult))    {
			$row = array();
    		for ($i=0; $i<mysql_num_fields($sqlresult); $i++)  {
				if (mysql_field_type($sqlresult,$i)=='real') { 
        			array_push($row, number_format($ro[$i],1));
				} else {	
        			array_push($row, $ro[$i]);
				}
			} //end for
        	array_push($ColData, $row);
		} // end while
    } // end if $rs
    return $ColData;
}

function buildtable($sqlresult,$col=-1,$col2=-1,$col3=-1,$col4=-1)	{
?>
<table width="100%" border="0" cellpadding="1">
<tr bgcolor="#CCCCCC">
<?php
	$rs=mysql_data_seek($sqlresult,0);
    if ($rs)   {
    for ($i=0; $i<mysql_num_fields($sqlresult); $i++)  {
?>
        <td><strong><?php $f=mysql_field_name($sqlresult,$i);
                    echo get_vocab("$f"); ?><strong></td>
<?php
    } // end for
?>
<?php
    while ($ro = mysql_fetch_array($sqlresult))    {
?>
        <tr>
<?php
            for ($i=0; $i<mysql_num_fields($sqlresult); $i++)  {
?>
                <td class=odd_row>
				<?php 
						if (mysql_field_type($sqlresult,$i)=='real') { 
							echo number_format($ro[$i],2); 
						} else {	
							echo $ro[$i]; 
						}
				?></td>
<?php
            }
?>
        </tr>
<?php
    } // end while
    } // end if
	if ($col!=-1)	{
	$Total=0;
	if ($col2!=-1)	{ $Total2=0; }
	if ($col3!=-1)	{ $Total3=0; }
	if ($col4!=-1)	{ $Total4=0; }
	$rs=mysql_data_seek($sqlresult,0);
	if ($rs)	{
    	while ($ro = mysql_fetch_array($sqlresult))    {
			if ($col!=-1)	$Total+=$ro[$col];
			if ($col2!=-1)	$Total2+=$ro[$col2];
			if ($col3!=-1)	$Total3+=$ro[$col3];
			if ($col4!=-1)	$Total4+=$ro[$col4];
		} // end while
		$STotal=number_format($Total,2);
		$STotal2=number_format($Total2,2);
		$STotal3=number_format($Total3,2);
		$STotal4=number_format($Total4,2);
?>
    	<tr>
<?php
		$rs=mysql_data_seek($sqlresult,0);
    	for ($i=0; $i<mysql_num_fields($sqlresult); $i++)  {
			if ($i==$col)	{
        		echo "<td class=odd_row align>".$STotal."</td>";
			} else if ($i==$col2)	{
        		echo "<td class=odd_row align>".$STotal2."</td>";
			} else if ($i==$col3)	{
        		echo "<td class=odd_row align>".$STotal3."</td>";
			} else if ($i==$col4)	{
        		echo "<td class=odd_row align>".$STotal4."</td>";
			} else {
				echo "<td class=odd_row>&nbsp</td>";
			}
    	} // end for
?>
    	</tr>
<?php 
	} // end if $rs
	} // end if $col
?>
</table>
<?php
} // end function buildtable()
 
function buildtableb($sqlresult,$col=-1,$col2=-1,$col3=-1,$col4=-1,$button=-1,$key=-1)	{
?>
<table width="100%" border="0" cellpadding="1">
<tr bgcolor="#CCCCCC">
<?php
	$rs=mysql_data_seek($sqlresult,0);
    if ($rs)   {
    for ($i=0; $i<mysql_num_fields($sqlresult); $i++)  {
?>
        <td><strong><?php $f=mysql_field_name($sqlresult,$i);
                    echo get_vocab("$f"); ?><strong></td>
<?php
    } // end for
?>
<?php
    while ($ro = mysql_fetch_array($sqlresult))    {
?>
        <tr>
<?php
            for ($i=0; $i<mysql_num_fields($sqlresult); $i++)  {
?>
                <td class=odd_row>
				<?php 
						if (mysql_field_type($sqlresult,$i)=='real') { 
							echo number_format($ro[$i],2); 
						} else {	
							echo $ro[$i]; 
						}
				?></td>
<?php
            }
        print $button."','sub',500,400)\"></td>";
    //    print "<td><input type=button name=Submit value=\"".get_vocab("add")."\" onclick=\"javascript:openGLWindow('add_mktprice.php?ProductID=".$ro[$key]."','sub',500,400)\"></td>";
?>
        </tr>
<?php
    } // end while
    } // end if
	if ($col!=-1)	{
	$Total=0;
	if ($col2!=-1)	{ $Total2=0; }
	if ($col3!=-1)	{ $Total3=0; }
	if ($col4!=-1)	{ $Total4=0; }
	$rs=mysql_data_seek($sqlresult,0);
	if ($rs)	{
    	while ($ro = mysql_fetch_array($sqlresult))    {
			if ($col!=-1)	$Total+=$ro[$col];
			if ($col2!=-1)	$Total2+=$ro[$col2];
			if ($col3!=-1)	$Total3+=$ro[$col3];
			if ($col4!=-1)	$Total4+=$ro[$col4];
		} // end while
		$STotal=number_format($Total,2);
		$STotal2=number_format($Total2,2);
		$STotal3=number_format($Total3,2);
		$STotal4=number_format($Total4,2);
?>
    	<tr>
<?php
		$rs=mysql_data_seek($sqlresult,0);
    	for ($i=0; $i<mysql_num_fields($sqlresult); $i++)  {
			if ($i==$col)	{
        		echo "<td class=odd_row align>".$STotal."</td>";
			} else if ($i==$col2)	{
        		echo "<td class=odd_row align>".$STotal2."</td>";
			} else if ($i==$col3)	{
        		echo "<td class=odd_row align>".$STotal3."</td>";
			} else if ($i==$col4)	{
        		echo "<td class=odd_row align>".$STotal4."</td>";
			} else {
				echo "<td class=odd_row>&nbsp</td>";
			}
    	} // end for
?>
    	</tr>
<?php 
	} // end if $rs
	} // end if $col
?>
</table>
<?php
} // end function buildtableb()

// Establish a database connection.
// On connection error, the message will be output without a proper HTML
// header. There is no way I can see around this; if track_errors isn't on
// there seems to be no way to supress the automatic error message output and
// still be able to access the error text.
if (empty($db_nopersist))
	$db_base = mysql_pconnect($db_host, $db_login, $db_password);
else
	$db_base = mysql_connect($db_host, $db_login, $db_password);

//$get_dayone="select balance from ref_counter where counter='dayone'";
//$ro=sql_row(sql_query($get_dayone),0);
//$dayone=$ro[0];


if (!$db_base)
{
	echo "\n<p>\n" . get_vocab("failed_connect_db") . "\n";
	exit;
}
unset($_SESSION['data']);
unset($_SESSION['head']);
unset($_SESSION['colname']);
$count=0;
for ($i = 1; $i <= $numr; $i++) {
	$chbox = 'chbox'.$i;
    $chbox = $$chbox;
  if ($chbox == "yes") {
	$id="id".$i;
	$id = $$id;
	if($count==0) $sId=$id;
	else $sId.=",".$id;
	$count++;
  }
}?>
<meta content="text/html; charset=big5" http-equiv=Content-Type>
<?php

$sql="select ifnull( n.customer_name, '公價' ) as 'Customer',v.product_name as 'Product',c.price as 'Price',date_start as 'Start Date',date_end as 'End Date' from vol_product v left outer join cus_pro_price c on v.product_id=c.product_id left outer join ntt_customer n on n.customer_id=c.customer_id where v.status!='110' and c.id in ($sId) order by $sort, sort_order,v.product_id";
$rs = mysql_query($sql,$db);
	$_SESSION['head'] = array(
				'col_count' => 5, 
				'orientation' => 'P', 
                'print_date' => "$print_date", 
                'page_sub_title' => "$sub_title",
				'print_page' => "Page ",
				);
	if (mysql_num_rows($rs)>0)	{
		//buildtable($rs);
		$_SESSION['colname'] = array();
		//$ColName = buildpdfcol($rs);
		$ColName = array("顧客","貨品","單價(港幣)","開始日期","結束日期");//buildpdfcol($rs);
		array_push($_SESSION['colname'], $ColName);
        $ColWidth = array(50,50,25,33,33);
        $ColAlign = array('L','L','R','C','C');
	  	array_push($_SESSION['colname'], $ColWidth);
	  	array_push($_SESSION['colname'], $ColAlign);
		$_SESSION['data'] = buildpdfdata($rs,5);
	}
	

?><!---->
<script>window.location.href='pdf_price.php';</script>

