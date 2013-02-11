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


if(!empty($_POST) && isset($_POST))
{
include("../webconfig.php");
}

if($user->signed){
$uid    = $user->data['user_id'];

if(!empty($_POST) && isset($_POST))
{

	if ($_REQUEST['form']=='new') {
	//make variables safe to insert
	$string         = $_REQUEST['ID'];
	$columns        = explode("|", $string); // The content format of the string = ID|column_descr|column_group
	$id             = $columns[0];
	$column_descr   = $columns[1];
	$column_group   = $columns[2];
	$tp_description = mysql_real_escape_string($_POST['tp_description']);

	//query to insert data into table
	$sql = "INSERT INTO myichi_tradingplan SET user_id='$uid', tp_group='$column_group', tp_description='$tp_description' ";
	$result = mysql_query($sql);
	redirect();
	exit;
	}
	else
	{
	$string  = $_REQUEST['id'] ;
	$value   = $_REQUEST['value'] ;
	$columns = explode("|", $string);
	$id      = $columns[0];
	$column  = $columns[1];
	if ($column=='tp_number') {$value = ($value / 100);}
	//query to update data in the table
	mysql_query("UPDATE myichi_tradingplan SET $column='$value' WHERE ID='$id' ");
	if ($column=='tp_number') {echo ($value*100);} else {echo $value;}
	exit;
	}
}

?>


		<table class="listtable">
		<thead>
		<th scope="col" width="500"><?php echo $title; ?></th>
		<?php 
		if (($tp_group=='money_bull') || ($tp_group=='money_bear')) { ?><th scope="col" width="60"><?php echo $lang['TRADINGPLAN_MM_PERC']; ?></th><?php } ?> 
		<th scope="col" width="60"><?php echo $lang['TRADINGPLAN_TP_REMOVE']; ?></th>
		</thead>
		<tbody>
			<?
				//show data from tables
				$rowclass=1;
				$query = "SELECT * FROM myichi_tradingplan WHERE user_id='$uid' AND tp_group='$tp_group' ";
				$result = mysql_query($query);
				while($row = mysql_fetch_array($result))
				
			{
			if ($rowclass==0) {$oddeven=''; $rowclass=1;} else {$oddeven='class="odd"'; $rowclass=0;}
			//print data
			?>
		<tr <?php echo $oddeven; ?>>
		<td class='edit_area' id='<?php echo $row['ID'].'|tp_description'; ?>'><?php echo $row[tp_description]; ?></td>
		<?php
		if (($tp_group=='money_bull') || ($tp_group=='money_bear')) {?><td class='edit_area' id='<?php echo $row['ID'].'|tp_number'; ?>'><?php echo ($row[tp_number]*100); ?></td><?php } ?>
		<td>
		<a href="ps/tradingplan_delete.php?id=<?php echo $row['ID']; ?>" title= "<?php echo $lang['TRADINGPLAN_TP_REMOVE']; ?>"><img src="../charts/images/bin.png" border="0"></a>
		</td>
		</tr>
		<?php
		}
		?>
	
		</tbody>
		</table>

<?php

	}
else
{
echo $lang['ERROR_ACCES_VIOLATION'];
}



?>