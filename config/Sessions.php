<?php 

require_once "./config/Database.php";

class Sessions extends Database
{
    private $table;
    private $db;

    public function __construct($table = "sessions")
    {
        $this->table = $table;
        $this->db = new Database();
    }

    // Sélectionner session
    public function find($id_session="")
    {
        if ($id_session) {
            return $this->db->row("SELECT pk_session, fk_panier, id_session
                                    FROM $this->table
                                    WHERE id_session = :id_session
                                    LIMIT 1",
                                    array("id_session" => $id_session));
        }
    }



    // Ajouter un Session
    public function add($id_session, $fk_panier)
    {
        if ($id_session) {
            return $this->db->prepare("INSERT INTO $this->table (fk_panier, id_session) 
                                                VALUES (:fk_panier,:id_session)",
                                                array("fk_panier" => $fk_panier,"id_session" => $id_session));
        }
    }


    // Modifier une Session
    public function edit($id_session="", $fk_panier)
    {
        if (true) {

            return $this->db->prepare("UPDATE $this->table 
                                        SET fk_panier = :fk_panier
                                        WHERE id_session = :id_session",
                                        array("fk_panier"=>$fk_panier,"id_session"=>$id_session));
        }
    }


    // Supprimer une Session 
    public function delete($id_session = "") 
    {
        if ($id_session) {
            return $this->db->prepare("DELETE FROM $this->table
                                        WHERE pk_session=:pk_session",
                                        array("pk_session" => $id_session));
        }
    }

}


?>