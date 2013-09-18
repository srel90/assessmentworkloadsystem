<?php
session_start();
require_once('MySQL.class.php');
$database= new database();
if(!isset($_SESSION['users'])||empty($_SESSION['users'])){header("location:index.php");}else{
$role=$database->checkrole($_SESSION['users'][0]['userTypeID'],$_SERVER['PHP_SELF']);
if($role==0)header("location:nopermission.php");}
/*SERVER CODE---------------------------------------------------------------------------*/
$personal=$_SESSION['users'];
if(isset($_GET) && !empty($_GET)):
switch($_GET['mode']):
	case 'selectAllUserType':
		$strsql="SELECT * FROM usertype";
		$database->showDataAsJson($strsql);
	break;	
endswitch;
exit();	
endif;
if(isset($_POST) && !empty($_POST)):
/*START*/
switch($_POST['mode']):
	case 'insert':
		$strsql="INSERT INTO usertype (userType,status)VALUES('".$_POST['userType']."','".$_POST['status']."')";
		if($database->execute($strsql)){
		echo 'true';
		}else{
		echo 'false';
		}
	break;
	case 'update':
		$strsql="UPDATE usertype SET userType='".$_POST['userType']."',status='".$_POST['status']."' WHERE userTypeID='".$_POST['userTypeID']."'";		
		if($database->execute($strsql)){
		echo 'true';
		}else{
		echo 'false';
		}
	break;
	case 'delete':
		$strsql="DELETE FROM usertype WHERE userTypeID='".$_POST['userTypeID']."'";	
		if($database->execute($strsql)){
		echo 'true';
		}else{
		echo 'false';
		}
	break;
	case 'getLastID':
		$strsql="SELECT AUTO_INCREMENT AS lastID FROM information_schema.tables WHERE table_name='userType' AND table_schema = 'assessmentworkloadsystem'";
		$data=$database->query($strsql);
		echo $data[0]['lastID'];
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
<link href="css/kendo.black.min.css" rel="stylesheet" />
<script src="js/kendo/kendo.all.min.js"></script>
<!--ENDS Kendo UI-->
<!--JQUERY FORM-->
<script src="js/jquery.form.min.js" type="text/javascript"></script>
<!--ENDS JQUERY FORM-->
<script type="text/javascript">
<!--
$(function() {
	$('#m2').addClass('current-menu-item');
	script.initial();
	script.validation();
	script.eventhandle();
	script.clearform();
});
var script= new function() {
	var validator = $("#scriptForm");
	var status=$('#error');
	this.initial=function(){
    	$('#error').hide(); 
		$("#userTypeList").kendoGrid({
	        dataSource: {
	        	transport: {read: "usertype.php?mode=selectAllUserType"},	            
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
	        /*groupable: true,*/
	        sortable: true,
	        columnMenu: true,
	        selectable: "multiple",
	        pageable: {pageSizes: true},
	        columns: [ 
	        	{field: "userTypeID",title: "ลำดับ",width: 60, type: "number"},
	        	{field: "userType",title: "ประเภทผู้ใช้"},
	        	{field: "status", title:"สถานะ",template:'#=status==1?"ใช้งาน":"ไม่ใช้งาน"#'}
	        	],
	        toolbar: [
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="addNew"><img src="img/mono-icons/doc_plus.png" width="12px">เพื่ม</a>'
	        	},
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="edit"><img src="img/mono-icons/doc_edit.png" width="12px">แก้ไข</a>'
	        	},
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="delete"><img src="img/mono-icons/doc_delete.png" width="12px">ลบ</a>'
	        	},
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="cancel"><img src="img/mono-icons/undo.png" width="12px">ยกเลิก</a>'
	        	}

				]
	    });
    	                
	}//end initial
	this.eventhandle=function(){
		$("#addNew").click(function(){
		if($("#addNew").hasClass("k-state-disabled"))return;
				$("#addNew").addClass("k-state-disabled");
				$("#edit").addClass("k-state-disabled");
				$("#delete").addClass("k-state-disabled");			
				script.clearform();
				$('#mode').val('insert');				
	
		});
		$("#edit").click(function(){
		if($("#edit").hasClass("k-state-disabled"))return;
			var userTypeList = $("#userTypeList ").data("kendoGrid");
			var selectedItem = userTypeList.dataItem(userTypeList.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการแก้ไข.');return;}
				$("#addNew").addClass("k-state-disabled");
				$("#edit").addClass("k-state-disabled");
				$("#delete").addClass("k-state-disabled");								
				$('#mode').val('update');
				
				$('#userTypeID').val(selectedItem.userTypeID);
				$('#userType').val(selectedItem.userType);
				setRDOValue('status',selectedItem.status);			
		});
		$("#delete").click(function(){
		if($("#delete").hasClass("k-state-disabled"))return;
			var userTypeList = $("#userTypeList ").data("kendoGrid");
			var selectedItem = userTypeList.dataItem(userTypeList.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการลบ.');return;}
			if(confirm('คุณต้องการลบรายการนี้หรือไม่?')){
				if(ajax('usertype.php',({mode:'delete',typeID:selectedItem.userTypeID}),false)=='true'){
					script.clearform();
				}
			}							
		});		
		$("#cancel").click(function(){
			$("#addNew").removeClass("k-state-disabled");
			$("#edit").removeClass("k-state-disabled");
			$("#delete").removeClass("k-state-disabled");
			
			
			script.clearform();
		});
		
		$("#save").click(function() {
			$("#addNew").removeClass("k-state-disabled");
			$("#edit").removeClass("k-state-disabled");
			$("#delete").removeClass("k-state-disabled");

            if (validator.validate()) {
                status.hide();
                script.save();
            } else {
                status.html("มีบางรายการป้อนข้อมูลไม่ถูกต้อง.").show();
            }
        });
	}//end eventhandle
	this.validation=function(){
	validator = $('#scriptForm').kendoValidator().data("kendoValidator"),status = $('#error');	
	}//end validator
	this.save=function(){
	$('#loading').show();
	var options = {
				success:function(response) {
				//console.log(response);
					$('#loading').hide();
					if($.trim(response)=='true'){
			            alert("ดำเนินการเรียบร้อย.");
			            script.clearform();
		            }else{
		            	alert("ไม่สามารถดำเนินการได้!");
		            } 
			    }
			};
			$("#scriptForm").ajaxSubmit(options);
	}//end save
	this.clearform=function(){
		$("#userTypeList").data("kendoGrid").clearSelection();
		$("#userTypeList").data("kendoGrid").dataSource.read();
		$("#userTypeList").data("kendoGrid").refresh();
		HTMLFormElement.prototype.reset.call($('#scriptForm')[0]);
		//$('#scriptForm')[0].reset();
		var lastID=ajax('usertype.php',({mode:'getLastID'}),false);
		$('#userTypeID').val(lastID);
		$('#mode').val('insert');
	}//end clearForm

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
				<form id="scriptForm" action="usertype.php" method="post" name="scriptForm">
					<input id="mode" name="mode" type="hidden" value="insert" />
					<?php include_once('profileheader.php'); ?>
					<fieldset>
					<legend style="color: #37b2d1">จัดการข้อมูลประเภทผู้ใช้</legend>
					<fieldset>
					<legend style="color: #37b2d1">รายการประเภทผู้ใช้</legend>
					<div id="userTypeList">
					</div>
					</fieldset> <fieldset>
					<legend style="color: #37b2d1">ข้อมูลประเภทผู้ใช้</legend>
					<div>
						<div>
							<label>ลำดับ :</label>
							<input id="userTypeID" class="input" name="userTypeID" readonly title="คลิกปุ่มเพิ่มข้อมูลเพื่อสร้างรหัสใหม่" type="text">
							<span class="k-invalid-msg" data-for="userTypeID">
							</span></div>
						<div>
							<label>ประเภทผู้ใช้ :</label>
							<input id="userType" class="input" name="userType" required title="พิมพ์ประเภทผู้ใช้" type="text">*
							<span class="k-invalid-msg" data-for="userType"></span>
						</div>
						<div>
							<label>สถานะ :</label>
							<input id="status0" name="status" title="Inctive" type="radio" value="0">ไม่ใช้งาน
							<input id="status1" checked="checked" name="status" title="Active" type="radio" value="1">ใช้งาน
						</div>
					</div>
					<div class="clear" style="height: 10px">
					</div>
					<input id="save" class="k-button" name="save" type="button" value="บันทึก" />
					<img id="loading" alt="" src="img/loading.gif" style="vertical-align: middle; display: none;">
					<p id="error" class="warning">Message</p>
					</fieldset> </fieldset></form>
			</div>
		</div>
		<!-- ENDS content --></div>
	<!-- ENDS wrapper-main --></div>
<!-- ENDS MAIN -->
<!-- Bottom --><?php include_once('bottom.php'); ?>
<!-- ENDS Bottom -->

</body>

</html>
