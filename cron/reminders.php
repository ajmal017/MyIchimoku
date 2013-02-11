<?php##########################################################################################################################                                                                                                                       ##   Copyright (c) 2012 by Oscar Buijten; http://myichimoku.eu  and  http://oscar.buijten.fr                             ##                                                                                                                       ##   This work is made available under the terms of the Creative Commons Attribution-NonCommercial 3.0 Unported,         ##                                                                                                                       ##   http://creativecommons.org/licenses/by-nc/3.0/legalcode                                                             ##                                                                                                                       ##   This work is WITHOUT ANY WARRANTY; without even the implied warranty of FITNESS FOR A PARTICULAR PURPOSE.           ##                                                                                                                       ##########################################################################################################################
// Daily email reminders
$start = date('H:i:s', time());
include("/homez.31/domainese/myichimoku/charts/config.php");
$today = date("Y-m-d"); 
$weekday = date("l");
if(date("d")==01) {$monthly='Monthly';}

for($cycle=0; $cycle < 3; $cycle++) {
	if ($cycle==0) {$frequency='Daily';}
	if ($cycle==1) {$frequency=$weekday;}
	if ($cycle==2) {$frequency=$monthly;}
	
	$query = mysql_query("SELECT user_id FROM myichi_users WHERE mail_frequency = '$frequency' AND activated = '1'");
		if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
		
	while ($row = mysql_fetch_assoc($query)) {
		$uID = ($row['user_id']);
		wakeUpEmail($uID,$fromEmail,$root_url,$copyright);
	}
}			
$end = date('H:i:s', time());
mysql_query("UPDATE myichi_tracker SET rundate='$today' WHERE script='Wake-upEmail' ");

?>