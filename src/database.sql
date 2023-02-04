Use assignment1;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newspaper_agency`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(250) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryId` int(250) NOT NULL,
  `publishedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `publishedBy` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageName` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `categoryId`, `publishedDate`, `publishedBy`, `content`, `imageName`) VALUES
(31, 'Her majesty.', 19, '2023-01-29 11:14:53', '12', 'It is with great sadness that we announce the passing of Her Majesty, Queen. She passed away peacefully in her sleep.\r\nHer Majesty was a beloved leader and a symbol of strength, grace, and dignity for her people. During her reign, she was dedicated to serving her country and worked tirelessly to promote peace, justice, and equality.\r\n\r\nShe will be deeply missed by her family, her subjects, and people around the world who were touched by her kindness and wisdom. Our thoughts and prayers are with her loved ones during this difficult time.\r\n\r\nAs a mark of respect, flags will be flown at half-mast and a period of national mourning has been declared. The nation will come together to honor her memory and celebrate her life and legacy.\r\n\r\nMay she rest in peace.\r\n\r\nThis is a very serious topic, please make sure you have the right information before publishing any kind of news about the death of a ruler or important public figure as it may cause distress and panic.\r\n', '1674970554.jpeg'),
(32, 'Northampton High School football team wins state championship', 17, '2023-01-29T11:17:10', '12', 'The Northampton High School football team has won the state championship, bringing great excitement and pride to the community. The team\'s hard work and dedication throughout the season have paid off, with a final score of 21-14 against their rival team.\r\n\r\nThe team\'s success is a testament to the skill and determination of the players, as well as the leadership of the coaches. The community has rallied behind the team, with many residents attending the games and showing their support.\r\n\r\nWinning the state championship is a significant achievement for the school and the community. It not only brings recognition and prestige to the school but also provides opportunities for the players to showcase their skills and potentially attract the attention of college coaches.', NULL),
(33, 'New movie theater set to open in downtown Northampton', 18, '2023-01-29T11:18:09', '12', 'The residents of Northampton have something to look forward to as a new movie theater is set to open in the downtown area. The state-of-the-art theater will feature multiple screens, comfortable seating, and the latest sound and projection technology. The theater will also offer a variety of food and drinks options, making it a great destination for a night out.\r\n\r\nThe opening of the new theater is expected to bring new life to the downtown area, as it will attract both residents and visitors. It will provide a new entertainment option for the community and it will likely boost the local economy by increasing foot traffic and business for nearby restaurants and shops.\r\n\r\nThe theater\'s opening is also expected to create jobs for the local area and it could also be a boost for the local film industry, as it will provide a new venue for independent and local filmmakers to showcase their work.\r\nThe theater\'s opening date and ticket prices have not yet been announced, but the community is eagerly awaiting the day when they can enjoy the latest blockbuster or independent film in the comfort of this new theater.', NULL),
(34, 'Tensions rise between US and China over trade deals', 16, '2023-01-29T11:19:54', '12', 'Tensions between the United States and China have been escalating in recent years, with trade being a major point of contention. The US has accused China of unfair trade practices, such as currency manipulation and intellectual property theft, and has imposed tariffs on Chinese goods. China, in turn, has retaliated with tariffs of its own.\r\n\r\nThese tensions have had a significant impact on the global economy, with many industries being affected by the tariffs and trade disputes. Companies that rely on exports to China have seen their sales drop, while consumers have had to pay more for goods due to the tariffs.\r\n\r\nThe US and China have been engaged in negotiations in recent months to try and resolve the trade dispute, but a resolution has yet to be reached. The situation is closely watched by the international community as it has a potential to impact the global economy.\r\n', NULL),
(35, 'The Digital Future: 5G Technology to Revolutionize the Way We Connect', 14, '2023-01-29T11:22:34', '12', '5G technology, the next generation of cellular networks, is set to revolutionize the way we connect to the internet and communicate with each other. With faster speeds and lower latency, 5G will enable a wide range of new applications and services, from self-driving cars to virtual reality.\r\n\r\nThe technology will bring many benefits, including faster download and upload speeds, enabling more devices to connect to the internet simultaneously and providing better coverage in densely populated areas. It will also enable new technologies such as the Internet of Things (IoT) and smart cities, which will make our lives more convenient and efficient.\r\n\r\nHowever, this new technology also brings some concerns, such as privacy and security. As more devices and services connect to the internet, the risk of cyber attacks increases. Additionally, the increased data usage and processing power required for 5G will also put a strain on our current infrastructure, requiring significant upgrades and investments.\r\n\r\nDespite these concerns, the potential benefits of 5G technology are undeniable. It will change the way we live, work, and play, and it will be important for governments, companies, and individuals to be aware of the changes and opportunities it will bring. The digital future is here, and it\'s exciting to see how this technology will shape our world.', '1674970654.jpeg'),
(36, 'Business Brief: New Startup Takes the e-Commerce Industry by Storm', 15, '2023-01-29T11:24:00', '12', 'A new startup, StockUp Inc., is shaking up the e-commerce industry with its innovative approach to online shopping. The company, which launched just a year ago, has quickly gained a reputation for its user-friendly platform and unique product offerings.\r\n\r\nStockUp Inc. has developed a proprietary algorithm that personalizes the online shopping experience for each customer, providing them with a curated selection of products based on their browsing history and purchase history. The algorithm also uses machine learning to anticipate customer needs and make product recommendations.\r\n\r\nIn addition to the algorithm, StockUp Inc. also offers a subscription service for customers to receive monthly boxes of handpicked items. This service has been a hit with customers, who appreciate the convenience and surprise of receiving a package of products tailored to their interests.\r\n\r\nThe company has also made a name for itself by sourcing products from small, independent businesses, providing a platform for these companies to reach a wider audience. This approach not only sets StockUp Inc. apart from other e-commerce giants, but also supports local economies.\r\n\r\nStockUp Inc. has seen rapid growth since its launch, with revenues doubling in the last quarter and a steady increase in customer base. The company is now planning to expand into international markets and is currently in talks with investors to secure funding for its expansion plans.', '1674970740.jpeg'),
(37, 'Science Today: Breakthrough Discovery in Cancer Research', 13, '2023-01-29T11:25:04', '12', 'Scientists at the University of Northampton have made a breakthrough discovery in cancer research that could lead to new and more effective treatments for the disease. The team of researchers has identified a new protein that plays a key role in the development and progression of cancer cells.\r\n\r\nThe protein, called P53, is responsible for regulating cell growth and division. In normal cells, P53 acts as a \"guardian\" and prevents abnormal growth. However, in cancer cells, P53 is often mutated or suppressed, allowing the cells to continue growing and dividing uncontrollably.\r\n\r\nThe team of scientists discovered that by targeting and inhibiting this protein, they were able to slow down the growth of cancer cells in laboratory experiments. This discovery could lead to the development of new drugs that specifically target P53, which could be more effective in treating cancer than current therapies.\r\n\r\nThis research is still in the early stages, but the scientists are hopeful that their findings will lead to new treatments for cancer that could save many lives. The team is currently working on developing new drugs that target P53 and they plan to start clinical trials in the next few years.\r\n\r\nThis discovery is a significant step forward in the fight against cancer and brings hope for the future. The researchers believe that this new therapy will help in more precise and targeted treatments and eventually will lead to a better outcome for patients.', NULL),
(38, 'Science Breakthrough: Scientists Discover New Planet in Solar System', 13, '2023-01-29T11:26:00', '12', 'In a groundbreaking discovery, a team of scientists from the University of PlanetUniversity have announced the discovery of a new planet in our solar system. The planet, named Kepler-Bb, is located in the Alpha Centauri star system and is approximately the same size as Earth.\r\n\r\nThe discovery was made using the Kepler telescope, which is capable of detecting the small wobbles in a star\'s motion caused by the gravitational pull of orbiting planets. This method, known as the radial velocity method, is one of the most successful ways to detect exoplanets, or planets outside of our solar system.\r\n\r\nThe newly discovered planet is located in the habitable zone of its star, which means that it has the potential to have liquid water on its surface, a key ingredient for life as we know it. However, scientists caution that much more research is needed to determine if the planet is actually habitable or if it has the potential to support life.\r\n\r\nThis discovery is a major step forward in the search for other planets like Earth and could potentially lead to the discovery of extraterrestrial life. It also opens up new possibilities for future space exploration and the study of other planetary systems.\r\n\r\nThe team\'s findings were published in the journal Nature, and the discovery has been widely covered in the media and has generated a lot of interest among scientists and the general public alike.', '1674970860.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(250) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(13, 'Science'),
(14, 'Technology'),
(15, 'Buisness'),
(16, 'Politics'),
(17, 'Sports'),
(18, 'Entertainment'),
(19, 'World');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(200) NOT NULL,
  `content` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `articleId` int(200) NOT NULL,
  `publishedBy` int(11) NOT NULL,
  `publishedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(250) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `isSuperAdmin` int(2) NOT NULL DEFAULT 0,
  `isAdmin` bit(2) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `createdAt`, `isSuperAdmin`, `isAdmin`) VALUES
(12, 'SuperAdmin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2023-01-29T11:11:15', 1, b'01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
