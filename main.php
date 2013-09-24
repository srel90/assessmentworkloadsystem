<?php
session_start();
if(!isset($_SESSION['users'])||empty($_SESSION['users']))header("location:index.php");
/*SERVER CODE---------------------------------------------------------------------------*/
require_once('MySQL.class.php');
$database= new database();
$personal=$_SESSION['users'];
if(isset($_GET) && !empty($_GET)):
/*START*/
switch($_GET['mode']):
		case 'selectAllCompleteWorkload':
		$strsql="SELECT w.*,f.faculty FROM workload w LEFT OUTER JOIN faculty f ON w.facultyID=f.facultyID where w.status='3' AND userID='".$personal[0]['userID']."'";
		$database->showDataAsJson($strsql);
	break;
	case 'selectAllNotCompleteWorkload':
		$strsql="SELECT w.*,f.faculty FROM workload w LEFT OUTER JOIN faculty f ON w.facultyID=f.facultyID where w.status in('0','1','2') AND userID='".$personal[0]['userID']."'";
		$database->showDataAsJson($strsql);
	break;
	case 'workloadListWaitingForCheck':		
		$strsql="SELECT w.*,f.faculty FROM workload w 		 
		LEFT OUTER JOIN faculty f ON w.facultyID=f.facultyID
		where w.status='1' AND w.mentorID='".$personal[0]['userID']."'";
		$database->showDataAsJson($strsql);
	break;
endswitch;
/*ENDS*/
exit();
endif;
if(isset($_POST) && !empty($_POST)):
/*START*/
switch($_POST['mode']):
	case 'updateWorkload':
		$strsql="UPDATE workload SET 
		status='".$_POST['status']."',
		comment='".$_POST['comment']."'
		WHERE workloadID='".$_POST['workloadID']."'";
		if($database->execute($strsql)){
			echo 'true';
		}else{
			echo 'false';
		}
	break;
endswitch;
/*ENDS*/
exit();
endif;
/*END SERVER CODE-----------------------------------------------------------------------*/
?>
<!DOCTYPE  html>
<html>

<head>
<meta charset="utf-8">
<title>The assessment workload system</title>
<!-- CSS -->
<link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/social-icons.css" media="screen" rel="stylesheet" type="text/css" />
<!--[if IE 8]>
<link href="css/ie8-hacks.css" media="screen" rel="stylesheet" type="text/css" />
<![endif]-->
<!-- ENDS CSS -->
<!-- GOOGLE FONTS 
		<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>-->
<!-- JS -->
<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script>
<script src="js/easing.js" type="text/javascript"></script>
<script src="js/jquery.scrollTo-1.4.2-min.js" type="text/javascript"></script>
<script src="js/jquery.cycle.all.js" type="text/javascript"></script>
<script src="js/common.js" type="text/javascript"></script>
<script src="js/utility.js" type="text/javascript"></script>
<!--[if IE]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--><!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript"></script>
<script>
	      		/* EXAMPLE */
	      		//DD_belatedPNG.fix('*');
</script>
<![endif]-->
<!-- ENDS JS -->
<!-- superfish -->
<link href="css/superfish.css" media="screen" rel="stylesheet" />
<script src="js/superfish-1.4.8/js/hoverIntent.js" type="text/javascript"></script>
<script src="js/superfish-1.4.8/js/superfish.js" type="text/javascript"></script>
<script src="js/superfish-1.4.8/js/supersubs.js" type="text/javascript"></script>
<!-- ENDS superfish -->
<!-- poshytip -->
<link href="js/poshytip-1.0/src/tip-twitter/tip-twitter.css" rel="stylesheet" type="text/css" />
<link href="js/poshytip-1.0/src/tip-yellowsimple/tip-yellowsimple.css" rel="stylesheet" type="text/css" />
<script src="js/poshytip-1.0/src/jquery.poshytip.min.js" type="text/javascript"></script>
<!-- ENDS poshytip -->
<!--Kendo UI-->
<link href="css/kendo.common.min.css" rel="stylesheet" />
<link href="css/kendo.default.min.css" rel="stylesheet" />
<script src="js/kendo/kendo.all.min.js"></script>
<!--ENDS Kendo UI-->
<!--JQUERY FORM-->
<script src="js/jquery.form.min.js" type="text/javascript"></script>
<!--ENDS JQUERY FORM-->
<script type="text/javascript">
<!--
$(function() {
	$('#m1').addClass('current-menu-item');
	script.initial();
	script.eventhandle();
});
var script= new function() {
	var formcomment;
	this.initial=function(){
	$("#workloadListNotComplete").kendoGrid({
                        dataSource: {
							transport: {read: "main.php?mode=selectAllNotCompleteWorkload"},	            
							dataType: "json",
							autoSync: true,
							pageSize: 5,
							schema: {
								data: "data",
								total:"total"
							}				
			            },
                        filterable: true,
                        resizable: true,
                        reorderable: true,
                        groupable: true,
                        sortable: true,
                        columnMenu: true,
                        selectable: "multiple",
                        pageable: {pageSizes: true},
                        columns: [ 
							{field: "workloadID",title: "ลำดับ",width: 60, type: "number"},
				        	{field: "faculty",title: "คณะ"},
				        	{field: "semester",title: "ภาคการศึกษา"},
				        	{field: "year",title: "ปีการศึกษา"},
							{field: "comment",title: "ข้อเสนอแนะ",template:function (dataItem) {
          if (comment != "") {
            return "<a href=\"javascript:viewcomment("+dataItem.workloadID+")\">ดูข้อเสนอแนะ</a>";
          } else {
            return "";
          }
        }
      },
				        	{field: "status", title:"สถานะ",template:'#=status==0?"ยังไม่เสร็จสมบูรณ์":status==1?"กำลังส่งตรวจสอบ":status==2?"มีข้อปรับปรุง":"ตรวจสอบแล้ว"#'}
                        	]
                    });
		$("#workloadListWaitingForCheck").kendoGrid({
                        dataSource: {
							transport: {read: "main.php?mode=workloadListWaitingForCheck"},	            
							dataType: "json",
							autoSync: true,
							pageSize: 5,
							schema: {
								data: "data",
								total:"total"
							}				
			            },
                        filterable: true,
                        resizable: true,
                        reorderable: true,
                        groupable: true,
                        sortable: true,
                        columnMenu: true,
                        selectable: "multiple",
                        pageable: {pageSizes: true},
                        columns: [ 
							{field: "workloadID",title: "ลำดับ",width: 60, type: "number"},
				        	{field: "faculty",title: "คณะ"},
				        	{field: "semester",title: "ภาคการศึกษา"},
				        	{field: "year",title: "ปีการศึกษา"},
							{field: "comment",title: "ข้อเสนอแนะ",template:function (dataItem) {
          if (dataItem.comment != "") {
            return "<a href=\"javascript:viewcomment("+dataItem.workloadID+")\">ดูข้อเสนอแนะ</a>";
          } else {
            return "";
          }
        }
      },
				        	{field: "status", title:"สถานะ",template:'#=status==0?"ยังไม่เสร็จสมบูรณ์":status==1?"กำลังส่งตรวจสอบ":status==2?"มีข้อปรับปรุง":"ตรวจสอบแล้ว"#'}
                        	],
						toolbar: [
	        	{template: '<a class="k-button" href="javascript:;" id="btnPrintForm1"><img src="img/mono-icons/doc_plus.png" width="12px">โหลดแบบ ภวช 1</a>'}
	        	,{template: '<a class="k-button" href="javascript:;" id="btnPrintForm2"><img src="img/mono-icons/doc_plus.png" width="12px">โหลดแบบ ภวช 2</a>'}
				,{template: '<a class="k-button" href="javascript:;" id="btnCheck"><img src="img/mono-icons/doc_plus.png" width="12px">ตรวจสอบเรียบร้อยแล้ว</a>'}

				]
                    });
		formcomment= $("#formcomment");
	        if (!formcomment.data("kendoWindow")) {
	            formcomment.kendoWindow({
	            	width: "800px",
	            	height:"400px",
	                title: "ส่งผลการตรวจสอบ",
	                modal:true,
	                animation:false,
	                visible:false
	            });
	        } 
			$("#comment").kendoEditor();
	                    
	}
	this.eventhandle=function(){
		$('#btnPrintForm1').click(function(e) {
            var workloadListComplete = $("#workloadListWaitingForCheck").data("kendoGrid");
			var selectedItem = workloadListComplete.dataItem(workloadListComplete.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการ.');return;}
			window.open("workload1.php?workloadID="+selectedItem.workloadID);
        });
		$('#btnPrintForm2').click(function(e) {
            var workloadListComplete = $("#workloadListWaitingForCheck").data("kendoGrid");
			var selectedItem = workloadListComplete.dataItem(workloadListComplete.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการ.');return;}
			window.open("workload2.php?workloadID="+selectedItem.workloadID);
        });
		$('#btnCheck').click(function(e) {
            var workloadListComplete = $("#workloadListWaitingForCheck").data("kendoGrid");
			var selectedItem = workloadListComplete.dataItem(workloadListComplete.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการ.');return;}
			$('#workloadID').val(selectedItem.workloadID);
			formcomment.data("kendoWindow").center().open();
        });
		$('#commentSave').click(function(e) {
            var datastring=new Object();
	        datastring.comment=$('#comment').val();
	        datastring.workloadID=$('#workloadID').val();
			datastring.status=getRDOValue("status");
			datastring.mode="updateWorkload";
			var response=ajax('main.php',datastring,false);
			if($.trim(response)=='true'){
				alert("ส่งผลการตรวจสอบเรียบร้อย");
			formcomment.data("kendoWindow").center().close();
			$("#workloadListWaitingForCheck").data("kendoGrid").dataSource.read();
			}
        });
		
	}
}
function viewcomment(workloadID){
	window.open("comment.php?workloadID="+workloadID);
}
//-->
</script>
</head>

<body class="home">

<!-- Menu -->
<div id="menu">
	<?php include_once('menu.php'); ?></div>
<!-- ENDS Menu -->
<!-- MAIN -->
<div id="main">
	<!-- wrapper-main -->
	<div class="wrapper">
		<!-- content -->
		<div id="content">
			<div class="box">
				<form action="" method="post">
					<?php include_once('profileheader.php'); ?>
					<fieldset>
					<legend style="color: #37b2d1">รายการแบบภวช 1 (ยังไม่ได้รับการตรวจสอบ)</legend>
					<div id="workloadListNotComplete">
					</div>
					</fieldset>
					<fieldset>
					<legend style="color: #37b2d1">รายการแบบภวช 1 (รอการตรวจสอบในฐานะพี่เลี้ยง)</legend>
					<div id="workloadListWaitingForCheck">
					</div>
                    <div id="formcomment">
					<div>
					  <label>ข้อความเสนอแนะ :</label>
                      	<input id="workloadID" class="input" name="workloadID" type="hidden" >
                            <textarea id="comment" name="comment" title="พิพม์ข้อเสนอแนะ" cols="50" rows="12"></textarea>
							<span class="k-invalid-msg" data-for="comment">
							</span>
						</div>
                    <div>
					  <label>ผลการตรวจสอบ :</label>
                      	<input id="status0" name="status"  type="radio" value="3">ตรวจสอบเรียบร้อย
						<input id="status1" checked="checked" name="status" type="radio" value="2">มีข้อควรปรับปรุง
						</div>    
						<input id="commentSave" class="k-button" name="commentSave" type="button" value="ส่งผลการตรวจสอบ" />


					</div>
					</fieldset>

				</form>
			</div>
		</div>
		<!-- ENDS content --></div>
	<!-- ENDS wrapper-main --></div>
<!-- ENDS MAIN -->
<!-- Bottom --><?php include_once('bottom.php'); ?>
<!-- ENDS Bottom -->

</body>

</html>
