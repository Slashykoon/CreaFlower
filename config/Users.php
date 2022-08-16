<?php // models/Users.php

require_once "./config/Database.php";

class Users extends Database
{
    private $table;
    private $db;

    public function __construct($table = "users")
    {
        $this->table = $table;
        $this->db = new Database();
    }

    // Sélectionner tous les éléments
    public function findAll()
    {
        return $this->db->query("SELECT id, name, fk_panier
                                    FROM $this->table");
    }

    // Sélectionner un élément par son id
    public function find($id = "")
    {
        if ($id) {
            return $this->db->row("SELECT id, name
                                    FROM $this->table
                                    WHERE id = :id
                                    LIMIT 1",
                                    array("id" => $id));
        }
    }

    // Ajouter un élément
    public function add($name = "")
    {
        if ($name) {
            return $this->db->prepare("INSERT INTO $this->table (name)
                                        VALUES (:name)",
                                        array("name" => $name));
        }
    }


    // Modifier un élément
    public function edit($name = "", $id = "")
    {
        if ($name && $id) {
            return $this->db->prepare("UPDATE $this->table
                                        SET name = :name
                                        WHERE id = :id",
                                        array("name" => $name, "id" => $id));
        }
    }

    // Supprimer un élément
    public function delete($id = "") 
    {
        if ($id) {
            return $this->db->prepare("DELETE FROM $this->table
                                        WHERE id=:id",
                                        array("id" => $id));
        }
    }

}


?>