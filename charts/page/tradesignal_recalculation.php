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


//If user is not signed in redirect
if(!$user->signed) redirect("./?page=login");	

// this actually doesn't work yet...
exec("/usr/local/bin/php.ORIG.5 /yourpath/cron/update_user_tradesignals.php yes > /dev/null &");

echo "<br><br><center>Trade Signals are being updated...</center>";	
?>