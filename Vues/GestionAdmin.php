<!Doctype HTML>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link href="Vues/css/style.css" rel="stylesheet"/>
    <title> Page gestion des admins </title>
</head>

<body>
<div class="jumbotron jumbotron-fluid">
    <div class="container btn-success">
        <h1 class="display-4">Page de gestion des Admins</h1>

        <h3>Ajouter un nouvel Admin</h3>
        <form class="form-inline navbar-form" name="ajouterAdmin" method="post" action="../index.php?action=addAdmin">
            <input class="form-control input-conn" placeholder="Login" type="text" name="login"/></br>
            <input class="form-control input-conn" placeholder="Password" type="password" name="password"/></br>
            <input class="form-control input-conn" placeholder="Email" type="text" name="mail"/></br>
            <button class="btn btn-outline-success my-2 my-sm-0 btn-danger" type="button" value="Retour" name="Retour" onclick="history.go(-1)">Retour</button>
            <button class="btn btn-outline-success my-2 my-sm-0 btn-info" type="submit" name="Valider" value="Valider">Valider</button>
        </form>

        <h3>Modification mot de passe d'un admin</h3>
        <form class="form-inline navbar-form" name="miseAJourAdmin" method="post" action="../index.php?action=updateMDP">
            <input class="form-control input-conn" placeholder="login" type="text" name="login"/></br>
            <input class="form-control input-conn" placeholder="Old Password" type="password" name="oldPassword"/></br>
            <input class="form-control input-conn" placeholder="New Password" type="password" name="newPassword"/></br>
            <button class="btn btn-outline-success my-2 my-sm-0 btn-danger" type="button" value="Retour" name="Retour" onclick="history.go(-1)">Retour</button>
            <button class="btn btn-outline-success my-2 my-sm-0 btn-info" type="submit" name="Valider" value="Valider">Valider</button>
        </form>

        <h3>Supprimer un admin</h3>
        <form class="form-inline navbar-form" name="suppAdmin" method="post" action="../index.php?action=suppAdmin">
            <input class="form-control input-conn" placeholder="Login" type="text" name="login"/></br>
            <input class="form-control input-conn" placeholder="Password" type="password" name="password"/></br>
            <button class="btn btn-outline-success my-2 my-sm-0 btn-danger" type="button" value="Retour" name="Retour" onclick="history.go(-1)">Retour</button>
            <button class="btn btn-outline-success my-2 my-sm-0 btn-info" type="submit" name="Valider" value="Valider">Valider</button>
        </form>
    </div>
</div>
</body>
</html>