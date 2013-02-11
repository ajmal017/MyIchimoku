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
	$type   = $_GET["type"];
	$symbol = $_GET["yahoo_symbol"];
	$price  = $_GET["added_price"];
	$action = $_GET["action"];
	$uid    = $user->data['user_id'];
	$today  = date("Y-m-d");
	
		if (($type <> 'favorites') && ($type <> 'portfolio')) { echo 'Hacking??'; }
			else {
				if ($action == 'add') {
				mysql_query("INSERT INTO myichi_portfolio (user_id, symbol, type, date_added, price_at_date_added) VALUES ('$uid', '$symbol', '$type', '$today', '$price')");
				}
				if (($action == 'remove') && ($type == 'favorites'))
				{
				mysql_query("DELETE FROM myichi_portfolio WHERE user_id='$uid' AND symbol='$symbol' AND type='favorites' ");
				}
			}
}	
else
{
echo 'Forgot to login?';
}

redirect($root_url.'/?page=portfolio');
	
?>