<!--
log.php - Login page for the CXA Auth LW web data framework.
Copyright (c) 2016 James Rowley

This file is part of CXA Auth LW, which is licensed under the Creative Commons Attribution-NonCommercial-ShareAlike 3.0 United States License.
You should have received a copy of this license with CXA Auth LW.
If not, to view a copy of the license, visit https://creativecommons.org/licenses/by-nc-sa/3.0/us/legalcode
-->

<?php
include('meta.php');
if(!isset($loginerror)){
	$loginerror='';
}
?>
<html>
	<head>
		<title>MCDM DonorTrack Login</title>
		<link rel="stylesheet" type="text/css" href="css/cxa-ui.css">
		<link rel="icon" type="image/png" href="./img/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<form action="login.php" method="post" id="main">
			<div id="topbar" class="loginbar noselect"><?php cxa_header() ?></div>
			<div id="login">
				&nbsp;Username:<br/>
				<input type="text" name="username" class="logintext"/><br/>
				&nbsp;Password:<br/>
				<input type="password" name="password" class="logintext"/><br/>
				&nbsp;One-time Password:<br/>
				<input type="number" name="otp" class="logintext"/><br/>
				&nbsp;<input type="checkbox" name="rememberme" />Remember Me<br/>
				<input  type="submit" style="position: absolute; height: 0px; width: 0px; border: none; padding: 0px;" hidefocus="true" tabindex="-1"/>
				<?php
				if($loginerror){
					echo "<div id=\"loginerror\">".$loginerror."</div>";
				}
				?>
				<span class="logincenter">- or -</span>
				<div class="loginbutton" onclick="window.location.assign('./register.php')">
					Request Access
				</div>
			</div>
			<div id="bottombar" class="loginbar noselect" onclick="document.getElementById('main').submit(); return false;">Login&nbsp;&nbsp;</div>
			<div id="footer" class="loginbar" ><?php cxa_footer() ?></div>
		</form>
		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" style="position: absolute; bottom: 10px; right: 10px; margin-bottom: 4px;">
		
			<!-- Identify your business so that you can collect the payments. -->
			<input type="hidden" name="business"
				value="test@test.tester">
		
			<!-- Specify a Donate button. -->
			<input type="hidden" name="cmd" value="_donations">
		
			<!-- Specify details about the contribution -->
			<input type="hidden" name="item_name" value="Friends of the Park">
			<input type="hidden" name="item_number" value="Fall Cleanup Campaign">
			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="notify_url" value="https://matt.mcepic.com/index.php">
			
		
			<!-- Display the payment button. -->
			<input type="image" name="submit"
			src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_donate_92x26.png"
			alt="Donate" >
			<img alt="" width="1" height="1"
			src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
		
		</form>
	</body>
</html>