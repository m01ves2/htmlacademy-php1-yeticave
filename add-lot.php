<?php
require_once './vendor/autoload.php'; //libraries loader
require_once './functions.php';
// require_once './mock-data.php';
require_once './auth.php';
require_once './data-api.php';

if (!isAuthorized()) {
    header('HTTP/1.0 403 Forbidden');
    exit();
}

$categories = getCategories();

if ($mysqli_error) {
    $page_content = renderTemplate('./templates/error.php', ['error' => $mysqli_error]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $lot = $_POST;

    $required_fields = ['lot-name', 'category_id', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $err_desc = [
        'lot-name' => 'Введите наименование лота',
        'category' => 'Выберите категорию',
        'message'  => 'Напишите описание лота',
        'lot-rate' => 'Введите начальную цену',
        'lot-step' => 'Введите шаг ставки',
        'lot-date' => 'Введите дату завершения торгов',
    ];
    $errors = [];

    foreach ($required_fields as $field) {
        if (empty($lot[$field])) {
            $errors[$field] = $err_desc[$field] ?? 'Это поле нужно заполнить';
        }
    }

    //TODO Array[ [id => id1, name => name1], [id => id2, name => name2],... ]
    if ($lot['category_id'] == -1) {
        $errors['category'] = $err_desc['category'];
    }

    if (!empty($_FILES['lot-img']['tmp_name'])) {

        $tmp_name = $_FILES['lot-img']['tmp_name'];
        $path = 'uploads/' . $_FILES['lot-img']['name'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);

        if ($file_type !== 'image/jpeg') {
            $errors['file-upload'] = 'Загрузите картинку в формате jpeg';
        } else {
            move_uploaded_file($tmp_name, $path);
            $lot['img'] = $path;
        }
    }

    if (count($errors)) {
        $page_content = renderTemplate('./templates/add-lot.php', ['lot' => $lot, 'categories' => $categories, 'errors' => $errors]);
    } else {
        $newLot = [
            'name' => $lot['lot-name'],
            'category_id' => $lot['category_id'],
            'price' => $lot['lot-rate'],
            'enddate' => $lot['lot-date'],
            'step' =>  $lot['lot-step'],
            'description' => $lot['message'],
        ];
        $newLot['img'] = isset($lot['img']) ?  $lot['img'] : '';

        $id = addLot($newLot);
        if ($mysqli_error) {
            $page_content = renderTemplate('./templates/error.php', ['error' => $mysqli_error]);
        } else {
            header('Location: ./lot.php?id=' . $id);
        }
    }
} else { //$_SERVER['REQUEST_METHOD'] == 'GET'
    $page_content = renderTemplate('./templates/add-lot.php', ['categories' => $categories]);
}

$title = 'Добавить новый лот';

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
