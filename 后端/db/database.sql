-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2020-10-10 22:08:21
-- 服务器版本： 5.6.48-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyclub`
--

-- --------------------------------------------------------

--
-- 表的结构 `fy_admin`
--

CREATE TABLE IF NOT EXISTS `fy_admin` (
  `id` int(11) NOT NULL COMMENT '管理员编号',
  `user` text NOT NULL COMMENT '管理员账号',
  `pass` text NOT NULL COMMENT '管理员密码（MD5）',
  `name` text NOT NULL COMMENT '管理员姓名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='飞扬后台管理账户';

--
-- 转存表中的数据 `fy_admin`
--

INSERT INTO `fy_admin` (`id`, `user`, `pass`, `name`) VALUES
(2020000000, 'root', '0000000000000000000000000000000', '2020系统所有者'),
(2020000001, 'pika', 'eb87e7115a52f83d4a7b08653e373d5f', '2020研发皮卡丘'),
(2020000002, '冷浩杰', '5b70803a12dea85db39989b2b10b318b', '2020维修冷浩杰'),
(2020000003, '唐琦', 'afdec7005cc9f14302cd0474fd0f3c96', '2020研发部唐琦'),
(2020000004, '罗杰惠', '9c1c073ac3bd05a1520ff8c337c14cf7', '2020维修罗杰惠');

-- --------------------------------------------------------

--
-- 表的结构 `fy_confs`
--

CREATE TABLE IF NOT EXISTS `fy_confs` (
  `id` int(11) NOT NULL COMMENT '编号',
  `name` text NOT NULL COMMENT '数据名称',
  `info` text NOT NULL COMMENT '注释',
  `data` text NOT NULL COMMENT '数据'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='飞扬报修核心配置';

--
-- 转存表中的数据 `fy_confs`
--

INSERT INTO `fy_confs` (`id`, `name`, `info`, `data`) VALUES
(0, 'Global_Flag', '全局报修开关', '1'),
(1, 'Global_Year', '全局年份时间', '2020'),
(2, 'Global_Tips', '全局公告内容', '1.送修前请移除电源外其余外设配件\r\n\r\n（包括鼠标 接收器 U盘 内存卡等）\r\n\r\n2.如要更换配件，请提前购买准备好\r\n\r\n3.如需重装系统，送修前电脑充满电\r\n\r\n4.请备份好数据，不对丢失数据负责\r\n\r\n5.我们不是万能，不保证一定能修好\r\n'),
(3, 'Global_Days', '每天提交限额', '20'),
(4, 'Global_Week', '每周提交限额', '90'),
(5, 'Global_Mont', '每月提交限额', '240'),
(6, 'Global_Time', '全局超时时间', '10'),
(7, 'Limits_Days', '用户每天限额', '10'),
(8, 'Limits_Week', '用户每周限额', '40');

-- --------------------------------------------------------

--
-- 表的结构 `fy_datas`
--

CREATE TABLE IF NOT EXISTS `fy_datas` (
  `id` int(11) NOT NULL COMMENT '编号',
  `name` text NOT NULL,
  `data` int(11) NOT NULL COMMENT '数据',
  `info` text NOT NULL COMMENT '注释'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='飞扬维修统计数据';

--
-- 转存表中的数据 `fy_datas`
--

INSERT INTO `fy_datas` (`id`, `name`, `data`, `info`) VALUES
(0, 'flag', 0, '0-正常  1-已满 2-会员'),
(1, 'total_num', 0, '总共报修-所有'),
(2, 'month_num', 0, '本月报修-所有'),
(3, 'order_am1', 0, '本周报修-会员'),
(4, 'order_am2', 0, '本周报修-游客'),
(5, 'order_vip', 0, '今日报修-会员'),
(6, 'order_nop', 0, '今日报修-游客'),
(7, 'id_user', 1, '总共数据-用户'),
(8, 'id_staf', 1, '总共数据-职员'),
(9, 'id_orde', 0, '总共数据-订单'),
(10, 'id_info', 3, '总共数据-问题'),
(11, 'wa1', 0, '周一-会员'),
(12, 'wa2', 0, '周二-会员'),
(13, 'wa3', 0, '周三-会员'),
(14, 'wa4', 0, '周四-会员'),
(15, 'wa5', 0, '周五-会员'),
(16, 'wa6', 0, '周六-会员'),
(17, 'wa7', 0, '周天-会员'),
(18, 'id_vips', 1, '总共数据-会员'),
(19, 'id_feed', 0, '总共数据-反馈'),
(20, 'id_admi', 4, '总共数据-管理'),
(21, 'wb1', 0, '周一-游客'),
(22, 'wb2', 0, '周二-游客'),
(23, 'wb3', 0, '周三-游客'),
(24, 'wb4', 0, '周四-游客'),
(25, 'wb5', 0, '周五-游客'),
(26, 'wb6', 0, '周六-游客'),
(27, 'wb7', 0, '周天-游客'),
(28, 'reserved', 0, '系统操作计数'),
(29, 'reserved', 0, '系统操作计数');

-- --------------------------------------------------------

--
-- 表的结构 `fy_feeds`
--

CREATE TABLE IF NOT EXISTS `fy_feeds` (
  `fkid` int(11) NOT NULL,
  `urid` int(11) NOT NULL COMMENT '反馈用户',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '反馈时间',
  `pnum` text NOT NULL COMMENT '手机号码',
  `name` text NOT NULL COMMENT '反馈用户',
  `text` text NOT NULL COMMENT '消息文本'
) ENGINE=InnoDB AUTO_INCREMENT=2020000014 DEFAULT CHARSET=utf8 COMMENT='飞扬技术问题反馈';

--
-- 转存表中的数据 `fy_feeds`
--

INSERT INTO `fy_feeds` (`fkid`, `urid`, `time`, `pnum`, `name`, `text`) VALUES
(2020000000, 2020000000, '2020-01-01 00:00:00', '10000000000', '系统', '默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容默认反馈内容');

-- --------------------------------------------------------

--
-- 表的结构 `fy_infos`
--

CREATE TABLE IF NOT EXISTS `fy_infos` (
  `ssid` int(8) NOT NULL COMMENT '搜索编号',
  `urid` int(8) NOT NULL COMMENT '作者编号',
  `twid` int(8) NOT NULL COMMENT '提问编号',
  `good` int(8) NOT NULL DEFAULT '0' COMMENT '点赞数量',
  `ansd` int(1) NOT NULL DEFAULT '0' COMMENT '是否回答',
  `cont` text COMMENT '关联问题',
  `tips` text COMMENT '关键内容',
  `wzbt` text NOT NULL,
  `text` text COMMENT '消息文本',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '编写时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='飞扬技术问题查找';

--
-- 转存表中的数据 `fy_infos`
--

INSERT INTO `fy_infos` (`ssid`, `urid`, `twid`, `good`, `ansd`, `cont`, `tips`, `wzbt`, `text`, `date`) VALUES
(2020000001, 2020000000, 2020000000, 46, 1, NULL, NULL, '电脑黑屏了怎么办', '电脑黑屏是一个很复杂问题\n需要按照下面的步骤进行判断状况：\nA.电脑在使用中黑屏，或休眠之后唤醒黑屏：\n  1.移动鼠标看是否有指针可见\n      如果可见，按【软件错误】处理，否则继续\n  2.大小写和小数字锁定键，看有无反应\n      如果可见，按【休眠故障】处理，否则继续\n  3.侧面看显示屏看是否有光\n      如果可见，仍【休眠故障】处理\n  以上均无反应或者不可见，按照B情况处理\nB.电脑在冷关机(长按电源之后），开机黑屏\n  1.开机之后进桌面才黑屏，按【软件错误】\n  2.进入系统(转圈圈或者win的logo)黑屏，按【系统错误】处理\n  3.按下开机键有logo有显示，但无法显示Windows的图标或者没有win10的转圈圈，并且没有显示【光标】以及【其他文字报错】此时按照【自检3不过】处理\n  4.第三步如果显示了光标或者无法开机的错误，此时按照【引导错误】处理\n  5.如果没有logo，按下面步骤判断：\n     a.笔记本拔出电池和主板纽扣电池\n        (台式机跳过）\n     b.连接外置键盘\n     c.上电开机\n  会有这几种情况：\n     1）正常开机了，那么是【电源/电池故障】\n     2）黑屏，键盘大写和小数字键无响应，按照【自检1不过】处理\n     3）以上情况都不是，按【自检2不过】处理\n\n【软件错误】\n同时按下ctrl+alt+del按键，选择任务管理器，左上角新建任务，输入explorer回车\n【休眠错误】\n请关闭休眠\n【系统错误】\n安全模式进入，看日志然后修复，或者重装\n【引导错误】\n检查硬盘是不是没了，确认没问题进pe修复\n【电源故障】\n换。\n【自检x不过】\n按最小系统原则，拆下除了cpu内存屏幕的设备，按下表逐一排查\n自检1-内存条 cpu pcie设备 南桥出错\n自检2-硬盘 外设 主板晶振 显卡 网卡 风扇\n自检3-硬盘 usb口 HDMI 纽扣电池/时钟', '2020-09-20 12:55:44'),
(2020000002, 2020000000, 2020000000, 19, 1, '', '', '电脑蓝屏了怎么办', '1.如果发现开机蓝屏时，先重新启动试试，还是蓝屏就在开机时出现小圆圈转圈就迅速不停按动F8键，在屏幕出来的界面选择[安全模式]并按[Enter]进入安全模式。  2.如果能进安全模式，说明软件有冲突或系统故障。这时只需重装个系统就行了。  3.如果进安全模式也蓝屏，可能是硬件有问题，这时就要打开机箱检查硬件了。  4.打开机箱如果有很多灰尘，有时蓝屏就是因为灰尘引起的，所以我们就先对机箱用毛刷或风机清理一下灰尘。  5.如果清过灰尘开机还蓝屏的话，下一步再取出内存，用橡皮擦擦一下内存的金手机。  6.如果以上方法还不能解决问题，有可能内存本身或都硬盘有问题，建议拿到更专业的电脑维修机构去检修了。', '2020-09-22 08:41:46'),
(2020000003, 2020000000, 2020000000, 8, 1, '', '', '开机无限重启怎么办', '1.开机时按F8在弹出Windows高级选项菜单，Windows高级选项菜单中，先尝试使用使用方向上下键移动到[最后一次正确的配置]，然后回车重启电脑，尝试是否能正常进入系统。2.如还是无法正常的进入系统，再次按F8进入Windows高级选项菜单，使用方向键移动到[禁用系统失败时自动重新启动]此项，回车确定，电脑自动重启。尝试是否可以正常进入系统？3.如果还是无法正常的进入系统，再次按F8进入Windows高级选项菜单，选择第一项[安全模式]回车进入系统。按以下操作。4.进入Windows安全模式之后，在桌面找到[我的电脑]并在我的电脑图标上右键属性，打开[系统属性]程序窗口,在系统属性窗口找到并单击切换到[高级]选项卡5.在高级选项卡找到[启动和故障恢复]下面的[设置]按扭。6.在打开的启动和故障恢复窗口中，把[自动重新启动]前面的勾去掉，然后确定。7.再次在桌面空白处，右键选择属性，打开[显示属性]程序窗口，在显示属性程序窗口中找到并单击切换到[屏幕保护程序]选项卡8.在屏幕保护程序选项卡中找到并单击[电源]按扭，操作方法如下图所示。9.在打开的电源选项属性设置窗口中，找到并单击切换到[高级]选项卡，在高级选项卡看下图设置并确定回到显示属性窗口再次确定，设置完毕之后重启电脑。', '2020-09-24 10:33:58');

-- --------------------------------------------------------

--
-- 表的结构 `fy_order`
--

CREATE TABLE IF NOT EXISTS `fy_order` (
  `tbid` int(8) NOT NULL COMMENT '订单编号',
  `urid` int(8) NOT NULL COMMENT '用户编号',
  `wxid` int(8) NOT NULL DEFAULT '20200000' COMMENT '技工编号',
  `flag` int(1) NOT NULL DEFAULT '0' COMMENT '状态-0未接-1已接-2完成-3放弃-4技术关闭-5-系统关闭',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `wcsj` datetime NOT NULL COMMENT '关闭时间',
  `jdsj` datetime NOT NULL COMMENT '接单时间',
  `gmsj` text NOT NULL COMMENT '购买时间',
  `pnum` text NOT NULL COMMENT '手机号码',
  `sbzl` text NOT NULL COMMENT '设备种类',
  `dnpp` text NOT NULL COMMENT '电脑品牌',
  `dnxh` text NOT NULL COMMENT '电脑型号',
  `wxsm` text NOT NULL COMMENT '维修说明',
  `wxtp` text NOT NULL COMMENT '维修图片',
  `bxzt` text NOT NULL COMMENT '保修状态',
  `gzlx` text NOT NULL COMMENT '故障类型',
  `qqid` text NOT NULL COMMENT 'QQ号码'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='飞扬维修订单查找';

--
-- 转存表中的数据 `fy_order`
--

INSERT INTO `fy_order` (`tbid`, `urid`, `wxid`, `flag`, `time`, `wcsj`, `jdsj`, `gmsj`, `pnum`, `sbzl`, `dnpp`, `dnxh`, `wxsm`, `wxtp`, `bxzt`, `gzlx`, `qqid`) VALUES
(2020000000, 2020000000, 2020000000, 5, '2000-01-01 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', '10000000000', '其他设备（Other）', '其他', '其他', '无', '0000000000000000', '0', '0', '0');

-- --------------------------------------------------------

--
-- 表的结构 `fy_stack`
--

CREATE TABLE IF NOT EXISTS `fy_stack` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `data` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `fy_staff`
--

CREATE TABLE IF NOT EXISTS `fy_staff` (
  `urid` int(11) NOT NULL,
  `wxid` int(11) NOT NULL COMMENT '技术编号',
  `last` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '上次时间',
  `next` int(11) NOT NULL DEFAULT '1' COMMENT '下次天数',
  `wxcs` int(11) NOT NULL COMMENT '维修次数',
  `aval` tinyint(1) NOT NULL COMMENT '允许接单：技术员设置0-停止 1-可用',
  `flag` int(1) NOT NULL COMMENT '可用标识,系统设置，0-停止 1-可用',
  `qqky` int(1) NOT NULL COMMENT '使用QQ',
  `qqid` text NOT NULL COMMENT 'QQ号码',
  `sets` int(1) NOT NULL COMMENT '自定参数',
  `tips` text NOT NULL COMMENT '备注内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `fy_staff`
--

INSERT INTO `fy_staff` (`urid`, `wxid`, `last`, `next`, `wxcs`, `aval`, `flag`, `qqky`, `qqid`, `sets`, `tips`) VALUES
(2020000000, 2020000000, '2020-01-01 00:00:00', 999, 0, 0, 0, 0, '000000000', 0, '系统默认维修'),
(2020000001, 2020000001, '2020-01-01 00:00:00', 999, 0, 0, 0, 1, '894662978', 0, '研发部皮卡丘');

-- --------------------------------------------------------

--
-- 表的结构 `fy_users`
--

CREATE TABLE IF NOT EXISTS `fy_users` (
  `id` int(11) NOT NULL COMMENT '用户编号',
  `pnum` bigint(11) DEFAULT NULL COMMENT '手机号码',
  `vips` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否会员',
  `fixs` tinyint(1) NOT NULL DEFAULT '0' COMMENT '技术人员',
  `seid` bigint(20) NOT NULL DEFAULT '0' COMMENT '会话编号',
  `bans` tinyint(1) NOT NULL DEFAULT '0' COMMENT '禁止报修',
  `name` text COMMENT '会员姓名',
  `code` text COMMENT '短信验证码',
  `mail` text COMMENT '邮件地址',
  `flag` int(1) NOT NULL DEFAULT '0' COMMENT '当前维修',
  `hyid` int(11) NOT NULL DEFAULT '0' COMMENT '会员编号',
  `wxid` int(11) NOT NULL DEFAULT '0' COMMENT '技术编号',
  `init` int(11) NOT NULL DEFAULT '0' COMMENT '是否初始化',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `txtp` text NOT NULL COMMENT '头像图片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='飞扬维修用户登录';

--
-- 转存表中的数据 `fy_users`
--

INSERT INTO `fy_users` (`id`, `pnum`, `vips`, `fixs`, `seid`, `bans`, `name`, `code`, `mail`, `flag`, `hyid`, `wxid`, `init`, `date`, `txtp`) VALUES
(2020000000, 10000000000, 1, 1, 0, 1, '未分配', '不可用', 'root@fyscu.com', 0, 2020000000, 2020000000, 1, '2019-12-31 16:00:00', '0.png'),
(2020000001, 15998977068, 1, 0, 0, 0, '皮卡丘', '已登录', 'pikachuim@qq.com', 0, 2020000001, 2020000001, 1, '2019-12-31 16:00:00', '0.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fy_admin`
--
ALTER TABLE `fy_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `fy_confs`
--
ALTER TABLE `fy_confs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `fy_datas`
--
ALTER TABLE `fy_datas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `fy_feeds`
--
ALTER TABLE `fy_feeds`
  ADD PRIMARY KEY (`fkid`);

--
-- Indexes for table `fy_infos`
--
ALTER TABLE `fy_infos`
  ADD PRIMARY KEY (`ssid`);

--
-- Indexes for table `fy_order`
--
ALTER TABLE `fy_order`
  ADD UNIQUE KEY `tbid` (`tbid`);

--
-- Indexes for table `fy_stack`
--
ALTER TABLE `fy_stack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fy_staff`
--
ALTER TABLE `fy_staff`
  ADD PRIMARY KEY (`wxid`),
  ADD UNIQUE KEY `wxid_2` (`wxid`),
  ADD KEY `wxid` (`wxid`);

--
-- Indexes for table `fy_users`
--
ALTER TABLE `fy_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fy_feeds`
--
ALTER TABLE `fy_feeds`
  MODIFY `fkid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2020000014;
--
-- AUTO_INCREMENT for table `fy_stack`
--
ALTER TABLE `fy_stack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=150;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
