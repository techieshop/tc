#!/usr/bin/perl

use DBI;
$dbh =DBI->connect("DBI:mysql:tc2000:localhost","root","");
($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst)=localtime(time);
$year+=1900;
$mon++;
if ($mon < 1) {
  $mon+=12;
  $year--;
}
$this_mon="$year-$mon-01";
$mon--;
if ($mon < 1) {
  $mon+=12;
  $year--;
}
$last_mon="$year-$mon-01";

$oid_str = '0';
$qry=qq|select vol_order_head.order_id from vol_order_head, vol_order_line 
       where so_date < '$this_mon' and status='102' and reserve_status != '100'
       and vol_order_line.order_id = vol_order_head.order_id 
       group by vol_order_head.order_id|;
$res=$dbh->prepare($qry);
$res->execute();
while ( ($oid)=$res->fetchrow_array() ) {
  $oid_str = $oid_str.','.$oid;
}

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

$qry=qq|insert into his_order_head select * from vol_order_head 
        where order_id <= '$oid' and order_id >= '$oidl'|;
$res=$dbh->prepare($qry);
$res->execute();

$qry=qq|insert into his_order_line select * from vol_order_line 
        where order_id <= '$oid' and order_id >= '$oidl'|;
$res=$dbh->prepare($qry);
$res->execute();

$qry=qq|delete from vol_order_head 
        where order_id <= '$oid' and order_id not in ($oid_str)|;
$res=$dbh->prepare($qry);
$res->execute();

$qry=qq|delete from vol_order_line 
        where order_id <= '$oid' and order_id not in ($oid_str)|;
$res=$dbh->prepare($qry);
$res->execute();
