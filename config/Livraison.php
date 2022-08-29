<?php 

require_once "./config/Database.php";

class Livraisons extends Database
{
    private $table;
    private $db;

    public function __construct($table = "livraison")
    {
        $this->table = $table;
        $this->db = new Database();
    }

    // Sélectionner tous les éléments
    public function findwithPKPanier($fk_panier)
    {
        if ($fk_panier) {  
            return $this->db->row("SELECT pk_livraison, fk_panier,type_choisi,nom_relais,adresse_relais,cp_relais,nom_domicile,prenom_domicile,adresse_domicile,cp_domicile,email
                                    FROM $this->table
                                    WHERE fk_panier = :fk_panier
                                    LIMIT 1",
                                    array("fk_panier" => $fk_panier));
        }
    }

    // Ajouter un élément
    public function add_relais_and_domicile($fk_panier,$type_choisi,$nom_relais,$adresse_relais,$cp_relais,$email,$nom_domicile,$prenom_domicile,$adresse_domicile)
    {
        if (true) {
            return $this->db->prepare("INSERT INTO $this->table (fk_panier,type_choisi,nom_relais,adresse_relais,cp_relais,email,nom_domicile,prenom_domicile,adresse_domicile) 
                                                VALUES (:fk_panier,:type_choisi,:nom_relais,:adresse_relais,:cp_relais,:email,:nom_domicile,:prenom_domicile,:adresse_domicile)",
                                                array("fk_panier" => $fk_panier,"type_choisi" => $type_choisi,"nom_relais" => $nom_relais,"adresse_relais" => $adresse_relais,"cp_relais" => $cp_relais,"email" => $email,"nom_domicile" => $nom_domicile,"prenom_domicile" => $prenom_domicile,"adresse_domicile" => $adresse_domicile));
        }
    }

    // Modifier un élément
    public function edit_relais_and_domicile($fk_panier,$type_choisi,$nom_relais,$adresse_relais,$cp_relais,$email,$nom_domicile,$prenom_domicile,$adresse_domicile)
    {
        if ($fk_panier) {

            return $this->db->prepare("UPDATE $this->table 
                                        SET type_choisi = :type_choisi, nom_relais =:nom_relais,adresse_relais=:adresse_relais,cp_relais = :cp_relais,email =:email,nom_domicile=:nom_domicile,prenom_domicile=:prenom_domicile,adresse_domicile=:adresse_domicile
                                        WHERE fk_panier = :fk_panier",
                                        array("fk_panier"=>$fk_panier ,"type_choisi" => $type_choisi,"nom_relais"=>$nom_relais,"adresse_relais"=>$adresse_relais,"cp_relais"=>$cp_relais,"email"=>$email,"nom_domicile"=>$nom_domicile,"prenom_domicile"=>$prenom_domicile,"adresse_domicile"=>$adresse_domicile));
        }
    }


    // Ajouter un élément
    public function add_relais($fk_panier,$type_choisi,$nom_relais,$adresse_relais,$cp_relais,$email)
    {
        if (true) {
            return $this->db->prepare("INSERT INTO $this->table (fk_panier,type_choisi,nom_relais,adresse_relais,cp_relais,email) 
                                                VALUES (:fk_panier,:type_choisi,:nom_relais,:adresse_relais,:cp_relais,:email)",
                                                array("fk_panier" => $fk_panier,"type_choisi" => $type_choisi,"nom_relais" => $nom_relais,"adresse_relais" => $adresse_relais,"cp_relais" => $cp_relais,"email" => $email));
        }
    }
    // Ajouter un élément
    public function add_domicile($fk_panier,$type_choisi,$nom_domicile,$prenom_domicile,$adresse_domicile,$cp_domicile,$email)
    {
        if (true) {
            return $this->db->prepare("INSERT INTO $this->table (fk_panier,type_choisi,nom_domicile,prenom_domicile,adresse_domicile,cp_domicile,email) 
                                                VALUES (:fk_panier,:type_choisi,:nom_domicile,:prenom_domicile,:adresse_domicile,:cp_domicile,:email)",
                                                array("fk_panier" => $fk_panier,"type_choisi" => $type_choisi,"nom_domicile" => $nom_domicile,"prenom_domicile" => $prenom_domicile,"adresse_domicile" => $adresse_domicile,"cp_domicile" => $cp_domicile,"email"=>$email));
        }
    }




    // Modifier le statut
    /*public function edit_statut($pk_panier, $statut = "")
    {
        if ($pk_panier) {

            return $this->db->prepare("UPDATE $this->table 
                                        SET statut = :statut
                                        WHERE pk_panier = :pk_panier",
                                        array("pk_panier"=>$pk_panier,"statut"=>$statut));
        }
    }*/

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