<?php 

require_once "./config/Database.php";

class Specifications_Panier extends Database
{
    private $table;
    private $db;

    public function __construct($table = "specifications_panier")
    {
        $this->table = $table;
        $this->db = new Database();
    }


    // Sélectionner un élément par sa ref => a revoir id sp est bizarre
   /* public function findAllOptionsOfSpecification($id_sp= "")
    {
        if ($id_sp) {     

            return $this->db->prepare("SELECT pk_specification_panier,fk_produit_panier,fk_option,
                                    FROM specifications_panier INNER JOIN options ON specifications_panier.fk_option = options.pk_op
                                    WHERE options.pk_op = :id_sp",
                                    array("id_sp" => $id_sp));
        }
    }*/
  
    // Sélectionner un élément par sa ref => a tester
    public function findAllOptionsOfProdPanier($fk_prod_panier= "")
    {
        if ($fk_prod_panier) {     

            return $this->db->prepare("SELECT pk_specification_panier,fk_produit_panier,fk_option,txt_saisi
                                    FROM $this->table 
                                    WHERE fk_produit_panier = :fk_prod_panier",
                                    array("fk_prod_panier" => $fk_prod_panier));
        }
    }
      

    // Ajouter un élément depuis option select ou input
    public function addChosenOption($fk_produit_panier = "", $fk_option = "",$txt_saisi="")
    {
        if ($fk_produit_panier) {
            return $this->db->prepare("INSERT INTO $this->table (fk_produit_panier,fk_option,txt_saisi)
                                        VALUES (:fk_produit_panier,:fk_option,:txt_saisi)",
                                        array("fk_produit_panier" => $fk_produit_panier,"fk_option"=>$fk_option,"txt_saisi"=>$txt_saisi));
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

    // Supprimer les options associés à une specification
    /*public function delete($_id_sp= "") 
    {
        if ($_id_sp) {
            return $this->db->prepare("DELETE FROM $this->table
                                        WHERE fk_sp=:id",
                                        array("id" => $_id_sp));
        }
    }*/

}


?>