<?php
require_once './vendor/autoload.php'; //libraries loader
require_once './functions.php';
// require_once './mock-data.php';
require_once './auth.php';
require_once './data-api.php';

$lots = getLots();
$categories = getCategories();

if ($mysqli_error) {
    $page_content = renderTemplate('./templates/error.php', ['error' => $mysqli_error]);
} else {
    $page_content = renderTemplate('./templates/index.php', ['lots' => $lots]);
}

$title = 'Главная';

$layout_content = renderTemplate(
    './templates/layout.php',
    [
        'categories' => $categories,
        'title' => $title,
        'content' => $page_content,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar
    ]
);
print($layout_content);
