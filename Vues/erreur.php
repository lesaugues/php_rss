<!Doctype HTML>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link href="Vues/css/style.css" rel="stylesheet"/>
    <title> Page d'erreur </title>
</head>
<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container btn-danger">
            <h1 class="display-4"> Erreur </h1>

<?php
if(isset($dVueEreur))
{
    foreach ($dVueEreur as $value)
    {
        echo ($value);
    }
}
?>
        </div>
    </div>
</body>
</head>
</html>