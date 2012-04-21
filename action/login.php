<?php
    if($_POST['ingresar']){
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['passwd'] = $_POST['passwd'];
    }
?>