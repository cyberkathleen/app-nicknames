<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 04.10.23
 * Description : Programme pour la classe Database
 */

 class Database {

    // Variable de classe
    private $connector;
    
    /**
     * Se connecte via PDO et utilise la variable de classe $connector
     * Constructeur
     */
    public function __construct() {
        // Configuration de la base de donnée
        $configs = include("../config.php");

        // Se connecter via PDO
        try
        {
            $this->connector = new PDO('mysql:host=' . $configs["host"]. ':' . $configs["port"] . ';dbname=' . $configs["dbname"] . ';charset=utf8' , $configs["username"], $configs["password"]);
        }
        catch (PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Permet de préparer et d'exécuter une requête de type simple (sans where)
     */
    private function querySimpleExecute($query) {
        // Utilisation de query pour effectuer une requête
        return $this->connector->query($query);
    }

    /**
     * Permet de préparer, de binder et d'exécuter une requête (select avec where ou insert, update et delete)
     */
    private function queryPrepareExecute($query, $binds) {
        // Utilisation de prepare pour effectuer une requête
        $req = $this->connector->prepare($query);
        foreach ($binds as $bind => $value) {
            $req->bindValue($bind, $value);
        }
        $req->execute();

        // Retourne l'objet de requête
        return $req;
    }

    /**
     * Traite les données pour les retourner en tableau associatif (avec PDO::FETCH_ASSOC)
     */
    private function formatData($req) {
        // Transforme le résultat d'une requête en tableau associatif
        return $req->fetchALL(PDO::FETCH_ASSOC);
    }

    /**
     *
     * TODO: Vide le jeu d'enregistrement
     */
    private function unsetData($req) {
       // $req->closeCursors();
    }

    /**
     * Retourne la liste de tous les enseignants de la BD
     */
    public function getAllTeachers() {
        // Récupère la liste de tous les enseignants de la BD
        $query = 'SELECT * FROM t_teacher';
        $queryResult =  $this->querySimpleExecute($query);

        // Appelle la méthode pour avoir le résultat sous forme de tableau associatif
        $teachers = $this->formatData($queryResult);

        // Retourne tous les enseignants
        return $teachers;
    }

    /**
     * Retourne un enseignant de la BD
     */
    public function getOneTeacher($id) {
        // Récupère les informations pour un enseignant
        $query = 'SELECT * FROM t_teacher WHERE idTeacher = :id';
        $binds = array(':id' => $id);
        $queryResult = $this->queryPrepareExecute($query, $binds);

        // Appelle la méthode pour avoir le résultat sous forme de tableau associatif
        $teacher = $this->formatData($queryResult);

        // Retourne l'enseignant
        return $teacher[0];
    }

    /* 
     * Retourne le nom d'une section en fonction de son id
     */
    public function getOneSection($id) {
        // Récupère les informations pour une section
        $query = 'SELECT * FROM t_section WHERE idSection = :id';
        $binds = array(':id' => $id);
        $queryResult = $this->queryPrepareExecute($query, $binds);

        // Appelle la méthode pour avoir le résultat sous forme de tableau associatif
        $section = $this->formatData($queryResult);

        // Retourne la section
        return $section[0]["secName"];
    }

    /* 
     * Retourne la liste des toutes les sections de la BD
     */
    public function getAllSections() {
        // Récupère la liste de toutes les sections de la BD
        $query = 'SELECT * FROM t_section';
        $queryResult =  $this->querySimpleExecute($query);

        // Appelle la méthode pour avoir le résultat sous forme de tableau associatif
        $sections = $this->formatData($queryResult);

        // Retourne la section
        return $sections;
    }

    /* 
     * Crée et insère un nouveau enseignant dans la BD
     */
    public function insertTeacher($firstName, $lastName, $gender, $nickname, $origin, $sectionID) {
        // Appelle la méthode pour executer la requête
        $query = "INSERT INTO t_teacher (teaFirstname, teaName, teaGender, teaNickname, teaOrigine, fkSection) VALUES (:firstName, :lastName, :gender, :nickName, :origin, :sectionID)";
        $binds = array(':firstName' => $firstName, ':lastName' => $lastName, ':gender' => $gender, ':nickName' => $nickname, ':origin' => $origin, ':sectionID' => $sectionID);
        $this->queryPrepareExecute($query, $binds);
    }

    /* 
     * Met à jour les données d'un enseignant dans la BD en fonction de son ID
     */
    public function updateTeacher($id, $firstName, $lastName, $gender, $nickname, $origin, $sectionID) {
        // Appelle la méthode pour executer la requête
        $query = "UPDATE t_teacher SET teaFirstname = :firstName, teaName = :lastName, teaGender = :gender, teaNickname = :nickName, teaOrigine = :origin, fkSection = :sectionID WHERE idTeacher = :id";
        $binds = array(':firstName' => $firstName, ':lastName' => $lastName, ':gender' => $gender, ':nickName' => $nickname, ':origin' => $origin, ':sectionID' => $sectionID, ':id' => $id);
        $this->queryPrepareExecute($query, $binds);
    }

    /* 
     * Supprime un enseignant dans la BD en fonction de son ID
     */
    public function deleteTeacher($id) {
        // Appelle la méthode pour executer la requête
        $query = "DELETE FROM t_teacher WHERE idTeacher = :id";
        $binds = array(':id' => $id);
        $this->queryPrepareExecute($query, $binds);
    }

    /**
     * Retourne la liste de tous les utilisateurs de la BD
     */
    public function getAllUsers() {
        // Récupère la liste de tous les utilisateurs de la BD
        $query = 'SELECT * FROM t_user';
        $queryResult =  $this->querySimpleExecute($query);

        // Appelle la méthode pour avoir le résultat sous forme de tableau associatif
        $users = $this->formatData($queryResult);

        // Retourne tous les enseignants
        return $users;
    }

    /**
     * Retourne la liste des utilisateurs de la BD correspondants au login donné
     */
    public function getLoggedInUser($username, $password) {
        // Récupère les informations pour un utilisateur
        $query = 'SELECT * FROM t_user WHERE useLogin = :username AND usePassword = :usePassword';
        $binds = array(':username' => $username, ':usePassword' => $password);
        $queryResult = $this->queryPrepareExecute($query, $binds);

        // Appelle la méthode pour avoir le résultat sous forme de tableau associatif
        $user = $this->formatData($queryResult);

        // Retourne l'utilisateur
        return $user;
    }
}
?>