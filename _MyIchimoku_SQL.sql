-- phpMyAdmin SQL Dump
-- version OVH
-- http://www.phpmyadmin.net
--
-- Généré le : Jeu 07 Février 2013 à 22:31
-- Version du serveur: 5.1.49
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Structure de la table `myichi_admin`
--

CREATE TABLE IF NOT EXISTS `myichi_admin` (
  `user_id` int(10) DEFAULT NULL,
  `show_public` tinyint(1) DEFAULT NULL,
  `mi_screener` tinyint(1) DEFAULT NULL,
  `mi_performance` tinyint(1) DEFAULT NULL,
  `intraday_frequency` int(10) DEFAULT NULL,
  `max_days_data_history` int(10) DEFAULT NULL,
  `max_days_portfolio_history` int(10) DEFAULT NULL,
  UNIQUE KEY `index1` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `myichi_historical_data`
--

CREATE TABLE IF NOT EXISTS `myichi_historical_data` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `symbol` char(10) DEFAULT NULL,
  `exchange` varchar(10) DEFAULT NULL,
  `yahoo_symbol` varchar(15) NOT NULL,
  `symbol_period` int(5) NOT NULL,
  `timeframe` varchar(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `updated` datetime NOT NULL,
  `open` decimal(10,4) DEFAULT NULL,
  `high` decimal(10,4) DEFAULT NULL,
  `low` decimal(10,4) DEFAULT NULL,
  `close` decimal(10,4) DEFAULT NULL,
  `volume` int(10) DEFAULT NULL,
  `average_volume` int(10) DEFAULT NULL,
  `tenkan_sen` decimal(10,4) DEFAULT NULL,
  `kijun_sen` decimal(10,4) DEFAULT NULL,
  `senkou_span_a` decimal(10,4) DEFAULT NULL,
  `senkou_span_b` decimal(10,4) DEFAULT NULL,
  `chikou_span` decimal(10,4) DEFAULT NULL,
  `bb_price` int(2) DEFAULT NULL,
  `bb_tenkan_sen` int(2) DEFAULT NULL,
  `bb_kijun_sen` int(2) DEFAULT NULL,
  `bb_senkou_a_current` int(2) DEFAULT NULL,
  `bb_senkou_b_current` int(2) NOT NULL,
  `bb_senkou_future` int(2) DEFAULT NULL,
  `bb_SenkouFutureSignal` int(2) NOT NULL,
  `bb_chikou_span` int(2) DEFAULT NULL,
  `ichimoku_signal` int(2) DEFAULT NULL,
  `cloudbreak` int(2) DEFAULT NULL,
  `cloudbreak_strenght` int(2) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `yahoo_symbol` (`yahoo_symbol`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1895560 ;

-- --------------------------------------------------------

--
-- Structure de la table `myichi_instrument_names`
--

CREATE TABLE IF NOT EXISTS `myichi_instrument_names` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `symbol` char(10) DEFAULT NULL,
  `exchange` varchar(5) DEFAULT NULL,
  `yahoo_symbol` varchar(15) DEFAULT NULL,
  `instrument_name` varchar(50) DEFAULT NULL,
  `isin` varchar(15) DEFAULT NULL,
  `market` varchar(10) DEFAULT NULL,
  `trading_currency` varchar(10) DEFAULT NULL,
  `sector` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `yahoo_symbol1` (`yahoo_symbol`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1816 ;

-- --------------------------------------------------------

--
-- Structure de la table `myichi_portfolio`
--

CREATE TABLE IF NOT EXISTS `myichi_portfolio` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `entry_price` decimal(10,4) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `invested` decimal(10,4) DEFAULT NULL,
  `stoploss` decimal(10,4) DEFAULT NULL,
  `exit_date` date DEFAULT NULL,
  `exit_price` decimal(10,4) DEFAULT NULL,
  `commision` decimal(10,4) DEFAULT NULL,
  `comments` varchar(1000) DEFAULT NULL,
  `keynotes` varchar(5000) DEFAULT NULL,
  `instrument_type` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `price_at_date_added` decimal(10,4) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=191 ;

-- --------------------------------------------------------

--
-- Structure de la table `myichi_tracker`
--

CREATE TABLE IF NOT EXISTS `myichi_tracker` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `script` varchar(20) NOT NULL,
  `rundate` date NOT NULL,
  `counter` int(2) NOT NULL DEFAULT '0',
  `description` varchar(50) NOT NULL,
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `script` (`script`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Structure de la table `myichi_tracker_report`
--

CREATE TABLE IF NOT EXISTS `myichi_tracker_report` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `script` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `yqlqty` int(11) NOT NULL,
  `records` int(11) NOT NULL,
  `info` varchar(1000) NOT NULL,
  UNIQUE KEY `primaire` (`ID`),
  KEY `script` (`script`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18484 ;

-- --------------------------------------------------------

--
-- Structure de la table `myichi_tradingplan`
--

CREATE TABLE IF NOT EXISTS `myichi_tradingplan` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `tp_group` varchar(20) CHARACTER SET utf8 NOT NULL,
  `tp_type` varchar(20) CHARACTER SET utf8 NOT NULL,
  `tp_description` varchar(200) CHARACTER SET utf8 NOT NULL,
  `tp_number` decimal(4,2) NOT NULL,
  UNIQUE KEY `tp_index` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=97 ;

-- --------------------------------------------------------

--
-- Structure de la table `myichi_users`
--

CREATE TABLE IF NOT EXISTS `myichi_users` (
  `user_id` int(7) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `activated` int(1) NOT NULL DEFAULT '0',
  `confirmation` varchar(35) NOT NULL,
  `reg_date` int(11) NOT NULL,
  `last_login` int(11) NOT NULL DEFAULT '0',
  `group_id` int(2) NOT NULL DEFAULT '1',
  `language` varchar(2) NOT NULL DEFAULT 'EN',
  `frontpage_chartsize` int(4) NOT NULL DEFAULT '600',
  `frontpage_colums` int(1) NOT NULL DEFAULT '2',
  `popup_chartsize` int(4) NOT NULL DEFAULT '600',
  `popup_columns` int(1) NOT NULL DEFAULT '2',
  `page_chartsize` int(4) NOT NULL DEFAULT '600',
  `portfolio_charts` varchar(3) NOT NULL DEFAULT 'no',
  `rangeselect_charts` int(1) NOT NULL DEFAULT '4',
  `taxreserve` decimal(3,2) NOT NULL DEFAULT '0.30',
  `fiscal_month` int(2) NOT NULL DEFAULT '1',
  `mail_frequency` varchar(10) NOT NULL DEFAULT 'Never',
  `mail_subject` varchar(40) NOT NULL DEFAULT 'MyIchimoku wake-up email',
  `mail_content` varchar(200) NOT NULL DEFAULT 'Hey! Wake-up',
  `currency` varchar(3) NOT NULL DEFAULT 'EUR',
  `trading_capital` int(10) NOT NULL DEFAULT '1000',
  `max_per_trade` decimal(3,2) NOT NULL DEFAULT '0.20',
  `min_volume_instrument` int(10) NOT NULL DEFAULT '100000',
  `bull_entry_tenkan` decimal(3,2) NOT NULL DEFAULT '0.10',
  `bull_entry_kijun` decimal(3,2) NOT NULL DEFAULT '0.20',
  `bull_entry_buffer` decimal(3,2) NOT NULL DEFAULT '0.02',
  `bear_entry_tenkan` decimal(3,2) NOT NULL DEFAULT '0.10',
  `bear_entry_kijun` decimal(3,2) NOT NULL DEFAULT '0.20',
  `bear_entry_buffer` decimal(3,2) NOT NULL DEFAULT '0.02',
  `exit_buffer` decimal(3,2) NOT NULL DEFAULT '0.15',
  `profit_buffer` decimal(3,2) NOT NULL DEFAULT '0.10',
  `profit_exit_alert` decimal(3,2) NOT NULL DEFAULT '0.03',
  `invest_limit` decimal(3,2) NOT NULL DEFAULT '0.50',
  `use_free_trade` varchar(3) NOT NULL DEFAULT 'yes',
  `min_ichimoku_signal` int(2) NOT NULL DEFAULT '10',
  `min_cloudbreak_signal` int(2) NOT NULL DEFAULT '5',
  `ichimoku_trade_signal` int(2) NOT NULL DEFAULT '6',
  `chikou_open_space` int(2) NOT NULL DEFAULT '10',
  `buy_wait` int(2) NOT NULL DEFAULT '12',
  `trade_date` date NOT NULL DEFAULT '2000-01-01',
  `trade_direction` varchar(7) NOT NULL DEFAULT 'Both',
  `backtrading` varchar(3) NOT NULL DEFAULT 'no',
  `daily_trade_signals` varchar(3) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

-- --------------------------------------------------------

--
-- Structure de la table `myichi_user_signals`
--

CREATE TABLE IF NOT EXISTS `myichi_user_signals` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `yahoo_symbol` varchar(15) NOT NULL,
  `updated` datetime NOT NULL,
  `signal_date` date NOT NULL,
  `trade_direction` varchar(10) NOT NULL,
  `trade_signal` varchar(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101975 ;

-- --------------------------------------------------------

--
-- Structure de la table `myichi_user_stats`
--

CREATE TABLE IF NOT EXISTS `myichi_user_stats` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(7) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `page` varchar(100) NOT NULL,
  `browser` varchar(20) NOT NULL,
  UNIQUE KEY `userStatsIndex` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2394 ;
