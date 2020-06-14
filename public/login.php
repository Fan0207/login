<?php

// activation du système d'autoloading de Composer
require __DIR__.'/../vendor/autoload.php';

// instanciation du chargeur de templates
$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../templates');

// instanciation du moteur de template
$twig = new \Twig\Environment($loader, [
    // activation du mode debug
    'debug' => true,
    // activation du mode de variables strictes
    'strict_variables' => true,
]);

// chargement de l'extension Twig_Extension_Debug
$twig->addExtension(new \Twig\Extension\DebugExtension());

// initialisation d'une donnée
$greeting = 'Hello Twig!';
$error = '';

print_r($_POST);

if(isset($_POST) && isset($_POST["login"]) && isset($_POST["password"])){
    
    if($_POST["login"] == "toto" && $_POST["password"] == "12345678") {
        session_start();
        $_SESSION["user_id"] = 1;
        $_SESSION["login"] = "toto";
        $url = 'private-page.php';
        header("Location: {$url}", true, 302);
        exit();
        
    } else {
        $error = "identifiant ou mot de passe incorrect";
    }
}


// affichage du rendu d'un template
echo $twig->render('login.html.twig', [
    // transmission de données au template
    'greeting' => $greeting, 
    'error' => $error
]);
