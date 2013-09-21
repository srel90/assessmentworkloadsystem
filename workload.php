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
exit();	
endif;
if(isset($_POST) && !empty($_POST)):
/*START*/
switch($_POST['mode']):
	case 'clearSession':
		$_SESSION['TeachingWorkgroup']=array();
		$_SESSION['researchingWorkgroup']=array();
		$_SESSION['servicesWorkgroup']=array();
		$_SESSION['otherWorkgroup']=array();
	break;
	
	case 'selectWorkloadDetail':
		$_SESSION['TeachingWorkgroup']=array();
			$strsql="SELECT * FROM teachingworkgroup WHERE teachingWorkgroupWorkloadID='".$_POST['workloadID']."'";
			$data=$database->query($strsql);
			foreach($data as $item){
			$index=count($TeachingWorkgroup,2);
			$TeachingWorkgroup[$index]['teachingWorkgroupuid']=$index;
			$TeachingWorkgroup[$index]['teachingWorkgroupID']=$item['teachingWorkgroupID'];
			$TeachingWorkgroup[$index]['teachingWorkgroupType']=$item['teachingWorkgroupType'];
			$TeachingWorkgroup[$index]['teachingWorkgroup']=$item['teachingWorkgroup'];
			$TeachingWorkgroup[$index]['teachingWorkgroupWorkloadID']=$item['teachingWorkgroupWorkloadID'];
			$TeachingWorkgroup[$index]['teachingWorkgroupCode']=$item['teachingWorkgroupCode'];
			$TeachingWorkgroup[$index]['teachingWorkgroupNumberOfStudents']=$item['teachingWorkgroupNumberOfStudents'];
			$TeachingWorkgroup[$index]['teachingWorkgroupSubject']=$item['teachingWorkgroupSubject'];
			$TeachingWorkgroup[$index]['teachingWorkgroupHours']=$item['teachingWorkgroupHours'];
			$TeachingWorkgroup[$index]['teachingWorkgroupProportion']=$item['teachingWorkgroupProportion'];
			}
			$_SESSION['TeachingWorkgroup'] = array_values($TeachingWorkgroup);
			
		$_SESSION['researchingWorkgroup']=array();
			$strsql="SELECT * FROM researchingworkgroup WHERE researchingWorkgroupWorkloadID='".$_POST['workloadID']."'";
			$data=$database->query($strsql);
			foreach($data as $item){
			$index=count($researchingWorkgroup,2);
			$researchingWorkgroup[$index]['researchingWorkgroupuid']=$index;
			$researchingWorkgroup[$index]['researchingWorkgroupID']=$item['researchingWorkgroupID'];
			$researchingWorkgroup[$index]['researchingWorkgroupType']=$item['researchingWorkgroupType'];
			$researchingWorkgroup[$index]['researchingWorkgroup']=$item['researchingWorkgroup'];
			$researchingWorkgroup[$index]['researchingWorkgroupWorkloadID']=$item['researchingWorkgroupWorkloadID'];
			$researchingWorkgroup[$index]['researchingWorkgroupSubject']=$item['researchingWorkgroupSubject'];
			$researchingWorkgroup[$index]['researchingWorkgroupPeriod']=$item['researchingWorkgroupPeriod'];
			$researchingWorkgroup[$index]['researchingWorkgroupHours']=$item['researchingWorkgroupHours'];
			$researchingWorkgroup[$index]['researchingWorkgroupProportion']=$item['researchingWorkgroupProportion'];
			}
			$_SESSION['researchingWorkgroup'] = array_values($researchingWorkgroup);
			
		$_SESSION['servicesWorkgroup']=array();
			$strsql="SELECT * FROM servicesworkgroup WHERE servicesWorkgroupWorkloadID='".$_POST['workloadID']."'";
			$data=$database->query($strsql);
			foreach($data as $item){
			$index=count($servicesWorkgroup,2);
			$servicesWorkgroup[$index]['servicesWorkgroupuid']=$index;
			$servicesWorkgroup[$index]['servicesWorkgroupID']=$item['servicesWorkgroupID'];
			$servicesWorkgroup[$index]['servicesWorkgroupType']=$item['servicesWorkgroupType'];
			$servicesWorkgroup[$index]['servicesWorkgroup']=$item['servicesWorkgroup'];
			$servicesWorkgroup[$index]['servicesWorkgroupWorkloadID']=$item['servicesWorkgroupWorkloadID'];
			$servicesWorkgroup[$index]['servicesWorkgroupSubject']=$item['servicesWorkgroupSubject'];
			$servicesWorkgroup[$index]['servicesWorkgroupTime']=$item['servicesWorkgroupTime'];
			$servicesWorkgroup[$index]['servicesWorkgroupHours']=$item['servicesWorkgroupHours'];
			}
			$_SESSION['servicesWorkgroup'] = array_values($servicesWorkgroup);
			
		$_SESSION['otherWorkgroup']=array();
			$strsql="SELECT * FROM otherworkgroup WHERE otherWorkgroupWorkloadID='".$_POST['workloadID']."'";
			$data=$database->query($strsql);
			foreach($data as $item){
			$index=count($otherWorkgroup,2);
			$otherWorkgroup[$index]['otherWorkgroupuid']=$index;
			$otherWorkgroup[$index]['otherWorkgroupID']=$item['otherWorkgroupID'];
			$otherWorkgroup[$index]['otherWorkgroupType']=$item['otherWorkgroupType'];
			$otherWorkgroup[$index]['otherWorkgroup']=$item['otherWorkgroup'];
			$otherWorkgroup[$index]['otherWorkgroupWorkloadID']=$item['otherWorkgroupWorkloadID'];
			$otherWorkgroup[$index]['otherWorkgroupSubject']=$item['otherWorkgroupSubject'];
			$otherWorkgroup[$index]['otherWorkgroupTime']=$item['otherWorkgroupTime'];
			$otherWorkgroup[$index]['otherWorkgroupHours']=$item['otherWorkgroupHours'];
			}
			$_SESSION['otherWorkgroup'] = array_values($otherWorkgroup);
	break;
	case 'insert':
	$teachingWorkgroupAgrHours=0;
	$researchingWorkgroupAgrHours=0;
	$servicesWorkgroupAgrHours=0;
	$otherWorkgroupAgrHours=0;
		if(!isset($_SESSION['TeachingWorkgroup']))$_SESSION['TeachingWorkgroup']=array();
		if(!is_array($_SESSION['TeachingWorkgroup']))
			{
			$TeachingWorkgroup=array();
			}
			else
			{
			$TeachingWorkgroup=$_SESSION['TeachingWorkgroup'];
			}
		if(!isset($_SESSION['researchingWorkgroup']))$_SESSION['researchingWorkgroup']=array();
		if(!is_array($_SESSION['researchingWorkgroup']))
			{
			$researchingWorkgroup=array();
			}
			else
			{
			$researchingWorkgroup=$_SESSION['researchingWorkgroup'];
			}
		if(!isset($_SESSION['servicesWorkgroup']))$_SESSION['servicesWorkgroup']=array();
		if(!is_array($_SESSION['servicesWorkgroup']))
			{
			$servicesWorkgroup=array();
			}
			else
			{
			$servicesWorkgroup=$_SESSION['servicesWorkgroup'];
			}
		if(!isset($_SESSION['otherWorkgroup']))$_SESSION['otherWorkgroup']=array();
		if(!is_array($_SESSION['otherWorkgroup']))
			{
			$otherWorkgroup=array();
			}
			else
			{
			$otherWorkgroup=$_SESSION['otherWorkgroup'];
			}
		if(!empty($TeachingWorkgroup))
		{
			$strsql="INSERT INTO teachingworkgroup(
			 teachingWorkgroupType
			,teachingWorkgroup
			,teachingWorkgroupWorkloadID
			,teachingWorkgroupCode
			,teachingWorkgroupNumberOfStudents
			,teachingWorkgroupSubject
			,teachingWorkgroupHours
			,teachingWorkgroupProportion
			)VALUES";
			$items=array();
			foreach($TeachingWorkgroup as $item){
			$items[]="(
			 '".$item['teachingWorkgroupType']."'
			,'".$item['teachingWorkgroup']."'
			,'".$item['teachingWorkgroupWorkloadID']."'
			,'".$item['teachingWorkgroupCode']."'
			,'".$item['teachingWorkgroupNumberOfStudents']."'
			,'".$item['teachingWorkgroupSubject']."'
			,'".$item['teachingWorkgroupHours']."'
			,'".$item['teachingWorkgroupProportion']."'
			)";
			$teachingWorkgroupAgrHours+=is_numeric($item['teachingWorkgroupHours'])?$item['teachingWorkgroupHours']:0;
			}
			$strsql.=implode(',',$items);
			//echo $strsql;
			$database->execute($strsql);
		}
		if(!empty($researchingWorkgroup))
		{
			$strsql="INSERT INTO researchingworkgroup(
			 researchingWorkgroupType
			,researchingWorkgroup
			,researchingWorkgroupWorkloadID
			,researchingWorkgroupSubject
			,researchingWorkgroupPeriod
			,researchingWorkgroupHours
			,researchingWorkgroupProportion
			)VALUES";
			$items=array();
			foreach($researchingWorkgroup as $item){
			$items[]="(
			 '".$item['researchingWorkgroupType']."'
			,'".$item['researchingWorkgroup']."'
			,'".$item['researchingWorkgroupWorkloadID']."'
			,'".$item['researchingWorkgroupSubject']."'
			,'".$item['researchingWorkgroupPeriod']."'
			,'".$item['researchingWorkgroupHours']."'
			,'".$item['researchingWorkgroupProportion']."'
			)";
			$researchingWorkgroupAgrHours+=is_numeric($item['researchingWorkgroupHours'])?$item['researchingWorkgroupHours']:0;
			}
			$strsql.=implode(',',$items);
			//echo $strsql;
			$database->execute($strsql);
		}
		if(!empty($servicesWorkgroup))
		{
			$strsql="INSERT INTO servicesworkgroup(
			 servicesWorkgroupType
			,servicesWorkgroup
			,servicesWorkgroupWorkloadID
			,servicesWorkgroupSubject
			,servicesWorkgroupTime
			,servicesWorkgroupHours
			)VALUES";
			$items=array();
			foreach($servicesWorkgroup as $item){
			$items[]="(
			 '".$item['servicesWorkgroupType']."'
			,'".$item['servicesWorkgroup']."'
			,'".$item['servicesWorkgroupWorkloadID']."'
			,'".$item['servicesWorkgroupSubject']."'
			,'".$item['servicesWorkgroupTime']."'
			,'".$item['servicesWorkgroupHours']."'
			)";
			$servicesWorkgroupAgrHours+=is_numeric($item['servicesWorkgroupHours'])?$item['servicesWorkgroupHours']:0;
			}
			$strsql.=implode(',',$items);
			//echo $strsql;
			$database->execute($strsql);
		}
		if(!empty($otherWorkgroup))
		{
			$strsql="INSERT INTO otherworkgroup(
			 otherWorkgroupType
			,otherWorkgroup
			,otherWorkgroupWorkloadID
			,otherWorkgroupSubject
			,otherWorkgroupTime
			,otherWorkgroupHours
			)VALUES";
			$items=array();
			foreach($otherWorkgroup as $item){
			$items[]="(
			 '".$item['otherWorkgroupType']."'
			,'".$item['otherWorkgroup']."'
			,'".$item['otherWorkgroupWorkloadID']."'
			,'".$item['otherWorkgroupSubject']."'
			,'".$item['otherWorkgroupTime']."'
			,'".$item['otherWorkgroupHours']."'
			)";
			$otherWorkgroupAgrHours+=is_numeric($item['otherWorkgroupHours'])?$item['otherWorkgroupHours']:0;
			}
			$strsql.=implode(',',$items);
			//echo $strsql;
			$database->execute($strsql);
		}
		$strsql="INSERT INTO workload(
		 userID
		,mentorID
		,facultyID
		,semester
		,year
		,teachingWorkgroupStdProportion
		,teachingWorkgroupStdHours
		,teachingWorkgroupAgrProportion
		,teachingWorkgroupAgrHours
		,researchingWorkgroupStdProportion
		,researchingWorkgroupStdHours
		,researchingWorkgroupAgrProportion
		,researchingWorkgroupAgrHours
		,servicesWorkgroupStdProportion
		,servicesWorkgroupStdHours
		,servicesWorkgroupAgrProportion
		,servicesWorkgroupAgrHours
		,otherWorkgroupStdProportion
		,otherWorkgroupStdHours
		,otherWorkgroupAgrProportion
		,otherWorkgroupAgrHours
		,status
		)VALUES(
		 '".$personal[0]['userID']."'
		,'".$personal[0]['mentorID']."' 
		,'".$_POST['facultyID']."'
		,'".$_POST['semester']."'
		,'".$_POST['year']."'
		,'50'
		,'20'
		,'50'
		,'".$teachingWorkgroupAgrHours."'
		,'25'
		,'10'
		,'25'
		,'".$researchingWorkgroupAgrHours."'
		,'15'
		,'6'
		,'15'
		,'".$servicesWorkgroupAgrHours."'
		,'10'
		,'4'
		,'10'
		,'".$otherWorkgroupAgrHours."'
		,'0'
		)";
		//echo $strsql;
		//exit();
		if($database->execute($strsql)){
		unset($_SESSION['TeachingWorkgroup']);
		unset($_SESSION['researchingWorkgroup']);
		unset($_SESSION['servicesWorkgroup']);
		unset($_SESSION['otherWorkgroup']);	
		echo 'true';
		}else{
		echo 'false';
		}
	break;
	case 'update':
	$teachingWorkgroupAgrHours=0;
	$researchingWorkgroupAgrHours=0;
	$servicesWorkgroupAgrHours=0;
	$otherWorkgroupAgrHours=0;
		if(!isset($_SESSION['TeachingWorkgroup']))$_SESSION['TeachingWorkgroup']=array();
		if(!is_array($_SESSION['TeachingWorkgroup']))
			{
			$TeachingWorkgroup=array();
			}
			else
			{
			$TeachingWorkgroup=$_SESSION['TeachingWorkgroup'];
			}
		if(!isset($_SESSION['researchingWorkgroup']))$_SESSION['researchingWorkgroup']=array();
		if(!is_array($_SESSION['researchingWorkgroup']))
			{
			$researchingWorkgroup=array();
			}
			else
			{
			$researchingWorkgroup=$_SESSION['researchingWorkgroup'];
			}
		if(!isset($_SESSION['servicesWorkgroup']))$_SESSION['servicesWorkgroup']=array();
		if(!is_array($_SESSION['servicesWorkgroup']))
			{
			$servicesWorkgroup=array();
			}
			else
			{
			$servicesWorkgroup=$_SESSION['servicesWorkgroup'];
			}
		if(!isset($_SESSION['otherWorkgroup']))$_SESSION['otherWorkgroup']=array();
		if(!is_array($_SESSION['otherWorkgroup']))
			{
			$otherWorkgroup=array();
			}
			else
			{
			$otherWorkgroup=$_SESSION['otherWorkgroup'];
			}
		$strsql="DELETE FROM teachingworkgroup WHERE teachingWorkgroupWorkloadID='".$_POST['workloadID']."'";
		$database->execute($strsql);
		if(!empty($TeachingWorkgroup))
		{
			$strsql="INSERT INTO teachingworkgroup(
			 teachingWorkgroupType
			,teachingWorkgroup
			,teachingWorkgroupWorkloadID
			,teachingWorkgroupCode
			,teachingWorkgroupNumberOfStudents
			,teachingWorkgroupSubject
			,teachingWorkgroupHours
			,teachingWorkgroupProportion
			)VALUES";
			$items=array();
			foreach($TeachingWorkgroup as $item){
			$items[]="(
			 '".$item['teachingWorkgroupType']."'
			,'".$item['teachingWorkgroup']."'
			,'".$item['teachingWorkgroupWorkloadID']."'
			,'".$item['teachingWorkgroupCode']."'
			,'".$item['teachingWorkgroupNumberOfStudents']."'
			,'".$item['teachingWorkgroupSubject']."'
			,'".$item['teachingWorkgroupHours']."'
			,'".$item['teachingWorkgroupProportion']."'
			)";
			$teachingWorkgroupAgrHours+=is_numeric($item['teachingWorkgroupHours'])?$item['teachingWorkgroupHours']:0;
			}
			$strsql.=implode(',',$items);
			//echo $strsql;
			$database->execute($strsql);
		}
		$strsql="DELETE FROM researchingworkgroup WHERE researchingWorkgroupWorkloadID='".$_POST['workloadID']."'";
		$database->execute($strsql);
		if(!empty($researchingWorkgroup))
		{
			$strsql="INSERT INTO researchingworkgroup(
			 researchingWorkgroupType
			,researchingWorkgroup
			,researchingWorkgroupWorkloadID
			,researchingWorkgroupSubject
			,researchingWorkgroupPeriod
			,researchingWorkgroupHours
			,researchingWorkgroupProportion
			)VALUES";
			$items=array();
			foreach($researchingWorkgroup as $item){
			$items[]="(
			 '".$item['researchingWorkgroupType']."'
			,'".$item['researchingWorkgroup']."'
			,'".$item['researchingWorkgroupWorkloadID']."'
			,'".$item['researchingWorkgroupSubject']."'
			,'".$item['researchingWorkgroupPeriod']."'
			,'".$item['researchingWorkgroupHours']."'
			,'".$item['researchingWorkgroupProportion']."'
			)";
			$researchingWorkgroupAgrHours+=is_numeric($item['researchingWorkgroupHours'])?$item['researchingWorkgroupHours']:0;
			}
			$strsql.=implode(',',$items);
			//echo $strsql;
			$database->execute($strsql);
		}
		$strsql="DELETE FROM servicesworkgroup WHERE servicesWorkgroupWorkloadID='".$_POST['workloadID']."'";
		$database->execute($strsql);
		if(!empty($servicesWorkgroup))
		{
			$strsql="INSERT INTO servicesworkgroup(
			 servicesWorkgroupType
			,servicesWorkgroup
			,servicesWorkgroupWorkloadID
			,servicesWorkgroupSubject
			,servicesWorkgroupTime
			,servicesWorkgroupHours
			)VALUES";
			$items=array();
			foreach($servicesWorkgroup as $item){
			$items[]="(
			 '".$item['servicesWorkgroupType']."'
			,'".$item['servicesWorkgroup']."'
			,'".$item['servicesWorkgroupWorkloadID']."'
			,'".$item['servicesWorkgroupSubject']."'
			,'".$item['servicesWorkgroupTime']."'
			,'".$item['servicesWorkgroupHours']."'
			)";
			$servicesWorkgroupAgrHours+=is_numeric($item['servicesWorkgroupHours'])?$item['servicesWorkgroupHours']:0;
			}
			$strsql.=implode(',',$items);
			//echo $strsql;
			$database->execute($strsql);
		}
		$strsql="DELETE FROM otherworkgroup WHERE otherWorkgroupWorkloadID='".$_POST['workloadID']."'";
		$database->execute($strsql);
		if(!empty($otherWorkgroup))
		{
			$strsql="INSERT INTO otherworkgroup(
			 otherWorkgroupType
			,otherWorkgroup
			,otherWorkgroupWorkloadID
			,otherWorkgroupSubject
			,otherWorkgroupTime
			,otherWorkgroupHours
			)VALUES";
			$items=array();
			foreach($otherWorkgroup as $item){
			$items[]="(
			 '".$item['otherWorkgroupType']."'
			,'".$item['otherWorkgroup']."'
			,'".$item['otherWorkgroupWorkloadID']."'
			,'".$item['otherWorkgroupSubject']."'
			,'".$item['otherWorkgroupTime']."'
			,'".$item['otherWorkgroupHours']."'
			)";
			$otherWorkgroupAgrHours+=is_numeric($item['otherWorkgroupHours'])?$item['otherWorkgroupHours']:0;
			}
			$strsql.=implode(',',$items);
			//echo $strsql;
			$database->execute($strsql);
		}
		$strsql="UPDATE workload SET
		 facultyID='".$_POST['facultyID']."'
		,semester='".$_POST['semester']."'
		,year='".$_POST['year']."'
		,teachingWorkgroupStdProportion='50'
		,teachingWorkgroupStdHours='20'
		,teachingWorkgroupAgrProportion='50'
		,teachingWorkgroupAgrHours='".$teachingWorkgroupAgrHours."'
		,researchingWorkgroupStdProportion='25'
		,researchingWorkgroupStdHours='10'
		,researchingWorkgroupAgrProportion='25'
		,researchingWorkgroupAgrHours='".$researchingWorkgroupAgrHours."'
		,servicesWorkgroupStdProportion='15'
		,servicesWorkgroupStdHours='6'
		,servicesWorkgroupAgrProportion='15'
		,servicesWorkgroupAgrHours='".$servicesWorkgroupAgrHours."'
		,otherWorkgroupStdProportion='10'
		,otherWorkgroupStdHours='4'
		,otherWorkgroupAgrProportion='10'
		,otherWorkgroupAgrHours='".$otherWorkgroupAgrHours."'
		,status='0'
		WHERE workloadID='".$_POST['workloadID']."'";
		//echo $strsql;
		//exit();
		if($database->execute($strsql)){
		unset($_SESSION['TeachingWorkgroup']);
		unset($_SESSION['researchingWorkgroup']);
		unset($_SESSION['servicesWorkgroup']);
		unset($_SESSION['otherWorkgroup']);	
		echo 'true';
		}else{
		echo 'false';
		}	
	break;
	case 'delete':
		$strsql="DELETE FROM workload WHERE workloadID='".$_POST['workloadID']."'";	
		if($database->execute($strsql)){
			$strsql="DELETE FROM teachingworkgroup WHERE workloadID='".$_POST['workloadID']."'";
			if($database->execute($strsql)){
				$strsql="DELETE FROM servicesworkgroup WHERE workloadID='".$_POST['workloadID']."'";
				if($database->execute($strsql)){
					$strsql="DELETE FROM researchingworkgroup WHERE workloadID='".$_POST['workloadID']."'";
					if($database->execute($strsql)){
						$strsql="DELETE FROM otherworkgroup WHERE workloadID='".$_POST['workloadID']."'";
						if($database->execute($strsql)){
						echo 'true';
						}else{
						echo 'false';
						}
					}else{
					echo 'false';
					}
				}else{
				echo 'false';
				}
			}else{
			echo 'false';
			}
		}else{
		echo 'false';
		}
	break;
	case 'check':
		$strsql="UPDATE workload SET status='1' WHERE workloadID='".$_POST['workloadID']."'";
		if($database->execute($strsql)){
			echo 'true';
		}else{
			echo 'false';
		}
	break;
	case 'getLastID':
		$strsql="SELECT AUTO_INCREMENT AS lastID FROM information_schema.tables WHERE table_name='workload' AND table_schema = 'assessmentworkloadsystem'";
		$data=$database->query($strsql);
		echo $data[0]['lastID'];
	break;
	case 'insertTeachingWorkgroup':
		if(!isset($_SESSION['TeachingWorkgroup']))$_SESSION['TeachingWorkgroup']=array();
		if(!is_array($_SESSION['TeachingWorkgroup']))
			{
			$TeachingWorkgroup=array();
			}
			else
			{
			$TeachingWorkgroup=$_SESSION['TeachingWorkgroup'];
			}
			$index=count($TeachingWorkgroup,2);
			$TeachingWorkgroup[$index]['teachingWorkgroupuid']=$index;
			$TeachingWorkgroup[$index]['teachingWorkgroupID']=$index+1;
			$TeachingWorkgroup[$index]['teachingWorkgroupType']=$_POST['teachingWorkgroupType'];
			$TeachingWorkgroup[$index]['teachingWorkgroup']=$_POST['teachingWorkgroup'];
			$TeachingWorkgroup[$index]['teachingWorkgroupWorkloadID']=$_POST['teachingWorkgroupWorkloadID'];
			$TeachingWorkgroup[$index]['teachingWorkgroupCode']=$_POST['teachingWorkgroupCode'];
			$TeachingWorkgroup[$index]['teachingWorkgroupNumberOfStudents']=$_POST['teachingWorkgroupNumberOfStudents'];
			$TeachingWorkgroup[$index]['teachingWorkgroupSubject']=$_POST['teachingWorkgroupSubject'];
			$TeachingWorkgroup[$index]['teachingWorkgroupHours']=$_POST['teachingWorkgroupHours'];
			$TeachingWorkgroup[$index]['teachingWorkgroupProportion']=$_POST['teachingWorkgroupProportion'];
			$_SESSION['TeachingWorkgroup'] = array_values($TeachingWorkgroup);
			echo "{\"data\":" .json_encode($_SESSION['TeachingWorkgroup']). ",\"total\":".count($_SESSION['TeachingWorkgroup'])."}";
	break;
	case 'insertResearchingWorkgroup':
		if(!isset($_SESSION['researchingWorkgroup']))$_SESSION['researchingWorkgroup']=array();
		if(!is_array($_SESSION['researchingWorkgroup']))
			{
			$researchingWorkgroup=array();
			}
			else
			{
			$researchingWorkgroup=$_SESSION['researchingWorkgroup'];
			}
			$index=count($researchingWorkgroup,2);
			$researchingWorkgroup[$index]['researchingWorkgroupuid']=$index;
			$researchingWorkgroup[$index]['researchingWorkgroupID']=$index+1;
			$researchingWorkgroup[$index]['researchingWorkgroupType']=$_POST['researchingWorkgroupType'];
			$researchingWorkgroup[$index]['researchingWorkgroup']=$_POST['researchingWorkgroup'];
			$researchingWorkgroup[$index]['researchingWorkgroupWorkloadID']=$_POST['researchingWorkgroupWorkloadID'];
			$researchingWorkgroup[$index]['researchingWorkgroupSubject']=$_POST['researchingWorkgroupSubject'];
			$researchingWorkgroup[$index]['researchingWorkgroupPeriod']=$_POST['researchingWorkgroupPeriod'];
			$researchingWorkgroup[$index]['researchingWorkgroupHours']=$_POST['researchingWorkgroupHours'];
			$researchingWorkgroup[$index]['researchingWorkgroupProportion']=$_POST['researchingWorkgroupProportion'];
			$_SESSION['researchingWorkgroup'] = array_values($researchingWorkgroup);
			echo "{\"data\":" .json_encode($_SESSION['researchingWorkgroup']). ",\"total\":".count($_SESSION['researchingWorkgroup'])."}";		
	break;
	case 'insertServicesWorkgroup':
		if(!isset($_SESSION['servicesWorkgroup']))$_SESSION['servicesWorkgroup']=array();
		if(!is_array($_SESSION['servicesWorkgroup']))
			{
			$servicesWorkgroup=array();
			}
			else
			{
			$servicesWorkgroup=$_SESSION['servicesWorkgroup'];
			}
			$index=count($servicesWorkgroup,2);
			$servicesWorkgroup[$index]['servicesWorkgroupuid']=$index;
			$servicesWorkgroup[$index]['servicesWorkgroupID']=$index+1;
			$servicesWorkgroup[$index]['servicesWorkgroupType']=$_POST['servicesWorkgroupType'];
			$servicesWorkgroup[$index]['servicesWorkgroup']=$_POST['servicesWorkgroup'];
			$servicesWorkgroup[$index]['servicesWorkgroupWorkloadID']=$_POST['servicesWorkgroupWorkloadID'];
			$servicesWorkgroup[$index]['servicesWorkgroupSubject']=$_POST['servicesWorkgroupSubject'];
			$servicesWorkgroup[$index]['servicesWorkgroupTime']=$_POST['servicesWorkgroupTime'];
			$servicesWorkgroup[$index]['servicesWorkgroupHours']=$_POST['servicesWorkgroupHours'];
			$_SESSION['servicesWorkgroup'] = array_values($servicesWorkgroup);
			echo "{\"data\":" .json_encode($_SESSION['servicesWorkgroup']). ",\"total\":".count($_SESSION['servicesWorkgroup'])."}";		
	break;	
	case 'insertOtherWorkgroup':
		if(!isset($_SESSION['otherWorkgroup']))$_SESSION['otherWorkgroup']=array();
		if(!is_array($_SESSION['otherWorkgroup']))
			{
			$otherWorkgroup=array();
			}
			else
			{
			$otherWorkgroup=$_SESSION['otherWorkgroup'];
			}
			$index=count($otherWorkgroup,2);
			$otherWorkgroup[$index]['otherWorkgroupuid']=$index;
			$otherWorkgroup[$index]['otherWorkgroupID']=$index+1;
			$otherWorkgroup[$index]['otherWorkgroupType']=$_POST['otherWorkgroupType'];
			$otherWorkgroup[$index]['otherWorkgroup']=$_POST['otherWorkgroup'];
			$otherWorkgroup[$index]['otherWorkgroupWorkloadID']=$_POST['otherWorkgroupWorkloadID'];
			$otherWorkgroup[$index]['otherWorkgroupSubject']=$_POST['otherWorkgroupSubject'];
			$otherWorkgroup[$index]['otherWorkgroupTime']=$_POST['otherWorkgroupTime'];
			$otherWorkgroup[$index]['otherWorkgroupHours']=$_POST['otherWorkgroupHours'];
			$_SESSION['otherWorkgroup'] = array_values($otherWorkgroup);
			echo "{\"data\":" .json_encode($_SESSION['otherWorkgroup']). ",\"total\":".count($_SESSION['otherWorkgroup'])."}";		
	break;
	case 'updateTeachingWorkgroup':
		if(!isset($_SESSION['TeachingWorkgroup']))$_SESSION['TeachingWorkgroup']=array();
			if(!is_array($_SESSION['TeachingWorkgroup']))
				{
				$TeachingWorkgroup=array();
				}
				else
				{
				$TeachingWorkgroup=$_SESSION['TeachingWorkgroup'];
				}
				for($i=0;$i<count($TeachingWorkgroup,2);$i++){
					if($TeachingWorkgroup[$i]['teachingWorkgroupuid']==$_POST['teachingWorkgroupuid']){
								$TeachingWorkgroup[$i]['teachingWorkgroupType']=$_POST['teachingWorkgroupType'];
								$TeachingWorkgroup[$i]['teachingWorkgroup']=$_POST['teachingWorkgroup'];
								$TeachingWorkgroup[$i]['teachingWorkgroupWorkloadID']=$_POST['teachingWorkgroupWorkloadID'];
								$TeachingWorkgroup[$i]['teachingWorkgroupCode']=$_POST['teachingWorkgroupCode'];
								$TeachingWorkgroup[$i]['teachingWorkgroupNumberOfStudents']=$_POST['teachingWorkgroupNumberOfStudents'];
								$TeachingWorkgroup[$i]['teachingWorkgroupSubject']=$_POST['teachingWorkgroupSubject'];
								$TeachingWorkgroup[$i]['teachingWorkgroupHours']=$_POST['teachingWorkgroupHours'];
								$TeachingWorkgroup[$i]['teachingWorkgroupProportion']=$_POST['teachingWorkgroupProportion'];
								$_SESSION['TeachingWorkgroup'] = array_values($TeachingWorkgroup);
					break;
					}
				}	
	break;
	case 'updateresearchingWorkgroup':
		if(!isset($_SESSION['researchingWorkgroup']))$_SESSION['researchingWorkgroup']=array();
			if(!is_array($_SESSION['researchingWorkgroup']))
				{
				$researchingWorkgroup=array();
				}
				else
				{
				$researchingWorkgroup=$_SESSION['researchingWorkgroup'];
				}
				for($i=0;$i<count($researchingWorkgroup,2);$i++){
					if($researchingWorkgroup[$i]['researchingWorkgroupuid']==$_POST['researchingWorkgroupuid']){
								$researchingWorkgroup[$i]['researchingWorkgroupType']=$_POST['researchingWorkgroupType'];
								$researchingWorkgroup[$i]['researchingWorkgroup']=$_POST['researchingWorkgroup'];
								$researchingWorkgroup[$i]['researchingWorkgroupWorkloadID']=$_POST['researchingWorkgroupWorkloadID'];
								$researchingWorkgroup[$i]['researchingWorkgroupSubject']=$_POST['researchingWorkgroupSubject'];
								$researchingWorkgroup[$i]['researchingWorkgroupPeriod']=$_POST['researchingWorkgroupPeriod'];
								$researchingWorkgroup[$i]['researchingWorkgroupHours']=$_POST['researchingWorkgroupHours'];
								$researchingWorkgroup[$i]['researchingWorkgroupProportion']=$_POST['researchingWorkgroupProportion'];
								$_SESSION['researchingWorkgroup'] = array_values($researchingWorkgroup);
					break;
					}
				}	
	break;
	case 'updateservicesWorkgroup':
		if(!isset($_SESSION['servicesWorkgroup']))$_SESSION['servicesWorkgroup']=array();
			if(!is_array($_SESSION['servicesWorkgroup']))
				{
				$servicesWorkgroup=array();
				}
				else
				{
				$servicesWorkgroup=$_SESSION['servicesWorkgroup'];
				}
				for($i=0;$i<count($servicesWorkgroup,2);$i++){
					if($servicesWorkgroup[$i]['servicesWorkgroupuid']==$_POST['servicesWorkgroupuid']){
								$servicesWorkgroup[$i]['servicesWorkgroupType']=$_POST['servicesWorkgroupType'];
								$servicesWorkgroup[$i]['servicesWorkgroup']=$_POST['servicesWorkgroup'];
								$servicesWorkgroup[$i]['servicesWorkgroupWorkloadID']=$_POST['servicesWorkgroupWorkloadID'];
								$servicesWorkgroup[$i]['servicesWorkgroupSubject']=$_POST['servicesWorkgroupSubject'];
								$servicesWorkgroup[$i]['servicesWorkgroupTime']=$_POST['servicesWorkgroupTime'];
								$servicesWorkgroup[$i]['servicesWorkgroupHours']=$_POST['servicesWorkgroupHours'];
								$_SESSION['servicesWorkgroup'] = array_values($servicesWorkgroup);
					break;
					}
				}	
	break;
	case 'updateotherWorkgroup':
		if(!isset($_SESSION['otherWorkgroup']))$_SESSION['otherWorkgroup']=array();
			if(!is_array($_SESSION['otherWorkgroup']))
				{
				$otherWorkgroup=array();
				}
				else
				{
				$otherWorkgroup=$_SESSION['otherWorkgroup'];
				}
				for($i=0;$i<count($otherWorkgroup,2);$i++){
					if($otherWorkgroup[$i]['otherWorkgroupuid']==$_POST['otherWorkgroupuid']){
								$otherWorkgroup[$i]['otherWorkgroupType']=$_POST['otherWorkgroupType'];
								$otherWorkgroup[$i]['otherWorkgroup']=$_POST['otherWorkgroup'];
								$otherWorkgroup[$i]['otherWorkgroupWorkloadID']=$_POST['otherWorkgroupWorkloadID'];
								$otherWorkgroup[$i]['otherWorkgroupSubject']=$_POST['otherWorkgroupSubject'];
								$otherWorkgroup[$i]['otherWorkgroupTime']=$_POST['otherWorkgroupTime'];
								$otherWorkgroup[$i]['otherWorkgroupHours']=$_POST['otherWorkgroupHours'];
								$_SESSION['otherWorkgroup'] = array_values($otherWorkgroup);
					break;
					}
				}	
	break;	
	case 'deleteTeachingWorkgroup':
	if(!isset($_SESSION['TeachingWorkgroup']))$_SESSION['TeachingWorkgroup']=array();
			if(!is_array($_SESSION['TeachingWorkgroup']))
				{
				$TeachingWorkgroup=array();
				}
				else
				{
				$TeachingWorkgroup=$_SESSION['TeachingWorkgroup'];
				}
				for($i=0;$i<count($TeachingWorkgroup,2);$i++){
					if($TeachingWorkgroup[$i]['teachingWorkgroupuid']==$_POST['teachingWorkgroupuid']){
					unset($TeachingWorkgroup[$i]);
					$_SESSION['TeachingWorkgroup'] = array_values($TeachingWorkgroup);
					break;
					}
				}	
	break;
	case 'deleteresearchingWorkgroup':
	if(!isset($_SESSION['researchingWorkgroup']))$_SESSION['researchingWorkgroup']=array();
			if(!is_array($_SESSION['researchingWorkgroup']))
				{
				$researchingWorkgroup=array();
				}
				else
				{
				$researchingWorkgroup=$_SESSION['researchingWorkgroup'];
				}
				for($i=0;$i<count($researchingWorkgroup,2);$i++){
					if($researchingWorkgroup[$i]['researchingWorkgroupuid']==$_POST['researchingWorkgroupuid']){
					unset($researchingWorkgroup[$i]);
					$_SESSION['researchingWorkgroup'] = array_values($researchingWorkgroup);
					break;
					}
				}	
	break;
	case 'deleteservicesWorkgroup':
	if(!isset($_SESSION['servicesWorkgroup']))$_SESSION['servicesWorkgroup']=array();
			if(!is_array($_SESSION['servicesWorkgroup']))
				{
				$servicesWorkgroup=array();
				}
				else
				{
				$servicesWorkgroup=$_SESSION['servicesWorkgroup'];
				}
				for($i=0;$i<count($servicesWorkgroup,2);$i++){
					if($servicesWorkgroup[$i]['servicesWorkgroupuid']==$_POST['servicesWorkgroupuid']){
					unset($servicesWorkgroup[$i]);
					$_SESSION['servicesWorkgroup'] = array_values($servicesWorkgroup);
					break;
					}
				}	
	break;
	case 'deleteotherWorkgroup':
	if(!isset($_SESSION['otherWorkgroup']))$_SESSION['otherWorkgroup']=array();
			if(!is_array($_SESSION['otherWorkgroup']))
				{
				$otherWorkgroup=array();
				}
				else
				{
				$otherWorkgroup=$_SESSION['otherWorkgroup'];
				}
				for($i=0;$i<count($otherWorkgroup,2);$i++){
					if($otherWorkgroup[$i]['otherWorkgroupuid']==$_POST['otherWorkgroupuid']){
					unset($otherWorkgroup[$i]);
					$_SESSION['otherWorkgroup'] = array_values($otherWorkgroup);
					break;
					}
				}	
	break;	
	case 'readteachingworkgroup':
		echo "{\"data\":" .json_encode($_SESSION['TeachingWorkgroup']). ",\"total\":".count($_SESSION['TeachingWorkgroup'])."}";	
	break;
	case 'readresearchingworkgroup':
		echo "{\"data\":" .json_encode($_SESSION['researchingWorkgroup']). ",\"total\":".count($_SESSION['researchingWorkgroup'])."}";	
	break;
	case 'readservicesworkgroup':
		echo "{\"data\":" .json_encode($_SESSION['servicesWorkgroup']). ",\"total\":".count($_SESSION['servicesWorkgroup'])."}";
	break;
	case 'readotherworkgroup':
		echo "{\"data\":" .json_encode($_SESSION['otherWorkgroup']). ",\"total\":".count($_SESSION['otherWorkgroup'])."}";
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
	$('#m4').addClass('current-menu-item');
	script.initial();
	script.eventhandle();
	script.validation();	
	script.clearform();
});
var script= new function() {
	var validator = $("#scriptForm");
	var status=$('#error');
	var formteachingworkgroup;
	var formresearchingworkgroup;
	var formservicesworkgroup;
	var formotherworkgroup;
	this.initial=function(){
    	$('#error').hide(); 
		$("#workloadListComplete").kendoGrid({
	        dataSource: {
	        	transport: {read: "workload.php?mode=selectAllCompleteWorkload"},	            
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
          if ($.trim(dataItem.comment) != "") {
            return "<a href=\"javascript:viewcomment("+dataItem.workloadID+")\">ดูข้อเสนอแนะ</a>";
          } else {
            return "";
          }
        }
      },
	        	{field: "status", title:"สถานะ",template:'#=status==0?"ยังไม่เสร็จสมบูรณ์":status==1?"กำลังส่งตรวจสอบ":"ตรวจสอบแล้ว"#'}
	        	],
	        toolbar: [
	        	{template: '<a class="k-button" href="javascript:;" id="btnPrintForm1"><img src="img/mono-icons/doc_plus.png" width="12px">พิมพ์ แบบ ภวช 1</a>'}
	        	,{template: '<a class="k-button" href="javascript:;" id="btnPrintForm2"><img src="img/mono-icons/doc_plus.png" width="12px">พิมพ์ แบบ ภวช 2</a>'}

				]
	    });
	    $("#workloadListNotComplete").kendoGrid({
	        dataSource: {
	        	transport: {read: "workload.php?mode=selectAllNotCompleteWorkload"},	            
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
          if ($.trim(dataItem.comment) != "") {
            return "<a href=\"javascript:viewcomment("+dataItem.workloadID+")\">ดูข้อเสนอแนะ</a>";
          } else {
            return "";
          }
        }
      },
	        	{field: "status", title:"สถานะ",template:'#=status==0?"ยังไม่เสร็จสมบูรณ์":status==1?"กำลังส่งตรวจสอบ":status==2?"มีข้อปรับปรุง":"ตรวจสอบแล้ว"#'}
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
	        	}
	        	,
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="check"><img src="img/mono-icons/doc_plus.png" width="12px">ส่งตรวจสอบ</a>'
	        	}
	        	,
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="cancel"><img src="img/mono-icons/undo.png" width="12px">ยกเลิก</a>'
	        	}

				]
	    });
	    formteachingworkgroup= $("#formteachingworkgroup");
	        if (!formteachingworkgroup.data("kendoWindow")) {
	            formteachingworkgroup.kendoWindow({
	            	width: "800px",
	            	height:"300px",
	                title: "ข้อมูลกลุ่มงานสอน",
	                modal:true,
	                animation:false,
	                visible:false
	            });
	        } 
	    formresearchingworkgroup= $("#formresearchingworkgroup");
	        if (!formresearchingworkgroup.data("kendoWindow")) {
	            formresearchingworkgroup.kendoWindow({
	            	width: "800px",
	            	height:"300px",
	                title: "ข้อมูลกลุ่มงานวิจัยและงานวิชาการ",
	                modal:true,
	                animation:false,
	                visible:false
	            });
	        } 
		formservicesworkgroup= $("#formservicesworkgroup");
	        if (!formservicesworkgroup.data("kendoWindow")) {
	            formservicesworkgroup.kendoWindow({
	            	width: "800px",
	            	height:"300px",
	                title: "ข้อมูลกลุ่มงานบริการวิชาการ",
	                modal:true,
	                animation:false,
	                visible:false
	            });
	        } 
		formotherworkgroup= $("#formotherworkgroup");
	        if (!formotherworkgroup.data("kendoWindow")) {
	            formotherworkgroup.kendoWindow({
	            	width: "800px",
	            	height:"300px",
	                title: "ข้อมูลกลุ่มงานอื่นๆ",
	                modal:true,
	                animation:false,
	                visible:false
	            });
	        } 			
	    $("#teachingworkgroup").kendoGrid({
	        dataSource: {
	        	transport: {read:{
			        		dataType:"json",
			        		type:"POST",
			        		data:({mode:'readteachingworkgroup'}),
			        		url:'workload.php'
			        		}
		        		},	           
	            dataType: "json",
	            autoSync: true,
	            pageSize: 5,
	            schema: {
				    data: "data",
				    total:"total"
				}				
            },	  
            selectable: "multiple",      
	        pageable: {pageSizes: true},
	        columns: [ 
	        	//{field: "teachingWorkgroupID",title: "ลำดับ",width: 60, type: "number"},
	        	{field: "teachingWorkgroupType",title: "ประเภท"},
	        	{field: "teachingWorkgroup",title: "งาน"},
	        	{field: "teachingWorkgroupCode",title: "รหัส"},
	        	{field: "teachingWorkgroupNumberOfStudents",title: "จำนวนนักศึกษา"},
	        	{field: "teachingWorkgroupSubject",title: "รายวิชา/หลักสูตร/สาขาวิชา"},
	        	{field: "teachingWorkgroupHours",title: "ชั่วโมงทำการสอนต่อสัปดาห์"},
	        	{field: "teachingWorkgroupProportion",title: "สัดส่วน %"},
	        	],
	        toolbar: [
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="addteachingWorkgroup"><img src="img/mono-icons/doc_plus.png" width="12px">เพื่มรายการ</a>'
	        	},
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="editteachingWorkgroup"><img src="img/mono-icons/doc_edit.png" width="12px">แก้ไข</a>'
	        	},
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="deleteteachingWorkgroup"><img src="img/mono-icons/doc_delete.png" width="12px">ลบ</a>'
	        	}

]
	        });
	        $("#researchingworkgroup").kendoGrid({
	        dataSource: {
	        	transport: {read:{
			        		dataType:"json",
			        		type:"POST",
			        		data:({mode:'readresearchingworkgroup'}),
			        		url:'workload.php'
			        		}
		        		},	           
	            dataType: "json",
	            autoSync: true,
	            pageSize: 5,
	            schema: {
				    data: "data",
				    total:"total"
				}				
            },	  
            selectable: "multiple",      
	        pageable: {pageSizes: true},
	        columns: [ 
	        	//{field: "researchingWorkgroupID",title: "ลำดับ",width: 60, type: "number"},
	        	{field: "researchingWorkgroupType",title: "ประเภท"},
	        	{field: "researchingWorkgroup",title: "กิจกรรม"},
	        	{field: "researchingWorkgroupSubject",title: "ชื่อเรื่อง / กิจกรรม"},
	        	{field: "researchingWorkgroupPeriod",title: "ระยะเวลา"},
	        	{field: "researchingWorkgroupHours",title: "ชั่วโมงทำการสอนต่อสัปดาห์"},
	        	{field: "researchingWorkgroupProportion",title: "สัดส่วน %"},
	        	],
	        toolbar: [
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="addresearchingWorkgroup"><img src="img/mono-icons/doc_plus.png" width="12px">เพื่มรายการ</a>'
	        	},
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="editresearchingWorkgroup"><img src="img/mono-icons/doc_edit.png" width="12px">แก้ไข</a>'
	        	},
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="deleteresearchingWorkgroup"><img src="img/mono-icons/doc_delete.png" width="12px">ลบ</a>'
	        	}

]
	        });
			$("#servicesworkgroup").kendoGrid({
	        dataSource: {
	        	transport: {read:{
			        		dataType:"json",
			        		type:"POST",
			        		data:({mode:'readservicesworkgroup'}),
			        		url:'workload.php'
			        		}
		        		},	           
	            dataType: "json",
	            autoSync: true,
	            pageSize: 5,
	            schema: {
				    data: "data",
				    total:"total"
				}				
            },	  
            selectable: "multiple",      
	        pageable: {pageSizes: true},
	        columns: [ 
	        	//{field: "servicesWorkgroupID",title: "ลำดับ",width: 60, type: "number"},
	        	{field: "servicesWorkgroupType",title: "ประเภท"},
	        	{field: "servicesWorkgroup",title: "กิจกรรม"},
	        	{field: "servicesWorkgroupSubject",title: "ชื่อเรื่อง / กิจกรรม"},
	        	{field: "servicesWorkgroupTime",title: "วัน / เวลา"},
	        	{field: "servicesWorkgroupHours",title: "ชั่วโมงทำการสอนต่อสัปดาห์"},
	        	],
	        toolbar: [
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="addservicesWorkgroup"><img src="img/mono-icons/doc_plus.png" width="12px">เพื่มรายการ</a>'
	        	},
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="editservicesWorkgroup"><img src="img/mono-icons/doc_edit.png" width="12px">แก้ไข</a>'
	        	},
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="deleteservicesWorkgroup"><img src="img/mono-icons/doc_delete.png" width="12px">ลบ</a>'
	        	}

]
	        });
			$("#otherworkgroup").kendoGrid({
	        dataSource: {
	        	transport: {read:{
			        		dataType:"json",
			        		type:"POST",
			        		data:({mode:'readotherworkgroup'}),
			        		url:'workload.php'
			        		}
		        		},	           
	            dataType: "json",
	            autoSync: true,
	            pageSize: 5,
	            schema: {
				    data: "data",
				    total:"total"
				}				
            },	  
            selectable: "multiple",      
	        pageable: {pageSizes: true},
	        columns: [ 
	        	//{field: "otherWorkgroupID",title: "ลำดับ",width: 60, type: "number"},
	        	{field: "otherWorkgroupType",title: "ประเภท"},
	        	{field: "otherWorkgroup",title: "กิจกรรม"},
	        	{field: "otherWorkgroupSubject",title: "ชื่อเรื่อง / กิจกรรม"},
	        	{field: "otherWorkgroupTime",title: "วัน / เวลา"},
	        	{field: "otherWorkgroupHours",title: "ชั่วโมงทำการสอนต่อสัปดาห์"},
	        	],
	        toolbar: [
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="addotherWorkgroup"><img src="img/mono-icons/doc_plus.png" width="12px">เพื่มรายการ</a>'
	        	},
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="editotherWorkgroup"><img src="img/mono-icons/doc_edit.png" width="12px">แก้ไข</a>'
	        	},
	        	{
	        	template: '<a class="k-button" href="javascript:;" id="deleteotherWorkgroup"><img src="img/mono-icons/doc_delete.png" width="12px">ลบ</a>'
	        	}

]
	        });
	    $('#facultyID,#teachingWorkgroupType,#researchingWorkgroupType,#servicesWorkgroupType,#otherWorkgroupType').kendoDropDownList(); 
		$('#teachingWorkgroupHours,#researchingWorkgroupHours,#servicesWorkgroupHours,#otherWorkgroupHours').kendoNumericTextBox({format: "#.00"});
 	                
	}//end initial
	this.eventhandle=function(){
		$("#addNew").click(function(){
		if($("#addNew").hasClass("k-state-disabled"))return;
				$("#addNew").addClass("k-state-disabled");
				$("#edit").addClass("k-state-disabled");
				$("#delete").addClass("k-state-disabled");
				$("#check").addClass("k-state-disabled");			
				script.clearform();
				$('#mode').val('insert');				
	
		});
		$("#edit").click(function(){
		if($("#edit").hasClass("k-state-disabled"))return;
			var workloadListNotComplete = $("#workloadListNotComplete").data("kendoGrid");
			var selectedItem = workloadListNotComplete.dataItem(workloadListNotComplete.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการแก้ไข.');return;}
			if(selectedItem.status=='1'){alert('ไม่สามารถแก้ไขรายการนี้ได้เนื่องจากอยู่ระหว่างการตรวจสอบ.');return;}
				$("#addNew").addClass("k-state-disabled");
				$("#edit").addClass("k-state-disabled");
				$("#delete").addClass("k-state-disabled");
				$("#check").addClass("k-state-disabled");								
				$('#mode').val('update');
				$('#workloadID').val(selectedItem.workloadID);
				$('#facultyID').data("kendoDropDownList").select(function(dataItem) {
				    return dataItem.value === selectedItem.facultyID;
				});
				$('#semester').val(selectedItem.semester);
				$('#year').val(selectedItem.year);
				ajax('workload.php',({mode:'selectWorkloadDetail',workloadID:selectedItem.workloadID}),false);
				$("#teachingworkgroup").data("kendoGrid").dataSource.read();
				$("#researchingworkgroup").data("kendoGrid").dataSource.read();
				$("#servicesworkgroup").data("kendoGrid").dataSource.read();
				$("#otherworkgroup").data("kendoGrid").dataSource.read();
			
		});
		$("#delete").click(function(){
		if($("#delete").hasClass("k-state-disabled"))return;
			var workloadListNotComplete = $("#workloadListNotComplete").data("kendoGrid");
			var selectedItem = workloadListNotComplete.dataItem(workloadListNotComplete.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการลบ.');return;}
			if(selectedItem.status=='1'){alert('ไม่สามารถลบรายการนี้ได้เนื่องจากอยู่ระหว่างการตรวจสอบ.');return;}
			if(confirm('คุณต้องการลบรายการนี้หรือไม่?')){
				if(ajax('workload.php',({mode:'delete',workloadID:selectedItem.workloadID}),false)=='true'){
					script.clearform();
				}
			}							
		});
		$("#check").click(function(){
			var workloadListNotComplete = $("#workloadListNotComplete").data("kendoGrid");
			var selectedItem = workloadListNotComplete.dataItem(workloadListNotComplete.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการส่งตรวจสอบ.');return;}
			if(selectedItem.status=='1'){alert('รายการนี้อยู่ระหว่างการตรวจสอบ.');return;}	
			if(ajax('workload.php',({mode:'check',workloadID:selectedItem.workloadID}),false)=='true'){
				alert("ทำการส่งตรวจสอบเรียบร้อยแล้ว");
					script.clearform();
				}
		});		
		$("#cancel").click(function(){
			$("#addNew").removeClass("k-state-disabled");
			$("#edit").removeClass("k-state-disabled");
			$("#delete").removeClass("k-state-disabled");
			$("#check").removeClass("k-state-disabled");
			$('#mode').val('insert');
			
			script.clearform();
		});
		
		$("#save").click(function() {
			$("#addNew").removeClass("k-state-disabled");
			$("#edit").removeClass("k-state-disabled");
			$("#delete").removeClass("k-state-disabled");
			$("#check").removeClass("k-state-disabled");
			

            if (validator.validate()) {
                status.hide();
                script.save();
            } else {
                status.html("มีบางรายการป้อนข้อมูลไม่ถูกต้อง.").show();
            }
        });
        $('#addteachingWorkgroup').click(function(){
			$('#teachingWorkgroupmode').val('insertTeachingWorkgroup');
        	formteachingworkgroup.data("kendoWindow").center().open();
        });
        $('#addresearchingWorkgroup').click(function(){
			$('#researchingWorkgroupmode').val('insertResearchingWorkgroup');
        	formresearchingworkgroup.data("kendoWindow").center().open();
        });
		$('#addservicesWorkgroup').click(function(){
			$('#servicesWorkgroupmode').val('insertServicesWorkgroup');
        	formservicesworkgroup.data("kendoWindow").center().open();
        });
		$('#addotherWorkgroup').click(function(){
			$('#otherWorkgroupmode').val('insertOtherWorkgroup');
        	formotherworkgroup.data("kendoWindow").center().open();
        });
        $('#editteachingWorkgroup').click(function(){
        	var gridTable = $("#teachingworkgroup").data("kendoGrid");
			var selectedItem = gridTable.dataItem(gridTable.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการแก้ไข.');return;}
			$('#teachingWorkgroupType').data("kendoDropDownList").select(function(dataItem) {
				return dataItem.value === selectedItem.teachingWorkgroupType;
			});
			$('#teachingWorkgroup').val(selectedItem.teachingWorkgroup);
			$('#teachingWorkgroupCode').val(selectedItem.teachingWorkgroupCode);
			$('#teachingWorkgroupNumberOfStudents').val(selectedItem.teachingWorkgroupNumberOfStudents);
			$('#teachingWorkgroupSubject').val(selectedItem.teachingWorkgroupSubject);
			$('#teachingWorkgroupHours').val(selectedItem.teachingWorkgroupHours);
			$('#teachingWorkgroupProportion').val(selectedItem.teachingWorkgroupProportion);
			$('#teachingWorkgroupmode').val('updateTeachingWorkgroup');
			$('#teachingWorkgroupuid').val(selectedItem.teachingWorkgroupuid);
        	formteachingworkgroup.data("kendoWindow").center().open();
        });
        $('#editresearchingWorkgroup').click(function(){
        	var gridTable = $("#researchingworkgroup").data("kendoGrid");
			var selectedItem = gridTable.dataItem(gridTable.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการแก้ไข.');return;}
			$('#researchingWorkgroupType').data("kendoDropDownList").select(function(dataItem) {
				return dataItem.value === selectedItem.researchingWorkgroupType;
			});
			$('#researchingWorkgroup').val(selectedItem.researchingWorkgroup);
			$('#researchingWorkgroupSubject').val(selectedItem.researchingWorkgroupSubject);
			$('#researchingWorkgroupPeriod').val(selectedItem.researchingWorkgroupPeriod);
			$('#researchingWorkgroupHours').val(selectedItem.researchingWorkgroupHours);
			$('#researchingWorkgroupProportion').val(selectedItem.researchingWorkgroupProportion);
			$('#researchingWorkgroupmode').val('updateresearchingWorkgroup');
			$('#researchingWorkgroupuid').val(selectedItem.researchingWorkgroupuid);
        	formresearchingworkgroup.data("kendoWindow").center().open();
        });
		$('#editservicesWorkgroup').click(function(){
        	var gridTable = $("#servicesworkgroup").data("kendoGrid");
			var selectedItem = gridTable.dataItem(gridTable.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการแก้ไข.');return;}
			$('#servicesWorkgroupType').data("kendoDropDownList").select(function(dataItem) {
				return dataItem.value === selectedItem.servicesWorkgroupType;
			});
			$('#servicesWorkgroup').val(selectedItem.servicesWorkgroup);
			$('#servicesWorkgroupSubject').val(selectedItem.servicesWorkgroupSubject);
			$('#servicesWorkgroupTime').val(selectedItem.servicesWorkgroupTime);
			$('#servicesWorkgroupHours').val(selectedItem.servicesWorkgroupHours);
			$('#servicesWorkgroupmode').val('updateservicesWorkgroup');
			$('#servicesWorkgroupuid').val(selectedItem.servicesWorkgroupuid);
        	formservicesworkgroup.data("kendoWindow").center().open();
        });
		$('#editotherWorkgroup').click(function(){
        	var gridTable = $("#otherworkgroup").data("kendoGrid");
			var selectedItem = gridTable.dataItem(gridTable.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการแก้ไข.');return;}
			$('#otherWorkgroupType').data("kendoDropDownList").select(function(dataItem) {
				return dataItem.value === selectedItem.otherWorkgroupType;
			});
			$('#otherWorkgroup').val(selectedItem.otherWorkgroup);
			$('#otherWorkgroupSubject').val(selectedItem.otherWorkgroupSubject);
			$('#otherWorkgroupTime').val(selectedItem.otherWorkgroupTime);
			$('#otherWorkgroupHours').val(selectedItem.otherWorkgroupHours);
			$('#otherWorkgroupmode').val('updateotherWorkgroup');
			$('#otherWorkgroupuid').val(selectedItem.otherWorkgroupuid);
        	formotherworkgroup.data("kendoWindow").center().open();
        });				
        $('#deleteteachingWorkgroup').click(function(){
        	var gridTable = $("#teachingworkgroup").data("kendoGrid");
			var selectedItem = gridTable.dataItem(gridTable.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการลบ.');return;}
			if(confirm('คุณต้องการลบรายการนี้หรือไม่?')){
			ajax('workload.php',({mode:'deleteTeachingWorkgroup',teachingWorkgroupuid:selectedItem.teachingWorkgroupuid}),false);
			$("#teachingworkgroup").data("kendoGrid").dataSource.read();
			}		
        });
        $('#deleteresearchingWorkgroup').click(function(){
        	var gridTable = $("#researchingworkgroup").data("kendoGrid");
			var selectedItem = gridTable.dataItem(gridTable.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการลบ.');return;}
			if(confirm('คุณต้องการลบรายการนี้หรือไม่?')){
			ajax('workload.php',({mode:'deleteresearchingWorkgroup',researchingWorkgroupuid:selectedItem.researchingWorkgroupuid}),false);
			$("#researchingworkgroup").data("kendoGrid").dataSource.read();
			}		
        });
        $('#deleteservicesWorkgroup').click(function(){
        	var gridTable = $("#servicesworkgroup").data("kendoGrid");
			var selectedItem = gridTable.dataItem(gridTable.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการลบ.');return;}
			if(confirm('คุณต้องการลบรายการนี้หรือไม่?')){
			ajax('workload.php',({mode:'deleteservicesWorkgroup',servicesWorkgroupuid:selectedItem.servicesWorkgroupuid}),false);
			$("#servicesworkgroup").data("kendoGrid").dataSource.read();
			}		
        });
        $('#deleteotherWorkgroup').click(function(){
        	var gridTable = $("#otherworkgroup").data("kendoGrid");
			var selectedItem = gridTable.dataItem(gridTable.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการลบ.');return;}
			if(confirm('คุณต้องการลบรายการนี้หรือไม่?')){
			ajax('workload.php',({mode:'deleteotherWorkgroup',otherWorkgroupuid:selectedItem.otherWorkgroupuid}),false);
			$("#otherworkgroup").data("kendoGrid").dataSource.read();
			}		
        });				
        $('#teachingWorkgroupSave').click(function(){
	        var datastring=new Object();
	        datastring.teachingWorkgroupType=$('#teachingWorkgroupType').val();
	        datastring.teachingWorkgroup=$('#teachingWorkgroup').val();
			datastring.teachingWorkgroupWorkloadID=$('#workloadID').val();
			datastring.teachingWorkgroupCode=$('#teachingWorkgroupCode').val();
			datastring.teachingWorkgroupNumberOfStudents=$('#teachingWorkgroupNumberOfStudents').val();
			datastring.teachingWorkgroupSubject=$('#teachingWorkgroupSubject').val();
			datastring.teachingWorkgroupHours=$('#teachingWorkgroupHours').val();
			datastring.teachingWorkgroupProportion=$('#teachingWorkgroupProportion').val();
			datastring.mode=$('#teachingWorkgroupmode').val();
			datastring.teachingWorkgroupuid=$('#teachingWorkgroupuid').val();
			
			$('#teachingWorkgroupType').data("kendoDropDownList").select(0);
			$('#teachingWorkgroup').val("");
			$('#teachingWorkgroupCode').val("");
			$('#teachingWorkgroupNumberOfStudents').val("");
			$('#teachingWorkgroupSubject').val("");
			$('#teachingWorkgroupHours').data("kendoNumericTextBox").value("");
			$('#teachingWorkgroupProportion').val("");
			
			var response=ajax('workload.php',datastring,false);
			$("#teachingworkgroup").data("kendoGrid").dataSource.read();
        	formteachingworkgroup.data("kendoWindow").center().close();
        }); 
        $('#researchingWorkgroupSave').click(function(){
	        var datastring=new Object();
	        datastring.researchingWorkgroupType=$('#researchingWorkgroupType').val();
	        datastring.researchingWorkgroup=$('#researchingWorkgroup').val();
			datastring.researchingWorkgroupWorkloadID=$('#workloadID').val();
			datastring.researchingWorkgroupSubject=$('#researchingWorkgroupSubject').val();
			datastring.researchingWorkgroupPeriod=$('#researchingWorkgroupPeriod').val();
			datastring.researchingWorkgroupHours=$('#researchingWorkgroupHours').val();
			datastring.researchingWorkgroupProportion=$('#researchingWorkgroupProportion').val();
			datastring.mode=$('#researchingWorkgroupmode').val();
			datastring.researchingWorkgroupuid=$('#researchingWorkgroupuid').val();
			var response=ajax('workload.php',datastring,false);
			$("#researchingworkgroup").data("kendoGrid").dataSource.read();
        	formresearchingworkgroup.data("kendoWindow").center().close();
        });  
		$('#servicesWorkgroupSave').click(function(){
	        var datastring=new Object();
	        datastring.servicesWorkgroupType=$('#servicesWorkgroupType').val();
	        datastring.servicesWorkgroup=$('#servicesWorkgroup').val();
			datastring.servicesWorkgroupWorkloadID=$('#workloadID').val();
			datastring.servicesWorkgroupSubject=$('#servicesWorkgroupSubject').val();
			datastring.servicesWorkgroupTime=$('#servicesWorkgroupTime').val();
			datastring.servicesWorkgroupHours=$('#servicesWorkgroupHours').val();
			datastring.mode=$('#servicesWorkgroupmode').val();
			datastring.servicesWorkgroupuid=$('#servicesWorkgroupuid').val();
			var response=ajax('workload.php',datastring,false);
			$("#servicesworkgroup").data("kendoGrid").dataSource.read();
        	formservicesworkgroup.data("kendoWindow").center().close();
        }); 
		$('#otherWorkgroupSave').click(function(){
	        var datastring=new Object();
	        datastring.otherWorkgroupType=$('#otherWorkgroupType').val();
	        datastring.otherWorkgroup=$('#otherWorkgroup').val();
			datastring.otherWorkgroupWorkloadID=$('#workloadID').val();
			datastring.otherWorkgroupSubject=$('#otherWorkgroupSubject').val();
			datastring.otherWorkgroupTime=$('#otherWorkgroupTime').val();
			datastring.otherWorkgroupHours=$('#otherWorkgroupHours').val();
			datastring.mode=$('#otherWorkgroupmode').val();
			datastring.otherWorkgroupuid=$('#otherWorkgroupuid').val();
			var response=ajax('workload.php',datastring,false);
			$("#otherworkgroup").data("kendoGrid").dataSource.read();
        	formotherworkgroup.data("kendoWindow").center().close();
        });
		$('#btnPrintForm1').click(function(e) {
            var workloadListComplete = $("#workloadListComplete").data("kendoGrid");
			var selectedItem = workloadListComplete.dataItem(workloadListComplete.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการ.');return;}
			window.open("workload1.php?workloadID="+selectedItem.workloadID);
        });
		$('#btnPrintForm2').click(function(e) {
            var workloadListComplete = $("#workloadListComplete").data("kendoGrid");
			var selectedItem = workloadListComplete.dataItem(workloadListComplete.select());
			if(selectedItem==null){alert('กรุณาเลือกรายการที่ต้องการ.');return;}
			window.open("workload2.php?workloadID="+selectedItem.workloadID);
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
		$("#workloadListNotComplete").data("kendoGrid").clearSelection();
		$("#workloadListNotComplete").data("kendoGrid").dataSource.read();
		$("#workloadListNotComplete").data("kendoGrid").refresh();
		HTMLFormElement.prototype.reset.call($('#scriptForm')[0]);
		//$('#scriptForm')[0].reset();
		var lastID=ajax('workload.php',({mode:'getLastID'}),false);
		$('#workloadID').val(lastID);
		ajax('workload.php',({mode:'clearSession'}),false);
		$("#teachingworkgroup").data("kendoGrid").dataSource.read();
		$("#researchingworkgroup").data("kendoGrid").dataSource.read();
		$("#servicesworkgroup").data("kendoGrid").dataSource.read();
		$("#otherworkgroup").data("kendoGrid").dataSource.read();
		$('#mode').val('insert');
	}//end clearForm

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
				<form id="scriptForm" action="workload.php" method="post" name="scriptForm">
					<input id="mode" name="mode" type="hidden" value="insert" />
					<?php include_once('profileheader.php'); ?><fieldset>
					<legend style="color: #37b2d1">จัดการข้อมูลแบบภวช1</legend>
					<fieldset>
					<legend style="color: #37b2d1">รายการแบบภวช 1 (ตรวจสอบแล้ว)</legend>
					<div id="workloadListComplete">
					</div>
					</fieldset> <fieldset>
					<legend style="color: #37b2d1">รายการแบบภวช 1 (ยังไม่ได้รับการตรวจสอบ)</legend>
					<div id="workloadListNotComplete">
					</div>
					</fieldset> <fieldset>
					<legend style="color: #37b2d1">ข้อมูลแบบภวช 1</legend>
					<div>
						<label>รหัสภาระงาน :</label>
						<input id="workloadID" class="input" name="workloadID" required title="พิมพ์รหัสภาระงาน" type="text" readonly>
						<span class="k-invalid-msg" data-for="workloadID"></span>
					</div>

					<div>
						<label>ปฎิบัติงานที่ :</label>
						<select id="facultyID" name="facultyID" required="" title="เลือกคณะ / สถาบัน">
						<option value="">คณะ / สถาบัน</option>
						<?php 
								$strsql="SELECT * FROM faculty WHERE status='1'";
								$faculty=$database->query($strsql);
								foreach($faculty as $item):
							?>
						<option value="<?php echo $item['facultyID'];?>"><?php echo $item['faculty'];?>
						</option>
						<?php endforeach;?></select>*
						<span class="k-invalid-msg" data-for="facultyID"></span>
					</div>
					<div>
						<label>ภาคการศึกษาที่ :</label>
						<input id="semester" class="input" name="semester" required title="พิมพ์ภาคการศึกษา" type="text">*
						<span class="k-invalid-msg" data-for="semester"></span>
					</div>
					<div>
						<label>ปีีการศึกษา :</label>
						<input id="year" class="input" name="year" required title="พิมพ์ปีการศึกษา" type="text">*
						<span class="k-invalid-msg" data-for="year"></span>
					</div>
					<fieldset>
					<legend style="color: #37b2d1">กลุ่มงานสอน</legend>
					<div id="teachingworkgroup">
					</div>
					<div id="formteachingworkgroup">
					<input id="teachingWorkgroupmode" name="teachingWorkgroupmode" type="hidden" value="insertTeachingWorkgroup" />
					<input id="teachingWorkgroupuid" name="teachingWorkgroupuid" type="hidden" value="" />
						<div>
							<label>ประเภทกลุ่มงานสอน :</label><select name="teachingWorkgroupType" id="teachingWorkgroupType">
							<option value="">เลือกประเภทกลุ่มงานสอน</option>
							<option value="1">1.1 งานการสอน</option>
							<option value="2">1.2 งานควบคุมวิทยานิพนธ์/การค้นคว้า/โครงการนักศึกษา(ไม่เกิน 5 เรื่อง)</option>
							<option value="3">1.3 งานที่ปรึกษา</option>
							<option value="4">1.4 งานนิเทศ</option>
							<option value="5">1.5 การประสานงานรายวิชา</option>
							<option value="6">1.6 อื่นๆ</option>
							</select>
							<span class="k-invalid-msg" data-for="teachingWorkgroupType">
							</span></div>
						<div>
							<label>งาน :</label>
							<input id="teachingWorkgroup" class="input" name="teachingWorkgroup" title="พิมพ์งาน" type="text">
							<span class="k-invalid-msg" data-for="teachingWorkgroup"></span>
						</div>
	
						<div>
							<label>รหัส :</label>
							<input id="teachingWorkgroupCode" class="input" name="teachingWorkgroupCode" title="พิมพ์รหัส" type="text">
							<span class="k-invalid-msg" data-for="teachingWorkgroupCode"></span>
						</div>
						<div>
							<label>จำนวนนักศึกษา :</label>
							<input id="teachingWorkgroupNumberOfStudents" class="input" name="teachingWorkgroupNumberOfStudents" title="พิมพ์รหัส" type="text">
							<span class="k-invalid-msg" data-for="teachingWorkgroupNumberOfStudents">
							</span>
						</div>
						<div>
							<label>รายวิชา/หลักสูตร/สาขาวิชา :</label>
							<textarea id="teachingWorkgroupSubject" class="input" name="teachingWorkgroupSubject" title="พิมพ์รายวิชา/หลักสูตร/สาขาวิชา" ></textarea>
							<span class="k-invalid-msg" data-for="teachingWorkgroupSubject">
							</span>
						</div>
						<div>
							<label>ชม.ทำการ/สป. :</label>
							<input id="teachingWorkgroupHours"  name="teachingWorkgroupHours" title="พิมพ์ชั่วโมงทำการต่อสัปดาห์" type="text">
							<span class="k-invalid-msg" data-for="teachingWorkgroupHours">
							</span>
						</div>
						<div>
							<label>สัดส่วน(%) / เวลาทำการ:</label>
							<input id="teachingWorkgroupProportion" class="input" name="teachingWorkgroupProportion" title="พิมพ์สัดส่วน" type="text">
							<span class="k-invalid-msg" data-for="teachingWorkgroupProportion">
							</span>
						</div>
						<input id="teachingWorkgroupSave" class="k-button" name="teachingWorkgroupSave" type="button" value="บันทึก" />


					</div>
					</fieldset>
					<fieldset>
					<legend style="color: #37b2d1">กลุ่มงานวิจัยและงานวิชาการ</legend>
					<div id="researchingworkgroup">
					</div>
					<div id="formresearchingworkgroup">
					<input id="researchingWorkgroupmode" name="researchingWorkgroupmode" type="hidden" value="insertResearchingWorkgroup" />
					<input id="researchingWorkgroupuid" name="researchingWorkgroupuid" type="hidden" value="" />
						<div>
							<label>ประเภทกิจกรรม :</label><select name="researchingWorkgroupType" id="researchingWorkgroupType">
							<option value="">เลือกประเภทกิจกรรม</option>
							<option value="1">2.1 โครงการวิจัย</option>
							<option value="2">2.2 การจัดทำตำรา เอกสาร สื่อ หนังสือวิชาการ</option>
							<option value="3">2.3 อื่นๆ</option>
							</select>
							<span class="k-invalid-msg" data-for="researchingWorkgroupType">
							</span></div>
						<div>
							<label>กิจกรรม :</label>
							<input id="researchingWorkgroup" class="input" name="researchingWorkgroup" title="พิมพ์กิจกรรม" type="text">
							<span class="k-invalid-msg" data-for="researchingWorkgroup"></span>
						</div>
	
						<div>
							<label>ชื่อเรื่อง / กิจกรรม :</label>
							<textarea id="researchingWorkgroupSubject" class="input" name="researchingWorkgroupSubject" title="พิมพ์ชื่อเรื่อง / กิจกรรม" ></textarea>
							<span class="k-invalid-msg" data-for="researchingWorkgroupSubject"></span>
						</div>
						<div>
							<label>ระยะเวลา :</label>
							<input id="researchingWorkgroupPeriod" class="input" name="researchingWorkgroupPeriod" title="พิมพ์ระยะเวลา" type="text">
							<span class="k-invalid-msg" data-for="researchingWorkgroupPeriod">
							</span>
						</div>
						<div>
							<label>ชม.ทำการ/สป. :</label>
							<input id="researchingWorkgroupHours"  name="researchingWorkgroupHours" title="พิมพ์ชั่วโมงทำการต่อสัปดาห์" type="text">
							<span class="k-invalid-msg" data-for="researchingWorkgroupHours">
							</span>
						</div>
						<div>
							<label>สัดส่วน(%) :</label>
							<input id="researchingWorkgroupProportion" class="input" name="researchingWorkgroupProportion" title="พิมพ์สัดส่วน" type="text">
							<span class="k-invalid-msg" data-for="researchingWorkgroupProportion">
							</span>
						</div>
						<input id="researchingWorkgroupSave" class="k-button" name="researchingWorkgroupSave" type="button" value="บันทึก" />


					</div>
					</fieldset>
					<fieldset>
					<legend style="color: #37b2d1">กลุ่มงานบริการวิชาการ</legend>
					<div id="servicesworkgroup">
					</div>
					<div id="formservicesworkgroup">
					<input id="servicesWorkgroupmode" name="servicesWorkgroupmode" type="hidden" value="insertServicesWorkgroup" />
					<input id="servicesWorkgroupuid" name="servicesWorkgroupuid" type="hidden" value="" />
						<div>
							<label>ประเภทกิจกรรม :</label><select name="servicesWorkgroupType" id="servicesWorkgroupType">
							<option value="">เลือกประเภทกิจกรรม</option>
							<option value="1">3.1 กรรมการวิชาการพัฒนาหลักสูตร</option>
							<option value="2">3.2 การอบรมบุคคลภายนอก</option>
                            <option value="3">3.3 คณะกรรมการตรวจประเมินคุณภาพการศึกษาภายใน</option>
							<option value="4">3.4 อื่นๆ</option>
							</select>
							<span class="k-invalid-msg" data-for="servicesWorkgroupType">
							</span></div>
						<div>
							<label>กิจกรรม :</label>
							<input id="servicesWorkgroup" class="input" name="servicesWorkgroup" title="พิมพ์กิจกรรม" type="text">
							<span class="k-invalid-msg" data-for="servicesWorkgroup"></span>
						</div>
	
						<div>
							<label>ชื่อเรื่อง / โครงการ :</label>
							<textarea id="servicesWorkgroupSubject" class="input" name="servicesWorkgroupSubject" title="พิมพ์ชื่อเรื่อง / กิจกรรม" ></textarea>
							<span class="k-invalid-msg" data-for="servicesWorkgroupSubject"></span>
						</div>
						<div>
							<label>วัน/เวลา :</label>
							<input id="servicesWorkgroupTime" class="input" name="servicesWorkgroupTime" title="พิมพ์วัน / เวลา" type="text">
							<span class="k-invalid-msg" data-for="servicesWorkgroupTime">
							</span>
						</div>
						<div>
							<label>ชม.ทำการ/สป. :</label>
							<input id="servicesWorkgroupHours"  name="servicesWorkgroupHours" title="พิมพ์ชั่วโมงทำการต่อสัปดาห์" type="text">
							<span class="k-invalid-msg" data-for="servicesWorkgroupHours">
							</span>
						</div>
						
						<input id="servicesWorkgroupSave" class="k-button" name="servicesWorkgroupSave" type="button" value="บันทึก" />


					</div>
					</fieldset>
					<fieldset>
					<legend style="color: #37b2d1">กลุ่มงานอื่นๆ</legend>
					<div id="otherworkgroup">
					</div>
					<div id="formotherworkgroup">
					<input id="otherWorkgroupmode" name="otherWorkgroupmode" type="hidden" value="insertOtherWorkgroup" />
					<input id="otherWorkgroupuid" name="otherWorkgroupuid" type="hidden" value="" />
						<div>
							<label>ประเภทกิจกรรม :</label><select name="otherWorkgroupType" id="otherWorkgroupType">
							<option value="">เลือกประเภทกิจกรรม</option>
							<option value="1">4.1 กรรมการส่งเสริมกิจกรรมมหาวิทยาลัย</option>
							<option value="2">4.2 กรรมการประจำหลักสูตร</option>
                            <option value="3">4.3 กรรมการประจำคณะ / ศูนย์ / สถาบัน</option>
                            <option value="4">4.4 งานที่ภาควิชา / สาขาวิชา / คณะ / สำนัก / สถาบัน / มหาวิทยาลัยมอบหมาย</option>
							<option value="5">4.5 กรรมการเฉพาะกิจ</option>
                            <option value="6">4.6 อื่นๆ</option>
							</select>
							<span class="k-invalid-msg" data-for="otherWorkgroupType">
							</span></div>
						<div>
							<label>กิจกรรม :</label>
							<input id="otherWorkgroup" class="input" name="otherWorkgroup" title="พิมพ์กิจกรรม" type="text">
							<span class="k-invalid-msg" data-for="otherWorkgroup"></span>
						</div>
	
						<div>
							<label>ชื่อเรื่อง / โครงการ :</label>
							<textarea id="otherWorkgroupSubject" class="input" name="otherWorkgroupSubject" title="พิมพ์ชื่อเรื่อง / กิจกรรม" ></textarea>
							<span class="k-invalid-msg" data-for="otherWorkgroupSubject"></span>
						</div>
						<div>
							<label>วัน/เวลา :</label>
							<input id="otherWorkgroupTime" class="input" name="otherWorkgroupTime" title="พิมพ์วัน / เวลา" type="text">
							<span class="k-invalid-msg" data-for="otherWorkgroupTime">
							</span>
						</div>
						<div>
							<label>ชม.ทำการ/สป. :</label>
							<input id="otherWorkgroupHours"  name="otherWorkgroupHours" title="พิมพ์ชั่วโมงทำการต่อสัปดาห์" type="text">
							<span class="k-invalid-msg" data-for="otherWorkgroupHours">
							</span>
						</div>
						
						<input id="otherWorkgroupSave" class="k-button" name="otherWorkgroupSave" type="button" value="บันทึก" />


					</div>
					</fieldset>
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
