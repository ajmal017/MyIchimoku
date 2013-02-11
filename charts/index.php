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


$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

include("webconfig.php");

if($user->signed){
$lang = $user->data['language'];
}
else
{
$lang = 'EN';
}
include("language/".$lang.".php"); 

	$page = @$_GET['page'];
	$page = !$page ? "home" : $page;
	//$page = !$page ? "portfolio" : $page;
	$ext = ".php";
	$page_inc = "page/" . str_replace("-", "_", $page) . $ext;
	
	//Page not found
	if(!file_exists($page_inc)) send404();
	
	$page_title = ucfirst($page);

include("templates/header.html");
include("templates/menu.html");
?>
<table width="100%"><tr>


<td>
<?php
include($page_inc);
?>
</td>
</tr></table>
<?php
include("templates/footer.html");

?>