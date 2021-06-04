-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 6 月 04 日 06:40
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
-- テーブルの構造 `signUp_table`
--

CREATE TABLE `signUp_table` (
  `id` int(11) NOT NULL,
  `user_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` double NOT NULL,
  `password` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signUp_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `signUp_table`
--

INSERT INTO `signUp_table` (`id`, `user_name`, `email`, `sex`, `password`, `signUp_date`) VALUES
(1, 'mas', 'masa@gmail.cc', 1, 'yyysssiii1', '2021-06-02 01:11:12'),
(23, 'sinzou', 'sinzou@sinzou.com', 1, '$2y$10$2vbDSUJ6eVa8oS8x56/PSezW67pLV2jU5U32dAbCyGfYw9iDWLjli', '2021-06-04 13:13:16'),
(24, 'mikan', 'mikan@mikan.com', 1, '$2y$10$Buc699oipKkMB7kr9knEseGXhIMU5FneNFefBiIwMNCYYUaHsOAB.', '2021-06-04 13:26:26');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `signUp_table`
--
ALTER TABLE `signUp_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `signUp_table`
--
ALTER TABLE `signUp_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
