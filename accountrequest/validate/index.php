<?php
#########################################################################################################################
#                                                                                                                       #
#   Copyright (c) 2012 by Oscar Buijten; http://myichimoku.eu  and  http://oscar.buijten.fr                             #
#                                                                                                                       #
#   This work is made available under the terms of the Creative Commons Attribution-NonCommercial 3.0 Unported,         #
#                                                                                                                       #
#   http://creativecommons.org/licenses/by-nc/3.0/legalcode                                                             #
#                                                                                                                       #
#   This work is WITHOUT ANY WARRANTY; without even the implied warranty of FITNESS FOR A PARTICULAR PURPOSE.           #
#                                                                                                                       #
#########################################################################################################################

include("../../charts/webconfig.php");

//Create uFlex instance
$user = new uflex();

//According the example URL
$hash = $_GET['aid'];

//Will return true on successfull activation
$activated = $user->activate($hash);

$Lang = $_GET['lang'];
include("../../charts/language/".$Lang.".php");

if($activated){
	//Account has been activated
	//Notify the user
	echo "Account activated<br>";
	$Username  = $user->data['username'];
	$Email     = $user->data['email'];
	$Firstname = $user->data['firstname'];
	if (!$Firstname) {$Name = $UserName;} else {$Name = $Firstname;}

	$headers = 'From: ' . $fromEmail .'' . "\r\n" .
     'Reply-To: no-reply@MyIchimoku.eu' . "\r\n" .
	 'MIME-Version: 1.0' . "\r\n" .
	 'Content-type: text/html; charset=utf-8' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
	$subject = $lang['ACCOUNT_ACTIVATED_SUBJECT'];
	$message = "
					<link rel='stylesheet' href='http://myichimoku.eu/charts/css/stylesheet.css' type='text/css'>
					<table width='100%'>
					<tbody>
					<tr><td>".
					$lang['ACCOUNT_ACTIVATED_HI'].$Name.", <br><br>".
					$lang['ACCOUNT_ACTIVATED_MESSAGE']
					."<br>
					<br>
					</td>
					</tbody>
					</table>
					
					<table class='footer' width='100%'>
					<tbody><tr>
					<td width='300' align='left'><img src='http://MyIchimoku.eu/charts/images/logo.png' border='0'></td>
					<td></td>
					<td width='300'><p align=right>&copy; Copyright 2012 - MyIchimoku.eu </p></td>
					</tr></tbody>
					</table>
					";
	mail($Email, $subject, $message, $headers);

	echo "An Email was sent to: ".$Username;
		
}else{
	//There was an error during activation
	echo "<pre>";
	print_r($user->error());
	echo "</pre>";
}
?>