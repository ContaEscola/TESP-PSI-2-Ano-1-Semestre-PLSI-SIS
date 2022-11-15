CREATE SCHEMA IF NOT EXISTS aerocontrol;

USE aerocontrol;

--
-- Estrutura da tabela `user`
--
CREATE TABLE IF NOT EXISTS `user` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `username` VARCHAR(30) NOT NULL,
  `auth_key` VARCHAR(32) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `password_reset_token` VARCHAR(255) NULL,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `gender` ENUM('Masculino', 'Feminino', 'Outro') NOT NULL,
  `country` VARCHAR(50) NOT NULL,
  `city` VARCHAR(75) NOT NULL,
  `birthdate` DATE NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  `phone_country_code` VARCHAR(5) NOT NULL,
  `status` SMALLINT(6) NOT NULL DEFAULT '9',
  `created_at` INT(11) NOT NULL,
  `updated_at` INT(11) NOT NULL,
  `verification_token` VARCHAR(255) NULL,
  CONSTRAINT `pk_user_id` PRIMARY KEY(`id`),
  CONSTRAINT `uk_username` UNIQUE KEY(`username`),
  CONSTRAINT `uk_password_reset_token` UNIQUE KEY(`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `admin`
--
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` INT UNSIGNED,
  CONSTRAINT `pk_admin_id` PRIMARY KEY(`admin_id`),
  CONSTRAINT `fk_admin_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `user`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `client`
--
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` INT UNSIGNED,
  CONSTRAINT `pk_client_id` PRIMARY KEY(`client_id`),
  CONSTRAINT `fk_client_client_id` FOREIGN KEY (`client_id`) REFERENCES `user`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `employee_function`
--
CREATE TABLE IF NOT EXISTS `employee_function` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  CONSTRAINT `pk_employee_function_id` PRIMARY KEY (`id`),
  CONSTRAINT `uk_name` UNIQUE KEY(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `employee`
--
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` INT UNSIGNED,
  `tin` VARCHAR(20) NOT NULL,
  `num_emp` VARCHAR(20) NOT NULL,
  `ssn` VARCHAR(20) NOT NULL,
  `street` VARCHAR(100) NOT NULL,
  `zip_code` VARCHAR(20) NOT NULL,
  `iban` CHAR(25) NOT NULL,
  `qualifications` enum(
    'Até ao 9º ano de escolaridade',
    'Secundário',
    'Curso técnico superior profissional',
    'Diploma de Especialização Tecnológica',
    'Ensino superior - bacharelato ou equivalente',
    'Licenciatura Pré-Bolonha',
    'Licenciatura 1º Ciclo - Pós-Bolonha',
    'Mestrado',
    'Doutoramento'
  ) NOT NULL,
  `function_id` INT(11) UNSIGNED NOT NULL,
  CONSTRAINT `pk_employee_id` PRIMARY KEY(`employee_id`),
  CONSTRAINT `fk_employee_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `user`(`id`),
  CONSTRAINT `fk_employee_function_id` FOREIGN KEY (`function_id`) REFERENCES `employee_function`(`id`),
  CONSTRAINT `uk_num_emp` UNIQUE KEY(`num_emp`),
  CONSTRAINT `uk_ssn` UNIQUE KEY(`ssn`),
  CONSTRAINT `uk_tin` UNIQUE KEY(`tin`),
  CONSTRAINT `uk_iban` UNIQUE KEY(`iban`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `restaurant`
--
CREATE TABLE IF NOT EXISTS `restaurant` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `name` VARCHAR(75) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `open_time` TIME NULL,
  `close_time` TIME NULL,
  `logo` VARCHAR(50) NULL,
  `website` VARCHAR(50) NULL,
  CONSTRAINT `pk_restaurant_id` PRIMARY KEY(`id`),
  CONSTRAINT `uk_name` UNIQUE KEY(`name`),
  CONSTRAINT `uk_logo` UNIQUE KEY(`logo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `restaurant_item`
--
CREATE TABLE IF NOT EXISTS `restaurant_item` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `item` VARCHAR(100) NOT NULL,
  `image` VARCHAR(50) NOT NULL,
  `state` TINYINT(1) NOT NULL,
  `restaurant_id` INT(11) UNSIGNED NOT NULL,
  CONSTRAINT `pk_restaurant_item_id` PRIMARY KEY(`id`),
  CONSTRAINT `fk_restaurant_item_restaurant_id` FOREIGN KEY(`restaurant_id`) REFERENCES `restaurant`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `manager`
--
CREATE TABLE IF NOT EXISTS `manager` (
  `manager_id` INT UNSIGNED,
  `restaurant_id` INT(11) UNSIGNED NOT NULL,
  CONSTRAINT `pk_manager_id` PRIMARY KEY(`manager_id`),
  CONSTRAINT `fk_manager_manager_id` FOREIGN KEY (`manager_id`) REFERENCES `user`(`id`),
  CONSTRAINT `fk_manager_restaurant_id` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `airport`
--
CREATE TABLE IF NOT EXISTS `airport` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `country` VARCHAR(50) NOT NULL,
  `city` VARCHAR(75) NOT NULL,
  `name` VARCHAR(75) NOT NULL,
  `website` VARCHAR(50) NOT NULL,
  CONSTRAINT `pk_airport_id` PRIMARY KEY(`id`),
  CONSTRAINT `uk_name` UNIQUE KEY(`name`),
  CONSTRAINT `uk_website` UNIQUE KEY(`website`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `company`
--
CREATE TABLE IF NOT EXISTS `company` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  CONSTRAINT `pk_company_id` PRIMARY KEY(`id`),
  CONSTRAINT `uk_name` UNIQUE KEY(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `airplane`
--
CREATE TABLE IF NOT EXISTS `airplane` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `name` VARCHAR(75) NOT NULL,
  `capacity` SMALLINT(6) NOT NULL,
  `state` TINYINT(1) NOT NULL,
  `company_id` INT(11) UNSIGNED NOT NULL,
  CONSTRAINT `pk_airplane_id` PRIMARY KEY(`id`),
  CONSTRAINT `fk_airplane_company_id` FOREIGN KEY(`company_id`) REFERENCES `company`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `state` TINYINT(1) NOT NULL,
  `icon` VARCHAR(50) NOT NULL,
  CONSTRAINT `pk_payment_method` PRIMARY KEY(`id`),
  CONSTRAINT `uk_name` UNIQUE KEY(`name`),
  CONSTRAINT `uk_icon` UNIQUE KEY(`icon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `flight`
--

CREATE TABLE IF NOT EXISTS `flight` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `terminal` VARCHAR(30) NOT NULL,
  `estimated_departure_date` DATETIME NOT NULL,
  `estimated_arrival_date` DATETIME NOT NULL,
  `departure_date` DATETIME NULL,
  `arrival_date` DATETIME NULL,
  `price` DOUBLE NOT NULL,
  `distance` FLOAT NOT NULL,
  `state` ENUM('Previsto','Chegou','Partiu','Cancelado','Embarque','Ultima Chamada') NOT NULL DEFAULT 'Previsto',
  `discount_percentage` TINYINT(4) NOT NULL,
  `origin_airport_id` INT UNSIGNED NOT NULL,
  `arrival_airport_id` INT UNSIGNED NOT NULL,
  `airplane_id` INT UNSIGNED NOT NULL,
  CONSTRAINT `pk_flight_id` PRIMARY KEY(`id`),
  CONSTRAINT `fk_flight_origin_airport_id` FOREIGN KEY(`origin_airport_id`) REFERENCES `airport`(`id`),
  CONSTRAINT `fk_flight_arrival_airport_id` FOREIGN KEY(`arrival_airport_id`) REFERENCES `airport`(`id`),
  CONSTRAINT `fk_flight_airplane_id` FOREIGN KEY(`airplane_id`) REFERENCES `airplane`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `flight_ticket`
--

CREATE TABLE IF NOT EXISTS `flight_ticket` (
  `flight_ticket_id` INT UNSIGNED AUTO_INCREMENT,
  `price` DOUBLE NOT NULL,
  `purchase_date` DATETIME NOT NULL,
  `checkin` TINYINT(1) NOT NULL,
  `client_id` INT(11) UNSIGNED NOT NULL,
  `flight_id` INT(11) UNSIGNED NOT NULL,
  `payment_method_id` INT(11) UNSIGNED NOT NULL,
  CONSTRAINT `pk_flight_ticket` PRIMARY KEY(`flight_ticket_id`,`client_id`,`flight_id`),
  CONSTRAINT `fk_flight_ticket_client_id` FOREIGN KEY(`client_id`) REFERENCES `client`(`client_id`),
  CONSTRAINT `fk_flight_ticket_flight_id` FOREIGN KEY(`flight_id`) REFERENCES `flight`(`id`),
  CONSTRAINT `fk_flight_ticket_payment_method_id` FOREIGN KEY(`payment_method_id`) REFERENCES `payment_method`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `passenger`
--

CREATE TABLE IF NOT EXISTS `passenger` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `gender` ENUM('Masculino','Feminino','Outro') NOT NULL,
  `flight_ticket_id` INT(11) UNSIGNED NOT NULL,
  CONSTRAINT `pk_passenger_id` PRIMARY KEY (`id`),
  CONSTRAINT `fk_passenger_flight_ticket_id` FOREIGN KEY(`flight_ticket_id`) REFERENCES `flight_ticket`(`flight_ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `lost_item`
--

CREATE TABLE IF NOT EXISTS `lost_item` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `description` VARCHAR(100) NOT NULL,
  `state` ENUM('Entregue','Por entregar','Perdido') NOT NULL DEFAULT 'Por entregar',
  `image` VARCHAR(75) NOT NULL,
  CONSTRAINT `pk_lost_item_id` PRIMARY KEY(`id`),
  CONSTRAINT `uk_image` UNIQUE KEY(`image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `support_ticket`
--

CREATE TABLE IF NOT EXISTS `support_ticket` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `title` VARCHAR(20) NOT NULL,
  `state` ENUM('Por Rever','Concluido','Em Processo') NOT NULL DEFAULT 'Por Rever',
  `client_id` INT(11) UNSIGNED NOT NULL,
  `employee_id` INT(11) UNSIGNED NOT NULL,
  CONSTRAINT `pk_support_ticket_id` PRIMARY KEY (`id`),
  CONSTRAINT `fk_support_ticket_client_id` FOREIGN KEY (`client_id`) REFERENCES `client`(`client_id`),
  CONSTRAINT `fk_support_ticket_employee_id` FOREIGN KEY(`employee_id`) REFERENCES `employee`(`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `ticket_item`
--

CREATE TABLE IF NOT EXISTS `ticket_item` (
  `lost_item_id` INT UNSIGNED,
  `support_ticket_id` INT(11) UNSIGNED NOT NULL,
  CONSTRAINT `pk_ticket_item_lost_item_id` PRIMARY KEY(`lost_item_id`),
  CONSTRAINT `fk_ticket_item_lost_item_id`  FOREIGN KEY (`lost_item_id`) REFERENCES `lost_item` (`id`),
  CONSTRAINT `fk_ticket_item_support_ticket_id` FOREIGN KEY (`support_ticket_id`) REFERENCES `support_ticket` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `ticket_message`
--

CREATE TABLE IF NOT EXISTS `ticket_message` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `message` VARCHAR(255) NOT NULL,
  `photo` VARCHAR(75) NULL,
  `sender_id` INT(11) UNSIGNED NOT NULL,
  `support_ticket_id` INT(11) UNSIGNED NOT NULL,
  CONSTRAINT `pk_ticket_message` PRIMARY KEY(`id`),
  CONSTRAINT `fk_ticket_message_support_ticket_id` FOREIGN KEY(`support_ticket_id`) REFERENCES `support_ticket`(`id`),
  CONSTRAINT `uk_photo` UNIQUE KEY(`photo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



--
--
-- INSERTS
--
--


INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `first_name`, `last_name`, `gender`, `country`, `city`, `birthdate`, `email`, `phone`, `phone_country_code`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'Rafael', '3LCUGMKxZPpzr34KJQqnRHerxvb9H-GD', '$2y$13$siIFsVQTb.Xw.SCmxCkkeOpP/jUmewhYu8kYaxdeH5XPFHyK1FCe6', NULL, 'Rafael', 'Bento', 'Masculino', 'Portugal', 'Lisboa', '2002-08-07', 'rafael@email.pt', '912345678', '+351', 10, 1667385991, 1667392931, 'iBlapCIFv2HLg6_itfyyr-xsERf_b287_1667385991'),
(2, 'Pedro', 'JO3nV-1f2xjjEfqBrOw-EhJDGgAgFBvT', '$2y$13$t0EbTzLBtr2jKt5SteKVReIEyizI4lBopTTFJggFMjgj1odid.HpG', NULL, 'Pedro', 'Norberto', 'Masculino', 'Portugal', 'Lisboa', '2002-11-13', 'pedro@email.pt', '913412581', '+351', 10, 1667390821, 1667392906, 'fd73elasjLW11GrxlDenw2dcPfzWBA6h_1667390821'),
(3, 'Manuel', 'E3JGSTaNM8D7MbTdd7VyXWKn2nMPN6kO', '$2y$13$WYKf.WWmQEb4Hd2FpvUsGer/Lq7bTQFaVm6WerOJjNmCBMBzXn.Yy', NULL, 'Manuel', 'Henriques', 'Masculino', 'Portugal', 'Lisboa', '2002-11-08', 'pedrohenriques@gmail.pt', '998877665', '+351', 10, 1667394488, 1667394488, 'aQ1CM8RK8jZVZo27pg8KI_EZXNCFCspR_1667394488'),
(4,'Antonio', 'sOAZ_ou8A8ZImJjZ8C5R9mYrnSn3MjdR', '$2y$13$yRY3c2CeOV5472uQQQbyq.EXV3j1QZs9nZwg4ulAGMnHK/PhiKykC', NULL, 'Antonio', 'Alberto', 'Masculino', 'Portugal', 'Torres Vedras', '2002-10-30', 'antonio.alberto@live.com', '911111111', '+351', 10, 1668529982, 1668529982, 'ny7bgoj7mvW732Kv1pBHzTF7A2cu3l66_1668529982'),
(5,'Joaquim', 'SsqujPrZXyG1tLKUwF8XP0YfJWmmSh6n', '$2y$13$sq4r3qgKLBhjAuwehOnwju4f8RGh9kL04/Vzn0ntzq3KDY9kmbx1O', NULL, 'Joaquim', 'Antunes', 'Masculino', 'Portugal', 'Torres Vedras', '2022-11-13', 'joaquim.antunes@live.com', '911111111', '+351', 10, 1668530463, 1668531494, '62ZbfYy0ohnj5WoQjEYaUbNYaCnuBOi0_1668530463');


INSERT INTO `admin`(admin_id) VALUES(1);


INSERT INTO `employee_function`(id,name) VALUES
(1,"Limpeza"),
(2,"Empregado de Balcã");


INSERT INTO `employee` (`employee_id`, `tin`, `num_emp`, `ssn`, `street`, `zip_code`, `iban`, `qualifications`, `function_id`) VALUES
(2, '123321432', 'a121112', '312123412', 'Rua Principal nº6', '2530-321', 'PT50123123123123123123123', 'Curso técnico superior profissional', 1),
(3, '123456444', 'a123321', '567431987', 'Rua das Amoreiras nº3', '2530-555', 'PT50948594069485013430405', 'Ensino superior - bacharelato ou equivalente', 2);


INSERT INTO `client` (client_id) VALUES (4) , (5);