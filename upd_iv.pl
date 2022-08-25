#!/usr/bin/perl

use DBI;
$dbh =DBI->connect("DBI:mysql:tc2000:localhost","root","");

$last_mon="2002-04-01";
$this_mon="2002-06-01";

$qry=qq|select order_id from vol_order_head 
        where so_date >= '$last_mon' order by order_id limit 0,1|;
$res=$dbh->prepare($qry);
$res->execute();
($oidl)=$res->fetchrow_array();

$qry=qq|select order_id from vol_order_head 
        where so_date < '$this_mon' order by order_id desc limit 0,1|;
$res=$dbh->prepare($qry);
$res->execute();
($oid)=$res->fetchrow_array();

$qry=qq|insert into his_invoice_head (invoice_id,iv_date,customer_id,remark) 
        select order_id,so_date,customer_id,remark from vol_order_head 
        where order_id <= '$oid' and order_id >= '$oidl' order by order_id|;
$res=$dbh->prepare($qry);
$res->execute();

$qry=qq|insert into his_invoice_line (invoice_id,order_line_id,product_name,product_spec,unit_price,qty,weight,status) 
        select order_id,order_line_id,product_name,product_unit_id,unit_price,qty,weight,t1.status from vol_order_line t1, vol_product t2 
        where t1.product_id=t2.product_id and order_id <= '$oid' and order_id >= '$oidl' order by order_line_id|;
$res=$dbh->prepare($qry);
$res->execute();

