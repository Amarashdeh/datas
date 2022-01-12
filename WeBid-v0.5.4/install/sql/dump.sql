# 
# Table structure for table `PHPAUCTIONXL_accesseshistoric`
# 

CREATE TABLE `PHPAUCTIONXL_accesseshistoric` (
  `month` char(2) NOT NULL default '',
  `year` char(4) NOT NULL default '',
  `pageviews` int(11) NOT NULL default '0',
  `uniquevisitiors` int(11) NOT NULL default '0',
  `usersessions` int(11) NOT NULL default '0'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_accesseshistoric`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_accounts`
# 

CREATE TABLE `PHPAUCTIONXL_accounts` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(32) NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `operation_date` varchar(8) NOT NULL default '',
  `operation_type` int(1) NOT NULL default '0',
  `operation_amount` double NOT NULL default '0',
  `account_balance` double NOT NULL default '0',
  `auction` varchar(32) NOT NULL default '',
  KEY `id` (`id`)
) AUTO_INCREMENT=1 ;

# 
# Dumping data for table `PHPAUCTIONXL_accounts`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_adminusers`
# 

CREATE TABLE `PHPAUCTIONXL_adminusers` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(32) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `created` varchar(8) NOT NULL default '',
  `lastlogin` varchar(14) NOT NULL default '',
  `status` int(2) NOT NULL default '0',
  KEY `id` (`id`)
) AUTO_INCREMENT=1 ;

# 
# Dumping data for table `PHPAUCTIONXL_adminusers`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_altpayments`
# 

CREATE TABLE `PHPAUCTIONXL_altpayments` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=4 ;

# 
# Dumping data for table `PHPAUCTIONXL_altpayments`
# 

INSERT INTO `PHPAUCTIONXL_altpayments` VALUES (2, 'Bank Transfer', 'Test Bank\r<BR>123 Worthwood Road\r<BR>Miami USA');
INSERT INTO `PHPAUCTIONXL_altpayments` VALUES (3, 'Money Order', 'TEst text for\r\nMoney order');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_auccounter`
# 

CREATE TABLE `PHPAUCTIONXL_auccounter` (
  `auction_id` int(11) NOT NULL default '0',
  `counter` int(11) NOT NULL default '0',
  PRIMARY KEY  (`auction_id`)
) ;

# 
# Dumping data for table `PHPAUCTIONXL_auccounter`
# 

# ############################

# 
# Table structure for table `PHPAUCTIONXL_auctionextension`
# 

CREATE TABLE `PHPAUCTIONXL_auctionextension` (
  `status` enum('enabled','disabled') NOT NULL default 'enabled',
  `timebefore` int(11) NOT NULL default '0',
  `extend` int(11) NOT NULL default '0'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_auctionextension`
# 

INSERT INTO `PHPAUCTIONXL_auctionextension` VALUES ('disabled', 120, 300);

# ############################

# 
# Table structure for table `PHPAUCTIONXL_auctions`
# 

CREATE TABLE `PHPAUCTIONXL_auctions` (
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
  `location` varchar(30) default NULL,
  `location_zip` varchar(10) default NULL,
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
) AUTO_INCREMENT=1 ;

# 
# Dumping data for table `PHPAUCTIONXL_auctions`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_banners`
# 

CREATE TABLE `PHPAUCTIONXL_banners` (
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
) AUTO_INCREMENT=1 ;

# 
# Dumping data for table `PHPAUCTIONXL_banners`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_bannerscategories`
# 

CREATE TABLE `PHPAUCTIONXL_bannerscategories` (
  `banner` int(11) NOT NULL default '0',
  `category` int(11) NOT NULL default '0'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_bannerscategories`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_bannerskeywords`
# 

CREATE TABLE `PHPAUCTIONXL_bannerskeywords` (
  `banner` int(11) NOT NULL default '0',
  `keyword` varchar(255) NOT NULL default ''
) ;

# 
# Dumping data for table `PHPAUCTIONXL_bannerskeywords`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_bannerssettings`
# 

CREATE TABLE `PHPAUCTIONXL_bannerssettings` (
  `id` int(11) NOT NULL auto_increment,
  `sizetype` enum('fix','any') default NULL,
  `width` int(11) default NULL,
  `height` int(11) default NULL,
  KEY `id` (`id`)
) AUTO_INCREMENT=2 ;

# 
# Dumping data for table `PHPAUCTIONXL_bannerssettings`
# 

INSERT INTO `PHPAUCTIONXL_bannerssettings` VALUES (1, 'any', 468, 60);

# ############################

# 
# Table structure for table `PHPAUCTIONXL_bannersstats`
# 

CREATE TABLE `PHPAUCTIONXL_bannersstats` (
  `banner` int(11) default NULL,
  `purchased` int(11) default NULL,
  `views` int(11) default NULL,
  `clicks` int(11) default NULL,
  KEY `id` (`banner`)
) ;

# 
# Dumping data for table `PHPAUCTIONXL_bannersstats`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_bannersusers`
# 

CREATE TABLE `PHPAUCTIONXL_bannersusers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `company` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  KEY `id` (`id`)
) AUTO_INCREMENT=1 ;

# 
# Dumping data for table `PHPAUCTIONXL_bannersusers`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_bidfind`
# 

CREATE TABLE `PHPAUCTIONXL_bidfind` (
  `bidfind` enum('enabled','disabled') NOT NULL default 'enabled'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_bidfind`
# 

INSERT INTO `PHPAUCTIONXL_bidfind` VALUES ('disabled');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_bids`
# 

CREATE TABLE `PHPAUCTIONXL_bids` (
  `id` int(11) NOT NULL auto_increment,
  `auction` int(32) default NULL,
  `bidder` int(32) default NULL,
  `bid` double(16,4) default NULL,
  `bidwhen` varchar(14) default NULL,
  `quantity` int(11) default '0',
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=1 ;

# 
# Dumping data for table `PHPAUCTIONXL_bids`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_browsers`
# 

CREATE TABLE `PHPAUCTIONXL_browsers` (
  `month` char(2) NOT NULL default '',
  `year` varchar(4) NOT NULL default '',
  `browser` varchar(50) NOT NULL default '0',
  `counter` int(11) NOT NULL default '0'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_browsers`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_categories`
# 

CREATE TABLE `PHPAUCTIONXL_categories` (
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
) AUTO_INCREMENT=212 ;

# 
# Dumping data for table `PHPAUCTIONXL_categories`
# 

INSERT INTO `PHPAUCTIONXL_categories` VALUES (1, 0, 'Art &amp; Antiques', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (2, 1, 'Ancient World', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (3, 1, 'Amateur Art', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (4, 1, 'Ceramics &amp; Glass', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (5, 4, 'Glass', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (6, 5, '40s, 50s &amp; 60s', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (7, 5, 'Art Glass', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (8, 5, 'Carnival', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (9, 5, 'Contemporary Glass', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (10, 5, 'Porcelain', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (11, 5, 'Chalkware', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (12, 5, 'Chintz &amp; Shelley', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (13, 5, 'Decorative', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (14, 1, 'Fine Art', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (15, 1, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (16, 1, 'Painting', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (17, 1, 'Photographic Images', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (18, 1, 'Prints', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (19, 1, 'Books &amp; Manuscripts', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (20, 1, 'Cameras', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (21, 1, 'Musical Instruments', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (22, 1, 'Orientalia', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (23, 1, 'Post-1900', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (24, 1, 'Pre-1900', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (25, 1, 'Scientific Instruments', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (26, 1, 'Silver &amp; Silver Plate', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (27, 1, 'Textiles &amp; Linens', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (28, 0, 'Books', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (29, 28, 'Arts, Architecture &amp; Photography', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (30, 28, 'Audiobooks', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (31, 28, 'Biographies &amp; Memoirs', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (32, 28, 'Business &amp; Investing', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (34, 28, 'Computers &amp; Internet', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (35, 28, 'Cooking, Food &amp; Wine', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (36, 28, 'Entertainment', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (37, 28, 'Foreign Language Instruction', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (38, 28, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (39, 28, 'Health, Mind &amp; Body', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (40, 28, 'History', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (41, 28, 'Home &amp; Garden', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (42, 28, 'Horror', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (43, 28, 'Literature &amp; Fiction', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (44, 28, 'Animals', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (45, 28, 'Catalogs', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (46, 28, 'Children', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (47, 28, 'Illustrated', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (48, 28, 'Men', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (49, 28, 'News', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (51, 28, 'Sports', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (52, 28, 'Women', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (53, 28, 'Mystery &amp; Thrillers', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (54, 28, 'Nonfiction', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (55, 28, 'Parenting &amp; Families', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (56, 28, 'Poetry', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (57, 28, 'Rare', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (58, 28, 'Reference', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (59, 28, 'Religion &amp; Spirituality', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (60, 28, 'Contemporary', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (61, 28, 'Historical', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (62, 28, 'Regency', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (63, 28, 'Science &amp; Nature', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (64, 28, 'Science Fiction &amp; Fantasy', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (65, 28, 'Sports &amp; Outdoors', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (66, 28, 'Teens', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (67, 28, 'Textbooks', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (68, 28, 'Travel', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (69, 0, 'Clothing &amp; Accessories', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (70, 69, 'Accessories', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (71, 69, 'Clothing', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (72, 69, 'Watches', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (73, 0, 'Coins &amp; Stamps', 0, 1, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (74, 73, 'Coins', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (75, 73, 'Philately', 0, 1, 1, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (76, 0, 'Collectibles', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (77, 76, 'Advertising', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (78, 76, 'Animals', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (79, 76, 'Animation', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (80, 76, 'Antique Reproductions', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (81, 76, 'Autographs', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (82, 76, 'Barber Shop', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (83, 76, 'Bears', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (84, 76, 'Bells', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (85, 76, 'Bottles &amp; Cans', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (86, 76, 'Breweriana', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (87, 76, 'Cars &amp; Motorcycles', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (88, 76, 'Cereal Boxes &amp; Premiums', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (89, 76, 'Character', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (90, 76, 'Circus &amp; Carnival', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (91, 76, 'Collector Plates', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (92, 76, 'Dolls', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (93, 76, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (94, 76, 'Historical &amp; Cultural', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (95, 76, 'Holiday &amp; Seasonal', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (96, 76, 'Household Items', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (97, 76, 'Kitsch', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (98, 76, 'Knives &amp; Swords', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (99, 76, 'Lunchboxes', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (100, 76, 'Magic &amp; Novelty Items', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (101, 76, 'Memorabilia', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (102, 76, 'Militaria', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (103, 76, 'Music Boxes', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (104, 76, 'Oddities', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (105, 76, 'Paper', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (106, 76, 'Pinbacks', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (107, 76, 'Porcelain Figurines', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (108, 76, 'Railroadiana', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (109, 76, 'Religious', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (110, 76, 'Rocks, Minerals &amp; Fossils', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (111, 76, 'Scientific Instruments', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (112, 76, 'Textiles', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (113, 76, 'Tobacciana', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (114, 0, 'Comics, Cards &amp; Science Fiction', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (115, 114, 'Anime &amp; Manga', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (116, 114, 'Comic Books', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (117, 114, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (118, 114, 'Godzilla', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (119, 114, 'Star Trek', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (120, 114, 'The X-Files', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (121, 114, 'Toys', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (122, 114, 'Trading Cards', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (123, 0, 'Computers &amp; Software', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (124, 123, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (125, 123, 'Hardware', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (126, 123, 'Internet Services', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (127, 123, 'Software', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (128, 0, 'Electronics &amp; Photography', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (129, 128, 'Consumer Electronics', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (130, 128, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (131, 128, 'Photo Equipment', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (132, 128, 'Recording Equipment', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (133, 128, 'Video Equipment', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (134, 0, 'Gemstones &amp; Jewelry', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (135, 134, 'Ancient', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (136, 134, 'Beaded Jewelry', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (137, 134, 'Beads', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (138, 134, 'Carved &amp; Cameo', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (139, 134, 'Contemporary', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (140, 134, 'Costume', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (141, 134, 'Fine', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (142, 134, 'Gemstones', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (143, 134, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (144, 134, 'Gold', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (145, 134, 'Necklaces', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (146, 134, 'Silver', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (147, 134, 'Victorian', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (148, 134, 'Vintage', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (149, 0, 'Home &amp; Garden', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (150, 149, 'Baby Items', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (151, 149, 'Crafts', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (152, 149, 'Furniture', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (153, 149, 'Garden', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (154, 149, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (155, 149, 'Household Items', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (156, 149, 'Pet Supplies', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (157, 149, 'Tools &amp; Hardware', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (158, 149, 'Weddings', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (159, 0, 'Movies &amp; Video', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (160, 159, 'DVD', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (161, 159, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (162, 159, 'Laser Discs', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (163, 159, 'VHS', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (164, 0, 'Music', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (165, 164, 'CDs', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (166, 164, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (167, 164, 'Instruments', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (168, 164, 'Memorabilia', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (169, 164, 'Records', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (170, 164, 'Tapes', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (171, 0, 'Office &amp; Business', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (172, 171, 'Briefcases', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (173, 171, 'Fax Machines', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (174, 171, 'General Equipment', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (175, 171, 'Pagers', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (176, 0, 'Other Goods &amp; Services', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (177, 176, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (178, 176, 'Metaphysical', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (179, 176, 'Property', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (180, 176, 'Services', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (181, 176, 'Tickets &amp; Events', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (182, 176, 'Transportation', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (183, 176, 'Travel', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (184, 0, 'Sports &amp; Recreation', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (185, 184, 'Apparel &amp; Equipment', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (186, 184, 'Exercise Equipment', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (187, 184, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (188, 0, 'Toys &amp; Games', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (189, 188, 'Action Figures', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (190, 188, 'Beanie Babies &amp; Beanbag Toys', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (191, 188, 'Diecast', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (192, 188, 'Fast Food', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (193, 188, 'Fisher-Price', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (194, 188, 'Furby', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (195, 188, 'Games', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (196, 188, 'General', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (197, 188, 'Giga Pet &amp; Tamagotchi', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (198, 188, 'Hobbies', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (199, 188, 'Marbles', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (200, 188, 'My Little Pony', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (201, 188, 'Peanuts Gang', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (202, 188, 'Pez', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (203, 188, 'Plastic Models', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (204, 188, 'Plush Toys', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (205, 188, 'Puzzles', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (206, 188, 'Slot Cars', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (207, 188, 'Teletubbies', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (208, 188, 'Toy Soldiers', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (209, 188, 'Vintage Tin', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (210, 188, 'Vintage Vehicles', 0, 0, 0, '', '', 'n');
INSERT INTO `PHPAUCTIONXL_categories` VALUES (211, 188, 'Vintage', 0, 0, 0, '', '', 'n');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_categories_plain`
# 

CREATE TABLE `PHPAUCTIONXL_categories_plain` (
  `id` int(11) NOT NULL auto_increment,
  `cat_id` int(11) default NULL,
  `cat_name` tinytext,
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=67737 ;

# 
# Dumping data for table `PHPAUCTIONXL_categories_plain`
# 

INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67528, 1, 'Art &amp; Antiques');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67529, 3, '&nbsp; &nbsp;Amateur Art');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67530, 2, '&nbsp; &nbsp;Ancient World');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67531, 19, '&nbsp; &nbsp;Books &amp; Manuscripts');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67532, 20, '&nbsp; &nbsp;Cameras');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67533, 4, '&nbsp; &nbsp;Ceramics &amp; Glass');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67534, 5, '&nbsp; &nbsp;&nbsp; &nbsp;Glass');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67535, 6, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;40s, 50s &amp; 60s');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67536, 7, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Art Glass');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67537, 8, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Carnival');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67538, 11, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Chalkware');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67539, 12, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Chintz &amp; Shelley');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67540, 9, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Contemporary Glass');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67541, 13, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Decorative');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67542, 10, '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Porcelain');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67543, 14, '&nbsp; &nbsp;Fine Art');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67544, 15, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67545, 21, '&nbsp; &nbsp;Musical Instruments');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67546, 22, '&nbsp; &nbsp;Orientalia');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67547, 16, '&nbsp; &nbsp;Painting');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67548, 17, '&nbsp; &nbsp;Photographic Images');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67549, 23, '&nbsp; &nbsp;Post-1900');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67550, 24, '&nbsp; &nbsp;Pre-1900');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67551, 18, '&nbsp; &nbsp;Prints');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67552, 25, '&nbsp; &nbsp;Scientific Instruments');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67553, 26, '&nbsp; &nbsp;Silver &amp; Silver Plate');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67554, 27, '&nbsp; &nbsp;Textiles &amp; Linens');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67555, 28, 'Books');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67556, 44, '&nbsp; &nbsp;Animals');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67557, 29, '&nbsp; &nbsp;Arts, Architecture &amp; Photography');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67558, 30, '&nbsp; &nbsp;Audiobooks');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67559, 31, '&nbsp; &nbsp;Biographies &amp; Memoirs');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67560, 32, '&nbsp; &nbsp;Business &amp; Investing');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67561, 45, '&nbsp; &nbsp;Catalogs');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67562, 46, '&nbsp; &nbsp;Children');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67563, 34, '&nbsp; &nbsp;Computers &amp; Internet');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67564, 60, '&nbsp; &nbsp;Contemporary');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67565, 35, '&nbsp; &nbsp;Cooking, Food &amp; Wine');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67566, 36, '&nbsp; &nbsp;Entertainment');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67567, 37, '&nbsp; &nbsp;Foreign Language Instruction');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67568, 38, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67569, 39, '&nbsp; &nbsp;Health, Mind &amp; Body');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67570, 61, '&nbsp; &nbsp;Historical');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67571, 40, '&nbsp; &nbsp;History');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67572, 41, '&nbsp; &nbsp;Home &amp; Garden');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67573, 42, '&nbsp; &nbsp;Horror');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67574, 47, '&nbsp; &nbsp;Illustrated');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67575, 43, '&nbsp; &nbsp;Literature &amp; Fiction');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67576, 48, '&nbsp; &nbsp;Men');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67577, 53, '&nbsp; &nbsp;Mystery &amp; Thrillers');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67578, 49, '&nbsp; &nbsp;News');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67579, 54, '&nbsp; &nbsp;Nonfiction');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67580, 55, '&nbsp; &nbsp;Parenting &amp; Families');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67581, 56, '&nbsp; &nbsp;Poetry');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67582, 57, '&nbsp; &nbsp;Rare');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67583, 58, '&nbsp; &nbsp;Reference');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67584, 62, '&nbsp; &nbsp;Regency');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67585, 59, '&nbsp; &nbsp;Religion &amp; Spirituality');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67586, 63, '&nbsp; &nbsp;Science &amp; Nature');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67587, 64, '&nbsp; &nbsp;Science Fiction &amp; Fantasy');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67588, 51, '&nbsp; &nbsp;Sports');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67589, 65, '&nbsp; &nbsp;Sports &amp; Outdoors');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67590, 66, '&nbsp; &nbsp;Teens');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67591, 67, '&nbsp; &nbsp;Textbooks');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67592, 68, '&nbsp; &nbsp;Travel');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67593, 52, '&nbsp; &nbsp;Women');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67594, 69, 'Clothing &amp; Accessories');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67595, 70, '&nbsp; &nbsp;Accessories');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67596, 71, '&nbsp; &nbsp;Clothing');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67597, 72, '&nbsp; &nbsp;Watches');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67598, 73, 'Coins &amp; Stamps');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67599, 74, '&nbsp; &nbsp;Coins');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67600, 75, '&nbsp; &nbsp;Philately');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67601, 76, 'Collectibles');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67602, 77, '&nbsp; &nbsp;Advertising');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67603, 78, '&nbsp; &nbsp;Animals');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67604, 79, '&nbsp; &nbsp;Animation');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67605, 80, '&nbsp; &nbsp;Antique Reproductions');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67606, 81, '&nbsp; &nbsp;Autographs');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67607, 82, '&nbsp; &nbsp;Barber Shop');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67608, 83, '&nbsp; &nbsp;Bears');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67609, 84, '&nbsp; &nbsp;Bells');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67610, 85, '&nbsp; &nbsp;Bottles &amp; Cans');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67611, 86, '&nbsp; &nbsp;Breweriana');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67612, 87, '&nbsp; &nbsp;Cars &amp; Motorcycles');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67613, 88, '&nbsp; &nbsp;Cereal Boxes &amp; Premiums');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67614, 89, '&nbsp; &nbsp;Character');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67615, 90, '&nbsp; &nbsp;Circus &amp; Carnival');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67616, 91, '&nbsp; &nbsp;Collector Plates');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67617, 92, '&nbsp; &nbsp;Dolls');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67618, 93, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67619, 94, '&nbsp; &nbsp;Historical &amp; Cultural');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67620, 95, '&nbsp; &nbsp;Holiday &amp; Seasonal');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67621, 96, '&nbsp; &nbsp;Household Items');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67622, 97, '&nbsp; &nbsp;Kitsch');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67623, 98, '&nbsp; &nbsp;Knives &amp; Swords');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67624, 99, '&nbsp; &nbsp;Lunchboxes');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67625, 100, '&nbsp; &nbsp;Magic &amp; Novelty Items');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67626, 101, '&nbsp; &nbsp;Memorabilia');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67627, 102, '&nbsp; &nbsp;Militaria');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67628, 103, '&nbsp; &nbsp;Music Boxes');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67629, 104, '&nbsp; &nbsp;Oddities');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67630, 105, '&nbsp; &nbsp;Paper');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67631, 106, '&nbsp; &nbsp;Pinbacks');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67632, 107, '&nbsp; &nbsp;Porcelain Figurines');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67633, 108, '&nbsp; &nbsp;Railroadiana');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67634, 109, '&nbsp; &nbsp;Religious');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67635, 110, '&nbsp; &nbsp;Rocks, Minerals &amp; Fossils');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67636, 111, '&nbsp; &nbsp;Scientific Instruments');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67637, 112, '&nbsp; &nbsp;Textiles');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67638, 113, '&nbsp; &nbsp;Tobacciana');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67639, 114, 'Comics, Cards &amp; Science Fiction');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67640, 115, '&nbsp; &nbsp;Anime &amp; Manga');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67641, 116, '&nbsp; &nbsp;Comic Books');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67642, 117, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67643, 118, '&nbsp; &nbsp;Godzilla');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67644, 119, '&nbsp; &nbsp;Star Trek');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67645, 120, '&nbsp; &nbsp;The X-Files');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67646, 121, '&nbsp; &nbsp;Toys');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67647, 122, '&nbsp; &nbsp;Trading Cards');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67648, 123, 'Computers &amp; Software');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67649, 124, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67650, 125, '&nbsp; &nbsp;Hardware');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67651, 126, '&nbsp; &nbsp;Internet Services');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67652, 127, '&nbsp; &nbsp;Software');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67653, 128, 'Electronics &amp; Photography');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67654, 129, '&nbsp; &nbsp;Consumer Electronics');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67655, 130, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67656, 131, '&nbsp; &nbsp;Photo Equipment');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67657, 132, '&nbsp; &nbsp;Recording Equipment');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67658, 133, '&nbsp; &nbsp;Video Equipment');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67659, 134, 'Gemstones &amp; Jewelry');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67660, 135, '&nbsp; &nbsp;Ancient');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67661, 136, '&nbsp; &nbsp;Beaded Jewelry');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67662, 137, '&nbsp; &nbsp;Beads');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67663, 138, '&nbsp; &nbsp;Carved &amp; Cameo');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67664, 139, '&nbsp; &nbsp;Contemporary');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67665, 140, '&nbsp; &nbsp;Costume');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67666, 141, '&nbsp; &nbsp;Fine');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67667, 142, '&nbsp; &nbsp;Gemstones');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67668, 143, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67669, 144, '&nbsp; &nbsp;Gold');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67670, 145, '&nbsp; &nbsp;Necklaces');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67671, 146, '&nbsp; &nbsp;Silver');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67672, 147, '&nbsp; &nbsp;Victorian');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67673, 148, '&nbsp; &nbsp;Vintage');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67674, 149, 'Home &amp; Garden');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67675, 150, '&nbsp; &nbsp;Baby Items');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67676, 151, '&nbsp; &nbsp;Crafts');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67677, 152, '&nbsp; &nbsp;Furniture');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67678, 153, '&nbsp; &nbsp;Garden');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67679, 154, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67680, 155, '&nbsp; &nbsp;Household Items');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67681, 156, '&nbsp; &nbsp;Pet Supplies');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67682, 157, '&nbsp; &nbsp;Tools &amp; Hardware');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67683, 158, '&nbsp; &nbsp;Weddings');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67684, 159, 'Movies &amp; Video');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67685, 160, '&nbsp; &nbsp;DVD');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67686, 161, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67687, 162, '&nbsp; &nbsp;Laser Discs');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67688, 163, '&nbsp; &nbsp;VHS');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67689, 164, 'Music');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67690, 165, '&nbsp; &nbsp;CDs');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67691, 166, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67692, 167, '&nbsp; &nbsp;Instruments');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67693, 168, '&nbsp; &nbsp;Memorabilia');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67694, 169, '&nbsp; &nbsp;Records');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67695, 170, '&nbsp; &nbsp;Tapes');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67696, 171, 'Office &amp; Business');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67697, 172, '&nbsp; &nbsp;Briefcases');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67698, 173, '&nbsp; &nbsp;Fax Machines');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67699, 174, '&nbsp; &nbsp;General Equipment');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67700, 175, '&nbsp; &nbsp;Pagers');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67701, 176, 'Other Goods &amp; Services');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67702, 177, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67703, 178, '&nbsp; &nbsp;Metaphysical');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67704, 179, '&nbsp; &nbsp;Property');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67705, 180, '&nbsp; &nbsp;Services');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67706, 181, '&nbsp; &nbsp;Tickets &amp; Events');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67707, 182, '&nbsp; &nbsp;Transportation');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67708, 183, '&nbsp; &nbsp;Travel');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67709, 184, 'Sports &amp; Recreation');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67710, 185, '&nbsp; &nbsp;Apparel &amp; Equipment');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67711, 186, '&nbsp; &nbsp;Exercise Equipment');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67712, 187, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67713, 188, 'Toys &amp; Games');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67714, 189, '&nbsp; &nbsp;Action Figures');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67715, 190, '&nbsp; &nbsp;Beanie Babies &amp; Beanbag Toys');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67716, 191, '&nbsp; &nbsp;Diecast');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67717, 192, '&nbsp; &nbsp;Fast Food');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67718, 193, '&nbsp; &nbsp;Fisher-Price');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67719, 194, '&nbsp; &nbsp;Furby');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67720, 195, '&nbsp; &nbsp;Games');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67721, 196, '&nbsp; &nbsp;General');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67722, 197, '&nbsp; &nbsp;Giga Pet &amp; Tamagotchi');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67723, 198, '&nbsp; &nbsp;Hobbies');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67724, 199, '&nbsp; &nbsp;Marbles');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67725, 200, '&nbsp; &nbsp;My Little Pony');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67726, 201, '&nbsp; &nbsp;Peanuts Gang');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67727, 202, '&nbsp; &nbsp;Pez');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67728, 203, '&nbsp; &nbsp;Plastic Models');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67729, 204, '&nbsp; &nbsp;Plush Toys');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67730, 205, '&nbsp; &nbsp;Puzzles');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67731, 206, '&nbsp; &nbsp;Slot Cars');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67732, 207, '&nbsp; &nbsp;Teletubbies');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67733, 208, '&nbsp; &nbsp;Toy Soldiers');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67734, 211, '&nbsp; &nbsp;Vintage');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67735, 209, '&nbsp; &nbsp;Vintage Tin');
INSERT INTO `PHPAUCTIONXL_categories_plain` VALUES (67736, 210, '&nbsp; &nbsp;Vintage Vehicles');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_cats_translated`
# 

CREATE TABLE `PHPAUCTIONXL_cats_translated` (
  `cat_id` int(11) NOT NULL default '0',
  `lang` char(2) NOT NULL default '',
  `cat_name` varchar(255) NOT NULL default ''
) ;

# 
# Dumping data for table `PHPAUCTIONXL_cats_translated`
# 

INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (1, 'EN', 'Art & Antiques');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (1, 'ES', 'Arte y Antigüedades');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (2, 'EN', 'Ancient World');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (2, 'ES', 'Mundo Antiguo');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (3, 'EN', 'Amateur Art');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (3, 'ES', 'Arte Amateur');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (4, 'EN', 'Ceramics & Glass');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (4, 'ES', 'Cerámica & Cristal');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (5, 'EN', 'Glass');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (5, 'ES', 'Cristal');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (6, 'EN', '40s, 50s & 60s');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (6, 'ES', '40s, 50s & 60s');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (7, 'EN', 'Art Glass');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (7, 'ES', 'Piezas en cristal');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (8, 'EN', 'Carnival');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (8, 'ES', 'Carnaval');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (9, 'EN', 'Contemporary Glass');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (9, 'ES', 'Contemporaneo');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (10, 'EN', 'Porcelain');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (10, 'ES', 'Porcelana');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (11, 'EN', 'Chalkware');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (11, 'ES', 'Vajilla');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (12, 'EN', 'Chintz & Shelley');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (12, 'ES', 'Chintz & Shelley');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (13, 'EN', 'Decorative');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (13, 'ES', 'Decorativo');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (14, 'EN', 'Fine Art');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (14, 'ES', 'Arte');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (15, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (15, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (16, 'EN', 'Painting');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (16, 'ES', 'Pintura');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (17, 'EN', 'Photographic Images');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (17, 'ES', 'Fotografí­a');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (18, 'EN', 'Prints');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (18, 'ES', 'Impresos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (19, 'EN', 'Books & Manuscripts');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (19, 'ES', 'Libros y Manuscritos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (20, 'EN', 'Cameras');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (20, 'ES', 'Cámaras');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (21, 'EN', 'Musical Instruments');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (21, 'ES', 'Instrumentos Musicales');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (22, 'EN', 'Orientalia');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (22, 'ES', 'Arte Oriental');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (23, 'EN', 'Post-1900');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (23, 'ES', 'Posterior 1900');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (24, 'EN', 'Pre-1900');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (24, 'ES', 'Anterior 1900');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (25, 'EN', 'Scientific Instruments');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (25, 'ES', 'Instrumentos cientí­ficos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (26, 'EN', 'Silver & Silver Plate');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (26, 'ES', 'Plata & Cuebrterí­a');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (27, 'EN', 'Textiles & Linens');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (27, 'ES', 'Tejidos & Telas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (28, 'EN', 'Books');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (28, 'ES', 'Libros');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (29, 'EN', 'Arts, Architecture & Photography');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (29, 'ES', 'Arte, Arquitectura y Fotografí­a');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (30, 'EN', 'Audiobooks');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (30, 'ES', 'Audio Libros');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (31, 'EN', 'Biographies & Memoirs');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (31, 'ES', 'Biografí­as & Memorias');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (32, 'EN', 'Business & Investing');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (32, 'ES', 'Negocios & Inversiones');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (33, 'ES', 'Libros para niÃ±os');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (34, 'EN', 'Computers & Internet');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (34, 'ES', 'Ordenadores & Internet');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (35, 'EN', 'Cooking, Food & Wine');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (35, 'ES', 'Cocina, Comida y Vinos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (36, 'EN', 'Entertainment');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (36, 'ES', 'Ocio');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (37, 'EN', 'Foreign Language Instruction');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (37, 'ES', 'Eseñanza Idiomas Extranjeros');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (38, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (38, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (39, 'EN', 'Health, Mind & Body');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (39, 'ES', 'Salud, Mente y Cuerpo');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (40, 'EN', 'History');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (40, 'ES', 'Historia');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (41, 'EN', 'Home & Garden');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (41, 'ES', 'Hogar y Jardin');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (42, 'EN', 'Horror');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (42, 'ES', 'Horror');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (43, 'EN', 'Literature & Fiction');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (43, 'ES', 'Literatura Ficción');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (44, 'EN', 'Animals');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (44, 'ES', 'Animales');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (45, 'EN', 'Catalogs');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (45, 'ES', 'Catálogos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (46, 'EN', 'Children');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (46, 'ES', 'Niños');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (47, 'EN', 'Illustrated');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (47, 'ES', 'Ilustrados');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (48, 'EN', 'Men');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (48, 'ES', 'Hombres');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (49, 'EN', 'News');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (49, 'ES', 'Novedades');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (51, 'EN', 'Sports');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (51, 'ES', 'Deportes');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (52, 'EN', 'Women');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (52, 'ES', 'Mujeres');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (53, 'EN', 'Mystery & Thrillers');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (53, 'ES', 'Misterio & Thrillers');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (54, 'EN', 'Nonfiction');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (54, 'ES', 'No Ficción');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (55, 'EN', 'Parenting & Families');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (55, 'ES', 'Educación & Familia');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (56, 'EN', 'Poetry');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (56, 'ES', 'Poesí­a');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (57, 'EN', 'Rare');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (57, 'ES', 'Raros');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (58, 'EN', 'Reference');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (58, 'ES', 'Referencia');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (59, 'EN', 'Religion & Spirituality');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (59, 'ES', 'Religión & Espiritualidad');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (60, 'EN', 'Contemporary');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (60, 'ES', 'Contemporaneos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (61, 'EN', 'Historical');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (61, 'ES', 'Históricos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (62, 'EN', 'Regency');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (62, 'ES', 'Realeza');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (63, 'EN', 'Science & Nature');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (63, 'ES', 'Ciencia & Naturaleza');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (64, 'EN', 'Science Fiction & Fantasy');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (64, 'ES', 'Ciencia Ficción & FantasÃ­a');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (65, 'EN', 'Sports & Outdoors');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (65, 'ES', 'Deportes & Exterior');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (66, 'EN', 'Teens');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (66, 'ES', 'Adolescente');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (67, 'EN', 'Textbooks');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (67, 'ES', 'Libros de texto');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (68, 'EN', 'Travel');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (68, 'ES', 'Viajes');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (69, 'EN', 'Clothing & Accessories');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (69, 'ES', 'Ropa y Complementos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (70, 'EN', 'Accessories');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (70, 'ES', 'Accessorios');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (71, 'EN', 'Clothing');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (71, 'ES', 'Ropa');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (72, 'EN', 'Watches');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (72, 'ES', 'Relojes');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (73, 'EN', 'Coins & Stamps');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (73, 'ES', 'Monedas y Sellos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (74, 'EN', 'Coins');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (74, 'ES', 'Monedas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (75, 'EN', 'Philately');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (75, 'ES', 'Filatelí­a');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (76, 'EN', 'Collectibles');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (76, 'ES', 'Coleccionables');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (77, 'EN', 'Advertising');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (77, 'ES', 'Publicidad');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (78, 'EN', 'Animals');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (78, 'ES', 'Animales');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (79, 'EN', 'Animation');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (79, 'ES', 'Animación');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (80, 'EN', 'Antique Reproductions');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (80, 'ES', 'Reproducciones Antigueas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (81, 'EN', 'Autographs');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (81, 'ES', 'Autografos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (82, 'EN', 'Barber Shop');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (82, 'ES', 'Barberí­a');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (83, 'EN', 'Bears');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (83, 'ES', 'Osos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (84, 'EN', 'Bells');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (84, 'ES', 'Campanas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (85, 'EN', 'Bottles & Cans');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (85, 'ES', 'Botellas & Latas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (86, 'EN', 'Breweriana');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (86, 'ES', 'Cerveza');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (87, 'EN', 'Cars & Motorcycles');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (87, 'ES', 'Automóviles & Motocicletas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (88, 'EN', 'Cereal Boxes & Premiums');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (88, 'ES', 'Cajas de cereal & Premios');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (89, 'EN', 'Character');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (89, 'ES', 'Personajes');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (90, 'EN', 'Circus & Carnival');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (90, 'ES', 'Circo & Carnaval');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (91, 'EN', 'Collector Plates');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (91, 'ES', 'Platos de collecioón');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (92, 'EN', 'Dolls');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (92, 'ES', 'Muñecas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (93, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (93, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (94, 'EN', 'Historical & Cultural');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (94, 'ES', 'HistÃ³rico & Cultural');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (95, 'EN', 'Holiday & Seasonal');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (95, 'ES', 'Vacaciones & Fiestas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (96, 'EN', 'Household Items');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (96, 'ES', 'Utensilios de casa');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (97, 'EN', 'Kitsch');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (97, 'ES', 'Kitsch');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (98, 'EN', 'Knives & Swords');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (98, 'ES', 'Espadas & Navajas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (99, 'EN', 'Lunchboxes');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (99, 'ES', 'Cajas de Lunch');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (100, 'EN', 'Magic & Novelty Items');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (100, 'ES', 'Magia & Nobleza');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (101, 'EN', 'Memorabilia');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (101, 'ES', 'Memorabilia');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (102, 'EN', 'Militaria');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (102, 'ES', 'Militar');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (103, 'EN', 'Music Boxes');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (103, 'ES', 'Cajas de Música');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (104, 'EN', 'Oddities');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (104, 'ES', 'Rarezas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (105, 'EN', 'Paper');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (105, 'ES', 'Papel');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (106, 'EN', 'Pinbacks');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (106, 'ES', 'Pins');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (107, 'EN', 'Porcelain Figurines');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (107, 'ES', 'Figuras de porcelana');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (108, 'EN', 'Railroadiana');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (108, 'ES', 'Tren');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (109, 'EN', 'Religious');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (109, 'ES', 'Religioso');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (110, 'EN', 'Rocks, Minerals & Fossils');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (110, 'ES', 'Rocas, Minerales & Fósiles');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (111, 'EN', 'Scientific Instruments');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (111, 'ES', 'Instrumentos Cientí­ficos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (112, 'EN', 'Textiles');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (112, 'ES', 'Textiles');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (113, 'EN', 'Tobacciana');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (113, 'ES', 'Tabaco');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (114, 'EN', 'Comics, Cards & Science Fiction');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (114, 'ES', 'Comics, Cromos & Ciencia Ficción');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (115, 'EN', 'Anime & Manga');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (115, 'ES', 'Animación & Manga');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (116, 'EN', 'Comic Books');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (116, 'ES', 'Libros de Comics');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (117, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (117, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (118, 'EN', 'Godzilla');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (118, 'ES', 'Godzilla');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (119, 'EN', 'Star Trek');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (119, 'ES', 'Star Trek');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (120, 'EN', 'The X-Files');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (120, 'ES', 'Expediente X');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (121, 'EN', 'Toys');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (121, 'ES', 'Juguetes');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (122, 'EN', 'Trading Cards');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (122, 'ES', 'Cromos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (123, 'EN', 'Computers & Software');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (123, 'ES', 'Ordenadores & Software');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (124, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (124, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (125, 'EN', 'Hardware');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (125, 'ES', 'Hardware');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (126, 'EN', 'Internet Services');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (126, 'ES', 'Internet');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (127, 'EN', 'Software');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (127, 'ES', 'Software');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (128, 'EN', 'Electronics & Photography');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (128, 'ES', 'Electrónica y Fotografí­a');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (129, 'EN', 'Consumer Electronics');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (129, 'ES', 'Consumibles Electrónicos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (130, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (130, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (131, 'EN', 'Photo Equipment');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (131, 'ES', 'Equipos Fotográfico');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (132, 'EN', 'Recording Equipment');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (132, 'ES', 'Equipos de Grabación');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (133, 'EN', 'Video Equipment');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (133, 'ES', 'Equipos Video');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (134, 'EN', 'Gemstones & Jewelry');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (134, 'ES', 'Gemas y Joyas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (135, 'EN', 'Ancient');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (135, 'ES', 'Antiguas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (136, 'EN', 'Beaded Jewelry');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (136, 'ES', 'Joyerí­a bordada');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (137, 'EN', 'Beads');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (137, 'ES', 'Granos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (138, 'EN', 'Carved & Cameo');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (138, 'ES', 'Cameo & Grabado');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (139, 'EN', 'Contemporary');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (139, 'ES', 'Contemporanea');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (140, 'EN', 'Costume');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (140, 'ES', 'Ropa');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (141, 'EN', 'Fine');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (141, 'ES', 'Fina');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (142, 'EN', 'Gemstones');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (142, 'ES', 'Gemas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (143, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (143, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (144, 'EN', 'Gold');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (144, 'ES', 'Oro');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (145, 'EN', 'Necklaces');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (145, 'ES', 'Collares');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (146, 'EN', 'Silver');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (146, 'ES', 'Plata');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (147, 'EN', 'Victorian');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (147, 'ES', 'Victoriana');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (148, 'EN', 'Vintage');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (148, 'ES', 'Vintage');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (149, 'EN', 'Home & Garden');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (149, 'ES', 'Hogar  y Jardin');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (150, 'EN', 'Baby Items');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (150, 'ES', 'Artículos de bebé');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (151, 'EN', 'Crafts');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (151, 'ES', 'Artesaní­a');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (152, 'EN', 'Furniture');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (152, 'ES', 'Muebles');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (153, 'EN', 'Garden');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (153, 'ES', 'Jardí­n');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (154, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (154, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (155, 'EN', 'Household Items');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (155, 'ES', 'Artí­culos del Hogar');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (156, 'EN', 'Pet Supplies');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (156, 'ES', 'Artí­culos mascotas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (157, 'EN', 'Tools & Hardware');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (157, 'ES', 'Herramientas & Equipo');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (158, 'EN', 'Weddings');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (158, 'ES', 'Bodas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (159, 'EN', 'Movies & Video');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (159, 'ES', 'Pelí­culas & Video');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (160, 'EN', 'DVD');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (160, 'ES', 'DVD');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (161, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (161, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (162, 'EN', 'Laser Discs');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (162, 'ES', 'Discos Laser');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (163, 'EN', 'VHS');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (163, 'ES', 'VHS');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (164, 'EN', 'Music');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (164, 'ES', 'Música');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (165, 'EN', 'CDs');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (165, 'ES', 'CDs');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (166, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (166, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (167, 'EN', 'Instruments');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (167, 'ES', 'Instrumentos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (168, 'EN', 'Memorabilia');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (168, 'ES', 'Memorabilia');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (169, 'EN', 'Records');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (169, 'ES', 'Grabaciones - Vynilos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (170, 'EN', 'Tapes');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (170, 'ES', 'Cintas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (171, 'EN', 'Office & Business');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (171, 'ES', 'Oficina y Negocios');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (172, 'EN', 'Briefcases');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (172, 'ES', 'Portafolio');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (173, 'EN', 'Fax Machines');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (173, 'ES', 'Fax');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (174, 'EN', 'General Equipment');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (174, 'ES', 'Equipo General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (175, 'EN', 'Pagers');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (175, 'ES', 'Localizadores');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (176, 'EN', 'Other Goods & Services');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (176, 'ES', 'Otros Bienes y Servicios');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (177, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (177, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (178, 'EN', 'Metaphysical');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (178, 'ES', 'Metafí­sicos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (179, 'EN', 'Property');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (179, 'ES', 'Propiedades');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (180, 'EN', 'Services');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (180, 'ES', 'Servicios');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (181, 'EN', 'Tickets & Events');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (181, 'ES', 'Entradas & Eventos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (182, 'EN', 'Transportation');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (182, 'ES', 'Transporte');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (183, 'EN', 'Travel');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (183, 'ES', 'Viajes');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (184, 'EN', 'Sports & Recreation');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (184, 'ES', 'Deportes y Ocio');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (185, 'EN', 'Apparel & Equipment');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (185, 'ES', 'Equipamiento & Accesorios');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (186, 'EN', 'Exercise Equipment');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (186, 'ES', 'Equipo de ejercicio');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (187, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (187, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (188, 'EN', 'Toys & Games');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (188, 'ES', 'Juguetes y Juegos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (189, 'EN', 'Action Figures');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (189, 'ES', 'Figuras de Acción');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (190, 'EN', 'Beanie Babies & Beanbag Toys');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (190, 'ES', 'Beanie Babies & Beanbag Toys');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (191, 'EN', 'Diecast');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (191, 'ES', 'Diecast');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (192, 'EN', 'Fast Food');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (192, 'ES', 'Comida rá¡pida');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (193, 'EN', 'Fisher-Price');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (193, 'ES', 'Fisher-Price');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (194, 'EN', 'Furby');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (194, 'ES', 'Furby');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (195, 'EN', 'Games');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (195, 'ES', 'Juegos');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (196, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (196, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (197, 'EN', 'Giga Pet & Tamagotchi');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (197, 'ES', 'Giga Pet & Tamagotchi');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (198, 'EN', 'Hobbies');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (198, 'ES', 'Hobbies');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (199, 'EN', 'Marbles');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (199, 'ES', 'Canicas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (200, 'EN', 'My Little Pony');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (200, 'ES', 'Mi pequeño Pony');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (201, 'EN', 'Peanuts Gang');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (201, 'ES', 'Peanuts - Snoopy y su Pandilla');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (202, 'EN', 'Pez');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (202, 'ES', 'Pez');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (203, 'EN', 'Plastic Models');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (203, 'ES', 'Modelos de Plástico');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (204, 'EN', 'Plush Toys');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (204, 'ES', 'Juguetes de Felpa');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (205, 'EN', 'Puzzles');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (205, 'ES', 'Puzzles');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (206, 'EN', 'Slot Cars');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (206, 'ES', 'Coches para pistas');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (207, 'EN', 'Teletubbies');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (207, 'ES', 'Teletubbies');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (208, 'EN', 'Toy Soldiers');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (208, 'ES', 'Soldados de juguete');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (209, 'EN', 'Vintage Tin');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (209, 'ES', 'Latas Vintage');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (210, 'EN', 'Vintage Vehicles');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (210, 'ES', 'Vehí­culos Vintage');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (211, 'EN', 'Vintage');
INSERT INTO `PHPAUCTIONXL_cats_translated` VALUES (211, 'ES', 'Vintage');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_closedrelisted`
# 

CREATE TABLE `PHPAUCTIONXL_closedrelisted` (
  `auction` int(32) default '0',
  `relistdate` varchar(8) NOT NULL default '',
  `newauction` int(32) NOT NULL default '0'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_closedrelisted`
# 

# Table structure for table `PHPAUCTIONXL_comm_messages`

CREATE TABLE IF NOT EXISTS `PHPAUCTIONXL_comm_messages` (
  `id` int(11) NOT NULL auto_increment,
  `boardid` int(11) NOT NULL default '0',
  `msgdate` varchar(14) NOT NULL default '',
  `user` int(11) NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `message` text NOT NULL,
  KEY `msg_id` (`id`)
) AUTO_INCREMENT=3 ;

# Dumping data for table `PHPAUCTIONXL_comm_messages`


# Table structure for table `PHPAUCTIONXL_community`

CREATE TABLE IF NOT EXISTS `PHPAUCTIONXL_community` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '0',
  `messages` int(11) NOT NULL default '0',
  `lastmessage` varchar(14) NOT NULL default '0',
  `msgstoshow` int(11) NOT NULL default '0',
  `active` int(1) NOT NULL default '1',
  KEY `msg_id` (`id`)
) AUTO_INCREMENT=3 ;

# Dumping data for table `PHPAUCTIONXL_community`

INSERT INTO `PHPAUCTIONXL_community` VALUES (1, 'Selling', 0, '', 30, 1);
INSERT INTO `PHPAUCTIONXL_community` VALUES (2, 'Buying', 0, '20050823103800', 30, 1);


# ############################

# 
# Table structure for table `PHPAUCTIONXL_counters`
# 

CREATE TABLE `PHPAUCTIONXL_counters` (
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
) ;

# 
# Dumping data for table `PHPAUCTIONXL_counters`
# 

INSERT INTO `PHPAUCTIONXL_counters` VALUES (0, 0, 0, 0, 0, 0, 0, '20070101', 0, 0);

# ############################

# 
# Table structure for table `PHPAUCTIONXL_counterstoshow`
# 

CREATE TABLE `PHPAUCTIONXL_counterstoshow` (
  `auctions` enum('y','n') NOT NULL default 'y',
  `users` enum('y','n') NOT NULL default 'y',
  `online` enum('y','n') NOT NULL default 'y'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_counterstoshow`
# 

INSERT INTO `PHPAUCTIONXL_counterstoshow` VALUES ('y', 'y', 'y');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_countries`
# 

CREATE TABLE `PHPAUCTIONXL_countries` (
  `country` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`country`)
) ;

# 
# Dumping data for table `PHPAUCTIONXL_countries`
# 

INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Afghanistan');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Albania');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Algeria');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('American Samoa');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Andorra');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Angola');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Anguilla');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Antarctica');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Antigua And Barbuda');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Argentina');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Armenia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Aruba');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Australia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Austria');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Azerbaijan');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Bahamas');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Bahrain');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Bangladesh');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Barbados');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Belarus');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Belgium');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Belize');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Benin');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Bermuda');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Bhutan');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Bolivia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Bosnia and Herzegowina');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Botswana');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Bouvet Island');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Brazil');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('British Indian Ocean Territory');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Brunei Darussalam');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Bulgaria');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Burkina Faso');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Burma');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Burundi');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Cambodia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Cameroon');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Canada');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Cape Verde');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Cayman Islands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Central African Republic');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Chad');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Chile');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('China');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Christmas Island');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Cocos (Keeling) Islands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Colombia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Comoros');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Congo');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Congo, the Democratic Republic');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Cook Islands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Costa Rica');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Cote d''Ivoire');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Croatia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Cyprus');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Czech Republic');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Denmark');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Djibouti');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Dominica');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Dominican Republic');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('East Timor');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Ecuador');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Egypt');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('El Salvador');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('England');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Equatorial Guinea');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Eritrea');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Estonia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Ethiopia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Falkland Islands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Faroe Islands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Fiji');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Finland');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('France');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('French Guiana');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('French Polynesia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('French Southern Territories');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Gabon');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Gambia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Georgia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Germany');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Ghana');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Gibraltar');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Great Britain');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Greece');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Greenland');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Grenada');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Guadeloupe');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Guam');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Guatemala');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Guinea');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Guinea-Bissau');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Guyana');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Haiti');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Heard and Mc Donald Islands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Holy See (Vatican City State)');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Honduras');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Hong Kong');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Hungary');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Iceland');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('India');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Indonesia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Ireland');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Israel');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Italy');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Jamaica');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Japan');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Jordan');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Kazakhstan');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Kenya');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Kiribati');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Korea (South)');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Kuwait');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Kyrgyzstan');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Lao People''s Democratic Republ');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Latvia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Lebanon');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Lesotho');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Liberia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Liechtenstein');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Lithuania');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Luxembourg');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Macau');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Macedonia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Madagascar');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Malawi');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Malaysia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Maldives');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Mali');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Malta');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Marshall Islands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Martinique');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Mauritania');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Mauritius');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Mayotte');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Mexico');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Micronesia, Federated States o');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Moldova, Republic of');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Monaco');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Mongolia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Montserrat');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Morocco');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Mozambique');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Namibia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Nauru');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Nepal');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Netherlands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Netherlands Antilles');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('New Caledonia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('New Zealand');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Nicaragua');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Niger');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Nigeria');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Niuev');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Norfolk Island');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Northern Ireland');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Northern Mariana Islands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Norway');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Oman');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Pakistan');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Palau');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Panama');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Papua New Guinea');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Paraguay');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Peru');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Philippines');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Pitcairn');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Poland');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Portugal');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Puerto Rico');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Qatar');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Reunion');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Romania');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Russian Federation');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Rwanda');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Saint Kitts and Nevis');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Saint Lucia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Saint Vincent and the Grenadin');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Samoa (Independent)');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('San Marino');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Sao Tome and Principe');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Saudi Arabia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Scotland');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Senegal');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Seychelles');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Sierra Leone');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Singapore');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Slovakia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Slovenia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Solomon Islands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Somalia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('South Africa');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('South Georgia and the South Sa');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Spain');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Sri Lanka');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('St. Helena');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('St. Pierre and Miquelon');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Suriname');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Svalbard and Jan Mayen Islands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Swaziland');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Sweden');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Switzerland');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Taiwan');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Tajikistan');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Tanzania');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Thailand');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Togo');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Tokelau');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Tonga');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Trinidad and Tobago');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Tunisia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Turkey');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Turkmenistan');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Turks and Caicos Islands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Tuvalu');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Uganda');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Ukraine');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('United Arab Emiratesv');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('United States');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Uruguay');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Uzbekistan');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Vanuatu');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Venezuela');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Viet Nam');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Virgin Islands (British)');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Virgin Islands (U.S.)');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Wales');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Wallis and Futuna Islands');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Western Sahara');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Yemen');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Zambia');
INSERT INTO `PHPAUCTIONXL_countries` VALUES ('Zimbabwe');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_currencies`
# 

CREATE TABLE `PHPAUCTIONXL_currencies` (
  `id` int(11) NOT NULL auto_increment,
  `currency` varchar(100) NOT NULL default '',
  KEY `id` (`id`)
) AUTO_INCREMENT=1 ;

# 
# Dumping data for table `PHPAUCTIONXL_currencies`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_currentaccesses`
# 

CREATE TABLE `PHPAUCTIONXL_currentaccesses` (
  `day` char(2) NOT NULL default '',
  `month` char(2) NOT NULL default '',
  `year` char(4) NOT NULL default '',
  `pageviews` int(11) NOT NULL default '0',
  `uniquevisitors` int(11) NOT NULL default '0',
  `usersessions` int(11) NOT NULL default '0'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_currentaccesses`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_currentbrowsers`
# 

CREATE TABLE `PHPAUCTIONXL_currentbrowsers` (
  `month` char(2) NOT NULL default '',
  `year` varchar(4) NOT NULL default '',
  `browser` varchar(50) NOT NULL default '0',
  `counter` int(11) NOT NULL default '0'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_currentbrowsers`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_currentdomains`
# 

CREATE TABLE `PHPAUCTIONXL_currentdomains` (
  `month` char(2) NOT NULL default '',
  `year` varchar(4) NOT NULL default '',
  `domain` varchar(100) NOT NULL default '0',
  `counter` int(11) NOT NULL default '0'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_currentdomains`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_currentplatforms`
# 

CREATE TABLE `PHPAUCTIONXL_currentplatforms` (
  `month` char(2) NOT NULL default '',
  `year` varchar(4) NOT NULL default '',
  `platform` varchar(50) NOT NULL default '0',
  `counter` int(11) NOT NULL default '0'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_currentplatforms`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_durations`
# 

CREATE TABLE `PHPAUCTIONXL_durations` (
  `days` int(11) NOT NULL default '0',
  `description` varchar(30) default NULL
) ;

# 
# Dumping data for table `PHPAUCTIONXL_durations`
# 

INSERT INTO `PHPAUCTIONXL_durations` VALUES (1, '1 day');
INSERT INTO `PHPAUCTIONXL_durations` VALUES (2, '2 days');
INSERT INTO `PHPAUCTIONXL_durations` VALUES (3, '3 days');
INSERT INTO `PHPAUCTIONXL_durations` VALUES (7, '1 week');
INSERT INTO `PHPAUCTIONXL_durations` VALUES (14, '2 weeks');
INSERT INTO `PHPAUCTIONXL_durations` VALUES (21, '3 weeks');
INSERT INTO `PHPAUCTIONXL_durations` VALUES (30, '1 month');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_faqs`
# 

CREATE TABLE `PHPAUCTIONXL_faqs` (
  `id` int(11) NOT NULL auto_increment,
  `question` varchar(200) NOT NULL default '',
  `answer` text NOT NULL,
  `category` int(11) NOT NULL default '0',
  KEY `id` (`id`)
) AUTO_INCREMENT=13 ;

# 
# Dumping data for table `PHPAUCTIONXL_faqs`
# 

INSERT INTO `PHPAUCTIONXL_faqs` VALUES (2, 'Registering', 'To register as a new user, click on Register at the top of the window. You will be asked for your name, a username and password, and contact information, including your email address.\r\n\r\n<B>You must be at least 18 years of age to register.</B>!', 1);
INSERT INTO `PHPAUCTIONXL_faqs` VALUES (4, 'Item Watch', '<b>Item watch</b> notifies you when someone bids on the auctions that you have added to your Item Watch. ', 3);
INSERT INTO `PHPAUCTIONXL_faqs` VALUES (5, 'What is a Dutch auction?', 'Dutch auction is a type of auction where the auctioneer begins with a high asking price which is lowered until some participant is willing to accept the auctioneer\'s price. The winning participant pays the last announced price.', 1);

# ############################

# 
# Table structure for table `PHPAUCTIONXL_faqs_translated`
# 

CREATE TABLE `PHPAUCTIONXL_faqs_translated` (
  `id` int(11) NOT NULL auto_increment,
  `lang` char(2) NOT NULL default '',
  `question` varchar(200) NOT NULL default '',
  `answer` text NOT NULL,
  KEY `id` (`id`)
) AUTO_INCREMENT=13 ;

# 
# Dumping data for table `PHPAUCTIONXL_faqs_translated`
# 

INSERT INTO `PHPAUCTIONXL_faqs_translated` VALUES (11, 'ES', 'Ã‚Â¿QuÃƒÂ¡ pasa neeeeeeeeeennnn?', 'Nadaaaaaaaaaaaaa');
INSERT INTO `PHPAUCTIONXL_faqs_translated` VALUES (2, 'EN', 'Registering', 'To register as a new user, click on Register at the top of the window. You will be asked for your name, a username and password, and contact information, including your email address.\r\n\r\n<B>You must be at least 18 years of age to register.</B>!');
INSERT INTO `PHPAUCTIONXL_faqs_translated` VALUES (2, 'ES', 'Registrarse', 'Para registrar un nuevo usuario, haz click en <B>RegÃ­Â­strate</B> en la parte superior de la pantalla. Se te preguntarÃ¡n tus datos personales, un nombre de usuario, una contraseÃ±a e informaciÃ³n de contacto como la direcciÃ³n e-mail.\r\n\r\n<B>Â¡Tienes que ser mayor de edad para poder registrarte!</B>');
INSERT INTO `PHPAUCTIONXL_faqs_translated` VALUES (4, 'EN', 'Item Watch', '<b>Item watch</b> notifies you when someone bids on the auctions that you have added to your Item Watch. ');
INSERT INTO `PHPAUCTIONXL_faqs_translated` VALUES (4, 'ES', 'Item Watch', '<i><b>Item watch</b></i> te envÃ­a una notificaciÃ³n por e-mail, cada vez que alguien puja en una de las subastas que has aÃ±adido a tu lista <i>Item Watch</i>. ');
INSERT INTO `PHPAUCTIONXL_faqs_translated` VALUES (6, 'ES', 'Auction Watch', '<i><B>Auction Watch</b></i> es tu asistente para saber cuando se abre una subasta cuya descripciÃ³n contiene palabras clave de tu interes.\r\n\r\nPara usar esta opciÃ³n inserta las palabras clave en las que estÃ©s interesado en la lista de <i>Auction Watch</i>. Todas las palabras claves deben estar separadas por un espacio. Cuando estas palabras claves aparezcan en algÃºn tÃ­tulo o descripciÃ³n de subasta, recibirÃ¡s un e-mail con la informaciÃ³n de que una subasta que contiene tus palabras claves ha sido creada. TambiÃ©n puedas agregar el nombre del usuario como palabra clave. ');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_faqscat_translated`
# 

CREATE TABLE `PHPAUCTIONXL_faqscat_translated` (
  `id` int(11) NOT NULL default '0',
  `lang` char(2) NOT NULL default '',
  `category` varchar(255) NOT NULL default ''
) ;

# 
# Dumping data for table `PHPAUCTIONXL_faqscat_translated`
# 

INSERT INTO `PHPAUCTIONXL_faqscat_translated` VALUES (3, 'EN', 'Buying');
INSERT INTO `PHPAUCTIONXL_faqscat_translated` VALUES (3, 'ES', 'Comprar');
INSERT INTO `PHPAUCTIONXL_faqscat_translated` VALUES (1, 'EN', 'General');
INSERT INTO `PHPAUCTIONXL_faqscat_translated` VALUES (1, 'ES', 'General');
INSERT INTO `PHPAUCTIONXL_faqscat_translated` VALUES (2, 'EN', 'Selling');
INSERT INTO `PHPAUCTIONXL_faqscat_translated` VALUES (2, 'ES', 'Vender');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_faqscategories`
# 

CREATE TABLE `PHPAUCTIONXL_faqscategories` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(200) NOT NULL default '',
  KEY `id` (`id`)
) AUTO_INCREMENT=25 ;

# 
# Dumping data for table `PHPAUCTIONXL_faqscategories`
# 

INSERT INTO `PHPAUCTIONXL_faqscategories` VALUES (1, 'General');
INSERT INTO `PHPAUCTIONXL_faqscategories` VALUES (2, 'Selling');
INSERT INTO `PHPAUCTIONXL_faqscategories` VALUES (3, 'Buying');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_feedbacks`
# 

CREATE TABLE `PHPAUCTIONXL_feedbacks` (
  `id` int(11) NOT NULL auto_increment,
  `rated_user_id` int(32) default NULL,
  `rater_user_nick` varchar(20) default NULL,
  `feedback` mediumtext,
  `rate` int(2) default NULL,
  `feedbackdate` timestamp ,
  `auction_id` int(32) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=1 ;

# 
# Dumping data for table `PHPAUCTIONXL_feedbacks`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_feedbacksanswers`
# 

CREATE TABLE `PHPAUCTIONXL_feedbacksanswers` (
  `id` int(11) NOT NULL auto_increment,
  `feedbackid` int(11) NOT NULL default '0',
  `rated_user_id` int(32) default NULL,
  `comment` text,
  `feedbackdate` timestamp ,
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=1 ;

# 
# Dumping data for table `PHPAUCTIONXL_feedbacksanswers`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_feedforum`
# 

CREATE TABLE `PHPAUCTIONXL_feedforum` (
  `id` int(11) NOT NULL auto_increment,
  `feed_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `seqnum` int(11) NOT NULL default '0',
  `commentdate` timestamp ,
  `COMMENT` text NOT NULL,
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=1 ;

# 
# Dumping data for table `PHPAUCTIONXL_feedforum`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_filterwords`
# 

CREATE TABLE `PHPAUCTIONXL_filterwords` (
  `word` varchar(255) NOT NULL default ''
) ;

# 
# Dumping data for table `PHPAUCTIONXL_filterwords`
# 

INSERT INTO `PHPAUCTIONXL_filterwords` VALUES ('');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_fontsandcolors`
# 

CREATE TABLE `PHPAUCTIONXL_fontsandcolors` (
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
) ;

# 
# Dumping data for table `PHPAUCTIONXL_fontsandcolors`
# 

INSERT INTO `PHPAUCTIONXL_fontsandcolors` VALUES (1, 3, '#FF9900', 'y', 'n', 1, 2, '#000000', 'n', 'n', 1, 1, '#000000', 'n', 'n', 2, 4, '#3300CC', 'y', 'n', 1, 3, '#3366CC', 'y', 'n', 1, 1, '#aaaaaa', 'n', 'n', '3366cc', '#ffffff', '#888888', '003399', '#333333', 'd8ebff');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_freecategories`
# 

CREATE TABLE `PHPAUCTIONXL_freecategories` (
  `category` int(11) NOT NULL default '0'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_freecategories`
# 

CREATE TABLE `PHPAUCTIONXL_messages` (
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
) ENGINE = MYISAM DEFAULT CHARSET = latin1;

# ############################

# 
# Table structure for table `PHPAUCTIONXL_https`
# 

CREATE TABLE `PHPAUCTIONXL_https` (
  `https` enum('yes','no') default NULL,
  `httpsurl` varchar(255) default NULL
) ;

# 
# Dumping data for table `PHPAUCTIONXL_https`
# 

INSERT INTO `PHPAUCTIONXL_https` VALUES ('no', 'https://yourdomain.com/path/to/phpauction/');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_increments`
# 

CREATE TABLE `PHPAUCTIONXL_increments` (
  `id` char(3) default NULL,
  `low` double(16,4) default NULL,
  `high` double(16,4) default NULL,
  `increment` double(16,4) default NULL
) ;

# 
# Dumping data for table `PHPAUCTIONXL_increments`
# 

INSERT INTO `PHPAUCTIONXL_increments` VALUES ('1', 0.0000, 0.9900, 0.2800);
INSERT INTO `PHPAUCTIONXL_increments` VALUES ('2', 1.0000, 9.9900, 0.5000);
INSERT INTO `PHPAUCTIONXL_increments` VALUES ('3', 10.0000, 29.9900, 1.0000);
INSERT INTO `PHPAUCTIONXL_increments` VALUES ('4', 30.0000, 99.9900, 2.0000);
INSERT INTO `PHPAUCTIONXL_increments` VALUES ('5', 100.0000, 249.9900, 5.0000);
INSERT INTO `PHPAUCTIONXL_increments` VALUES ('6', 250.0000, 499.9900, 10.0000);
INSERT INTO `PHPAUCTIONXL_increments` VALUES ('7', 500.0000, 999.9900, 25.0000);

# ############################

# 
# Table structure for table `PHPAUCTIONXL_lastupdate`
# 

CREATE TABLE `PHPAUCTIONXL_lastupdate` (
  `last_update` datetime default NULL,
  `updateinterval` int(11) NOT NULL default '0'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_lastupdate`
# 

INSERT INTO `PHPAUCTIONXL_lastupdate` VALUES ('2004-06-11 17:40:10', 100);

# ############################

# 
# Table structure for table `PHPAUCTIONXL_maintainance`
# 

CREATE TABLE `PHPAUCTIONXL_maintainance` (
  `id` int(11) NOT NULL auto_increment,
  `active` enum('y','n') default NULL,
  `superuser` varchar(32) default NULL,
  `maintainancetext` text,
  KEY `id` (`id`)
) AUTO_INCREMENT=2 ;

# 
# Dumping data for table `PHPAUCTIONXL_maintainance`
# 

INSERT INTO `PHPAUCTIONXL_maintainance` VALUES (1, 'n', 'gianluca', '<BR>\r\n<CENTER>\r\n<B>Under maintainance!!!!!!!</b>\r\n</center>');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_membertypes`
# 

CREATE TABLE `PHPAUCTIONXL_membertypes` (
  `id` int(11) NOT NULL auto_increment,
  `feedbacks` int(11) NOT NULL default '0',
  `membertype` varchar(30) NOT NULL default '',
  `discount` tinyint(4) NOT NULL default '0',
  `icon` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=25 ;

# 
# Dumping data for table `PHPAUCTIONXL_membertypes`
# 

INSERT INTO `PHPAUCTIONXL_membertypes` VALUES (24, 9, '', 0, 'transparent.gif');
INSERT INTO `PHPAUCTIONXL_membertypes` VALUES (22, 999999, '100000', 0, 'starFR.gif');
INSERT INTO `PHPAUCTIONXL_membertypes` VALUES (21, 99999, '50000', 0, 'starFV.gif');
INSERT INTO `PHPAUCTIONXL_membertypes` VALUES (20, 49999, '25000', 0, 'starFT.gif');
INSERT INTO `PHPAUCTIONXL_membertypes` VALUES (19, 24999, '10000', 0, 'starFY.gif');
INSERT INTO `PHPAUCTIONXL_membertypes` VALUES (23, 9999, '5000', 0, 'starG.gif');
INSERT INTO `PHPAUCTIONXL_membertypes` VALUES (17, 4999, '1000', 0, 'starR.gif');
INSERT INTO `PHPAUCTIONXL_membertypes` VALUES (16, 999, '100', 0, 'starT.gif');
INSERT INTO `PHPAUCTIONXL_membertypes` VALUES (15, 99, '50', 0, 'starB.gif');
INSERT INTO `PHPAUCTIONXL_membertypes` VALUES (14, 49, '10', 0, 'starY.gif');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_news`
# 

CREATE TABLE `PHPAUCTIONXL_news` (
  `id` int(32) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL default '',
  `content` longtext NOT NULL,
  `new_date` int(8) NOT NULL default '0',
  `suspended` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=5 ;

# 
# Dumping data for table `PHPAUCTIONXL_news`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_news_translated`
# 

CREATE TABLE `PHPAUCTIONXL_news_translated` (
  `id` int(11) NOT NULL default '0',
  `lang` char(2) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `content` text NOT NULL
) ;

# 
# Dumping data for table `PHPAUCTIONXL_news_translated`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_online`
# 

CREATE TABLE `PHPAUCTIONXL_online` (
  `ID` bigint(21) NOT NULL auto_increment,
  `SESSION` varchar(255) NOT NULL default '',
  `time` bigint(21) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) AUTO_INCREMENT=325 ;

# 
# Dumping data for table `PHPAUCTIONXL_online`
# 

INSERT INTO `PHPAUCTIONXL_online` VALUES (324, 'fdcb0b352167f41fef1198ae53df714d', 1129279393);

# ############################

# 
# Table structure for table `PHPAUCTIONXL_package`
# 

CREATE TABLE `PHPAUCTIONXL_package` (
  `id` int(11) NOT NULL auto_increment,
  `scriptname` varchar(60) NOT NULL default '',
  `scriptdir` varchar(60) NOT NULL default '',
  `scriptdate` varchar(8) NOT NULL default '',
  `scriptversion` varchar(10) NOT NULL default '',
  `scriptstatus` enum('inuse','updated') NOT NULL default 'inuse',
  KEY `id` (`id`)
) AUTO_INCREMENT=724 ;

# 
# Dumping data for table `PHPAUCTIONXL_package`
# 

INSERT INTO `PHPAUCTIONXL_package` VALUES (1, 'aboutmetemplate1.html', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (2, '2checkouthelp.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (3, 'ST_browsers.html', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (4, 'ST_browsers.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (5, 'ST_countries.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (6, 'ST_platforms.html', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (7, 'ST_platforms.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (8, 'aboutme.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (9, 'batch.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (10, 'bar.php', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (11, 'aboutmetemplate2.html', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (12, 'aboutmetemplates.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (13, 'aboutus.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (14, 'acceptancetext.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (15, 'accessstatshistoric.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (16, 'accounttypes.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (17, 'activatenewsletter.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (18, 'addcredits.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (19, 'addnew.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (20, 'adminusers.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (21, 'alternativepayments.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (22, 'auctionssearch.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (23, 'banips.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (24, 'banners.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (25, 'bannerssettings.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (26, 'categories.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (27, 'bidfind.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (28, 'boards.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (29, 'bold.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (30, 'faqs.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (31, 'boardsettings.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (32, 'boldfee.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (33, 'create_package_structure.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (34, 'browserstatshistoric.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (35, 'buyersfinalvaluefee.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (36, 'buyersrequests.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (37, 'categories.txt', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (38, 'categorieshelp.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (39, 'categoryfeatured.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (40, 'categoryfeaturedfee.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (41, 'catsorting.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (42, 'check_files.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (43, 'checkupdates.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (44, 'colors.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (45, 'contactseller.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (46, 'contactus.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (47, 'converter.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (48, 'counters.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (49, 'currency.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (50, 'editadminuser.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (51, 'durations.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (52, 'createaboutme.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (53, 'currencies.txt', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (54, 'editfaq.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (55, 'deleteclosedauction.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (56, 'deleteauction.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (57, 'deletebanner.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (58, 'domainstatshistoric.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (59, 'deletemessage.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (60, 'errorhandling.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (61, 'editnew.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (62, 'deleteuserfeed.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (63, 'excludeauction.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (64, 'edituser.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (65, 'editbannersuser.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (66, 'editauction.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (67, 'editbanner.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (68, 'editinvoice.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (69, 'editboards.php', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (70, 'editpendinginvoices.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (71, 'editmessages.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (72, 'excludeuser.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (73, 'fvf.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (74, 'edittemplate.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (75, 'https.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (76, 'header.php', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (77, 'news.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (78, 'faqscategories.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (79, 'extension.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (80, 'edituserfeed.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (81, 'highlightedfee.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (82, 'featuredfee.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (83, 'homepage.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (84, 'exportauctions.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (85, 'exportcauctions.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (86, 'exportsauctions.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (87, 'exportuserauctions.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (88, 'exportusers.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (89, 'highlighted.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (90, 'featured.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (91, 'hiddenfiles.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (92, 'fonts.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (93, 'membertypes.php', 'admin/', '20050915', '1.1.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (94, 'footer.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (95, 'freecategories.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (96, 'increments.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (97, 'help.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (98, 'newtree.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (99, 'invoicedetails.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (100, 'invoicesheaderfooter.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (101, 'home.installation.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (102, 'home.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (103, 'home.stats.php', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (104, 'homepage.html', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (105, 'wordsfilter.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (106, 'time.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (107, 'httpshelp.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (108, 'httpsneeded.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (109, 'listauctions.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (110, 'incrementshelp.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (111, 'index.php', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (112, 'install.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (113, 'install2.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (114, 'install3.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (115, 'install4.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (116, 'install5.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (117, 'installheader.php', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (118, 'trustusers.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (119, 'wap.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (120, 'metatags.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (121, 'multilingual.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (122, 'loggedin.inc.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (123, 'listhelp.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (124, 'listusers.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (125, '.DS_Store', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (126, 'maintainance.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (127, 'login.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (128, 'logout.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (129, 'picturesgalleryfee.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (130, 'managebanners.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (131, 'newsletter.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (132, 'newboard.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (133, 'newbannersuser.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (134, 'sitemap.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (135, 'newfaq.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (136, 'relisting.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (137, 'patches.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (138, 'payments.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (139, 'paypaladdress.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (140, 'payprepay.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (141, 'settings.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (142, 'terms.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (143, 'paypalhelp.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (144, 'pendinginvoices.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (145, 'picturesgallery.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (146, 'populate_categories.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (147, 'resendemail.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (148, 'picturesupload.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (149, 'dates.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (150, 'platformstatshistoric.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (151, 'previewinvoice.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (152, 'testmode.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (153, 'rebuild_html.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (154, 'rebuild_tables.php', 'admin/', '20050915', '1.1.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (155, 'sendinvoices.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (156, 'reservefee.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (157, 'deleteuser.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (158, 'runscript.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (159, 'savetodisk.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (160, 'sellerfinalvaluefee.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (161, 'sellersetupfee.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (162, 'xl', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (163, 'backup', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (164, 'signupfee.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (165, 'settings.menu.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (166, 'taxsettings.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (167, 'theme.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (168, 'stats.menu', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (169, 'stats_settings.html', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (170, 'stats_settings.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (171, 'tags_signup1.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (172, 'tagsauctionsetup.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (173, 'targethelp.html', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (174, 'thumbnails.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (175, 'greetings.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (176, 'listclosedauctions.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (177, 'unconfirmedusers.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (178, 'buyitnow.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (179, 'updatecounters.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (180, 'upgradeXL.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (181, 'userinvoicedetails.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (182, 'userfeedback.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (183, 'viewaccessstats.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (184, 'userinvoices.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (185, 'userssearch.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (186, 'userssettings.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (187, 'variants.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (188, 'viewinvoices.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (189, 'userunsentinvoices.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (190, 'util_cc1.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (191, 'util_cc2.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (192, 'deletenew.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (193, 'viewbrowserstats.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (194, 'viewcc.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (195, 'viewdomainstats.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (196, 'viewfilters.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (197, 'viewplatformstats.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (198, 'viewtemplate.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (199, 'viewuserips.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (200, 'viewtemplatetags.html', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (201, 'viewuserauctions.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (202, 'viewwinners.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (203, 'wapsettings.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (204, 'wanted.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (205, 'images', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (206, 'style.css', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (207, 'winner_address.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (208, 'stats_settings_files', 'admin/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (209, 'adultonly.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (210, 'metatags.php~', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (211, 'sendinvoices.php~', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (212, 'countries.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (213, 'editfaqscategory.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (214, 'bidretract.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (215, 'editmessage.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (216, 'newadminuser.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (217, 'uniqueseller.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (218, 'userbanners.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (219, 'usersauth.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (220, 'listsuspendedauctions.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (221, 'defaultcountry.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (222, 'banemails.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (223, 'forumsmessages.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (224, 'userconfirmation.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (225, 'sendinvoices_cron.php', 'admin/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (226, 'bulkuploadauction.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (227, '2checkoutipn.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (228, 'aboutme.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (229, 'active_auctions.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (230, 'addfeedforum.php', '', '20050915', '3.0.1', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (231, 'adsearch.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (232, 'auction_watch.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (233, 'bid.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (234, 'blacklists.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (235, 'boards.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (236, 'browse.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (237, 'bulkschema.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (238, 'bulkupload.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (239, 'select_category.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (240, 'buy_credits.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (241, 'buy_credits_confirmation.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (242, 'buy_credits_cancelled.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (243, 'buy_now.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (244, 'buying.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (245, 'calendar.html', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (246, 'docs', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (247, 'buysellnofeedback.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (248, 'cancel.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (249, 'clickthrough.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (250, 'catids.php', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (251, 'cron.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (252, 'viewnew.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (253, 'edit_active_auction.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (254, 'closed_auctions.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (255, 'confirm.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (256, 'contactus.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (257, 'contents.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (258, 'converter.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (259, 'countryids.php', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (260, 'createaboutme.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (261, 'credits_account.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (262, 'uc.php', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (263, 'dailyemails.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (264, 'editblacklist.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (265, 'edit_data.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (266, 'editaboutme.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (267, 'getthumb-banalized.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (268, 'editinvitedlist.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (269, 'email_request.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (270, 'error.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (271, 'faqs.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (272, 'feedback.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (273, 'feesdue.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (274, 'footer.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (275, 'forgotpasswd.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (276, 'friend.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (277, 'gallery.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (278, 'getbckthumb.php', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (279, 'help_password.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (280, 'getthumb.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (281, 'header.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (282, 'help.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (283, 'help_email.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (284, 'help_name.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (285, 'help_nick.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (286, 'item_watch.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (287, 'item.php', '', '20050915', '3.0.1', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (288, 'highlighted_style_css.inc', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (289, 'sell.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (290, 'invited.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (291, 'inviteduserslists.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (292, 'iperror.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (293, 'view_more_ending.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (294, 'leave_feedback.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (295, 'login.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (296, 'logout.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (297, 'maintenance.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (298, 'megalist.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (299, 'msgboard.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (300, 'newuser_credits.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (301, 'notification.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (302, 'online.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (303, 'pay_buyer_fee.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (304, 'pay_seller_fee.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (305, 'payinvoice.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (306, 'preview_gallery.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (307, 'previewaboutme.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (308, 'profile.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (309, 'register.php', '', '20050915', '3.0.1', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (310, 'relistauction.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (311, 'wantedad.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (312, 'search.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (313, 'reopen_closed_auction.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (314, 'edit_wanteditem.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (315, 'selltemplate.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (316, 'select_wanted_category.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (317, 'selling.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (318, 'users_search.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (319, 'send_email.php', '', '20050915', '3.0.1', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (320, 'thanks.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (321, 'upldgallery.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (322, 'user_data.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (323, 'user_login.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (324, 'user_menu.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (325, 'useraboutme.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (326, 'viewinvoice.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (327, 'view_gallery.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (328, 'admin', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (329, 'view_more_higher.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (330, 'view_more_news.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (331, 'viewallnews.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (332, 'viewfaqs.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (333, 'yourauctions.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (334, 'index.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (335, 'viewrelisted.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (336, 'sitemap.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (337, 'sim.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (338, 'yourauctions_c.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (339, 'yourauctions_p.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (340, 'yourauctions_s.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (341, '.DS_Store', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (342, 'browse_wanted.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (343, 'yourbids.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (344, 'yourfeedback.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (345, 'yourinvoices.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (346, 'images', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (347, 'includes', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (348, 'lib', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (349, 'sql', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (350, 'eledicss.php', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (351, 'uploaded', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (352, 'wap', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (353, 'xl2float.css', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (354, 'csseditor_.php', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (355, 'navig.php', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (356, 'fck', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (357, 'yourauctions_sold.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (358, 'xl2float.css.old', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (359, 'editpagestyle.php', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (360, 'test.php', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (361, 'js', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (362, 'data', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (363, 'editstylesheet.php', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (364, 'csseditor.php', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (365, 'csssyntax.inc', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (366, 'themes', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (367, 'closedwanted.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (368, 'wanted.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (369, 'payment_details.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (370, 'yourauctions_b.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (371, 'simresponse.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (372, 'dailynotifications.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (373, 'wanteditem.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (374, 'privateboard_poster.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (375, 'selleremails.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (376, 'privateboard.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (377, 'respondad.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (378, 'publicboard.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (379, 'yourprivateboards.php', '', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (380, 'Untitled-2', '', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (381, 'flags', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (382, 'img', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (383, 'images', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (384, 'popups', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (385, 'auction_confirmation.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (386, 'CurrencyConverter.wdsl', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (387, 'buyer_request.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (388, 'auction_types.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (389, 'auctionmail.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (390, 'auctionmail.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (391, 'auctionstoshow.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (392, 'banners.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (393, 'browseitems.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (394, 'browsers.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (395, 'categories_select_box.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (396, 'buyer_request.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (397, 'buyerfinalfee.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (398, 'calendar.html', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (399, 'calendar.js', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (400, 'checkage.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (401, 'cc.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (402, 'colorpicker.smlfont.inc', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (403, 'class.smtp.inc', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (404, 'colorpicker.highlighteditems.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (405, 'colorpicker.bordercolor.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (406, 'colorpicker.errfont.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (407, 'colorpicker.footerfont.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (408, 'colorpicker.headercolor.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (409, 'colorpicker.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (410, 'colorpicker.tableheadercolor.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (411, 'colorpicker.linkscolor.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (412, 'colorpicker.navfont.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (413, 'colorpicker.navfont.inc.php.txt', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (414, 'colorpicker.navfont.inc.txt', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (415, 'colorpicker.smlfont.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (416, 'colorpicker.stdfont.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (417, 'colorpicker.vlinkscolor.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (418, 'colorpicker.tltfont.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (419, 'errors.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (420, 'editor.js', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (421, 'comment_confirmation.EN.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (422, 'comment_confirmation.ES.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (423, 'comment_confirmation.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (424, 'config.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (425, 'config.inc.tmp', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (426, 'converter.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (427, 'countries.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (428, 'currency.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (429, 'datacheck.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (430, 'dates.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (431, 'domains.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (432, 'languages.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (433, 'html.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (434, 'endauction_buyer_nobalance.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (435, 'endauction_cumulative.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (436, 'endauction_nowinner.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (437, 'endauction_winner.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (438, 'endauction_winner_nobalance.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (439, 'endauction_winner_pay.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (440, 'endauction_youwin.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (441, 'endauction_youwin_nodutch.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (442, 'endauction_youwin_pay.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (443, 'endauctionmail.EN.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (444, 'endauctionmail.ES.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (445, 'fontcolor.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (446, 'fonts.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (447, 'settings.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (448, 'friend_confirmation.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (449, 'friendmail.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (450, 'friendmail.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (451, 'highlighted_style_css.inc', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (452, 'https.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (453, 'invoice.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (454, 'invitation_email.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (455, 'invitationmail.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (456, 'invitationmail.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (457, 'ips.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (458, 'nusoap.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (459, 'invoice_footer_text.inc.txt', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (460, 'invoice_header_text.inc.txt', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (461, 'mail_endauction_youwin_nodutch.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (462, 'mail_endauction_buyers_nofee.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (463, 'mail_endauction_buyers_nofee.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (464, 'mail_endauction_cumulative.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (465, 'mail_endauction_cumulative.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (466, 'mail_endauction_nowinner.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (467, 'mail_endauction_nowinner.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (468, 'mail_endauction_winner.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (469, 'mail_endauction_winner.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (470, 'mail_endauction_winner_nofee.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (471, 'mail_endauction_winner_nofee.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (472, 'mail_endauction_winner_pay.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (473, 'mail_endauction_winner_pay.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (474, 'mail_endauction_youwin.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (475, 'mail_endauction_youwin.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (476, 'newpasswd.EN.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (477, 'messages.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (478, 'mail_endauction_youwin_nodutch.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (479, 'mail_endauction_youwin_nodutch.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (480, 'mail_endauction_youwin_pay.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (481, 'mail_endauction_youwin_pay.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (482, 'mail_endauction_youwin_pay.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (483, 'mail_item_watch.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (484, 'mail_request_to_seller.EN.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (485, 'mail_request_to_seller.ES.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (486, 'membertypes.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (487, 'messages.EN.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (488, 'messages.ES.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (489, 'no_longer_winner.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (490, 'newpasswd.ES.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (491, 'newpasswd.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (492, 'setup_fee_confirmation_pay.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (493, 'no_longer_winnermail.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (494, 'no_longer_winnermail.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (495, 'passwd.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (496, 'passwd.inc.tmp', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (497, 'phpauction-key.key', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (498, 'platforms.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (499, 'wanteditem_notification.EN.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (500, 'send_email.EN.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (501, 'send_email.ES.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (502, 'birthday.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (503, 'updaterates.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (504, 'stats.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (505, 'setup_confirmation_pay_mail.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (506, 'setup_confirmation_pay_mail.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (507, 'status.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (508, 'styles.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (509, 'tags.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (510, 'time.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (511, 'user_confirmation.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (512, 'updatecounters.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (513, 'user_approved.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (514, 'user_confirmation_needapproval.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (515, 'user_confirmation_invoicing.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (516, 'usermail_toseller_approved.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (517, 'user_confirmation_needapproval.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (518, 'user_rejected.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (519, 'user_toseller_approved.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (520, 'user_toseller_rejected.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (521, 'useragent.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (522, 'usermail.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (523, 'usermail.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (524, 'usermail_approved.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (525, 'usermail_approved.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (526, 'usermail_needapproval.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (527, 'usermail_needapproval.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (528, 'usermail_pay.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (529, 'usermail_pay.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (530, 'usermail_pay_invoice.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (531, 'usermail_pay_invoice.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (532, 'usermail_prepay.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (533, 'usermail_prepay.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (534, 'usermail_rejected.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (535, 'usermail_rejected.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (536, 'usermail_toseller_approved.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (537, 'usermail_toseller_rejected.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (538, 'usermail_toseller_rejected.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (539, 'wordfilter.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (540, 'styles.inc.php.old', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (541, 'updatecategories.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (542, 'simlib.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (543, 'mailIt.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (544, 'mimePart.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (545, 'sellerfinalfee.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (546, 'updatefaqs.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (547, 'browsewanted.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (548, 'auction_watchmail.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (549, 'banemails.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (550, 'class.html.mime.mail.inc', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (551, 'privateboard_messages.EN.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (552, 'privateboard_messages.ES.inc.php', 'includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (553, 'wanteditem_notification.ES.inc.php', 'includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (554, 'auctionsetup_payment.php', 'lib/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (555, 'auctionsetup_note.php', 'lib/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (556, 'simulator.php', 'lib/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (557, 'cancel.php', 'lib/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (558, 'signuppayment_pay.php', 'lib/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (559, 'signuppayment.php', 'lib/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (560, 'includes', 'lib/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (561, 'simulator_confirmation.php', 'lib/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (562, 'thanks.php', 'lib/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (563, 'credits_confirmation.EN.inc.php', 'lib/includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (564, 'credits_confirmation.ES.inc.php', 'lib/includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (565, 'signup_completed.EN.inc.php', 'lib/includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (566, 'signup_completed.ES.inc.php', 'lib/includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (567, 'signup_denied.EN.inc.php', 'lib/includes/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (568, 'signup_denied.ES.inc.php', 'lib/includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (569, 'signup_fee_confirmation_prepay.EN.inc.php', 'lib/includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (570, 'signup_fee_confirmation_pay.EN.inc.php', 'lib/includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (571, 'signup_fee_confirmation_pay.ES.inc.php', 'lib/includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (572, 'signup_fee_confirmation_prepay.ES.inc.php', 'lib/includes/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (573, 'template_advanced_search_result.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (574, 'template_2checkoutipn_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (575, 'template_addfeedforum_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (576, 'template_advanced_search.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (577, 'template_auction_watchmail_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (578, 'template_auction_watch_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (579, 'template_bid_result_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (580, 'template_auctions.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (581, 'template_back_to_active_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (582, 'template_auctions_active.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (583, 'template_auctions_closed.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (584, 'template_auctions_no_cat.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (585, 'template_bid_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (586, 'template_back_to_bulkloaded_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (587, 'template_back_to_closed_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (588, 'template_back_to_sold_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (589, 'template_bulkuploadauction_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (590, 'template_bidhistory_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (591, 'template_blacklists_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (592, 'template_boards_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (593, 'template_browse_header_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (594, 'template_browse_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (595, 'template_bulkupload_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (596, 'template_buy_credits_confirmation_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (597, 'template_buy_credits_cancelled_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (598, 'template_newuser_buy_credits_paypal_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (599, 'template_buy_credits_paypal_pay_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (600, 'template_buy_credits_paypal_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (601, 'template_buy_credits_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (602, 'template_buy_now_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (603, 'template_buying_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (604, 'template_change_details_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (605, 'template_confirm_error_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (606, 'template_confirm_fee_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (607, 'template_confirm_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (608, 'template_confirmed_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (609, 'template_confirmed_refused_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (610, 'template_contactus_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (611, 'template_contents_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (612, 'template_create_aboutme_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (613, 'template_credits_account_pay_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (614, 'template_credits_account_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (615, 'template_edit_auction_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (616, 'template_edit_result_pay_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (617, 'template_editaboutme_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (618, 'template_editblacklists_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (619, 'template_editinviteduserslists_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (620, 'template_email_request_form.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (621, 'template_email_request_result.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (622, 'template_empty_search.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (623, 'template_error_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (624, 'template_faqs_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (625, 'template_feedback_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (626, 'template_feesdue_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (627, 'template_forgotpasswd_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (628, 'template_friend_confirmation_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (629, 'template_friend_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (630, 'template_index_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (631, 'template_invited_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (632, 'template_inviteduserslists_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (633, 'template_item_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (634, 'template_item_watch_endedmail_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (635, 'template_item_watch_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (636, 'template_msgboard_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (637, 'template_myauction_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (638, 'template_relist_sell_result_pay_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (639, 'template_newuser_buy_credits_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (640, 'template_passwd_sent_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (641, 'template_pay_buyerfee_error_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (642, 'template_pay_buyerfee_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (643, 'template_payinvoice_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (644, 'template_paysellerfee_error_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (645, 'template_paysellerfee_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (646, 'template_profile_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (647, 'template_register_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (648, 'template_registered_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (649, 'template_relist_sell_result_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (650, 'template_relistauction_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (651, 'template_select_category_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (652, 'template_sell_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (653, 'footer.php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (654, '.DS_Store', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (655, 'style.css', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (656, 'logo.gif', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (657, 'template_sell_result_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (658, 'template_sellbuyfeedback_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (659, 'template_sellermails_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (660, 'template_selling_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (661, 'template_selltemplate_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (662, 'template_send_email_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (663, 'template_show_feedback.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (664, 'template_updated.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (665, 'template_user_login_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (666, 'template_user_menu_account.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (667, 'template_user_menu_buying.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (668, 'template_user_menu_nofee_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (669, 'template_user_menu_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (670, 'template_user_menu_selling.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (671, 'template_users_auctions_header_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (672, 'template_view_allnews_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (673, 'template_view_ending_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (674, 'template_sell_result_pay_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (675, 'template_viewfaq_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (676, 'settings.ini', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (677, 'template_view_higher_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (678, 'template_view_new_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (679, 'template_view_news_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (680, 'template_respondad_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (681, 'template_viewinvoice_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (682, 'template_viewrelisted_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (683, 'template_yourauctions_b_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (684, 'template_yourauctions_c_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (685, 'template_yourauctions_p_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (686, 'template_yourauctions_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (687, 'template_yourauctions_s_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (688, 'template_yourauctions_sold_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (689, 'template_yourbids_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (690, 'template_yourfeedback_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (691, 'template_yourinvoices_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (692, 'template_user_menu_header.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (693, 'template_user_menu_footer.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (694, 'template_signupfee_paypal_pay_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (695, 'template_yourprivateboards_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (696, 'template_browse_wanted_header_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (697, 'template_wanted_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (698, 'header.php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (699, 'img', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (700, 'template_sitemap_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (701, 'template_view_help_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (702, 'template_browse_wanted_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (703, 'template_users_closed_auctions_header_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (704, 'template_closedwanted_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (705, 'template_payment_details_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (706, 'template_privateboards_poster_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (707, 'template_publicboard_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (708, 'template_select_wanted_category_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (709, 'template_wantedad_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (710, 'template_wanted_no_cat.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (711, 'template_wanted_result_php.html', 'themes/default/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (712, 'template_wanteditem_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (713, 'template_wanteditem_preview_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (714, 'template_sell_preview_php.html', 'themes/default/', '20050915', '3.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (715, 'endingsoon.php', 'wap/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (716, 'browse.php', 'wap/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (717, 'lastcreated.php', 'wap/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (718, 'index.php', 'wap/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (719, 'item.php', 'wap/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (720, 'item_.php', 'wap/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (721, 'includes', 'wap/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (722, 'logo.wbmp', 'wap/', '20050915', '0.0.0', 'inuse');
INSERT INTO `PHPAUCTIONXL_package` VALUES (723, 'logo2.wbmp', 'wap/', '20050915', '0.0.0', 'inuse');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_payments`
# 

CREATE TABLE `PHPAUCTIONXL_payments` (
  `id` int(2) default NULL,
  `description` varchar(30) default NULL
) ;

# 
# Dumping data for table `PHPAUCTIONXL_payments`
# 

INSERT INTO `PHPAUCTIONXL_payments` VALUES (1, 'Paypal');
INSERT INTO `PHPAUCTIONXL_payments` VALUES (2, 'Wire Transfer');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_pendingnotif`
# 

CREATE TABLE `PHPAUCTIONXL_pendingnotif` (
  `id` int(11) NOT NULL auto_increment,
  `auction_id` int(11) NOT NULL default '0',
  `seller_id` int(11) NOT NULL default '0',
  `winners` text NOT NULL,
  `auction` text NOT NULL,
  `seller` text NOT NULL,
  `thisdate` varchar(8) NOT NULL default '',
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=1 ;

# 
# Dumping data for table `PHPAUCTIONXL_pendingnotif`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_platforms`
# 

CREATE TABLE `PHPAUCTIONXL_platforms` (
  `month` char(2) NOT NULL default '',
  `year` varchar(4) NOT NULL default '',
  `browser` varchar(50) NOT NULL default '0',
  `counter` int(11) NOT NULL default '0'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_platforms`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_proxybid`
# 

CREATE TABLE `PHPAUCTIONXL_proxybid` (
  `itemid` int(32) default NULL,
  `userid` int(32) default NULL,
  `bid` double(16,4) default NULL
) ;

# 
# Dumping data for table `PHPAUCTIONXL_proxybid`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_rates`
# 

CREATE TABLE `PHPAUCTIONXL_rates` (
  `id` int(11) NOT NULL auto_increment,
  `ime` tinytext NOT NULL,
  `valuta` tinytext NOT NULL,
  `rate` float(8,2) NOT NULL default '0.00',
  `sifra` tinytext NOT NULL,
  `symbol` char(3) NOT NULL default '',
  KEY `id` (`id`)
) AUTO_INCREMENT=64 ;

# 
# Dumping data for table `PHPAUCTIONXL_rates`
# 

INSERT INTO `PHPAUCTIONXL_rates` VALUES (1, 'United States', 'U.S. Dollar', 1.00, 'U.S. Dollar ', 'USD');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (2, 'Argentina', 'Argentinian Peso', 2.97, 'Argentine Peso ', 'ARS');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (3, 'Australia', 'Australian Dollar ', 1.45, 'Australian Dollar ', 'AUD');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (5, 'Brazil', 'Brazilian Real ', 3.15, 'Brazilian Real ', 'BRL');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (6, 'Chile', 'Chilean Peso ', 649.86, 'Chilean Peso ', 'CLP');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (7, 'China', 'Chinese Renminbi ', 8.28, 'Chinese Renminbi ', 'CNY');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (8, 'Colombia', 'Colombian Peso ', 2734.87, 'Colombian Peso ', 'COP');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (10, 'Czech. Republic', 'Czech. Republic Koruna ', 26.17, 'Czech. Republic Koruna ', 'CZK');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (11, 'Denmark', 'Danish Krone ', 6.19, 'Danish Krone ', 'DKK');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (12, 'European Union', 'EURO', 0.83, 'European Monetary Union EURO', 'EUR');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (13, 'Fiji', 'Fiji Dollar ', 1.78, 'Fiji Dollar ', 'FJD');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (16, 'Hong Kong', 'Hong Kong Dollar', 7.80, 'Hong Kong Dollar ', 'HKD');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (18, 'Iceland', 'Icelandic Krona ', 72.47, 'Icelandic Krona ', 'INR');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (19, 'India', 'Indian Rupee', 45.07, 'Indian Rupee ', 'INR');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (20, 'Indonesia', 'Indonesian Rupiah ', 9411.72, 'Indonesian Rupiah ', 'IDR');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (21, 'Israel', 'Israeli New Shekel ', 4.53, 'Israeli New Shekel ', 'ILS');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (22, 'Japan', 'Japanese Yen', 110.08, 'Japanese Yen ', 'JPY');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (23, 'Malaysia', 'Malaysian Ringgit ', 3.80, 'Malaysian Ringgit ', 'MYR');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (24, 'Mexico', 'New Peso', 10.81, 'Mexican New Peso ', 'MXN');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (25, 'Morocco', 'Moroccan Dirham ', 9.11, 'Moroccan Dirham ', 'MAD');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (28, 'New Zealand', 'New Zealand Dollar', 1.59, 'New Zealand Dollar ', 'NZD');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (29, 'Norway', 'Norwege Krone', 6.92, 'Norwegian Krone ', 'NOK');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (30, 'Pakistan', 'Pakistan Rupee ', 57.83, 'Pakistan Rupee ', 'PKR');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (31, 'Panama', 'Panamanian Balboa ', 1.00, 'Panamanian Balboa ', 'PAB');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (32, 'Peru', 'Peruvian New Sol', 3.48, 'Peruvian New Sol ', 'PEN');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (33, 'Philippine', 'Philippine Peso ', 55.79, 'Philippine Peso ', 'PHP');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (34, 'Poland', 'Polish Zloty', 3.82, 'Polish Zloty ', 'PLN');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (35, 'Russian', 'Russian Rouble', 29.02, 'Russian Rouble ', 'RUR');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (36, 'Singapore', 'Singapore Dollar ', 1.72, 'Singapore Dollar ', 'SGD');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (37, 'Slovakia', 'Koruna', 33.16, 'Slovak Koruna ', 'SKK');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (38, 'Slovenia', 'Slovenian Tolar', 198.94, 'Slovenian Tolar ', 'SIT');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (39, 'South Africa', 'South African Rand', 6.51, 'South African Rand ', 'ZAR');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (40, 'South Korea', 'South Korean Won', 1164.42, 'South Korean Won ', 'KRW');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (41, 'Sri Lanka', 'Sri Lanka Rupee ', 99.98, 'Sri Lanka Rupee ', 'LKR');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (42, 'Sweden', 'Swedish Krona', 7.62, 'Swedish Krona ', 'SEK');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (43, 'Switzerland', 'Swiss Franc', 1.26, 'Swiss Franc ', 'CHF');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (44, 'Taiwan', 'Taiwanese New Dollar ', 33.46, 'Taiwanese New Dollar ', 'TWD');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (45, 'Thailand', 'Thailand Thai Baht ', 40.69, 'Thai Baht ', 'THB');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (47, 'Tunisia', 'Tunisisan Dinar', 1.27, 'Tunisian Dinar ', 'TND');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (48, 'Turkey', 'Turkish Lira', 150.05, 'Turkish Lira (2) ', 'TRL');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (49, 'Great Britain', 'Pound Sterling ', 0.57, 'Pound Sterling ', 'GBP');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (50, 'Venezuela', 'Bolivar ', 1916.71, 'Venezuelan Bolivar ', 'VEB');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (51, 'Bahamas', 'Bahamian Dollar', 1.00, 'Bahamian Dollar', 'BSD');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (52, 'Croatia', 'Croatian Kuna', 6.16, 'Croatian Kuna', 'HRK');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (53, 'East Caribe', 'East Caribbean Dollar', 0.00, 'East Caribbean Dollar', 'XCD');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (54, 'CFA Franc (African Financial Community)', 'African Financial Community Franc', 0.00, 'African Financial Community Franc', 'CFA');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (55, 'Pacific Financial Community', 'Pacific Financial Community Franc', 0.00, 'Pacific Financial Community', 'CFP');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (56, 'Ghana', 'Ghanaian Cedi', 8978.29, 'Ghanaian Cedi', 'GHC');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (57, 'Honduras', 'Honduras Lempira', 0.00, 'Honduras Lempira', 'HNL');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (58, 'Hungaria', 'Hungarian Forint', 210.83, 'Hungarian Forint', 'HUF');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (59, 'Jamaica', 'Jamaican Dollar', 60.52, 'Jamaican Dollar', 'JMD');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (60, 'Burma', 'Myanmar (Burma) Kyat', 5.82, 'Myanmar (Burma) Kyat', 'MMK');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (61, 'Neth. Antilles', 'Neth. Antilles Guilder', 1.78, 'Neth. Antilles Guilder', 'ANG');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (62, 'Trinidad & Tobago', 'Trinidad & Tobago Dollar', 6.15, 'Trinidad & Tobago Dollar', 'TTD');
INSERT INTO `PHPAUCTIONXL_rates` VALUES (63, 'Canadian', 'Canadian Dollar', 1.31, 'Canadian Dollar', 'CAD');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_rememberme`
# 

CREATE TABLE `PHPAUCTIONXL_rememberme` (
  `userid` int(11) NOT NULL default '0',
  `hashkey` char(32) NOT NULL default ''
) ;

# 
# Dumping data for table `PHPAUCTIONXL_rememberme`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_settings`
# 

CREATE TABLE `PHPAUCTIONXL_settings` (
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
  `defaultlanguage` char(2) NOT NULL default '',
  `aboutme` enum('y','n') default 'n',
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
) ;

# 
# Dumping data for table `PHPAUCTIONXL_settings`
# 

INSERT INTO `PHPAUCTIONXL_settings` VALUES ('Phpauction GPL 3.0', 'http://172.26.0.10/phpauction-gpl-3.0/', 'PHPAUCTIONPREFIX', 1, 1, 5, 1, 2, 2, 'USD', 1, 'By clicking below you agree to the terms of this website.', 'webmaster@phpauction.org', 1, 1, 'l_gpl.gif', 0, 2, 30, 'USA', 'pay', 2, 0, 2, 0, 0, 0, 2, 0, 0, 'webmaster@phpauction.org', 'An unexpected error occurred. Please report to the administrator at ', 'youraddress@yourdomain.com', 2, 2, 1, 5, 100, 2, 1, 2, 'center', 12, 3, 90, 100, 4, 120, 8, 8, 8, 'y', 'y', 'n', 'y', 'Your About us text goes here', 'y', 'Your Terms and Conditions go here', 'n', 10, 16, 'y', 'n', 'United States', 2, 2, 1, 'y', 0, 'fix', 0, 'EN', 'n', 90, 'perc', 'n', 'n', 'Taxes', 'n', 'sb', '<B><FONT COLOR=red>No fees will be charged for this auction!!</FONT></B>', 'unique', 'alpha', 'n', '3.gif', '', '', '', 51200, 'logged', 'default', 20, 'n', 0, 'n', 'n', 'y', 'n', 30);

# ############################

# 
# Table structure for table `PHPAUCTIONXL_statssettings`
# 

CREATE TABLE `PHPAUCTIONXL_statssettings` (
  `activate` enum('y','n') NOT NULL default 'y',
  `accesses` enum('y','n') NOT NULL default 'y',
  `browsers` enum('y','n') NOT NULL default 'y',
  `domains` enum('y','n') NOT NULL default 'y'
) ;

# 
# Dumping data for table `PHPAUCTIONXL_statssettings`
# 

INSERT INTO `PHPAUCTIONXL_statssettings` VALUES ('n', 'y', 'y', 'y');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_tmp_closed_edited`
# 

CREATE TABLE `PHPAUCTIONXL_tmp_closed_edited` (
  `session` varchar(100) NOT NULL default '',
  `auction` int(32) NOT NULL default '0',
  `editdate` varchar(8) NOT NULL default '',
  `seller` int(32) NOT NULL default '0',
  `fee` enum('homefeatured','catfeatured','bold','highlighted','reserve') NOT NULL default 'homefeatured',
  `amount` double NOT NULL default '0',
  KEY `session` (`session`)
) ;

# 
# Dumping data for table `PHPAUCTIONXL_tmp_closed_edited`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_users`
# 

CREATE TABLE `PHPAUCTIONXL_users` (
  `id` int(32) NOT NULL auto_increment,
  `nick` varchar(20) default NULL,
  `password` varchar(32) default NULL,
  `name` tinytext,
  `address` tinytext,
  `city` varchar(25) default NULL,
  `prov` varchar(10) default NULL,
  `country` varchar(30) default NULL,
  `zip` varchar(6) default NULL,
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
) AUTO_INCREMENT=3 ;

# 
# Dumping data for table `PHPAUCTIONXL_users`
# 


# ############################

# 
# Table structure for table `PHPAUCTIONXL_usersettings`
# 

CREATE TABLE `PHPAUCTIONXL_usersettings` (
  `discount` double NOT NULL default '0',
  `banemail` text NOT NULL,
  `requested_fields` varchar(255) NOT NULL default '',
  `mandatory_fields` varchar(255) NOT NULL default ''
) ;

# 
# Dumping data for table `PHPAUCTIONXL_usersettings`
# 

INSERT INTO `PHPAUCTIONXL_usersettings` VALUES (0, '', 'a:6:{s:9:"birthdate";s:1:"y";s:7:"address";s:1:"y";s:4:"city";s:1:"y";s:4:"prov";s:1:"y";s:3:"zip";s:1:"y";s:3:"tel";s:1:"y";}', 'a:6:{s:9:"birthdate";s:1:"y";s:7:"address";s:1:"y";s:4:"city";s:1:"y";s:4:"prov";s:1:"y";s:3:"zip";s:1:"y";s:3:"tel";s:1:"y";}');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_usersips`
# 

CREATE TABLE `PHPAUCTIONXL_usersips` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(32) default NULL,
  `ip` varchar(15) default NULL,
  `type` enum('first','after') NOT NULL default 'first',
  `action` enum('accept','deny') NOT NULL default 'accept',
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=4 ;

# 
# Dumping data for table `PHPAUCTIONXL_usersips`
# 

INSERT INTO `PHPAUCTIONXL_usersips` VALUES (1, 0, '172.26.0.10', 'after', 'accept');
INSERT INTO `PHPAUCTIONXL_usersips` VALUES (2, 1, '172.26.0.10', 'first', 'accept');
INSERT INTO `PHPAUCTIONXL_usersips` VALUES (3, 2, '172.26.0.10', 'first', 'accept');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_userslanguage`
# 

CREATE TABLE `PHPAUCTIONXL_userslanguage` (
  `user` int(32) NOT NULL default '0',
  `language` char(2) NOT NULL default ''
) ;

# 
# Dumping data for table `PHPAUCTIONXL_userslanguage`
# 

INSERT INTO `PHPAUCTIONXL_userslanguage` VALUES (2, 'EN');
INSERT INTO `PHPAUCTIONXL_userslanguage` VALUES (1, 'EN');

# ############################

# 
# Table structure for table `PHPAUCTIONXL_winners`
# 

CREATE TABLE `PHPAUCTIONXL_winners` (
  `id` int(11) NOT NULL auto_increment,
  `auction` int(32) NOT NULL default '0',
  `seller` int(32) NOT NULL default '0',
  `winner` int(32) NOT NULL default '0',
  `bid` double NOT NULL default '0',
  `closingdate` timestamp ,
  `fee` double NOT NULL default '0',
  KEY `id` (`id`)
) AUTO_INCREMENT=1 ;

