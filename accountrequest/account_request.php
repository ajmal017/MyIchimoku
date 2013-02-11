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

	include("../charts/webconfig.php");

	//if($user->signed) redirect("../");
	
	//Proccess Registration
	if(count($_POST)){
		
		//Add validation for custom fields, first_name, last_name and website
		$user->addValidation("first_name","0-15","/\w+/");
		$user->addValidation("last_name","0-15","/\w+/");
		$user->addValidation("website","0-50","@((https?://)?([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@");

		//Register User
		$hash = $user->register($_POST, true);		
		if(!$hash){
			$_SESSION['NoteMsgs'] = $user->error();
			$_SESSION["regData"] = $_POST;
			redirect();		
		}else{
		
		//echo $hash;
		$UserEmail = $user->tmp_data['email'];
		$UserName  = $user->tmp_data['username'];
		$Firstname = $user->tmp_data['firstname'];
		$Lang      = $user->tmp_data['language'];
		include("../charts/language/".$Lang.".php");
		
		if (!$Firstname) {$Name = $UserName;} else {$Name = $Firstname;}
	
		// Sent an email with the activation link to the site admin
		$headers = 'From: ' . $fromEmail .'' . "\r\n" .
                   'Reply-To: no-reply@MyIchimoku.eu' . "\r\n" .
	               'MIME-Version: 1.0' . "\r\n" .
	               //'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
				   'Content-type: text/html; charset=utf-8' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
		$subject = $lang['ACCOUNT_REQUEST_MAILSUBJECT'].$Name;
		$message = "Account request from: <br>
					UserName: ".$UserName."<br>
					FirstName: ".$user->tmp_data['firstname']."<br>
					LastName: ".$user->tmp_data['lastname']."<br>
					Email: ".$UserEmail."<br>
					Taal: ".$Lang."<br>
					Activation link: <a href='http://MyIchimoku.eu/accountrequest/validate/?aid=".$hash."&lang=".$Lang."'>http://MyIchimoku.eu/accountrequest/validate/?aid=".$hash."&lang=".$Lang."</a>";
		mail($adminEmail, $subject, $message, $headers);
			//$_SESSION['NoteMsgs'][] = "User Registered Successfully";
			//$_SESSION['NoteMsgs'][] = "You may login now!";

		// Sent an email to the account requester

		$message =  $lang['ACCOUNT_REQUEST_MAIL_HI'].$Name.",<br><br>".
					$lang['ACCOUNT_REQUEST_MAIL_BODY'];
		mail($UserEmail, $subject, $message, $headers);		
		
		// Show an info page to the Account Requester
		$page_title = ucfirst($page);

		include("../charts/templates/header.html");
		//include("../charts/templates/menu.html");
		?>
		<center>
		<table width="70%"><tr>
			<td>
			<br><br><br>
			<?php echo $lang['ACCOUNT_REQUEST_MESSAGE']; ?><br>
			<br><br><br><br><br><br>
			</td>
			</tr>
		</table>
		</center>
		<?php
		include("../charts/templates/footer.html");
		}		
		
	}else{
		redirect();		
	}
	
?>
