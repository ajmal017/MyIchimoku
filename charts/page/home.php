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
	$datagroup = $user->data['group_id'];

	if ($datagroup < 4) {$signalUID=1;} else {$signalUID=$uid;}
	
	$today  = date("Y-m-d");
	if(date("D")=='Sat') {$today = date("Y-m-d", strtotime("-1 day"));}
	if(date("D")=='Sun') {$today = date("Y-m-d", strtotime("-2 days"));}
	
	
	$minIchimokuSignal   = $user->data["min_ichimoku_signal"];

function favorites ($user,$today,$uid,$lang) { // *****************  Favorites function **************************************
		$favo_query = mysql_query("
		SELECT myichi_portfolio.ID, myichi_portfolio.symbol, myichi_portfolio.price_at_date_added, myichi_portfolio.type, myichi_instrument_names.instrument_name, 
		(
		SELECT close
		FROM myichi_historical_data
		WHERE yahoo_symbol = myichi_portfolio.symbol
		AND DATE =  '$today'
		AND close <>  'NULL'
		Limit 1
		) AS price, 
		(
		SELECT ichimoku_signal
		FROM myichi_historical_data
		WHERE yahoo_symbol = myichi_portfolio.symbol
		AND DATE =  '$today'
		AND close <>  'NULL'
		Limit 1
		) AS signal
		FROM myichi_portfolio
		LEFT JOIN myichi_instrument_names ON myichi_portfolio.symbol = myichi_instrument_names.yahoo_symbol
		WHERE myichi_portfolio.type =  'favorites'
		AND myichi_portfolio.user_id =  '$uid'");
			if (!$favo_query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }

	
	if (mysql_num_rows($favo_query)<1) { echo $lang['PORTFOLIO_FAVO_EMPTY'];} else {
echo "<table class='listtable'><caption>".$lang['PORTFOLIO_TITLE_FAV']."<br><a href='page/popup.php?type=favorites' target='_blank' title='".$lang['CHARTPOPUP_SHOWCHARTS_TITLE']."'><font style='font-size:8pt; font-weight:normal'>".$lang['CHARTPOPUP_SHOWCHARTS']."</font></a><br></caption>
<thead><tr>
<th scope='col' width='90'>".$lang['PORTFOLIO_SYMBOL']."</th>
<th scope='col' width='150'>".$lang['PORTFOLIO_INST_NAME']."</th>
<th scope='col' width='85'>".$lang['PORTFOLIO_ADD_PRICE']."</th>
<th scope='col' width='85'>".$lang['PORTFOLIO_CURR_PRICE']."</th>
<th scope='col' width='85' title='".$lang['SEARCHRESULTS_SIGNAL_INFO']."'>".$lang['PORTFOLIO_STRENGTH']."</th>

</tr>
</thead>
<tbody>";


				while ($row = mysql_fetch_assoc($favo_query)) {
					if ($rowclass==0) {$oddeven=''; $rowclass=1;} else {$oddeven="class='odd'"; $rowclass=0;}
				$symbol               = $row['symbol'];
				$instrumentname       = $row['instrument_name'];
				$price_at_date_added  = round($row['price_at_date_added'], 3);
				$pricenow             = round($row['price'], 3);
				$ichimokusignal       = $row['signal'];
				$id                   = $row['ID'];
$a++;
if ($price_at_date_added <= $pricenow) { $showPriceNow = "<font color='green'>".$pricenow."&uarr;</font>";} else {$showPriceNow = "<font color='red'>".$pricenow."&darr;</font>";} 
if ($pricenow==0) {$showPriceNow = "<center><font color='orange'>&infin;</font></center>"; $showGain="";}
echo"
<tr ".$oddeven.">
<td>".$symbol."</td>
<td>
<form method='post' action='?page=searchresult' id='my_form".$a."'>
<input type='hidden' name='yahoo_symbol' value='".$symbol."'>
<input type='hidden' name='chartsize' value='".$user->data['page_chartsize']."'>
<a href=\"javascript:{}\" onclick=\"document.getElementById('my_form".$a."').submit(); return false;\">".$instrumentname."</a>

</form>
</td>
<td>".$price_at_date_added."</td>
<!-- <td>".$showPriceNow."</td> -->
<td>
<ul class='drop-down-menu'>
		<li><a href=''>".$showPriceNow."</a>
			<ul>
                <li><a href='ps/portfolio_update.php?id=".$id."|type&value=portfolio'>".$lang['PORTFOLIO_MOVE_PORT']."</a></li>
                <li><a href='ps/portfolio_delete.php?id=".$id."' onclick=\"return window.confirm('".$lang['PORTFOLIO_ALERT_FAV_DELETE']."');\">".$lang['TRADINGPLAN_TP_REMOVE']."</a></li>
            </ul>
        </li>
    </ul>
</td>

<td><center>".$ichimokusignal."</center></td>
<tr>";


}	
echo"</tbody></table>";
}
}


function portfolio ($user,$today,$uid,$lang) { // *****************  Portfolio function **************************************

		$favo_query = mysql_query("
		SELECT myichi_portfolio.ID, myichi_portfolio.symbol, myichi_portfolio.quantity, myichi_portfolio.entry_price, myichi_portfolio.stoploss, myichi_portfolio.type, myichi_instrument_names.instrument_name, 
		(
		SELECT close
		FROM myichi_historical_data
		WHERE yahoo_symbol = myichi_portfolio.symbol
		AND DATE =  '$today'
		AND close <>  'NULL'
		) AS price, 
		(
		SELECT ichimoku_signal
		FROM myichi_historical_data
		WHERE yahoo_symbol = myichi_portfolio.symbol
		AND DATE =  '$today'
		AND close <>  'NULL'
		) AS signal
		FROM myichi_portfolio
		LEFT JOIN myichi_instrument_names ON myichi_portfolio.symbol = myichi_instrument_names.yahoo_symbol
		WHERE myichi_portfolio.type =  'portfolio'
		AND myichi_portfolio.user_id =  '$uid'");
			if (!$favo_query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }

	
	if (mysql_num_rows($favo_query)<1) { echo $lang['PORTFOLIO_PORT_EMPTY'];} else { 
	echo "
<table class='listtable'><caption>".$lang['PORTFOLIO_TITLE_PORT']."<br><a href='page/popup.php?type=portfolio' target='_blank' title='".$lang['CHARTPOPUP_SHOWCHARTS_TITLE']."'><font style='font-size:8pt; font-weight:normal'>".$lang['CHARTPOPUP_SHOWCHARTS']."</font></a><br></caption>
<thead><tr>
<th scope='col' width='90'>".$lang['PORTFOLIO_SYMBOL']."</th>
<th scope='col' width='150'>".$lang['PORTFOLIO_INST_NAME']."</th>
<th scope='col' width='85'>".$lang['PORTFOLIO_INVESTED']."</th>
<th scope='col' width='85'>".$lang['PORTFOLIO_ADD_PRICE']."</th>
<th scope='col' width='85'>".$lang['PORTFOLIO_STOPLOSS']."</th>
<th scope='col' width='85'>".$lang['PORTFOLIO_CURR_PRICE']."</th>
<th scope='col' width='85'>".$lang['PORTFOLIO_PLPERC']."</th>
<th scope='col' width='85' title='".$lang['SEARCHRESULTS_SIGNAL_INFO']."'>".$lang['PORTFOLIO_STRENGTH']."</th>

</tr>
</thead>
<tbody>";

				$rowclass=0;
				while ($row = mysql_fetch_assoc($favo_query)) {
					if ($rowclass==0) {$oddeven=''; $rowclass=1;} else {$oddeven='class="odd"'; $rowclass=0;}
				$symbol               = $row['symbol'];
				$instrumentname       = $row['instrument_name'];
				$invested             = $row['quantity'] * $row['entry_price'];
				$entry_price          = round($row['entry_price'], 3);
				$stoplossorder        = round($row['stoploss'], 2);
				$pricenow             = round($row['price'], 3);
					if ($entry_price==0) {$entry_price=$pricenow;}
				$gain                 = round(((($pricenow/$entry_price)-1)*100),2);
				$ichimokusignal       = $row['signal'];
				$id                   = $row['ID'];
if ($entry_price <= $pricenow) { $showPriceNow = "<font color='green'>".$pricenow."&uarr;</font>";} else {$showPriceNow = "<font color='red'>".$pricenow."&darr;</font>";}
if ($entry_price <= $pricenow) { $showGain     = "<font color='green'>".$gain."% &uarr;</font>";} else {$showGain = "<font color='red'>".abs($gain)."% &darr;</font>";}
if ($pricenow==0) {$showPriceNow = "<center><font color='orange'>&infin;</font></center>"; $showGain="";}

if ($entry_price < $stoplossorder) { $stoploss = "<font color='green'>".$stoplossorder." &#10003;</font>";} else {$stoploss = "<font color='orange'>".$stoplossorder."</font>";}

$a++;
echo "
<tr ".$oddeven.">
<td>".$symbol."</td>
<td>
<form method='post' action='?page=searchresult' id='my_form_b".$a."'>
<input type='hidden' name='yahoo_symbol' value='".$symbol."'>
<input type='hidden' name='chartsize' value='".$user->data['page_chartsize']."'>
<a href=\"javascript:{}\" onclick=\"document.getElementById('my_form_b".$a."').submit(); return false;\">".$instrumentname."</a>
</form>
</td>
<td>".$invested."</td>
<td>".$entry_price."</td>
<td>".$stoploss."</td>
<!-- <td>".$showPriceNow."</td> -->
<td>
<ul class='drop-down-menu'>
		<li><a href=''>".$showPriceNow."</a>
			<ul>
                <li><a href='ps/portfolio_delete.php?id=".$id."' onclick=\"return window.confirm('".$lang['PORTFOLIO_ALERT_FAV_DELETE']."');\">".$lang['TRADINGPLAN_TP_REMOVE']."</a></li>
            </ul>
        </li>
    </ul>
</td>
 
<td>".$showGain."</td>
<td><center>".$ichimokusignal."</center></td>
</tr>";

}	
echo"</tbody></table>";
}
}


function buysignals ($user,$today,$signalUID,$lang) { // *****************  Buy Signals function **************************************

$tradeDate=$user->data['trade_date'];
$minVolume=$user->data["min_volume_instrument"];

	if ($user->data['trade_direction']=='Bullish') {$tradeDirection="j.trade_direction='Bullish' ";}
	if ($user->data['trade_direction']=='Bearish') {$tradeDirection="j.trade_direction='Bearish' ";}
	if ($user->data['trade_direction']=='Both')    {$tradeDirection="(j.trade_direction='Bullish' OR j.trade_direction='Bearish') ";}

	$ichi_query = mysql_query("
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
		ORDER BY market ASC , trade_direction DESC , ichimoku_signal DESC");
				if (!$ichi_query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }

//		 if (mysql_num_rows($ichi_query)<1) { echo $lang['ICHI_SIGNAL_EMPTY'];} else { 
	echo "
<table class='listtable'>
<caption>".$lang['ICHI_TRADE_TITLE'].date('l M d',strtotime($tradeDate))."<br><a href='page/popup.php?type=buysignals' target='_blank' title='".$lang['CHARTPOPUP_SHOWCHARTS_TITLE']."'><font style='font-size:8pt; font-weight:normal'>".$lang['CHARTPOPUP_SHOWCHARTS']."</font></a><br></caption>
<thead><tr>
<th scope='col' width='90'>".$lang['PORTFOLIO_SYMBOL']."</th>
<th scope='col' width='150'>".$lang['PORTFOLIO_INST_NAME']."</th>
<th scope='col' width='85'>".$lang['ICHI_SIGNAL_STRENGTH']."</th>
<th scope='col' width='85'>".$lang['ICHI_SIGNAL_MARKET']."</th>
<th scope='col' width='85'>".$lang['ICHI_SIGNAL_DIRECTION']."</th>
<th scope='col' width='85'>".$lang['ICHI_SIGNAL_PRICE']."</th>
<th><img src='../charts/images/toggle-down.png' border='0' title='".$lang['PREFERENCES_BUTTON']."' id='clickMyIchiTradePreferences'></th>

</tr>
</thead>
<tbody>

<tr id='MyIchiTradePreferences'  class='expand'>
<td colspan='6'>
<table width='100%'>
<tr>
<td>".$lang['PREFERENCES_TRADE_DATE']."</td>
<td class='datepicker' id='trade_date' >".$user->data['trade_date']."</td>
<tr>
<tr class='odd'>
<td>".$lang['ICHI_TRADE_DIRECTION']."</td>
<td class='select_trade_direction' id='trade_direction' >".$user->data['trade_direction']."</td>
</tr>
<tr>
<td>".$lang['PREFERENCES_PAGE_REFRESH']."</td>
<td ><a href='/'><img src='../charts/images/refresh.png'></a></td>
</tr>


</table>
</td>
</tr>";
	 if (mysql_num_rows($ichi_query)<1) { echo "</table>".$lang['ICHI_SIGNAL_EMPTY'];} else {
		$rowclass=0;
				while ($row = mysql_fetch_assoc($ichi_query)) {
					if ($rowclass==0) {$oddeven=''; $rowclass=1;} else {$oddeven="class='odd'"; $rowclass=0;}
				$symbol               = $row['symbol'];
				$instrumentname       = $row['instrument_name'];
				$ichimokusignal       = $row['ichimoku_signal'];
				$market               = $row['market'];
				$direction            = $row['trade_direction'];
				$price                = round($row['close'], 2);

				$a++;
				
echo "<tr ".$oddeven.">
<td>".$symbol."</td>
<td>
<form method='post' action='?page=searchresult' id='my_form_c".$a."'>
<input type='hidden' name='yahoo_symbol' value='".$symbol."'>
<input type='hidden' name='chartsize' value='".$user->data['page_chartsize']."'>
<a href=\"javascript:{}\" onclick=\"document.getElementById('my_form_c".$a."').submit(); return false;\">".$instrumentname."</a>
</form>
</td>
<td><center>".$ichimokusignal."</center></td>
<td><center>".$market."</center></td>
<td><center>".$direction."</center></td>
<!--<td>".$price."</td>-->

<td>
<ul class='drop-down-menu'>
		<li><a href=''>".$price."</a>
			<ul>
                <li><a href='ps/portfolio_add.php?yahoo_symbol=".$symbol."&added_price=".$price."&type=favorites&action=add'>".$lang['SEARCHRESULTS_ADD_FAVORITES']."</a></li>
                <li><a href='ps/portfolio_add.php?yahoo_symbol=".$symbol."&added_price=".$price."&type=portfolio&action=add'>".$lang['SEARCHRESULTS_ADD_PORTFOLIO']."</a></li>
            </ul>
        </li>
    </ul>
</td>

</tr>";

}	

echo"</table>";




 
}
$javacomment[] = "  $('#MyIchiTradePreferences').hide();
			 $('#".$ID."clickMyIchiTradePreferences').click(function() {
			 $('#MyIchiTradePreferences').toggle();
			 }); ";
$javacommentcode = implode('', array_values($javacomment));
echo " <script>".$javacommentcode."</script>";
}


function cloudbreaks ($user,$today,$uid,$lang) { // *****************  Cloud Break function **************************************

$minVolume=$user->data["min_volume_instrument"];

	if ($user->data['trade_direction']=='Bullish') {$tradeDirection="AND ichimoku_signal > 0 ";}
	if ($user->data['trade_direction']=='Bearish') {$tradeDirection="AND ichimoku_signal < 0 ";}
	if ($user->data['trade_direction']=='Both')    {$tradeDirection=" ";}

	$minCloudBreak = $user->data["min_cloudbreak_signal"];
	$cloud_query = mysql_query("
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
			ORDER BY market ASC, cloudbreak DESC, `h`.`cloudbreak_strenght` DESC");
				if (!$cloud_query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }

	if (mysql_num_rows($cloud_query)<1) { echo $lang['ICHI_CLOUD_EMPTY'];} else { 
	echo "
<table class='listtable'><caption>".$lang['ICHI_CLOUD_TITLE']."<br><a href='page/popup.php?type=cloudbreak' target='_blank' title='".$lang['CHARTPOPUP_SHOWCHARTS_TITLE']."'><font style='font-size:8pt; font-weight:normal'>".$lang['CHARTPOPUP_SHOWCHARTS']."</font></a><br></caption>
<thead><tr>
<th scope='col' width='90'>".$lang['PORTFOLIO_SYMBOL']."</th>
<th scope='col' width='150'>".$lang['PORTFOLIO_INST_NAME']."</th>
<th scope='col' width='85'>".$lang['ICHI_SIGNAL_PRICE']."</th>
<th scope='col' width='85'>".$lang['ICHI_SIGNAL_MARKET']."</th>
<th scope='col' width='85' title='".$lang['SEARCHRESULTS_SIGNAL_INFO']."'>".$lang['ICHI_SIGNAL_STRENGTH']."</th>
<th scope='col' width='85'>".$lang['ICHI_CLOUD_STRENGTH']."</th>
<th scope='col' width='85'>".$lang['ICHI_CLOUD_NUMDAYS']."</th>
<th><img src='../charts/images/toggle-down.png' border='0' title='".$lang['PREFERENCES_BUTTON']."' id='clickCloudBreakPreferences'></th>

</tr>
</thead>
<tbody>
<tr id='CloudBreakPreferences'>
<td colspan='6'>
<table ><tr>
<td>".$lang['PREFERENCES_MIN_CLOUDBRVALUE_B']."</td>
<td class='select_cloudbreak_signal' id='min_cloudbreak_signal'>".$user->data['min_cloudbreak_signal']."</td>
<td>&nbsp&nbsp&nbsp<a href='/'><img src='../charts/images/refresh.png'></a></td>
</tr></table>
</td>
</tr>";

				$rowclass=0;
				$bulltd=0;
				while ($row = mysql_fetch_assoc($cloud_query)) {
					if ($rowclass==0) {$oddeven=''; $rowclass=1;} else {$oddeven="class='odd''"; $rowclass=0;}
				$symbol               = $row['symbol'];
				$instrumentname       = $row['instrument_name'];
				$market               = $row['market'];
				$price                = round($row['close'], 2);
				$cloudbreak           = $row['cloudbreak'];
				$ichimokusignal       = $row['ichimoku_signal'];
				$cloudbreak_strenght  = $row['cloudbreak_strenght'];
					if ($cloudbreak_strenght > 0) {$bullcloud++;} else {$bearcloud++;}
$a++;
echo "<tr ".$oddeven.">

<td>".$symbol."</td>
<td>
<form method='post' action='?page=searchresult' id='my_form_d".$a."'>
<input type='hidden' name='yahoo_symbol' value='".$symbol."'>
<input type='hidden' name='chartsize' value='".$user->data['page_chartsize']."'>
<a href=\"javascript:{}\" onclick=\"document.getElementById('my_form_d".$a."').submit(); return false;\">".$instrumentname."</a>
</form>

</td>
<!--<td>".$price."</td>-->

<td>
<ul class='drop-down-menu'>
		<li><a href='' onmouseover=\"myTimer=setTimeout('timedCount()', 1000);\" onmouseout=\"clearTimeout(myTimer);\">".$price."</a>
			<ul>
                <li><a href='ps/portfolio_add.php?yahoo_symbol=".$symbol."&added_price=".$price."&type=favorites&action=add'>".$lang['SEARCHRESULTS_ADD_FAVORITES']."</a></li>
                <li><a href='ps/portfolio_add.php?yahoo_symbol=".$symbol."&added_price=".$price."&type=portfolio&action=add'>".$lang['SEARCHRESULTS_ADD_PORTFOLIO']."</a></li>
            </ul>
        </li>
    </ul>
</td>
<td><center>".$market."</center></td>
<td><center>".$ichimokusignal."</center></td>
<td><center>".$cloudbreak_strenght."</center></td>
<td><center>".$cloudbreak."</center></td>
</tr>";
	
}

echo"</table>";

$javacloud[] = "  $('#CloudBreakPreferences').hide();
			 $('#".$ID."clickCloudBreakPreferences').click(function() {
			 $('#CloudBreakPreferences').toggle();
			 }); ";
$javacloudcode = implode('', array_values($javacloud));
echo " <script>".$javacloudcode."</script>";



}
}

function strongIchiSignals ($user,$today,$uid,$minIchimokuSignal,$lang) { // *****************  Strong Ichimoku Signals function **************************************

$minVolume=$user->data["min_volume_instrument"];
	if ($user->data['trade_direction']=='Bullish') {$tradeDirection="AND ichimoku_signal > 0 ";}
	if ($user->data['trade_direction']=='Bearish') {$tradeDirection="AND ichimoku_signal < 0 ";}
	if ($user->data['trade_direction']=='Both')    {$tradeDirection=" ";}
	
$ichi_query = mysql_query("
			SELECT i.yahoo_symbol AS symbol, instrument_name, market, close, ichimoku_signal
			FROM myichi_historical_data AS h
			LEFT JOIN myichi_instrument_names AS i ON h.yahoo_symbol = i.yahoo_symbol
			WHERE (ichimoku_signal >= '$minIchimokuSignal' OR ichimoku_signal <= -'$minIchimokuSignal')
			AND DATE =  '$today'
			AND average_volume > '$minVolume'
			$tradeDirection
			ORDER BY market ASC, ichimoku_signal DESC ");
				if (!$ichi_query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }

	if (mysql_num_rows($ichi_query)<1) { echo $lang['PORTFOLIO_FAVO_EMPTY'];} else { ?>
<table class="listtable"><caption><?php echo $lang['ICHI_SIGNAL_TITLE']; ?><br><a href='page/popup.php?type=screening&volume=50k&market=ALL&signal=<?php echo $minIchimokuSignal; ?>&date=<?php echo $today; ?>' target='_blank' title='<?php echo $lang['CHARTPOPUP_SHOWCHARTS_TITLE']; ?>'><font style='font-size:8pt; font-weight:normal'><?php echo $lang['CHARTPOPUP_SHOWCHARTS']; ?></font></a><br></caption>
<thead><tr>
<th scope="col" width="90"><?php echo $lang['PORTFOLIO_SYMBOL']; ?></th>
<th scope="col" width="150"><?php echo $lang['PORTFOLIO_INST_NAME']; ?></th>
<th scope="col" width="85"><?php echo $lang['ICHI_SIGNAL_PRICE']; ?></th>
<th scope="col" width="85"><?php echo $lang['ICHI_SIGNAL_MARKET']; ?></th>
<th scope="col" width="85" title="<?php echo $lang['SEARCHRESULTS_SIGNAL_INFO']; ?>"><?php echo $lang['ICHI_SIGNAL_STRENGTH']; ?></th>
<th><img src="../charts/images/toggle-down.png" border="0" title="<?php echo $lang['PREFERENCES_BUTTON']; ?>" id="clickMyIchiPreferences"></th>

</tr>
</thead>
<tbody>

<tr id='MyIchiPreferences'>
<td colspan='6'>
<table ><tr>
<td><?php echo $lang['PREFERENCES_MIN_ICHIVALUE_B']; ?></td>
<td class='select_min_ichimoku_signal' id='min_ichimoku_signal' ><?php echo $user->data['min_ichimoku_signal']; ?></td><td></td>
</tr></table>
</td>
</tr>
<?php
				$rowclass=0;
				while ($row = mysql_fetch_assoc($ichi_query)) {
					if ($rowclass==0) {$oddeven=''; $rowclass=1;} else {$oddeven='class="odd"'; $rowclass=0;}
				$symbol               = $row['symbol'];
				$instrumentname       = $row['instrument_name'];
				$market               = $row['market'];
				$price                = round($row['close'], 2);
				$ichimokusignal       = $row['ichimoku_signal'];
?>
<tr <?php echo $oddeven; ?>>
<td><?php echo $symbol; ?></td>
<td><a href="index.php?page=searchresult&yahoo_symbol=<?php echo $symbol; ?>&chartsize=<?php echo $user->data['page_chartsize']; ?>"><?php echo $instrumentname; ?></a></td>
<td><?php echo $price; ?></td>
<td><center><?php echo $market; ?></center></td>
<td><center><?php echo $ichimokusignal; ?></center></td>
</tr>



<?php
}	
?>

</table>
<?php
$javacomment[] = "  $('#MyIchiPreferences').hide();
			 $('#".$ID."clickMyIchiPreferences').click(function() {
			 $('#MyIchiPreferences').toggle();
			 }); ";
$javacommentcode = implode('', array_values($javacomment));
echo " <script>".$javacommentcode."</script>";

}
}
//  ********************************************  End of Functions  *************************************
	
?>
<img src="images/user.png" border="0" title="<?php echo $user->data['firstname'] ." ". $user->data['lastname']; ?>"></img>
<br><br>
<table>
<tr> <?php // The table below shows the latest updates of YQL data to the database ?>
<td width="25"></td>
<td>
	<table class="listtable">
		<thead>
		<th scope="col" width="200"><?php echo $lang['LATEST_UPDATE_TITLE']; ?></th>
		<th scope="col" width="100"><?php echo $lang['LATEST_UPDATE_DATE']; ?></th>
		<th scope="col" width="100"><?php echo $lang['LATEST_UPDATE_TIME']; ?></th>
		<th scope="col" width="100"><?php echo $lang['LATEST_UPDATE_RECORDS']; ?></th>
		</thead>
		<tbody>
			<?php  //show data from table
				$query = mysql_query ("SELECT * FROM myichi_tracker_report WHERE script='Intraday' ORDER BY ID DESC LIMIT 1");
				$resultEuro   = mysql_fetch_assoc($query);
				$dateEuro     = ($resultEuro["date"]);
				$endEuro      = ($resultEuro["end"]);
				$recordsEuro  = ($resultEuro["records"]);
			?>
		<tr>
			<td><?php echo $lang['LATEST_UPDATE_EURO']; ?></td>
			<td><?php echo date("D, d-M", strtotime($dateEuro));?></td>
			<td><?php echo $endEuro;?></td>
			<td><?php echo $recordsEuro;?></td>
		</tr>
		
			<?php  //show data from table
				$query = mysql_query ("SELECT * FROM myichi_tracker_report WHERE script='Intraday_USA' ORDER BY ID DESC LIMIT 1");
				$resultUSA    = mysql_fetch_assoc($query);
				$dateUSA      = ($resultUSA["date"]);
				$endUSA       = ($resultUSA["end"]);
				$recordsUSA   = ($resultUSA["records"]);
			?>
		<tr class="odd">
			<td><?php echo $lang['LATEST_UPDATE_USA']; ?></td>
			<td><?php echo date("D, d-M", strtotime($dateUSA));?></td>
			<td><?php echo $endUSA;?></td>
			<td><?php echo $recordsUSA;?></td>
		</tr>
		
			<?php  //show data from table
				$query = mysql_query ("SELECT * FROM myichi_tracker_report WHERE script='Intraday_FOREX' ORDER BY ID DESC LIMIT 1");
				$resultForex  = mysql_fetch_assoc($query);
				$dateForex    = ($resultForex["date"]);
				$endForex     = ($resultForex["end"]);
				$recordsForex = ($resultForex["records"]);
			?>
		<tr>
			<td><?php echo $lang['LATEST_UPDATE_FOREX']; ?></td>
			<td><?php echo date("D, d-M", strtotime($dateForex));?></td>
			<td><?php echo $endForex;?></td>
			<td><?php echo $recordsForex;?></td>
		</tr>
		

		</tbody>
		</table>
</td>
</tr>
</table>

	<?php  	
	echo "
	<br><br><br>
	<table>
	<tr>
	<td  width='25'></td>
	<td  width='500'>
		<table>
		<tr><td>";
			buysignals ($user,$today,$signalUID,$lang);
			echo "<br><br>";
			cloudbreaks ($user,$today,$uid,$lang);
			echo "<br><br>";
			strongIchiSignals ($user,$today,$uid,$minIchimokuSignal,$lang);

	echo "
		</td></tr>
		</table>
	</td>
	<td  width='50'></td>
	<td>
		<table>
		<tr><td>";	
			portfolio ($user,$today,$uid,$lang);
			echo "<br><br>";
			favorites ($user,$today,$uid,$lang);
	echo "
		</td></tr>
		</table>
	</td>
	</tr>
	</table>
	<br><br>";


//  -----------------------------------------  End of the Home page for loged-in users  ---------------------------------


//  -------------------------------  Below this line start the home page for non loged-in users  ------------------------	
}
else {echo "<br><center>You need to be logged in...<br><br><br><br>
<a href='../cms/'>
<img src='images/front/ichimoku-example.PNG' alt='MyIchimoku Screenshot' width='60%' >
</a>

</center><br><br>";}
	?>
	
