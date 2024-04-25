<?php
require_once './functions.php';
require_once './data.php';
require_once './auth.php';

$history_lots = [];

if(isset($_COOKIE['history'])){
    $h_ids = json_decode($_COOKIE['history']);
    foreach( $h_ids as $h_id ){
        if( isset($lots[$h_id]) ){
            $history_lots[] = $lots[$h_id]; //добавляем в историю лотов лот из истории
        }
    }
}

$page_content = renderTemplate('./templates/history.php', ['lots' => $history_lots]);

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
