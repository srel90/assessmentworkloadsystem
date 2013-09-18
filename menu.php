<?php
require_once('MySQL.class.php');
$database= new database();
?>
<!-- ENDS menu-holder -->
<div id="menu-holder">
	<!-- wrapper-menu -->
	<div class="wrapper">
		<!-- Navigation -->
        
		<ul id="nav" class="sf-menu">
			<a href="index.php"><img alt="Nova" src="img/logo.png"></a>
			<?php if(isset($_SESSION['users'])):?>
			<li id="m1"><a href="main.php">หน้าหลัก<span class="subheader">กลับสู่หน้าหลัก</span></a></li>
			<li id="m2"><a href="profile.php">ผู้ใช้<span class="subheader">จัดการข้อมูลผู้ใช้</span></a>
			<ul>
            <?php if(($database->checkrole($_SESSION['users'][0]['userTypeID'],'usertype.php'))!=0):?>
				<li><a href="usertype.php"><span>ประเภทผู้ใช้</span></a></li>
            <?php endif;?> 
            <?php if(($database->checkrole($_SESSION['users'][0]['userTypeID'],'userrole.php'))!=0):?>   
				<li><a href="userrole.php"><span>กำหนดสิทธิ์</span></a></li>
            <?php endif;?>
            <?php if(($database->checkrole($_SESSION['users'][0]['userTypeID'],'userprofile.php'))!=0):?>     
				<li><a href="userprofile.php"><span>ข้อมูลผู้ใช้</span></a></li>
            <?php endif;?>
			</ul>
			</li>
            <?php if(($database->checkrole($_SESSION['users'][0]['userTypeID'],'faculty.php'))!=0):?>
			<li id="m3"><a href="faculty.php">คณะ<span class="subheader">จัดการข้อมูลคณะ</span></a></li>
            <?php endif;?>
            <?php if(($database->checkrole($_SESSION['users'][0]['userTypeID'],'workload.php'))!=0):?>
			<li id="m4"><a href="workload.php">แบบภาระงาน<span class="subheader">จัดการข้อมูลแบบภาระงาน</span></a></li>
            <?php endif;?>


			<li><a href="logout.php">ออกจากระบบ<span class="subheader">ออกจากระบบ</span></a></li>
			<?php endif;?>
		</ul>
        
		<!-- Navigation --></div>
	<!-- wrapper-menu --></div>
<!-- ENDS menu-holder -->