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


function wakeUpEmail($uID,$fromEmail,$root_url,$copyright)
{

require('/yourpath/charts/includes/includes.php');

$today = date('Y-m-d');
// Check if this is the first time this script runs today, if so; reset the counter.
	$query = mysql_query("SELECT rundate, counter FROM myichi_tracker WHERE script='Wake-upEmail'");
		if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }
	$updatecounter = mysql_fetch_assoc($query);
	//echo $updatecounter[rundate];
		if ($updatecounter[rundate] == $today) {
			echo "This is not the first time that the script runs today. ";
			$queryType = "Wake-up Email for: ";
			}
		else
			{
			echo "This is the first time today the script runs. ";
			$counter = 0;
			$updatecounter[counter] = 0;
			$queryType = "Wake-up Email for: ";
			mysql_query("UPDATE myichi_tracker SET counter='$counter' WHERE script='Wake-upEmail'");
			}

// Get the uID email details and prepare the mail
	$query = mysql_query("SELECT * FROM myichi_users WHERE user_id = '$uID' ");
		if (!$query) { echo 'Impossible d\'exécuter la requête : ' . mysql_error(); exit; }	
			
		$row     = mysql_fetch_assoc($query);
		$to      = ($row["email"]);
		$lang    = ($row["language"]);

			include_once('/yourpath/charts/language/'.$lang.'.php');
		$fname   = ($row["firstname"]);
		$user    = ($row["username"]);
			if ($fname=='') {$fname = $user;}
		$subject = ($row["mail_subject"]);
		$content = ($row["mail_content"]);
	 
		$body.= '<html><body>
				<br><center>
				<table width="80%"><tbody>
				<tr><td>
				<p style="font: Verdana, Helvetica, sans-serif; color:#636363;font-size: 10pt;">' . $lang['ACCOUNT_ACTIVATED_HI'] . ' ' . $fname .',<br><br>'.
				$content .'</p>
				</td></tr>
				</table>
				</center>
				<br><br><br>' .
				$emailFooter .
				'</body></html>';
	 
		$headers = 'From: ' . $fromEmail .'' . "\r\n" .
		'Reply-To: no-reply@MyIchimoku.eu' . "\r\n" .
		'MIME-Version: 1.0' . "\r\n" .
		'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $body, $headers);
		echo $body."\n";
		echo "Mail sent to: ".$to."\n";
		//echo $body;
			

$counter = $updatecounter[counter]+1;
$info = $queryType . $fname . ' > ' . $to . '';
$end = date('H:i:s', time());
mysql_query("UPDATE myichi_tracker SET rundate='$today', counter='$counter' WHERE script='Wake-upEmail' ");
mysql_query("INSERT INTO myichi_tracker_report (script, date, start, end, info) VALUES ('Wake-upEmail', '$today', '$start', '$end',  '$info')");

//mysql_close($conn);
}
?>