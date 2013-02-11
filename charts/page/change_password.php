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
<p class='title'><?php echo $lang['MYACCOUNT_PASSWORD_TITLE2']; ?></p>

<center>	
	<div class="report">
		<?php echo showMsg()?>
	</div>

    <form method="post" action="ps/change_password.php">
        <label><?php echo $lang['MYACCOUNT_PASSWORD_LABEL2']; ?></label><font color="red"> *</font>
        <input name="password" type="password"  title="<?php echo $lang['ACCOUNT_REQUEST_REQUIRED']; ?>">        
        
        <label><?php echo $lang['MYACCOUNT_PASSWORD_LABEL3']; ?></label><font color="red"> *</font>
        <input name="password2" type="password"  title="<?php echo $lang['ACCOUNT_REQUEST_REQUIRED']; ?>">
        
        <input name="c" type="hidden" value="<?php echo getVar("c")?>"></input>     
        
        <input value="<?php echo $lang['MYACCOUNT_PASSWORD_BUTTON2']; ?>" type="submit">
    </form>
</center>    
<br><br><br><br>