SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES 'utf8mb4';


CREATE TABLE `user` (
  `UserID` INT(10) NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(30) NOT NULL,
  `Surname` VARCHAR(40) NOT NULL,
  `email` VARCHAR(40) NOT NULL UNIQUE,
  `Password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`Name`, `Surname`, `email`, `Password`) VALUES
('Grish', 'KC', 'bob@gmail.com', 'demo');


CREATE TABLE `employee` (
  `EmployeeID` INT(10) NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(20) NOT NULL,
  `Surname` VARCHAR(40) NOT NULL,
  `Password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`EmployeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `employee` (`Name`, `Surname`, `Password`) VALUES
('Bobby', 'KC', '12345');


CREATE TABLE `glaze` (
  `GlazeID` INT(11) NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`GlazeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `glaze` (`Name`) VALUES
('No topping'),
('White chocolate'),
('Milk chocolate'),
('Sugar topping'),
('Dark chocolate'),
('Strawberry topping'),
('Caramel topping');


CREATE TABLE `sprinkle` (
  `SprinkleID` INT(11) NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`SprinkleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `sprinkle` (`Name`) VALUES
('No sprinkles'),
('Colorful sprinkles'),
('Coconut sprinkles'),
('Powdered sugar'),
('Pink sprinkles'),
('Nut sprinkles'),
('Cinnamon sprinkles'),
('Orange sprinkles'),
('Cookie sprinkles');


CREATE TABLE `filling` (
  `FillingID` INT(11) NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`FillingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `filling` (`Name`) VALUES
('No filling'),
('Cream filling'),
('Fruit jam'),
('Strawberry jam'),
('Chocolate filling'),
('Nut filling');


CREATE TABLE `product` (
  `ProductID` INT(11) NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(40) NOT NULL,
  `Price` DECIMAL(6,2) NOT NULL,
  `AmountOnStock` INT(11) NOT NULL,
  `Glaze` INT(11),
  `Sprinkle` INT(11),
  `Filling` INT(11),
  `ImageID` VARCHAR(50),
  `Hashtag` VARCHAR(40),
  PRIMARY KEY (`ProductID`),
  FOREIGN KEY (`Glaze`) REFERENCES `glaze` (`GlazeID`) ON DELETE SET NULL,
  FOREIGN KEY (`Sprinkle`) REFERENCES `sprinkle` (`SprinkleID`) ON DELETE SET NULL,
  FOREIGN KEY (`Filling`) REFERENCES `filling` (`FillingID`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `product` (`Name`, `Price`, `AmountOnStock`, `Glaze`, `Sprinkle`, `Filling`, `ImageID`, `Hashtag`) VALUES
('Sprinkle Classic', '11.99', 20, 1, 1, 1, 'white_glazed.jpg', 'SprinkleWhiteChocolate'),
('Raspberry Sprinkle', '12.99', 15, 1, 1, 2, 'sprinkle_pink.jpg', 'RaspberrySprinkle'),
('Orange Party', '13.99', 12, 3, 2, 2, 'orangebits.jpg', 'OrangeBits'),
('Oreo Supreme', '15.99', 5, 3, 2, 2, 'oreo.jpg', 'Oreo'),
('Sugar Snow', '13.99', 8, 2, 1, 1, 'powder.jpg', 'SugarPowder'),
('Salty Carmel', '11.99', 11, 2, 2, 1, 'salted_carmel.jpg', 'SaltedCarmel'),
('Donut Classic', '9.99', 22, 1, 1, 1, 'glazed.jpg', 'Classic'),
('Merry Berry', '14.00', 17, 8, 2, 3, 'berry.JPG', 'berry'),
('Caramel Sweetness', '10.00', 14, 9, 1, 1, 'caramel.JPG', 'caramel'),
('Coconut Marvel', '13.00', 10, 2, 3, 2, 'coconut.JPG', 'coconut'),
('Classic Donut', '8.00', 14, 4, 1, 1, 'classic.JPG', 'classic'),
('Hazelnut Forest', '14.00', 5, 3, 6, 6, 'hazelnut.JPG', 'hazelnut'),
('Choco Sprinkle', '12.99', 18, 7, 2, 1, 'sprinkle.JPG', 'sprinkle'),
('Almond Heaven', '15.00', 25, 7, 6, 5, 'almond.JPG', 'almond'),
('Choco Coco', '17.00', 15, 3, 3, 2, 'coconut_chocolate.JPG', 'coconut_chocolate');


CREATE TABLE `orders` (
  `OrderID` INT(11) NOT NULL AUTO_INCREMENT,
  `OrderNumber` INT(11) NOT NULL,
  `UserID` INT(11) NOT NULL,
  `ProductID` INT(11) NOT NULL,
  `Quantity` INT(11) NOT NULL,
  `Price` DOUBLE NOT NULL,
  PRIMARY KEY (`OrderID`),
  FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE,
  FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;


ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`);

ALTER TABLE `filling`
  ADD PRIMARY KEY (`FillingID`);

ALTER TABLE `glaze`
  ADD PRIMARY KEY (`GlazeID`);

ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`);

ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

ALTER TABLE `sprinkle`
  ADD PRIMARY KEY (`SprinkleID`);


ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);


-- AUTO_INCREMENT

ALTER TABLE `employee`
  MODIFY `EmployeeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

ALTER TABLE `filling`
  MODIFY `FillingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `glaze`
  MODIFY `GlazeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

ALTER TABLE `sprinkle`
  MODIFY `SprinkleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `user`
  MODIFY `UserID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

