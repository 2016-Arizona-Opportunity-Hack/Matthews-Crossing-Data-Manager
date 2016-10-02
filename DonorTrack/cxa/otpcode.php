<?php
include('php/guestsession.php');
use OTPHP\TOTP;

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['regsql']) && !empty($_SESSION['otphp']) && !empty($_POST["otp"])){
	if($_SESSION["otphp"]->verify($_POST["otp"])){
		unset($_SESSION["otphp"]);
		if($conn->query($sql)){
			unset($_SESSION["regsql"]);
			include('php/reg-ok.php');
		}else{
			$registererror="Database error!";
			unset($_SESSION["regsql"]);
			include('php/reg.php');
		}
	}else{
		include('php/reg-img.php');
	}
}elseif(!empty($_SESSION['regsql']) && !empty($_SESSION['otphp'])){
	include('php/reg-img.php');
}else{
	include('php/reg.php');
}
?>