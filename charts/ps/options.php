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


include("../webconfig.php");

if($user->signed){
$uid    = $user->data['user_id'];

$language     = $_REQUEST["language"];
$tax          = $_REQUEST["taxreserve"];
$fiscal       = $_REQUEST["fiscal_month"];
$tradesignals = $_REQUEST["daily_trade_signals"];
$mail_f       = $_REQUEST["mail_frequency"];
$mail_s       = $_REQUEST["mail_subject"];
$mail_c       = $_REQUEST["mail_content"];

$update = array (	"language" => "$language",
					"taxreserve" => "$tax",
					"fiscal_month" => "$fiscal",
					"daily_trade_signals" => "$tradesignals",
					"mail_frequency" => "$mail_f",
					"mail_subject" => "$mail_s",
					"mail_content" => "$mail_c");

$user->update($update);
redirect();
	}
else
{
echo 'You need to be logged in to the system';
}



?>