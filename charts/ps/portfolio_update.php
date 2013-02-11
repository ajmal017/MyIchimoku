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
	$uid     = $user->data['user_id'];

	$string  = $_REQUEST['id'] ;
	$value   = $_REQUEST['value'] ;
	$columns = explode("|", $string);
	$id      = $columns[0];
	$column  = $columns[1];

	mysql_query("UPDATE myichi_portfolio SET $column='$value' WHERE ID='$id' ");
if (($value == 'portfolio') || ($value == 'history')) { redirect();} else { echo $value;}
	}
else
{
echo 'You need to be logged in to the system';
}



?>