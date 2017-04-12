<?php

require_once('my_connect.php');

function    findAllCategorie() {
    $bdd = my_connect();
    $res = NULL;

    $db = $bdd->prepare("SELECT categ_id AS idCat,
        categ_name AS nom FROM categ");
    if ($db->execute()) {
        while ($line = $db->fetch(PDO::FETCH_ASSOC)) {
                $res[] = $line;
            }
    }
    return ($res);
}

function    findCategorieById($id) {
    $bdd = connect_pdo();
    $res = NULL;

    $db = $bdd->prepare("SELECT categ_id AS idCat,
        categ_name AS nom FROM categ WHERE categ_id = ?");
    $db->bindParam(1, $id, PDO::PARAM_INT);
    if ($db->execute()) {
        $res = $db->fetch();
        $db->closeCursor();
    }
    return ($res);
}

function    deleteCategorie($id) {
    $bdd = my_connect();

    $stmt = $bdd->prepare('DELETE FROM categ WHERE categ_id = ?');
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    return ($stmt->execute());
}

function    createCategorie($nom) {
    $bdd = my_connect();
    $id = NULL;

    $stmt = $bdd->prepare('INSERT INTO categ SET categ_name = ?');
    $stmt->bindParam(1, $nom, PDO::PARAM_STR);
    if ($stmt->execute()) {
        $id = $bdd->lastInsertId();
    }
    return ($id);
}

?>
