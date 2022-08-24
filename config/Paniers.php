<?php 

require_once "./config/Database.php";

class Paniers extends Database
{
    private $table;
    private $db;

    public function __construct($table = "paniers")
    {
        $this->table = $table;
        $this->db = new Database();
    }

    // Sélectionner tous les éléments
    public function findwithPK($id_panier)
    {
        if ($id_panier) {  
            return $this->db->row("SELECT pk_panier, ref_panier,statut,creation_date
                                    FROM $this->table
                                    WHERE pk_panier = :id_panier
                                    LIMIT 1",
                                    array("id_panier" => $id_panier));
        }
    }

    // Ajouter un élément
    public function add($ref_panier = "")
    {
        if (true) {
            return $this->db->prepare("INSERT INTO $this->table (ref_panier) 
                                                VALUES (:ref_panier)",
                                                array("ref_panier" => $ref_panier));
        }
    }


    // Modifier le statut
    public function edit_statut($pk_panier, $statut = "")
    {
        if ($pk_panier) {

            return $this->db->prepare("UPDATE $this->table 
                                        SET statut = :statut
                                        WHERE pk_panier = :pk_panier",
                                        array("pk_panier"=>$pk_panier,"statut"=>$statut));
        }
    }

    // Supprimer un élément
    /*public function delete($_id = "") 
    {
        if ($_id) {
            return $this->db->prepare("DELETE FROM $this->table
                                        WHERE pk_pr=:id",
                                        array("id" => $_id));
        }
    }*/

}


?>