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


$fpc   = $_REQUEST["frontpagecolumns"];
$fpcw  = $_REQUEST["frontpagechartwidth"];
$popc  = $_REQUEST["popupcolumns"];
$popcw = $_REQUEST["popupchartwidth"];
$pcw   = $_REQUEST["pageschartwidth"];
$pc    = $_REQUEST["portfolio_charts"];
$rs    = $_REQUEST["rangeselect_charts"];

//	$update = array("$column" => "$value");
//	$user->update($update);

$update = array (	"frontpage_colums" => "$fpc",
					"frontpage_chartsize" => "$fpcw",
					"popup_columns" => "$popc",
					"popup_chartsize" => "$popcw",
					"page_chartsize" => "$pcw",
					"portfolio_charts" => "$pc",
					"rangeselect_charts" => "$rs");

$user->update($update);
					
redirect();

	}
else
{
echo 'You need to be logged in to the system';
}



?>