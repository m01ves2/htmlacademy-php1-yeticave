CREATE DATABASE IF NOT EXISTS yeticavedb;

USE yeticavedb;

CREATE TABLE Categories (
  Id INT PRIMARY KEY AUTO_INCREMENT,
  Name VARCHAR(50)
);
CREATE UNIQUE INDEX index_Categories_Name ON Categories(Name);

INSERT Categories(Name)
VALUES
("Доски и лыжи"),
("Крепления"),
("Ботинки"),
("Одежда"),
("Инструменты"),
("Разное");



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

INSERT Users(Email, Name, Password, Img, Date, Contacts)
VALUES
('ignat.v@gmail.com', 'Игнат', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', 'img/user.jpg', '2024-01-01 10:20:50', 'Москва, Краснопутиловская, 102. тел. 198-94-21'),
('kitty_93@li.ru', 'Леночка', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', 'img/user.jpg', '2023-09-02 18:02:05', 'Москва, Измайловская, 155. тел. 728-09-11'),
('warrior07@mail.ru', 'Руслан', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', 'img/user.jpg', '2021-06-11 011:21:10', 'Санкт-Петербург, Ленинский пр. 12. тел. 391-24-15');



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

INSERT Lots(Startdate, Name, CategoryId, Price, Step, Img, Enddate, Description, Favorites, OwnerId, WinnerId)
VALUES
('2024-04-01 08:14:50', "2014 Rossigol District Snowboard", 1, 10999, 1000, "img/lot-1.jpg", '2024-04-16 00:00:00', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчком и четкими дугами.
        Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия
        в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
        просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', 2, 2, NULL),
('2024-04-01 13:14:50', "DC Ply 2016/2017 Snowboard", 1, 159999, 5000, "img/lot-2.jpg", '2024-04-20 00:00:00', 'судя по ценнику, из золота сделана', 4, 1, NULL),
('2024-02-25 18:11:21', "Крепления Union Contact Pro 2015 года, размер L/XL", 2, 8000, 1000, "img/lot-3.jpg", '2024-06-21 00:00:00', 'просто крепления, чтобы доска от ног не отваливалась', 1, 2, NULL),
('2024-04-25 01:20:20', "Ботинки для сноуборда", 3, 10999, 500, "img/lot-4.jpg", '2024-04-27', 'обычные ботинки, можно ходить в магазин', 10, 1, NULL),
('2024-04-01 14:31:00', "Куртка для сноуборда", 4, 7500, 1000, "img/lot-5.jpg", '2024-05-05', 'Немного ношенная, с дыркой', 8, 1, NULL),
('2024-01-09 19:16:02', "Маска Oakley Canopy", 6, 5400, 400,  "img/lot-6.jpg", '2024-01-10', 'с такой можно и банк грабить, и на Эверест залезть', 11, 3, NULL);



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

INSERT Bets( UserId, Price, Date, LotId)
VALUES
(1, 11500, '2024-04-01 010:14:50', 1),
(2, 162000, '2024-04-02 011:14:50', 2),
(1, 8500, '2024-04-06 014:51:19', 3),
(3, 12500, '2024-04-03 010:15:50', 4),
(2, 13000, '2024-04-016 010:15:50', 4),
(3, 160000, '2024-04-01 010:15:50', 2);
