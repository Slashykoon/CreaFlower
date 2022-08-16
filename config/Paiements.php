<?php 

require_once "./config/Database.php";

class Paiements extends Database
{
    private $table;
    private $db;

    public function __construct($table = "paiements")
    {
        $this->table = $table;
        $this->db = new Database();
    }

    // Sélectionner tous les éléments
    public function findAll()
    {
        return $this->db->query("SELECT produit, payment_id, payment_status, payment_amount, payment_currency, payment_date, payer_email
                                    FROM $this->table");
    }


    // Sélectionner un élément par sa ref
    public function find($ref_id = "")
    {
        if ($ref_id) {     
            return $this->db->row("SELECT produit, payment_id, payment_status, payment_amount, payment_currency, payment_date, payer_email
                                    FROM $this->table
                                    WHERE payment_id = :payment_id
                                    LIMIT 1",
                                    array("payment_id" => $ref_id));
        }
    }

    // Ajouter un élément
    public function add($_produit= "",$_payment_id = "",$_payment_status = "",$_payment_amount = "",$_payment_currency= "")
    {
        if ($_produit) {
            return $this->db->prepare("INSERT INTO $this->table (produit, payment_id, payment_status, payment_amount, payment_currency, payment_date, payer_email) 
                                                VALUES (:produit, :payment_id, :payment_status, :payment_amount, :payment_currency, NOW(),'')",
                                                array("produit" => $_produit,"payment_id"=>$_payment_id,"payment_status"=>$_payment_status,"payment_amount"=>$_payment_amount,"payment_currency"=>$_payment_currency ));
        }
    }


    // Modifier un élément
    public function edit($payment_status = "",$payer_email="",$payment_id="")
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
    }

}


?>