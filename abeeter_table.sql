-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 6 月 04 日 06:24
-- サーバのバージョン： 10.4.19-MariaDB
-- PHP のバージョン: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsacf_l05_01`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `abeeter_table`
--

CREATE TABLE `abeeter_table` (
  `id` int(11) NOT NULL,
  `user_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abeet` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_time` datetime NOT NULL,
  `update_text` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `abeeter_table`
--

INSERT INTO `abeeter_table` (`id`, `user_name`, `abeet`, `sex`, `password`, `email`, `post_time`, `update_text`, `update_time`, `deleted`) VALUES
(28, 'sinzou', 'こんにちわ', 1, '$2y$10$2vbDSUJ6eVa8oS8x56/PSezW67pLV2jU5U32dAbCyGfYw9iDWLjli', 'sinzou@sinzou.com', '2021-06-04 13:22:16', NULL, NULL, 0),
(29, 'sinzou', 'こんにちわ', 1, '$2y$10$2vbDSUJ6eVa8oS8x56/PSezW67pLV2jU5U32dAbCyGfYw9iDWLjli', 'sinzou@sinzou.com', '2021-06-04 13:23:01', NULL, NULL, 0),
(30, 'sinzou', 'こんばんわ', 1, '$2y$10$2vbDSUJ6eVa8oS8x56/PSezW67pLV2jU5U32dAbCyGfYw9iDWLjli', 'sinzou@sinzou.com', '2021-06-04 13:23:10', NULL, NULL, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `abeeter_table`
--
ALTER TABLE `abeeter_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `abeeter_table`
--
ALTER TABLE `abeeter_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
