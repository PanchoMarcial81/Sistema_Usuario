<?php
// INCLUIMOS LA CONEXION A LA BD
require_once '../db_conexion.php';

/*=============================================
PUBLICANDO ARTICULO
=============================================*/
if (isset($_POST['title']) && isset($_POST['description'])) {

    if (!empty($_POST['title']) && !empty($_POST['description'])) {
        if (!preg_match('/^[,\\@\\?\\$\\.\\´\\\\¨\\¡\\!\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/', $_POST['title'])) {
            echo 'title_invalido';
            exit();
        }else if (!preg_match('/^[,\\@\\?\\$\\.\\´\\\\¨\\¡\\!\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/', $_POST['description'])) {
            echo 'description_invalido';
            exit();
        }

        //VALIDANDO IMAGEN
        $name_file = '';
        
        if ($_FILES['images_files']['type'] == 'image/jpg' || $_FILES['images_files']['type'] == 'image/jpeg' || $_FILES['images_files']['type'] == 'image/png') {
		
            $iduser = trim(base64_decode($_POST['userid']));
            $extent = explode('/', $_FILES['images_files']['type']);
            $name_file = time().'-'.$_FILES['images_files']['name'];

            move_uploaded_file($_FILES['images_files']['tmp_name'], '../images/articles/'. $name_file);

        }else{
            echo "file_no_aceptado";
        }

        $ahutor = base64_decode($_POST['userid']);
        $title = $_POST['title'];
        $description = $_POST['description'];
        $url = limpiar_url($title);
        $visitors = 0;
        $comments = 0;

        //INSERTANDO DATOS
        $stmt = $conn->prepare("INSERT INTO ud_articles(title, description_ar, images, url, ahutor, visitors, comments)  VALUES (?, ?, ?, ?, ?, ?, ?)");
        // Ligar parametros para marcadores
        $stmt->bind_param("ssssiii", $title, $description, $name_file, $url, $ahutor, $visitors, $comments);
        
        if ($stmt->execute()) {
            echo "ok";
        }else{
            echo "error";
        }

    }else{
        echo "campos_vacios";
    }
    
}

/*=============================================
PAGINACION
=============================================*/
if (isset($_POST['cascada_page'])) {
    $_SESSION['page'] += 6;
    $indice = $_SESSION['page'];
    $select = "SELECT * FROM ud_articles JOIN ud_users ON ud_users.id = ud_articles.ahutor ORDER BY ud_articles.id DESC LIMIT $indice, 6";
    $consulta = mysqli_query($conn, $select);
    $res_dates = mysqli_fetch_all($consulta);
    $count_dates = mysqli_num_rows($consulta);

    if ($count_dates != 0) {
        echo json_encode($res_dates);
    }else{
        $error = array('error'=> 'error');
        echo json_encode($error);
    }

    mysqli_free_result($consulta);
}