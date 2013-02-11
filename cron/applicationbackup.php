<?php##########################################################################################################################                                                                                                                       ##   Copyright (c) 2012 by Oscar Buijten; http://myichimoku.eu  and  http://oscar.buijten.fr                             ##                                                                                                                       ##   This work is made available under the terms of the Creative Commons Attribution-NonCommercial 3.0 Unported,         ##                                                                                                                       ##   http://creativecommons.org/licenses/by-nc/3.0/legalcode                                                             ##                                                                                                                       ##   This work is WITHOUT ANY WARRANTY; without even the implied warranty of FITNESS FOR A PARTICULAR PURPOSE.           ##                                                                                                                       ##########################################################################################################################
$start = date('H:i:s', time());
include_once("/homez.31/domainese/myichimoku/charts/config.php");
$today = date("Y-m-d"); 
$weekday = date("l");
$AMPM = date("A");

/*
echo "Back-up of your data base: ".$db_name. " in ". $db_charset ." format. \n";
// Connect to database
$conn = mysql_connect($db_host, $db_user, $db_password) or die ('Error connecting to mysql');
mysql_select_db($db_name);
	$result = mysql_query( "SHOW TABLE STATUS" );
	$dbsize = 0;
		while( $row = mysql_fetch_array( $result ) ) {  
			$dbsize += $row[ "Data_length" ] + $row[ "Index_length" ];
			}
			$db = "Database size: " . formatfilesize( $dbsize ) ."\n";
			echo $db;
echo "Creating .sql back-up file...\n";
system("mysqldump --host=$db_host --user=$db_user --password=$db_password -C -Q -e --default-character-set=$db_charset $db_name > ../backup/$db_name-$weekday-$AMPM.sql");

echo "\n gzip-ing (".format_bytes(filesize('../backup/'.$db_name.'-'.$weekday.'-'.$AMPM.'.sql')).")... ";
system("gzip -cvf --best ../backup/".$db_name."-".$weekday."-".$AMPM.".sql > ../backup/".$db_name."-".$weekday."-".$AMPM.".sql.gz");
echo "\n";
echo "SQL file compression completed. The file name is: ".$db_name."-".$weekday."-".$AMPM.".sql.gz (".format_bytes(filesize('../backup/'.$db_name.'-'.$weekday.'-'.$AMPM.'.sql.gz')).") \n";
*/

// tar and zip the web application
system("tar -czpf /homez.31/domainese/myichimoku/backup/MyIchimoku_Backup-$weekday-$AMPM.tar.gz /homez.31/domainese/myichimoku/charts/");
echo "Website compression completed. The file name is: MyIchimoku_Backup-".$weekday."-".$AMPM.".tar.gz (".format_bytes(filesize('../backup/MyIchimoku_Backup-'.$weekday.'-'.$AMPM.'.tar.gz')).")\n";

// ftp to save location
$source_file = '../backup/MyIchimoku_Backup-'.$weekday.'-'.$AMPM.'.tar.gz';
$destination_file = '/MyIchimoku/MyIchimoku_Backup-'.$weekday.'-'.$AMPM.'.tar.gz';

$sqlsource = '../backup/'.$db_name.'-'.$weekday.'-'.$AMPM.'.sql.gz';
$sqldestination = '/MyIchimoku/'.$db_name.'-'.$weekday.'-'.$AMPM.'.sql.gz';

// création de la connection 
$conn_id = ftp_connect($ftp_server); 
// authentification avec nom de compte et mot de passe 
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 
// vérification de la connexion 
if ((!$conn_id) || (!$login_result)) { 
echo "La connexion FTP a échoué!"; 
echo "Tentative de connexion à". $ftp_server." avec ".$ftp_user_name."\n"; 
die; 
} else { 
echo "\n Connected to ". $ftp_server.", with user ID ".$ftp_user_name."\n"; 
} 
// ftp the web application 
echo "Transfering website: " .$source_file." (". format_bytes(filesize($source_file))." )...  ";
$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY); 
echo "Done! \n";
// ftp the sql file
echo "Transfering sql file: " .$sqlsource." (". format_bytes(filesize($sqlsource))." )...  ";
$upload = ftp_put($conn_id, $sqldestination, $sqlsource, FTP_BINARY); 
echo "Done! \n";

// Vérification de téléchargement 
if (!$upload) { 
echo "Le téléchargement Ftp a échoué! \n"; 
} else { 
echo "Back-up completed. \n"; 
} 
// fermeture de la connexion FTP. 
ftp_quit($conn_id); 
			
$end = date('H:i:s', time());
mysql_query("UPDATE myichi_tracker SET rundate='$today' WHERE script='Backup' ");
mysql_query("INSERT INTO myichi_tracker_report (script, date, start, end, info) VALUES ('Backup', '$today', '$start', '$end', '$db')");
mysql_close($conn);

?>