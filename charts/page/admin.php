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


	//If user is not signed in refirect
	if(!$user->signed) redirect("./?page=login");
	if ($user->data['group_id']<9) {redirect('/');}	
	else
	{
	echo "<br>Admin page <br><center>";
	
	// --------------------------------------  List all users in the database  --------------------------------------
		$query = mysql_query("SELECT user_id, username, firstname, lastname, email, activated, reg_date, last_login, group_id, language
							  FROM myichi_users
							  ORDER BY user_id ASC") or die ('Erreur de requête<br>'.$query.'<br>'.mysql_error());

		if (mysql_num_rows($query)<1) { echo "No users in Database??";} 
			else {
			echo "<table class='listtable'><caption>".$lang['ADMIN_TITLE_USERS']."<br><br></caption>
					<thead><tr>
					<th scope='col' width='30'>".$lang['ADMIN_USER_ID']."</th>
					<th scope='col' width='85'>".$lang['ADMIN_USER_NAME']."</th>
					<th scope='col' width='85'>".$lang['ADMIN_USER_FIRST']."</th>
					<th scope='col' width='85'>".$lang['ADMIN_USER_LAST']."</th>
					<th scope='col' width='85'>".$lang['ADMIN_USER_EMAIL']."</th>
					<th scope='col' width='85'>".$lang['ADMIN_USER_ACTIVATED']."</th>
					<th scope='col' width='185'>".$lang['ADMIN_USER_REGDATE']."</th>
					<th scope='col' width='185'>".$lang['ADMIN_USER_LAST_LOGON']."</th>
					<th scope='col' width='85'>".$lang['ADMIN_USER_GROUPID']."</th>
					<th scope='col' width='85'>".$lang['ADMIN_USER_LANGUAGE']."</th>
					</tr>
					</thead>
				<tbody>";
		while ($row = mysql_fetch_assoc($query)) {
			if ($rowclass==0) {$oddeven=''; $rowclass=1;} else {$oddeven="class='odd'"; $rowclass=0;}
			echo "
			<tr ".$oddeven.">
				<td>".$row['user_id']."</td>
				<td>".$row['username']."</td>
				<td>".$row['firstname']."</td>
				<td>".$row['lastname']."</td>
				<td>".$row['email']."</td>
				<td><center>".$row['activated']."</center></td>
				<td>".date("D d M Y @ H:i ", $row['reg_date'])."</td>
				<td>".date("D d M Y @ H:i ", $row['last_login'])."</td>
				<td><center>".$row['group_id']."</center></td>
				<td><center>".$row['language']."</center></td>
			<tr>";
		}	
		echo "</tbody></table>";
		}
	// --------------------------------------  End list all users in the database  --------------------------------------

// --------------------------------------  Page views per user over last 10 days  --------------------------------------
		echo "<br><br><br><br>";
		$date = date("Y-m-d", strtotime("-10 days"));
		$query = mysql_query("SELECT DISTINCT s.user_id, COUNT(*) AS pages, u.username AS username, u.firstname AS firstname, u.lastname AS lastname
							  FROM myichi_user_stats AS s
							  LEFT JOIN myichi_users AS u ON s.user_id = u.user_id
							  WHERE date > '$date'
							  GROUP BY user_id 
							  ORDER BY user_id ASC") or die ('Erreur de requête<br>'.$query.'<br>'.mysql_error());

		if (mysql_num_rows($query)<1) { echo "No users in Database??";} 
			else {
			echo "<table class='listtable'><caption>".$lang['ADMIN_TITLE_STATS1']."<br><br></caption>
					<thead><tr>
					<th scope='col' width='75'>".$lang['ADMIN_USER_ID']."</th>
					<th scope='col' width='150'>".$lang['ADMIN_USER_NAME']."</th>
					<th scope='col' width='100'><center>".$lang['ADMIN_COLUMN_PAGES']."</center></th>
					</tr>
					</thead>
				<tbody>";
		while ($row = mysql_fetch_assoc($query)) {
			if ($rowclass==0) {$oddeven=''; $rowclass=1;} else {$oddeven="class='odd'"; $rowclass=0;}
			if ($row['user_id']==0) {$user='Not logged in';} else {$user=$row['firstname']." ".$row['lastname'];}
			echo "
			<tr ".$oddeven.">
				<td><center>".$row['user_id']."</center></td>
				<td>".$user."</td>
				<td><center>".$row['pages']."</center></td>
			<tr>";
		}	
		echo "</tbody></table>";
		}
	// --------------------------------------  End Page views per user over last 10 days  --------------------------------------

	
echo "</center><br><br><br><br>";	
	}
?>
