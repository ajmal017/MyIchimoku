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
	
	//Proccess Login
	if(count($_POST)){
	  @$username = $_POST['username'];
	  @$password = $_POST['password'];
	  @$auto = $_POST['auto'];
	  
	  @$user = new uFlex($username,$password,$auto);
	  if($user->has_error()){
		  $_SESSION['NoteMsgs'] = $user->error();	  	
	  }
	}
	
	redirect();
?>
