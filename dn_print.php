<?php

include("include/function.php");

if ($conn_db != 1) {
  $db = mysql_connect("localhost", "root");
  mysql_select_db("tc2000",$db);
  $conn_db = 1;
}

?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=Big5">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 9">
<meta name=Originator content="Microsoft Word 9">
<title>代出單</title>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>Fong</o:Author>
  <o:Template>Normal</o:Template>
  <o:LastAuthor>Fong</o:LastAuthor>
  <o:Revision>2</o:Revision>
  <o:TotalTime>8</o:TotalTime>
  <o:Created>2003-01-13T16:22:00Z</o:Created>
  <o:LastSaved>2003-01-13T16:22:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>97</o:Words>
  <o:Characters>554</o:Characters>
  <o:Lines>4</o:Lines>
  <o:Paragraphs>1</o:Paragraphs>
  <o:CharactersWithSpaces>680</o:CharactersWithSpaces>
  <o:Version>9.2812</o:Version>
 </o:DocumentProperties>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:View>Print</w:View>
  <w:Zoom>90</w:Zoom>
  <w:Compatibility>
   <w:UseFELayout/>
  </w:Compatibility>
  <w:DoNotOptimizeForBrowser/>
 </w:WordDocument>
</xml><![endif]-->
<style>
<!--
 /* Font Definitions */
@font-face
	{font-family:新細明體;
	panose-1:2 2 3 0 0 0 0 0 0 0;
	mso-font-alt:PMingLiU;
	mso-font-charset:136;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:1 134742016 16 0 1048576 0;}
@font-face
	{font-family:"\@新細明體";
	panose-1:2 2 3 0 0 0 0 0 0 0;
	mso-font-charset:136;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:1 134742016 16 0 1048576 0;}
@font-face
	{font-family:"Arial Narrow";
	panose-1:2 11 5 6 2 2 2 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:647 0 0 0 159 0;}
 /* Style Definitions */
p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:新細明體;
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";}
a:link, span.MsoHyperlink
	{color:black;
	text-decoration:underline;
	text-underline:single;}
a:visited, span.MsoHyperlinkFollowed
	{color:black;
	text-decoration:underline;
	text-underline:single;}
 /* Page Definitions */
@page
	{mso-page-border-surround-header:no;
	mso-page-border-surround-footer:no;}
@page Section1
	{size:419.6pt 21.0cm;
	margin:14.2pt 25.5pt 14.2pt 25.5pt;
	mso-header-margin:42.55pt;
	mso-footer-margin:49.6pt;
	mso-paper-source:0;}
div.Section1
	{page:Section1;}
-->
</style>
<!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="2050"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body bgcolor=white leftMargin=0 rightMargin=0 topMargin=0 bottomMargin=0 lang=ZH-TW link=black vlink=black style='tab-interval:24.0pt'>

<div class=Section1>

<?php
if (isset($dnid)) {
  $dnid1 = $dnid;
  $dnid2 = $dnid;
}
$dnid1 -= 0;
$dnid2 -= 0;
if ($dnid1 < 10001) {
  $dnid1 = 10001;
}
if ($dnid2 < 10001) {
  $dnid2 = 10001;
}
for ($dnid = $dnid1; $dnid <= $dnid2; $dnid++) {
  $query = "select customer_name,remark,dn_date from his_reserve_head,ntt_customer where reserve_id='$dnid' and ntt_customer.customer_id=his_reserve_head.customer_id";
  $result = mysql_query($query,$db);
  $myrow = mysql_fetch_array($result);
  $array1 = split("-", $myrow["dn_date"], 4);
?>
<p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span lang=EN-US><o:p></o:p></span></p>

<?php
  if ($dnid > $dnid1) {
?>
<span lang=EN-US style='font-size:12.0pt;font-family:新細明體;mso-hansi-font-family:
"Times New Roman";mso-bidi-font-family:"Times New Roman";mso-ansi-language:
EN-US;mso-fareast-language:ZH-TW;mso-bidi-language:AR-SA'><br clear=all
style='mso-special-character:line-break;page-break-before:always'>
</span>

<p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span lang=EN-US><o:p></o:p></span></p>

<?php
  }
?>
<table border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;
 mso-padding-alt:0cm 1.4pt 0cm 1.4pt'>
 <tr>
  <td width=77 style='width:58.0pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <table border=0 cellspacing=0 cellpadding=0 width="48%" style='width:48.96%;
   mso-cellspacing:0cm;margin-left:17.6pt;mso-padding-alt:0cm 0cm 0cm 0cm'>
   <tr style='height:17.0pt;mso-height-rule:exactly'>
    <td width="100%" style='width:100.0%;border:none;border-bottom:solid windowtext .5pt;
    padding:0cm 0cm 0cm 0cm;height:17.0pt;mso-height-rule:exactly'>
    <p class=MsoNormal align=center style='text-align:center'>專<span
    lang=EN-US style='font-family:"Times New Roman";mso-ascii-font-family:新細明體'>&nbsp;&nbsp;</span>營</p>
    </td>
   </tr>
   <tr>
    <td width="100%" style='width:100.0%;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal align=center style='text-align:center'>環<span
    lang=EN-US style='font-family:"Times New Roman";mso-ascii-font-family:新細明體'>&nbsp;&nbsp;</span>零</p>
    </td>
   </tr>
   <tr>
    <td width="100%" style='width:100.0%;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal align=center style='text-align:center'>球<span
    lang=EN-US style='font-family:"Times New Roman";mso-ascii-font-family:新細明體'>&nbsp;&nbsp;</span>沽</p>
    </td>
   </tr>
   <tr>
    <td width="100%" style='width:100.0%;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal align=center style='text-align:center'>凍<span
    lang=EN-US style='font-family:"Times New Roman";mso-ascii-font-family:新細明體'>&nbsp;&nbsp;</span>批</p>
    </td>
   </tr>
   <tr>
    <td width="100%" style='width:100.0%;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal align=center style='text-align:center'>肉<span
    lang=EN-US style='font-family:"Times New Roman";mso-ascii-font-family:新細明體'>&nbsp;&nbsp;</span>發</p>
    </td>
   </tr>
  </table>
  <p class=MsoNormal><span lang=EN-US><o:p></o:p></span></p>
  </td>
  <td width=359 style='width:269.2pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <table border=0 cellspacing=0 cellpadding=0 width=351 style='width:263.6pt;
   mso-cellspacing:0cm;mso-padding-alt:0cm 0cm 0cm 0cm'>
   <tr>
    <td width="100%" style='width:100.0%;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal align=center style='text-align:center'><b><span
    style='font-size:18.0pt;letter-spacing:18.0pt'>泰昌肉食公司</span></b><span
    lang=EN-US style='letter-spacing:18.0pt'><o:p></o:p></span></p>
    </td>
   </tr>
   <tr>
    <td width="100%" style='width:100.0%;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal align=center style='text-align:center'><b><span
    lang=EN-US style='font-size:18.0pt'>TAI </span></b><b><span lang=EN-US
    style='font-size:18.0pt;font-family:"Times New Roman";mso-ascii-font-family:
    新細明體'>&nbsp;&nbsp;</span></b><b><span lang=EN-US style='font-size:18.0pt'>CHEONG
    </span></b><b><span lang=EN-US style='font-size:18.0pt;font-family:"Times New Roman";
    mso-ascii-font-family:新細明體'>&nbsp;&nbsp;</span></b><b><span lang=EN-US
    style='font-size:18.0pt'>MEAT </span></b><b><span lang=EN-US
    style='font-size:18.0pt;font-family:"Times New Roman";mso-ascii-font-family:
    新細明體'>&nbsp;&nbsp;</span></b><b><span lang=EN-US style='font-size:18.0pt'>CO.</span></b></p>
    </td>
   </tr>
   <tr>
    <td width="100%" style='width:100.0%;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal align=center style='text-align:center'>九龍基隆街<span
    lang=EN-US>83-85號地下</span></p>
    </td>
   </tr>
   <tr>
    <td width="100%" style='width:100.0%;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal align=center style='text-align:center'><span lang=EN-US
    style='font-size:10.0pt'>G/F., No. 83-85 Ki Lung Street, Kowloon.</span></p>
    </td>
   </tr>
   <tr>
    <td width="100%" style='width:100.0%;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal align=center style='text-align:center'><span lang=EN-US
    style='font-size:10.0pt'>TEL: 2381 8751, 2397 6100 </span><span lang=EN-US
    style='font-size:10.0pt;font-family:"Times New Roman";mso-ascii-font-family:
    新細明體'>&nbsp;&nbsp;</span><span lang=EN-US style='font-size:10.0pt'>FAX:
    2381 8817</span></p>
    </td>
   </tr>
  </table>
  <p class=MsoNormal><span lang=EN-US><o:p></o:p></span></p>
  </td>
  <td width=59 style='width:44.2pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US><o:p></o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span lang=EN-US><![if !supportEmptyParas]>&nbsp;<![endif]><o:p></o:p></span></p>

<table border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;
 mso-padding-alt:0cm 1.4pt 0cm 1.4pt'>
 <tr>
  <td width=206 style='width:154.4pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US><o:p></o:p></span></p>
  </td>
  <td width=96 style='width:72.0pt;border:none;border-bottom:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:13.5pt'>代 </span></b><b><span lang=EN-US style='font-size:
  13.5pt;font-family:"Times New Roman";mso-ascii-font-family:新細明體'>&nbsp;&nbsp;</span></b><b><span
  style='font-size:13.5pt'>出 </span></b><b><span lang=EN-US style='font-size:
  13.5pt;font-family:"Times New Roman";mso-ascii-font-family:新細明體'>&nbsp;&nbsp;</span></b><b><span
  style='font-size:13.5pt'>單</span></b></p>
  </td>
  <td width=115 style='width:86.3pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=EN-US
  style='font-size:13.5pt'>No. </span></b></p>
  </td>
  <td width=60 style='width:44.65pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=EN-US
  style='font-size:13.5pt'><?php echo $dnid ?></span></b></p>
  </td>
  <td width=19 style='width:14.05pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US><o:p></o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span lang=EN-US><![if !supportEmptyParas]>&nbsp;<![endif]><o:p></o:p></span></p>

<table border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;
 mso-padding-alt:0cm 1.4pt 0cm 1.4pt'>
 <tr>
  <td width=158 valign=bottom style='width:118.4pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:13.5pt'><?php echo $myrow["customer_name"] ?></span></b></p>
  </td>
  <td width=40 valign=bottom style='width:30.1pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph'>寶號</p>
  </td>
  <td width=99 valign=bottom style='width:74.4pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:13.5pt'><?php echo $myrow["remark"] ?></span></b></p>
  </td>
  <td width=185 valign=bottom style='width:138.5pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=EN-US><?php echo $array1[0] ?></span></b>年<b><span
  lang=EN-US><?php echo $array1[1] ?></span></b>月<b><span lang=EN-US><?php echo $array1[2] ?></span></b>日</p>
  </td>
  <td width=20 style='width:15.05pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US><o:p></o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span lang=EN-US style='font-size:8.0pt;mso-bidi-font-size:
12.0pt;mso-hansi-font-family:"Arial Narrow";mso-bidi-font-family:"Courier New"'><![if !supportEmptyParas]>&nbsp;<![endif]><o:p></o:p></span></p>

<table border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;
 mso-padding-alt:0cm 1.4pt 0cm 1.4pt'>
 <tr>
  <td width=149 valign=bottom style='width:111.4pt;border:none;border-top:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=center style='text-align:center;line-height:11.25pt'><span
  style='font-size:10.0pt'>貨 </span><span lang=EN-US style='font-size:10.0pt;
  font-family:"Times New Roman";mso-ascii-font-family:新細明體'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='font-size:10.0pt'>品</span></p>
  </td>
  <td width=40 valign=bottom style='width:29.75pt;border:none;border-top:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right;line-height:11.25pt'><span
  style='font-size:10.0pt'>件數</span></p>
  </td>
  <td width=89 valign=bottom style='width:66.9pt;border:none;border-top:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right;line-height:11.25pt'><span
  style='font-size:10.0pt'>重 </span><span lang=EN-US style='font-size:10.0pt;
  font-family:"Times New Roman";mso-ascii-font-family:新細明體'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='font-size:10.0pt'>量</span></p>
  </td>
  <td width=99 valign=bottom style='width:74.55pt;border:none;border-top:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right;line-height:11.25pt'><span
  style='font-size:10.0pt'>單 </span><span lang=EN-US style='font-size:10.0pt;
  font-family:"Times New Roman";mso-ascii-font-family:新細明體'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='font-size:10.0pt'>價</span></p>
  </td>
  <td width=100 valign=bottom style='width:74.85pt;border:none;border-top:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right;line-height:11.25pt'><span
  style='font-size:10.0pt'>金 </span><span lang=EN-US style='font-size:10.0pt;
  font-family:"Times New Roman";mso-ascii-font-family:新細明體'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='font-size:10.0pt'>額</span></p>
  </td>
  <td width=20 style='width:15.05pt;border:none;border-top:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US style='font-size:10.0pt;font-family:"Times New Roman"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr>
  <td width=149 style='width:111.4pt;border:none;border-bottom:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=center style='text-align:center;line-height:11.25pt'><span
  lang=EN-US style='font-size:10.0pt'>DESCRIPTION</span></p>
  </td>
  <td width=40 style='width:29.75pt;border:none;border-bottom:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right;line-height:11.25pt'><span
  lang=EN-US style='font-size:10.0pt'>QTY</span></p>
  </td>
  <td width=89 style='width:66.9pt;border:none;border-bottom:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right;line-height:11.25pt'><span
  lang=EN-US style='font-size:10.0pt'>WEIGHT</span></p>
  </td>
  <td width=99 style='width:74.55pt;border:none;border-bottom:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right;line-height:11.25pt'><span
  lang=EN-US style='font-size:10.0pt'>UNIT PRICE</span></p>
  </td>
  <td width=100 style='width:74.85pt;border:none;border-bottom:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right;line-height:11.25pt'><span
  lang=EN-US style='font-size:10.0pt'>AMOUNT</span></p>
  </td>
  <td width=20 style='width:15.05pt;border:none;border-bottom:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US style='font-size:10.0pt;font-family:"Times New Roman"'><o:p></o:p></span></p>
  </td>
 </tr>
<?php
  $mod_no = 0;
  $query = "select his_reserve_line.*,product_name,product_unit_id from his_reserve_line,vol_product where reserve_id='$dnid' and his_reserve_line.status != '117' and vol_product.product_id=his_reserve_line.product_id";
  $result = mysql_query($query,$db);
  while ($row = mysql_fetch_array($result)) {
    $mod_no++;
?>
 <tr style='height:24.1pt'>
  <td width=149 style='width:111.4pt;padding:0cm 1.4pt 0cm 1.4pt;height:24.1pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><?php echo $row["product_name"] ?></b></p>
  </td>
  <td width=40 style='width:29.75pt;padding:0cm 1.4pt 0cm 1.4pt;height:24.1pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=EN-US><?php if ($row["qty"] != 0) {echo $row["qty"]-0;} ?></span></b></p>
  </td>
  <td width=89 style='width:66.9pt;padding:0cm 1.4pt 0cm 1.4pt;height:24.1pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=EN-US><?php echo ($row["weight"]-0).$row["product_unit_id"] ?></span></b></p>
  </td>
  <td width=99 style='width:74.55pt;padding:0cm 1.4pt 0cm 1.4pt;height:24.1pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=EN-US></span></b></p>
  </td>
  <td width=100 style='width:74.85pt;padding:0cm 1.4pt 0cm 1.4pt;height:24.1pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=EN-US></span></b></p>
  </td>
  <td width=20 style='width:15.05pt;padding:0cm 1.4pt 0cm 1.4pt;height:24.1pt'>
  <p class=MsoNormal align=right style='text-align:right'><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US><o:p></o:p></span></p>
  </td>
 </tr>
<?php
  } // while ($row = mysql_fetch_array($result)) {
  for ($i = 0; $i < (12-$mod_no); $i++) {
?>
 <tr style='height:24.1pt'>
  <td width=149 style='width:111.4pt;padding:0cm 1.4pt 0cm 1.4pt;height:24.1pt'>
  <p class=MsoNormal align=center style='text-align:center'><b></b></p>
  </td>
  <td width=40 style='width:29.75pt;padding:0cm 1.4pt 0cm 1.4pt;height:24.1pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=EN-US></span></b></p>
  </td>
  <td width=89 style='width:66.9pt;padding:0cm 1.4pt 0cm 1.4pt;height:24.1pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=EN-US></span></b></p>
  </td>
  <td width=99 style='width:74.55pt;padding:0cm 1.4pt 0cm 1.4pt;height:24.1pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=EN-US></span></b></p>
  </td>
  <td width=100 style='width:74.85pt;padding:0cm 1.4pt 0cm 1.4pt;height:24.1pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=EN-US></span></b></p>
  </td>
  <td width=20 style='width:15.05pt;padding:0cm 1.4pt 0cm 1.4pt;height:24.1pt'>
  <p class=MsoNormal align=right style='text-align:right'><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US><o:p></o:p></span></p>
  </td>
 </tr>
<?php
  } // for ($i = 0; $i < (12-$mod_no); $i++) {
?>
 <tr>
  <td width=149 style='width:111.4pt;border:none;border-top:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US><o:p></o:p></span></p>
  </td>
  <td width=40 style='width:29.75pt;border:none;border-top:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US><o:p></o:p></span></p>
  </td>
  <td width=89 style='width:66.9pt;border:none;border-top:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US><o:p></o:p></span></p>
  </td>
  <td width=99 valign=bottom style='width:74.55pt;border:none;border-top:
  solid windowtext .5pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right;line-height:11.25pt'><span
  style='font-size:10.0pt'>合 </span><span lang=EN-US style='font-size:10.0pt;
  font-family:"Times New Roman";mso-ascii-font-family:新細明體'>&nbsp;&nbsp;&nbsp;</span><span
  style='font-size:10.0pt'>計</span></p>
  </td>
  <td width=100 style='width:74.85pt;border:none;border-top:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US style='font-size:10.0pt;font-family:"Times New Roman"'><o:p></o:p></span></p>
  </td>
  <td width=20 style='width:15.05pt;border:none;border-top:solid windowtext .5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US style='font-size:10.0pt;font-family:"Times New Roman"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr>
  <td width=149 style='width:111.4pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US><o:p></o:p></span></p>
  </td>
  <td width=40 style='width:29.75pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US><o:p></o:p></span></p>
  </td>
  <td width=89 style='width:66.9pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US><o:p></o:p></span></p>
  </td>
  <td width=99 style='width:74.55pt;padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right;line-height:11.25pt'><span
  lang=EN-US style='font-size:10.0pt'>TOTAL</span></p>
  </td>
  <td width=100 style='width:74.85pt;border:none;border-bottom:double windowtext 1.5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal align=right style='text-align:right;mso-line-height-alt:
  11.25pt'><b><span lang=EN-US></span></b></p>
  </td>
  <td width=20 style='width:15.05pt;border:none;border-bottom:double windowtext 1.5pt;
  padding:0cm 1.4pt 0cm 1.4pt'>
  <p class=MsoNormal><![if !supportEmptyParas]>&nbsp;<![endif]><span
  lang=EN-US style='font-size:10.0pt;font-family:"Times New Roman"'><o:p></o:p></span></p>
  </td>
 </tr>
</table>
<?php
} // for ($dnid = $dnid1; $dnid <= $dnid2; $dnid++) {
?>

</div>

</body>

</html>
<?php
  mysql_close($db);
?>
