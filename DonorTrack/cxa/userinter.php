<?php
/*
userinter.php - User management database interface for the CXA Auth LW web data framework.
Copyright (c) 2016 James Rowley

This file is part of CXA Auth LW, which is licensed under the Creative Commons Attribution-NonCommercial-ShareAlike 3.0 United States License.
You should have received a copy of this license with CXA Auth LW.
If not, to view a copy of the license, visit https://creativecommons.org/licenses/by-nc-sa/3.0/us/legalcode
*/
include("php/session.php");

function generateResetLink($authenticator){
	return (!empty($_SERVER['HTTPS']) ? 'https' : 'http')."://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/reset.php?token=".strtr(base64_encode($authenticator), '+/=', '-_,');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(!empty($_SESSION['userid']) && !empty($_POST["action"])){
		switch($_POST["action"]){
			case "approveuser":
				if(authorized(3)){
					$authlevel=$conn->escape_string($_POST["data"]['authlevel']);
					if($authlevel <= $_SESSION["userdata"]["authorization"]){
						$luid=$conn->escape_string($_POST["data"]['userid']);
						$qry="SELECT * FROM user_limbo WHERE userid=\"$luid\" LIMIT 1";
						$result=$conn->query($qry);
						if($result && $result->num_rows==1){
							$newuser=$result->fetch_assoc();
							$qry='INSERT INTO users (username,password,name,email,authorization,otpsecret) VALUES ("'.$conn->escape_string($newuser["username"]).'", "'.$conn->escape_string($newuser["password"]).'", "'.$conn->escape_string($newuser["name"]).'", "'.$conn->escape_string($newuser["email"]).'", "'.$authlevel.'", "'.$conn->escape_string($newuser["otpsecret"]).'")';
							if($conn->query($qry)){
								$qry='DELETE FROM user_limbo WHERE userid="'.$newuser["userid"].'" LIMIT 1';
								if($conn->query($qry)){
									echo "ok";
								}else{
									echo "dbe";
								error_log($conn->error);
								}
							}else{
								echo "dbe";
								error_log($conn->error);
							}
						}else{
							echo "dbe";
							error_log($conn->error);
						}
					}else{
						echo "unauthorized";
					}
				}else{
					echo "unauthorized";
				}
				break;
			case "dellimbouser":
				if(authorized(3)){
					$qry='DELETE FROM user_limbo WHERE userid="'.$conn->escape_string($_POST['data']['userid']).'" LIMIT 1';
					if($conn->query($qry)){
						echo "ok";
					}else{
						echo "dbe";
						error_log($conn->error);
					}
				}else{
					echo "unauthorized";
				}
				break;
			case "setuser":
				if(authorized(4) && $_POST['data']['userid']!=777){
					if(!empty($_POST["data"]["password"])){
						$qry='UPDATE users SET username="'.$conn->escape_string($_POST['data']['username']).
							'", name="'.$conn->escape_string($_POST['data']['name']).
							'", email="'.$conn->escape_string($_POST['data']['email']).
							'", password="'.password_hash($conn->escape_string($_POST['data']['password']),PASSWORD_BCRYPT).
							'", otpsecret="'.$conn->escape_string($_POST['data']['otpsecret']).
							'", authorization="'.$conn->escape_string($_POST['data']['authorization']).
							'" WHERE userid="'.$conn->escape_string($_POST['data']['userid']).'"';
					}else{
						$qry='UPDATE users SET username="'.$conn->escape_string($_POST['data']['username']).
							'", name="'.$conn->escape_string($_POST['data']['name']).
							'", email="'.$conn->escape_string($_POST['data']['email']).
							'", otpsecret="'.$conn->escape_string($_POST['data']['otpsecret']).
							'", authorization="'.$conn->escape_string($_POST['data']['authorization']).
							'" WHERE userid="'.$conn->escape_string($_POST['data']['userid']).'"';
					}
					if($conn->query($qry)){
						echo "ok";
					}else{
						echo "dbe";
						error_log($conn->error);
					}
				}else{
					echo "unauthorized";
				}
				break;
			case "deluser":
				if(authorized(4)){
					$qry='DELETE FROM users WHERE userid="'.$conn->escape_string($_POST['data']['userid']).'" LIMIT 1';
					if($conn->query($qry)){
						echo "ok";
					}else{
						echo "dbe";
						error_log($conn->error);
					}
				}else{
					echo "unauthorized";
				}
				break;
			case "resetuserpassword":
				if(authorized(4)){
					$authenticator = openssl_random_pseudo_bytes(33);
					$token = hash('sha256', $authenticator);
					$expires = time() + 86400;
					$userid = $conn->escape_string($_POST['data']);
					$result=$conn->query("SELECT * FROM password_reset WHERE userid=$userid");
					if($result && $result->num_rows==0){
						if($conn->query("INSERT INTO password_reset (userid, token, expires) VALUES ($userid, \"$token\", $expires)")){
							echo generateResetLink($authenticator);
						}else{
							echo "dbe";
							error_log($conn->error);
						}
					}elseif($result){
						if($conn->query("UPDATE password_reset SET token=\"$token\", expires=$expires WHERE userid=$userid LIMIT 1")){
							echo generateResetLink($authenticator);
						}else{
							echo "dbe";
							error_log($conn->error);
						}
					}else{
						echo "dbe";
						error_log($conn->error);
					}
				}else{
					echo "unauthorized";
				}
			case "getlimbousers":
				if(authorized(3)){
					$mquery="SELECT * FROM user_limbo";
					if($result=$conn->query($mquery)){
						$matches=array();
						while($row=$result->fetch_assoc()){
							unset($row['password']);
							$matches[]=$row;
						}
						$result=json_encode($matches);
						echo $result;
					}else{
						echo "dbe";
						error_log($conn->error);
					}
				}else{
					echo "unauthorized";
				}
				break;
			case "getusers":
				if(authorized(4)){
					$mquery="SELECT * FROM users";
					if($result=$conn->query($mquery)){
						$matches=array();
						while($row=$result->fetch_assoc()){
							unset($row['password']);
							if($row['userid']!=777){
								$matches[]=$row;
							}
						}
						$result=json_encode($matches);
						echo $result;
					}else{
						echo "dbe";
						error_log($conn->error);
					}
				}else{
					echo "unauthorized";
				}
				break;
			default:
				echo "Invalid Action!";
		}
	}else{
		echo "malformed request";
	}
}else{
	echo "no request";
}
?>