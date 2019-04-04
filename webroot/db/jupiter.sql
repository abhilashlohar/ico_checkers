-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2019 at 05:55 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jupiter`
--

-- --------------------------------------------------------

--
-- Table structure for table `airdrops`
--

CREATE TABLE `airdrops` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airdrops`
--

INSERT INTO `airdrops` (`id`, `name`, `link`, `country`, `email`, `created_on`, `is_deleted`) VALUES
(1, 'ico test', 'ico', 'india', 'ico@gmail.com', '0000-00-00 00:00:00', 0),
(2, 'dsaas', 'sds', 'sdsf', 'sddsf@sdfsf.sdf', '2019-03-24 09:17:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `icos`
--

CREATE TABLE `icos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `applied_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `icos`
--

INSERT INTO `icos` (`id`, `name`, `link`, `country`, `email`, `applied_on`) VALUES
(1, 'ICO Name', 'https;cdsfsdf.com', 'India', 'sds@adsad.xc', '2019-03-24 09:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `is_approved` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `published_on` datetime NOT NULL,
  `category` varchar(15) NOT NULL,
  `tags` text NOT NULL,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `short_description`, `description`, `cover_image`, `is_approved`, `created_by`, `created_on`, `published_on`, `category`, `tags`, `is_deleted`) VALUES
(1, 'LokSabha Elections 2019: आजमगढ़ से लोकसभा चुनाव लड़ेंगे अखिलेश, रामपुर से आजम खां को टिकट', 'समाजवादी पार्टी (Samajwadi Party) ने आगामी लोकसभा चुनाव (LokSabha Elections 2019) के लिए रविवार को अपने दो और उम्मीदवारों के नामों का ऐलान कर दिया। इन नामों में सपा अध्यक्ष अखिलेश यादव (Akhilesh Yadav) का नाम भी शामिल है। ', 'समाजवादी पार्टी (Samajwadi Party) ने आगामी लोकसभा चुनाव (LokSabha Elections 2019) के लिए रविवार को अपने दो और उम्मीदवारों के नामों का ऐलान कर दिया। इन नामों में सपा अध्यक्ष अखिलेश यादव (Akhilesh Yadav) का नाम भी शामिल है। \n\nसमाजवादी पार्टी के राष्ट्रीय अध्यक्ष अखिलेश यादव यूपी के आजमगढ़ से चुनाव लड़ेंगे। इसके अलावा पार्टी के वरिष्ठ नेता आजम खां को रामपुर से चुनावी मैदान में उतारा गया है।\n\nआजमगढ़ सीट से इस वक्त अखिलेश के पिता एवं सपा संस्थापक मुलायम सिंह यादव सांसद हैं। उन्हें सपा ने इस बार मैनपुरी से टिकट दिया है। अखिलेश के आजमगढ़ से चुनाव लड़ने की अटकलें पहले से ही लगाई जा रही थीं। आजम खान रामपुर से सपा के मौजूदा विधायक हैं और इस बार वह रामपुर लोकसभा सीट से सपा के प्रत्याशी होंगे।\n\nबता दें कि मुलायम सिंह यादव मैनपुरी से उम्मीदवार बनाए गए हैं। वहीं, डिम्पल यादव कन्नौज से उम्मीदवार होंगी। धर्मेन्द्र यादव बदायूं से, अक्षय यादव फिरोजाबाद से, कमलेश कठेरिया इटावा, भाईलाल कोल राबर्टसगंज और शब्बीर बाल्मीकि बहराइच से पार्टी उम्मीदवार होंगे। ', 'news/news.png', 'yes', 11, '2019-03-24 07:05:11', '2019-03-24 07:08:00', '', '', 0),
(2, 'ऐसे करें तरह-तरह की ज्वैलरी की सही लेयरिंग', NULL, 'लेयरिंग, फैशन का नया मंत्र है। फिर चाहे कपड़े हों या ज्वेलरी, सही तरीके से इनकी लेयरिंग करके आप खुद को स्टाइलिश और अलग लुक दे सकती हैं। आप ऑफिस में हैं और आपको दोस्तों के साथ फिल्म देखने जाना है। आपके ऑफिस लुक को तब्दील करने के लिए ज्वेलरी की लेर्यंरग ही काफी है। या आपको किसी पार्टी में भी जाना है और आप स्टाइल स्टेटमेंट बनाना चाहती हैं तो इसके लिए भी ज्वेलरी की सही लेयरिंग से बेहतर कोई अन्य विकल्प नहीं है। तो फिर देर किस बात की, अपनी ड्र्रेंसग टेबल से आकर्षक ज्वेलरी को बाहर निकालिए और खुद को स्टाइलिश लुक देने के लिए तैयार हो जाइए। कैसे करें ज्वेलरी की लेयरिंग आइए जानें :\r\n\r\nज्वेलरी हो एक जैसी\r\nज्वेलरी लेयरिंग करते समय सबसे जरूरी जो बात है, वह यह है कि आप हमेशा एक जैसे लुक वाली ज्वेलरी ही पहनिए। कहने का मतलब है कि यदि आप ब्लैक मेटल ज्वेलरी पहन रही हैं तो लेयरिंग के लिए सभी ब्लैक मेटल ज्वेलरी का ही प्रयोग करें। ब्लैक मेटल के साथ गोल्डन ज्वेलरी खराब दिखेगी। एक जैसे लुक वाली ज्वेलरी ब्लॉक इफेक्ट देती है और स्टाइल स्टेटमेंट देने के लिए उपयुक्त भी है। साथ ही ध्यान यह भी रखिए कि यदि धातु एक जैसी हैं तो डिजाइन अलग होने चाहिए। यदि आप नेकलेस के साथ लेर्यंरग कर रही हैं तो उसके पेंडेंट अलग हों और नेकलेस का डिजाइन भी अलग हो। \r\n\r\nऐसे करें लेयरिंग\r\nयदि आपको भारी ज्वेलरी पहनना पसंद नहीं है तो उसे भी ड्रॉअर से निकालने का समय आ गया है। भारी ज्वेलरी के साथ कोई हल्की डिजाइन वाली नेकलेस की लेयरिंग कीजिए। यह काफी क्लासिक लुक देता है। आप चाहें तो इसे कॉलर वाली कलर ब्लॉक शर्ट के साथ पहन सकती हैं। यह बोहेमियन लुक देता है, जो कि इन दिनों ट्रेंड में भी है। लेर्यंरग वाला लुक तब कमाल का लगता है, जब आपके नेकलेस विभिन्न आकार और हल्के डिजाइन वाले होते हैं। इसलिए, आपके पास जितनी भी हल्की नेकलेस हैं, उन सबको लेर्यंरग करके पहनने का समय आ गया है। यदि नहीं हैं तो कुछ हल्की और अलग-अलग लंबाई वाली नेकलेस खरीद लीजिए। विभिन्न साइज वाली नेकलेस पहनने का फायदा यह है कि सभी के डिजाइन दिखते हैं। यह इतना कमाल लगता है कि आपकी किसी भी फीकी ड्रेस को पार्टी वियर बना सकता है। \r\n\r\nकान दिखेंगे कमाल\r\nकानों में एक के बजाय ज्यादा ईयरिंग पहनने से यह काफी डेकोरेटिव लुक देता है। एक बड़ा स्टेटमेंट ईयर्रंरग पहनिए, जैसे टैसल ईयर्रंरग और इसके साथ डेलिकेट स्टड। इन दिनों दोनों कानों में अलग-अलग डिजाइन वाली ईयर्रंरग पहनने का भी चलन है। एक कान में एक ही लंबी लटकती ईयर्रंरग और दूसरे में छोटी-सी। \r\n\r\nअनोखी अंगूठियां\r\nजिन लोगों को गले में कुछ पहनना पसंद नहीं है, वे लोग अंगूठी के साथ लेयरिंग का फंडा आजमा सकती हैं। लंबी, पतली और आसान डिजाइन वाली अंगूठियां खरीदिए। चाहें तो इन्हें एक ही उंगली में पहनें या फिर अलग-अलग उंगलियों में। \r\n\r\nब्रेसलेट्स का बोलबाला\r\nब्रेसलेट्स की लेयरिंग भी इतनी खूबसूरत दिखती है कि इन्हें पहने हाथों से नजर हटाने का मन ही नहीं करेगा। अलग-अलग डिजाइन वाले बे्रसलेट को पहनकर आप लेर्यंरग को एक अलग ऊंचाई तक ले जा सकती हैं। \r\n\r\nइन बातों का भी रखें ध्यान\r\n’  ज्वेलरी की लेर्यंरग के समय संतुलित लुक रखना जरूरी है। \r\n’  हर ज्वेलरी दूसरे के साथ अच्छी दिखनी चाहिए। भीड़-सी दिखाती ज्वेलरी या एक-दूसरे में उलझी ज्वेलरी खराब लुक देती है। आप भी चाहती होंगी कि लेयर्ड ज्वेलरी एक- दूसरे में उलझी न दिखे। \r\n’  बोल्ड स्टेटमेंट ज्वेलरी पतली और बारीक ज्वेलरी के साथ अच्छी दिखती हैं। दो बड़ी-बड़ी और बोल्ड ज्वेलरी को साथ नहीं पहनें। ऐसा करने से आप अजीब-सी दिखेंगी। बढ़िया तो यह होगा कि कई तरह के डिजाइन वाली ज्वेलरी की लेर्यंरग करें।\r\n’  लेयरिंग के समर्य ंसपल ज्वेलरी ही पहनें। ये तभी आकर्षक लगती हैं।\r\n’  प्राकृतिक लुक के लिए ज्वेलरी के टेक्सचर और स्टोन को मिक्स और मैच करके पहनें।\r\n\r\n', '', 'no', 11, '2019-03-24 07:09:39', '0000-00-00 00:00:00', '', '', 0),
(3, 'IPL 2019, KKR vs SRH: Sunrisers Hyderabad’s Predicted XI against Kolkata Knight Riders', NULL, 'Sunrisers Hyderabad, with their potent bowling attack, are one of the favourites this year and with the inclusion of David Warner in their ranks, can be a team other sides need to wary about.\r\n\r\nThey will be up against Kolkata Knight Riders in their first match of the season and we try to predict Hyderabad’s predicted XI.\r\n\r\nDavid Warner\r\n\r\nThe Australian is back in the fold and he will stride out to open the innings for his side. A fit and firing Warner at the top of the order could be just what Hyderabad would want to get their season underway.\r\n\r\nManish Pandey\r\n\r\nHe was a big ticket but for the side last season, but did not have an entirely memorable season for Sunrisers. However, he has been in good form in the recent domestic season and can walk out to bat at the crucial number 3 position for his side.\r\n\r\nVijay Shankar\r\n\r\nAfter being impressive in the limited opportunities his got for the Indian side, this season could be all about Vijay Shankar, the all-rounder for Sunrisers Hyderabad. A bumper season in the IPL and Shankar could well be on his way to England.\r\n\r\nShakib al Hasan\r\n\r\nThe gun all-rounder from Bangladesh, Shakib renders great balance to the side and his experience both with the bat and ball will be crucial to the fortunes of the side.\r\n\r\nDeepak Hooda\r\n\r\nThe Baroda all-rounder now has plenty of experience in the IPL and his season, he needs to step up and make an impression. He has played a few memorable knocks in the past, but this season, he has to be more consistent for his side.\r\n\r\nALSO READ: Potent bowling attack, effective overseas crop could hand SRH the title - SWOT analysis\r\n\r\nRashid Khan\r\n\r\nThe X-factor for SRH with the ball, but Rashid has grown leaps and bound with the bat over the last one year. He is a clean striker of the ball and can be potent with the long handle in the final few overs.\r\n\r\nBhuvneshwar Kumar\r\n\r\nIn the match against KKR, Bhuvneshwar could lead the side in the absence of David Warner and hence, will be under a lot of pressure to get things rolling for his side, both with the ball and as a skipper of the side.\r\n\r\nShahbaz Nadeem\r\n\r\nAfter spending all these years with Delhi Daredevils (now Delhi Capitals), Shahbaz Nadeem will now turn up for the Sunrisers Hyderabad and on the sluggish surfaces in Hyderabad, his canny bowling can be a real asset for the side.\r\n\r\nSiddarth Kaul\r\n\r\nThe bowler with the band, Siddarth Kaul has been a consistent performer for his side over the last couple of seasons and now, is one of the senior members in the side and will be expected to come up with the goods.\r\n\r\nKhaleel Ahmed\r\n\r\nThe young left-hander tapered off after a bright debut and would want to reclaim his spot back for the World Cup with a bumper season for Sunrisers Hyderabad.', '', 'no', 11, '2019-03-24 07:11:04', '0000-00-00 00:00:00', '', '', 0),
(4, ' RBI defers implementing Ind AS, yet again', NULL, '<div class=\"form-group\">\n  <label for=\"sel1\">Select list:</label>\n  <select class=\"form-control\" id=\"sel1\">\n    <option>1</option>\n    <option>2</option>\n    <option>3</option>\n    <option>4</option>\n  </select>\n</div>', '', 'no', 11, '2019-03-24 07:32:25', '0000-00-00 00:00:00', '', '', 0),
(5, ' RBI defers implementing Ind AS, yet again', 'RBI defers implementing Ind AS, yet again', 'category', 'news/news.png', 'yes', 11, '2019-03-24 07:33:38', '2019-03-24 07:34:00', 'India', '', 0),
(6, ' RBI defers implementing Ind AS, yet again', NULL, 'tag1, tag2, tag3', '', 'no', 11, '2019-03-24 07:43:29', '0000-00-00 00:00:00', 'India', 'tag1, tag2, tag3, tag tag 4,', 0),
(7, 'eff', NULL, 'dfghjk', 'Yekaterinburg_skyline2.jpg', 'no', 11, '2019-03-29 04:28:41', '0000-00-00 00:00:00', 'India', 'sdfghjk', 0),
(8, 'garma garam news', NULL, 'qwqw', 'news\\tulips.jpg', 'no', 11, '2019-03-29 04:39:14', '0000-00-00 00:00:00', 'India', 'qwqw', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `created_on` datetime NOT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `short_description`, `description`, `created_on`, `is_deleted`) VALUES
(1, 'Task 1 --', '', 'Earn Money / advertising\r\nTasks- title, description, link etc.\r\nPoints after approval\r\nSubmit proof email id /screenshot/ user name\r\nAdd point row like 1-50 (Need clerity)', '2019-03-20 10:00:00', 0),
(2, 'task', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', '2019-04-01 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `task_proofs`
--

CREATE TABLE `task_proofs` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `task_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_proofs`
--

INSERT INTO `task_proofs` (`id`, `user_id`, `message`, `image`, `task_id`) VALUES
(4, 6, 'hiii', 'task_proof\\chrysanthemum (1).jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(180) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(240) NOT NULL,
  `role` enum('Admin','User','Staff') NOT NULL,
  `mobile` varchar(21) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `is_system` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `password_token` varchar(50) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '0 - Not Deleted, Null - Deleted',
  `created_by` mediumint(8) UNSIGNED DEFAULT NULL,
  `modified_by` mediumint(8) UNSIGNED DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `mobile`, `password`, `status`, `is_system`, `last_login`, `password_token`, `token_expiry`, `is_deleted`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(1, 'admin', 'admin', 'admin@ifwworld.com', 'Admin', '98745632510', '$2y$10$pmXH3Juo4k0Iy9fMgwqetewv1T1H2EvT.c6S63osw3mMiUHWvWLgi', 1, 1, '2019-03-18 17:19:38', NULL, NULL, 0, 1, 1, '2018-06-06 00:00:00', '2019-03-18 17:19:38'),
(2, 'ramesh', '', 'ramesh@gmail.com', '', '9876543211', 'admin123', 0, 0, NULL, NULL, NULL, 0, NULL, NULL, '2019-03-25 16:30:07', '2019-03-25 16:30:07'),
(3, 'ram', '', 'ram@gmail.com', '', '9878675645', '$2y$10$XWNUyhUfvg89WvSkumQxm.09bZuhjg0eTjq35CqCZX5AywZClQAxG', 0, 0, NULL, NULL, NULL, 0, NULL, NULL, '2019-03-25 16:35:42', '2019-03-25 16:35:42'),
(4, 'manoj', '', 'manoj@gmail.com', '', '8877663423', '$2y$10$gds1apov/DhHtHWGK9lQ1uHlgW0IymNL4RN3srvybAp2MINYyhQxW', 0, 0, NULL, NULL, NULL, 0, NULL, NULL, '2019-03-27 17:11:12', '2019-03-27 17:11:12'),
(5, 'dilip', 'dilip', 'dilip@gmail.com', 'User', '9623123456', '$2y$10$Ekp1Bv6hVVS6vo8n9wNZwO34eSzv1GMbF4S1CdvXhw9Qx3yH2HVSW', 1, 0, NULL, NULL, NULL, 0, NULL, NULL, '2019-03-31 02:39:59', '2019-03-31 02:39:59'),
(6, 'anita', 'anita', 'anita@gmail.com', 'User', '9812678989', '$2y$10$LTB5S34jNqCPpPOny4bii.x02GQ.BTyfQSr7IEx/U48YgcfltFHBu', 1, 0, NULL, NULL, NULL, 0, NULL, NULL, '2019-03-31 02:45:07', '2019-03-31 02:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `point` decimal(8,2) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `news_id` int(10) NOT NULL,
  `task_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airdrops`
--
ALTER TABLE `airdrops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icos`
--
ALTER TABLE `icos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_proofs`
--
ALTER TABLE `task_proofs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airdrops`
--
ALTER TABLE `airdrops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `task_proofs`
--
ALTER TABLE `task_proofs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
