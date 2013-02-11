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

if ($argv[1]=='yes') {$dailyUpdate =0;} else {$dailyUpdate =1;}
//$dailyUpdate  = $_REQUEST['dailyupdate'];

// ------------------------------  Settings  -----------------------------------
//$dailyUpdate =1;
$uID         =1;
$markets     = "'AMS',  'BRU',  'LIS',  'PAR', 'USA', 'FOREX'";

// -----------------------------------------------------------------------------
$today = date("Y-m-d");
echo "dailyupdate: ".$dailyUpdate;

	// Verify if we are in the week-end. If so, exit
		if ((date("l") == 'Saturday') OR (date("l") == 'Sunday'))  {exit();}


	// Check if we need to change the default date for the user (for a fresh new day) or if we are only refreshing intraday data
	$query = mysql_query("SELECT rundate, counter FROM myichi_tracker WHERE script='Trade_Signals'");
		if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
	$updatecounter = mysql_fetch_assoc($query);
	//echo $updatecounter[rundate];
		if ($updatecounter[rundate] == $today) {
			echo "this is an Intraday TradeSignal update";
			$queryType = "(Intraday TradeSignal update)";
			}
		else
			{
			echo "This is a fresh new TradeSignal day!";
			$counter = 0;
			$updatecounter[counter] = 0;
			$queryType = "(Fresh new TradeSignal day!)";
			mysql_query("UPDATE myichi_tracker SET counter='$counter' WHERE script='Trade_Signals'");
			$query = mysql_query("SELECT * FROM myichi_users WHERE activated=1");	if (!$query) { echo 'Impossible d\'exécuter la requête Z: ' .$query. mysql_error(); exit; }
				while ($row = mysql_fetch_assoc($query)) {
				$uID = $row['user_id'];
				mysql_query("UPDATE myichi_users SET trade_date='$today' WHERE user_id=$uID");
				}
			}

//function tradesignals ($uID,$dailyUpdate,$markets) {

	if ($dailyUpdate==0) 
		{mysql_query("DELETE FROM myichi_user_signals	WHERE user_id = '$uID' ");}	// We re-construct the history so delete trading signals
		else
		{
		$query = mysql_query (" SELECT * 
								FROM myichi_user_signals 
								WHERE user_id='$uID'
								AND signal_date='$today' ") or die ('Erreur de requête<br />'.$sql.'<br />'.mysql_error());
			while($row = mysql_fetch_assoc($query)) {
			$resetsymbol=$row["yahoo_symbol"];
			mysql_query("UPDATE myichi_user_signals SET signal_date='1999-01-01', trade_direction='Bullish', trade_signal='Sell'
						 WHERE  user_id='$uID' 
						 AND yahoo_symbol='$resetsymbol' ");
			}
		}

							
									
		$query = mysql_query (" SELECT yahoo_symbol 
								FROM myichi_instrument_names 
								WHERE market IN ($markets) ") or die ('Erreur de requête<br />'.$sql.'<br />'.mysql_error());
			
			while($row = mysql_fetch_assoc($query)) {
				$CurrentSymbol = $row["yahoo_symbol"];
				echo $CurrentSymbol."\n";
					$periodquery = mysql_query("SELECT MAX(symbol_period) AS max, MAX(ID) AS ID 
												FROM myichi_historical_data 
												WHERE yahoo_symbol='$CurrentSymbol' 
												AND open<>'NULL' "); 
												if (!$periodquery) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
					$symbolperiodrow     = mysql_fetch_assoc($periodquery);
					$symbolPeriod        = $symbolperiodrow["max"];
						if ($symbolPeriod=="") {$symbolPeriod=1;}
						
						calculateTradeSignals($CurrentSymbol,$uID,$symbolPeriod,$dailyUpdate);

						$signalCount    = (count($tradeSignals['signalDate']))-1;	
						$signalDate     = $tradeSignals['signalDate'][$signalCount];
						$tradeDirection = $tradeSignals['tradeDirection'][$signalCount];
						$tradeSignal    = $tradeSignals['tradeSignal'][$signalCount];
						$delta          = $tradeSignals['delta'][$signalCount];
						$date           = date("Y-m-d",($signalDate/1000));
				
							if ($tradeSignal<>"") {
								if ($dailyUpdate==1) {
									mysql_query("DELETE FROM myichi_user_signals WHERE user_id='$uID' AND yahoo_symbol='$CurrentSymbol' ");
									}
									$updated = date('Y-m-d G:i:s');
									mysql_query("INSERT INTO myichi_user_signals (user_id, yahoo_symbol, updated, signal_date, trade_direction, trade_signal) VALUES ('$uID', '$CurrentSymbol', '$updated', '$date', '$tradeDirection', '$tradeSignal') ");
									echo $CurrentSymbol."signalDate: ".$signalDate." tradeDirection: ".$tradeDirection." tradeSignal: ".$tradeSignal."\n";
									$count++;
									$updatedRecordsCounter++;
							}
							else
							{
							if ($tradeSignal=="" && $dailyUpdate==0) {
								$updated = date('Y-m-d G:i:s');
								mysql_query("INSERT INTO myichi_user_signals (user_id, yahoo_symbol, updated, signal_date, trade_direction, trade_signal) VALUES ('$uID', '$CurrentSymbol', '$updated', '1900-01-01', 'Bullish', 'Sell') ");
							}}

			}
//	}	
	
	// test purpose code

	/*if ($argv[1]=='yes') {	
exec("/usr/local/bin/php.ORIG.5 /homez.31/domainese/myichimoku/cron/tradesignals_email.php > /dev/null &");

	}*/
	// end test purpose coce
$end = date('H:i:s', time());

echo "start: ".$start." end: ".$end;

$counter = $updatecounter[counter]+1;
$info = 'Query type: ' . $queryType;
mysql_query("UPDATE myichi_tracker SET rundate='$today', counter='$counter' WHERE script='Trade_Signals' ");
mysql_query("INSERT INTO myichi_tracker_report (script, date, start, end, yqlqty, records, info) VALUES ('Trade_Signals', '$today', '$start', '$end', '$yqlqty', '$updatedRecordsCounter', '$info')");
?>

