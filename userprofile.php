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
	case 'selectAllUser':
	$strsql="SELECT u.*,ut.usertype,concat(uu.firstName,' ',uu.lastName) as mentorName FROM users u LEFT OUTER JOIN usertype ut ON u.userTypeID=ut.userTypeID LEFT OUTER JOIN users uu ON u.mentorID=uu.userID";
	$database->showDataAsJson($strsql);
	break;
endswitch;
exit();	
endif;
if(isset($_POST) && !empty($_POST)):
/*START*/
switch($_POST['mode']):
	case 'selectUser':
	$strsql="SELECT u.*,ut.usertype,concat(uu.firstName,' ',uu.lastName) as mentorName FROM users u LEFT OUTER JOIN usertype ut ON u.userTypeID=ut.userTypeID LEFT OUTER JOIN users uu ON u.mentorID=uu.userID WHERE u.userID='".$_POST['userID']."'";
	$database->showDataAsJson($strsql);
	break;
	case 'insert':
		$strsql="INSERT INTO users(
		code
		,mentorID
		,IDCard
		,userTypeID
		,firstName
		,lastName
		,userStatus
		,username
		,password
		,dateOfBirth
		,bachelorDegreeDiscipline
		,bachelorDegreeInstitution
		,bachelorDegreeGraduate
		,mastersDegreeDiscipline
		,mastersDegreeInstitution
		,mastersDegreeGraduate
		,doctorateDegreeDiscipline
		,doctorateDegreeInstitution
		,doctorateDegreeGraduate
		,diplomaDiscipline
		,diplomaInstitution
		,diplomaGraduate
		,address
		,phone
		,email
		,registerDate
		,currentSalary
		,status
		)VALUES(
		'".$_POST['code']."'
		,'".$_POST['mentorID']."'
		,'".$_POST['IDCard']."'
		,'".$_POST['userTypeID']."'
		,'".$_POST['firstName']."'
		,'".$_POST['lastName']."'
		,'".$_POST['userStatus']."'
		,'".$_POST['username']."'
		,MD5('".$_POST['password']."')
		,'".$_POST['dateOfBirth']."'
		,'".$_POST['bachelorDegreeDiscipline']."'
		,'".$_POST['bachelorDegreeInstitution']."'
		,'".$_POST['bachelorDegreeGraduate']."'
		,'".$_POST['mastersDegreeDiscipline']."'
		,'".$_POST['mastersDegreeInstitution']."'
		,'".$_POST['mastersDegreeGraduate']."'
		,'".$_POST['doctorateDegreeDiscipline']."'
		,'".$_POST['doctorateDegreeInstitution']."'
		,'".$_POST['doctorateDegreeGraduate']."'
		,'".$_POST['diplomaDiscipline']."'
		,'".$_POST['diplomaInstitution']."'
		,'".$_POST['diplomaGraduate']."'
		,'".$_POST['address']."'
		,'".$_POST['phone']."'
		,'".$_POST['email']."'
		,'".$_POST['registerDate']."'
		,'".$_POST['currentSalary']."'
		,'".$_POST['status']."'
		)";
		if($database->execute($strsql)){
		echo 'true';
		}else{
		echo 'false';
		}
	break;
	case 'update':
		$strsql="
		UPDATE users SET 
		code='".$_POST['code']."'
		,mentorID='".$_POST['mentorID']."'
		,IDCard='".$_POST['IDCard']."'
		,userTypeID='".$_POST['userTypeID']."'
		,firstName='".$_POST['firstName']."'
		,lastName='".$_POST['lastName']."'
		,userStatus='".$_POST['userStatus']."'
		,username='".$_POST['username']."'
		,dateOfBirth='".$_POST['dateOfBirth']."'
		,bachelorDegreeDiscipline='".$_POST['bachelorDegreeDiscipline']."'
		,bachelorDegreeInstitution='".$_POST['bachelorDegreeInstitution']."'
		,bachelorDegreeGraduate='".$_POST['bachelorDegreeGraduate']."'
		,mastersDegreeDiscipline='".$_POST['mastersDegreeDiscipline']."'
		,mastersDegreeInstitution='".$_POST['mastersDegreeInstitution']."'
		,mastersDegreeGraduate='".$_POST['mastersDegreeGraduate']."'
		,doctorateDegreeDiscipline='".$_POST['doctorateDegreeDiscipline']."'
		,doctorateDegreeInstitution='".$_POST['doctorateDegreeInstitution']."'
		,doctorateDegreeGraduate='".$_POST['doctorateDegreeGraduate']."'
		,diplomaDiscipline='".$_POST['diplomaDiscipline']."'
		,diplomaInstitution='".$_POST['diplomaInstitution']."'
		,diplomaGraduate='".$_POST['diplomaGraduate']."'
		,address='".$_POST['address']."'
		,phone='".$_POST['phone']."'
		,email='".$_POST['email']."'
		,registerDate='".$_POST['registerDate']."'
		,currentSalary='".$_POST['currentSalary']."'
		,status='".$_POST['status']."'
		";
		if(!empty($_POST['password'])){
		$strsql.=",password=MD5('".$_POST['password']."')";
		}
		$strsql.=" WHERE userID='".$_POST['userID']."'";
		if($database->execute($strsql)){
		$strsql="SELECT u.*,ut.usertype FROM users u LEFT OUTER JOIN usertype ut ON u.userTypeID=ut.userTypeID WHERE u.userID='".$_POST['userID']."'";
		$data=$database->query($strsql);
		$_SESSION['users']=$data;	
		echo 'true';
		}else{
		echo 'false';
		}
	break;	
	case 'delete':
		$strsql="DELETE FROM users WHERE userID='".$_POST['userID']."'";	
		if($database->execute($strsql)){
		echo 'true';
		}else{
		echo 'false';
		}
	break;
	case 'getLastID':
		$strsql="SELECT AUTO_INCREMENT AS lastID FROM information_schema.tables WHERE table_name='users' AND table_schema = 'assessmentworkloadsystem'";
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
	script.eventhandle();
	script.validation();	
	script.clearform();
});
var script= new function() {
	var validator = $("#profileForm");
	var status=$('#error');
	var formAddMentor;
	this.initial=function(){
    	$('#error').hide(); 
		$("#gridTable").kendoGrid({
	        dataSource: {
	        	transport: {read: "userprofile.php?mode=selectAllUser"},	            
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
	        pageable: {
	            pageSizes: true
	        },
	        columns: [ 
	        	{field: "userID",title: "ลำดับ",width: 60},
	        	{field: "IDCard",title: "รหัสประจำตัวประชาชน"},
	        	{field: "firstName",title: "ชื่อ"},	        	
	        	{field: "lastName",title: "นามสกุล"},
	        	{field: "username",title: "ชื่อผู้ใช้"},
	        	{field: "phone",title: "เบอร์โทรศัพท์"},
	        	{field: "email",title: "อีเมล์"},
	        	{field: "userType",title: "ประเภทผู้ใช้"},	        	
	        	{field: "status", title:"สถานะ",template:'#=status==1?"ใช้งาน":"ระงับ"#'}
	        	],
	        toolbar: [
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="addNew"><img src="img/mono-icons/doc_plus.png" width="12px">เพิ่ม</a>'
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
	    $("#gridTableUser").kendoGrid({
	        dataSource: {
	        	transport: {read: "userprofile.php?mode=selectAllUser"},	            
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
	        pageable: {
	            pageSizes: true
	        },
	        columns: [ 
	        	{field: "userID",title: "ลำดับ",width: 60},
	        	{field: "IDCard",title: "รหัสประจำตัวประชาชน"},
	        	{field: "firstName",title: "ชื่อ"},	        	
	        	{field: "lastName",title: "นามสกุล"},
	        	{field: "userType",title: "ประเภทผู้ใช้"},	        	
	        	{field: "status", title:"สถานะ",template:'#=status==1?"ใช้งาน":"ระงับ"#'}
	        	],
	        toolbar: [
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="btnSelect"><img src="img/mono-icons/doc_plus.png" width="12px">เลือกรายการ</a>'
	        	}
				]
	    });

	    $('#userTypeID').kendoDropDownList();
	    $('#registerDate,#dateOfBirth').kendoDatePicker({format: "yyyy-MM-dd"});  
	    $("#currentSalary").kendoNumericTextBox({format: "#.00"});
	    formAddMentor= $("#formAddMentor");
        if (!formAddMentor.data("kendoWindow")) {
            formAddMentor.kendoWindow({
            	width: "800px",
            	height:"300px",
                title: "Add mentor",
                modal:true,
                animation:false,
                visible:false
            });
        }  	                
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
			var gridTable = $("#gridTable").data("kendoGrid");
			var selectedItem = gridTable.dataItem(gridTable.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการแก้ไข.');return;}
				$("#addNew").addClass("k-state-disabled");
				$("#edit").addClass("k-state-disabled");
				$("#delete").addClass("k-state-disabled");								
				$('#mode').val('update');
				$('#userID').val(selectedItem.userID);
				$('#code').val(selectedItem.code);
				var user=$.parseJSON(ajax('userprofile.php',({mode:'selectUser',userID:selectedItem.userID})));
				$('#mentorName').val(user.data[0].mentorName);
				$('#mentorID').val(selectedItem.mentorID);
				$('#IDCard').val(selectedItem.IDCard);
				$('#userTypeID').data("kendoDropDownList").select(function(dataItem) {
				    return dataItem.value === selectedItem.userTypeID;
				});
				$('#firstName').val(selectedItem.firstName);
				$('#lastName').val(selectedItem.lastName);
				setRDOValue('userStatus',selectedItem.userStatus);
				$('#username').val(selectedItem.username);
				$('#dateOfBirth').val(selectedItem.dateOfBirth);				
				$('#bachelorDegreeDiscipline').val(selectedItem.bachelorDegreeDiscipline);
				$('#bachelorDegreeInstitution').val(selectedItem.bachelorDegreeInstitution);
				$('#bachelorDegreeGraduate').val(selectedItem.bachelorDegreeGraduate);
				$('#mastersDegreeDiscipline').val(selectedItem.mastersDegreeDiscipline);
				$('#mastersDegreeInstitution').val(selectedItem.mastersDegreeInstitution);
				$('#mastersDegreeGraduate').val(selectedItem.mastersDegreeGraduate);
				$('#doctorateDegreeDiscipline').val(selectedItem.doctorateDegreeDiscipline);
				$('#doctorateDegreeInstitution').val(selectedItem.doctorateDegreeInstitution);
				$('#doctorateDegreeGraduate').val(selectedItem.doctorateDegreeGraduate);
				$('#diplomaDiscipline').val(selectedItem.diplomaDiscipline);
				$('#diplomaInstitution').val(selectedItem.diplomaInstitution);
				$('#diplomaGraduate').val(selectedItem.diplomaGraduate);
				$('#address').val(selectedItem.address);
				$('#phone').val(selectedItem.phone);
				$('#email').val(selectedItem.email);
				$('#registerDate').val(selectedItem.registerDate);
				$('#currentSalary').data("kendoNumericTextBox").value(selectedItem.currentSalary);
				setRDOValue('status',selectedItem.status);			
		});
		$("#delete").click(function(){
		if($("#delete").hasClass("k-state-disabled"))return;
			var gridTable = $("#gridTable ").data("kendoGrid");
			var selectedItem = gridTable.dataItem(gridTable.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการลบ.');return;}
			if(confirm('คุณต้องการลบรายการนี้หรือไม่?')){
				if(ajax('userprofile.php',({mode:'delete',userID:selectedItem.userID}),false)=='true'){
					script.clearform();
				}
			}							
		});		
		$("#cancel").click(function(){
			$("#addNew").removeClass("k-state-disabled");
			$("#edit").removeClass("k-state-disabled");
			$("#delete").removeClass("k-state-disabled");
			$('#mode').val('insert');
			
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
        $("#btnmentorID").click(function(){
        	formAddMentor.data("kendoWindow").center().open();
        });
        $("#btnSelect").click(function(){
        	var gridTable = $("#gridTableUser").data("kendoGrid");
			var selectedItem = gridTable.dataItem(gridTable.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการ.');return;}
			$('#mentorID').val(selectedItem.userID);
			$('#mentorName').val(selectedItem.firstName+' '+selectedItem.lastName);
			formAddMentor.data("kendoWindow").center().close();
        });

        
	}//end eventhandle
	this.validation=function(){
	validator = $('#scriptForm').kendoValidator({
		rules: {
		          requestIdCard: function(input){
		             var ret = true;
		             if (input.is('#IDCard')) {
		                 ret = input.val() !='';
		             }
		             return ret;
		          },
		          verifyIdCard: function(input){
		             var ret = true;
		             if (input.is('#IDCard')) {
		                 ret = chkIDCard(input.val());
		             }
		             return ret;
		          },
		          verifyPasswords: function(input){
		             var ret = true;
		             if (input.is('#confirmPassword')) {
		                 ret = input.val() === $('#password').val();
		             }
		             return ret;
		          }		          
		      },
		messages: {
			verifyIdCard: "รหัสประจำตัวประชาชนไม่ถูกต้อง",
			requestIdCard:"พิมพ์รหัสประจำตัวประชาชน",
			verifyPasswords: "ยืนยันรหัสผ่านไม่ตรงกัน"
		}
	}).data("kendoValidator"),status = $('#error');	
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
		$("#gridTable").data("kendoGrid").clearSelection();
		$("#gridTable").data("kendoGrid").dataSource.read();
		$("#gridTable").data("kendoGrid").refresh();
		HTMLFormElement.prototype.reset.call($('#scriptForm')[0]);
		//$('#scriptForm')[0].reset();
		var lastID=ajax('userprofile.php',({mode:'getLastID'}),false);
		$('#userID').val(lastID);
		$('#code').val(pad(lastID,7));
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
				<form id="scriptForm" action="userprofile.php" method="post" name="scriptForm">
					<input id="mode" name="mode" type="hidden" value="insert" />
					<?php include_once('profileheader.php'); ?>
					<fieldset class="k-content">
					<legend style="color: #37b2d1">จัดการข้อมูลผู้ใช้</legend>
					<fieldset id="fprofileList">
					<legend >รายการข้อมูลผู้ใช้</legend>
					<div id="gridTable">
					</div>
					</fieldset> <fieldset>
					<legend>ข้อมูลผู้ใช้</legend>
					<div>
						<div>
							<label>ลำดับ :</label>
							<input id="userID" class="input" name="userID" readonly required title="คลิกเพิ่มข้อมูลเพื่อสร้างลำดับใหม่" type="text">
							<span class="k-invalid-msg" data-for="userID">
							</span></div>
						<div>
							<label>รหัส :</label>
							<input id="code" class="input" name="code" readonly required title="คลิกเพิ่มข้อมูลเพื่อสร้างรหัสใหม่" type="text">
							<span class="k-invalid-msg" data-for="code"></span>
						</div>
						<div>
							<label>ประเภทผู้ใช้ :</label>
							<select id="userTypeID" name="userTypeID" required="required" title="เลือกประเภทผู้ใช้">
							<option value="">Please Select</option>
							<?php 
								$strsql="SELECT * FROM usertype WHERE status='1'";
								$typeID=$database->query($strsql);
								foreach($typeID as $item):
							?>
							<option value="<?php echo $item['userTypeID'];?>"><?php echo $item['userType'];?>
							</option>
							<?php endforeach;?></select>*
							<span class="k-invalid-msg" data-for="typeID">
							</span></div>
						<div>
							<label>ชื่อ :</label>
							<input id="firstName" class="input" name="firstName" required title="พิมพ์ชื่อ" type="text">*
							<span class="k-invalid-msg" data-for="firstName">
							</span></div>
						<div>
							<label>นามสกุล :</label>
							<input id="lastName" class="input" name="lastName" required title="พิมพ์นามสกุล" type="text">*
							<span class="k-invalid-msg" data-for="lastName">
							</span></div>
						<div>
							<label>รหัสประจำตัวประชาชน :</label>
							<input id="IDCard" class="input" name="IDCard" type="text">*
							<span class="k-invalid-msg" data-for="IDCard">
							</span></div>
						<div>
							<label>วันเดือนปีเกิด :</label>
							<input id="dateOfBirth" name="dateOfBirth" required title="เลือกวันเดือนปีเกิด" />*
							<span class="k-invalid-msg" data-for="dateOfBirth">
							</span></div>
						<div>
							<label>ที่สถานะภาพ :</label>
							<input id="userStatus0" checked="checked" name="userStatus" title="Inctive" type="radio" value="1">โสด
							<input id="userStatus1" name="userStatus" title="Active" type="radio" value="2">สมรส
							<input id="userStatus2" name="userStatus" title="Active" type="radio" value="3">หย่า
							<input id="userStatus3" name="userStatus" title="Active" type="radio" value="4">หม้าย
						</div>
						<div>
							<label>ที่อยู่ :</label>
							<textarea id="address" class="input" cols="20" name="address" rows="2" title="พิมพ์ที่อยู่"></textarea>
							<span class="k-invalid-msg" data-for="address">
							</span></div>
						<div>
							<label>เบอร์โทรศัพท์ :</label>
							<input id="phone" class="input" name="phone" title="พิมพ์เบอร์โทรศัพท์" type="text">
							<span class="k-invalid-msg" data-for="phone"></span>
						</div>
						<div>
							<label>อีเมล์ :</label>
							<input id="email" class="input" data-email-msg="รูปแบบอีเมล์ไม่ถูกต้อง" name="email" required type="email" validationmessage="พิมพ์อีเมล์">*
							<span class="k-invalid-msg" data-for="email"></span>
						</div>
						
						<div>
							<label>วันที่บรรจุ :</label>
							<input id="registerDate" name="registerDate" required title="เลือกวันที่บรรจุ" />*
							<span class="k-invalid-msg" data-for="registerDate">
							</span>
						</div>
						<div>
							<label>อัตราเงินเดือนปัจจุบัน:</label>
							<input id="currentSalary" name="currentSalary" title="พิมพ์อัตรเงินเดือน" type="text">
							<span class="k-invalid-msg" data-for="currentSalary"></span>
						</div>
						<div>
							<label>พี่เลี้ยง:</label>
							<input id="mentorID" class="input" name="mentorID" title="รหัสพี่เลี้ยง" type="hidden">
							<input id="mentorName" class="input" name="mentorName" title="พี่เลี้ยง" type="text" style="width:124px" readonly>
							<a href="javascript:;" id="btnmentorID"><img src="img/mono-icons/zoom.png" width="12"></a>
							<span class="k-invalid-msg" data-for="mentorName"></span>
						</div>
						<div id="formAddMentor">
							<div id="gridTableUser"></div>
						</div>
					</div>
					
					</fieldset> 
					<fieldset>
						<legend>วุฒิการศึกษาระดับปริญญาตรี </legend>
						<div>
							<label>สาขา/สาขาวิชา :</label>
							<input id="bachelorDegreeDiscipline" class="input" name="bachelorDegreeDiscipline" title="พิมพ์สาขา/สาขาวิชา" type="text">
							<span class="k-invalid-msg" data-for="bachelorDegreeDiscipline">
							</span></div>
						<div>
							<label>สถาบันการศึกษา :</label>
							<input id="bachelorDegreeInstitution" class="input" name="bachelorDegreeInstitution" title="พิมพ์สถาบันการศึกษา" type="text">
							<span class="k-invalid-msg" data-for="bachelorDegreeInstitution">
							</span></div>
						<div>
							<label>ปีที่สำเร็จ :</label>
							<input id="bachelorDegreeGraduate" class="input" name="bachelorDegreeGraduate" title="พิพม์ปีที่สำเร็จ" type="text">
							<span class="k-invalid-msg" data-for="bachelorDegreeGraduate">
							</span></div>
						</fieldset> <fieldset>
						<legend>วุฒิการศึกษาระดับปริญญาโท </legend>
						<div>
							<label>สาขา/สาขาวิชา :</label>
							<input id="mastersDegreeDiscipline" class="input" name="mastersDegreeDiscipline" title="พิมพ์สาขา/สาขาวิชา" type="text">
							<span class="k-invalid-msg" data-for="mastersDegreeDiscipline">
							</span></div>
						<div>
							<label>สถาบันการศึกษา :</label>
							<input id="mastersDegreeInstitution" class="input" name="mastersDegreeInstitution" title="พิมพ์สถาบันการศึกษา" type="text">
							<span class="k-invalid-msg" data-for="mastersDegreeInstitution">
							</span></div>
						<div>
							<label>ปีที่สำเร็จ :</label>
							<input id="mastersDegreeGraduate" class="input" name="mastersDegreeGraduate" title="พิพม์ปีที่สำเร็จ" type="text">
							<span class="k-invalid-msg" data-for="mastersDegreeGraduate">
							</span></div>
						</fieldset><fieldset>
						<legend>วุฒิการศึกษาระดับปริญญาเอก </legend>
						<div>
							<label>สาขา/สาขาวิชา :</label>
							<input id="doctorateDegreeDiscipline" class="input" name="doctorateDegreeDiscipline" title="พิมพ์สาขา/สาขาวิชา" type="text">
							<span class="k-invalid-msg" data-for="doctorateDegreeDiscipline">
							</span></div>
						<div>
							<label>สถาบันการศึกษา :</label>
							<input id="doctorateDegreeInstitution" class="input" name="doctorateDegreeInstitution" title="พิมพ์สถาบันการศึกษา" type="text">
							<span class="k-invalid-msg" data-for="doctorateDegreeInstitution">
							</span></div>
						<div>
							<label>ปีที่สำเร็จ :</label>
							<input id="doctorateDegreeGraduate" class="input" name="doctorateDegreeGraduate" title="พิพม์ปีที่สำเร็จ" type="text">
							<span class="k-invalid-msg" data-for="doctorateDegreeGraduate">
							</span></div>
						</fieldset>
						<fieldset>
						<legend>วุฒิการศึกษาระดับวุฒิบัตร</legend>
						<div>
							<label>สาขา/สาขาวิชา :</label>
							<input id="diplomaDiscipline" class="input" name="diplomaDiscipline" title="พิมพ์สาขา/สาขาวิชา" type="text">
							<span class="k-invalid-msg" data-for="diplomaDiscipline">
							</span></div>
						<div>
							<label>สถาบันการศึกษา :</label>
							<input id="diplomaInstitution" class="input" name="diplomaInstitution" title="พิมพ์สถาบันการศึกษา" type="text">
							<span class="k-invalid-msg" data-for="diplomaInstitution">
							</span></div>
						<div>
							<label>ปีที่สำเร็จ :</label>
							<input id="diplomaGraduate" class="input" name="diplomaGraduate" title="พิพม์ปีที่สำเร็จ" type="text">
							<span class="k-invalid-msg" data-for="diplomaGraduate">
							</span></div>
						</fieldset>
<fieldset>
						<legend>ข้อมูลการเข้าใช้ระบบ</legend>
						<div>
							<label>ชื่อผู้ใช้ :</label>
							<input id="username" class="input" name="username" required type="text" title="พิมพ์ชื่อผู้ใช้">*
							<span class="k-invalid-msg" data-for="username">
							</span></div>
						<div>
							<label>รหัสผ่าน :</label>
							<input id="password" class="input" name="password" required title="พิมพ์รหัสผ่าน" type="password">*
							<span class="k-invalid-msg" data-for="password">
							</span></div>
						<div>
							<label>ยืนยันรหัสผ่าน :</label>
							<input id="confirmPassword" class="input" name="confirmPassword" type="password">
							<span class="k-invalid-msg" data-for="confirmPassword">
							</span></div>
						<div>
							<label>สถานะการใช้งาน :</label>
							<input id="status0" name="status" title="Inctive" type="radio" value="0">ระงับ
							<input id="status1" checked="checked" name="status" title="Active" type="radio" value="1">ใช้งาน
						</div>						</fieldset>

						<div class="clear" style="height: 10px"></div>
					<input id="save" class="k-button" name="save" type="button" value="บันทึก" />
					<img id="loading" alt="" src="img/loading.gif" style="vertical-align: middle; display: none;">
					<p id="error" class="warning">Message</p>
					</fieldset></form>
			</div>
		</div>
		<!-- ENDS content --></div>
	<!-- ENDS wrapper-main --></div>
<!-- ENDS MAIN -->
<!-- Bottom --><?php include_once('bottom.php'); ?>
<!-- ENDS Bottom -->

</body>

</html>
