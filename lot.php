<?php
require_once './functions.php';
require_once './data.php';
require_once './auth.php';


if (!isset($_GET['id']) || !isset($lots[$_GET['id']])) {
    http_response_code(404);
    $page_content = renderTemplate('./templates/error.php', ['errmsg' => 'Ошибка 404. Страница не найдена']);
}
else {
    $id = $_GET['id'];
    $page_content = renderTemplate('./templates/lot.php', ['id' => $id, 'lot' => $lots[$id], 'bets' => $bets, 'is_auth' => $is_auth]);

    //TODO
    //добавляем просмотренный лот в историю просмотров в cookie
    // $h_ids = [];
    // if(isset($_COOKIE['history'])){
    //     $h_ids = json_decode($_COOKIE['history']);
    // }

    // if( !in_array($id, $h_ids) ) {
    //     $h_ids[] = $id; //добавляем новый $id, если его ещё не было
    // }
    // $_COOKIE['history'] = json_encode($h_ids);
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
