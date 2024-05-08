<?php
    // require_once './data.php';
    require_once './functions.php';

    session_start();

    if(isAuthorized()){ //по факту, если есть в cookie поле PHPSESSID - по нему восстанавливается сессия
        $is_auth = false;
        $user_name = '';
        $user_avatar = '';
        $user_email = '';
        $user_password = '';

        $_SESSION = [];
    }

    header('Location: ./index.php');
?>
