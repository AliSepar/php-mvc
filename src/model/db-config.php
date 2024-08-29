<?php
// Connexion à la base de données
function dbConnect()
{

    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    return $bdd;
}
