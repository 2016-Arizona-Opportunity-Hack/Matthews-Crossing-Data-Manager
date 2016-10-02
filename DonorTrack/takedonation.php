<?php
include('cxa/php/session.php');
include('cxa/meta.php');
boot_user(2);
include('donorinter.php');

if(	   !empty($_POST["donorid"])
	&& !empty($_POST["type"])
	&& !empty($_POST["source"])
	&& !empty($_POST["weight"])){
	//record the donation
	$recorded = true;
}elseif(!empty($_GET["donorid"]) && array_key_exists($_GET["donorid"], $_SESSION["donorlist"])){
	$recorded = false;	
}else{
	error_log("Invalid or missing Donor ID!");
	header("Location: /index.php");
}
?>
<html>
	<head>
		<title>Record Donation - MCDM DonorTrack</title>
		<link rel="stylesheet" type="text/css" href="cxa/css/cxa-ui.css">
		<link rel="icon" type="image/png" href="cxa/img/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div id="main" style="min-height: 200px;">
			<div id="topbar" class="loginbar noselect">
				<?php cxa_header() ?>
			</div>
			<div class="welcomebar">
				Record Donation <?php if($recorded) echo "Success"; ?><br/>
			</div>
			<?php 
				if($recorded){
					echo '<div id="results" style="width: 100%; border-bottom: 1px solid #aaa; overflow-y: hidden; height: auto;">';
					echo '<div class="resitem nohover"></div>';
					echo '<div class="resitem nohover">';
					echo '<p class="resleft">'.$_SESSION["donorlist"][$_POST["donorid"]]["firstname"].' '.$_SESSION["donorlist"][$_POST["donorid"]]["lastname"].'</p>';
					echo '<p class="resright">'.$_SESSION["donorlist"][$_POST["donorid"]]["email"].'</p>';
					echo '<p class="resleft">'.$_POST["type"].'</p>';
					echo '<p class="resleft">'.$_POST["source"].'</p>';
					echo '<p class="resright">'.$_POST["weight"].' lbs</p>';
					echo '</div>';
					echo '<div class="resitem nohover">Donation recorded. (not actually)</div>';
					echo '</div>';
			?>
				<div id="login" style="height: auto; padding: 10px 15px; width: 270px; margin-bottom: 15px; margin-top: 5px;">
					<div class="loginbutton" style="width: 260px;" onclick="window.location.assign('/index.php')">
						Back to Menu
					</div>
					<span class="logincenter">- or -</span>
					<div class="loginbutton" style="width: 260px;" onclick="window.location.assign('./takedonation.php?donorid=<?php echo $_POST["donorid"] ?>')">
						Accept Donation from this Donor
					</div>
				</div>
			<?php
				}else{
					echo '<div id="results" style="width: 100%; border-bottom: 1px solid #aaa; overflow-y: hidden; height: auto;">';
					echo '<div class="resitem nohover"></div>';
					echo '<div class="resitem nohover">';
					echo '<p class="resleft">'.$_SESSION["donorlist"][$_GET["donorid"]]["firstname"].' '.$_SESSION["donorlist"][$_GET["donorid"]]["lastname"].'</p>';
					echo '<p class="resright">'.$_SESSION["donorlist"][$_GET["donorid"]]["email"].'</p>';
					echo '</div>';
					echo '</div>';
			?>
				<form action="takedonation.php" method="post" id="login" style="height: auto; padding: 10px 15px; width: 270px; margin-bottom: 10px;">
					<input type="hidden" name="donorid" value="<?php echo $_GET["donorid"] ?>" />
					<p class="ilabel">Donation Type</p>
					<input type="text" name="type" class="registertext" style="width: 100%;" />
					<p class="ilabel">Donation Source</p>
					<input type="text" name="source" class="registertext" style="width: 100%;" />
					<p class="ilabel">Donation weight</p>
					<input type="number" name="weight" class="registertext" style="width: 100%;" />
					<input type="submit" style="position: absolute; height: 0px; width: 0px; border: none; padding: 0px;" hidefocus="true" tabindex="-1">
				</form>
				<div id="bottombar" class="loginbar noselect" onclick="document.getElementById('login').submit(); return false;">Submit&nbsp;&nbsp;</div>
			<?php
				}
			?>
			<div id="footer" class="loginbar"><?php cxa_footer() ?></div>
		</div>
	</body>
</html>
<?php
$conn->close();
?>