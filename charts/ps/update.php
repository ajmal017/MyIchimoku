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
	
	//Proccess Update
	if(count($_POST)){
		
		foreach($_POST as $name=>$val){
			if($user->data[$name] == $val){
			
				unset($_POST[$name]);
			}		
		}
		
		//Add validation for custom fields, first_name, last_name and website
		$user->addValidation("firstname","0-15","/[a-zA-Z]+/");
		$user->addValidation("lastname","0-15","/[a-zA-Z]+/");
		$user->addValidation("website","0-50","@((https?://)?([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@");
		
		if(count($_POST)){
			//Update info
			$user->update($_POST);			
		}else{
			//Nothing has changed
			$_SESSION['NoteMsgs'][0] = "No need to update!";
		}
		
		//If there are errors
		if($user->has_error()){
			//There were errors while updating information
			$_SESSION['NoteMsgs'] = $user->error();	
		}elseif(count($_POST)){
			//Updates have been saved successfully!
			$_SESSION['NoteMsgs'][0] = "Information Updated!";
		}
	}
	
	redirect();
	
?>