<?php
/*
userinter.php - User management database interface for the CXA Auth LW web data framework.
Copyright (c) 2016 James Rowley

This file is part of CXA Auth LW, which is licensed under the Creative Commons Attribution-NonCommercial-ShareAlike 3.0 United States License.
You should have received a copy of this license with CXA Auth LW.
If not, to view a copy of the license, visit https://creativecommons.org/licenses/by-nc-sa/3.0/us/legalcode
*/
include("php/session.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(!empty($_SESSION['userid']) && !empty($_POST["action"])){
		switch($_POST["action"]){
			case "approveuser":
				if(authorized(4)){
					$luid=$conn->escape_string($_POST["data"]['userid']);
					$authlevel=$conn->escape_string($_POST["data"]['authlevel']);
					$qry="SELECT * FROM user_limbo WHERE userid=\"$luid\" LIMIT 1";
					$result=$conn->query($qry);
					if($result && $result->num_rows==1){
						$newuser=$result->fetch_assoc();
						$qry='INSERT INTO users (username,password,name,email,authorization,otpsecret) VALUES ("'.$newuser["username"].'", "'.$newuser["password"].'", "'.$newuser["name"].'", "'.$newuser["email"].'", "'.$authlevel.'", "'.$newuser["otpsecret"].'")';
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
				break;
			case "dellimbouser":
				if(authorized(4)){
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
			case "getlimbousers":
				if(authorized(4)){
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