<?php
/**
 *   User class file
 *
 *   Class do handle flux rss
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
require 'Bdd.php';

/**
 *   User class
 *
 *   Class do handle user
 *
 * @category Nothing
 * @package  Nothing
 * @author   bourge_n <adeline.bourgeois@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/rendu/
 */





class User extends Bdd
{

    private $_nom;
    private $_prenom;
    private $_mail;
    private $_login;
    private $_password;

    /**
     *   Put new user into the database
     *   @param string $nom      is the lname
     *   @param string $prenom   is the fname
     *   @param string $login    is the login
     *   @param string $mail     is the mail
     *   @param string $password is the password
     *   @return true if ok
     */
    public function inscription($nom, $prenom, $login, $mail, $password)
    {
        
        $sql ="INSERT INTO user (nom, prenom, login, mail, password) VALUES (:nom, :prenom, :login, :mail, :password)";

        $donnees = $this->getBdd()->prepare($sql);
        $donnee->bindParam(':nom', $nom);
        $donnee->bindParam(':prenom', $prenom);
        $donnee->bindParam(':login', $login);
        $donnee->bindParam(':mail', $mail);
        $donnee->bindParam(':password', sha1($password));

        $donnees->execute();

        $req = "SELECT id_user FROM user WHERE login = :login and nom = :nom";
        $exec = $this->getBdd()->prepare($req);
        $donnee->bindParam(":login", $login);
        $donnee->bindParam(":nom", $nom);
        $exec->execute();

        $res = $exec->fetch();

        $_SESSION['connected']      = true;
        $_SESSION['id']             = $result['id_user'];
        $_SESSION['nom']            = $result['nom'];
        $_SESSION['prenom']         = $result['prenom'];
        $_SESSION['pseudo']         = $result['login'];
        $_SESSION['mail']           = $result['mail'];
        header('Location:../Control/accueil.php');
        exit();
    }   

    //VERIF EXIST BDD

     /**
     *   If login exist in database
     *   @param string $login is the login user
     *   @param string $mail  is the mail user
     *   @return true if ok
     */
    public function existBdd($login, $mail)
    {
        $sql = "SELECT * FROM user WHERE login = :login OR mail = :mail";
        $donnees = $this->getBdd()->prepare($sql);
        $donnee->bindParam(':login', $login);
        $donnee->bindParam(':mail', $mail);
        $donnees->execute();
    
        $resultat = $donnees->fetch();
        return $resultat;

    }

    // CONNEXION

    /**
     *   Connexion
     *   @param string $mail is the mail user
     *   @param string $pass is the pass user
     *   @return array
     */
    public function login($mail, $pass)
    {
        $req = "SELECT * FROM user WHERE mail=:mail AND password = :pass";
        $exec = $this->getBdd()->prepare($req);
        $exec->bindParam(':mail', $mail);
        $exec->bindParam(':pass', sha1($pass));
        $exec->execute();
           
        $result = $exec->fetch();

        if (!empty($result)) {
            $_SESSION['connected']      = true;
            $_SESSION['id']             = $result['id_user'];
            $_SESSION['nom']            = $result['nom'];
            $_SESSION['prenom']         = $result['prenom'];
            $_SESSION['pseudo']         = $result['login'];
            $_SESSION['mail']           = $result['mail'];
            header('Location:../Control/accueil.php');
            exit();
        } else {
            header('Location ../');
            exit();
        }

    }

    /**
     *   Change mail user
     *   @param int    $id   is the id user
     *   @param string $mail is the mail user
     *   @return array
     */
    public function modifinfos ($id, $mail)
    {

        $sql = 'UPDATE user SET mail = :mail WHERE id_user = :id';
        $donnees = $this->getBdd()->prepare($sql);
        $donnee->bindParam(':id', $id);
        $donnee->bindParam(':mail', $mail);
        $donnees->execute(); 
    }

    /**
     *   Change password user
     *   @param string $login is the login user
     *   @param string $old   is the old pass
     *   @param string $new   is the new pass
     *   @return array
     */
    public function modifpwd($login, $old, $new)
    {
        $pass= "SELECT * from user WHERE login = :login AND password = :old";
        
        $pass_requete = $this->getDb()->prepare($pass);
        $donnee->bindParam(':login', $login);
        $donnee->bindParam(':old', $old);
        $pass_requete->execute();
        
        $pass_sql=$pass_requete->fetch();

        if ($pass_sql == false) {
            echo "Ancien mot de passe incorrecte";
        }

        $update= "UPDATE user SET password = :new WHERE login = :login";
        $update_requete = $this->getDb()->prepare($update);
        $donnee->bindParam(':login', $login);
        $donnee->bindParam(':new', $new);
        $update_requete->execute();
                                        
    }

    /**
     *   Change login user
     *   @param int $id    is the id user
     *   @param int $login is the login user
     *   @return array
     */
    public function modiflog ($id, $login)
    {

        $sql = 'UPDATE user SET login = :login WHERE id_user = :id';
        $donnees = $this->getBdd()->prepare($sql);
        $donnee->bindParam(':id', $id);
        $donnee->bindParam(':login', $login);
        $donnees->execute();    
    }

    /**
     *   Recup login
     *   @return $login
     */
    public function getLogin()
    {
        return $this->_login;
    }

    /**
     *   Modif login
     *   @param string $login is the login
     *   @return $login
     */
    public function setLogin($login)
    {
        $this->_login = $login;
    }

    /**
     *   Recup mail
     *   @return $mail
     */
    public function getMail()
    {
        return $this->_mail;
    }

    /**
     *   Modif mail
     *   @param string $mail is the mail
     *   @return $mail
     */
    public function setMail($mail)
    {
        $this->_mail = $mail;
    }  
}
?>