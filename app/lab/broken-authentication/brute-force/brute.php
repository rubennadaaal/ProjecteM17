<?php

session_start(); 

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0; 
}

$max_attempts = 3; 

$db = new PDO('sqlite:users.db');
$html = "";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $_SESSION['login_attempts']++;

    if ($_SESSION['login_attempts'] > $max_attempts) {
        $html = "Masses intents.";
    } else {
        $q = $db->prepare("SELECT * FROM users_ WHERE username=:user AND password=:pass");
        $q->execute(array(
            'user' => $_POST['username'],
            'pass' => $_POST['password']
        ));
        $_select = $q->fetch();

        if (isset($_select['id'])) {
            $_SESSION['username'] = $_POST['username'];
            $html = "¡Inicio de sesión exitoso!";
        } else {
            $html = "Worng.";
        }
    }
}

?>
