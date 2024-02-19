<?php
    // Requerir l'arxiu de traducció
    require("../../../lang/lang.php");
    $strings = tr();
    
    // Comprovar si s'ha enviat el formulari
    if( isset($_POST['submit']) ){

        // Obtindre informació sobre l'arxiu pujat
        $tmpName = $_FILES['input_image']['tmp_name']; // Nom temporal de l'arxiu
        $fileName = $_FILES['input_image']['name']; // Nom de l'arxiu

        // Comprovar si s'ha proporcionat un nom d'arxiu
        if(!empty($fileName)){
            // Obtindre informació sobre l'arxiu d'imatge
            $imageInfo = @getimagesize($tmpName);

            // Comprovar si s'ha pogut obtenir informació sobre l'arxiu i si és una imatge vàlida
            if ($imageInfo !== false && in_array($imageInfo['mime'], array('image/gif', 'image/jpeg', 'image/png'))) {
                // Obtindre l'extensió de l'arxiu
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Definir les extensions permeses
                $allowedExtensions = array("gif", "jpeg", "jpg", "png");

                // Comprovar si l'extensió i el tipus MIME estan permesos
                if (in_array($fileExtension, $allowedExtensions)) {

                    // Comprovar si la carpeta de destí no existeix, si no, crear-la
                    if(!file_exists("uploads")){
                        mkdir("uploads");
                    }

                    // Definir la ruta de destí per a l'arxiu pujat
                    $uploadPath = "uploads/".$fileName;

                    // Moure l'arxiu pujat al destí
                    if( @move_uploaded_file($tmpName,$uploadPath) ){
                        $status = "success"; // Estat d'èxit
                    } else {
                        $status = "unsuccess"; // Estat de fallida
                    }
                } else {
                    $status = "blocked"; // Estat d'arxiu bloquejat (extensió no permesa)
                }
            } else {
                $status = "blocked"; // Estat d'arxiu bloquejat (tipus d'arxiu no vàlid)
            }
        } else {
            $status = "empty"; // Estat d'arxiu buit
        }
    }
?>

<!DOCTYPE html>
<html lang="<?= $strings['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $strings['title']; ?></title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    
    <div class="container">

        <div class="container-wrapper">
            <div class="row pt-5 mt-5 mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h1><?= $strings['title']; ?></h1>

                    <a href="delete.php"><button type="button" href="" class="btn btn-secondary btn-sm"><?= $strings['delete_button']; ?></button></a>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row pt-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    
                    <div class="card border-primary mb-4">
                        <div class="card-header text-primary">
                            <?= $strings['card_formats']; ?> <b><?= $strings['card_formats_type']; ?> </b>
                        </div>
                    </div>

                    <h3 class="mb-3"><?= $strings['middle_title']; ?></h3>

                    <?php
                        // Mostrar missatges d'alerta segons l'estat de la càrrega de l'arxiu
                        if( isset($status) ){
                            if( $status == "success" ){
                                echo '<div class="alert alert-success" role="alert">
                                <b>'.$strings['alert_success'].'</b> 
                                <hr>'
                                .$strings['alert_success_file_path'].'<a class="text-success" href="'.$uploadPath.'"> <b>'.$uploadPath.'</b> </a> 
                                </div>';
                            }
                            if( $status == "unsuccess" ){
                                echo '<div class="alert alert-danger" role="alert">
                                <b>'.$strings['alert_unsuccess'].'</b> 
                                </div>';
                            }
                            if( $status == "blocked" ){
                                echo '<div class="alert alert-danger" role="alert">
                                <b>'.$strings['alert_blocked'].'</b> <hr>'
                                .$strings['alert_blocked_type'].
                                '</div>';
                            }
                            if( $status == "empty" ){
                                echo '<div class="alert alert-danger" role="alert">
                                <b>'.$strings['alert_empty'].'</b> 
                                </div>';
                            }
                        }
                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="input_image" class="form-label"><?= $strings['input_label']; ?></label>
                            <input class="form-control" type="file" id="input_image" name="input_image"> 
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit" name="submit"><?= $strings['button']; ?></button>
                        </div>
                    </form>

                </div>
                <div class="col-md-3"></div>
            </div>
        </div>

    </div>
    <script id="VLBar" title="<?= $strings['title']; ?>" category-id="7" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>
