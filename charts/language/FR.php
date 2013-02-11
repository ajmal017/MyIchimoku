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
Language: Français
------------------
*/

$lang = array();

// Header
$lang['PAGE_TITLE']            = "MyIchimoku Application Web";

// Errors
$lang['ERROR_LOGGED_OUT']      = 'Tu doit te connecter au sysème afin de pouvoir l\'utiliser.';
$lang['ERROR_ACCES_VIOLATION'] = 'Don\'t even try. GET OUT!!.';

// Ichimoku chart header
$lang['MONTHS']                = "['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre']";
$lang['WEEK_DAYS']             = "['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi']";
$lang['SHRT_MNTHS']            = "['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sept', 'Oct', 'Nov', 'Dec']";
$lang['DECIMAL_POINT']         = ',';
$lang['Ks_SEP']                = '.';

// Menu
$lang['MENU_LOGIN']            = 'Connection';
$lang['MENU_ABOUT']            = 'Concernant MyIchimoku';
$lang['MENU_HOME']             = 'Accueil';
$lang['MENU_ADMIN']            = 'Admin';
$lang['MENU_SCREENING']        = 'Criblage';
$lang['MENU_PORTFOLIO']        = 'Portefeuille';
$lang['MENU_PREFERENCES']      = 'Préferences';
$lang['MENU_OPTIONS']          = 'Options';
$lang['MENU_TRADING_PLAN']     = 'Plan de Trading';
$lang['MENU_MY_ACCOUNT']       = 'Mon Compte';
$lang['MENU_LOGOUT']           = 'Déconnecter';


	// Drop down menu's
	
	// Login
	$lang['LOGIN_TITLE']       = 'Se connecter à MyIchimoku';
	$lang['LOGIN_USER']        = 'Nom d\'utilisateur ou Email';
	$lang['LOGIN_PASSWORD']    = 'Mot de passe';
	$lang['LOGIN_REMEMBER_ME'] = 'S\'en souvenir?';
	$lang['LOGIN_BUTTON']      = 'Se connecter';
	$lang['LOGIN_FORGOT']      = 'Mot de passe oublié?';
	
	// Screening
	$lang['SCREENING_TITLE']   = 'Scribleur MyIchimoku';
	$lang['SCREENING_STRENGT'] = 'Puisance:';
	$lang['SCREENING_QTY']     = 'Qté:';
	$lang['SCREENING_MARK']    = 'Marché:';
	$lang['SCREENING_ALL']     = 'Tout';
	$lang['SCREENING_EUR']     = 'Europe';
	$lang['SCREENING_AMS']     = 'Amsterdam';
	$lang['SCREENING_PAR']     = 'Paris';
	$lang['SCREENING_BRU']     = 'Bruxelles';
	$lang['SCREENING_LIS']     = 'Lisboa';
	$lang['SCREENING_USA']     = 'USA';
	$lang['SCREENING_FOR']     = 'Forex';
	
	$lang['SCREENING_VOL']     = 'Volume:';
	$lang['SCREENING_500K']    = '> 500.000';
	$lang['SCREENING_100K']    = '> 100.000';
	$lang['SCREENING_50K']     = '>  50.000';
	$lang['SCREENING_10K']     = '<  50.000';	
	$lang['SCREENING_ANY']     = 'n\'importe';
	$lang['SCREENING_DATE']    = 'Date:';
	$lang['SCREENING_BUTTON']  = 'On y go!';
	
	// Preferences
	$lang['PREFERENCES_FRONTPAGE_COLUMNS']    = 'Nombre de colonnes sur la page principale:';
	$lang['PREFERENCES_FRONTPAGE_CHARTSIZE']  = 'Taille de la graphique sur la page principale:';
	$lang['PREFERENCES_POPUPS_COLUMNS']       = 'Nombre de colonnes dans les pop-ups:';
	$lang['PREFERENCES_POPUPS_CHARTSIZE']     = 'Taille de la grphique dans les pop-ups:';
	$lang['PREFERENCES_PAGES_CHARTSIZE']      = 'Taille de la graphique sur sur les pages:';
	$lang['PREFERENCES_BUTTON']               = 'Envoyer les Préférences';
	
	
	// Options
	$lang['OPTIONS_SELECT_LANG']     = 'Selectionne la langue de l\'interface:';
	$lang['OPTIONS_LANG_FR']         = 'Français';
	$lang['OPTIONS_LANG_UK']         = 'English';
	$lang['OPTIONS_LANG_NL']         = 'Nederlands';
	$lang['OPTIONS_TAX']             = 'Définir le pourcentage de réserve pour les impôts:';
	$lang['OPTIONS_FISCAL']          = 'L\'année fiscale commence en:';
	$lang['OPTIONS_JANUARY']         = 'Janvier';
	$lang['OPTIONS_FEBRUARY']        = 'Février';
	$lang['OPTIONS_MARCH']           = 'Mars';
	$lang['OPTIONS_APRIL']           = 'Avril';
	$lang['OPTIONS_MAY']             = 'Mai';
	$lang['OPTIONS_JUNE']            = 'Juin';
	$lang['OPTIONS_JULY']            = 'Juillet';
	$lang['OPTIONS_AUGUST']          = 'Aout';
	$lang['OPTIONS_SEPTEMBER']       = 'Septembre';
	$lang['OPTIONS_OCTOBER']         = 'Octobre';
	$lang['OPTIONS_NOVEMBER']        = 'Novembre';
	$lang['OPTIONS_DECEMBER']        = 'Decembre';
	$lang['OPTIONS_MAIL']            = "Reveille moi par Email";
	$lang['OPTIONS_EVERY']           = 'tout les:';
	$lang['OPTIONS_DAY']             = 'Jours';
	$lang['OPTIONS_MONDAY']          = 'Lundi';
	$lang['OPTIONS_TUESDAY']         = 'Mardi';
	$lang['OPTIONS_WEDNESDAY']       = 'Mercredi';
	$lang['OPTIONS_THURSDAY']        = 'Jeudi';
	$lang['OPTIONS_FRIDAY']          = 'Vendredi';
	$lang['OPTIONS_SATURDAY']        = 'Samedi';
	$lang['OPTIONS_SUNDAY']          = 'Dimanche';
	$lang['OPTIONS_MONTH']           = 'Mois';
	$lang['OPTIONS_NEVER']           = 'Jamais';
	$lang['OPTIONS_SUBJECT']         = 'Sujet';
	$lang['OPTIONS_CONTENT']         = 'Contenu';
	$lang['OPTIONS_BUTTON']          = 'Envoyer ses Options';
	$lang['OPTIONS_MAIL_FOOTER']     = '<p></p><p></p>Cet Email vous est fournit par <b>MyIchimoku.eu</b><br>Tu peut changer la fréquence avc laquelle tu les reçoi dans le menu des Options.';
	
	
// Search result
$lang['SEARCHRESULTS_NO_RESULTS']    = 'Ta recherche n\'a apporté aucun résultat.';
$lang['SEARCHRESULTS_SYMBOL']        = 'Symbole';
$lang['SEARCHRESULTS_NAME']          = 'Nom';
$lang['SEARCHRESULTS_PRICE']         = 'Prix';
$lang['SEARCHRESULTS_ACTION']        = 'Action';
$lang['SEARCHRESULTS_ADD_FAVORITES'] = 'Ajouter aux Favoris';
$lang['SEARCHRESULTS_ADD_PORTFOLIO'] = 'Ajouter a la Portefeuille';
$lang['SEARCHRESULTS_REMOVE']        = 'Supprimer des Favoris';
$lang['SEARCHRESULTS_SIGNAL']        = 'Puissance du Signal Ichimoku:';
$lang['SEARCHRESULTS_SIGNAL_INFO']   = 'La puissance du signal Ichimoku est mésuré sur une échèlle de -10 (Bearish/Baissent) à +10 (Bullish/Montant)';
$lang['SEARCHRESULTS_ADD_INFO']      = 'Informations supplémentaire';
$lang['SEARCHRESULTS_DETAILS']       = 'Détails de l\'instrument';
$lang['SEARCHRESULTS_CONF_REMOVE']   = 'Est-ce que tu est sur de vouloir supprimer cet instrument de tes Favoris?';
	
// Portfolio
$lang['PORTFOLIO_TITLE_PORT']        = 'Portefeuille';
$lang['PORTFOLIO_TITLE_FAV']         = 'Favoris';
$lang['PORTFOLIO_TITLE_HIS']         = 'Historique';
$lang['PORTFOLIO_ID']                = 'ID';
$lang['PORTFOLIO_NETRESULT']         = 'Resultat net:';
$lang['PORTFOLIO_LATEST_DATE']       = 'Dernière mis a jour Ichimoku le: ';
$lang['PORTFOLIO_LATEST_TIME']       = 'à ';
$lang['PORTFOLIO_PORT_EMPTY']        = 'Le portefeuille est vide. Ajoute un instrument en utilisent la fonction de recherche ou tes Favoris';
$lang['PORTFOLIO_FAVO_EMPTY']        = 'Il n\'y a pas de Favoris. Ajoute un instrument en utilisent la fonction de recherche.';
$lang['PORTFOLIO_AVAILABLE']         = 'Cash disponible<br>pour investir:';
$lang['PORTFOLIO_AV_INV_SIZE']       = 'Montant moyen d\'investissement:';

$lang['PORTFOLIO_SYMBOL']            = 'Symbole';
$lang['PORTFOLIO_INST_NAME']         = 'Nom<br>Instrument';
$lang['PORTFOLIO_STRENGTH']          = 'Signal<br>Ichimoku';
$lang['PORTFOLIO_ICHI_HIGHER']       = 'Augmentation du signal depuis la dernière période.';
$lang['PORTFOLIO_ICHI_LOWER']        = 'Diminution du signal depuis la dernière période.';
$lang['PORTFOLIO_ICHI_SAME']         = 'Pas de changement du signal depuis la dernière période.';
$lang['PORTFOLIO_ICHI_L_WEEK']       = 'Signal il y a 5 periodes:';
$lang['PORTFOLIO_ICHI_L_MONTH']      = 'Signal il y a  20 periodes:';
$lang['PORTFOLIO_ADD_DATE']          = 'Date<br>Ajouté';
$lang['PORTFOLIO_ADD_PRICE']         = 'Prix<br>Ajouté';
$lang['PORTFOLIO_CURR_PRICE']        = 'Prix<br>Actuel';
$lang['PORTFOLIO_CURR_PRICE_NO_YQL'] = 'Pas de données en direct disponible. Actuellement les données de a base de données (données donc retardé) sont affiché.';
$lang['PORTFOLIO_INTRA_DELTA']       = 'Intraday<br>Delta';
$lang['PORTFOLIO_PL']                = 'B/P';
$lang['PORTFOLIO_PLPERC']            = 'B/P %';
$lang['PORTFOLIO_DAYS']              = 'No<br>Jours';
$lang['PORTFOLIO_TYPE']              = 'Type';
$lang['PORTFOLIO_COMMENTS']          = 'Commentaires';

$lang['PORTFOLIO_ENTRY_DATE']        = 'Date<br>Achat';
$lang['PORTFOLIO_ENTRY_PRICE']       = 'Prix<br>Achat';
$lang['PORTFOLIO_QUANTITY']          = 'Quantité';
$lang['PORTFOLIO_INVESTED']          = 'Investi';
$lang['PORTFOLIO_INVESTED_COMMENT']  = 'Tu a investi plus que tu est autorisé sur cet instrument. Le maximum autorisé est:';
$lang['PORTFOLIO_STOPLOSS']          = 'Stop<br>Loss';
$lang['PORTFOLIO_DISTANCE_TENKAN']   = 'La distance entre le Prix et Tenkan Sen est:';
$lang['PORTFOLIO_DISTANCE_SL']       = 'et la distance entre le Prix et le StopLoss est:';
$lang['PORTFOLIO_EXITBUFFER1']       = 'Ton Plan de Trading indique que tu doit sortir de ce trade MAINTENANT!';
$lang['PORTFOLIO_EXITBUFFER2']       = 'La distance entre le Prix & Tenkan Sen est';
$lang['PORTFOLIO_EXITBUFFER3']       = 'et du coup, plus grand que';
$lang['PORTFOLIO_EXITBUFFER4']       = 'Tenkan Sen est is PLAT';
$lang['PORTFOLIO_FREETRADE']         = 'Free<br>Trade';
$lang['PORTFOLIO_EXIT_DATE']         = 'Date<br>Sortie';
$lang['PORTFOLIO_EXIT_PRICE']        = 'Prix<br>Sortie';
$lang['PORTFOLIO_NETPL']             = 'B/P net';
$lang['PORTFOLIO_NETPLPERC']         = 'B/P % net';
$lang['PORTFOLIO_COMMISION']         = 'Commission';
$lang['PORTFOLIO_TAX']               = 'Taxes';
$lang['PORTFOLIO_KEYNOTES']          = 'Commentaires étendu';
$lang['PORTFOLIO_ACTION']            = 'Action';

$lang['PORTFOLIO_EDIT']              = 'Modifier cette ligne';
$lang['PORTFOLIO_MOVE_HIST']         = 'Transférer vers l\'historique';
$lang['PORTFOLIO_MOVE_PORT']         = 'Transférer vers le Portefeuille';
$lang['PORTFOLIO_DELETE']            = 'Supprimer du Portefeuille';
$lang['PORTFOLIO_ALERT_DELETE']      = 'Est-ce que t\'est sur de vouloir supprimer cet instrument de ton portefeuille?';
$lang['PORTFOLIO_FAV_DELETE']        = 'Supprimer des Favoris';
$lang['PORTFOLIO_ALERT_FAV_DELETE']  = 'Est-ce que t\'est sur de vouloir supprimer cet instrument de tes Favoris?';
$lang['PORTFOLIO_SHOW_CHART']        = 'Montrer la graphique Ichimoku';

$lang['PORTFOLIO_ENTRY_RULES_TITLE'] = 'Règles d\'Achat';
$lang['PORTFOLIO_ENTRY_RULES_COMM']  = 'T=Tenkan Sen, K=Kijun Sen et P=Prix. Mésure la distance en pourcentage en reférence du contenue de ton Plan de Trading. Les deux doivent être vert';
$lang['PORTFOLIO_TE_BULL_ENTRY_OK']  = 'T &rarr; P <';
$lang['PORTFOLIO_TE_BULL_ENTRY_WAIT']= 'T &rarr; P >';
$lang['PORTFOLIO_KI_BULL_ENTRY_OK']  = 'K &rarr; P <';
$lang['PORTFOLIO_KI_BULL_ENTRY_WAIT']= 'K &rarr; P >';
$lang['PORTFOLIO_ENRTY_SL_TITLE']    = 'StopLoss';

// Trading Plan
$lang['TRADINGPLAN_TAB_RULES']       = 'Règles Ichimoku';
$lang['TRADINGPLAN_TAB_PLAN']        = 'Plan de Trading';
$lang['TRADINGPLAN_TAB_ENTRY']       = 'Règles d\'Achat';
$lang['TRADINGPLAN_TAB_MONEY']       = 'Gestion d\'Argent';
$lang['TRADINGPLAN_TP_TITLE']        = 'Règles de Trading';
$lang['TRADINGPLAN_ER_BULL_TITLE']   = 'Règles d\'Achat Bullish/Hausse';
$lang['TRADINGPLAN_ER_BEAR_TITLE']   = 'Règles d\'Achat Bearish/Baisse';
$lang['TRADINGPLAN_MM_BULL_TITLE']   = 'Gestion d\'argent en Bullish/Hausse';
$lang['TRADINGPLAN_MM_BEAR_TITLE']   = 'Gestion d\'argent en Bearish/Baisset';
$lang['TRADINGPLAN_MM_PERC']         = '%';
$lang['TRADINGPLAN_TP_ADD']          = 'Ajouter';
$lang['TRADINGPLAN_TP_REMOVE']       = 'Supprimere';

// Chart Pop-ups
$lang['CHARTPOPUP_TITLE_PORT']       = 'Portefeuille';
$lang['CHARTPOPUP_TITLE_FAVO']       = 'Favoris';
$lang['CHARTPOPUP_TITLE_SCREEN']     = 'Résultats Scribleur MyIchimoku';
$lang['CHARTPOPUP_TITLE_CLOUDBREAK'] = 'Les Cloudbreaks';
$lang['CHARTPOPUP_DETAILS']          = 'Montrer la page de détails';

// MyAccount
$lang['MYACCOUNT_CAPTION']           = 'Mon Compte MyIchimoku en Détails';
$lang['MYACCOUNT_USERNAME']          = 'Nom d\'utilisateur:';
$lang['MYACCOUNT_FIRSTNAME']         = 'Prénom:';
$lang['MYACCOUNT_LASTNAME']          = 'Nom de famille:';
$lang['MYACCOUNT_EMAIL']             = 'Email:';
$lang['MYACCOUNT_PASSWORD']          = 'Changer le mot de passe:';
$lang['MYACCOUNT_CLICK']             = 'Clicquer ici';
$lang['MYACCOUNT_ACCESS_TITLE']      = 'Type d\'utilisateur:';
$lang['MYACCOUNT_CURRENCY']          = 'Abbréviation devise:';
$lang['MYACCOUNT_CURRENCY_COMMENT']  = 'Utilise 3 caractère maximum. Les symboles comme € ou $ ne peuvent être utilisé :-(';
$lang['MYACCOUNT_LEVEL_1']           = 'Utilisateur standard';
$lang['MYACCOUNT_LEVEL_9']           = 'Administrateur';

$lang['MYACCOUNT_TRADINGPLAN']       = 'Variables du Plan de Trading';
$lang['MYACCOUNT_GENERAL']           = 'Général';
$lang['MYACCOUNT_BULL_ENTRY']        = 'Règles d\'Achat<br>Bullish/Hausse';
$lang['MYACCOUNT_BEAR_ENTRY']        = 'Règles d\'Achat<br>Bearish/Baisse';
$lang['MYACCOUNT_MONEY_MGT']         = 'Gestion<br>d\'Argent';
$lang['MYACCOUNT_TRAD_CAPITAL']      = 'Capital disponible:';
$lang['MYACCOUNT_TRAD_CAP_MAX']      = 'Taille maximum d\'un investissement:';
$lang['MYACCOUNT_MIN_VOLUME']        = 'Volume minimum journalier:';
$lang['MYACCOUNT_BULL_ENTRY_TENKAN'] = 'Le prix d\'achat doit être moins de x% du Tenkan Sen:';
$lang['MYACCOUNT_BULL_ENTRY_KIJUN']  = 'Le prix d\'achat doit être moins de x% du Kijun Sen:';
$lang['MYACCOUNT_BULL_ENTRY_BUFFER'] = 'Tampon a l\'achat (suggère le StopLoss a l\'achat):';
$lang['MYACCOUNT_BEAR_ENTRY_TENKAN'] = 'Le prix d\'achat doit être moins de x% du Tenkan Sen:';
$lang['MYACCOUNT_BEAR_ENTRY_KIJUN']  = 'Le prix d\'achat doit être moins de x% du Kijun Sen:';
$lang['MYACCOUNT_BEAR_ENTRY_BUFFER'] = 'Tampon a l\'achat (suggère le StopLoss a l\'achat):';
$lang['MYACCOUNT_EXIT_BUFFER']       = 'Alerte de sortie: Quand la différence entre le prix et Tenkan Sen est > x% , sort de ton investissement si Tenkan Sen est plat:';
$lang['MYACCOUNT_PROFIT_BUFFER']     = 'Si le profit est plus que x%, utilise Tenkan Sen + le tampon de sortie comme le StopLoss:';
$lang['MYACCOUNT_PROFIT_EXIT_ALERT'] = 'Tampon de sortie (utilisé pour prposer le StopLoss):';
$lang['MYACCOUNT_INVEST_LIMIT']      = 'Investi au maximum x% de ton capital disponible:';
$lang['MYACCOUNT_INVEST_FREE_TRADE'] = 'Permet également d\'investir le montant équivalent des investissement qui sont en FreeTrade?';

$lang['MYACCOUNT_PASSWORD_TITLE']    = 'Ré-initialier le mot de passe';
$lang['MYACCOUNT_PASSWORD_INSTRUCT'] = 'Saisi le mot de passe associé avec votre compte.';
$lang['MYACCOUNT_PASSWORD_LABEL']    = 'Email:';
$lang['MYACCOUNT_PASSWORD_BUTTON']   = 'Réinitialiser';
$lang['MYACCOUNT_PASSWORD_MAILSENT'] = 'Verifie ton email afin de poursuivre la procédure de changement de mot de passe.';
$lang['MYACCOUNT_PASSWORD_TITLE2']   = 'Changer mot de passe';
$lang['MYACCOUNT_PASSWORD_LABEL2']   = 'Nouveau mot de passe:';
$lang['MYACCOUNT_PASSWORD_LABEL3']   = 'Re-saisir nouveau mot de passe:';
$lang['MYACCOUNT_PASSWORD_BUTTON2']  = 'Changer mot de passe';
$lang['MYACCOUNT_PASSWORD_CHANGED']  = 'Mot de passe changé';

// Account Request
$lang['ACCOUNT_REQUEST_TITLE']       = 'Demande de ouverture compte MyIchimoku';
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
$lang['ACCOUNT_REQUEST_MAIL_HI']     = 'Bonjour ';
$lang['ACCOUNT_REQUEST_MAIL_BODY']   = "Merci d'avoir demandé la création d'un compte MyIchimoku.<br>
										Un email a était envoyé a l'administrateur du site web et il te répondra rapidement (d'ici environ 24-48hrs).<br>
										<br>
										Bien cordialement,<br>
										Oscar";
$lang['ACCOUNT_REQUEST_MESSAGE']     = "Un email a était envoyé a l'administrateur du site web et il te répondra rapidement (d'ici environ 24-48hrs).";

$lang['ACCOUNT_ACTIVATED_SUBJECT']   = 'MyIchimoku Compte Activé :-)';
$lang['ACCOUNT_ACTIVATED_HI']        = 'Bonjour ';
$lang['ACCOUNT_ACTIVATED_MESSAGE']   = "Ton compte a était activé et tu y te connecter maintenant sur:<br>
										<a href='http://MyIchimoku.eu/'>http://MyIchimoku.eu</a>, avec les informations précédement fournit.<br>
										<br>
										Attention, l'application est encore sous dévéloppement et tu peut constater des 'bugs' de temps a autres.<br>
										Et il manque encore des fonctionalités :-)<br>
										Pas de panique par contre, j'utilise l'application moi même et suis donc fortement motivé a que ça fonctionne au mieux.<br>
										Il est possible par contre que il y a des changements sur les écran ou des bugs pendant de je suis en train de coder (typiquement le soir).<br>
										<br>
										Sur certains écran tu peut te demander comment modifier les données. En fait, il suffit de cliquer dessus<br>
										et tu verra que ces champs deviennent modifiable (cool, hein?). Enregister les données se fait soit avec le bouton 'Entrée' ou en cliquant en dehors du champ.<br>
										<br>
										Si tu ne connait rien du Ichimoku Kinko Hyo (ouai, quel nom hein!) ou le trading en general, regarde sur <br>
										<a href='http://www.linkedin.com/profile/view?trk=tab_pro&id=11579649'>ma page LinkedIn</a>, en bas tu verra quelques livres qui peuvent t'interesser.<br>
										Donc avant de poser des questions, c'est cool de faire quelques investigations ;-)<br>
										<br>
										Concernant les mise a jours, regarde les pages public du site de temps a autre a <a href='http://myichimoku.eu/cms/'>cet endroit</a> (rien pour l'instant).<br><br>
										Oh, et l'application a était conçu pour fonctionner avec <b>Google Chrome</b>.<br>
										Firefox marchera probablement pas mal aussi, mais M$ Internet Explorer NE fonctionera certainement PAS.<br>
										<br>
										Have Fun !!<br>
										Oscar";



// Terms and Conditions
$lang['TC_AND_CS']					 = '<br><center><b>Terms and Conditions:</b></center><br>
										
										1.  The utilisation of the MyIchimoku website, the associated features and the provided<br> data is at your own risk and for your own responsability.<br><br>
										2.  No direct or implied guarantee of availability of the MyIchimoku.eu website and its<br> associated features.<br><br>
										3.  No direct or implied guarantee of the provided service nor of the provided data.<br><br>
										4.  The Software is under development and therefore can not be considered stable. Any <br>complaints you will keep to yourself. Feel free to share<br> any constructive feedback though.<br><br>
										5.  Requests for features and functionality will not be considered. Suggestions and<br> great ideas may be considered at the site owners descretion.<br><br>
										6.  It is not because you request access to this tool that you will gain access.<br> Approvals are at the site owner descretion. To say the least, I will need to know you.<br> If you landed on this page by accident it is likely that access will not be granted<br>and this without any further justification/explaination. :-) <br><br>
										7.  Though access is free of charge at this moment in time, this might change in the future.<br><br>
										8.  No attempts to hacking or otherwise trying to damage the software and/or the database<br>content is permitted (BTW: logs are being kept and <i>Big Brother IS watching you!</i>).<br> Any violation of this condition may lead to prosecution at the site owners descretion.<br><br>
										9.  Access to the MyIchimoku website and associated features may be terminated by <br>both the user and the site owner at any time and without any further explaination.<br><br>
										10. Other than personal financial gain, the MyIchimoku website, its features and<br> information CAN NOT be used, directly or indirectly, for any commercial benefit to you.<br><br>
										11. Though some of the site content is available in several languages, you agree<br> that English is the single language of reference in relation to this site and service.<br><br>
										12. These conditions may be changed at any time by the site owner.<br><br>
										13. <b>By clicking on the <Request Account> button below you agree to all of the above.</b><br>

										';
?>