# Database : `zenosaga_zenosaga`
# --------------------------------------------------------

#
# Table structure for table `ehq_admin`
#

CREATE TABLE ehq_admin (
  logID int(11) unsigned NOT NULL auto_increment,
  userid int(11) NOT NULL default '0',
  username varchar(50) NOT NULL default '',
  host varchar(255) NOT NULL default '',
  ip varchar(15) NOT NULL default '',
  KEY logID (logID)
) TYPE=MyISAM COMMENT='EHQ''s Admin, "last log in" table';

#
# Table structure for table `ehq_affils`
#

CREATE TABLE ehq_affils (
  affiilID tinyint(2) unsigned zerofill NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  url varchar(255) NOT NULL default '',
  type varchar(255) NOT NULL default '',
  summary text NOT NULL,
  owner varchar(25) NOT NULL default '',
  email varchar(255) NOT NULL default '',
  image varchar(8) NOT NULL default '',
  PRIMARY KEY  (affiilID),
  KEY affiilID (affiilID)
) TYPE=MyISAM COMMENT='Official Affiliates';

#
# Table structure for table `ehq_affils_recommend`
#

CREATE TABLE ehq_affils_recommend (
  affiilID tinyint(1) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  url varchar(255) NOT NULL default '',
  type varchar(255) NOT NULL default '',
  summary text NOT NULL,
  owner varchar(25) NOT NULL default '',
  email varchar(255) NOT NULL default '',
  PRIMARY KEY  (affiilID),
  KEY affiilID (affiilID)
) TYPE=MyISAM COMMENT='Recommended sites';

#
# Table structure for table `ehq_ban_agents`
#

CREATE TABLE ehq_ban_agents (
  eID int(11) NOT NULL auto_increment,
  agentname varchar(255) NOT NULL default '',
  fullname varchar(255) NOT NULL default '',
  KEY eID (eID)
) TYPE=MyISAM COMMENT='EHQ Banned E-mail Addresses';

#
# Table structure for table `ehq_ban_email`
#

CREATE TABLE ehq_ban_email (
  eID int(11) NOT NULL auto_increment,
  domain varchar(255) NOT NULL default '',
  KEY eID (eID)
) TYPE=MyISAM COMMENT='EHQ Banned E-mail Addresses';

#
# Table structure for table `ehq_ban_host`
#

CREATE TABLE ehq_ban_host (
  banID int(11) NOT NULL auto_increment,
  hostname varchar(255) NOT NULL default '',
  username varchar(50) NOT NULL default '',
  reason varchar(255) NOT NULL default '',
  KEY banID (banID)
) TYPE=MyISAM COMMENT='EHQ Banned host';

#
# Table structure for table `ehq_ban_ip`
#

CREATE TABLE ehq_ban_ip (
  banID int(11) NOT NULL auto_increment,
  ipaddress varchar(16) NOT NULL default '0',
  username varchar(50) NOT NULL default '',
  reason text NOT NULL,
  PRIMARY KEY  (banID),
  KEY banID (banID)
) TYPE=MyISAM COMMENT='Banned IP Addresses';

#
# Table structure for table `ehq_bookmark`
#

CREATE TABLE ehq_bookmark (
  bid int(11) NOT NULL auto_increment,
  userid int(11) NOT NULL default '0',
  username varchar(255) NOT NULL default '',
  descript varchar(255) NOT NULL default '',
  url varchar(255) NOT NULL default '',
  PRIMARY KEY  (bid),
  KEY userid (userid),
  KEY bid (bid)
) TYPE=MyISAM COMMENT='Bookmark table';
#
# Table structure for table `ehq_changelog`
#

CREATE TABLE ehq_changelog (
  logID int(11) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  date date NOT NULL default '0000-00-00',
  major text NOT NULL,
  minor text NOT NULL,
  status enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (logID),
  KEY logID (logID)
) TYPE=MyISAM COMMENT='EHQ Change Logs';

#
# Table structure for table `ehq_contest`
#

CREATE TABLE ehq_contest (
  cID tinyint(3) unsigned zerofill NOT NULL auto_increment,
  start date NOT NULL default '0000-00-00',
  end date NOT NULL default '0000-00-00',
  title varchar(25) NOT NULL default '',
  short_desc varchar(250) NOT NULL default '',
  details text NOT NULL,
  status enum('0','1') NOT NULL default '0',
  winner int(11) NOT NULL default '0',
  added date NOT NULL default '0000-00-00',
  price float(4,2) NOT NULL default '0.00',
  KEY cID (cID)
) TYPE=MyISAM COMMENT='EHQ''s contests';

#
# Table structure for table `ehq_directory`
#

CREATE TABLE ehq_directory (
  dID tinyint(2) unsigned NOT NULL auto_increment,
  image varchar(255) NOT NULL default '',
  links varchar(255) NOT NULL default '',
  title varchar(255) NOT NULL default '',
  PRIMARY KEY  (dID),
  KEY dID (dID)
) TYPE=MyISAM COMMENT='Main directory assembly and links';

#
# Table structure for table `ehq_download`
#

CREATE TABLE ehq_download (
  dID varchar(5) NOT NULL default '0',
  episode tinyint(4) NOT NULL default '0',
  filename varchar(255) NOT NULL default '',
  title varchar(255) NOT NULL default '',
  descript text NOT NULL,
  type tinyint(1) NOT NULL default '0',
  added date NOT NULL default '0000-00-00',
  added_by varchar(255) NOT NULL default '',
  author varchar(255) NOT NULL default '',
  published date NOT NULL default '0000-00-00',
  email varchar(255) NOT NULL default '',
  counter int(11) NOT NULL default '0',
  recommend tinyint(1) NOT NULL default '0',
  status enum('0','1') NOT NULL default '0',
  downloadable enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (dID),
  KEY dID (dID)
) TYPE=MyISAM COMMENT='Zenosaga file download table';


#
# Table structure for table `ehq_download_log`
#

CREATE TABLE ehq_download_log (
  logID int(11) NOT NULL auto_increment,
  userID int(11) NOT NULL default '0',
  username varchar(50) NOT NULL default '',
  dID int(11) NOT NULL default '0',
  date varchar(255) NOT NULL default '',
  IP varchar(15) NOT NULL default '',
  PRIMARY KEY  (logID),
  KEY logID (logID),
  KEY userID (userID)
) TYPE=MyISAM COMMENT='Download log';

#
# Table structure for table `ehq_faq`
#

CREATE TABLE ehq_faq (
  faqID mediumint(8) unsigned NOT NULL auto_increment,
  catID enum('1','2','3','4','5') NOT NULL default '1',
  question text NOT NULL,
  faq text NOT NULL,
  added_by int(11) NOT NULL default '1',
  ipaddress varchar(255) NOT NULL default '',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  KEY faqID (faqID)
) TYPE=MyISAM COMMENT='EHQ''s FAQ';

#
# Table structure for table `ehq_faq_cat`
#

CREATE TABLE ehq_faq_cat (
  catID smallint(5) unsigned NOT NULL auto_increment,
  descript varchar(255) NOT NULL default '',
  summary text NOT NULL,
  KEY catID (catID)
) TYPE=MyISAM COMMENT='EHQ''s FAQ Categories';

#
# Table structure for table `ehq_gs_category`
#

CREATE TABLE ehq_gs_category (
  cID tinyint(4) NOT NULL default '0',
  title varchar(20) NOT NULL default '',
  status tinyint(4) NOT NULL default '0',
  KEY cID (cID)
) TYPE=MyISAM COMMENT='Giftshop''s category chart';

#
# Table structure for table `ehq_gs_category_s`
#

CREATE TABLE ehq_gs_category_s (
  cID tinyint(1) NOT NULL default '0',
  scID tinyint(1) NOT NULL default '0',
  descript varchar(255) NOT NULL default '',
  long_descript varchar(255) NOT NULL default '',
  KEY cID (cID),
  KEY scID (scID)
) TYPE=MyISAM;

#
# Table structure for table `ehq_gs_episode`
#

CREATE TABLE ehq_gs_episode (
  eID tinyint(1) NOT NULL default '0',
  title varchar(14) NOT NULL default '',
  KEY eID (eID)
) TYPE=MyISAM COMMENT='Giftshop''s episode chart';

#
# Table structure for table `ehq_gs_items`
#

CREATE TABLE ehq_gs_items (
  itemID int(10) unsigned NOT NULL default '0',
  cID tinyint(1) NOT NULL default '0',
  eID tinyint(1) NOT NULL default '0',
  scID tinyint(1) NOT NULL default '0',
  item varchar(255) NOT NULL default '',
  descript text NOT NULL,
  price varchar(20) NOT NULL default '0.00',
  ourprice varchar(6) NOT NULL default '',
  author varchar(25) NOT NULL default '',
  date tinyint(1) NOT NULL default '0',
  month tinyint(2) NOT NULL default '0',
  year int(4) NOT NULL default '0',
  isbn varchar(255) NOT NULL default '',
  format varchar(255) NOT NULL default '',
  publisher varchar(255) NOT NULL default '',
  fromPub text NOT NULL,
  fromEdit text NOT NULL,
  avail varchar(255) NOT NULL default '',
  in_stock tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (itemID),
  KEY itemID (itemID),
  KEY cID (cID),
  KEY eID (eID),
  KEY scID (scID)
) TYPE=MyISAM COMMENT='Giftshop''s Item chart';

#
# Table structure for table `ehq_gs_reviews`
#

CREATE TABLE ehq_gs_reviews (
  rID int(10) unsigned NOT NULL auto_increment,
  uID int(11) NOT NULL default '0',
  itemID int(11) NOT NULL default '0',
  rate tinyint(1) NOT NULL default '0',
  short_title varchar(80) NOT NULL default '',
  review text NOT NULL,
  date varchar(25) NOT NULL default '',
  r_location varchar(255) NOT NULL default '',
  status tinyint(1) NOT NULL default '0',
  anon tinyint(4) NOT NULL default '0',
  approved_by varchar(50) NOT NULL default '',
  approved_date varchar(50) NOT NULL default '',
  PRIMARY KEY  (rID),
  KEY rID (rID),
  KEY uID (uID),
  KEY itemID (itemID)
) TYPE=MyISAM COMMENT='Giftshop''s reviews';

#
# Table structure for table `ehq_gs_reviews_helpful`
#

CREATE TABLE ehq_gs_reviews_helpful (
  reviewID int(11) NOT NULL default '0',
  userRID int(11) NOT NULL default '0',
  yes tinyint(4) NOT NULL default '0',
  no tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (reviewID),
  KEY reviewID (reviewID),
  KEY userRID (userRID)
) TYPE=MyISAM COMMENT='Helpful review table';

#
# Table structure for table `ehq_lib_artwork`
#

CREATE TABLE ehq_lib_artwork (
  artID int(11) NOT NULL auto_increment,
  userID int(11) NOT NULL default '0',
  cID tinyint(2) NOT NULL default '0',
  filename varchar(50) NOT NULL default '',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  title varchar(255) NOT NULL default '',
  rating enum('e','n','m') NOT NULL default 'e',
  ratereason enum('a','b','c','d','z') NOT NULL default 'a',
  descript text NOT NULL,
  forsale tinyint(1) NOT NULL default '0',
  copyright tinyint(1) NOT NULL default '0',
  credits varchar(255) NOT NULL default '',
  status enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (artID),
  KEY artID (artID),
  KEY userID (userID),
  KEY cID (cID)
) TYPE=MyISAM COMMENT='EHQ Art profiles';

#
# Table structure for table `ehq_lib_comment_art`
#

CREATE TABLE ehq_lib_comment_art (
  remID int(11) NOT NULL auto_increment,
  artID int(11) NOT NULL default '0',
  name varchar(25) NOT NULL default '',
  email varchar(50) NOT NULL default '',
  comment text NOT NULL,
  public tinyint(1) NOT NULL default '1',
  ip varchar(16) NOT NULL default '',
  timestamp varchar(50) NOT NULL default '',
  KEY remID (remID),
  KEY artID (artID)
) TYPE=MyISAM;

#
# Table structure for table `ehq_lib_news`
#

CREATE TABLE ehq_lib_news (
  newsID int(11) NOT NULL auto_increment,
  date varchar(50) NOT NULL default '',
  userID int(11) NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  summary text NOT NULL,
  PRIMARY KEY  (newsID),
  KEY newsID (newsID),
  KEY userID (userID)
) TYPE=MyISAM COMMENT='EHQ Library news table';

#
# Table structure for table `ehq_lib_profile`
#

CREATE TABLE ehq_lib_profile (
  userID int(11) NOT NULL default '0',
  lastmodified varchar(50) NOT NULL default '',
  status tinyint(1) NOT NULL default '0',
  biography text NOT NULL,
  commission tinyint(1) NOT NULL default '0',
  KEY userID (userID)
) TYPE=MyISAM COMMENT='EHQ Library artist profile';

#
# Table structure for table `ehq_lib_sale`
#

CREATE TABLE ehq_lib_sale (
  artID int(11) NOT NULL default '0',
  userID int(11) NOT NULL default '0',
  saleinfo varchar(255) NOT NULL default '',
  KEY artID (artID)
) TYPE=MyISAM COMMENT='EHQ Library artwork sales table';

#
# Table structure for table `ehq_mailbag`
#

CREATE TABLE ehq_mailbag (
  msgID int(11) NOT NULL auto_increment,
  msgName varchar(50) NOT NULL default '',
  msgEmail varchar(255) NOT NULL default '',
  msgSubject varchar(50) NOT NULL default '',
  msgMessage text NOT NULL,
  msgDate date NOT NULL default '0000-00-00',
  msgIP varchar(15) default NULL,
  msgHost varchar(250) default NULL,
  mailbag enum('0','1') NOT NULL default '0',
  status tinyint(1) NOT NULL default '1',
  answered_on datetime NOT NULL default '0000-00-00 00:00:00',
  answered_by int(11) NOT NULL default '0',
  msgTime datetime default '0000-00-00 00:00:00',
  response text,
  PRIMARY KEY  (msgID),
  KEY msgID (msgID)
) TYPE=MyISAM COMMENT='Mailbag catalogue';

#
# Table structure for table `ehq_maxusers`
#

CREATE TABLE ehq_maxusers (
  maxID char(1) NOT NULL default '',
  date varchar(25) NOT NULL default '0000-00-00',
  users mediumint(9) NOT NULL default '0'
) TYPE=MyISAM COMMENT='EHQ''s Max user table';

#
# Table structure for table `ehq_news`
#

CREATE TABLE ehq_news (
  newsID int(10) unsigned NOT NULL auto_increment,
  multi tinyint(1) NOT NULL default '0',
  type varchar(4) NOT NULL default 'News',
  date date NOT NULL default '2001-05-21',
  time varchar(8) NOT NULL default '',
  timezone varchar(25) NOT NULL default 'PST',
  author varchar(255) NOT NULL default 'Zenosaga.com Staff',
  title varchar(255) NOT NULL default '',
  summary text NOT NULL,
  story text NOT NULL,
  source varchar(255) default NULL,
  sourceURL text,
  sourceEXTRA varchar(255) NOT NULL default '',
  relatedLINKS text NOT NULL,
  threadid int(11) default NULL,
  image text NOT NULL,
  caption text NOT NULL,
  nl2br enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (newsID),
  KEY newsID (newsID)
) TYPE=MyISAM COMMENT='News headlines table';

#
# Table structure for table `ehq_news_fr`
#

CREATE TABLE ehq_news_fr (
  newsID int(10) unsigned NOT NULL auto_increment,
  multi tinyint(1) NOT NULL default '0',
  type varchar(4) NOT NULL default 'News',
  date date NOT NULL default '2001-05-21',
  time varchar(8) NOT NULL default '',
  timezone varchar(25) NOT NULL default 'PST',
  author varchar(255) NOT NULL default 'Zenosaga.com Staff',
  title varchar(255) NOT NULL default '',
  summary text NOT NULL,
  story text NOT NULL,
  source varchar(255) default NULL,
  sourceURL text,
  sourceEXTRA varchar(255) NOT NULL default '',
  relatedLINKS text NOT NULL,
  threadid int(11) default NULL,
  image text NOT NULL,
  caption text NOT NULL,
  PRIMARY KEY  (newsID),
  KEY newsID (newsID)
) TYPE=MyISAM COMMENT='News headlines table';

#
# Table structure for table `ehq_news_multi`
#

CREATE TABLE ehq_news_multi (
  newsID int(10) NOT NULL default '0',
  pg tinyint(2) NOT NULL default '0',
  story text NOT NULL,
  KEY newsID (newsID)
) TYPE=MyISAM COMMENT='Multi-paged news articles';

#
# Table structure for table `ehq_pref`
#

CREATE TABLE ehq_pref (
  userid int(10) unsigned NOT NULL auto_increment,
  username varchar(50) NOT NULL default '',
  lang char(2) default 'en',
  toplogo char(2) NOT NULL default '0',
  mainlogo varchar(8) default 'bg_main5',
  archivenews int(11) default '3',
  headlines tinyint(1) default '3',
  subsite int(11) default '4000',
  images_wt tinyint(1) default '1',
  images_best tinyint(1) default '1',
  color varchar(10) default 'blue',
  timezoneoffset int(2) NOT NULL default '-8',
  PRIMARY KEY  (userid),
  KEY userid (userid)
) TYPE=MyISAM COMMENT='Registered users preference and settings';

#
# Table structure for table `ehq_pw_chap`
#

CREATE TABLE ehq_pw_chap (
  chapID tinyint(1) NOT NULL auto_increment,
  descript varchar(17) NOT NULL default '',
  active tinyint(1) NOT NULL default '0',
  complete tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (chapID),
  KEY chapid (chapID),
  KEY chapID_2 (chapID)
) TYPE=MyISAM COMMENT='Perfect Works chapter summary';

#
# Table structure for table `ehq_pw_dnld`
#

CREATE TABLE ehq_pw_dnld (
  userID int(11) NOT NULL default '0',
  username varchar(50) NOT NULL default '',
  count tinyint(20) NOT NULL default '0',
  date date default NULL,
  time_stamp int(11) default NULL,
  ipaddress varchar(15) NOT NULL default '',
  host varchar(250) default NULL,
  agent varchar(250) default NULL
) TYPE=MyISAM COMMENT='Perfect Works download log';

#
# Table structure for table `ehq_pw_page`
#

CREATE TABLE ehq_pw_page (
  pageID smallint(255) unsigned NOT NULL default '0',
  credit varchar(255) NOT NULL default 'int',
  title varchar(100) NOT NULL default '',
  chapID tinyint(1) NOT NULL default '0',
  descript varchar(255) NOT NULL default '',
  KEY pageID (pageID),
  KEY chapID (chapID)
) TYPE=MyISAM COMMENT='PW page summaries';

#
# Table structure for table `ehq_quiknews`
#

CREATE TABLE ehq_quiknews (
  qID smallint(6) NOT NULL auto_increment,
  newsID mediumint(9) NOT NULL default '0',
  date date NOT NULL default '0000-00-00',
  news varchar(145) NOT NULL default '',
  author varchar(15) NOT NULL default '',
  PRIMARY KEY  (qID),
  KEY qID (qID),
  KEY newsID (newsID)
) TYPE=MyISAM COMMENT='Quick News table';

#
# Table structure for table `ehq_raziel`
#

CREATE TABLE ehq_raziel (
  CaseID tinyint(3) unsigned zerofill NOT NULL default '000',
  title varchar(255) NOT NULL default '',
  summary mediumtext NOT NULL,
  story text NOT NULL,
  author int(11) NOT NULL default '0',
  add_date date NOT NULL default '0000-00-00',
  approved enum('0','1') NOT NULL default '0',
  approved_date date NOT NULL default '0000-00-00',
  approved_by int(11) NOT NULL default '0',
  status enum('0','1') NOT NULL default '0',
  author_email varchar(50) NOT NULL default '',
  author_website varchar(250) NOT NULL default '',
  multipage enum('0','1') NOT NULL default '0',
  page_num tinyint(4) NOT NULL default '0'
) TYPE=MyISAM COMMENT='EHQ''s Raziel CENTRAL entries';


#
# Table structure for table `ehq_sol9k_category`
#

CREATE TABLE ehq_sol9k_category (
  eID tinyint(1) NOT NULL default '0',
  title varchar(15) NOT NULL default '',
  KEY eID (eID)
) TYPE=MyISAM;

#
# Table structure for table `ehq_sol9k_reference`
#

CREATE TABLE ehq_sol9k_reference (
  rID int(11) NOT NULL auto_increment,
  eID tinyint(4) NOT NULL default '5',
  title varchar(255) NOT NULL default '',
  reference text NOT NULL,
  mythology text NOT NULL,
  kana varchar(255) NOT NULL default '',
  kana_say varchar(255) NOT NULL default '',
  related varchar(255) NOT NULL default '',
  j_meaning varchar(255) NOT NULL default '',
  pronounce varchar(255) NOT NULL default '',
  PRIMARY KEY  (rID),
  KEY rID (rID),
  KEY eID (eID)
) TYPE=MyISAM;

#
# Table structure for table `ehq_staff`
#

CREATE TABLE ehq_staff (
  username varchar(25) NOT NULL default '',
  title varchar(25) NOT NULL default '',
  userid int(11) NOT NULL default '0',
  hobby varchar(255) NOT NULL default '',
  vidgames varchar(255) NOT NULL default '',
  quote text NOT NULL
) TYPE=MyISAM COMMENT='Zenosaga.com staff access level table';

#
# Table structure for table `ehq_subsite_updates`
#

CREATE TABLE ehq_subsite_updates (
  newsID int(11) NOT NULL auto_increment,
  date date NOT NULL default '0000-00-00',
  title varchar(25) NOT NULL default '',
  update text NOT NULL,
  timestamp int(11) NOT NULL default '0',
  status enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (newsID),
  KEY newsID (newsID)
) TYPE=MyISAM COMMENT='EHQ Subsite Updates';


CREATE TABLE ehq_tooltips (
  id int(11) NOT NULL auto_increment,
  tip varchar(255) NOT NULL default '',
  KEY id (id)
) TYPE=MyISAM COMMENT='EHQ''s Tooltips';

#
# Table structure for table `ehq_topheader`
#

CREATE TABLE ehq_topheader (
  hID tinyint(2) NOT NULL default '0',
  descript tinytext NOT NULL,
  KEY hID (hID)
) TYPE=MyISAM COMMENT='Top Header database for Preference page';

#
# Table structure for table `ehq_users`
#

CREATE TABLE ehq_users (
  userid int(10) unsigned NOT NULL auto_increment,
  username varchar(50) NOT NULL default '',
  password varchar(20) NOT NULL default '',
  email varchar(255) NOT NULL default '',
  pquestion varchar(255) NOT NULL default '0',
  panswer varchar(255) NOT NULL default '0',
  www varchar(255) default NULL,
  icq int(20) default NULL,
  aol varchar(200) default NULL,
  yahoo varchar(200) default NULL,
  bmonth int(2) NOT NULL default '0',
  bday int(2) unsigned NOT NULL default '0',
  byear int(4) unsigned NOT NULL default '0',
  bio varchar(255) default NULL,
  location varchar(255) default NULL,
  joindate date NOT NULL default '0000-00-00',
  interest varchar(255) default NULL,
  job varchar(255) default NULL,
  gender enum('M','F') NOT NULL default 'M',
  ipaddress varchar(50) NOT NULL default '0',
  lastvisit varchar(255) NOT NULL default '0',
  userhash varchar(30) NOT NULL default '0',
  admin tinyint(2) default '0',
  confirm tinyint(1) NOT NULL default '0',
  disabled tinyint(4) NOT NULL default '0',
  probation enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (userid),
  KEY userid (userid)
) TYPE=MyISAM;

#
# Table structure for table `ehq_users_bypass`
#

CREATE TABLE ehq_users_bypass (
  userid int(11) NOT NULL default '0',
  username varchar(25) NOT NULL default ''
) TYPE=MyISAM COMMENT='EHQ User Ban Bypass';

#
# Table structure for table `ehq_vip`
#

CREATE TABLE ehq_vip (
  userID int(11) NOT NULL default '0',
  username varchar(25) NOT NULL default '',
  level tinyint(2) NOT NULL default '0'
) TYPE=MyISAM COMMENT='EHQ''s VIP Pass';


#
# Table structure for table `ehq_xenocards`
#

CREATE TABLE ehq_xenocards (
  cardID varchar(6) NOT NULL default '',
  type enum('0','1','2','3','4','5','6','7','8','9') NOT NULL default '1',
  title varchar(50) NOT NULL default '',
  summary mediumtext NOT NULL,
  KEY cardID (cardID)
) TYPE=MyISAM COMMENT='EHQ Xenocard database';

