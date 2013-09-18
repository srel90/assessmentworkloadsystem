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
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=workload1.doc");
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
<link rel=File-List href="workload1_files/filelist.xml">
<title>(ร่าง)แบบกำหนดภาระงานมาตรฐานของพนักงานมหาวิทยาลัยสายวิชาการ[ภวช]</title>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>TT</o:Author>
  <o:LastAuthor>lers90@hotmail.com</o:LastAuthor>
  <o:Revision>7</o:Revision>
  <o:TotalTime>5</o:TotalTime>
  <o:LastPrinted>2010-09-03T04:34:00Z</o:LastPrinted>
  <o:Created>2013-09-11T07:50:00Z</o:Created>
  <o:LastSaved>2013-09-11T07:53:00Z</o:LastSaved>
  <o:Pages>6</o:Pages>
  <o:Words>623</o:Words>
  <o:Characters>3556</o:Characters>
  <o:Company>TTT</o:Company>
  <o:Lines>29</o:Lines>
  <o:Paragraphs>8</o:Paragraphs>
  <o:CharactersWithSpaces>4171</o:CharactersWithSpaces>
  <o:Version>15.00</o:Version>
 </o:DocumentProperties>
</xml><![endif]-->
<link rel=dataStoreItem href="workload1_files/item0007.xml"
target="workload1_files/props008.xml">
<link rel=themeData href="workload1_files/themedata.thmx">
<link rel=colorSchemeMapping href="workload1_files/colorschememapping.xml">
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:View>Print</w:View>
  <w:SpellingState>Clean</w:SpellingState>
  <w:GrammarState>Clean</w:GrammarState>
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
   <w:UseFELayout/>
  </w:Compatibility>
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
  <w:LsdException Locked="false" Priority="1" Name="Default Paragraph Font"/>
  <w:LsdException Locked="false" QFormat="true" Name="Subtitle"/>
  <w:LsdException Locked="false" QFormat="true" Name="Strong"/>
  <w:LsdException Locked="false" QFormat="true" Name="Emphasis"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal Table"/>
  <w:LsdException Locked="false" Priority="99" Name="No List"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Contemporary"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Elegant"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Professional"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Subtle 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Subtle 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Theme"/>
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
	mso-generic-font-family:auto;
	mso-font-format:other;
	mso-font-pitch:fixed;
	mso-font-signature:1 151388160 16 0 524288 0;}
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
	mso-font-charset:1;
	mso-generic-font-family:roman;
	mso-font-format:other;
	mso-font-pitch:variable;
	mso-font-signature:0 0 0 0 0 0;}
@font-face
	{font-family:AngsanaUPC;
	panose-1:2 2 6 3 5 4 5 2 3 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-2130706429 0 0 0 65537 0;}
@font-face
	{font-family:"\@Batang";
	panose-1:2 3 6 0 0 1 1 1 1 1;
	mso-font-charset:129;
	mso-generic-font-family:auto;
	mso-font-format:other;
	mso-font-pitch:fixed;
	mso-font-signature:1 151388160 16 0 524288 0;}
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
span.SpellE
	{mso-style-name:"";
	mso-spl-e:yes;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	font-size:10.0pt;
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	mso-fareast-font-family:Batang;
	mso-bidi-font-family:"Angsana New";}
 /* Page Definitions */
 @page
	{mso-footnote-separator:url("http://localhost/assessmentworkloadsystem/workload1_files/header.htm") fs;
	mso-footnote-continuation-separator:url("http://localhost/assessmentworkloadsystem/workload1_files/header.htm") fcs;
	mso-endnote-separator:url("http://localhost/assessmentworkloadsystem/workload1_files/header.htm") es;
	mso-endnote-continuation-separator:url("http://localhost/assessmentworkloadsystem/workload1_files/header.htm") ecs;}
@page WordSection1
	{size:595.3pt 841.9pt;
	margin:28.35pt 64.35pt 28.35pt 89.85pt;
	mso-header-margin:35.45pt;
	mso-footer-margin:35.45pt;
	mso-even-header:url("http://localhost/assessmentworkloadsystem/workload1_files/header.htm") eh1;
	mso-header:url("http://localhost/assessmentworkloadsystem/workload1_files/header.htm") h1;
	mso-even-footer:url("http://localhost/assessmentworkloadsystem/workload1_files/header.htm") ef1;
	mso-footer:url("http://localhost/assessmentworkloadsystem/workload1_files/header.htm") f1;
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
	mso-list-template-ids:-840536758 -385709426 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l5:level1
	{mso-level-text:"%1\)";
	mso-level-tab-stop:.75in;
	mso-level-number-position:left;
	margin-left:.75in;
	text-indent:-.25in;}
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
div.MsoNormal1 {mso-style-unhide:no;
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
li.MsoNormal1 {mso-style-unhide:no;
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
p.MsoNormal1 {mso-style-unhide:no;
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
span.SpellE1 {mso-style-name:"";
	mso-spl-e:yes;}
div.MsoNormal2 {mso-style-unhide:no;
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
li.MsoNormal2 {mso-style-unhide:no;
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
p.MsoNormal2 {mso-style-unhide:no;
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
span.SpellE2 {mso-style-name:"";
	mso-spl-e:yes;}
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
	mso-style-priority:99;
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

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=630
 style='width:472.5pt;margin-left:.9pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0in 5.4pt 0in 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=630 colspan=5 valign=top style='width:472.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>แบบกำหนดภาระงานมาตรฐานของพนักงานมหาวิทยาลัย<span
  style='mso-spacerun:yes'>&nbsp; </span>สายวิชาการ</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp; </span>[<span class=SpellE><span lang=TH>ภวช</span></span>.1]</span></b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=630 colspan=2 valign=top style='width:153.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=168 valign=top style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=159 valign=top style='width:119.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=99 valign=top style='width:74.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=630 colspan=5 valign=top style='width:472.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ก.
  ข้อมูลส่วนตัวของผู้ขอกำหนดภาระงาน</span></b><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=630 colspan=2 valign=top style='width:153.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.<span
  style='mso-spacerun:yes'>&nbsp; </span>ชื่อ-สกุล<span
  style='mso-spacerun:yes'></span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
    <o:p></o:p></span></p>
  </td>
  <td width=168 valign=top style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
  <o:p><?php echo $workload[0]['firstName'].' '.$workload[0]['lastName'];?></o:p></span></p>
  </td>
  <td colspan="2" valign=top style='width:119.0pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>สถานภาพ</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p></o:p>
</span><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <?php 
  switch($workload[0]['userStatus']):
  case'1':$userStatus='โสด';break;
  case'2':$userStatus='สมรส';break;
  case'3':$userStatus='หย่า';break;
  case'4':$userStatus='หม่าย';break;
  endswitch;
  echo $userStatus; ?>
      </span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p></o:p>
      </span></p>
  </td>
  </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=630 colspan=2 valign=top style='width:153.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2.<span
  style='mso-spacerun:yes'>&nbsp; </span>วันเดือนปีเกิด</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=168 valign=top style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo convdate($workload[0]['dateOfBirth']);?></o:p></span></p>
  </td>
  <td width=159 valign=top style='width:119.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>อายุ <?php echo calcutateAge($workload[0]['dateOfBirth']);?> ปี</o:p></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=99 valign=top style='width:74.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=630 colspan=2 valign=top style='width:153.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3.<span
  style='mso-spacerun:yes'>&nbsp; </span>วุฒิการศึกษา</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=168 style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>สาขา/สาขาวิชา</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=159 style='width:119.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>สถาบันการศึกษา</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=99 style='width:74.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ปีที่สำเร็จ</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=630 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=186 valign=top style='width:139.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ปริญญาตรี</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=168 valign=top style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['bachelorDegreeDiscipline'];?></o:p></span></p>
  </td>
  <td width=159 valign=top style='width:119.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['bachelorDegreeInstitution'];?></o:p></span></p>
  </td>
  <td width=99 align="center" valign=top style='width:74.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['bachelorDegreeGraduate'];?></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width=630 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=186 valign=top style='width:139.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ปริญญาโท</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=168 valign=top style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['mastersDegreeDiscipline'];?></o:p></span></p>
  </td>
  <td width=159 valign=top style='width:119.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['mastersDegreeInstitution'];?></o:p></span></p>
  </td>
  <td width=99 align="center" valign=top style='width:74.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['mastersDegreeGraduate'];?></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
  <td width=630 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=186 valign=top style='width:139.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ปริญญาเอก
  </span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=168 valign=top style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['doctorateDegreeDiscipline'];?></o:p></span></p>
  </td>
  <td width=159 valign=top style='width:119.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['doctorateDegreeInstitution'];?></o:p></span></p>
  </td>
  <td width=99 align="center" valign=top style='width:74.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['doctorateDegreeGraduate'];?></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9'>
  <td width=630 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=186 valign=top style='width:139.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>วุฒิบัตร</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=168 valign=top style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['diplomaDiscipline'];?></o:p></span></p>
  </td>
  <td width=159 valign=top style='width:119.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['diplomaInstitution'];?></o:p></span></p>
  </td>
  <td width=99 align="center" valign=top style='width:74.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['diplomaGraduate'];?></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10'>
  <td width=630 colspan=2 valign=top style='width:153.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.<span
  style='mso-spacerun:yes'>&nbsp; </span>ปฏิบัติงาน ที่ คณะ/ สถาบัน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td colspan="3" valign=top style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['faculty'];?></o:p></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
    <o:p></o:p>
    </span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
    <o:p></o:p>
    </span></p>
  </td>
  </tr>
 <tr style='mso-yfti-irow:11'>
  <td width=630 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=186 valign=top style='width:139.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ภาคการศึกษาที่ 
      <?php echo $workload[0]['semester'];?>
      <o:p></o:p></span></p>
  </td>
  <td width=168 valign=top style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ปีการศึกษา 
      <?php echo $workload[0]['year'];?>
      <o:p></o:p></span></p>
  </td>
  <td width=159 valign=top style='width:119.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=99 valign=top style='width:74.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;mso-yfti-lastrow:yes'>
  <td width=630 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=186 valign=top style='width:139.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;<?php echo $workload[0]['semester']=='1'?"&#10003":'';?>&nbsp; </span>] 1<span lang=TH> เมษายน -
  30 กันยายน</span><o:p></o:p></span></p>
  </td>
  <td width=168 valign=top style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;<?php echo $workload[0]['semester']=='2'?"&#10003":'';?>&nbsp; </span>]<span
  style='mso-spacerun:yes'>&nbsp; </span><span lang=TH>1 ตุลาคม - 31<span
  style='mso-spacerun:yes'>&nbsp; </span>มีนาคม</span><o:p></o:p></span></p>
  </td>
  <td width=159 valign=top style='width:119.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-left:35.85pt'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=99 valign=top style='width:74.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-left:35.85pt'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><br style='mso-special-character:line-break'>
<![if !supportLineBreakNewLine]><br style='mso-special-character:line-break'>
<![endif]><span style='display:none;mso-hide:all'><o:p></o:p></span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=1701
 style='width:472.1pt;margin-left:1.2pt;border-collapse:collapse;border:none;
 mso-border-alt:dotted windowtext .5pt;mso-yfti-tbllook:480;mso-padding-alt:
 0in 5.4pt 0in 5.4pt;mso-border-insideh:.5pt dotted windowtext;mso-border-insidev:
 .5pt dotted windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=629 colspan=6 valign=top style='width:472.1pt;border:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-.2in'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ข.
  ข้อมูลการปฏิบัติงาน</span></b><span lang=TH style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=17 valign=top style='width:12.7pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=613 colspan=5 valign=top style='width:459.4pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-.2in'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1. กลุ่มงานสอน<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span></span></b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=185 colspan=2 valign=top style='width:138.7pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.1 งานการสอน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=78 valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>รหัส<o:p></o:p></span></p>
  </td>
  <td width=202 valign=top style='width:151.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชื่อรายวิชา<o:p></o:p></span></p>
  </td>
  <td width=97 valign=top style='width:72.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชม.ทำการ/<span
  class=SpellE>สป</span>.<o:p></o:p></span></p>
  </td>
  <td width=68 valign=top style='width:50.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-.2in'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'>สัดส่วน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>(%)<o:p></o:p></span></p>
  </td>
 </tr>
 <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==1):
 ?>
 <tr style='mso-yfti-irow:3'>
  <td width=185 colspan=2 valign=top style='width:138.7pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:dotted windowtext 1.0pt;
  border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;mso-border-bottom-alt:dotted windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['teachingWorkgroup'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=78 align="center" valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:dotted windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;mso-border-bottom-alt:dotted windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupCode'];?></o:p>
  </span></p>
  </td>
  <td width=202 valign=top style='width:151.7pt;border-top:none;border-left:
  none;border-bottom:dotted windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;mso-border-bottom-alt:dotted windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupSubject'];?></o:p>
  </span></p>
  </td>
  <td width=97 align="center" valign=top style='width:72.55pt;border-top:none;border-left:
  none;border-bottom:dotted windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;mso-border-bottom-alt:dotted windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupHours'];?></o:p>
  </span></p>
  </td>
  <td width=68 align="center" valign=top style='width:50.65pt;border-top:none;border-left:
  none;border-bottom:dotted windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;mso-border-bottom-alt:dotted windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupProportion'];?></o:p>
  </span></p>
  </td>
 </tr>
 <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:4'>
  <td width=263 colspan=3 valign=top style='width:197.2pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.2
  งานควบคุมวิทยานิพนธ์/ การค้นคว้า/โครงการนักศึกษา (ไม่เกิน 5 เรื่อง)<o:p></o:p></span></p>
  </td>
  <td width=202 style='width:151.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชื่อเรื่อง<o:p></o:p></span></p>
  </td>
  <td width=97 style='width:72.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชม.ทำการ/<span
  class=SpellE>สป</span>.<o:p></o:p></span></p>
  </td>
  <td width=68 style='width:50.65pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ประธาน/กรรมการ<o:p></o:p></span></p>
  </td>
 </tr>
  <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==2):
 ?>
 <tr style='mso-yfti-irow:5;height:18.05pt'>
  <td width=263 colspan=3 valign=top style='width:197.2pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:18.05pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['teachingWorkgroup'];?><o:p></o:p></span></p>
  </td>
  <td width=202 valign=top style='width:151.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.05pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupSubject'];?></o:p></span></p>
  </td>
  <td width=97 align="center" valign=top style='width:72.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.05pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupHours'];?></o:p></span></p>
  </td>
  <td width=68 align="center" valign=top style='width:50.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.05pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupProportion'];?></o:p></span></p>
  </td>
 </tr>
  <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:7'>
  <td width=185 colspan=2 valign=top style='width:138.7pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.3
  งานที่ปรึกษา<o:p></o:p></span></p>
  </td>
  <td width=78 valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>จำนวน <span
  class=SpellE>นศ</span></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>.<o:p></o:p></span></p>
  </td>
  <td width=202 valign=top style='width:151.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>หลักสูตร/สาขาวิชา</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=97 valign=top style='width:72.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชม.ทำการ/<span
  class=SpellE>สป</span>.</span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=68 valign=top style='width:50.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>เวลาทำการ</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
  <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==3):
 ?> 
 <tr style='mso-yfti-irow:8;height:18.75pt'>
  <td width=185 colspan=2 valign=top style='width:138.7pt;border:
  solid windowtext 1.0pt;border-top:none;mso-border-top-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.75pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['teachingWorkgroup'];?><o:p></o:p></span></p>
  </td>
  <td width=78 align="center" valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.75pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupNumberOfStudents'];?></o:p></span></p>
  </td>
  <td width=202 valign=top style='width:151.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.75pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupSubject'];?></o:p></span></p>
  </td>
  <td width=97 valign=top style='width:72.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.75pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupHours'];?></o:p></span></p>
  </td>
  <td width=68 align="center" valign=top style='width:50.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.75pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupProportion'];?></o:p></span></p>
  </td>
 </tr>
   <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:12'>
  <td width=185 colspan=2 valign=top style='width:138.7pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.4
  งานนิเทศ<o:p></o:p></span></p>
  </td>
  <td width=78 valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-right:-5.4pt;text-align:center'><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>จำนวน <span
  class=SpellE>นศ</span>.<o:p></o:p></span></p>
  </td>
  <td width=202 valign=top style='width:151.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>หลักสูตร/สาขาวิชา<o:p></o:p></span></p>
  </td>
  <td width=97 valign=top style='width:72.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชม.ทำการ/<span
  class=SpellE>สป</span>.<o:p></o:p></span></p>
  </td>
  <td width=68 valign=top style='width:50.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>เวลาทำการ<o:p></o:p></span></p>
  </td>
 </tr>
   <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==4):
 ?> 
 <tr style='mso-yfti-irow:13'>
  <td width=185 colspan=2 valign=top style='width:138.7pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroup'];?></o:p></span></p>
  </td>
  <td width=78 align="center" valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='tab-stops:65.25pt'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupNumberOfStudents'];?></o:p></span></p>
  </td>
  <td width=202 valign=top style='width:151.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupSubject'];?></o:p></span></p>
  </td>
  <td width=97 valign=top style='width:72.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupHours'];?></o:p></span></p>
  </td>
  <td width=68 valign=top style='width:50.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['teachingWorkgroupProportion'];?></o:p></span></p>
  </td>
 </tr>
    <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:14'>
  <td width=465 colspan=4 valign=top style='width:348.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.5
  การประสานงานรายวิชา <o:p></o:p></span></p>
  </td>
  <td width=97 valign=top style='width:72.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=68 valign=top style='width:50.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
    <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==5):
 ?> 
 <tr style='mso-yfti-irow:14'>
   <td colspan=2 valign=top style='width:138.7pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span><span style="font-size:14.0pt;font-family:&quot;AngsanaUPC&quot;,&quot;serif&quot;"><?php echo $item['teachingWorkgroup'];?></span></p></td>
   <td align="center" valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='tab-stops:65.25pt'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['teachingWorkgroupCode'];?></o:p>
   </span></p></td>
   <td valign=top style='width:151.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['teachingWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td width=97 align="center" valign=top style='width:72.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
     <?php echo $item['teachingWorkgroupHours'];?></span></p></td>
   <td width=68 align="center" valign=top style='width:50.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
     <?php echo $item['teachingWorkgroupProportion'];?></span></p></td>
   </tr>
    <?php 
 endif;
 endforeach; ?>   
 <tr style='mso-yfti-irow:15;mso-yfti-lastrow:yes'>
  <td width=465 colspan=4 valign=top style='width:348.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.6
  อื่นๆ<o:p></o:p></span></p>
  </td>
  <td width=97 valign=top style='width:72.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=68 valign=top style='width:50.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
     <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==6):
 ?> 
 <tr style='mso-yfti-irow:15;mso-yfti-lastrow:yes'>
   <td colspan=4 valign=top style='width:348.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><?php echo $item['teachingWorkgroupSubject'];?></p></td>
   <td width=97 align="center" valign=top style='width:72.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
     <?php echo $item['teachingWorkgroupHours'];?></span></p></td>
   <td width=68 align="center" valign=top style='width:50.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
     <?php echo $item['teachingWorkgroupProportion'];?></span></p></td>
   </tr>
       <?php 
 endif;
 endforeach; ?> 
 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=17 style='border:none'></td>
  <td width=168 style='border:none'></td>
  <td width=78 style='border:none'></td>
  <td width=202 style='border:none'></td>
  <td width=97 style='border:none'></td>
  <td width=68 style='border:none'></td>
 </tr>
 <![endif]>
</table>

<p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>

<b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif";mso-fareast-font-family:
Batang;mso-ansi-language:EN-US;mso-fareast-language:KO;mso-bidi-language:TH'><br
clear=all style='mso-special-character:line-break;page-break-before:always'>
</span></b>

<p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=630
 style='width:472.85pt;margin-left:2.4pt;border-collapse:collapse;border:none;
 mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:1184;mso-padding-alt:
 0in 5.4pt 0in 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td  style='width:11.8pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif";mso-fareast-font-family:
  Batang;mso-ansi-language:EN-US;mso-fareast-language:KO;mso-bidi-language:
  TH'><br clear=all style='page-break-before:always'>
  <br clear=all style='mso-special-character:line-break;page-break-before:always'>
  </span></b>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td  colspan=5 valign=top style='width:461.05pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-.2in'><b><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>2<span lang=TH>. กลุ่มงานวิจัยและงานวิชาการ<span
  style='mso-spacerun:yes'>&nbsp; </span></span></span></b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td  colspan=2 style='width:140.25pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กิจกรรม</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td  style='width:157.25pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชื่อเรื่อง /กิจกรรม<o:p></o:p></span></p>
  </td>
  <td  style='width:.75in;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ระยะเวลา<o:p></o:p></span></p>
  </td>
  <td  style='width:67.4pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-left:5.4pt;text-align:center;
  text-indent:-5.4pt'><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชม.ทำการ/<span
  class=SpellE>สป</span>.</span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td  valign=top style='width:53.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-.2in'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'>สัดส่วน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>(%)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td  colspan=2 valign=top style='width:140.25pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2.1<span
  style='mso-spacerun:yes'>&nbsp; </span>โครงการวิจัย</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td  valign=top style='width:157.25pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td  valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td  valign=top style='width:67.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td  valign=top style='width:53.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
      <?php foreach($researchingworkgroup as $item):
 if($item['researchingWorkgroupType']==1):
 ?> 
 <tr style='mso-yfti-irow:3'>
  <td  colspan=2 valign=top style='width:140.25pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  lang=TH><o:p><?php echo $item['researchingWorkgroup'];?></o:p></span></span></p>
  </td>
  <td  valign=top style='width:157.25pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><spa style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroupSubject'];?></o:p></span></p>
  </td>
  <td  align="center" valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroupPeriod'];?></o:p></span></p>
  </td>
  <td  align="center" valign=top style='width:67.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroupHours'];?></o:p></span></p>
  </td>
  <td  align="center" valign=top style='width:53.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroupProportion'];?></o:p></span></p>
  </td>
 </tr>
        <?php 
 endif;
 endforeach; ?> 
 <tr style='mso-yfti-irow:4'>
  <td colspan=3 valign=top style='width:140.25pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2. 2 การจัดทำตำรา เอกสาร สือ หนังสือวิชาการ</span></p></td>
  <td  valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td  valign=top style='width:67.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td  valign=top style='width:53.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
       <?php foreach($researchingworkgroup as $item):
 if($item['researchingWorkgroupType']==2):
 ?> 
 <tr style='mso-yfti-irow:5'>
  <td  colspan=2 valign=top style='width:140.25pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroup'];?></o:p>
  </span></p>
  </td>
  <td  valign=top style='width:157.25pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroupSubject'];?></o:p>
  </span></p>
  </td>
  <td  align="center" valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroupPeriod'];?></o:p>
  </span></p>
  </td>
  <td  align="center" valign=top style='width:67.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroupHours'];?></o:p>
  </span></p>
  </td>
  <td  align="center" valign=top style='width:53.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroupProportion'];?></o:p>
  </span></p>
  </td>
 </tr>
         <?php 
 endif;
 endforeach; ?>
 <tr style='mso-yfti-irow:6'>
  <td width=187 colspan=2 valign=top style='width:140.25pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
  <o:p>&nbsp;2.3 อื่นๆ</o:p></span></p>
  </td>
  <td  valign=top style='width:157.25pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td  valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td  valign=top style='width:67.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td  valign=top style='width:53.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
        <?php foreach($researchingworkgroup as $item):
 if($item['researchingWorkgroupType']==3):
 ?>
 <tr style='mso-yfti-irow:7'>
  <td  colspan=2 valign=top style='width:140.25pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroup'];?></o:p>
  </span></p>
  </td>
  <td  valign=top style='width:157.25pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroupSubject'];?></o:p>
  </span></p>
  </td>
  <td  align="center" valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroupPeriod'];?></o:p>
  </span></p>
  </td>
  <td  align="center" valign=top style='width:67.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroupHours'];?></o:p>
  </span></p>
  </td>
  <td  align="center" valign=top style='width:53.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['researchingWorkgroupProportion'];?></o:p>
  </span></p>
  </td>
 </tr>
         <?php 
 endif;
 endforeach; ?>
 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=187 style='border:none'></td>
  <td width=615 style='border:none'></td>
  <td width=210 style='border:none'></td>
  <td width=72 style='border:none'></td>
  <td width=90 style='border:none'></td>
  <td width=72 style='border:none'></td>
 </tr>
 <![endif]>
</table>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=1439
 style='width:475.7pt;margin-left:1.7pt;border-collapse:collapse;border:none;
 mso-border-alt:dotted windowtext .5pt;mso-yfti-tbllook:480;mso-padding-alt:
 0in 5.4pt 0in 5.4pt;mso-border-insideh:.5pt dotted windowtext;mso-border-insidev:
 .5pt dotted windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td  valign=top style='width:11.8pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td  colspan=4 valign=top style='width:463.9pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3.
  กลุ่มงานบริการวิชาการ</span></b><span lang=TH style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td  colspan=2 valign=top style='width:112.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กิจกรรม<o:p></o:p></span></p>
  </td>
  <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชื่อเรื่อง/โครงการ<o:p></o:p></span></p>
  </td>
  <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>วัน/เวลา<o:p></o:p></span></p>
  </td>
  <td  valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชม.ทำการ/<span
  class=SpellE>สป</span>.<o:p></o:p></span></p>
  </td>
 </tr>
<?php 
$i=0;
foreach($servicesworkgroup as $item):
	if($item['servicesWorkgroupType']==1):
	$i+=1;
	endif;
endforeach;
?>
<?php if($i!=0):?>
 <tr style='mso-yfti-irow:4'>
 
  <td  colspan=2 rowspan="<?php echo $i;?>"  valign=top style='width:112.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3.</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1 กรรมการวิชาการพัฒนาหลักสูตร
      <o:p></o:p></span></p>
  </td>
<?php foreach($servicesworkgroup as $item):
 if($item['servicesWorkgroupType']==1):
?>
  <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['servicesWorkgroupSubject'];?></o:p></span></p>
  </td>
  <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['servicesWorkgroupTime'];?></o:p></span></p>
  </td>
  <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['servicesWorkgroupHours'];?></o:p></span></p>
  </td>
<?php
 break;
 endif;
 endforeach;
?>
 </tr>
 <?php endif;?>
<?php
	$i=0; 
	foreach($servicesworkgroup as $item):
	if($item['servicesWorkgroupType']==1):
	$i+=1;
	if($i>1):
?>
 <tr style='mso-yfti-irow:4'>
   <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupTime'];?></o:p>
   </span></p></td>
   <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupHours'];?></o:p>
   </span></p></td>
   </tr>
  <?php
  endif;
 endif;
 endforeach;
 ?>
<?php 
$i=0;
foreach($servicesworkgroup as $item):
	if($item['servicesWorkgroupType']==2):
	$i+=1;
	endif;
endforeach;
?>
<?php if($i!=0):?>
 <tr style='mso-yfti-irow:5'>
  <td width=324 colspan=2 rowspan="<?php echo $i;?>" valign=top style='width:112.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
  <o:p>3.2 การอบรมบุคคลภายนอก</o:p></span></p>
  </td>
  <?php foreach($servicesworkgroup as $item):
 if($item['servicesWorkgroupType']==2):
?>
  <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['servicesWorkgroupSubject'];?></o:p></span></p>
  </td>
  <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['servicesWorkgroupTime'];?></o:p></span></p>
  </td>
  <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['servicesWorkgroupHours'];?></o:p></span></p>
  </td>
  <?php
 break;
 endif;
 endforeach;
?>
 </tr>
 <?php endif;?>
 <?php
	$i=0; 
	foreach($servicesworkgroup as $item):
	if($item['servicesWorkgroupType']==2):
	$i+=1;
	if($i>1):
?>
 <tr style='mso-yfti-irow:5'>
<td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupTime'];?></o:p>
   </span></p></td>
   <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupHours'];?></o:p>
   </span></p></td>
   </tr>
   <?php
  endif;
 endif;
 endforeach;
 ?>
 <?php 
$i=0;
foreach($servicesworkgroup as $item):
	if($item['servicesWorkgroupType']==3):
	$i+=1;
	endif;
endforeach;
?>
<?php if($i!=0):?>
 <tr style='mso-yfti-irow:6'>
   <td width=324 colspan=2 rowspan="<?php echo $i;?>" valign=top style='width:112.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
       <o:p>3.3 คณะกรรมการตรวจประเมิน คุณภาพการศึกษาภายใน</o:p></span></p>
     </td>
       <?php foreach($servicesworkgroup as $item):
 if($item['servicesWorkgroupType']==3):
?>
   <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['servicesWorkgroupSubject'];?></o:p></span></p>
     </td>
   <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['servicesWorkgroupTime'];?></o:p></span></p>
     </td>
   <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['servicesWorkgroupHours'];?></o:p></span></p>
     </td>
       <?php
 break;
 endif;
 endforeach;
?>
 </tr>
 <?php endif;?>
  <?php
	$i=0; 
	foreach($servicesworkgroup as $item):
	if($item['servicesWorkgroupType']==3):
	$i+=1;
	if($i>1):
?>
 <tr style='mso-yfti-irow:6'>
<td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupTime'];?></o:p>
   </span></p></td>
   <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupHours'];?></o:p>
   </span></p></td>
   </tr>
   <?php
  endif;
 endif;
 endforeach;
 ?>
  <?php 
$i=0;
foreach($servicesworkgroup as $item):
	if($item['servicesWorkgroupType']==4):
	$i+=1;
	endif;
endforeach;
?>
<?php if($i!=0):?>
 <tr style='mso-yfti-irow:7'>
   <td width=324 colspan=2 rowspan="<?php echo $i;?>" valign=top style='width:112.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
       <o:p>3.4 อื่นๆ</o:p></span></p>
     </td>
            <?php foreach($servicesworkgroup as $item):
 if($item['servicesWorkgroupType']==4):
?>
   <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['servicesWorkgroupSubject'];?></o:p></span></p>
     </td>
   <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['servicesWorkgroupTime'];?></o:p></span></p>
     </td>
   <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $item['servicesWorkgroupHours'];?></o:p></span></p>
     </td>
            <?php
 break;
 endif;
 endforeach;
?>
 </tr>
<?php endif;?> 
   <?php
	$i=0; 
	foreach($servicesworkgroup as $item):
	if($item['servicesWorkgroupType']==4):
	$i+=1;
	if($i>1):
?>
 <tr style='mso-yfti-irow:7'>
<td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupSubject'];?></o:p>
   </span></p></td>
   <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupTime'];?></o:p>
   </span></p></td>
   <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p><?php echo $item['servicesWorkgroupHours'];?></o:p>
   </span></p></td>
   </tr>
   <?php
  endif;
 endif;
 endforeach;
 ?>

 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=324 style='border:none'></td>
  <td width=619 style='border:none'></td>
  <td width=324 style='border:none'></td>
  <td width=66 style='border:none'></td>
  <td width=94 style='border:none'></td>
 </tr>
 <![endif]>
</table>

<p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=1439
 style='width:475.7pt;margin-left:1.7pt;border-collapse:collapse;border:none;
 mso-border-alt:dotted windowtext .5pt;mso-yfti-tbllook:480;mso-padding-alt:
 0in 5.4pt 0in 5.4pt;mso-border-insideh:.5pt dotted windowtext;mso-border-insidev:
 .5pt dotted windowtext'>
  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
    <td  valign=top style='width:11.8pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2 align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p>&nbsp;</o:p>
    </span></p></td>
    <td  colspan=4 valign=top style='width:463.9pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.
      กลุ่มงานอื่นๆ</span></b></p></td>
  </tr>
  <tr style='mso-yfti-irow:1'>
    <td  colspan=2 valign=top style='width:112.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2 align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กิจกรรม
      <o:p></o:p>
    </span></p></td>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2 align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชื่อเรื่อง/โครงการ
      <o:p></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2 align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>วัน/เวลา
      <o:p></o:p>
    </span></p></td>
    <td  valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2 align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชม.ทำการ/<span
  class=SpellE2>สป</span>.
      <o:p></o:p>
    </span></p></td>
  </tr>
  <?php 
$i=0;
foreach($otherworkgroup as $item):
	if($item['otherWorkgroupType']==1):
	$i+=1;
	endif;
endforeach;
?>
<?php if($i!=0):?>
  <tr style='mso-yfti-irow:4'>
    <td  colspan=2 rowspan="<?php echo $i;?>"  valign=top style='width:112.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1 กรรมการส่งเสริมกิจการมหาวิทยาลัย
          <o:p></o:p>
    </span></p></td>
    <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==1):
?>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupTime'];?></o:p>
    </span></p></td>
    <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
    </span></p></td>
    <?php
 break;
 endif;
 endforeach;
?>
<?php endif;?>
  </tr>
  <?php
	$i=0; 
	foreach($otherworkgroup as $item):
	if($item['otherWorkgroupType']==1):
	$i+=1;
	if($i>1):
?>
  <tr style='mso-yfti-irow:4'>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupTime'];?></o:p>
    </span></p></td>
    <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
    </span></p></td>
  </tr>
  <?php
  endif;
 endif;
 endforeach;
 ?>
  <?php 
$i=0;
foreach($otherworkgroup as $item):
	if($item['otherWorkgroupType']==2):
	$i+=1;
	endif;
endforeach;
?>
<?php if($i!=0):?>
  <tr style='mso-yfti-irow:5'>
    <td width=324 colspan=2 rowspan="<?php echo $i;?>" valign=top style='width:112.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p>4.2 กรรมการประจำหลักสูตร</o:p>
    </span></p></td>
    <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==2):
?>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupTime'];?></o:p>
    </span></p></td>
    <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
    </span></p></td>
    <?php
 break;
 endif;
 endforeach;
?>
<?php endif;?>
  </tr>
  <?php
	$i=0; 
	foreach($otherworkgroup as $item):
	if($item['otherWorkgroupType']==2):
	$i+=1;
	if($i>1):
?>
  <tr style='mso-yfti-irow:5'>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupTime'];?></o:p>
    </span></p></td>
    <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
    </span></p></td>
  </tr>
  <?php
  endif;
 endif;
 endforeach;
 ?>
  <?php 
$i=0;
foreach($otherworkgroup as $item):
	if($item['otherWorkgroupType']==3):
	$i+=1;
	endif;
endforeach;
?>
<?php if($i!=0):?>
  <tr style='mso-yfti-irow:6'>
    <td width=324 colspan=2 rowspan="<?php echo $i;?>" valign=top style='width:112.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p>4.3 กรรมการประจำคณะ / ศูนย์ / สถาบัน</o:p>
    </span></p></td>
    <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==3):
?>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupTime'];?></o:p>
    </span></p></td>
    <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
    </span></p></td>
    <?php
 break;
 endif;
 endforeach;
?>
<?php endif;?>
  </tr>
  <?php
	$i=0; 
	foreach($otherworkgroup as $item):
	if($item['otherWorkgroupType']==3):
	$i+=1;
	if($i>1):
?>
  <tr style='mso-yfti-irow:6'>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupTime'];?></o:p>
    </span></p></td>
    <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
    </span></p></td>
  </tr>
  <?php
  endif;
 endif;
 endforeach;
 ?>
  <?php 
$i=0;
foreach($otherworkgroup as $item):
	if($item['otherWorkgroupType']==4):
	$i+=1;
	endif;
endforeach;
?>
<?php if($i!=0):?>
  <tr style='mso-yfti-irow:7' >
    <td width=324 colspan=2 rowspan="<?php echo $i;?>" valign=top style='width:112.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p>4.4 งานที่ภาควิชา / สาขาวิชา / คณะ / สำนัก / สถาบัน / มหาวิทยาลัยมอบหมาย</o:p>
    </span></p></td>
    <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==4):
?>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupTime'];?></o:p>
    </span></p></td>
    <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
    </span></p></td>
    <?php
 break;
 endif;
 endforeach;
?>
<?php endif;?>
  </tr>
  <?php
	$i=0; 
	foreach($otherworkgroup as $item):
	if($item['otherWorkgroupType']==4):
	$i+=1;
	if($i>1):
?>
  <tr style='mso-yfti-irow:7'>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupTime'];?></o:p>
    </span></p></td>
    <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
    </span></p></td>
  </tr>
  <?php
  endif;
 endif;
 endforeach;
 ?>
   <?php 
$i=0;
foreach($otherworkgroup as $item):
	if($item['otherWorkgroupType']==5):
	$i+=1;
	endif;
endforeach;
?>
<?php if($i!=0):?>
  <tr style='mso-yfti-irow:7' >
    <td width=324 colspan=2 rowspan="<?php echo $i;?>" valign=top style='width:112.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p>4.5 กรรมการเฉพาะกิจ</o:p>
    </span></p></td>
    <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==5):
?>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupTime'];?></o:p>
    </span></p></td>
    <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
    </span></p></td>
    <?php
 break;
 endif;
 endforeach;
?>
<?php endif;?>
  </tr>
  <?php
	$i=0; 
	foreach($otherworkgroup as $item):
	if($item['otherWorkgroupType']==5):
	$i+=1;
	if($i>1):
?>
  <tr style='mso-yfti-irow:7'>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupTime'];?></o:p>
    </span></p></td>
    <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
    </span></p></td>
  </tr>
  <?php
  endif;
 endif;
 endforeach;
 ?>
   <?php 
$i=0;
foreach($otherworkgroup as $item):
	if($item['otherWorkgroupType']==6):
	$i+=1;
	endif;
endforeach;
?>
<?php if($i!=0):?>
  <tr style='mso-yfti-irow:7' >
    <td width=324 colspan=2 rowspan="<?php echo $i;?>" valign=top style='width:112.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p>4.6 อื่นๆ</o:p>
    </span></p></td>
    <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==6):
?>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupTime'];?></o:p>
    </span></p></td>
    <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
    </span></p></td>
    <?php
 break;
 endif;
 endforeach;
?>
<?php endif;?>
  </tr>
  <?php
	$i=0; 
	foreach($otherworkgroup as $item):
	if($item['otherWorkgroupType']==6):
	$i+=1;
	if($i>1):
?>
  <tr style='mso-yfti-irow:7'>
    <td  valign=top style='width:243.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupSubject'];?></o:p>
    </span></p></td>
    <td  valign=top style='width:49.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupTime'];?></o:p>
    </span></p></td>
    <td  align="center" valign=top style='width:70.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal2><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
      <o:p><?php echo $item['otherWorkgroupHours'];?></o:p>
    </span></p></td>
  </tr>
  <?php
  endif;
 endif;
 endforeach;
 ?>
  <![if !supportMisalignedColumns]>
  <tr height=0>
    <td width=324 style='border:none'></td>
    <td width=619 style='border:none'></td>
    <td width=324 style='border:none'></td>
    <td width=66 style='border:none'></td>
    <td width=94 style='border:none'></td>
  </tr>
  <![endif]>
</table>
<p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=630
 style='width:477.0pt;margin-left:-.4pt;border-collapse:collapse;border:none;
 mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:1184;mso-padding-alt:
 0in 5.4pt 0in 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=294 valign=top style='width:220.55pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>รวมชั่วโมงทำการทั้งหมด</span></b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=342 valign=top style='width:256.45pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $totalhour;?> ชั่วโมงทำการ/สัปดาห์</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<span style='font-size:14.0pt;font-family:"AngsanaUPC","serif";mso-fareast-font-family:
Batang;mso-ansi-language:EN-US;mso-fareast-language:KO;mso-bidi-language:TH'><br
clear=all style='mso-special-character:line-break;page-break-before:always'>
</span>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=630
 style='margin-left:3.4pt;border-collapse:collapse;mso-table-layout-alt:fixed;
 border:none;mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:480;
 mso-padding-alt:0in 5.4pt 0in 5.4pt;mso-border-insideh:.5pt solid windowtext;
 mso-border-insidev:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=635 colspan=6 valign=top style='width:476.35pt;border:none;
  padding:0in 5.4pt 0in 5.4pt'><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif";
  mso-fareast-font-family:Batang;mso-ansi-language:EN-US;mso-fareast-language:
  KO;mso-bidi-language:TH'><br clear=all style='page-break-before:always'>
  </span>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ค.
  ข้อตกลงอื่นๆ</span></b><span lang=TH style='font-size:14.0pt;font-family:
  "AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=635 colspan=6 valign=top style='width:476.35pt;border:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-indent:.5in'><span lang=TH style='font-size:
  14.0pt;font-family:"AngsanaUPC","serif"'>การปฏิบัติงานที่ภาระงานและสัดส่วนของภาระงานแตกต่างไปจากกำหนด
  ให้ทำความตกลง และให้อธิการบดี <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=635 colspan=6 valign=top style='width:476.35pt;border:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>หรือผู้ที่อธิการบดีมอบหมายให้ความเห็นชอบเป็นการเฉพาะกรณี</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><span lang=TH><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=635 colspan=6 valign=top style='width:476.35pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=193 valign=top style='width:145.1pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กลุ่มงาน<o:p></o:p></span></p>
  </td>
  <td width=145 colspan=2 valign=top style='width:108.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>มาตรฐาน<o:p></o:p></span></p>
  </td>
  <td width=146 colspan=2 valign=top style='width:109.75pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ข้อตกลงที่ปฏิบัติ</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=151 rowspan=2 style='width:113.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>หมายเหตุ</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=193 valign=top style='width:145.1pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=54 valign=top style='width:40.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>สัดส่วน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=90 valign=top style='width:67.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชม.ทำการ/<span
  class=SpellE>สป</span></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>.<o:p></o:p></span></p>
  </td>
  <td width=54 valign=top style='width:40.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>สัดส่วน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=92 valign=top style='width:69.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ชม.ทำการ/<span
  class=SpellE>สป</span></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=193 valign=top style='width:145.1pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.งานสอน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=54 valign=top style='width:40.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>50</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=90 valign=top style='width:67.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>20</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=54 align="center" valign=top style='width:40.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['teachingWorkgroupAgrProportion'];?></o:p></span></p>
  </td>
  <td width=92 align="center" valign=top style='width:69.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['teachingWorkgroupAgrHours'];?></o:p></span></p>
  </td>
  <td width=151 valign=top style='width:113.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width=193 valign=top style='width:145.1pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2.งานวิจัยและงานวิชาการ</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=54 valign=top style='width:40.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>25</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=90 valign=top style='width:67.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>10</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=54 align="center" valign=top style='width:40.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['researchingWorkgroupAgrProportion'];?></o:p></span></p>
  </td>
  <td width=92 align="center" valign=top style='width:69.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['researchingWorkgroupAgrHours'];?></o:p>
  </span></p>
  </td>
  <td width=151 valign=top style='width:113.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
  <td width=193 valign=top style='width:145.1pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3.งานบริการวิชาการ</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=54 valign=top style='width:40.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>15</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=90 valign=top style='width:67.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>6</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=54 align="center" valign=top style='width:40.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['servicesWorkgroupAgrProportion'];?></o:p>
  </span></p>
  </td>
  <td width=92 align="center" valign=top style='width:69.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['servicesWorkgroupAgrHours'];?></o:p></span></p>
  </td>
  <td width=151 valign=top style='width:113.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9'>
  <td width=193 valign=top style='width:145.1pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.งานอื่นๆ</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=54 valign=top style='width:40.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>10</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=90 valign=top style='width:67.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=54 align="center" valign=top style='width:40.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['otherWorkgroupAgrProportion'];?></o:p>
  </span></p>
  </td>
  <td width=92 align="center" valign=top style='width:69.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p><?php echo $workload[0]['otherWorkgroupAgrHours'];?></o:p></span></p>
  </td>
  <td width=151 valign=top style='width:113.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;mso-yfti-lastrow:yes'>
  <td width=193 valign=top style='width:145.1pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>รวม<o:p></o:p></span></p>
  </td>
  <td width=54 valign=top style='width:40.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>100<o:p></o:p></span></p>
  </td>
  <td width=90 valign=top style='width:67.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>40<o:p></o:p></span></p>
  </td>
  <td width=54 align="center" valign=top style='width:40.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $totalproportion;?></o:p>
  </span></p>
  </td>
  <td width=92 align="center" valign=top style='width:69.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;<?php echo $totalhour;?></o:p>
  </span></p>
  </td>
  <td width=151 valign=top style='width:113.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=630
 style='width:477.9pt;border-collapse:collapse;mso-yfti-tbllook:1184;
 mso-padding-alt:0in 5.4pt 0in 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=637 colspan=4 valign=top style='width:477.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ทั้งนี้<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;
  </span>พนักงานมหาวิทยาลัยสายวิชาการ<span style='mso-spacerun:yes'>&nbsp;
  </span>ต้องทำแผนปฏิบัติการ ตามแบบแนบท้าย </span><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=42 valign=top style='width:31.75pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=175 valign=top style='width:131.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อ</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
  <td width=252 valign=top style='width:188.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=168 style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>วัน /เดือน/ปี</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=42 valign=top style='width:31.75pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=175 valign=top style='width:131.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1)
  ผู้ขอกำหนดภาระงาน</span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=252 style='width:188.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
    <o:p></o:p></span><span style="font-size:14.0pt;font-family:&quot;AngsanaUPC&quot;,&quot;serif&quot;">…………………………………………..</span></p>
  </td>
  <td width=168 style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-left:5.85pt;text-align:center;
  tab-stops:113.25pt'><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>…../………/…………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=42 valign=top style='width:31.75pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=175 valign=top style='width:131.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=252 style='width:188.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>( <?php echo $workload[0]['firstName'].' '.$workload[0]['lastName'];?> )
      <o:p></o:p></span></p>
  </td>
  <td width=168 style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-left:.8in;text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=42 valign=top style='width:31.75pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=595 colspan=3 valign=top style='width:446.15pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2)
  ผู้กำกับดูแล/ผู้ติดตามตรวจสอบและประเมินเบื้องต้น(คณะกรรมการคณะแต่งตั้ง)</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=42 valign=top style='width:31.75pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=175 valign=top style='width:131.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-left:127.35pt'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=252 style='width:188.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>…………………………………………..<o:p></o:p></span></p>
  </td>
  <td width=168 style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>…../………/…………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;mso-yfti-lastrow:yes'>
  <td width=42 valign=top style='width:31.75pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=175 valign=top style='width:131.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=252 style='width:188.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>(…………………………………………..)<o:p></o:p></span></p>
  </td>
  <td width=168 style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=630
 style='width:477.9pt;border-collapse:collapse;mso-yfti-tbllook:1184;
 mso-padding-alt:0in 5.4pt 0in 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=637 colspan=4 valign=top style='width:477.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ง.
  ข้อตกลงเพิ่มเติม (ระดับคณะ)</span></b><b><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=31 valign=top style='width:23.05pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=606 colspan=3 valign=top style='width:454.85pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1…………………………………………………………………………………………………………………..<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=637 colspan=4 valign=top style='width:477.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>……………………………………………………………………………………………………………………………..<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=31 valign=top style='width:23.05pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=606 colspan=3 valign=top style='width:454.85pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2…………………………………………………………………………………………………………………..<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=637 colspan=4 valign=top style='width:477.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>……………………………………………………………………………………………………………………………..<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=31 valign=top style='width:23.05pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=606 colspan=3 valign=top style='width:454.85pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3…………………………………………………………………………………………………………………..<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=637 colspan=4 valign=top style='width:477.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>……………………………………………………………………………………………………………………………..<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width=31 valign=top style='width:23.05pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=186 valign=top style='width:139.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อ</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
  <td width=253 valign=top style='width:189.6pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-left:14.85pt'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>วัน /เดือน/ปี</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
  <td width=31 valign=top style='width:23.05pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;</span><o:p></o:p></span></p>
  </td>
  <td width=186 valign=top style='width:139.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3)
  คณบดี/ผู้อำนวยการ</span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span><o:p></o:p></span></p>
  </td>
  <td width=253 style='width:189.6pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>…………………………………………..<o:p></o:p></span></p>
  </td>
  <td width=168 style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>…../………/…………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9'>
  <td width=31 valign=top style='width:23.05pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=186 valign=top style='width:139.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-left:84.6pt'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=253 style='width:189.6pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>(…………………………………………..)<o:p></o:p></span></p>
  </td>
  <td width=168 style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10'>
  <td width=31 valign=top style='width:23.05pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;</span><b><o:p></o:p></b></span></p>
  </td>
  <td width=186 valign=top style='width:139.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span style='mso-spacerun:yes'>4)
  ผู้ขอกำหนดภาระงาน</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'></span><b><o:p></o:p></b></span></p>
  </td>
  <td width=253 style='width:189.6pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>…………………………………………..<o:p></o:p></span></p>
  </td>
  <td width=168 style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>…../………/…………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;mso-yfti-lastrow:yes'>
  <td width=31 valign=top style='width:23.05pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=186 valign=top style='width:139.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=253 style='width:189.6pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>( <?php echo $workload[0]['firstName'].' '.$workload[0]['lastName'];?> )
      <o:p></o:p></span></p>
  </td>
  <td width=168 style='width:1.75in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=630
 style='width:477.9pt;border-collapse:collapse;mso-yfti-tbllook:1184;
 mso-padding-alt:0in 5.4pt 0in 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=637 colspan=4 valign=top style='width:477.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>จ.
  ความเห็นของอธิการบดี</span></b><b><span style='font-size:14.0pt;font-family:
  "AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=27 valign=top style='width:20.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=610 colspan=3 valign=top style='width:457.55pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>]<span style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  lang=TH>รับทราบ</span> /<span lang=TH>อนุมัติ</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=27 valign=top style='width:20.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=610 colspan=3 valign=top style='width:457.55pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>[<span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>]<span style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span
  lang=TH>มีข้อตกลง/มอบหมาย/เสนอแนะ เพิ่มเติม</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=27 valign=top style='width:20.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=610 colspan=3 valign=top style='width:457.55pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>...…………………………………………………………………………………………………………………..<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=637 colspan=4 valign=top style='width:477.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>……………………………………………………………………………………………………………………………..<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=27 valign=top style='width:20.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=165 valign=top style='width:123.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ลงชื่อ</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
  <td width=236 valign=top style='width:177.3pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=208 valign=top style='width:156.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-left:14.85pt'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>วัน /เดือน/ปี</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=27 valign=top style='width:20.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;</span><o:p></o:p></span></p>
  </td>
  <td width=165 valign=top style='width:123.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>5)
  อธิการบดี</span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span><o:p></o:p></span></p>
  </td>
  <td width=236 style='width:177.3pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>…………………………………………..<o:p></o:p></span></p>
  </td>
  <td width=208 style='width:156.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>…../………/…………<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;mso-yfti-lastrow:yes'>
  <td width=27 valign=top style='width:20.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=165 valign=top style='width:123.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-left:84.6pt'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=236 style='width:177.3pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>(…………………………………………..)<o:p></o:p></span></p>
  </td>
  <td width=208 style='width:156.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>

<b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif";mso-fareast-font-family:
Batang;mso-ansi-language:EN-US;mso-fareast-language:KO;mso-bidi-language:TH'><br
clear=all style='mso-special-character:line-break;page-break-before:always'>
</span></b>

<p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></b></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=1246
 style='width:474.95pt;margin-left:1.7pt;border-collapse:collapse;border:none;
 mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:1184;mso-padding-alt:
 0in 5.4pt 0in 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=633 colspan=14 style='width:474.95pt;border:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>แบบแนบท้าย
  การกำหนดภาระงานมาตรฐาน พนักงานมหาวิทยาลัย<span
  style='mso-spacerun:yes'>&nbsp; </span>สายวิชาการ</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=633 colspan=14 valign=top style='width:474.95pt;border:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>แผนการปฏิบัติงาน<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=633 colspan=14 valign=top style='width:474.95pt;border:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><span
  style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>ผู้ปฏิบัติงาน
  ให้กำหนดแผนการปฏิบัติงาน</span><span style='font-size:14.0pt;font-family:
  "AngsanaUPC","serif"'><span style='mso-spacerun:yes'>&nbsp; </span><span
  lang=TH>เพื่อเป็นแนวทางให้ปฏิบัติได้ชัดเจนยิ่งขึ้น
  และผู้ติดตามตรวจสอบและประเมินสามารถตรวจสอบ หรือ แนะนำ ทบทวนการปฏิบัติงานต่างๆได้ง่ายขึ้น</span><span
  style='mso-spacerun:yes'>&nbsp; </span><span lang=TH>ทั้งนี้
  รายละเอียดของงานและกิจกรรมในแต่ละกลุ่มงาน เมื่อนำมาใส่ในแผนการปฏิบัติ ให้นำ
  ตัวเลขประจำงาน/กิจกรรม มาลงในช่อง </span>“ <span lang=TH>หัวข้อ</span>” <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=633 colspan=14 valign=top style='width:474.95pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>เพื่อความสะดวกในการติดตาม</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=633 valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>หัวข้อ</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>รายละเอียดงาน/กิจกรรม<o:p></o:p></span></p>
  </td>
  <td width=32 style='width:24.3pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span class=SpellE><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>เมย</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=31 style='width:23.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span class=SpellE><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>พค</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=29 style='width:22.05pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span class=SpellE><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>มิย</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=30 style='width:22.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span class=SpellE><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กค</span></span><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=30 style='width:22.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span class=SpellE><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>สค</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=29 style='width:22.05pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span class=SpellE><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กย</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=30 style='width:22.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span class=SpellE><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ตค</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=30 style='width:22.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span class=SpellE><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>พย</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=29 style='width:22.05pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span class=SpellE><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>ธค</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=30 style='width:22.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span class=SpellE><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>มค</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=31 style='width:23.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span class=SpellE><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กพ</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=30 style='width:22.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-5.4pt'><span class=SpellE><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>มีค</span></span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=633 valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
  <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กลุ่มงานการสอน</span></b><b><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
  <td width=32 valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=633 valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.1</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>งานการสอน</span><span
  style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=32 valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==1):
 ?>
 <tr style='mso-yfti-irow:7'>
  <td width=633 valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['teachingWorkgroupSubject'];?>
  </span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
  </td>
  <td width=32 valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
<?php 
endif;
endforeach;?>
 <tr style='mso-yfti-irow:11'>
  <td width=633 valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.2<o:p></o:p></span></p>
  </td>
  <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>งานควบคุมวิทยานิพนธ์
  /การค้นคว้า /โครงการนักศึกษา</span><b><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'><o:p></o:p></span></b></p>
  </td>
  <td width=32 valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>

 <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==2):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['teachingWorkgroupSubject'];?> </span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
endif;
endforeach;?>

 <tr style='mso-yfti-irow:14'>
   <td width=633 valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.3<o:p></o:p></span></p>
     </td>
   <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>งานที่ปรึกษา<o:p></o:p></span></p>
     </td>
   <td width=32 valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
 </tr>
 <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==3):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['teachingWorkgroupSubject'];?> </span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
endif;
endforeach;?>

 <tr style='mso-yfti-irow:17'>
   <td width=633 valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.4<o:p></o:p></span></p>
     </td>
   <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>งานนิเทศ<o:p></o:p></span></p>
     </td>
   <td width=32 valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
 </tr>
 <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==4):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['teachingWorkgroupSubject'];?> </span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
  <?php 
endif;
endforeach;?>
 <tr style='mso-yfti-irow:20'>
   <td width=633 valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.5<o:p></o:p></span></p>
     </td>
   <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>งานประสานรายวิชา<span
  style='mso-spacerun:yes'>&nbsp; </span><o:p></o:p></span></p>
     </td>
   <td width=32 valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
 </tr>
 <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==5):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['teachingWorkgroupSubject'];?> </span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
  <?php 
endif;
endforeach;?>
 <tr style='mso-yfti-irow:20'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>1.6
     <o:p></o:p>
     </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>อื่นๆ<span
  style='mso-spacerun:yes'>&nbsp; </span>
     <o:p></o:p>
     </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
     </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
     </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
     </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
     </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
     </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
     </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
     </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
     </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
     </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
     </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
     </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
     </span></p></td>
 </tr>

 <?php foreach($teachingworkgroup as $item):
 if($item['teachingWorkgroupType']==6):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['teachingWorkgroupSubject'];?> </span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
endif;
endforeach;?>

 <tr style='mso-yfti-irow:21'>
   <td width=633 valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2<o:p></o:p></span></b></p>
     </td>
   <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กลุ่มงานวิจัยและงานวิชาการ</span></b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
     </td>
   <td width=32 valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
 </tr>
 <tr style='mso-yfti-irow:22'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2.1
     <o:p></o:p>
   </span></p></td>
  <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
    <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>โครงการวิจัย<o:p></o:p></span></p>
  </td>
  <td width=32 valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
  <?php foreach($researchingworkgroup as $item):
 if($item['researchingWorkgroupType']==1):
 ?>
 
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['researchingWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
 endif;
 endforeach;
 ?>
 <tr style='mso-yfti-irow:22'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2.2
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>การจัดทำตำราเอกสาร สื่อ หนังสือวิชาการ
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
   <?php foreach($researchingworkgroup as $item):
 if($item['researchingWorkgroupType']==2):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['researchingWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
 endif;
 endforeach;
 ?>
 <tr style='mso-yfti-irow:22'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>2.3
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>อื่นๆ     
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
   <?php foreach($researchingworkgroup as $item):
 if($item['researchingWorkgroupType']==3):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['researchingWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
<?php 
endif;
endforeach;
?>
 <tr style='mso-yfti-irow:25'>
   <td width=633 valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3<o:p></o:p></span></b></p>
     </td>
   <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กลุ่มงานบริการวิชาการ</span></b><span
  lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p></o:p></span></p>
     </td>
   <td width=32 valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
   <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
     </td>
 </tr>
 <tr style='mso-yfti-irow:26'>
  <td width=633 valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3.1<o:p></o:p></span></p>
  </td>
  <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กรรมการวิชาการพัฒนาหลักสูตร      
      <o:p></o:p>
  </span></p>
  </td>
  <td width=32 valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
    <?php foreach($servicesworkgroup as $item):
 if($item['servicesWorkgroupType']==1):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['servicesWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
endif;
endforeach;
?>
 <tr style='mso-yfti-irow:26'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3.2
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>การอบรมบุคคลภายนอก
         <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
     <?php foreach($servicesworkgroup as $item):
 if($item['servicesWorkgroupType']==2):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['servicesWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
  <?php 
endif;
endforeach;
?>
 <tr style='mso-yfti-irow:26'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3.3
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>คณะกรรมการตรวจประเมินคุณภาพการศึกษาภายใน
         <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
     <?php foreach($servicesworkgroup as $item):
 if($item['servicesWorkgroupType']==3):
 ?> 
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['servicesWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
   <?php 
endif;
endforeach;
?>
 <tr style='mso-yfti-irow:26'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>3.4
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>อื่นๆ
         <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
     <?php foreach($servicesworkgroup as $item):
 if($item['servicesWorkgroupType']==4):
 ?>  
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['servicesWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
   <?php 
endif;
endforeach;
?> 
 <tr style='mso-yfti-irow:29'>
  <td width=633 valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4<o:p></o:p></span></b></p>
  </td>
  <td width=222 valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>กลุ่มงานอื่นๆ<o:p></o:p></span></b></p>
  </td>
  <td width=32 valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=29 valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=31 valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=30 valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:26'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.1
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>กรรมการส่งเสริมกิจกรรมมหาวิทยาลัย</span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
    <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==1):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['otherWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
 <?php 
endif;
endforeach;
?>
 <tr style='mso-yfti-irow:26'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.2
         <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>กรรมการประจำหลักสูตร</span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
     <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==2):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['otherWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
  <?php 
endif;
endforeach;
?>
 <tr style='mso-yfti-irow:26'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.3
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>กรรมการประจำคณะ / ศูนย์ / สถาบัน</span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
      <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==3):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['otherWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
   <?php 
endif;
endforeach;
?>
 <tr style='mso-yfti-irow:26'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.4
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>งานที่ภาควิชา / สาขาวิชา / คณะ / สำนัก / สถาบัน /มหาวิทยาลัยมอบหมาย</span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
       <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==4):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['otherWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
    <?php 
endif;
endforeach;
?>
 <tr style='mso-yfti-irow:26'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.5
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>กรรมการเฉพาะกิจ</span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
        <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==5):
 ?>
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['otherWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
     <?php 
endif;
endforeach;
?>
 <tr style='mso-yfti-irow:26'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>4.6
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size: 14.0pt; font-family: &quot;AngsanaUPC&quot;, &quot;serif&quot;'>อื่นๆ</span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
        <?php foreach($otherworkgroup as $item):
 if($item['otherWorkgroupType']==6):
 ?> 
 <tr style='mso-yfti-irow:7'>
   <td valign=top style='width:34.05pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-right:-.15in'><span style='font-size:14.0pt;
  font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:166.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'><?php echo $item['otherWorkgroupSubject'];?></span><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p></o:p>
   </span></p></td>
   <td valign=top style='width:24.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:23.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
   <td valign=top style='width:22.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal><span style='font-size:14.0pt;font-family:"AngsanaUPC","serif"'>
     <o:p>&nbsp;</o:p>
   </span></p></td>
 </tr>
     <?php 
endif;
endforeach;
?>
</table>

</div>

</body>

</html>
