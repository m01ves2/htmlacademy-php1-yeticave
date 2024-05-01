<?php
require_once './functions.php';
require_once './data.php';
//require_once './userdata.php';
require_once './configdb.php';

session_start();

$user_name = '';
$user_avatar = '';
$is_auth = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required_fields = ['email', 'password'];

    $err_desc = [
        'email' => 'Введите логин',
        'password' => 'Введите пароль',
    ];

    $errors = [];

    foreach ($required_fields as $field) { //проверка валидации формы
        if (empty($_POST[$field])) {
            $errors[] = $err_desc[$field] ?? 'Это поле нужно заполнить';
        }
    }

    $users = [];
    $connection = mysqli_connect($mysql_host, $mysql_login, $mysql_password, $mysql_db);
    if ($connection) {
        $sql = 'SELECT  Email as email,
                        Name as name,
                        Password as password,
                        Img as avatar,
                        Contacts as contacts
        FROM users';
        $result = mysqli_query($connection, $sql);

        if ($result) {
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
            // $page_content = renderTemplate('./templates/index.php', ['lots' => $lots]);
            $user = searchUserByEmail($form['email'], $users);

            if (!count($errors) && $user) { //ошибок нет, пользователь найден => открываем сессию

                //проверка аутентификации
                if (password_verify($form['password'], $user['password'])) { //если успешно авторизовались
                    //открытие сессии
                    $_SESSION['user'] = $user; //в сессию пишем целиком пользователя
                } else {
                    //ошибка - неверный пароль
                    $errors['password'] = 'Неверный пароль';
                }
            }
            else {
                $errors['email'] = 'Такой пользователь не найден';
            }

            if (count($errors)) { //если есть какие то ошибки
                $page_content = renderTemplate('./templates/login.php', ['user' => $form, 'errors' => $errors]);
            }
            else {
                //ошибок нет, прошли валидацию и идентификацию
                $is_auth = true;
                $user_name = $_SESSION['user']['name'];
                $user_avatar = $_SESSION['user']['avatar'];

                $page_content = renderTemplate('./templates/welcome.php', ['username' => $user_name]); //TODO приветственная страница, с ссылкой на logout
            }

        }
        else {
            $page_content = renderTemplate('./templates/error.php', [$error['mysql'] => mysqli_error($connection)]);
        }
    } else {
        $page_content = renderTemplate('./templates/error.php', [$error['mysql'] => mysqli_connect_error()]);
    }
} else { //$_SERVER['REQUEST_METHOD'] == 'GET'
    if (isAuthorized()) { //по факту, если есть в cookie поле PHPSESSID - по нему восстанавливается сессия
        $is_auth = true;
        $user_name = $_SESSION['user']['name'];
        $user_avatar = $_SESSION['user']['avatar'];

        $page_content = renderTemplate('./templates/welcome.php', ['username' => $user_name]); //TODO приветственая страница, с ссылкой на logout
    } else {
        $page_content = renderTemplate('./templates/login.php', []);
    }
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
