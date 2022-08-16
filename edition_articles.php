<!DOCTYPE html>
<html lang="fr">
<!-- HEY ! COUCOU TOI PETIT CURIEUX-->

<head>
    <title>Celine Levrechon Gardiennage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gardiennage d'animaux sur Liverdun et environs">
    <meta name="author" content="Tommy Jeanbille, Celine Levrechon">
    <!--<link href="css/style.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Librairie JQuery pour requete AJAX-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css"
        integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/b0f7e6ecb6.js" crossorigin="anonymous"></script>
</head>


<?php

require_once "config/Users.php";
require_once "config/Produits.php";
require_once "config/Options.php";
require_once "config/Specifications.php";

$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();

$rows_user = $users->findAll();
$rows_produits = $produits->findAll();

?>


<body style="background-color:#ECECEC">
    <div class="mb-2">
        <button class="btn mt-3 btn-info" onclick="location.href='index.php';"> <i class="fas fa-reply"></i>
            RETOUR A LA GALLERIE</button>
    </div>


    <!-- Formulaire ajout -->
    <h1 style="text-align:center;">AJOUT/EDITION ARTICLE</h1>

    <form id="contact-form" name="contact-form" action="mail.php" method="POST" onsubmit="return false"
        data-sb-form-api-token="API_TOKEN">
        <div class="form-row" style="text-align:center;font-size:1.3em;">
            <!-- Nom -->
            <div class="mb-3">
                <label class="form-label" for="nom">Nom</label>
                <input class="form-control shadow" id="nom" name="nom" type="text" placeholder="Nom de l'article"
                    data-sb-validations="required" />
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control shadow " id="description" name="description" type="text"
                    placeholder="Description du produit" style="height: 10rem;white-space:pre-warp;"
                    data-sb-validations="required"></textarea>
            </div>

            <!-- Composition -->
            <div class="mb-3">
                <label class="form-label" for="composition">Composition</label>
                <textarea class="form-control shadow " id="composition" name="composition" type="text"
                    placeholder="Composition du produit" style="height: 10rem;"
                    data-sb-validations="required"></textarea>
            </div>

            <!-- Dimensions -->
            <div class="mb-3">
                <label class="form-label" for="dimensions">Dimensions</label>
                <textarea class="form-control shadow " id="dimensions" name="dimensions" type="text"
                    placeholder="Details des dimensions" style="height: 8rem;"
                    data-sb-validations="required"></textarea>
            </div>

            <!-- Prix -->
            <div class="mb-3">
                <label class="form-label" for="prix">Prix</label>
                <input class="form-control shadow " id="prix" name="prix" type="number" placeholder="Prix TTC" min="1.0"
                    max="1000.0" step=".01" style="" data-sb-validations="required"></input>
            </div>


            <br/>
            <hr/>
            <!-- specification-->
            <!-- Nom specification-->
            <div class="mb-3">
                <label class="form-label" for="nom_sp">Nom specification</label>
                <input class="form-control shadow" id="nom_sp" name="nom_sp" type="text" placeholder="Nom de la specification" data-sb-validations="required" />
            </div>
            <!-- Ajouter specification-->
            
                <button class="btn mt-3 btn-warning" onclick="AddSection_SpecificationOptions()"> <i class="fas fa-edit"></i>
                    Ajouter perso</button>
       
            <!-- Options (generée par code)-->
            <div class="section_options"></div>

            <br/>
         

            <!-- Validation -->
            <div class="d-grid mb-3">
                <button class="btn mt-3 btn-success" style="height: 3rem;" onclick="ActionOnProduct(1,1)"> <i class="	fas fa-edit"></i>
                    Ajouter l'article (avec photos préalablement uploadées)</button>
            </div>



        </div>
    </form>

    <!-- TEST -->
    <form method='post' action='' enctype="multipart/form-data">
        <input type="file" id='files' name="files[]" multiple><br>
        <input type="button" id="submit" value='Upload'>
    </form>
    <div id='preview'></div>

    <!-- TEST -->

    </br>
    </br>
    </br>
    <hr />
    </br>
    </br>
    </br>
    <?php

?>
    <!--TABLEAU EDITION -->
    <h1 style="text-align:center;">TABLEAU RECAPITULATIF ARTICLES</h1>
    <table>
        <tr style="border: solid 2px;text-align:center;">
            <th>Id</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Composition</th>
            <th>Dimensions</th>
            <th>Prix</th>
            <th>Specifications/Options</th>
            <th>Reference</th>
            <th>Pictures</th>
            <th>Editer</th>
            <th>Supprimer</th>
        </tr>
        <?php 
            foreach ($rows_produits as $produit)
            {
        ?>
        <tr style="border: solid 2px;font-size:1.1em;">
            <td style="border: solid 2px;padding:4px;"><?= $produit->pk_pr; ?></td>
            <td style="border: solid 2px;padding:4px;"><?= $produit->nom; ?></td>
            <td style="border: solid 2px;padding:4px;"><?= $produit->description; ?></td>
            <td style="border: solid 2px;padding:4px;"><?= $produit->composition; ?></td>
            <td style="border: solid 2px;padding:4px;"><?= $produit->dimension; ?></td>
            <td style="border: solid 2px;padding:4px;"><?= $produit->prix; ?>€</td>
            <td style="border: solid 2px;padding:4px;">
            <?php 
                $rows_specifications=$specifications->GetAllSpecificationOfProduct($produit->pk_pr);
                if(!empty($rows_specifications))
                {
                    foreach ($rows_specifications as $specification)
                    {
                        $i=0;
                        echo "<hr/>";
                        print_r($specification["nom_specification"]);
                        echo "<hr/>";
                        $rows_options = $options->findAllOptionsOfSpecification($specification['pk_sp']);
                        
                        foreach ($rows_options as $specif_options)
                        {
                            print_r($rows_options[$i]["nom_option"]);
                            print_r(" : ");
                            print_r($rows_options[$i]["prix_add"]);
                            print_r("€");
                            print_r("<br/>");
                            $i=$i+1;
                        }
                    }
                }
                else
                {
                    echo "Aucune specification";
                }
            ?>
            </td>
            <td style="border: solid 2px;"><?= $produit->ref; ?></td>
            <td style="border: solid 2px;">
                <?php
                    $dir = "img_produits/". $produit->ref ."/*";
                    // Ouvre le repertoire et recupère toute les photos
                    foreach(glob($dir) as $file)
                    {
                        echo '<img src='.$file.' height=200 width=240 />';
                    }
                ?>
            </td>
            <td style="border: solid 2px;"><button class="btn btn-warning"
                    onclick="ActionOnProduct(<?= $produit->pk_pr; ?>,2)"><i class="fas fa-marker"></i> Editer</button></td>
            <td style="border: solid 2px;"><button class="btn btn-danger"
                    onclick="ActionOnProduct(<?= $produit->pk_pr; ?>,3)"><i class="fas fa-trash"></i> Supprimer</button>
            </td>
        </tr>

        <?php } ?>
    </table>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Resultat de l'action</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="exampleModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    </br>
    </br>
    </br>

</body>

<script>

var dict_objsp_dict_arropt= new Object();
var nb_specif_added = 0;
var name_opt ;
var prixadd_opt ;
var option_values ;

$('#exampleModalCenter').on('hidden.bs.modal', function() {
    location.reload();
})


function AddSection_SpecificationOptions(){

    var dict_Init = new Object();
    dict_Init["specification"] = "";
    dict_Init["option"] = new Array();
    dict_Init["prix"] = new Array();

    nb_specif_added++;
    //alert(JSON.stringify(dict_objsp_dict_arropt));

    name_opt = "name_opt_";
    prixadd_opt = "prixadd_opt_";
    option_values = "option_values_";
    name_opt +=  String(nb_specif_added);
    prixadd_opt +=  String(nb_specif_added);
    option_values +=  String(nb_specif_added);
     
    //Ajouter les rubriques
    $('.section_options').append("<h4>"+$('input[name=nom_sp]').val()+"</h4>");
    $('.section_options').append("<br/>");
    //
    $('.section_options').append("<label for='name_opt'>Option :</label>");
    $('.section_options').append("<input class='form-control shadow' id='name_opt' name='name_opt' type='text' placeholder='Nom de loption' />");
    $('.section_options').append("<label class='form-label' for='prixadd_opt'>Prix additionel :</label>");
    $('.section_options').append("<input class='form-control shadow ' id='prixadd_opt' name='prixadd_opt' type='number' placeholder='Prix TTC' min='0.0' step='.01'></input>");
    //
    $('.section_options').append("<button class='btn mt-3 btn-info' onclick='AddOptionValue("+nb_specif_added+",$("+name_opt+").val(),$("+prixadd_opt+").val())'> <i class='fas fa-edit'></i>Ajouter option</button>");
    //
    $('.section_options').append("<div class='' id='option_values'></div>");
    $('.section_options').append("<hr/>");

    //Renomme les id
    $("#name_opt").attr("id", name_opt);
    $("#prixadd_opt").attr("id", prixadd_opt);
    $("#option_values").attr("id", option_values);

    dict_objsp_dict_arropt[String(nb_specif_added)]=dict_Init;
    dict_objsp_dict_arropt[String(nb_specif_added)]["specification"]=$('input[name=nom_sp]').val();

    alert(JSON.stringify(dict_objsp_dict_arropt));
}

function AddOptionValue(nb_sp_add,_name_opt,_prix_opt) {
    alert(nb_sp_add);
    dict_objsp_dict_arropt[String(nb_sp_add)]["option"].push(_name_opt);
    dict_objsp_dict_arropt[String(nb_sp_add)]["prix"].push(_prix_opt);
    alert(JSON.stringify(dict_objsp_dict_arropt));
    $("#option_values_"+nb_sp_add).append("<a>" + _name_opt +" : " + _prix_opt + "€ | </a>");
}


//Upload des photos via php dans un dossier
$(document).ready(function() {

    $('#submit').click(function() {

        //Utilisation du formdata pour passer des files
        var form_data = new FormData();

        // Read selected files
        var totalfiles = document.getElementById('files').files.length;

        for (var index = 0; index < totalfiles; index++) {
            form_data.append("files[]", document.getElementById('files').files[index]);
        }
        
        // AJAX request
        $.ajax({
            url: 'upload.php',
            type: 'post',
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                for (var index = 0; index < response.length; index++) {
                    var src = response[index];
                    // Add img element in <div id='preview'>
                    $('#preview').append('<img src="' + src +
                        '" width="200px;" height="200px">');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });

    });

});


function ActionOnProduct(selVar, cde_action) {

    formData = {
        'id_article': selVar,
        'cde_action': cde_action,
        'nom': $('input[name=nom]').val(),
        'description': $('textarea[name=description]').val(),
        'composition': $('textarea[name=composition]').val(),
        'dimensions': $('textarea[name=dimensions]').val(),
        'prix': $('input[name=prix]').val(),
        'specif_opt': JSON.stringify(dict_objsp_dict_arropt)
    };

    $.ajax({
        type: "POST",
        url: "Interface_edition.php",
        dataType: 'json',
        data: formData,
        success: function(data, textStatus, jqXHR) {
            //alert(data.ret);
            $('#exampleModalBody').text(data.ret);
            $('#exampleModalCenter').modal('show')
            //$('#status').text(data.message);
            //if (data.code) //Si mail envoyé alors reset
            //$('#contact-form').closest('form').find("input[type=text], textarea").val("");
            //$('#SuccessMessage').removeClass("d-none");;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(textStatus);
        }
    });
}
</script>


</html>