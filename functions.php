<?php
    function renderTemplate($templateFile, $args){
        $content = '';
        if(!file_exists($templateFile)){
            return $content;
        }

        foreach( $args as $key => $value ){
            ${$key} = $value;
        }

        ob_start(); //включили буферизациюю вывода print
        print( require_once($templateFile) );
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

?>
