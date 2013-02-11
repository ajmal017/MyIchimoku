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


$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
include("../webconfig.php");

if($user->signed){
$lang = $user->data['language'];
$type = $_REQUEST["type"];
include("../language/".$lang.".php"); 
include("../templates/popupheader.html");

	if ($type=='portfolio')  {$title=$lang['CHARTPOPUP_TITLE_PORT'];}
	if ($type=='favorites')  {$title=$lang['CHARTPOPUP_TITLE_FAVO'];}
	if ($type=='screening')  {$title=$lang['CHARTPOPUP_TITLE_SCREEN'];}
	if ($type=='cloudbreak') {$title=$lang['CHARTPOPUP_TITLE_CLOUDBREAK'];}
	if ($type=='buysignals') {$title=$lang['CHARTPOPUP_TITLE_BUYSIGNALS'];}

// Get the latest database update timestamp
	$query = mysql_query ("SELECT * FROM myichi_tracker_report WHERE script LIKE 'Intraday%' ORDER BY ID DESC LIMIT 1 ");
	$latest = mysql_fetch_row($query);
	
echo '<body>';
echo '<div class="title">' .$title. '</div>';
echo '<div class="portfolio">' .$lang['PORTFOLIO_LATEST_DATE'] . $latest[2] . ' ' . $lang['PORTFOLIO_LATEST_TIME'] . $latest[4] .'</div>';

include("../ps/charts_table.php");

include("../templates/footer.html");


}
else
{
$lang = 'EN';
include("../language/".$lang.".php");
include("../templates/header.html");
include("../templates/menu.html");
echo '<br><br><br><center>'.$lang['ERROR_LOGGED_OUT'].'</center><br><br><br>';
include("../templates/footer.html");
}

?>




