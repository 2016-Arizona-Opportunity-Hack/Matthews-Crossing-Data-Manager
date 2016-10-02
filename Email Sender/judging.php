<!--
judging.php - Example page for CXA UI web data framework demo.
Copyright (c) 2016 James Rowley
This file is part of CXA UI, which is licensed under the Creative Commons Attribution-NonCommercial-ShareAlike 3.0 United States License.
You should have received a copy of this license with CXA UI.
If not, to view a copy of the license, visit https://creativecommons.org/licenses/by-nc-sa/3.0/us/legalcode
-->

<?php
include('meta.php');
?>
<html>
	<head>
		<title>Email</title>
		<link rel="stylesheet" type="text/css" href="css/cxa-ui.css">
	</head>
	<body>
		<form action="action_page.php" id="main" style="min-height: 400px;">
			<div id="topbar" class="loginbar noselect"><?php cxa_header("Whatever") ?></div>
			<div class="welcomebar">
			Thank you email<br/>
			</div>
			<br/><br><br>
			<textarea style="height:300px;width:270px;font-size:12pt;"></textarea>
			<br><br>
			<div id="bottombar" class="loginbar noselect" onclick="document.getElementById('main').submit(); return false;">Submit&nbsp;&nbsp;</div>
			<div id="footer" class="loginbar"><?php cxa_footer() ?></div>
		</form>
	</body>
</html>