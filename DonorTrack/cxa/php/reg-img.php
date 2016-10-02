<?php
include('meta.php');
?>
<html>
	<head>
		<title>MCDM DonorTrack - Set up Two Factor Authentication</title>
		<link rel="stylesheet" type="text/css" href="css/cxa-ui.css">
		<link rel="icon" type="image/png" href="./img/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<form action="otpcode.php" method="post" id="main">
			<div id="topbar" class="loginbar noselect"><?php cxa_header() ?></div>
			<div id="login">
					<div id="loginerror" style="background: #2a2; color: #eee; width: 180px; margin: 0 auto; padding: 4px;"><img src="/cxa/otpimg.php" /></div>
					<p class="ilabel" style="margin-top: 12px;">&nbsp;Scan the code with the Google Authenticator app, then enter your one-time code below.</p>
					<input type="number" name="otp" class="logintext"/><br/>
					<input  type="submit" style="position: absolute; height: 0px; width: 0px; border: none; padding: 0px;" hidefocus="true" tabindex="-1"/>
			</div>
			<div id="bottombar" class="loginbar noselect" onclick="document.getElementById('main').submit(); return false;">Submit&nbsp;&nbsp;</div>
			<div id="footer" class="loginbar" ><?php cxa_footer() ?></div>
		</form>
	</body>
</html>