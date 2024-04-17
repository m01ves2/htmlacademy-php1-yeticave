<?php
// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) . ' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) . ' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) . ' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

$lots = [
    [
        "name" => "2014 Rossigol District Snowboard",
        "category" => "Доски и лыжи",
        "price" => 10999,
        "img" => "img/lot-1.jpg",
        'enddate' => '2024-04-16',
        'description' => 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчком и четкими дугами.
        Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия
        в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
        просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.'
    ],
    [
        "name" => "DC Ply 2016/2017 Snowboard",
        "category" => "Доски и лыжи",
        "price" => 159999,
        "img" => "img/lot-2.jpg",
        'enddate' => '2024-04-20',
        'description' => 'судя по ценнику, из золота сделана'
    ],
    [
        "name" => "Крепления Union Contact Pro 2015 года, размер L/XL",
        "category" => "Крепления",
        "price" => 8000,
        "img" => "img/lot-3.jpg",
        'enddate' => '2024-04-17',
        'description' => 'просто крепления, чтобы доска от ног не отваливалась'
    ],
    [
        "name" => "Ботинки для сноуборда",
        "category" => "Ботинки",
        "price" => 10999,
        "img" => "img/lot-4.jpg",
        'enddate' => '2024-04-27',
        'description' => 'обычные ботинки, можно ходить в магазин'
    ],
    [
        "name" => "Куртка для сноуборда",
        "category" => "Одежда",
        "price" => 7500,
        "img" => "img/lot-5.jpg",
        'enddate' => '2024-05-05',
        'description' => 'Немного ношенная, с дыркой'
    ],
    [
        "name" => "Маска Oakley Canopy",
        "category" => "Разное",
        "price" => 5400,
        "img" => "img/lot-6.jpg",
        'enddate' => '2024-01-10',
        'description' => 'с такой можно и банк грабить, и на Эверест залезть'
    ],
];

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
$title = 'Главная';
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';
