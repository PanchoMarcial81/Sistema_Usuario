<?php

/*=============================================
PUBLICANDO ARTICULO
=============================================*/
if (isset($_POST['title']) && isset($_POST['description'])) {
    if (!empty($_POST['title']) && empty($_POST['description'])) {
        if (!preg_match('/^[,\\@\\?\\$\\.\\´\\\\¨\\¡\\!\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/', $_POST['title'])) {
            echo 'title_invalido';
            exit();
        }else if (!preg_match('/^[,\\@\\?\\$\\.\\´\\\\¨\\¡\\!\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/', $_POST['description'])) {
            echo 'description_invalido';
            exit();
        }

        $name_file = '';
        
        if ($_FILES['upPicture']['type'] == 'image/jpg' || $_FILES['upPicture']['type'] == 'image/jpeg' || $_FILES['upPicture']['type'] == 'image/png') {
		
            $iduser = trim(base64_decode($_POST['userid']));
            $extent = explode('/', $_FILES['upPicture']['type']);
            $name_file = $iduser.'_'.$_POST['username'].'.'.$extent[1];

            move_uploaded_file($_FILES['upPicture']['tmp_name'], '../images/users/'. $name_picture);

        }else{
            echo "file_no_aceptado";
        }
    }else{
        echo "campos_vacios";
    }
    
}