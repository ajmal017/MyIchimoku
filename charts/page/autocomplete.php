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


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" type="image/x-icon" href="images/favicon2.ico">
<title><?php echo $lang['PAGE_TITLE']; ?></title>
<link rel="stylesheet" href="<?php echo $root_url; ?>/css/stylesheet.css" type="text/css">

<!-- Start of Form Menu header code -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script type='text/javascript' src='http://myichimoku.eu/charts/js/jquery/jquery.mcAutoComplete.js'></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">

	<script type="text/javascript">
jQuery(document).ready(function(){
	
		
			$('#searchString').autocomplete({source: 'http://yourdomain/charts/ps/symbolsearch.php'});
		});
		

	</script>
	
	
	<script>


</script>

	</head>
	<body>
	
		<form method="post" action="?page=searchresult">
			&nbsp;&nbsp;&nbsp;
			<input class="input" name="yahoo_symbol" type="text" id="searchString" >
			<input type="hidden" name="chartsize" value="<?php echo $user->data['page_chartsize']; ?>">
		<input value="Search" src="/charts/images/search_small.png" type="image">
		</form> 
		
		</body>