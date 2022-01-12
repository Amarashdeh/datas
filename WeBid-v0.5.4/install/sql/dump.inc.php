<?php
# 
# Table structure for table `".$DBPrefix."accesseshistoric`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."accesseshistoric`;";
$query[] = "CREATE TABLE `".$DBPrefix."accesseshistoric` (
  `month` char(2) NOT NULL default '',
  `year` char(4) NOT NULL default '',
  `pageviews` int(11) NOT NULL default '0',
  `uniquevisitiors` int(11) NOT NULL default '0',
  `usersessions` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."accesseshistoric`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."accounts`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."accounts`;";
$query[] = "CREATE TABLE `".$DBPrefix."accounts` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(32) NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `operation_date` varchar(8) NOT NULL default '',
  `operation_type` int(1) NOT NULL default '0',
  `operation_amount` double NOT NULL default '0',
  `account_balance` double NOT NULL default '0',
  `auction` varchar(32) NOT NULL default '',
  KEY `id` (`id`)
) AUTO_INCREMENT=1 ;";

# 
# Dumping data for table `".$DBPrefix."accounts`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."adminusers`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."adminusers`;";
$query[] = "CREATE TABLE `".$DBPrefix."adminusers` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(32) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `created` varchar(8) NOT NULL default '',
  `lastlogin` varchar(14) NOT NULL default '',
  `status` int(2) NOT NULL default '0',
  KEY `id` (`id`)
) AUTO_INCREMENT=1 ;";

# 
# Dumping data for table `".$DBPrefix."adminusers`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."altpayments`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."altpayments`;";
$query[] = "CREATE TABLE `".$DBPrefix."altpayments` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=4 ;";

# 
# Dumping data for table `".$DBPrefix."altpayments`
# 

$query[] = "INSERT INTO `".$DBPrefix."altpayments` VALUES (2, 'Bank Transfer', 'Test Bank\r<BR>123 Worthwood Road\r<BR>Miami USA');";
$query[] = "INSERT INTO `".$DBPrefix."altpayments` VALUES (3, 'Money Order', 'TEst text for\r\nMoney order');";

# ############################

# 
# Table structure for table `".$DBPrefix."auccounter`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."auccounter`;";
$query[] = "CREATE TABLE `".$DBPrefix."auccounter` (
  `auction_id` int(11) NOT NULL default '0',
  `counter` int(11) NOT NULL default '0',
  PRIMARY KEY  (`auction_id`)
) ;";

# 
# Dumping data for table `".$DBPrefix."auccounter`
# 

# ############################

# 
# Table structure for table `".$DBPrefix."auctionextension`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."auctionextension`;";
$query[] = "CREATE TABLE `".$DBPrefix."auctionextension` (
  `status` enum('enabled','disabled') NOT NULL default 'enabled',
  `timebefore` int(11) NOT NULL default '0',
  `extend` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."auctionextension`
# 

$query[] = "INSERT INTO `".$DBPrefix."auctionextension` VALUES ('disabled', 120, 300);";

# ############################

# 
# Table structure for table `".$DBPrefix."auctions`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."auctions`;";
$query[] = "CREATE TABLE `".$DBPrefix."auctions` (
  `id` int(32) NOT NULL auto_increment,
  `user` int(32) default NULL,
  `title` tinytext,
  `starts` varchar(14) default NULL,
  `description` text,
  `pict_url` tinytext,
  `category` int(11) default NULL,
  `minimum_bid` double(16,4) default NULL,
  `reserve_price` double(16,4) default NULL,
  `buy_now` double(16,4) default NULL,
  `auction_type` char(1) default NULL,
  `duration` varchar(7) default NULL,
  `increment` double(8,4) NOT NULL default '0.0000',
  `shipping` char(1) default NULL,
  `payment` tinytext,
  `international` char(1) default NULL,
  `ends` varchar(14) default NULL,
  `current_bid` double(16,4) default NULL,
  `closed` char(2) default NULL,
  `photo_uploaded` char(1) default NULL,
  `quantity` int(11) default NULL,
  `suspended` int(1) default '0',
  `private` enum('y','n') NOT NULL default 'n',
  `relist` int(11) NOT NULL default '0',
  `relisted` int(11) NOT NULL default '0',
  `num_bids` int(11) NOT NULL default '0',
  `sold` enum('y','n','s') NOT NULL default 'n',
  `shipping_terms` tinytext NOT NULL,
  `bn_only` enum('y','n') NOT NULL default 'n',
  `adultonly` enum('y','n') NOT NULL default 'n',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
);";

# 
# Dumping data for table `".$DBPrefix."auctions`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."banners`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."banners`;";
$query[] = "CREATE TABLE `".$DBPrefix."banners` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `type` enum('gif','jpg','png','swf') default NULL,
  `views` int(11) default NULL,
  `clicks` int(11) default NULL,
  `url` varchar(255) default NULL,
  `sponsortext` varchar(255) default NULL,
  `alt` varchar(255) default NULL,
  `purchased` int(11) NOT NULL default '0',
  `width` int(11) NOT NULL default '0',
  `height` int(11) NOT NULL default '0',
  `user` int(11) NOT NULL default '0',
  KEY `id` (`id`)
) AUTO_INCREMENT=1 ;";

# 
# Dumping data for table `".$DBPrefix."banners`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."bannerscategories`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."bannerscategories`;";
$query[] = "CREATE TABLE `".$DBPrefix."bannerscategories` (
  `banner` int(11) NOT NULL default '0',
  `category` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."bannerscategories`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."bannerskeywords`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."bannerskeywords`;";
$query[] = "CREATE TABLE `".$DBPrefix."bannerskeywords` (
  `banner` int(11) NOT NULL default '0',
  `keyword` varchar(255) NOT NULL default ''
) ;";

# 
# Dumping data for table `".$DBPrefix."bannerskeywords`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."bannerssettings`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."bannerssettings`;";
$query[] = "CREATE TABLE `".$DBPrefix."bannerssettings` (
  `id` int(11) NOT NULL auto_increment,
  `sizetype` enum('fix','any') default NULL,
  `width` int(11) default NULL,
  `height` int(11) default NULL,
  KEY `id` (`id`)
) AUTO_INCREMENT=2 ;";

# 
# Dumping data for table `".$DBPrefix."bannerssettings`
# 

$query[] = "INSERT INTO `".$DBPrefix."bannerssettings` VALUES (1, 'any', 468, 60);";

# ############################

# 
# Table structure for table `".$DBPrefix."bannersstats`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."bannersstats`;";
$query[] = "CREATE TABLE `".$DBPrefix."bannersstats` (
  `banner` int(11) default NULL,
  `purchased` int(11) default NULL,
  `views` int(11) default NULL,
  `clicks` int(11) default NULL,
  KEY `id` (`banner`)
) ;";

# 
# Dumping data for table `".$DBPrefix."bannersstats`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."bannersusers`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."bannersusers`;";
$query[] = "CREATE TABLE `".$DBPrefix."bannersusers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `company` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  KEY `id` (`id`)
) AUTO_INCREMENT=1 ;";

# 
# Dumping data for table `".$DBPrefix."bannersusers`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."bidfind`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."bidfind`;";
$query[] = "CREATE TABLE `".$DBPrefix."bidfind` (
  `bidfind` enum('enabled','disabled') NOT NULL default 'enabled'
) ;";

# 
# Dumping data for table `".$DBPrefix."bidfind`
# 

$query[] = "INSERT INTO `".$DBPrefix."bidfind` VALUES ('disabled');";

# ############################

# 
# Table structure for table `".$DBPrefix."bids`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."bids`;";
$query[] = "CREATE TABLE `".$DBPrefix."bids` (
  `id` int(11) NOT NULL auto_increment,
  `auction` int(32) default NULL,
  `bidder` int(32) default NULL,
  `bid` double(16,4) default NULL,
  `bidwhen` varchar(14) default NULL,
  `quantity` int(11) default '0',
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=1 ;";

# 
# Dumping data for table `".$DBPrefix."bids`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."browsers`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."browsers`;";
$query[] = "CREATE TABLE `".$DBPrefix."browsers` (
  `month` char(2) NOT NULL default '',
  `year` varchar(4) NOT NULL default '',
  `browser` varchar(50) NOT NULL default '0',
  `counter` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."browsers`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."categories`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."categories`;";
$query[] = "CREATE TABLE `".$DBPrefix."categories` (
  `cat_id` int(4) NOT NULL auto_increment,
  `parent_id` int(4) default NULL,
  `cat_name` tinytext,
  `deleted` int(1) default NULL,
  `sub_counter` int(11) default NULL,
  `counter` int(11) default NULL,
  `cat_colour` tinytext NOT NULL,
  `cat_image` tinytext NOT NULL,
  `feesfree` enum('y','n') NOT NULL default 'n',
  PRIMARY KEY  (`cat_id`)
) AUTO_INCREMENT=212 ;";

# 
# Dumping data for table `".$DBPrefix."categories`
# 

$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (1, 0, 'Art &amp; Antiques', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (2, 1, 'Ancient World', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (3, 1, 'Amateur Art', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (4, 1, 'Ceramics &amp; Glass', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (5, 4, 'Glass', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (6, 5, '40s, 50s &amp; 60s', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (7, 5, 'Art Glass', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (8, 5, 'Carnival', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (9, 5, 'Contemporary Glass', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (10, 5, 'Porcelain', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (11, 5, 'Chalkware', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (12, 5, 'Chintz &amp; Shelley', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (13, 5, 'Decorative', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (14, 1, 'Fine Art', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (15, 1, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (16, 1, 'Painting', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (17, 1, 'Photographic Images', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (18, 1, 'Prints', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (19, 1, 'Books &amp; Manuscripts', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (20, 1, 'Cameras', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (21, 1, 'Musical Instruments', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (22, 1, 'Orientalia', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (23, 1, 'Post-1900', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (24, 1, 'Pre-1900', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (25, 1, 'Scientific Instruments', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (26, 1, 'Silver &amp; Silver Plate', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (27, 1, 'Textiles &amp; Linens', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (28, 0, 'Books', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (29, 28, 'Arts, Architecture &amp; Photography', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (30, 28, 'Audiobooks', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (31, 28, 'Biographies &amp; Memoirs', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (32, 28, 'Business &amp; Investing', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (34, 28, 'Computers &amp; Internet', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (35, 28, 'Cooking, Food &amp; Wine', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (36, 28, 'Entertainment', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (37, 28, 'Foreign Language Instruction', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (38, 28, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (39, 28, 'Health, Mind &amp; Body', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (40, 28, 'History', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (41, 28, 'Home &amp; Garden', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (42, 28, 'Horror', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (43, 28, 'Literature &amp; Fiction', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (44, 28, 'Animals', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (45, 28, 'Catalogs', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (46, 28, 'Children', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (47, 28, 'Illustrated', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (48, 28, 'Men', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (49, 28, 'News', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (51, 28, 'Sports', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (52, 28, 'Women', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (53, 28, 'Mystery &amp; Thrillers', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (54, 28, 'Nonfiction', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (55, 28, 'Parenting &amp; Families', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (56, 28, 'Poetry', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (57, 28, 'Rare', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (58, 28, 'Reference', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (59, 28, 'Religion &amp; Spirituality', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (60, 28, 'Contemporary', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (61, 28, 'Historical', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (62, 28, 'Regency', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (63, 28, 'Science &amp; Nature', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (64, 28, 'Science Fiction &amp; Fantasy', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (65, 28, 'Sports &amp; Outdoors', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (66, 28, 'Teens', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (67, 28, 'Textbooks', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (68, 28, 'Travel', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (69, 0, 'Clothing &amp; Accessories', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (70, 69, 'Accessories', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (71, 69, 'Clothing', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (72, 69, 'Watches', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (73, 0, 'Coins &amp; Stamps', 0, 1, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (74, 73, 'Coins', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (75, 73, 'Philately', 0, 1, 1, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (76, 0, 'Collectibles', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (77, 76, 'Advertising', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (78, 76, 'Animals', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (79, 76, 'Animation', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (80, 76, 'Antique Reproductions', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (81, 76, 'Autographs', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (82, 76, 'Barber Shop', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (83, 76, 'Bears', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (84, 76, 'Bells', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (85, 76, 'Bottles &amp; Cans', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (86, 76, 'Breweriana', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (87, 76, 'Cars &amp; Motorcycles', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (88, 76, 'Cereal Boxes &amp; Premiums', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (89, 76, 'Character', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (90, 76, 'Circus &amp; Carnival', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (91, 76, 'Collector Plates', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (92, 76, 'Dolls', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (93, 76, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (94, 76, 'Historical &amp; Cultural', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (95, 76, 'Holiday &amp; Seasonal', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (96, 76, 'Household Items', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (97, 76, 'Kitsch', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (98, 76, 'Knives &amp; Swords', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (99, 76, 'Lunchboxes', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (100, 76, 'Magic &amp; Novelty Items', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (101, 76, 'Memorabilia', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (102, 76, 'Militaria', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (103, 76, 'Music Boxes', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (104, 76, 'Oddities', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (105, 76, 'Paper', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (106, 76, 'Pinbacks', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (107, 76, 'Porcelain Figurines', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (108, 76, 'Railroadiana', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (109, 76, 'Religious', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (110, 76, 'Rocks, Minerals &amp; Fossils', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (111, 76, 'Scientific Instruments', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (112, 76, 'Textiles', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (113, 76, 'Tobacciana', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (114, 0, 'Comics, Cards &amp; Science Fiction', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (115, 114, 'Anime &amp; Manga', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (116, 114, 'Comic Books', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (117, 114, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (118, 114, 'Godzilla', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (119, 114, 'Star Trek', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (120, 114, 'The X-Files', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (121, 114, 'Toys', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (122, 114, 'Trading Cards', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (123, 0, 'Computers &amp; Software', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (124, 123, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (125, 123, 'Hardware', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (126, 123, 'Internet Services', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (127, 123, 'Software', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (128, 0, 'Electronics &amp; Photography', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (129, 128, 'Consumer Electronics', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (130, 128, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (131, 128, 'Photo Equipment', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (132, 128, 'Recording Equipment', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (133, 128, 'Video Equipment', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (134, 0, 'Gemstones &amp; Jewelry', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (135, 134, 'Ancient', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (136, 134, 'Beaded Jewelry', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (137, 134, 'Beads', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (138, 134, 'Carved &amp; Cameo', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (139, 134, 'Contemporary', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (140, 134, 'Costume', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (141, 134, 'Fine', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (142, 134, 'Gemstones', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (143, 134, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (144, 134, 'Gold', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (145, 134, 'Necklaces', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (146, 134, 'Silver', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (147, 134, 'Victorian', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (148, 134, 'Vintage', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (149, 0, 'Home &amp; Garden', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (150, 149, 'Baby Items', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (151, 149, 'Crafts', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (152, 149, 'Furniture', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (153, 149, 'Garden', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (154, 149, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (155, 149, 'Household Items', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (156, 149, 'Pet Supplies', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (157, 149, 'Tools &amp; Hardware', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (158, 149, 'Weddings', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (159, 0, 'Movies &amp; Video', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (160, 159, 'DVD', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (161, 159, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (162, 159, 'Laser Discs', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (163, 159, 'VHS', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (164, 0, 'Music', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (165, 164, 'CDs', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (166, 164, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (167, 164, 'Instruments', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (168, 164, 'Memorabilia', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (169, 164, 'Records', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (170, 164, 'Tapes', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (171, 0, 'Office &amp; Business', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (172, 171, 'Briefcases', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (173, 171, 'Fax Machines', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (174, 171, 'General Equipment', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (175, 171, 'Pagers', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (176, 0, 'Other Goods &amp; Services', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (177, 176, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (178, 176, 'Metaphysical', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (179, 176, 'Property', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (180, 176, 'Services', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (181, 176, 'Tickets &amp; Events', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (182, 176, 'Transportation', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (183, 176, 'Travel', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (184, 0, 'Sports &amp; Recreation', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (185, 184, 'Apparel &amp; Equipment', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (186, 184, 'Exercise Equipment', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (187, 184, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (188, 0, 'Toys &amp; Games', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (189, 188, 'Action Figures', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (190, 188, 'Beanie Babies &amp; Beanbag Toys', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (191, 188, 'Diecast', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (192, 188, 'Fast Food', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (193, 188, 'Fisher-Price', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (194, 188, 'Furby', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (195, 188, 'Games', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (196, 188, 'General', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (197, 188, 'Giga Pet &amp; Tamagotchi', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (198, 188, 'Hobbies', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (199, 188, 'Marbles', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (200, 188, 'My Little Pony', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (201, 188, 'Peanuts Gang', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (202, 188, 'Pez', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (203, 188, 'Plastic Models', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (204, 188, 'Plush Toys', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (205, 188, 'Puzzles', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (206, 188, 'Slot Cars', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (207, 188, 'Teletubbies', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (208, 188, 'Toy Soldiers', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (209, 188, 'Vintage Tin', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (210, 188, 'Vintage Vehicles', 0, 0, 0, '', '', 'n');";
$query[] = "INSERT INTO `".$DBPrefix."categories` VALUES (211, 188, 'Vintage', 0, 0, 0, '', '', 'n');";

# ############################

# 
# Table structure for table `".$DBPrefix."categories_plain`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."categories_plain`;";
$query[] = "CREATE TABLE `".$DBPrefix."categories_plain` (
  `id` int(11) NOT NULL auto_increment,
  `cat_id` int(11) default NULL,
  `cat_name` tinytext,
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=67737 ;";

# 
# Dumping data for table `".$DBPrefix."categories_plain`
# 

$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67528, 1, 'Art &amp; Antiques');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67529, 3, '&nbsp; &nbsp;Amateur Art');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67530, 2, '&nbsp; &nbsp;Ancient World');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67531, 19, '&nbsp; &nbsp;Books &amp; Manuscripts');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67532, 20, '&nbsp; &nbsp;Cameras');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67533, 4, '&nbsp; &nbsp;Ceramics &amp; Glass');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67534, 5, '&nbsp; &nbsp;&nbsp; &nbsp;Glass');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67535, 6, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;40s, 50s &amp; 60s');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67536, 7, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Art Glass');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67537, 8, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Carnival');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67538, 11, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Chalkware');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67539, 12, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Chintz &amp; Shelley');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67540, 9, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Contemporary Glass');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67541, 13, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Decorative');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67542, 10, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Porcelain');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67543, 14, '&nbsp; &nbsp;Fine Art');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67544, 15, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67545, 21, '&nbsp; &nbsp;Musical Instruments');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67546, 22, '&nbsp; &nbsp;Orientalia');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67547, 16, '&nbsp; &nbsp;Painting');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67548, 17, '&nbsp; &nbsp;Photographic Images');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67549, 23, '&nbsp; &nbsp;Post-1900');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67550, 24, '&nbsp; &nbsp;Pre-1900');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67551, 18, '&nbsp; &nbsp;Prints');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67552, 25, '&nbsp; &nbsp;Scientific Instruments');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67553, 26, '&nbsp; &nbsp;Silver &amp; Silver Plate');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67554, 27, '&nbsp; &nbsp;Textiles &amp; Linens');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67555, 28, 'Books');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67556, 44, '&nbsp; &nbsp;Animals');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67557, 29, '&nbsp; &nbsp;Arts, Architecture &amp; Photography');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67558, 30, '&nbsp; &nbsp;Audiobooks');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67559, 31, '&nbsp; &nbsp;Biographies &amp; Memoirs');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67560, 32, '&nbsp; &nbsp;Business &amp; Investing');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67561, 45, '&nbsp; &nbsp;Catalogs');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67562, 46, '&nbsp; &nbsp;Children');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67563, 34, '&nbsp; &nbsp;Computers &amp; Internet');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67564, 60, '&nbsp; &nbsp;Contemporary');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67565, 35, '&nbsp; &nbsp;Cooking, Food &amp; Wine');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67566, 36, '&nbsp; &nbsp;Entertainment');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67567, 37, '&nbsp; &nbsp;Foreign Language Instruction');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67568, 38, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67569, 39, '&nbsp; &nbsp;Health, Mind &amp; Body');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67570, 61, '&nbsp; &nbsp;Historical');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67571, 40, '&nbsp; &nbsp;History');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67572, 41, '&nbsp; &nbsp;Home &amp; Garden');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67573, 42, '&nbsp; &nbsp;Horror');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67574, 47, '&nbsp; &nbsp;Illustrated');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67575, 43, '&nbsp; &nbsp;Literature &amp; Fiction');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67576, 48, '&nbsp; &nbsp;Men');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67577, 53, '&nbsp; &nbsp;Mystery &amp; Thrillers');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67578, 49, '&nbsp; &nbsp;News');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67579, 54, '&nbsp; &nbsp;Nonfiction');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67580, 55, '&nbsp; &nbsp;Parenting &amp; Families');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67581, 56, '&nbsp; &nbsp;Poetry');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67582, 57, '&nbsp; &nbsp;Rare');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67583, 58, '&nbsp; &nbsp;Reference');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67584, 62, '&nbsp; &nbsp;Regency');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67585, 59, '&nbsp; &nbsp;Religion &amp; Spirituality');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67586, 63, '&nbsp; &nbsp;Science &amp; Nature');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67587, 64, '&nbsp; &nbsp;Science Fiction &amp; Fantasy');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67588, 51, '&nbsp; &nbsp;Sports');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67589, 65, '&nbsp; &nbsp;Sports &amp; Outdoors');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67590, 66, '&nbsp; &nbsp;Teens');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67591, 67, '&nbsp; &nbsp;Textbooks');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67592, 68, '&nbsp; &nbsp;Travel');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67593, 52, '&nbsp; &nbsp;Women');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67594, 69, 'Clothing &amp; Accessories');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67595, 70, '&nbsp; &nbsp;Accessories');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67596, 71, '&nbsp; &nbsp;Clothing');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67597, 72, '&nbsp; &nbsp;Watches');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67598, 73, 'Coins &amp; Stamps');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67599, 74, '&nbsp; &nbsp;Coins');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67600, 75, '&nbsp; &nbsp;Philately');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67601, 76, 'Collectibles');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67602, 77, '&nbsp; &nbsp;Advertising');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67603, 78, '&nbsp; &nbsp;Animals');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67604, 79, '&nbsp; &nbsp;Animation');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67605, 80, '&nbsp; &nbsp;Antique Reproductions');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67606, 81, '&nbsp; &nbsp;Autographs');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67607, 82, '&nbsp; &nbsp;Barber Shop');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67608, 83, '&nbsp; &nbsp;Bears');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67609, 84, '&nbsp; &nbsp;Bells');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67610, 85, '&nbsp; &nbsp;Bottles &amp; Cans');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67611, 86, '&nbsp; &nbsp;Breweriana');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67612, 87, '&nbsp; &nbsp;Cars &amp; Motorcycles');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67613, 88, '&nbsp; &nbsp;Cereal Boxes &amp; Premiums');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67614, 89, '&nbsp; &nbsp;Character');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67615, 90, '&nbsp; &nbsp;Circus &amp; Carnival');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67616, 91, '&nbsp; &nbsp;Collector Plates');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67617, 92, '&nbsp; &nbsp;Dolls');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67618, 93, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67619, 94, '&nbsp; &nbsp;Historical &amp; Cultural');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67620, 95, '&nbsp; &nbsp;Holiday &amp; Seasonal');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67621, 96, '&nbsp; &nbsp;Household Items');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67622, 97, '&nbsp; &nbsp;Kitsch');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67623, 98, '&nbsp; &nbsp;Knives &amp; Swords');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67624, 99, '&nbsp; &nbsp;Lunchboxes');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67625, 100, '&nbsp; &nbsp;Magic &amp; Novelty Items');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67626, 101, '&nbsp; &nbsp;Memorabilia');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67627, 102, '&nbsp; &nbsp;Militaria');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67628, 103, '&nbsp; &nbsp;Music Boxes');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67629, 104, '&nbsp; &nbsp;Oddities');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67630, 105, '&nbsp; &nbsp;Paper');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67631, 106, '&nbsp; &nbsp;Pinbacks');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67632, 107, '&nbsp; &nbsp;Porcelain Figurines');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67633, 108, '&nbsp; &nbsp;Railroadiana');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67634, 109, '&nbsp; &nbsp;Religious');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67635, 110, '&nbsp; &nbsp;Rocks, Minerals &amp; Fossils');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67636, 111, '&nbsp; &nbsp;Scientific Instruments');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67637, 112, '&nbsp; &nbsp;Textiles');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67638, 113, '&nbsp; &nbsp;Tobacciana');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67639, 114, 'Comics, Cards &amp; Science Fiction');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67640, 115, '&nbsp; &nbsp;Anime &amp; Manga');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67641, 116, '&nbsp; &nbsp;Comic Books');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67642, 117, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67643, 118, '&nbsp; &nbsp;Godzilla');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67644, 119, '&nbsp; &nbsp;Star Trek');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67645, 120, '&nbsp; &nbsp;The X-Files');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67646, 121, '&nbsp; &nbsp;Toys');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67647, 122, '&nbsp; &nbsp;Trading Cards');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67648, 123, 'Computers &amp; Software');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67649, 124, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67650, 125, '&nbsp; &nbsp;Hardware');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67651, 126, '&nbsp; &nbsp;Internet Services');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67652, 127, '&nbsp; &nbsp;Software');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67653, 128, 'Electronics &amp; Photography');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67654, 129, '&nbsp; &nbsp;Consumer Electronics');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67655, 130, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67656, 131, '&nbsp; &nbsp;Photo Equipment');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67657, 132, '&nbsp; &nbsp;Recording Equipment');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67658, 133, '&nbsp; &nbsp;Video Equipment');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67659, 134, 'Gemstones &amp; Jewelry');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67660, 135, '&nbsp; &nbsp;Ancient');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67661, 136, '&nbsp; &nbsp;Beaded Jewelry');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67662, 137, '&nbsp; &nbsp;Beads');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67663, 138, '&nbsp; &nbsp;Carved &amp; Cameo');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67664, 139, '&nbsp; &nbsp;Contemporary');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67665, 140, '&nbsp; &nbsp;Costume');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67666, 141, '&nbsp; &nbsp;Fine');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67667, 142, '&nbsp; &nbsp;Gemstones');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67668, 143, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67669, 144, '&nbsp; &nbsp;Gold');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67670, 145, '&nbsp; &nbsp;Necklaces');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67671, 146, '&nbsp; &nbsp;Silver');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67672, 147, '&nbsp; &nbsp;Victorian');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67673, 148, '&nbsp; &nbsp;Vintage');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67674, 149, 'Home &amp; Garden');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67675, 150, '&nbsp; &nbsp;Baby Items');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67676, 151, '&nbsp; &nbsp;Crafts');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67677, 152, '&nbsp; &nbsp;Furniture');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67678, 153, '&nbsp; &nbsp;Garden');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67679, 154, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67680, 155, '&nbsp; &nbsp;Household Items');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67681, 156, '&nbsp; &nbsp;Pet Supplies');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67682, 157, '&nbsp; &nbsp;Tools &amp; Hardware');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67683, 158, '&nbsp; &nbsp;Weddings');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67684, 159, 'Movies &amp; Video');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67685, 160, '&nbsp; &nbsp;DVD');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67686, 161, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67687, 162, '&nbsp; &nbsp;Laser Discs');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67688, 163, '&nbsp; &nbsp;VHS');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67689, 164, 'Music');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67690, 165, '&nbsp; &nbsp;CDs');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67691, 166, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67692, 167, '&nbsp; &nbsp;Instruments');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67693, 168, '&nbsp; &nbsp;Memorabilia');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67694, 169, '&nbsp; &nbsp;Records');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67695, 170, '&nbsp; &nbsp;Tapes');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67696, 171, 'Office &amp; Business');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67697, 172, '&nbsp; &nbsp;Briefcases');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67698, 173, '&nbsp; &nbsp;Fax Machines');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67699, 174, '&nbsp; &nbsp;General Equipment');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67700, 175, '&nbsp; &nbsp;Pagers');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67701, 176, 'Other Goods &amp; Services');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67702, 177, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67703, 178, '&nbsp; &nbsp;Metaphysical');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67704, 179, '&nbsp; &nbsp;Property');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67705, 180, '&nbsp; &nbsp;Services');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67706, 181, '&nbsp; &nbsp;Tickets &amp; Events');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67707, 182, '&nbsp; &nbsp;Transportation');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67708, 183, '&nbsp; &nbsp;Travel');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67709, 184, 'Sports &amp; Recreation');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67710, 185, '&nbsp; &nbsp;Apparel &amp; Equipment');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67711, 186, '&nbsp; &nbsp;Exercise Equipment');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67712, 187, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67713, 188, 'Toys &amp; Games');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67714, 189, '&nbsp; &nbsp;Action Figures');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67715, 190, '&nbsp; &nbsp;Beanie Babies &amp; Beanbag Toys');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67716, 191, '&nbsp; &nbsp;Diecast');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67717, 192, '&nbsp; &nbsp;Fast Food');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67718, 193, '&nbsp; &nbsp;Fisher-Price');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67719, 194, '&nbsp; &nbsp;Furby');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67720, 195, '&nbsp; &nbsp;Games');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67721, 196, '&nbsp; &nbsp;General');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67722, 197, '&nbsp; &nbsp;Giga Pet &amp; Tamagotchi');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67723, 198, '&nbsp; &nbsp;Hobbies');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67724, 199, '&nbsp; &nbsp;Marbles');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67725, 200, '&nbsp; &nbsp;My Little Pony');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67726, 201, '&nbsp; &nbsp;Peanuts Gang');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67727, 202, '&nbsp; &nbsp;Pez');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67728, 203, '&nbsp; &nbsp;Plastic Models');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67729, 204, '&nbsp; &nbsp;Plush Toys');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67730, 205, '&nbsp; &nbsp;Puzzles');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67731, 206, '&nbsp; &nbsp;Slot Cars');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67732, 207, '&nbsp; &nbsp;Teletubbies');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67733, 208, '&nbsp; &nbsp;Toy Soldiers');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67734, 211, '&nbsp; &nbsp;Vintage');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67735, 209, '&nbsp; &nbsp;Vintage Tin');";
$query[] = "INSERT INTO `".$DBPrefix."categories_plain` VALUES (67736, 210, '&nbsp; &nbsp;Vintage Vehicles');";

# ############################

# 
# Table structure for table `".$DBPrefix."cats_translated`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."cats_translated`;";
$query[] = "CREATE TABLE `".$DBPrefix."cats_translated` (
  `cat_id` int(11) NOT NULL default '0',
  `lang` char(2) NOT NULL default '',
  `cat_name` varchar(255) NOT NULL default ''
) ;";

# 
# Dumping data for table `".$DBPrefix."cats_translated`
# 

$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (1, 'EN', 'Art & Antiques');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (1, 'ES', 'Arte y Antigüedades');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (2, 'EN', 'Ancient World');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (2, 'ES', 'Mundo Antiguo');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (3, 'EN', 'Amateur Art');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (3, 'ES', 'Arte Amateur');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (4, 'EN', 'Ceramics & Glass');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (4, 'ES', 'Cerámica & Cristal');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (5, 'EN', 'Glass');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (5, 'ES', 'Cristal');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (6, 'EN', '40s, 50s & 60s');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (6, 'ES', '40s, 50s & 60s');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (7, 'EN', 'Art Glass');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (7, 'ES', 'Piezas en cristal');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (8, 'EN', 'Carnival');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (8, 'ES', 'Carnaval');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (9, 'EN', 'Contemporary Glass');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (9, 'ES', 'Contemporaneo');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (10, 'EN', 'Porcelain');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (10, 'ES', 'Porcelana');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (11, 'EN', 'Chalkware');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (11, 'ES', 'Vajilla');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (12, 'EN', 'Chintz & Shelley');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (12, 'ES', 'Chintz & Shelley');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (13, 'EN', 'Decorative');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (13, 'ES', 'Decorativo');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (14, 'EN', 'Fine Art');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (14, 'ES', 'Arte');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (15, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (15, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (16, 'EN', 'Painting');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (16, 'ES', 'Pintura');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (17, 'EN', 'Photographic Images');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (17, 'ES', 'Fotografí­a');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (18, 'EN', 'Prints');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (18, 'ES', 'Impresos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (19, 'EN', 'Books & Manuscripts');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (19, 'ES', 'Libros y Manuscritos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (20, 'EN', 'Cameras');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (20, 'ES', 'Cámaras');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (21, 'EN', 'Musical Instruments');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (21, 'ES', 'Instrumentos Musicales');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (22, 'EN', 'Orientalia');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (22, 'ES', 'Arte Oriental');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (23, 'EN', 'Post-1900');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (23, 'ES', 'Posterior 1900');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (24, 'EN', 'Pre-1900');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (24, 'ES', 'Anterior 1900');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (25, 'EN', 'Scientific Instruments');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (25, 'ES', 'Instrumentos cientí­ficos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (26, 'EN', 'Silver & Silver Plate');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (26, 'ES', 'Plata & Cuebrterí­a');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (27, 'EN', 'Textiles & Linens');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (27, 'ES', 'Tejidos & Telas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (28, 'EN', 'Books');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (28, 'ES', 'Libros');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (29, 'EN', 'Arts, Architecture & Photography');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (29, 'ES', 'Arte, Arquitectura y Fotografí­a');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (30, 'EN', 'Audiobooks');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (30, 'ES', 'Audio Libros');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (31, 'EN', 'Biographies & Memoirs');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (31, 'ES', 'Biografí­as & Memorias');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (32, 'EN', 'Business & Investing');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (32, 'ES', 'Negocios & Inversiones');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (33, 'ES', 'Libros para ni&ntilde;os');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (34, 'EN', 'Computers & Internet');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (34, 'ES', 'Ordenadores & Internet');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (35, 'EN', 'Cooking, Food & Wine');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (35, 'ES', 'Cocina, Comida y Vinos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (36, 'EN', 'Entertainment');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (36, 'ES', 'Ocio');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (37, 'EN', 'Foreign Language Instruction');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (37, 'ES', 'Eseñanza Idiomas Extranjeros');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (38, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (38, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (39, 'EN', 'Health, Mind & Body');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (39, 'ES', 'Salud, Mente y Cuerpo');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (40, 'EN', 'History');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (40, 'ES', 'Historia');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (41, 'EN', 'Home & Garden');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (41, 'ES', 'Hogar y Jardin');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (42, 'EN', 'Horror');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (42, 'ES', 'Horror');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (43, 'EN', 'Literature & Fiction');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (43, 'ES', 'Literatura Ficción');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (44, 'EN', 'Animals');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (44, 'ES', 'Animales');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (45, 'EN', 'Catalogs');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (45, 'ES', 'Catálogos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (46, 'EN', 'Children');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (46, 'ES', 'Niños');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (47, 'EN', 'Illustrated');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (47, 'ES', 'Ilustrados');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (48, 'EN', 'Men');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (48, 'ES', 'Hombres');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (49, 'EN', 'News');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (49, 'ES', 'Novedades');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (51, 'EN', 'Sports');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (51, 'ES', 'Deportes');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (52, 'EN', 'Women');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (52, 'ES', 'Mujeres');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (53, 'EN', 'Mystery & Thrillers');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (53, 'ES', 'Misterio & Thrillers');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (54, 'EN', 'Nonfiction');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (54, 'ES', 'No Ficción');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (55, 'EN', 'Parenting & Families');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (55, 'ES', 'Educación & Familia');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (56, 'EN', 'Poetry');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (56, 'ES', 'Poesí­a');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (57, 'EN', 'Rare');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (57, 'ES', 'Raros');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (58, 'EN', 'Reference');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (58, 'ES', 'Referencia');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (59, 'EN', 'Religion & Spirituality');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (59, 'ES', 'Religión & Espiritualidad');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (60, 'EN', 'Contemporary');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (60, 'ES', 'Contemporaneos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (61, 'EN', 'Historical');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (61, 'ES', 'Históricos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (62, 'EN', 'Regency');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (62, 'ES', 'Realeza');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (63, 'EN', 'Science & Nature');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (63, 'ES', 'Ciencia & Naturaleza');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (64, 'EN', 'Science Fiction & Fantasy');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (64, 'ES', 'Ciencia Ficción & Fantas&iacute;a');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (65, 'EN', 'Sports & Outdoors');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (65, 'ES', 'Deportes & Exterior');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (66, 'EN', 'Teens');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (66, 'ES', 'Adolescente');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (67, 'EN', 'Textbooks');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (67, 'ES', 'Libros de texto');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (68, 'EN', 'Travel');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (68, 'ES', 'Viajes');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (69, 'EN', 'Clothing & Accessories');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (69, 'ES', 'Ropa y Complementos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (70, 'EN', 'Accessories');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (70, 'ES', 'Accessorios');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (71, 'EN', 'Clothing');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (71, 'ES', 'Ropa');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (72, 'EN', 'Watches');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (72, 'ES', 'Relojes');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (73, 'EN', 'Coins & Stamps');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (73, 'ES', 'Monedas y Sellos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (74, 'EN', 'Coins');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (74, 'ES', 'Monedas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (75, 'EN', 'Philately');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (75, 'ES', 'Filatelí­a');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (76, 'EN', 'Collectibles');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (76, 'ES', 'Coleccionables');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (77, 'EN', 'Advertising');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (77, 'ES', 'Publicidad');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (78, 'EN', 'Animals');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (78, 'ES', 'Animales');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (79, 'EN', 'Animation');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (79, 'ES', 'Animación');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (80, 'EN', 'Antique Reproductions');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (80, 'ES', 'Reproducciones Antigueas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (81, 'EN', 'Autographs');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (81, 'ES', 'Autografos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (82, 'EN', 'Barber Shop');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (82, 'ES', 'Barberí­a');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (83, 'EN', 'Bears');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (83, 'ES', 'Osos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (84, 'EN', 'Bells');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (84, 'ES', 'Campanas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (85, 'EN', 'Bottles & Cans');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (85, 'ES', 'Botellas & Latas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (86, 'EN', 'Breweriana');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (86, 'ES', 'Cerveza');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (87, 'EN', 'Cars & Motorcycles');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (87, 'ES', 'Automóviles & Motocicletas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (88, 'EN', 'Cereal Boxes & Premiums');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (88, 'ES', 'Cajas de cereal & Premios');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (89, 'EN', 'Character');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (89, 'ES', 'Personajes');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (90, 'EN', 'Circus & Carnival');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (90, 'ES', 'Circo & Carnaval');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (91, 'EN', 'Collector Plates');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (91, 'ES', 'Platos de collecioón');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (92, 'EN', 'Dolls');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (92, 'ES', 'Muñecas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (93, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (93, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (94, 'EN', 'Historical & Cultural');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (94, 'ES', 'Historico & Cultural');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (95, 'EN', 'Holiday & Seasonal');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (95, 'ES', 'Vacaciones & Fiestas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (96, 'EN', 'Household Items');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (96, 'ES', 'Utensilios de casa');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (97, 'EN', 'Kitsch');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (97, 'ES', 'Kitsch');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (98, 'EN', 'Knives & Swords');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (98, 'ES', 'Espadas & Navajas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (99, 'EN', 'Lunchboxes');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (99, 'ES', 'Cajas de Lunch');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (100, 'EN', 'Magic & Novelty Items');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (100, 'ES', 'Magia & Nobleza');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (101, 'EN', 'Memorabilia');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (101, 'ES', 'Memorabilia');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (102, 'EN', 'Militaria');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (102, 'ES', 'Militar');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (103, 'EN', 'Music Boxes');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (103, 'ES', 'Cajas de Música');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (104, 'EN', 'Oddities');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (104, 'ES', 'Rarezas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (105, 'EN', 'Paper');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (105, 'ES', 'Papel');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (106, 'EN', 'Pinbacks');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (106, 'ES', 'Pins');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (107, 'EN', 'Porcelain Figurines');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (107, 'ES', 'Figuras de porcelana');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (108, 'EN', 'Railroadiana');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (108, 'ES', 'Tren');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (109, 'EN', 'Religious');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (109, 'ES', 'Religioso');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (110, 'EN', 'Rocks, Minerals & Fossils');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (110, 'ES', 'Rocas, Minerales & Fósiles');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (111, 'EN', 'Scientific Instruments');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (111, 'ES', 'Instrumentos Cientí­ficos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (112, 'EN', 'Textiles');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (112, 'ES', 'Textiles');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (113, 'EN', 'Tobacciana');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (113, 'ES', 'Tabaco');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (114, 'EN', 'Comics, Cards & Science Fiction');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (114, 'ES', 'Comics, Cromos & Ciencia Ficción');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (115, 'EN', 'Anime & Manga');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (115, 'ES', 'Animación & Manga');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (116, 'EN', 'Comic Books');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (116, 'ES', 'Libros de Comics');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (117, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (117, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (118, 'EN', 'Godzilla');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (118, 'ES', 'Godzilla');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (119, 'EN', 'Star Trek');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (119, 'ES', 'Star Trek');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (120, 'EN', 'The X-Files');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (120, 'ES', 'Expediente X');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (121, 'EN', 'Toys');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (121, 'ES', 'Juguetes');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (122, 'EN', 'Trading Cards');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (122, 'ES', 'Cromos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (123, 'EN', 'Computers & Software');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (123, 'ES', 'Ordenadores & Software');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (124, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (124, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (125, 'EN', 'Hardware');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (125, 'ES', 'Hardware');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (126, 'EN', 'Internet Services');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (126, 'ES', 'Internet');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (127, 'EN', 'Software');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (127, 'ES', 'Software');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (128, 'EN', 'Electronics & Photography');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (128, 'ES', 'Electrónica y Fotografí­a');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (129, 'EN', 'Consumer Electronics');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (129, 'ES', 'Consumibles Electrónicos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (130, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (130, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (131, 'EN', 'Photo Equipment');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (131, 'ES', 'Equipos Fotográfico');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (132, 'EN', 'Recording Equipment');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (132, 'ES', 'Equipos de Grabación');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (133, 'EN', 'Video Equipment');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (133, 'ES', 'Equipos Video');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (134, 'EN', 'Gemstones & Jewelry');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (134, 'ES', 'Gemas y Joyas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (135, 'EN', 'Ancient');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (135, 'ES', 'Antiguas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (136, 'EN', 'Beaded Jewelry');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (136, 'ES', 'Joyerí­a bordada');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (137, 'EN', 'Beads');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (137, 'ES', 'Granos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (138, 'EN', 'Carved & Cameo');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (138, 'ES', 'Cameo & Grabado');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (139, 'EN', 'Contemporary');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (139, 'ES', 'Contemporanea');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (140, 'EN', 'Costume');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (140, 'ES', 'Ropa');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (141, 'EN', 'Fine');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (141, 'ES', 'Fina');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (142, 'EN', 'Gemstones');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (142, 'ES', 'Gemas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (143, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (143, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (144, 'EN', 'Gold');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (144, 'ES', 'Oro');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (145, 'EN', 'Necklaces');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (145, 'ES', 'Collares');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (146, 'EN', 'Silver');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (146, 'ES', 'Plata');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (147, 'EN', 'Victorian');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (147, 'ES', 'Victoriana');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (148, 'EN', 'Vintage');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (148, 'ES', 'Vintage');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (149, 'EN', 'Home & Garden');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (149, 'ES', 'Hogar  y Jardin');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (150, 'EN', 'Baby Items');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (150, 'ES', 'Artículos de bebé');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (151, 'EN', 'Crafts');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (151, 'ES', 'Artesaní­a');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (152, 'EN', 'Furniture');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (152, 'ES', 'Muebles');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (153, 'EN', 'Garden');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (153, 'ES', 'Jardí­n');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (154, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (154, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (155, 'EN', 'Household Items');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (155, 'ES', 'Artí­culos del Hogar');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (156, 'EN', 'Pet Supplies');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (156, 'ES', 'Artí­culos mascotas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (157, 'EN', 'Tools & Hardware');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (157, 'ES', 'Herramientas & Equipo');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (158, 'EN', 'Weddings');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (158, 'ES', 'Bodas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (159, 'EN', 'Movies & Video');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (159, 'ES', 'Pelí­culas & Video');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (160, 'EN', 'DVD');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (160, 'ES', 'DVD');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (161, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (161, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (162, 'EN', 'Laser Discs');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (162, 'ES', 'Discos Laser');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (163, 'EN', 'VHS');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (163, 'ES', 'VHS');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (164, 'EN', 'Music');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (164, 'ES', 'Música');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (165, 'EN', 'CDs');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (165, 'ES', 'CDs');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (166, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (166, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (167, 'EN', 'Instruments');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (167, 'ES', 'Instrumentos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (168, 'EN', 'Memorabilia');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (168, 'ES', 'Memorabilia');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (169, 'EN', 'Records');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (169, 'ES', 'Grabaciones - Vynilos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (170, 'EN', 'Tapes');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (170, 'ES', 'Cintas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (171, 'EN', 'Office & Business');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (171, 'ES', 'Oficina y Negocios');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (172, 'EN', 'Briefcases');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (172, 'ES', 'Portafolio');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (173, 'EN', 'Fax Machines');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (173, 'ES', 'Fax');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (174, 'EN', 'General Equipment');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (174, 'ES', 'Equipo General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (175, 'EN', 'Pagers');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (175, 'ES', 'Localizadores');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (176, 'EN', 'Other Goods & Services');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (176, 'ES', 'Otros Bienes y Servicios');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (177, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (177, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (178, 'EN', 'Metaphysical');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (178, 'ES', 'Metafí­sicos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (179, 'EN', 'Property');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (179, 'ES', 'Propiedades');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (180, 'EN', 'Services');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (180, 'ES', 'Servicios');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (181, 'EN', 'Tickets & Events');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (181, 'ES', 'Entradas & Eventos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (182, 'EN', 'Transportation');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (182, 'ES', 'Transporte');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (183, 'EN', 'Travel');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (183, 'ES', 'Viajes');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (184, 'EN', 'Sports & Recreation');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (184, 'ES', 'Deportes y Ocio');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (185, 'EN', 'Apparel & Equipment');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (185, 'ES', 'Equipamiento & Accesorios');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (186, 'EN', 'Exercise Equipment');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (186, 'ES', 'Equipo de ejercicio');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (187, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (187, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (188, 'EN', 'Toys & Games');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (188, 'ES', 'Juguetes y Juegos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (189, 'EN', 'Action Figures');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (189, 'ES', 'Figuras de Acción');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (190, 'EN', 'Beanie Babies & Beanbag Toys');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (190, 'ES', 'Beanie Babies & Beanbag Toys');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (191, 'EN', 'Diecast');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (191, 'ES', 'Diecast');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (192, 'EN', 'Fast Food');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (192, 'ES', 'Comida rá¡pida');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (193, 'EN', 'Fisher-Price');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (193, 'ES', 'Fisher-Price');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (194, 'EN', 'Furby');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (194, 'ES', 'Furby');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (195, 'EN', 'Games');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (195, 'ES', 'Juegos');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (196, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (196, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (197, 'EN', 'Giga Pet & Tamagotchi');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (197, 'ES', 'Giga Pet & Tamagotchi');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (198, 'EN', 'Hobbies');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (198, 'ES', 'Hobbies');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (199, 'EN', 'Marbles');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (199, 'ES', 'Canicas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (200, 'EN', 'My Little Pony');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (200, 'ES', 'Mi pequeño Pony');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (201, 'EN', 'Peanuts Gang');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (201, 'ES', 'Peanuts - Snoopy y su Pandilla');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (202, 'EN', 'Pez');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (202, 'ES', 'Pez');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (203, 'EN', 'Plastic Models');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (203, 'ES', 'Modelos de Plástico');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (204, 'EN', 'Plush Toys');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (204, 'ES', 'Juguetes de Felpa');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (205, 'EN', 'Puzzles');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (205, 'ES', 'Puzzles');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (206, 'EN', 'Slot Cars');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (206, 'ES', 'Coches para pistas');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (207, 'EN', 'Teletubbies');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (207, 'ES', 'Teletubbies');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (208, 'EN', 'Toy Soldiers');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (208, 'ES', 'Soldados de juguete');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (209, 'EN', 'Vintage Tin');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (209, 'ES', 'Latas Vintage');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (210, 'EN', 'Vintage Vehicles');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (210, 'ES', 'Vehí­culos Vintage');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (211, 'EN', 'Vintage');";
$query[] = "INSERT INTO `".$DBPrefix."cats_translated` VALUES (211, 'ES', 'Vintage');";

# ############################

# 
# Table structure for table `".$DBPrefix."closedrelisted`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."closedrelisted`;";
$query[] = "CREATE TABLE `".$DBPrefix."closedrelisted` (
  `auction` int(32) default '0',
  `relistdate` varchar(8) NOT NULL default '',
  `newauction` int(32) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."closedrelisted`
# 

# Table structure for table `".$DBPrefix."comm_messages`

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."comm_messages`;";
$query[] = "CREATE TABLE `".$DBPrefix."comm_messages` (
  `id` int(11) NOT NULL auto_increment,
  `boardid` int(11) NOT NULL default '0',
  `msgdate` varchar(14) NOT NULL default '',
  `user` int(11) NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `message` text NOT NULL,
  KEY `msg_id` (`id`)
);";

# Dumping data for table `".$DBPrefix."comm_messages`


# Table structure for table `".$DBPrefix."community`

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."community`;";
$query[] = "CREATE TABLE `".$DBPrefix."community` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '0',
  `messages` int(11) NOT NULL default '0',
  `lastmessage` varchar(14) NOT NULL default '0',
  `msgstoshow` int(11) NOT NULL default '0',
  `active` int(1) NOT NULL default '1',
  KEY `msg_id` (`id`)
);";

# Dumping data for table `".$DBPrefix."community`

$query[] = "INSERT INTO `".$DBPrefix."community` VALUES (1, 'Selling', 0, '', 30, 1);";
$query[] = "INSERT INTO `".$DBPrefix."community` VALUES (2, 'Buying', 0, '20050823103800', 30, 1);";

# ############################

# 
# Table structure for table `".$DBPrefix."counters`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."counters`;";
$query[] = "CREATE TABLE `".$DBPrefix."counters` (
  `users` int(11) default '0',
  `auctions` int(11) default '0',
  `closedauctions` int(11) NOT NULL default '0',
  `inactiveusers` int(11) NOT NULL default '0',
  `bids` int(11) NOT NULL default '0',
  `transactions` int(11) NOT NULL default '0',
  `totalamount` double NOT NULL default '0',
  `resetdate` varchar(8) NOT NULL default '',
  `fees` double NOT NULL default '0',
  `suspendedauction` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."counters`
# 

$query[] = "INSERT INTO `".$DBPrefix."counters` VALUES (0, 0, 0, 0, 0, 0, 0, '20070101', 0, 0);";

# ############################

# 
# Table structure for table `".$DBPrefix."counterstoshow`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."counterstoshow`;";
$query[] = "CREATE TABLE `".$DBPrefix."counterstoshow` (
  `auctions` enum('y','n') NOT NULL default 'y',
  `users` enum('y','n') NOT NULL default 'y',
  `online` enum('y','n') NOT NULL default 'y'
) ;";

# 
# Dumping data for table `".$DBPrefix."counterstoshow`
# 

$query[] = "INSERT INTO `".$DBPrefix."counterstoshow` VALUES ('y', 'y', 'y');";

# ############################

# 
# Table structure for table `".$DBPrefix."countries`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."countries`;";
$query[] = "CREATE TABLE `".$DBPrefix."countries` (
  `country` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`country`)
) ;";

# 
# Dumping data for table `".$DBPrefix."countries`
# 

$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Afghanistan');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Albania');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Algeria');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('American Samoa');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Andorra');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Angola');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Anguilla');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Antarctica');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Antigua And Barbuda');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Argentina');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Armenia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Aruba');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Australia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Austria');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Azerbaijan');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Bahamas');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Bahrain');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Bangladesh');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Barbados');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Belarus');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Belgium');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Belize');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Benin');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Bermuda');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Bhutan');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Bolivia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Bosnia and Herzegowina');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Botswana');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Bouvet Island');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Brazil');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('British Indian Ocean Territory');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Brunei Darussalam');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Bulgaria');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Burkina Faso');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Burma');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Burundi');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Cambodia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Cameroon');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Canada');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Cape Verde');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Cayman Islands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Central African Republic');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Chad');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Chile');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('China');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Christmas Island');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Cocos (Keeling) Islands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Colombia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Comoros');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Congo');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Congo, the Democratic Republic');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Cook Islands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Costa Rica');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Cote d''Ivoire');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Croatia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Cyprus');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Czech Republic');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Denmark');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Djibouti');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Dominica');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Dominican Republic');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('East Timor');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Ecuador');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Egypt');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('El Salvador');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('England');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Equatorial Guinea');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Eritrea');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Estonia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Ethiopia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Falkland Islands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Faroe Islands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Fiji');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Finland');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('France');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('French Guiana');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('French Polynesia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('French Southern Territories');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Gabon');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Gambia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Georgia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Germany');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Ghana');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Gibraltar');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Great Britain');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Greece');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Greenland');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Grenada');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Guadeloupe');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Guam');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Guatemala');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Guinea');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Guinea-Bissau');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Guyana');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Haiti');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Heard and Mc Donald Islands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Holy See (Vatican City State)');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Honduras');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Hong Kong');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Hungary');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Iceland');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('India');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Indonesia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Ireland');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Israel');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Italy');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Jamaica');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Japan');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Jordan');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Kazakhstan');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Kenya');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Kiribati');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Korea (South)');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Kuwait');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Kyrgyzstan');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Lao People''s Democratic Republ');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Latvia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Lebanon');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Lesotho');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Liberia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Liechtenstein');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Lithuania');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Luxembourg');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Macau');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Macedonia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Madagascar');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Malawi');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Malaysia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Maldives');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Mali');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Malta');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Marshall Islands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Martinique');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Mauritania');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Mauritius');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Mayotte');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Mexico');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Micronesia, Federated States o');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Moldova, Republic of');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Monaco');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Mongolia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Montserrat');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Morocco');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Mozambique');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Namibia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Nauru');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Nepal');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Netherlands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Netherlands Antilles');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('New Caledonia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('New Zealand');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Nicaragua');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Niger');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Nigeria');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Niuev');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Norfolk Island');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Northern Ireland');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Northern Mariana Islands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Norway');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Oman');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Pakistan');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Palau');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Panama');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Papua New Guinea');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Paraguay');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Peru');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Philippines');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Pitcairn');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Poland');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Portugal');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Puerto Rico');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Qatar');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Reunion');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Romania');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Russian Federation');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Rwanda');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Saint Kitts and Nevis');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Saint Lucia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Saint Vincent and the Grenadin');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Samoa (Independent)');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('San Marino');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Sao Tome and Principe');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Saudi Arabia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Scotland');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Senegal');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Seychelles');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Sierra Leone');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Singapore');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Slovakia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Slovenia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Solomon Islands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Somalia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('South Africa');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('South Georgia and the South Sa');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Spain');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Sri Lanka');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('St. Helena');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('St. Pierre and Miquelon');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Suriname');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Svalbard and Jan Mayen Islands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Swaziland');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Sweden');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Switzerland');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Taiwan');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Tajikistan');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Tanzania');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Thailand');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Togo');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Tokelau');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Tonga');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Trinidad and Tobago');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Tunisia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Turkey');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Turkmenistan');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Turks and Caicos Islands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Tuvalu');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Uganda');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Ukraine');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('United Arab Emiratesv');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('United States');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Uruguay');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Uzbekistan');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Vanuatu');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Venezuela');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Viet Nam');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Virgin Islands (British)');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Virgin Islands (U.S.)');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Wales');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Wallis and Futuna Islands');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Western Sahara');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Yemen');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Zambia');";
$query[] = "INSERT INTO `".$DBPrefix."countries` VALUES ('Zimbabwe');";

# ############################

# 
# Table structure for table `".$DBPrefix."currencies`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."currencies`;";
$query[] = "CREATE TABLE `".$DBPrefix."currencies` (
  `id` int(11) NOT NULL auto_increment,
  `currency` varchar(100) NOT NULL default '',
  KEY `id` (`id`)
) AUTO_INCREMENT=1 ;";

# 
# Dumping data for table `".$DBPrefix."currencies`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."currentaccesses`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."currentaccesses`;";
$query[] = "CREATE TABLE `".$DBPrefix."currentaccesses` (
  `day` char(2) NOT NULL default '',
  `month` char(2) NOT NULL default '',
  `year` char(4) NOT NULL default '',
  `pageviews` int(11) NOT NULL default '0',
  `uniquevisitors` int(11) NOT NULL default '0',
  `usersessions` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."currentaccesses`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."currentbrowsers`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."currentbrowsers`;";
$query[] = "CREATE TABLE `".$DBPrefix."currentbrowsers` (
  `month` char(2) NOT NULL default '',
  `year` varchar(4) NOT NULL default '',
  `browser` varchar(50) NOT NULL default '0',
  `counter` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."currentbrowsers`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."currentdomains`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."currentdomains`;";
$query[] = "CREATE TABLE `".$DBPrefix."currentdomains` (
  `month` char(2) NOT NULL default '',
  `year` varchar(4) NOT NULL default '',
  `domain` varchar(100) NOT NULL default '0',
  `counter` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."currentdomains`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."currentplatforms`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."currentplatforms`;";
$query[] = "CREATE TABLE `".$DBPrefix."currentplatforms` (
  `month` char(2) NOT NULL default '',
  `year` varchar(4) NOT NULL default '',
  `platform` varchar(50) NOT NULL default '0',
  `counter` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."currentplatforms`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."durations`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."durations`;";
$query[] = "CREATE TABLE `".$DBPrefix."durations` (
  `days` int(11) NOT NULL default '0',
  `description` varchar(30) default NULL
) ;";

# 
# Dumping data for table `".$DBPrefix."durations`
# 

$query[] = "INSERT INTO `".$DBPrefix."durations` VALUES (1, '1 day');";
$query[] = "INSERT INTO `".$DBPrefix."durations` VALUES (2, '2 days');";
$query[] = "INSERT INTO `".$DBPrefix."durations` VALUES (3, '3 days');";
$query[] = "INSERT INTO `".$DBPrefix."durations` VALUES (7, '1 week');";
$query[] = "INSERT INTO `".$DBPrefix."durations` VALUES (14, '2 weeks');";
$query[] = "INSERT INTO `".$DBPrefix."durations` VALUES (21, '3 weeks');";
$query[] = "INSERT INTO `".$DBPrefix."durations` VALUES (30, '1 month');";

# ############################

# 
# Table structure for table `".$DBPrefix."faqs`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."faqs`;";
$query[] = "CREATE TABLE `".$DBPrefix."faqs` (
  `id` int(11) NOT NULL auto_increment,
  `question` varchar(200) NOT NULL default '',
  `answer` text NOT NULL,
  `category` int(11) NOT NULL default '0',
  KEY `id` (`id`)
) ;";

# 
# Dumping data for table `".$DBPrefix."faqs`
# 

$query[] = "INSERT INTO `".$DBPrefix."faqs` VALUES (2, 'Registering', 'To register as a new user, click on Register at the top of the window. You will be asked for your name, a username and password, and contact information, including your email address.\r\n\r\n<B>You must be at least 18 years of age to register.</B>!', 1);";
$query[] = "INSERT INTO `".$DBPrefix."faqs` VALUES (4, 'Item Watch', '<b>Item watch</b> notifies you when someone bids on the auctions that you have added to your Item Watch. ', 3);";
$query[] = "INSERT INTO `".$DBPrefix."faqs` VALUES (5, 'What is a Dutch auction?', 'Dutch auction is a type of auction where the auctioneer begins with a high asking price which is lowered until some participant is willing to accept the auctioneer\'s price. The winning participant pays the last announced price.', 1);";

# ############################

# 
# Table structure for table `".$DBPrefix."faqs_translated`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."faqs_translated`;";
$query[] = "CREATE TABLE `".$DBPrefix."faqs_translated` (
  `id` int(11) NOT NULL auto_increment,
  `lang` char(2) NOT NULL default '',
  `question` varchar(200) NOT NULL default '',
  `answer` text NOT NULL,
  KEY `id` (`id`)
) ;";

# 
# Dumping data for table `".$DBPrefix."faqs_translated`
# 

$query[] = "INSERT INTO `".$DBPrefix."faqs_translated` VALUES (2, 'EN', 'Registering', 'To register as a new user, click on Register at the top of the window. You will be asked for your name, a username and password, and contact information, including your email address.\r\n\r\n<B>You must be at least 18 years of age to register.</B>!');";
$query[] = "INSERT INTO `".$DBPrefix."faqs_translated` VALUES (2, 'ES', 'Registrarse', 'Para registrar un nuevo usuario, haz click en <B>Reg&iacute;Â­strate</B> en la parte superior de la pantalla. Se te preguntar&aacute;n tus datos personales, un nombre de usuario, una contrase&ntilde;a e informacion de contacto como la direccion e-mail.\r\n\r\n<B>�Tienes que ser mayor de edad para poder registrarte!</B>');";
$query[] = "INSERT INTO `".$DBPrefix."faqs_translated` VALUES (4, 'EN', 'Item Watch', '<b>Item watch</b> notifies you when someone bids on the auctions that you have added to your Item Watch. ');";
$query[] = "INSERT INTO `".$DBPrefix."faqs_translated` VALUES (4, 'ES', 'En la Mira', '<i><b>En la Mira</b></i> te env&iacute;a una notificacion por e-mail, cada vez que alguien puja en una de las subastas que has a&ntilde;adido a tu lista <i>En la Mira</i>. ');";
$query[] = "INSERT INTO `".$DBPrefix."faqs_translated` VALUES (6, 'ES', 'Auction Watch', '<i><B>Auction Watch</b></i> es tu asistente para saber cuando se abre una subasta cuya descripcion contiene palabras clave de tu interes.\r\n\r\nPara usar esta opcion inserta las palabras clave en las que est&aacute;s interesado en la lista de <i>Auction Watch</i>. Todas las palabras claves deben estar separadas por un espacio. Cuando estas palabras claves aparezcan en alg&uacute;n t&iacute;tulo o descripcion de subasta, recibir&aacute;s un e-mail con la informacion de que una subasta que contiene tus palabras claves ha sido creada. Tambi&aacute;n puedas agregar el nombre del usuario como palabra clave. ');";

# ############################

# 
# Table structure for table `".$DBPrefix."faqscat_translated`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."faqscat_translated`;";
$query[] = "CREATE TABLE `".$DBPrefix."faqscat_translated` (
  `id` int(11) NOT NULL default '0',
  `lang` char(2) NOT NULL default '',
  `category` varchar(255) NOT NULL default ''
) ;";

# 
# Dumping data for table `".$DBPrefix."faqscat_translated`
# 

$query[] = "INSERT INTO `".$DBPrefix."faqscat_translated` VALUES (3, 'EN', 'Buying');";
$query[] = "INSERT INTO `".$DBPrefix."faqscat_translated` VALUES (3, 'ES', 'Comprar');";
$query[] = "INSERT INTO `".$DBPrefix."faqscat_translated` VALUES (1, 'EN', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."faqscat_translated` VALUES (1, 'ES', 'General');";
$query[] = "INSERT INTO `".$DBPrefix."faqscat_translated` VALUES (2, 'EN', 'Selling');";
$query[] = "INSERT INTO `".$DBPrefix."faqscat_translated` VALUES (2, 'ES', 'Vender');";

# ############################

# 
# Table structure for table `".$DBPrefix."faqscategories`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."faqscategories`;";
$query[] = "CREATE TABLE `".$DBPrefix."faqscategories` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(200) NOT NULL default '',
  KEY `id` (`id`)
) ;";

# 
# Dumping data for table `".$DBPrefix."faqscategories`
# 

$query[] = "INSERT INTO `".$DBPrefix."faqscategories` VALUES (1, 'General');";
$query[] = "INSERT INTO `".$DBPrefix."faqscategories` VALUES (2, 'Selling');";
$query[] = "INSERT INTO `".$DBPrefix."faqscategories` VALUES (3, 'Buying');";

# ############################

# 
# Table structure for table `".$DBPrefix."feedbacks`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."feedbacks`;";
$query[] = "CREATE TABLE `".$DBPrefix."feedbacks` (
  `id` int(11) NOT NULL auto_increment,
  `rated_user_id` int(32) default NULL,
  `rater_user_nick` varchar(20) default NULL,
  `feedback` mediumtext,
  `rate` int(2) default NULL,
  `feedbackdate` timestamp ,
  `auction_id` int(32) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ;";

# 
# Dumping data for table `".$DBPrefix."feedbacks`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."feedbacksanswers`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."feedbacks`;";
$query[] = "CREATE TABLE `".$DBPrefix."feedbacks` (
  `id` int(11) NOT NULL auto_increment,
  `feedbackid` int(11) NOT NULL default '0',
  `rated_user_id` int(32) default NULL,
  `comment` text,
  `feedbackdate` timestamp ,
  PRIMARY KEY  (`id`)
) ;";

# 
# Dumping data for table `".$DBPrefix."feedbacksanswers`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."feedforum`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."feedforum`;";
$query[] = "CREATE TABLE `".$DBPrefix."feedforum` (
  `id` int(11) NOT NULL auto_increment,
  `feed_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `seqnum` int(11) NOT NULL default '0',
  `commentdate` timestamp ,
  `COMMENT` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;";

# 
# Dumping data for table `".$DBPrefix."feedforum`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."filterwords`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."filterwords`;";
$query[] = "CREATE TABLE `".$DBPrefix."filterwords` (
  `word` varchar(255) NOT NULL default ''
) ;";

# 
# Dumping data for table `".$DBPrefix."filterwords`
# 

$query[] = "INSERT INTO `".$DBPrefix."filterwords` VALUES ('');";

# ############################

# 
# Table structure for table `".$DBPrefix."fontsandcolors`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."fontsandcolors`;";
$query[] = "CREATE TABLE `".$DBPrefix."fontsandcolors` (
  `err_font` int(2) NOT NULL default '0',
  `err_font_size` int(2) default NULL,
  `err_font_color` varchar(7) default NULL,
  `err_font_bold` enum('y','n') default NULL,
  `err_font_italic` enum('y','n') default NULL,
  `std_font` int(2) NOT NULL default '0',
  `std_font_size` int(2) default NULL,
  `std_font_color` varchar(7) default NULL,
  `std_font_bold` enum('y','n') default NULL,
  `std_font_italic` enum('y','n') default NULL,
  `sml_font` int(2) NOT NULL default '0',
  `sml_font_size` int(2) NOT NULL default '0',
  `sml_font_color` varchar(7) NOT NULL default '',
  `sml_font_bold` enum('y','n') NOT NULL default 'y',
  `sml_font_italic` enum('y','n') NOT NULL default 'y',
  `tlt_font` int(2) NOT NULL default '0',
  `tlt_font_size` int(2) default NULL,
  `tlt_font_color` varchar(7) default NULL,
  `tlt_font_bold` enum('y','n') default NULL,
  `tlt_font_italic` enum('y','n') default NULL,
  `nav_font` int(2) NOT NULL default '0',
  `nav_font_size` int(2) NOT NULL default '0',
  `nav_font_color` varchar(7) NOT NULL default '',
  `nav_font_bold` enum('y','n') NOT NULL default 'y',
  `nav_font_italic` enum('y','n') NOT NULL default 'y',
  `footer_font` int(2) NOT NULL default '0',
  `footer_font_size` int(2) NOT NULL default '0',
  `footer_font_color` varchar(7) NOT NULL default '',
  `footer_font_bold` enum('y','n') NOT NULL default 'y',
  `footer_font_italic` enum('y','n') NOT NULL default 'y',
  `bordercolor` varchar(7) NOT NULL default '0',
  `headercolor` varchar(7) NOT NULL default '0',
  `tableheadercolor` varchar(7) NOT NULL default '0000',
  `linkscolor` varchar(7) NOT NULL default '0',
  `vlinkscolor` varchar(7) NOT NULL default '0',
  `highlighteditems` varchar(7) NOT NULL default ''
) ;";

# 
# Dumping data for table `".$DBPrefix."fontsandcolors`
# 

$query[] = "INSERT INTO `".$DBPrefix."fontsandcolors` VALUES (1, 3, '#FF9900', 'y', 'n', 1, 2, '#000000', 'n', 'n', 1, 1, '#000000', 'n', 'n', 2, 4, '#3300CC', 'y', 'n', 1, 3, '#3366CC', 'y', 'n', 1, 1, '#aaaaaa', 'n', 'n', '3366cc', '#ffffff', '#888888', '003399', '#333333', 'd8ebff');";

# ############################

# 
# Table structure for table `".$DBPrefix."freecategories`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."freecategories`;";
$query[] = "CREATE TABLE `".$DBPrefix."freecategories` (
  `category` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."freecategories`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."messages`;";
$query[] = "CREATE TABLE `".$DBPrefix."messages` (
`id` int( 50 ) NOT NULL AUTO_INCREMENT ,
`sentto` int( 25 ) NOT NULL default '0',
`from` int( 25 ) NOT NULL default '0',
`when` varchar( 20 ) NOT NULL default '',
`message` text NOT NULL ,
`read` int( 1 ) NOT NULL default '0',
`subject` varchar( 50 ) NOT NULL default '',
`replied` int( 1 ) NOT NULL default '0',
`noticed` int( 1 ) NOT NULL default '0',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = latin1;";

# ############################

# 
# Table structure for table `".$DBPrefix."https`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."https`;";
$query[] = "CREATE TABLE `".$DBPrefix."https` (
  `https` enum('yes','no') default NULL,
  `httpsurl` varchar(255) default NULL
) ;";

# 
# Dumping data for table `".$DBPrefix."https`
# 

$query[] = "INSERT INTO `".$DBPrefix."https` VALUES ('no', 'https://yourdomain.com/path/to/phpauction/');";

# ############################

# 
# Table structure for table `".$DBPrefix."increments`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."increments`;";
$query[] = "CREATE TABLE `".$DBPrefix."increments` (
  `id` char(3) default NULL,
  `low` double(16,4) default NULL,
  `high` double(16,4) default NULL,
  `increment` double(16,4) default NULL
) ;";

# 
# Dumping data for table `".$DBPrefix."increments`
# 

$query[] = "INSERT INTO `".$DBPrefix."increments` VALUES ('1', 0.0000, 0.9900, 0.2800);";
$query[] = "INSERT INTO `".$DBPrefix."increments` VALUES ('2', 1.0000, 9.9900, 0.5000);";
$query[] = "INSERT INTO `".$DBPrefix."increments` VALUES ('3', 10.0000, 29.9900, 1.0000);";
$query[] = "INSERT INTO `".$DBPrefix."increments` VALUES ('4', 30.0000, 99.9900, 2.0000);";
$query[] = "INSERT INTO `".$DBPrefix."increments` VALUES ('5', 100.0000, 249.9900, 5.0000);";
$query[] = "INSERT INTO `".$DBPrefix."increments` VALUES ('6', 250.0000, 499.9900, 10.0000);";
$query[] = "INSERT INTO `".$DBPrefix."increments` VALUES ('7', 500.0000, 999.9900, 25.0000);";

# ############################

# 
# Table structure for table `".$DBPrefix."lastupdate`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."lastupdate`;";
$query[] = "CREATE TABLE `".$DBPrefix."lastupdate` (
  `last_update` datetime default NULL,
  `updateinterval` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."lastupdate`
# 

$query[] = "INSERT INTO `".$DBPrefix."lastupdate` VALUES ('2004-06-11 17:40:10', 100);";

# ############################

# 
# Table structure for table `".$DBPrefix."maintainance`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."maintainance`;";
$query[] = "CREATE TABLE `".$DBPrefix."maintainance` (
  `id` int(11) NOT NULL auto_increment,
  `active` enum('y','n') default NULL,
  `superuser` varchar(32) default NULL,
  `maintainancetext` text,
  KEY `id` (`id`)
) ;";

# 
# Dumping data for table `".$DBPrefix."maintainance`
# 

$query[] = "INSERT INTO `".$DBPrefix."maintainance` VALUES (1, 'n', 'gianluca', '<BR>\r\n<CENTER>\r\n<B>Under maintainance!!!!!!!</b>\r\n</center>');";

# ############################

# 
# Table structure for table `".$DBPrefix."membertypes`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."membertypes`;";
$query[] = "CREATE TABLE `".$DBPrefix."membertypes` (
  `id` int(11) NOT NULL auto_increment,
  `feedbacks` int(11) NOT NULL default '0',
  `membertype` varchar(30) NOT NULL default '',
  `discount` tinyint(4) NOT NULL default '0',
  `icon` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ;";

# 
# Dumping data for table `".$DBPrefix."membertypes`
# 

$query[] = "INSERT INTO `".$DBPrefix."membertypes` VALUES (24, 9, '', 0, 'transparent.gif');";
$query[] = "INSERT INTO `".$DBPrefix."membertypes` VALUES (22, 999999, '100000', 0, 'starFR.gif');";
$query[] = "INSERT INTO `".$DBPrefix."membertypes` VALUES (21, 99999, '50000', 0, 'starFV.gif');";
$query[] = "INSERT INTO `".$DBPrefix."membertypes` VALUES (20, 49999, '25000', 0, 'starFT.gif');";
$query[] = "INSERT INTO `".$DBPrefix."membertypes` VALUES (19, 24999, '10000', 0, 'starFY.gif');";
$query[] = "INSERT INTO `".$DBPrefix."membertypes` VALUES (23, 9999, '5000', 0, 'starG.gif');";
$query[] = "INSERT INTO `".$DBPrefix."membertypes` VALUES (17, 4999, '1000', 0, 'starR.gif');";
$query[] = "INSERT INTO `".$DBPrefix."membertypes` VALUES (16, 999, '100', 0, 'starT.gif');";
$query[] = "INSERT INTO `".$DBPrefix."membertypes` VALUES (15, 99, '50', 0, 'starB.gif');";
$query[] = "INSERT INTO `".$DBPrefix."membertypes` VALUES (14, 49, '10', 0, 'starY.gif');";

# ############################

# 
# Table structure for table `".$DBPrefix."news`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."news`;";
$query[] = "CREATE TABLE `".$DBPrefix."news` (
  `id` int(32) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL default '',
  `content` longtext NOT NULL,
  `new_date` int(8) NOT NULL default '0',
  `suspended` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ;";

# 
# Dumping data for table `".$DBPrefix."news`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."news_translated`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."news_translated`;";
$query[] = "CREATE TABLE `".$DBPrefix."news_translated` (
  `id` int(11) NOT NULL default '0',
  `lang` char(2) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `content` text NOT NULL
) ;";

# 
# Dumping data for table `".$DBPrefix."news_translated`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."online`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."online`;";
$query[] = "CREATE TABLE `".$DBPrefix."online` (
  `ID` bigint(21) NOT NULL auto_increment,
  `SESSION` varchar(255) NOT NULL default '',
  `time` bigint(21) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ;";

# 
# Dumping data for table `".$DBPrefix."online`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."payments`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."payments`;";
$query[] = "CREATE TABLE `".$DBPrefix."payments` (
  `id` int(2) default NULL,
  `description` varchar(30) default NULL
) ;";

# 
# Dumping data for table `".$DBPrefix."payments`
# 

$query[] = "INSERT INTO `".$DBPrefix."payments` VALUES (1, 'Paypal');";
$query[] = "INSERT INTO `".$DBPrefix."payments` VALUES (2, 'Wire Transfer');";

# ############################

# 
# Table structure for table `".$DBPrefix."pendingnotif`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."pendingnotif`;";
$query[] = "CREATE TABLE `".$DBPrefix."pendingnotif` (
  `id` int(11) NOT NULL auto_increment,
  `auction_id` int(11) NOT NULL default '0',
  `seller_id` int(11) NOT NULL default '0',
  `winners` text NOT NULL,
  `auction` text NOT NULL,
  `seller` text NOT NULL,
  `thisdate` varchar(8) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ;";

# 
# Dumping data for table `".$DBPrefix."pendingnotif`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."platforms`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."platforms`;";
$query[] = "CREATE TABLE `".$DBPrefix."platforms` (
  `month` char(2) NOT NULL default '',
  `year` varchar(4) NOT NULL default '',
  `browser` varchar(50) NOT NULL default '0',
  `counter` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."platforms`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."proxybid`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."proxybid`;";
$query[] = "CREATE TABLE `".$DBPrefix."proxybid` (
  `itemid` int(32) default NULL,
  `userid` int(32) default NULL,
  `bid` double(16,4) default NULL
) ;";

# 
# Dumping data for table `".$DBPrefix."proxybid`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."rates`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."rates`;";
$query[] = "CREATE TABLE `".$DBPrefix."rates` (
  `id` int(11) NOT NULL auto_increment,
  `ime` tinytext NOT NULL,
  `valuta` tinytext NOT NULL,
  `rate` float(8,2) NOT NULL default '0.00',
  `sifra` tinytext NOT NULL,
  `symbol` char(3) NOT NULL default '',
  KEY `id` (`id`)
) AUTO_INCREMENT=64 ;";

# 
# Dumping data for table `".$DBPrefix."rates`
# 

$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (1, 'United States', 'U.S. Dollar', 1.00, 'U.S. Dollar ', 'USD');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (2, 'Argentina', 'Argentinian Peso', 2.97, 'Argentine Peso ', 'ARS');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (3, 'Australia', 'Australian Dollar ', 1.45, 'Australian Dollar ', 'AUD');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (5, 'Brazil', 'Brazilian Real ', 3.15, 'Brazilian Real ', 'BRL');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (6, 'Chile', 'Chilean Peso ', 649.86, 'Chilean Peso ', 'CLP');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (7, 'China', 'Chinese Renminbi ', 8.28, 'Chinese Renminbi ', 'CNY');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (8, 'Colombia', 'Colombian Peso ', 2734.87, 'Colombian Peso ', 'COP');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (10, 'Czech. Republic', 'Czech. Republic Koruna ', 26.17, 'Czech. Republic Koruna ', 'CZK');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (11, 'Denmark', 'Danish Krone ', 6.19, 'Danish Krone ', 'DKK');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (12, 'European Union', 'EURO', 0.83, 'European Monetary Union EURO', 'EUR');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (13, 'Fiji', 'Fiji Dollar ', 1.78, 'Fiji Dollar ', 'FJD');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (16, 'Hong Kong', 'Hong Kong Dollar', 7.80, 'Hong Kong Dollar ', 'HKD');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (18, 'Iceland', 'Icelandic Krona ', 72.47, 'Icelandic Krona ', 'INR');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (19, 'India', 'Indian Rupee', 45.07, 'Indian Rupee ', 'INR');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (20, 'Indonesia', 'Indonesian Rupiah ', 9411.72, 'Indonesian Rupiah ', 'IDR');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (21, 'Israel', 'Israeli New Shekel ', 4.53, 'Israeli New Shekel ', 'ILS');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (22, 'Japan', 'Japanese Yen', 110.08, 'Japanese Yen ', 'JPY');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (23, 'Malaysia', 'Malaysian Ringgit ', 3.80, 'Malaysian Ringgit ', 'MYR');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (24, 'Mexico', 'New Peso', 10.81, 'Mexican New Peso ', 'MXN');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (25, 'Morocco', 'Moroccan Dirham ', 9.11, 'Moroccan Dirham ', 'MAD');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (28, 'New Zealand', 'New Zealand Dollar', 1.59, 'New Zealand Dollar ', 'NZD');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (29, 'Norway', 'Norwege Krone', 6.92, 'Norwegian Krone ', 'NOK');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (30, 'Pakistan', 'Pakistan Rupee ', 57.83, 'Pakistan Rupee ', 'PKR');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (31, 'Panama', 'Panamanian Balboa ', 1.00, 'Panamanian Balboa ', 'PAB');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (32, 'Peru', 'Peruvian New Sol', 3.48, 'Peruvian New Sol ', 'PEN');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (33, 'Philippine', 'Philippine Peso ', 55.79, 'Philippine Peso ', 'PHP');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (34, 'Poland', 'Polish Zloty', 3.82, 'Polish Zloty ', 'PLN');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (35, 'Russian', 'Russian Rouble', 29.02, 'Russian Rouble ', 'RUR');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (36, 'Singapore', 'Singapore Dollar ', 1.72, 'Singapore Dollar ', 'SGD');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (37, 'Slovakia', 'Koruna', 33.16, 'Slovak Koruna ', 'SKK');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (38, 'Slovenia', 'Slovenian Tolar', 198.94, 'Slovenian Tolar ', 'SIT');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (39, 'South Africa', 'South African Rand', 6.51, 'South African Rand ', 'ZAR');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (40, 'South Korea', 'South Korean Won', 1164.42, 'South Korean Won ', 'KRW');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (41, 'Sri Lanka', 'Sri Lanka Rupee ', 99.98, 'Sri Lanka Rupee ', 'LKR');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (42, 'Sweden', 'Swedish Krona', 7.62, 'Swedish Krona ', 'SEK');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (43, 'Switzerland', 'Swiss Franc', 1.26, 'Swiss Franc ', 'CHF');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (44, 'Taiwan', 'Taiwanese New Dollar ', 33.46, 'Taiwanese New Dollar ', 'TWD');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (45, 'Thailand', 'Thailand Thai Baht ', 40.69, 'Thai Baht ', 'THB');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (47, 'Tunisia', 'Tunisisan Dinar', 1.27, 'Tunisian Dinar ', 'TND');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (48, 'Turkey', 'Turkish Lira', 150.05, 'Turkish Lira (2) ', 'TRL');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (49, 'Great Britain', 'Pound Sterling ', 0.57, 'Pound Sterling ', 'GBP');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (50, 'Venezuela', 'Bolivar ', 1916.71, 'Venezuelan Bolivar ', 'VEB');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (51, 'Bahamas', 'Bahamian Dollar', 1.00, 'Bahamian Dollar', 'BSD');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (52, 'Croatia', 'Croatian Kuna', 6.16, 'Croatian Kuna', 'HRK');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (53, 'East Caribe', 'East Caribbean Dollar', 0.00, 'East Caribbean Dollar', 'XCD');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (54, 'CFA Franc (African Financial Community)', 'African Financial Community Franc', 0.00, 'African Financial Community Franc', 'CFA');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (55, 'Pacific Financial Community', 'Pacific Financial Community Franc', 0.00, 'Pacific Financial Community', 'CFP');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (56, 'Ghana', 'Ghanaian Cedi', 8978.29, 'Ghanaian Cedi', 'GHC');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (57, 'Honduras', 'Honduras Lempira', 0.00, 'Honduras Lempira', 'HNL');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (58, 'Hungaria', 'Hungarian Forint', 210.83, 'Hungarian Forint', 'HUF');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (59, 'Jamaica', 'Jamaican Dollar', 60.52, 'Jamaican Dollar', 'JMD');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (60, 'Burma', 'Myanmar (Burma) Kyat', 5.82, 'Myanmar (Burma) Kyat', 'MMK');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (61, 'Neth. Antilles', 'Neth. Antilles Guilder', 1.78, 'Neth. Antilles Guilder', 'ANG');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (62, 'Trinidad & Tobago', 'Trinidad & Tobago Dollar', 6.15, 'Trinidad & Tobago Dollar', 'TTD');";
$query[] = "INSERT INTO `".$DBPrefix."rates` VALUES (63, 'Canadian', 'Canadian Dollar', 1.31, 'Canadian Dollar', 'CAD');";

# ############################

# 
# Table structure for table `".$DBPrefix."rememberme`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."rememberme`;";
$query[] = "CREATE TABLE `".$DBPrefix."rememberme` (
  `userid` int(11) NOT NULL default '0',
  `hashkey` char(32) NOT NULL default ''
) ;";

# 
# Dumping data for table `".$DBPrefix."rememberme`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."settings`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."settings`;";
$query[] = "CREATE TABLE `".$DBPrefix."settings` (
  `sitename` varchar(255) NOT NULL default '',
  `siteurl` varchar(255) NOT NULL default '',
  `cookiesprefix` varchar(100) NOT NULL default '',
  `loginbox` int(1) NOT NULL default '0',
  `newsbox` int(1) NOT NULL default '0',
  `newstoshow` int(11) NOT NULL default '0',
  `moneyformat` int(1) NOT NULL default '0',
  `moneydecimals` int(11) NOT NULL default '0',
  `moneysymbol` int(1) NOT NULL default '0',
  `currency` varchar(10) NOT NULL default '',
  `showacceptancetext` int(1) NOT NULL default '0',
  `acceptancetext` longtext NOT NULL,
  `adminmail` varchar(100) NOT NULL default '',
  `banners` int(1) NOT NULL default '0',
  `newsletter` int(1) NOT NULL default '0',
  `logo` varchar(255) NOT NULL default '',
  `timecorrection` int(11) NOT NULL default '0',
  `cron` int(1) NOT NULL default '0',
  `archiveafter` int(11) NOT NULL default '0',
  `datesformat` enum('USA','EUR') NOT NULL default 'USA',
  `feetype` enum('prepay','pay') NOT NULL default 'prepay',
  `sellersetupfee` int(1) NOT NULL default '0',
  `sellersetuptype` int(11) NOT NULL default '0',
  `sellerfinalfee` int(11) NOT NULL default '0',
  `sellerfinaltype` tinyint(4) NOT NULL default '0',
  `sellersetupvalue` double NOT NULL default '0',
  `sellerfinalvalue` double NOT NULL default '0',
  `buyerfinalfee` int(11) NOT NULL default '0',
  `buyerfinaltype` int(11) NOT NULL default '0',
  `buyerfinalvalue` double NOT NULL default '0',
  `paypaladdress` varchar(255) NOT NULL default '',
  `errortext` text NOT NULL,
  `errormail` varchar(255) NOT NULL default '',
  `signupfee` int(1) NOT NULL default '0',
  `signupvalue` double NOT NULL default '0',
  `picturesgallery` int(1) NOT NULL default '0',
  `maxpictures` int(11) NOT NULL default '0',
  `maxpicturesize` int(11) NOT NULL default '0',
  `picturesgalleryfee` int(11) NOT NULL default '0',
  `picturesgalleryvalue` double NOT NULL default '0',
  `buy_now` int(1) NOT NULL default '1',
  `alignment` varchar(15) NOT NULL default '',
  `featureditemsnumber` int(11) NOT NULL default '0',
  `featuredcolumns` int(11) NOT NULL default '2',
  `thimbnailswidth` int(11) NOT NULL default '0',
  `thumb_show` smallint(6) NOT NULL default '100',
  `catfeatureditemsnumber` int(11) NOT NULL default '0',
  `featureditems` enum('y','n') NOT NULL default 'y',
  `catthumbnailswidth` int(11) NOT NULL default '0',
  `lastitemsnumber` int(11) NOT NULL default '0',
  `higherbidsnumber` int(11) NOT NULL default '0',
  `endingsoonnumber` int(11) NOT NULL default '0',
  `boards` enum('y','n') NOT NULL default 'y',
  `boardslink` enum('y','n') NOT NULL default 'y',
  `wordsfilter` enum('y','n') NOT NULL default 'y',
  `aboutus` enum('y','n') NOT NULL default 'y',
  `aboutustext` text NOT NULL,
  `terms` enum('y','n') NOT NULL default 'y',
  `termstext` text NOT NULL,
  `invoicing` enum('y','n') NOT NULL default 'y',
  `invoicelimit` double NOT NULL default '0',
  `taxpercentage` double NOT NULL default '0',
  `invoicetheadmin` enum('y','n') NOT NULL default 'y',
  `userscreditcard` enum('y','n') NOT NULL default 'y',
  `defaultcountry` varchar(30) NOT NULL default '0',
  `reservefee` int(1) NOT NULL default '0',
  `reservetype` int(1) NOT NULL default '0',
  `reservevalue` double NOT NULL default '0',
  `privatefee` enum('y','n') NOT NULL default 'y',
  `privatefeevalue` double NOT NULL default '0',
  `privatefeetype` enum('fix','percentage') NOT NULL default 'fix',
  `relisting` int(11) NOT NULL default '0',
  `defaultlanguage` char(2) NOT NULL default 'EN',
  `pagewidth` int(11) NOT NULL default '0',
  `pagewidthtype` enum('perc','fix') NOT NULL default 'perc',
  `charge_ivf` enum('y','n') NOT NULL default 'n',
  `charge_ivf_auto` enum('y','n') NOT NULL default 'n',
  `taxname` varchar(10) NOT NULL default 'TVA',
  `usignupconfirmation` enum('y','n') NOT NULL default 'y',
  `sbsignupconfirmation` enum('n','s','b','sb') NOT NULL default 'n',
  `freecatstext` varchar(255) NOT NULL default '',
  `accounttype` enum('sellerbuyer','unique') NOT NULL default 'unique',
  `catsorting` enum('alpha','counter') NOT NULL default 'alpha',
  `usersauth` enum('y','n') NOT NULL default 'y',
  `background` tinytext NOT NULL,
  `brepeat` enum('repeat','repeat-x','repeat-y','no-repeat','no') NOT NULL default 'no',
  `descriptiontag` text NOT NULL,
  `keywordstag` text NOT NULL,
  `maxuploadsize` int(11) NOT NULL default '0',
  `contactseller` enum('always','logged','never') NOT NULL default 'always',
  `theme` tinytext,
  `catstoshow` int(11) NOT NULL default '0',
  `sitemap` enum('y','n') NOT NULL default 'y',
  `uniqueseller` int(11) NOT NULL default '0',
  `bn_only` enum('y','n') NOT NULL default 'n',
  `adultonly` enum('y','n') NOT NULL default 'n',
  `winner_address` enum('y','n') NOT NULL default 'n',
  `wanted` enum('y','n') NOT NULL default 'y',
  `boardsmsgs` int(11) NOT NULL default '0'
) ;";

# 
# Dumping data for table `".$DBPrefix."settings`
# 

$query[] = "INSERT INTO `".$DBPrefix."settings` VALUES
('WeBid', '".$siteURL."', 'WEBID', 1, 1, 5, 1, 2, 2, 'GBP', 1, 'By clicking below you agree to the terms of this website.', 'admin@we-link.co.uk', 1, 1, 'logo.gif', 0, 2, 30, 'EUR', 'pay', 2, 0, 2, 0, 0, 0, 2, 0, 0, 'admin@we-link.co.uk', 'An unexpected error occurred. Please report to the administrator at ', 'admin@we-link.co.uk', 2, 2, 1, 5, 100, 2, 1, 2, 'center', 5, 2, 100, 1, 0, 'y', 8, 8, 8, 0, 'y', 'n', 'y', 'y', 'y', 'y', 'n', 'y', 16, 0, 'n', 'y', '2', 2, 1, 0, 'y', 0, 'fix', 0, 'EN', 90, 'perc', 'n', 'n', 'n', 'y', 'n', 'unique', 'unique', 'alpha', 'y', '', 'no', '', '', 51200, 'always', 'default', 20, 'y', 0, 'n', 'n', 'y', 'y', 0);";

/*
$query[] = "INSERT INTO `".$DBPrefix."settings` VALUES
('WeBid', '".$siteURL."', 'WEBID', 1, 1, 5, 1, 2, 2, 'GBP', 1, 'By clicking below you agree to the terms of this website.', 'admin@we-link.co.uk', 1, 1, 'logo.gif', 0, 2, 30, 'EUR', 'pay', 2, 0, 2, 0, 0, 0, 2, 0, 0, 'admin@we-link.co.uk', 'An unexpected error occurred. Please report to the administrator at ', 'admin@we-link.co.uk', 2, 2, 1, 5, 100, 2, 1, 2, 'center', 0, 0, 0, 100, 0, 0, 8, 8, 8, 'y', 'y', 'n', 'y', 'Your About us text goes here', 'y', 'Your Terms and Conditions go here', 'n', 10, 16, 'y', 'n', 'England', 2, 2, 1, 'y', 13, 'fix', 1, 'EN', 90, 'perc', 'n', 'n', 'Taxes', 'n', 'sb', '<B><FONT COLOR=red>No fees will be charged for this auction!!</FONT></B>', 'unique', 'alpha', 'n', '3.gif', '', '', '', 51200, 'logged', 'default', 20, 'n', 0, 'n', 'n', 'y', 'n', 30, 'y');"; */

# ############################

# 
# Table structure for table `".$DBPrefix."statssettings`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."statssettings`;";
$query[] = "CREATE TABLE `".$DBPrefix."statssettings` (
  `activate` enum('y','n') NOT NULL default 'y',
  `accesses` enum('y','n') NOT NULL default 'y',
  `browsers` enum('y','n') NOT NULL default 'y',
  `domains` enum('y','n') NOT NULL default 'y'
) ;";

# 
# Dumping data for table `".$DBPrefix."statssettings`
# 

$query[] = "INSERT INTO `".$DBPrefix."statssettings` VALUES ('n', 'y', 'y', 'y');";

# ############################

# 
# Table structure for table `".$DBPrefix."tmp_closed_edited`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."tmp_closed_edited`;";
$query[] = "CREATE TABLE `".$DBPrefix."tmp_closed_edited` (
  `session` varchar(100) NOT NULL default '',
  `auction` int(32) NOT NULL default '0',
  `editdate` varchar(8) NOT NULL default '',
  `seller` int(32) NOT NULL default '0',
  `fee` enum('homefeatured','catfeatured','bold','highlighted','reserve') NOT NULL default 'homefeatured',
  `amount` double NOT NULL default '0',
  KEY `session` (`session`)
) ;";

# 
# Dumping data for table `".$DBPrefix."tmp_closed_edited`
# 


# ############################

# 
# Table structure for table `".$DBPrefix."users`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."users`;";
$query[] = "CREATE TABLE `".$DBPrefix."users` (
  `id` int(32) NOT NULL auto_increment,
  `nick` varchar(20) default NULL,
  `password` varchar(32) default NULL,
  `name` tinytext,
  `address` tinytext,
  `city` varchar(25) default NULL,
  `prov` varchar(10) default NULL,
  `country` varchar(30) default NULL,
  `zip` varchar(10) default NULL,
  `phone` varchar(40) default NULL,
  `email` varchar(50) default NULL,
  `reg_date` timestamp ,
  `rate_sum` int(11) default NULL,
  `rate_num` int(11) default NULL,
  `birthdate` int(8) default NULL,
  `suspended` int(1) default '0',
  `nletter` int(1) NOT NULL default '0',
  `balance` double NOT NULL default '0',
  `auc_watch` varchar(20) default '',
  `item_watch` text,
  `creditcard` varchar(16) NOT NULL default '',
  `exp_month` char(2) NOT NULL default '',
  `exp_year` char(2) NOT NULL default '',
  `card_owner` varchar(255) NOT NULL default '',
  `card_zip` varchar(15) NOT NULL default '',
  `accounttype` enum('seller','buyer','buyertoseller','unique') NOT NULL default 'unique',
  `endemailmode` enum('one','cum','none') NOT NULL default 'one',
  `startemailmode` enum('yes','no') NOT NULL default 'yes',
  `trusted` enum('y','n') NOT NULL default 'n',
  `lastlogin` datetime NOT NULL default '0000-00-00 00:00:00',
  `payment_details` text NOT NULL,
  PRIMARY KEY  (`id`)
);";

# 
# Dumping data for table `".$DBPrefix."users`
# 

# ############################

# 
# Table structure for table `".$DBPrefix."usersettings`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."usersettings`;";
$query[] = "CREATE TABLE `".$DBPrefix."usersettings` (
  `discount` double NOT NULL default '0',
  `banemail` text NOT NULL,
  `requested_fields` varchar(255) NOT NULL default '',
  `mandatory_fields` varchar(255) NOT NULL default ''
) ;";

# 
# Dumping data for table `".$DBPrefix."usersettings`
# 

$query[] = "INSERT INTO ".$DBPrefix."usersettings VALUES (0, '', 'a:6:{s:9:\"birthdate\";s:1:\"y\";s:7:\"address\";s:1:\"y\";s:4:\"city\";s:1:\"y\";s:4:\"prov\";s:1:\"y\";s:3:\"zip\";s:1:\"y\";s:3:\"tel\";s:1:\"y\";}', 'a:6:{s:9:\"birthdate\";s:1:\"y\";s:7:\"address\";s:1:\"y\";s:4:\"city\";s:1:\"y\";s:4:\"prov\";s:1:\"y\";s:3:\"zip\";s:1:\"y\";s:3:\"tel\";s:1:\"y\";}')";

# ############################

# 
# Table structure for table `".$DBPrefix."usersips`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."usersips`;";
$query[] = "CREATE TABLE `".$DBPrefix."usersips` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(32) default NULL,
  `ip` varchar(15) default NULL,
  `type` enum('first','after') NOT NULL default 'first',
  `action` enum('accept','deny') NOT NULL default 'accept',
  PRIMARY KEY  (`id`)
) ;";

# 
# Dumping data for table `".$DBPrefix."usersips`
# 

# ############################

# 
# Table structure for table `".$DBPrefix."userslanguage`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."userslanguage`;";
$query[] = "CREATE TABLE `".$DBPrefix."userslanguage` (
  `user` int(32) NOT NULL default '0',
  `language` char(2) NOT NULL default ''
) ;";

# 
# Dumping data for table `".$DBPrefix."userslanguage`
# 

$query[] = "INSERT INTO `".$DBPrefix."userslanguage` VALUES (1, 'EN');";

# ############################

# 
# Table structure for table `".$DBPrefix."winners`
# 

$query[] = "DROP TABLE IF EXISTS `".$DBPrefix."winners`;";
$query[] = "CREATE TABLE `".$DBPrefix."winners` (
  `id` int(11) NOT NULL auto_increment,
  `auction` int(32) NOT NULL default '0',
  `seller` int(32) NOT NULL default '0',
  `winner` int(32) NOT NULL default '0',
  `bid` double NOT NULL default '0',
  `closingdate` timestamp ,
  `fee` double NOT NULL default '0',
  KEY `id` (`id`)
) ;";

?>