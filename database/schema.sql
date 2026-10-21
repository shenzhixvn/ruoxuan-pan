/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `domeadmin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domeadmin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `adminUserId` int(11) DEFAULT NULL COMMENT '用户ID',
  `type` tinyint(4) DEFAULT NULL COMMENT '类型',
  `summary` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '摘要',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domeadmin_log_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domeadmin_log_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `content` text COLLATE utf8_unicode_ci COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domeadmin_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domeadmin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domeadmin_role_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domeadmin_role_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `roleId` int(10) unsigned DEFAULT NULL,
  `rule` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_role_rule_roleid_index` (`roleId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domeadmin_upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domeadmin_upload` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `userId` int(11) DEFAULT NULL COMMENT '用户ID',
  `category` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '大类',
  `dataId` int(11) DEFAULT NULL COMMENT '文件ID',
  `uploadCategoryId` int(11) DEFAULT NULL COMMENT '分类ID',
  PRIMARY KEY (`id`),
  KEY `admin_upload_uploadcategoryid_index` (`uploadCategoryId`),
  KEY `admin_upload_userid_category_index` (`userId`,`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domeadmin_upload_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domeadmin_upload_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `userId` int(11) DEFAULT NULL COMMENT '用户ID',
  `category` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '大类',
  `pid` int(11) DEFAULT NULL COMMENT '上级分类',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '名称',
  PRIMARY KEY (`id`),
  KEY `admin_upload_category_userid_category_index` (`userId`,`category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domeadmin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domeadmin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passwordSalt` char(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruleChanged` tinyint(1) DEFAULT NULL,
  `lastLoginTime` timestamp NULL DEFAULT NULL,
  `lastLoginIp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastChangePwdTime` timestamp NULL DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_user_username_unique` (`username`),
  UNIQUE KEY `admin_user_phone_unique` (`phone`),
  UNIQUE KEY `admin_user_email_unique` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domeadmin_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domeadmin_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `userId` int(10) unsigned DEFAULT NULL,
  `roleId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_user_role_userid_index` (`userId`),
  KEY `admin_user_role_roleid_index` (`roleId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domearticle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domearticle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '位置',
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '标题',
  `content` text COLLATE utf8_unicode_ci COMMENT '内容',
  `sort` int(11) DEFAULT NULL,
  `alias` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_alias_index` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domeatomic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domeatomic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `expire` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `atomic_name_unique` (`name`),
  KEY `atomic_expire_index` (`expire`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domebanner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domebanner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '位置',
  `sort` int(11) DEFAULT NULL COMMENT '顺序',
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图片',
  `link` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '链接',
  `type` tinyint(4) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slogan` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkText` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `colorReverse` tinyint(4) DEFAULT NULL,
  `video` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domeconfig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domeconfig` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `config_key_index` (`key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domedata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domedata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `category` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '大类',
  `path` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '路径',
  `filename` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '原始文件名',
  `size` int(10) unsigned NOT NULL,
  `driver` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '大类',
  `domain` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '域名',
  `md5` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `data_md5_index` (`md5`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domedata_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domedata_temp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `category` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '大类',
  `path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '原始文件名',
  `size` int(10) unsigned DEFAULT NULL COMMENT '文件大小',
  `md5` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `data_temp_category_path_index` (`category`,`path`),
  KEY `data_temp_md5_index` (`md5`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domelazy_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domelazy_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `key` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `param` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expire` int(11) DEFAULT NULL,
  `lifeExpire` int(11) DEFAULT NULL,
  `cacheSeconds` int(11) DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lazy_value_key_param_unique` (`key`,`param`),
  KEY `lazy_value_expire_index` (`expire`),
  KEY `lazy_value_lifeexpire_index` (`lifeExpire`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `memberUserId` int(11) DEFAULT NULL COMMENT '用户ID',
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '姓名',
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号',
  `area` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '省市地区',
  `detail` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '详细地址',
  `post` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮政编码',
  `isDefault` tinyint(4) DEFAULT NULL COMMENT '默认',
  PRIMARY KEY (`id`),
  KEY `member_address_userid_index` (`memberUserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_credit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_credit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `memberUserId` int(11) DEFAULT NULL COMMENT '用户ID',
  `total` int(11) DEFAULT NULL COMMENT '数量',
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_credit_memberuserid_unique` (`memberUserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_credit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_credit_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `memberUserId` int(11) DEFAULT NULL COMMENT '用户ID',
  `change` int(11) DEFAULT NULL COMMENT '金额',
  `remark` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `member_credit_log_memberuserid_index` (`memberUserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_deleted`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_deleted` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户名',
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机',
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '其他数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_favorite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `userId` int(11) DEFAULT NULL COMMENT '用户ID',
  `category` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '类别',
  `categoryId` int(11) DEFAULT NULL COMMENT '所属类别ID',
  PRIMARY KEY (`id`),
  KEY `member_favorite_userid_category_index` (`userId`,`category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '名称',
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '描述',
  `isDefault` tinyint(4) DEFAULT NULL COMMENT '默认',
  `showFront` tinyint(4) DEFAULT NULL COMMENT '前台显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `userId` int(11) DEFAULT NULL COMMENT '用户ID',
  `status` tinyint(4) DEFAULT NULL COMMENT '1未读 2已读',
  `fromId` int(11) DEFAULT NULL COMMENT '来源用户ID',
  `content` varchar(20000) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '消息内容(html)',
  PRIMARY KEY (`id`),
  KEY `member_message_userid_status_index` (`userId`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_money`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_money` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `memberUserId` int(11) DEFAULT NULL COMMENT '用户ID',
  `total` decimal(20,2) DEFAULT NULL COMMENT '金额',
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_money_memberuserid_unique` (`memberUserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_money_cash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_money_cash` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `memberUserId` int(11) DEFAULT NULL COMMENT '用户ID',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态',
  `money` decimal(20,2) DEFAULT NULL COMMENT '金额',
  `moneyAfterTax` decimal(20,2) DEFAULT NULL COMMENT '实际到账',
  `remark` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  `type` tinyint(4) DEFAULT NULL COMMENT '提现账号类型',
  `realname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '提现账号姓名',
  `account` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '提现账号',
  PRIMARY KEY (`id`),
  KEY `member_money_cash_memberuserid_index` (`memberUserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_money_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_money_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `memberUserId` int(11) DEFAULT NULL COMMENT '用户ID',
  `change` decimal(20,2) DEFAULT NULL COMMENT '金额',
  `remark` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `member_money_log_memberuserid_index` (`memberUserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_oauth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_oauth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `memberUserId` int(11) DEFAULT NULL COMMENT '用户ID',
  `type` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '类型',
  `openId` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'OpenId',
  `infoUsername` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `infoAvatar` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_oauth_type_openid_index` (`type`,`openId`),
  KEY `member_oauth_memberuserid_index` (`memberUserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_upload` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `userId` int(10) unsigned DEFAULT NULL COMMENT '用户ID',
  `category` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '大类',
  `dataId` int(10) unsigned DEFAULT NULL COMMENT '文件ID',
  `uploadCategoryId` int(11) DEFAULT NULL COMMENT '分类ID',
  PRIMARY KEY (`id`),
  KEY `member_upload_userid_uploadcategoryid_index` (`userId`,`uploadCategoryId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_upload_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_upload_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `userId` int(11) DEFAULT NULL COMMENT '用户ID',
  `category` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '大类',
  `pid` int(11) DEFAULT NULL COMMENT '上级分类',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '名称',
  PRIMARY KEY (`id`),
  KEY `member_upload_category_userid_index` (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户名',
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机',
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `password` char(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '密码',
  `passwordSalt` char(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '密码Salt',
  `lastLoginTime` timestamp NULL DEFAULT NULL COMMENT '上次登录时间',
  `lastLoginIp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '上次登录Ip',
  `phoneVerified` tinyint(1) DEFAULT NULL COMMENT '手机已验证',
  `emailVerified` tinyint(1) DEFAULT NULL COMMENT '邮箱已验证',
  `avatar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '头像(小)',
  `avatarMedium` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '头像(中)',
  `avatarBig` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '头像(大)',
  `gender` tinyint(4) DEFAULT NULL COMMENT '性别',
  `realname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '真实姓名',
  `signature` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '个性签名',
  `vipId` int(11) DEFAULT NULL,
  `vipExpire` date DEFAULT NULL,
  `nickname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `groupId` int(11) DEFAULT NULL,
  `deleteAtTime` bigint(20) DEFAULT NULL COMMENT '已删除',
  `isDeleted` tinyint(4) DEFAULT NULL COMMENT '已删除',
  `panSizeLimit` bigint(20) DEFAULT NULL,
  `panSizeUsed` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_user_username_index` (`username`),
  KEY `member_user_phone_index` (`phone`),
  KEY `member_user_email_index` (`email`),
  KEY `member_user_nickname_index` (`nickname`),
  KEY `member_user_deleteattime_index` (`deleteAtTime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_vip_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_vip_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `memberUserId` int(11) DEFAULT NULL COMMENT '排序',
  `vipId` int(11) DEFAULT NULL,
  `payFee` decimal(20,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '默认',
  `expire` date DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemember_vip_set`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemember_vip_set` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '名称',
  `flag` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '标识',
  `pid` int(11) DEFAULT NULL COMMENT '排序',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `isDefault` tinyint(4) DEFAULT NULL COMMENT '默认',
  `icon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图标',
  `price` decimal(20,2) DEFAULT NULL,
  `vipDays` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domemigrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domemigrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domenav`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domenav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '位置',
  `sort` int(11) DEFAULT NULL COMMENT '顺序',
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图片',
  `link` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '链接',
  `openType` tinyint(4) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL COMMENT '上级ID',
  `enable` tinyint(4) DEFAULT NULL COMMENT '启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domepan_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domepan_file` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `hash` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `useCount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pan_file_hash_unique` (`hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domepan_file_recycle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domepan_file_recycle` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `memberUserId` int(11) DEFAULT NULL,
  `entry` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `memberFileId` bigint(20) DEFAULT NULL,
  `deleteTime` datetime DEFAULT NULL,
  `deleteBatchNum` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pan_file_recycle_deletebatchnum_unique` (`deleteBatchNum`),
  KEY `pan_file_recycle_memberuserid_index` (`memberUserId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domepan_member_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domepan_member_file` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `memberUserId` int(11) DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `fileId` bigint(20) DEFAULT NULL,
  `fileName` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ext` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `isDir` tinyint(4) DEFAULT NULL,
  `uploadTime` datetime DEFAULT NULL,
  `deleteTime` datetime DEFAULT NULL,
  `deleteBatchNum` bigint(20) DEFAULT NULL,
  `isDeleted` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pan_member_file_memberuserid_pid_filename_unique` (`memberUserId`,`pid`,`fileName`),
  KEY `pan_member_file_memberuserid_index` (`memberUserId`),
  KEY `pan_member_file_deletebatchnum_index` (`deleteBatchNum`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `domepan_share`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domepan_share` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `memberUserId` int(11) DEFAULT NULL,
  `alias` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shareTime` datetime DEFAULT NULL,
  `expireTime` datetime DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `fileIds` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pan_share_alias_unique` (`alias`),
  KEY `pan_share_memberuserid_index` (`memberUserId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

