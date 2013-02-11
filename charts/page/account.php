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
?>
	
	<div class="report">
		<?php echo showMsg()?>
	</div>
	
	

<BR><BR><BR>

	
<center>
<table border="0">
<tr>
<!-- <td width="200" rowspan="4">
</td> -->
<td width="50" style="text-align:right;"><br>
<img src="http://www.gravatar.com/avatar/<?php echo md5($user->data['email'])?>?d=wavatar">&nbsp
</td>
<td>

<table class="listtable"> <!-- basic account details -->
<thead><tr>
<th colspan="2" width="300"><?php echo $lang['MYACCOUNT_CAPTION']; ?></th>
</tr></thead>

<tbody>
<tr >
<td><?php echo $lang['MYACCOUNT_USERNAME']; ?></td>
<td class='edit' id='<?php echo $user->data['username']; ?>'><?php echo $user->data['username']; ?></td>
</tr>

<tr class="odd">
<td><?php echo $lang['MYACCOUNT_FIRSTNAME']; ?></td>
<td class='edit' id='firstname'><?php echo $user->data['firstname']; ?></td>
</tr>

<tr >
<td><?php echo $lang['MYACCOUNT_LASTNAME']; ?></td>
<td class='edit' id='lastname'><?php echo $user->data['lastname']; ?></td>
</tr>

<tr class="odd" >
<td><?php echo $lang['MYACCOUNT_EMAIL']; ?></td>
<td class='edit' id='email'><?php echo $user->data['email']; ?></td>
</tr>

<tr >
<td><?php echo $lang['MYACCOUNT_ACCESS_TITLE']; ?></td>
<?php
if ($user->data['group_id']==1) {$level = $lang['MYACCOUNT_LEVEL_1'];}
if ($user->data['group_id']==4) {$level = $lang['MYACCOUNT_LEVEL_4'];}
if ($user->data['group_id']==9) {$level = $lang['MYACCOUNT_LEVEL_9'];}
?>
<td><?php echo $level; ?></td>
</tr>

<tr class="odd" >
<td><?php echo $lang['MYACCOUNT_CURRENCY']; ?></td>
<td class='edit' id='currency' title="<?php echo $lang['MYACCOUNT_CURRENCY_COMMENT']; ?>"><?php echo htmlentities($user->data['currency']); ?></td>
</tr>


<tr >
<td><?php echo $lang['MYACCOUNT_PASSWORD']; ?></td>
<td><a class="md_bnt" href="?page=change-password"><?php echo $lang['MYACCOUNT_CLICK']; ?></a></td>
</tr>

<?php
if ($user->data['user_id']==1) { echo '
<tr class="odd">
<td>Change access level:</td>
<td class="edit" id="group_id">' .$user->data['group_id'].'</td>
</tr>';}
?>
</tbody>
</table>
</td>
<td>
<!--  ---------------- Trading Signals details  ---------------- -->
<table class="listtable">
<thead><tr><th colspan="2" width="350"><?php echo $lang['MYACCOUNT_SIGNALSETTINGS']; ?></th></tr></thead>

<tbody>
<tr >
<td title='<?php echo $lang['MYACCOUNT_BACKTRADING_INFO']; ?>'><?php echo $lang['MYACCOUNT_BACKTRADING']; ?>&nbsp<font color='red'><b>!</b></font></td>
<td class='select' id='backtrading' style="text-align: left;"><?php echo $user->data['backtrading']; ?></td>
</tr>

<?php if ($user->data['group_id']>=4) { ?>
<tr class='odd'>
<td><?php echo $lang['PREFERENCES_MIN_ICHIVALUE_B']; ?></td>
<td class='select_min_ichimoku_signal' id='min_ichimoku_signal' ><?php echo $user->data['min_ichimoku_signal']; ?></td>
</tr>

<tr>
<td><?php echo $lang['PREFERENCES_MIN_CLOUDBRVALUE_B']; ?></td>
<td class='select_min_cloudbreak_signal' id='min_cloudbreak_signal' ><?php echo $user->data['min_cloudbreak_signal']; ?></td>
</tr>

<tr class='odd'>
<td><?php echo $lang['PREFERENCES_TRADE_ICHI_SIGNAL']; ?></td>
<td class='select_min_ichimoku_signal' id='ichimoku_trade_signal' ><?php echo $user->data['ichimoku_trade_signal']; ?></td>
</tr>

<tr >
<td><?php echo $lang['PREFERENCES_TRADE_CIKOU_OS']; ?></td>
<td class='select_period' id='chikou_open_space' ><?php echo $user->data['chikou_open_space']; ?></td>
</tr>

<tr class='odd'>
<td><?php echo $lang['PREFERENCES_TRADE_BUYWAIT']; ?></td>
<td class='select_period' id='buy_wait' ><?php echo $user->data['buy_wait']; ?></td>
</tr>

<tr >
<td><a href="?page=tradesignal_recalculation" title= "<?php echo $lang['PREFERENCES_PAGE_RECALCTITLE']; ?>" onclick="return window.confirm('<?php echo $lang['PREFERENCES_PAGE_RECALCALERT']; ?>')";><?php echo $lang['PREFERENCES_PAGE_RECALCLINK']; ?></a></td>
<td></td>
</tr>

<?php } ?>

</tbody>
</table>

<br><br><br><BR><BR>
</td>
</tr>

<tr>

<!-- <td class='select_cloudbreak_signal' id='min_cloudbreak_signal'>".$user->data['min_cloudbreak_signal']."</td>
<!--  ---------------- Trading Plan details  ---------------- -->

<td colspan="4">
<center>
<table class="listtable">
<thead><tr>
<th colspan="4" ><?php echo $lang['MYACCOUNT_TRADINGPLAN']; ?></th>
</tr></thead>
<tbody>
<tr >
<td rowspan = "3" >
 <p style=" font-weight: bold; "><?php echo $lang['MYACCOUNT_GENERAL']; ?></p>
</td>
<td width="600"><?php echo $lang['MYACCOUNT_TRAD_CAPITAL']; ?><br><br></td>
<td class='edit' id='trading_capital' style="text-align: right;"><?php echo $user->data['trading_capital']; ?></td><td>&nbsp<?php echo $user->data['currency']; ?></td>
</tr>

<tr class="odd">
<td><?php echo $lang['MYACCOUNT_TRAD_CAP_MAX']; ?><br><br></td>
<td class='edit' id='max_per_trade' style="text-align: right;"><?php echo ($user->data['max_per_trade']*100); ?></td><td>&nbsp%</td>
</tr>

<tr>
<td><?php echo $lang['MYACCOUNT_MIN_VOLUME']; ?><br><br></td>
<td class='edit' id='min_volume_instrument' style="text-align: right;"><?php echo $user->data['min_volume_instrument']; ?></td>
</tr>

<tr class="odd">
<td rowspan = "3">
  <p style="font-weight: bold; "><?php echo $lang['MYACCOUNT_BULL_ENTRY']; ?> </p>
</td>
<td><?php echo $lang['MYACCOUNT_BULL_ENTRY_TENKAN']; ?><br><br></td>
<td class='edit' id='bull_entry_tenkan' style="text-align: right;"><?php echo ($user->data['bull_entry_tenkan']*100); ?></td><td>&nbsp%</td>
</tr>

<tr>
<td><?php echo $lang['MYACCOUNT_BULL_ENTRY_KIJUN']; ?><br><br></td>
<td class='edit' id='bull_entry_kijun' style="text-align: right;"><?php echo ($user->data['bull_entry_kijun']*100); ?></td><td>&nbsp%</td>
</tr>


<tr class="odd">
<td><?php echo $lang['MYACCOUNT_BULL_ENTRY_BUFFER']; ?><br><br></td>
<td class='edit' id='bull_entry_buffer' style="text-align: right;"><?php echo ($user->data['bull_entry_buffer']*100); ?></td><td>&nbsp%</td>
</tr>

<tr>
<td rowspan = "3">
 <p style=" font-weight: bold; "><?php echo $lang['MYACCOUNT_BEAR_ENTRY']; ?> </p>
</td>
<td><?php echo $lang['MYACCOUNT_BEAR_ENTRY_TENKAN']; ?><br><br></td>
<td class='edit' id='bear_entry_tenkan' style="text-align: right;"><?php echo ($user->data['bear_entry_tenkan']*100); ?></td><td>&nbsp%</td>
</tr>

<tr class="odd">
<td><?php echo $lang['MYACCOUNT_BEAR_ENTRY_KIJUN']; ?><br><br></td>
<td class='edit' id='bear_entry_kijun' style="text-align: right;"><?php echo ($user->data['bear_entry_kijun']*100); ?></td><td>&nbsp%</td>
</tr>

<tr>
<td><?php echo $lang['MYACCOUNT_BEAR_ENTRY_BUFFER']; ?><br><br></td>
<td class='edit' id='bear_entry_buffer' style="text-align: right;"><?php echo ($user->data['bear_entry_buffer']*100); ?></td><td>&nbsp%</td>
</tr>

<tr class="odd">
<td rowspan = "5">
 <p style=" font-weight: bold; "><?php echo $lang['MYACCOUNT_MONEY_MGT']; ?></p>
</td>
<td><?php echo $lang['MYACCOUNT_EXIT_BUFFER']; ?><br><br></td>
<td class='edit' id='exit_buffer' style="text-align: right;"><?php echo ($user->data['exit_buffer']*100); ?></td><td>&nbsp%</td>
</tr>

<tr>
<td><?php echo $lang['MYACCOUNT_PROFIT_BUFFER']; ?><br><br></td>
<td class='edit' id='profit_buffer' style="text-align: right;"><?php echo ($user->data['profit_buffer']*100); ?></td><td>&nbsp%</td>
</tr>


<tr class="odd">
<td><?php echo $lang['MYACCOUNT_PROFIT_EXIT_ALERT']; ?><br><br></td>
<td class='edit' id='profit_exit_alert' style="text-align: right;"><?php echo ($user->data['profit_exit_alert']*100); ?></td><td>&nbsp%</td>
</tr>

<tr>
<td><?php echo $lang['MYACCOUNT_INVEST_LIMIT']; ?><br><br></td>
<td class='edit' id='invest_limit' style="text-align: right;"><?php echo ($user->data['invest_limit']*100); ?></td><td>&nbsp%</td>
</tr>

<tr class="odd">
<td><?php echo $lang['MYACCOUNT_INVEST_FREE_TRADE']; ?><br><br></td>
<td class='select' id='use_free_trade' style="text-align: right;"><?php echo $user->data['use_free_trade']; ?></td><td></td>
</tr>

</table>
</td>
</tr>
</table>
</center>
</center>


<p></p><p></p><p></p><p></p><p></p>