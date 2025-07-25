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
require_once "config/Rubriques.php";

$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();
$rubriques = new Rubriques();

$rows_user = $users->findAll();
$rows_produits = $produits->findAll();
$rows_rubriques = $rubriques->findAll();

?>


<body style="background-color:#ECECEC">
    <div class="mb-2">
        <button class="btn mt-3 btn-info" onclick="location.href='administration.php';"> <i class="fas fa-reply"></i>
            RETOUR A LA VUE ADMIN</button>
    </div>


    <!-- Formulaire ajout -->
    <h1 style="text-align:center;">AJOUT/EDITION ARTICLE</h1>

    <div class="container">
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

                <!-- Rubrique -->
                <div class="mb-3">
                    <label class="form-label" >Choix rubrique</label>
                    <select class="form-select" name="select_rubrique" aria-label="Choix rubrique">
                        <?php
                        if($rows_rubriques)
                        {
                            foreach ($rows_rubriques as $rubrique): 
                        ?>
                        <option value="<?= $rubrique->pk_rubrique;?>"><?= $rubrique->nom;?></option>
                        <?php endforeach; }?>
                    </select>
                </div>

                <br/>
                <hr/>

                <!-- specification-->
                <!-- Nom specification-->
                <div class="mb-3">
                    <div class="row align-items-end justify-content-start">
                        <div class="col-6">
                            <label class="form-label" for="nom_sp">Nom specification</label>
                            <input class="form-control shadow" id="nom_sp" name="nom_sp" type="text" placeholder="Nom de la specification" data-sb-validations="required" />
                        </div>
                        <div class="col-4">
                            <label for="type_specif">Type</label>
                            <select name="type_specif" id="type_specif">
                                <option value="0">Selection</option>
                                <option value="1">Saisie libre</option>
                                <option value="2">Image</option>
                                <option value="3">PDF(en dev)</option>
                                <option value="4">Date</option>
                            </select>
                        </div>
                        <div class="col-2 ">
                        <!-- Ajouter specification-->
                            <button class="btn btn-warning" onclick="AddSection_SpecificationOptions()"> <i class="fas fa-edit"></i>Ajouter perso</button>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row align-items-end">
                        <!-- Options (generée par code)-->
                        <div class="section_options"></div>
                    </div>
                </div>
                <br/>
            

                <!-- Validation -->
                <div class="d-grid mb-3">
                    <button class="btn mt-3 btn-success btn-add-article" style="height: 3rem;display:block;" onclick="ActionOnProduct(1,1)"> <i class="	fas fa-edit"></i>
                        Ajouter l'article (avec photos préalablement uploadées)</button>
                    <button class="btn mt-3 btn-success btn-edit-article" style="height: 3rem;display:none;" onclick="ActionOnProduct(1,4)"> <i class="	fas fa-edit"></i>
                        Modifier l'article</button>
                </div>

            </div>
        </form> 
                        

        <!-- Upload photos -->
        <form method='post' action='' enctype="multipart/form-data">
            <input type="file" id='files' name="files[]" multiple><br>
            <input type="button" id="submit" value='Upload'>
        </form>
        <div id='preview'></div>

    </div><!--container-->

    <hr/>
    </br>
    </br>

    <!-- Formulaire ajout rubrique-->
    <h1 style="text-align:center;">AJOUT RUBRIQUE</h1>
    <div class="container">
        <form id="contact-form" name="contact-form" action="mail.php" method="POST" onsubmit="return false"
            data-sb-form-api-token="API_TOKEN">
            <div class="form-row" style="text-align:center;font-size:1.3em;">
                <!-- Rubriques -->
                <div class="mb-3">
                    <label class="form-label" for="nom_rubrique">Rubrique</label>
                    <input class="form-control shadow" id="nom_rubrique" name="nom_rubrique" type="text" placeholder="Nom de la rubrique"
                        data-sb-validations="required" />
                </div>
                <!-- Dimensions -->
                <div class="mb-3">
                    <label class="form-label" for="description_rubrique">Description</label>
                    <textarea class="form-control shadow " id="description_rubrique" name="description_rubrique" type="text"
                        placeholder="Details des dimensions" style="height: 6rem;"
                        data-sb-validations="required"></textarea>
                </div>
                <!-- Validation ajout -->
                <div class="d-grid mb-3">
                    <button class="btn mt-3 btn-success btn-rub" style="height: 3rem;" onclick="ActionOnRubriques(1)"> <i class="	fas fa-edit"></i>
                        Ajouter la rubrique</button>

                </div>
            </div>
        </form>
    </div><!--container rubrique-->

    </br>
    <hr/>
    </br>
    </br>
    <?php

?>


    <!--TABLEAU EDITION -->
    <h1 style="text-align:center; margin-left: auto; margin-right: auto;">TABLEAU RECAPITULATIF ARTICLES</h1>
    <table style=" margin-left: auto; margin-right: auto;">
        <tr style="border: solid 2px;text-align:center;">
            <th>Id</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Composition</th>
            <th>Dimensions</th>
            <th>Prix</th>
            <th>Specifications/Options</th>
            <th>Reference</th>
            <th>Rubrique</th>
            <th>Pictures</th>
            <th>Editer</th>
            <th>Supprimer</th>
        </tr>
        <?php 
            foreach ($rows_produits as $produit)
            {
        ?>
        <tr style="border: solid 2px;font-size:0.9em;">
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
                        print_r("<b>".$specification["nom_specification"]."</b>");
                        echo "<br/>";
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
                $row_rubrique=$rubriques->find($produit->fk_rubrique);
                print_r($row_rubrique['nom']);
            ?>
            </td>
            <td style="border: solid 2px;">
                <?php
                    $dir = "img_produits/". $produit->ref ."/*";
                    // Ouvre le repertoire et recupère toute les photos
                    foreach(glob($dir) as $file)
                    {
                        echo '<img src='.$file.' height=80 width=90 />';
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

var edit_mode=1;
/*$('.btn-rub').prop('disabled', true);*/


$('#exampleModalCenter').on('hidden.bs.modal', function() {
    //location.reload();
})


function AddSection_SpecificationOptions(){

    var dict_Init = new Object();
    dict_Init["specification"] = "";
    dict_Init["option"] = new Array();
    dict_Init["prix"] = new Array();

    nb_specif_added++;
   

    name_opt = "name_opt_";
    prixadd_opt = "prixadd_opt_";
    option_values = "option_values_";
    name_opt +=  String(nb_specif_added);
    prixadd_opt +=  String(nb_specif_added);
    option_values +=  String(nb_specif_added);

    //Ajouter les rubriques
    $('.section_options').append("<h4>"+$('input[name=nom_sp]').val()+"</h4>");
    $('.section_options').append("(");
    $('.section_options').append($('select[name=type_specif] :selected').text());
    $('.section_options').append(")");
    $('.section_options').append("<br/>");

    //console.log(nb_specif_added);

    //probleme ici
    //if($('select[name=type_specif]').val() == 0)
    //{
        $('.section_options').append("<label for='name_opt'>Option :</label>");
        $('.section_options').append("<input class='form-control shadow' id='name_opt' name='name_opt' type='text' placeholder='Nom de loption' />");
        $('.section_options').append("<label class='form-label' for='prixadd_opt'>Prix additionel :</label>");
        $('.section_options').append("<input class='form-control shadow ' id='prixadd_opt' name='prixadd_opt' type='number' placeholder='Prix TTC' min='0.0' step='.01'></input>");

        //
        $('.section_options').append("<button class='btn mt-3 btn-info' onclick='AddOptionValue("+nb_specif_added+",$("+name_opt+").val(),$("+prixadd_opt+").val())'> <i class='fas fa-edit'></i>Ajouter option</button>");
        //
        $('.section_options').append("<div class='' id='option_values'></div>");
        $('.section_options').append("<hr/>");
    //}
    //else{
        /*$('.section_options').append("<label for='name_opt'>Option :</label>");
        $('.section_options').append("<input class='form-control shadow' id='name_opt' name='name_opt' type='text' placeholder='Nom de loption' />");
        $('input[name=name_opt]').val($('input[name=nom_sp]').val()); //add
        $('input[name=name_opt]').attr('disabled', 'disabled');
        //
        $('.section_options').append("<label class='form-label' for='prixadd_opt'>Prix additionel :</label>");
        $('.section_options').append("<input class='form-control shadow ' id='prixadd_opt' name='prixadd_opt' type='number' placeholder='Prix TTC' min='0.0' step='.01'></input>");
        $('input[name=prixadd_opt]').val(0.0); //add
        $('input[name=prixadd_opt]').attr('disabled', 'disabled');

        $('.section_options').append("<div class='' id='option_values'></div>");
        $('.section_options').append("<hr/>");
        //
        AddOptionValue(nb_specif_added,$("+name_opt+").val(),$("+prixadd_opt+").val());
        //dict_objsp_dict_arropt[String(nb_specif_added)]["option"].push($("+name_opt+").val());
        //dict_objsp_dict_arropt[String(nb_specif_added)]["prix"].push($("+prixadd_opt+").val());
        //$("#option_values_"+String(nb_specif_added)).append("<a>" + $("+name_opt+").val() +" : " + $("+prixadd_opt+").val() + "€ | </a>");*/
    //}


    //Renomme les id
    $("#name_opt").attr("id", name_opt);
    $("#prixadd_opt").attr("id", prixadd_opt);
    $("#option_values").attr("id", option_values);

    dict_objsp_dict_arropt[String(nb_specif_added)]=dict_Init;
    dict_objsp_dict_arropt[String(nb_specif_added)]["specification"]=$('input[name=nom_sp]').val();
    dict_objsp_dict_arropt[String(nb_specif_added)]["type"]=$('select[name=type_specif]').val();



    //console.log(dict_objsp_dict_arropt);
    //alert(JSON.stringify(dict_objsp_dict_arropt));
}

function AddOptionValue(nb_sp_add,_name_opt,_prix_opt) {
    //alert(nb_sp_add);
    dict_objsp_dict_arropt[String(nb_sp_add)]["option"].push(_name_opt);
    dict_objsp_dict_arropt[String(nb_sp_add)]["prix"].push(_prix_opt);
    //alert(JSON.stringify(dict_objsp_dict_arropt));
    //console.log(dict_objsp_dict_arropt);
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
            console.log(document.getElementById('files').files[index].name);
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
                    $('#preview').append('<img src="' + src + '" width="200px;" height="200px">');
                    $('#preview').append("<select name='position_img_" + index + "' style='width:50px;height:200px;margin-left:0px;margin-right:5px;' id = '" + src +"'>");
                    for (var n = 1; n <= 20; n++) {
                        $("select[name=position_img_"+ index +"]").append("<option value="+ n +">"+ n +"</option>");
                        
                    }
                    $('#preview').append("</select>");
                }


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });

    });

});


function ActionOnProduct(selVar, cde_action) {
    //console.log(dict_objsp_dict_arropt);
    var array_keyname_valuepos = {};
    $("select[name*='position_img']").each(function (i, el) {
        //It'll be an array of elements
        array_keyname_valuepos[el.name]=[el.id ,$(el).val()];
    });
    console.log(array_keyname_valuepos);

    formData = {
        'id_article': selVar,
        'cde_action': cde_action,
        'nom': $('input[name=nom]').val(),
        'description': $('textarea[name=description]').val(),
        'composition': $('textarea[name=composition]').val(),
        'dimensions': $('textarea[name=dimensions]').val(),
        'prix': $('input[name=prix]').val(),
        'rubrique': $('select[name=select_rubrique]').val(),
        'specif_opt': JSON.stringify(dict_objsp_dict_arropt),
        'key_arrImgNameAndPos': JSON.stringify(array_keyname_valuepos)
    };

    $.ajax({
        type: "POST",
        url: "Interface_edition.php",
        dataType: 'json',
        data: formData,
        success: function(data, textStatus, jqXHR) {
            $('#exampleModalBody').text(data.ret);
            $('#exampleModalCenter').modal('show')
            if (cde_action == 2) //chargement pour modification
            {
                //console.log(data.datafromdb);
                //edit_mode = 2;

                $(".btn-edit-article").attr("onclick","ActionOnProduct(" + data.datafromdb.pk_pr + ",4)");

                $('.btn-edit-article').css('display', 'block');
                $('.btn-add-article').css('display', 'none');
                
                $('input[name=nom]').val(data.datafromdb.nom.replace(/(<|&lt;)br\s*\/*(>|&gt;)/g,' '));
                $('textarea[name=description]').val(data.datafromdb.description.replace(/(<|&lt;)br\s*\/*(>|&gt;)/g,' '));
                $('textarea[name=composition]').val(data.datafromdb.composition.replace(/(<|&lt;)br\s*\/*(>|&gt;)/g,' '));
                $('textarea[name=dimensions]').val(data.datafromdb.dimension.replace(/(<|&lt;)br\s*\/*(>|&gt;)/g,' '));
                $('input[name=prix]').val(data.datafromdb.prix);
                $('select[name=select_rubrique]').val(data.datafromdb.fk_rubrique);

            }
            if (cde_action == 4) //execution modification
            {
                //edit_mode = 1;
                console.log(formData);
                $('.btn-edit-article').css('display', 'none');
                $('.btn-add-article').css('display', 'block');

            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(textStatus);
        }
    });
}


function ActionOnRubriques(cde_action) {

formData = {
    'nom_rubrique': $('input[name=nom_rubrique]').val(),
    'description_rubrique': $('textarea[name=description_rubrique]').val(),
    'cde_action': cde_action
};

$.ajax({
    type: "POST",
    url: "Interface_edition_rubriques.php",
    dataType: 'json',
    data: formData,
    success: function(data, textStatus, jqXHR) {
        $('#exampleModalBody').text(data.ret);
        $('#exampleModalCenter').modal('show')
    },
    error: function(jqXHR, textStatus, errorThrown) {
        alert(textStatus);
    }
});
}

</script>


</html>