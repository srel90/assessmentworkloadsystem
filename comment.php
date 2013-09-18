<?php
require_once('MySQL.class.php');
$database= new database();
header("Content-type: application/vnd.ms-word; charset=utf-8");
header("Content-Disposition: attachment;Filename=comment.doc");
$strsql="SELECT comment FROM workload WHERE workloadID='".$_GET['workloadID']."'";
$data=$database->query($strsql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Comment</title>
</head>
<body>
<?php echo $data[0]['comment'];?>
</body>
</html>