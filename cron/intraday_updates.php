<?php##########################################################################################################################                                                                                                                       ##   Copyright (c) 2012 by Oscar Buijten; http://myichimoku.eu  and  http://oscar.buijten.fr                             ##                                                                                                                       ##   This work is made available under the terms of the Creative Commons Attribution-NonCommercial 3.0 Unported,         ##                                                                                                                       ##   http://creativecommons.org/licenses/by-nc/3.0/legalcode                                                             ##                                                                                                                       ##   This work is WITHOUT ANY WARRANTY; without even the implied warranty of FITNESS FOR A PARTICULAR PURPOSE.           ##                                                                                                                       ##########################################################################################################################
if (date('H', time()) == '01' ||
	date('H', time()) == '02' ||
	date('H', time()) == '03' ||
	date('H', time()) == '04' ||
	date('H', time()) == '05' ||
	date('H', time()) == '06' ||
	date('H', time()) == '07' ||
	date('H', time()) == '22' ||
	date('H', time()) == '23'   ) {$u=1;}
	
if (date('H', time()) == '08' ||
	date('H', time()) == '09' ||
	date('H', time()) == '10' ||
	date('H', time()) == '11' ||
	date('H', time()) == '12' ||
	date('H', time()) == '13' ||
	date('H', time()) == '14' ||
	date('H', time()) == '15'   ) {$u=2;}
	
if (date('H', time()) == '16' ||
	date('H', time()) == '17' ||
	date('H', time()) == '18' ||
	date('H', time()) == '19' ||
	date('H', time()) == '20' ||
	date('H', time()) == '21'   ) {$u=3;}
	
switch ($u) {
    case 1:
			for($cycle=0; $cycle < 3; $cycle++) {
				exec("/usr/local/bin/php.ORIG.5 /homez.31/domainese/myichimoku/cron/intraday_forex.php > /dev/null &");

				echo "Cycle: ".$cycle." ";
				echo strtotime("now"), "\n";
				$sleepuntil = strtotime("+20 minutes");
				time_sleep_until($sleepuntil);
			}
			echo "End.";
	break;
	
    case 2:
			for($cycle=0; $cycle < 2; $cycle++) {
				echo "start forex: ". date('H:i:s', time())."\n";
				exec("/usr/local/bin/php.ORIG.5 /homez.31/domainese/myichimoku/cron/intraday_forex.php > /dev/null &");
				$sleepuntil = strtotime("+4 minutes");
				time_sleep_until($sleepuntil);

				echo "slept a little. start europe: ". date('H:i:s', time())."\n";
				exec("/usr/local/bin/php.ORIG.5 /homez.31/domainese/myichimoku/cron/intraday.php > /dev/null &");
				$sleepuntil = strtotime("+9 minutes");
				time_sleep_until($sleepuntil);
				echo "slept a little: ". date('H:i:s', time())."\n";

				echo "Cycle: ".$cycle." ";
				$sleepuntil = strtotime("+10 minutes");
				time_sleep_until($sleepuntil);
				echo "slept a little more and will start again now. ". date('H:i:s', time())."\n";
			}
			echo "End.";
	break;
	
    case 3:
			for($cycle=0; $cycle < 2; $cycle++) {
				echo "start forex: ". date('H:i:s', time())."\n";
				exec("/usr/local/bin/php.ORIG.5 /homez.31/domainese/myichimoku/cron/intraday_forex.php > /dev/null &");
				$sleepuntil = strtotime("+3 minutes");
				time_sleep_until($sleepuntil);
				
				echo "slept a little. start europe: ". date('H:i:s', time())."\n";
				exec("/usr/local/bin/php.ORIG.5 /homez.31/domainese/myichimoku/cron/intraday.php > /dev/null &");
				$sleepuntil = strtotime("+14 minutes");
				time_sleep_until($sleepuntil);
				
				echo "slept a little. start usa: ". date('H:i:s', time())."\n";
				exec("/usr/local/bin/php.ORIG.5 /homez.31/domainese/myichimoku/cron/intraday_usa.php > /dev/null &");

				echo "Cycle: ".$cycle." ";
				$sleepuntil = strtotime("+6 minutes");
				time_sleep_until($sleepuntil);
				echo "slept a little more and will start again now. ". date('H:i:s', time())."\n";
			}
			echo "End.";
    break;
}
exit;
?>