<?php
/**
 *   Control Inscription and connexion
 *
 *   Control
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

require'../Model/User.php';
session_start();
$erreur = "";

  //CONNEXION

if (isset($_POST['connexion'])) {
    $membre = new user();

    if (!isset($_POST['email']) || !isset($_POST['pwd'])) {
        $erreur = "Saisie incorrect";
        header('Location: ../index.html');
    } else {
        $membre->login($_POST['email'], $_POST['pwd']);
        header('Location: ../Control/accueil.php');
        exit();
    }
}

  // INSCRIPTION


if (isset($_POST["inscription"])) { 
    $membre = new user();

    if (!isset($_POST['login']) || !isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['mail'])) {
        $erreur = "Saisie incorrect";
    } elseif (!isset($_POST['pass']) || $_POST['pass'] !== $_POST['pass1']) {
        $erreur = "Mot de passe invalide ou différent";
        header('Location: ../index.html');
        exit();
    } else {
        $tempArr = $membre->existbdd($_POST['login'], $_POST['mail']);
        if (empty($tempArr)) {
                        unset($tempArr);
                        $membre->inscription($_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['mail'], $_POST['pass']);
                        header('Location:accueil.php');
                        exit();
        } else {
                        $erreur = "Pseudo ou mail déja utilisés";
        }
    }
}
?>