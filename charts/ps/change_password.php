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
	
	//Proccess Password change
	if(count($_POST)){
		$hash = @$_POST['c'];
		unset($_POST['c']);
		
		if(!$user->signed and $hash){
			//Change password with confirmation hash
			$user->new_pass($hash,$_POST);
			//$redirectPage = "login";
			$redirectPage = "portfolio";
		}else{
			//Change the password of signed in user without a confirmation hash 
			$user->update($_POST);
			$redirectPage = "account";
		}
		
		
		//If there is not error
		if(!$user->has_error()){
			//$_SESSION["NoteMsgs"][] = "Password Changed";
			$_SESSION["NoteMsgs"][] = $lang['MYACCOUNT_PASSWORD_CHANGED'];
			redirect("../?page={$redirectPage}");
			
		}else{
			$_SESSION["NoteMsgs"] = $user->error();
			redirect();
		}
	}else if(!$user->signed and !isset($_POST['c'])){
		//Refirect
		redirect("../");
	}
?>