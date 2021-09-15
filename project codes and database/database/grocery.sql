-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 Eyl 2021, 14:26:07
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `grocery`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `aid` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`aid`, `name`, `email`, `password`) VALUES
(1, 'oguzhan', 'eskalen32@gmail.com', 8814);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `cid` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT 13
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`cid`, `name`, `parent_id`) VALUES
(13, 'Tüm Ürünler', 13),
(14, 'Gıda', 13),
(15, 'İçecek', 13),
(16, 'Tahıl', 14),
(17, 'Diğer', 13),
(18, 'Atıştırmalık', 14),
(19, 'Gazlı İçecekler', 15),
(20, 'Meyve', 14),
(22, 'deterjan', 13);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `feedback`
--

CREATE TABLE `feedback` (
  `fid` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `mobile` varchar(12) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `msg` mediumtext COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `uid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `feedback`
--

INSERT INTO `feedback` (`fid`, `name`, `mobile`, `msg`, `uid`) VALUES
(1, 'Tarkan', '05552216688', 'Mükemmel Website elinize sağlık.', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ord`
--

CREATE TABLE `ord` (
  `oid` int(10) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `ord_state` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `subtotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `payment`
--

CREATE TABLE `payment` (
  `payid` int(10) NOT NULL,
  `oid` int(10) DEFAULT NULL,
  `uid` int(10) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `payment_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product`
--

CREATE TABLE `product` (
  `pid` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `weight` varchar(20) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `pic` varchar(100) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `cid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `product`
--

INSERT INTO `product` (`pid`, `name`, `price`, `discount`, `weight`, `pic`, `cid`) VALUES
(31, 'Ülker Çikolatalı Gofret', 5.5, 0, '180 G', 'images/1622022740-1621507674-ülker çikolata beşli.jpg', 18),
(32, 'Söke Un', 7, 0, '1 Kg', 'images/1622022861-1621507701-1621335306-05010401-c4c14f.jpg', 16),
(33, 'Pringles Original Sade', 15, 0, '165 G', 'images/1622025400-1621507720-pringles original sade.jpg', 18),
(34, 'Coca-Cola', 8.5, 0, '2.5 L', 'images/1622025440-1621507952-coca-cola 2.5lt.jpg', 19),
(35, 'Milka Oreo Bar', 4.5, 0, '37 G', 'images/1622025515-1621507792-milka oreo bar.jpg', 18),
(36, 'Elma - Granny Smith', 4, 0, '1 Kg', 'images/1622025586-1621507752-1621334103-tuplu-granny-smith-elma-fidani.jpg', 20),
(38, 'fanta', 5, 0, '500 ml', 'images/1624268738-fanta 0.5L.jpg', 15),
(39, 'ariel deterjan', 15, 0, '1L', 'images/1624268986-indir.jpg', 22);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `uid` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `address1` varchar(250) COLLATE utf8mb4_turkish_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_turkish_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` varchar(10) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`uid`, `name`, `mobile`, `address1`, `gender`, `username`, `password`) VALUES
(6, 'oguzhan', 5551112233, 'sadsadasdasdasd', '', 'oguzhan', '8814'),
(9, 'james', 5544478758, 'Yeni Şehir, Azerbaycan Blv., 46060 Kahramanmaraş Mssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '', 'ahmet', '8814');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Tablo için indeksler `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `feedback_ibfk_1` (`uid`);

--
-- Tablo için indeksler `ord`
--
ALTER TABLE `ord`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `user_id` (`uid`);

--
-- Tablo için indeksler `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`oid`),
  ADD KEY `product_id` (`pid`);

--
-- Tablo için indeksler `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `oid` (`oid`);

--
-- Tablo için indeksler `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `cid` (`cid`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `ord`
--
ALTER TABLE `ord`
  MODIFY `oid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- Tablo için AUTO_INCREMENT değeri `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- Tablo için AUTO_INCREMENT değeri `payment`
--
ALTER TABLE `payment`
  MODIFY `payid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- Tablo için AUTO_INCREMENT değeri `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `ord`
--
ALTER TABLE `ord`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Tablo kısıtlamaları `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`oid`) REFERENCES `ord` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`oid`) REFERENCES `ord` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
