<?php
require_once './functions.php';
// require_once './data.php';
require_once './auth.php';
require_once './data-api.php';

if(!isAuthorized()){
    header('HTTP/1.0 403 Forbidden');
    exit();
}

$history_lots = [];
if (isset($_COOKIE['history'])) {
    $h_ids = json_decode($_COOKIE['history']); //id просмотренных лотов
    $history_lots = getLotsByIds($h_ids);
}
$page_content = renderTemplate('./templates/history.php', ['lots' => $history_lots]);


$title = 'История просмотров';
$categories = getCategories();

if ($mysqli_error) {
    $page_content = renderTemplate('./templates/error.php', ['error' => $mysqli_error]);
}

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
