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


function collectHistoryEURO($symbol)
{
// This function collects the historical data for the EURO market, creates the senkou records and updates the tracker_report.
// It has the following parameters: $startdate, $enddate and $symbol

$start = date('H:i:s', time());


$today = date("Y-m-d");	

// Check if this is the first time this script runs today, if so; reset the counter.
	$query = mysql_query("SELECT rundate, counter FROM myichi_tracker WHERE script='Historical_USA'");
		if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
	$updatecounter = mysql_fetch_assoc($query);
	//echo $updatecounter[rundate];
		if ($updatecounter[rundate] == $today) {
			echo "this is not the first time that the script runs today";
			}
		else
			{
			echo "This is the first time today the script runs";
			$counter = 0;
			$updatecounter[counter] = 0;
			mysql_query("UPDATE myichi_tracker SET counter='$counter' WHERE script='Historical_USA'");
			}
			
$symbolperiod = 1;

// Collect the data from the sourca table
	$query = mysql_query("SELECT * FROM myichi_historical_temp WHERE yahoo_symbol = '$symbol' ORDER BY date");
		if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }

		while ($row = mysql_fetch_assoc($query)) {
				
				$ID      = $row['ID'];
				$symbol  = $row['yahoo_symbol'];
				$Date    = $row['date'];
				$Open    = $row['open'];
				$High    = $row['high'];
				$Low     = $row['low'];
				$Close   = $row['close'];
				$Volume  = $row['volume'];
				$updated = date('Y-m-d G:i:s');
				// Update the database	
				mysql_query("INSERT INTO myichi_historical_data_euro (yahoo_symbol, symbol_period, timeframe, date, updated, open, high, low, close, volume) VALUES ('$symbol', '$symbolperiod', 'EOD', '$Date', '$updated', '$Open', '$High', '$Low', '$Close', '$Volume')");
				$symbolperiod++;
				$addedRecordsCounter++;    

				}

			
				// Now we create the records for senkou
				$query = mysql_query("SELECT MAX(symbol_period) AS max FROM myichi_historical_data_euro WHERE yahoo_symbol='$symbol' AND open<>'NULL' ");
					if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }
				$row = mysql_fetch_assoc($query);
				$symbolperiod = ($row["max"]);
					$senkoudays=1;
					$weekday=1;
					for ($i=1; $i < 27; $i++) {
						
						$symbolperiod++;
						$date = date("Y-m-d", strtotime("+".$senkoudays." days"));
						mysql_query("INSERT INTO myichi_historical_data_euro (yahoo_symbol, symbol_period, date, updated) VALUES ('$symbol', '$symbolperiod', '$date', '$updated')");
						$addedRecordsCounter++;
						$weekday++;
						if ($weekday==6) {$senkoudays=$senkoudays+2; $weekday=1;} else {$senkoudays++;}
					}
			
		

$info = "Added: " . $symbol. " to historical_data_euro";
$counter = $updatecounter[counter]+1;
$end = date('H:i:s', time());
			
mysql_query("UPDATE myichi_tracker SET rundate='$today', counter='$counter' WHERE script='Historical_USA' ");
mysql_query("INSERT INTO myichi_tracker_report (script, date, start, end, yqlqty, records, info) VALUES ('Historical_EURO', '$today', '$start', '$end', '$yqlqty', '$addedRecordsCounter', '$info')");

}
?>