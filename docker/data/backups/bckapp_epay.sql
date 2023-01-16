-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2023 at 10:49 PM
-- Server version: 8.0.31-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bckapp_epay`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint UNSIGNED NOT NULL,
  `currency_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `currency_id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(51, 1, 'Bank of America', 'BOFA', '2022-10-17 12:37:39', '2022-10-17 12:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` json DEFAULT NULL,
  `lang` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `key`, `value`, `lang`, `status`, `created_at`, `updated_at`) VALUES
(14, 'faq', '{\"answer\": \"Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt eiusmod.\", \"question\": \"What is the regular license?\"}', 'en', 1, '2022-07-31 14:39:28', '2022-07-31 14:50:48'),
(15, 'faq', '{\"answer\": \"Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt eiusmod.\", \"question\": \"How can I purchased The Sell?\"}', 'en', 1, '2022-07-31 14:39:29', '2022-07-31 14:51:06'),
(16, 'faq', '{\"answer\": \"Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt eiusmod.\", \"question\": \"What are the minimum requirements?\"}', 'en', 1, '2022-07-31 14:39:31', '2022-07-31 14:51:21'),
(17, 'reviews', '{\"name\": \"Ajoy Das\", \"image\": \"/uploads/1/22/07/62e68167244e53107221659273575.jpg\", \"rating\": \"5\", \"comment\": \"Veritatis fugit quam blanditiis rerum reprehenderit maxime expedita odit,\\r\\n                                laboriosam voluptatibus? Iure corporis nulla eveniet quam.\", \"position\": \"CEO\"}', 'en', 1, '2022-07-31 14:47:55', '2022-07-31 14:47:55'),
(18, 'reviews', '{\"name\": \"Chaity Shaha\", \"image\": \"/uploads/1/22/07/62e681674414c3107221659273575.jpg\", \"rating\": \"4\", \"comment\": \"Veritatis fugit quam blanditiis rerum reprehenderit maxime expedita edit,  laboriosam voluptatibus? Iure corporis nulla eveniet quam.\", \"position\": \"CEO\"}', 'en', 1, '2022-07-31 14:48:35', '2022-07-31 14:48:35'),
(19, 'reviews', '{\"name\": \"Chaity Shaha\", \"image\": \"/uploads/1/22/07/62e681674414c3107221659273575.jpg\", \"rating\": \"4\", \"comment\": \"Veritatis fugit quam blanditiis rerum reprehenderit maxime expedita edit,  laboriosam voluptatibus? Iure corporis nulla eveniet quam.\", \"position\": \"Developer\"}', 'en', 1, '2022-07-31 14:48:35', '2022-07-31 14:48:35'),
(20, 'reviews', '{\"name\": \"Ajoy Das\", \"image\": \"/uploads/1/22/07/62e68167244e53107221659273575.jpg\", \"rating\": \"5\", \"comment\": \"Veritatis fugit quam blanditiis rerum reprehenderit maxime expedita odit,\\r\\n                                laboriosam voluptatibus? Iure corporis nulla eveniet quam.\", \"position\": \"Developer\"}', 'en', 1, '2022-07-31 14:47:55', '2022-07-31 14:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `contact_mails`
--

CREATE TABLE `contact_mails` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `country_name`, `code`, `rate`, `symbol`, `position`, `status`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'US Dollar', 'United States', 'USD', 1, '$', 'left', 1, 1, '2022-08-07 19:04:59', '2022-10-17 12:38:02'),
(2, 'Euro', 'Estonia', 'EUR', 0.98, '€', 'left', 0, 0, '2022-08-07 19:04:59', '2022-11-14 14:43:14'),
(4, 'Indian Rupee', 'India', 'INR', 79.37, '₹', 'left', 0, 0, '2022-08-07 19:04:59', '2022-10-17 12:54:37'),
(5, 'Nigerian Naira', 'Nigeria', 'NGN', 417.57, '₦', 'left', 1, 0, '2022-08-07 19:04:59', '2022-12-09 10:01:20'),
(6, 'Malaysian Ringgit', 'Malaysia', 'MYR', 4.46, 'RM', 'left', 0, 0, '2022-08-07 19:04:59', '2022-10-17 12:55:23'),
(7, 'Omani rial', 'Afghanistan', 'OMR', 0.39, 'ر.ع.', 'right', 0, 0, '2022-08-07 19:04:59', '2022-10-17 12:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `gateway_id` bigint UNSIGNED NOT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `status` int DEFAULT NULL,
  `payment_status` int DEFAULT NULL,
  `charge` double DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `gateway_id`, `currency_id`, `trx`, `amount`, `total_amount`, `status`, `payment_status`, `charge`, `rate`, `meta`, `created_at`, `updated_at`) VALUES
(1, 9, 14, 1, 'VTfsHA06XEIoTum161', 500, 2, 2, 2, 2, 1, NULL, '2022-11-29 08:37:44', '2022-11-29 08:37:44'),
(2, 14, 14, 1, 'XsDwysisgiiGy5c163', 100, 2, 2, 2, 2, 1, NULL, '2022-12-10 01:15:18', '2022-12-10 01:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `donationorders`
--

CREATE TABLE `donationorders` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `charge` double DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `is_anonymous` int NOT NULL DEFAULT '0',
  `data` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donor_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `gateway_id` bigint UNSIGNED NOT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `donation_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `currency_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'd36df6d1-b917-43e8-9e67-3adbbd9834e7', 'database', 'default', '{\"uuid\":\"d36df6d1-b917-43e8-9e67-3adbbd9834e7\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":5:{s:29:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000invoice\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Invoice\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:1:{i:0;s:8:\\\"currency\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:30:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000subTotal\\\";s:7:\\\"$100.00\\\";s:27:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000total\\\";s:7:\\\"$100.00\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"jersongil21@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Expected response code \"354\" but got code \"550\", with message \"550 5.7.0 Requested action not taken: too many emails per second\". in /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:317\nStack trace:\n#0 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(180): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(105): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(202): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#4 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#5 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#6 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#7 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\\Mail\\Mailer->send()\n#8 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(212): Illuminate\\Mail\\Mailable->withLocale()\n#10 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(65): Illuminate\\Mail\\Mailable->send()\n#11 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#12 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#16 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#28 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#29 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#30 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#36 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(139): Illuminate\\Container\\Container->call()\n#37 /home/bckapp/public_html/epay/script/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#38 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(124): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(998): Illuminate\\Console\\Command->run()\n#40 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#43 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/bckapp/public_html/epay/script/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}', '2022-11-10 22:45:07'),
(2, '78be3abb-1ac5-4877-84eb-4b1cdeb08771', 'database', 'default', '{\"uuid\":\"78be3abb-1ac5-4877-84eb-4b1cdeb08771\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":5:{s:29:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000invoice\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Invoice\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:1:{i:0;s:8:\\\"currency\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:30:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000subTotal\\\";s:7:\\\"$122.00\\\";s:27:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000total\\\";s:7:\\\"$122.00\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"jersongil21@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Expected response code \"354\" but got code \"550\", with message \"550 5.7.0 Requested action not taken: too many emails per second\". in /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:317\nStack trace:\n#0 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(180): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(105): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(202): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#4 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#5 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#6 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#7 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\\Mail\\Mailer->send()\n#8 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(212): Illuminate\\Mail\\Mailable->withLocale()\n#10 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(65): Illuminate\\Mail\\Mailable->send()\n#11 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#12 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#16 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#28 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#29 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#30 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#36 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(139): Illuminate\\Container\\Container->call()\n#37 /home/bckapp/public_html/epay/script/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#38 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(124): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(998): Illuminate\\Console\\Command->run()\n#40 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#43 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/bckapp/public_html/epay/script/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}', '2022-11-10 22:45:07'),
(3, '239b925e-225d-4e5a-b909-aaa0dc1e69e4', 'database', 'default', '{\"uuid\":\"239b925e-225d-4e5a-b909-aaa0dc1e69e4\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":5:{s:29:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000invoice\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Invoice\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:1:{i:0;s:8:\\\"currency\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:30:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000subTotal\\\";s:7:\\\"$122.00\\\";s:27:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000total\\\";s:7:\\\"$122.00\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"jersongil21@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Expected response code \"354\" but got code \"550\", with message \"550 5.7.0 Requested action not taken: too many emails per second\". in /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:317\nStack trace:\n#0 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(180): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(105): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(202): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#4 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#5 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#6 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#7 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\\Mail\\Mailer->send()\n#8 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(212): Illuminate\\Mail\\Mailable->withLocale()\n#10 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(65): Illuminate\\Mail\\Mailable->send()\n#11 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#12 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#16 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#28 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#29 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#30 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#36 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(139): Illuminate\\Container\\Container->call()\n#37 /home/bckapp/public_html/epay/script/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#38 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(124): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(998): Illuminate\\Console\\Command->run()\n#40 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#43 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/bckapp/public_html/epay/script/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}', '2022-11-10 22:45:08'),
(4, 'ec37aa81-11a2-4e35-bf00-3ee1cd516963', 'database', 'default', '{\"uuid\":\"ec37aa81-11a2-4e35-bf00-3ee1cd516963\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":5:{s:29:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000invoice\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Invoice\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:1:{i:0;s:8:\\\"currency\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:30:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000subTotal\\\";s:7:\\\"$122.00\\\";s:27:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000total\\\";s:7:\\\"$122.00\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"jersongil21@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Expected response code \"354\" but got code \"550\", with message \"550 5.7.0 Requested action not taken: too many emails per second\". in /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:317\nStack trace:\n#0 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(180): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(105): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(202): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#4 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#5 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#6 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#7 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\\Mail\\Mailer->send()\n#8 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(212): Illuminate\\Mail\\Mailable->withLocale()\n#10 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(65): Illuminate\\Mail\\Mailable->send()\n#11 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#12 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#16 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#28 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#29 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#30 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#36 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(139): Illuminate\\Container\\Container->call()\n#37 /home/bckapp/public_html/epay/script/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#38 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(124): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(998): Illuminate\\Console\\Command->run()\n#40 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#43 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/bckapp/public_html/epay/script/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}', '2022-11-10 22:45:08'),
(5, '93cb7367-8300-4ad3-9b39-7224e8693e29', 'database', 'default', '{\"uuid\":\"93cb7367-8300-4ad3-9b39-7224e8693e29\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":5:{s:29:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000invoice\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Invoice\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:1:{i:0;s:8:\\\"currency\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:30:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000subTotal\\\";s:7:\\\"$122.00\\\";s:27:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000total\\\";s:7:\\\"$122.00\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"jersongil21@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Expected response code \"354\" but got code \"550\", with message \"550 5.7.0 Requested action not taken: too many emails per second\". in /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:317\nStack trace:\n#0 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(180): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(105): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(202): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#4 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#5 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#6 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#7 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\\Mail\\Mailer->send()\n#8 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(212): Illuminate\\Mail\\Mailable->withLocale()\n#10 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(65): Illuminate\\Mail\\Mailable->send()\n#11 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#12 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#16 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#28 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#29 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#30 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#36 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(139): Illuminate\\Container\\Container->call()\n#37 /home/bckapp/public_html/epay/script/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#38 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(124): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(998): Illuminate\\Console\\Command->run()\n#40 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#43 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/bckapp/public_html/epay/script/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}', '2022-11-10 22:45:09');
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(6, '8100c83d-9a8c-4bf1-ab1b-45a209b547b3', 'database', 'default', '{\"uuid\":\"8100c83d-9a8c-4bf1-ab1b-45a209b547b3\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":5:{s:29:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000invoice\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Invoice\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:1:{i:0;s:8:\\\"currency\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:30:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000subTotal\\\";s:7:\\\"$122.00\\\";s:27:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000total\\\";s:7:\\\"$122.00\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"jersongil21@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Expected response code \"354\" but got code \"550\", with message \"550 5.7.0 Requested action not taken: too many emails per second\". in /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:317\nStack trace:\n#0 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(180): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(105): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(202): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#4 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#5 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#6 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#7 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\\Mail\\Mailer->send()\n#8 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(212): Illuminate\\Mail\\Mailable->withLocale()\n#10 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(65): Illuminate\\Mail\\Mailable->send()\n#11 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#12 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#16 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#28 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#29 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#30 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#36 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(139): Illuminate\\Container\\Container->call()\n#37 /home/bckapp/public_html/epay/script/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#38 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(124): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(998): Illuminate\\Console\\Command->run()\n#40 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#43 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/bckapp/public_html/epay/script/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}', '2022-11-10 22:45:09'),
(7, '52b699d8-be67-48f4-b300-007f8d5e2aac', 'database', 'default', '{\"uuid\":\"52b699d8-be67-48f4-b300-007f8d5e2aac\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":5:{s:29:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000invoice\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Invoice\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:1:{i:0;s:8:\\\"currency\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:30:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000subTotal\\\";s:9:\\\"$1,111.00\\\";s:27:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000total\\\";s:9:\\\"$1,111.00\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"jersongil21@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Expected response code \"354\" but got code \"550\", with message \"550 5.7.0 Requested action not taken: too many emails per second\". in /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:317\nStack trace:\n#0 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(180): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(105): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(202): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#4 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#5 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#6 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#7 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\\Mail\\Mailer->send()\n#8 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(212): Illuminate\\Mail\\Mailable->withLocale()\n#10 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(65): Illuminate\\Mail\\Mailable->send()\n#11 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#12 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#16 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#28 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#29 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#30 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#36 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(139): Illuminate\\Container\\Container->call()\n#37 /home/bckapp/public_html/epay/script/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#38 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(124): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(998): Illuminate\\Console\\Command->run()\n#40 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#43 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/bckapp/public_html/epay/script/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}', '2022-11-10 22:45:10'),
(8, '8b6c172c-88fe-4f61-a4be-06b72e1c5a65', 'database', 'default', '{\"uuid\":\"8b6c172c-88fe-4f61-a4be-06b72e1c5a65\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":5:{s:29:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000invoice\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Invoice\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:1:{i:0;s:8:\\\"currency\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:30:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000subTotal\\\";s:9:\\\"$1,111.00\\\";s:27:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000total\\\";s:9:\\\"$1,111.00\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"jersongil21@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Expected response code \"354\" but got code \"550\", with message \"550 5.7.0 Requested action not taken: too many emails per second\". in /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:317\nStack trace:\n#0 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(180): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(105): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(202): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#4 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#5 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#6 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#7 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\\Mail\\Mailer->send()\n#8 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(212): Illuminate\\Mail\\Mailable->withLocale()\n#10 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(65): Illuminate\\Mail\\Mailable->send()\n#11 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#12 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#16 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#28 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#29 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#30 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#36 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(139): Illuminate\\Container\\Container->call()\n#37 /home/bckapp/public_html/epay/script/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#38 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(124): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(998): Illuminate\\Console\\Command->run()\n#40 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#43 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/bckapp/public_html/epay/script/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}', '2022-11-10 22:45:10'),
(9, 'cba1f644-33c2-48b0-b48f-0ba8d4d2a816', 'database', 'default', '{\"uuid\":\"cba1f644-33c2-48b0-b48f-0ba8d4d2a816\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":5:{s:29:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000invoice\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Invoice\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:1:{i:0;s:8:\\\"currency\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:30:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000subTotal\\\";s:9:\\\"$1,111.00\\\";s:27:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000total\\\";s:9:\\\"$1,111.00\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"jersongil21@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Expected response code \"354\" but got code \"550\", with message \"550 5.7.0 Requested action not taken: too many emails per second\". in /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:317\nStack trace:\n#0 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(180): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(105): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(202): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#4 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#5 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#6 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#7 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\\Mail\\Mailer->send()\n#8 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(212): Illuminate\\Mail\\Mailable->withLocale()\n#10 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(65): Illuminate\\Mail\\Mailable->send()\n#11 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#12 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#16 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#28 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#29 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#30 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#36 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(139): Illuminate\\Container\\Container->call()\n#37 /home/bckapp/public_html/epay/script/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#38 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(124): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(998): Illuminate\\Console\\Command->run()\n#40 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#43 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/bckapp/public_html/epay/script/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}', '2022-11-10 22:45:11'),
(10, 'bf76db91-7317-4af8-bb03-92fe8961cd6f', 'database', 'default', '{\"uuid\":\"bf76db91-7317-4af8-bb03-92fe8961cd6f\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":5:{s:29:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000invoice\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Invoice\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:1:{i:0;s:8:\\\"currency\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:30:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000subTotal\\\";s:9:\\\"$1,111.00\\\";s:27:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000total\\\";s:9:\\\"$1,111.00\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"jersongil21@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Expected response code \"354\" but got code \"550\", with message \"550 5.7.0 Requested action not taken: too many emails per second\". in /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:317\nStack trace:\n#0 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(180): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(105): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(202): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#4 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#5 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#6 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#7 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\\Mail\\Mailer->send()\n#8 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(212): Illuminate\\Mail\\Mailable->withLocale()\n#10 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(65): Illuminate\\Mail\\Mailable->send()\n#11 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#12 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#16 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#28 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#29 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#30 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#36 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(139): Illuminate\\Container\\Container->call()\n#37 /home/bckapp/public_html/epay/script/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#38 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(124): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(998): Illuminate\\Console\\Command->run()\n#40 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#43 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/bckapp/public_html/epay/script/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}', '2022-11-10 22:45:12');
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(11, '98730df9-ccc9-4092-b49f-decae249a58d', 'database', 'default', '{\"uuid\":\"98730df9-ccc9-4092-b49f-decae249a58d\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":5:{s:29:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000invoice\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Invoice\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:1:{i:0;s:8:\\\"currency\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:30:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000subTotal\\\";s:9:\\\"$1,111.00\\\";s:27:\\\"\\u0000App\\\\Mail\\\\InvoiceMail\\u0000total\\\";s:9:\\\"$1,111.00\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"jersongil21@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Expected response code \"354\" but got code \"550\", with message \"550 5.7.0 Requested action not taken: too many emails per second\". in /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:317\nStack trace:\n#0 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(180): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(105): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(202): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#4 /home/bckapp/public_html/epay/script/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#5 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#6 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#7 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\\Mail\\Mailer->send()\n#8 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(212): Illuminate\\Mail\\Mailable->withLocale()\n#10 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(65): Illuminate\\Mail\\Mailable->send()\n#11 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#12 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#16 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#28 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#29 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#30 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#36 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(139): Illuminate\\Container\\Container->call()\n#37 /home/bckapp/public_html/epay/script/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#38 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Command.php(124): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(998): Illuminate\\Console\\Command->run()\n#40 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/bckapp/public_html/epay/script/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#43 /home/bckapp/public_html/epay/script/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/bckapp/public_html/epay/script/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}', '2022-11-10 22:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` double NOT NULL DEFAULT '0',
  `namespace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_amount` double NOT NULL DEFAULT '1',
  `max_amount` double NOT NULL DEFAULT '1000',
  `is_auto` int NOT NULL DEFAULT '0',
  `image_accept` int DEFAULT NULL,
  `test_mode` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `phone_required` int NOT NULL DEFAULT '0',
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `fields` json DEFAULT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `name`, `logo`, `charge`, `namespace`, `min_amount`, `max_amount`, `is_auto`, `image_accept`, `test_mode`, `status`, `phone_required`, `data`, `currency_id`, `fields`, `instructions`, `created_at`, `updated_at`) VALUES
(1, 'paypal', '/uploads/payment-gateway/paypal.png', 2, 'App\\Lib\\Paypal', 1, 1000, 1, NULL, 1, 1, 0, '{\"client_id\":\"ARKsbdD1qRpl3WEV6XCLuTUsvE1_5NnQuazG2Rvw1NkMG3owPjCeAaia0SXSvoKPYNTrh55jZieVW7xv\",\"client_secret\":\"EJed2cGACzB2SJFQwSannKAA1gyBjKkwlKh1o8G75zQHYzAgLQ3n7f9EfeNCZgtfPDMxyFzfp6oQWPia\"}', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-11-14 14:38:56'),
(2, 'stripe', '/uploads/payment-gateway/stripe.png', 20, 'App\\Lib\\Stripe', 1, 1000, 1, NULL, 1, 1, 0, '{\"publishable_key\":\"pk_test_51I8GqvBRq7fsgmoHB37mXDC3oNVtsJBMQRYeRLUykmuWlqihZ1kDvYeLUeno9Nkqze4axZF0nLeeqkdYJP42S06u00GEiuG8CS\",\"secret_key\":\"sk_test_51I8GqvBRq7fsgmoHldttMcxnaiSwu5thxGVELXwxd9la5NNttvNBICXTY7r0TkTEDKqzdIl9KZIJu6sNMJqMM1MZ00I8obAU6P\"}', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-11-14 14:17:35'),
(3, 'mollie', '/uploads/payment-gateway/mollie.png', 2, 'App\\Lib\\Mollie', 1, 1000, 1, NULL, 1, 0, 0, '{\"api_key\":\"test_WqUGsP9qywy3eRVvWMRayxmVB5dx2r\"}', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-12-09 09:59:01'),
(4, 'paystack', '/uploads/payment-gateway/paystack.png', 2, 'App\\Lib\\Paystack', 1, 1000, 1, NULL, 1, 0, 0, '{\"public_key\":\"pk_test_84d91b79433a648f2cd0cb69287527f1cb81b53d\",\"secret_key\":\"sk_test_cf3a234b923f32194fb5163c9d0ab706b864cc3e\"}', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-12-09 10:01:45'),
(5, 'razorpay', '/uploads/payment-gateway/rajorpay.png', 2, 'App\\Lib\\Razorpay', 1, 1000, 1, NULL, 1, 0, 0, '{\"key_id\":\"rzp_test_siWkeZjPLsYGSi\",\"key_secret\":\"jmIzYyrRVMLkC9BwqCJ0wbmt\"}', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-12-09 09:59:55'),
(6, 'instamojo', '/uploads/payment-gateway/instamojo.png', 2, 'App\\Lib\\Instamojo', 1, 1000, 1, NULL, 1, 0, 1, '{\"x_api_key\":\"test_0027bc9da0a955f6d33a33d4a5d\",\"x_auth_token\":\"test_211beaba149075c9268a47f26c6\"}', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-12-09 10:03:24'),
(7, 'toyyibpay', '/uploads/payment-gateway/toyybipay.png', 2, 'App\\Lib\\Toyyibpay', 1, 1000, 1, NULL, 1, 0, 1, '{\"user_secret_key\":\"v4nm8x50-bfb4-7f8y-evrs-85flcysx5b9p\",\"cateogry_code\":\"5cc45t69\"}', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-12-09 10:12:41'),
(8, 'flutterwave', '/uploads/payment-gateway/flutterwave.png', 2, 'App\\Lib\\Flutterwave', 1, 1000, 1, NULL, 1, 0, 1, '{\"public_key\":\"FLWPUBK_TEST-f448f625c416f69a7c08fc6028ebebbf-X\",\"secret_key\":\"FLWSECK_TEST-561fa94f45fc758339b1e54b393f3178-X\",\"encryption_key\":\"FLWSECK_TEST498417c2cc01\",\"payment_options\":\"card\"}', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-12-09 10:03:06'),
(9, 'payu', '/uploads/payment-gateway/payu.png', 2, 'App\\Lib\\Payu', 1, 1000, 1, NULL, 1, 0, 1, '{\"merchant_key\":\"IPeQuHyk\",\"merchant_salt\":\"YsfnYBVxYI\",\"auth_header\":\"VHgXMklEVpktkIZjOZjdUJKPdSPe+c5iICxOFwaC9T0=\"}', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-12-09 10:02:38'),
(10, 'thawani', '/uploads/payment-gateway/uhawan.png', 1, 'App\\Lib\\Thawani', 1, 1000, 1, NULL, 1, 0, 1, '{\"secret_key\":\"rRQ26GcsZzoEhbrP2HZvLYDbn9C9et\",\"publishable_key\":\"HGvTMLDssJghr9tlN9gr4DVYt0qyBy\"}', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-12-09 10:02:53'),
(11, 'mercadopago', '/uploads/payment-gateway/mercado-pago.png', 2, 'App\\Lib\\Mercado', 1, 1000, 1, NULL, 1, 1, 0, '{\"secret_key\":\"TEST-2964843767483023-122010-ce5c988a453d88949f2bf96934628bc0-318954416\",\"public_key\":\"TEST-6869c79b-a996-49f3-802b-84ddce4428b5\"}', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-12-20 14:49:57'),
(12, 'manual', '/uploads/payment-gateway/manual.png', 1, 'App\\Lib\\CustomGateway', 1, 1000, 1, NULL, 0, 1, 0, 'Manual', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-12-09 10:04:02'),
(13, 'Paynomy Wallet', 'https://epay.backlayer.app/uploads/epaywallet/22/12/63930937895580912221670580535.png', 1, 'App\\Lib\\Credit', 1, 1000, 1, NULL, 1, 1, 0, '', 1, NULL, NULL, '2022-10-17 11:42:09', '2022-12-09 10:08:55'),
(14, 'Zelle', 'https://epay.backlayer.app/uploads/epaywallet/22/11/63724eca232c71411221668435658.png', 2, 'App\\Lib\\CustomGateway', 1, 1000, 1, NULL, 0, 1, 0, '', 1, NULL, NULL, '2022-11-14 14:20:58', '2022-11-23 13:09:14'),
(15, 'Bank of America', 'https://epay.backlayer.app/uploads/epaywallet/22/11/6374ebd0344a21611221668606928.png', 1, 'App\\Lib\\CustomGateway', 1, 2000, 0, NULL, 0, 1, 0, '', 1, '[{\"type\": \"text\", \"label\": \"Account Number\", \"isRequired\": true}, {\"type\": \"text\", \"label\": \"Holder Name\", \"isRequired\": true}, {\"type\": \"text\", \"label\": \"Bank Name\", \"isRequired\": true}, {\"type\": \"file\", \"label\": \"Proof of Payment\", \"isRequired\": false}, {\"type\": \"date\", \"label\": \"Day of Payment\", \"isRequired\": true}, {\"type\": \"tel\", \"label\": \"Phone Number\", \"isRequired\": true}]', NULL, '2022-11-16 13:55:28', '2022-12-30 18:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` double DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `paid_at` timestamp NULL DEFAULT NULL,
  `status_paid` enum('2','1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0: Pending, 1: Payout, 2: Confirmed',
  `is_sent` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id` bigint UNSIGNED DEFAULT NULL,
  `currency_id` bigint UNSIGNED DEFAULT NULL,
  `gateway_id` bigint UNSIGNED DEFAULT NULL,
  `fields` json DEFAULT NULL,
  `data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `uuid`, `invoice_no`, `trx`, `charge`, `rate`, `tax`, `discount`, `total`, `customer_email`, `customer_phone_number`, `due_date`, `note`, `paid_at`, `status_paid`, `is_sent`, `name`, `email`, `owner_id`, `currency_id`, `gateway_id`, `fields`, `data`, `created_at`, `updated_at`) VALUES
(1, '0ff76b39-512e-4133-910a-f65ce8d8b53f', '1000', NULL, NULL, NULL, 0, 0, 100, 'MARCO@BACKLAYER.EU', NULL, '2022-10-17', '111', NULL, '0', 0, NULL, NULL, 3, 6, 0, NULL, NULL, '2022-10-17 13:58:07', '2022-10-17 13:58:07'),
(2, '2b9e4987-3a9d-4982-af27-370d68000f43', '123456', NULL, NULL, NULL, NULL, NULL, 100, 'marco@backlayer.eu', NULL, '2022-10-17', NULL, NULL, '0', 0, NULL, NULL, 3, 6, 0, NULL, NULL, '2022-10-17 13:59:04', '2022-10-17 13:59:04'),
(3, '72712365-dc08-4316-b8b9-c74761b51151', '0001', NULL, NULL, NULL, 7, 0, 107, 'carias@workmail.com', NULL, '2022-10-19', 'Pago de Asesoria', NULL, '0', 0, NULL, NULL, 7, 1, 0, NULL, NULL, '2022-10-19 15:57:56', '2022-10-19 15:57:56'),
(4, '7c5e1fc6-1d5c-486a-82f2-c939b71dcdb5', '12', NULL, NULL, NULL, 12, 0, 224, 'jersongil21@gmail.com', NULL, '2022-10-20', 'algo', NULL, '0', 0, NULL, NULL, 10, 1, 0, NULL, NULL, '2022-10-20 15:17:22', '2022-10-20 15:17:22'),
(5, 'cd9643d8-0f8c-4d86-bc52-15c91823701a', '114', NULL, NULL, NULL, 2, 1, 100.98, 'jersongil21@gmail.com', NULL, '2022-10-24', NULL, NULL, '0', 0, NULL, NULL, 10, 1, 0, NULL, NULL, '2022-10-24 18:53:56', '2022-10-24 18:53:56'),
(6, '005116b6-14e6-423c-8b48-c563d1fcedba', '123123', NULL, NULL, NULL, NULL, NULL, 1231, 'jersongil21@gmail.com', NULL, '2022-10-24', NULL, NULL, '0', 0, NULL, NULL, 10, 1, 0, NULL, NULL, '2022-10-24 18:57:21', '2022-10-24 18:57:21'),
(7, '6c4a05bc-cd6b-4099-adcf-63a5e96545fb', 'a213', NULL, NULL, NULL, NULL, NULL, 1111, 'jersongil21@gmail.com', NULL, '2022-10-24', 'tessst', NULL, '0', 0, NULL, NULL, 10, 1, 0, NULL, NULL, '2022-10-24 19:39:58', '2022-11-10 19:59:37'),
(8, '5be5a28d-e351-4eaf-a37f-03aad7b91383', '3215', NULL, NULL, NULL, 5, NULL, 10.5, 'carlosariasreggeti@hotmail.com', NULL, '2022-10-31', 'Prueba de sonido', NULL, '0', 0, NULL, NULL, 9, 1, 0, NULL, NULL, '2022-10-31 15:58:58', '2022-10-31 15:58:58'),
(9, '1bca2855-1604-40b8-8c7b-dd2515f22788', '1000-RF-A', NULL, NULL, NULL, 0, 0, 100, 'marco@backlayer.eu', NULL, '2022-11-30', 'Prueba', NULL, '0', 0, NULL, NULL, 12, 1, 0, NULL, NULL, '2022-11-06 18:19:30', '2022-11-06 18:21:41'),
(10, 'dc62ec3f-e11f-4477-a0cb-d8ee544ce388', '1221', NULL, NULL, NULL, NULL, NULL, 100, 'jersongil21@gmail.com', NULL, '2022-11-10', NULL, NULL, '0', 0, NULL, NULL, 10, 1, 0, NULL, NULL, '2022-11-10 00:29:25', '2022-11-10 00:29:25'),
(11, '1ce3cb62-7d21-4090-8177-affcbec60900', '12121212', NULL, NULL, NULL, NULL, NULL, 122, 'jersongil21@gmail.com', NULL, '2022-11-10', NULL, NULL, '0', 0, NULL, NULL, 10, 1, 0, NULL, NULL, '2022-11-10 00:50:22', '2022-11-10 13:23:11'),
(12, '3df13f1b-393d-4699-9aa6-0290c94de8bb', '123123123', NULL, NULL, NULL, NULL, NULL, 200, 'jersongil21@gmail.com', NULL, '2022-11-10', NULL, NULL, '0', 0, NULL, NULL, 10, 1, 0, NULL, NULL, '2022-11-10 13:28:55', '2022-12-12 18:09:01'),
(13, '040d341e-c670-4509-9cb0-642a8af9cca1', '213123132', 'kK6jjB0BV5HpOf5162', 0, 1, NULL, NULL, 111, 'jersongil21@gmail.com', NULL, '2022-11-10', NULL, '2022-12-12 18:05:30', '1', 0, 'jerson gil', 'jersongil21@gmail.com', 10, 1, 0, NULL, NULL, '2022-11-10 14:05:41', '2022-12-12 18:05:30'),
(14, 'b41638f1-25e9-4ead-b7e9-a163d5982a5f', '1000-RF-A2', NULL, NULL, NULL, 21, 0, 121, 'marco@debtsy.io', NULL, '2022-11-13', 'Prueba', NULL, '0', 0, NULL, NULL, 6, 1, 0, NULL, NULL, '2022-11-13 12:04:59', '2022-11-13 12:04:59'),
(15, '248bd979-7c10-4604-9d90-6f2948b2e983', '165165', NULL, NULL, NULL, NULL, NULL, 250, 'carlosariasreggeti@hotmail.com', NULL, '2022-11-13', 'Prueba de sonido', NULL, '0', 0, NULL, NULL, 9, 1, 0, NULL, NULL, '2022-11-13 12:12:33', '2022-11-13 12:12:33'),
(16, 'd4f01708-770c-4ec7-8a81-6a186b64871d', '1000-RF-A3', NULL, NULL, NULL, 21, 10, 108.9, 'marco@backlayer.eu', NULL, '2022-11-13', NULL, NULL, '0', 0, NULL, NULL, 6, 1, 0, NULL, NULL, '2022-11-13 12:13:36', '2022-11-13 12:13:36'),
(17, '42fc0b0a-f74e-47a5-9d13-a69604eea1e4', '16516', NULL, NULL, NULL, 10, 10, 99, 'carlosariasreggeti@hotmail.com', NULL, '2022-11-13', 'Prueba 2', NULL, '0', 0, NULL, NULL, 9, 1, 0, NULL, NULL, '2022-11-13 12:25:12', '2022-11-13 12:25:12'),
(18, '85f2394f-8c31-46e1-8e2e-fa39530625e3', 'ABC-1', NULL, NULL, NULL, 5, 0, 1050, 'marco@backlayer.eu', NULL, '2022-11-14', 'Notas', NULL, '0', 0, NULL, NULL, 6, 1, 0, NULL, NULL, '2022-11-14 14:28:16', '2022-11-14 14:30:07'),
(19, '1d8f7aac-1448-4825-b9c9-10c6232c9c8c', '1651651', NULL, NULL, NULL, NULL, NULL, 100, 'carlosariasreggeti@hotmail.com', NULL, '2022-11-29', NULL, NULL, '0', 0, NULL, NULL, 9, 1, 0, NULL, NULL, '2022-11-29 00:06:49', '2022-11-29 00:06:49'),
(20, '3776aa37-d9e6-4291-9a5b-c207fa0590f5', '10009-090', NULL, NULL, NULL, 0, 0, 100, 'carlos@paynomy.io', NULL, '2022-11-29', 'Test', NULL, '0', 0, NULL, NULL, 6, 1, 0, NULL, NULL, '2022-11-29 07:59:42', '2022-11-29 07:59:42'),
(21, '7e40cc9f-a1a4-4b62-b6ea-c93bc850ee5d', '516516', NULL, NULL, NULL, NULL, NULL, 98, 'carlosariasreggeti@hotmail.com', NULL, '2022-12-02', NULL, NULL, '0', 0, NULL, NULL, 9, 1, 0, NULL, NULL, '2022-12-02 01:51:29', '2022-12-02 01:51:29'),
(22, 'b77e7734-ddd3-438f-bbc5-b143c5a70bff', '10009-091', NULL, NULL, NULL, NULL, NULL, 1000, 'marco@backlayer.eu', NULL, '2022-12-07', NULL, NULL, '0', 0, NULL, NULL, 6, 1, 0, NULL, NULL, '2022-12-07 11:08:34', '2022-12-07 11:08:34'),
(23, '09e1d6a1-e882-4453-a0d0-5b0fb972d5c5', '4545', NULL, NULL, NULL, NULL, NULL, 1000, 'carlosariasreggeti@hotmail.com', NULL, '2022-12-08', NULL, NULL, '0', 0, NULL, NULL, 9, 1, 0, NULL, NULL, '2022-12-08 21:28:23', '2022-12-08 21:28:23'),
(24, 'eebd3e10-e45c-4a61-a24f-dcd7d05e22dc', '1000390', NULL, NULL, NULL, 0, 0, 1000, 'm.pirro1987@gmail.com', NULL, '2022-12-08', 'Bla bla', NULL, '0', 0, NULL, NULL, 5, 1, 0, NULL, NULL, '2022-12-08 21:29:38', '2022-12-08 21:29:38'),
(25, '1527eaaa-8753-42eb-9164-1ac3af709dd9', '32', 'ch_3MCsCFBRq7fsgmoH2wFuvfPh', 0, 1, NULL, NULL, 500, 'carlosariasreggeti@hotmail.com', NULL, '2022-12-08', NULL, '2022-12-08 22:04:05', '1', 0, 'Carlos Arias Reggeti', 'carlos@debtsy.io', 9, 1, 0, NULL, NULL, '2022-12-08 21:31:15', '2022-12-08 22:04:05'),
(26, '3d1b5955-3d28-41e1-861d-1aaa600e8153', '939484949', 'ch_3MCs8JBRq7fsgmoH1lbSsggP', 0, 1, NULL, NULL, 100, 'm.pirro1987@gmail.com', NULL, '2022-12-08', NULL, '2022-12-08 22:00:00', '1', 0, 'Marco Pirrongelli', 'marco@backlayer.eu', 5, 1, 0, NULL, NULL, '2022-12-08 21:58:00', '2022-12-08 22:00:00'),
(27, 'a9ad0b05-18ba-49eb-9282-79ded82639df', '9495858', NULL, NULL, NULL, NULL, NULL, 100, 'm.pirro1987@gmail.com', NULL, '2022-12-08', NULL, NULL, '0', 0, NULL, NULL, 5, 1, 0, NULL, NULL, '2022-12-08 22:05:43', '2022-12-08 22:05:43'),
(28, '6eba878f-48a1-4b3f-abe9-60876c70802c', '23432', 'zFo2rNhudcHBjr8119', 0, 1, NULL, NULL, 500, 'carlosariasreggeti@hotmail.com', NULL, '2022-12-08', NULL, '2022-12-08 22:07:24', '1', 0, 'Carlos Arias Reggeti', 'carlos@debtsy.io', 9, 1, 0, NULL, NULL, '2022-12-08 22:06:57', '2022-12-08 22:07:24'),
(29, '3d57e87b-7567-4e86-bda9-3447e58b297e', '45345', 'ch_3MD7yjBRq7fsgmoH2GphH3iz', 0, 1, NULL, NULL, 500, 'carlosariasreggeti@hotmail.com', NULL, '2022-12-09', NULL, '2022-12-09 14:55:11', '1', 0, 'Carlos Arias Reggeti', 'carlos@debtsy.io', 9, 1, 0, NULL, NULL, '2022-12-09 14:53:39', '2022-12-09 14:55:11'),
(30, '21b09ea5-f283-4a14-8294-3fe77bc1b44d', '565451', '19VaKvDwYINSE3M130', 0, 1, NULL, NULL, 500, 'carlosariasreggeti@hotmail.com', NULL, '2022-12-10', NULL, '2022-12-10 19:33:40', '1', 0, 'Carlos Arias Reggeti', 'carlos@debtsy.io', 9, 1, 0, NULL, NULL, '2022-12-10 19:31:24', '2022-12-10 19:33:40'),
(31, '19b3a22f-380a-4860-87fa-61d9479e893f', '51651', 'VLJoNAq2XczvIZ3141', 0, 1, NULL, NULL, 500, 'carlosariasreggeti@hotmail.com', NULL, '2022-12-12', NULL, '2022-12-12 15:09:14', '1', 0, 'Carlos Arias Reggeti', 'carlos@debtsy.io', 9, 1, 0, NULL, NULL, '2022-12-12 15:08:34', '2022-12-12 15:09:14'),
(32, '87694901-94e1-4e10-84de-6bc5866ffdb8', '123456-31', NULL, NULL, NULL, 0, 0, 120, 'm.pirro1987@gmail.com', NULL, '2022-12-12', NULL, NULL, '0', 0, NULL, NULL, 5, 1, 0, NULL, NULL, '2022-12-12 17:56:06', '2022-12-12 17:56:06'),
(33, '94071a15-59f1-443b-8ff0-5a32ab69f00e', '9000-1-1', 'v5G0zh18ll3Bp0d171', 0, 1, 0, 0, 500, 'm.pirro1987@gmail.com', NULL, '2022-12-14', 'Bla bla', '2022-12-14 14:07:35', '2', 0, 'Marco', 'marco@backlayer.eu', 5, 1, 0, NULL, NULL, '2022-12-14 14:06:14', '2022-12-26 20:36:38'),
(34, '3905f6dc-9e88-4210-bdfd-c9b1ff98e795', '01112', NULL, NULL, NULL, 2, NULL, 161.6904, 'marco+01@backlayer.com', '+573212684453', '2022-12-22', NULL, NULL, '0', 1, NULL, NULL, 16, 1, 0, NULL, NULL, '2022-12-22 23:27:08', '2022-12-22 23:28:26'),
(35, 'c1cb07d2-62a4-4d47-9eaf-625f3ed81284', 'SMS-A01', NULL, NULL, NULL, 0, 0, 100, 'marco@backlayer.eu', '+34695936514', '2022-12-28', 'PAGAME MIS REALES', NULL, '0', 1, NULL, NULL, 6, 1, NULL, NULL, NULL, '2022-12-28 21:03:02', '2022-12-28 21:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `subtotal` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `name`, `amount`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 'INVOICE', 100, 1, 100, '2022-10-17 13:58:07', '2022-10-17 13:58:07'),
(2, 2, 'INVOICE', 100, 1, 100, '2022-10-17 13:59:04', '2022-10-17 13:59:04'),
(3, 3, 'Asesoria', 100, 1, 100, '2022-10-19 15:57:56', '2022-10-19 15:57:56'),
(4, 4, 'test', 200, 1, 200, '2022-10-20 15:17:22', '2022-10-20 15:17:22'),
(5, 5, 'algo', 100, 1, 100, '2022-10-24 18:53:56', '2022-10-24 18:53:56'),
(6, 6, 'adsad', 1231, 1, 1231, '2022-10-24 18:57:21', '2022-10-24 18:57:21'),
(8, 8, 'Prueba', 10, 1, 10, '2022-10-31 15:58:58', '2022-10-31 15:58:58'),
(10, 9, 'Asesoria', 100, 1, 100, '2022-11-06 18:21:41', '2022-11-06 18:21:41'),
(11, 10, 'test 3', 100, 1, 100, '2022-11-10 00:29:25', '2022-11-10 00:29:25'),
(13, 11, 'test 4', 122, 1, 122, '2022-11-10 13:23:11', '2022-11-10 13:23:11'),
(19, 7, 'tes2', 1111, 1, 1111, '2022-11-10 19:59:37', '2022-11-10 19:59:37'),
(23, 14, 'Testing Product', 100, 1, 100, '2022-11-13 12:04:59', '2022-11-13 12:04:59'),
(24, 15, 'Item', 250, 1, 250, '2022-11-13 12:12:33', '2022-11-13 12:12:33'),
(25, 16, 'Asesoria', 100, 1, 100, '2022-11-13 12:13:36', '2022-11-13 12:13:36'),
(26, 17, 'Servicios', 100, 1, 100, '2022-11-13 12:25:12', '2022-11-13 12:25:12'),
(29, 18, 'Asesoria', 1000, 1, 1000, '2022-11-14 14:30:07', '2022-11-14 14:30:07'),
(32, 19, 'Compra x', 100, 1, 100, '2022-11-29 00:06:49', '2022-11-29 00:06:49'),
(33, 20, 'Servicios', 100, 1, 100, '2022-11-29 07:59:42', '2022-11-29 07:59:42'),
(34, 21, 'Factura a Dalmiro', 98, 1, 98, '2022-12-02 01:51:29', '2022-12-02 01:51:29'),
(35, 22, 'Factura nro 4330304920303', 1000, 1, 1000, '2022-12-07 11:08:34', '2022-12-07 11:08:34'),
(36, 23, '3135', 1000, 1, 1000, '2022-12-08 21:28:23', '2022-12-08 21:28:23'),
(37, 24, 'Prueb', 1000, 1, 1000, '2022-12-08 21:29:38', '2022-12-08 21:29:38'),
(38, 25, '300', 500, 1, 500, '2022-12-08 21:31:15', '2022-12-08 21:31:15'),
(39, 26, 'Prueba 2', 100, 1, 100, '2022-12-08 21:58:00', '2022-12-08 21:58:00'),
(40, 27, 'Prueba', 100, 1, 100, '2022-12-08 22:05:43', '2022-12-08 22:05:43'),
(41, 28, '23432', 500, 1, 500, '2022-12-08 22:06:57', '2022-12-08 22:06:57'),
(42, 29, '453453', 500, 1, 500, '2022-12-09 14:53:39', '2022-12-09 14:53:39'),
(43, 30, '564156', 500, 1, 500, '2022-12-10 19:31:24', '2022-12-10 19:31:24'),
(44, 31, '5461', 500, 1, 500, '2022-12-12 15:08:34', '2022-12-12 15:08:34'),
(45, 32, 'Titulo', 100, 1, 100, '2022-12-12 17:56:06', '2022-12-12 17:56:06'),
(46, 32, 'Titulo 2', 20, 1, 20, '2022-12-12 17:56:06', '2022-12-12 17:56:06'),
(47, 13, 'test 50', 111, 1, 111, '2022-12-12 18:04:37', '2022-12-12 18:04:37'),
(48, 12, 'test 5', 200, 1, 200, '2022-12-12 18:09:01', '2022-12-12 18:09:01'),
(49, 33, 'Factura 9000-1-1', 500, 1, 500, '2022-12-14 14:06:14', '2022-12-14 14:06:14'),
(50, 34, 'Invioce Test', 158.52, 1, 158.52, '2022-12-22 23:27:08', '2022-12-22 23:27:08'),
(55, 35, 'Asesoria', 100, 1, 100, '2022-12-28 21:17:02', '2022-12-28 21:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kyc_methods`
--

CREATE TABLE `kyc_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_accept` tinyint(1) NOT NULL,
  `status` tinyint NOT NULL,
  `fields` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_methods`
--

INSERT INTO `kyc_methods` (`id`, `title`, `image`, `image_accept`, `status`, `fields`, `created_at`, `updated_at`) VALUES
(1, 'ID Card', '/uploads/id-card.png', 1, 1, '[{\"type\": \"text\", \"label\": \"ID No\"}, {\"type\": \"file\", \"label\": \"Image\"}, {\"type\": \"date\", \"label\": \"Date Of Birth\"}]', '2022-10-17 11:42:10', '2022-12-19 18:41:41'),
(2, 'Driving License', '/uploads/id-card.png', 1, 1, '[{\"type\": \"text\", \"label\": \"ID No\"}, {\"type\": \"file\", \"label\": \"Image\"}]', '2022-10-17 11:42:10', '2022-10-17 11:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_method_user`
--

CREATE TABLE `kyc_method_user` (
  `id` bigint UNSIGNED NOT NULL,
  `kyc_method_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kyc_request_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kyc_requests`
--

CREATE TABLE `kyc_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kyc_method_id` bigint UNSIGNED NOT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0 for pending, 1 for approved, 2 for rejected',
  `rejected_at` date DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `data` json DEFAULT NULL,
  `fields` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local',
  `files` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `is_optimized` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `url`, `driver`, `files`, `user_id`, `is_optimized`, `created_at`, `updated_at`) VALUES
(1, '/uploads/1/22/07/62e6814c04fd93107221659273548.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e6814c04fd93107221659273548.png\",\"/uploads\\/1\\/22\\/07\\/62e6814c04fd93107221659273548small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(2, '/uploads/1/22/07/62e6814c3a57a3107221659273548.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e6814c3a57a3107221659273548.png\",\"/uploads\\/1\\/22\\/07\\/62e6814c3a57a3107221659273548small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(3, '/uploads/1/22/07/62e6814c6a87d3107221659273548.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e6814c6a87d3107221659273548.png\",\"/uploads\\/1\\/22\\/07\\/62e6814c6a87d3107221659273548small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(4, '/uploads/1/22/07/62e6814c8ed5f3107221659273548.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e6814c8ed5f3107221659273548.png\",\"/uploads\\/1\\/22\\/07\\/62e6814c8ed5f3107221659273548small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(5, '/uploads/1/22/07/62e6814cae0483107221659273548.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e6814cae0483107221659273548.png\",\"/uploads\\/1\\/22\\/07\\/62e6814cae0483107221659273548small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(6, '/uploads/1/22/07/62e6814cd37233107221659273548.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e6814cd37233107221659273548.png\",\"/uploads\\/1\\/22\\/07\\/62e6814cd37233107221659273548small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(7, '/uploads/1/22/07/62e681584c3fa3107221659273560.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e681584c3fa3107221659273560.png\",\"/uploads\\/1\\/22\\/07\\/62e681584c3fa3107221659273560small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(8, '/uploads/1/22/07/62e681586a77e3107221659273560.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e681586a77e3107221659273560.png\",\"/uploads\\/1\\/22\\/07\\/62e681586a77e3107221659273560small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(9, '/uploads/1/22/07/62e68164ae22d3107221659273572.jpg', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e68164ae22d3107221659273572.jpg\",\"/uploads\\/1\\/22\\/07\\/62e68164ae22d3107221659273572small.jpg\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(10, '/uploads/1/22/07/62e6816541fb23107221659273573.jpg', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e6816541fb23107221659273573.jpg\",\"/uploads\\/1\\/22\\/07\\/62e6816541fb23107221659273573small.jpg\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(11, '/uploads/1/22/07/62e68165722793107221659273573.jpg', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e68165722793107221659273573.jpg\",\"/uploads\\/1\\/22\\/07\\/62e68165722793107221659273573small.jpg\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(12, '/uploads/1/22/07/62e681659c5b43107221659273573.jpg', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e681659c5b43107221659273573.jpg\",\"/uploads\\/1\\/22\\/07\\/62e681659c5b43107221659273573small.jpg\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(13, '/uploads/1/22/07/62e68165d30713107221659273573.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e68165d30713107221659273573.png\",\"/uploads\\/1\\/22\\/07\\/62e68165d30713107221659273573small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(14, '/uploads/1/22/07/62e681666b4b43107221659273574.jpg', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e681666b4b43107221659273574.jpg\",\"/uploads\\/1\\/22\\/07\\/62e681666b4b43107221659273574small.jpg\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(15, '/uploads/1/22/07/62e681669aeac3107221659273574.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e681669aeac3107221659273574.png\",\"/uploads\\/1\\/22\\/07\\/62e681669aeac3107221659273574small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(16, '/uploads/1/22/07/62e68166c3d283107221659273574.jpg', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e68166c3d283107221659273574.jpg\",\"/uploads\\/1\\/22\\/07\\/62e68166c3d283107221659273574small.jpg\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(17, '/uploads/1/22/07/62e68166eb7623107221659273574.jpg', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e68166eb7623107221659273574.jpg\",\"/uploads\\/1\\/22\\/07\\/62e68166eb7623107221659273574small.jpg\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(18, '/uploads/1/22/07/62e68167244e53107221659273575.jpg', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e68167244e53107221659273575.jpg\",\"/uploads\\/1\\/22\\/07\\/62e68167244e53107221659273575small.jpg\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(19, '/uploads/1/22/07/62e681674414c3107221659273575.jpg', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e681674414c3107221659273575.jpg\",\"/uploads\\/1\\/22\\/07\\/62e681674414c3107221659273575small.jpg\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(20, '/uploads/1/22/07/62e68167656593107221659273575.jpg', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e68167656593107221659273575.jpg\",\"/uploads\\/1\\/22\\/07\\/62e68167656593107221659273575small.jpg\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(21, '/uploads/1/22/07/62e6816794fde3107221659273575.jpg', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e6816794fde3107221659273575.jpg\",\"/uploads\\/1\\/22\\/07\\/62e6816794fde3107221659273575small.jpg\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(22, '/uploads/1/22/07/62e6849c3e2853107221659274396.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e6849c3e2853107221659274396.png\",\"/uploads\\/1\\/22\\/07\\/62e6849c3e2853107221659274396small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(23, '/uploads/1/22/07/62e68862ac24c3107221659275362.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e68862ac24c3107221659275362.png\",\"/uploads\\/1\\/22\\/07\\/62e68862ac24c3107221659275362small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(24, '/uploads/1/22/07/62e69773699843107221659279219.png', 'local', '[\"/uploads\\/1\\/22\\/07\\/62e69773699843107221659279219.png\",\"/uploads\\/1\\/22\\/07\\/62e69773699843107221659279219small.png\"]', NULL, 0, '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(27, 'https://epay.backlayer.app/uploads/1/22/12/6393391a43f290912221670592794.png', 'public', '[\"uploads\\/1\\/22\\/12\\/6393391a43f290912221670592794.png\",\"uploads\\/1\\/22\\/12\\/6393391a43f290912221670592794small.png\"]', NULL, 0, '2022-12-09 13:33:14', '2022-12-09 13:33:14'),
(28, 'https://epay.backlayer.app/uploads/1/22/12/63933963542d10912221670592867.png', 'public', '[\"uploads\\/1\\/22\\/12\\/63933963542d10912221670592867.png\",\"uploads\\/1\\/22\\/12\\/63933963542d10912221670592867small.png\"]', NULL, 0, '2022-12-09 13:34:27', '2022-12-09 13:34:27'),
(31, 'https://epay.backlayer.app/uploads/1/22/12/6393424db37570912221670595149.png', 'public', '[\"uploads\\/1\\/22\\/12\\/6393424db37570912221670595149.png\",\"uploads\\/1\\/22\\/12\\/6393424db37570912221670595149small.png\"]', NULL, 0, '2022-12-09 14:12:29', '2022-12-09 14:12:29'),
(32, 'https://epay.backlayer.app/uploads/1/22/12/6393432beb2960912221670595371.png', 'public', '[\"uploads\\/1\\/22\\/12\\/6393432beb2960912221670595371.png\",\"uploads\\/1\\/22\\/12\\/6393432beb2960912221670595371small.png\"]', NULL, 0, '2022-12-09 14:16:11', '2022-12-09 14:16:11'),
(33, 'https://epay.backlayer.app/uploads/1/22/12/639346e945c7a0912221670596329.png', 'public', '[\"uploads\\/1\\/22\\/12\\/639346e945c7a0912221670596329.png\",\"uploads\\/1\\/22\\/12\\/639346e945c7a0912221670596329small.png\"]', NULL, 0, '2022-12-09 14:32:09', '2022-12-09 14:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `position`, `data`, `lang`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Header', 'header', '[{\"text\":\"Home\",\"href\":\"/\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"About Us\",\"href\":\"/about\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Blog\",\"href\":\"/blog\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Contact\",\"href\":\"/contact\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]', 'en', 1, NULL, NULL),
(2, 'Our Solutions', 'footer_left_menu', '[{\"text\":\"Transfer Money\",\"icon\":\"\",\"href\":\"#\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Request Money\",\"icon\":\"empty\",\"href\":\"#\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Virtual Cards\",\"icon\":\"empty\",\"href\":\"#\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Bill Payments\",\"icon\":\"empty\",\"href\":\"#\",\"target\":\"_self\",\"title\":\"\"}]', 'en', 1, NULL, NULL),
(3, 'HELP', 'footer_right_menu', '[{\"text\":\"Contact\",\"icon\":\"\",\"href\":\"/contact\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"FAQs\",\"icon\":\"empty\",\"href\":\"#\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Terms or Service\",\"icon\":\"empty\",\"href\":\"#\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Privacy Policy\",\"icon\":\"empty\",\"href\":\"#\",\"target\":\"_self\",\"title\":\"\"}]', 'en', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_000000_create_currencies_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_08_19_000002_create_taxes_table', 1),
(6, '2019_09_15_000001_create_gateways_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2022_02_27_105253_create_menus_table', 1),
(9, '2022_02_27_105302_create_terms_table', 1),
(10, '2022_02_27_105310_create_term_metas_table', 1),
(11, '2022_02_27_105320_create_options_table', 1),
(12, '2022_02_27_105337_create_categories_table', 1),
(13, '2022_02_27_105353_create_media_table', 1),
(14, '2022_02_28_095723_create_term_categories_table', 1),
(15, '2022_06_15_094542_create_deposits_table', 1),
(16, '2022_06_26_212541_create_temporary_files_table', 1),
(17, '2022_08_01_045418_create_moneyrequests_table', 1),
(18, '2022_08_01_052056_create_transactions_table', 1),
(19, '2022_08_01_053204_create_banks_table', 1),
(20, '2022_08_01_054119_create_user_banks_table', 1),
(21, '2022_08_01_054124_create_payouts_table', 1),
(22, '2022_08_01_062156_create_contact_mails_table', 1),
(23, '2022_08_01_091232_create_singlecharges_table', 1),
(24, '2022_08_01_091705_create_singlechargeorders_table', 1),
(25, '2022_08_01_094243_create_donations_table', 1),
(26, '2022_08_01_094247_create_donationorders_table', 1),
(27, '2022_08_03_085009_create_storefronts_table', 1),
(28, '2022_08_04_071105_create_product_categories_table', 1),
(29, '2022_08_04_082523_create_invoices_table', 1),
(30, '2022_08_04_082524_create_invoice_items_table', 1),
(31, '2022_08_04_091921_create_products_table', 1),
(32, '2022_08_04_114953_create_websites_table', 1),
(33, '2022_08_04_133848_create_transfers_table', 1),
(34, '2022_08_05_110735_create_user_plans_table', 1),
(35, '2022_08_05_113538_create_user_plan_subscribers_table', 1),
(36, '2022_08_06_154748_create_web_orders_table', 1),
(37, '2022_08_06_154748_create_web_test_orders_table', 1),
(38, '2022_08_08_125200_create_kyc_methods_table', 1),
(39, '2022_08_08_125222_create_kyc_requests_table', 1),
(40, '2022_08_08_125255_create_kyc_method_user_table', 1),
(41, '2022_08_08_153638_create_shippings_table', 1),
(42, '2022_08_09_103139_create_product_storefront_table', 1),
(43, '2022_08_10_111509_create_supports_table', 1),
(44, '2022_08_10_114705_create_support_metas_table', 1),
(45, '2022_08_10_172245_create_orders_table', 1),
(46, '2022_08_10_172256_create_orderitems_table', 1),
(47, '2022_08_13_155406_create_jobs_table', 1),
(48, '2022_08_17_044312_create_qrpayments_table', 1),
(49, '2022_08_17_131614_create_permission_tables', 1),
(50, '2022_12_20_141410_shorten_link_table', 2),
(51, '2022_12_21_100426_invoice_phone_field', 3),
(52, '2022_12_22_130728_payment_gateway_fields', 4),
(53, '2022_12_22_151952_invoice_fields', 5),
(55, '2022_12_23_095258_single_charge_fields', 6),
(56, '2022_12_26_111910_invoice_change_field', 7),
(57, '2022_12_26_114126_single_charge_order_change_field', 8),
(58, '2022_12_27_103545_invoice_gateway_id_field', 9),
(59, '2022_12_29_123125_qr_payment_fields', 10),
(60, '2022_12_30_095148_gateway_instructions_field', 11),
(61, '2023_01_02_095820_create_signup_fields_table', 12),
(62, '2023_01_02_100820_user_signup_fields', 12);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `moneyrequests`
--

CREATE TABLE `moneyrequests` (
  `id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED DEFAULT NULL,
  `receiver_id` bigint UNSIGNED DEFAULT NULL,
  `request_currency_id` bigint UNSIGNED DEFAULT NULL,
  `approved_currency_id` bigint UNSIGNED DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `charge` double DEFAULT NULL,
  `rate` double DEFAULT '1',
  `status` int NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `key`, `value`, `lang`, `created_at`, `updated_at`) VALUES
(1, 'plan_renewal_messages', '{\"plan_disabled\": \"<b>We were unable to make renew your subscription plan.</b><br> Please change your subscription plan. Currently this plan not available or contact at the support forum.\", \"order_complete\": \"<b>Your subscription has been successfully renewed.</b><br> Your subscription automatic renewal order has been received and is now being processed. Your order details are shown below for your reference.\", \"user_balance_low\": \"<b>We were unable to make renew your subscription plan.</b><br> Please top up the balance for renew the subscription. your subscription detail is shown below for your reference.\"}', 'en', '2022-07-31 13:14:11', '2022-07-31 13:14:11'),
(2, 'cron_option', '{\"expire_message\": \"Your plan is expired!\", \"first_expire_days\": 14, \"second_expire_days\": 7, \"first_alert_message\": \"Hi, your plan will expire soon\", \"second_alert_message\": \"Hi, your plan will expire soon\", \"trial_expired_message\": \"Your free trial is expired!\"}', 'en', '2022-07-31 13:14:11', '2022-07-31 13:14:11'),
(3, 'languages', '{\"en\": \"English\"}', 'en', '2022-07-31 13:14:11', '2022-07-31 13:14:11'),
(4, 'currency', '{\"name\": \"USD\", \"rate\": \"1\"}', 'en', '2022-07-31 13:14:11', '2022-07-31 13:14:11'),
(5, 'footer_setting', '{\"copyright\":\"Copyright \\u00a9 2022. All Rights Reserved\",\"about\":\"Paynomy is a payment gateway company for unbanked companies with the goal of connecting people and businesses to the global economy. Aligned with the 2030 agenda of the United Nations.\",\"social\":[{\"icon_class\":\"fab fa-facebook\",\"website_url\":\"https:\\/\\/www.facebook.com\"},{\"icon_class\":\"fab fa-twitter\",\"website_url\":\"https:\\/\\/www.twitter.com\"},{\"icon_class\":\"fab fa-instagram\",\"website_url\":\"https:\\/\\/www.instagram.com\"},{\"icon_class\":\"fab fa-youtube\",\"website_url\":\"https:\\/\\/www.youtube.com\"},{\"icon_class\":\"fab fa-linkedin\",\"website_url\":\"https:\\/\\/www.linkedin.com\"}]}', 'en', '2022-07-31 13:14:11', '2022-12-09 15:48:01'),
(6, 'logo_setting', '{\"logo\":\"https:\\/\\/epay.backlayer.app\\/uploads\\/1\\/22\\/12\\/6393391a43f290912221670592794.png\",\"favicon\":\"https:\\/\\/epay.backlayer.app\\/uploads\\/1\\/22\\/12\\/63933963542d10912221670592867.png\"}', 'en', '2022-07-31 13:14:11', '2022-12-09 13:34:49'),
(7, 'heading.welcome', '{\"short_title\":\"Integrated Payment Processor\",\"title\":\"The doorway to a globalized world\",\"description\":\"Every year more and more people are adopting online payment platforms other than the traditional ones. Don\'t get left behind and offer your customers popular payment methods.\",\"button1_text\":\"Start now\",\"button1_url\":\"\\/register\",\"button2_text\":\"Sign In\",\"button2_url\":\"\\/login\",\"image\":\"https:\\/\\/epay.backlayer.app\\/uploads\\/1\\/22\\/12\\/6393424db37570912221670595149.png\",\"lang\":\"en\"}', 'en', '2022-07-31 13:16:04', '2022-12-09 15:35:22'),
(8, 'heading.feature', '{\"title\":\"Increase your sales\",\"description\":\"We provide you with tools to offer more payment options to your customers and increase your invoicing volume.\",\"feature_1_icon\":\"fas fa-laptop\",\"feature_1_text\":\"Stay Updated\",\"feature_1_description\":\"We keep up to date on online payment trends. Don\'t waste time opening new accounts and studying the implementation of new trends in your business.\",\"feature_2_icon\":\"fas fa-piggy-bank\",\"feature_2_text\":\"Save Time and Resources\",\"feature_2_description\":\"We save you the hassle of the learning curve of new online payment trends and the administrative burdens involved in adapting them to your business.\",\"feature_3_icon\":\"far fa-credit-card\",\"feature_3_text\":\"Multiple Options\",\"feature_3_description\":\"We offer your customers the most popular online payment methods in a single channel, through a physical point of sale or online payment gateway.\"}', 'en', '2022-07-31 13:17:18', '2022-12-09 15:40:55'),
(9, 'heading.about', '{\"title\":\"Making Recurring Payments has never been easier.\",\"description\":\"We renegotiate your debts and monthly commitments so that you pay less, receive extensions or increase your credit with suppliers. In addition, we take care of the entire monthly payment process from collecting invoices, calculating payments and taxes, and paying your monthly commitments internationally.\",\"button_text\":\"Read more\",\"button_url\":\"https:\\/\\/epay.backlayer.app\\/about\",\"image\":\"https:\\/\\/epay.backlayer.app\\/uploads\\/1\\/22\\/12\\/6393432beb2960912221670595371.png\"}', 'en', '2022-07-31 13:26:38', '2022-12-09 15:41:28'),
(10, 'heading.payment', '{\"title\":\"Know the big difference\",\"description\":\"Learn about all the advantages you get when using our services\",\"payment_1_icon\":\"fas fa-store-alt\",\"payment_1_text\":\"Payment Methods\",\"payment_1_description\":\"Access to the most popular online payment methods immediately without creating accounts in each of them.\",\"payment_2_icon\":\"fas fa-exchange-alt\",\"payment_2_text\":\"International Payments\",\"payment_2_description\":\"+80% of payments made in the US are online\",\"payment_3_icon\":\"fab fa-cc-amazon-pay\",\"payment_3_text\":\"Instant Verification\",\"payment_3_description\":\"Reduces staff approving transactions.\",\"payment_4_icon\":\"fas fa-link\",\"payment_4_text\":\"Decide on how to monetize\",\"payment_4_description\":\"Choose the time and means where you will receive the funds of all payments processed in the different authorized payment methods.\",\"payment_5_icon\":\"fas fa-file-invoice\",\"payment_5_text\":\"PoS Aggregator\",\"payment_5_description\":\"We work directly with payment providers, without intermediaries.\",\"payment_6_icon\":\"fas fa-id-card-alt\",\"payment_6_text\":\"Increase your sales\",\"payment_6_description\":\"100% of businesses with online payments increase sales.\"}', 'en', '2022-07-31 13:29:16', '2022-12-09 15:44:21'),
(11, 'heading.integration', '{\"title\": \"The fastest way to integrate Stripe.\", \"button_url\": \"/about\", \"button_text\": \"Read More\", \"description\": \"Checkout’s intuitive APIs and documentation make it easy to get started, Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa recusandae accusamus numquam quos, debitis consectetur! and easy to iterate.\\r\\n\\r\\nLorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam fuga eius sed aut, voluptates commodi incidunt excepturi nobis similique vel, aliquid laborum ex dignissimos officia minima voluptas dolor labore cum?\"}', 'en', '2022-07-31 13:30:08', '2022-07-31 13:30:08'),
(12, 'heading.capture', '{\"short_title\":\"CAPTURE MORE REVENUE\",\"title\":\"Main Reason for Trust\",\"image\":\"https:\\/\\/epay.backlayer.app\\/uploads\\/1\\/22\\/12\\/639346e945c7a0912221670596329.png\",\"capture_1_title\":\"International Bank Accounts\",\"capture_1_description\":\"We have a wide variety of international accounts, and multiple currencies for receiving payments via wire transfer, Zelle, among others.\",\"capture_2_title\":\"Quick Solutions\",\"capture_2_description\":\"Activating payment methods has never been so easy and fast, start getting paid online in less than 48 business hours.\",\"capture_3_title\":\"Digital Wallet\",\"capture_3_description\":\"Our system will provide a digital wallet for the receipt of your funds in which you will be able to make payments to other people and companies just by using the email address.\"}', 'en', '2022-07-31 13:31:17', '2022-12-09 15:47:24'),
(13, 'heading.security', '{\"title\": \"Built-In Fraud Prevention And Compliance (Security)\", \"description\": \"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reprehenderit, sed Lorem ipsum dolor sit amet..\", \"security_1_icon\": \"far fa-eye\", \"security_2_icon\": \"fab fa-asymmetrik\", \"security_1_title\": \"Powerful fraud protection\", \"security_2_title\": \"Compliance made easy\", \"security_1_description\": \"Checkout uses machine learning to help you distinguish fraudsters from customers. Apply extra authentication to high-risk payments, or let us take on fraudulent disputes entirely with Chargeback Protection.\", \"security_2_description\": \"Checkout uses machine learning to help you distinguish fraudsters from customers. Apply extra authentication to high-risk payments, or let us take on fraudulent disputes entirely with Chargeback Protection.\"}', 'en', '2022-07-31 13:35:09', '2022-07-31 13:35:19'),
(14, 'heading.review', '{\"title\": \"Client Says About Our Services\", \"description\": \"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reprehenderit, sed Lorem ipsum dolor sit amet..\"}', 'en', '2022-07-31 13:35:32', '2022-07-31 13:35:32'),
(15, 'heading.faq', '{\"title\": \"Questions & Answers\", \"description\": \"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reprehenderit, sed Lorem ipsum dolor sit amet..\"}', 'en', '2022-07-31 13:35:46', '2022-07-31 13:35:46'),
(16, 'heading.latest-news', '{\"title\": \"New All Blogs\", \"description\": \"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reprehenderit, sed Lorem ipsum dolor sit amet..\"}', 'en', '2022-07-31 13:35:59', '2022-07-31 13:35:59'),
(17, 'heading.contact', '{\"email\": \"example@gmail.com\", \"phone\": \"+88015426\", \"title\": \"Contact Us Now\", \"map_url\": \"https://maps.google.com/maps?q=1864 Lancaster Court Road Poughkeepsie, CA 12601&z=13&ie=UTF8&iwloc=&output=embed\", \"location\": \"New York, 1850\"}', 'en', '2022-06-28 00:36:54', '2022-06-28 00:36:54'),
(18, 'charges', '{\"request_money_charge\":{\"type\":\"percentage\",\"rate\":\"1\"},\"withdraw_charge\":{\"type\":\"percentage\",\"rate\":\"3\"},\"transfer_charge\":{\"type\":\"percentage\",\"rate\":\"5\"},\"transaction_charge\":{\"type\":\"fixed\",\"rate\":\"60\"},\"single_payment_charge\":{\"type\":\"percentage\",\"rate\":\"0\"},\"donation_charge\":{\"type\":\"percentage\",\"rate\":\"0\"},\"invoice_charge\":{\"type\":\"percentage\",\"rate\":\"0\"},\"user_plan_charge\":{\"type\":\"percentage\",\"rate\":\"0\"},\"merchant_charge\":{\"type\":\"percentage\",\"rate\":\"1\"},\"qr_payment_charge\":{\"type\":\"percentage\",\"rate\":\"0\"}}', 'en', '2022-10-17 11:42:09', '2022-11-14 14:50:38'),
(19, 'seo_home', '{\"site_name\":\"Home\",\"matatag\":\"Home\",\"matadescription\":\"it is an payment gateway application. you can add your payment gateway keys,id and start using your payment gateway system within 5  within 5 minutes.\",\"twitter_site_title\":\"home\"}', 'en', '2022-10-17 11:42:09', '2022-10-17 11:42:09'),
(21, 'seo_blog', '{\"site_name\":\"Blog\",\"matatag\":\"Blog\",\"matadescription\":\"it is an payment gateway application. in this page you can view all post recently post form the application\",\"twitter_site_title\":\"Blog\"}', 'en', '2022-10-17 11:42:09', '2022-10-17 11:42:09'),
(22, 'seo_about', '{\"site_name\":\"About Us\",\"matatag\":\"about\",\"matadescription\":\"it is an payment gateway application. in this page you can view all details about each services\",\"twitter_site_title\":\"Service\"}', 'en', '2022-10-17 11:42:09', '2022-10-17 11:42:09'),
(23, 'about_us', '{\"title\":\"The Price Is Something Not Necessarily Defined As Financial.\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, eligendi porro? Numquam commodi placeat quia. Blanditiis libero ad porro, cum quaerat vel fuga mollitia quasi exercitationem! Nostrum molestias, officiis nulla id cum quae deleniti accusantium velit laudantium. Commodi, reprehenderit minus aliquid, unde doloremque quidem, laudantium maxime recusandae sed sapiente nam.\\r\\n\\r\\nLorem ipsum dolor sit amet consectetur adipisicing elit. Similique, eligendi porro? Numquam commodi placeat quia. Blanditiis libero ad porro, cum quaerat vel fuga mollitia quasi exercitationem! Nostrum molestias, officiis nulla id cum quae deleniti accusantium velit laudantium. Commodi, reprehenderit minus aliquid, unde doloremque quidem, laudantium maxime recusandae sed sapiente nam.\",\"image\":\"/uploads\\/1\\/22\\/07\\/62e69773699843107221659279219.png\"}', 'en', '2022-08-24 13:32:36', '2022-08-24 13:33:34'),
(24, 'seo_contact', '{\"site_name\":\"Contact Us\",\"matatag\":\"contact\",\"matadescription\":\"it is an payment gateway application. in this page you can view all details about each services\",\"twitter_site_title\":\"Service\"}', 'en', '2022-10-17 11:42:09', '2022-10-17 11:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `shipping_id` bigint UNSIGNED DEFAULT NULL,
  `seller_id` bigint UNSIGNED NOT NULL,
  `gateway_id` bigint UNSIGNED DEFAULT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `storefront_id` bigint UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_bank_id` bigint UNSIGNED NOT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `trx` int DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `charge` double NOT NULL,
  `rate` double NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(2, 'customers-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(3, 'customers-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(4, 'customers-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(5, 'customers-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(6, 'staff-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(7, 'staff-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(8, 'staff-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(9, 'staff-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(10, 'promotional-email-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(11, 'promotional-email-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(12, 'supports-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(13, 'supports-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(14, 'supports-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(15, 'supports-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(16, 'reports-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(17, 'transactions-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(18, 'payments-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(19, 'invoices-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(20, 'merchants-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(21, 'category-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(22, 'products-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(23, 'deposits-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(24, 'stores-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(25, 'transfers-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(26, 'money-requests-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(27, 'payment-plans-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(28, 'payouts-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(29, 'banks-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(30, 'banks-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(31, 'banks-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(32, 'banks-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(33, 'orders-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(34, 'orders-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(35, 'orders-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(36, 'currencies-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(37, 'currencies-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(38, 'currencies-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(39, 'currencies-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(40, 'users-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(41, 'users-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(42, 'users-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(43, 'users-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(44, 'kyc-methods-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(45, 'kyc-methods-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(46, 'kyc-methods-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(47, 'kyc-methods-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(48, 'kyc-requests-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(49, 'kyc-requests-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(50, 'kyc-requests-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(51, 'kyc-requests-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(52, 'media-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(53, 'media-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(54, 'media-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(55, 'media-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(56, 'reviews-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(57, 'reviews-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(58, 'reviews-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(59, 'reviews-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(60, 'blog-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(61, 'blog-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(62, 'blog-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(63, 'blog-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(64, 'pages-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(65, 'pages-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(66, 'pages-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(67, 'pages-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(68, 'website-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(69, 'website-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(70, 'settings-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(71, 'languages-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(72, 'languages-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(73, 'languages-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(74, 'languages-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(75, 'menus-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(76, 'menus-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(77, 'menus-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(78, 'menus-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(79, 'seo-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(80, 'seo-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(81, 'seo-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(82, 'seo-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(83, 'system-settings-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(84, 'system-settings-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(85, 'cron-settings-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(86, 'cron-settings-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(87, 'taxes-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(88, 'taxes-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(89, 'taxes-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(90, 'taxes-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(91, 'gateways-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(92, 'gateways-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(93, 'gateways-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(94, 'gateways-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(95, 'roles-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(96, 'roles-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(97, 'roles-update', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(98, 'roles-delete', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(99, 'roles-assign-read', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(100, 'roles-assign-create', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(101, 'signup-fields-create', 'web', '2023-01-02 22:58:42', '2023-01-02 22:58:42'),
(102, 'signup-fields-read', 'web', '2023-01-02 22:58:42', '2023-01-02 22:58:42'),
(103, 'signup-fields-update', 'web', '2023-01-02 22:58:42', '2023-01-02 22:58:42'),
(104, 'signup-fields-delete', 'web', '2023-01-02 22:58:42', '2023-01-02 22:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci,
  `price` double DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `confirmation_message` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `name`, `type`, `link`, `price`, `image`, `quantity`, `description`, `confirmation_message`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 'USB STICK 8 GB', 0, NULL, 10, 'uploads/6/22/10/1666368557.jpeg', 1, '<p>aaaa</p>', NULL, '2022-10-21 16:09:17', '2022-10-21 16:09:17'),
(2, 9, 3, 'Producto 1', 0, NULL, 50, 'uploads/9/22/11/1669711988.png', 1, '<p>Producto bien bueno y de calidad</p>', NULL, '2022-11-29 08:53:08', '2022-11-29 08:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `user_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 10, 'test 1', '2022-10-20 17:47:20', '2022-10-20 17:47:29'),
(2, 6, 'Category', '2022-10-21 16:07:54', '2022-10-21 16:07:54'),
(3, 9, 'Prueba', '2022-11-29 08:51:00', '2022-11-29 08:51:00'),
(4, 14, 'Cat 1', '2022-12-10 01:27:24', '2022-12-10 01:27:24'),
(5, 14, 'Cat 2', '2022-12-10 01:27:33', '2022-12-10 01:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_storefront`
--

CREATE TABLE `product_storefront` (
  `storefront_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_storefront`
--

INSERT INTO `product_storefront` (`storefront_id`, `product_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `qrpayments`
--

CREATE TABLE `qrpayments` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_id` bigint UNSIGNED NOT NULL,
  `gateway_id` bigint UNSIGNED DEFAULT NULL,
  `currency_id` bigint UNSIGNED DEFAULT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `charge` double DEFAULT NULL,
  `rate` double NOT NULL DEFAULT '1',
  `fields` json DEFAULT NULL,
  `data` json DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(2, 'Manager', 'web', '2022-10-17 11:42:10', '2022-10-17 11:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(22, 2),
(23, 2),
(24, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(49, 2),
(50, 2),
(51, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `user_id`, `region`, `amount`, `created_at`, `updated_at`) VALUES
(1, 9, 'India', 10, '2022-11-29 08:54:34', '2022-11-29 08:54:34');

-- --------------------------------------------------------

--
-- Table structure for table `shorten_link`
--

CREATE TABLE `shorten_link` (
  `id` bigint UNSIGNED NOT NULL,
  `long_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shorten_link`
--

INSERT INTO `shorten_link` (`id`, `long_url`, `hash`, `created_at`, `updated_at`) VALUES
(1, 'https://epay.backlayer.app/invoice/c1cb07d2-62a4-4d47-9eaf-625f3ed81284', '481f81d9', '2022-12-28 21:06:28', '2022-12-28 21:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `signup_fields`
--

CREATE TABLE `signup_fields` (
  `id` bigint UNSIGNED NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` json DEFAULT NULL COMMENT 'Used for select, radio or checkbox fields',
  `isRequired` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signup_fields`
--

INSERT INTO `signup_fields` (`id`, `label`, `type`, `data`, `isRequired`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'RIF', 'text', NULL, 1, 0, '2023-01-02 23:01:28', '2023-01-02 23:01:28'),
(2, 'Do you have a bank account in the USA?', 'radio', '[{\"label\": \"Yes\", \"value\": \"true\"}, {\"label\": \"No\", \"value\": \"false\"}]', 1, 1, '2023-01-03 15:19:58', '2023-01-03 15:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `singlechargeorders`
--

CREATE TABLE `singlechargeorders` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `charge` double DEFAULT NULL,
  `rate` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `status_paid` enum('2','1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0: Pending, 1: Payout, 2: Confirmed',
  `user_id` bigint UNSIGNED NOT NULL,
  `gateway_id` bigint UNSIGNED NOT NULL,
  `singlecharge_id` bigint UNSIGNED NOT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `fields` json DEFAULT NULL,
  `data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `singlechargeorders`
--

INSERT INTO `singlechargeorders` (`id`, `invoice_no`, `trx`, `amount`, `charge`, `rate`, `name`, `email`, `paid_at`, `status_paid`, `user_id`, `gateway_id`, `singlecharge_id`, `currency_id`, `fields`, `data`, `created_at`, `updated_at`) VALUES
(1, '0000001', '2ghvypvmJ34avcw162', 166.59, 0, 1, 'Carlos Camacho', 'carloscgo123@gmail.com', '2022-12-29 20:16:14', '1', 16, 15, 6, 1, '[{\"type\": \"text\", \"label\": \"Account Number\"}, {\"type\": \"text\", \"label\": \"Holder Name\"}, {\"type\": \"text\", \"label\": \"Bank Name\"}, {\"type\": \"file\", \"label\": \"Proof of Payment\"}, {\"type\": \"date\", \"label\": \"Day of Payment\"}]', '{\"Bank Name\": \"First Century Bank\", \"Holder Name\": \"Carlos Camacho\", \"Account Number\": \"1110101022\", \"Day of Payment\": \"2022-12-29\", \"Proof of Payment\": \"uploads/20221229081613/22/12/1672344973.png\"}', '2022-12-29 20:16:14', '2022-12-29 20:16:14'),
(2, '0000002', 'cmowRvv8otXdBnU120', 168.4, 0, 1, 'Carlos Camacho', 'carloscgo123@gmail.com', '2022-12-29 20:26:42', '1', 16, 15, 7, 1, '[{\"type\": \"text\", \"label\": \"Account Number\"}, {\"type\": \"text\", \"label\": \"Holder Name\"}, {\"type\": \"text\", \"label\": \"Bank Name\"}, {\"type\": \"file\", \"label\": \"Proof of Payment\"}, {\"type\": \"date\", \"label\": \"Day of Payment\"}]', '{\"Bank Name\": \"First Century Bank\", \"Holder Name\": \"Carlos Camacho\", \"Account Number\": \"1110101022\", \"Day of Payment\": \"2022-12-29\", \"Proof of Payment\": \"uploads/20221229082641/22/12/1672345601.png\"}', '2022-12-29 20:26:42', '2022-12-29 20:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `singlecharges`
--

CREATE TABLE `singlecharges` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `currency_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `singlecharges`
--

INSERT INTO `singlecharges` (`id`, `uuid`, `user_id`, `currency_id`, `title`, `amount`, `meta`, `status`, `created_at`, `updated_at`) VALUES
(2, 'fc94de70-b26c-4b54-b81d-d30c3873d442', 3, 6, 'LINK TEST', 100, '{\"description\":\"AAAAA\",\"redirect_url\":\"HTTPS:\\/\\/GOOGLE.COM\"}', 1, '2022-10-17 13:55:21', '2022-10-17 13:55:21'),
(3, '8ed810c9-7772-4054-a314-4149699e50ec', 6, 1, 'Test #1611', 500, '{\"description\":\"qwerty\",\"redirect_url\":null}', 1, '2022-11-16 18:59:22', '2022-11-16 18:59:22'),
(4, '30b386d0-94f4-4b0c-8514-00491fdce621', 9, 1, 'Prueba Single Charge', 15, '{\"description\":\"Pago Noviembre\",\"redirect_url\":null}', 1, '2022-11-29 08:59:33', '2022-11-29 08:59:33'),
(5, 'a887a3c8-7596-45fd-99fb-a03ebc2ce8ae', 5, 1, 'Test', 100, '{\"description\":\"Test\",\"redirect_url\":\"https:\\/\\/www.debtsy.io\"}', 1, '2022-12-09 09:57:58', '2022-12-09 09:57:58'),
(6, 'b4e00bec-abc2-47f6-8326-5ff4815a8bc6', 16, 1, 'Single Charge', 166.59, '{\"description\":\"Testing\",\"redirect_url\":null}', 2, '2022-12-23 14:40:28', '2022-12-29 20:16:14'),
(7, 'c281f678-9f85-4eed-a44a-384a84975c58', 16, 1, 'Payment 0001', 168.4, '{\"description\":\"test\",\"redirect_url\":null}', 2, '2022-12-29 20:19:27', '2022-12-29 20:26:42'),
(35, '3d261b9c-0c28-46e1-af30-f842d9aa6fe7', 9, 1, 'Prueba 1', 200, '{\"description\":\"Prueba 2\",\"redirect_url\":null}', 1, '2022-12-29 20:30:00', '2022-12-29 20:30:00'),
(36, '2be2c773-32c3-45e8-a0b8-3bea3db7ab5a', 16, 1, 'Payment 002', 122.35, '{\"description\":\"Testing\",\"redirect_url\":null}', 1, '2022-12-29 21:58:30', '2022-12-29 21:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `storefronts`
--

CREATE TABLE `storefronts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `product_type` tinyint(1) DEFAULT NULL,
  `shipping_status` tinyint(1) NOT NULL DEFAULT '1',
  `note_status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storefronts`
--

INSERT INTO `storefronts` (`id`, `user_id`, `name`, `image`, `description`, `status`, `product_type`, `shipping_status`, `note_status`, `created_at`, `updated_at`) VALUES
(1, 6, 'Marco Pirrongelli', 'uploads/6/22/10/1666368414.png', NULL, 1, 0, 1, 0, '2022-10-21 16:06:54', '2022-10-21 16:06:54'),
(2, 9, 'Store Front', 'uploads/9/22/11/1669711914.png', 'Tienda de prueba', 1, 0, 1, 0, '2022-11-29 08:51:54', '2022-11-29 08:51:54'),
(3, 14, 'Tienda Store Front', 'uploads/14/22/12/1670635711.png', 'This is my great store front.', 1, 0, 1, 2, '2022-12-10 01:28:31', '2022-12-10 01:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_no` bigint UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` json NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_metas`
--

CREATE TABLE `support_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `type` int NOT NULL DEFAULT '1',
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_files`
--

CREATE TABLE `temporary_files` (
  `id` bigint UNSIGNED NOT NULL,
  `folder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `termcategories`
--

CREATE TABLE `termcategories` (
  `term_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `featured` int NOT NULL DEFAULT '0',
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `comment_status` int NOT NULL DEFAULT '0',
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `title`, `slug`, `type`, `status`, `featured`, `lang`, `comment_status`, `meta`, `created_at`, `updated_at`) VALUES
(1, 'How To Attract Top Talent In Competitive Industries', 'how-to-attract-top-talent-in-competitive-industries', 'blog', 1, 1, 'en', 1, NULL, '2022-07-31 14:59:43', '2022-07-31 14:59:43'),
(2, '5 New Insights You Should Know', '5-new-insights-you-should-know', 'blog', 1, 1, 'en', 1, NULL, '2022-07-31 15:00:23', '2022-07-31 15:00:23'),
(3, 'Monteno How to make blockcahin', 'monteno-how-to-make-blockcahin', 'blog', 1, 1, 'en', 1, NULL, '2022-07-31 15:00:56', '2022-07-31 15:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `term_metas`
--

CREATE TABLE `term_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `term_id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_metas`
--

INSERT INTO `term_metas` (`id`, `term_id`, `key`, `value`) VALUES
(1, 1, 'excerpt', 'Dolor sit amet consectetur adipisicing elit. Eligendi ab illo ad incidunt unde cumque magnam iure numquam sed dicta voluptatum corrupti nulla non culpa vitae velit, quae autem facilis nam in. Debitis recusandae ratione molestiae facere voluptatibus quo ipsum modi sapiente incidunt minima, reprehenderit, id harum sequi illo eius? Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis minima amet provident dolorum. Odit explicabo sint rerum dicta ab asperiores voluptas! Excepturi, ad eligendi?'),
(4, 1, 'preview', 'uploads/1/22/07/62e681659c5b43107221659273573.jpg'),
(5, 1, 'description', '<p style=\"margin-right: 0px; margin-left: 0px; padding: 0px; line-height: 1.7; color: rgb(33, 37, 41); font-size: 16px; font-family: &quot;Noto Sans&quot;, sans-serif;\">Dolor sit amet consectetur adipisicing elit. Eligendi ab illo ad incidunt unde cumque magnam iure numquam sed dicta voluptatum corrupti nulla non culpa vitae velit, quae autem facilis nam in. Debitis recusandae ratione molestiae facere voluptatibus quo ipsum modi sapiente incidunt minima, reprehenderit, id harum sequi illo eius? Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis minima amet provident dolorum. Odit explicabo sint rerum dicta ab asperiores voluptas! Excepturi, ad eligendi?</p><blockquote class=\"text-center\" style=\"padding: 0px; color: rgb(33, 37, 41); font-family: &quot;Noto Sans&quot;, sans-serif; font-style: normal; letter-spacing: normal; background-color: rgb(255, 255, 255);\"><h2 class=\"block-code-text\" style=\"margin: 40px 0px; padding: 0px; font-weight: 400; line-height: 1.5; font-size: 28px; font-family: Chivo, sans-serif; color: rgb(50, 50, 93); text-transform: capitalize; letter-spacing: 1px;\">“ There’s Going After Top Talent, And Then There’s Going After Top Talent Within Highly-Competitive Industries. “</h2></blockquote><p class=\"mb-30\" style=\"margin-right: 0px; margin-bottom: 30px; margin-left: 0px; padding: 0px; line-height: 1.7; color: rgb(33, 37, 41); font-size: 16px; font-family: &quot;Noto Sans&quot;, sans-serif;\">Amet consectetur adipisicing elit. Eligendi ab illo ad incidunt unde cumque magnam iure numquam sed dicta voluptatum corrupti nulla non culpa vitae velit, quae autem facilis nam in. Debitis recusandae ratione molestiae facere voluptatibus quo ipsum modi sapiente incidunt minima, reprehenderit, id harum sequi illo eius? Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, sunt aperiam libero dolore perspiciatis excepturi exercitationem alias dolorum architecto deserunt.</p>'),
(6, 2, 'excerpt', 'Dolor sit amet consectetur adipisicing elit. Eligendi ab illo ad incidunt unde cumque magnam iure numquam sed dicta voluptatum corrupti nulla non culpa vitae velit, quae autem facilis nam in. Debitis recusandae ratione molestiae facere voluptatibus quo ipsum modi sapiente incidunt minima, reprehenderit, id harum sequi illo eius? Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis minima amet provident dolorum. Odit explicabo sint rerum dicta ab asperiores voluptas! Excepturi, ad eligendi?'),
(7, 2, 'metatag', NULL),
(8, 2, 'metadescription', NULL),
(9, 2, 'preview', 'uploads/1/22/07/62e68165722793107221659273573.jpg'),
(10, 2, 'description', '<p style=\"margin-right: 0px; margin-left: 0px; padding: 0px; line-height: 1.7; color: rgb(33, 37, 41); font-size: 16px; font-family: &quot;Noto Sans&quot;, sans-serif;\">Dolor sit amet consectetur adipisicing elit. Eligendi ab illo ad incidunt unde cumque magnam iure numquam sed dicta voluptatum corrupti nulla non culpa vitae velit, quae autem facilis nam in. Debitis recusandae ratione molestiae facere voluptatibus quo ipsum modi sapiente incidunt minima, reprehenderit, id harum sequi illo eius? Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis minima amet provident dolorum. Odit explicabo sint rerum dicta ab asperiores voluptas! Excepturi, ad eligendi?</p><blockquote class=\"text-center\" style=\"padding: 0px; color: rgb(33, 37, 41); font-family: &quot;Noto Sans&quot;, sans-serif; font-style: normal; letter-spacing: normal; background-color: rgb(255, 255, 255);\"><h2 class=\"block-code-text\" style=\"margin: 40px 0px; padding: 0px; font-weight: 400; line-height: 1.5; font-size: 28px; font-family: Chivo, sans-serif; color: rgb(50, 50, 93); text-transform: capitalize; letter-spacing: 1px;\">“ There’s Going After Top Talent, And Then There’s Going After Top Talent Within Highly-Competitive Industries. “</h2></blockquote><p class=\"mb-30\" style=\"margin-right: 0px; margin-bottom: 30px; margin-left: 0px; padding: 0px; line-height: 1.7; color: rgb(33, 37, 41); font-size: 16px; font-family: &quot;Noto Sans&quot;, sans-serif;\">Amet consectetur adipisicing elit. Eligendi ab illo ad incidunt unde cumque magnam iure numquam sed dicta voluptatum corrupti nulla non culpa vitae velit, quae autem facilis nam in. Debitis recusandae ratione molestiae facere voluptatibus quo ipsum modi sapiente incidunt minima, reprehenderit, id harum sequi illo eius? Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, sunt aperiam libero dolore perspiciatis excepturi exercitationem alias dolorum architecto deserunt.</p>'),
(11, 3, 'excerpt', 'Dolor sit amet consectetur adipisicing elit. Eligendi ab illo ad incidunt unde cumque magnam iure numquam sed dicta voluptatum corrupti nulla non culpa vitae velit, quae autem facilis nam in. Debitis recusandae ratione molestiae facere voluptatibus quo ipsum modi sapiente incidunt minima, reprehenderit, id harum sequi illo eius? Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis minima amet provident dolorum. Odit explicabo sint rerum dicta ab asperiores voluptas! Excepturi, ad eligendi?'),
(12, 3, 'metatag', NULL),
(13, 3, 'metadescription', NULL),
(14, 3, 'preview', 'uploads/1/22/07/62e6816541fb23107221659273573.jpg'),
(15, 3, 'description', '<p style=\"margin-right: 0px; margin-left: 0px; padding: 0px; line-height: 1.7; color: rgb(33, 37, 41); font-size: 16px; font-family: &quot;Noto Sans&quot;, sans-serif;\">Dolor sit amet consectetur adipisicing elit. Eligendi ab illo ad incidunt unde cumque magnam iure numquam sed dicta voluptatum corrupti nulla non culpa vitae velit, quae autem facilis nam in. Debitis recusandae ratione molestiae facere voluptatibus quo ipsum modi sapiente incidunt minima, reprehenderit, id harum sequi illo eius? Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis minima amet provident dolorum. Odit explicabo sint rerum dicta ab asperiores voluptas! Excepturi, ad eligendi?</p><blockquote class=\"text-center\" style=\"padding: 0px; color: rgb(33, 37, 41); font-family: &quot;Noto Sans&quot;, sans-serif; font-style: normal; letter-spacing: normal; background-color: rgb(255, 255, 255);\"><h2 class=\"block-code-text\" style=\"margin: 40px 0px; padding: 0px; font-weight: 400; line-height: 1.5; font-size: 28px; font-family: Chivo, sans-serif; color: rgb(50, 50, 93); text-transform: capitalize; letter-spacing: 1px;\">“ There’s Going After Top Talent, And Then There’s Going After Top Talent Within Highly-Competitive Industries. “</h2></blockquote><p class=\"mb-30\" style=\"margin-right: 0px; margin-bottom: 30px; margin-left: 0px; padding: 0px; line-height: 1.7; color: rgb(33, 37, 41); font-size: 16px; font-family: &quot;Noto Sans&quot;, sans-serif;\">Amet consectetur adipisicing elit. Eligendi ab illo ad incidunt unde cumque magnam iure numquam sed dicta voluptatum corrupti nulla non culpa vitae velit, quae autem facilis nam in. Debitis recusandae ratione molestiae facere voluptatibus quo ipsum modi sapiente incidunt minima, reprehenderit, id harum sequi illo eius? Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, sunt aperiam libero dolore perspiciatis excepturi exercitationem alias dolorum architecto deserunt.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `currency_id` bigint UNSIGNED DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `charge` double DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `invoice_no`, `user_id`, `currency_id`, `amount`, `rate`, `charge`, `reason`, `type`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, '0000001', 3, 6, -92, NULL, 8, 'Transfer money', 'debit', 'Prof. Johnnie Carroll Jr.', 'user@user.com', '2022-10-17 14:00:29', '2022-10-17 14:00:29'),
(2, '0000002', 9, 1, 500, 1, NULL, 'Deposite.', 'credit', 'Carlos Arias Reggeti', 'Carlos Arias Reggeti', '2022-11-29 08:37:44', '2022-11-29 08:37:44'),
(3, '0000003', 5, 1, 100, 1, 0, 'Invoice Payment received from Marco Pirrongelli', 'credit', 'Marco Pirrongelli', 'marco@backlayer.eu', '2022-12-08 22:00:00', '2022-12-08 22:00:00'),
(4, '0000004', 9, 1, -500, 1, NULL, 'Invoice Payment sent to Debtsy', 'debit', 'Carlos Arias Reggeti', 'carlos@debtsy.io', '2022-12-08 22:04:05', '2022-12-08 22:04:05'),
(5, '0000005', 9, 1, 500, 1, 0, 'Invoice Payment received from Carlos Arias Reggeti', 'credit', 'Carlos Arias Reggeti', 'carlos@debtsy.io', '2022-12-08 22:04:05', '2022-12-08 22:04:05'),
(6, '0000006', 9, 1, -500, 1, NULL, 'Invoice Payment sent to Debtsy', 'debit', 'Carlos Arias Reggeti', 'carlos@debtsy.io', '2022-12-08 22:07:25', '2022-12-08 22:07:25'),
(7, '0000007', 9, 1, 500, 1, 0, 'Invoice Payment received from Carlos Arias Reggeti', 'credit', 'Carlos Arias Reggeti', 'carlos@debtsy.io', '2022-12-08 22:07:25', '2022-12-08 22:07:25'),
(8, '0000008', 9, 1, -500, 1, NULL, 'Invoice Payment sent to Debtsy', 'debit', 'Carlos Arias Reggeti', 'carlos@debtsy.io', '2022-12-09 14:55:11', '2022-12-09 14:55:11'),
(9, '0000009', 9, 1, 500, 1, 0, 'Invoice Payment received from Carlos Arias Reggeti', 'credit', 'Carlos Arias Reggeti', 'carlos@debtsy.io', '2022-12-09 14:55:11', '2022-12-09 14:55:11'),
(10, '0000010', 14, 1, 100, 1, NULL, 'Deposite.', 'credit', 'Test 0001', 'Test 0001', '2022-12-10 01:15:18', '2022-12-10 01:15:18'),
(11, '0000011', 9, 1, -500, 1, NULL, 'Invoice Payment sent to Debtsy', 'debit', 'Carlos Arias Reggeti', 'carlos@debtsy.io', '2022-12-10 19:33:37', '2022-12-10 19:33:37'),
(12, '0000012', 9, 1, 500, 1, 0, 'Invoice Payment received from Carlos Arias Reggeti', 'credit', 'Carlos Arias Reggeti', 'carlos@debtsy.io', '2022-12-10 19:33:37', '2022-12-10 19:33:37'),
(13, '0000013', 9, 1, -500, 1, NULL, 'Invoice Payment sent to Debtsy', 'debit', 'Carlos Arias Reggeti', 'carlos@debtsy.io', '2022-12-10 19:33:40', '2022-12-10 19:33:40'),
(14, '0000014', 9, 1, 500, 1, 0, 'Invoice Payment received from Carlos Arias Reggeti', 'credit', 'Carlos Arias Reggeti', 'carlos@debtsy.io', '2022-12-10 19:33:40', '2022-12-10 19:33:40'),
(15, '0000015', 9, 1, -500, 1, NULL, 'Invoice Payment sent to Debtsy', 'debit', 'Carlos Arias Reggeti', 'carlos@debtsy.io', '2022-12-12 15:09:14', '2022-12-12 15:09:14'),
(16, '0000016', 9, 1, 500, 1, 0, 'Invoice Payment received from Carlos Arias Reggeti', 'credit', 'Carlos Arias Reggeti', 'carlos@debtsy.io', '2022-12-12 15:09:14', '2022-12-12 15:09:14'),
(17, '0000017', 10, 1, -111, 1, NULL, 'Invoice Payment sent to Jerson', 'debit', 'jerson gil', 'jersongil21@gmail.com', '2022-12-12 18:05:30', '2022-12-12 18:05:30'),
(18, '0000018', 10, 1, 111, 1, 0, 'Invoice Payment received from jerson gil', 'credit', 'jerson gil', 'jersongil21@gmail.com', '2022-12-12 18:05:30', '2022-12-12 18:05:30'),
(19, '0000019', 5, 1, -500, 1, NULL, 'Invoice Payment sent to Backlayer', 'debit', 'Marco', 'marco@backlayer.eu', '2022-12-14 14:07:35', '2022-12-14 14:07:35'),
(20, '0000020', 5, 1, 500, 1, 0, 'Invoice Payment received from Marco', 'credit', 'Marco', 'marco@backlayer.eu', '2022-12-14 14:07:35', '2022-12-14 14:07:35'),
(21, '0000021', 16, 1, 166.59, 1, 0, 'Single Charge Payment received from Carlos Camacho', 'credit', 'Carlos Camacho', 'carloscgo123@gmail.com', '2022-12-29 20:16:14', '2022-12-29 20:16:14'),
(22, '0000022', 16, 1, 168.4, 1, 0, 'Single Charge Payment received from Carlos Camacho', 'credit', 'Carlos Camacho', 'carloscgo123@gmail.com', '2022-12-29 20:26:42', '2022-12-29 20:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` double DEFAULT NULL,
  `rate` double DEFAULT '1',
  `is_beneficiary` tinyint(1) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `user_id`, `currency_id`, `email`, `amount`, `trx`, `charge`, `rate`, `is_beneficiary`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 6, 'marco@backlayer.eu', 92, '166601522952', 8, 4.46, 1, 1, '2022-10-17 14:00:29', '2022-10-17 14:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` bigint UNSIGNED DEFAULT NULL COMMENT 'use as country',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `wallet` double NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `meta` json DEFAULT NULL,
  `fields` json DEFAULT NULL,
  `data` json DEFAULT NULL,
  `public_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `kyc_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `username`, `phone`, `email`, `currency_id`, `role`, `wallet`, `password`, `status`, `meta`, `fields`, `data`, `public_key`, `secret_key`, `qr`, `ip_address`, `last_login_at`, `kyc_verified_at`, `remember_token`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'https://avatars.dicebear.com/api/adventurer/admin.svg', 'admin', NULL, 'admin@admin.com', NULL, 'admin', 0, '$2y$10$uQGehkOgBgYD/PngPfBmIu4PkiDBgZSyRj5jGnKp3YsMIJ3/aACMq', 1, NULL, NULL, NULL, 'PUBLIC-VYG09XDDl7Kk81kWvYVloZI24tu2nR4f', 'SECRET-2L2WYrpQ4CoUbdyWxyoWfVJtRu8vllCM', 'CLHW3xfrMrOJKGBHSqt43VCqFkarOBql', '181.234.196.73', '2023-01-05 17:02:41', '2022-10-17 11:42:10', NULL, '2022-10-17 11:42:10', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(2, 'Manager', 'https://avatars.dicebear.com/api/adventurer/manager.svg', 'manager', NULL, 'manager@manager.com', NULL, 'admin', 0, '$2y$10$ccYNmb7IkqQTEyHRxWoljuvU3Lk/h2FJySRZk2W87UCF66RDI/tE.', 1, NULL, NULL, NULL, 'PUBLIC-9GTMWiGlM45NUCFFcSAg0UMPghjLyAYG', 'SECRET-pxU1mi1jLUrqeCnDXe8KcMmtl4qtbG7V', 'O2QmrkNvumHn7UXCJMAQ2LTXb3OTdUY7', NULL, NULL, '2022-10-17 11:42:10', NULL, '2022-10-17 11:42:10', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(3, 'Prof. Johnnie Carroll Jr.', 'https://avatars.dicebear.com/api/adventurer/avatar.png', 'demo-user', '+1-701-252-8925', 'user@user.com', 6, 'user', 21, '$2y$10$NCY3z1uEsVCxWHesum1Lke3wjOcSnYhrVk6nbeokyK.WU27Ni0chC', 1, '{\"business_name\": \"Ortiz-Kutch\"}', NULL, NULL, 'PUBLIC-FIiKfWSdlyu6UUimmkXTNBpuxndLMVuZ', 'SECRET-hZqy4CMN66ZIUCbllvQGxKa5q9lwLBFP', 'zBPqkk4ZokU1HYjUoOcGMeaZqXTVjHv1', '82.159.224.24', '2022-10-18 11:46:19', '2022-10-17 11:42:10', 'CzmFk7FAXM5N7Fk5lCYyMusZXTe99MtP3OUhOR3CwNpSL1rCqqslkkIRkjly', '2022-10-17 11:42:10', '2022-10-17 11:42:10', '2022-10-17 14:00:29'),
(4, 'Ms. Destini Wilkinson', 'https://avatars.dicebear.com/api/adventurer/avatar.png', 'test', '301-759-3759', 'test@test.com', 5, 'user', 350, '$2y$10$1gV0.F8fTBh831u1F3vGFeP012rXuMqp7hWWjbTRoK0Ayncp1XDri', 1, '{\"business_name\": \"Weimann, Fahey and Luettgen\"}', NULL, NULL, 'PUBLIC-5jzkWEEIsFQw7usgjGJ23lU2ngL8rTm9', 'SECRET-rclBfQ02phAdB3DmSoAVoBBD7ME4bxfZ', 'NGoXEDTsSOWlXV6CTG77m6h7mdr49NRa', NULL, NULL, NULL, '9ckFxXhDG6', '2022-10-17 11:42:10', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(5, 'Marco', NULL, 'marco', '7866150834', 'marco@backlayer.eu', 1, 'user', 600, '$2y$10$o4AaKCIxMY6dVE2uZMzmDOb9452tLVhRcHnuKnwbOnDZE.UvaMNHm', 1, '{\"business_name\": \"Backlayer\"}', NULL, NULL, 'PUBLIC-IEViS9ExTHG9SLEAMhcYvKN3IgOTP0X9', 'SECRET-CeCn09cYxZ0RwuNMJl6NHKPWm7xriE5n', 'mdUARhAEWYiyNF5QO7jLPru2p2IzrOb9', '148.3.149.168', '2022-12-14 13:55:21', NULL, NULL, '2022-12-08 21:28:32', '2022-10-17 14:03:05', '2022-12-14 14:07:35'),
(6, 'Marco Pirrongelli', NULL, 'm.pirro1987', '695936514', 'm.pirro1987@gmail.com', 1, 'user', 0, '$2y$10$t4Al8EVNDrrh8CujjenSguo0PtUHGSTRPs.WDLoXeoZVxcwIh0t6e', 1, '{\"business_name\": \"Backlayer\"}', NULL, NULL, 'PUBLIC-zYmlUFcgX1Qkz941CPXAFCGBPvunK04P', 'SECRET-Vo5EVsRrqLx73rfidAVBkfwK3pXuIdHM', 'dU229F3yvfAS7qL2gSQhyI4N93jf4pnm', '82.159.228.163', '2022-12-28 20:59:40', NULL, NULL, '2022-10-21 16:05:42', '2022-10-17 17:57:16', '2022-10-21 16:05:42'),
(7, 'Marco Pirrongelli', NULL, 'm.pirro1987+01', '695936514', 'm.pirro1987+01@gmail.com', 1, 'user', 0, '$2y$10$IrLNdmAfjOeX6gD4WSd1A.jKZjoc34JphmZmc2PPj9hznX0ejcr7m', 1, '{\"business_name\": \"Backlayer\"}', NULL, NULL, 'PUBLIC-TG5ByxQezo4D3pCbaDCTpici1aNeirZ5', 'SECRET-X83Ge29XgWA7ANqtxq6NkWDee8aULZO9', 'oKLULjZEOFVsdASMehs8DN342WIHKnWE', '37.140.254.19', '2022-10-19 15:56:25', NULL, NULL, '2022-10-19 15:56:42', '2022-10-17 17:58:18', '2022-10-19 15:56:42'),
(8, 'Marco Pirrongelli', NULL, 'm.pirro1987+02', '695936514', 'm.pirro1987+02@gmail.com', 1, 'user', 0, '$2y$10$812pcoQ308PfKVwWOzph7OudS4nlS2IXmKS/fQ8OKb.rKDZvnFd3G', 1, '{\"business_name\": \"Backlayer\"}', NULL, NULL, 'PUBLIC-hFTciigtwKBsY3a8GVy0pLxBuMuPhSqR', 'SECRET-9vhg3VMdyrW9aHbgdnptsSGKz6XsaFGP', 'rGv8hinRK1hXUwEq3fgPg8ZJ3pAxCgWG', '45.132.226.138', '2022-10-18 17:24:40', NULL, NULL, '2022-10-18 17:25:00', '2022-10-17 17:58:39', '2022-10-18 17:25:00'),
(9, 'Carlos Arias Reggeti', NULL, 'carlos', '+13059303309', 'carlos@debtsy.io', 1, 'user', 3000, '$2y$10$t9T5VHIOqGbmqiwLS6ntWOtbxweY6IYGixFTg26Ik5V4FgAkbwWZC', 1, '{\"business_name\": \"Debtsy\"}', NULL, NULL, 'PUBLIC-ijVU0NuVq88Ye9wilX42esDFPuLqk3rg', 'SECRET-NNW5mKVwrLAiyiIDgcQSk4uQMSiV5VCA', 'FT4EQ7XPeqHXOIZylTkE5MnYmAM8haGd', '138.122.7.242', '2022-12-29 20:28:32', NULL, NULL, '2022-10-18 20:57:34', '2022-10-18 20:56:04', '2022-12-12 15:09:14'),
(10, 'jerson gil', NULL, 'jersongil21', '+5804245545422', 'jersongil21@gmail.com', 1, 'user', 111, '$2y$10$IYNq5FDLXZcI/t9LoxIfR.VJYmjm6X46tFIMgrjA1TzRYgunAJcA6', 1, '{\"business_name\": \"Jerson\"}', NULL, NULL, 'PUBLIC-P0TIPmnrFAfEdNlec3Gm2qHqta4nNdKX', 'SECRET-1AtyR5Pxs4F30jEEoOiSgGsfWc4MXFL3', 'gnjk7cYJtGOjHjULlzAWcNjBwpLXUh61', '38.51.158.94', '2022-12-12 18:04:00', NULL, NULL, '2022-10-20 15:15:49', '2022-10-20 15:14:15', '2022-12-12 18:05:30'),
(11, 'Marco Pirrongelli', NULL, 'marco+01', '123456789', 'marco+01@backlayer.com', 1, 'user', 0, '$2y$10$J66m6YdYe2FubhiVj1BzQO9Yjb50m7guonJUqD2Xd/ZoLELburH66', 1, '{\"business_name\": \"Business Lisbon\"}', NULL, NULL, 'PUBLIC-2GWUsz9FJsqlPGV40eRaVPoOMRDQsmOF', 'SECRET-4fKCVvsM6KsFjqzwa0r0mGRHqMwI53AZ', 'mGFNXTw4cJapPpvfo5ajnQp2tPb0AGnJ', NULL, NULL, NULL, NULL, NULL, '2022-11-01 22:45:22', '2022-11-01 22:45:22'),
(12, 'Marco Pirrongelli', NULL, 'marco2', '+34695936514', 'marco@debtsy.io', 1, 'user', 0, '$2y$10$m1F7ggeJOQWpOUnSq4yIGu9z0p2HpNFrycv5TushyMWcnU66fpF.e', 1, '{\"business_name\": \"Debtsy\"}', NULL, NULL, 'PUBLIC-2DP76XYm4bFn6hxau9RuFWcU1CfDB7U5', 'SECRET-fk9YCwAwI0Mi9et9pMYYEtTz7lwKXqqN', 'coCjAdQ9kLqFp4QTLx9XQVgi0NdJ9s6Q', NULL, NULL, NULL, NULL, '2022-11-06 18:18:56', '2022-11-06 18:18:07', '2022-11-06 18:18:56'),
(13, 'Stefano Di Geronimo-Zingg', NULL, 'Stefano', '8572009823', 'Stefano@unionblock.io', 1, 'user', 0, '$2y$10$cBeYlEt3RIap4JzwMnxI8.kWjGC.lq80zvk6Dtw8EcUxoGIrqefs6', 1, '{\"business_name\": \"Union Block LLC\"}', NULL, NULL, 'PUBLIC-yd9sFEo9Bf9f50YMsIem5cB6o9pl0X4Z', 'SECRET-ILcNQhdPybzx38Si6Ju9gz5L7YLOpOPs', 'KBO9L20gFuiXuwExiGFurKRsKHlCQChd', NULL, NULL, NULL, NULL, NULL, '2022-12-05 19:57:49', '2022-12-05 19:57:49'),
(14, 'Test 0001', NULL, 'test01-pay-378992928js8', '305778899', 'test01-pay-378992928js8@yopmail.com', 1, 'user', 0, '$2y$10$zL4pohWRZ6LFoHPCLnZG/.w9rCVhxrl4wfE649gKss7NgolTcRpsW', 1, '{\"business_name\": \"JTestBusiness Name\"}', NULL, NULL, 'PUBLIC-65XlbtPqBGEIptTgxMhlwkU7W9HhlYLT', 'SECRET-pbI8Gdxyw7TUWv55Z7w7MJuzsyf1WA5g', 'h53LeL3cfyuqHb7Y3o9WchspoGYi7PaL', '149.19.168.168', '2022-12-10 00:55:12', NULL, NULL, '2022-12-10 01:01:42', '2022-12-06 04:42:58', '2022-12-10 01:01:42'),
(15, 'Giordano', NULL, 'giordano.lugo', '+37258541566', 'giordano.lugo@gmail.com', 1, 'user', 0, '$2y$10$XU9umzM6D5/J0G/tAD653O0pfQyO7y04OYd64uw16gpCK7HgYFojO', 1, '{\"business_name\": \"PepitoLLC\"}', NULL, NULL, 'PUBLIC-PFpQDnJoJjHNHYkurk9jm56HtQUEBid9', 'SECRET-vGUwPL9Wikc06BgooRMm0T7TG26CVjJV', 'EzsVAexywlrqZCVPCnWOXRwTrktQ1mbD', NULL, NULL, NULL, NULL, '2022-12-09 16:48:43', '2022-12-09 16:42:31', '2022-12-09 16:48:43'),
(16, 'Carlos Camacho', NULL, 'carloscgo123', '3212684453', 'carloscgo123@gmail.com', 1, 'user', 334.99, '$2y$10$TdjhAlKf3D4DScIIqTELquwembjGHCmsAmGsORy3RdfkA1zaQd0YG', 1, '{\"business_name\": \"Xcellent System, C.A\"}', NULL, NULL, 'PUBLIC-MGFBrabWSMjdVuJJ5hjl2NqHPpG17lEE', 'SECRET-O9GbcK4FBTog4MirDn32xasOxISMtICh', 'LRemEgUDEploGbCfi5CqQd7c7S0c8nZD', '186.119.107.113', '2022-12-29 21:02:53', NULL, NULL, '2022-12-14 13:44:51', '2022-12-14 13:41:39', '2022-12-29 20:26:42'),
(17, 'Carlos Camacho', NULL, 'carloscgo123+3', '+573212684453', 'carloscgo123+3@gmail.com', 1, 'user', 0, '$2y$10$qMOvd4w1XZVXjM5DlK0EmuQNTu4djkQUh.u5LzYK1Gcj.RiPIovPK', 1, '{\"business_name\": \"New Corp LLC\"}', NULL, NULL, 'PUBLIC-CjRxjsceTnz0ZlZEmF0y17BdfbQPR5fd', 'SECRET-JXDdBUbo1KHxGRjtdfro9wNuBiM2xBdT', 'Pib7jWWDGtGT06EIrCGYFmbpaCYScqqY', NULL, NULL, NULL, NULL, NULL, '2023-01-04 22:15:33', '2023-01-04 22:15:33'),
(18, 'Marco Pirrongelli', NULL, 'carloscgo123+01-zapier', '+584166516515', 'carloscgo123+01-zapier@gmail.com', 1, 'user', 0, '$2y$10$HvxDqAK/cxDIMWOrdS6/H./e6Kq3Oy.YipE4r/7yrGGkO7SOVjI4K', 1, '{\"business_name\": \"Compañia 2\"}', NULL, NULL, 'PUBLIC-hq8TkyuPnciiDQEU4ihh21wo88HuN4iQ', 'SECRET-yAcmW3Zkj9Akj8P66oP2SFNVtTLGilVK', 'UQIu2M7lB8I9U8pxDpvX2ooHMeGTnHDA', NULL, NULL, NULL, NULL, NULL, '2023-01-05 17:02:10', '2023-01-05 17:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_banks`
--

CREATE TABLE `user_banks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `bank_id` bigint UNSIGNED DEFAULT NULL,
  `data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_banks`
--

INSERT INTO `user_banks` (`id`, `user_id`, `bank_id`, `data`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, '{\"account_name\": \"Prof. Ahmad Legros Sr.\", \"account_type\": \"business\", \"account_number\": 16, \"routing_number\": 10}', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(2, 4, NULL, '{\"account_name\": \"Mr. Aron Feeney\", \"account_type\": \"personal\", \"account_number\": 16, \"routing_number\": 10}', '2022-10-17 11:42:10', '2022-10-17 11:42:10'),
(3, 8, 51, '{\"account_name\": \"Backlayer Inc\", \"account_type\": \"individual\", \"account_number\": \"1234567890\", \"routing_number\": \"123455678\"}', '2022-10-17 17:59:00', '2022-10-17 17:59:00'),
(4, 9, 51, '{\"account_name\": \"Carlos Arias\", \"account_type\": \"individual\", \"account_number\": \"6516516\", \"routing_number\": \"61561\"}', '2022-10-18 20:56:51', '2022-10-18 20:56:51'),
(5, 7, 51, '{\"account_name\": \"MARCO PIRRONGELLI\", \"account_type\": \"individual\", \"account_number\": \"123456789\", \"routing_number\": \"123456789\"}', '2022-10-19 15:57:14', '2022-10-19 15:57:14'),
(6, 10, 51, '{\"account_name\": \"individual\", \"account_type\": \"individual\", \"account_number\": \"0102303\", \"routing_number\": \"022323232\"}', '2022-10-20 15:14:38', '2022-10-20 15:14:38'),
(7, 6, 51, '{\"account_name\": \"13456\", \"account_type\": \"individual\", \"account_number\": \"1345690\", \"routing_number\": \"1234567\"}', '2022-10-21 16:06:00', '2022-10-21 16:06:00'),
(8, 11, 51, '{\"account_name\": \"921987654321\", \"account_type\": \"individual\", \"account_number\": \"123789\", \"routing_number\": \"12345678\"}', '2022-11-01 22:46:09', '2022-11-01 22:46:09'),
(9, 12, 51, '{\"account_name\": \"MARCO PIRRONGELLI\", \"account_type\": \"individual\", \"account_number\": \"12345789\", \"routing_number\": \"12345678\"}', '2022-11-06 18:18:26', '2022-11-06 18:18:26'),
(10, 13, 51, '{\"account_name\": \"Union Block LLC\", \"account_type\": \"company\", \"account_number\": \"123123123\", \"routing_number\": \"3213123123\"}', '2022-12-05 19:58:07', '2022-12-05 19:58:07'),
(11, 14, 51, '{\"account_name\": \"Super Account\", \"account_type\": \"company\", \"account_number\": \"8393838938393983\", \"routing_number\": \"37389736\"}', '2022-12-06 04:43:35', '2022-12-06 04:43:35'),
(12, 5, 51, '{\"account_name\": \"Marco Pirrongelli\", \"account_type\": \"individual\", \"account_number\": \"123456789\", \"routing_number\": \"93958694939\"}', '2022-12-08 21:29:02', '2022-12-08 21:29:02'),
(13, 15, 51, '{\"account_name\": \"wise\", \"account_type\": \"individual\", \"account_number\": \"9600000000042432\", \"routing_number\": \"084009519\"}', '2022-12-09 16:48:21', '2022-12-09 16:48:21'),
(14, 16, 51, '{\"account_name\": \"Personal Account\", \"account_type\": \"individual\", \"account_number\": \"7894561258\", \"routing_number\": \"1578\"}', '2022-12-14 13:42:17', '2022-12-14 13:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_plans`
--

CREATE TABLE `user_plans` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double DEFAULT NULL,
  `interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `limit` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `features` json DEFAULT NULL,
  `owner_id` bigint UNSIGNED DEFAULT NULL,
  `currency_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_plans`
--

INSERT INTO `user_plans` (`id`, `uuid`, `name`, `amount`, `interval`, `limit`, `status`, `features`, `owner_id`, `currency_id`, `created_at`, `updated_at`) VALUES
(1, '3c35a2f9-7226-4ae5-b58e-059eef28789c', 'Plan 1', 100, '1 Month', 1, 1, '[{\"title\": \"100\"}]', 3, 6, '2022-10-17 13:59:39', '2022-10-17 13:59:39'),
(2, 'b5573898-a0eb-4e12-828d-b2d14c8be225', 'jerson plan', 100, '1 Day', NULL, 1, '[{\"title\": \"test\"}, {\"title\": \"ssss\"}]', 10, 1, '2022-10-20 17:48:29', '2022-10-20 17:48:29'),
(3, '57dfc048-e51e-44c0-8b28-0e2ebf301af8', 'Prueba Suscription Plan', 50, '1 Month', 1, 1, '[{\"title\": \"Matricula Escuela\"}]', 9, 1, '2022-11-29 09:05:03', '2022-11-29 09:05:03'),
(4, 'd2ae5d09-83c9-4381-acca-289b9845ba0f', 'Plan 1', 10, '1 Month', 1, 1, '[{\"title\": \"Feature 1\"}]', 5, 1, '2022-12-12 18:34:05', '2022-12-12 18:34:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_plan_subscribers`
--

CREATE TABLE `user_plan_subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `charge` double DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `interval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `times` int DEFAULT NULL,
  `is_auto_renew` tinyint(1) NOT NULL DEFAULT '0',
  `user_plan_id` bigint UNSIGNED DEFAULT NULL,
  `owner_id` bigint UNSIGNED DEFAULT NULL,
  `subscriber_id` bigint UNSIGNED DEFAULT NULL,
  `currency_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `merchant_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode` tinyint(1) DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `user_id`, `merchant_name`, `token`, `email`, `mode`, `message`, `created_at`, `updated_at`) VALUES
(1, 9, 'Merchant Website', '2eYWudPCvCrKIA3N3qlNnTsKBqB9IuFr', 'carlosariasreggeti@hotmail.com', 0, 'Este mensaje llega despues de un pago en una website integrada', '2022-11-29 09:07:29', '2022-11-29 09:07:29'),
(2, 5, 'Marco', 'c3X4lLdmXuZniN6ykMZjs2sjIqhBa52d', 'marco@backlayer.eu', 1, 'Thanks', '2022-12-12 18:30:48', '2022-12-12 18:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `web_orders`
--

CREATE TABLE `web_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `website_id` bigint UNSIGNED DEFAULT NULL,
  `currency_id` bigint UNSIGNED DEFAULT NULL,
  `gateway_id` bigint UNSIGNED DEFAULT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `charge` double DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `meta` json NOT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `payment_status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_test_orders`
--

CREATE TABLE `web_test_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `website_id` bigint UNSIGNED DEFAULT NULL,
  `currency_id` bigint UNSIGNED DEFAULT NULL,
  `gateway_id` bigint UNSIGNED DEFAULT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `charge` double DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `meta` json NOT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `payment_status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banks_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_mails`
--
ALTER TABLE `contact_mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_name_unique` (`name`),
  ADD UNIQUE KEY `currencies_code_unique` (`code`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deposits_user_id_foreign` (`user_id`),
  ADD KEY `deposits_gateway_id_foreign` (`gateway_id`),
  ADD KEY `deposits_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `donationorders`
--
ALTER TABLE `donationorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donationorders_donor_id_foreign` (`donor_id`),
  ADD KEY `donationorders_user_id_foreign` (`user_id`),
  ADD KEY `donationorders_gateway_id_foreign` (`gateway_id`),
  ADD KEY `donationorders_currency_id_foreign` (`currency_id`),
  ADD KEY `donationorders_donation_id_foreign` (`donation_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donations_uuid_unique` (`uuid`),
  ADD KEY `donations_user_id_foreign` (`user_id`),
  ADD KEY `donations_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gateways_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_uuid_unique` (`uuid`),
  ADD KEY `invoices_owner_id_foreign` (`owner_id`),
  ADD KEY `invoices_currency_id_foreign` (`currency_id`),
  ADD KEY `invoices_gateway_id_foreign` (`gateway_id`) USING BTREE;

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `kyc_methods`
--
ALTER TABLE `kyc_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_method_user`
--
ALTER TABLE `kyc_method_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kyc_method_user_kyc_method_id_foreign` (`kyc_method_id`),
  ADD KEY `kyc_method_user_user_id_foreign` (`user_id`),
  ADD KEY `kyc_method_user_kyc_request_id_foreign` (`kyc_request_id`);

--
-- Indexes for table `kyc_requests`
--
ALTER TABLE `kyc_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kyc_requests_user_id_foreign` (`user_id`),
  ADD KEY `kyc_requests_kyc_method_id_foreign` (`kyc_method_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_user_id_foreign` (`user_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `moneyrequests`
--
ALTER TABLE `moneyrequests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moneyrequests_sender_id_foreign` (`sender_id`),
  ADD KEY `moneyrequests_receiver_id_foreign` (`receiver_id`),
  ADD KEY `moneyrequests_request_currency_id_foreign` (`request_currency_id`),
  ADD KEY `moneyrequests_approved_currency_id_foreign` (`approved_currency_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderitems_order_id_foreign` (`order_id`),
  ADD KEY `orderitems_product_id_foreign` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_shipping_id_foreign` (`shipping_id`),
  ADD KEY `orders_seller_id_foreign` (`seller_id`),
  ADD KEY `orders_gateway_id_foreign` (`gateway_id`),
  ADD KEY `orders_currency_id_foreign` (`currency_id`),
  ADD KEY `orders_storefront_id_foreign` (`storefront_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payouts_user_id_foreign` (`user_id`),
  ADD KEY `payouts_user_bank_id_foreign` (`user_bank_id`),
  ADD KEY `payouts_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_storefront`
--
ALTER TABLE `product_storefront`
  ADD KEY `product_storefront_storefront_id_foreign` (`storefront_id`),
  ADD KEY `product_storefront_product_id_foreign` (`product_id`);

--
-- Indexes for table `qrpayments`
--
ALTER TABLE `qrpayments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qrpayments_seller_id_foreign` (`seller_id`),
  ADD KEY `qrpayments_gateway_id_foreign` (`gateway_id`),
  ADD KEY `qrpayments_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_user_id_foreign` (`user_id`);

--
-- Indexes for table `shorten_link`
--
ALTER TABLE `shorten_link`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shorten_link_hash_unique` (`hash`);

--
-- Indexes for table `signup_fields`
--
ALTER TABLE `signup_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `singlechargeorders`
--
ALTER TABLE `singlechargeorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `singlechargeorders_user_id_foreign` (`user_id`),
  ADD KEY `singlechargeorders_gateway_id_foreign` (`gateway_id`),
  ADD KEY `singlechargeorders_singlecharge_id_foreign` (`singlecharge_id`),
  ADD KEY `singlechargeorders_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `singlecharges`
--
ALTER TABLE `singlecharges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `singlecharges_uuid_unique` (`uuid`),
  ADD KEY `singlecharges_user_id_foreign` (`user_id`),
  ADD KEY `singlecharges_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `storefronts`
--
ALTER TABLE `storefronts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storefronts_user_id_foreign` (`user_id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supports_user_id_foreign` (`user_id`);

--
-- Indexes for table `support_metas`
--
ALTER TABLE `support_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_metas_support_id_foreign` (`support_id`),
  ADD KEY `support_metas_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `taxes_name_unique` (`name`);

--
-- Indexes for table `temporary_files`
--
ALTER TABLE `temporary_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termcategories`
--
ALTER TABLE `termcategories`
  ADD KEY `termcategories_term_id_foreign` (`term_id`),
  ADD KEY `termcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `term_metas`
--
ALTER TABLE `term_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `term_metas_term_id_foreign` (`term_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfers_user_id_foreign` (`user_id`),
  ADD KEY `transfers_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_public_key_unique` (`public_key`),
  ADD UNIQUE KEY `users_secret_key_unique` (`secret_key`),
  ADD UNIQUE KEY `users_qr_unique` (`qr`),
  ADD KEY `users_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `user_banks`
--
ALTER TABLE `user_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_banks_user_id_foreign` (`user_id`),
  ADD KEY `user_banks_bank_id_foreign` (`bank_id`);

--
-- Indexes for table `user_plans`
--
ALTER TABLE `user_plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_plans_uuid_unique` (`uuid`),
  ADD KEY `user_plans_owner_id_foreign` (`owner_id`),
  ADD KEY `user_plans_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `user_plan_subscribers`
--
ALTER TABLE `user_plan_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_plan_subscribers_user_plan_id_foreign` (`user_plan_id`),
  ADD KEY `user_plan_subscribers_owner_id_foreign` (`owner_id`),
  ADD KEY `user_plan_subscribers_subscriber_id_foreign` (`subscriber_id`),
  ADD KEY `user_plan_subscribers_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `websites_token_unique` (`token`),
  ADD KEY `websites_user_id_foreign` (`user_id`);

--
-- Indexes for table `web_orders`
--
ALTER TABLE `web_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `web_orders_uuid_unique` (`uuid`),
  ADD KEY `web_orders_user_id_foreign` (`user_id`),
  ADD KEY `web_orders_website_id_foreign` (`website_id`),
  ADD KEY `web_orders_currency_id_foreign` (`currency_id`),
  ADD KEY `web_orders_gateway_id_foreign` (`gateway_id`);

--
-- Indexes for table `web_test_orders`
--
ALTER TABLE `web_test_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `web_test_orders_uuid_unique` (`uuid`),
  ADD KEY `web_test_orders_user_id_foreign` (`user_id`),
  ADD KEY `web_test_orders_website_id_foreign` (`website_id`),
  ADD KEY `web_test_orders_currency_id_foreign` (`currency_id`),
  ADD KEY `web_test_orders_gateway_id_foreign` (`gateway_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contact_mails`
--
ALTER TABLE `contact_mails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donationorders`
--
ALTER TABLE `donationorders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `kyc_methods`
--
ALTER TABLE `kyc_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kyc_method_user`
--
ALTER TABLE `kyc_method_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kyc_requests`
--
ALTER TABLE `kyc_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `moneyrequests`
--
ALTER TABLE `moneyrequests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `qrpayments`
--
ALTER TABLE `qrpayments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shorten_link`
--
ALTER TABLE `shorten_link`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signup_fields`
--
ALTER TABLE `signup_fields`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `singlechargeorders`
--
ALTER TABLE `singlechargeorders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `singlecharges`
--
ALTER TABLE `singlecharges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `storefronts`
--
ALTER TABLE `storefronts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_metas`
--
ALTER TABLE `support_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temporary_files`
--
ALTER TABLE `temporary_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `term_metas`
--
ALTER TABLE `term_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_banks`
--
ALTER TABLE `user_banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_plans`
--
ALTER TABLE `user_plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_plan_subscribers`
--
ALTER TABLE `user_plan_subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `web_orders`
--
ALTER TABLE `web_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_test_orders`
--
ALTER TABLE `web_test_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banks`
--
ALTER TABLE `banks`
  ADD CONSTRAINT `banks_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `deposits_gateway_id_foreign` FOREIGN KEY (`gateway_id`) REFERENCES `gateways` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `deposits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `donationorders`
--
ALTER TABLE `donationorders`
  ADD CONSTRAINT `donationorders_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `donationorders_donation_id_foreign` FOREIGN KEY (`donation_id`) REFERENCES `donations` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `donationorders_donor_id_foreign` FOREIGN KEY (`donor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `donationorders_gateway_id_foreign` FOREIGN KEY (`gateway_id`) REFERENCES `gateways` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `donationorders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `donations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `gateways`
--
ALTER TABLE `gateways`
  ADD CONSTRAINT `gateways_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `invoices_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `kyc_method_user`
--
ALTER TABLE `kyc_method_user`
  ADD CONSTRAINT `kyc_method_user_kyc_method_id_foreign` FOREIGN KEY (`kyc_method_id`) REFERENCES `kyc_methods` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `kyc_method_user_kyc_request_id_foreign` FOREIGN KEY (`kyc_request_id`) REFERENCES `kyc_requests` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `kyc_method_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `kyc_requests`
--
ALTER TABLE `kyc_requests`
  ADD CONSTRAINT `kyc_requests_kyc_method_id_foreign` FOREIGN KEY (`kyc_method_id`) REFERENCES `kyc_methods` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `kyc_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `moneyrequests`
--
ALTER TABLE `moneyrequests`
  ADD CONSTRAINT `moneyrequests_approved_currency_id_foreign` FOREIGN KEY (`approved_currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `moneyrequests_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `moneyrequests_request_currency_id_foreign` FOREIGN KEY (`request_currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `moneyrequests_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `orderitems_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_gateway_id_foreign` FOREIGN KEY (`gateway_id`) REFERENCES `gateways` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `shippings` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_storefront_id_foreign` FOREIGN KEY (`storefront_id`) REFERENCES `storefronts` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `payouts`
--
ALTER TABLE `payouts`
  ADD CONSTRAINT `payouts_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `payouts_user_bank_id_foreign` FOREIGN KEY (`user_bank_id`) REFERENCES `user_banks` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `payouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `product_storefront`
--
ALTER TABLE `product_storefront`
  ADD CONSTRAINT `product_storefront_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_storefront_storefront_id_foreign` FOREIGN KEY (`storefront_id`) REFERENCES `storefronts` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `qrpayments`
--
ALTER TABLE `qrpayments`
  ADD CONSTRAINT `qrpayments_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `qrpayments_gateway_id_foreign` FOREIGN KEY (`gateway_id`) REFERENCES `gateways` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `qrpayments_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `singlechargeorders`
--
ALTER TABLE `singlechargeorders`
  ADD CONSTRAINT `singlechargeorders_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `singlechargeorders_gateway_id_foreign` FOREIGN KEY (`gateway_id`) REFERENCES `gateways` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `singlechargeorders_singlecharge_id_foreign` FOREIGN KEY (`singlecharge_id`) REFERENCES `singlecharges` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `singlechargeorders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `singlecharges`
--
ALTER TABLE `singlecharges`
  ADD CONSTRAINT `singlecharges_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `singlecharges_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `storefronts`
--
ALTER TABLE `storefronts`
  ADD CONSTRAINT `storefronts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `supports`
--
ALTER TABLE `supports`
  ADD CONSTRAINT `supports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `support_metas`
--
ALTER TABLE `support_metas`
  ADD CONSTRAINT `support_metas_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `support_metas_support_id_foreign` FOREIGN KEY (`support_id`) REFERENCES `supports` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `termcategories`
--
ALTER TABLE `termcategories`
  ADD CONSTRAINT `termcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `termcategories_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `term_metas`
--
ALTER TABLE `term_metas`
  ADD CONSTRAINT `term_metas_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `transfers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `user_banks`
--
ALTER TABLE `user_banks`
  ADD CONSTRAINT `user_banks_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_banks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `user_plans`
--
ALTER TABLE `user_plans`
  ADD CONSTRAINT `user_plans_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_plans_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `user_plan_subscribers`
--
ALTER TABLE `user_plan_subscribers`
  ADD CONSTRAINT `user_plan_subscribers_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_plan_subscribers_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_plan_subscribers_subscriber_id_foreign` FOREIGN KEY (`subscriber_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_plan_subscribers_user_plan_id_foreign` FOREIGN KEY (`user_plan_id`) REFERENCES `user_plans` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `websites`
--
ALTER TABLE `websites`
  ADD CONSTRAINT `websites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `web_orders`
--
ALTER TABLE `web_orders`
  ADD CONSTRAINT `web_orders_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `web_orders_gateway_id_foreign` FOREIGN KEY (`gateway_id`) REFERENCES `gateways` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `web_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `web_orders_website_id_foreign` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `web_test_orders`
--
ALTER TABLE `web_test_orders`
  ADD CONSTRAINT `web_test_orders_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `web_test_orders_gateway_id_foreign` FOREIGN KEY (`gateway_id`) REFERENCES `gateways` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `web_test_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `web_test_orders_website_id_foreign` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
