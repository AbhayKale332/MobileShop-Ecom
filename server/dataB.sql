CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(108) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255),
  `product_image3` varchar(255),
  `product_image4` varchar(255),
  `product_image5` varchar(255),
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(108) NOT NULL,
  `display_size` varchar(108) NOT NULL,
  `rom_size` varchar(108) NOT NULL,
  `ram_size` varchar(108) NOT NULL,
  `battery_cap` varchar(108) NOT NULL,
  `operating_system` varchar(108) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_email` varchar(108) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `order_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(108) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `UX_Constraint` (`user_email`)
) ENGINE=InnoDB CHARSET=latin1;



INSERT INTO `products`(`product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_image5`, `product_price`, `product_special_offer`, `product_color`, `display_size`, `rom_size`, `ram_size`, `battery_cap`, `operating_system`, `camera`) 
VALUES ('Iphone15','Smart-Phone','Introducing the 1Phone 15, a pinnacle of technological marvel and aesthetic sophistication. Immerse yourself in its stunning 6.7-inch Super Retina XDR display, capturing every detail with a powerful 108MP triple-lens camera system. The A15 Bionic chip ensures lightning-fast performance, while advanced security features prioritize your privacy. With all-day battery life, wireless charging, and a premium build, the 1Phone 15 combines form and function seamlessly. Step into the future of mobile innovation order yours now and experience the epitome of excellence.',
'assets/img/iphone1','assets/img/iphone2','assets/img/iphone3','assets/img/iphone4','assets/img/iphone5','70,999','','','15.49 cm (6.1 inch) Super Retina XDR Display','126GB','6GB','3,349mAh','iOS17','48MP + 12MP | 12MP Front Camera')


INSERT INTO `products`(`product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_image5`, `product_price`, `product_special_offer`, `product_color`, `display_size`, `rom_size`, `ram_size`, `battery_cap`, `operating_system`, `camera`) 
VALUES ('Iphone15 Pro','Smart-Phone','Introducing the 1Phone 15 Pro, a pinnacle of technological marvel and aesthetic sophistication. Immerse yourself in its stunning 6.7-inch Super Retina XDR display, capturing every detail with a powerful 108MP triple-lens camera system. The A15 Bionic chip ensures lightning-fast performance, while advanced security features prioritize your privacy. With all-day battery life, wireless charging, and a premium build, the 1Phone 15 combines form and function seamlessly. Step into the future of mobile innovation order yours now and experience the epitome of excellence.',
'assets/img/iphonepro1','assets/img/iphonepro2','assets/img/iphonepro3','assets/img/iphonepro4','assets/img/iphonepro5','158990','','','15.49 cm (6.1 inch) Super Retina XDR Display','512GB','8GB','3,800mAh','iOS17','48MP + 12MP + 12MP | 12MP Front Camera')


INSERT INTO `products`(`product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_image5`, `product_price`, `product_special_offer`, `product_color`, `display_size`, `rom_size`, `ram_size`, `battery_cap`, `operating_system`, `camera`) 
VALUES ('Samsung S22 5G','Smart-Phone','Introducing the Samsung S22 5g, a pinnacle of technological marvel and aesthetic sophistication. Immerse yourself in its stunning 6.7-inch Super Retina XDR display, capturing every detail with a powerful 108MP triple-lens camera system. The A15 Bionic chip ensures lightning-fast performance, while advanced security features prioritize your privacy. With all-day battery life, wireless charging, and a premium build, the 1Phone 15 combines form and function seamlessly. Step into the future of mobile innovation order yours now and experience the epitome of excellence.',
'assets/img/sams221','assets/img/sams222','assets/img/sams223','assets/img/sams224','assets/img/sams225','39900','','','15.49 cm (6.1 inch) Full HD+ Display','256GB','8GB','3,700mAh','Android 12','50MP + 12MP + 10MP | 10MP Front Camera')


INSERT INTO `products`(`product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_image5`, `product_price`, `product_special_offer`, `product_color`, `display_size`, `rom_size`, `ram_size`, `battery_cap`, `operating_system`, `camera`) 
VALUES ('OnePlus 12R','Smart-Phone','Introducing the OnePlus 12R, a pinnacle of technological marvel and aesthetic sophistication. Immerse yourself in its stunning 6.7-inch Super Retina XDR display, capturing every detail with a powerful 108MP triple-lens camera system. The A15 Bionic chip ensures lightning-fast performance, while advanced security features prioritize your privacy. With all-day battery life, wireless charging, and a premium build, the 1Phone 15 combines form and function seamlessly. Step into the future of mobile innovation order yours now and experience the epitome of excellence.',
'assets/img/op12r1','assets/img/op12r2','assets/img/op12r3','assets/img/op12r4','assets/img/op12r5','45794','','','17.22 cm (6.78 inch) Display','256GB','16GB','5,500mAh','Android 14','50 MP + 8 MP + 2 MP Triple Rear | 16 MP Front Camera')