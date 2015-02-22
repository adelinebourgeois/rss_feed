<?php

/**
 *   Control Modif Info
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

session_start();
require'../Model/User.php';
require'../Model/Flux.php';

//MODIF MDP

if (isset($_POST['modifierMdp'])) {
    $old = sha1($_POST['old']);
    $new = sha1($_POST['new']);
    $new_rep = $_POST['new_pwd'];

    if (empty($old)) {
        echo "Veuillez saisir votre ancien mot de passe !";
    } elseif ($new != $new_rep) {
        echo "Mot de passe non identique";
    } else {
        $ok = $obj->modifpwd($_SESSION['pseudo'], $old, $new);
        if ($ok === true) {
            ?>
            
        <?php
            header('Location:profil.php');
            exit();
        } else {
            $erreur = "Erreur";
        }
    }
}

//MODIF MAIL
//die(var_dump($_SESSION));
if (isset($_POST['modemail'])) {
    $user = new User();
    $user->setMail($_POST['nouveau']);
    $_SESSION['mail'] = $_POST['nouveau'];
    $user->modifinfos($_SESSION['id'], $_SESSION['mail']);
}

//MODIF LOGIN
 /*die(var_dump($_POST['modiflog']));*/
if (isset($_POST['modiflog'])) {
   
    $user = new User();
    $user->setLogin($_POST['log']);
    $_SESSION['pseudo'] = $_POST['log'];
    $user->modiflog($_SESSION['id'], $_SESSION['pseudo']);
}

/*$user = new User();
$infos = $user->getInfos($_SESSION['id']);*/





require'../Templates/profil.html';
?>