<?php
function check($customer_id,$product_id,$date_start,$date_end,$odate_start,$odate_end,$customer_name,$product_name,$bMessage=true)
{
	if(mktime($date_start)>mktime($date_end)) 
	{
		if($bMessage)echo "<script>alert('Wrong Date!');</script>";
		return false;
	}
	$query_check="select * from cus_pro_price where product_id='$product_id' and customer_id='$customer_id' and ('$odate_start'<>date_start and '$odate_end'<>date_end) and (('$date_start' between date_start and date_end) or ('$date_end' between date_start and date_end) or (date_start >'$date_start' and date_end<'$date_end'))";
	$result = mysql_query($query_check);
  	$num=mysql_num_rows($result);
  	if($num>=1)
  	{
  		if($bMessage) echo "Please check your data! $product_name sold to $customer_name :<br>The start date and end date<br>";
		for($i=0;$i<$num;$i++) 
  		{
  			$row=mysql_fetch_array($result);
  			if($bMessage) echo $row['date_start'].' to '.$row['date_end'].'<br>';
  		}
  		if($bMessage)echo "And the date you write in is $date_start to $date_end";
  		return false;
  	}
  	return true;
}
?>