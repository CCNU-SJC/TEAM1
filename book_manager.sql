CREATE DATABASE book_manager;

-- 表的结构 `admin`

CREATE TABLE `admin` (
  `admin_id` int(10) PRIMARY KEY AUTO_INCREMENT,
  `admin_name` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 表的结构 `apply`

CREATE TABLE `apply` (
  `id` int(10) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `apply_type` varchar(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `approval_state` varchar(10) NOT NULL,
  `apply_time` datetime NOT NULL,
  `reason` text,
  `operate_time` datetime DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `book_info`
--

CREATE TABLE `book_info` (
  `book_id` int(10) PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `author` varchar(30) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `press` varchar(50) NOT NULL,
  `introduction` text NOT NULL,
  `state` varchar(10) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `reader`
--

CREATE TABLE `reader` (
  `user_id` int(10) PRIMARY KEY AUTO_INCREMENT,
  `user_name` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `register_day` date NOT NULL,
  `user_state` tinyint(1) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user_record`
--

CREATE TABLE `user_record` (
  `id` int(10) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `author` varchar(30) NOT NULL,
  `borrow_time` int(11) NOT NULL,
  `return_time` int(11) NOT NULL ,
  FOREIGN KEY (id) REFERENCES reader(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


