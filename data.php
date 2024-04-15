<?php
// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

$lots = [
    [
        "name" => "2014 Rossigol District Snowboard",
        "category" => "Доски и лыжи",
        "price" => 10999,
        "img" => "img/lot-1.jpg",
        'enddate' => '2024-04-16'
    ],
    [
        "name" => "DC Ply 2016/2017 Snowboard",
        "category" => "Доски и лыжи",
        "price" => 159999,
        "img" => "img/lot-2.jpg",
        'enddate' => '2024-04-20'
    ],
    [
        "name" => "Крепления Union Contact Pro 2015 года, размер L/XL",
        "category" => "Крепления",
        "price" => 8000,
        "img" => "img/lot-3.jpg",
        'enddate' => '2024-04-17'
    ],
    [
        "name" => "Ботинки для сноуборда",
        "category" => "Ботинки",
        "price" => 10999,
        "img" => "img/lot-4.jpg",
        'enddate' => '2024-04-27'
    ],
    [
        "name" => "Куртка для сноуборда",
        "category" => "Одежда",
        "price" => 7500,
        "img" => "img/lot-5.jpg",
        'enddate' => '2024-05-05'
    ],
    [
        "name" => "Маска Oakley Canopy",
        "category" => "Разное",
        "price" => 5400,
        "img" => "img/lot-6.jpg",
        'enddate' => '2024-01-10'
    ],
];

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
$title = 'Главная';
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

?>
