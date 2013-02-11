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
	$lang = $user->data['language'];
	$destination='popup';
	include("../language/".$lang.".php");
	include ("prepareMyIchiData.php");
	?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="../css/stylesheet.css" type="text/css">
	<script type="text/javascript" src="js/jquery/jquery-1.7.2.min.js"></script>
	<?php
	include ("../templates/highstockheader.html");
	?>
	</head>
	<body>
	<table border="0" cellpadding="0" cellspacing="0">
	<tr><td>
	<form method="post" action="<?php echo $root_url; ?>/index.php?page=searchresult" target="_parent">
	<input type="hidden" name="yahoo_symbol" value="<?php echo $symbol; ?>">
	<input type="hidden" name="chartsize" value="<?php echo $user->data['page_chartsize']; ?>">
	<input title="<?php echo $lang['CHARTPOPUP_DETAILS']; ?>" src="../images/search_small.png" type="image">
	</form>

	</td></tr>
	<tr><td>
	<script src="http://www.myichimoku.eu/charts/js/highstock.js"></script>
	<script src="http://www.myichimoku.eu/charts/js/highcharts-more.js"></script>
	<div id="container"></div>
	<button class="button" id="toggle-ichimokuSignal"><?php echo $lang['SEARCHRESULTS_CHART_BUTTON']; ?></button>
	</td></tr>
	</table>
	</body>
	
<?php	

$javacomment[] = "  $('#details').hide();
			 $('#details').click(function() {
			 $('#details').toggle();
			 }); ";
			 
	}
else
{
echo 'You need to be logged in to the system';
}



?>
