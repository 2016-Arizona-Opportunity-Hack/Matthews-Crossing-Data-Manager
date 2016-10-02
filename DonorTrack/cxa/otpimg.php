<?php
require_once('php/qrgen/qrlib.php');
require_once('php/guestsession.php');

//if(!empty($_SESSION["otpuri"])){
	//QRcode::png($_SESSION["otpuri"], false, 2, 4);
	QRcode::png('otpauth://totp/MCDM:admin@CXA?secret=7UNFZL7B5LVISJWI', false, 2, 4);
//}
?>