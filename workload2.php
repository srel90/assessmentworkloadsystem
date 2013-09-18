<?php
session_start();
require_once('MySQL.class.php');
$database= new database();
if(!isset($_SESSION['users'])||empty($_SESSION['users'])){header("location:index.php");}else{
$role=$database->checkrole($_SESSION['users'][0]['userTypeID'],$_SERVER['PHP_SELF']);
if($role==0)header("location:nopermission.php");}


$workloadID=$_GET['workloadID'];
$strsql="SELECT w.*,u.*,f.faculty FROM workload w 
LEFT OUTER JOIN users u ON w.userID=u.userID 
LEFT OUTER JOIN faculty f ON w.facultyID=f.facultyID 
WHERE workloadID='".$workloadID."'";
$workload=$database->query($strsql);
$strsql="SELECT * FROM teachingworkgroup WHERE teachingWorkgroupWorkloadID='".$workloadID."'";
$teachingworkgroup=$database->query($strsql);
$strsql="SELECT * FROM researchingworkgroup WHERE researchingWorkgroupWorkloadID='".$workloadID."'";
$researchingworkgroup=$database->query($strsql);
$strsql="SELECT * FROM servicesworkgroup WHERE servicesWorkgroupWorkloadID='".$workloadID."'";
$servicesworkgroup=$database->query($strsql);
$strsql="SELECT * FROM otherworkgroup WHERE otherWorkgroupWorkloadID='".$workloadID."'";
$otherworkgroup=$database->query($strsql);
$totalhour=0;
$totalhour+=$workload[0]['teachingWorkgroupAgrHours'];
$totalhour+=$workload[0]['researchingWorkgroupAgrHours'];
$totalhour+=$workload[0]['servicesWorkgroupAgrHours'];
$totalhour+=$workload[0]['otherWorkgroupAgrHours'];
$totalproportion=0;
$totalproportion+=$workload[0]['teachingWorkgroupAgrProportion'];
$totalproportion+=$workload[0]['researchingWorkgroupAgrProportion'];
$totalproportion+=$workload[0]['servicesWorkgroupAgrProportion'];
$totalproportion+=$workload[0]['otherWorkgroupAgrProportion'];
$type1=0;
foreach($teachingworkgroup as $item){
if($item['teachingWorkgroupType']==1){
	$type1++;
}
}

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=workload2.doc");
function convdate($date) {
    $MONTH = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $dt = explode("-", $date);
    $tyear = $dt[0];
    $dt[0] = $dt[2] +0;
    $dt[1] = $MONTH[$dt[1]+0];
    $dt[2] = $tyear+543;
    return join(" ", $dt);
}
function calcutateAge($dob){

        $dob = date("Y-m-d",strtotime($dob));

        $dobObject = new DateTime($dob);
        $nowObject = new DateTime();

        $diff = $dobObject->diff($nowObject);

        return $diff->y;
}
?>

<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 15">
<meta name=Originator content="Microsoft Word 15">
<link rel=File-List href="workload2_files/filelist.xml">
<title>แบบติดตามตรวจสอบและประเมินผลการปฏิบัติงานของพนักงานมหาวิทยาลัย 
สายวิชาการ  [ภวช]</title>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>iLLuSioN</o:Author>
  <o:LastAuthor>lers90@hotmail.com</o:LastAuthor>
  <o:Revision>2</o:Revision>
  <o:TotalTime>44</o:TotalTime>
  <o:LastPrinted>2010-09-06T02:59:00Z</o:LastPrinted>
  <o:Created>2013-09-12T05:06:00Z</o:Created>
  <o:LastSaved>2013-09-12T05:06:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>2002</o:Words>
  <o:Characters>11416</o:Characters>
  <o:Company>Microsoft Corporation</o:Company>
  <o:Lines>95</o:Lines>
  <o:Paragraphs>26</o:Paragraphs>
  <o:CharactersWithSpaces>13392</o:CharactersWithSpaces>
  <o:Version>15.00</o:Version>
 </o:DocumentProperties>
 <o:OfficeDocumentSettings>
  <o:TargetScreenSize>800x600</o:TargetScreenSize>
 </o:OfficeDocumentSettings>
</xml><![endif]-->
<link rel=themeData href="workload2_files/themedata.thmx">
<link rel=colorSchemeMapping href="workload2_files/colorschememapping.xml">
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:PunctuationKerning/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF/>
  <w:LidThemeOther>EN-US</w:LidThemeOther>
  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>
  <w:LidThemeComplexScript>TH</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:ApplyBreakingRules/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
   <w:SplitPgBreakAndParaMark/>
   <w:EnableOpenTypeKerning/>
   <w:DontFlipMirrorIndents/>
   <w:OverrideTableStyleHps/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
  <m:mathPr>
   <m:mathFont m:val="Cambria Math"/>
   <m:brkBin m:val="before"/>
   <m:brkBinSub m:val="&#45;-"/>
   <m:smallFrac m:val="off"/>
   <m:dispDef/>
   <m:lMargin m:val="0"/>
   <m:rMargin m:val="0"/>
   <m:defJc m:val="centerGroup"/>
   <m:wrapIndent m:val="1440"/>
   <m:intLim m:val="subSup"/>
   <m:naryLim m:val="undOvr"/>
  </m:mathPr></w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="false"
  DefSemiHidden="false" DefQFormat="false" LatentStyleCount="371">
  <w:LsdException Locked="false" QFormat="true" Name="Normal"/>
  <w:LsdException Locked="false" QFormat="true" Name="heading 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 9"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="caption"/>
  <w:LsdException Locked="false" QFormat="true" Name="Title"/>
  <w:LsdException Locked="false" QFormat="true" Name="Subtitle"/>
  <w:LsdException Locked="false" QFormat="true" Name="Strong"/>
  <w:LsdException Locked="false" QFormat="true" Name="Emphasis"/>
  <w:LsdException Locked="false" Priority="99" SemiHidden="true"
   Name="Placeholder Text"/>
  <w:LsdException Locked="false" Priority="1" QFormat="true" Name="No Spacing"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 1"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="99" SemiHidden="true" Name="Revision"/>
  <w:LsdException Locked="false" Priority="34" QFormat="true"
   Name="List Paragraph"/>
  <w:LsdException Locked="false" Priority="29" QFormat="true" Name="Quote"/>
  <w:LsdException Locked="false" Priority="30" QFormat="true"
   Name="Intense Quote"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 1"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 1"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 2"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 2"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 2"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 3"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 3"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 3"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 4"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 4"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 4"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 5"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 5"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 5"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 6"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 6"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 6"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="19" QFormat="true"
   Name="Subtle Emphasis"/>
  <w:LsdException Locked="false" Priority="21" QFormat="true"
   Name="Intense Emphasis"/>
  <w:LsdException Locked="false" Priority="31" QFormat="true"
   Name="Subtle Reference"/>
  <w:LsdException Locked="false" Priority="32" QFormat="true"
   Name="Intense Reference"/>
  <w:LsdException Locked="false" Priority="33" QFormat="true" Name="Book Title"/>
  <w:LsdException Locked="false" Priority="37" SemiHidden="true"
   UnhideWhenUsed="true" Name="Bibliography"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="TOC Heading"/>
  <w:LsdException Locked="false" Priority="41" Name="Plain Table 1"/>
  <w:LsdException Locked="false" Priority="42" Name="Plain Table 2"/>
  <w:LsdException Locked="false" Priority="43" Name="Plain Table 3"/>
  <w:LsdException Locked="false" Priority="44" Name="Plain Table 4"/>
  <w:LsdException Locked="false" Priority="45" Name="Plain Table 5"/>
  <w:LsdException Locked="false" Priority="40" Name="Grid Table Light"/>
  <w:LsdException Locked="false" Priority="46" Name="Grid Table 1 Light"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark"/>
  <w:LsdException Locked="false" Priority="51" Name="Grid Table 6 Colorful"/>
  <w:LsdException Locked="false" Priority="52" Name="Grid Table 7 Colorful"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 1"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 1"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 1"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 2"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 2"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 2"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 3"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 3"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 3"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 4"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 4"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 4"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 5"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 5"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 5"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 6"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 6"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 6"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="46" Name="List Table 1 Light"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark"/>
  <w:LsdException Locked="false" Priority="51" Name="List Table 6 Colorful"/>
  <w:LsdException Locked="false" Priority="52" Name="List Table 7 Colorful"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 1"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 1"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 1"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 2"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 2"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 2"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 3"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 3"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 3"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 4"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 4"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 4"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 5"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 5"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 5"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 6"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 6"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 6"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 6"/>
 </w:LatentStyles>
</xml><![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;
	mso-font-charset:2;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:0 268435456 0 0 -2147483648 0;}
@font-face
	{font-family:Batang;
	panose-1:2 3 6 0 0 1 1 1 1 1;
	mso-font-alt:\BC14\D0D5;
	mso-font-charset:129;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-1342176593 1775729915 48 0 524447 0;}
@font-face
	{font-family:"Angsana New";
	panose-1:2 2 6 3 5 4 5 2 3 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-2130706429 0 0 0 65537 0;}
@font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-536870145 1107305727 0 0 415 0;}
@font-face
	{font-family:AngsanaUPC;
	panose-1:2 2 6 3 5 4 5 2 3 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-2130706429 0 0 0 65537 0;}
@font-face
	{font-family:"Wingdings 2";
	panose-1:5 2 1 2 1 5 7 7 7 7;
	mso-font-charset:2;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:0 268435456 0 0 -2147483648 0;}
@font-face
	{font-family:"\@Batang";
	panose-1:2 3 6 0 0 1 1 1 1 1;
	mso-font-charset:129;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-1342176593 1775729915 48 0 524447 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:Batang;
	mso-bidi-font-family:"Angsana New";
	mso-fareast-language:KO;}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-unhide:no;
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 207.65pt right 415.3pt;
	font-size:12.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:Batang;
	mso-bidi-font-family:"Angsana New";
	mso-fareast-language:KO;}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{mso-style-unhide:no;
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 207.65pt right 415.3pt;
	font-size:12.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:Batang;
	mso-bidi-font-family:"Angsana New";
	mso-fareast-language:KO;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	font-size:10.0pt;
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	mso-bidi-font-family:"Angsana New";}
 /* Page Definitions */
 @page
	{mso-footnote-separator:url("http://localhost/assessmentworkloadsystem/workload2_files/header.htm") fs;
	mso-footnote-continuation-separator:url("http://localhost/assessmentworkloadsystem/workload2_files/header.htm") fcs;
	mso-endnote-separator:url("http://localhost/assessmentworkloadsystem/workload2_files/header.htm") es;
	mso-endnote-continuation-separator:url("http://localhost/assessmentworkloadsystem/workload2_files/header.htm") ecs;}
@page WordSection1
	{size:595.3pt 841.9pt;
	margin:56.7pt 64.35pt 56.7pt 89.85pt;
	mso-header-margin:35.45pt;
	mso-footer-margin:35.45pt;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 @list l0
	{mso-list-id:544290038;
	mso-list-type:hybrid;
	mso-list-template-ids:-128296328 405731702 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l0:level1
	{mso-level-text:"%1\)";
	mso-level-tab-stop:.5in;
	mso-level-number-position:left;
	text-indent:-.25in;
	mso-ansi-font-size:14.0pt;
	font-family:"Angsana New","serif";}
@list l0:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:1.5in;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l0:level4
	{mso-level-tab-stop:2.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:3.0in;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l0:level7
	{mso-level-tab-stop:3.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:4.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:4.5in;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l1
	{mso-list-id:870342692;
	mso-list-type:hybrid;
	mso-list-template-ids:-1962404544 -726899554 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l1:level1
	{mso-level-tab-stop:.5in;
	mso-level-number-position:left;
	text-indent:-.25in;
	mso-ansi-font-size:14.0pt;}
@list l1:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:1.5in;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l1:level4
	{mso-level-tab-stop:2.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:3.0in;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l1:level7
	{mso-level-tab-stop:3.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:4.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:4.5in;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l2
	{mso-list-id:927076141;
	mso-list-type:hybrid;
	mso-list-template-ids:-940037334 -1012889188 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l2:level1
	{mso-level-tab-stop:.75in;
	mso-level-number-position:left;
	margin-left:.75in;
	text-indent:-.25in;}
@list l2:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:1.25in;
	mso-level-number-position:left;
	margin-left:1.25in;
	text-indent:-.25in;}
@list l2:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:1.75in;
	mso-level-number-position:right;
	margin-left:1.75in;
	text-indent:-9.0pt;}
@list l2:level4
	{mso-level-tab-stop:2.25in;
	mso-level-number-position:left;
	margin-left:2.25in;
	text-indent:-.25in;}
@list l2:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:2.75in;
	mso-level-number-position:left;
	margin-left:2.75in;
	text-indent:-.25in;}
@list l2:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:3.25in;
	mso-level-number-position:right;
	margin-left:3.25in;
	text-indent:-9.0pt;}
@list l2:level7
	{mso-level-tab-stop:3.75in;
	mso-level-number-position:left;
	margin-left:3.75in;
	text-indent:-.25in;}
@list l2:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:4.25in;
	mso-level-number-position:left;
	margin-left:4.25in;
	text-indent:-.25in;}
@list l2:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:4.75in;
	mso-level-number-position:right;
	margin-left:4.75in;
	text-indent:-9.0pt;}
@list l3
	{mso-list-id:1325012871;
	mso-list-type:hybrid;
	mso-list-template-ids:1324254212 615418926 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l3:level1
	{mso-level-tab-stop:.75in;
	mso-level-number-position:left;
	margin-left:.75in;
	text-indent:-.25in;}
@list l3:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:1.25in;
	mso-level-number-position:left;
	margin-left:1.25in;
	text-indent:-.25in;}
@list l3:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:1.75in;
	mso-level-number-position:right;
	margin-left:1.75in;
	text-indent:-9.0pt;}
@list l3:level4
	{mso-level-tab-stop:2.25in;
	mso-level-number-position:left;
	margin-left:2.25in;
	text-indent:-.25in;}
@list l3:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:2.75in;
	mso-level-number-position:left;
	margin-left:2.75in;
	text-indent:-.25in;}
@list l3:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:3.25in;
	mso-level-number-position:right;
	margin-left:3.25in;
	text-indent:-9.0pt;}
@list l3:level7
	{mso-level-tab-stop:3.75in;
	mso-level-number-position:left;
	margin-left:3.75in;
	text-indent:-.25in;}
@list l3:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:4.25in;
	mso-level-number-position:left;
	margin-left:4.25in;
	text-indent:-.25in;}
@list l3:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:4.75in;
	mso-level-number-position:right;
	margin-left:4.75in;
	text-indent:-9.0pt;}
@list l4
	{mso-list-id:1407069982;
	mso-list-type:hybrid;
	mso-list-template-ids:2028078984 67698689 67698691 67698693 67698689 67698691 67698693 67698689 67698691 67698693;}
@list l4:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:.5in;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l4:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";
	mso-bidi-font-family:"Times New Roman";}
@list l4:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:1.5in;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l4:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:2.0in;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l4:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";
	mso-bidi-font-family:"Times New Roman";}
@list l4:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:3.0in;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l4:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:3.5in;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l4:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:4.0in;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";
	mso-bidi-font-family:"Times New Roman";}
@list l4:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:4.5in;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l5
	{mso-list-id:1685786259;
	mso-list-type:hybrid;
	mso-list-template-ids:-1281165470 496930998 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l5:level1
	{mso-level-text:"%1\)";
	mso-level-tab-stop:.75in;
	mso-level-number-position:left;
	margin-left:.75in;
	text-indent:-.25in;
	mso-ansi-font-size:14.0pt;
	mso-bidi-font-size:14.0pt;}
@list l5:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:1.25in;
	mso-level-number-position:left;
	margin-left:1.25in;
	text-indent:-.25in;}
@list l5:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:1.75in;
	mso-level-number-position:right;
	margin-left:1.75in;
	text-indent:-9.0pt;}
@list l5:level4
	{mso-level-tab-stop:2.25in;
	mso-level-number-position:left;
	margin-left:2.25in;
	text-indent:-.25in;}
@list l5:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:2.75in;
	mso-level-number-position:left;
	margin-left:2.75in;
	text-indent:-.25in;}
@list l5:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:3.25in;
	mso-level-number-position:right;
	margin-left:3.25in;
	text-indent:-9.0pt;}
@list l5:level7
	{mso-level-tab-stop:3.75in;
	mso-level-number-position:left;
	margin-left:3.75in;
	text-indent:-.25in;}
@list l5:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:4.25in;
	mso-level-number-position:left;
	margin-left:4.25in;
	text-indent:-.25in;}
@list l5:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:4.75in;
	mso-level-number-position:right;
	margin-left:4.75in;
	text-indent:-9.0pt;}
@list l6
	{mso-list-id:1724403041;
	mso-list-type:hybrid;
	mso-list-template-ids:614886676 -1759883948 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l6:level1
	{mso-level-tab-stop:.75in;
	mso-level-number-position:left;
	margin-left:.75in;
	text-indent:-.25in;
	mso-ansi-font-size:14.0pt;
	mso-ansi-font-weight:normal;}
@list l6:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:1.25in;
	mso-level-number-position:left;
	margin-left:1.25in;
	text-indent:-.25in;}
@list l6:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:1.75in;
	mso-level-number-position:right;
	margin-left:1.75in;
	text-indent:-9.0pt;}
@list l6:level4
	{mso-level-tab-stop:2.25in;
	mso-level-number-position:left;
	margin-left:2.25in;
	text-indent:-.25in;}
@list l6:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:2.75in;
	mso-level-number-position:left;
	margin-left:2.75in;
	text-indent:-.25in;}
@list l6:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:3.25in;
	mso-level-number-position:right;
	margin-left:3.25in;
	text-indent:-9.0pt;}
@list l6:level7
	{mso-level-tab-stop:3.75in;
	mso-level-number-position:left;
	margin-left:3.75in;
	text-indent:-.25in;}
@list l6:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:4.25in;
	mso-level-number-position:left;
	margin-left:4.25in;
	text-indent:-.25in;}
@list l6:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:4.75in;
	mso-level-number-position:right;
	margin-left:4.75in;
	text-indent:-9.0pt;}
ol
	{margin-bottom:0in;}
ul
	{margin-bottom:0in;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Table Normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-para-margin:0in;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";
	mso-bidi-font-family:"Angsana New";}
table.MsoTableGrid
	{mso-style-name:"Table Grid";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:Batang;
	mso-bidi-font-family:"Angsana New";}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="1026"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=EN-US style='tab-interval:.5in'>

<div class=WordSection1>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=642
 style='width:481.5pt;border-collapse:collapse;border:none;mso-yfti-tbllook:
 1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:
 none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:16.0pt;font-family:"AngsanaUPC","serif"'>แบบติดตามตรวจสอบและประเมินผลการปฏิบัติงาน</span></b><b><span
  style='font-size:16.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:16.0pt;font-family:"AngsanaUPC","serif"'>ของพนักงานมหาวิทยาลัย
  สายวิชาการ (ภวช.2)<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:16.0pt;font-family:"AngsanaUPC","serif"'>ประจำปีงบประมาณ...........................<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:16.0pt;font-family:"AngsanaUPC","serif"'>คำชี้แจง</span></b><b><span
  style='font-size:16.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-cluster'><b><span
  lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>1.<span
  style='mso-spacerun:yes'>&nbsp; </span>ผู้รับการประเมิน </span></b><span
  lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ได้แก่<span
  style='mso-spacerun:yes'>&nbsp; </span>พนักงานมหาวิทยาลัยสายวิชาการ</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-cluster'><b><span
  lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>2.<span
  style='mso-spacerun:yes'>&nbsp; </span>ผู้ประเมิน</span></b><span lang=TH
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'> ได้แก่<span
  style='mso-spacerun:yes'>&nbsp; </span>ผู้กำกับดูแล/ผู้ติดตามตรวจสอบประเมินเบื้องต้น,<span
  style='letter-spacing:-1.0pt'>คณะกรรมการประเมินระดับคณะ</span>,<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span></span><span style='font-size:
  15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-cluster'><span
  lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;
  </span>คณะกรรมการประเมินระดับมหาวิทยาลัย </span><span style='font-size:15.0pt;
  font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-cluster'><b><span
  lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>3.<span
  style='mso-spacerun:yes'>&nbsp; </span>การกรอกข้อมูล<span
  style='mso-spacerun:yes'>&nbsp; </span></span></b><span lang=TH
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ผู้รับการประเมินกรอก<span
  style='letter-spacing:-1.0pt'>ข้อมูลในแบบติดตามตรวจสอบและ</span>ประเมินผลการปฏิบัติงาน</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-cluster'><span
  lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span>ของพนักงานมหาวิทยาลัยสายวิชาการ</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>4.<span
  style='mso-spacerun:yes'>&nbsp; </span>วิธีติดตามตรวจสอบและประเมิน</span></b><b><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  lang=TH>4.1 ผู้รับการติดตามตรวจสอบและประเมิน กรอกข้อมูลเชิงปริมาณลงในแบบติดตามตรวจสอบ</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>และประเมินผลการปฏิบัติงาน (ภวช.2)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  lang=TH>4.2 ผู้กำกับดูแล/ผู้ติดตามตรวจสอบและประเมินเบื้องต้น<span
  style='mso-spacerun:yes'>&nbsp; </span>ตรวจสอบความถูกต้อง</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>ของข้อมูลเชิงปริมาณ <span style='mso-spacerun:yes'>&nbsp;</span>ประเมินเชิงคุณภาพ<span
  style='mso-spacerun:yes'>&nbsp;
  </span>และประเมินผลการปฏิบัติงานตามแบบติดตาม<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>ตรวจสอบและประเมินผลการปฏิบัติงานของพนักงานมหาวิทยาลัยสายวิชาการ</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:16'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  lang=TH>4. 3 ผู้รับการติดตามตรวจสอบและประเมิน<span
  style='mso-spacerun:yes'>&nbsp; </span>รับทราบผลการติดตามตรวจสอบและประเมิน</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:17'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='mso-spacerun:yes'>&nbsp;</span><span lang=TH>ของผู้กำกับดูแล/ผู้ติดตามตรวจสอบและประเมินเบื้องต้น
  </span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:18'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>4.<span
  lang=TH>4 คณบดี หรือผู้ที่คณบดีมอบหมาย ติดตามตรวจสอบและประเมินข้อตกลงเพิ่มเติม
  (ระดับคณะ)<o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:19'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  lang=TH>4.5 ผู้รับการติดตามตรวจสอบและประเมินรับทราบผลการติดตามตรวจสอบและประเมิน</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:20'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='mso-spacerun:yes'>&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;</span><span lang=TH>ตามข้อตกลงเพิ่มเติมระดับคณะ(ถ้ามี)</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:21'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>4.6
  <span lang=TH style='letter-spacing:-1.0pt'>คณะกรรมก</span><span lang=TH>ารประเมินระดับคณะ/หรือคณะกรรมการที่คณะแต่งตั้ง
  <span style='letter-spacing:-1.0pt'>สรุปผลการติดตามตรวจสอบ</span></span><span
  style='letter-spacing:-1.0pt'><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:22'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span lang=TH>และประเมิน และให้ความเห็น(ถ้ามี)<o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:23'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>4.<span
  lang=TH>7 <span style='letter-spacing:-1.0pt'>คณะกรรมการระดับมหาวิทยาลัย</span>
  พิจารณา/ให้ความเห็นผลการติดตามตรวจสอบและประเมิน</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:24;mso-yfti-lastrow:yes'>
  <td width=642 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  lang=TH>4.8 อธิการบดี<span style='mso-spacerun:yes'>&nbsp;
  </span>รับทราบ/ให้ความเห็นชอบผลของการติดตามตรวจสอบและประเมิน</span><o:p></o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><b><span style='font-family:"AngsanaUPC","serif"'><span
style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></b><b><span
style='font-size:8.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=642
 style='width:481.5pt;border-collapse:collapse;border:none;mso-yfti-tbllook:
 1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:
 none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:20.25pt'>
  <td width=642 colspan=5 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt;
  height:20.25pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;mso-ansi-font-size:
  12.0pt;font-family:"AngsanaUPC","serif"'>ก.<span
  style='mso-spacerun:yes'>&nbsp; </span>ข้อมูลส่วนตัวของผู้ขอรับการติดตามตรวจสอบและประเมิน</span></b><b><span
  style='font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:20.25pt'>
  <td width=642 colspan=5 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt;
  height:20.25pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>1.<span
  style='mso-spacerun:yes'>&nbsp; </span>ชื่อ-สกุล <?php echo $workload[0]['firstName'].' '.$workload[0]['lastName'];?></span><b><span
  style='font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=642 colspan=5 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span>วัน/เดือน/ปีเกิด <?php echo convdate($workload[0]['dateOfBirth']);?> อายุ <?php echo calcutateAge($workload[0]['dateOfBirth']);?> ปี<span
  style='mso-spacerun:yes'>&nbsp; </span>สถานภาพ <span style="font-size:14.0pt;font-family:&quot;AngsanaUPC&quot;,&quot;serif&quot;">
    <?php 
  switch($workload[0]['userStatus']):
  case'1':$userStatus='โสด';break;
  case'2':$userStatus='สมรส';break;
  case'3':$userStatus='หย่า';break;
  case'4':$userStatus='หม่าย';break;
  endswitch;
  echo $userStatus; ?>
  </span>ตำแหน่ง</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>
  <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=642 valign=top style='width:1.25in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>2.<span
  style='mso-spacerun:yes'>&nbsp; </span>วุฒิการศึกษา</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 style='width:121.5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal align=center style='margin-left:30.6pt;text-align:center'><span
  lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>สาขา/สาขาวิชา</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 colspan=2 style='width:179.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-left:23.85pt;text-align:center'><span
  lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>สถาบันการศึกษา</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 style='width:90.6pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ปีที่สำเร็จ</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
   <td width=642 valign=top style='width:1.25in;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span>ปริญญาตรี</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
     </td>
   <td width=642 valign=top style='width:121.5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $workload[0]['bachelorDegreeDiscipline'];?></o:p>
       </span></p>
     </td>
   <td width=642 colspan=2 valign=top style='width:179.4pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='margin-left:1.35pt'><span style='font-size:15.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $workload[0]['bachelorDegreeInstitution'];?></o:p>
     </span></p>
     </td>
   <td width=642 valign=top style='width:90.6pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='margin-left:2.85pt'><span style='font-size:15.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $workload[0]['bachelorDegreeGraduate'];?></o:p>
     </span></p>
     </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
   <td width=642 valign=top style='width:1.25in;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span>ปริญญาโท</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
     </td>
   <td width=642 valign=top style='width:121.5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $workload[0]['mastersDegreeDiscipline'];?></o:p>
     </span></p>
     </td>
   <td width=642 colspan=2 valign=top style='width:179.4pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='margin-left:1.35pt'><span style='font-size:15.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $workload[0]['mastersDegreeInstitution'];?></o:p>
     </span></p>
     </td>
   <td width=642 valign=top style='width:90.6pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='margin-left:2.85pt'><span style='font-size:15.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $workload[0]['mastersDegreeGraduate'];?></o:p>
     </span></p>
     </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
   <td width=642 valign=top style='width:1.25in;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span>ปริญญาเอก</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
     </td>
   <td width=642 valign=top style='width:121.5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $workload[0]['doctorateDegreeDiscipline'];?></o:p>
     </span></p>
     </td>
   <td width=642 colspan=2 valign=top style='width:179.4pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='margin-left:1.35pt'><span style='font-size:15.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $workload[0]['doctorateDegreeInstitution'];?></o:p>
     </span></p>
     </td>
   <td width=642 valign=top style='width:90.6pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='margin-left:2.85pt'><span style='font-size:15.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $workload[0]['doctorateDegreeGraduate'];?></o:p>
     </span></p>
     </td>
 </tr>
 <tr style='mso-yfti-irow:10'>
   <td width=642 valign=top style='width:1.25in;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span><span lang=TH>วุฒิบัตร</span><o:p></o:p></span></p>
     </td>
   <td width=642 valign=top style='width:121.5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $workload[0]['diplomaDiscipline'];?></o:p>
     </span></p>
     </td>
   <td width=642 colspan=2 valign=top style='width:179.4pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='margin-left:1.35pt'><span style='font-size:15.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $workload[0]['diplomaInstitution'];?></o:p>
     </span></p>
     </td>
   <td width=642 valign=top style='width:90.6pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='margin-left:2.85pt'><span style='font-size:15.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $workload[0]['diplomaGraduate'];?></o:p>
     </span></p>
     </td>
 </tr>
 <tr style='mso-yfti-irow:12'>
   <td width=642 colspan=5 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>3.
       <span style='mso-spacerun:yes'>&nbsp;</span>วันบรรจุ <?php echo convdate($workload[0]['registerDate']);?></span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>
       <o:p></o:p></span></p>
     </td>
 </tr>
 <tr style='mso-yfti-irow:13'>
  <td width=642 colspan=5 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>4.
  <span style='mso-spacerun:yes'>&nbsp;</span>อัตราเงินเดือนปัจจุบัน <?php echo $workload[0]['currentSalary'];?> บาท</span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>
  <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14'>
  <td width=642 colspan=5 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>5.
  ปฏิบัติงานที่ คณะ <?php echo $workload[0]['faculty'];?> สาขาวิชา </span><span style='font-size:15.0pt;font-family:
  "AngsanaUPC","serif"'>
  <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15'>
  <td width=642 colspan=5 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span>ภาคการศึกษาที่ <span style="font-size:14.0pt;font-family:&quot;AngsanaUPC&quot;,&quot;serif&quot;"><?php echo $workload[0]['semester'];?></span> <span
  style='mso-spacerun:yes'>&nbsp;</span>ปีการศึกษา </span><span
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>
    <span style="font-size:14.0pt;font-family:&quot;AngsanaUPC&quot;,&quot;serif&quot;"><?php echo $workload[0]['year'];?></span>
    <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:16'>
  <td width=642 colspan=5 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>6.
  บันทึกการปฏิบัติงานตามปีงบประมาณ </span><span style='font-size:15.0pt;
  font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:17'>
  <td width=642 colspan=5 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width=533
   style='width:399.45pt;margin-left:28.95pt;border-collapse:collapse;
   border:none;mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:480;
   mso-padding-alt:0in 5.4pt 0in 5.4pt'>
   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:21.5pt'>
    <td width=413 rowspan=2 style='width:309.45pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:21.5pt'>
    <p class=MsoNormal align=center style='text-align:center'><span lang=TH
    style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ประเภท</span><span
    style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
    </td>
    <td width=120 colspan=2 valign=top style='width:1.25in;border:solid windowtext 1.0pt;
    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.5pt'>
    <p class=MsoNormal align=center style='text-align:center'><span lang=TH
    style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>สถิติการลา</span><span
    style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:1;height:20.95pt'>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:20.95pt'>
    <p class=MsoNormal align=center style='text-align:center'><span lang=TH
    style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ครั้ง</span><span
    style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:20.95pt'>
    <p class=MsoNormal align=center style='text-align:center'><span lang=TH
    style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>วัน</span><span
    style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:2;height:21.5pt'>
    <td width=413 valign=top style='width:309.45pt;border:solid windowtext 1.0pt;
    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.5pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ลาป่วย<o:p></o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:21.5pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:21.5pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:3;height:24.3pt'>
    <td width=413 valign=top style='width:309.45pt;border:solid windowtext 1.0pt;
    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ลากิจ<o:p></o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:4;height:24.3pt'>
    <td width=413 valign=top style='width:309.45pt;border:solid windowtext 1.0pt;
    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>มาสาย<o:p></o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:5;height:24.3pt'>
    <td width=413 valign=top style='width:309.45pt;border:solid windowtext 1.0pt;
    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ลาคลอดบุตร<o:p></o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:6;height:24.3pt'>
    <td width=413 valign=top style='width:309.45pt;border:solid windowtext 1.0pt;
    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ลาอุปสมบท<o:p></o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:7;height:24.3pt'>
    <td width=413 valign=top style='width:309.45pt;border:solid windowtext 1.0pt;
    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ลาป่วยจำเป็นต้องรักษาตัวเป็นเวลานานคราวเดียวหรือหลายคราวรวมกัน<o:p></o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:8;mso-yfti-lastrow:yes;height:24.3pt'>
    <td width=413 valign=top style='width:309.45pt;border:solid windowtext 1.0pt;
    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ขาดราชการโดยไม่มีเหตุผลอันสมควร<o:p></o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
    <td width=60 valign=top style='width:45.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
    height:24.3pt'>
    <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
    </td>
   </tr>
  </table>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:18'>
  <td width=642 colspan=5 valign=top style='width:481.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:19'>
  <td width=642 colspan=3 style='width:238.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อผู้รับการติดตามตรวจสอบและประเมิน<o:p></o:p></span></p>
  </td>
  <td width=642 colspan=2 style='width:243.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อผู้ตรวจสอบ<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:20'>
  <td width=642 colspan=3 style='width:238.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>..................................................<o:p></o:p></span></p>
  </td>
  <td width=642 colspan=2 style='width:243.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>.......................................................<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:21'>
  <td width=642 colspan=3 style='width:238.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>( <?php echo $workload[0]['firstName'].' '.$workload[0]['lastName'];?> )
      <o:p></o:p></span></p>
  </td>
  <td width=642 colspan=2 style='width:243.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>(..................................................................)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:22;mso-yfti-lastrow:yes'>
  <td width=642 colspan=3 style='width:238.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>.........../............................/.................<o:p></o:p></span></p>
  </td>
  <td width=642 colspan=2 style='width:243.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:15.0pt;font-family:"AngsanaUPC","serif"'>.............../................................../..............<o:p></o:p></span></p>
  </td>
 </tr>
 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=642 style='border:none'></td>
  <td width=642 style='border:none'></td>
  <td width=642 style='border:none'></td>
  <td width=642 style='border:none'></td>
  <td width=642 style='border:none'></td>
 </tr>
 <![endif]>
</table>

<p class=MsoNormal style='text-align:justify'><span style='font-size:16.0pt;
font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<span style='font-size:16.0pt;font-family:"AngsanaUPC","serif";mso-fareast-font-family:
Batang;mso-ansi-language:EN-US;mso-fareast-language:KO;mso-bidi-language:TH'><br
clear=all style='mso-special-character:line-break;page-break-before:always'>
</span>

<p class=MsoNormal><span style='font-size:16.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=6420
 style='width:481.25pt;margin-left:3.25pt;border-collapse:collapse;border:none;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;mso-border-insideh:
 none;mso-border-insidev:none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ข.
  <span style='mso-spacerun:yes'>&nbsp;</span>ส่วนประกอบแบบติดตามตรวจสอบและประเมินผลการปฏิบัติงาน<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>ประกอบด้วย<span
  style='mso-spacerun:yes'>&nbsp; </span>2<span style='mso-spacerun:yes'>&nbsp;
  </span>ส่วน<span style='mso-spacerun:yes'>&nbsp; </span>คือ </span></b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  lang=TH>ส่วน ก . การติดตามตรวจสอบและประเมินสมรรถนะการปฏิบัติงาน</span><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
  <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-left:.75in;text-indent:-.25in;mso-list:l5 level1 lfo7;
  tab-stops:list .75in'><![if !supportLists]><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif";mso-fareast-font-family:AngsanaUPC'><span
  style='mso-list:Ignore'>1)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span lang=TH style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>การติดตามตรวจสอบและประเมินการปฏิบัติงานตามภารกิจ</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-left:.75in;text-indent:-.25in;mso-list:l5 level1 lfo7;
  tab-stops:list .75in'><![if !supportLists]><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif";mso-fareast-font-family:AngsanaUPC'><span
  style='mso-list:Ignore'>2)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span lang=TH style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>การติดตามตรวจสอบและประเมิน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'> /<span lang=TH>ให้ความเห็นตามข้อตกลงเพิ่มเติม</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>ส่วน
  ข.<span style='mso-spacerun:yes'>&nbsp; </span>การติดตามตรวจสอบและประเมินคุณลักษณะและพฤติกรรมในการปฏิบัติงาน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ค.
  วิธีติดตามตรวจสอบและประเมิน</span></b><b><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.
  ผู้รับการติดตามตรวจสอบและประเมิน กรอกข้อมูลเชิงปริมาณลงในแบบประเมิน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>2.
  ผู้กำกับดูแล/ผู้ติดตามตรวจสอบและประเมิน<span style='mso-spacerun:yes'>&nbsp;
  </span>ตรวจสอบความถูกต้องของข้อมูลเชิงปริมาณ ประเมินเชิง คุณภาพ<span
  style='mso-spacerun:yes'>&nbsp; </span></span><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  lang=TH>และประเมินผลการปฏิบัติงาน<span style='mso-spacerun:yes'>&nbsp;
  </span>ตามที่ระบุในคู่มือการติดตามตรวจสอบและประเมินผลการปฏิบัติงานของ </span><o:p></o:p></span></p>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  lang=TH>พนักงาน มหาวิทยาลัย<span style='mso-spacerun:yes'>&nbsp;
  </span>สายวิชาการ</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>3.
  ผู้รับการติดตามตรวจสอบและประเมิน<span style='mso-spacerun:yes'>&nbsp;
  </span>รับทราบผลการติดตามตรวจสอบและประเมินของผู้กำกับดูแล/ผู้ติดตาม</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span></span><span style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  lang=TH>ตรวจสอบและประเมินเบื้องต้น </span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>4.
  <span lang=TH>คณบดี หรือผู้ที่คณบดีมอบหมาย
  ติดตามตรวจสอบและประเมินข้อตกลงเพิ่มเติมระดับคณะ</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  lang=TH>5. ผู้รับการติดตามตรวจสอบและประเมิน<span
  style='mso-spacerun:yes'>&nbsp; </span>รับทราบความเห็นข้อตกลงเพิ่มเติมระดับคณะ
  (ถ้ามี)</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>6.
  <span style='mso-spacerun:yes'>&nbsp;</span><span lang=TH>คณะกรรมการประเมินระดับคณะ
  /หรือคณะกรรมการที่คณะแต่งตั้ง สรุปผลการติดตามตรวจสอบและประเมิน <span
  style='mso-spacerun:yes'>&nbsp;</span></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span lang=TH>และ<span style='mso-spacerun:yes'>&nbsp; </span>ให้ความเห็น(ถ้ามี)</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>7<span
  lang=TH>. คณบดี รับทราบ/ให้ความเห็นผลของการติดตามตรวจสอบและประเมิน<o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:16'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>8.
  คณะกรรมการระดับมหาวิทยาลัย<span style='mso-spacerun:yes'>&nbsp;
  </span>พิจารณา/ให้ความเห็นผลการติดตามตรวจสอบและประเมิน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:17'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>9.
  อธิการบดี<span style='mso-spacerun:yes'>&nbsp;
  </span>รับทราบ/ให้ความเห็นชอบผลของการติดตามตรวจสอบและประเมิน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:18'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span></span><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ง.<span
  style='mso-spacerun:yes'>&nbsp; </span>การ</span></b><b><span lang=TH
  style='font-size:14.0pt;mso-ansi-font-size:12.0pt;font-family:"AngsanaUPC","serif"'>การติดตามตรวจสอบ</span></b><b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>และประเมินผล</span></b><span
  lang=TH style='font-size:14.0pt;mso-ansi-font-size:12.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:19'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;mso-ansi-font-size:
  12.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>ส่วน ก.<span style='mso-spacerun:yes'>&nbsp;
  </span>การติดตามตรวจสอบและประเมินสมรรถนะการปฏิบัติงาน<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:20'>
  <td width=642 colspan=10 valign=top style='width:481.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;mso-ansi-font-size:
  12.0pt;font-family:"AngsanaUPC","serif"'><span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>1)<span
  style='mso-spacerun:yes'>&nbsp;
  </span>การติดตามตรวจสอบประเมินผลการปฏิบัติตามภารกิจ<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:21'>
  <td width=642 colspan=2 rowspan=2 style='width:215.35pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>รายการ</span><span
  lang=TH style='font-size:14.0pt;mso-ansi-font-size:12.0pt;font-family:"AngsanaUPC","serif"'>ติดตามตรวจสอบและ</span><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ประเมิน<o:p></o:p></span></p>
  </td>
  <td width=642 colspan=6 style='width:151.6pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>การ</span><span
  lang=TH style='font-size:14.0pt;mso-ansi-font-size:12.0pt;font-family:"AngsanaUPC","serif"'>ติดตามตรวจสอบและ</span><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ประเมิน<o:p></o:p></span></p>
  </td>
  <td width=642 style='width:50.75pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-right:-5.4pt;text-align:center'><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>คะแนนที่ได้</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 rowspan=2 style='width:63.55pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>หมายเหตุ</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:22'>
  <td width=642 style='width:68.05pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-right:-10.05pt;text-align:center'><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>เชิงปริมาณ(2)<o:p></o:p></span></p>
  </td>
  <td width=642 colspan=5 style='width:83.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>เชิงคุณภาพ (3)<o:p></o:p></span></p>
  </td>
  <td width=642 style='width:50.75pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>(2)<span
  style='mso-spacerun:yes'>&nbsp; </span></span><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>x <span lang=TH><span
  style='mso-spacerun:yes'>&nbsp;</span>(3)<o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:23'>
  <td width=642 style='width:29.3pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ที่</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 style='width:186.05pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>รายการกิจกรรม (1)<o:p></o:p></span></p>
  </td>
  <td width=642 style='width:68.05pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='mso-bidi-font-size:12.0pt;font-family:"AngsanaUPC","serif"'>ชม.ทำการ/สป.</span><span
  style='mso-bidi-font-size:12.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 style='width:15.45pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 style='width:15.45pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 style='width:17.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 style='width:17.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 style='width:17.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>5</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 style='width:50.75pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 style='width:63.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:24'>
  <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1<o:p></o:p></span></b></p>
  </td>
  <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:16.0pt;font-family:"AngsanaUPC","serif"'>กลุ่มงานสอน<o:p></o:p></span></b></p>
  </td>
  <td width=642 valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 rowspan=<?php echo $type1+3;?> valign=top style='width:63.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-.2in;text-align:justify'><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;</span>*ผู้รับการประเมิน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  <p class=MsoNormal style='margin-right:-.2in;text-align:justify'><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ต้องส่งเอกสารหรือข้อมูล
  ตามที่ระบุ</span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  <p class=MsoNormal style='margin-right:-.2in;text-align:justify'><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ไว้ในคู่มือประกอบ</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:25'>
  <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>1.1<o:p></o:p></span></p>
  </td>
  <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'><strong>งานการสอน</strong></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
  <?php 
 $type1=0;
 foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==1):
 ?>
 <tr style='mso-yfti-irow:26'>
   <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'>&nbsp;</p>
     </td>
   <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>รหัสวิชา <?php echo $item['teachingWorkgroupCode'];?>&nbsp;<?php echo $item['teachingWorkgroupSubject'];?>
         <o:p></o:p></span></p>
     </td>
   <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupHours'];?></o:p></span></p>
     </td>
   <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
 </tr>
 <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:30'>
   <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'>1.2<o:p></o:p></span></p>
     </td>
   <td colspan=8 valign=top style='width:254.1pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'><strong>งานควบคุมวิทยานิพนธ์/การค้นคว้าอิสระ/โครงการ ระดับปริญญาตรี</strong></span><strong><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
       <o:p></o:p>
       <span style="font-size:
  14.0pt;font-family:&quot;AngsanaUPC&quot;,&quot;serif&quot;">ระดับบัณฑิตศึกษา</span></span></strong></p>
   </td>
   </tr>
    <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==2):
 ?> 
 <tr style='mso-yfti-irow:33'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'>&nbsp;</p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['teachingWorkgroup'];?>&nbsp;<?php echo $item['teachingWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['teachingWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
  <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:33'>
   <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'>1.3<o:p></o:p></span></p>
     </td>
   <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'><strong>งานที่ปรึกษา</strong>
       <o:p></o:p></span></p>
     </td>
   <td width=642 valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
 </tr>
     <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==3):
 ?> 
 <tr style='mso-yfti-irow:33'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['teachingWorkgroup'];?>&nbsp;<?php echo $item['teachingWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['teachingWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
   <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:36'>
   <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>1.4<o:p></o:p></span></p>
     </td>
   <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><strong>งานนิเทศ
         </strong>
       <o:p></o:p></span></p>
     </td>
   <td width=642 valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
 </tr>
      <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==4):
 ?> 
 <tr style='mso-yfti-irow:37'>
  <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroup'];?>&nbsp;<?php echo $item['teachingWorkgroupSubject'];?></o:p></span></p>
  </td>
  <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
    <o:p><?php echo $item['teachingWorkgroupHours'];?></o:p>
  </span></p></td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
    <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:39'>
   <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>1.5<o:p></o:p></span></p>
     </td>
   <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><strong>ผู้ประสานงานรายวิชา</strong></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
     </td>
   <td width=642 valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
 </tr>
       <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==5):
 ?>
 <tr style='mso-yfti-irow:37'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['teachingWorkgroup'];?>&nbsp;<?php echo $item['teachingWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['teachingWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
    <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:40;height:13.0pt'>
  <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:13.0pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'>1.6<o:p></o:p></span></p>
  </td>
  <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.0pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><strong>อื่นๆ</strong>
    <o:p></o:p></span></p>
  </td>
  <td width=642 valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.0pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.0pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.0pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.0pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.0pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.0pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.0pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.0pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:37'>
      <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==6):
 ?>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['teachingWorkgroup'];?>&nbsp;<?php echo $item['teachingWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['teachingWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
     <?php 
 endif;
 endforeach; ?>
 </tr>
 <tr style='mso-yfti-irow:41'>
  <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
  <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:16.0pt;font-family:"AngsanaUPC","serif"'>งานวิจัยและวิชาการ</span></b><b><span
  style='font-size:16.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
  <td width=642 valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:42'>
  <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>2.1<o:p></o:p></span></p>
  </td>
  <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>โครงการวิจัย
  </span></b><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>/<span
  lang=TH>นวัตกรรม /สิ่งประดิษฐ์</span></span></b><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=642 valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
   <?php foreach($researchingworkgroup as $item):
 if($item['researchingWorkgroupType']==1):
 ?>
 <tr style='mso-yfti-irow:43'>
  <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['researchingWorkgroupSubject'];?></o:p>
      </span></p>
  </td>
  <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
    <o:p><?php echo $item['researchingWorkgroupHours'];?></o:p>
  </span></p></td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:42'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>2.2
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><b><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>การจัดทำตำรา เอกสาร สื่อ หนังสือวิชาการ</span></b></p></td>
   <td valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
  <?php foreach($researchingworkgroup as $item):
 if($item['researchingWorkgroupType']==2):
 ?>
 <tr style='mso-yfti-irow:43'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['researchingWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['researchingWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
  <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:42'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>2.3
         <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><b><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>อื่นๆ</span></b></p></td>
   <td valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
   <?php foreach($researchingworkgroup as $item):
 if($item['researchingWorkgroupType']==3):
 ?>
 <tr style='mso-yfti-irow:43'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['researchingWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['researchingWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:47'>
   <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><b><span lang=TH
  style='font-size:16.0pt;font-family:"AngsanaUPC","serif"'>3<o:p></o:p></span></b></p>
     </td>
   <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><b><span lang=TH style='font-size:16.0pt;font-family:"AngsanaUPC","serif"'>กลุ่มงานบริการวิชาการ<o:p></o:p></span></b></p>
     </td>
   <td width=642 valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
 </tr>
 <tr style='mso-yfti-irow:42'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>3.1
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><b><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>กรรมการวิชาการพัฒนาหลักสูตร</span></b></p></td>
   <td valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php foreach($servicesworkgroup as $item):
 if($item['servicesWorkgroupType']==1):
 ?>
 <tr style='mso-yfti-irow:43'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:42'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>3.2
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><b><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>การอบรมบุคคลภายนอก</span></b></p></td>
   <td valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php foreach($servicesworkgroup as $item):
 if($item['servicesWorkgroupType']==2):
 ?>
 <tr style='mso-yfti-irow:43'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
  <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:42'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>3.3
     <o:p></o:p>
   </span></p></td>
   <td colspan="2" valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><b><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>คณะกรรมการตรวจประเมินคุณภาพการศึกษาภายใน</span></b><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
       <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php foreach($servicesworkgroup as $item):
 if($item['servicesWorkgroupType']==3):
 ?>
 <tr style='mso-yfti-irow:43'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
  <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:42'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>3.4
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><b><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>อื่นๆ</span></b></p></td>
   <td valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php foreach($servicesworkgroup as $item):
 if($item['servicesWorkgroupType']==4):
 ?>
 <tr style='mso-yfti-irow:43'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td width=642 align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:51'>
   <td width=642 valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4<o:p></o:p></span></b></p>
     </td>
   <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กลุ่มงานอื่นๆ<o:p></o:p></span></b></p>
     </td>
   <td width=642 valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=642 valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
 </tr>
 <tr style='mso-yfti-irow:42'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>4.1
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><b><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>กรรมการส่งเสริมกิจกรรมมหาวิทยาลัย</span></b></p></td>
   <td valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==1):
 ?>
 <tr style='mso-yfti-irow:43'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:42'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>4.2
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><b><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>กรรมการประจำหลักสูตร</span></b></p></td>
   <td valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==2):
 ?>
 <tr style='mso-yfti-irow:43'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:42'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>4.3
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><b><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>กรรมการประจำคณะ / ศูนย์ / สถาบัน</span></b></p></td>
   <td valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==3):
 ?>
 <tr style='mso-yfti-irow:43'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:42'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>4.4
     <o:p></o:p>
   </span></p></td>
   <td colspan="2" valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><b><span lang=TH style='font-size: 14.0pt; font-family: "AngsanaUPC", "serif"'>งานที่ภาควิชา / สาขาวิชา / คณะ / สถาบัน / มหาวิทยาลัยมอบหมาย</span></b></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==4):
 ?>
 <tr style='mso-yfti-irow:43'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:42'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>4.5
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><b><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>กรรมการเฉพาะกิจ</span></b></p></td>
   <td valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==5):
 ?>
 <tr style='mso-yfti-irow:43'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:42'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>4.6
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><b><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>อื่นๆ</span></b></p></td>
   <td valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==6):
 ?>
 <tr style='mso-yfti-irow:43'>
   <td valign=top style='width:29.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:15.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:17.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:54;mso-yfti-lastrow:yes'>
  <td width=642 valign=top style='width:29.3pt;border:none;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-right-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=642 valign=top style='width:186.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ผลคะแนนรวม<o:p></o:p></span></b></p>
  </td>
  <td align="center" valign=top style='width:68.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='text-align:center'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
    <o:p><?php echo $totalhour;?></o:p>
  </span></p></td>
  <td width=642 colspan=5 valign=top style='width:83.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=642 valign=top style='width:63.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span style='font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<span style='font-size:12.0pt;mso-bidi-font-size:14.0pt;font-family:"AngsanaUPC","serif";
mso-fareast-font-family:Batang;mso-ansi-language:EN-US;mso-fareast-language:
KO;mso-bidi-language:TH'><br clear=all style='mso-special-character:line-break;
page-break-before:always'>
</span>

<p class=MsoNormal><span style='font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span style='font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=648
 style='width:6.75in;border-collapse:collapse;border:none;mso-yfti-tbllook:
 1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:
 none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2)
  <span style='mso-spacerun:yes'>&nbsp;</span>ผลการติดตามตรวจสอบและประเมิน </span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span>ส่วน ก </span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>:<span
  style='mso-spacerun:yes'>&nbsp; </span><span lang=TH><span
  style='mso-spacerun:yes'>&nbsp;</span>การติดตามตรวจสอบและประเมินสมรรถนะการปฏิบัติงาน
  </span><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2.1)<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>คะแนนที่ได้<span
  style='mso-spacerun:yes'>&nbsp; </span>............................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp; </span><span lang=TH>2.2)<span
  style='mso-spacerun:yes'>&nbsp; </span>คิดเป็นร้อยละ<span
  style='mso-spacerun:yes'>&nbsp; </span>............................</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2.3)<span
  style='mso-spacerun:yes'>&nbsp; </span>ระดับที่ได้รับ<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>] <span lang=TH>ระดับ 5 ดีเยี่ยม
  (90-100</span>%<span lang=TH>)<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>] <span lang=TH>ระดับ 4 ดีมาก (80-89</span>%<span
  lang=TH>)<span style='mso-spacerun:yes'>&nbsp;&nbsp; </span></span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>] <span lang=TH>ระดับ 3 ดี (70-
  79</span>%<span lang=TH>)<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>] <span lang=TH>ระดับ 2 พอใช้ (60-69</span>%<span
  lang=TH>) <span style='mso-spacerun:yes'>&nbsp;</span></span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>] <span lang=TH>ระดับ 1 ไม่ผ่านเกณฑ์การประเมิน
  (ต่ำกว่า 60</span>%)<span lang=TH><span style='mso-spacerun:yes'>&nbsp;&nbsp;
  </span></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อ</span></b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp; </span><span style='mso-tab-count:9'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>วัน/เดือน/ปี</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ผู้กำกับดูแล/ผู้ติดตามตรวจสอบและประเมินเบื้องต้น<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>..................................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span>…../………/…………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span lang=TH>(<span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span>)</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ความเห็นของผู้รับการติดตามตรวจสอบและประเมิน<span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>]<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><span lang=TH>เห็นด้วย /รับทราบ</span>
  <span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>]<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><span lang=TH>ไม่เห็นด้วย.............................................................................................................................................</span>.......................<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>] <span lang=TH><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;</span>อื่นๆ........................................................................................................................................................</span>......................<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อ</span></b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='mso-tab-count:4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-tab-count:4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>วัน/เดือน/ปี</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ผู้รับการติดตามตรวจสอบและประเมิน<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>..................................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>…../………/…………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15;mso-yfti-lastrow:yes'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;</span></span><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;</span><span lang=TH>(<span
  style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;</span>)</span><o:p></o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span style='font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=648
 style='width:6.75in;border-collapse:collapse;border:none;mso-yfti-tbllook:
 1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:
 none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3)<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>การติดตามตรวจสอบประเมิน/
  ให้ความเห็นตามข้อตกลงเพิ่มเติม (ถ้ามี)</span></b><b><span style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;</span>3.1)<span
  style='mso-spacerun:yes'>&nbsp; </span>ผลการติดตามตรวจสอบและประเมิน/ให้ความเห็น<span
  style='mso-spacerun:yes'>&nbsp; </span>ตาม ภวช.1<span
  style='mso-spacerun:yes'>&nbsp; </span>ข้อ1<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>:<span lang=TH><span
  style='mso-spacerun:yes'>&nbsp; </span></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>]<span lang=TH>
  ปฏิบัติได้น้อยกว่าข้อตกลง</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>[<span style='mso-spacerun:yes'>&nbsp; </span>] <span lang=TH>ปฏิบัติได้ตามข้อตกลง</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>]<span lang=TH>
  ปฏิบัติได้มากกว่าข้อตกลง</span><span style='mso-spacerun:yes'>&nbsp;&nbsp;
  </span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span></span></b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>ความเห็น.....................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>...............................................................................................................................................................<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span>3.2)<span
  style='mso-spacerun:yes'>&nbsp;
  </span>ผลการติดตามตรวจสอบและประเมิน/ให้ความเห็น<span
  style='mso-spacerun:yes'>&nbsp; </span>ตาม ภวช.1<span
  style='mso-spacerun:yes'>&nbsp; </span>ข้อ2<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>:<span lang=TH><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>[<span
  style='mso-spacerun:yes'>&nbsp; </span>]<span lang=TH>
  ปฏิบัติได้น้อยกว่าข้อตกลง</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>[<span style='mso-spacerun:yes'>&nbsp; </span>] <span lang=TH>ปฏิบัติได้ตามข้อตกลง</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>]<span lang=TH>
  ปฏิบัติได้มากกว่าข้อตกลง</span><span style='mso-spacerun:yes'>&nbsp;&nbsp;
  </span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;</span></span></b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ความเห็น....................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>.................................................................................................................................................................<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span>3.3)<span
  style='mso-spacerun:yes'>&nbsp;
  </span>ผลการติดตามตรวจสอบและประเมิน/ให้ความเห็น<span
  style='mso-spacerun:yes'>&nbsp; </span>ตาม ภวช.1<span
  style='mso-spacerun:yes'>&nbsp; </span>ข้อ3<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>:<span lang=TH><span
  style='mso-spacerun:yes'>&nbsp; </span></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>[<span
  style='mso-spacerun:yes'>&nbsp; </span>]<span lang=TH>
  ปฏิบัติได้น้อยกว่าข้อตกลง</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>[<span style='mso-spacerun:yes'>&nbsp; </span>] <span lang=TH>ปฏิบัติได้ตามข้อตกลง</span><span
  style='mso-spacerun:yes'>&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;</span>[<span style='mso-spacerun:yes'>&nbsp;
  </span>]<span lang=TH> ปฏิบัติได้มากกว่าข้อตกลง</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;</span></span></b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ความเห็น.....................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>.................................................................................................................................................................<b><o:p></o:p></b></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อ</span></b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp; </span></span><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><span style='mso-tab-count:8'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  lang=TH><span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;</span></span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  lang=TH><span style='mso-spacerun:yes'>&nbsp;</span>วัน/เดือน/ปี</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>คณบดีหรือผู้ที่คณบดีมอบหมาย<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  lang=TH><span style='mso-spacerun:yes'>&nbsp;</span>.........................</span>................<span
  style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>…../………/……….<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;</span><span lang=TH><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;</span></span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  lang=TH>(<span style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  lang=TH>)</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>ความเห็นของผู้รับการติดตามตรวจสอบและประเมิน</span></b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>]<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><span lang=TH>เห็นด้วย /รับทราบ</span>
  <span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>]<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><span lang=TH>ไม่เห็นด้วย.............................................................................................................................................</span>.......................<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:16;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>] <span lang=TH><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;</span>อื่นๆ.......................................................................................................................................................</span>.....................<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:17;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อ</span></b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>ผู้รับการติดตามตรวจสอบและประเมิน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp; </span> <span lang=TH>.........................</span>................<span
  style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>…../………/…………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:18;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span lang=TH>(<span style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
  )<o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:19;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ก.
  ลักษณะเด่นของผู้รับการติดตามตรวจสอบและประเมิน
  ..........................................................................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>......................<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:20;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>.............................................................................................................................................................................................................<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:21;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ข.ลักษณะที่ควรได้รับการปรับปรุง<span
  style='mso-spacerun:yes'>&nbsp;
  </span>.............................................................................................................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>.......................<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:22;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>................................................................................................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>........................................<span
  lang=TH>...........</span>..........................................<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:23;mso-yfti-lastrow:yes;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ค.
  อื่นๆ .........................................................................................................................................................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>.......................<o:p></o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-left:.25in'><span style='font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=648
 style='width:6.75in;border-collapse:collapse;border:none;mso-yfti-tbllook:
 1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:
 none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4)
  ผลการติดตามตรวจสอบและประเมินส่วน ข.<span style='mso-spacerun:yes'>&nbsp;
  </span></span></b><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>:
  <span lang=TH>คุณลักษณะและพฤติกรรม</span><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.1)<span
  style='mso-spacerun:yes'>&nbsp; </span>คะแนนที่ได้<span
  style='mso-spacerun:yes'>&nbsp; </span>............................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.2)<span
  style='mso-spacerun:yes'>&nbsp; </span>คิดเป็นร้อยละ<span
  style='mso-spacerun:yes'>&nbsp; </span>............................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.3)
  ระดับที่ได้รับ<span style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>] <span lang=TH>ระดับ 5 ดีเยี่ยม
  (90-100</span>%<span lang=TH>)<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>] <span lang=TH>ระดับ 4 ดีมาก (80-89</span>%<span
  lang=TH>)<span style='mso-spacerun:yes'>&nbsp; </span></span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>] <span lang=TH>ระดับ 3 ดี (70-
  79</span>%<span lang=TH>)<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>] <span lang=TH>ระดับ 2 พอใช้ (60-69</span>%<span
  lang=TH>) <span style='mso-spacerun:yes'>&nbsp;</span></span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;</span>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>] <span lang=TH>ระดับ 1 ไม่ผ่านเกณฑ์การประเมิน
  (ต่ำกว่า 60</span>%)<span lang=TH><span style='mso-spacerun:yes'>&nbsp;&nbsp;
  </span></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อ</span></b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><span style='mso-tab-count:9'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>วัน
  /เดือน/ปี</span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ผู้กำกับดูแล/
  ผู้ติดตามตรวจสอบและประเมินเบื้องต้น<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>.........................</span><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>................<span style='mso-tab-count:
  1'>&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;</span>…../………/…………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  lang=TH><span style='mso-spacerun:yes'>&nbsp;</span>(<span style='mso-tab-count:
  2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>)</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ความเห็นของผู้รับการติดตามตรวจสอบและประเมิน</span></b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>]<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><span lang=TH>เห็นด้วย /รับทราบ</span>
  <span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>]<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><span lang=TH>ไม่เห็นด้วย.................................................................................................................................................</span>.............<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>] <span lang=TH><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;</span>อื่นๆ...........................................................................................................................................................</span>............<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อ</span></b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span></span><span style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ผู้รับการติดตามตรวจสอบและประเมิน<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='mso-spacerun:yes'>&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;</span></span><span style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  lang=TH><span style='mso-spacerun:yes'>&nbsp;</span></span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;</span><span lang=TH>.........................</span>................<span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;</span>…../………/…………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  lang=TH><span style='mso-spacerun:yes'>&nbsp;</span>(<span style='mso-tab-count:
  3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span lang=TH>)</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:16'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>จ</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>.<span lang=TH>สรุปผลการติดตามตรวจสอบและประเมินระดับคณะ<o:p></o:p></span></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:17'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
   style='border-collapse:collapse;mso-table-layout-alt:fixed;border:none;
   mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:480;mso-padding-alt:
   0in 5.4pt 0in 5.4pt'>
   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
    <td width=211 valign=top style='width:2.2in;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>รายการ</span></b><b><span
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
    </td>
    <td width=132 valign=top style='width:99.0pt;border:solid windowtext 1.0pt;
    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ส่วน ก</span></b><b><span
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
    style='mso-spacerun:yes'>&nbsp; </span>80%<o:p></o:p></span></b></p>
    </td>
    <td width=132 valign=top style='width:99.0pt;border:solid windowtext 1.0pt;
    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ส่วน ข</span></b><b><span
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
    style='mso-spacerun:yes'>&nbsp; </span>20%<o:p></o:p></span></b></p>
    </td>
    <td width=127 valign=top style='width:95.4pt;border:solid windowtext 1.0pt;
    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ผลประเมินรวม</span></b><b><span
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:1'>
    <td width=211 valign=top style='width:2.2in;border:solid windowtext 1.0pt;
    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.
    คะแนนเต็ม<o:p></o:p></span></p>
    </td>
    <td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>40 </span></b><b><span
    style='font-size:14.0pt;font-family:"Wingdings 2";mso-ascii-font-family:
    AngsanaUPC;mso-hansi-font-family:AngsanaUPC;mso-bidi-font-family:AngsanaUPC;
    mso-char-type:symbol;mso-symbol-font-family:"Wingdings 2"'><span
    style='mso-char-type:symbol;mso-symbol-font-family:"Wingdings 2"'>&Iacute;</span></span></b><b><span
    lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'> 5<span
    style='mso-spacerun:yes'>&nbsp; </span>=<span
    style='mso-spacerun:yes'>&nbsp; </span>200<o:p></o:p></span></b></p>
    </td>
    <td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>100 </span></b><b><span
    style='font-size:14.0pt;font-family:"Wingdings 2";mso-ascii-font-family:
    AngsanaUPC;mso-hansi-font-family:AngsanaUPC;mso-bidi-font-family:AngsanaUPC;
    mso-char-type:symbol;mso-symbol-font-family:"Wingdings 2"'><span
    style='mso-char-type:symbol;mso-symbol-font-family:"Wingdings 2"'>&Iacute;</span></span></b><b><span
    lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'> 5<span
    style='mso-spacerun:yes'>&nbsp; </span>= 500<o:p></o:p></span></b></p>
    </td>
    <td width=127 valign=top style='width:95.4pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>-</span></b><b><span
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:2'>
    <td width=211 valign=top style='width:2.2in;border:solid windowtext 1.0pt;
    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2.
    คะแนนที่ได้<span
    style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </span></span><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
    </td>
    <td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
    </td>
    <td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
    </td>
    <td width=127 valign=top style='width:95.4pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:3'>
    <td width=211 valign=top style='width:2.2in;border:solid windowtext 1.0pt;
    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3.
    เปอร์เซ็นต์ที่ได้รับตามส่วน ก หรือ ข<span
    style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </span></span><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
    </td>
    <td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
    </td>
    <td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
    </td>
    <td width=127 valign=top style='width:95.4pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:4'>
    <td width=211 valign=top style='width:2.2in;border:solid windowtext 1.0pt;
    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.
    <span lang=TH>เปอร์เซ็นต์ที่ได้รับตามสัดส่วน<o:p></o:p></span></span></p>
    </td>
    <td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
    </td>
    <td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
    </td>
    <td width=127 valign=top style='width:95.4pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:5;mso-yfti-lastrow:yes'>
    <td width=211 valign=top style='width:2.2in;border:solid windowtext 1.0pt;
    border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ระดับที่ได้รับ</span></b><b><span
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
    </td>
    <td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
    </td>
    <td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
    </td>
    <td width=127 valign=top style='width:95.4pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span
    style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
    </td>
   </tr>
  </table>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อ<span
  style='mso-spacerun:yes'>&nbsp; </span>คณะกรรมการประเมินระดับคณะ<span
  style='mso-spacerun:yes'>&nbsp; </span></span></b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;</span></span><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><span style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  lang=TH><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>วัน
  /เดือน /ปี</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:18'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.
  คณบดี/ผอ.<span style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span>...................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>................<span
  style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>……/………/…….<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:19'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>(<span
  style='mso-tab-count:5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:20'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2.<span
  style='mso-spacerun:yes'>&nbsp; </span><span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>...................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>............... <span
  style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>……/………/…….<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:21'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>(<span
  style='mso-tab-count:5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:22'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3.<span
  style='mso-spacerun:yes'>&nbsp; </span><span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>...................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>................<span
  style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>……/………/…….<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:23'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>(<span
  style='mso-tab-count:5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:24'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:25;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ความเห็นของคณะกรรมการประเมินระดับคณะ</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:26;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>................................................................................................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>........................................<span
  lang=TH>...........</span>..........................................<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:27;height:19.4pt'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt;
  height:19.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>................................................................................................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>........................................<span
  lang=TH>...........</span>..........................................<span
  lang=TH><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:28'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ฉ.
  ความเห็นของคณะกรรมการประเมินระดับมหาวิทยาลัย</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:29'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>[<span style='mso-spacerun:yes'>&nbsp; </span>]<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><span lang=TH>เห็นด้วย /รับทราบ</span>
  <span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>[<span
  style='mso-spacerun:yes'>&nbsp; </span>] <span lang=TH>อื่นๆ...............................................................................................................</span>.............<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:30'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>……………………………………………………………………………………………………………………………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:31'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>……………………………………………………………………………………..………………………………………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:32'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อ<span
  style='mso-spacerun:yes'>&nbsp; </span>คณะกรรมการประเมินระดับมหาวิทยาลัย<span
  style='mso-spacerun:yes'>&nbsp; </span></span></b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;</span></span><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><span style='mso-tab-count:5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:33'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>วัน /เดือน /ปี</span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:34'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1. <span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;</span>...................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>................<span
  style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>……/………/…….<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:35'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>(<span
  style='mso-tab-count:5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:36'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>2.<span
  style='mso-spacerun:yes'>&nbsp; </span><span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;</span>...................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>............... <span
  style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>……/………/…….<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:37'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>(<span
  style='mso-tab-count:5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:38'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>3.<span
  style='mso-spacerun:yes'>&nbsp; </span><span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;</span>...................................</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>................<span
  style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>……/………/…….<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:39;mso-yfti-lastrow:yes'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>(<span
  style='mso-tab-count:5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>)<o:p></o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span style='font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=648
 style='width:6.75in;border-collapse:collapse;border:none;mso-yfti-tbllook:
 1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:
 none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ช.
  ความเห็นของอธิการบดี</span></b><b><span style='font-size:14.0pt;font-family:
  "AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>]<span style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  lang=TH>รับทราบ</span> /<span lang=TH>อนุมัติ</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>]<span style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  lang=TH>อื่นๆ </span><b><span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></b>………………………………………………………………………………………………………………………..…..<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>………………………………………………………………………………………………………………………………………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>………………………………………………………………………………………………………………………………………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อ<span
  style='mso-tab-count:7'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>วัน /เดือน/ปี</span></b><b><span style='font-size:14.0pt;font-family:
  "AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>อธิการบดี</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span><span style='mso-tab-count:
  1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>………………………………………<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>……….../………/…………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;mso-yfti-lastrow:yes'>
  <td width=648 valign=top style='width:6.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>(<span style='mso-tab-count:4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>)<span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><o:p></o:p></span></b></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span style='font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

</div>

</body>

</html>
