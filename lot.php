<?php
require_once './vendor/autoload.php'; //libraries loader
require_once './functions.php';
// require_once './mock-data.php';
require_once './auth.php';
require_once './data-api.php';

//TODO POST request for lot.php (make bet)

if (!isset($_GET['id'])) {
    http_response_code(404);
    $page_content = renderTemplate('./templates/error.php', ['error' => 'Ошибка 404. Страница не найдена']);
} else {
    $id = $_GET['id'];
    $lot = getLotById($id);
    $bets = getBetsByLotId($id);

    if ($mysqli_error) {
        http_response_code(404);
        $page_content = renderTemplate('./templates/error.php', ['error' => $mysqli_error]);
    } else {
        $page_content = renderTemplate('./templates/lot.php', ['id' => $id, 'lot' => $lot, 'bets' => $bets, 'is_auth' => $is_auth]);

        //добавляем просмотренный лот в историю просмотров в cookie
        $h_ids = [];
        if (isset($_COOKIE['history'])) {
            $h_ids = json_decode($_COOKIE['history']);
        }

        if (!in_array($id, $h_ids)) {
            $h_ids[] = $id; //добавляем новый $id, если его ещё не было
        }
        //$_COOKIE['history'] = json_encode($h_ids);
        $name = 'history';
        $value = json_encode($h_ids);
        $expire = time() + 7 * 24 * 60 * 60;
        $path = '/';
        setcookie($name, $value, $expire, $path);
    }
}


$title = 'Информация о лоте';
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
