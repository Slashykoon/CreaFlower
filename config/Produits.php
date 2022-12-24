<?php 

require_once "./config/Database.php";

class Produits extends Database
{
    private $table;
    private $db;

    public function __construct($table = "produits")
    {
        $this->table = $table;
        $this->db = new Database();
    }

    // Sélectionner tous les éléments
    public function findAll()
    {
        return $this->db->query("SELECT pk_pr,nom,description,composition,dimension,prix,ref,fk_rubrique
                                    FROM $this->table");
    }
    // Sélectionner tous les elements dune rubrique
    public function findAll_With_RubriqueFK($fk_rub)
    {
        if ($fk_rub) {     

            return $this->db->prepare("SELECT pk_pr,nom,description,composition,dimension,prix,ref,fk_rubrique
                                        FROM $this->table
                                        WHERE fk_rubrique = :fk_rubrique",
                                        array("fk_rubrique" => $fk_rub));
        }
    }

    // Sélectionner un élément par sa ref
    public function find($ref_id = "")
    {
        if ($ref_id) {     
            return $this->db->row("SELECT pk_pr,nom,description,composition,dimension,prix,ref,fk_rubrique
                                    FROM $this->table
                                    WHERE ref = :ref
                                    LIMIT 1",
                                    array("ref" => $ref_id));
        }
    }

    // Sélectionner un élément par sa ref
    public function findwithPK($pk_id = "")
    {
        if ($pk_id) {     
            return $this->db->row("SELECT pk_pr,nom,description,composition,dimension,prix,ref,fk_rubrique
                                    FROM $this->table
                                    WHERE pk_pr = :pk_pr
                                    LIMIT 1",
                                    array("pk_pr" => $pk_id));
        }
    }

    // Ajouter un élément
    public function add($_nom = "",$_description = "",$_composition = "",$_dimension = "",$_prix= 0.0,$_ref="",$_rubrique="")
    {
        if ($_nom) {
            return $this->db->prepare("INSERT INTO $this->table (nom,description,composition,dimension,prix,ref,fk_rubrique)
                                        VALUES (:nom,:description,:composition,:dimension,:prix,:ref,:fk_rubrique)",
                                        array("nom" => $_nom,"description"=>$_description,"composition"=>$_composition,"dimension"=>$_dimension,"prix"=>$_prix,"ref"=>$_ref,"fk_rubrique"=>$_rubrique ));
        }
    }


    // Modifier un élément
    public function edit($_id ,$_nom ,$_description,$_composition ,$_dimension ,$_prix,$_rubrique)
    {
        if ($_nom && $_id) {
            return $this->db->prepare("UPDATE $this->table
                                        SET nom = :nom,description = :description,composition = :composition,dimension = :dimension,prix = :prix , fk_rubrique=:fk_rubrique
                                        WHERE pk_pr = :id",
                                        array("nom" => $_nom, "description"=>$_description,"composition"=>$_composition,"dimension"=>$_dimension,"prix"=>$_prix,"fk_rubrique"=>$_rubrique , "id" => $_id));
        }
    }

    // Supprimer un élément
    public function delete($_id = "") 
    {
        if ($_id) {
            return $this->db->prepare("DELETE FROM $this->table
                                        WHERE pk_pr=:id",
                                        array("id" => $_id));
        }
    }

}


?>