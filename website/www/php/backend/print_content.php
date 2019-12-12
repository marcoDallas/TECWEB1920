<?php
/*
 * Definisce metodi che elaborano parti di pagine
 */
require_once('sessions.php');
class Print_content{

    public static function top($type){
        if(!strcmp($type,"html5"))
            return '<!DOCTYPE html>';
        else if(!strcmp($type,"xhtml+aria"))
            return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML + ARIA 1.0//EN""http://www.w3.org/WAI/ARIA/schemata/xhtml-aria-1.dtd">';
        else throw new Exception("Failed to load document schema");
    }

    public static function openHTML(){
        return '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it">';
    }

    public static function head(){
        return include_once "components/head.php";
    }

    public static function openBody(){
        return '<body>';
    }

    public static function header($title,$page){
        $content='<div id="header" class="box full_column">
                     <div class="logo_column">';
        if(!strcmp($page,"home.php"))
        $content=$content.'<img id="logo" src="../images/logo.png" alt="Ti trovi nella pagina principale di Pasticceria Padovana"/>';
        else
        $content=$content.'<a href="home.php" title="Torna alla pagina principale"><img id="logo" src="../images/logo.png" alt="Torna alla pagina principale di Pasticceria Padovana"/></a>';
        return $content.'</div>
                            <div class="title_column mobile_hidden">
                                <h1>'.$title.'</h1>
                            </div>
                        </div>';
    }

    public static function breadcrumb($page){
        return '<div id="breadcrumb" class="box full_column"><p>Ti trovi in: '.$page.'</p></div>';
    }

    public static function openGeneralContainer(){
        return '<div id="general_container" class="box full_column">';
    }

    public static function menu($page){
        $content='<div class="menu_column">'."\r".'<div id="menu" class="mobile_hidden" role="navigation">'."\r".'<ul role="tablist">
        '."\r".'<li class="hidden" role="tab"><a href="#content" tabindex="1">Vai al contenuto</a></li>';
        if(!strcmp($page,"home.php")){
            $content=$content."\r".'<li xml:lang="en" role="tab"><strong>Home</strong></li>'."\r".'
            <li role="tab" aria-setsize="5" aria-posinset="2"><a href="prodotti.php?type=Paste" tabindex="2">Paste</a></li>'."\r".'
            <li role="tab" aria-setsize="5" aria-posinset="3"><a href="prodotti.php?type=Torte" tabindex="3">Torte</a></li>'."\r".'
            <li role="tab" aria-setsize="5" aria-posinset="4"><a href="storia.php" tabindex="4">Storia</a></li>'."\r".'
            <li role="tab" aria-setsize="5" aria-posinset="5"><a href="contatti.php" tabindex="5">Contatti</a></li>';
        }else if(!strcmp($page,"storia.php")){
            $content=$content."\r".'<li role="tablist" aria-setsize="5" aria-posinset="2"><a href="home.php" xml:lang="en" tabindex="2">Home</a></li>'."\r".'
            <li role="tablist" aria-setsize="5" aria-posinset="3"><a href="prodotti.php?type=Paste" tabindex="3">Paste</a></li>'."\r".'
            <li role="tablist" aria-setsize="5" aria-posinset="4"><a href="prodotti.php?type=Torte" tabindex="4">Torte</a></li>'."\r".'
            <li><strong>Storia</strong></li>'."\r".'
            <li role="tablist" aria-setsize="5" aria-posinset="5"><a href="contatti.php" tabindex="5">Contatti</a></li>';
        }else if(!strcmp($page,"contatti.php")){
            $content=$content."\r".'<li role="tablist" aria-setsize="5" aria-posinset="2"><a href="home.php" xml:lang="en" tabindex="2">Home</a></li>'."\r".'
            <li role="tablist" aria-setsize="5" aria-posinset="3"><a href="prodotti.php?type=Paste" tabindex="3">Paste</a></li>'."\r".'
            <li role="tablist" aria-setsize="5" aria-posinset="4"><a href="prodotti.php?type=Torte" tabindex="4">Torte</a></li>'."\r".'
            <li role="tablist" aria-setsize="5" aria-posinset="5"><a href="storia.php" tabindex="5">Storia</a></li>'."\r".'
            <li><strong>Contatti</strong></li>';
        }else if(!strcmp($page,"prodotti.php?type=Paste")){
            $content=$content."\r".'<li xml:lang="en" role="tablist" aria-setsize="5" aria-posinset="2"><a href="home.php" tabindex="2">Home</a></li>'."\r".'
            <li><strong>Paste</strong></dt>'."\r".'
            <li role="tablist" aria-setsize="5" aria-posinset="3"><a href="prodotti.php?type=Torte" tabindex="3">Torte</a></li>'."\r".'
            <li role="tablist" aria-setsize="5" aria-posinset="4"><a href="storia.php" tabindex="4">Storia</a></li>'."\r".'
            <li role="tablist" aria-setsize="5" aria-posinset="5"><a href="contatti.php" tabindex="5">Contatti</a></li>';
        }else if(!strcmp($page,"prodotti.php?type=Torte")){
            $content=$content."\r".'<li role="tablist" aria-setsize="5" aria-posinset="2"><a href="home.php" xml:lang="en" tabindex="2">Home</a></li>'."\r".'
            <li role="tablist" aria-setsize="5" aria-posinset="3"><a href="prodotti.php?type=Paste" tabindex="3">Paste</a></li>'."\r".'
            <li><strong>Torte</strong></li>'."\r".'
            <li role="tablist" aria-setsize="5" aria-posinset="4"><a href="storia.php" tabindex="4">Storia</a></li>'."\r".'
            <li role="tablist" aria-setsize="5" aria-posinset="5"><a href="contatti.php" tabindex="5">Contatti</a></li>';
        }
        return $content."\r".'</ul>'."\r".'</div>'."\r".'<div id="menu_icon" onclick="toggleMenu(this)">'."\r".'<div class="bar1"></div>'."\r".'<div class="bar2"></div>'."\r".'<div class="bar3"></div>'."\r".'</div>';    
    }

    public static function news($page){
        if(!strcmp($page,"contatti.php")){
            require_once('print_news.php');
            $print = new Print_news();
            $print->print_news();
        }else{
            include_once("components/news.php");
        }
    }

    public static function closeDiv(){
        return '</div>';
    }

    public static function footer(){
        include_once("components/footer.php");
    }

    public static function adminAreaForm(){
        if(Sessions::session_exists('admin')){
            $content ='<div id="logout">
                        <form class="general_form" method="post" action="'.$_SERVER['REQUEST_URI'].'">
                            <fieldset id="fieldset_login">
                            <legend>Benvenuto amministratore!</legend>
                                <input id="submit_login_form" class="general_button" type="submit" value="Esci" name="Logout" tabindex="8" />
                            </fieldset>
                        </form>
                        </div>';
        }else{
            $content ='<div  class="box admin_column">
                <form class="general_form" method="post" action="'.$_SERVER['REQUEST_URI'].'">
                    <fieldset id="fieldset_login">
                        <legend>Area Amministratore</legend>
                        <div class="input_line">
                            <label for="username"><span xml:lang="en">Username: </span></label>
                            <input class="general_input" type="text" name="username" id="username" maxlength="20" tabindex="6" aria-required="true"/>
                        </div>
                        <div class="input_line">
                        <label for="password"><span xml:lang="en">Password: </span></label>
                        <input class="general_input" type="password" name="password" id="password" maxlength="20" tabindex="7" aria-required="true"/>
                        </div>
                        <input id="submit_login_form" class="general_button" type="submit" value="Accedi" name="Login" tabindex="8" />
                    </fieldset>
                </form>
            </div>';
        }
        return $content;
    }

    public static function closeBody(){
        return '</body>';
    }

    public static function closeHTML(){
        return '</html>';
    }

} 
?>