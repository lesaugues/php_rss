<!Doctype HTML>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link href="Vues/css/style.css" rel="stylesheet"/>
    <title> Page de connexion </title>
</head>

<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container btn-success">
            <h1 class="display-4">Page de connexion</h1>


            <h3>Connexion Admin</h3>
            <form class="form-inline navbar-form" name="Connexion" method="post" action="../index.php?action=connection">
                <input class="form-control input-conn" placeholder="Login" type="text" name="login"/></br>
                <input class="form-control input-conn" placeholder="Password" type="password" name="password"/></br>
                <button class="btn btn-outline-success my-2 my-sm-0 btn-warning" type="submit" name="Valider1" value="OK">Se connecter</button>
            </form>

            <h3>Connexion Super Admin</h3>
            <form class="form-inline navbar-form" name="ConnexionSuperAdmin" method="post" action="../index.php?action=connectionSuperAdmin">
                <input class="form-control input-conn" placeholder="Login" type="text" name="login"/></br>
                <input class="form-control input-conn" placeholder="Password" type="password" name="password"/></br>
                <button class="btn btn-outline-success my-2 my-sm-0 btn-warning" type="submit" name="Valider2" value="OK">Se connecter</button>
            </form>
        </br>
        </div>
    </div>
</body>
</html>