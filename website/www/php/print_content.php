<?php
/*
 * Definisce metodi che elaborano parti di pagine
 */
class Print_content{

    public static function top($type){
        $content;
        if(!strcmp($type,"html5"))
            $content='<!DOCTYPE html>';
        else if(!strcmp($type,"xhtml+aria"))
            $content='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML + ARIA 1.0//EN""http://www.w3.org/WAI/ARIA/schemata/xhtml-aria-1.dtd">';
        else throw new Exception("Failed to load document schema");
        return $content."\r".'<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it">';   
    }

    public static function head($title){
        return str_replace("%",$title,file_get_contents("../html/components/head.html"));
    }

    public static function header($title){
        return str_replace("%",$title,file_get_contents("../html/components/header.html"));
    }

    public static function footer(){
        return file_get_contents("../html/components/footer.html");
    }

    public static function breadcrumb($page){
        return '<div id="breadcrumb" class="box a_column"><p>Ti trovi in: '.$page.'</p></div>'));
    }
} 
?>