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
        $donnees->bindParam(':nom', $nom);
        $donnees->bindParam(':prenom', $prenom);
        $donnees->bindParam(':login', $login);
        $donnees->bindParam(':mail', $mail);
        $donnees->bindParam(':password', sha1($password));
        $donnees->execute();

        $req = "SELECT * FROM user WHERE login = :login and nom = :nom";
        $exec = $this->getBdd()->prepare($req);
        $exec->bindParam(":login", $login);
        $exec->bindParam(":nom", $nom);
        $exec->execute();

        $result = $exec->fetch();
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
        $donnees->bindParam(':login', $login);
        $donnees->bindParam(':mail', $mail);
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
        $passwd = sha1($pass);
        $req = "SELECT * FROM user WHERE mail=:mail AND password = :pass";
        $exec = $this->getBdd()->prepare($req);
        $exec->bindParam(':mail', $mail);
        $exec->bindParam(':pass', $passwd);
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
        $donnees->bindParam(':id', $id);
        $donnees->bindParam(':mail', $this->_mail);
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
        $sql = "SELECT * from user WHERE login = :login AND password = :old";
        
        $donnee = $this->getBdd()->prepare($sql);
        $donnee->bindParam(':login', $login);
        $donnee->bindParam(':old', $old);
        $donnee->execute();
        
        $pass_sql=$donnee->fetch();

        if ($pass_sql == false) {
            echo "Ancien mot de passe incorrecte";
        }

        $update= "UPDATE user SET password = :new WHERE login = :login";
        $update_requete = $this->getDb()->prepare($update);
        $update_requete->bindParam(':login', $login);
        $update_requete->bindParam(':new', $new);
        $update_requete->execute();                                   
    }
    /*public function getInfos($id)
    {
        $sql= "SELECT * from user WHERE login = :id";
        $donnee = $this->getBdd()->prepare($sql);
        $donnee->bindParam(':id', $id);
        $donnee->execute();
        return $donnee->fetch(PDO::FETCH_ASSOC);
    } */


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
        $donnees->bindParam(':id', $id);
        $donnees->bindParam(':login', $this->_login);
        $donnees->execute();
        $_SESSION['pseudo'] = $login;
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