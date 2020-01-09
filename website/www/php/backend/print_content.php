<?php
/*
 * Definisce metodi che elaborano parti di pagine dinamiche
 */
require_once('backend/utilities.php');
require_once('sessions.php');

class Print_content
{
    /* Il metodo stampa il logo in base alla pagina in cui ci troviamo */
    public static function logo($page)
    {
        if (!strcmp($page, "Home")) {
            $content='<img id="logo" src="../images/logo.png" alt="Ti trovi nella pagina principale di Pasticceria Padovana"/>';
        } else {
            $content='<a href="home.php" title="Torna alla pagina principale">
                        <img id="logo" src="../images/logo.png" alt="Torna alla pagina principale di Pasticceria Padovana"/>
                      </a>';
        }
        return $content;
    }
    /* Il metodo stampa il menu in base alla pagina in cui ci troviamo */
    public static function menu($page)
    {
        if (!strcmp($page, "home.php")) {
            $content='<li role="menuitem"><strong xml:lang="en">Home</strong></li>
            <li role="none"><a href="prodotti.php?type=Paste" role="menuitem">Paste</a></li>
            <li role="none"><a href="prodotti.php?type=Torte" role="menuitem">Torte</a></li>
            <li role="none"><a href="storia.php" role="menuitem">Storia</a></li>
            <li role="none"><a href="contatti.php" role="menuitem">Contatti</a></li>';
        } elseif (!strcmp($page, "storia.php")) {
            $content='<li role="none"><a href="home.php" xml:lang="en" role="menuitem">Home</a></li>
            <li role="none"><a href="prodotti.php?type=Paste" role="menuitem">Paste</a></li>
            <li role="none"><a href="prodotti.php?type=Torte" role="menuitem">Torte</a></li>
            <li role="none"><strong>Storia</strong></li>
            <li role="none"><a href="contatti.php" role="menuitem">Contatti</a></li>';
        } elseif (!strcmp($page, "contatti.php")) {
            $content='<li role="none"><a href="home.php" xml:lang="en" role="menuitem">Home</a></li>
            <li role="none"><a href="prodotti.php?type=Paste" role="menuitem">Paste</a></li>
            <li role="none"><a href="prodotti.php?type=Torte" role="menuitem">Torte</a></li>
            <li role="none"><a href="storia.php" role="menuitem">Storia</a></li>
            <li role="none"><strong>Contatti</strong></li>';
        } elseif (!strcmp($page, "prodotti.php?type=Paste")) {
            $content='<li role="none"><a href="home.php" xml:lang="en" role="menuitem">Home</a></li>
            <li role="none"><strong>Paste</strong></li>
            <li role="none"><a href="prodotti.php?type=Torte" role="menuitem">Torte</a></li>
            <li role="none"><a href="storia.php" role="menuitem">Storia</a></li>
            <li role="none"><a href="contatti.php" role="menuitem">Contatti</a></li>';
        } elseif (!strcmp($page, "prodotti.php?type=Torte")) {
            $content='<li role="none"><a href="home.php" xml:lang="en" role="menuitem">Home</a></li>
            <li role="none"><a href="prodotti.php?type=Paste" role="menuitem">Paste</a></li>
            <li role="none"><strong>Torte</strong></li>
            <li role="none"><a href="storia.php" role="menuitem">Storia</a></li>
            <li role="none"><a href="contatti.php" role="menuitem">Contatti</a></li>';
        } else {
            $content='<li role="none"><a href="home.php" xml:lang="en" role="menuitem">Home</a></li>
            <li role="none"><a href="prodotti.php?type=Paste" role="menuitem">Paste</a></li>
            <li role="none"><a href="prodotti.php?type=Torte" role="menuitem">Torte</a></li>
            <li role="none"><a href="storia.php" role="menuitem">Storia</a></li>
            <li role="none"><a href="contatti.php" role="menuitem">Contatti</a></li>';
        }
        return $content;
    }
    /* Il metodo stampa il form di login o logout */
    public static function admin_form()
    {
        if (Sessions::session_exists('admin')) {
            $content = file_get_contents('../html/components/logout_admin_form.html');
            if (!strcmp(Utilities::shrink_page($_SERVER['REQUEST_URI']), 'modifica_prodotto') || !strcmp(Utilities::shrink_page($_SERVER['REQUEST_URI']), 'modifica_news')) {
                $content = str_replace('<form_to_insert/>', '<form class="col-sm-1" method="post" action="home.php">', $content);
            } else {
                $content = str_replace('<form_to_insert/>', '<form class="col-sm-1" method="post" action="'.htmlentities($_SERVER['REQUEST_URI']).'">', $content);
            }
        } else {
            $content = file_get_contents('../html/components/admin_form.html');
            $content = str_replace('<form_to_insert/>', '<form class="col-sm-1 mobile_hidden" id="admin_login_form" method="post" action="'.htmlentities($_SERVER['REQUEST_URI']).'">', $content);
            if(isset($_POST['in']) && $_POST['in']===FALSE) {
                $content = str_replace('<error_login_to_insert/>','<strong>Credenziali errate!</p>',$content);
            } else {
                $content = str_replace('<error_login_to_insert/>','',$content);
            }
        }
        return $content;
    }
}
?>