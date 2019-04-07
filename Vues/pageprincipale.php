<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">	
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <link href="Vues/css/style.css" rel="stylesheet"/>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

    <!--
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	-->
	<title> Page Principale </title>
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Site de News</a>
            </div>
            <ul class="nav navbar-nav">
            <?php
            if(ModeleAdmin::isAdmin())
            {?>
                <li><a href="index.php">Accueil</a></li>
                <li><button type="button" class="btn btn-danger navbar-btn" onclick="self.location.href='index.php?action=deconnexion'">Déconnexion</button></li>
                <li><button type="button" class="btn btn-info navbar-btn" onclick="self.location.href='Vues/GestionNews.php'">Gestion News</button></li>
                <li>
                    <span class="navbar-text">
                        Vous êtes connectés en tant qu'admin
                    </span>
                </li>
                <?php
                }
                elseif(ModeleSuperAdmin::isSuperAdmin())
                {?>
                    <li><a href="index.php">Accueil</a></li>
                    <li><button type="button" class="btn btn-danger navbar-btn" onclick="self.location.href='index.php?action=deconnexion1'">Déconnexion</button></li>
                    <li><button type="button" class="btn btn-info navbar-btn" onclick="self.location.href='Vues/GestionNews.php'">Gestion News</button></li>
                    <li><button type="button" class="btn btn-info navbar-btn" onclick="self.location.href='Vues/GestionAdmin.php'">Gestion Admin</button></li>

                    <li>
                        <span class="navbar-text">
                            Vous êtes connectés en tant que super admin
                        </span>
                    </li>
                <?php
                }
                else
                {?>
                    <li><a href="index.php">Accueil</a></li>
                    <li><button type="button" class="btn btn-success navbar-btn" onclick="self.location.href='Vues/vueConnection.php'">Connexion</button></li>
                    <li>
                        <span class="navbar-text">
                            Vous êtes connectés en tant que visiteur
                        </span>
                    </li>
                <?php
                }?>
            </ul>
            <form class="form-inline navbar-form navbar-right" method="post" action="index.php?action=setCookie">
                <input class="form-control mr-sm-2" type="search" placeholder="Nombre de news par page" aria-label="Appliquer" type="number" name="nbNews" min="1" max="10" required>
                <button class="btn btn-outline-success my-2 my-sm-0 btn-warning" type="submit" name="Valider" value="OK">Appliquer</button>
            </form>
        </div>
    </nav>



    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">News</h1>
        <p class="lead">Voici les dernières news !</p>

        <?php
            if(isset($tabNews))
            {
                foreach ($tabNews as $news)
                {
                    echo'<div class="news btn-success">';
                    echo'<h2>'.$news->getTitre().'</h2></br><h3>'.$news->getCategorie().'</h3></br><h4>'.$news->getDescription().'</h4></br><h4>'.$news->getDate().'</h4>';
                    echo '<a href='.$news->getLink().'>Voir entièrement</a></br></br>';
                    if(ModeleAdmin::isAdmin() or ModeleSuperAdmin::isSuperAdmin())
                    {
                        echo '<button class="btn btn-danger pull-right btn-suppr" name="Supprimer" value="delete">Supprimer</button>';
                    }
                    echo '</div>';
                }
                echo '<div id="navi" class="btn-success">';
                if($page-1>=1)
                {
                    echo '<a class="navi-item" href=index.php?page='.($page-1).'>Précédent</a>';
                }
                else
                {
                    echo '<a class="navi-item" href=index.php?page='.(1).'>Précédent</a>';
                }
                if($page-1>=1)
                {
                    echo '<a class="navi-item" href=index.php?page='.($page-1).'>'.($page-1).'</a>';
                }
                echo '<a class="navi-item" href=index.php?page='.($page).'>'.$page.'</a>';
                echo '<a class="navi-item" href=index.php?page='.($page+1).'>'.($page+1).'</a>';
                echo '<a class="navi-item" href=index.php?page='.($page+1).'>Suivant </a>';
                echo '</div>';
            }
            else
            {
                $tabErreur[]="Probleme chargement news";
                require_once("erreur.php");
            }

        ?>
  </div>
</div>

</body>
</html>