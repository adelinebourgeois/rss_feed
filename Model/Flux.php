<?php

/**
 *   Flux class file
 *
 *   Class flux rss
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
 *   Flux class
 *
 *   Class do handle flux rss
 *
 * @category Nothing
 * @package  Nothing
 * @author   bourge_n <adeline.bourgeois@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/rendu/
 */
class Flux extends Bdd
{
    private $_id;
    private $_id_user;
    private $_link;

    /**
     *   Put new rss into the database
     *   @param int    $id_user is the id user
     *   @param string $link    is the flux link
     *   @return true if ok
     */
    public function sendUrl($id_user,$link)
    {
        /*$valid = $this->validateFeed($link);
        if ($valid) {*/
            $sql = "INSERT INTO flux(id_user, link, activate) VALUES (:id_user, :link, 1)";
            $donnee = $this->getBdd()->prepare($sql);
            $donnee->bindParam(':id_user', $id_user);
            $donnee->bindParam(':link', $link);
            $donnee->execute();
        /*} else {
            return false;
        }*/
    }

    /**
     *   Fetch list ofrss flux
     *   @param int $id_user is the id user
     *   @return rss list
     */
    public function affichMyUrl($id_user)
    {
        $sql = "SELECT * FROM flux WHERE id_user = :id AND activate = 1";
        $donnee = $this->getBdd()->prepare($sql);
        $donnee->bindParam(':id', $id_user);
        $donnee->execute();
        return $donnee;
    }

    /**
     *   Remove rss
     *   @param int $activate is the activation of url
     *   @param int $id_link  is the flux id
     *   @return nothing
     */
    public function supprFlux($activate, $id_link)
    {
        $sql = "UPDATE flux SET activate = :activate WHERE id = :id_link";
        $donnee = $this->getBdd()->prepare($sql);
        $donnee->bindParam(':activate', $activate);
        $donnee->bindParam(':id_link', $id_link);
        $donnee->execute();
    }

    /**
     *   Verify if flux exist
     *   @param int    $id     is the id user
     *   @param string $idFlux is the flux link
     *   @return array
     */
    public function affichContent($id, $idFlux)
    {
        $sql = "SELECT * FROM flux WHERE id_user = :id AND id = :idFlux";
        $donnee = $this->getBdd()->prepare($sql);
        $donnee->bindParam(':id', $id);
        $donnee->bindParam(':idFlux', $idFlux);
        $donnee->execute();
        return $donnee->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     *   Fetch current flux
     * @param int $flux is the rss selected
     * @return rss content
     */
    public function curFlux($flux)
    {
        $nombre_flux = 5;
        $fluxrss = simplexml_load_file($flux);
        $i = 0;

        foreach ($fluxrss->channel->item as $key => $value) {
            if ($i < $nombre_flux) {

                echo '<li><a href="'.$value->link.'">'.$value->title.'</a><p>'.$value->description.'</p> <i>publié le '.date('d/m/Y à G\hi', strtotime($value->pubDate)).'</i></li>';    
            }
            $i++;   
        }
    }  
}

?>