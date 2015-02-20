<?php

/**
 *   Accueil file
 *
 *   Controler accueil
 *
 *
 * PHP Version 5.4
 *
 * @category Nothing
 * @package  Nothing
 * @author   bourge_n <adeline.bourgeois@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/rendu/
 */

session_start();
require'../Model/User.php';
require'../Model/Flux.php';

$xml = 'rss';

//ENVOIE URL

if (isset($_POST['send'])) {
    if (strpos(($_POST['url']), $xml)) {
        $flux = new Flux();
        $flux->sendUrl($_SESSION['id'], $_POST['url']);
    } else {
        echo "url non valide";
    }
}



//AFFICHAGE DES FLUX

$affichage = new Flux();

if (isset($_GET['suppr'])) {

    $suppr = $affichage->supprFlux(0, $_GET['suppr']);
}


    $lien = "";
    $affich = $affichage->affichMyUrl($_SESSION['id']);



if (isset($_GET['id'])) {

    $lien = $affichage->affichContent($_SESSION['id'], $_GET['id']);
}

require'../Templates/accueil.html';

?>