<?php
session_start();

$is_auth = false;
$user_id = '';
$user_name = '';
$user_avatar = '';
$user_email = '';
$user_password = '';


if (isAuthorized()) {
    $is_auth = true;
    $user_id = $_SESSION['user']['id'];
    $user_name = $_SESSION['user']['name'];
    $user_avatar = $_SESSION['user']['avatar'];
    $user_email = $_SESSION['user']['email'];
    $user_password = $_SESSION['user']['password'];
}
