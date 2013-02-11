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


include_once("/yourpath/myichimoku/charts/config.php");

$rs = mysql_query("SELECT yahoo_symbol, instrument_name, sector FROM myichi_instrument_names WHERE instrument_name LIKE '%".mysql_real_escape_string($_REQUEST['term'])."%' order by instrument_name asc limit 0,20");

$return_arr = array();

    while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
        $row_array['label'] = $row['instrument_name']." => ".$row['yahoo_symbol']." | ".$row['sector']." ";
        $row_array['value'] = $row['yahoo_symbol'];
        array_push($return_arr,$row_array);
    }

echo json_encode($return_arr);

?>