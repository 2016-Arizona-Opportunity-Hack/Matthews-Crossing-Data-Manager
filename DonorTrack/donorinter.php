<?php

function refreshDonorList(){
	$newDonorList = Array();
	//get the donor list - mockup below
	$newDonorList[1] = Array();
	$newDonorList[1]["firstname"] = "John";
	$newDonorList[1]["lastname"] = "Smith";
	$newDonorList[1]["email"] = "js193048@gmail.com";
	$newDonorList[2] = Array();
	$newDonorList[2]["firstname"] = "Jane";
	$newDonorList[2]["lastname"] = "Doe";
	$newDonorList[2]["email"] = "jd938742@gmail.com";
	$_SESSION["donorlist"] = $newDonorList;	
}

function nextDonorID(){
	//get the next autoincrement id - placeholder
	return 3;
}

refreshDonorList();

if(empty($_SESSION["donorlist"])){
	refreshDonorList();
}
?>