<?php
include('cxa/php/session.php');
include('cxa/meta.php');
boot_user(2);
include('donorinter.php');

$donorAdded = false;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(	   !empty($_POST["firstname"])
		&& !empty($_POST["lastname"])
		&& !empty($_POST["email"])
		&& !empty($_POST["address"])
		&& !empty($_POST["city"])
		&& !empty($_POST["state"])
		&& !empty($_POST["zipcode"])
		&& !empty($_POST["phone"])){
		//record the donor
		$donorAdded = true;
	}
}
?>
<html>
	<head>
		<title>Add New Donor - MCDM DonorTrack</title>
		<link rel="stylesheet" type="text/css" href="cxa/css/cxa-ui.css">
		<link rel="icon" type="image/png" href="cxa/img/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			.ilabel.ilabel {
				margin: 0px;
			}
		</style>
	</head>
	<body>
		<div id="main" style="min-height: 200px;">
			<div id="topbar" class="loginbar noselect">
				<?php cxa_header() ?>
			</div>
			<div class="welcomebar">
				Add Donor <?php if($donorAdded) echo "Success"; ?><br/>
			</div>
			<?php 
				if($donorAdded){
					echo '<div id="results" style="width: 100%; border-bottom: 1px solid #aaa; overflow-y: hidden; height: auto;">';
					echo '<div class="resitem nohover"></div>';
					echo '<div class="resitem nohover">';
					echo '<p class="resleft">'.$_POST["firstname"].' '.$_POST["lastname"].'</p>';
					echo '<p class="resright">'.$_POST["email"].'</p>';
					echo '</div>';
					echo '<div class="resitem nohover">Donor added. (not actually)</div>';
					echo '</div>';
			?>
				<div id="login" style="height: auto; padding: 10px 15px; width: 270px; margin-bottom: 15px; margin-top: 5px;">
					<div class="loginbutton" style="width: 260px;" onclick="window.location.assign('/index.php')">
						Back to Menu
					</div>
					<span class="logincenter">- or -</span>
					<div class="loginbutton" style="width: 260px;" onclick="window.location.assign('./takedonation.php?donorid=<?php echo nextDonorID() ?>')">
						Accept Donation from this Donor
					</div>
				</div>
			<?php
				}else{
			?>
				<form action="adddonor.php" method="post" id="login" style="height: auto; padding: 10px 15px; width: 270px; margin-bottom: 40px;">
					<p class="ilabel">First Name</p>
					<p class="ilabel fright">Last Name</p>
					<input type="text" name="firstname" class="registertext" style="width: 49%; margin-right: 1%" /><!--
				--><input type="text" name="lastname" class="registertext" style="width: 49%; margin-left: 1%" />
					<p class="ilabel">E-Mail Address</p>
					<input type="text" name="email" class="registertext" style="width: 100%;" />
					<p class="ilabel">Street Address</p>
					<input type="text" name="address" class="registertext" style="width: 100%;" />
					<p class="ilabel">City</p>
					<input type="text" name="city" class="registertext" style="width: 100%;" />
					<p class="ilabel">State</p>
					<p class="ilabel fright">ZIP Code</p>
					<select name="state" class="registertext" style="width: 49%; margin-right: 1%;">
						<option>AK</option><option>AZ</option>
					</select><!--
				 --><input type="number" name="zipcode" class="registertext" style="width: 49%; margin-left: 1%" />
					<p class="ilabel">Phone Number</p>
					<input type="number" name="phone" class="registertext" style="width: 100%;" />
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