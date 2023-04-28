
--
-- Database: `coffeeshop` and php web application user
CREATE DATABASE coffeeshop;
GRANT USAGE ON *.* TO 'appuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON coffeeshop.* TO 'appuser'@'localhost';
FLUSH PRIVILEGES;

USE coffeeshop;
--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `img_path` text NOT NULL,
  `description` VARCHAR(200) NOT NULL,
  `date` DATE NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `img_path`, `description`, `date`, `price`) VALUES
(1, 'SCARLET FINCH', 'Image1.png', 'Origin: Baoshan, Yunnan, China', '2023-01-01', 17.99),
(2, 'Tian Yu', 'Image2.png', 'A coffee that has decent fragrance, fruity sweetness, round body, balance and smooth.', '2023-02-01', 20.99),
(3, 'XIN GANG', 'Image3.png', 'Tasting Notes: Brown Sugar | Ceylon | Fermented Puer Tea', '2023-02-11', 18.99);

