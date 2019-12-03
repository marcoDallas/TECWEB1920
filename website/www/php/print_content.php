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

    public static function breadcrumb($page){
        return '<div id="breadcrumb" class="box a_column"><p>Ti trovi in: '.$page.'</p></div>';
    }

    public static function menu($page){
        $content='<div id="menu_container" class="thin_column">'."\r".'<div id="menu" class="mobile_hidden" role="navigation">'."\r".'<dl>
        '."\r".'<dt class="hidden" role="tablist" aria-setsize="5" aria-posinset="1"><a href="#content" tabindex="1">Vai al contenuto</a></dt>';
        if(!strcmp($page,"home.php")){
            $content=$content."\r".'<dt xml:lang="en"><strong>Home</strong></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="2"><a href="prodotti.php?type=paste" tabindex="2">Paste</a></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="3"><a href="prodotti.php?type=torte" tabindex="3">Torte</a></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="4"><a href="storia.php" tabindex="4">Storia</a></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="5"><a href="contatti.php" tabindex="5">Contatti</a></dt>';
        }else if(!strcmp($page,"storia.php")){
            $content=$content."\r".'<dt role="tablist" aria-setsize="5" aria-posinset="2"><a href="home.php" xml:lang="en" tabindex="2">Home</a></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="3"><a href="prodotti.php?type=paste" tabindex="2">Paste</a></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="4"><a href="prodotti.php?type=torte" tabindex="3">Torte</a></dt>'."\r".'
            <dt><strong>Storia</strong></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="5"><a href="contatti.php" tabindex="5">Contatti</a></dt>';
        }else if(!strcmp($page,"contatti.php")){
            $content=$content."\r".'<dt role="tablist" aria-setsize="5" aria-posinset="2"><a href="home.php" xml:lang="en" tabindex="2">Home</a></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="3"><a href="prodotti.php?type=paste" tabindex="3">Paste</a></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="4"><a href="prodotti.php?type=torte" tabindex="4">Torte</a></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="5"><a href="storia.php" tabindex="5">Storia</a></dt>'."\r".'
            <dt><strong>Contatti</strong></dt>';
        }else if(!strcmp($page,"prodotti.php?type=paste")){
            $content=$content."\r".'<dt xml:lang="en" role="tablist" aria-setsize="5" aria-posinset="2"><a href="home.php" tabindex="2">Home</a></dt>'."\r".'
            <dt><strong>Paste</strong></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="3"><a href="prodotti.php?type=torte" tabindex="3">Torte</a></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="4"><a href="storia.php" tabindex="4">Storia</a></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="5"><a href="contatti.php" tabindex="5">Contatti</a></dt>';
        }else if(!strcmp($page,"prodotti.php?type=torte")){
            $content=$content."\r".'<dt role="tablist" aria-setsize="5" aria-posinset="2"><a href="home.php" xml:lang="en" tabindex="2">Home</a></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="3"><a href="prodotti.php?type=paste" tabindex="3">Paste</a></dt>'."\r".'
            <dt><strong>Torte</strong></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="4"><a href="storia.php" tabindex="4">Storia</a></dt>'."\r".'
            <dt role="tablist" aria-setsize="5" aria-posinset="5"><a href="contatti.php" tabindex="5">Contatti</a></dt>';
        }
        $content=$content."\r".'</dl>'."\r".'</div>'."\r".'<div id="menu_icon" onclick="toggleMenu(this)">'."\r".'<div class="bar1"></div>'."\r".'
        <div class="bar2"></div>'."\r".'<div class="bar3"></div>'."\r".'</div>'."\r".'</div>';
        return $content;
    }

    public static function login_form(){
        return file_get_contents("../html/components/login_form.html");
    }

    public static function footer(){
        return file_get_contents("../html/components/footer.html");
    }


} 
?>