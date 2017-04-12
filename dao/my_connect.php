<?php

define('HOST', 'localhost');
define('LOGIN', 'root');
define('PSW', '');
define('BASE', 'cdtheque');

function    my_connect() {
    return (new PDO('mysql:host=' . HOST . ';dbname=' . BASE, LOGIN, PSW));
}

?>
