<?php 

require_once "./config/Database.php";

class Specifications extends Database
{
    private $table;
    private $db;

    public function __construct($table = "specifications")
    {
        $this->table = $table;
        $this->db = new Database();
    }


    // Sélectionner un élément par sa ref
    public function GetAllSpecificationOfProduct($id_prod = "")
    {
        if ($id_prod) {     

            return $this->db->prepare("SELECT pk_sp,fk_pr,nom_specification
                                        FROM specifications INNER JOIN produits ON specifications.fk_pr = produits.pk_pr
                                        WHERE specifications.fk_pr = :id_prod",
                                        array("id_prod" => $id_prod));
        }
    }

    // Ajouter un élément
    public function add($_idprod = "", $_nom = "")
    {
        if ($_nom) {
            return $this->db->prepare("INSERT INTO $this->table (fk_pr,nom_specification)
                                        VALUES (:fk_pr,:nom_specification)",
                                        array("fk_pr" => $_idprod,"nom_specification"=>$_nom));
        }
    }


    // Modifier un élément
    /*public function edit($_id = "",$_nom = "",$_description = "",$_composition = "",$_dimension = "",$_prix= 0.0,$_ref="")
    {
        if ($_nom && $_id) {
            return $this->db->prepare("UPDATE $this->table
                                        SET nom = :nom
                                        WHERE id = :id",
                                        array("nom" => $_nom, "id" => $_id));
        }
    }*/

    // Supprimer les specifs associés à un produit
    public function delete($_id_prod = "") 
    {
        if ($_id_prod) {
            return $this->db->prepare("DELETE FROM $this->table
                                        WHERE fk_pr=:id",
                                        array("id" => $_id_prod));
        }
    }

}


?>