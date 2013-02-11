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


#MyIchimoku Configuration File

#-----------------
#Database Settings
#-----------------
#This is your database connection information.
$db_host     = '';
$db_user     = '';
$db_password = '';
$db_name     = '';
$db_charset  = "utf8";
#If app needs to coexist with other tables in the same db, put a prefix here.  e.g. "myapp_"
#$db_prefix = 'myichi_';

$db_link = mysql_connect($db_host, $db_user, $db_password);
$connection = mysql_select_db($db_name, $db_link);

#-------------------
#FTP Backup Settings
#-------------------
$ftp_server    = 'ftp.domain';
$ftp_user_name = '';
$ftp_user_pass = '';

#-------------
#Path Settings
#-------------
#Document root as seen from the webserver.  No slash at the end
#If page is requested with https use https as root url
#e.g. http://blah.com
$root_url = '';
#Path to document root. This should be the directory this file is in.
#e.g. /var/www/localhost
$root_path = '';
#Name of the admin directory
$admin_dir = 'admin';
$appname = 'MyIchimoku';
$templates = 'templates/'; // templates folder



#---------------------------
#Some admin related settings
#---------------------------
#Sent email to site administrator after cron jobs? (0=No)
$cronMailIntradayResults = 0;
$cronMailDailyReport = 1;
$adminEmail = 'you@mail';
$fromEmail ='automagical@yourdomain';
$copyright ='2012-2013 - MyIchimoku.eu';

#---------
#Functions
#---------
include_once("/yourpath/charts/functions/calculate_indicators.php");
include_once("/yourpath/charts/functions/historical_data_collection.php");
include_once("/yourpath/charts/functions/misc.php");
include_once("/yourpath/charts/functions/email_reminder.php");
include("/yourpath/charts/functions/functions.php");

?>