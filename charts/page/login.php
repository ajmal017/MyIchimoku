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


	if($user->signed) redirect("./?page=account");
?>	
	<h1>Login</h1>
	
	<div class="report">
		<?php echo showMsg()?>
	</div>
	
    <form method="post" action="ps/login.php">
        <label>Username or Email:</label>
        <input name="username" type="text" value="">
        
        
        <label>Password:</label>
        <input name="password" type="password">
        
        
        <label>Remember me?:</label>
        <input name="auto" type="checkbox" style="display: inline-block">
        
        
        <input value="SignIn" type="submit">
    </form>
    
    <br>
    <a href="?page=forgot-password">Forgot password?</a>