<?php
require_once './vendor/autoload.php'; //libraries loader
require_once './functions.php';
// require_once './data.php';
require_once './auth.php';
require_once './data-api.php';

if (!isAuthorized()) {
    header('HTTP/1.0 403 Forbidden');
    exit();
}

$history_lots = [];
if (isset($_COOKIE['history'])) {
    $h_ids = json_decode($_COOKIE['history']); //id просмотренных лотов

    $currentPage = $_GET['page'] ?? 1;
    $pageItems = 3;
    $itemsCount = getLotsByIdsCount($h_ids);

    $pagesCount = ceil($itemsCount / $pageItems);
    $offset = ($currentPage - 1) * $pageItems;
    $pages = range(1, $pagesCount); //page numbers 1,2,.., pagesCount

    $history_lots = getLotsByIdsLimited($h_ids, $pageItems, $offset);
}
$page_content = renderTemplate('./templates/history.php', ['lots' => $history_lots, 'pages' => $pages, 'current_page' => $currentPage]);


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
