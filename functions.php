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

?>
