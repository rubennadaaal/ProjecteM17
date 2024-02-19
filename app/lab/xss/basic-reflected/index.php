<?php
require("../../../lang/lang.php");
$strings = tr();

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
  <title><?php echo $strings['title'];  ?></title>
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center h-100 mx-auto">
    <?php

    if (isset($_GET['q'])) {
      $q = $_GET['q'];
      echo '<div class="alert alert-danger" style="margin-top: 30vh;" role="alert" >';
      echo '' . $strings['text'] . ' <b>' . $q . '</b> ';
      echo '<a href="index.php" ">' . $strings['try'] . '</a>';
      echo "</div>";
    } else {
      echo '<form method="GET" action="#" style="margin-top: 30vh;" class="row g-3 col-md-6 row justify-content-center mx-auto">';
      echo '<input class="form-control" type="text" placeholder="' . $strings['search'] . '" name="q">';
      echo '<button type="submit" class="col-md-3 btn btn-primary mb-3">' . $strings['s_button'] . '</button>';
      echo '</form>';
    }

    // Validar el comentario
    $comentario = trim($_POST["comentario"]);
    if(empty($comentario)){
      exit("Debes proporcionar un comentario");
    }
    // Sanitizar comentario
    $comentario = strip_tags($comentario);
    // El comentario ya se puede guardar de forma segura
    file_put_contents("comentarios.txt", $comentario, FILE_APPEND);
    // Escapar comentarios antes de mostrarlos
    $comentarios = file_get_contents("comentarios.txt");
    echo htmlspecialchars($comentarios);
    ?>

  </div>

  <script id="VLBar" title="<?= $strings['title'] ?>" category-id="1" src="/public/assets/js/vlnav.min.js"></script>

</body>

</html>