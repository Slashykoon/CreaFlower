<?php 

require_once "./config/Database.php";

class Rubriques extends Database
{
    private $table;
    private $db;

    public function __construct($table = "rubriques")
    {
        $this->table = $table;
        $this->db = new Database();
    }


    // Sélectionner session
    /*public function findOne_With_ProduitID($pk_prod="")
    {
        if ($pk_prod) {
            return $this->db->row("SELECT pk_produit_panier, fk_produit, fk_panier, quantity
                                    FROM $this->table
                                    WHERE fk_produit = :pk_prod
                                    LIMIT 1",
                                    array("pk_prod" => $pk_prod));
        }
    }*/

    // Sélectionner un élément par sa ref
    /*public function findAllProduct_With_RubriqueName($name)
    {
        if ($name) {     

            return $this->db->prepare("SELECT pk_rubrique,nom,description
                                        FROM $this->table
                                        WHERE nom = :nom",
                                        array("nom" => $name));
        }
    }*/

    // Sélectionner un pk par son non de rubrique
    public function GetPKofRubriqueName($name)
    {
        if ($name) {     

            return $this->db->row("SELECT pk_rubrique,nom,description
                                    FROM $this->table
                                    WHERE nom = :nom
                                    LIMIT 1",
                                    array("nom" => $name));
        }
    }
    
    // Sélectionner un élément par sa ref
    public function findAll()
    {   
        return $this->db->query("SELECT pk_rubrique,nom,description
                                    FROM $this->table");
    }


    // Ajouter une rubrique
    public function add($nom,$description="")
    {
        if ($nom) {
            return $this->db->prepare("INSERT INTO $this->table (nom,description) 
                                                VALUES (:nom,:description)",
                                                array("nom" => $nom,"description" => $description));
        }
    }


    // Modifier un élément
    /*public function edit($fk_produit = "",$fk_panier="",$quantity="")
    {
        if ($fk_panier) {
            return $this->db->prepare("UPDATE $this->table 
                                        SET quantity = :quantity
                                        WHERE fk_panier = :fk_panier AND fk_produit=:fk_produit",
                                        array("fk_produit"=>$fk_produit ,"fk_panier" => $fk_panier,"quantity"=>$quantity));
        }
    }*/

    // Supprimer un élément
    /*public function DeleteAllFromPanier($panier_id = "") 
    {
        if ($panier_id) {
            return $this->db->prepare("DELETE FROM $this->table
                                        WHERE fk_panier=:panier_id",
                                        array("panier_id" => $panier_id));
        }
    }*/

}


?>