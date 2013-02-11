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


/*
------------------
Language: English
------------------

$lang[''] = '';
*/

$lang = array();

// Header
$lang['PAGE_TITLE']            = "MyIchimoku Web Application";

// Footer
$lang['FOOTER_TIMER']          = "Page generated in";
$lang['FOOTER_TIMER_2']        = "seconds.";

// Errors
$lang['ERROR_LOGGED_OUT']      = 'You need to log into the system to have access.';
$lang['ERROR_ACCES_VIOLATION'] = 'Don\'t even try. GET OUT!!';

// Ichimoku chart header
$lang['MONTHS']                = "['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']";
$lang['WEEK_DAYS']             = "['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']";
$lang['SHRT_MNTHS']            = "['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']";
$lang['DECIMAL_POINT']         = ',';
$lang['Ks_SEP']                = '.';

// Menu
$lang['MENU_LOGIN']            = 'Login';
$lang['MENU_ABOUT']            = 'About MyIchimoku';
$lang['MENU_HOME']             = 'Home';
$lang['MENU_ADMIN']            = 'Admin';
$lang['MENU_SCREENING']        = 'Screening';
$lang['MENU_PORTFOLIO']        = 'Portfolio';
$lang['MENU_PREFERENCES']      = 'Preferences';
$lang['MENU_OPTIONS']          = 'Options';
$lang['MENU_TRADING_PLAN']     = 'Trading Plan';
$lang['MENU_MY_ACCOUNT']       = 'My Account';
$lang['MENU_LOGOUT']           = 'Logout';


	// Drop down menu's
	
	// Login
	$lang['LOGIN_TITLE']       = 'Login to MyIchimoku';
	$lang['LOGIN_USER']        = 'User name or Email';
	$lang['LOGIN_PASSWORD']    = 'Password';
	$lang['LOGIN_REMEMBER_ME'] = 'Remember me?';
	$lang['LOGIN_BUTTON']      = 'Sign in';
	$lang['LOGIN_FORGOT']      = 'Forgot password?';
	
	// Screening
	$lang['SCREENING_TITLE']   = 'MyIchimoku Screener';
	$lang['SCREENING_STRENGT'] = 'Strenght:';
	$lang['SCREENING_QTY']     = 'Qty:';
	$lang['SCREENING_MARK']    = 'Market:';
	$lang['SCREENING_ALL']     = 'All';
	$lang['SCREENING_EUR']     = 'Europe';
	$lang['SCREENING_AMS']     = 'Amsterdam';
	$lang['SCREENING_PAR']     = 'Paris';
	$lang['SCREENING_BRU']     = 'Brussels';
	$lang['SCREENING_LIS']     = 'Lisbon';
	$lang['SCREENING_USA']     = 'USA';
	$lang['SCREENING_FOR']     = 'Forex';
	
	$lang['SCREENING_VOL']     = 'Volume:';
	$lang['SCREENING_500K']    = '> 500.000';
	$lang['SCREENING_100K']    = '> 100.000';
	$lang['SCREENING_50K']     = '>  50.000';
	$lang['SCREENING_10K']     = '<  50.000';
	$lang['SCREENING_ANY']     = 'Any';
	$lang['SCREENING_DATE']     = 'Date:';
	$lang['SCREENING_BUTTON']   = 'Go!';
	
	// Preferences
	$lang['PREFERENCES_FRONTPAGE_COLUMNS']    = 'Number of columns on frontpage:';
	$lang['PREFERENCES_FRONTPAGE_CHARTSIZE']  = 'Chart size on front-page:';
	$lang['PREFERENCES_POPUPS_COLUMNS']       = 'Number of columns in chart pop-ups:';
	$lang['PREFERENCES_POPUPS_CHARTSIZE']     = 'Chart size on pop-ups:';
	$lang['PREFERENCES_PAGES_CHARTSIZE']      = 'Chart size on pages:';
	$lang['PREFERENCES_PAGES_RANGESELECT']    = 'Chart range selection:';
	$lang['PREFERENCES_PAGES_2']              = '6 Months';
	$lang['PREFERENCES_PAGES_3']              = 'YTD';
	$lang['PREFERENCES_PAGES_4']              = '1 Year';
	$lang['PREFERENCES_PAGES_5']              = 'All';
	$lang['PREFERENCES_PORTFOLIO_CHARTS']     = 'Include charts in the portfolio page:<br>(has a significant impact on page loads)';
	$lang['PREFERENCES_PORTFOLIO_CHARTS_YES'] = 'Yes';
	$lang['PREFERENCES_PORTFOLIO_CHARTS_NO']  = 'No';
	$lang['PREFERENCES_MIN_ICHIVALUE']        = 'Minimum<br>Ichimoku signal:';
	$lang['PREFERENCES_MIN_ICHIVALUE_B']      = 'Minimum Ichimoku signal for Back Trading:';
	$lang['PREFERENCES_MIN_CLOUDBRVALUE']     = 'Minimum<br>Cloudbreak signal:';
	$lang['PREFERENCES_MIN_CLOUDBRVALUE_B']   = 'Minimum Cloudbreak signal for Reporting:';
	$lang['PREFERENCES_BUTTON']               = 'Set Preferences';
	$lang['PREFERENCES_TRADE_ICHI_SIGNAL']    = 'Minimum Ichimoku signal for Reporting:';
	$lang['PREFERENCES_TRADE_CIKOU_OS']       = 'Set the number of periods for Chikou to be<BR>above or below the price ("open space"):';
	$lang['PREFERENCES_TRADE_BUYWAIT']        = 'Set the number of periods to wait after a Sell<BR>signal before allowing a new Buy signal:';
	$lang['PREFERENCES_TRADE_DATE']           = 'Select the date for which we will show signals:';
	$lang['PREFERENCES_PAGE_REFRESH']         = 'Refresh the page:';
	$lang['PREFERENCES_PAGE_RECALCLINK']      = 'Recalculate all trade signals';
	$lang['PREFERENCES_PAGE_RECALCTITLE']     = 'ATTENTION: This will take about 30-45 minutes to be completed !!';
	$lang['PREFERENCES_PAGE_RECALCALERT']     = 'Are you sure you want to recalculate all Trade Signals? This will take about 30-45 minutes. You will receive an email when succesfully completed.';
	
	
	// Options
	$lang['OPTIONS_SELECT_LANG']     = 'Select the interface language:';
	$lang['OPTIONS_LANG_FR']         = 'Français';
	$lang['OPTIONS_LANG_UK']         = 'English';
	$lang['OPTIONS_LANG_NL']         = 'Nederlands';
	$lang['OPTIONS_TAX']             = 'Set tax reserve percentage:';
	$lang['OPTIONS_FISCAL']          = 'The fiscal year starts in:';
	$lang['OPTIONS_JANUARY']         = 'January';
	$lang['OPTIONS_FEBRUARY']        = 'February';
	$lang['OPTIONS_MARCH']           = 'March';
	$lang['OPTIONS_APRIL']           = 'April';
	$lang['OPTIONS_MAY']             = 'May';
	$lang['OPTIONS_JUNE']            = 'June';
	$lang['OPTIONS_JULY']            = 'July';
	$lang['OPTIONS_AUGUST']          = 'August';
	$lang['OPTIONS_SEPTEMBER']       = 'September';
	$lang['OPTIONS_OCTOBER']         = 'October';
	$lang['OPTIONS_NOVEMBER']        = 'November';
	$lang['OPTIONS_DECEMBER']        = 'December';
	$lang['OPTIONS_TRADESIGNALS']    = 'Receive daily Trade Signals Email:';
	$lang['OPTIONS_TRADESIGNALS_Y']  = 'Yes';
	$lang['OPTIONS_TRADESIGNALS_N']  = 'No';
	$lang['OPTIONS_MAIL']            = "Send me a 'wake-up' Email";
	$lang['OPTIONS_EVERY']           = 'every:';
	$lang['OPTIONS_DAY']             = 'Day';
	$lang['OPTIONS_MONDAY']          = 'Monday';
	$lang['OPTIONS_TUESDAY']         = 'Tuesday';
	$lang['OPTIONS_WEDNESDAY']       = 'Wednesday';
	$lang['OPTIONS_THURSDAY']        = 'Thursday';
	$lang['OPTIONS_FRIDAY']          = 'Friday';
	$lang['OPTIONS_SATURDAY']        = 'Saturday';
	$lang['OPTIONS_SUNDAY']          = 'Sunday';
	$lang['OPTIONS_MONTH']           = 'Month';
	$lang['OPTIONS_NEVER']           = 'Never';
	$lang['OPTIONS_SUBJECT']         = 'Subject';
	$lang['OPTIONS_CONTENT']         = 'Content';
	$lang['OPTIONS_BUTTON']          = 'Set Options';
	$lang['OPTIONS_MAIL_FOOTER']     = '<p></p><p></p>This email is brought to you by <b>MyIchimoku.eu</b><br>You can change the frequency and content of this email in the Options menu.';
	
	// The ? page
	$lang['ABOUT_AUTHOR']          = 'Developed by: ';
	$lang['ABOUT_VERSION']         = 'Application version: ';
	$lang['ABOUT_BLOG']            = 'Blog and Help: ';
	$lang['ABOUT_BLOG_PAGE']       = 'is here';
	$lang['ABOUT_LICENSE']         = 'License agreement: ';
	$lang['ABOUT_LICENSE_PAGE']    = 'is here';
	$lang['ABOUT_HOSTER']          = 'Hosted by:';
	$lang['ABOUT_HOSTER_NAME']     = '<a href="http://www.ovh.com/fr/hebergement_mutualise/hebergement_web_mutualise_pro_100go_trafic_illimite.xml">www.ovh.com</a>';	
	$lang['ABOUT_TECHS']           = 'This application uses standard open source software such as PHP, MySQL, JQuery (and a number of it\'s plug-in\'s) and probably a few others. Thanks!! :-) .<br>
									 In addition to this <a href="http://developer.yahoo.com/yql/">Yahoo! YQL</a> is used for stock data feeds though some historical data was provided by <a href="http://www.abcbourse.com/">ABC Bourse</a>.<br>
									 The JQuery charting plugin comes from <a href="http://www.highcharts.com/">Highcharts</a>.<br>
									 Icons are provided by <a href="http://www.doublejdesign.co.uk/">Doubje-J Design</a><br><br>
									 Last but not least: the Ichimoku trading basics where provided by <a href="http://www.linkedin.com/pub/manesh-patel/2/a08/a85">Manesh Patel</a> by use of <a href="http://www.amazon.com/Trading-Ichimoku-Clouds-Essential-Technical/dp/0470609931/">his book</a> which
									would never have happened if I wouldn\'t have had an impuls purchase of this book: 
									<a href="http://livre.fnac.com/a3630437/Daniel-Allemann-Les-secrets-de-trading-d-un-moine-bouddhiste">Secrets de trading d\'un moine bouddhiste</a> from
									<a href="http://www.choisirmavie.com/">Daniel Alleman</a>. MERCI Daniel! After 20 years of trading absence you got me back on track :-)';

	
// Home page

$lang['LATEST_UPDATE_TITLE']         = 'Latest database updates:';
$lang['LATEST_UPDATE_DATE']          = 'Date:';
$lang['LATEST_UPDATE_TIME']          = 'Time:';
$lang['LATEST_UPDATE_RECORDS']       = 'Instruments:';
$lang['LATEST_UPDATE_EURO']          = 'European Markets:';
$lang['LATEST_UPDATE_USA']           = 'United States:';
$lang['LATEST_UPDATE_FOREX']         = 'Foreign Exchange:';
$lang['ICHI_SIGNAL_TITLE']           = 'Strong Ichimoku Signals';
$lang['ICHI_SIGNAL_MARKET']          = 'Market';
$lang['ICHI_SIGNAL_PRICE']           = 'Price';
$lang['ICHI_SIGNAL_STRENGTH']        = 'Ichimoku<br>Strength';
$lang['ICHI_SIGNAL_DIRECTION']       = 'Trade<br>Direction';
$lang['ICHI_SIGNAL_EMPTY']           = 'No Trade Signals available for the selected date.';
$lang['ICHI_CLOUD_TITLE']            = 'Recent Cloud Breaks';
$lang['ICHI_CLOUD_STRENGTH']         = 'CloudBreak<br>Strength';
$lang['ICHI_CLOUD_NUMDAYS']          = 'Number<br>of Days';
$lang['ICHI_CLOUD_EMPTY']            = 'No Cloud Breaks available for the moment.';
$lang['ICHI_TRADE_TITLE']            = 'MyIchimoku Buy Signals on: ';
$lang['ICHI_TRADE_DIRECTION']        = 'Trade direction we show Buy signals for:';
$lang['ICHI_TRADE_BULLISH']          = 'Bullish';
$lang['ICHI_TRADE_BEARISH']          = 'Bearish';
$lang['ICHI_TRADE_BOTH']             = 'Both';
	
// Search result
$lang['SEARCHRESULTS_NO_RESULTS']    = 'Your search returned no results';
$lang['SEARCHRESULTS_SYMBOL']        = 'Symbol';
$lang['SEARCHRESULTS_NAME']          = 'Name';
$lang['SEARCHRESULTS_PRICE']         = 'Price';
$lang['SEARCHRESULTS_ACTION']        = 'Action';
$lang['SEARCHRESULTS_ADD_FAVORITES'] = 'Add to Favorites';
$lang['SEARCHRESULTS_IN_FAVORITES']  = 'Already in your Favorites';
$lang['SEARCHRESULTS_ADD_PORTFOLIO'] = 'Add to Portfolio';
$lang['SEARCHRESULTS_IN_PORTFOLIO']  = 'Already in your Portfolio';
$lang['SEARCHRESULTS_REMOVE']        = 'Remove from Favorites';
$lang['SEARCHRESULTS_SIGNAL']        = 'Ichimoku Signal Strength:';
$lang['SEARCHRESULTS_SIGNAL_INFO']   = 'The Ichimoku Signal Strength is on a scale from -13 (Bearish) to +13 (Bullish)';
$lang['SEARCHRESULTS_ADD_INFO']      = 'Additional Information';
$lang['SEARCHRESULTS_DETAILS']       = 'Instrument details';
$lang['SEARCHRESULTS_CONF_REMOVE']   = 'Are you sure you want to remove this instrument COMPLETELY from your favorites?';
$lang['SEARCHRESULTS_CHART_BUTTON']  = 'Show/Hide MyIchimoku Signal';
$lang['SEARCHRESULTS_BACKTRADE']     = 'Back Trade this Instrument';

	
// Portfolio
$lang['PORTFOLIO_TITLE_PORT']        = 'Portfolio';
$lang['PORTFOLIO_TITLE_FAV']         = 'Favorites';
$lang['PORTFOLIO_TITLE_HIS']         = 'History';
$lang['PORTFOLIO_ID']                = 'ID';
$lang['PORTFOLIO_NETRESULT']         = 'Net Result: ';
$lang['PORTFOLIO_LATEST_DATE']       = 'Latest Ichimoku update on: ';
$lang['PORTFOLIO_LATEST_TIME']       = 'at: ';
$lang['PORTFOLIO_PORT_EMPTY']        = 'The Portfolio is empty. Add an instrument via the search results or your favorites<br><br>';
$lang['PORTFOLIO_FAVO_EMPTY']        = 'You have no Favorites. Add an instrument via the search results';
$lang['PORTFOLIO_HISTO_EMPTY']       = 'You have no History yet. History can be created by moving Instruments from the Portfolio (see icons on the right side of the Portfolio table above).';
$lang['PORTFOLIO_AVAILABLE']         = 'Cash available<br>to invest:';
$lang['PORTFOLIO_AV_INV_SIZE']       = 'Average Investment Size:';

$lang['PORTFOLIO_SYMBOL']            = 'Symbol';
$lang['PORTFOLIO_INST_NAME']         = 'Instrument<br>Name';
$lang['PORTFOLIO_STRENGTH']          = 'Ichimoku<br>Strength';
$lang['PORTFOLIO_ICHI_HIGHER']       = 'Signal increase since last period.';
$lang['PORTFOLIO_ICHI_LOWER']        = 'Signal decrease since last period.';
$lang['PORTFOLIO_ICHI_SAME']         = 'No signal change since last period.';
$lang['PORTFOLIO_ICHI_L_WEEK']       = 'Strenght 5 periods ago:';
$lang['PORTFOLIO_ICHI_L_MONTH']      = 'Strenght 20 periods ago:';
$lang['PORTFOLIO_ADD_DATE']          = 'Entry<br>Date';
$lang['PORTFOLIO_ADD_PRICE']         = 'Entry<br>Price';
$lang['PORTFOLIO_CURR_PRICE']        = 'Current<br>Price';
$lang['PORTFOLIO_CURR_PRICE_NO_YQL'] = 'No live data available. Currently showing delayed data from the application database.';
$lang['PORTFOLIO_INTRA_DELTA']       = 'Intraday<br>Delta';
$lang['PORTFOLIO_PL']                = 'P/L';
$lang['PORTFOLIO_PLPERC']            = 'P/L %';
$lang['PORTFOLIO_DAYS']              = 'No<br>Days';
$lang['PORTFOLIO_TYPE']              = 'Type';
$lang['PORTFOLIO_COMMENTS']          = 'Comments';

$lang['PORTFOLIO_ENTRY_DATE']        = 'Entry<br>Date';
$lang['PORTFOLIO_ENTRY_PRICE']       = 'Entry<br>Price';
$lang['PORTFOLIO_QUANTITY']          = 'Quantity';
$lang['PORTFOLIO_INVESTED']          = 'Invested';
$lang['PORTFOLIO_INVESTED_COMMENT']  = 'You have invested more in this instrument than what is allowed by your trading plan.The maximimum allowed is:';
$lang['PORTFOLIO_STOPLOSS']          = 'Stop<br>Loss';
$lang['PORTFOLIO_DISTANCE_TENKAN']   = 'The distance between Price and Tenkan Sen is:';
$lang['PORTFOLIO_DISTANCE_SL']       = 'and the distance between Price and StopLoss is:';
$lang['PORTFOLIO_SUGGESTED_SL']      = 'Suggested StopLoss: ';
$lang['PORTFOLIO_EXITBUFFER1']       = 'Your trading plan indicates that you should exit this trade NOW!';
$lang['PORTFOLIO_EXITBUFFER2']       = 'The distance between Price & Tenkan Sen is';
$lang['PORTFOLIO_EXITBUFFER3']       = 'and therefore greater then';
$lang['PORTFOLIO_EXITBUFFER4']       = 'Tenkan Sen is FLAT';
$lang['PORTFOLIO_FREETRADE']         = 'Free<br>Trade';
$lang['PORTFOLIO_EXIT_DATE']         = 'Exit<br>Date';
$lang['PORTFOLIO_EXIT_PRICE']        = 'Exit<br>Price';
$lang['PORTFOLIO_NETPL']             = 'Net P/L';
$lang['PORTFOLIO_NETPLPERC']         = 'Net P/L %';
$lang['PORTFOLIO_COMMISION']         = 'Commision';
$lang['PORTFOLIO_TAX']               = 'Taxes';
$lang['PORTFOLIO_TAX_RESERVE']       = 'Tax reserve: ';
$lang['PORTFOLIO_KEYNOTES']          = 'Keynotes';
$lang['PORTFOLIO_ACTION']            = 'Action';

$lang['PORTFOLIO_EDIT']              = 'Edit this line';
$lang['PORTFOLIO_MOVE_HIST']         = 'Move to history';
$lang['PORTFOLIO_HIST_DELETE']       = 'Remove from History';
$lang['PORTFOLIO_HIST_TO_PORTFOLIO'] = 'Move back to Portfolio';
$lang['PORTFOLIO_HIST_ALERT']        = 'ARE YOU SURE YOU WANT TO DO THIS ???';
$lang['PORTFOLIO_ALERT_HIST']        = 'You will NOT be able to edit any data anymore. Are you sure you want to move this item to the History?';
$lang['PORTFOLIO_MOVE_PORT']         = 'Move to portfolio';
$lang['PORTFOLIO_DELETE']            = 'Remove from Portfolio';
$lang['PORTFOLIO_ALERT_DELETE']      = 'Are you sure you want to remove this item from your Portfolio?';
$lang['PORTFOLIO_FAV_DELETE']        = 'Remove from Favorites';
$lang['PORTFOLIO_ALERT_FAV_DELETE']  = 'Are you sure you want to remove this item from your Favorites?';
$lang['PORTFOLIO_SHOW_CHART']        = 'Show Ichimoku Chart';
$lang['PORTFOLIO_SHOW_PORTOLIO']     = 'Show details';

$lang['PORTFOLIO_ENTRY_RULES_TITLE'] = 'Entry Rules';
$lang['PORTFOLIO_ENTRY_RULES_COMM']  = 'T=Tenkan Sen, K=Kijun Sen and P=Price. Measures the distance in percent in reference to what is set in the Trading Plan. Both need to show green';
$lang['PORTFOLIO_TE_BULL_ENTRY_OK']  = 'T &rarr; P <';
$lang['PORTFOLIO_TE_BULL_ENTRY_WAIT']= 'T &rarr; P >';
$lang['PORTFOLIO_KI_BULL_ENTRY_OK']  = 'K &rarr; P <';
$lang['PORTFOLIO_KI_BULL_ENTRY_WAIT']= 'K &rarr; P >';
$lang['PORTFOLIO_ENRTY_SL_TITLE']    = 'StopLoss';

// Trading Plan
$lang['TRADINGPLAN_TAB_RULES']       = 'Ichimoku Rules';
$lang['TRADINGPLAN_TAB_PLAN']        = 'Trading Plan';
$lang['TRADINGPLAN_TAB_ENTRY']       = 'Entry Rules';
$lang['TRADINGPLAN_TAB_MONEY']       = 'Money Management';
$lang['TRADINGPLAN_TP_TITLE']        = 'Trading Rules';
$lang['TRADINGPLAN_ER_BULL_TITLE']   = 'Bullish Entry Rules';
$lang['TRADINGPLAN_ER_BEAR_TITLE']   = 'Bearish Entry Rules';
$lang['TRADINGPLAN_MM_BULL_TITLE']   = 'Bullish Money Management';
$lang['TRADINGPLAN_MM_BEAR_TITLE']   = 'Bearish Money Management';
$lang['TRADINGPLAN_MM_PERC']         = '%';
$lang['TRADINGPLAN_TP_ADD']          = 'Add';
$lang['TRADINGPLAN_TP_REMOVE']       = 'Remove';

// Chart Pop-ups & Flags
$lang['CHARTPOPUP_TITLE_PORT']       = 'Portfolio';
$lang['CHARTPOPUP_TITLE_FAVO']       = 'Favorites';
$lang['CHARTPOPUP_TITLE_SCREEN']     = 'MyIchimoku Screener Results';
$lang['CHARTPOPUP_TITLE_CLOUDBREAK'] = 'MyIchimoku Cloudbreaks';
$lang['CHARTPOPUP_TITLE_BUYSIGNALS'] = 'MyIchimoku Buy Signals';
$lang['CHARTPOPUP_DETAILS']          = 'Show details page';
$lang['CHARTPOPUP_SHOWCHARTS']       = 'Show charts';
$lang['CHARTPOPUP_SHOWCHARTS_TITLE'] = 'Please note that loading the charts may take a moment if the list is long.';

$lang['CHARTFLAG_ENTRY']             = 'Entry';
$lang['CHARTFLAG_ENTRY_PRICE']       = 'Entry Price: ';
$lang['CHARTFLAG_EXIT']              = 'Exit';
$lang['CHARTFLAG_EXIT_PRICE']        = 'Exit Price: ';
$lang['CHARTFLAG_GAIN']              = 'Gain: ';

// MyAccount
$lang['MYACCOUNT_CAPTION']           = 'MyIchimoku Account Details';
$lang['MYACCOUNT_USERNAME']          = 'User name:';
$lang['MYACCOUNT_FIRSTNAME']         = 'First name:';
$lang['MYACCOUNT_LASTNAME']          = 'Last name:';
$lang['MYACCOUNT_EMAIL']             = 'Email:';
$lang['MYACCOUNT_PASSWORD']          = 'Change Password:';
$lang['MYACCOUNT_CLICK']             = 'Click here';
$lang['MYACCOUNT_ACCESS_TITLE']      = 'User type:';
$lang['MYACCOUNT_CURRENCY']          = 'Currency code:';
$lang['MYACCOUNT_CURRENCY_COMMENT']  = 'Use 3 characters maximum. No symbols such as € supported :-(';
$lang['MYACCOUNT_LEVEL_1']           = 'Standard user';
$lang['MYACCOUNT_LEVEL_4']           = 'Advanced user';
$lang['MYACCOUNT_LEVEL_9']           = 'Admin user';
$lang['MYACCOUNT_SIGNALSETTINGS']    = 'Trade Signal Settings';
$lang['MYACCOUNT_BACKTRADING']       = 'Back Trading:';
$lang['MYACCOUNT_BACKTRADING_INFO']  = 'ALERT: Backtrading slows down the chart generation and shows signals independant from your Trading Signals Settings. This means that Buy & Sell signals on the charts may not correspond to the Buy & Sell signals in the reporting.';
$lang['MYACCOUNT_BACKTRADING_ALERT'] = 'Back Trading';

$lang['MYACCOUNT_TRADINGPLAN']       = 'Trading Plan Variables';
$lang['MYACCOUNT_GENERAL']           = 'General';
$lang['MYACCOUNT_BULL_ENTRY']        = 'Bullish<br>Entry Rules';
$lang['MYACCOUNT_BEAR_ENTRY']        = 'Bearish<br>Entry Rules';
$lang['MYACCOUNT_MONEY_MGT']         = 'Money<br>Management';
$lang['MYACCOUNT_TRAD_CAPITAL']      = 'Trading Capital:';
$lang['MYACCOUNT_TRAD_CAP_MAX']      = 'Maximum Trade size allowed:';
$lang['MYACCOUNT_MIN_VOLUME']        = 'Minimum daily volume:';
$lang['MYACCOUNT_BULL_ENTRY_TENKAN'] = 'Entry price has to be less than x% from Tenkan Sen:';
$lang['MYACCOUNT_BULL_ENTRY_KIJUN']  = 'Entry price has to be less than x% from Kijun Sen:';
$lang['MYACCOUNT_BULL_ENTRY_BUFFER'] = 'Entry buffer (suggests StopLoss at trade entry):';
$lang['MYACCOUNT_BEAR_ENTRY_TENKAN'] = 'Entry price has to be less than x% from Tenkan Sen:';
$lang['MYACCOUNT_BEAR_ENTRY_KIJUN']  = 'Entry price has to be less than x% from Kijun Sen:';
$lang['MYACCOUNT_BEAR_ENTRY_BUFFER'] = 'Entry buffer (suggests StopLoss at trade entry):';
$lang['MYACCOUNT_EXIT_BUFFER']       = 'Exit alert: If price is > x% away from Tenkan Sen, exit the trade if Tenkan Sen is flat:';
$lang['MYACCOUNT_PROFIT_BUFFER']     = 'If profit is greater than x%, use Tenkan Sen + exit buffer as your stop loss:';
$lang['MYACCOUNT_PROFIT_EXIT_ALERT'] = 'Exit buffer (used to suggest StopLoss order level):';
$lang['MYACCOUNT_INVEST_LIMIT']      = 'Invest a maximum of x% of your available trading capital:';
$lang['MYACCOUNT_INVEST_FREE_TRADE'] = 'Also permitted to invest the capital equivalent of your Free Trades?';

$lang['MYACCOUNT_PASSWORD_TITLE']    = 'Reset your password';
$lang['MYACCOUNT_PASSWORD_INSTRUCT'] = 'Enter the email associated with your account.';
$lang['MYACCOUNT_PASSWORD_LABEL']    = 'Email:';
$lang['MYACCOUNT_PASSWORD_BUTTON']   = 'Reset Password';
$lang['MYACCOUNT_PASSWORD_MAILSENT'] = 'Please check your email in order to proceed with the email change procedure.';
$lang['MYACCOUNT_PASSWORD_TITLE2']   = 'Change Password';
$lang['MYACCOUNT_PASSWORD_LABEL2']   = 'New Password:';
$lang['MYACCOUNT_PASSWORD_LABEL3']   = 'Retype New Password:';
$lang['MYACCOUNT_PASSWORD_BUTTON2']  = 'Change Password';
$lang['MYACCOUNT_PASSWORD_CHANGED']  = 'Password Changed';

// Account Request
$lang['ACCOUNT_REQUEST_TITLE']       = 'MyIchimoku Account Request Form';
$lang['ACCOUNT_REQUEST_INFO']        = 'Accounts are free of charge at this moment in time, but not automatically granted. DO read the Terms & Conditions. They ARE important!';
$lang['ACCOUNT_REQUEST_USER']        = 'User name:';
$lang['ACCOUNT_REQUEST_FIRSTNAME']   = 'First name:';
$lang['ACCOUNT_REQUEST_LASTNAME']    = 'Last name:';
$lang['ACCOUNT_REQUEST_EMAIL']       = 'Email:';
$lang['ACCOUNT_REQUEST_LANGUAGE']    = 'Language:';
$lang['ACCOUNT_REQUEST_PASSWORD']    = 'Password:';
$lang['ACCOUNT_REQUEST_PASSWORD2']   = 'Re-enter password:';
$lang['ACCOUNT_REQUEST_BUTTON']      = 'Request Account';
$lang['ACCOUNT_REQUEST_REQUIRED']    = 'Required field';
$lang['ACCOUNT_REQUEST_MAILSUBJECT'] = 'MyIchimoku Account Request from: ';
$lang['ACCOUNT_REQUEST_MAIL_HI']     = 'Hi there ';
$lang['ACCOUNT_REQUEST_MAIL_BODY']   = 'Thanks for requesting an account at MyIchimoku.eu<br>
										An email has been sent to the site admin and will respond to you shortly (typically within 24-48hrs).<br>
										<br>
										Best regards,<br>
										Oscar';
$lang['ACCOUNT_REQUEST_MESSAGE']     = 'An Email has been sent to the site admin with your Account Request and will respond to you shortly (typically within 24-48hrs).';

$lang['ACCOUNT_ACTIVATED_SUBJECT']   = 'MyIchimoku Account activated :-)';
$lang['ACCOUNT_ACTIVATED_HI']        = 'Hi ';
$lang['ACCOUNT_ACTIVATED_MESSAGE']   = "Your account has been activated and you can now login to the system at:<br>
										<a href='http://MyIchimoku.eu/'>http://MyIchimoku.eu</a>, using the credentials you have provided previously.<br>
										<br>
										Remember, this application is still under heavy development and at times can be buggy.<br>
										Not all planned features are live either :-)<br>
										No panic though, I use the application myself so have a big interest in keeping it up an running.<br>
										You might however see some changes appear or see bugs temporarily appear as I code along (typically at night).<br>
										<br>
										On some of the screens you might wonder how to update any information. Just click on the area that you would like to update<br>
										and you will notice that they become editable (cool, huh?). Saving the data you do by either hitting your 'Enter' button or click outside of the box somewhere.<br>
										<br>
										If you don't know much about Ichimoku Kinko Hyo (yeah, what a name!) or trading in general, have a look<br>
										on my <a href='http://www.linkedin.com/profile/view?trk=tab_pro&id=11579649'>LinkedIn page</a>, at the bottom you will find some books that might be of interest.<br>
										So before you ask any questions, I invite you to do some research yourself ;-)<br>
										<br>
										With regards to updates, you might also want to check out the public web pages from time to time on <a href='http://myichimoku.eu/cms/'>this location</a> (nothing to see yet).<br><br>
										Oh, and last but not least, the application works best using <b>Google Chrome</b>.<br>
										Firefox is not too bad, but M$ Internet Explorer will certainly NOT work.<br>
										<br>
										Have Fun !!<br>
										Oscar";


// Terms and Conditions
$lang['TC_AND_CS']					 = '<br><center><b>Terms and Conditions:</b></center><br>
										
										1.  The use of the MyIchimoku website, the associated features and the provided<br> data is at your own risk and for your own responsability.<br><br>
										2.  No direct or implied guarantee of availability of the MyIchimoku.eu website and its<br> associated features.<br><br>
										3.  No direct or implied guarantee of the provided service nor of the provided data.<br><br>
										4.  The Software is under development and therefore <i>can not be considered stable</i>. <br>Any complaints you will keep to yourself. <br>Feel free to share any constructive feedback though.<br><br>
										5.  Requests for features and functionality will not be considered. <br>Suggestions and great ideas may be considered at the site owners descretion.<br><br>
										6.  It is not because you request access to this tool that you will gain access.<br> Approvals are at the site owner descretion. To say the least, I will need to know you.<br> If you landed on this page by accident it is likely that access will not be granted<br>and this without any further justification/explaination. :-) <br><br>
										7.  Though access is free of charge at this moment in time, this might change in the future.<br><br>
										8.  No attempts to hacking or otherwise trying to damage the software and/or the database<br>content is permitted (BTW: logs are being kept and <i>Big Brother IS watching you!</i>).<br> Any violation of this condition may lead to prosecution at the site owners descretion.<br><br>
										9.  Access to the MyIchimoku website and associated features may be terminated by <br>both the user and the site owner at any time and without any further explaination.<br><br>
										10. Other than personal financial gain, the MyIchimoku website, its features and<br> information CAN NOT be used, directly or indirectly, for any commercial benefit to you.<br><br>
										11. Though some of the site content is available in several languages, you agree<br> that English is the single language of reference in relation to this site and service.<br><br>
										12. These conditions may be changed at any time by the site owner.<br><br>
										13. The application is being developed with standards as open as possible. <b>Chrome</b> <br>is the browser of reference. If you try to use another browser and discover that the<br> application does not function correctly you have been warned,<br>so please keep negative feelings about this to yourself.<br><br>
										14. <b>By clicking on the <Request Account> button below you understand, accept and agree to all of the above.</b><br>

										';
										
// Admin

$lang['ADMIN_TITLE_USERS']     = 'Registered Users';
$lang['ADMIN_USER_ID']         = 'User<br>ID:';
$lang['ADMIN_USER_NAME']       = 'User<br>Name:';
$lang['ADMIN_USER_FIRST']      = 'First<br>Name:';
$lang['ADMIN_USER_LAST']       = 'Last<br>Name:';
$lang['ADMIN_USER_EMAIL']      = 'Email:';
$lang['ADMIN_USER_ACTIVATED']  = 'Activated:';
$lang['ADMIN_USER_REGDATE']    = 'Registration<br>Date:';
$lang['ADMIN_USER_LAST_LOGON'] = 'Last<br>Logon:';
$lang['ADMIN_USER_GROUPID']    = 'Access<br>Level:';
$lang['ADMIN_USER_LANGUAGE']   = 'Language:';

$lang['ADMIN_TITLE_STATS1']    = 'Page views per user over last 10 days';
$lang['ADMIN_COLUMN_PAGES']    = 'Pages:';

?>