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
<center>
	<p class='title'><?php echo $lang['MYACCOUNT_PASSWORD_TITLE']; ?></p>
	    
	<div class="report">
		<?php echo showMsg()?>
	</div>

    <form method="post" action="ps/reset_password.php">
        <p><?php echo $lang['MYACCOUNT_PASSWORD_INSTRUCT']; ?></p>            
        <label><?php echo $lang['MYACCOUNT_PASSWORD_LABEL']; ?> </label><span class="required">*</span>
        <input name="email" type="text" value="">
        
                
        <input value="<?php echo $lang['MYACCOUNT_PASSWORD_BUTTON']; ?>" type="submit" class="button">
    </form>
    </center>
	<br><br>
