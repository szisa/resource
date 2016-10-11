DROP TABLE IF EXISTS `isa_res_info`;
CREATE TABLE `isa_res_info` (
  `id`       INT  NOT NULL AUTO_INCREMENT  COMMENT '资源ID，自增长',
  `name`     VARCHAR(100)  NOT NULL        COMMENT '资源名称',
  `subject`  INT           DEFAULT NULL    COMMENT '资源分类',
  `tags`     VARCHAR(100)  DEFAULT NULL    COMMENT '资源标签，逗号隔开',
  `desc`     text          DEFAULT NULL    COMMENT '资源描述',
  `creator`  VARCHAR(50)   DEFAULT NULL    COMMENT '发布者',
  `createdate` DATETIME    DEFAULT NULL    COMMENT '访问日期',
  `valid`    INT           DEFAULT 1       COMMENT '是否有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `isa_res_link`;
CREATE TABLE `isa_res_link` (
  `id`       INT  NOT NULL AUTO_INCREMENT  COMMENT '资源下载链接ID，自增长',
  `resId`    INT  NOT NULL                 COMMENT '资源ID',
  `source`   VARCHAR(100)  NOT NULL        COMMENT '来源名称，作为网页上链接名称，如百度网盘',
  `resLink`  VARCHAR(500)  DEFAULT NULL    COMMENT '资源链接',
  `extCode`  VARCHAR(10)   DEFAULT NULL    COMMENT '提取码',
  `valid`    INT           DEFAULT 1       COMMENT '是否有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `isa_res_type`;
CREATE TABLE `isa_res_type` (
  `id`       INT  NOT NULL AUTO_INCREMENT  COMMENT '资源类型ID，自增长',
  `name`     VARCHAR(100)  NOT NULL        COMMENT '类型名称',
  `valid`    INT           DEFAULT 1       COMMENT '是否有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `isa_res_base`;
CREATE TABLE `isa_res_base` (
  `key`      VARCHAR(50)   NOT NULL        COMMENT '网站基本信息键',
  `value`    VARCHAR(200)  NOT NULL        COMMENT '网站基本信息值',
  `desc`     VARCHAR(200)  NOT NULL        COMMENT '网站基本信息描述',
  `valid`    INT           DEFAULT 1       COMMENT '是否有效'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;

INSERT INTO `isa_res_base` (`key`, `value`, `desc`)
VALUES  ('adminUser', 'root', '管理员账号');
INSERT INTO `isa_res_base` (`key`, `value`, `desc`)
VALUES  ('adminPwd', '1111111', '管理员密码');

-- 创建保存基本配置存储过程
DELIMITER //
CREATE PROCEDURE SetBase (
  IN KEYNAME VARCHAR(50) charset utf8,
  IN KEYVALUE VARCHAR(200) charset utf8
)
  BEGIN
    BEGIN
      IF EXISTS(SELECT * FROM `isa_res_base` WHERE `key` = KEYNAME) THEN
        UPDATE `isa_res_base` SET `value` = KEYVALUE, `valid` = 1
        WHERE `key` = KEYNAME;
      ELSE
        INSERT INTO `isa_res_base` (`key`, `value`, `valid`)
        VALUES(KEYNAME, KEYVALUE, 1);
      END IF;
    END;
  END//
DELIMITER ;