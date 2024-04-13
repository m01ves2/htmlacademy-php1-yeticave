<?php
    require_once './functions.php';

    $lots = [
        [
            "title" => "2014 Rossigol District Snowboard",
            "cathegory" => "Доски и лыжи",
            "price" => 10999,
            "url" => "img/lot-1.jpg",
        ],
        [
            "title" => "DC Ply 2016/2017 Snowboard",
            "cathegory" => "Доски и лыжи",
            "price" => 159999,
            "url" => "img/lot-2.jpg",
        ],
        [
            "title" => "Крепления Union Contact Pro 2015 года, размер L/XL",
            "cathegory" => "Крепления",
            "price" => 8000,
            "url" => "img/lot-3.jpg",
        ],
        [
            "title" => "Ботинки для сноуборда",
            "cathegory" => "Ботинки",
            "price" => 10999,
            "url" => "img/lot-4.jpg",
        ],
        [
            "title" => "Куртка для сноуборда",
            "cathegory" => "Одежда",
            "price" => 7500,
            "url" => "img/lot-5.jpg",
        ],
        [
            "title" => "Маска Oakley Canopy",
            "cathegory" => "Разное",
            "price" => 5400,
            "url" => "img/lot-6.jpg",
        ],
    ];

    $cathegories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
    $title = 'Главная';
    $user_name = 'Константин';
    $user_avatar = 'img/user.jpg';

    $page_content = renderTemplate('./templates/index.php', ['lots' => $lots]);

    $layout_content = renderTemplate('./templates/layout.php',
        [
            'cathegories' => $cathegories,
            'title' => $title,
            'content' => $page_content,
            'user_name' => $user_name,
            'user_avatar' => $user_avatar
        ]);

    print($layout_content);
?>
