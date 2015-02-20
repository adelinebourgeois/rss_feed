<?php

/**
 *   Bdd file
 *
 *   Bdd
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

/**
 *   Bdd class
 *
 *   Class bdd
 *
 * @category Nothing
 * @package  Nothing
 * @author   bourge_n <adeline.bourgeois@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/rendu/
 */
class Bdd
{
    protected $bdd;

    /**
     *   Connexion to bdd
    */
    public function __construct()
    {
        
        try
        {
            $this->bdd = new PDO('mysql:host=localhost;dbname=RSS-Feed;unix_socket=/home/bourge_n/.mysql/mysql.sock', 'root', '');
        }
        catch(Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }   
    }

      /**
     *   Recup connexion
     *   @return connexion bdd
     */
    public function getBdd()
    {
      
        return $this->bdd;
    }
}
?>