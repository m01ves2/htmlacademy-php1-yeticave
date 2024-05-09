<?php
require_once './vendor/autoload.php'; //libraries loader
require_once './functions.php';
// require_once './mock-data.php';
// require_once './nock-userdata.php';s
require_once './data-api.php';

session_start();

$user_name = '';
$user_avatar = '';
$is_auth = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required_fields = ['email', 'password', 'name', 'contacts'];

    $err_desc = [
        'email' => 'Введите e-mail',
        'password' => 'Введите пароль',
        'name' => 'Введите имя',
        'contacts' => 'Введите контанктные данные'
    ];

    $errors = [];

    foreach ($required_fields as $field) { //проверка валидации формы
        if (empty($_POST[$field])) {
            $errors[] = $err_desc[$field] ?? 'Это поле нужно заполнить';
        }
    }

    $users = getUsers();
    if ($mysqli_error) {
        $page_content = renderTemplate('./templates/error.php', ['error' => $mysqli_error]);
    } else {

        $user = searchUserByEmail($form['email'], $users);
        if ($user) {
            $errors['email_occupied'] = 'Пользователь с таким email уже существует.';
        }

        $password = $form['password'];

        $min_password_length = 5;
        if (strlen($password) <= $min_password_length) {
            $errors['short_password'] = 'Слишком короткий пароль. Попробуйте выбрать другой( минимально ' . $min_password_length . ' символов)';
        }
        //TODO проверка пароля, соответствие шаблону

        // загрузка аватара, сохранение в uploads
        if (!empty($_FILES['avatar']['tmp_name'])) {

            $tmp_name = $_FILES['avatar']['tmp_name'];
            $path = 'uploads/' . $_FILES['avatar']['name'];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($finfo, $tmp_name);

            if ($file_type !== 'image/jpeg') {
                $errors['file-upload'] = 'Загрузите аватар в формате jpeg';
            } else {
                move_uploaded_file($tmp_name, $path);
                $form['avatar'] = $path;
            }
        }

        if (count($errors)) { //если есть какие то ошибки
            $page_content = renderTemplate('./templates/sign-up.php', ['user' => $form, 'errors' => $errors]);
        } else {

            //создаём пользователя
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $newUser = [
                'email' => $form['email'],
                'name' => $form['name'],
                'password' => $passwordHash,
                'avatar' => 'img/user.jpg', //TODO
                'contacts' =>  $form['contacts']
            ];

            $id = addUser($newUser);

            if ($mysqli_error) {
                $page_content = renderTemplate('./templates/error.php', ['error' => mysqli_connect_error()]);
            } else {
                //авторизуемся
                $_SESSION['user'] = $form;
                $_SESSION['user']['id'] = $id;

                $is_auth = true;
                $user_name = $_SESSION['user']['name'];
                $user_avatar = $_SESSION['user']['avatar'];

                $page_content = renderTemplate('./templates/welcome.php', ['username' => $user_name]); //TODO приветственная страница, с ссылкой на logout
            }
        }
    }
} else { //$_SERVER['REQUEST_METHOD'] == 'GET'
    if (isAuthorized()) {
        header('Location: ./logout.php');
        exit();
    } else {
        $page_content = renderTemplate('./templates/sign-up.php', []);
    }
}

$categories = getCategories();
if ($mysqli_error) {
    $page_content = renderTemplate('./templates/error.php', ['error' => $mysqli_error]);
}

$title = 'Регистрация';

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
