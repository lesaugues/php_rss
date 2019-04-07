<!Doctype HTML>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <link href="Vues/css/style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <title> Gestion News </title>
</head>
<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container btn-success">
            <h1 class="display-4">Page de gestion des News</h1>

            <h3>Ajouter une News</h3>
            <form class="form-inline navbar-form" name="ajouterNew" method="post" action="../index.php?action=ajouter">
                <input class="form-control input-conn" placeholder="Titre (Primary Key)" type="text" name="titre"/></br>
                <input class="form-control input-conn" placeholder="Catégorie" type="text" name="categ"/></br>
                <input class="form-control input-conn" placeholder="00/00/0000" type="text" name="date"/></br>
                <input class="form-control input-conn" placeholder="Description" type="text" name="desc"/></br>
                <input class="form-control input-conn" placeholder="Lien" type="text" name="lien"/></br>
                <button class="btn btn-outline-success my-2 my-sm-0 btn-danger" type="button" value="Retour" name="Retour" onclick="history.go(-1)">Retour</button>
                <button class="btn btn-outline-success my-2 my-sm-0 btn-info" type="submit" name="Valider" value="Valider">Valider</button>
            </form>

            <h3>Supprimer une News</h3>
            <form class="form-inline navbar-form" name="SupprimerNews" method="post" action="../index.php?action=supprimer">
                <input class="form-control input-conn" placeholder="Titre (Primary Key)" type="text" name="titre"/></br>
                <button class="btn btn-outline-success my-2 my-sm-0 btn-danger" type="button" value="Retour" name="Retour" onclick="history.go(-1)">Retour</button>
                <button class="btn btn-outline-success my-2 my-sm-0 btn-info" type="submit" name="Valider" value="Valider">Valider</button>
            </form>
            </br>
        </div>
    </div>
</body>
</html>