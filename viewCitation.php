<?php

function load($class)
{
    include("Entity/" . $class . ".class.php");
}

spl_autoload_register("load");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$systeme = new Systeme();

$login = null;
$citation = null;
$fullName = null;
$login = null;
$errors = "";

try {

    $login = $systeme->test_input($_POST["login"], "login");
    $citation = $systeme->test_input($_POST["citation"], "citation");
    $fullName = $systeme->test_input($_POST["auteur"], "auteur");

    $date = $systeme->test_input($_POST["date"], "date");

    $fullName = explode(" ", $fullName);
    
    $auteur = $systeme->getAuteur(new Auteur($fullName[0], $fullName[1], intval($fullName[2]), $systeme), $systeme->getAuteurs());
    $citationObj = new Citation($citation, new DateTime($date), $auteur);
    $systeme->ajouterCitation($citationObj); 

} catch (Exception $e) {
    $errors = $e->getMessage();
}

$auteurs = $systeme->getAuteurs();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    <?php include 'style.css'; ?>
    </style>
</head>

<body>
    <style>
        td {
            background: white;
        }
    </style>
    <h1>View Citation</h1>
    <table border="1" bgcolor="#ccccff" frame="above">
        <tbody>
            <tr>
                <th><label for="login">Login</label></th>
                <td><?php echo $login ?></td>
                <th>Errors</th>
            </tr>
            <tr>
                <th><label for="citation">Citation</label></th>
                <td><?php echo $citation ?></td>
                <td rowspan="5" style="background: white; color: red" name="errors_text"><?php echo $errors; ?></td>
            </tr>
            <tr>
                <th><label for="auteur">Auteur</label></th>
                <td><?php echo $auteur->getNomComplet() ?></td>
            </tr>
            <tr>
                <th><label for="date">Date</label></th>
                <td><?php echo $date ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>View Citations</h1>
    <?php if (!empty($auteurs)) : ?>
        <table frame="above">
        <thead>
            <tr>
                <th>Author</th>
                <th>Citations</th>
                <th>Quote</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($auteurs as $auteur) : ?>
                <tr>
                    <td><?= htmlspecialchars($auteur->getNomComplet()) ?></td>
                    <td>
                    <?php 
                    
                    $_citations = $auteur->getCitations();
                    echo "" . sizeof($_citations);
                    ?></td>
                    <td>
                        <ul class="quote-list">
                            <?php foreach ($auteur->getCitations() as $c) : ?>
                                <li><?= htmlspecialchars($c->getTexte()) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
        <p>No auteurs found.</p>
    <?php endif; ?>
</body>

</html>