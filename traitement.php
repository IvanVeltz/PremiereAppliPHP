<?php
session_start();

if (isset($_GET['action'])){

    switch($_GET['action']){

        case "add":
            if(isset($_POST['submit'])){
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                if($name&&$price&&$qtt){
            
                    $product = [
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price * $qtt,
                    ];
            
                    $_SESSION['products'][] = $product;
                    $_SESSION['messageAjout'] = "Le produit $name a été ajouté avec succès";
            
                } else {
                    $_SESSION['messageAjout'] = "Erreur : le produit n'a pas pu être ajouté";
                }
            }
            
            header("Location:index.php");
            break;

        case "delete":

            if(isset($_POST['index'])){
                $index = intval($_POST['index']); // Récupére l'index du produit
            
                if (isset($_SESSION['products'][$index])) {
                    unset($_SESSION['products'][$index]); // Supprime le produit
                    $_SESSION['messageDelete'] = "Le produit a été supprimé avec succès.";
                } else {
                    $_SESSION['messageDelete'] = "Erreur : le produit à supprimer n'existe pas.";
                }
            }
            header("Location:recap.php");
            break;

        case "clear":

            if (isset($_POST['delete_all'])){
                // Suppression de tous les produits
                if (isset($_SESSION['products'])) {
                    unset($_SESSION['products']); // Supprime tous les produits
                    $_SESSION['messageDelete'] = "Les produits ont été supprimés avec succès.";
                } else {
                    $_SESSION['messageDelete'] = "Erreur : les produits à supprimer n'existent pas.";
                }
            }
            header("Location:recap.php");
            break;

        case "up-qtt":
            
            if (isset($_POST['plus'])) {
                $index = intval($_POST['plus']); // Récupére l'index du produit
                // Ajoute une quantité à l'article
                if (isset($_SESSION['products'][$index])) {
                    $_SESSION['products'][$index]['qtt'] += 1;
                    $_SESSION['products'][$index]['total'] += $_SESSION['products'][$index]['price'];
            
                }
            }
            header("Location:recap.php");
            break;

        case "down-qtt":
            if (isset($_POST['minus'])) {
                $index = intval($_POST['minus']); // Récupére l'index du produit
                // Retirer une quantité à l'article
                if (isset($_SESSION['products'][$index]) && ($_SESSION['products'][$index]['qtt'] > 0)) {
                    $_SESSION['products'][$index]['qtt'] -= 1;
                    $_SESSION['products'][$index]['total'] -= $_SESSION['products'][$index]['price'];
                }
            }
            header("Location:recap.php");
            break;

        default :
        header("Location:index.php");
            
    }
}



// session Une façon de stocker des données différentes pour chaque utilisateur, en utilisant un identifiant unique, durée de vie : quand on ferme le navigateur
// rapport entre session et navigateur, que peux envoyer la session au navigateur ? 
// Les identifiants de sessions sont envoyé au navigateur via un cookie
 
// session start Ca créer une session, ou reprend la session en cours si elle existe déjà

// faille XSS Une faille de sécurité coté client qui permet à un utilisateur malveilllant d'injecter du code

// superglobale Une varibale prédefini en PHP, utilisable à n'importe quel endroit?