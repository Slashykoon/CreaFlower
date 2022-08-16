<?php // class Database.php


class Database
{
    private $pdo = null;

    public function __construct()
    {
        $this->db_name = "bdd_website";
        $this->db_user = "root";
        $this->db_pass = "";
        $this->db_host = "localhost";
        $this->db_port = 3306;
    }

    // Connexion à la BDD
    private function getPDO()
    {
        if ($this->pdo === null) 
        {
            try {
                // DSN
                $pdo = new PDO("mysql:dbname=" . $this->db_name . ";host=" . $this->db_host . ";port=". $this->db_port, $this->db_user, $this->db_pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->exec("SET CHARACTER SET utf8");

                $this->pdo = $pdo;

            } catch (PDOException $e) {
                echo 'Pas de connexion avec la BDD : ' . $e->getMessage();
                die();
            }
        }
        return $this->pdo;
    }

    // Requête simple
    public function query($statement)
    {
        $req  = $this->getPDO()->query($statement);
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    // Requête préparée
    public function prepare($statement, $attributes = array())
    {
        $query  = explode(" ", $statement);
        // Récupération du 1èr mot
        $option = strtolower(array_shift($query));
        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);

        if ($option == "select" || $option == "show") {

            if ($req->rowCount() > 0) {
                /*$data = $req->fetchAll(PDO::FETCH_CLASS);*/
                $data = $req->fetchAll();
                return $data;
            }

        } elseif ($option == "insert" || $option == "update" || $option == "delete") {

            if ($option == "insert") {
                // Valeur id inséré
                return $this->getPDO()->lastInsertId();
            } else {
                return $req->rowCount();
            }

        }
    }

    // Une seule ligne
    public function row($statement, $attributes = array())
    {
        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return $data;
    }


}



?>