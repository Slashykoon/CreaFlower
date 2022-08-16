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


    // Modifier un élément
    /*public function edit($payment_status = "",$payer_email="",$payment_id="")
    {
        if ($payment_id) {

            return $this->db->prepare("UPDATE $this->table 
                                        SET payment_status = :payment_status, payer_email =:payer_email
                                        WHERE payment_id = :payment_id",
                                        array("payment_status"=>$payment_status ,"payment_id" => $payment_id,"payer_email"=>$payer_email));
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
    }*/

}


?>