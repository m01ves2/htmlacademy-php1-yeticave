<?php
    require_once './configdb.php';

    function renderTemplate($templateFile, $args){
        $content = '';
        if(!file_exists($templateFile)){
            print_r('TEMPLATE FILE NOT FOUND');
            return $content;
        }

        foreach( $args as $key => $value ){
            ${$key} = $value;
        }
        //extract($args);

        ob_start(); //включили буферизациюю вывода print
        $content = require($templateFile);
        $content = ob_get_clean(); //записали содержимое файла

        return $content;
    }

    function formatPrice($price){
        $price = ceil($price);
        if($price > 1000){
            $price = number_format($price, 0, ",", " ");
        }
        $price = $price."<b class=\"rub\">р</b>";
        return $price;
    }
    // function formatPrice2($price){
    //     $price = ceil($price);
    //     $price_str = $price."";
    //     if($price > 1000){
    //         $thousads = substr($price_str, 0, strlen($price_str) - 3 );
    //         $rest = substr($price_str, strlen($price_str) - 3);
    //         $price_str = $thousads." ".$rest;
    //     }
    //     return $price_str;
    // }

    function getLotTimeLeft($time)
    {
        date_default_timezone_set('Europe/Moscow');
        $tcNow = time();
        $tcEnd = strtotime($time);
        $secLeft = $tcEnd - $tcNow;

        $hours = floor($secLeft / 3600);
        $minutes = floor(($secLeft % 3600) / 60);

        return [$hours, $minutes];
    }

    function searchUserByEmail($email, $users){
        $result = null;
        foreach($users as $user){
            if($user['email'] == $email){
                $result = $user;
                break;
            }
        }
        return $result;
    }

    function isAuthorized(){
        return isset($_SESSION['user']);
    }
?>
