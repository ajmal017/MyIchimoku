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


function collectHistory($startdate,$enddate,$symbol)
{
// This function collects the historical data for an Instrument, creates the senkou records and updates the tracker_report.
// It has the following parameters: $startdate, $enddate and $symbol

$start = date('H:i:s', time());
include '/yourpath/charts/includes/yql_keys.php';

$today = date("Y-m-d");	
echo "starting data collection function";
// Check if this is the first time this script runs today, if so; reset the counter.
	$query = mysql_query("SELECT rundate, counter FROM myichi_tracker WHERE script='Historical'");
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
			mysql_query("UPDATE myichi_tracker SET counter='$counter' WHERE script='Historical'");
			}
			
$symbolperiod = 1;

// The YahooApplication class is used for two-legged authorization, which doesn't need permission from the end user.
$two_legged_app = new YahooApplication(API_KEY,SHARED_SECRET);
	if ($two_legged_app == NULL) { print ("<br />"); print ("Error: Cannot get two_legged_app (YahooApplication object)."); exit;}

// Build YQL query 
	$yql_query = "select * from yahoo.finance.historicaldata where symbol = $symbol and startDate = $startdate and endDate = $enddate | sort(field='date')";

	$yql_response = $two_legged_app->query($yql_query);
	$yqlqty++;
	// Show QYL query in the browser
	$datatables = '://datatables.org/alltableswithkeys';
	$yql_query_url = "http://query.yahooapis.com/v1/public/yql?q=" . urlencode($yql_query) . "&env=store://datatables.org/alltableswithkeys&format=json";

	echo "<br>" . $yql_query_url;
	
		if ($yql_response->query->count > 1) { // We must have several days of data
			for($i=0; $i < $yql_response->query->count; $i++) {
				$Date    = $yql_response->query->results->quote[$i]->Date;
				$Open    = $yql_response->query->results->quote[$i]->Open;
				$High    = $yql_response->query->results->quote[$i]->High;
				$Low     = $yql_response->query->results->quote[$i]->Low;
				$Close   = $yql_response->query->results->quote[$i]->Close;
				$Volume  = $yql_response->query->results->quote[$i]->Volume;
				$updated = date('Y-m-d G:i:s');
				// Update the database	
				mysql_query("INSERT INTO myichi_historical_temp (yahoo_symbol, symbol_period, timeframe, date, updated, open, high, low, close, volume) VALUES ('$symbol', '$symbolperiod', 'EOD', '$Date', '$updated', '$Open', '$High', '$Low', '$Close', '$Volume')");
				$symbolperiod++;
				$addedRecordsCounter++;    
			}
			
				// Now we create the records for senkou
				$query = mysql_query("SELECT MAX(symbol_period) AS max FROM myichi_historical_temp WHERE yahoo_symbol='$symbol' AND open<>'NULL' ");
					if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }
				$row = mysql_fetch_assoc($query);
				$symbolperiod = ($row["max"]);
				
					for ($i=1; $i < 27; $i++) {
						$symbolperiod++;
						$date = date("Y-m-d", strtotime("+".$i." days"));
						mysql_query("INSERT INTO myichi_historical_temp (yahoo_symbol, symbol_period, date, updated) VALUES ('$symbol', '$symbolperiod', '$date', '$updated')");
						$addedRecordsCounter++;
			}
			
		}

$info = "Added: " . $symbol . " from: " . $startdate . " to: " . $enddate;
$counter = $updatecounter[counter]+1;
$end = date('H:i:s', time());
			
mysql_query("UPDATE myichi_tracker SET rundate='$today', counter='$counter' WHERE script='Historical' ");
mysql_query("INSERT INTO myichi_tracker_report (script, date, start, end, yqlqty, records, info) VALUES ('Historical', '$today', '$start', '$end', '$yqlqty', '$addedRecordsCounter', '$info')");

}
?>