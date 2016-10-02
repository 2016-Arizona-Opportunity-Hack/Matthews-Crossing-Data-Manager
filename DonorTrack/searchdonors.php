<?php
include('cxa/php/session.php');
include('cxa/meta.php');
boot_user(2);

if(empty($_SESSION["donorSearch"])){
	$_SESSION["donorSearch"] = null;
}
$donorSearch = $_SESSION["donorSearch"];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if( !empty($_POST["firstname"]) || !empty($_POST["lastname"]) || !empty($_POST["email"]) ){
		//search the database
	}
}
?>
<html>
	<head>
		<title>Donor Search - MCDM DonorTrack</title>
		<link rel="stylesheet" type="text/css" href="cxa/css/cxa-ui.css">
		<link rel="icon" type="image/png" href="cxa/img/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			#results {
				height: 200px;
				overflow-y: scroll;
			}
			.resitem {
				color: black;
				padding: 4px 10px;
				background: #eee;
				cursor: pointer;
			}
			.resitem:hover {
				background: #e8e8e8;
			}
			.resitem:active {
				background: #ddd;
			}
			.resitem:nth-child(even) {
				background: #ddf;
			}
			.resitem:nth-child(even):hover {
				background: #d8d8ff;
			}
			.resitem:nth-child(even):active {
				background: #ccf;
			}
			.resitem:first-child {
				height: 0px;
				cursor: default;
				background: #eee;
			}
			.resleft, .resright {
				margin: 2px 4px;
				padding: 0px;
			}
			.resright {
				text-align: right;
			}
		</style>
	</head>
	<body>
		<div id="main" style="min-height: 200px;">
			<div id="topbar" class="loginbar noselect">
				<?php cxa_header() ?>
			</div>
			<div class="welcomebar">
				Donor Search <?php if(is_array($donorSearch)) echo "Results"; ?><br/>
			</div>
			<?php 
				if(is_array($donorSearch)){
					echo '<div id="results" style="width: 100%; border-bottom: 1px solid #aaa;">';
					echo '<div class="resitem"></div>';
					if(!empty($donorSearch)){
						foreach($donorSearch as $donorid => $donor){
							echo '<div id="'.$donorid.'" class="resitem">';
							echo '<p class="resleft">'.$donor["firstname"].' '.$donor["lastname"].'</p>';
							echo '<p class="resright">'.$donor["email"].'</p>';
							echo '</div>';
						}
					}else{
						echo '<div class="resitem">No records found. NYI</div>';
					}
					echo '</div>';
				}
			?>
			<form action="searchdonors.php" method="post" id="login" style="height: auto; padding: 10px 15px; width: 270px; margin-bottom: 10px;">
				<p class="ilabel">First Name</p>
				<p class="ilabel fright">Last Name</p>
				<input type="text" name="firstname" class="registertext" style="width: 49%; margin-right: 1%" /><!--
			 --><input type="text" name="lastname" class="registertext" style="width: 49%; margin-left: 1%" />
				<p class="ilabel">E-Mail Address</p>
				<input type="text" name="email" class="registertext" style="width: 100%;" />
				<input type="submit" style="position: absolute; height: 0px; width: 0px; border: none; padding: 0px;" hidefocus="true" tabindex="-1">
			</form>
			<div id="bottombar" class="loginbar noselect" onclick="document.getElementById('login').submit(); return false;">Search&nbsp;&nbsp;</div>
			<div id="footer" class="loginbar"><?php cxa_footer() ?></div>
		</div>
	</body>
</html>
<?php
$_SESSION["donorSearch"] = $donorSearch;
$conn->close();
?>