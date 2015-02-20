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


  //CONNEXION

if (isset($_POST['connexion'])) {
    $membre = new user();

    if (empty($_POST['email']) || empty($_POST['pwd'])) {
        echo "Saisie incorrect";
        header('Location: ../index.html');
        exit();
    } else {
        $membre->login($_POST['email'], $_POST['pwd']);
        header('Location: ../Control/accueil.php');
        exit();
    }
}

  // INSCRIPTION


if (isset($_POST["inscription"])) { 
    $membre = new user();
    
    if (empty($_POST['login']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['mail'])) {
        echo "Saisie incorrect";
    } elseif (empty($_POST['pass']) || $_POST['pass'] !== $_POST['pass1']) {
        echo "Mot de passe invalide ou différent";
        header('Location: ../index.html');
        exit();
    } else {
        $log = htmlspecialchars(trim($_POST['login']));
        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $mail =  htmlspecialchars(trim($_POST['mail']));
        $pass =  htmlspecialchars(trim($_POST['pass']));

        $tempArr = $membre->existbdd($log, $mail);
        if (empty($tempArr)) {
                        unset($tempArr);
                        $membre->inscription($nom, $prenom, $log, $mail, $pass);
                        header('Location:accueil.php');
                        exit();
        } else {
                       echo "Pseudo ou mail déja utilisés";
        }
    }
}
?>