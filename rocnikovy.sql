-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 25, 2025 at 08:12 PM
-- Server version: 10.6.5-MariaDB-log
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `niko`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `postal` char(5) NOT NULL,
  `shipping` decimal(6,2) NOT NULL,
  `total` decimal(6,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `surname`, `email`, `phone`, `country`, `city`, `address1`, `address2`, `postal`, `shipping`, `total`, `created_at`) VALUES
(1, 1, 'Samuel', 'Šadlák', 'dev@samosadlaker.eu', '0919080716', 'Slovenko', 'Nová Baňa', 'Školská 22', '', '96801', 4.99, 59.99, '2025-01-25 18:25:16'),
(2, NULL, 'Samuel', 'Šadlák', 'dev@samosadlaker.eu', '0919080716', 'Slovenko', 'Nová Baňa', 'Školská 22', '', '96801', 4.99, 94.99, '2025-01-25 18:26:55'),
(3, 1, 'Samuel', 'Šadlák', 'dev@samosadlaker.eu', '0919080716', 'Slovenko', 'Nová Baňa', 'Školská 22', '', '96801', 4.99, 14.99, '2025-01-25 18:28:14'),
(4, 1, 'Samuel', 'Šadlák', 'dev@samosadlaker.eu', '0919080716', 'Slovenko', 'Nová Baňa', 'Školská 22', '', '96801', 4.99, 16.99, '2025-01-25 18:29:35'),
(5, 1, 'Samuel', 'Šadlák', 'dev@samosadlaker.eu', '0919080716', 'Slovenko', 'Nová Baňa', 'Školská 22', '', '96801', 4.99, 16.99, '2025-01-25 18:30:31'),
(6, 1, 'Samuel', 'Šadlák', 'dev@samosadlaker.eu', '0919080716', 'Slovenko', 'Nová Baňa', 'Školská 22', '', '96801', 4.99, 16.99, '2025-01-25 18:31:02'),
(7, 1, 'Samuel', 'Šadlák', 'dev@samosadlaker.eu', '0919080716', 'Slovenko', 'Nová Baňa', 'Školská 22', '', '96801', 4.99, 16.99, '2025-01-25 18:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` enum('S','M','L','XL') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `quantity`, `size`) VALUES
(1, 1, 18, 1, 'S'),
(2, 2, 30, 1, 'S'),
(3, 3, 6, 1, NULL),
(4, 4, 10, 1, NULL),
(5, 5, 10, 1, NULL),
(6, 6, 10, 1, NULL),
(7, 7, 10, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` double(10,2) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `has_size` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `slug`, `name`, `image`, `price`, `description`, `category`, `has_size`, `created_at`) VALUES
(1, 'utopia-2-disk-vinyl-lp-cover-1', 'Utopia 2 Disk Vinyl LP Cover 1', 'vinyl1.png', 50.00, 'Názov: UTOPIA<br>\nFormát: 2 x Vinyl, LP, Album, Cover 1<br>\nŽáner: Hip Hop, Elektronický<br>\nŠtýl: Trap, Cloud Rap, Pop Rap, Experimentálny, Psychedelický<br>\nDátum vydania: 28. júl 2023<br>\nTracklist:<br><br>\n\nLP1:<br>\n1 · HYAENA - Travis Scott<br>\n2 · THANK GOD - Travis Scott<br>\n3 · MODERN JAM - Travis Scott, Teezo Touchdown<br>\n4 · MY EYES - Travis Scott<br>\n5 · GOD’S COUNTRY - Travis Scott<br>\n6 · SIRENS (First Edition Version) - Travis Scott<br>\n7 · Aye (First Editon Version) - Lil Uzi Vert, Travis Scott<br>\n8 · FE!N (First Edition Version) - Travis Scott, Playboi Carti, Sheck Wes<br>\n9 · DELRESTO (ECHOES) - Byoncé, Travis Scott<br>\n10 · I KNOW? - Travis Scott<br><br>\n\nLP2:<br>\n1 · TOPIA TWINS - Travis Scott, 21Savage, Rob49<br>\n2 · CIRCUS MAXIMUS - Travis Scott, The Weeknd, Swae Lee<br>\n3 · PARASAIL - Travis Scott, Dave Chappelle, Yung Lean<br>\n4 · SKITZO - Travis Scott, Young Thug<br>\n5 · LOST FOREVER - Travis Scott, Westside Gunn<br>\n6 · LOOOVE - Travis Scott, Kid Cudi<br>\n7 · K-POP - Travis Scott, The Weeknd, Bad Bunny<br>\n8 · TELEKINESIS - Travis Scott, Future, SZA<br>\n9 · TILL FURTHER NOTICE - Travis Scott, 21Savage, James Blake<br>', 'vinyl', 0, '2024-04-04 18:22:11'),
(2, 'utopia-2-disk-vinyl-lp-cover-2', 'Utopia 2 Disk Vinyl LP Cover 2', 'vinyl2.png', 50.00, 'Názov: UTOPIA<br>\r\nFormát: 2 x Vinyl, LP, Album, Cover 2<br>\r\nŽáner: Hip Hop, Elektronický<br>\r\nŠtýl: Trap, Cloud Rap, Pop Rap, Experimentálny, Psychedelický<br>\r\nDátum vydania: 28. júl 2023<br>\r\nTracklist:<br><br>\r\n\r\nLP1:<br>\r\n1 · HYAENA - Travis Scott<br>\r\n2 · THANK GOD - Travis Scott<br>\r\n3 · MODERN JAM - Travis Scott, Teezo Touchdown<br>\r\n4 · MY EYES - Travis Scott<br>\r\n5 · GOD’S COUNTRY - Travis Scott<br>\r\n6 · SIRENS (First Edition Version) - Travis Scott<br>\r\n7 · Aye (First Editon Version) - Lil Uzi Vert, Travis Scott<br>\r\n8 · FE!N (First Edition Version) - Travis Scott, Playboi Carti, Sheck Wes<br>\r\n9 · DELRESTO (ECHOES) - Byoncé, Travis Scott<br>\r\n10 · I KNOW? - Travis Scott<br><br>\r\n\r\nLP2:<br>\r\n1 · TOPIA TWINS - Travis Scott, 21Savage, Rob49<br>\r\n2 · CIRCUS MAXIMUS - Travis Scott, The Weeknd, Swae Lee<br>\r\n3 · PARASAIL - Travis Scott, Dave Chappelle, Yung Lean<br>\r\n4 · SKITZO - Travis Scott, Young Thug<br>\r\n5 · LOST FOREVER - Travis Scott, Westside Gunn<br>\r\n6 · LOOOVE - Travis Scott, Kid Cudi<br>\r\n7 · K-POP - Travis Scott, The Weeknd, Bad Bunny<br>\r\n8 · TELEKINESIS - Travis Scott, Future, SZA<br>\r\n9 · TILL FURTHER NOTICE - Travis Scott, 21Savage, James Blake<br>', 'vinyl', 0, '2024-04-07 08:32:57'),
(3, 'utopia-2-disk-vinyl-lp-cover-3', 'Utopia 2 Disk Vinyl LP Cover 3', 'vinyl3.png', 50.00, 'Názov: UTOPIA<br>\nFormát: 2 x Vinyl, LP, Album, Cover 3<br>\nŽáner: Hip Hop, Elektronický<br>\nŠtýl: Trap, Cloud Rap, Pop Rap, Experimentálny, Psychedelický<br>\nDátum vydania: 28. júl 2023<br>\nTracklist:<br><br>\n\nLP1:<br>\n1 · HYAENA - Travis Scott<br>\n2 · THANK GOD - Travis Scott<br>\n3 · MODERN JAM - Travis Scott, Teezo Touchdown<br>\n4 · MY EYES - Travis Scott<br>\n5 · GOD’S COUNTRY - Travis Scott<br>\n6 · SIRENS (First Edition Version) - Travis Scott<br>\n7 · Aye (First Editon Version) - Lil Uzi Vert, Travis Scott<br>\n8 · FE!N (First Edition Version) - Travis Scott, Playboi Carti, Sheck Wes<br>\n9 · DELRESTO (ECHOES) - Byoncé, Travis Scott<br>\n10 · I KNOW? - Travis Scott<br><br>\n\nLP2:<br>\n1 · TOPIA TWINS - Travis Scott, 21Savage, Rob49<br>\n2 · CIRCUS MAXIMUS - Travis Scott, The Weeknd, Swae Lee<br>\n3 · PARASAIL - Travis Scott, Dave Chappelle, Yung Lean<br>\n4 · SKITZO - Travis Scott, Young Thug<br>\n5 · LOST FOREVER - Travis Scott, Westside Gunn<br>\n6 · LOOOVE - Travis Scott, Kid Cudi<br>\n7 · K-POP - Travis Scott, The Weeknd, Bad Bunny<br>\n8 · TELEKINESIS - Travis Scott, Future, SZA<br>\n9 · TILL FURTHER NOTICE - Travis Scott, 21Savage, James Blake<br>', 'vinyl', 0, '2024-04-05 13:20:21'),
(4, 'utopia-2-disk-vinyl-lp-cover-4', 'Utopia 2 Disk Vinyl LP Cover 4', 'vinyl4.png', 50.00, 'Názov: UTOPIA<br>\nFormát: 2 x Vinyl, LP, Album, Cover 4<br>\nŽáner: Hip Hop, Elektronický<br>\nŠtýl: Trap, Cloud Rap, Pop Rap, Experimentálny, Psychedelický<br>\nDátum vydania: 28. júl 2023<br>\nTracklist:<br><br>\n\nLP1:<br>\n1 · HYAENA - Travis Scott<br>\n2 · THANK GOD - Travis Scott<br>\n3 · MODERN JAM - Travis Scott, Teezo Touchdown<br>\n4 · MY EYES - Travis Scott<br>\n5 · GOD’S COUNTRY - Travis Scott<br>\n6 · SIRENS (First Edition Version) - Travis Scott<br>\n7 · Aye (First Editon Version) - Lil Uzi Vert, Travis Scott<br>\n8 · FE!N (First Edition Version) - Travis Scott, Playboi Carti, Sheck Wes<br>\n9 · DELRESTO (ECHOES) - Byoncé, Travis Scott<br>\n10 · I KNOW? - Travis Scott<br><br>\n\nLP2:<br>\n1 · TOPIA TWINS - Travis Scott, 21Savage, Rob49<br>\n2 · CIRCUS MAXIMUS - Travis Scott, The Weeknd, Swae Lee<br>\n3 · PARASAIL - Travis Scott, Dave Chappelle, Yung Lean<br>\n4 · SKITZO - Travis Scott, Young Thug<br>\n5 · LOST FOREVER - Travis Scott, Westside Gunn<br>\n6 · LOOOVE - Travis Scott, Kid Cudi<br>\n7 · K-POP - Travis Scott, The Weeknd, Bad Bunny<br>\n8 · TELEKINESIS - Travis Scott, Future, SZA<br>\n9 · TILL FURTHER NOTICE - Travis Scott, 21Savage, James Blake<br>', 'vinyl', 0, '2024-04-05 13:24:05'),
(5, 'utopia-2-disk-vinyl-lp-cover-5', 'Utopia 2 Disk Vinyl LP Cover 5', 'vinyl5.png', 50.00, 'Názov: UTOPIA<br>\nFormát: 2 x Vinyl, LP, Album, Cover 5<br>\nŽáner: Hip Hop, Elektronický<br>\nŠtýl: Trap, Cloud Rap, Pop Rap, Experimentálny, Psychedelický<br>\nDátum vydania: 28. júl 2023<br>\nTracklist:<br><br>\n\nLP1:<br>\n1 · HYAENA - Travis Scott<br>\n2 · THANK GOD - Travis Scott<br>\n3 · MODERN JAM - Travis Scott, Teezo Touchdown<br>\n4 · MY EYES - Travis Scott<br>\n5 · GOD’S COUNTRY - Travis Scott<br>\n6 · SIRENS (First Edition Version) - Travis Scott<br>\n7 · Aye (First Editon Version) - Lil Uzi Vert, Travis Scott<br>\n8 · FE!N (First Edition Version) - Travis Scott, Playboi Carti, Sheck Wes<br>\n9 · DELRESTO (ECHOES) - Byoncé, Travis Scott<br>\n10 · I KNOW? - Travis Scott<br><br>\n\nLP2:<br>\n1 · TOPIA TWINS - Travis Scott, 21Savage, Rob49<br>\n2 · CIRCUS MAXIMUS - Travis Scott, The Weeknd, Swae Lee<br>\n3 · PARASAIL - Travis Scott, Dave Chappelle, Yung Lean<br>\n4 · SKITZO - Travis Scott, Young Thug<br>\n5 · LOST FOREVER - Travis Scott, Westside Gunn<br>\n6 · LOOOVE - Travis Scott, Kid Cudi<br>\n7 · K-POP - Travis Scott, The Weeknd, Bad Bunny<br>\n8 · TELEKINESIS - Travis Scott, Future, SZA<br>\n9 · TILL FURTHER NOTICE - Travis Scott, 21Savage, James Blake<br>', 'vinyl', 0, '2024-04-05 13:47:36'),
(6, 'kpop-vinyl', 'K-POP Vinyl', 'vinyl6.png', 10.00, 'Názov: K-POP<br>\nFormát: 2 x Vinyl<br>\nŽáner: Hip Hop, Latin, Pop<br>\nŠtýl: Dancehall, Pop Rap, Afrobeat, Moderné R&B<br>\nDátum vydania: 21. júl 2023<br>\nTracklist:<br><br>\n\n1 · K-POP - Travis Scott, The Weeknd, Bad Bunny<br>\n2 · K-POP (Clean Edition) - Travis Scott, The Weeknd, Bad Bunny<br>\n3 · K-POP (Instrumental)', 'vinyl', 0, '2024-04-05 14:00:13'),
(7, 'astroworld-vinyl', 'Astroworld Vinyl', 'vinyl7.png', 40.00, 'Názov: ASTROWORLD<br>\nFormát: 2 x Vinyl, LP, Album<br>\nŽáner: Hip Hop, Elektronický<br>\nŠtýl: Trap, Pop Rap, Psychedelický<br>\nDátum vydania: 3. august 2018<br>\nTracklist:<br><br>\n\nLP1:<br>\n1 · STARGAZING - Travis Scott<br>\n2 · CAROUSEL - Travis Scott, Frank Ocean<br>\n3 · SICKO MODE - Travis Scott, Drake<br>\n4 · R.I.P SCREW - Travis Scott, Swae Lee<br>\n5 · STOP TRYING TO BE GOD - Travis Scott, James Blake, Kid Cudi, Philip Bailey, Stevie Wonder<br>\n6 · NO BYSTANDERS - Travis Scott, Juice WRLD, Sheck Wes<br>\n7 · SKELETONS - Travis Scott, The Weeknd, Tame Impala, Pharrell Williams<br>\n8 · WAKE UP - Travis Scott, The Weeknd<br>\n9 · 5% TINT - Travis Scott<br><br>\n\nLP2:<br>\n1 · NC-17 - Travis Scott, 21Savage<br>\n2 · ASTROTHUNDER - Travis Scott<br>\n3 · YOSEMITE - Travis Scott, Gunna, NAV<br>\n4 · CAN\'T SAY - Travis Scott, Don Toliver<br>\n5 · WHO? WHAT! - Travis Scott, Quavo, Takeoff<br>\n6 · BUTTERFLY EFFECT - Travis Scott<br>\n7 · HOUSTONFORNICATION - Travis Scott<br>\n8 · COFEE BEAN - Travis Scott', 'vinyl', 0, '2024-04-05 14:08:09'),
(8, 'rodeo-vinyl', 'Rodeo Vinyl', 'vinyl8.png', 50.00, 'Názov: Rodeo (Deluxe)<br>\nFormát: 2 x Vinyl, LP, Album<br>\nŽáner: Hip Hop<br>\nŠtýl: Trap, Pop Rap, Goth Rap, Psychedelický<br>\nDátum vydania: 4. september 2015<br>\nTracklist:<br><br>\n\nLP1:<br>\n1 · Pornography - Travis Scott<br>\n2 · Oh My Dis Side - Travis Scott, Quavo<br>\n3 · 3500 - Travis Scott, Future, 2Chainz<br>\n4 · Waster - Travis Scott, Juicy J<br>\n5 · 90210 - Travis Scott, Kacy Hill<br>\n6 · Pray 4 Love - Travis Scott, The Weeknd<br><br>\n\nLP2:<br>\n1 · Nightcrawler - Travis Scott, Swae Lee, Chief Keef<br>\n2 · Piss on Your Grave - Travis Scott, Kanye West<br>\n3 · Antidote - Travis Scott<br>\n4 · Impossible - Travis Scott<br>\n5 · Maria I\'m Drunk - Travis Scott, Young Thug, Justin Bieber<br>\n6 · Flying High - Travis Scott, Toro y Moi<br>\n7 · I Can Tell - Travis Scott<br>\n8 · Apple Pie - Travis Scott<br>\n9 · Ok Alright - Travis Scott, ScHoolboy Q<br>\n10 · Never Catch Me - Travis Scott', 'vinyl', 0, '2024-04-05 14:10:49'),
(9, 'utopia-cd-cover-1', 'Utopia CD Cover 1', 'cd1.png', 12.00, 'Názov: UTOPIA<br>\r\nFormát: CD, Album, Cover 1<br>\r\nŽáner: Hip Hop, Elektronický<br>\r\nŠtýl: Trap, Cloud Rap, Pop Rap, Experimentálny, Psychedelický<br>\r\nDátum vydania: 28. júl 2023<br>\r\nTracklist:<br><br>\r\n\r\n1 · HYAENA - Travis Scott<br>\r\n2 · THANK GOD - Travis Scott<br>\r\n3 · MODERN JAM - Travis Scott, Teezo Touchdown<br>\r\n4 · MY EYES - Travis Scott<br>\r\n5 · GOD’S COUNTRY - Travis Scott<br>\r\n6 · SIRENS (First Edition Version) - Travis Scott<br>\r\n7 · Aye (First Editon Version) - Lil Uzi Vert, Travis Scott<br>\r\n8 · FE!N (First Edition Version) - Travis Scott, Playboi Carti, Sheck Wes<br>\r\n9 · DELRESTO (ECHOES) - Byoncé, Travis Scott<br>\r\n10 · I KNOW? - Travis Scott<br>\r\n11 · TOPIA TWINS - Travis Scott, 21Savage, Rob49<br>\r\n12 · CIRCUS MAXIMUS - Travis Scott, The Weeknd, Swae Lee<br>\r\n13 · PARASAIL - Travis Scott, Dave Chappelle, Yung Lean<br>\r\n14 · SKITZO - Travis Scott, Young Thug<br>\r\n15 · LOST FOREVER - Travis Scott, Westside Gunn<br>\r\n16 · LOOOVE - Travis Scott, Kid Cudi<br>\r\n17 · K-POP - Travis Scott, The Weeknd, Bad Bunny<br>\r\n18 · TELEKINESIS - Travis Scott, Future, SZA<br>\r\n19 · TILL FURTHER NOTICE - Travis Scott, 21Savage, James Blake', 'cd', 0, '2024-04-07 08:38:58'),
(10, 'utopia-cd-cover-2', 'Utopia CD Cover 2', 'cd2.png', 12.00, 'Názov: UTOPIA<br>\nFormát: CD, Album, Cover 2<br>\nŽáner: Hip Hop, Elektronický<br>\nŠtýl: Trap, Cloud Rap, Pop Rap, Experimentálny, Psychedelický<br>\nDátum vydania: 28. júl 2023<br>\nTracklist:<br><br>\n\n1 · HYAENA - Travis Scott<br>\n2 · THANK GOD - Travis Scott<br>\n3 · MODERN JAM - Travis Scott, Teezo Touchdown<br>\n4 · MY EYES - Travis Scott<br>\n5 · GOD’S COUNTRY - Travis Scott<br>\n6 · SIRENS (First Edition Version) - Travis Scott<br>\n7 · Aye (First Editon Version) - Lil Uzi Vert, Travis Scott<br>\n8 · FE!N (First Edition Version) - Travis Scott, Playboi Carti, Sheck Wes<br>\n9 · DELRESTO (ECHOES) - Byoncé, Travis Scott<br>\n10 · I KNOW? - Travis Scott<br>\n11 · TOPIA TWINS - Travis Scott, 21Savage, Rob49<br>\n12 · CIRCUS MAXIMUS - Travis Scott, The Weeknd, Swae Lee<br>\n13 · PARASAIL - Travis Scott, Dave Chappelle, Yung Lean<br>\n14 · SKITZO - Travis Scott, Young Thug<br>\n15 · LOST FOREVER - Travis Scott, Westside Gunn<br>\n16 · LOOOVE - Travis Scott, Kid Cudi<br>\n17 · K-POP - Travis Scott, The Weeknd, Bad Bunny<br>\n18 · TELEKINESIS - Travis Scott, Future, SZA<br>\n19 · TILL FURTHER NOTICE - Travis Scott, 21Savage, James Blake', 'cd', 0, '2024-04-05 14:26:25'),
(11, 'utopia-cd-cover-3', 'Utopia CD Cover 3', 'cd3.png', 12.00, 'Názov: UTOPIA<br>\nFormát: CD, Album, Cover 3<br>\nŽáner: Hip Hop, Elektronický<br>\nŠtýl: Trap, Cloud Rap, Pop Rap, Experimentálny, Psychedelický<br>\nDátum vydania: 28. júl 2023<br>\nTracklist:<br><br>\n\n1 · HYAENA - Travis Scott<br>\n2 · THANK GOD - Travis Scott<br>\n3 · MODERN JAM - Travis Scott, Teezo Touchdown<br>\n4 · MY EYES - Travis Scott<br>\n5 · GOD’S COUNTRY - Travis Scott<br>\n6 · SIRENS (First Edition Version) - Travis Scott<br>\n7 · Aye (First Editon Version) - Lil Uzi Vert, Travis Scott<br>\n8 · FE!N (First Edition Version) - Travis Scott, Playboi Carti, Sheck Wes<br>\n9 · DELRESTO (ECHOES) - Byoncé, Travis Scott<br>\n10 · I KNOW? - Travis Scott<br>\n11 · TOPIA TWINS - Travis Scott, 21Savage, Rob49<br>\n12 · CIRCUS MAXIMUS - Travis Scott, The Weeknd, Swae Lee<br>\n13 · PARASAIL - Travis Scott, Dave Chappelle, Yung Lean<br>\n14 · SKITZO - Travis Scott, Young Thug<br>\n15 · LOST FOREVER - Travis Scott, Westside Gunn<br>\n16 · LOOOVE - Travis Scott, Kid Cudi<br>\n17 · K-POP - Travis Scott, The Weeknd, Bad Bunny<br>\n18 · TELEKINESIS - Travis Scott, Future, SZA<br>\n19 · TILL FURTHER NOTICE - Travis Scott, 21Savage, James Blake', 'cd', 0, '2024-04-05 14:27:12'),
(12, 'utopia-cd-cover-4', 'Utopia CD Cover 4', 'cd4.png', 12.00, 'Názov: UTOPIA<br>\nFormát: CD, Album, Cover 4<br>\nŽáner: Hip Hop, Elektronický<br>\nŠtýl: Trap, Cloud Rap, Pop Rap, Experimentálny, Psychedelický<br>\nDátum vydania: 28. júl 2023<br>\nTracklist:<br><br>\n\n1 · HYAENA - Travis Scott<br>\n2 · THANK GOD - Travis Scott<br>\n3 · MODERN JAM - Travis Scott, Teezo Touchdown<br>\n4 · MY EYES - Travis Scott<br>\n5 · GOD’S COUNTRY - Travis Scott<br>\n6 · SIRENS (First Edition Version) - Travis Scott<br>\n7 · Aye (First Editon Version) - Lil Uzi Vert, Travis Scott<br>\n8 · FE!N (First Edition Version) - Travis Scott, Playboi Carti, Sheck Wes<br>\n9 · DELRESTO (ECHOES) - Byoncé, Travis Scott<br>\n10 · I KNOW? - Travis Scott<br>\n11 · TOPIA TWINS - Travis Scott, 21Savage, Rob49<br>\n12 · CIRCUS MAXIMUS - Travis Scott, The Weeknd, Swae Lee<br>\n13 · PARASAIL - Travis Scott, Dave Chappelle, Yung Lean<br>\n14 · SKITZO - Travis Scott, Young Thug<br>\n15 · LOST FOREVER - Travis Scott, Westside Gunn<br>\n16 · LOOOVE - Travis Scott, Kid Cudi<br>\n17 · K-POP - Travis Scott, The Weeknd, Bad Bunny<br>\n18 · TELEKINESIS - Travis Scott, Future, SZA<br>\n19 · TILL FURTHER NOTICE - Travis Scott, 21Savage, James Blake', 'cd', 0, '2024-04-05 14:27:56'),
(13, 'utopia-cd-cover-5', 'Utopia CD Cover 5', 'cd5.png', 12.00, 'Názov: UTOPIA<br>\nFormát: CD, Album, Cover 5<br>\nŽáner: Hip Hop, Elektronický<br>\nŠtýl: Trap, Cloud Rap, Pop Rap, Experimentálny, Psychedelický<br>\nDátum vydania: 28. júl 2023<br>\nTracklist:<br><br>\n\n1 · HYAENA - Travis Scott<br>\n2 · THANK GOD - Travis Scott<br>\n3 · MODERN JAM - Travis Scott, Teezo Touchdown<br>\n4 · MY EYES - Travis Scott<br>\n5 · GOD’S COUNTRY - Travis Scott<br>\n6 · SIRENS (First Edition Version) - Travis Scott<br>\n7 · Aye (First Editon Version) - Lil Uzi Vert, Travis Scott<br>\n8 · FE!N (First Edition Version) - Travis Scott, Playboi Carti, Sheck Wes<br>\n9 · DELRESTO (ECHOES) - Byoncé, Travis Scott<br>\n10 · I KNOW? - Travis Scott<br>\n11 · TOPIA TWINS - Travis Scott, 21Savage, Rob49<br>\n12 · CIRCUS MAXIMUS - Travis Scott, The Weeknd, Swae Lee<br>\n13 · PARASAIL - Travis Scott, Dave Chappelle, Yung Lean<br>\n14 · SKITZO - Travis Scott, Young Thug<br>\n15 · LOST FOREVER - Travis Scott, Westside Gunn<br>\n16 · LOOOVE - Travis Scott, Kid Cudi<br>\n17 · K-POP - Travis Scott, The Weeknd, Bad Bunny<br>\n18 · TELEKINESIS - Travis Scott, Future, SZA<br>\n19 · TILL FURTHER NOTICE - Travis Scott, 21Savage, James Blake', 'cd', 0, '2024-04-05 14:28:32'),
(14, 'astroworld-cd', 'Astroworld CD', 'cd6.png', 12.00, 'Názov: ASTROWORLD<br>\nFormát: CD, Album<br>\nŽáner: Hip Hop, Elektronický<br>\nŠtýl: Trap, Pop Rap, Psychedelický<br>\nDátum vydania: 3. august 2018<br>\nTracklist:<br><br>\n\n1 · STARGAZING - Travis Scott<br>\n2 · CAROUSEL - Travis Scott, Frank Ocean<br>\n3 · SICKO MODE - Travis Scott, Drake<br>\n4 · R.I.P SCREW - Travis Scott, Swae Lee<br>\n5 · STOP TRYING TO BE GOD - Travis Scott, James Blake, Kid Cudi, Philip Bailey, Stevie Wonder<br>\n6 · NO BYSTANDERS - Travis Scott, Juice WRLD, Sheck Wes<br>\n7 · SKELETONS - Travis Scott, The Weeknd, Tame Impala, Pharrell Williams<br>\n8 · WAKE UP - Travis Scott, The Weeknd<br>\n9 · 5% TINT - Travis Scott<br>\n10 · NC-17 - Travis Scott, 21Savage<br>\n11 · ASTROTHUNDER - Travis Scott<br>\n12 · YOSEMITE - Travis Scott, Gunna, NAV<br>\n13 · CAN\'T SAY - Travis Scott, Don Toliver<br>\n14 · WHO? WHAT! - Travis Scott, Quavo, Takeoff<br>\n15 · BUTTERFLY EFFECT - Travis Scott<br>\n16 · HOUSTONFORNICATION - Travis Scott<br>\n17 · COFEE BEAN - Travis Scott', 'cd', 0, '2024-04-05 14:32:02'),
(15, 'birds-in-the-trap-sing-mcknight', 'Birds in the Trap Sing McKnight CD', 'cd7.png', 11.00, 'Názov: Birds In The Trap Sing McKnight<br>\r\nFormát: CD, Album<br>\r\nŽáner: Hip Hop, Elektronický<br>\r\nŠtýl: Trap, Pop Rap, Psychedelický<br>\r\nDátum vydania: 2. september 2016<br>\r\nTracklist:<br><br>\r\n1 · the ends - Travis Scott, André 3000<br>\r\n2 · way back - Travis Scott<br>\r\n3 · coordinate - Travis Scott, Blac Youngsta<br>\r\n4 · through the late night - Travis Scott, Kid Cudi<br>\r\n5 · beibs in the trap - Travis Scott, NAV<br>\r\n6 · sdp interlude - Travis Scott<br>\r\n7 · sweet sweet - Travis Scott<br>\r\n8 · outside - Travis Scott, 21savage<br>\r\n9 · goosebumps - Travis Scott, Kendrick Lamar<br>\r\n10 · first take - Travis Scott, Bryson Tiller<br>\r\n11 · pick up the phone - Young Thug, Travis Scott, Quavo<br>\r\n12 · lose - Travis Scott<br>\r\n13 · guidance - Travis Scott<br>\r\n14 · wonderful - Travis Scott, The Weeknd', 'cd', 0, '2024-04-05 14:33:05'),
(16, 'rodeo-cd', 'Rodeo CD', 'cd8.png', 10.00, 'Názov: Rodeo (Deluxe)<br>\nFormát: CD, Album<br>\nŽáner: Hip Hop<br>\nŠtýl: Trap, Pop Rap, Goth Rap, Psychedelický<br>\nDátum vydania: 4. september 2015<br>\n\nTracklist:<br><br>\n1 · Pornography - Travis Scott<br>\n2 · Oh My Dis Side - Travis Scott, Quavo<br>\n3 · 3500 - Travis Scott, Future, 2Chainz<br>\n4 · Waster - Travis Scott, Juicy J<br>\n5 · 90210 - Travis Scott, Kacy Hill<br>\n6 · Pray 4 Love - Travis Scott, The Weeknd<br>\n7 · Nightcrawler - Travis Scott, Swae Lee, Chief Keef<br>\n8 · Piss on Your Grave - Travis Scott, Kanye West<br>\n9 · Antidote - Travis Scott<br>\n10 · Impossible - Travis Scott<br>\n11 · Maria I\'m Drunk - Travis Scott, Young Thug, Justin Bieber<br>\n12 · Flying High - Travis Scott, Toro y Moi<br>\n13 · I Can Tell - Travis Scott<br>\n14 · Apple Pie - Travis Scott<br>\n15 · Ok Alright - Travis Scott, ScHoolboy Q<br>\n16 · Never Catch Me - Travis Scott', 'cd', 0, '2024-04-05 14:33:55'),
(17, 'circus-maximus-tee', 'Circus Maximus Tee', 'tricko1_1.png', 55.00, 'Tričko s krátkym rukávom<br>\nZnačka: Cactus Jack<br>\nKolekcia: Utopia<br>\nFarba: Bila, Šedá<br>\nMateriál: 100% bavlna<br>\nStrih: Normálny', 'tricko', 1, '2024-04-05 15:07:11'),
(18, 'hyaena-tee', 'Hyaena Tee', 'tricko2.png', 55.00, 'Tričko s krátkym rukávom<br>\nZnačka: Cactus Jack<br>\nKolekcia: Utopia<br>\nFarba: Šedá, Modrá<br>\nMateriál: 100% bavlna<br>\nStrih: Normálny', 'tricko', 1, '2024-04-05 15:10:32'),
(19, 'utopia-b1-tee', 'Utopia B1 Tee', 'tricko4.png', 45.00, 'Tričko s krátkym rukávom<br>\nZnačka: Cactus Jack<br>\nKolekcia: Utopia<br>\nFarba: Bila, Hnedá, Zelená, Červená, Šedá<br>\nMateriál: 100% bavlna<br>\nStrih: Normálny', 'tricko', 1, '2024-04-05 15:11:56'),
(20, 'utopia-b2-tee', 'Utopia B2 Tee', 'tricko3.png', 45.00, 'Tričko s krátkym rukávom<br>\nZnačka: Cactus Jack<br>\nKolekcia: Utopia<br>\nFarba: Bila, Hnedá<br>\nMateriál: 100% bavlna<br>\nStrih: Normálny', 'tricko', 1, '2024-04-05 15:12:36'),
(21, 'utopia-b3-tee', 'Utopia B3 Tee', 'tricko5.png', 45.00, 'Tričko s krátkym rukávom<br>\nZnačka: Cactus Jack<br>\nKolekcia: Utopia<br>\nFarba: Čierna, Hnedá<br>\nMateriál: 100% bavlna<br>\nStrih: Normálny', 'tricko', 1, '2024-04-05 15:13:38'),
(22, 'annihilator-tee', 'Annihilator Tee', 'tricko6.png', 45.00, 'Tričko s krátkym rukávom<br>\nZnačka: Cactus Jack<br>\nKolekcia: Utopia<br>\nFarba: Hnedá<br>\nMateriál: 100% bavlna<br>\nStrih: Normálny', 'tricko', 1, '2024-04-05 15:14:21'),
(23, 'utopia-wheel-tee', 'Utopia Wheel Tee', 'tricko7.png', 55.00, 'Tričko s krátkym rukávom<br>\nZnačka: Cactus Jack<br>\nKolekcia: Utopia<br>\nFarba: Bila, Čierna<br>\nMateriál: 100% bavlna<br>\nStrih: Normálny', 'tricko', 1, '2024-04-05 15:15:35'),
(24, 'collage-tee', 'Collage Tee', 'tricko8.png', 55.00, 'Tričko s krátkym rukávom<br>\nZnačka: Cactus Jack<br>\nKolekcia: Utopia<br>\nFarba: Šedá, Hnedá, Biela<br>\nMateriál: 100% bavlna<br>\nStrih: Normálny', 'tricko', 1, '2024-04-05 15:16:41'),
(25, 'ap-hoodie', 'AP Hoodie', 'mikina1_1.png', 90.00, 'Mikina s kapucňou, potlačou a klokaním vreckom.<br>\r\nZnačka: Cactus Jack<br>\r\nKolekcia: Utopia<br>\r\nFarba: Biela, Hnedá<br>\r\nMateriál: 100% bavlna<br>\r\nStrih: Voľný', 'mikina', 1, '2024-04-07 09:02:53'),
(26, 'mcdonalds-hoodie', 'McDonalnd\'s Hoodie', 'mikina2_1.png', 80.00, 'Mikina s kapucňou, potlačou a klokaním vreckom.<br>\nZnačka: Cactus Jack<br>\nKolekcia: McDonald\'s<br>\nFarba: Hnedá, Biela<br>\nMateriál: 80% bavlna, 20% polyester<br>\nStrih: Voľný', 'mikina', 1, '2024-04-07 09:05:21'),
(27, 'utopia-c1-hoodie', 'Utopia C1 Hoodie', 'mikina3.png', 90.00, 'Mikina s kapucňou, potlačou a klokaním vreckom.<br>\r\nZnačka: Cactus Jack<br>\r\nKolekcia: Utopia<br>\r\nFarba: Biela, Hnedá<br>\r\nMateriál: 100% bavlna<br>\r\nStrih: Voľný', 'mikina', 1, '2024-04-07 09:07:46'),
(28, 'utopia-b1-hoodie', 'Utopia B1 Hoodie', 'mikina4.png', 90.00, 'Mikina s kapucňou, potlačou a klokaním vreckom.<br>\r\nZnačka: Cactus Jack<br>\r\nKolekcia: Utopia<br>\r\nFarba: Biela, Šedá<br>\r\nMateriál: 100% bavlna<br>\r\nStrih: Voľný', 'mikina', 1, '2024-04-07 09:09:57'),
(29, 'circus-maximus-hoodie', 'Circus Maximus Hoodie', 'mikina5.png', 90.00, 'Mikina s kapucňou, potlačou a klokaním vreckom.<br>\r\nZnačka: Cactus Jack<br>\r\nKolekcia: Utopia<br>\r\nFarba: Biela, Šedá<br>\r\nMateriál: 100% bavlna<br>\r\nStrih: Voľný', 'mikina', 1, '2024-04-07 09:11:11'),
(30, 'utopia-x-kawas-hoodie', 'Utopia x Kawas Hoodie', 'mikina6.png', 90.00, 'Mikina s kapucňou, potlačou a klokaním vreckom.<br>\r\nZnačka: Cactus Jack<br>\r\nKolekcia: Utopia<br>\r\nFarba: Biela, Hnedá<br>\r\nMateriál: 100% bavlna<br>\r\nStrih: Voľný', 'mikina', 1, '2024-04-07 09:12:43'),
(31, 'topia-hoodie', 'Topia Hoodie', 'mikina7.png', 90.00, 'Mikina s kapucňou, potlačou a klokaním vreckom.<br>\r\nZnačka: Cactus Jack<br>\r\nKolekcia: Utopia<br>\r\nFarba: Hnedá<br>\r\nMateriál: 80% bavlna, 20% polyester<br>\r\nStrih: Voľný', 'mikina', 1, '2024-04-07 09:13:38'),
(32, 'sicko-event-hoodie', 'Sicko Event Hoodie', 'mikina8.png', 80.00, 'Mikina s kapucňou, potlačou a klokaním vreckom.<br>\nZnačka: Cactus Jack<br>\nKolekcia: Astroworld<br>\nFarba: Hnedá, Biela<br>\nMateriál: 80% bavlna, 20% polyester<br>\nStrih: Voľný', 'mikina', 1, '2024-04-07 09:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_selection`
--

CREATE TABLE `product_selection` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_selection`
--

INSERT INTO `product_selection` (`id`, `product_id`, `type`, `created_at`) VALUES
(1, 31, 'recommended', '2024-04-07 09:19:15'),
(2, 15, 'recommended', '2024-04-07 09:19:45'),
(3, 9, 'recommended', '2024-04-07 09:19:59'),
(4, 26, 'recommended', '2024-04-07 09:23:08'),
(5, 14, 'recommended', '2024-04-07 09:23:57'),
(6, 5, 'news', '2024-04-07 09:24:28'),
(7, 30, 'news', '2024-04-07 09:25:02'),
(8, 29, 'news', '2024-04-07 09:25:58'),
(9, 6, 'news', '2024-04-07 09:26:31'),
(10, 16, 'news', '2024-04-07 09:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `postal` char(5) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `phone`, `country`, `city`, `address1`, `address2`, `postal`, `password`, `is_admin`, `created_at`) VALUES
(1, 'Samuel', 'Šadlák', 'dev@samosadlaker.eu', '0919080716', 'Slovensko', 'Nová Baňa', 'Školská 22', '', '96801', '$2y$10$YDwbe1chSQ8Zhy0wDehq/.hs.l4Xt/GuV6JmPxNN7DyNHLwK031ti', 1, '2025-01-25 17:06:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_selection`
--
ALTER TABLE `product_selection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_selection`
--
ALTER TABLE `product_selection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_selection`
--
ALTER TABLE `product_selection`
  ADD CONSTRAINT `product_selection_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
