<?php
    require_once './functions.php';
    require_once './data.php';
    require_once './auth.php';
    require_once './configdb.php';

    $connection = mysqli_connect($mysql_host, $mysql_login, $mysql_password, $mysql_db);
    if($connection){
        $sql = 'SELECT  Lots.name as name,
                        Categories.Name AS category,
                        Lots.Price as price,
                        Lots.Step as step,
                        Lots.Img as img,
                        Lots.Enddate as enddate,
                        Lots.Description as description
                FROM Lots
                JOIN Categories
                ON Lots.CategoryId = Categories.id
                -- WHERE Lots.Enddate > CURDATE()
                ORDER BY Lots.Startdate DESC';
        $result = mysqli_query($connection, $sql);

        if($result){
            $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $page_content = renderTemplate('./templates/index.php', ['lots' => $lots]);
        }
        else{
            $page_content = renderTemplate('./templates/error.php', [ $error['mysql'] => mysqli_error($connection)] );
        }
    }
    else{
        $page_content = renderTemplate('./templates/error.php', [ $error['mysql'] => mysqli_connect_error()] );
    }

    $layout_content = renderTemplate('./templates/layout.php',
        [
            'categories' => $categories,
            'title' => $title,
            'content' => $page_content,
            'is_auth' => $is_auth,
            'user_name' => $user_name,
            'user_avatar' => $user_avatar
        ]);
    print($layout_content);
?>
