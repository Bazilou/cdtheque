<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">

        <title>Gestionnaire de CD</title>

        <script src="js/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


        <script src="js/music.js"></script>

    </head>
    <body>
        <div class="container">

            <div id="test"></div>

            <div class="row">
				<div class="col-md-8">
                    <div class="ajoutCD">
                        <label for="disque">Titre du CD : </label>
                        <input type="text" id="disque">
                        <a class="btn btn-success" id="btnAddCD" role="button">
							<span class="glyphicon glyphicon-plus"></span>
							Ajouter un CD
						</a>
						<span id="spinner">
							<img src="img/spinner.gif">
						</span>
                    </div>
                    <div id="listCD"></div>
                </div>

				<div class="col-md-4">
                    <div class="listCat">
                        <table>
                            <tr>
                                <td>Categorie :</td>
                                <td><input type="text" id="categ" /></td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td><br>
                                    <a class="btn btn-success" id="btnAddCateg" role="button">
                                        <span class="glyphicon glyphicon-plus"></span> Ajouter une Category
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <div id="mesCateg"></div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
