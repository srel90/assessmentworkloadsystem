﻿<?php
session_start();
unset($_SESSION['users']);
unset($_SESSION['TeachingWorkgroup']);
unset($_SESSION['researchingWorkgroup']);
unset($_SESSION['servicesWorkgroup']);
unset($_SESSION['otherWorkgroup']);
header("location:index.php");
?>