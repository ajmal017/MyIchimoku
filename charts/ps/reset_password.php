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


	include("../webconfig.php");
	include("../language/EN.php");
	
	//Proccess Update
	if(count($_POST)){
		$res = $user->pass_reset($_POST['email']);
		
		if($res){
			//Hash succesfully generated
			//You would send an email to $res['email'] with the URL+HASH $res['hash'] to enter the new password
			//In this demo we will just redirect the user directly
			
		$Email = $res['email'];	
		
		// Sent an email 
		$headers = 'From: ' . $fromEmail .'' . "\r\n" .
			'Reply-To: no-reply@MyIchimoku.eu' . "\r\n" .
			'MIME-Version: 1.0' . "\r\n" .
			'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		$subject = "MyIchimoku Password reset";
		$message = "Hi there,<br>
					It seems that you would like to reset your password (or someone else is trying to be funny with your Email address)<br>
					To reset your password, click on the following link: <a href='http://MyIchimoku.eu/charts/?page=change-password&c=" .$res['hash']. "'>http://MyIchimoku.eu/charts/?page=change-password&c=" . $res['hash']. "</a><br>
					<br>
					Enjoy!!";
		
		mail($Email, $subject, $message, $headers);
			
			
			//$url = "../?page=change-password&c=" . $res['hash'];
			//$_SESSION["NoteMsgs"][] = "You may change your password";
			$_SESSION["NoteMsgs"][] = $lang['MYACCOUNT_PASSWORD_MAILSENT'];
			//Redirect
			//redirect($url);
			redirect("../");
			
		}else{
			$_SESSION["NoteMsgs"] = $user->error();
			
			redirect();
		}
	}
	
?>
