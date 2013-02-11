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
include_once($root_path . "/charts/includes/yql_keys_usa.php");

// ------------------------------ Settings  ------------------------------------

$selectidGroupSize = 100;
$selectid = 1;
//$selectid = 132;

// -----------------------------------------------------------------------------
$intraday = date("Y-m-d");


// Verify if we are in the week-end. If so, exit
if ((date("l") == 'Saturday') OR (date("l") == 'Sunday'))  {
	$end = date('H:i:s', time());
	// Sent email with results:
	if ($cronMailIntradayResults > 0) {
		$subject = 'No queries during the Weekend';
		$message = '
	 <html><body>No queries done on ' . date("l") . ' ' . $intraday .'. The script started at ' . $start . ' and ended at ' . $end
	 . '.</body></html>';
     
	 $headers = 'From: ' . $fromEmail .'' . "\r\n" .
     'Reply-To: no-reply@MyIchimoku.eu' . "\r\n" .
	 'MIME-Version: 1.0' . "\r\n" .
	 'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($adminEmail, $subject, $message, $headers);
	 }
	exit();
}



// Connect to database
$conn = mysql_connect($db_host, $db_user, $db_password) or die ('Error connecting to mysql');
mysql_select_db($db_name);



// Check if we need to add new rows to the table (for a fresh new day) or if we are only refreshing intraday data
	$query = mysql_query("SELECT rundate, counter FROM myichi_tracker WHERE script='Intraday_USA'");
		if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
	$updatecounter = mysql_fetch_assoc($query);
	//echo $updatecounter[rundate];
		if ($updatecounter[rundate] == $intraday) {
			echo "this is a USA Intraday refresh";
			$symbol_period_increment = 0;
			$queryType = "(USA Intraday refresh)";
			}
		else
			{
			echo "This is a fresh new day!";
			$symbol_period_increment = 1;
			$counter = 0;
			$updatecounter[counter] = 0;
			$queryType = "(Fresh new USA day!)";
			mysql_query("UPDATE myichi_tracker SET counter='$counter' WHERE script='Intraday_USA'");
			}

// The YahooApplication class is used for two-legged authorization, which doesn't need permission from the end user.
$two_legged_app = new YahooApplication(API_KEY,SHARED_SECRET);
	if ($two_legged_app == NULL) { print ("<br />"); print ("Error: Cannot get two_legged_app (YahooApplication object)."); exit;}

// Get number of instruments available
	$query = mysql_query ("SELECT COUNT(*) AS num FROM myichi_instrument_names WHERE market = 'USA'");
	$row = mysql_fetch_assoc($query);
	$symbols_num = $row['num'];
	echo $symbols_num;
	echo $selectid;

$rounds = 0;
$symbolList = array();

//	while ($selectid < 140) {
	while ($selectid < $symbols_num) {
		if (($selectid + $selectidGroupSize) > $symbols_num) {$selectidGroupSize = ($symbols_num - $selectid);}
		$list = ''; // if we don't empty $list, the new list of symbols will be added to the previous list and create double entries

// Get the list of Yahoo_symbols and convert them into a YQL useable string
		$query = mysql_query ("SELECT yahoo_symbol FROM myichi_instrument_names WHERE market = 'USA' LIMIT $selectid,$selectidGroupSize ") or die ('Erreur de requête<br />'.$sql.'<br />'.mysql_error());
			while($row = mysql_fetch_row($query)) {
				$list[] = $row[0];
			}
		$symbolList = "'" . implode("', '", array_values($list)) . "'";
		echo "<br>" . $symbolList . "<br>";

// Build YQL query
		$yql_query = "select * from yahoo.finance.quotes where symbol in ($symbolList)";
		$yql_response = $two_legged_app->query($yql_query);
		$yqlqty++;

			if ($yql_response->query->count >1) {
				for($i=0; $i < $yql_response->query->count; $i++) {
// Determine the last "symbol_period" created for the "yahoo_symbol" we work on (as that is where we start)
					$CurrentSymbol   = $yql_response->query->results->quote[$i]->symbol;
					$query = mysql_query("SELECT MAX(symbol_period) AS max, MAX(ID) AS ID FROM myichi_historical_data WHERE yahoo_symbol='$CurrentSymbol' AND open<>'NULL' ");
						if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
					$symbolperiodrow     = mysql_fetch_assoc($query);
					$SymbolPeriod        = ($symbolperiodrow["max"]);
					$currentSymbolPeriod = $SymbolPeriod + $symbol_period_increment;
					$query = mysql_query("SELECT ID FROM myichi_historical_data WHERE yahoo_symbol='$CurrentSymbol' AND symbol_period='$currentSymbolPeriod' ");
						if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
					$symbolperiodid      = mysql_fetch_assoc($query);
					$ID                  = $symbolperiodid["ID"];
					$timeframe           = 'EOD';
					$Open                = $yql_response->query->results->quote[$i]->Open;
					$Close               = $yql_response->query->results->quote[$i]->LastTradePriceOnly;
					$High                = $yql_response->query->results->quote[$i]->DaysHigh;
					$Low                 = $yql_response->query->results->quote[$i]->DaysLow;
					$Volume              = $yql_response->query->results->quote[$i]->Volume;
					$AverageDailyVolume  = $yql_response->query->results->quote[$i]->AverageDailyVolume;
					$updated             = date('Y-m-d G:i:s');
					
					echo "SymbolPeriod : " . $SymbolPeriod . " currentSymbolPeriod : " . $currentSymbolPeriod . "<br>";
					echo "Yahoo_Symbol : " . $CurrentSymbol . " Open: " . $Open . " High: " . $High . " Low: " . $Low . " Close: " . $Close . " Volume: " . $Volume . " <br>";
// Update the database	
					$ext='_data_usa';
					mysql_query("UPDATE myichi_historical_data SET yahoo_symbol='$CurrentSymbol', symbol_period='$currentSymbolPeriod', timeframe='$timeframe', date='$intraday', updated='$updated', open='$Open', high='$High', low='$Low', close='$Close', volume='$Volume', average_volume='$AverageDailyVolume' WHERE ID='$ID'  ");
					calculateIchimokuIndicators($CurrentSymbol,$currentSymbolPeriod,$symbol_period_increment);
					$addedRecordsCounter++;
				}
			}
	
	$selectid = $selectid + $selectidGroupSize;
	$rounds++;
	}

echo "<br>rounds : " . $rounds;
$counter = $updatecounter[counter]+1;
$info = 'Query type: ' . $queryType . '';
$end = date('H:i:s', time());
mysql_query("UPDATE myichi_tracker SET rundate='$intraday', counter='$counter' WHERE script='Intraday_USA' ");
mysql_query("INSERT INTO myichi_tracker_report (script, date, start, end, yqlqty, records, info) VALUES ('Intraday_USA', '$intraday', '$start', '$end', '$yqlqty', '$addedRecordsCounter', '$info')");

mysql_close($conn);


// Sent email with results:
if ($cronMailIntradayResults > 0) {
     $subject = 'USA Intraday data update results';
     $message = '
	 <html><body>Just added ' . $addedRecordsCounter . ' records with USA Intraday ' . $queryType . ' data from ' . $intraday .' to the database. <br>'
	 . $yqlqty . ' YQL queries where executed. <br>
	 The script started at ' . $start . ' and ended at ' . $end
	 . '</body></html>';
     
	 $headers = 'From: ' . $fromEmail .'' . "\r\n" .
     'Reply-To: no-reply@MyIchimoku.eu' . "\r\n" .
	 'MIME-Version: 1.0' . "\r\n" .
	 'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($adminEmail, $subject, $message, $headers);
	 }
	 
	 
?>