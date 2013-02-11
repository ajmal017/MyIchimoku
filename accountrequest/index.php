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
		// Show an info page to the Account Requester
		$page_title = ucfirst($page);

include("../charts/language/EN.php");
include("../charts/templates/header.html");
//include("../charts/templates/menu.html");
		
if($user->signed) redirect("/charts/");
	
	$d = @$_SESSION["regData"];
	unset($_SESSION["regData"]);
?>
	
<br><br>
<center>
<form method="post" action="account_request.php">
<table class="listtable">
<thead><tr>
<th colspan="2" width="350"><?php echo $lang['ACCOUNT_REQUEST_TITLE']; ?></th>
</tr></thead>

<tbody>
<tr >
<td><?php echo $lang['ACCOUNT_REQUEST_USER']; ?><font color="red"> *</font></td>
<td><input name="username" type="text" value="<?php echo @$d['username']?>" title="<?php echo $lang['ACCOUNT_REQUEST_REQUIRED']; ?>"></td>
</tr>

<tr class="odd">
<td><?php echo $lang['ACCOUNT_REQUEST_FIRSTNAME']; ?></td>
<td><input name="firstname" type="text" value="<?php echo @$d['first_name']?>"></td>
</tr>

<tr >
<td><?php echo $lang['ACCOUNT_REQUEST_LASTNAME']; ?></td>
<td><input name="lastname" type="text" value="<?php echo @$d['last_name']?>"></td>
</tr>

<tr class="odd" >
<td><?php echo $lang['ACCOUNT_REQUEST_EMAIL']; ?><font color="red"> *</font></td>
<td><input name="email" type="text" value="<?php echo @$d['email']?>" title="<?php echo $lang['ACCOUNT_REQUEST_REQUIRED']; ?>"></td>
</tr>

<tr>
<td><?php echo $lang['ACCOUNT_REQUEST_LANGUAGE']; ?></td>
<td><select name="language"><option value="EN" SELECTED>English</option><option value="FR" >Français</option><option value="NL" >Nederlands</option></select></td>
</tr>

<tr class="odd" >
<td><?php echo $lang['ACCOUNT_REQUEST_PASSWORD']; ?><font color="red"> *</font></td>
<td><input name="password" type="password" value="<?php echo @$d['password']?>" title="<?php echo $lang['ACCOUNT_REQUEST_REQUIRED']; ?>"></td>
</tr>

<tr >
<td><?php echo $lang['ACCOUNT_REQUEST_PASSWORD2']; ?><font color="red"> *</font></td>
<td><input name="password2" type="password" value="<?php echo @$d['password2']?>" title="<?php echo $lang['ACCOUNT_REQUEST_REQUIRED']; ?>"></td>
</tr>

<tr  class="odd"><td colspan="2">
<?php
/*
require_once('includes/recaptchalib.php');

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6LdpstUSAAAAABpbQyNTHnCqfK_n74vng2qcNrIy";
$privatekey = "6LdpstUSAAAAAK-IsX5FiWliBR5KNhYvlFAbgXUP";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

# was there a reCAPTCHA response?
if ($_POST["recaptcha_response_field"]) {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
                echo "You got it!";
        } else {
                # set the error code so that we can display it
                $error = $resp->error;
        }
}
echo recaptcha_get_html($publickey, $error);
*/
?>

</td></tr>

<tr><td colspan="2">
<?php echo $lang['TC_AND_CS']; ?>
</td></tr>
</table>

    <input value="<?php echo $lang['ACCOUNT_REQUEST_BUTTON']; ?>" type="submit">
    </form>
</center>
<br>
<?php include("../charts/templates/footer.html") ?>