<?php
require_once './functions.php';
require_once './data.php';

if (!isset($_GET['id']) || !isset($lots[$_GET['id']])) {
    $page_content = renderTemplate('./templates/error.php', ['errmsg' => 'Ошибка 404. Страница не найдена']);
}
else {
    $id = $_GET['id'];
    $page_content = renderTemplate('./templates/lot.php', ['id' => $id, 'lot' => $lots[$id]]);
}

$layout_content = renderTemplate(
    './templates/layout.php',
    [
        'categories' => $categories,
        'title' => $title,
        'content' => $page_content,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar
    ]
);

print($layout_content);
