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
	$column  = $_REQUEST['id'] ;
	$value   = $_REQUEST['value'] ;
	
	if ($column=='max_per_trade' || 
		$column=='bull_entry_tenkan' ||
		$column=='bull_entry_kijun' ||
		$column=='bull_entry_buffer' ||
		$column=='bear_entry_tenkan' ||
		$column=='bear_entry_kijun' ||
		$column=='bear_entry_buffer'		||
		$column=='exit_buffer' ||
		$column=='profit_buffer' ||
		$column=='invest_limit' ||
		$column=='profit_exit_alert') 
		{
			$perc = ($value / 100);
			$update = array("$column" => "$perc");
			$user->update($update);
		}
		else
		{
			$update = array("$column" => "$value");
			$user->update($update);
		}
		
echo $value;
	}
else
{
echo 'You need to be logged in to the system';
}



?>