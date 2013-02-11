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


$user = new uFlex();
	$symbol    = $_REQUEST["yahoo_symbol"];
	$chartsize = $_REQUEST["chartsize"];
	$backtrade = $_REQUEST["backtrade"];
	$uID       = $user->data['user_id'];
	
	$query = mysql_query("SELECT yahoo_symbol, instrument_name FROM myichi_instrument_names WHERE yahoo_symbol='$symbol'");
	if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }
		
		$row = mysql_fetch_assoc($query);
		$instr_name = $row['instrument_name'];
		
			if ($row[yahoo_symbol] == '') {
			$emptysearch = 1;
			}
			else
			{
			// ----------------------------- First we go get the Ichimoku lines we will plot  -----------------------------
			
			$query = mysql_query("SELECT * FROM myichi_historical_data WHERE yahoo_symbol='$symbol' ORDER BY symbol_period ASC");
				if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }

				while ($row = mysql_fetch_assoc($query)) {

				$date            = (strtotime($row['date']) * 1000) + 86400000; // Not sure why, but need to add a day (+ 86400000)
				$volume          = $row['volume'];
				$tenkan_sen      = $row['tenkan_sen'];
				$kijun_sen       = $row['kijun_sen'];
				$senkou_span_a   = $row['senkou_span_a'];
				$senkou_span_b   = $row['senkou_span_b'];
				$chikou_span     = $row['chikou_span'];
				$ichimoku_signal = $row['ichimoku_signal'];
				
								
				$tenkan[]      = '[' . $date . ', ' . $tenkan_sen . ']';
				$kijun[]       = '[' . $date . ', ' . $kijun_sen . ']';
				$span_a[]      = '[' . $date . ', ' . $senkou_span_a . ']';
				$span_b[]      = '[' . $date . ', ' . $senkou_span_b . ']';
				$chikou[]      = '[' . $date . ', ' . $chikou_span . ']';
				$datavolume[]  = '[' . $date . ', ' . $volume . ']';
				$cloud[]       = '[' . $date . ', ' . $senkou_span_a . ', ' . $senkou_span_b . ']';
				$ichimoku[]    = '[' . $date . ', ' . $ichimoku_signal . ']';
				
				$json_tenkan   = "([" . implode(", ", array_values($tenkan)) . "])";
				$json_kijun    = "([" . implode(", ", array_values($kijun)) . "])";
				$json_span_a   = "([" . implode(", ", array_values($span_a)) . "])";
				$json_span_b   = "([" . implode(", ", array_values($span_b)) . "])";
				$json_chikou   = "([" . implode(", ", array_values($chikou)) . "])";
				$json_volume   = "([" . implode(", ", array_values($datavolume)) . "])";
				$json_cloud    = "([" . implode(", ", array_values($cloud)) . "])";
				$json_ichimoku = "([" . implode(", ", array_values($ichimoku)) . "])";
				}	
			
			// ------------------- Now we create the 5 Day Moving average for the MyIchimoku Signal  ---------------------
			
				$FiveDayAvgquery = mysql_query("SELECT 
									a.date, 
									Round(( SELECT SUM(b.ichimoku_signal) / COUNT(b.ichimoku_signal)
											FROM myichi_historical_data AS b 
											WHERE DATEDIFF(a.date, b.date) BETWEEN 0 AND 4
											AND  yahoo_symbol = '$symbol'
										  ), 1 ) AS 5dayMovingAvg 
								FROM myichi_historical_data AS a
								WHERE yahoo_symbol = '$symbol' 
								ORDER BY symbol_period ASC");
					if (!$FiveDayAvgquery) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
		
				while ($row = mysql_fetch_assoc($FiveDayAvgquery)) {
					$FiveDayAvgdate = (strtotime($row['date']) * 1000) + 86400000; // Not sure why, but need to add a day (+ 86400000)
					$FiveDayAvg     = ($row["5dayMovingAvg"]);
		
					$FiveDayAvgichimoku[]    = '[' . $FiveDayAvgdate . ', ' . $FiveDayAvg . ']';
		
					$json_FiveDayAvg_ichimoku = "([" . implode(", ", array_values($FiveDayAvgichimoku)) . "])";
				}
			
			// ----------------------------- Now we create the OHLC candlestick chart  --------------------------------
			
			$query = mysql_query("SELECT * FROM myichi_historical_data WHERE yahoo_symbol='$symbol' AND open >0 ORDER BY symbol_period ASC");
				if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }
				
				while ($row = mysql_fetch_assoc($query)) {
				$date          = (strtotime($row['date']) * 1000) + 86400000; // Not sure why, but need to add a day (+ 86400000)
				if ($row['open']  > 0) {$open  = $row['open'];}
				if ($row['high']  > 0) {$high  = $row['high'];}
				if ($row['low']   > 0) {$low   = $row['low'];}
				if ($row['close'] > 0) {$close = $row['close'];}
				
				$ohlc[]      = '[' . $date . ', ' . $open . ', ' . $high . ', ' . $low . ', ' . $close . ']';
				$json_ohlc   = "([" . implode(", ", array_values($ohlc)) . "])";
				}
			}
			

				
?>


