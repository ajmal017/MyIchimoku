<?php

				echo "Create and email daily report: ". date('H:i:s', time())."\n";
				exec("/usr/local/bin/php.ORIG.5 /homez.31/domainese/myichimoku/cron/dailyreport.php > /dev/null &");
				$sleepuntil = strtotime("+2 minutes");
				time_sleep_until($sleepuntil);
				
				echo "Email reminders: ". date('H:i:s', time())."\n";
				exec("/usr/local/bin/php.ORIG.5 /homez.31/domainese/myichimoku/cron/reminders.php > /dev/null &");
				$sleepuntil = strtotime("+2 minutes");
				time_sleep_until($sleepuntil);
				
				echo "Email trade signals: ". date('H:i:s', time())."\n";
				exec("/usr/local/bin/php.ORIG.5 /homez.31/domainese/myichimoku/cron/tradesignals_email.php > /dev/null &");
				$sleepuntil = strtotime("+2 minutes");
				time_sleep_until($sleepuntil);

				echo "Back-up MyIchimoku application: ". date('H:i:s', time())."\n";
				exec("/usr/local/bin/php.ORIG.5 /homez.31/domainese/myichimoku/cron/applicationbackup.php > /dev/null &");
				$sleepuntil = strtotime("+5 minutes");
				time_sleep_until($sleepuntil);
				
				echo "Back-up MyIchimoku database: ". date('H:i:s', time())."\n";
				exec("/usr/local/bin/perl /homez.31/domainese/www/backup/msd_cron/crondump.pl > /dev/null &");


?>