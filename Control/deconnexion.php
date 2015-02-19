<?php

/**
 *   Deconnexion file
 *
 *   Deconnexion
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
  session_unset();
  session_destroy();
  header('Location: ../index.html');
  exit();
?>