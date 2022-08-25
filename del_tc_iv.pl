#!/usr/bin/perl

use DBI;
$dbh =DBI->connect("DBI:mysql:tc2000:localhost","root","");
($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst)=localtime(time);
$year+=1900;
#$mon-=1;
if ($mon < 1) {
  $mon+=12;
  $year--;
}
$last_mon="$year-$mon-$mday";

$qry=qq|select invoice_id from his_invoice_head 
        where iv_date < '$last_mon' and ar_status='120' 
        order by invoice_id desc limit 0,1|;
$res=$dbh->prepare($qry);
$res->execute();
($ivid)=$res->fetchrow_array();

$qry=qq|delete from his_invoice_head where invoice_id <= '$ivid'|;
$res=$dbh->prepare($qry);
$res->execute();

$qry=qq|delete from his_invoice_line where invoice_id <= '$ivid'|;
$res=$dbh->prepare($qry);
$res->execute();
