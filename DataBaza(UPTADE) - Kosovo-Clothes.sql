USE kosovo_clothing;

-- Create `admin_access` table
CREATE TABLE `admin_access` (
  `ID_Admin` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`ID_Admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert data into `admin_access`
INSERT INTO `admin_access` (`ID_Admin`, `Email`, `Password`) VALUES
(1, 'leoni@gmail.com', 'Leoni123'),
(2, 'bleroni@gmail.com', 'Bleroni123')



-- Create `users` table
CREATE TABLE IF NOT EXISTS `users` (
    `ID_Klientit` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `Emri` VARCHAR(100) NOT NULL,
    `Mbiemri` VARCHAR(100) NOT NULL,
    `Gjinia` ENUM('male', 'female', 'other') NOT NULL,
    `Numri` VARCHAR(20) NOT NULL,
    `Email` VARCHAR(255) NOT NULL UNIQUE,
    `Password` VARCHAR(255) NOT NULL,
    `Data_Regjistrimit` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Create `porosite` table
CREATE TABLE IF NOT EXISTS `porosite` (
  `ID_Porosise` int(11) NOT NULL AUTO_INCREMENT,
  `Klient_ID` int(11) NOT NULL,
  `Data_Porosise` date NOT NULL DEFAULT current_timestamp(),
  `Statusi` ENUM('Në Proces', 'Dërguar', 'Përfunduar') NOT NULL DEFAULT 'Në Proces',
  PRIMARY KEY (`ID_Porosise`),
  FOREIGN KEY (`Klient_ID`) REFERENCES `users`(`ID_Klientit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create `produktet` table
CREATE TABLE IF NOT EXISTS `produktet` (
  `ID_Produktit` int(11) NOT NULL AUTO_INCREMENT,
  `Emri_Produktit` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Qmimi` decimal(10,2) DEFAULT NULL,
  `Stok` int(11) NOT NULL,
  `Imazhi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`ID_Produktit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create `detajet_porosise` table
CREATE TABLE IF NOT EXISTS `detajet_porosise` (
  `ID_DetajeveP` int(11) NOT NULL AUTO_INCREMENT,
  `Porosia_ID` int(11) NOT NULL,
  `Produkti_ID` int(11) NOT NULL,
  `Sasia` int(11) NOT NULL,
  `Cmimi` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_DetajeveP`),
  FOREIGN KEY (`Porosia_ID`) REFERENCES `porosite`(`ID_Porosise`) ON DELETE CASCADE,
  FOREIGN KEY (`Produkti_ID`) REFERENCES `produktet`(`ID_Produktit`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Commit the changes
COMMIT;


