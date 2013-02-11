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


function collectHistoryUSA($symbol)
{
// This function collects the historical data for the US market, creates the senkou records and updates the tracker_report.
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
	$query = mysql_query("SELECT * FROM us_historical WHERE symbol = '$symbol' ORDER BY date");
		if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }

		while ($row = mysql_fetch_assoc($query)) {
				
				$ID      = $row['ID'];
				$symbol  = $row['symbol'];
				$Date    = $row['date'];
				$Open    = $row['open'];
				$High    = $row['high'];
				$Low     = $row['low'];
				$Close   = $row['close'];
				$Volume  = $row['volume'];
				$updated = date('Y-m-d G:i:s');
				// Update the database	
				mysql_query("INSERT INTO myichi_historical_data_usa (yahoo_symbol, symbol_period, timeframe, date, updated, open, high, low, close, volume) VALUES ('$symbol', '$symbolperiod', 'EOD', '$Date', '$updated', '$Open', '$High', '$Low', '$Close', '$Volume')");
				$symbolperiod++;
				$addedRecordsCounter++;    

				}

/*		
// The YahooApplication class is used for two-legged authorization, which doesn't need permission from the end user.
$two_legged_app = new YahooApplication(API_KEY,SHARED_SECRET);
	if ($two_legged_app == NULL) { print ("<br />"); print ("Error: Cannot get two_legged_app (YahooApplication object)."); exit;}

// Build YQL query 
	//$yql_query = "select * from yahoo.finance.historicaldata where symbol='$symbol' and startDate='$startdate' and endDate='$enddate' | sort(field='date')";
	$yql_query = 'select * from yahoo.finance.historicaldata where symbol = "'.$symbol.'" and startDate = "'.$startdate.'" and endDate = "'.$enddate.'"';	
	$yql_response = $two_legged_app->query($yql_query);
	$yqlqty++;
	// Show QYL query in the browser
	//$yql_query_url = $BASE_URL . "?q=" . rawurlencode($yql_query) . "&env=store://datatables.org/alltableswithkeys&format=json"; 
	$datatables = '://datatables.org/alltableswithkeys';
	$yql_query_url = $BASE_URL . '?q=' . rawurlencode($yql_query).'&env=store'.rawurlencode($datatables).'&format=json'; 
	echo "<br>" . $yql_query_url;
	
	// http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%3D%27alt.pa%27%20and%20startDate%3D%272011-01-01%27%20and%20endDate%3D%272012-08-21%27&env=store://datatables.org/alltableswithkeys&format=json
	// http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22ALT.PA%22%20and%20startDate%20%3D%20%222009-09-11%22%20and%20endDate%20%3D%20%222010-03-10%22&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&format=json
	// http://query.yahooapis.com/v1/public/yql?q=select%20%2A%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22alt.pa%22%20and%20startDate%20%3D%20%222011-01-01%22%20and%20endDate%20%3D%20%222012-08-21%22&env=store://datatables.org/alltableswithkeys&format=jsonhttp://query.yahooapis.com/v1/public/yql?q=select%20%2A%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22alt.pa%22%20and%20startDate%20%3D%20%222011-01-01%22%20and%20endDate%20%3D%20%222012-08-21%22%26env%3Dstore%3A%2F%2Fdatatables.org%2Falltableswithkeys%26format%3Djson
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
*/			
				// Now we create the records for senkou
				$query = mysql_query("SELECT MAX(symbol_period) AS max FROM myichi_historical_data_usa WHERE yahoo_symbol='$symbol' AND open<>'NULL' ");
					if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }
				$row = mysql_fetch_assoc($query);
				$symbolperiod = ($row["max"]);
				
					for ($i=1; $i < 27; $i++) {
						$symbolperiod++;
						$date = date("Y-m-d", strtotime("+".$i." days"));
						mysql_query("INSERT INTO myichi_historical_data_usa (yahoo_symbol, symbol_period, date, updated) VALUES ('$symbol', '$symbolperiod', '$date', '$updated')");
						$addedRecordsCounter++;
			}
			
		

$info = "Added: " . $symbol. " to historical_data_usa";
$counter = $updatecounter[counter]+1;
$end = date('H:i:s', time());
			
mysql_query("UPDATE myichi_tracker SET rundate='$today', counter='$counter' WHERE script='Historical_USA' ");
mysql_query("INSERT INTO myichi_tracker_report (script, date, start, end, yqlqty, records, info) VALUES ('Historical_USA', '$today', '$start', '$end', '$yqlqty', '$addedRecordsCounter', '$info')");

}
?>