CREATE DATABASE IF NOT EXISTS yeticavedb;

USE yeticavedb;

CREATE TABLE Categories (
  Id INT PRIMARY KEY AUTO_INCREMENT,
  Name VARCHAR(50)
);
CREATE UNIQUE INDEX index_Categories_Name ON Categories(Name);


CREATE TABLE Users(
  id INT PRIMARY KEY AUTO_INCREMENT,
  Date DATETIME,
  Email VARCHAR(50),
  Name VARCHAR(200),
  Password VARCHAR(200),
  Img VARCHAR(200),
  Contacts TEXT
);
CREATE UNIQUE INDEX index_Users_Email ON Users(Email);


CREATE TABLE Lots(
  Id INT PRIMARY KEY AUTO_INCREMENT,
  Startdate DATETIME,
  Name VARCHAR(50),
  Price DECIMAL(10,2),
  Step DECIMAL(10,2),
  Img VARCHAR(200),
  Enddate DATETIME,
  Description TEXT,
  Favorites INT,


  CategoryId INT,
  OwnerId INT,
  WinnerId INT,

  FOREIGN KEY (CategoryId) REFERENCES Categories (Id),
  FOREIGN KEY (OwnerId) REFERENCES Users (Id),
  FOREIGN KEY (WinnerId) REFERENCES Users (Id)
);
CREATE INDEX index_Lots_Startdate ON Lots(Startdate);
CREATE INDEX index_Lots_Enddate ON Lots(Enddate);
CREATE INDEX index_Lots_Favorites ON Lots(Favorites);
CREATE INDEX index_Lots_Price ON Lots(Price);



CREATE TABLE Bets(
  Id INT PRIMARY KEY AUTO_INCREMENT,
  Date DATETIME,
  Price DECIMAL(10,2),

  UserId INT,
  LotId INT,

  FOREIGN KEY (UserId) REFERENCES Users(Id),
  FOREIGN KEY (LotId) REFERENCES Lots(Id)
);
CREATE INDEX index_Bets_Price ON Bets(Price);
CREATE INDEX index_Bets_Date ON Bets(Date);

CREATE FULLTEXT INDEX index_ft_Lots_search ON Lots(Name, Description);
-- ALTER TABLE Lots ADD FULLTEXT INDEX index_ft_Lots_search(Name, Description);

-- ALTER TABLE {your_table_name} DROP INDEX {your_index_name}
-- DROP INDEX {your_index_name} ON {your_tbl_name}
