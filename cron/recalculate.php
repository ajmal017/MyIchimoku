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


$start = date('H:i:s', time());
include_once("/homez.31/domainese/myichimoku/charts/config.php"); 

// ------------------------------ Settings  ------------------------------------

$CurrentSymbol= 'LG.PA';

// -----------------------------------------------------------------------------
$intraday = date("Y-m-d");
$symbol_period_increment = 0;
$currentSymbolPeriod = 1;

// Connect to database
$conn = mysql_connect($db_host, $db_user, $db_password) or die ('Error connecting to mysql');
mysql_select_db($db_name);

$instrumentquery = mysql_query("SELECT ID, yahoo_symbol FROM myichi_instrument_names WHERE ID= 650 ORDER BY ID ASC");	if (!$instrumentquery) { echo 'Impossible d\'exécuter la requête Z: ' .$instrumentquery. mysql_error(); exit; }
	while ($instrumentrow = mysql_fetch_assoc($instrumentquery)) {
		$CurrentSymbol = $instrumentrow['yahoo_symbol'];
		$ID            = $instrumentrow['ID'];
		echo "Yahoo_symbol: ".$CurrentSymbol.". ";
			$startSymbol = date('H:i:s', time());
			$query = mysql_query ("
							SELECT symbol_period
							FROM myichi_historical_data
							WHERE yahoo_symbol =  '$CurrentSymbol'
							AND OPEN <>0
							ORDER BY symbol_period ASC ");
				while ($row = mysql_fetch_assoc($query)) {
				$currentSymbolPeriod = $row['symbol_period'];
				calculateIchimokuIndicators($CurrentSymbol,$currentSymbolPeriod,$symbol_period_increment);
				}
				$info = $CurrentSymbol." recalculated. Row ID: ".$ID;
				$endSymbol = date('H:i:s', time());
				mysql_query("INSERT INTO myichi_tracker_report (script, date, start, end, info) VALUES ('MyIchimoku_Signals', '$intraday', '$startSymbol', '$endSymbol', '$info')");
				echo $info."\n";
}
echo "Done!\n";
$end = date('H:i:s', time());
echo "Started at: ".$start." and ended at: ".$end;

?>