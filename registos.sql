--
--
-- INSERTS
--
--

use aerocontrol;

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `first_name`, `last_name`, `gender`, `country`, `city`, `birthdate`, `email`, `phone`, `phone_country_code`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'Rafael', '3LCUGMKxZPpzr34KJQqnRHerxvb9H-GD', '$2y$13$siIFsVQTb.Xw.SCmxCkkeOpP/jUmewhYu8kYaxdeH5XPFHyK1FCe6', NULL, 'Rafael', 'Bento', 'Masculino', 'Portugal', 'Lisboa', '2002-08-07', 'rafael@email.pt', '912345678', '+351', 10, 1667385991, 1667392931, 'iBlapCIFv2HLg6_itfyyr-xsERf_b287_1667385991'),
(2, 'Pedro', 'JO3nV-1f2xjjEfqBrOw-EhJDGgAgFBvT', '$2y$13$t0EbTzLBtr2jKt5SteKVReIEyizI4lBopTTFJggFMjgj1odid.HpG', NULL, 'Pedro', 'Norberto', 'Masculino', 'Portugal', 'Lisboa', '2002-11-13', 'pedro@email.pt', '913412581', '+351', 10, 1667390821, 1667392906, 'fd73elasjLW11GrxlDenw2dcPfzWBA6h_1667390821'),
(3, 'Manuel', 'E3JGSTaNM8D7MbTdd7VyXWKn2nMPN6kO', '$2y$13$WYKf.WWmQEb4Hd2FpvUsGer/Lq7bTQFaVm6WerOJjNmCBMBzXn.Yy', NULL, 'Manuel', 'Henriques', 'Masculino', 'Portugal', 'Lisboa', '2002-11-08', 'pedrohenriques@gmail.pt', '998877665', '+351', 10, 1667394488, 1667394488, 'aQ1CM8RK8jZVZo27pg8KI_EZXNCFCspR_1667394488'),
(4,'Antonio', 'sOAZ_ou8A8ZImJjZ8C5R9mYrnSn3MjdR', '$2y$13$yRY3c2CeOV5472uQQQbyq.EXV3j1QZs9nZwg4ulAGMnHK/PhiKykC', NULL, 'Antonio', 'Alberto', 'Masculino', 'Portugal', 'Torres Vedras', '2002-10-30', 'antonio.alberto@live.com', '911111111', '+351', 10, 1668529982, 1668529982, 'ny7bgoj7mvW732Kv1pBHzTF7A2cu3l66_1668529982'),
(5,'Joaquim', 'SsqujPrZXyG1tLKUwF8XP0YfJWmmSh6n', '$2y$13$sq4r3qgKLBhjAuwehOnwju4f8RGh9kL04/Vzn0ntzq3KDY9kmbx1O', NULL, 'Joaquim', 'Antunes', 'Masculino', 'Portugal', 'Torres Vedras', '2022-11-13', 'joaquim.antunes@live.com', '911111111', '+351', 10, 1668530463, 1668531494, '62ZbfYy0ohnj5WoQjEYaUbNYaCnuBOi0_1668530463');


INSERT INTO `admin`(admin_id) VALUES(1);


INSERT INTO `employee_function`(id,name) VALUES
(1,"Limpeza"),
(2,"Empregado de Balcão");


INSERT INTO `employee` (`employee_id`, `tin`, `num_emp`, `ssn`, `street`, `zip_code`, `iban`, `qualifications`, `function_id`) VALUES
(2, '123321432', 'a121112', '312123412', 'Rua Principal nº6', '2530-321', 'PT50123123123123123123123', 'Curso técnico superior profissional', 1),
(3, '123456444', 'a123321', '567431987', 'Rua das Amoreiras nº3', '2530-555', 'PT50948594069485013430405', 'Ensino superior - bacharelato ou equivalente', 2);


INSERT INTO `client` (client_id) VALUES (4) , (5);