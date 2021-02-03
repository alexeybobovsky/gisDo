<?php

if(($_SERVER['SERVER_NAME'] == 'localhost'))
{
	$SQLhost = "localhost";
	$SQLdb = "gis";
	$SQLus = "gis";
	$SQLpw = "rthjcby";
}
else
{
	$SQLhost = "db40.valuehost.ru";
	$SQLdb = "alexeybobo_gis";
	$SQLus = "alexeybobo_gis";
	$SQLpw = "gis2503";
}
$tplDir = 'gis/';
$siteName = 'www.GISdo.ru';
$messBody = '';
setlocale (LC_TIME, "");
Error_Reporting(E_ALL & ~E_NOTICE);
?>
