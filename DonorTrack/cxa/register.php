<!--
register.php - New user registration page for the CXA Auth LW web data framework.
Copyright (c) 2016 James Rowley

This file is part of CXA Auth LW, which is licensed under the Creative Commons Attribution-NonCommercial-ShareAlike 3.0 United States License.
You should have received a copy of this license with CXA Auth LW.
If not, to view a copy of the license, visit https://creativecommons.org/licenses/by-nc-sa/3.0/us/legalcode
-->

<?php
include('php/guestsession.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if( !empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password_conf"]) && !empty($_POST["name"]) ){
		if($_POST["password"]==$_POST["password_conf"]){
			if(strlen($_POST["password"])>7){
				$uname=$conn->escape_string($_POST['username']);
				$passwd=password_hash($conn->escape_string($_POST['password']),PASSWORD_BCRYPT);
				$name=$conn->escape_string($_POST['name']);
				$email=$conn->escape_string($_POST['email']);
				$sql = "INSERT INTO user_limbo (username, password, email, name) VALUES (\"$uname\", \"$passwd\", \"$email\", \"$name\")";
				if($conn->query($sql)){
					include('php/reg-ok.php');
				}else{
					$registererror="Database error!";
					include('php/reg.php');
				}
			}else{
				$registererror="Password must be 8 or more characters long.";
				include('php/reg.php');
			}
		}else{
			$registererror="Passwords must match.";
			include('php/reg.php');
		}
	}else{
		$registererror="All fields are required.";
		include('php/reg.php');
	}
}else{
	include('php/reg.php');
}
?>