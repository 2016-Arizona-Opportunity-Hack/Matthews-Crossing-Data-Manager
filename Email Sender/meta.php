<!--
meta.php - Template data for CXA UI web data framework.
Copyright (c) 2016 James Rowley

This file is part of CXA UI, which is licensed under the Creative Commons Attribution-NonCommercial-ShareAlike 3.0 United States License.
You should have received a copy of this license with CXA UI.
If not, to view a copy of the license, visit https://creativecommons.org/licenses/by-nc-sa/3.0/us/legalcode
-->

<?php
function cxa_header($type=false,$url="landing.php"){
	echo '<a id="toplogo" href="'.$url.'">Email Thing</a>';
	if($type){
		echo "&nbsp;&nbsp;".$type;
	}else{
		echo "&nbsp;<i>Stuff</i>";
	}
}
function cxa_minheader($type=false,$url="landing.php"){
	echo '<a id="minlogo" href="'.$url.'"></a>';
	if($type){
		echo "<h1>$type</h1>";
	}
}
function cxa_footer(){
	echo "&nbsp;CXA UI and Live Demo &copy;2016 James Rowley - <a href=\"mailto:james@jrowley.me\">contact</a>";
}
?>