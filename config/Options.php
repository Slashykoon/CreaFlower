<?php 

require_once "./config/Database.php";

class Options extends Database
{
    private $table;
    private $db;

    public function __construct($table = "options")
    {
        $this->table = $table;
        $this->db = new Database();
    }


    // Sélectionner un élément par sa ref
    public function findAllOptionsOfSpecification($id_sp= "")
    {
        if ($id_sp) {     

            return $this->db->prepare("SELECT pk_op,fk_sp,nom_specification,nom_option,prix_add 
                                    FROM specifications INNER JOIN options ON specifications.pk_sp = options.fk_sp
                                    WHERE options.fk_sp = :id_sp",
                                    array("id_sp" => $id_sp));
        }
    }
  
    public function TestIfOptionExist($pk_op= "")
    {
        if ($pk_op) {
            return $this->db->row("SELECT fk_sp,nom_option,prix_add
                                    FROM $this->table
                                    WHERE pk_op = :pk_op
                                    LIMIT 1",
                                    array("pk_op" => $pk_op));
        }
    }



    // Ajouter un élément
    public function add($_fk_sp = "",$_nom_option = "",$_prix_add = "")
    {
        if ($_nom_option) {
            return $this->db->prepare("INSERT INTO $this->table (fk_sp,nom_option,prix_add)
                                        VALUES (:fk_sp,:nom_option,:prix_add)",
                                        array("fk_sp" => $_fk_sp,"nom_option"=>$_nom_option,"prix_add"=>$_prix_add ));
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
    public function delete($_id_sp= "") 
    {
        if ($_id_sp) {
            return $this->db->prepare("DELETE FROM $this->table
                                        WHERE fk_sp=:id",
                                        array("id" => $_id_sp));
        }
    }

}


?>