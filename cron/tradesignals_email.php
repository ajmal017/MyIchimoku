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
include("/homez.31/domainese/myichimoku/charts/config.php");

//$uID=1;

// Verify if we are in the week-end. If so, exit
		if ((date("l") == 'Saturday') OR (date("l") == 'Sunday'))  {exit();}

		$query = mysql_query("SELECT user_id
							  FROM myichi_users
							  WHERE daily_trade_signals = 'yes'
							  ORDER BY user_id ASC") or die ('Erreur de requête<br>'.$query.'<br>'.mysql_error());

		if (mysql_num_rows($query)<1) { echo "No users in Database??";} 
			else {
				while ($row = mysql_fetch_assoc($query)) {
				tradeSignalsEmail($row['user_id'],$fromEmail,$root_url,$copyright);
				}
			}
// -------------------------------------------- Send Email  ------------------------------------------------------------
function tradeSignalsEmail($uID,$fromEmail,$root_url,$copyright)
{
	require('/homez.31/domainese/myichimoku/charts/includes/includes.php');
	
// Get the uID email details and prepare the mail
	$query = mysql_query("SELECT * FROM myichi_users WHERE user_id = '$uID' ");
		if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }			
		$row       = mysql_fetch_assoc($query);
		$to        = ($row["email"]);
		$lang      = ($row["language"]);
			include_once($root_path . '/homez.31/domainese/myichimoku/charts/language/'.$lang.'.php');
		$fname     = ($row["firstname"]);
		$user      = ($row["username"]);
			if ($fname=='') {$fname = $user;}
		$content   = ($row["mail_content"]);
		$tradeDate = ($row["trade_date"]);
		$minVolume = ($row["min_volume_instrument"]);
		$trade_dir = ($row["trade_direction"]);
		$chartsize = ($row["page_chartsize"]);

// Get the data
if ($trade_dir=='Bullish') {$tradeDirection="j.trade_direction='Bullish' ";}
if ($trade_dir=='Bearish') {$tradeDirection="j.trade_direction='Bearish' ";}
if ($trade_dir=='Both')    {$tradeDirection="(j.trade_direction='Bullish' OR j.trade_direction='Bearish') ";}

$ichi_query = mysql_query("
SELECT i.yahoo_symbol AS symbol, instrument_name, market, h.ichimoku_signal AS ichimoku_signal, j.trade_direction AS trade_direction, j.signal_date AS signalDate, h.close AS close
FROM myichi_historical_data AS h
LEFT JOIN myichi_instrument_names AS i ON h.yahoo_symbol = i.yahoo_symbol
LEFT JOIN myichi_user_signals AS j ON h.yahoo_symbol = j.yahoo_symbol
WHERE j.signal_date =  '$tradeDate'
AND h.date =  '$tradeDate'
AND j.user_id =  '$uID'
AND $tradeDirection
AND j.trade_signal =  'Buy'
AND h.average_volume >  '$minVolume'
GROUP BY j.yahoo_symbol
ORDER BY market ASC , trade_direction DESC , ichimoku_signal DESC");
				if (!$ichi_query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }

//		 if (mysql_num_rows($ichi_query)<1) { echo $lang['PORTFOLIO_FAVO_EMPTY'];} else { 
$reportHeader.="
<table class='listtable'>
<caption style='font-weight: bold; font-size: 10pt; color:#636363; text-align: left; margin: 0; padding: 0.5em 0.25em;'>".$lang['ICHI_TRADE_TITLE'].date("l M d",strtotime($tradeDate))." 
&nbsp&nbsp&nbsp&nbsp&nbsp  <a style='color: #09f; text-decoration: none; border-bottom: 0px solid;' href='http://MyIchimoku.eu/charts/page/popup.php?type=buysignals&source=email' title='".$lang['CHARTPOPUP_SHOWCHARTS_TITLE']."'><font style='font-size:8pt; font-weight:normal'>".$lang['CHARTPOPUP_SHOWCHARTS']."</font></a><br>
<br></caption>
<thead><tr>
<th scope='col' width='90' style='border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: left; border-bottom: 0.2em solid #09f;'>".$lang['PORTFOLIO_SYMBOL']."</th>
<th scope='col' width='150' style='border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: left; border-bottom: 0.2em solid #09f;'>".$lang['PORTFOLIO_INST_NAME']."</th>
<th scope='col' width='85' style='border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: center; border-bottom: 0.2em solid #09f;'>".$lang['ICHI_SIGNAL_STRENGTH']."</th>
<th scope='col' width='85' style='border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: center; border-bottom: 0.2em solid #09f;'>".$lang['ICHI_SIGNAL_MARKET']."</th>
<th scope='col' width='85' style='border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: center; border-bottom: 0.2em solid #09f;'>".$lang['ICHI_SIGNAL_DIRECTION']."</th>
<th scope='col' width='85' style='border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: left; border-bottom: 0.2em solid #09f;'>".$lang['ICHI_SIGNAL_PRICE']."</th>
</tr>
</thead>
<tbody>	";	


				$rowclass=0;
				while ($row = mysql_fetch_assoc($ichi_query)) {
					if ($rowclass==0) {$oddeven=''; $rowclass=1;} else {$oddeven="style='border-color: #E8E8E8; background: #F8F8F'"; $rowclass=0;}
				$symbol               = $row['symbol'];
				$instrumentname       = $row['instrument_name'];
				$ichimokusignal       = $row['ichimoku_signal'];
				$market               = $row['market'];
				$direction            = $row['trade_direction'];
				$price                = round($row['close'], 2);
$a++;
$reportContent .='
<tr '.$oddeven.'>
<td style="text-align: left; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;">'.$symbol.'</td>
<td style="text-align: left; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;">
<a style="color: #09f; text-decoration: none; border-bottom: 0px solid;" href="http://MyIchimoku.eu/charts/?page=searchresult&yahoo_symbol='.$symbol.'&chartsize='.$chartsize.'&source=email">'.$instrumentname.'</a></td>
<td style="text-align: center; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;"><center>'.$ichimokusignal.'</center></td>
<td style="text-align: center; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;"><center>'.$market.'</center></td>
<td style="text-align: center; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;"><center>'.$direction.'</center></td>
<td style="text-align: left; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;">'.$price.'</td>

</tr>';
		}
		
		
		$body.= '<html><body>
				<center>
				<table width="80%"><tbody>
				<tr><td>
				<font style="font: Verdana, Helvetica, sans-serif; color:#636363;font-size: 10pt;">' . $lang['ACCOUNT_ACTIVATED_HI'] . ' ' . $fname .',<br><br></font>
				'.
				$reportHeader.
				$reportContent.'
				</table>
				</td></tr>
				</table>
				</center>
				<br><br><br>' .
				$emailFooter .
				'</body></html>';
	 
		$subject   = $lang['ICHI_TRADE_TITLE'].date("l M d",strtotime($tradeDate));
	 
		$headers = 'From: ' . $fromEmail .'' . "\r\n" .
		'Reply-To: no-reply@MyIchimoku.eu' . "\r\n" .
		'MIME-Version: 1.0' . "\r\n" .
		'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $body, $headers);
		
		echo $subject."\n";
		//echo $body."\n";
		//echo $headers."\n";
		echo "Mail sent to: ".$to."\n";
}
//  --------------------------------------------------------------------------------------------------------------------
?>