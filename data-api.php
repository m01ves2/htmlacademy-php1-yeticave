<?php
require_once './configdb.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT ); //- Throw mysqli_sql_exception for errors instead of warnings

$mysqli_error = null;

try {
    $connection = mysqli_connect($mysql_host, $mysql_login, $mysql_password, $mysql_db);
} catch (Exception $e) {
    $mysqli_error = mysqli_connect_error();
}


function getLots(){
    global $connection, $mysqli_error;

    if (!$connection) {
        return;
    }

    try {
        $sql = "SELECT  Lots.Id as id,
                        Lots.Name as name,
                        Categories.Name AS category,
                        Lots.Price as price,
                        Lots.Step as step,
                        Lots.Img as img,
                        Lots.Enddate as enddate,
                        Lots.Description as description
                FROM Lots
                JOIN Categories
                ON Lots.CategoryId = Categories.id
                ORDER BY Lots.Startdate DESC";

        $result = mysqli_query($connection, $sql);
        $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $lots;
    } catch (Exception $e) {
        $mysqli_error = mysqli_error($connection);
    }
}

function getLotById($id){
    global $connection, $mysqli_error;

    if (!$connection) {
        return;
    }

    try {
        $sql = "SELECT  Lots.Id as id,
                        Lots.Name as name,
                        Categories.Name AS category,
                        Lots.Price as price,
                        Lots.Step as step,
                        Lots.Img as img,
                        Lots.Enddate as enddate,
                        Lots.Description as description
                FROM Lots
                JOIN Categories
                ON Lots.CategoryId = Categories.id
                WHERE Lots.Id = $id";

        $result = mysqli_query($connection, $sql);
        $lot = mysqli_fetch_assoc($result);

        return $lot;
    } catch (Exception $e) {
        $mysqli_error = mysqli_error($connection);
    }
}

function getLotsByIds($ids){
    global $connection, $mysqli_error;

    if (!$connection) {
        return;
    }

    try {
        $sql = "SELECT  Lots.Id as id,
                        Lots.Name as name,
                        Categories.Name AS category,
                        Lots.Price as price,
                        Lots.Step as step,
                        Lots.Img as img,
                        Lots.Enddate as enddate,
                        Lots.Description as description
                FROM Lots
                JOIN Categories
                ON Lots.CategoryId = Categories.id
                WHERE Lots.Id IN (" . implode(',', $ids) . ")";

        $result = mysqli_query($connection, $sql);
        $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $lots;
    } catch (Exception $e) {
        $mysqli_error = mysqli_error($connection);
    }
}

function getBetsByLotId($lotId){ //TODO
    global $connection, $mysqli_error;

    if (!$connection) {
        return;
    }

    try {
        $sql = "SELECT  Bets.Id as id,
                        Bets.Date as date,
                        Bets.Price as price,
                        Bets.userId as user,
                        Users.Name as name
                FROM Bets
                JOIN Users
                ON Bets.UserId = Users.Id
                WHERE LotId = '$lotId'
                ORDER BY Date DESC";

        $result = mysqli_query($connection, $sql);
        $bets = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $bets;
    } catch (Exception $e) {
        $mysqli_error = mysqli_error($connection);
    }
}



function getCategories(){
    global $connection, $mysqli_error;

    if (!$connection) {
        return;
    }

    try {

        $sql = 'SELECT Id as id, Name as name
                FROM Categories
                ORDER BY Id';

        $result = mysqli_query($connection, $sql);
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $categories;
    } catch (Exception $e) {
        $mysqli_error = mysqli_error($connection);
    }
}

function getUsers(){
    global $connection, $mysqli_error;

    if (!$connection) {
        return;
    }

    try {

        $sql = "SELECT  Id as id,
                        Email as email,
                        Name as name,
                        Password as password,
                        Img as avatar,
                        Contacts as contacts
                FROM users";

        $result = mysqli_query($connection, $sql);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $users;

    }
    catch (Exception $e) {
        $mysqli_error = mysqli_error($connection);
    }
}

function addUser($newUser){
    global $connection, $mysqli_error;

    if (!$connection) {
        return;
    }

    try {
        $email = $newUser['email'];
        $name = $newUser['name'];
        $passwordHash = $newUser['password'];
        $avatar = $newUser['avatar'];
        $contacts = $newUser['contacts'];

        $sql = "INSERT Users(Email, Name, Password, Img, Date, Contacts)
                VALUES ('$email', '$name', '$passwordHash', '$avatar', NOW(), '$contacts');";


        $result = mysqli_query($connection, $sql);

        return $id = mysqli_insert_id($connection);

    }
    catch (Exception $e) {
        $mysqli_error = mysqli_error($connection);
    }
}

function addLot($newLot){
    global $connection, $mysqli_error;

    if (!$connection) {
        return;
    }

    try {
        $name = $newLot['name'];
        $price = $newLot['price'];
        $step = $newLot['step'];
        $img = $newLot['img'];
        $endDate = $newLot['enddate'];
        $description = $newLot['description'];
        $favorites = 0;

        $ownerId = 1; //TODO
        $categoryId = $newLot['category_id'];; //TODO
        $winnerId = 2; //TODO

        $sql = "INSERT Lots (Startdate, Name, CategoryId, Price, Step, Img, Enddate, Description, Favorites, OwnerId, WinnerId)
                VALUES ( NOW(), '$name', $categoryId, $price, $step, '$img', '$endDate', '$description', $favorites, $ownerId, $winnerId );";

        $result = mysqli_query($connection, $sql);

        return $id = mysqli_insert_id($connection);

    } catch (Exception $e) {
        $mysqli_error = mysqli_error($connection);
    }
}

function getLotsByKeyWords($keywords){
    global $connection, $mysqli_error;

    if (!$connection) {
        return;
    }

    try {
        $sql = "SELECT  Lots.Id as id,
                        Lots.Name as name,
                        Categories.Name AS category,
                        Lots.Price as price,
                        Lots.Step as step,
                        Lots.Img as img,
                        Lots.Enddate as enddate,
                        Lots.Description as description
                FROM Lots
                JOIN Categories
                ON Lots.CategoryId = Categories.id
                WHERE MATCH(Lots.Name, Lots.Description) AGAINST('$keywords')
                ORDER BY Lots.Startdate DESC";

        $result = mysqli_query($connection, $sql);
        $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $lots;
    } catch (Exception $e) {
        $mysqli_error = mysqli_error($connection);
    }
}
