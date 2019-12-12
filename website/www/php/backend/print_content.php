<?php
/*
 * Definisce metodi che elaborano parti di pagine
 */
class Print_content{

    public static function logo($page){
        if(!strcmp($page,"Home"))
        $content='<img id="logo" src="../images/logo.png" alt="Ti trovi nella pagina principale di Pasticceria Padovana"/>';
        else
        $content='<a href="home.php" title="Torna alla pagina principale">
                    <img id="logo" src="../images/logo.png" alt="Torna alla pagina principale di Pasticceria Padovana"/>
                  </a>';
        return $content;
    }

    public static function menu($page){
        if(!strcmp($page,"home.php")){
            $content='<li xml:lang="en" role="menuitem"><strong>Home</strong></li>
            <li role="none"><a href="prodotti.php?type=Paste" role="menuitem">Paste</a></li>
            <li role="none"><a href="prodotti.php?type=Torte" role="menuitem">Torte</a></li>
            <li role="none"><a href="storia.php" role="menuitem">Storia</a></li>
            <li role="none"><a href="contatti.php" role="menuitem">Contatti</a></li>';
        }else if(!strcmp($page,"storia.php")){
            $content='<li xml:lang="en"><a href="home.php" xml:lang="en" role="menuitem">Home</a></li>
            <li role="none"><a href="prodotti.php?type=Paste" role="menuitem">Paste</a></li>
            <li role="none"><a href="prodotti.php?type=Torte" role="menuitem">Torte</a></li>
            <li role="menuitem"><strong>Storia</strong></li>
            <li role="none"><a href="contatti.php" role="menuitem">Contatti</a></li>';
        }else if(!strcmp($page,"contatti.php")){
            $content='<li xml:lang="en"><a href="home.php" xml:lang="en" role="menuitem">Home</a></li>
            <li role="none"><a href="prodotti.php?type=Paste" role="menuitem">Paste</a></li>
            <li role="none"><a href="prodotti.php?type=Torte" role="menuitem">Torte</a></li>
            <li role="none"><a href="storia.php" role="menuitem">Storia</a></li>
            <li role="menuitem"><strong>Contatti</strong></li>';
        }else if(!strcmp($page,"prodotti.php?type=Paste")){
            $content='<li xml:lang="en"><a href="home.php" xml:lang="en" role="menuitem">Home</a></li>
            <li role="menuitem"><strong>Paste</strong></li>
            <li role="none"><a href="prodotti.php?type=Torte" role="menuitem">Torte</a></li>
            <li role="none"><a href="storia.php" role="menuitem">Storia</a></li>
            <li role="none"><a href="contatti.php" role="menuitem">Contatti</a></li>';
        }else if(!strcmp($page,"prodotti.php?type=Torte")){
            $content='<li xml:lang="en"><a href="home.php" xml:lang="en" role="menuitem">Home</a></li>
            <li role="none"><a href="prodotti.php?type=Paste" role="menuitem">Paste</a></li>
            <li role="menuitem"><strong>Torte</strong></li>
            <li role="none"><a href="storia.php" role="menuitem">Storia</a></li>
            <li role="none"><a href="contatti.php" role="menuitem">Contatti</a></li>';
        }else{
            $content='<li xml:lang="en"><a href="home.php" xml:lang="en" role="menuitem">Home</a></li>
            <li role="none"><a href="prodotti.php?type=Paste" role="menuitem">Paste</a></li>
            <li role="none"><a href="prodotti.php?type=Torte" role="menuitem">Torte</a></li>
            <li role="none"><a href="storia.php" role="menuitem">Storia</a></li>
            <li role="none"><a href="contatti.php" role="menuitem">Contatti</a></li>';
        }
        return $content;
    }


    public static function admin_form(){
        require_once('sessions.php');
        if(Sessions::session_exists('admin')){
            $content ='<div class="box admin_column">
                            <form class="general_form" method="post" action="'.$_SERVER['REQUEST_URI'].'">
                                <fieldset id="fieldset_login">
                                <legend>Benvenuto amministratore!</legend>
                                    <input id="submit_login_form" class="general_button" type="submit" value="Esci" name="Logout" tabindex="8" />
                                </fieldset>
                            </form>
                        </div>';
        }else{
            $content ='<div class="box admin_column">
                            <form class="general_form" method="post" action="'.$_SERVER['REQUEST_URI'].'">
                                <fieldset id="fieldset_login">
                                    <legend>Area Amministratore</legend>
                                    <div class="input_line">
                                        <label for="username"><span xml:lang="en">Username: </span></label>
                                        <input class="general_input" id="login_input" type="text" name="username" id="username" maxlength="20" tabindex="6" aria-required="true"/>
                                    </div>
                                    <div class="input_line">
                                        <label for="password"><span xml:lang="en">Password:  </span></label>
                                        <input class="general_input" id="login_input" type="password" name="password" id="password" maxlength="20" tabindex="7" aria-required="true"/>
                                    </div>
                                    <input id="submit_login_form" class="general_button" type="submit" value="Accedi" name="Login" tabindex="8" />
                                </fieldset>
                            </form>
                        </div>';
        }
        return $content;
    }

} 
?>