<?php

require_once('my_connect.php');

function    findAllAlbum() {
    $bdd = my_connect();
    $res = NULL;

    $stmt = $bdd->prepare("SELECT album_id AS idCd,
        album_name AS titre FROM album");
    if ($stmt->execute()) {
        while ($line = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $res[] = $line;
        }
    }
    return ($res);
}

function    findAllCategInCd() {
    $bdd = my_connect();
    $res = NULL;

    $db = $bdd->prepare('SELECT album_id AS idCd, categ_id AS idCateg FROM album_has_categ');
    if ($db->execute()) {
        while ($line = $db->fetch(PDO::FETCH_ASSOC)) {
            $res[] = $line;
        }
    }
    return ($res);
}

function    findAlbumById($id) {
    $bdd = connect_pdo();
    $res = NULL;

    $stmt = $bdd->prepare("SELECT album_id AS idCd,
        album_name AS titre FROM album WHERE album_id = ?");
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        $res = $stmt->fetch();
        $stmt->closeCursor();
    }
    return ($res);
}

function    deleteAlbum($id) {
    $bdd = my_connect();

    $stmt = $bdd->prepare('DELETE FROM album WHERE album_id = ?');
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    return ($stmt->execute());
}

function    createAlbum($nom) {
    $bdd = my_connect();
    $id = null;

    $stmt = $bdd->prepare('INSERT INTO album SET album_name = ?');
    $stmt->bindParam(1, $nom, PDO::PARAM_STR);
    if ($stmt->execute()) {
        $id = $bdd->lastInsertId();
    }
    return ($id);
}

?>
