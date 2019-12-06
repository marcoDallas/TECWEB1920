<?php
require_once 'backend/sessions.php';
Sessions::init_session();
require_once 'backend/print_content.php';
echo(Print_content::top('xhtml+aria'));
echo(Print_content::openHTML());
echo(Print_content::head('Contatti'));
echo(Print_content::openBody());
echo(Print_content::header('Come e quando puoi contattarci','contatti.php')."\r");
echo(Print_content::breadcrumb('<strong>Contatti</strong>')."\r");
echo(Print_content::openGeneralContainer());
echo(Print_content::menu("contatti.php"));
echo(Print_content::news("contatti.php"));
echo(Print_content::closeDiv());
include_once('../html/contatti.html');
echo(Print_content::closeDiv());
echo(Print_content::footer());
echo(Print_content::closeBody());
echo(Print_content::closeHTML());
?>