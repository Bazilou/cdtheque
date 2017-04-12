<?php

require_once('dao/album.php');
require_once('dao/categorie.php');

$mesCd = findAllAlbum();
$mesCateg = findAllCategorie();
$categCD = findAllCategInCd();

$monJson['listCD'] = $mesCd;
$monJson['categCD'] = $categCD;
$monJson['listCat'] = $mesCateg;

echo json_encode($monJson);
//var_dump($monJson);
?>
