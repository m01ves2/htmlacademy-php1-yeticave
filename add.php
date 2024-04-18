<?php
    require_once './functions.php';
    require_once './data.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $lot = $_POST;

        $required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
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

        if ($lot['category'] == 'Выберите категорию') {
            $errors['category'] = $err_desc['category'];
        }

        //TODO
        if(!empty($_FILES['lot-img']['tmp_name'])){
            $tmp_name = $_FILES['lot-img']['tmp_name'];
            $path = 'uploads/'.$_FILES['lot-img']['name'];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($finfo, $tmp_name);
            if($file_type !== 'image/jpeg'){
                $errors['file-upload'] = 'Загрузите картинку в формате jpeg';
            }
            else{
                move_uploaded_file($tmp_name, $path);
                $lot['img'] = $path;
            }
        }

        if (count($errors)) {
            $page_content = renderTemplate('./templates/add-lot.php', ['lot' => $lot, 'errors' => $errors]);
        }
        else {
            $newLot = [
                "name" => $lot['lot-name'],
                "category" => $lot['category'],
                "price" => $lot['lot-rate'],
                'enddate' => $lot['lot-date'],
                'description' => $lot['message'],
            ];
            $newLot['img'] = isset($lot['img']) ?  $lot['img'] : '';

            $page_content = renderTemplate('./templates/lot.php', ['lot' => $newLot]);
        }
    }
    else { //$_SERVER['REQUEST_METHOD'] == 'GET'
        $page_content = renderTemplate('./templates/add-lot.php', []);
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

?>
