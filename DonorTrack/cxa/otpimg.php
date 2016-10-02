<?php
include('php/guestsession.php');
use OTPHP\TOTP;
include('php/qrgen/qrlib.php');

if(!empty($_SESSION["otphp"])){
	QRcode::png($_SESSION["otphp"]->getProvisioningUri(););
}
?>