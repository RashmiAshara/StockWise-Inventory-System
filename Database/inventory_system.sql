
CREATE TABLE `categories` (
  `cat_id` int(11) UNSIGNED NOT NULL,
  `cat_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `products` (
  `pro_id` int(11) UNSIGNED NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_file` varchar(100) DEFAULT '0',
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `sales` (
  `sales_id` int(11) UNSIGNED NOT NULL,
  `stock_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `stocks` (
  `s_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `batch_no` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buy_price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `s_alert` int(11) NOT NULL,
  `add_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `name`, `username`, `password`, `status`, `last_login`) VALUES
(1, 'Admin', 'Admin', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2023-03-05 06:29:21');

ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`);

ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

ALTER TABLE `stocks`
  ADD PRIMARY KEY (`s_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categories`
  MODIFY `cat_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `products`
  MODIFY `pro_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `sales`
  MODIFY `sales_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `stocks`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
