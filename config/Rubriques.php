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
    public function findAllProduct_With_Rubrique($pk_rubrique)
    {
        if ($pk_rubrique) {     

            return $this->db->prepare("SELECT pk_rubrique,fk_produit,nom_description
                                        FROM $this->table
                                        WHERE fk_produit = :pk_rubrique",
                                        array("pk_rubrique" => $pk_rubrique));
        }
    }



    // Ajouter un élément
    /*public function add($fk_produit, $fk_panier, $quantity)
    {
        if (true) {
            return $this->db->prepare("INSERT INTO $this->table (fk_produit,fk_panier,quantity) 
                                                VALUES (:fk_produit,:fk_panier,:quantity)",
                                                array("fk_produit" => $fk_produit,"fk_panier" => $fk_panier,"quantity" => $quantity));
        }
    }*/


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