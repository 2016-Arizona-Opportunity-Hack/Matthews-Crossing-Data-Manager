<?php
require_once('php/ga.php');
require_once('php/guestsession.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['regsql']) && !empty($_SESSION['otpsecret']) && !empty($_POST["otp"])){
	if(Google2FA::verify_key($_SESSION["otpsecret"],$_POST["otp"])){
		unset($_SESSION["otpsecret"]);
		unset($_SESSION["otpuri"]);
		if($conn->query($_SESSION["regsql"])){
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
}elseif(!empty($_SESSION['regsql']) && !empty($_SESSION['otpuri'])){
	include('php/reg-img.php');
}else{
	include('php/reg.php');
}
?>