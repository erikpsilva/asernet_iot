-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/02/2026 às 22:10
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `admin_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `campaign_people`
--

CREATE TABLE `campaign_people` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(160) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `numbersLucky` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`numbersLucky`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `campaign_people`
--

INSERT INTO `campaign_people` (`id`, `name`, `cpf`, `email`, `phone`, `numbersLucky`, `created_at`, `updated_at`) VALUES
(1, 'Erik Primao', '35857206847', 'erikprimao@gmail.com', '11942307240', '[{\"number\": \"41812\", \"type\": \"referral\", \"date\": \"2026-02-20T23:53:28-03:00\", \"nomeIndicado\": \"Ana Paula Assunção\"}, {\"number\": \"37034\", \"type\": \"referral\", \"date\": \"2026-02-20T23:55:24-03:00\", \"nomeIndicado\": \"Gonçalo Ferreira\"}, {\"number\": \"96646\", \"type\": \"referral\", \"date\": \"2026-02-21T00:14:58-03:00\", \"nomeIndicado\": \"Carol Assunção\"}, {\"number\": \"65833\", \"type\": \"referral\", \"date\": \"2026-02-21T12:18:13-03:00\", \"nomeIndicado\": \"Ana Assuncao\"}, {\"number\": \"34633\", \"type\": \"referral\", \"date\": \"2026-02-21T12:18:35-03:00\", \"nomeIndicado\": \"Ana Assuncao\"}, {\"number\": \"87325\", \"type\": \"referral\", \"date\": \"2026-02-21T12:19:30-03:00\", \"nomeIndicado\": \"Ana Assuncao\"}, {\"number\": \"17088\", \"type\": \"referral\", \"date\": \"2026-02-21T12:19:47-03:00\", \"nomeIndicado\": \"Ana Assuncao\"}]', '2026-02-21 02:53:28', '2026-02-21 15:19:47'),
(2, 'Ana Paula Aparecida Rodrigues Assunção', '34044956839', 'anapaula.nutri11@gmail.com', '11964713950', '[{\"number\": \"65038\", \"type\": \"signup\", \"date\": \"2026-02-20T23:53:28-03:00\", \"nomeIndicado\": null}, {\"number\": \"77114\", \"type\": \"referral\", \"date\": \"2026-02-21T00:41:52-03:00\", \"nomeIndicado\": \"Lohana Gabriele\"}]', '2026-02-21 02:53:28', '2026-02-21 03:41:52'),
(3, 'Gonçalo Ferreira', '07560931804', 'goncalinhofs@gmail.com', '11942307241', '[{\"number\": \"26645\", \"type\": \"signup\", \"date\": \"2026-02-20T23:55:24-03:00\", \"nomeIndicado\": null}]', '2026-02-21 02:55:24', '2026-02-21 02:55:24'),
(4, 'Carol Assunção', '07560931801', 'carol@carol.com', '11905464065', '[{\"number\": \"84180\", \"type\": \"signup\", \"date\": \"2026-02-21T00:14:58-03:00\", \"nomeIndicado\": null}]', '2026-02-21 03:14:58', '2026-02-21 03:14:58'),
(5, 'Sirius Black', '01234567890', 'sirius@sirius.com', '11906406540', '[{\"number\": \"48927\", \"type\": \"signup\", \"date\": \"2026-02-21T00:17:58-03:00\", \"nomeIndicado\": null}]', '2026-02-21 03:17:58', '2026-02-21 03:17:58'),
(6, 'Lohana Gabriele', '12345678900', 'lohana.gvsp@gmail.com', '11904504064', '[{\"number\": \"54369\", \"type\": \"signup\", \"date\": \"2026-02-21T00:41:52-03:00\", \"nomeIndicado\": null}]', '2026-02-21 03:41:52', '2026-02-21 03:41:52'),
(7, 'Ana Assuncao', '03246579806', 'anassunc@anassun.com', '11904560464', '[{\"number\": \"30360\", \"type\": \"signup\", \"date\": \"2026-02-21T12:18:13-03:00\", \"nomeIndicado\": null}]', '2026-02-21 15:18:13', '2026-02-21 15:18:13'),
(8, 'Ana Assuncao', '04560465406', 'anassunc@aaanassun.com', '11904560464', '[{\"number\": \"16888\", \"type\": \"signup\", \"date\": \"2026-02-21T12:18:35-03:00\", \"nomeIndicado\": null}]', '2026-02-21 15:18:35', '2026-02-21 15:18:35'),
(9, 'Ana Assuncao', '65406540654', 'anassusasnc@aaasanassun.com', '11904560464', '[{\"number\": \"42828\", \"type\": \"signup\", \"date\": \"2026-02-21T12:19:30-03:00\", \"nomeIndicado\": null}]', '2026-02-21 15:19:30', '2026-02-21 15:19:30'),
(10, 'Ana Assuncao', '11111111111', 'anassusasnc@aaassdanassun.com', '11904560464', '[{\"number\": \"70070\", \"type\": \"signup\", \"date\": \"2026-02-21T12:19:47-03:00\", \"nomeIndicado\": null}]', '2026-02-21 15:19:47', '2026-02-21 15:19:47'),
(11, 'Luciane', '11906546546', 'luciane@luciane.com', '11804646546', '[{\"number\": \"32348\", \"type\": \"referral\", \"date\": \"2026-02-22T10:35:00-03:00\", \"nomeIndicado\": \"Roberta Dauni\"}]', '2026-02-22 13:35:00', '2026-02-22 13:35:00'),
(12, 'Roberta Dauni', '02315804798', 'robertinha@roberta.com', '11980446545', '[{\"number\": \"62918\", \"type\": \"signup\", \"date\": \"2026-02-22T10:35:00-03:00\", \"nomeIndicado\": null}]', '2026-02-22 13:35:00', '2026-02-22 13:35:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lucky_numbers_registry`
--

CREATE TABLE `lucky_numbers_registry` (
  `id` int(11) NOT NULL,
  `lucky_number` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lucky_numbers_registry`
--

INSERT INTO `lucky_numbers_registry` (`id`, `lucky_number`, `created_at`) VALUES
(1, 41812, '2026-02-21 02:53:28'),
(2, 65038, '2026-02-21 02:53:28'),
(3, 37034, '2026-02-21 02:55:24'),
(4, 26645, '2026-02-21 02:55:24'),
(5, 96646, '2026-02-21 03:14:58'),
(6, 84180, '2026-02-21 03:14:58'),
(7, 48927, '2026-02-21 03:17:58'),
(8, 77114, '2026-02-21 03:41:52'),
(9, 54369, '2026-02-21 03:41:52'),
(10, 65833, '2026-02-21 15:18:13'),
(11, 30360, '2026-02-21 15:18:13'),
(12, 34633, '2026-02-21 15:18:35'),
(13, 16888, '2026-02-21 15:18:35'),
(14, 87325, '2026-02-21 15:19:30'),
(15, 42828, '2026-02-21 15:19:30'),
(16, 17088, '2026-02-21 15:19:47'),
(17, 70070, '2026-02-21 15:19:47'),
(18, 32348, '2026-02-22 13:35:00'),
(19, 62918, '2026-02-22 13:35:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(160) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `level_access` enum('admin','editor','viewer') NOT NULL DEFAULT 'viewer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `cpf`, `email`, `password_hash`, `phone`, `level_access`, `created_at`, `updated_at`) VALUES
(4, 'Thabata Stoll', '36272972881', 'thabatastoll@gmail.com', '$2y$10$wfqhBnmjdfyBTZ0IuJf03utqpjGjznvfMjeJqFHu2LcwK0100XZRe', '19991240005', 'admin', '2026-02-17 12:06:30', '2026-02-17 12:06:30'),
(5, 'Erik Primão', '35857206847', 'erikprimao@gmail.com', '$2y$10$jdfkfhnpfVuJm4.aQD.43.1UC5h19KJ8aAw5qynVHsf7v8MfHfysC', '11942307240', 'admin', '2026-02-17 13:57:27', '2026-02-21 15:16:35'),
(6, 'User Teste', '01234567890', 'erikpsilva@gmail.com', '$2y$10$pOrNQ8mAMluS6m5YOeoi8ux97Uea5ijzj6vSUvFHKoy7mkwu6p4zS', '19906504654', 'editor', '2026-02-17 13:58:08', '2026-02-17 14:00:27');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `campaign_people`
--
ALTER TABLE `campaign_people`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `lucky_numbers_registry`
--
ALTER TABLE `lucky_numbers_registry`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lucky_number` (`lucky_number`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `campaign_people`
--
ALTER TABLE `campaign_people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `lucky_numbers_registry`
--
ALTER TABLE `lucky_numbers_registry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
