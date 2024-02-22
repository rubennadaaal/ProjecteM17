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
    // Comprobar si se proporciona un parámetro 'q' en la URL
    if (isset($_GET['q'])) {
      $q = htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8');
      // Mostrar mensaje de alerta de error
      echo '<div class="alert alert-danger" style="margin-top: 30vh;" role="alert" >';
      echo '' . htmlspecialchars($strings['text'], ENT_QUOTES, 'UTF-8') . ' <b>' . $q . '</b> ';
      echo '<a href="index.php">' . htmlspecialchars($strings['try'], ENT_QUOTES, 'UTF-8') . '</a>';
      echo "</div>";
    } else {
      // Mostrar formulario de búsqueda si no se proporciona 'q'
      echo '<form method="GET" action="#" style="margin-top: 30vh;" class="row g-3 col-md-6 row justify-content-center mx-auto">';
      echo '<input class="form-control" type="text" placeholder="' . htmlspecialchars($strings['search'], ENT_QUOTES, 'UTF-8') . '" name="q">';
      echo '<button type="submit" class="col-md-3 btn btn-primary mb-3">' . htmlspecialchars($strings['s_button'], ENT_QUOTES, 'UTF-8') . '</button>';
      echo '</form>';
    }

    ?>

  </div>
    

  <!-- Cerrar etiqueta </html> -->
  </html>

  <!-- Sección opcional para cargar scripts JavaScript adicionales según sea necesario -->
</body>

</html>