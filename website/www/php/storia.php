<?php
require_once 'backend/sessions.php';
Sessions::init_session();
require_once 'backend/print_content.php';
echo(Print_content::top('xhtml+aria'));
echo(Print_content::openHTML());
echo(Print_content::head('Storia'));
echo(Print_content::openBody());
echo(Print_content::header('Dietro ad una grande pasticceria, c\'è anche una grande tradizione','storia.php')."\r");
echo(Print_content::breadcrumb('<strong>Storia</strong>')."\r");
echo(Print_content::openGeneralContainer());
echo(Print_content::menu("storia.php"));
echo(Print_content::news("storia.php"));
echo(Print_content::closeDiv());
include_once('../html/storia.html');
echo(Print_content::closeDiv());
echo(Print_content::footer());
echo(Print_content::closeBody());
echo(Print_content::closeHTML());
?>