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
$uid    = $user->data['user_id'];
$yql_base_url = "http://query.yahooapis.com/v1/public/yql";
$today = date("Y-m-d");

// Get the latest database update timestamp
	$query = mysql_query ("SELECT * FROM myichi_tracker_report WHERE script='Intraday' ORDER BY ID DESC LIMIT 1 ");
	$latest = mysql_fetch_row($query);
	
// ---------------------- Favorites  -----------------------

// Get the list of Yahoo_symbols, convert them into a YQL useable string and query Yahoo for data.
// Doing this first limits the number of YQL queries and speeds up the querying/page process at he same time.
		$list=null;
		$favo_phpObj=null;
		$query = mysql_query ("SELECT symbol FROM myichi_portfolio WHERE type='favorites' AND user_id='$uid' ") or die ('Erreur de requête<br />'.$sql.'<br />'.mysql_error());
		
		if (mysql_num_rows($query)<1) { $favoritesnoshow=1;} else {
			if (mysql_num_rows($query)==1) {$symbolList = "'".mysql_result($query, 0)."'"; $multiF="0";}
				else
				{
					while($row  = mysql_fetch_row($query)) {
						$list[] = $row[0];
				}
				$symbolList     = "'" . implode("', '", array_values($list)) . "'";
				$multiF="1";
		}}
		$yql_query      = "select * from yahoo.finance.quotes where symbol in ($symbolList)";
		$yql_query_url  = $yql_base_url . "?q=" . urlencode($yql_query) . "&env=store://datatables.org/alltableswithkeys&format=json";
		$session        = curl_init($yql_query_url);
		curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
		$json           = curl_exec($session);
		$favo_phpObj    = json_decode($json);
//var_dump ($favo_phpObj);
// Get the list of favorites, mix with the YQL data into a 'Data Table' useable ajax string and write it to an ajax file
			$favo_query = mysql_query("SELECT myichi_portfolio.ID, myichi_portfolio.symbol, myichi_portfolio.date_added, myichi_portfolio.price_at_date_added, myichi_portfolio.type, myichi_portfolio.comments, myichi_portfolio.keynotes, myichi_instrument_names.instrument_name  FROM myichi_portfolio LEFT JOIN myichi_instrument_names ON myichi_portfolio.symbol=myichi_instrument_names.yahoo_symbol WHERE myichi_portfolio.type='favorites' AND myichi_portfolio.user_id='$uid'");
				if (!$favo_query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }
				
	
// ---------------------- Portfolio  -----------------------
// Get the list of Yahoo_symbols, convert them into a YQL useable string and query Yahoo for data.
// Doing this first limits the number of YQL queries and speeds up the querying/page process at he same time.
		$query = mysql_query ("SELECT symbol FROM myichi_portfolio WHERE type='portfolio' AND user_id='$uid' ") or die ('Erreur de requête<br />'.$sql.'<br />'.mysql_error());

		if (mysql_num_rows($query)<1) { $portfolionoshow=1;} else {
			if (mysql_num_rows($query)==1) {$symbolListP = "'".mysql_result($query, 0)."'"; $multiP="0";}
				else
				{
					while($row  = mysql_fetch_row($query)) {
						$listP[] = $row[0];
				}
				$symbolListP     = "'" . implode("', '", array_values($listP)) . "'";
				$multiP="1";
		}}
		$yql_query      = "select * from yahoo.finance.quotes where symbol in ($symbolListP)";
		$yql_query_url  = $yql_base_url . "?q=" . urlencode($yql_query) . "&env=store://datatables.org/alltableswithkeys&format=json";
		$session        = curl_init($yql_query_url);
		curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
		$json           = curl_exec($session);
		$portf_phpObj   = json_decode($json);

// Get the list of portfolio items, mix with the YQL data 
			$portf_query = mysql_query("SELECT myichi_portfolio.ID, myichi_portfolio.symbol, myichi_portfolio.entry_date, myichi_portfolio.entry_price, myichi_portfolio.quantity, myichi_portfolio.invested, myichi_portfolio.stoploss, myichi_portfolio.exit_date, myichi_portfolio.exit_price, myichi_portfolio.commision, myichi_portfolio.comments, myichi_portfolio.keynotes, myichi_portfolio.type, myichi_instrument_names.instrument_name  FROM myichi_portfolio LEFT JOIN myichi_instrument_names ON myichi_portfolio.symbol=myichi_instrument_names.yahoo_symbol WHERE myichi_portfolio.type='portfolio' AND myichi_portfolio.user_id='$uid'");
				if (!$portf_query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }


// ---------------------- History  -----------------------
// No need for any YQL data here
			$histo_query = mysql_query("SELECT myichi_portfolio.ID, myichi_portfolio.symbol, myichi_portfolio.entry_date, myichi_portfolio.entry_price, myichi_portfolio.quantity, myichi_portfolio.invested, myichi_portfolio.stoploss, myichi_portfolio.exit_date, myichi_portfolio.exit_price, myichi_portfolio.commision, myichi_portfolio.comments, myichi_portfolio.keynotes, myichi_portfolio.type, myichi_instrument_names.instrument_name  
										FROM myichi_portfolio 
										LEFT JOIN myichi_instrument_names ON myichi_portfolio.symbol=myichi_instrument_names.yahoo_symbol 
										WHERE myichi_portfolio.type='history' 
										AND myichi_portfolio.user_id='$uid'
										ORDER BY myichi_portfolio.entry_date DESC");
				if (!$histo_query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error();	exit; }
			if (mysql_num_rows($histo_query)<1) { $historynoshow=1;}
				
include ("templates/portfolio.html");

}
else
{
echo '<center><br><br><br>'.$lang['ERROR_LOGGED_OUT'].'</center><br><br><br><br><br>';
}

?>