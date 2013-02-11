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


function calculateIchimokuIndicators($symbol,$currentSymbolPeriod,$symbol_period_increment,$ext="_data")
{
// This function calculates the 5 Ichimoku Indicators.
// It has the following parameters: $symbol, $currentSymbolPeriod, $symbol_period_increment and $ext

$table = 'myichi_historical' . $ext;
$cloudBreak = 0;
// ---------------------------------------------  Calculate Tenkan-Sen  -------------------------------------------- 
			$TSoffset = ($currentSymbolPeriod - 8);
			// Determine the HighestHigh and LowestLow for Tenkan-Sen
			$query = mysql_query("SELECT MAX(t.high) AS HighestHigh, MIN(t.low) AS LowestLow 
										FROM (SELECT high, low 
												FROM $table
												WHERE yahoo_symbol = '$symbol' 
												AND symbol_period >= '$TSoffset'
												ORDER BY symbol_period ASC 												
												LIMIT 9) 
												AS t");

				if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
			$row = mysql_fetch_assoc($query);
			$HighestHigh = ($row["HighestHigh"]);

			$LowestLow = ($row["LowestLow"]);

			// Calculate Tenkan-Sen value
			$TenkanSen = ($HighestHigh + $LowestLow)/2;

// ---------------------------------------------  Calculate Kijun-Sen  -------------------------------------------- 
			$KSoffset = ($currentSymbolPeriod - 25);
			// Determine the HighestHigh and LowestLow for Kijun-Sen
			$query = mysql_query("SELECT MAX(t.high) AS HighestHigh, MIN(t.low) AS LowestLow 
										FROM (SELECT high, low 
												FROM $table
												WHERE yahoo_symbol = '$symbol' 
												AND symbol_period >= '$KSoffset' 
												ORDER BY symbol_period ASC 
												LIMIT 26) 
												AS t");
				if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
			$row = mysql_fetch_assoc($query);
			$HighestHigh = ($row["HighestHigh"]);


			$LowestLow = ($row["LowestLow"]);

			// Calculate Kijun-Sen value
			$KijunSen = ($HighestHigh + $LowestLow)/2;

// ---------------------------------------------  Calculate Senkou-Span A  -------------------------------------------- 
			$SenkouSpanA = ($TenkanSen + $KijunSen)/2; // Needs to be inserted 26 periods forward

// ---------------------------------------------  Calculate Senkou-Span B  --------------------------------------------
			$SPBoffset = ($currentSymbolPeriod - 51);
			// Determine the HighestHigh for Senkou-Span B
			$query = mysql_query("SELECT MAX(t.high) AS HighestHigh, MIN(t.low) AS LowestLow 
										FROM (SELECT high, low 
												FROM $table
												WHERE yahoo_symbol = '$symbol' 
												AND symbol_period >= '$SPBoffset' 
												ORDER BY symbol_period ASC 
												LIMIT 52) 
												AS t");
				if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }
			$row = mysql_fetch_assoc($query);
			$HighestHigh = ($row["HighestHigh"]);

			$LowestLow = ($row["LowestLow"]);

			// Calculate Senkou-Span B value
			$SenkouSpanB = ($HighestHigh + $LowestLow)/2; // Needs to be inserted 26 periods forward
			$senkouPeriod = $currentSymbolPeriod + 26;

// ---------------------------------------------  Calculate Chikou-Span  --------------------------------------------
			// Determine the Close price for Chikou-Span
			$query = mysql_query("SELECT close, ID FROM $table WHERE yahoo_symbol='$symbol' AND symbol_period='$currentSymbolPeriod' ");
				if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
			$row = mysql_fetch_assoc($query);
			$ChikouSpan = ($row["close"]);  // Needs to be inserted 26 periods behind
			$ID = ($row["ID"]);             // Whilst we are here we get the row ID we need to update lateron
			$chikouSymbolPeriod = $currentSymbolPeriod-26;
			$query = mysql_query("SELECT ID, close, senkou_span_a, senkou_span_b FROM $table WHERE yahoo_symbol='$symbol' AND symbol_period='$chikouSymbolPeriod' ");
				if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
			$row = mysql_fetch_assoc($query); 
			$ChikouID = ($row["ID"]);       // The row ID of the row that is 26 periods behind
			
			$price_26    = ($row["close"]); // will be used for signal calculation
			$senkou_a_26 = ($row["senkou_span_a"]);
			$senkou_b_26 = ($row["senkou_span_b"]);

			
// -------------------------------  From here we start calculating the Ichimoku signals  ----------------------------			

			// The bb_ prefix stands for Bullish or Bearish and is either 1 (bullish), 0 (neutral) or -1 (bearish) for each of the signals
			
			// Let's get some data first
			$queryToday = mysql_query("SELECT * FROM $table WHERE yahoo_symbol='$symbol' AND symbol_period='$currentSymbolPeriod' ");
				if (!$queryToday) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
			$rowToday = mysql_fetch_assoc($queryToday);

			$symbolPeriodYesterday = $currentSymbolPeriod - 1;
			$queryYesterday = mysql_query("SELECT * FROM $table WHERE yahoo_symbol='$symbol' AND symbol_period='$symbolPeriodYesterday' ");
				if (!$queryYesterday) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
			$rowYesterday = mysql_fetch_assoc($queryYesterday);
			
			$symbolPeriod2Days = $currentSymbolPeriod - 2;
			$query2Days = mysql_query("SELECT * FROM $table WHERE yahoo_symbol='$symbol' AND symbol_period='$symbolPeriod2Days' ");
				if (!$query2Days) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
			$row2Days = mysql_fetch_assoc($query2Days);
			
			// Determine the average close price over the last 5 periods
			$symbolPeriod5Days = $currentSymbolPeriod - 5;
			$Avquery = mysql_query("SELECT AVG(close) AS averageClose FROM $table WHERE yahoo_symbol='$symbol' AND symbol_period = $symbolPeriod5Days LIMIT 5");
				if (!$Avquery) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
			$row = mysql_fetch_assoc($Avquery);
			$averageClose = ($row["averageClose"]);
			
			$futureCloudRef = $senkouPeriod - 1;
			$queryFutureCloudPast = mysql_query("SELECT senkou_span_a, senkou_span_b FROM $table WHERE yahoo_symbol='$symbol' AND symbol_period='$futureCloudRef' ");
				if (!$queryFutureCloudPast) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
			$rowFutureCloudPast = mysql_fetch_assoc($queryFutureCloudPast);
			
			
			$priceToday                    = ($rowToday["close"]);
			$highToday                     = ($rowToday["high"]);
			$lowToday                      = ($rowToday["low"]);
			$tenkanToday                   = ($rowToday["tenkan_sen"]);
			$kijunToday                    = ($rowToday["kijun_sen"]);
			$senkouAToday                  = ($rowToday["senkou_span_a"]);
			$senkouBToday                  = ($rowToday["senkou_span_b"]);
			$priceYesterday                = ($rowYesterday["close"]);
			$highYesterday                 = ($rowYesterday["high"]);
			$lowYesterday                  = ($rowYesterday["low"]);
			$tenkanYesterday               = ($rowYesterday["tenkan_sen"]);
			$kijunYesterday                = ($rowYesterday["kijun_sen"]);
			$senkouAYesterday              = ($rowYesterday["senkou_span_a"]);
			$senkouBYesterday              = ($rowYesterday["senkou_span_b"]);
			$cloudbreakYesterday           = ($rowYesterday["cloudbreak"]);
			$low2Days                      = ($row2Days["low"]);
			$average_volume                = ($rowYesterday["average_volume"]);	
			$senkouAFuturePast             = ($rowFutureCloudPast["senkou_span_a"]);
			$senkouBFuturePast             = ($rowFutureCloudPast["senkou_span_b"]);
			
			// bb_price
				if ($priceToday > $priceYesterday) 
					{$bb_price = 1;}
					else
					{	if ($priceToday < $priceYesterday) 
						{$bb_price = -1;}
						else
						{$bb_price = 0; }}
			
			// bb_tenkan_sen
				if ($lowToday > $tenkanToday) 
					{$bb_tenkan = 2;}
					else
					{	if ($lowToday < $tenkanToday) 
						{$bb_tenkan = -2;}
						else
						{$bb_tenkan = 0; }}	
						
				if ($tenkanToday > $tenkanYesterday) 
					{$bb_tenkan = $bb_tenkan + 1;}
					else
					{	if ($tenkanToday < $tenkanYesterday) 
						{$bb_tenkan = $bb_tenkan -1;}
						else
						{$bb_tenkan = $bb_tenkan; }}

			// bb_kijun_sen
				if ($lowToday > $kijunToday) 
					{$bb_kijun = 1;}
					else
					{	if ($lowToday < $kijunToday) 
						{$bb_kijun = -1;}
						else
						{$bb_kijun = 0; }}
						
				if ($kijunToday > $kijunYesterday) 
					{$bb_kijun = $bb_kijun + 1;}
					else
					{	if ($kijunToday < $kijunYesterday) 
						{$bb_kijun = $bb_kijun -1;}
						else
						{$bb_kijun = $bb_kijun; }}

			// bb_senkou_span_A_current
				if ($priceToday > $senkouAToday) 
					{$bb_senkouACurr = 1;}
					else
					{	if ($priceToday < $senkouAToday) 
						{$bb_senkouACurr = -1;}
						else
						{$bb_senkouACurr = 0; }}
						
				if ($senkouAToday > $senkouAYesterday) 
					{$bb_senkouACurr = $bb_senkouACurr +1;}
					else
					{	if ($senkouAToday < $senkouAYesterday) 
						{$bb_senkouACurr = $bb_senkouACurr -1;}
						else
						{$bb_senkouACurr = $bb_senkouACurr; }}
			
			// bb_senkou_span_B_current
				if ($priceToday > $senkouBToday) 
					{$bb_senkouBCurr = 1;}
					else
					{	if ($priceToday < $senkouBToday) 
						{$bb_senkouBCurr = -1;}
						else
						{$bb_senkouBCurr = 0; }}
						
				if ($senkouBToday > $senkouBYesterday) 
					{$bb_senkouBCurr = $bb_senkouBCurr +1;}
					else
					{	if ($senkouBToday < $senkouBYesterday) 
						{$bb_senkouBCurr = $bb_senkouBCurr -1;}
						else
						{$bb_senkouBCurr = $bb_senkouBCurr; }}
						
			// bb_senkou_future
				if ($SenkouSpanA > $SenkouSpanB) 
					{$bb_senkouFuture = 1;
					// future cloud bullish strenght signal
						if (($senkouAFuturePast < $SenkouSpanA) && ($priceToday > $senkouAToday) && ($priceToday > $senkouBToday) && ($senkouBFuturePast < $SenkouSpanB)) {$SenkouFutureSignal = 2;}
						if (($senkouAFuturePast < $SenkouSpanA) && ($priceToday > $senkouAToday) && ($priceToday > $senkouBToday) && ($senkouBFuturePast = $SenkouSpanB)) {$SenkouFutureSignal = 1;}
						if (($senkouAFuturePast > $SenkouSpanA) && ($priceToday > $senkouAToday) && ($priceToday > $senkouBToday) && ($senkouBFuturePast = $SenkouSpanB)) {$SenkouFutureSignal = 0;}
					}
					else
					{	if ($SenkouSpanA < $SenkouSpanB) 
						{$bb_senkouFuture = -1;
						// future cloud bearish strenght signal
							if (($senkouAFuturePast > $SenkouSpanA) && ($priceToday < $senkouAToday) && ($priceToday < $senkouBToday) && ($senkouBFuturePast > $SenkouSpanB)) {$SenkouFutureSignal = -2;}
							if (($senkouAFuturePast > $SenkouSpanA) && ($priceToday < $senkouAToday) && ($priceToday < $senkouBToday) && ($senkouBFuturePast = $SenkouSpanB)) {$SenkouFutureSignal = -1;}
							if (($senkouAFuturePast < $SenkouSpanA) && ($priceToday < $senkouAToday) && ($priceToday < $senkouBToday) && ($senkouBFuturePast = $SenkouSpanB)) {$SenkouFutureSignal = 0;}
						}
						else
						{$bb_senkouFuture    = 0; 
						 $SenkouFutureSignal = 0;
						}}			
				
			
			// bb_chikou_span
				if ($ChikouSpan > $price_26) 
					{
						if (($price_26 < $senkou_a_26) && ($price_26 > $senkou_b_26)) {$bb_chikou = 1;}
						if (($price_26 > $senkou_a_26) && ($price_26 < $senkou_b_26)) {$bb_chikou = 1;}
						if (($price_26 > $senkou_a_26) && ($price_26 > $senkou_b_26)) {$bb_chikou = 2;}
					}
					else
					{	if ($ChikouSpan < $price_26) 
						{
						if (($price_26 > $senkou_a_26) && ($price_26 < $senkou_b_26)) {$bb_chikou = -1;}
						if (($price_26 < $senkou_a_26) && ($price_26 > $senkou_b_26)) {$bb_chikou = -1;}
						if (($price_26 < $senkou_a_26) && ($price_26 < $senkou_b_26)) {$bb_chikou = -2;}
						}
						else
						{$bb_chikou = 0; }}

		//  Ichimoku signal => so the scale is between -13 and +13 where 0 is the least attractive
			$IchimokuSignal = $bb_price + $bb_tenkan + $bb_kijun + $bb_senkouACurr + $bb_senkouBCurr + $bb_senkouFuture + $bb_chikou + $SenkouFutureSignal;

			
// ---------------------------------------------  Cloud break signal culculation  -------------------------------------------- 
 
				// Verify if previous cloudbreak continues to progress
				if     ($cloudbreakYesterday > 0) {
						if (($lowToday  > $senkouAToday) && (($lowToday > $lowYesterday) || ($priceToday > $low2Days))) {
							$cloudBreak = $cloudbreakYesterday + 1; 
							if ($cloudBreak > 20) {$cloudBreak = 0;}}}
				elseif ($cloudbreakYesterday < 0) {
						if (($highToday < $senkouAToday) && ($highToday < $highYesterday)) {
							$cloudBreak = $cloudbreakYesterday - 1; 
							if ($cloudBreak < -20) {$cloudBreak = 0;}}}
				else   {
						// Figure out if we have a cloud break
						if     (($lowToday  > $senkouAToday) && ($lowToday  > $senkouBToday) && (($lowYesterday  <= $senkouAYesterday) || ($lowYesterday  <= $senkouBYesterday))) {$cloudBreak =  1;}  // Bullish cloudbreak
						elseif (($highToday < $senkouAToday) && ($highToday < $senkouBToday) && (($highYesterday >= $senkouAYesterday) || ($highYesterday >= $senkouBYesterday))) {$cloudBreak = -1;}  // Bearish cloudbreak
						else   {$cloudBreak = 0;}
						}
						
				// Let's see what the strength of that break is
								
				if     ($cloudBreak >= 1)  {
					if ($senkouAToday > $senkouBToday) {$breakStrength = 1;}
					if ($senkouAToday > $senkouAYesterday) {$breakStrength = $breakStrength +1;}
					$breakStrength = $breakStrength + $bb_kijun + $bb_tenkan + $bb_chikou + $SenkouFutureSignal;
				}
				elseif ($cloudBreak <= -1) {
					if ($senkouAToday < $senkouBToday) {$breakStrength = -1;}
					if ($senkouBToday < $senkouBYesterday) {$breakStrength = $breakStrength -1;}
					$breakStrength = $breakStrength + $bb_kijun + $bb_tenkan + $bb_chikou + $SenkouFutureSignal;				
				}
				else   {$breakStrength=0;}
				
				
// ---------------------------------------------  Show the calculated data in the browser  -------------------------------------------- 			
 
			echo $symbol . " " .
			"Period:" . $currentSymbolPeriod . " " .       "\n" .
			/*"RowID:" . $ID . " " .                         "<br>" .
			"TenkanSen:" . $TenkanSen . " " .              "<br>" .
			"KijunSen:" . $KijunSen . " " .                "<br>" .
			"SenkouSymbolPeriod:" . $senkouPeriod . " " .  "<br>" .
			"SenkouSpanA:" . $SenkouSpanA . " " .          "<br>" .
			"SenkouSpanB:" . $SenkouSpanB . " " .          "<br>" .
			"ChikouSpan:" . $ChikouSpan .                  "<br>" .
			"chikouSymbolPeriod: " . $chikouSymbolPeriod . "<br>" .
			"ChikouID: " . $ChikouID .                     "<br>" .
			"<br>" .                                       "<br>" .
			"bb_price: " . $bb_price .                     "<br>" .
			"bb_tenkan: " . $bb_tenkan .                   "<br>" .
			"bb_kijun: " . $bb_kijun .                     "<br>" .
			"bb_senkouACurr: " . $bb_senkouACurr .         "<br>" .
			"bb_senkouBCurr: " . $bb_senkouBCurr .         "<br>" .
			"IchimokuSignal: " . $IchimokuSignal .         "<br>" .
			"bb_senkouFuture: " . $bb_senkouFuture .       "<br>" .
			"IchimokuSignal: " . $IchimokuSignal .         "<br>" . */
			"cloudbreakYesterday: " . $cloudbreakYesterday . "\n" .
			"cloudBreak: " . $cloudBreak .                 "\n" .
			"breakStrength: " . $breakStrength .           "\n" .
			"\n" .                                       "\n" .
			"\n" .                                       "\n" ;
			
		

// ---------------------------------------------  Database updates  -------------------------------------------- 			
		
		// From here we insert the data into the table with the *** signal strenght *** included
			$updated = date('Y-m-d G:i:s');
			mysql_query("UPDATE $table SET tenkan_sen='$TenkanSen', kijun_sen='$KijunSen', updated='$updated', bb_price='$bb_price', bb_tenkan_sen='$bb_tenkan', bb_kijun_sen='$bb_kijun', bb_senkou_a_current='$bb_senkouACurr', bb_senkou_b_current='$bb_senkouBCurr', bb_senkou_future='$bb_senkouFuture', bb_chikou_span='$bb_chikou', bb_SenkouFutureSignal='$SenkouFutureSignal', ichimoku_signal='$IchimokuSignal', cloudbreak='$cloudBreak', cloudbreak_strenght='$breakStrength' WHERE ID='$ID' ");
			mysql_query("UPDATE $table SET chikou_span='$ChikouSpan', updated='$updated' WHERE ID='$ChikouID' ");
			//mysql_query("UPDATE $table SET ichimoku_signal='$FiveDayAvg', updated='$updated' WHERE ID='$FiveDayAvgID' ");

	
			if ($symbol_period_increment == 0) {
		// This is an intraday refresh
				mysql_query("UPDATE $table SET updated='$updated', senkou_span_a='$SenkouSpanA', senkou_span_b='$SenkouSpanB'  WHERE yahoo_symbol='$symbol' AND symbol_period='$senkouPeriod' ");
			}
			else
			{
		// This is a fresh new day
				$senkouDate = date("Y-m-d", strtotime("+36 days")); // This approximating the number of business days ahead as 26/5=5,2 weeks. So we need to add another 10 weekend days 
				mysql_query("INSERT INTO $table (yahoo_symbol, symbol_period, timeframe, date, updated, senkou_span_a, senkou_span_b ) VALUES ('$symbol', '$senkouPeriod', 'EOD', '$senkouDate', '$updated', '$SenkouSpanA', '$SenkouSpanB')");
			}

		// End inserts

}


// **********************************************************************************************************************************
// *																																*
// *									HERE WE START THE TRADE SIGNAL CALCULATION FUNCTION											* 
// *																																*
// **********************************************************************************************************************************

function calculateTradeSignals($yahoo_symbol,$uID,$period="",$dailyUpdate="",$table="myichi_historical",$ext="_data")
{ 
// This function calculates the Buy & Sell signals for both Bullish & Bearish trends for a symbol based on specific user settings
$start = date('H:i:s', time());
$table = $table.$ext;

global $tradeSignals;
$signalDate = array();
$tradeDirection = array();
$tradeSignal = array();
$delta = array();

// First we get the user specific settings
$query = mysql_query("	SELECT	bull_entry_tenkan, bull_entry_kijun, bull_entry_buffer, 
								bear_entry_tenkan, bear_entry_kijun, bear_entry_buffer, 
								exit_buffer, profit_buffer, profit_exit_alert, ichimoku_trade_signal,
								chikou_open_space, buy_wait
						FROM  myichi_users 
						WHERE user_id = '$uID' "); if (!$query) { echo 'Impossible d\'exécuter la requête X : ' . mysql_error();	exit; }

	$row = mysql_fetch_assoc($query);
	$bull_entry_tenkan     = $row['bull_entry_tenkan'];
	$bull_entry_kijun      = $row['bull_entry_kijun'];
	$bull_entry_buffer     = $row['bull_entry_buffer'];
	$bear_entry_tenkan     = $row['bear_entry_tenkan'];
	$bear_entry_buffer     = $row['bear_entry_buffer'];
	$exit_buffer           = $row['exit_buffer'];
	$profit_buffer         = $row['profit_buffer'];
	$profit_exit_alert     = $row['profit_exit_alert'];
	$ichimoku_trade_signal = $row['ichimoku_trade_signal'];
	$chikouOpenSpace       = $row['chikou_open_space'];
	$buyWait               = $row['buy_wait'];
	$buyWaitSecs           = $buyWait * (60*60*24);

// Let's see if this is an update or not.
// If it is an update we need to retrieve the recordered last signals for this user and set some variables accordingly. 
// If we are creating the history for this user for the first time we limite the data we will work on to speed up the process
// as we,only need (and store) the last trade signal anyway.

		if ($dailyUpdate==1) {
			$symbolPeriod     = "AND symbol_period='".$period."'";
			$signalquery      = mysql_query("SELECT * FROM myichi_user_signals WHERE yahoo_symbol='$yahoo_symbol' AND user_id='$uID' "); if (!$signalquery) { echo 'Impossible d\'exécuter la requête Y: ' . mysql_error(); exit; }
			$symbolperiodrow  = mysql_fetch_assoc($signalquery);
			$tradeDate        = $symbolperiodrow["signal_date"];
			$tradeDirection   = $symbolperiodrow["trade_direction"];
			$tradeSignal      = $symbolperiodrow["trade_signal"];
				if ($tradeDirection==Bullish) {$tradeDirection=null;
					if ($tradeSignal==Buy) {$sellSignal=0; $bullishbuy=1; $tradeSignal=null;}}
				if ($tradeDirection==Bearish) {$tradeDirection=null;
					if ($tradeSignal==Buy) {$sellSignal=0; $bearishbuy=1; $tradeSignal=null;}}
				if ($tradeSignal==Sell)    {$sellSignal=1; $sellSignalDate=$tradeDate; $tradeSignal=null;}

			}
			elseif ($dailyUpdate==0)
			{
			$a = $period-150;
			$b = 151;
				if ($period<150) {$a=1;$b=$period;}
			$symbolPeriod    = "ORDER BY symbol_period ASC LIMIT ".$a.", ".$b."";
			$sellSignal      = 1;
			$sellSignalDate  ='2000-01-01';
			}
			else
			{
			$symbolPeriod    = "ORDER BY symbol_period ASC";
			$sellSignal      = 1;
			$sellSignalDate  ='2000-01-01';
			}

// Now we get the data from the historic data table for the Symbol we are working on	
$query = mysql_query("SELECT * FROM $table WHERE yahoo_symbol='$yahoo_symbol' AND open<>'NULL' $symbolPeriod ");	if (!$query) { echo 'Impossible d\'exécuter la requête Z: ' .$query. mysql_error(); exit; }

	while ($row = mysql_fetch_assoc($query)) {
		$yahoo_symbol    = $row['yahoo_symbol'];
		$date            = $row['date'];
		$curr_symb_prd   = $row['symbol_period'];
		$tenkan          = $row['tenkan_sen'];
		$kijun           = $row['kijun_sen'];
		$open            = $row['open'];
		$high            = $row['high'];
		$low             = $row['low'];
		$price           = $row['close'];
		$senkou_span_a   = $row['senkou_span_a'];
		$senkou_span_b   = $row['senkou_span_b'];
		$ichimoku_signal = $row['ichimoku_signal'];
		$averageVolume   = $row['average_volume'];
		
			//if (($symbolPeriod<>"") && ($averageVolume<50000)) {break;return;}
		
// Just in case we had a sell signal, we do not want to generate a buy signal for atleast a few days
// as they are usually not very significant	
	if ($sellSignal==1){$nextBuyDate = strtotime($sellSignalDate) + $buyWaitSecs;
						if (strtotime($date) >= $nextBuyDate) {$buyOK=1;}
						} 
						else 
						{$buyOK=0;}

// Lets have a look at the price evolution since yesterday. Did it go up or down.
/*if ($buyOK==1) {
$yesterday = $curr_symb_prd - 1;
$queryYesterday = mysql_query("SELECT * FROM $table WHERE yahoo_symbol='$yahoo_symbol' AND symbol_period='$yesterday' ");	if (!$queryYesterday) { echo 'Impossible d\'exécuter la requête Z: ' .$query. mysql_error(); exit; }

	while ($rowYesterday = mysql_fetch_assoc($queryYesterday)) {
		$priceYesterday = $rowYesterday['close'];
		$openYesterday  = $rowYesterday['open'];
			if (($price > $priceYesterday) && ($openYesterday < $priceYesterday)) {$priceUpOrDown=1;}
			if (($price < $priceYesterday) && ($openYesterday > $priceYesterday)) {$priceUpOrDown=-1;}
		}

}*/
						
if ($buyOK==1) {		
// We need to know if the Chikou span is in 'open space'
	$chikouPeriod = $curr_symb_prd - 26;
	$chikouquery  = mysql_query("SELECT MAX( t.high ) AS highestHigh, MIN( t.low ) AS lowestLow 
								 FROM (SELECT high, low 
										FROM $table
										WHERE yahoo_symbol = '$yahoo_symbol' 
										AND symbol_period >= '$chikouPeriod' 
										LIMIT $chikouOpenSpace) 
										AS t");	if (!$chikouquery) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }		
	$row = mysql_fetch_assoc($chikouquery);
	$highestHigh = ($row["highestHigh"]);
	$lowestLow   = ($row["lowestLow"]);
	$bullishOpen = $highestHigh + (($highestHigh - $lowestLow) * 0.1);
	$bearishOpen = $lowestLow   - (($highestHigh - $lowestLow) * 0.1);
			
	$chikouquery = mysql_query("SELECT chikou_span, senkou_span_a, senkou_span_b FROM $table 
								WHERE yahoo_symbol='$yahoo_symbol' 
								AND symbol_period='$chikouPeriod' "); if (!$chikouquery) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }		
	$row = mysql_fetch_assoc($chikouquery);
	$chikou_span      = ($row["chikou_span"]);
	$senkou_span_a_OS = ($row["senkou_span_a"]);
	$senkou_span_b_OS = ($row["senkou_span_b"]);
					// *************** We need to do something here to improve the results of Open Space determination  *************
					// need to have more space above and below the prices and avoid the chikou to get into the cloud as well
		if (($chikou_span > $bullishOpen) && ($chikou_span > $senkou_span_a_OS) && ($chikou_span > $senkou_span_b_OS))  {$BullOpenSpace = 1;}
		if (($chikou_span < $bearishOpen)   && ($chikou_span < $senkou_span_a_OS) && ($chikou_span < $senkou_span_b_OS))  {$BearOpenSpace = 1;}

// Having Chikou in open space and a useable buydate is a great start and we can look further.
// If not, we can move on without looking into more details
	if ($BullOpenSpace==1 || $BearOpenSpace==1 ) {		

	// So let's determine if we are Bullish or Bearish
		if (($low > $senkou_span_a) && ($low > $senkou_span_b) && ($tenkan > $kijun) && ($low > $tenkan) && ($low > $kijun) && ($ichimoku_signal >= $ichimoku_trade_signal))
			{
				// We are Bullish
				// Are we within the Bullish Tenkan & Kijun range set by the user?
				$trade_direction  = 'Bullish';
				$tenkandelta      = ($price * $bull_entry_tenkan);
									if (($price - $tenkandelta) <= $tenkan) {$bullTenkanOK = 1;}
				$kijundelta       = ($price * $bull_entry_kijun);
									if (($price - $kijundelta) <= $kijun)   {$bullKijunOK  = 1;}

					if ($bullTenkanOK==1 && $bullKijunOK==1 && $sellSignal==1 && $BullOpenSpace==1 && $buyOK==1 && $price>$open) 
						{
						// We have a Bullish BUY signal
						$trade_signal = 'Buy';
						$buydate      = $date;
						$bullishbuy   = 1;
						$sellSignal   = 0;
						$nextBuyDate  = 0;
						$buyprice     = $price;
						$deltanull    = 0;
						// So now that we know we have a valid signal, we need to store it to an array.
							$signalDate[]     = (strtotime($date) * 1000);
							$tradeDirection[] = $trade_direction;
							$tradeSignal[]    = $trade_signal;
							$delta[]          = $deltanull;
						}
			}
		else
			{
			if ($high < $senkou_span_a && $high < $senkou_span_b && $tenkan < $kijun && $high < $tenkan && $high < $kijun && $ichimoku_signal <= -$ichimoku_trade_signal) 
				{
				// We are Bearish
				// Are we within the Bearish Tenkan & Kijun range set by the user?
				$trade_direction = 'Bearish';
				$tenkandelta     = ($price * $bear_entry_tenkan);
									if (($price + $tenkandelta) >= $tenkan) {$bearTenkanOK = 1;}
				$kijundelta      = ($price * $bear_entry_kijun);
									if (($price + $kijundelta) <= $kijun)   {$bearKijunOK  = 1;}
					if ($bearTenkanOK==1 && $bearKijunOK==1 && $sellSignal==1 && $BearOpenSpace==1 && $buyOK==1 && $price<$open)
						{
						// We have a Bearish BUY signal
						$trade_signal = 'Buy';
						$bearishbuy   = 1;
						$buydate      = $date;
						$sellSignal   = 0;
						$nextBuyDate  = 0;
						$buyprice     = $price;
						$deltanull    = 0;
						// So now that we know we have a valid signal, we need to store it to an array.
							$signalDate[]     = (strtotime($date) * 1000);
							$tradeDirection[] = $trade_direction;
							$tradeSignal[]    = $trade_signal;
							$delta[]          = $deltanull;
						}
				}
			}
	}
} // End of buying code

// So we are in a buying patern (either bullish or bearish)			
// In order to maximize the profit on (a sudden) price change we need verify the distance between Price and Tenkan

if ($sellSignal==0) 
	{
	if ($bullishbuy==1) {$bullishexitalert = $tenkan * (1 - $profit_exit_alert); if ($price <= $bullishexitalert) {$checkTenkan=1;}}
	if ($bearishbuy==1) {$bearishexitalert = $tenkan * (1 + $profit_exit_alert); if ($price >= $bullishexitalert) {$checkTenkan=1;}}

			if ($checkTenkan==1) {
				$yesterdayPeriod = $curr_symb_prd - 1;
					$tenkanquery = mysql_query("SELECT tenkan_sen FROM $table WHERE yahoo_symbol='$yahoo_symbol' AND symbol_period='$yesterdayPeriod' "); if (!$tenkanquery) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }		
					$row = mysql_fetch_assoc($tenkanquery);
					$tenkan_san_yesterday = ($row["tenkan_sen"]);
						if ($tenkan==$tenkan_sen_yesterday) {$exitNow = 1;}
				}

			// Bullish Sell		
			if (($bullishbuy==1) && ($bullishsell < 1) && ($sellSignal==0) && (($exitNow==1) || ($kijun > $tenkan) || ($tenkan >= $high) ))
						{
						// We have a SELL signal
						$trade_signal   = 'Sell';
						$bullishbuy     = 0;
						$sellSignal     = 1;
						$sellSignalDate = $date;
						$gain           = round(((($price/$buyprice)-1)*100),1);
							if ($archive==1) {
								mysql_query("INSERT INTO myichi_user_signals (user_id, yahoo_symbol, signal_date, trade_direction, trade_signal) VALUES ('$uID', '$yahoo_symbol', '$date', '$trade_direction', '$trade_signal') ");
							}
							else
							{
								$signalDate[]     = (strtotime($date) * 1000);
								$tradeDirection[] = $trade_direction;
								$tradeSignal[]    = $trade_signal;
								$delta[]          = $gain;
							}
						}

			// Bearish Sell
			if (($bearishbuy==1) && ($bearishsell < 1) && ($sellSignal==0) && (($exitNow==1) || ($kijun < $tenkan) || ($tenkan <= $low) ))
						{
						// We have a SELL signal
						$trade_signal   = 'Sell';
						$bearishbuy     = 0;
						$sellSignal     = 1;
						$sellSignalDate = $date;
						$gain           = round(((($price/$buyprice)-1)*100),1);
							if ($archive==1) {
								mysql_query("INSERT INTO myichi_user_signals (user_id, yahoo_symbol, signal_date, trade_direction, trade_signal) VALUES ('$uID', '$yahoo_symbol', '$date', '$trade_direction', '$trade_signal') ");
							}
							else
							{
								$signalDate[]     = (strtotime($date) * 1000);
								$tradeDirection[] = $trade_direction;
								$tradeSignal[]    = $trade_signal;
								$delta[]          = $gain;
							}

						}
	}

			// Before the next loop start we need to reset some variables
			$BullOpenSpace      = 0;
			$BearOpenSpace      = 0;
			$bullTenkanOK       = 0;
			$bullKijunOK        = 0;
			$bearTenkanOK       = 0;
			$bearKijunOK        = 0;

}
// We need to return the data back to the originating script
$tradeSignals = array(signalDate=>$signalDate, tradeDirection=>$tradeDirection, tradeSignal=>$tradeSignal, delta=>$delta);


$end = date('H:i:s', time());
//echo "tradeSignals start: ".$start." tradeSignals end: ".$end;
}

// **********************************************************************************************************************************
// *																																*
// *					HERE WE START THE ******  NEW  ******  TRADE SIGNAL CALCULATION FUNCTION									* 
// *																																*
// **********************************************************************************************************************************

function calculateEntryExitSignals($yahoo_symbol,$uID,$period="",$dailyUpdate="",$table="myichi_historical",$ext="_data")
{ 
// This function calculates the Buy & Sell signals for both Bullish & Bearish trends for a symbol based on specific user settings
$start = date('H:i:s', time());
$table = $table.$ext;

global $tradeSignals;
$signalDate = array();
$tradeDirection = array();
$tradeSignal = array();
$delta = array();

// First we get the user specific settings
$query = mysql_query("	SELECT	bull_entry_tenkan, bull_entry_kijun, bull_entry_buffer, 
								bear_entry_tenkan, bear_entry_kijun, bear_entry_buffer, 
								exit_buffer, profit_buffer, profit_exit_alert, ichimoku_trade_signal,
								chikou_open_space, buy_wait
						FROM  myichi_users 
						WHERE user_id = '$uID' "); if (!$query) { echo 'Impossible d\'exécuter la requête X : ' . mysql_error();	exit; }

	$row = mysql_fetch_assoc($query);
	$bull_entry_tenkan     = $row['bull_entry_tenkan'];
	$bull_entry_kijun      = $row['bull_entry_kijun'];
	$bull_entry_buffer     = $row['bull_entry_buffer'];
	$bear_entry_tenkan     = $row['bear_entry_tenkan'];
	$bear_entry_buffer     = $row['bear_entry_buffer'];
	$exit_buffer           = $row['exit_buffer'];
	$profit_buffer         = $row['profit_buffer'];
	$profit_exit_alert     = $row['profit_exit_alert'];
	$ichimoku_trade_signal = $row['ichimoku_trade_signal'];
	$chikouOpenSpace       = $row['chikou_open_space'];
	$buyWait               = $row['buy_wait'];
	$buyWaitSecs           = $buyWait * (60*60*24);

// Let's see if this is an update or not.
// If it is an update we need to retrieve the recordered last signals for this user and set some variables accordingly. 
// If we are creating the history for this user for the first time we limite the data we will work on to speed up the process
// as we,only need (and store) the last trade signal anyway.

		if ($dailyUpdate==1) {
			$symbolPeriod     = "AND symbol_period='".$period."'";
			$signalquery      = mysql_query("SELECT * FROM myichi_virtual_portfolio WHERE symbol='$yahoo_symbol' AND user_id='$uID' "); if (!$signalquery) { echo 'Impossible d\'exécuter la requête Y: ' . mysql_error(); exit; }
			$symbolperiodrow  = mysql_fetch_assoc($signalquery);
			$entryDate        = $symbolperiodrow["signal_date"];
			$entryPrice       = $symbolperiodrow["entry_price"];
			$tradeDirection   = $symbolperiodrow["trade_direction"];
			$tradeSignal      = $symbolperiodrow["trade_signal"];
				if ($tradeDirection==Bullish) {$tradeDirection=null;
					if ($tradeSignal==Buy) {$sellSignal=0; $bullishbuy=1; $tradeSignal=null;}}
				if ($tradeDirection==Bearish) {$tradeDirection=null;
					if ($tradeSignal==Buy) {$sellSignal=0; $bearishbuy=1; $tradeSignal=null;}}
				if ($tradeSignal==Sell)    {$sellSignal=1; $sellSignalDate=$tradeDate; $tradeSignal=null;}

			}
			elseif ($dailyUpdate==0)
			{
			$a = $period-150;
			$b = 151;
				if ($period<150) {$a=1;$b=$period;}
			$symbolPeriod    = "ORDER BY symbol_period ASC LIMIT ".$a.", ".$b."";
			$sellSignal      = 1;
			$sellSignalDate  ='2000-01-01';
			}
			else
			{
			$symbolPeriod    = "ORDER BY symbol_period ASC";
			$sellSignal      = 1;
			$sellSignalDate  ='2000-01-01';
			}

// Now we get the data from the historic data table for the Symbol we are working on	
$query = mysql_query("SELECT * FROM $table WHERE yahoo_symbol='$yahoo_symbol' AND open<>'NULL' $symbolPeriod ");	if (!$query) { echo 'Impossible d\'exécuter la requête Z: ' .$query. mysql_error(); exit; }

	while ($row = mysql_fetch_assoc($query)) {
		$yahoo_symbol    = $row['yahoo_symbol'];
		$date            = $row['date'];
		$curr_symb_prd   = $row['symbol_period'];
		$tenkan          = $row['tenkan_sen'];
		$kijun           = $row['kijun_sen'];
		$open            = $row['open'];
		$high            = $row['high'];
		$low             = $row['low'];
		$price           = $row['close'];
		$senkou_span_a   = $row['senkou_span_a'];
		$senkou_span_b   = $row['senkou_span_b'];
		$ichimoku_signal = $row['ichimoku_signal'];
		$averageVolume   = $row['average_volume'];
		
// Just in case we had a sell signal, we do not want to generate a buy signal for atleast a few days
// as they are usually not very significant	
	if ($sellSignal==1){$nextBuyDate = strtotime($sellSignalDate) + $buyWaitSecs;
						if (strtotime($date) >= $nextBuyDate) {$buyOK=1;}
						} 
						else 
						{$buyOK=0;}
		
if ($buyOK==1) {		
// We need to know if the Chikou span is in 'open space'
	$chikouPeriod = $curr_symb_prd - 26;
	$chikouquery  = mysql_query("SELECT MAX( t.high ) AS highestHigh, MIN( t.low ) AS lowestLow 
								 FROM (SELECT high, low 
										FROM $table
										WHERE yahoo_symbol = '$yahoo_symbol' 
										AND symbol_period >= '$chikouPeriod' 
										LIMIT $chikouOpenSpace) 
										AS t");	if (!$chikouquery) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }		
	$row = mysql_fetch_assoc($chikouquery);
	$highestHigh = ($row["highestHigh"]);
	$lowestLow   = ($row["lowestLow"]);
	$bullishOpen = $highestHigh + (($highestHigh - $lowestLow) * 0.1);
	$bearishOpen = $lowestLow   - (($highestHigh - $lowestLow) * 0.1);
			
	$chikouquery = mysql_query("SELECT chikou_span, senkou_span_a, senkou_span_b 
								FROM $table 
								WHERE yahoo_symbol='$yahoo_symbol' 
								AND symbol_period='$chikouPeriod' "); if (!$chikouquery) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }		
	$row = mysql_fetch_assoc($chikouquery);
	$chikou_span      = ($row["chikou_span"]);
	$senkou_span_a_OS = ($row["senkou_span_a"]);
	$senkou_span_b_OS = ($row["senkou_span_b"]);
					// *************** We need to do something here to improve the results of Open Space determination  *************
					// need to have more space above and below the prices and avoid the chikou to get into the cloud as well
		if (($chikou_span > $bullishOpen) && ($chikou_span > $senkou_span_a_OS) && ($chikou_span > $senkou_span_b_OS))  {$BullOpenSpace = 1;}
		if (($chikou_span < $bearishOpen)   && ($chikou_span < $senkou_span_a_OS) && ($chikou_span < $senkou_span_b_OS))  {$BearOpenSpace = 1;}

// Having Chikou in open space and a useable buydate is a great start and we can look further.
// If not, we can move on without looking into more details
	if ($BullOpenSpace==1 || $BearOpenSpace==1 ) {		

	// So let's determine if we are Bullish or Bearish
		if (($price > $senkou_span_a) && ($price > $senkou_span_b) && ($tenkan > $kijun) && ($price > $tenkan) && ($price > $kijun) && ($ichimoku_signal >= $ichimoku_trade_signal))
			{
				// We are Bullish
				// Are we within the Bullish Tenkan & Kijun range set by the user?
				$trade_direction  = 'Bullish';
				$tenkandelta      = ($price * $bull_entry_tenkan);
									if (($price - $tenkandelta) <= $tenkan) {$bullTenkanOK = 1;}
				$kijundelta       = ($price * $bull_entry_kijun);
									if (($price - $kijundelta) <= $kijun)   {$bullKijunOK  = 1;}

					if ($bullTenkanOK==1 && $bullKijunOK==1 && $sellSignal==1 && $BullOpenSpace==1 && $buyOK==1 && $price>$open) 
						{
						// We have a Bullish BUY signal
						$trade_signal = 'Buy';
						$buydate      = $date;
						$bullishbuy   = 1;
						$sellSignal   = 0;
						$nextBuyDate  = 0;
						$buyprice     = $price;
						$deltanull    = 0;
						// So now that we know we have a valid signal, we need to store it to an array.
							$entryDate[]      = (strtotime($date) * 1000);
							$entryPrice[]     = $buyprice;
							$tradeDirection[] = $trade_direction;
							$tradeSignal[]    = $trade_signal;
							$delta[]          = $deltanull;
						}
			}
		else
			{
			if ($price < $senkou_span_a && $price < $senkou_span_b && $tenkan < $kijun && $price < $tenkan && $price < $kijun && $ichimoku_signal <= -$ichimoku_trade_signal) 
				{
				// We are Bearish
				// Are we within the Bearish Tenkan & Kijun range set by the user?
				$trade_direction = 'Bearish';
				$tenkandelta     = ($price * $bear_entry_tenkan);
									if (($price + $tenkandelta) >= $tenkan) {$bearTenkanOK = 1;}
				$kijundelta      = ($price * $bear_entry_kijun);
									if (($price + $kijundelta) <= $kijun)   {$bearKijunOK  = 1;}
					if ($bearTenkanOK==1 && $bearKijunOK==1 && $sellSignal==1 && $BearOpenSpace==1 && $buyOK==1 && $price<$open)
						{
						// We have a Bearish BUY signal
						$trade_signal = 'Buy';
						$bearishbuy   = 1;
						$buydate      = $date;
						$sellSignal   = 0;
						$nextBuyDate  = 0;
						$buyprice     = $price;
						$deltanull    = 0;
						// So now that we know we have a valid signal, we need to store it to an array.
							$entryDate[]      = (strtotime($date) * 1000);
							$entryPrice[]     = $buyprice;
							$tradeDirection[] = $trade_direction;
							$tradeSignal[]    = $trade_signal;
							$delta[]          = $deltanull;
						}
				}
			}
	}
} // End of buying code

// So we are in a buying patern (either bullish or bearish)			
// In order to maximize the profit on (a sudden) price change we need verify the distance between Price and Tenkan

if ($sellSignal==0) 
	{
	
	if ($bullishbuy==1) {$bullishexitalert = $tenkan * (1 - $profit_exit_alert); if ($price <= $bullishexitalert) {$checkTenkan=1;}}
	if ($bearishbuy==1) {$bearishexitalert = $tenkan * (1 + $profit_exit_alert); if ($price >= $bullishexitalert) {$checkTenkan=1;}}


			//if (($bullishbuy==1) && ($low <= ($buyPrice * (1 - $profit_exit_alert)))) {$exitNow = 1;}
			//elseif (($bullishbuy==1) && (date("Y-m-d") > $date) && ($low <= ($tenkan * (1 - $profit_exit_alert)))) {$exitNow = 1;}
			//elseif (($bullishbuy==1) && (date("Y-m-d") > $date) && (($kijun * (1 - $profit_exit_alert)) > $buyPrice) && ($low <= $kijun)) {$exitNow = 1;}
			//else {
			if ($bullishbuy==1) {$bullishexitalert = $tenkan * (1 - $profit_exit_alert); if ($price <= $bullishexitalert) {$checkTenkan=1;}}
						if ($checkTenkan==1) {
				$yesterdayPeriod = $curr_symb_prd - 1;
					$tenkanquery = mysql_query("SELECT tenkan_sen FROM $table WHERE yahoo_symbol='$yahoo_symbol' AND symbol_period='$yesterdayPeriod' "); if (!$tenkanquery) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }		
					$row = mysql_fetch_assoc($tenkanquery);
					$tenkan_san_yesterday = ($row["tenkan_sen"]);
						if ($tenkan==$tenkan_sen_yesterday) {$exitNow = 1;}
				}
			//}
			// Bullish Sell		
			if (($bullishbuy==1) && ($bullishsell < 1) && ($sellSignal==0) && (($exitNow==1) || ($kijun > $tenkan) || ($tenkan >= $high) ))
						{
						// We have a SELL signal
						$trade_signal   = 'Sell';
						$bullishbuy     = 0;
						$sellSignal     = 1;
						$sellSignalDate = $date;
						$gain           = round(((($low/$buyprice)-1)*100),1);
							if ($archive==1) {
								mysql_query("INSERT INTO myichi_virtual_portfolio (user_id, symbol, signal_date, trade_direction, trade_signal) VALUES ('$uID', '$yahoo_symbol', '$date', '$trade_direction', '$trade_signal') ");
							}
							else
							{
								$exitDate[]       = (strtotime($date) * 1000);
								$exitPrice[]      = $low;
								$tradeDirection[] = $trade_direction;
								$tradeSignal[]    = $trade_signal;
								$delta[]          = $gain;
							}
						}

			// Bearish Sell
			if (($bearishbuy==1) && ($bearishsell < 1) && ($sellSignal==0) && (($exitNow==1) || ($kijun < $tenkan) || ($tenkan <= $low) ))
						{
						// We have a SELL signal
						$trade_signal   = 'Sell';
						$bearishbuy     = 0;
						$sellSignal     = 1;
						$sellSignalDate = $date;
						$gain           = round(((($low/$buyprice)-1)*100),1);
							if ($archive==1) {
								mysql_query("INSERT INTO myichi_virtual_portfolio (user_id, symbol, signal_date, trade_direction, trade_signal) VALUES ('$uID', '$yahoo_symbol', '$date', '$trade_direction', '$trade_signal') ");
							}
							else
							{
								$exitDate[]     = (strtotime($date) * 1000);
								$exitPrice[]      = $low;
								$tradeDirection[] = $trade_direction;
								$tradeSignal[]    = $trade_signal;
								$delta[]          = $gain;
							}

						}
	}

			// Before the next loop start we need to reset some variables
			$BullOpenSpace      = 0;
			$BearOpenSpace      = 0;
			$bullTenkanOK       = 0;
			$bullKijunOK        = 0;
			$bearTenkanOK       = 0;
			$bearKijunOK        = 0;

}
// We need to return the data back to the originating script
$tradeSignals = array(	entryDate=>$entryDate, 
						entryPrice=>$entryPrice, 
						exitDate=>$exitDate, 
						exitPrice=>$exitPrice, 
						tradeDirection=>$tradeDirection, 
						tradeSignal=>$tradeSignal, 
						delta=>$delta);


$end = date('H:i:s', time());
//echo "tradeSignals start: ".$start." tradeSignals end: ".$end;
}

?>