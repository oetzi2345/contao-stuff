-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- 
-- Table `tl_module`
-- 
CREATE TABLE `tl_module` (
  `aeo_custom_template` varchar(32) NOT NULL default '',
  `aeo_show_info` char(1) NOT NULL default '',
  `aeo_info_text` mediumtext NULL,
  `aeo_disable` char(1) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Table `tl_content`
-- 
CREATE TABLE `tl_content` (
  `aeo_custom_template` varchar(32) NOT NULL default '',
  `aeo_show_info` char(1) NOT NULL default '',
  `aeo_info_text` mediumtext NULL,
  `aeo_disable` char(1) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
