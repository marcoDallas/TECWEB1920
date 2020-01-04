<?php
require_once("admin.php");

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['Login'])) {
    echo(Admin::login_ajax());
}
?>