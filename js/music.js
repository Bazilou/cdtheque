var listCat = [];
var idCat = 1;

function Categorie(nom, id) {
    this.nom = nom;
    this.idCat = id || idCat++;
}

var listCD = [];

var idCd = 1;
function Piste(piste, nom, temps) {
    this.idP = piste;
    this.nom = nom;
    this.tps = temps;
}

function Disque(titre, id) {
    this.idCd = id || idCd++;
    this.titre = titre;
    this.categories = [];
    this.pistes = [];
}

var CDtheque = [];

function    displayTabCat() {

    var disp = '';
    for (var i = 0; i < listCat.length; i++) {

        disp    +="<br><br>";
        disp    +='<table class="table table-striped" data-id='+listCat[i].idCat+'>';
        disp	+="<tr>";
        disp	+="<td colspan=3><h3>#"+listCat[i].idCat +" "+listCat[i].nom;
        disp	+=' <a class="btn btn-primary subCd" role="button">';
        disp	+='<span class="glyphicon glyphicon-trash">';
        disp	+='</span></a></h3></td>';
        disp	+="</tr>";
        disp	+="</table>";

    }

    $('#mesCateg').html(disp);

    var html = '<table class="table table-stripped">' +
        '<tr>' +
            '<th>Nom</th>' +
            '<th>Suppr</th>' +
        '</tr>';

    for (var i = 0 ; i < listCat.length ; i++) {
        html += '<tr data-id="' + listCat[i].idCat + '" >' +
            '<td>' + listCat[i].nom + '</td>' +
            '<td>' + '<button type="button" class="btn btn-danger subCat" >' +
                '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>' + '</button>' +
            '</td>';
    }
    html += '</table>';

    $('#listCat').html(html);
    $('.my_select').select2();
}

function    deleteCategorie(id) {
    cconsole.log('coucou');
    for (var i = 0; i < listCat.length; i++) {
        console.log(listCat[i].id);
        if (listCat[i].id == id) {
            console.log('id : ' + id);
            $.post(
                "cdtheque_api.php",
                { id_cat : id },
                function( cat_id ) {
                    listCat.splice(i, 1);
                    $('.my_select').secat_id2();

            }).fail(function() {
                alert('error');
            });
            break;
        }
    }
}

function    findSelectCateg(id) {
    var select = '<select class="form-control my_select" name="' + id + ' ">';
    for (var i = 0 ; i < listCat.length ; i++) {
        select += '<option value="' + listCat[i].idCat + '">' +
            listCat[i].nom + '</option>';
    }
    select += '</select>';
    return (select);
}

function    displayTabCd() {
    var disp1 = '';
    for (var i = 0; i < listCD.length; i++) {

        disp1   +="<br><br>";
        disp1   +='<table class="table table-striped" data-id='+listCD[i].idCd+'>';
        disp1	+="<tr>";
        disp1	+="<td colspan=3><h3>#"+listCD[i].idCd +" "+listCD[i].titre;
        disp1	+='</h3></td>';
        disp1   +='<td colspan=3>';
        disp1   += findSelectCateg(listCD[i].idCd);
        disp1   += ' <a class="btn btn-primary subCd" role="button">';
        disp1   +='<span class="glyphicon glyphicon-trash">';
        disp1	+='</span></a></td>';
        disp1	+="</tr>";
        // entete du tableau
        disp1	+="<tr>";
        disp1	+="<th>Piste</th><th>Titre</th><th>Temps</th>";
        disp1	+="</tr>";
        disp1	+="</table>";

    }
    return (disp1);
}

function    deleteCd(id) {
    for (var i = 0; i < listCD.length; i++) {
        if (listCD[i].id == id) {
            listCD.splice(i, 1);
            break;
        }
    }
}

$(document).ready(function() {

    $('#spinner').hide();

    $.ajax({
        url: "list_cd.php",
        dataType : 'json'
    }).done(function(data) {
        // On parcourt l'objet data pour récupérer tous les cd
        for (var i = 0; i < data.listCD.length; i++) {
            var CdCateg = [];
            var oneCD = new Disque(data.listCD[i].titre, data.listCD[i].idCd);
            // On parcourt le json pour récupérer toutes les categories associées
            // au dossier courant.
            for (var j = 0; j < data.listCat.length; j++) {
                if (data.listCD[i].idCd == data.listCat[j].idCd) {
                    oneCD.categories.push(data.listCat[j].idCateg);
                }
            }
            listCD.push(oneCD);
        }
        for (var i = 0; i < data.listCat.length; i++) {
            var oneCateg = new Categorie(data.listCat[i].nom, data.listCat[i].idCat);
            listCat.push(oneCateg);
        }
        $('#listCD').html(displayTabCd());
        $('#mesCateg').html(displayTabCat());
        $('.my_select').select2();
    }).fail(function() {
        alert('erreur');
    });

    $('.my_select').select2();

    // Listener clic Ajouter Categorie
    $('#btnAddCateg').click( function() {
        var nomCat = $('#categ').val().trim();

        if (nomCat != null && nomCat != '') {
            $.post(
                "cdtheque_api.php",
                { nameCat : nomCat },
                function( idCategorie ) {
                    var newCat = new Categorie(nomCat, idCategorie);
                    listCat.push(newCat);
                    displayTabCat();
                    $('#categ').val('');
                    $('.my_select').select2();
                }
            );
        }
    });

    // listener dynamique sur les boutons de suppression des categories
    $(document).on("click", ".subCat", function() {
        var idSupCat = $(this).parent().parent().attr("data-id");
        console.log('onclick suppr categorie');
        deleteCategorie(idSupCat);
        $(this).parents('table').remove();
        $('.my_select').select2();
    });

    // Listener clic Ajouter CD
    $('#btnAddCD').click( function() {
        var nomCD = $('#disque').val().trim();

        if (nomCD != null && nomCD != '') {
            $.post(
                "cdtheque_api.php",
                { nameCD: nomCD },
                function( cdID ) {
                    var newCD = new Disque(nomCD, cdID);
                    listCD.push(newCD);

                    $('#listCD').html(displayTabCd());
                    $('#disque').val('');
                    $('.my_select').select2();
                }
            );
        }
    });

    // listener dynamique sur les boutons de suppression de Disque
    $(document).on("click", ".subCd", function() {
        var idSupCd = $(this).parent().parent().attr("data-id");
        deleteCd(idSupCd);
        $(this).parents('table').prev().prev().remove();
        $(this).parents('table').prev().remove();
        $(this).parents('table').remove();
        $('.my_select').select2();
    });

});
