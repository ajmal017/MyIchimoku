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
if($user->signed){
$yql_query = "select * from yahoo.finance.quotes where symbol = '$symbol' ";
$yql_base_url = "http://query.yahooapis.com/v1/public/yql";
$yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query) . "&env=store://datatables.org/alltableswithkeys&format=json";

// Make call with cURL
  $session = curl_init($yql_query_url);
  curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
  $json = curl_exec($session);
  
// Convert JSON to PHP object 
  $phpObj =  json_decode($json);

// Uncomment to show the details
  /*
echo "<pre>";
print_r($phpObj);
echo "</pre>"; */

$searchSymbolSymbol                    = $phpObj->query->results->quote->symbol;
$searchSymbolName                      = $phpObj->query->results->quote->Name;
$searchSymbolPrice                     = $phpObj->query->results->quote->LastTradePriceOnly;
$searchSymbolExchange                  = $phpObj->query->results->quote->StockExchange;
$searchSymbolYearLow                   = $phpObj->query->results->quote->YearLow;
$searchSymbolYearHigh                  = $phpObj->query->results->quote->YearHigh;
$searchSymbolEBITDA                    = $phpObj->query->results->quote->EBITDA;
$searchSymbolAverageDailyVolume        = $phpObj->query->results->quote->AverageDailyVolume;
$searchSymbolChangeFromYearLow         = $phpObj->query->results->quote->ChangeFromYearLow;
$searchSymbolChangeFromYearHigh        = $phpObj->query->results->quote->ChangeFromYearHigh;
$searchSymbolMarketCapitalization      = $phpObj->query->results->quote->MarketCapitalization;
$searchSymbolPercentChangeFromYearLow  = $phpObj->query->results->quote->PercentChangeFromYearLow;
$searchSymbolPercentChangeFromYearHigh = $phpObj->query->results->quote->PercebtChangeFromYearHigh;


$uID = $user->data['user_id'];
$query = mysql_query ("SELECT type FROM myichi_portfolio WHERE user_id='$uID' AND symbol='$symbol' AND type='favorites'");
	if (mysql_num_rows($query)<1) {$favoyes=0;} else {$favoyes=1;}
$query = mysql_query ("SELECT type FROM myichi_portfolio WHERE user_id='$uID' AND symbol='$symbol' AND type='portfolio'");
	if (mysql_num_rows($query)<1) {$portfyes=0;} else {$portfyes=1;}
	
if ($favoyes==1) {

}
	
	
include("templates/searchresults.html");
}
else
{
{echo "<br><center>You need to be logged in...</center><br><br>";}
}
?>



	
	