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



if($user->signed){
$uid       = $user->data['user_id'];
$culumns   = $user->data['popup_columns'];
$chartsize = $user->data['popup_chartsize'];
$datagroup = $user->data['group_id'];
if ($datagroup < 4) {$signalUID=1;} else {$signalUID=$uid;}
$today = date("Y-m-d");

$cloudBreakDate = date("Y-m-d", strtotime("yesterday"));


if ((date("l") == 'Saturday') OR (date("l") == 'Sunday'))  {$today = $latest[2];} 

if ($type=='screening') {
// Get the list of instruments with a medium to strong Ichimoku signal
	$signal = $_REQUEST["signal"];
				
	$volume   = $_REQUEST["volume"];
		if ($volume == '500k') {$volume = " AND average_volume >= '500000' ";}
		if ($volume == '100k') {$volume = " AND average_volume >= '100000' ";}
		if ($volume == '50k')  {$volume = " AND average_volume >= '50000'  ";}
		if ($volume == '10k')  {$volume = " AND average_volume < '50000'  ";}
		if ($volume == 'any')  {$volume = " AND average_volume >= '500' ";}

	$market   = $_REQUEST["market"];
		if ($market =='ALL')      {$market = "";}
		if ($market =='AMS')      {$market = " AND market='AMS'   ";}
		if ($market =='PAR')      {$market = " AND market='PAR'   ";}
		if ($market =='LIS')      {$market = " AND market='LIS'   ";}
		if ($market =='BRU')      {$market = " AND market='BRU'   ";}
		if ($market =='EUROPE')   {$market = " AND market IN ('AMS',  'BRU',  'LIS',  'PAR')   ";}
		if ($market =='USA')      {$market = " AND market='USA'   ";}
		if ($market =='FOREX')    {$market = " AND market='FOREX' "; $volume="";}
		
	$date     = $_REQUEST["date"];
	
	$query = mysql_query("SELECT h.yahoo_symbol AS symbol 
									FROM myichi_historical_data AS h LEFT JOIN myichi_instrument_names AS i ON h.yahoo_symbol=i.yahoo_symbol  
									WHERE ichimoku_signal='" .$signal."'". 
									$volume. 
									$market. "
									AND date='$date' 
									ORDER BY ichimoku_signal DESC");
		if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }
}
elseif
($type=='cloudbreak') {
	
	$minVolume=$user->data["min_volume_instrument"];

	if ($user->data['trade_direction']=='Bullish') {$tradeDirection="AND ichimoku_signal > 0 ";}
	if ($user->data['trade_direction']=='Bearish') {$tradeDirection="AND ichimoku_signal < 0 ";}
	if ($user->data['trade_direction']=='Both')    {$tradeDirection=" ";}

	$minCloudBreak = $user->data["min_cloudbreak_signal"];
	$query = mysql_query("
			SELECT i.yahoo_symbol AS symbol, instrument_name, market, close, ichimoku_signal, ABS(cloudbreak) AS cloudbreak, cloudbreak_strenght
			FROM myichi_historical_data AS h
			LEFT JOIN myichi_instrument_names AS i ON h.yahoo_symbol = i.yahoo_symbol
			WHERE
				(
				ABS(cloudbreak_strenght) >= '$minCloudBreak'
				AND ABS(cloudbreak) >= '2'
				AND ABS(cloudbreak) <= '10'
				)
			AND symbol_period >50
			$tradeDirection
			AND average_volume > '$minVolume'
			AND volume > '$minVolume'
			AND DATE = '$today'
			ORDER BY market ASC, cloudbreak DESC, h.cloudbreak_strenght DESC")
				or die ('Erreur de requête<br />'.$sql.'<br />'.mysql_error());
				//if (!$cloud_query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }
	
	}

elseif
($type=='buysignals') {
	
	$tradeDate=$user->data['trade_date'];
	$minVolume=$user->data["min_volume_instrument"];

	if ($user->data['trade_direction']=='Bullish') {$tradeDirection="j.trade_direction='Bullish' ";}
	if ($user->data['trade_direction']=='Bearish') {$tradeDirection="j.trade_direction='Bearish' ";}
	if ($user->data['trade_direction']=='Both')    {$tradeDirection="(j.trade_direction='Bullish' OR j.trade_direction='Bearish') ";}
	
	$query = mysql_query("
		SELECT i.yahoo_symbol AS symbol, instrument_name, market, h.ichimoku_signal AS ichimoku_signal, j.trade_direction AS trade_direction, j.signal_date AS signalDate, h.close AS close
		FROM myichi_historical_data AS h
		LEFT JOIN myichi_instrument_names AS i ON h.yahoo_symbol = i.yahoo_symbol
		LEFT JOIN myichi_user_signals AS j ON h.yahoo_symbol = j.yahoo_symbol
		WHERE j.signal_date =  '$tradeDate'
		AND h.date =  '$tradeDate'
		AND j.user_id =  '$signalUID'
		AND $tradeDirection
		AND j.trade_signal =  'Buy'
		AND h.average_volume >  '$minVolume'
		GROUP BY j.yahoo_symbol
		ORDER BY market ASC , trade_direction DESC , ichimoku_signal DESC  LIMIT 0,20") or die ('Erreur de requête<br />'.$sql.'<br />'.mysql_error());

	}
	
else
{
$query = mysql_query("SELECT symbol FROM myichi_portfolio WHERE user_id='$uid' AND type='$type' ") or die ('Erreur de requête<br />'.$sql.'<br />'.mysql_error());
}


echo $signal . $market . $volume . $date;
echo '<center><table><tr>';
$c=0;

while ($row = mysql_fetch_assoc($query)) {

	echo '<td width"' .($tdwidth+30). '">';
	echo '<iframe src="../ps/portfolio_chart.php?yahoo_symbol=' .$row[symbol].'&chartsize='.$chartsize.'" height="700" width="' .($chartsize+30). '" frameborder="0"></iframe></td>';
		$c++;
		if ($c >= $culumns) {echo '</tr><tr>'; $c=0;}

}
echo '</tr></table></center>';


}
else
{
echo '<center>'.$lang['ERROR_LOGGED_OUT'].'</center>';
}

?>


