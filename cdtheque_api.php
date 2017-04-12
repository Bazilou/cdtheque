<?php

require_once('dao/album.php');
require_once('dao/categorie.php');

if (!empty($_POST['nameCD'])) {
    $idCD = createAlbum(trim(htmlspecialchars($_POST['nameCD'])));
    if ($idCD) {
        echo $idCD;
    }
} else if (!empty($_POST['nameCat'])) {
    $idCat = createCategorie(trim(htmlspecialchars($_POST['nameCat'])));
    if ($idCat) {
        echo $idCat;
    }
} else if (!empty($_POST['id_cd'])) {
    deleteAlbum(trim(htmlspecialchars($_POST['id_cd'])));
} else if (!empty($_POST['id_cat'])) {
    deleteCategorie(trim(htmlspecialchars($_POST['id_cat'])));
}

?>
