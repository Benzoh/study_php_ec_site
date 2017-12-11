-- 商品・在庫

CREATE TABLE `item` (
    `item_id` int(10) NOT NULL auto_increment,
    `item_name` varchar(255) NOT NULL default '',
    `author_id` int(11) NOT NULL default '0',
    `publisher_id` int(11) NOT NULL default '0',
    `isbn` varchar(64) NOT NULL default '',
    `release_date` datetime NOT NULL default '0000-00-00 00:00:00',
    `list_price` decimal(10,0) NOT NULL default '0',
    `sale_price` decimal(10,0) NOT NULL default '0',
    `category_id` int(11) NOT NULL default '0',
    `state` int(11) NOT NULL default '0',
    `image_url` varchar(255) NOT NULL default '',
    `descreption` text NOT NULL,
    PRIMARY KEY (`item_id`),
    KEY `ship_date` (`release_date`),
    KEY `list_price` (`list_price`),
    KEY `sale_price` (`sale_price`),
    KEY `state` (`state`),
    KEY `author_id` (`author_id`),
    KEY `publisher_id` (`publisher_id`),
    KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

CREATE TABLE `stock` (
    `item_id` int(11) NOT NULL default '0',
    `quantity` int(11) NOT NULL default '0',
    `sales_quantity` int(11) NOT NULL default '0',
    `arrival_date` datetime NOT NULL default '0000-00-00 00:00:00',
    `state` int(11) NOT NULL default '0',
    `description` text NOT NULL,
    PRIMARY KEY (`item_id`),
    KEY `state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

CREATE TABLE `author` (
    `author_id` int(11) NOT NULL auto_increment,
    `author_name` varchar(255) NOT NULL default '',
    `author_name_kana` varchar(255) NOT NULL default '',
    `state` int(11) NOT NULL default '0',
    `description` text NOT NULL,
    PRIMARY KEY (`author_id`),
    KEY `author_name` (`author_name`),
    KEY `author_name_kana` (`author_name_kana`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

CREATE TABLE `publisher` (
    `publisher_id` int(11) NOT NULL auto_increment,
    `publisher_name` varchar(255) NOT NULL default '',
    `publisher_name_kana` varchar(255) NOT NULL default '',
    `state` int(11) NOT NULL default '0',
    `description` text NOT NULL,
    PRIMARY KEY (`publisher_id`),
    KEY `publisher_name` (`publisher_name`),
    KEY `publisher_name_kana` (`publisher_name_kana`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- カテゴリー
-- TODO:


-- 会員

CREATE TABLE `users` (
    `users_id` int(11) NOT NULL auto_increment,
    `login_id` varchar(128) NOT NULL default '',
    `passwd` varchar(32) NOT NULL default '',
    `register_date` datetime NOT NULL default '0000-00-00 00:00:00',
    `login_date` datetime NOT NULL default '0000-00-00 00:00:00',
    `name_kanji` varchar(32) NOT NULL default '',
    `name_kana` varchar(32) NOT NULL default '',
    `sex` tinyint(4) NOT NULL default '0',
    `birth_day` datetime  NOT NULL default '0000-00-00 00:00:00',
    `email1` varchar(128) NOT NULL default '',
    `email2` varchar(128) NOT NULL default '',
    `postal_code` varchar(16)  NOT NULL default '',
    `country` varchar(2)  NOT NULL default '',
    `xmpf` tinyint(4) NOT NULL default '0',
    `address1` varchar(64) NOT NULL default '',
    `address2` varchar(64) NOT NULL default '',
    `division` int(11) NOT NULL default '0',
    `state` int(11) NOT NULL default '0',
    PRIMARY KEY (`users_id`),
    KEY `login_id` (`login_id`),
    KEY `state` (`state`),
    KEY `division` (`division`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- 売上

CREATE TABLE `shipping` (
    `shipping_id` int(11) NOT NULL auto_increment,
    `order_date` datetime NOT NULL default '0000-00-00 00:00:00',
    `shipping_date` datetime NOT NULL default '0000-00-00 00:00:00',
    `users_id` int(11) NOT NULL default '0',
    `item_id` int(11) NOT NULL default '0',
    `quantity_id` int(11) NOT NULL default '0',
    `sale_price` decimal(10,0) NOT NULL default '0',
    `payment` int(11) NOT NULL default '0',
    `state` int(11) NOT NULL default '0',
    `description` text NOT NULL,
    `remote_addr` varchar(16) NOT NULL default '',
    `shipping_name_kanji` varchar(32) NOT NULL default '',
    `shipping_postal_code` varchar(16) NOT NULL default '',
    `shipping_xmpf` tinyint(4) NOT NULL default '0',
    `shipping_address1` varchar(64) NOT NULL default '',
    `shipping_address2` varchar(64) NOT NULL default '',
    PRIMARY KEY (`shipping_id`),
    KEY `order_date` (`order_date`),
    KEY `shipping_date` (`shipping_date`),
    KEY `users_id` (`users_id`),
    KEY `item_id` (`item_id`),
    KEY `remote_addr` (`remote_addr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;
