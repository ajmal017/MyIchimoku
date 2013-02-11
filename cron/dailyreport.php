<?php##########################################################################################################################                                                                                                                       ##   Copyright (c) 2012 by Oscar Buijten; http://myichimoku.eu  and  http://oscar.buijten.fr                             ##                                                                                                                       ##   This work is made available under the terms of the Creative Commons Attribution-NonCommercial 3.0 Unported,         ##                                                                                                                       ##   http://creativecommons.org/licenses/by-nc/3.0/legalcode                                                             ##                                                                                                                       ##   This work is WITHOUT ANY WARRANTY; without even the implied warranty of FITNESS FOR A PARTICULAR PURPOSE.           ##                                                                                                                       ##########################################################################################################################
include_once("/yourpath/charts/config.php");  
require('/yourpath/charts/includes/includes.php');

$conn = mysql_connect($db_host, $db_user, $db_password) or die                      ('Error connecting to mysql');
mysql_select_db($db_name);

			mysql_select_db( $db_name );
			$result = mysql_query( "SHOW TABLE STATUS" );
			$dbsize = 0;
				while( $row = mysql_fetch_array( $result ) ) {  
					$dbsize += $row[ "Data_length" ] + $row[ "Index_length" ];
					
					}
				
//$today = date('Y-m-d', strtotime('yesterday'));
$today = date("Y-m-d");
$query = mysql_query("SELECT script, date, start, end, yqlqty, records, info FROM myichi_tracker_report WHERE date='$today' ");
		if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
			
			$report.= '
			<html><body>
				<center>
				<table width="80%"><tbody>
				<tr><td>
				<table class="listtable">
				<caption style="font-weight: bold; font-size: 10pt; color:#636363; text-align: left; margin: 0; padding: 0.5em 0.25em;">Daily Database Activity Report</caption>
				<thead><tr>
				<th scope="col" width="150" style="border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: left; border-bottom: 0.2em solid #09f;">Script:</th>
				<th scope="col" width="125" style="border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: left; border-bottom: 0.2em solid #09f;">Date:</th>
				<th scope="col" width="100" style="border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: left; border-bottom: 0.2em solid #09f;">Start:</th>
				<th scope="col" width="100" style="border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: left; border-bottom: 0.2em solid #09f;">End:</th>
				<th scope="col" width="100" style="border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: left; border-bottom: 0.2em solid #09f;">YQL Queries:</th>
				<th scope="col" width="100" style="border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: left; border-bottom: 0.2em solid #09f;">No Records:</th>
				<th scope="col" width="450" style="border-width: 0px 0;color:#636363;font-size: 10pt; font-weight: bold; line-height:normal; text-align: left; border-bottom: 0.2em solid #09f;">Info:</th>
				</tr>
				</thead>
				<tbody>';
			while($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
			$report.= '<tr>
						<td style="text-align: left; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;">' . $row['script'] . '</td>
						<td style="text-align: left; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;">' . $row['date'] . '</td>
						<td style="text-align: left; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;">' . $row['start'] . '</td>
						<td style="text-align: left; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;">' . $row['end'] . '</td>
						<td style="text-align: left; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;">' . $row['yqlqty'] . '</td>
						<td style="text-align: left; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;">'. $row['records'] . '</td>
						<td style="text-align: left; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;">'. $row['info'] . '</td>
						</tr>';
			}
			$report.= '</table><br><font style="text-align: left; vertical-align: bottom; white-space: nowrap; font: 10pt Verdana, Helvetica; border-spacing: 0; border-collapse: separate; margin: 0 0 0 0; color:#636363;">The size of the database is ' . formatfilesize( $dbsize ) .'</font></td></tr></table><br><br>'.$emailFooter.'</body></html>';
	
			echo $report;
			

// Sent email with results:
if ($cronMailDailyReport > 0) {
     $subject = 'Daily Database Activity Report';
	 $headers = 'From: ' . $fromEmail .'' . "\r\n" .
     'Reply-To: no-reply@MyIchimoku.eu' . "\r\n" .
	 'MIME-Version: 1.0' . "\r\n" .
	 'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($adminEmail, $subject, $report, $headers);
	 }

mysql_close($conn);
?>